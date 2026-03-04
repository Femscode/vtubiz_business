@extends('dashboard.master1')

@section('header')
<style>
    .giveaway-header {
        margin-bottom: var(--space-lg);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .giveaway-header h1 {
        font-family: 'Fraunces', serif;
        font-size: 2.2rem;
        color: var(--primary-dark);
        margin-bottom: 8px;
    }
    .giveaway-card {
        background: var(--surface);
        border-radius: var(--radius-lg);
        padding: var(--space-lg);
        box-shadow: var(--shadow-card);
    }
    .btn-create-giveaway {
        background: var(--primary-dark);
        color: white;
        border: none;
        padding: 12px 24px;
        border-radius: var(--radius-pill);
        font-weight: 600;
        cursor: pointer;
        transition: transform 0.1s;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    .btn-create-giveaway:hover { color: white; opacity: 0.9; }

    .modern-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0 12px;
    }
    .modern-table tbody tr {
        background: #FDFCF8;
        transition: transform 0.2s;
        box-shadow: 0 2px 4px rgba(0,0,0,0.02);
    }
    .modern-table tbody tr:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 16px rgba(0,0,0,0.04);
    }
    .modern-table tbody td {
        padding: 20px;
        border: none;
    }
    .modern-table tbody td:first-child { border-radius: 16px 0 0 16px; border-left: 4px solid var(--accent-yellow); }
    .modern-table tbody td:last-child { border-radius: 0 16px 16px 0; }

    .copy-link-group {
        display: flex;
        background: white;
        border: 1px solid rgba(0,0,0,0.08);
        border-radius: 12px;
        overflow: hidden;
        max-width: 400px;
        margin-top: 10px;
    }
    .copy-link-input {
        border: none;
        padding: 8px 12px;
        font-size: 0.8rem;
        flex: 1;
        background: transparent;
        color: var(--text-secondary);
        outline: none;
    }
    .btn-copy-sm {
        background: var(--primary-dark);
        color: white;
        border: none;
        padding: 8px 15px;
        cursor: pointer;
        font-size: 0.8rem;
    }

    .btn-action-sm {
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        text-decoration: none;
        display: inline-block;
        border: none;
        transition: all 0.2s;
    }
    .btn-primary-sm { background: rgba(47, 128, 237, 0.1); color: var(--accent-blue); }
    .btn-info-sm { background: rgba(15, 53, 72, 0.05); color: var(--primary-dark); }
    .btn-danger-sm { background: rgba(235, 87, 87, 0.1); color: var(--accent-pink); }
</style>
@endsection

@section('content')
<div class="giveaway-header">
    <div>
        <h1>My Giveaways</h1>
        <p class="text-muted">Manage your active giveaways and track winners.</p>
    </div>
    <div class="d-flex gap-2">
        <a href='/create-giveaway' class="btn-create-giveaway">
            <i class="fa-solid fa-gift"></i> Create Giveaway
        </a>
    </div>
</div>

<div class="giveaway-card">
    <div class="table-responsive">
        <table class="modern-table datatable">
            <thead class="d-none">
                <tr><th>Details</th></tr>
            </thead>
            <tbody>
                @foreach($giveaway as $group)
                <tr>
                    <td>
                        <div class="d-flex justify-content-between align-items-start flex-wrap gap-3">
                            <div style="flex: 1; min-width: 300px;">
                                <h4 class="serif mb-1" style="color: var(--primary-dark);">{{ $group->name }}</h4>
                                <div class="text-sm font-weight-bold" style="color: var(--accent-green);">
                                    Value: ₦{{ number_format($group->estimated_amount) }}
                                </div>
                                
                                <div class="mt-3">
                                    @if(($group->type == "question_data" || $group->type=='question_airtime' || $group->type == 'question_cash') && count($group->all_questions->all()) == 0)
                                        <div class="alert alert-warning py-2 px-3 text-xs" style="border-radius: 10px; border: 1px dashed #D4A017; background: rgba(242, 201, 76, 0.05);">
                                            <i class="fa-solid fa-circle-info me-1"></i> Add questions to activate this giveaway link.
                                        </div>
                                    @else
                                        <div class="copy-link-group">
                                            <input id="copy_content_{{ $loop->iteration }}" type="text" class="copy-link-input" readonly value="https://vtubiz.com/{{ $group->slug }}">
                                            <button class="btn-copy-sm copy-btn" data-clipboard-target="#copy_content_{{ $loop->iteration }}">
                                                <i class='fa fa-copy'></i>
                                            </button>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="d-flex gap-2 align-items-center">
                                @if($group->type == 'question_data' || $group->type == 'question_airtime' || $group->type == 'question_cash')
                                    <a href='/add_question/{{ $group->slug }}' class='btn-action-sm btn-primary-sm'>Add Questions</a>
                                @endif
                                <a href='/giveaway_participant/{{ $group->slug }}' class='btn-action-sm btn-info-sm'>More Info</a>
                                <a onclick="return confirm('Are you sure you want to delete this giveaway?')" href='/delete_giveaway/{{ $group->slug }}' class='btn-action-sm btn-danger-sm'>
                                    <i class='fa fa-trash'></i>
                                </a>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/clipboard@2.0.11/dist/clipboard.min.js"></script>
<script>
    $(document).ready(function() {
        var oTable = $('.datatable').DataTable({
            ordering: false,
            searching: true,
            dom: 'lrtip'
        });

        var clipboard = new ClipboardJS('.copy-btn');
        clipboard.on('success', function (e) {
            e.clearSelection();
            var btn = $(e.trigger);
            btn.html('Copied!');
            btn.css('background', 'var(--accent-green)');
            setTimeout(function () {
                btn.html('<i class="fa fa-copy"></i>');
                btn.css('background', 'var(--primary-dark)');
            }, 2000);
        });

        @if (session('success'))
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 3000
            });
        @endif
    });
</script>
@endsection
