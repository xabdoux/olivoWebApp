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
  <div class="new-login-box m-t-22">
    <div class="white-box">
      <a href="javascript:void(0)" class="text-center db"><img src="{{ asset('ample/plugins/images/admin-logo-dark.png')}}" width="150px" height="100px" alt="Home" /><br/><h3>OLIVO ALCAZAR<b></h3></b></a>  
        <form class="form-horizontal new-lg-form" id="loginform" method="POST" action="{{ route('login') }}">
        @csrf  
        <div class="form-group  m-t-20 m-b-10">
          <div class="col-xs-12">
            <label>{{ __('E-Mail Address') }}</label>
            <input type="text"  class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required autofocus placeholder=" E-Mail or Username">
            @if ($errors->has('username'))
                <p style="color:#f44336;">
                    * {{ $errors->first('username') }}
                </p>
            @endif
          </div>
        </div>
        <div class="form-group m-b-15">
          <div class="col-xs-12">
            <label>{{ __('Password') }}</label>
            <input type="password" id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required placeholder="Password">
            @if ($errors->has('password'))
                <p style="color:#f44336;">
                    * {{ $errors->first('password') }}
                </p>
            @endif
          </div>
        </div>
        <div class="form-group m-b-15">
          <div class="col-md-12">
            <div class="checkbox checkbox-info pull-left p-t-0">
              <input id="checkbox-signup" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> 
              <label for="checkbox-signup"> {{ __('Remember Me') }} </label>
            </div>
            <a href="javascript:(0)" id="to-recover" class="text-dark pull-right"><i class="fa fa-lock m-r-5"></i>{{ __('Forgot Your Password ?') }}</a> </div>
        </div>
        <div class="form-group text-center m-b-15">
          <div class="col-xs-12">
            <button class="btn btn-info btn-lg btn-block btn-rounded text-uppercase waves-effect waves-light" style="padding: 4px 16px; border-radius: 0;" type="submit">{{ __('Login') }}</button>
          </div>
        </div>
        <div class="form-group m-b-0">
          <div class="col-sm-12 text-center">
            <p>Don't have an account? <a href="{{ route('register') }}" class="text-primary m-l-5"><b>{{ __('Register') }}</b></a></p>
          </div>
        </div>
      </form>
       @if (session('status'))
            <div class="alert alert-success">
                * {{ session('status') }}
            </div>
        @endif
      <form class="form-horizontal" id="recoverform" method="POST" action="{{ route('password.email') }}">
        @csrf
        <div class="form-group ">
          <div class="col-xs-12">
            <h3>{{ __('Reset Password') }}</h3>
            <p class="text-muted">Enter your Email and instructions will be sent to you! </p>
          </div>
        </div>
        <div class="form-group ">
          <div class="col-xs-12">
            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required placeholder="Email">
                @if ($errors->has('email'))
                    <p style="color:#f44336;">
                        * {{ $errors->first('email') }}
                    </p>
                @endif
          </div>
        </div>
        <div class="form-group text-center m-t-20">
          <div class="col-xs-12">
            <button class="btn btn-primary btn-lg btn-block text-uppercase waves-effect waves-light" style="padding: 4px 16px; border-radius: 0;" type="submit"> Reset</button>
          </div>
        </div>
      </form>
    </div>
  </div>              
</section>


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
