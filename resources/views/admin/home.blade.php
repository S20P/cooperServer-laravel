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
                  <h2 class="h5 display">User Records</h2>
            </div>
          <div class="card-block">
            <div class="table-responsive">
            <table class="table pagination_table table_hover_tr" id="userlist_table">
              <thead>
                <tr>
                  <th>#_Id</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Region</th>
                  <th>Status</th>
                  <th>flag</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
               <?php $number = 1;?>
               @if($user_data)
                @foreach($user_data  as $user_item)
                <tr>

                  <th scope="row">{{$number}}</th>
                  <td>{{$user_item->email}}</td>
                  <td>{{$user_item->phone}}</td>
                  <td>{{$user_item->region}}</td>
                  <td>{{$user_item->status}}</td>
                  <td>{{$user_item->flag}}</td>
                  <td>
                    <!-- <form  class="form-inline" role="form" method="POST" action="{{ route('admin.profile_approval_api') }}">
                      {{ csrf_field() }}
                      <div class="form-group">
                        <input id="inlineFormInput" type="hidden" id="email" name="email" placeholder="E-mail" value="{{$user_item->email}}" class="mx-sm-3 form-control">
                      </div>
                      @if($user_item->status==="approved")
                      <div class="form-group">
                        <button type="submit" class="btn btn-danger btn-theme">
                            Delete
                        </button>
                      </div>
                      <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-theme">
                            Deactivate
                        </button>
                      </div>
                      @else
                      <div class="form-group">
                        <button type="submit" class="btn btn-info btn-theme">
                            Approve
                        </button>
                        <button type="submit" class="btn btn-info btn-theme">
                            Reject
                        </button>
                      </div>
                        @endif
                    </form> -->

                      @if($user_item->status==="approved")

                      @if(!$user_item->isAdmin=="true")
                      <button class="btn btn-danger btn-theme" data-toggle="modal" data-target="#confirm-delete{{$number}}">
                      <i class="fa fa-trash-o" aria-hidden="true"></i>   Delete
                      </button>
                        @else
                        <button class="btn btn-danger btn-theme" data-toggle="modal" data-target="#confirm-delete{{$number}}" disabled="true">
                        <i class="fa fa-trash-o" aria-hidden="true"></i>   Delete
                        </button>
                        @endif

                      <!-- confirm-delete model -->
                                 <div class="modal fade" id="confirm-delete{{$number}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                 <div class="modal-dialog">
                                 <div class="modal-content">
                                     <div class="modal-header">
                                         Confirm Delete
                                     </div>
                                     <div class="modal-body">
                                      Are you sure you want to delete this user ?
                                     </div>
                                     <div class="modal-footer">
                                         <form  class="form-inline" role="form" method="POST" action="{{ route('admin.User_delete_api') }}">
                                           {{ csrf_field() }}
                                           <div class="form-group">
                                             <input id="inlineFormInput" type="hidden" id="email" name="email" placeholder="E-mail" value="{{$user_item->email}}" class="mx-sm-3 form-control">
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
                    @if($user_item->flag==="active")

                      @if(!$user_item->isAdmin=="true")
                      <button class="btn btn-success btn-theme" data-toggle="modal" data-target="#confirm-deactivate{{$number}}">
                        Deactivate
                      </button>
                      @else
                      <button class="btn btn-success btn-theme" data-toggle="modal" data-target="#confirm-deactivate{{$number}}" disabled="true">
                        Deactivate
                      </button>
                      @endif
              <!-- confirm-Deactivate model -->
                         <div class="modal fade" id="confirm-deactivate{{$number}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                         <div class="modal-dialog">
                         <div class="modal-content">
                             <div class="modal-header">
                                Confirm Deactivate
                             </div>
                             <div class="modal-body">
                               Are you sure you want to deactivate this user ?
                             </div>
                             <div class="modal-footer">
                                 <form  class="form-inline" role="form" method="POST" action="{{ route('admin.User_delete_api') }}">
                                   {{ csrf_field() }}
                                   <div class="form-group">
                                     <input id="inlineFormInput" type="hidden" id="email" name="email" placeholder="E-mail" value="{{$user_item->email}}" class="mx-sm-3 form-control">
                                   </div>
                                 <div class="form-group">
                                   <button type="submit" class="btn btn-danger btn-theme btn-ok">
                                       Deactivate
                                   </button>
                                     <button type="button" class="btn btn-default btn-theme" data-dismiss="modal">Cancel</button>
                                 </div>
                                 </form>
                             </div>
                         </div>
                     </div>
                 </div>
                 <!-- end Model -->
                        @else
                        <form  class="form-inline" role="form" method="POST" action="{{ route('admin.User_active_api') }}">
                            {{ csrf_field() }}
                            <div class="form-group">
                              <input id="inlineFormInput" type="hidden" id="email" name="email" placeholder="E-mail" value="{{$user_item->email}}" class="mx-sm-3 form-control">
                            </div>
                        <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-theme">
                            Activate
                        </button>
                        </div>
                     </form>
                      @endif

                      @else
                      <form  class="form-inline" role="form" method="POST" action="{{ route('admin.profile_approval_api') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                          <input id="inlineFormInput" type="hidden" id="email" name="email" placeholder="E-mail" value="{{$user_item->email}}" class="mx-sm-3 form-control">
                        </div>
                      <div class="form-group">
                        <button type="submit" class="btn btn-info btn-theme btn-approve">
                        <i class="fa fa-thumbs-o-up" aria-hidden="true"></i>  Approve
                        </button>
                      </div>
                      </form>
                      <div>

                      <button class="btn btn-danger btn-theme" data-toggle="modal" data-target="#confirm-reject{{$number}}">
                        Reject
                      </button>

                    </div>
                <!-- confirm-Reject model -->
                           <div class="modal fade" id="confirm-reject{{$number}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                           <div class="modal-dialog">
                           <div class="modal-content">
                               <div class="modal-header">
                                   Confirm Reject
                               </div>
                               <div class="modal-body">
                                   Are you sure you want to reject this user ?
                               </div>
                               <div class="modal-footer">
                                   <form  class="form-inline" role="form" method="POST" action="{{ route('admin.User_delete_api') }}">
                                     {{ csrf_field() }}
                                     <div class="form-group">
                                       <input id="inlineFormInput" type="hidden" id="email" name="email" placeholder="E-mail" value="{{$user_item->email}}" class="mx-sm-3 form-control">
                                     </div>
                                   <div class="form-group">
                                     <button type="submit" class="btn btn-danger btn-theme btn-ok">
                                         Reject
                                     </button>
                                       <button type="button" class="btn btn-default btn-theme" data-dismiss="modal">Cancel</button>
                                   </div>
                                   </form>
                               </div>
                           </div>
                       </div>
                   </div>
                   <!-- end Model -->
                        @endif

                  </td>

                </tr>
                <?php  $number++;?>
                @endforeach
                @else

            <tr>
              <td>{{$user_data}}</td>
            </tr>

                @endif
              </tbody>
            </table>

 <!-- confirm-delete model -->
            <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    ...
                </div>
                <div class="modal-body">
                    Are You Sure to Delete This User
                </div>
                <div class="modal-footer">
                    <form  class="form-inline" role="form" method="POST" action="{{ route('admin.User_delete_api') }}">
                      {{ csrf_field() }}
                      <div class="form-group">
                        <input id="inlineFormInput" type="hidden" id="email" name="email" placeholder="E-mail" value="{{$user_item->email}}" class="mx-sm-3 form-control">
                      </div>
                    <div class="form-group">
                      <button type="submit" class="btn btn-danger btn-theme btn-ok" data-toggle="modal" data-target="#confirm-delete">
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
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</section>

@endsection
