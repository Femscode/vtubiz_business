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
    
    .social-card {
        background: linear-gradient(135deg, var(--primary-dark) 0%, #1a4d66 100%);
        color: white;
        border-radius: var(--radius-lg);
        padding: var(--space-lg);
        text-align: center;
    }
    .social-icons {
        display: flex;
        justify-content: center;
        gap: 15px;
        margin-top: 20px;
    }
    .social-btn {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        text-decoration: none;
        transition: transform 0.2s;
        background: rgba(255,255,255,0.1);
    }
    .social-btn:hover { transform: translateY(-3px); background: rgba(255,255,255,0.2); }
</style>
@endsection

@section('content')
<div class="security-header">
    <h1>Security Settings</h1>
    <p class="text-muted">Update your password and keep your account secure.</p>
</div>

<div class="row g-5">
    <div class="col-lg-8">
        <div class="security-card">
            <h4 class="serif mb-4" style="color: var(--primary-dark);">Change Password</h4>
            
            <form action='/resetpassword' method='post'> @csrf
                <div class="row g-4">
                    <div class="col-12">
                        <label class="form-label">Current Password</label>
                        <input placeholder="**********" required type="password" name='current_password' class="form-control-custom">
                    </div>
                    
                    <div class="col-md-6">
                        <label class="form-label">New Password</label>
                        <input required type="password" minlength='8' name='new_password' class="form-control-custom" placeholder="**********">
                    </div>
                    
                    <div class="col-md-6">
                        <label class="form-label">Confirm New Password</label>
                        <input required type="password" minlength='8' name='confirm_password' class="form-control-custom" placeholder="**********">
                    </div>
                </div>

                <div class="mt-4">
                    <p class="text-sm">Forgot your password? <a href='/forgot-password' style="color: var(--accent-pink); font-weight: 600;">Reset it here</a></p>
                </div>

                <button type="submit" class="btn-save">Update Password</button>
            </form>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="social-card">
            <h3 class="serif mb-3">Join our Community</h3>
            <p class="text-sm" style="opacity: 0.8;">Follow us on social media for the latest updates and offers.</p>
            
            <div class="social-icons">
                <a href="#!" class="social-btn"><i class="fab fa-facebook-f"></i></a>
                <a href="#!" class="social-btn"><i class="fab fa-twitter"></i></a>
                <a href="#!" class="social-btn"><i class="fab fa-instagram"></i></a>
                <a href="#!" class="social-btn" style="background: #25d366;"><i class="fab fa-whatsapp"></i></a>
            </div>
        </div>

        <div class="security-card mt-4" style="text-align: center;">
            <div style="font-size: 2rem; color: var(--accent-yellow); margin-bottom: 15px;">
                <i class="fa-solid fa-shield-halved"></i>
            </div>
            <h5 class="serif" style="color: var(--primary-dark);">Account Protection</h5>
            <p class="text-xs text-muted">We use industry-standard encryption to protect your sensitive data.</p>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        @if (session('message'))
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: "{{ session('message') }}",
                confirmButtonColor: '#0F3548'
            });
        @endif
        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: "{{ session('error') }}",
                confirmButtonColor: '#0F3548'
            });
        @endif
    });
</script>
@endsection
