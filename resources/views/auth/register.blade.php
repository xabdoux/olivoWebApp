@extends('layouts.app')

@section('content')
<div class="preloader">
    <svg class="circular" viewBox="25 25 50 50">
        <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
    </svg>
</div>
<section id="wrapper" class="new-login-register">

    <div class="lg-info-panel">
        <div class="inner-panel">
            <a href="javascript:void(0)" class="p-20 di"><img src="{{ asset('ample/plugins/images/admin-logo.png') }}" width="60px" height="70px"></a>
            <div class="lg-content">
                <h2>OLIVO AL'CAZAR</h2>
                <p class="text-muted">
                    TRITURATION DES OLIVES, LA VALORISATION, LA TRANSFORMATION, LE CONDITIONNEMENT, L EMBALLAGE ET LA VENTE DES PRODUITS DE L'OLIVIER
                </p>
                <br><br><br>
                <p>Copyright © 2018 OLIVO AL-CAZAR - All Rights Reserved</p>
            </div>
        </div>
    </div>
    </div>
    <div class="new-login-box m-t-15">
        <div class="white-box ">
            <a href="javascript:void(0)" class="text-center db"><img src="{{ asset('ample/plugins/images/admin-logo-dark.png')}}" width="100px" height="100px" alt="Home" /><br />
                <h3>OLIVO AL'CAZAR</h3></b>
            </a>
            <form class="form-horizontal new-lg-form" id="loginform" method="POST" action="{{ route('register') }}">
                @csrf
                <div class="form-group m-b-15">
                    <div class="col-xs-12">
                        <input class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" id="name" type="text" required name="name" value="{{ old('name') }}" autofocus placeholder="Name">
                        @if ($errors->has('name'))
                        <p style="color:#f44336;">
                            * {{ $errors->first('name') }}
                        </p>
                        @endif
                    </div>
                </div>
                <div class="form-group m-b-15">
                    <div class="col-xs-12">
                        <input class="form-control {{ $errors->has('username') ? ' is-invalid' : '' }}" value="{{ old('username') }}" type="text" name="username" id="email" required placeholder="username">
                        @if ($errors->has('username'))
                        <p style="color:#f44336;">
                            * {{ $errors->first('username') }}
                        </p>
                        @endif
                    </div>
                </div>
                <div class="form-group m-b-15">
                    <div class="col-xs-12">
                        <input class="form-control " type="password" name="password" required placeholder="Password">
                        @if ($errors->has('password'))
                        <p style="color:#f44336;">
                            * {{ $errors->first('password') }}
                        </p>
                        @endif
                    </div>
                </div>
                <div class="form-group m-b-15">
                    <div class="col-xs-12">
                        <input class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" id="password_confirmation" type="password" name="password_confirmation" placeholder="Confirm Password">
                    </div>
                </div>
                <div class="form-group m-b-15">
                    <div class="col-md-12">
                        <div class="checkbox checkbox-primary p-t-0">
                            <input id="checkbox-signup" type="checkbox">
                            <label for="checkbox-signup"> I agree to all <a href="#">Terms</a></label>
                        </div>
                    </div>
                </div>
                <div class="form-group text-center m-t-15">
                    <div class="col-xs-12">
                        <button class="btn btn-info btn-lg btn-block btn-rounded text-uppercase waves-effect waves-light" style="padding: 4px 16px; border-radius: 0;" type="submit"> {{ __('Register') }}</button>
                    </div>
                </div>
                <div class="form-group m-b-0">
                    <div class="col-sm-12 text-center">
                        <p>Already have an account ? <a href="{{ route('login') }}" class="text-danger m-l-5"><b>{{ __('login') }}</b></a></p>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

<script src="{{ asset('ample/plugins/bower_components/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap Core JavaScript -->
<script src="{{ asset('ample/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- Menu Plugin JavaScript -->
<script src="{{ asset('ample/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js') }}"></script>

<!--slimscroll JavaScript -->
<script src="{{ asset('ample/js/jquery.slimscroll.js') }}"></script>
<!--Wave Effects -->
<script src="{{ asset('ample/js/waves.js') }}"></script>
<!-- Custom Theme JavaScript -->
<script src="{{ asset('ample/js/custom.min.js') }}"></script>
<!--Style Switcher -->
<script src="{{ asset('ample/plugins/bower_components/styleswitcher/jQuery.style.switcher.js') }}"></script>
@endsection