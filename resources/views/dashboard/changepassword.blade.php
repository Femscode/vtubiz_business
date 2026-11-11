@extends('dashboard.master1')

@section('content')
<div class="pg">
    <a href="/profile" class="pg-back"><i class="fa-solid fa-arrow-left"></i> Profile</a>
    <div class="pg-head">
        <div>
            <h1>Change <em>password</em></h1>
            <p>Use a strong password you don't use anywhere else.</p>
        </div>
    </div>

    <div class="grid-v main-side">
        <div class="panel">
            <form action="/resetpassword" method="post">
                @csrf
                <div class="f-group">
                    <label class="f-label" for="current_password">Current password</label>
                    <input id="current_password" required type="password" name="current_password" class="f-input" autocomplete="current-password">
                </div>
                <div class="f-row">
                    <div class="f-group">
                        <label class="f-label" for="new_password">New password</label>
                        <input id="new_password" required type="password" minlength="8" name="new_password" class="f-input" autocomplete="new-password">
                    </div>
                    <div class="f-group">
                        <label class="f-label" for="confirm_password">Confirm new password</label>
                        <input id="confirm_password" required type="password" minlength="8" name="confirm_password" class="f-input" autocomplete="new-password">
                    </div>
                </div>
                <div class="f-hint" id="pw_hint" style="margin:-6px 0 18px">At least 8 characters.</div>
                <button type="submit" class="btn-v dark block">Update password</button>
                <p class="f-hint" style="justify-content:center;margin-top:14px">Forgot it? <a href="/forgot-password" style="font-weight:600;color:var(--brand-orange-2)">Reset by email</a></p>
            </form>
        </div>

        <div class="panel">
            <div class="panel-head"><h3><span class="ic t-green" style="width:36px;height:36px;border-radius:12px;display:grid;place-items:center;font-size:.9rem"><i class="fa-solid fa-shield-halved"></i></span> Stay secure</h3></div>
            <div class="list-v">
                <div class="item" style="padding-top:0"><i class="fa-solid fa-check" style="color:var(--accent-green)"></i><span>Mix letters, numbers and symbols.</span></div>
                <div class="item"><i class="fa-solid fa-check" style="color:var(--accent-green)"></i><span>Never share your password or PIN.</span></div>
                <div class="item"><i class="fa-solid fa-check" style="color:var(--accent-green)"></i><span>VTUBIZ staff will never ask for them.</span></div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    (function () {
        var a = document.getElementById('new_password');
        var b = document.getElementById('confirm_password');
        var hint = document.getElementById('pw_hint');
        function check() {
            if (!b.value) { hint.className = 'f-hint'; hint.textContent = 'At least 8 characters.'; return; }
            var ok = a.value === b.value;
            hint.className = 'f-hint';
            hint.style.color = ok ? 'var(--accent-green)' : '#B91C1C';
            hint.innerHTML = ok ? '<i class="fa-solid fa-circle-check"></i> Passwords match' : '<i class="fa-solid fa-circle-xmark"></i> Passwords don\'t match';
        }
        a.addEventListener('input', check);
        b.addEventListener('input', check);
    })();
</script>
@endsection
