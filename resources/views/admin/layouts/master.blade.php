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

  <link href="{{ asset('css/app.css') }}" rel="stylesheet">

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
  <!-- Favicon-->
  <link rel="shortcut icon" href="favicon.png">
  <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
  <!-- Tweaks for older IEs--><!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
</head>
<body>
  <div id="loading_login">
    <img id="loading-image" src="{{asset('img/loading.gif')}}" alt="Loading..." />
  </div>
        <!-- Counts Section -->
        @yield('content')
      <!-- footer Section-->


    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/custome.js') }}"></script>


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
   <script type="text/javascript">
   $(document).ready(function() {
   //hide on start
    $('#loading_login').hide();

   });
   </script>
</body>
</html>
