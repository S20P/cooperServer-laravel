@extends('admin.layouts.app')

@section('content')
<h1 id="loading-text" hidden>Please stand by. We are updating the Customers list. It could take upwards of 10 minutes. Closing this page will not affect this operation.</h1>
<div class="breadcrumb-holder">
  <div class="container-fluid">
    <ul class="breadcrumb">
      <li>
        <!-- <a href="{{ URL::previous() }}" class="btn btn-default">Back</a> -->
        <a href="javascript:history.back()" class="btn btn-default"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
      </li>
      <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item active">Import Customer list</li>
  
    </ul>
  </div>
</div>
<section class="dashboard-counts section-padding">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">

        @if (session('data.message'))
          @if (session('data.status')=="success")
            <div class="alert alert-success">
                {{ session('data.message') }}
            </div>
          @else
          <div class="alert alert-danger">
              {{ session('data.message') }}
          </div>
       @endif
        @endif
        <div class="card">
          <div class="card-header">
                  <div class="pull-lef col-sm-6 col-xs-6 col-md-6">
                        <h2 class="h5 display mtm">Import Customer list</h2>
                  </div>
                  <div class="pull-right  col-sm-6 col-xs-6 col-md-6 mtm">

                    <form id="eventForm" class="form pull-right" role="form" method="POST" action="{{ route('admin.Export_Customer_api') }}">
                        {{ csrf_field() }}
                        <div class="form-group">

                        @if (session('data.url'))
                          <!-- <button class="btn btn-primary btn-theme">
                           <a href="{{url(session('data.url')) }}" download>
                                Download Export File  <i class="fa fa-download" target="_blank" aria-hidden="true"></i>
                           </a>
                         </button> -->
                        <a id="exportcustmer_dwlink" href="{{url(session('data.url')) }}" download  onclick="this.className='hidden'">  Download Exported File</a>
                       @endif
                         <button type="submit" class="btn btn-success btn-theme pull-right">
                             Export Customer list
                         </button>

                      </div>
                    </form>

                  </div>
            </div>


          <div class="card-block">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <!-- <form  class="form-inline" role="form" method="POST" id="file_upload_form1234" action="{{ route('admin.fileupload_api') }}" enctype="multipart/form-data">
              {{ csrf_field() }}
              <div class="form-group">
                <label for="file" class="sr-only">File Upload</label>
                <input id="file" type="file"  name="file"  accept=".xlsx, .xls, .csv"  class="mx-sm-3 form-control">
              </div>
              <div class="form-group">
                <button type="submit"  class="btn btn-primary btn-theme">
                    Upload
                </button>
              </div>
            </form> -->

            <!-- <form id="uploadForm" action="https://cooperapp.herokuapp.com/api/addCustomer" method="post">
            <label>Upload Excel File:</label><br/>
            <input name="file" type="file"  class="inputFile" />
            <input type="submit" value="Submit" class="btnSubmit" accept=".xlsx, .xls, .csv" required />
            </form> -->


            <form  class="form" role="form" method="POST" id="uploadForm"  action="https://cooperapp.herokuapp.com/api/addCustomer" method="post">
                {{ csrf_field() }}
               <input type="hidden" name="" value="{{ Session::get('token')}}">
               <div class="form-group">
                  <div class="row">
                    <div class="col-md-4">
                       <input  type="file" id="file" name="file"  accept=".xlsx, .xls, .csv"  class="mx-sm-3 form-control">
                    </div>
                    <div class="col-md-8">
                      <div id="file-info" class="info"></div>
                    </div>
                 </div>
              </div>
              <div class="form-group">
                  <input type="submit" id="submit" value="Upload" class="btnSubmit btn btn-primary btn-theme" accept=".xlsx, .xls, .csv" required />
              </div>

            </form>

          </div>

          <div class="card-footer">
            <div id="upload-msg"></div>
          </div>
        </div>
      </div>

        </div>

  </div>
</section>
@endsection
