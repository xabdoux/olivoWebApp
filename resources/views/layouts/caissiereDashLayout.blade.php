<!DOCTYPE html>
<!--
   This is a starter template page. Use this page to start your new project from
   scratch. This page gets rid of all links and provides the needed markup only.
   -->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('ample/plugins/images/admin-logo.png') }}">
    @yield('title')
    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('ample/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- This is Sidebar menu CSS -->
    <link href="{{ asset('ample/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css') }}" rel="stylesheet">
    <!-- This is a Animation CSS -->
    <link href="{{ asset('ample/css/animate.css') }}" rel="stylesheet">
    <!-- This is a Custom CSS -->
    <link href="{{ asset('ample/css/style.css') }}" rel="stylesheet">
    <!-- color CSS you can use different color css from css/colors folder -->
    <!-- We have chosen the skin-blue (default.css) for this starter
         page. However, you can choose any other skin from folder css / colors .
         -->
    <link href="{{ asset('ample/css/colors/blue-dark.css') }}" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
      @yield('stylesheet')
</head>

<body class="fix-sidebar">
    <!-- Preloader -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"/>
        </svg>
    </div>
    <div id="wrapper">
        <!-- Top Navigation -->
        <nav class="navbar navbar-default navbar-static-top m-b-0">
            <div class="navbar-header">
                <!-- Toggle icon for mobile view -->
                <div class="top-left-part">
                    <!-- Logo -->
                    <a class="logo p-l-30" href="{{ url('dashboard', 14) }}">
                        <!-- Logo icon image, you can use font-icon also --><b>
                        {{-- <!--This is dark logo icon--><img src="{{ asset('ample/plugins/images/olivo_black.png') }}" alt="home" class="dark-logo" width="35px" /><!--This is light logo icon--><img src="{{ asset('ample/plugins/images/admin-logo-dark.png') }}" alt="home" class="light-logo" /> --}}
                     </b>
                        <!-- Logo text image you can use text also --><span class="hidden-xs">
                        <!--This is dark logo text--><img src="{{ asset('ample/plugins/images/olivo_white.png') }}" height="45px" alt="home" class="dark-logo" /><!--This is light logo text--><img src="{{ asset('ample/plugins/images/admin-text-dark.png') }}" alt="home" class="light-logo" />
                     </span> </a>
                </div>
                <!-- /Logo -->
                <!-- Search input and Toggle icon -->
                <ul class="nav navbar-top-links navbar-left">
                    <li><a href="javascript:void(0)" class="open-close waves-effect waves-light visible-xs"><i class="ti-close ti-menu"></i></a></li>
                </ul>
                <!-- This is the message dropdown -->
                <ul class="nav navbar-top-links navbar-right pull-right">
                    <!-- /.Task dropdown -->
                    <!-- /.dropdown -->
                    <li class="dropdown">
                        <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#"> <img src="{{ asset('ample/plugins/images/users/user.png') }}" alt="user-img" width="36" class="img-circle"><b class="hidden-xs">{{ucfirst(Auth::user()->name)}}</b><span class="caret"></span> </a>
                        <ul class="dropdown-menu dropdown-user animated flipInY">
                            <li>
                                <div class="dw-user-box">
                                    <div class="u-img"><img src="{{ asset('ample/plugins/images/users/user.png') }}" alt="user" /></div>
                                    <div class="u-text"><h4>{{ucfirst(Auth::user()->name)}}</h4><p class="text-muted">{{str_limit(Auth::user()->email, 20)}}</p><a href="profile.html" class="btn btn-rounded btn-danger btn-sm">View Profile</a></div>
                                </div>
                            </li>
                            <li role="separator" class="divider"></li>
                            <li>
                                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                                 document.getElementById('logout-form').submit();">
                                  <i class="fa fa-power-off"></i> Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                        <!-- /.dropdown-user -->
                    </li>
                    
                    <!-- /.dropdown -->
                </ul>
            </div>
            <!-- /.navbar-header -->
            <!-- /.navbar-top-links -->
            <!-- /.navbar-static-side -->
        </nav>
        <!-- End Top Navigation -->
        <!-- Left navbar-header -->
        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav slimscrollsidebar">
                <div class="sidebar-head">
                    <h3><span class="fa-fw open-close"><i class="ti-menu hidden-xs"></i><i class="ti-close visible-xs"></i></span> <span class="hide-menu">Navigation</span></h3> </div>
                <ul class="nav" id="side-menu">
                    <li><a href="{{ url('dashboard', 14) }}" class="waves-effect"><i data-icon="7" class="fa fa-users" style="font-size: 20px; margin-right: 4px;"> </i> <span class="hide-menu" style="font-size: 18px;"> List des Clients</span></a> </li>
                    <li><a href="{{ url('finishedClients', 14) }}" class="waves-effect"><i data-icon="7" class="fa fa-sign-out" style="font-size: 20px; margin-right: 4px;"> </i> <span class="hide-menu" style="font-size: 18px;"> Clients terminés</span></a> </li>
                    <li><a href="{{ url('comptabilite') }}" class="waves-effect"><i data-icon="7" class="fa fa-money" style="font-size: 20px; margin-right: 4px;"> </i> <span class="hide-menu" style="font-size: 18px;"> Comptabilité</span></a> </li>
                    <li><a href="{{ url('compta-historique') }}" class="waves-effect"><i data-icon="7" class="fa fa-money" style="font-size: 20px; margin-right: 4px;"> </i> <span class="hide-menu" style="font-size: 18px;"> Historique Comptabilité</span></a> </li>
                    
                </ul>
            </div>
        </div>
        <!-- Left navbar-header end -->
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title ">
                    <!-- .page title -->
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-6 hidden-xs">
                        @yield('page_title')
                    </div>
                    <!-- /.page title -->
                    <!-- .breadcrumb -->
                    
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-6 hidden-xs">
                        <ol class="breadcrumb">
                            @yield('breadcrumb')
                        </ol>
                    </div>
                    <!-- /.breadcrumb -->
                </div>
                <!-- .row -->
                @yield('content')
                <!-- .row -->
               
            </div>
            <!-- /.container-fluid -->
            <footer class="footer text-center"> {{date("Y")}} &copy; Olivo Al-Cazar Admin Cpanel brought to you by JAADI Abdellah </footer>
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
    <!-- jQuery -->
    
    <script src="{{ asset('ample/plugins/bower_components/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="{{ asset('ample/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <!-- Sidebar menu plugin JavaScript -->
    <script src="{{ asset('ample/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js') }}"></script>
    <!--Slimscroll JavaScript For custom scroll-->
    <script src="{{ asset('ample/js/jquery.slimscroll.js') }}"></script>
    <!--Wave Effects -->
    <script src="{{ asset('ample/js/waves.js') }}"></script>
    <!-- Custom Theme JavaScript -->
    <script src="{{ asset('ample/js/custom.js') }}"></script>
    @yield('script')
</body>

</html>