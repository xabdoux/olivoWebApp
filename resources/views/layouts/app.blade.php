
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('ample/plugins/images/admin-logo.png') }}">
    <title>OLIVO AL CAZAR </title>
    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('ample/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    

{{-- <div>
                                    <a  href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div> --}}
    

    <!-- Menu CSS -->
    <!-- toast CSS -->
    <!-- morris CSS -->
    <!-- chartist CSS -->
    <!-- Calendar CSS -->
    <link href="{{ asset('ample/plugins/bower_components/owl.carousel/owl.theme.default.css')}}" rel="stylesheet" type="text/css" />

    <!-- animation CSS -->
    <link href="{{ asset('ample/css/animate.css') }}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ asset('ample/css/style.css') }}" rel="stylesheet">
    <!-- color CSS -->
    <link href="{{ asset('ample/css/colors/megna-dark.css') }}" id="theme" rel="stylesheet">


   
</head>

<body  class="fix-header" style="overflow-x: hidden; ">

        <main class="py-4">
            @yield('content')
        </main>

</body>
</html>
