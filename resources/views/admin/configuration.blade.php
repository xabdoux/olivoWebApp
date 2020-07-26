@extends('layouts.adminDashLayout')
@section('title')
<title>Configuration</title>
@endsection
@section('stylesheet')
<link href="{{ asset('ample/plugins/bower_components/sweetalert/sweetalert.css') }}" rel="stylesheet" type="text/css">
@endsection
@section('page_title')
<h4 class="page-title">Configuration</h4>
@endsection
@section('breadcrumb')
<li><a href="#">Dashboard</a></li>
<li class="active">Configuration</li>
@endsection
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-inverse">
            <div class="panel-heading"><i class="icon-badge"> </i> Configuration
                <div class="pull-right"><a href="#" data-perform="panel-collapse"><i class="ti-minus"></i></a> <a href="#"></i></a> </div>
            </div>
            <div class="panel-wrapper collapse in" aria-expanded="true">
                <div class="panel-body">

                    <form method="POST" action="{{ url('configuration') }}" data-toggle="validator">
                        @csrf
                        <div class="col-xs-12">
                            <div class="form-group {{$errors->has('configuration') ? 'has-error':''}} col-xs-4">
                                <label for="exampleInputEmail1">Numero de contact</label>
                                <input type="text" name="contact" class="form-control" id="exampleInputEmail1" placeholder="Numero de contact" value="{{old('contact', $contact->value ?? '')}}" required>
                                <div class="help-block with-errors"></div>
                                @if ($errors->has('contact'))
                                <div class="help-block with-errors">
                                    <ul class="list-unstyled">
                                        @foreach ($errors->get('contact') as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif
                            </div>
                            <div class="col-xs-4 m-t-20">
                                <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Submit</button>
                                <!-- <button type="submit" class="btn btn-inverse waves-effect waves-light">Cancel</button> -->
                            </div>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>
    @endsection
    @section('script')
    <script src="{{ asset('ample/js/validator.js') }}"></script>
    @if(session()->has('success'))
    <script src="{{ asset('ample/plugins/bower_components/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('ample/plugins/bower_components/sweetalert/jquery.sweet-alert.custom.js') }}"></script>

    <script>
        swal('Success!', "{{session()->get('success')}}", 'success');
    </script>
    @endif
    @if(session()->has('error'))
    <script src="{{ asset('ample/plugins/bower_components/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('ample/plugins/bower_components/sweetalert/jquery.sweet-alert.custom.js') }}"></script>

    <script>
        swal('Error!', "{{session()->get('error')}}", 'error');
    </script>
    @endif
    @endsection