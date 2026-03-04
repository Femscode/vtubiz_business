@extends('dashboard.master1')

@section('header')
<style>
    .security-header {
        margin-bottom: var(--space-lg);
    }
    .security-header h1 {
        font-family: 'Fraunces', serif;
        font-size: 2.2rem;
        color: var(--primary-dark);
        margin-bottom: 8px;
    }
    .security-card {
        background: var(--surface);
        border-radius: var(--radius-lg);
        padding: var(--space-lg);
        box-shadow: var(--shadow-card);
    }
    .form-label {
        font-weight: 600;
        color: var(--primary-dark);
        margin-bottom: 8px;
        display: block;
        font-size: 0.9rem;
    }
    .form-control-custom {
        width: 100%;
        padding: 12px 16px;
        border-radius: var(--radius-md);
        border: 1px solid rgba(0,0,0,0.08);
        background: #F9F9F9;
        font-family: 'DM Sans', sans-serif;
        transition: all 0.2s ease;
        text-align: center;
        font-size: 1.5rem;
        letter-spacing: 10px;
    }
    .form-control-custom:focus {
        outline: none;
        border-color: var(--primary-dark);
        background: white;
        box-shadow: 0 0 0 4px rgba(15, 53, 72, 0.05);
    }
    .btn-save {
        background: var(--primary-dark);
        color: white;
        border: none;
        padding: 14px 28px;
        border-radius: var(--radius-pill);
        font-weight: 600;
        cursor: pointer;
        transition: transform 0.1s ease;
        width: 100%;
        margin-top: 20px;
    }
    .btn-save:active { transform: scale(0.98); }
    
    .status-card {
        background: #FDFCF8;
        border: 1px solid rgba(0,0,0,0.03);
        border-radius: var(--radius-lg);
        padding: var(--space-lg);
        text-align: center;
    }
    .status-icon {
        font-size: 2.5rem;
        margin-bottom: 15px;
    }
</style>
@endsection

@section('content')
<div class="security-header">
    <h1>Transaction PIN</h1>
    <p class="text-muted">Secure your transactions with a 4-digit security PIN.</p>
</div>

<div class="row g-5">
    <div class="col-lg-4">
        <div class="status-card">
            <div class="status-icon">
                @if($user->pin_status == 1)
                    <i class="fa-solid fa-circle-check" style="color: var(--accent-green);"></i>
                @else
                    <i class="fa-solid fa-circle-xmark" style="color: var(--accent-pink);"></i>
                @endif
            </div>
            <h4 class="serif" style="color: var(--primary-dark);">PIN Validation</h4>
            <p class="text-sm text-muted mb-4">Currently {{ $user->pin_status == 1 ? 'Enabled' : 'Disabled' }}</p>
            
            <form action='{{ route("change_pin_status") }}' method='post'> @csrf
                <div class="mb-3">
                    <label class="form-label">Current PIN</label>
                    <input placeholder="****" maxlength="4" required type="password" name='current_pin' class="form-control-custom">
                </div>
                
                <button type="submit" class="btn-save {{ $user->pin_status == 1 ? 'bg-danger' : '' }}" style="background: {{ $user->pin_status == 1 ? 'var(--accent-pink)' : 'var(--primary-dark)' }}">
                    {{ $user->pin_status == 1 ? 'Disable PIN' : 'Enable PIN' }}
                </button>
            </form>
        </div>
    </div>

    <div class="col-lg-8">
        <div class="security-card">
            <h4 class="serif mb-4" style="color: var(--primary-dark);">Change Transaction PIN</h4>
            
            <form action='{{ route("resetpin") }}' method='post'> @csrf
                <div class="row g-4">
                    <div class="col-12">
                        <label class="form-label">Current PIN</label>
                        <input placeholder="****" maxlength="4" required type="password" name='current_pin' class="form-control-custom">
                    </div>
                    
                    <div class="col-md-6">
                        <label class="form-label">New PIN</label>
                        <input required type="password" maxlength="4" name='new_pin' class="form-control-custom" placeholder="****">
                    </div>
                    
                    <div class="col-md-6">
                        <label class="form-label">Confirm New PIN</label>
                        <input required type="password" maxlength="4" name='confirm_pin' class="form-control-custom" placeholder="****">
                    </div>
                </div>

                <div class="mt-4">
                    <p class="text-sm">Forgot your PIN? <a id='reset_pin' style="color: var(--accent-pink); font-weight: 600; cursor: pointer;">Reset it here</a></p>
                </div>

                <button type="submit" class="btn-save">Update PIN</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        @if(session('message'))
            Swal.fire({ icon: 'success', title: 'Success!', text: "{{ session('message') }}", confirmButtonColor: '#0F3548' });
        @endif
        @if(session('error'))
            Swal.fire({ icon: 'error', title: 'Error', text: "{{ session('error') }}", confirmButtonColor: '#0F3548' });
        @endif

        $("#reset_pin").click(function() {
            Swal.fire({
                title: 'Reset Transaction PIN?',
                text: 'A reset token will be sent to your email address.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, Send Token',
                confirmButtonColor: '#0F3548',
                cancelButtonColor: '#EB5757'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({ title: 'Sending token...', didOpen: () => { Swal.showLoading(); } });
                    $.ajax({
                        type: 'POST',
                        url: "{{route('forgot-pin')}}",
                        data: { _token: "{{ csrf_token() }}" },
                        success: function(data) {
                            location.href = 'https://vtubiz.com/reset-pin-with-token';
                        },
                        error: function() {
                            Swal.fire('Error', 'Failed to send reset token. Please try again.', 'error');
                        }
                    });
                }
            });
        });
    });
</script>
@endsection
