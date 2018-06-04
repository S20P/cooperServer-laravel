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
      <li class="breadcrumb-item active">Cron email user</li>
    </ul>
  </div>
</div>
<section class="dashboard-counts section-padding">
  <div class="container-fluid">
<div class="row">
      <div class="col-md-12">
      <input type="hidden" name="token" id="token" value="{{ Session::get('token')}}">
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
        <div class="card">
          <!-- <div class="card-header d-flex align-items-center">
                  <h2 class="h5 display">Email Records</h2>
            </div> -->
            <div class="card-header d-flex align-items-center">
                  <div class="pull-lef col-sm-6 col-xs-6 col-md-6">
                        <h2 class="h5 display mtm">Cron Email User Records</h2>
                  </div>
                  <div class="pull-right  col-sm-6 col-xs-6 col-md-6 mtm">
                  <button class="btn btn-primary btn-theme pull-right" data-toggle="modal" data-target="#confirm-add" onclick="confirm_add()">
                  <i class="fa fa-plus" aria-hidden="true"></i>      Add User
                  </button>
                  </div>
            </div>





          <div class="card-block">
            <div class="table-responsive">
                   <table class="table pagination_table table_hover_tr" id="userlist_table">
              <thead>
                <tr>
                  <th>#_Id</th>
                  <th>FirstName</th>
                  <th>Last Name</th>
                  <th>Email</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
               <?php $number = 1;?>

            <?php //print_r(count($email_data));
           //  die();
             ?>

              @if(isset($email_data))
              @if(count($email_data)<=0)
            <tr>
              <th scope="row">No Users Found</th>
           </tr>
            @else
           @foreach($email_data  as $email_item)
             <tr id="{{$number}}">
               <th scope="row">{{$number}}</th>
               <td>
               @if(isset($email_item->firstname))
               <span id="{{$email_item->_id}}_1">
                 {{$email_item->firstname}}
               </span>
               @endif
               </td>
               <td>
               @if(isset($email_item->lastname))
                <span id="{{$email_item->_id}}_2">
                  {{$email_item->lastname}}
               </span>
               @endif
               </td>

               <td>
               @if(isset($email_item->email))
               <span id="{{$email_item->_id}}_3">
                  {{$email_item->email}}
               </span>
               @endif
               </td>

               <td>
               <button class="btn btn-success btn-theme" data-toggle="modal"  onclick="confirm_edit('{{json_encode($email_item)}}')">
               <i class="fa fa-pencil" aria-hidden="true"></i>  Edit
               </button>
               <button class="btn btn-danger btn-theme" data-toggle="modal" data-target="#confirm-delete{{$number}}">
                   <i class="fa fa-trash-o" aria-hidden="true"></i>   Delete
              </button>
               <!-- confirm-delete model -->
               <div class="modal fade" id="confirm-delete{{$number}}" tabindex="-3" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                              <div class="modal-dialog">
                              <div class="modal-content">
                                  <div class="modal-header">
                                      Confirm Delete
                                  </div>
                                  <div class="modal-body">
                                   Are you sure you want to delete this user ?
                                  </div>
                                  <div class="modal-footer">
                                      <form  class="form-inline" role="form" method="POST" action="{{ route('admin.delete_settingEmail') }}">
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                          <input id="inlineFormInput" type="hidden" id="_id" name="_id"  value="{{$email_item->_id}}" class="mx-sm-3 form-control">
                                        </div>
                                      <div class="form-group">
                                        <button type="submit" class="btn btn-danger btn-theme btn-ok">
                                            Delete
                                        </button>
                                          <button type="button" class="btn btn-default btn-theme" data-dismiss="modal">Cancel</button>
                                      </div>
                                      </form>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <!-- end Model -->


               </td>
            </tr>
            <?php $number++;?>
            @endforeach
             @endif
             @endif

       <!-- confirm-edit model -->
