<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="robots" content="all,follow">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>CooperApp</title>

  <!-- Styles -->
  <?php $app = "app.css"; ?>
  <link href="{{ asset('css/'.$app) }}" rel="stylesheet">
  <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> using asset() to access public-->
  <!-- <link href="{{ url('css/app.css') }}" rel="stylesheet"> //using url() to access public-->

  <!-- Font Awesome CSS-->
  <link rel="stylesheet" href="{{ asset('css/font-awesome.css') }}">
  <link rel="stylesheet" href="{{ asset('vendor/font-awesome/css/font-awesome.min.css') }}">
  <!-- Custom icon font-->
  <link rel="stylesheet" href="{{ asset('css/fontastic.css') }}">
  <!-- Google fonts - Roboto -->
  <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:300,400,500,700">
  <!-- jQuery Circle-->
  <link rel="stylesheet" href="{{asset('css/grasp_mobile_progress_circle-1.0.0.min.css') }}">
  <!-- Custom Scrollbar-->
  <link rel="stylesheet" href="{{ asset('vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css') }}">
  <!-- theme stylesheet-->
 <link rel="stylesheet" href="{{ asset('css/style.default.css') }}"  id="theme-stylesheet">

  <!-- Custom stylesheet - for your changes-->
  <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
  <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
 <!-- pagination -->
  <link rel="stylesheet" href="{{ asset('css/pagination.css') }}">

  <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet"> -->

  <link rel="stylesheet" href="{{ asset('datepicker/css/bootstrap-datepicker.css') }}">

  <!-- Favicon-->
  <link rel="shortcut icon" href="favicon.png">
  <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
  <!-- Tweaks for older IEs--><!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
</head>
<body>
  <div id="loading">
    <img id="loading-image" src="{{asset('img/loading.gif')}}" alt="Loading..." />
  </div>
    <!-- Scripts -->
      <!-- Side Navbar -->

    @include('admin.inc.sidebar')
    <div class="page home-page">

      <!-- navbar-->
    @include('admin.inc.navbar')
      <!-- Counts Section -->
      @if (session('status'))
          <div class="alert alert-success">
              {{ session('status') }}
          </div>
      @endif
        @yield('content')
      <!-- footer Section-->

       @include('admin.inc.footer')
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/custome.js') }}"></script>
    <script src="{{ asset('js/api.js') }}"></script>


    <!-- Javascript files-->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"> </script>
    <!-- <script src="vendor/jquery.cookie/jquery.cookie.js"> </script> -->
    <script src="{{ asset('vendor/jquery.cookie/jquery.cookie.js') }}"></script>
    <script src="{{ asset('js/grasp_mobile_progress_circle-1.0.0.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js') }}"></script>


    <script>
      (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
      function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
      e=o.createElement(i);r=o.getElementsByTagName(i)[0];
      e.src='//www.google-analytics.com/analytics.js';
      r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
      ga('create','UA-XXXXX-X');ga('send','pageview');
    </script>
    <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>

    <!-- pagination script start-->
    <script type="text/javascript" src="{{ asset('js/pagination/pagination.js') }}"></script>
    <script type="text/javaScript">
    $(document).ready(function(){
      $('.pagination_table').tablePaginate({navigateType:'navigator',recordPerPage:10,buttonPosition:'before'});
      //$('#call_logs-table').tablePaginate({navigateType:'navigator',recordPerPage:10,buttonPosition:'before'});
    });
    </script>
    <script src="{{ asset('vendor/jquery-validation/jquery.validate.min.js') }}"></script>
    
    <!-- pagination script end-->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script> -->
    <script src="{{ asset('datepicker/js/bootstrap-datepicker.js') }}"></script>
    <!-- jQuery library -->


    <script>
    $(document).ready(function() {
        $('#datePicker_to')
            .datepicker({
                format: 'dd-M-yyyy'
          }).datepicker("setDate", new Date());
        $('#datePicker_from')
            .datepicker({
                format: 'dd-M-yyyy'
            }).datepicker("setDate", new Date());

        // $(".delete_form").on("submit", function(){
        // $('#confirm').modal('show');
        // });

        $('#confirm-delete').on('show.bs.modal', function(e) {
            $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
        });
});

$(document).ready(function() {
//hide on start
 $('#loading').hide();
});

    </script>
  

<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>




</body>
</html>
