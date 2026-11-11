@extends('dashboard.master1')

@section('content')
<div class="pg pg-narrow" style="max-width:560px">
    <a href="/change-pin" class="pg-back"><i class="fa-solid fa-arrow-left"></i> Transaction PIN</a>
    <div class="pg-head">
        <div>
            <h1>Reset <em>PIN</em></h1>
            <p>Enter the token we emailed you and choose a new PIN.</p>
        </div>
    </div>

    <div class="panel">
        <form action="{{ route('reset-forgot-pin') }}" method="post">
            @csrf
            <div class="f-group">
                <label class="f-label" for="rp_token">Reset token</label>
                <input id="rp_token" maxlength="7" required type="password" name="token" class="f-input" placeholder="From your email" autocomplete="one-time-code">
                <div class="f-hint"><i class="fa-regular fa-envelope"></i> Check your inbox and spam folder.</div>
            </div>
            <div class="f-row">
                <div class="f-group">
                    <label class="f-label" for="new_password">New PIN</label>
                    <input required type="password" inputmode="numeric" pattern="[0-9]{4}" maxlength="4" name="new_pin" id="new_password" class="f-input" placeholder="••••" autocomplete="off">
                </div>
                <div class="f-group">
                    <label class="f-label" for="confirm_pin">Confirm new PIN</label>
                    <input required type="password" inputmode="numeric" pattern="[0-9]{4}" maxlength="4" name="confirm_pin" id="confirm_pin" class="f-input" placeholder="••••" autocomplete="off">
                </div>
            </div>
            <button id="sub_btn" type="submit" class="btn-v dark block">Reset PIN</button>
        </form>
    </div>
</div>
@endsection
