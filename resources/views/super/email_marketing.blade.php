@extends('super.master')

@section('header')
<!-- Quill Editor CSS -->
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
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
    .placeholder-pill {
        cursor: pointer;
        background: #f0f4f7;
        color: #0F3548;
        padding: 5px 12px;
        border-radius: 50px;
        font-size: 12px;
        display: inline-block;
        margin-right: 5px;
        margin-bottom: 5px;
        transition: all 0.2s;
        border: 1px solid transparent;
    }
    .placeholder-pill:hover {
        background: #fb9129;
        color: #fff;
    }
    #editor {
        height: 350px;
        border-bottom-left-radius: 12px;
        border-bottom-right-radius: 12px;
    }
    .ql-toolbar {
        border-top-left-radius: 12px;
        border-top-right-radius: 12px;
        border-color: #e0e0e0 !important;
    }
    .ql-container {
        border-bottom-left-radius: 12px;
        border-bottom-right-radius: 12px;
        border-color: #e0e0e0 !important;
        font-family: 'DM Sans', sans-serif;
        font-size: 16px;
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row mb-4 align-items-center">
        <div class="col-auto">
            <h2 class="serif fw-bold mb-0">Email Marketing</h2>
            <p class="text-secondary">Send personalized campaigns to your platform users</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-9 mx-auto">
            <div class="marketing-card">
                <form action="{{ route('superadmin.send_marketing_email') }}" method="POST" enctype="multipart/form-data" id="marketingForm">
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
                        <input type="text" name="subject" id="subject" class="form-control" placeholder="Enter email subject" required>
                        <div class="mt-2">
                            <span class="text-muted small me-2">Insert placeholder:</span>
                            <span class="placeholder-pill" data-target="subject">{name}</span>
                            <span class="placeholder-pill" data-target="subject">{phone}</span>
                        </div>
                    </div>

                    <div class="mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <label class="form-label mb-0">Email Content</label>
                            <button type="button" class="btn btn-sm btn-outline-primary" id="previewBtn">
                                <i class="fa-solid fa-eye me-1"></i> Preview
                            </button>
                        </div>

                        <div class="recipient-badge mb-3">
                            <div class="fw-bold mb-1 small text-primary"><i class="fas fa-magic me-1"></i> Personalized Placeholders</div>
                            <div class="d-flex flex-wrap">
                                <span class="placeholder-pill" data-target="editor">{name}</span>
                                <span class="placeholder-pill" data-target="editor">{email}</span>
                                <span class="placeholder-pill" data-target="editor">{phone}</span>
                                <span class="placeholder-pill" data-target="editor">{balance}</span>
                                <span class="placeholder-pill" data-target="editor">{brand_name}</span>
                            </div>
                            <div class="small text-muted mt-1">Click a pill to insert it into your message. It will be replaced with user data during sending.</div>
                        </div>

                        <!-- Quill Editor -->
                        <div id="editor"></div>
                        <input type="hidden" name="content" id="emailContent">
                        <input type="hidden" name="is_html" value="1"> <!-- Always send as HTML now since we use Quill -->
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Attachments</label>
                        <input type="file" name="attachments[]" class="form-control" multiple>
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
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title serif fw-bold">Email Preview</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <div class="small text-muted mb-1">Subject:</div>
                    <div id="previewSubject" class="fw-bold p-3 bg-light rounded-3"></div>
                </div>
                <div class="small text-muted mb-1">Content:</div>
                <div id="previewContainer" class="p-4 rounded-3" style="border: 1px solid #eee; min-height: 200px;">
                    <!-- Content injected here -->
                </div>
                <div class="mt-3 small text-info p-2 bg-info-subtle rounded border border-info">
                    <i class="fas fa-info-circle me-1"></i> This is a preview showing placeholders. They will be replaced with actual user data when sent.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<!-- Quill Editor JS -->
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script>
    $(document).ready(function() {
        // Initialize Quill
        var quill = new Quill('#editor', {
            theme: 'snow',
            modules: {
                toolbar: [
                    [{ 'header': [1, 2, 3, false] }],
                    ['bold', 'italic', 'underline', 'strike'],
                    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                    [{ 'color': [] }, { 'background': [] }],
                    ['link', 'clean']
                ]
            }
        });

        // Recipient Filter
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

        // Placeholder Click Handler
        $('.placeholder-pill').on('click', function() {
            const placeholder = $(this).text();
            const target = $(this).data('target');

            if (target === 'subject') {
                const subject = $('#subject').val();
                $('#subject').val(subject + ' ' + placeholder);
            } else if (target === 'editor') {
                const range = quill.getSelection(true);
                quill.insertText(range.index, placeholder);
            }
        });

        // Preview Logic
        $('#previewBtn').on('click', function() {
            const content = quill.root.innerHTML;
            const subject = $('#subject').val();
            
            if (quill.getText().trim().length === 0) {
                Swal.fire('Empty Content', 'Please enter some content to preview.', 'warning');
                return;
            }

            $('#previewSubject').text(subject || '(No Subject)');
            $('#previewContainer').html(content);
            
            const modal = new bootstrap.Modal(document.getElementById('previewModal'));
            modal.show();
        });

        // Form Submit
        $('#marketingForm').on('submit', function(e) {
            // Put quill content into hidden input
            const content = quill.root.innerHTML;
            if (quill.getText().trim().length === 0) {
                e.preventDefault();
                Swal.fire('Empty Content', 'Please enter some email content.', 'error');
                return;
            }
            
            $('#emailContent').val(content);

            const btn = $(this).find('button[type="submit"]');
            btn.prop('disabled', true);
            btn.html('<i class="fas fa-spinner fa-spin me-2"></i> Sending Emails...');
        });
    });
</script>
@endsection
