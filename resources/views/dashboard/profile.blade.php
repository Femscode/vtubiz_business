@extends('dashboard.master1')

@section('header')
<style>
    .profile-header {
        margin-bottom: var(--space-lg);
    }
    .profile-header h1 {
        font-family: 'Fraunces', serif;
        font-size: 2.2rem;
        color: var(--primary-dark);
        margin-bottom: 8px;
    }
    .profile-grid {
        display: grid;
        grid-template-columns: 1fr 2fr;
        gap: var(--space-lg);
    }
    .profile-card {
        background: var(--surface);
        border-radius: var(--radius-lg);
        padding: var(--space-lg);
        box-shadow: var(--shadow-card);
    }
    .avatar-upload {
        position: relative;
        max-width: 120px;
        margin: 0 auto 20px;
    }
    .avatar-preview {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        background-color: var(--accent-yellow);
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'Fraunces', serif;
        font-size: 3rem;
        color: var(--primary-dark);
        font-weight: 700;
        overflow: hidden;
        border: 4px solid var(--surface);
        box-shadow: var(--shadow-sm);
    }
    .avatar-preview img {
        width: 100%;
        height: 100%;
        object-fit: cover;
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
    .form-control-custom:disabled {
        background: #F0F0F0;
        cursor: not-allowed;
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
    
    .stats-card {
        background: #FDFCF8;
        border: 1px solid rgba(0,0,0,0.03);
        border-radius: var(--radius-md);
        padding: 20px;
        text-align: center;
    }
    .stats-value {
        font-family: 'Fraunces', serif;
        font-size: 1.5rem;
        color: var(--primary-dark);
        font-weight: 600;
        margin-bottom: 4px;
    }
    .stats-label {
        font-size: 0.8rem;
        color: var(--text-secondary);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .action-buttons {
        display: flex;
        gap: 12px;
        margin-top: 20px;
    }
    .btn-action {
        flex: 1;
        padding: 12px;
        border-radius: var(--radius-md);
        text-decoration: none;
        text-align: center;
        font-size: 0.85rem;
        font-weight: 600;
        transition: all 0.2s;
    }
    .btn-secondary-custom {
        background: #F0F0F0;
        color: var(--text-main);
    }
    .btn-primary-custom {
        background: rgba(47, 128, 237, 0.1);
        color: var(--accent-blue);
    }
    .btn-danger-custom {
        background: rgba(235, 87, 87, 0.1);
        color: var(--accent-pink);
    }

    @media (max-width: 991px) {
        .profile-grid { grid-template-columns: 1fr; }
    }
</style>
@endsection

@section('content')
<div class="profile-header">
    <h1>Profile Settings</h1>
    <p class="text-muted">Manage your account information and security.</p>
</div>

<div class="profile-grid">
    <!-- Left Col: Avatar & Stats -->
    <div class="left-col">
        <div class="profile-card">
            <div class="avatar-upload">
                <div class="avatar-preview">
                    @if($user->image)
                        <img src="{{ asset('profile_picture/' . $user->image) }}" alt="Avatar">
                    @else
                        {{ substr($user->name, 0, 1) }}{{ substr(explode(' ', $user->name)[1] ?? '', 0, 1) }}
                    @endif
                </div>
            </div>
            
            <div style="text-align: center; margin-bottom: 30px;">
                <h3 class="serif" style="color: var(--primary-dark);">{{ $user->name }}</h3>
                <p class="text-muted text-sm">{{ $user->email }}</p>
                <div style="margin-top: 10px;">
                    <span class="badge" style="background: rgba(39, 174, 96, 0.1); color: var(--accent-green); padding: 6px 12px; border-radius: 20px; font-size: 0.75rem; font-weight: 600;">
                        {{ ucfirst($user->user_type) }} Account
                    </span>
                </div>
            </div>

            <div class="row g-3">
                <div class="col-6">
                    <div class="stats-card">
                        <div class="stats-value">₦{{ number_format($user->balance) }}</div>
                        <div class="stats-label">Balance</div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="stats-card">
                        <div class="stats-value">₦{{ number_format($user->total_spent) }}</div>
                        <div class="stats-label">Spent</div>
                    </div>
                </div>
            </div>

            <div class="action-buttons">
                <a href="/change-pin" class="btn-action btn-secondary-custom">Change Pin</a>
                <a href="/change-password" class="btn-action btn-primary-custom">Password</a>
            </div>
            
            <div style="margin-top: 15px;">
                <button type="button" class="btn-action btn-danger-custom w-100 border-0" style="cursor: pointer;">Deactivate Account</button>
            </div>
        </div>
    </div>

    <!-- Right Col: Form -->
    <div class="right-col">
        <div class="profile-card">
            <h4 class="serif mb-4" style="color: var(--primary-dark);">Personal Information</h4>
            
            <form action='{{ route("updateprofile") }}' method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row g-4">
                    <div class="col-md-12">
                        <label class="form-label">Full Name</label>
                        <input type="text" name="name" class="form-control-custom" value="{{ $user->name }}">
                    </div>
                    
                    <div class="col-md-6">
                        <label class="form-label">Email Address</label>
                        <input type="email" class="form-control-custom" value="{{ $user->email }}" disabled>
                    </div>
                    
                    <div class="col-md-6">
                        <label class="form-label">Phone Number</label>
                        <input type="text" name="phone" class="form-control-custom" value="{{ $user->phone }}">
                    </div>

                    <div class="col-md-12">
                        <label class="form-label">Profile Picture</label>
                        <input type="file" name="image" class="form-control-custom">
                        <p class="text-xs text-muted mt-2">Recommended: Square image, max 2MB.</p>
                    </div>

                    <div class="col-md-12">
                        <label class="form-label">BVN (Bank Verification Number)</label>
                        <div style="position: relative;">
                            <input type="text" class="form-control-custom" value="{{ $user->bvn ? '**********' : 'Not Provided' }}" disabled>
                            <i class="fa fa-lock" style="position: absolute; right: 15px; top: 15px; color: var(--text-light);"></i>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn-save">Save Changes</button>
            </form>
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