<div class="modal fade" id="confirm-edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                              <div class="modal-dialog">
                              <div class="modal-content">
                                  <div class="modal-header">
                                     Edit  User
                                  </div>
                                  <div class="modal-body">
                                  <form id="updateemailform" class="form" role="form" method="POST" action="{{ route('admin.add_settingEmail') }}">
                                           <!-- {{ csrf_field() }} -->
                                           <input type="hidden" name="token" id="token" value="{{ Session::get('token')}}">
                                           <input  type="hidden" id="_id" name="_id"  class="mx-sm-3 form-control">
                                           <div class="row">
                                           <div class="col-md-2"></div>
                                             <div class="col-md-8">
                                             <div class="form-group">
                                             <label for="firstname" class="label-custom">First Name</label>
                                                 <input id="firstname" class="form-control" type="text" name="firstname"
                                                  autofocus>
                                               </div>

                                             <div class="form-group">
                                             <label for="lastname" class="label-custom">Last Name</label>
                                                 <input id="lastname" class="form-control" type="text" name="lastname"
                                                   autofocus>
                                            </div>

                                             <div class="form-group">
                                             <label for="email" class="label-custom">E-Mail</label>
                                                 <input id="email_edit" class="form-control" type="text" name="email_edit"
                                                      autofocus>
                                                       <span id="email_edit-info" class="info text-danger"></span>
                                            </div>

                                             <div class="form-group">
                                             <button type="submit" id='btnValidate'   class="btn btn-primary btn-theme form-control">
                                                 Save
                                             </button>
                                                 <span></span>
                                             <div id="edit-msg"></div>
                                           </div>
                                           <div class="col-md-2"></div>
                                           </div>
                                    </form>
                                  </div>
                                  <div class="modal-footer">
                                   <button type="button" class="btn btn-default btn-theme" data-dismiss="modal">Cancel</button>
                                   </div>
                              </div>
                          </div>
                      </div>
                      <!-- end Model -->

            
              </tbody>
            </table>
   </div>
   </div>
   </div>
   </div>
   </div>
<!-- confirm-add model -->
<div class="modal fade" id="confirm-add" tabindex="-2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                 <div class="modal-dialog">
                                 <div class="modal-content">
                                     <div class="modal-header">
                                     Add User
                                     </div>
                                     <div class="modal-body">
                                     <form id="addemailform" class="form" role="form" method="POST" action="{{ route('admin.add_settingEmail') }}">
                                              <!-- {{ csrf_field() }} -->
                                              <input type="hidden" name="token" id="token" value="{{ Session::get('token')}}">
                                              <input  type="hidden" id="_id" name="_id"  value="0" class="mx-sm-3 form-control">
                                              <div class="row">
                                              <div class="col-md-2"></div>
                                                <div class="col-md-8">
                                                <div class="form-group">
                                                <label for="firstname" class="label-custom">First Name</label>
                                                    <input id="firstname" class="form-control" type="text" name="firstname"
                                                          autofocus>
                                                  </div>

                                                <div class="form-group">
                                                <label for="lastname" class="label-custom">Last Name</label>
                                                    <input id="lastname" class="form-control" type="text" name="lastname"
                                                            autofocus>
                                               </div>

                                                <div class="form-group">
                                                <label for="email" class="label-custom">E-Mail</label>
                                                    <input id="email" class="form-control" type="text" name="email"
                                                           autofocus>
                                                          <span id="email-info" class="info text-danger"></span>
                                               </div>

                                                <div class="form-group">
                                                <button type="submit" id='btnValidate'   class="btn btn-primary btn-theme form-control">
                                                    Add
                                                </button>
                                                <span></span>
                                                <div id="upload-msg"></div>
                                              </div>
                                              <div class="col-md-2"></div>
                                              </div>
                                       </form>
                                     </div>
                                     <div class="modal-footer">
                                      <button type="button" class="btn btn-default btn-theme" data-dismiss="modal">Cancel</button>
                                      </div>
                                 </div>
                             </div>
                         </div>

 </div>
</section>
@endsection
