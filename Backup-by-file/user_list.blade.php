@extends('admin.layouts.app')

@section('content')

<div class="breadcrumb-holder">
  <div class="container-fluid">
    <ul class="breadcrumb">
      <li>
        <!-- <a href="{{ URL::previous() }}" class="btn btn-default">Back</a> -->
        <a href="javascript:history.back()" class="btn btn-default"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
      </li>
      <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item active">user</li>
    </ul>
  </div>
</div>
<section class="dashboard-counts section-padding">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">

        <div class="card">
          <div class="card-header d-flex align-items-center">
                  <h2 class="h5 display">All user list</h2>
            </div>
          <div class="card-block">
            <div class="table-responsive">
            <table class="table pagination_table" id="userlist_table">
              <thead>
                <tr>
                  <th>#_id</th>
                  <th>email</th>
                  <th>phone</th>
                  <th>region</th>
                  <th>status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
               <?php $number = 1;?>
                @foreach($user_data  as $user_item)
                <tr>
                  <th scope="row">{{$number}}</th>
                  <td>{{$user_item->email}}</td>
                  <td>{{$user_item->phone}}</td>
                  <td>{{$user_item->region}}</td>
                  <td>{{$user_item->status}}</td>
                  <td>
                    <form  class="form-inline" role="form" method="POST" action="{{ route('admin.profile_approval_api') }}">
                      {{ csrf_field() }}
                      <div class="form-group">
                        <input id="inlineFormInput" type="hidden" id="email" name="email" placeholder="E-mail" value="{{$user_item->email}}" class="mx-sm-3 form-control">
                      </div>
                      @if($user_item->status==="approved")
                      <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-theme">
                            Approved
                        </button>
                      </div>
                      @else
                      <div class="form-group">
                        <button type="submit" class="btn btn-info btn-theme">
                            Approve
                        </button>
                      </div>
                        @endif
                    </form>
                  </td>
                </tr>
                <?php  $number++;?>
                @endforeach
              </tbody>
            </table>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</section>

@endsection
