@extends('super.master')

@section('header')
<style>
    .marketing-card {
        border: none;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        background: #fff;
        padding: 30px;
    }
    .form-label {
        font-weight: 600;
        color: #0F3548;
        margin-bottom: 10px;
    }
    .form-control, .form-select {
        border-radius: 12px;
        padding: 12px 20px;
        border: 1px solid #e0e0e0;
        transition: all 0.3s;
    }
    .form-control:focus, .form-select:focus {
        border-color: #fb9129;
        box-shadow: 0 0 0 0.25rem rgba(251, 145, 41, 0.1);
    }
    .btn-send {
        background: #fb9129;
        color: #fff;
        border-radius: 12px;
        padding: 12px 30px;
        font-weight: 600;
        border: none;
        transition: all 0.3s;
    }
    .btn-send:hover {
        background: #e67e22;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(230, 126, 34, 0.3);
        color: #fff;
    }
    .recipient-badge {
        background: #f8f9fa;
        border: 1px solid #e0e0e0;
        padding: 10px 15px;
        border-radius: 10px;
        margin-bottom: 15px;
    }
    .loading-spinner {
        display: none;
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row mb-4 align-items-center">
        <div class="col-auto">
            <h2 class="serif fw-bold mb-0">Email Marketing</h2>
            <p class="text-secondary">Send professional campaigns to your platform users</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="marketing-card">
                <form action="{{ route('superadmin.send_marketing_email') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="mb-4">
                        <label class="form-label">Recipient Filter</label>
                        <select class="form-select" id="recipientFilter">
                            <option value="">Select a group to populate recipients...</option>
                            <option value="this_week">Users joined This Week</option>
                            <option value="this_month">Users joined This Month</option>
                            <option value="last_month">Users joined Last Month</option>
                            <option value="last_3_months">Users joined Last 3 Months</option>
                            <option value="last_6_months">Users joined Last 6 Months</option>
                            <option value="this_year">Users joined This Year</option>
                            <option value="last_year">Users joined Last Year</option>
                            <option value="all">All Users</option>
                        </select>
                        <small class="text-muted mt-2 d-block">Selecting a group will automatically populate the field below.</small>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Recipient Emails</label>
                        <textarea name="recipients" id="recipients" class="form-control" rows="3" placeholder="Comma separated emails..." required></textarea>
                        <div id="loadingRecipients" class="mt-2 text-primary" style="display:none;">
                            <i class="fas fa-spinner fa-spin"></i> Fetching recipients...
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Subject</label>
                        <input type="text" name="subject" class="form-control" placeholder="Enter email subject" required>
                    </div>

                    <div class="mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <label class="form-label mb-0">Email Content</label>
                            <div class="d-flex align-items-center gap-3">
                                <button type="button" class="btn btn-sm btn-outline-primary" id="previewBtn">
                                    <i class="fa-solid fa-eye me-1"></i> Preview
                                </button>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="is_html" id="isHtml" value="1">
                                    <label class="form-check-label small text-secondary" for="isHtml">Send as HTML</label>
                                </div>
                            </div>
                        </div>
                        <textarea name="content" id="emailContent" class="form-control" rows="10" placeholder="Write your message here..." required></textarea>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Attachments</label>
                        <input type="file" name="attachments[]" class="form-control" multiple>
                        <small class="text-muted mt-2 d-block">You can select multiple files.</small>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-send">
                            <i class="fa-solid fa-paper-plane me-2"></i> Send Marketing Emails
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Preview Modal -->
<div class="modal fade" id="previewModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="border-radius: 20px;">
            <div class="modal-header border-0">
                <h5 class="modal-title serif fw-bold">Email Preview</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div id="previewContainer" style="border: 1px solid #eee; border-radius: 10px; min-height: 300px; padding: 20px;">
                    <!-- Content injected here -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        $('#recipientFilter').on('change', function() {
            const filter = $(this).val();
            if (!filter) return;

            $('#loadingRecipients').show();
            
            axios.get(`/fetch_recipients/${filter}`)
                .then(response => {
                    $('#recipients').val(response.data.emails);
                    Swal.fire({
                        icon: 'success',
                        title: 'Recipients Loaded',
                        text: `Found ${response.data.emails.split(',').filter(e => e.trim()).length} recipients.`,
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    });
                })
                .catch(error => {
                    console.error(error);
                    Swal.fire('Error', 'Failed to fetch recipients.', 'error');
                })
                .finally(() => {
                    $('#loadingRecipients').hide();
                });
        });

        $('#previewBtn').on('click', function() {
            const content = $('#emailContent').val();
            const isHtml = $('#isHtml').is(':checked');
            
            if (!content) {
                Swal.fire('Empty Content', 'Please enter some content to preview.', 'warning');
                return;
            }

            if (isHtml) {
                $('#previewContainer').html(content);
            } else {
                $('#previewContainer').html(`<pre style="white-space: pre-wrap;">${content}</pre>`);
            }
            
            const modal = new bootstrap.Modal(document.getElementById('previewModal'));
            modal.show();
        });

        $('form').on('submit', function() {
            const btn = $(this).find('button[type="submit"]');
            btn.prop('disabled', true);
            btn.html('<i class="fas fa-spinner fa-spin me-2"></i> Sending Emails...');
        });
    });
</script>
@endsection
