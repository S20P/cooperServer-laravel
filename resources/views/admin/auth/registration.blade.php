@extends('admin.layouts.master')

@section('content')
<div class="page login-page">
  <div class="container">

    <div class="form-outer text-center  align-items-center">
      <div class="form-inner">
        <div class="logo"><strong class="text-primary">Sign</strong><span>up</span></div>
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
        <form id="login-form" class="form-horizontal" role="form" method="POST" action="{{ route('admin.register') }}">
            {{ csrf_field() }}
            <div class="form-group">
                    <input id="isAdmin" type="hidden" name="isAdmin"
                           value="true" required autofocus>
            </div>

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
            <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                <label for="phone" class="label-custom">Phone</label>
                    <input id="phone" type="number" name="phone" minlength="10"
                           value="{{ old('phone') }}" required autofocus>
                    @if ($errors->has('phone'))
                        <span class="help-block">
                        <strong>{{ $errors->first('phone') }}</strong>
                    </span>
                    @endif
            </div>

            <div class="form-group">
              <label for="region" id="sign_region_label">Region</label>
              <select name="region" id="region"  class="form-control" required>
               <option value="">Select Region</option>
               <option value="Southern Ontario">Southern Ontario</option>
               <option value="Northern Ontario">Northern Ontario</option>
               <option value="Ottawa">Ottawa</option>
               <option value="Quebec">Quebec</option>
               <option value="North Alberta">North Alberta</option>
               <option value="South Alberta">South Alberta</option>
               <option value="Trench Safety">Trench Safety</option>
              </select>
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
                        Register
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
