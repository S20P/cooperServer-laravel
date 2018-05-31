@extends('admin.layouts.app')

@section('content')
<div class="breadcrumb-holder">
  <div class="container-fluid">
    <ul class="breadcrumb">
      <li>
       <!-- <a href="{{ URL::previous() }}" class="btn btn-default">Back</a> -->
       <a href="javascript:history.back()" class="btn btn-default"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
      </li>

      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
      <li class="breadcrumb-item active">Change Password</li>
    </ul>
  </div>
</div>
<section class="dashboard-counts section-padding">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">

        <div class="card">
          <div class="card-header d-flex align-items-center">
                  <h2 class="h5 display"> Change Password </h2>
          </div>
          <div class="card-block">
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
            <form id="eventForm" class="form" role="form" method="POST" action="{{ route('admin.changePassword') }}">
              {{ csrf_field() }}
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group{{ $errors->has('current-password') ? ' has-error' : '' }}">
                     <label for="new-password" class="control-label">Current Password</label>
                     <input id="current-password" type="password" class="form-control" name="current-password" required>
                         @if ($errors->has('current-password'))
                             <span class="help-block">
                                 <strong>{{ $errors->first('current-password') }}</strong>
                             </span>
                         @endif
                </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group{{ $errors->has('new-password') ? ' has-error' : '' }}">
                    <label for="new-password" class="control-label">New Password</label>
                    <input id="new-password" type="password" class="form-control" name="new-password" required>
                            @if ($errors->has('new-password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('new-password') }}</strong>
                                </span>
                            @endif
                     </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Confirm New Password</label>
                   <input id="new-password-confirm" type="password" class="form-control" name="new-password_confirmation" required>
                 </div>
                </div>
              </div>
                <div class="form-group">
                <button type="submit" class="btn btn-primary btn-theme">
                     Change Password
                </button>
              </div>
            </form>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
