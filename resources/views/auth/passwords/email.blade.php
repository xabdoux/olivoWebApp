@extends('layouts.app')

@section('content')
<center>
    

 <div class="wrapper-page animated fadeInDown ">
            <div class="panel panel-color panel-primary ">
             @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

                <form method="POST" action="{{ route('password.email') }}" role="form" class="text-center"> 
                    <div class="alert alert-info alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        Enter your <b>Email</b> and instructions will be sent to you!
                    </div>
                    <div class="form-group m-b-0"> 
                        <div class="input-group"> 
                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required placeholder="Enter Email"> 
                             @if ($errors->has('email'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                            <br>
                            <span class="input-group-btn"> <button type="submit" class="btn btn-primary">{{ __('Send ') }}</button> </span> 
                        </div> 
                    </div> 
                    
                </form>

            </div>
        </div>

        <!-- js placed at the end of the document so the pages load faster -->
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/pace.min.js"></script>
        <script src="js/wow.min.js"></script>
        <script src="js/jquery.nicescroll.js" type="text/javascript"></script>
            

        <!--common script for all pages-->
        <script src="js/jquery.app.js"></script>
</center>

@endsection

