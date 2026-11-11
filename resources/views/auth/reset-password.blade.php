@extends('auth.layout')

@section('title', 'Reset Password')

@section('content')
  <div class="form-head">
    <h1>New <em>password</em></h1>
    <p>Choose something strong.</p>
  </div>

  @if ($errors->any())
    <div class="alert alert-danger"><i class="fa fa-circle-exclamation"></i><div>{{ $errors->first() }}</div></div>
  @endif

  <form method="POST" action="{{ route('password.update') }}" data-loading>
    @csrf
    <input type="hidden" name="token" value="{{ $request->route('token') }}">

    <div class="field @error('email') invalid @enderror">
      <input id="email" type="email" name="email" value="{{ request('email') ?? old('email') }}" placeholder=" " readonly required autocomplete="email" />
      <label for="email">Email address</label>
    </div>

    <div class="field has-toggle @error('password') invalid @enderror">
      <input id="password" type="password" name="password" placeholder=" " autocomplete="new-password" required autofocus />
      <label for="password">New password</label>
      <button type="button" class="toggle-pw" data-toggle-pw aria-label="Show password"><i class="fa fa-eye"></i></button>
    </div>

    <div class="field has-toggle">
      <input id="password-confirm" type="password" name="password_confirmation" placeholder=" " autocomplete="new-password" required />
      <label for="password-confirm">Confirm password</label>
      <span class="match" id="match_hint"></span>
      <button type="button" class="toggle-pw" data-toggle-pw aria-label="Show password"><i class="fa fa-eye"></i></button>
    </div>

    <button type="submit" class="btn btn-primary" style="margin-top: 10px">
      <span class="spinner"></span> Reset password <i class="fa fa-arrow-right btn-icon"></i>
    </button>
  </form>

  <div class="form-foot"><a href="{{ route('login') }}">Back to sign in</a></div>
@endsection

@section('scripts')
  <script>
    (function () {
      var a = document.getElementById('password');
      var b = document.getElementById('password-confirm');
      var hint = document.getElementById('match_hint');
      function check() {
        var ok = a.value === b.value;
        hint.classList.toggle('show', !!b.value);
        hint.innerHTML = ok
          ? '<i class="fa fa-circle-check" style="color:#16a34a"></i>'
          : '<i class="fa fa-circle-xmark" style="color:#dc2626"></i>';
        hint.title = ok ? 'Passwords match' : 'Passwords do not match';
      }
      a.addEventListener('input', check);
      b.addEventListener('input', check);
    })();
  </script>
@endsection
