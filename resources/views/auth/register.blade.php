@extends('auth.layout')

@section('title', 'Registration')

@section('content')
  <div class="form-head">
    <h1>Create your <em>account</em></h1>
    <p>It takes less than a minute.</p>
  </div>

  @if ($errors->any())
    <div class="alert alert-danger">
      <i class="fa fa-circle-exclamation"></i>
      <div>
        @if ($errors->count() === 1)
          {{ $errors->first() }}
        @else
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        @endif
      </div>
    </div>
  @endif

  <form method="post" action="{{ route('register') }}" data-loading>
    @csrf

    <div class="grid-2">
      <div class="field @error('name') invalid @enderror">
        <input id="user_name" type="text" name="name" value="{{ old('name') }}" placeholder=" " autocomplete="name" required />
        <label for="user_name">Full name</label>
      </div>
      <div class="field @error('brand_name') invalid @enderror">
        <input id="company_id" type="text" name="brand_name" value="{{ old('brand_name') }}" placeholder=" " autocomplete="username" required />
        <label for="company_id">Username</label>
      </div>
    </div>

    <div class="field @error('email') invalid @enderror">
      <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder=" " autocomplete="email" required />
      <label for="email">Email address</label>
    </div>

    <div class="field @error('phone') invalid @enderror">
      <input id="user_phone" type="tel" inputmode="numeric" pattern="[0-9]*" name="phone" value="{{ old('phone') }}" placeholder=" " autocomplete="tel" required />
      <label for="user_phone">Phone number</label>
    </div>

    @if ($referralId)
      <div class="field">
        <input id="referred_by" type="text" name="referred_by" value="{{ $referralId }}" placeholder=" " readonly />
        <label for="referred_by">Referred by</label>
      </div>
    @endif

    <div class="field has-toggle @error('password') invalid @enderror">
      <input id="password" type="password" name="password" placeholder=" " autocomplete="new-password" required />
      <label for="password">Password</label>
      <button type="button" class="toggle-pw" data-toggle-pw aria-label="Show password"><i class="fa fa-eye"></i></button>
    </div>
    <div class="strength" id="strength" aria-hidden="true"><span></span><span></span><span></span><span></span></div>

    <div class="field has-toggle">
      <input id="password_confirmation" type="password" name="password_confirmation" placeholder=" " autocomplete="new-password" required />
      <label for="password_confirmation">Confirm password</label>
      <span class="match" id="match_alert"></span>
      <button type="button" class="toggle-pw" data-toggle-pw aria-label="Show password"><i class="fa fa-eye"></i></button>
    </div>

    <button type="submit" id="sign_up" class="btn btn-primary" style="margin-top: 10px" disabled>
      <span class="spinner"></span> Create account <i class="fa fa-arrow-right btn-icon"></i>
    </button>

    <p class="fine">By signing up you accept our <a href="/terms-of-service">Terms</a>.</p>
  </form>

  <div class="form-foot">Have an account? <a href="/login">Sign in</a></div>
@endsection

@section('scripts')
  <script>
    (function () {
      var pw = document.getElementById('password');
      var cf = document.getElementById('password_confirmation');
      var btn = document.getElementById('sign_up');
      var match = document.getElementById('match_alert');
      var bars = document.querySelectorAll('#strength span');
      var colors = ['#ef4444', '#f59e0b', '#84cc16', '#16a34a'];

      function score(v) {
        var s = v.length >= 5 ? 1 : 0;
        if (v.length >= 8) s++;
        if (/[A-Z]/.test(v) && /[a-z]/.test(v)) s++;
        if (/\d/.test(v) || /[^A-Za-z0-9]/.test(v)) s++;
        return Math.min(s, 4);
      }

      function update() {
        var a = pw.value, b = cf.value;
        var s = a ? Math.max(score(a), 1) : 0;
        bars.forEach(function (bar, i) { bar.style.background = i < s ? colors[s - 1] : ''; });

        match.classList.toggle('show', !!b);
        match.innerHTML = a === b
          ? '<i class="fa fa-circle-check" style="color:#16a34a"></i>'
          : '<i class="fa fa-circle-xmark" style="color:#dc2626"></i>';
        match.title = a === b ? 'Passwords match' : 'Passwords do not match';

        btn.disabled = !(a.length >= 5 && a === b);
      }

      pw.addEventListener('input', update);
      cf.addEventListener('input', update);
      update();
    })();
  </script>
@endsection
