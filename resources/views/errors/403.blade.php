<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('ample/plugins/images/favicon.png') }}">
    @yield('title')
    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('ample/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- This is Sidebar menu CSS -->
    <link href="{{ asset('ample/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css') }}" rel="stylesheet">
    <!-- This is a Animation CSS -->
    <link href="{{ asset('ample/css/animate.css') }}" rel="stylesheet">
    <!-- This is a Custom CSS -->
    <link href="{{ asset('ample/css/style.css') }}" rel="stylesheet">

    <link href="{{ asset('ample/css/colors/blue-dark.css') }}" id="theme" rel="stylesheet">

</head>
<body>
<!-- Preloader -->

<section id="wrapper" class="error-page">
  <div class="error-box">
    <div class="error-body text-center">
      <h1 class="text-info">403</h1>
      <h3 class="text-uppercase">Forbidden Error</h3>
      <p class="text-muted m-t-30 m-b-30 text-uppercase">You don't have permission to access on this server.</p>
      <a href="index.html" class="btn btn-info btn-rounded waves-effect waves-light m-b-40">Back to home</a> </div>
    <footer class="footer text-center">2017 © Ample Admin.</footer>
  </div>
</section>
<!-- jQuery -->
<script src="{{ asset('ample/plugins/bower_components/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap Core JavaScript -->
<script src="{{ asset('ample/bootstrap/dist/js/bootstrap.min.js') }}"></script>


</body>
</html>
