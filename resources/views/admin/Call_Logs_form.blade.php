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
      <li class="breadcrumb-item active">Call logs</li>
    </ul>
  </div>
</div>
<section class="dashboard-counts section-padding">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">

        <div class="card">
          <div class="card-header d-flex align-items-center">
                  <h2 class="h5 display">Call logs </h2>
            </div>

          <div class="card-block">
            <ul class="breadcrumb">
              <li class="breadcrumb-item active">Use the following filter to get a list of all call logs. If you would like to export them to an excel, you can use the export call logs page </li>
            </ul>
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
            <form id="eventForm" class="form" role="form" method="POST" action="{{ route('admin.Call_Logs_list') }}">
              {{ csrf_field() }}
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Customer Name</label>
                    <input type="text" placeholder="customerName" name="customerName" id="customerName"   class="form-control">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Region</label>
                    <select name="region" id="region"  class="form-control">
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
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>FromDate</label>
                    <div class="date">
                     <div class="input-group input-append date" id="datePicker_from">
                         <input type="text" class="form-control" placeholder="dd-M-yyyy" name="fromDate" id="fromDate" />
                         <span class="input-group-addon add-on"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                     </div>
                  </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>ToDate</label>
                    <div class="date">
                     <div class="input-group input-append date" id="datePicker_to">
                         <input type="text" class="form-control" placeholder="dd-M-yyyy" name="toDate" id="toDate" />
                         <span class="input-group-addon add-on"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                     </div>
                  </div>
                  </div>
                </div>
              </div>
                <div class="form-group">
                <button type="submit" class="btn btn-primary btn-theme">
                    submit
                </button>
              </div>
            </form>
             <div id="container"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
