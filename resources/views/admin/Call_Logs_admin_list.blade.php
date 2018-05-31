@extends('admin.layouts.app')

@section('content')

<div class="breadcrumb-holder">
  <div class="container-fluid">
    <ul class="breadcrumb">
      <li>
            <a href="javascript:history.back()" class="btn btn-default"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
      </li>
      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
      <li class="breadcrumb-item active">Call Logs </li>
    </ul>
  </div>
</div>

<section class="dashboard-counts section-padding">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">

        <div class="card">
          <div class="card-header d-flex align-items-center">
                  <h2 class="h5 display">Call Logs </h2>
            </div>
          <div class="card-block">
            <div class="table-responsive">
            <table class="table pagination_table table_hover_tr">
              <thead>
                <tr>
                  <th>#_id</th>
                  <th>CallType</th>
                  <th>Date</th>
                  <th>Salesman Id</th>
                  <th>Time</th>
                  <th>Created At</th>
                  <th>Order</th>
                  <th>Vibe</th>
                  <th>Loation</th>
                  <th>Comment</th>
                  <th>Contact</th>
                  <th>CustomerName</th>
                  <th>SalesmanName</th>
                </tr>
              </thead>
              <tbody>


             @if(isset($CallLogs_data))
              <?php $number = 1;?>
                @foreach($CallLogs_data  as $log_item)
                <tr>
                  <th scope="row">{{$number}}</th>
                  @if(isset($log_item->callType))
                  <td>{{$log_item->callType}}</td>
                  @else
                    <td></td>
                  @endif

                  @if(isset($log_item->date))
                  <td>{{$log_item->date}}</td>
                  @else
                    <td></td>
                  @endif

                  @if(isset($log_item->salesmanId))
                  <td>{{$log_item->salesmanId}}</td>
                  @else
                    <td></td>
                  @endif

                  @if(isset($log_item->time))
                  <td>{{$log_item->time}}</td>
                  @else
                    <td></td>
                  @endif

                  @if(isset($log_item->created_at))
                  <td>{{$log_item->created_at}}</td>
                  @else
                    <td></td>
                  @endif

                  @if(isset($log_item->order))
                  <td>{{$log_item->order}}</td>
                  @else
                    <td></td>
                  @endif

                  @if(isset($log_item->vibe))
                  <td>{{$log_item->vibe}}</td>
                  @else
                    <td></td>
                  @endif

                  @if(isset($log_item->location))
                  <td>{{$log_item->location}}</td>
                  @else
                    <td></td>
                  @endif

                  @if(isset($log_item->comment))
                  <td>{{$log_item->comment}}</td>
                  @else
                    <td></td>
                  @endif

                  @if(isset($log_item->contact))
                  <td>{{$log_item->contact}}</td>
                  @else
                    <td></td>
                  @endif

                  @if(isset($log_item->customerName))
                  <td>{{$log_item->customerName}}</td>
                  @else
                    <td></td>
                  @endif

                  @if(isset($log_item->salesmanName))
                  <td>{{$log_item->salesmanName}}</td>
                  @else
                    <td></td>
                  @endif
                </tr>
                <?php  $number++; ?>
                @endforeach
                @else
                <tr>
                  No Record Found
                </tr>
                @endif
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
