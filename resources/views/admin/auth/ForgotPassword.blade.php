@extends('admin.layouts.master')

@section('content')
<div class="page login-page">
  <div class="container">

    <div class="form-outer text-center  align-items-center">
      <div class="form-inner">
        <div class="logo"><strong class="text-primary">Forgot</strong><span>Password</span></div>
        <!-- @if (session('status'))
        <div class="alert alert-danger">
            {{ session('status') }}
        </div>
        @endif -->
        @if (session('error'))
                              <div class="alert alert-danger">
                                  {{ session('error') }}
                              </div>
                          @endif
                              @if (session('success'))
                                  <div class="alert alert-success">
                                      {{ session('success') }}
                                  </div>
                              @endif
        <form id="login-form" class="form-horizontal" role="form" method="POST" action="{{ route('admin.ForgotPassword') }}">
            {{ csrf_field() }}
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email" class="label-custom">E-Mail Address</label>
                    <input id="email" type="email" name="email"
                           value="{{ old('email') }}" required autofocus>
                    @if ($errors->has('email'))
                        <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif
            </div>

            <div class="form-group">
                    <button type="submit" id="Admin_Signin123" class="btn btn-primary btn-theme">
                        Submit
                    </button>
            </div>
        </form>
        <!-- <a href="{{ route('password.request') }}" class="forgot-pass">Forgot Password?</a> -->
      <a href="{{ route('admin.loginform') }}" class="forgot-pass">Login</a><small>Do not have an account? </small><a href="{{ route('admin.register') }}" class="signup">Signup</a>
      </div>
    </div>
  </div>
</div>
@endsection
