@extends('manager.master')
@section('header')
<style>
    .page-header h1 { font-family: 'Fraunces', serif; font-size: 2.2rem; color: var(--primary-dark); margin-bottom: 8px; }
    .config-card { background: white; border-radius: var(--radius-lg); padding: 30px; box-shadow: var(--shadow-card); border: none; }
    .form-label { font-weight: 700; color: var(--primary-dark); margin-bottom: 10px; font-size: 0.9rem; }
    .form-control-custom { 
        width: 100%; padding: 14px 18px; border-radius: var(--radius-md); 
        border: 1px solid rgba(0,0,0,0.08); background: #F9F9F9; transition: all 0.2s; 
    }
    .form-control-custom:focus { outline: none; border-color: var(--primary-dark); background: white; box-shadow: 0 0 0 4px rgba(15, 53, 72, 0.05); }
    
    .guide-card { background: #1A1A2E; color: white; border-radius: var(--radius-lg); padding: 25px; margin-top: 30px; border: none; }
    .guide-card h3 { font-family: 'Fraunces', serif; color: var(--accent-orange); margin-bottom: 15px; }
    .guide-card ul { padding-left: 20px; }
    .guide-card li { margin-bottom: 10px; color: rgba(255,255,255,0.8); font-size: 0.9rem; }
    
    .template-box { background: rgba(255,255,255,0.05); border-radius: var(--radius-md); padding: 15px; position: relative; margin-top: 20px; }
    .template-code { color: #fff; font-family: monospace; font-size: 0.85rem; white-space: pre-wrap; word-break: break-all; }
    .copy-btn { position: absolute; top: 10px; right: 10px; background: var(--accent-orange); color: var(--primary-dark); border: none; padding: 5px 12px; border-radius: var(--radius-pill); font-size: 0.7rem; font-weight: 700; }
</style>
@endsection

@section('content')
<div class="page-header mb-5">
    <h1>Manage Notifications</h1>
    <p class="text-muted">Update platform-wide notifications and homepage announcements.</p>
</div>

<div class="row g-4">
    <div class="col-lg-4">
        <div class="config-card h-100">
            <label class="form-label">Notification Type</label>
            <select class="form-control-custom form-select" id="type" name="type">
                <option value="">-- Select Type --</option>
                @foreach($notifications as $not)
                    <option data-title="{{ $not->title }}" data-description="{{ $not->description }}" value="{{ $not->id }}">{{ $not->type }}</option>
                @endforeach
            </select>
            <div class="mt-4 text-center">
                <div class="bg-light p-4 rounded-4">
                    <i class="fa-solid fa-bell-concierge fs-1 text-muted mb-3"></i>
                    <p class="small text-muted mb-0">Select a type from the dropdown to edit its content.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-8">
        <div class="config-card">
            <div id="empty_state" class="text-center py-5">
                <h4 class="text-muted serif">No Notification Selected</h4>
            </div>

            <div id="show_notify" style="display:none">
                <h4 class="serif mb-4" style="color: var(--primary-dark)">Edit Notification</h4>
                <form method="post" action="{{ route('update_notification') }}">
                    @csrf
                    <input type="hidden" id="notf_id" name="notf_id" />
                    
                    <div class="mb-4">
                        <label class="form-label">Notification Title</label>
                        <input type="text" id="title" class="form-control-custom" name="title" required placeholder="e.g. System Maintenance">
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Description / HTML Content</label>
                        <textarea class="form-control-custom" name="description" id="description" rows="6" placeholder="Enter the detailed message or HTML code..."></textarea>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary rounded-pill px-5 py-3 fw-bold">Update Notification</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="guide-card">
            <h3>Lucky Tuesday Guide</h3>
            <ul>
                <li>Create the giveaway <a href="https://vtubiz.com/my-giveaway" class="text-white text-decoration-underline">here</a></li>
                <li>Select "Homepage Notification" from the dropdown above</li>
                <li>Copy the format below and paste into the description field</li>
                <li>Update the link inside the code with your new giveaway URL</li>
            </ul>

            <div class="template-box">
                <button class="copy-btn" onclick="copyTemplate()">COPY HTML</button>
                <code class="template-code" id="template-content">&lt;h2&gt;Lucky Tuesday Giveaway!&lt;/h2&gt;
&lt;p&gt;Get Lucky Today, Get 1GB of data for N10 on all networks. &lt;a href="https://vtubiz.com/Lucky-Tuesday-Giveaway-jBpXw"&gt;Click here to participate.&lt;/a&gt;&lt;/p&gt;</code>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        $("#type").on('change', function() {
            const val = $(this).val();
            if(val) {
                $("#empty_state").hide();
                $("#show_notify").fadeIn();
                $("#title").val($(this).find(':selected').data('title'));
                $("#description").val($(this).find(':selected').data('description'));
                $("#notf_id").val(val);
            } else {
                $("#show_notify").hide();
                $("#empty_state").fadeIn();
            }
        });

        @if(session('success'))
            Swal.fire({ icon: 'success', title: 'Success!', text: '{{ session("success") }}', confirmButtonColor: '#0F3548' });
        @endif
    });

    function copyTemplate() {
        const content = document.getElementById('template-content').innerText;
        navigator.clipboard.writeText(content).then(() => {
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: 'Template copied!',
                showConfirmButton: false,
                timer: 2000
            });
        });
    }
</script>
@endsection