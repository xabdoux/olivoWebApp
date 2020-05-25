@extends('layouts.app')

@section('content')
 <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"/>
        </svg>
    </div>
<!-- Preloader -->
<section id="wrapper" class="new-login-register">
  <div class="lg-info-panel">
    <div class="inner-panel">
        <a href="javascript:void(0)" class="p-20 di"><img src="{{ asset('/plugins/images/admin-logo.png')}}"></a>
        <div class="lg-content">
            <h2>{{ __('Login') }} to Admin</h2>
            <p class="text-muted">Enter your details below</p>
            <p>Copyright © 2018 CreativeKeys.com. All rights reserved.</p>
        </div>
    </div>
  </div>

 <div class="new-login-box m-t-22">
    <div class="white-box">
      <a href="javascript:void(0)" class="text-center db"><img src="{{ asset('/plugins/images/admin-logo-dark.png')}}" alt="Home" /><br/><h3>Creative<b>Keys</h3></b></a>  

 <div class="wrapper-page animated fadeInDown">
            <div class="panel panel-color panel-primary">
                <div class="panel-heading " style="padding: 10px 25px;border-color: #ffbc0a;color: white;background-color: #f4643b"> 
                   <h3 class="text-center m-t-0 m-b-0" style="color: #fff"> {{ __('Reset Password') }} </h3>
                </div> 
                    <form class="form-horizontal new-lg-form m-t-20" method="POST" action="{{ route('password.request') }}">
                        @csrf

                         <input type="hidden" name="token" value="{{ $token }}">

                    <div class="form-group">
                        <div class="col-xs-12">
                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email ?? old('email') }}" required autofocus placeholder="Email">

                            @if ($errors->has('email'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-12">
                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required placeholder="password">

                           @if ($errors->has('password'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                     <div class="form-group">
                        <div class="col-xs-12">
                            <input  id="password-confirm" type="password" class="form-control" name="password_confirmation" required placeholder="password confirme">

                           @if ($errors->has('password'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                       
                    <div class="form-group text-right">
                        <div class="col-xs-12">
                            <button class="btn btn-info btn-lg btn-block btn-rounded waves-effect waves-light" style="padding: 5px 16px; border-radius: 0;"" type="submit"> {{ __('Reset Password') }}</button>
                        </div>
                    </div>
            

                       
                </form>                                  
                
            </div>
        </div>


       <!-- jQuery -->
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
