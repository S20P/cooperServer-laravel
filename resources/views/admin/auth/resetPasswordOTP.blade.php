@extends('admin.layouts.master')

@section('content')
<div class="page login-page">
  <div class="container">

    <div class="form-outer text-center  align-items-center">
      <div class="form-inner">
        <div class="logo"><strong class="text-primary">OTP</strong><span></span></div>
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
        <form id="login-form" class="form-horizontal" role="form" method="POST" action="{{ route('admin.resetPasswordOTP') }}">
            {{ csrf_field() }}
              <div class="form-group{{ $errors->has('otp') ? ' has-error' : '' }}">
                <label for="otp" class="label-custom">Otp</label>
                    <input id="otp" type="text" name="otp"
                           value="{{ old('otp') }}" required autofocus>
                    @if ($errors->has('otp'))
                        <span class="help-block">
                        <strong>{{ $errors->first('otp') }}</strong>
                    </span>
                    @endif
            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password" class="label-custom">New Password</label>
                    <input id="password" type="password" name="password" required>
                    @if ($errors->has('password'))
                        <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                    @endif
            </div>
            <div class="form-group{{ $errors->has('confirm_password') ? ' has-error' : '' }}">
                <label for="confirm_password" class="label-custom">Confirm Password</label>
                    <input id="confirm_password" type="password" name="confirm_password" required>
                    @if ($errors->has('confirm_password'))
                        <span class="help-block">
                        <strong>{{ $errors->first('confirm_password') }}</strong>
                    </span>
                    @endif
            </div>

            <div class="form-group">
                    <button type="submit" id="Admin_Signin123" class="btn btn-primary btn-theme">
                        submit
                    </button>
            </div>
        </form>
        <!-- <a href="{{ route('password.request') }}" class="forgot-pass">Forgot Password?</a> -->
      <small>Already have an account? </small><a href="{{ route('admin.loginform') }}" class="signup">Login</a>
      </div>

    </div>
  </div>
</div>
@endsection
