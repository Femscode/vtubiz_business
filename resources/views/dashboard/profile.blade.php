@extends('dashboard.master1')

@php
    $parts = explode(' ', trim($user->name));
    $initials = strtoupper(substr($parts[0] ?? '', 0, 1) . substr($parts[1] ?? '', 0, 1));
@endphp

@section('header')
<style>
    .id-card {
        text-align: center;
    }

    .id-avatar {
        width: 96px;
        height: 96px;
        border-radius: 50%;
        margin: 4px auto 14px;
        background: linear-gradient(135deg, #FFB45E, var(--brand-orange-2));
        color: #fff;
        font-family: 'Fraunces', serif;
        font-size: 2rem;
        display: grid;
        place-items: center;
        overflow: hidden;
        box-shadow: 0 0 0 6px #fff, 0 0 0 7px var(--line);
    }

    .id-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .id-card h3 {
        font-family: 'Fraunces', serif;
        font-weight: 500;
        font-size: 1.35rem;
        color: var(--ink);
        margin: 0 0 4px;
        word-break: break-word;
    }

    .id-card .email {
        color: var(--text-secondary);
        font-size: .88rem;
        word-break: break-all;
    }

    .id-stats {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px;
        margin-top: 20px;
        text-align: left;
    }

    .id-stats div {
        background: #FAFAF8;
        border-radius: 14px;
        padding: 12px 14px;
    }

    .id-stats small {
        display: block;
        font-size: .74rem;
        color: var(--text-secondary);
        font-weight: 600;
    }

    .id-stats b {
        font-family: 'Fraunces', serif;
        font-weight: 500;
        font-size: 1.2rem;
        color: var(--ink);
    }

    .sec-link {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 14px 0;
        border-bottom: 1px solid var(--line);
        text-decoration: none;
        color: var(--ink);
    }

    .sec-link:last-child {
        border-bottom: 0;
        padding-bottom: 0;
    }

    .sec-link:hover {
        color: var(--ink);
    }

    .sec-link .ic {
        width: 40px;
        height: 40px;
        border-radius: 12px;
        display: grid;
        place-items: center;
        flex-shrink: 0;
    }

    .sec-link b {
        display: block;
        font-weight: 600;
        font-size: .92rem;
    }

    .sec-link small {
        color: var(--text-secondary);
        font-size: .8rem;
    }

    .sec-link .chev {
        margin-left: auto;
        color: var(--text-light);
        font-size: .8rem;
        transition: transform .15s;
    }

    .sec-link:hover .chev {
        transform: translateX(3px);
    }

    .lock-field {
        position: relative;
    }

    .lock-field i {
        position: absolute;
        right: 16px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-light);
    }
</style>
@endsection

@section('content')
<div class="pg">
    <div class="pg-head">
        <div>
            <h1>Your <em>profile</em></h1>
            <p>Manage your details and security.</p>
        </div>
    </div>

    <div class="grid-v side-main">
        <div>
            <div class="panel id-card">
                <div class="id-avatar">
                    @if($user->image)
                        <img src="{{ asset('profile_picture/' . $user->image) }}" alt="{{ $user->name }}">
                    @else
                        {{ $initials }}
                    @endif
                </div>
                <h3>{{ $user->name }}</h3>
                <div class="email">{{ $user->email }}</div>
                <div style="margin-top:10px"><span class="badge-v ok">{{ ucfirst($user->user_type) }} account</span></div>

                <div class="id-stats">
                    <div><small>Balance</small><b>₦{{ number_format((float) $user->balance) }}</b></div>
                    <div><small>Total spent</small><b>₦{{ number_format((float) $user->total_spent) }}</b></div>
                </div>
            </div>

            <div class="panel" style="margin-top:20px">
                <div class="panel-head" style="margin-bottom:4px"><h3>Security</h3></div>
                <a href="/change-pin" class="sec-link">
                    <span class="ic t-amber"><i class="fa-solid fa-key"></i></span>
                    <span><b>Transaction PIN</b><small>Change the PIN you use to pay</small></span>
                    <i class="fa-solid fa-chevron-right chev"></i>
                </a>
                <a href="/change-password" class="sec-link">
                    <span class="ic t-blue"><i class="fa-solid fa-lock"></i></span>
                    <span><b>Password</b><small>Update your login password</small></span>
                    <i class="fa-solid fa-chevron-right chev"></i>
                </a>
            </div>
        </div>

        <div class="panel">
            <div class="panel-head">
                <div>
                    <h3>Personal information</h3>
                    <p>Keep your details up to date.</p>
                </div>
            </div>

            <form action="{{ route('updateprofile') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="f-group">
                    <label class="f-label" for="p_name">Full name</label>
                    <input type="text" id="p_name" name="name" class="f-input" value="{{ $user->name }}">
                </div>
                <div class="f-row">
                    <div class="f-group">
                        <label class="f-label" for="p_email">Email</label>
                        <div class="lock-field">
                            <input type="email" id="p_email" class="f-input" value="{{ $user->email }}" disabled>
                            <i class="fa-solid fa-lock"></i>
                        </div>
                    </div>
                    <div class="f-group">
                        <label class="f-label" for="p_phone">Phone number</label>
                        <input type="tel" id="p_phone" name="phone" class="f-input" value="{{ $user->phone }}">
                    </div>
                </div>
                <div class="f-group">
                    <label class="f-label" for="p_image">Profile picture</label>
                    <input type="file" id="p_image" name="image" accept="image/*" class="f-input">
                    <div class="f-hint">Square image, up to 2MB.</div>
                </div>
                <div class="f-group">
                    <label class="f-label">BVN</label>
                    <div class="lock-field">
                        <input type="text" class="f-input" value="{{ $user->bvn ? '•••••••••••' : 'Not provided' }}" disabled>
                        <i class="fa-solid fa-lock"></i>
                    </div>
                </div>

                <button type="submit" class="btn-v dark block">Save changes</button>
            </form>
        </div>
    </div>
</div>
@endsection
