@extends('auth.layout')

@section('title', 'Forgot Password')

{{-- This page never loaded the key-blocking script; keep it that way. --}}
@section('no_locker', '1')

@section('content')
  <div class="form-head">
    <h1>Forgot <em>password?</em></h1>
    <p>We'll email you a reset link.</p>
  </div>

  @if (session('status'))
    <div class="alert alert-success"><i class="fa fa-circle-check"></i><div>{{ session('status') }}</div></div>
  @endif

  @if ($errors->any())
    <div class="alert alert-danger"><i class="fa fa-circle-exclamation"></i><div>{{ $errors->first() }}</div></div>
  @endif

  <form action="{{ route('password.email') }}" method="post" data-loading>
    @csrf

    <div class="field">
      <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder=" " autocomplete="email" required autofocus />
      <label for="email">Email address</label>
    </div>

    <button type="submit" class="btn btn-primary" style="margin-top: 10px">
      <span class="spinner"></span> Send reset link <i class="fa fa-arrow-right btn-icon"></i>
    </button>
  </form>

  <div class="form-foot"><a href="{{ route('login') }}">Back to sign in</a></div>
@endsection
