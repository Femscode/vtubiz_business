@extends('auth.layout')

@section('title', 'Login')

@section('content')
  <div class="form-head">
    <h1>Welcome <em>back</em></h1>
    <p>Sign in to continue.</p>
  </div>

  @if (session('status'))
    <div class="alert alert-success"><i class="fa fa-circle-check"></i><div>{{ session('status') }}</div></div>
  @endif

  @if ($errors->any())
    <div class="alert alert-danger"><i class="fa fa-circle-exclamation"></i><div>{{ $errors->first() }}</div></div>
  @endif

  <form method="post" action="{{ route('login') }}" data-loading>
    @csrf

    <div class="field">
      <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder=" " autocomplete="email" required autofocus />
      <label for="email">Email address</label>
    </div>

    <div class="field has-toggle">
      <input id="password" type="password" name="password" placeholder=" " autocomplete="current-password" required />
      <label for="password">Password</label>
      <button type="button" class="toggle-pw" data-toggle-pw aria-label="Show password"><i class="fa fa-eye"></i></button>
    </div>

    <div class="meta">
      <label class="check"><input type="checkbox" name="remember" value="1" {{ old('remember') ? 'checked' : '' }}> Remember me</label>
      <a href="/forgot-password">Forgot password?</a>
    </div>

    <button type="submit" class="btn btn-primary">
      <span class="spinner"></span> Sign in <i class="fa fa-arrow-right btn-icon"></i>
    </button>
  </form>

  <div class="form-foot">New here? <a href="/register">Create an account</a></div>
@endsection
