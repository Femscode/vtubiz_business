@extends('dashboard.master1')

@php $pinOn = $user->pin_status == 1; @endphp

@section('content')
<div class="pg">
    <a href="/profile" class="pg-back"><i class="fa-solid fa-arrow-left"></i> Profile</a>
    <div class="pg-head">
        <div>
            <h1>Transaction <em>PIN</em></h1>
            <p>Your 4-digit PIN protects every purchase.</p>
        </div>
    </div>

    <div class="grid-v main-side">
        <div class="panel">
            <div class="panel-head"><h3>Change PIN</h3></div>
            <form action="{{ route('resetpin') }}" method="post">
                @csrf
                <div class="f-group">
                    <label class="f-label" for="cp_current">Current PIN</label>
                    <input id="cp_current" required type="password" inputmode="numeric" pattern="[0-9]{4}" maxlength="4" name="current_pin" class="f-input" placeholder="••••" autocomplete="off">
                </div>
                <div class="f-row">
                    <div class="f-group">
                        <label class="f-label" for="cp_new">New PIN</label>
                        <input id="cp_new" required type="password" inputmode="numeric" pattern="[0-9]{4}" maxlength="4" name="new_pin" class="f-input" placeholder="••••" autocomplete="off">
                    </div>
                    <div class="f-group">
                        <label class="f-label" for="cp_confirm">Confirm new PIN</label>
                        <input id="cp_confirm" required type="password" inputmode="numeric" pattern="[0-9]{4}" maxlength="4" name="confirm_pin" class="f-input" placeholder="••••" autocomplete="off">
                    </div>
                </div>
                <button type="submit" class="btn-v dark block">Update PIN</button>
                <p class="f-hint" style="justify-content:center;margin-top:14px">Forgot your PIN? <a id="reset_pin" style="font-weight:600;color:var(--brand-orange-2);cursor:pointer">Reset by email</a></p>
            </form>
        </div>

        <div class="panel">
            <div class="panel-head">
                <h3>PIN check</h3>
                <span class="badge-v {{ $pinOn ? 'ok' : 'fail' }}">{{ $pinOn ? 'On' : 'Off' }}</span>
            </div>
            <p style="color:var(--text-secondary);font-size:.9rem;margin:-6px 0 18px">
                {{ $pinOn ? 'Every purchase asks for your PIN.' : 'Purchases go through without asking for your PIN.' }}
            </p>
            <form action="{{ route('change_pin_status') }}" method="post">
                @csrf
                <div class="f-group">
                    <label class="f-label" for="ps_current">Current PIN</label>
                    <input id="ps_current" required type="password" inputmode="numeric" maxlength="4" name="current_pin" class="f-input" placeholder="••••" autocomplete="off">
                </div>
                <button type="submit" class="btn-v {{ $pinOn ? 'danger' : 'dark' }} block">{{ $pinOn ? 'Turn off PIN check' : 'Turn on PIN check' }}</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        $("#reset_pin").click(function() {
            Swal.fire({
                title: 'Reset your PIN?',
                text: 'We will email you a reset token.',
                showCancelButton: true,
                confirmButtonText: 'Send token',
                confirmButtonColor: '#001f3f'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({ title: 'Sending token...', didOpen: () => { Swal.showLoading(); } });
                    $.ajax({
                        type: 'POST',
                        url: "{{ route('forgot-pin') }}",
                        data: { _token: "{{ csrf_token() }}" },
                        success: function() {
                            location.href = '/reset-pin-with-token';
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
