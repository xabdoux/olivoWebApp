@extends('layouts.adminDashLayout')
@section('title')
<title>Welcome to Dashboard</title>
@endsection
@section('stylesheet')
<link href="{{ asset('ample/plugins/bower_components/sweetalert/sweetalert.css') }}" rel="stylesheet" type="text/css">
@endsection
@section('page_title')
<h4 class="page-title">Starter Page</h4>
@endsection
@section('breadcrumb')
<li><a href="#">Dashboard</a></li>
<li class="active">Starter Page</li>
@endsection
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="white-box p-t-0">
            <div class="row">
                <div class="col-sm-12 col-xs-12 m-t-40">
                    <form method="POST" action="{{ url('addUser') }}" data-toggle="validator">
                        @csrf
                        <div class="form-group {{$errors->has('name') ? 'has-error':''}}">
                            <label for="exampleInputEmail1">Nom et Prenom</label>
                            <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="nom et prenom" value="{{old('name')}}" required>
                            <div class="help-block with-errors"></div>
                            @if ($errors->has('name'))
                                <div class="help-block with-errors">
                                    <ul class="list-unstyled">
                                         @foreach ($errors->get('name') as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                       </div>
                        <div class="form-group {{$errors->has('username') ? 'has-error':''}}">
                            <label for="exampleInputEmail1">Username</label>
                            <input type="text" name="username" class="form-control" id="exampleInputEmail1" placeholder="username" value="{{old('username')}}" required>
                            <div class="help-block with-errors"></div>
                            @if ($errors->has('username'))
                                <div class="help-block with-errors">
                                    <ul class="list-unstyled">
                                         @foreach ($errors->get('username') as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                            <div class="form-group {{$errors->has('role') ? 'has-error':''}}">
                                <label>Role</label>
                                <select class="form-control" name="role" required>
                                    <option value=""></option>
                                    <option value="injecteur" {{old('role')=='injecteur'?'selected':''}}>Injecteur</option>
                                    <option value="caissiere" {{old('role')=='caissiere'?'selected':''}}>Caissiere</option>
                                    <option value="donneur" {{old('role')=='donneur'?'selected':''}}>Donneur</option>
                                    <option value="admin" {{old('role')=='admin'?'selected':''}}>Admin</option>
                                </select>
                                <div class="help-block with-errors"></div>
                                @if ($errors->has('role'))
                                <div class="help-block with-errors">
                                    <ul class="list-unstyled">
                                         @foreach ($errors->get('role') as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            </div>
                        <div class="form-group {{$errors->has('password') ? 'has-error':''}}">
                            <label for="exampleInputPassword1">Mot de passe</label>
                            <input type="password" name="password" value="{{old('password')}}" class="form-control" placeholder="Password" data-toggle="validator" data-minlength="6" id="inputPassword" required>
                            <div class="help-block with-errors"></div>
                            @if ($errors->has('password'))
                                <div class="help-block with-errors">
                                    <ul class="list-unstyled">
                                         @foreach ($errors->get('password') as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Confirmer Mdp</label>
                            <input type="password" name="password_confirmation" class="form-control" id="inputPasswordConfirm" data-match="#inputPassword" data-match-error="عفوًا ، هذه لا تتطابق" placeholder="Confirm" required>
                            <div class="help-block with-errors"></div>
                        </div>
                        
                        <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Submit</button>
                        <button type="submit" class="btn btn-inverse waves-effect waves-light">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12 col-sm-12">
    <div class="panel panel-inverse">
        <div class="panel-heading"><i class="icon-badge"> </i> Admin
            <div class="pull-right"><a href="#" data-perform="panel-collapse"><i class="ti-minus"></i></a> <a href="#" data-perform="panel-dismiss"><i class="ti-close"></i></a> </div>
        </div>
        <div class="panel-wrapper collapse in" aria-expanded="true">
            <div class="panel-body">

                @foreach ($users as $user)
                    @if ($user->role == "admin")
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="panel panel-default" style="border: solid 1px #d8cece;">
                                <div class="panel-heading"><i class="icon-user"> </i> {{$user->name}}
                                    <div class="panel-action">
                                        <div class="dropdown"> <a class="dropdown-toggle" id="examplePanelDropdown" data-toggle="dropdown" href="#" aria-expanded="false" role="button">Option <span class="caret"></span></a>
                                            <ul class="dropdown-menu bullet dropdown-menu-right" aria-labelledby="examplePanelDropdown" role="menu">
                                                <li role="presentation"><a href="javascript:void(0)" role="menuitem"><i class="icon wb-reply" aria-hidden="true"></i> Reply</a></li>
                                                <li role="presentation"><a href="javascript:void(0)" role="menuitem"><i class="icon wb-share" aria-hidden="true"></i> Share</a></li>
                                                <li role="presentation"><a href="javascript:void(0)" role="menuitem"><i class="icon wb-trash" aria-hidden="true"></i> Delete</a></li>
                                                <li class="divider" role="presentation"></li>
                                                <li role="presentation"><a href="javascript:void(0)" role="menuitem"><i class="icon wb-settings" aria-hidden="true"></i> Settings</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-wrapper collapse in">
                                    <div class="panel-body">

                                        <form class="form-material form-horizontal">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label>Nom & prenom</label>
                                                    <input type="text" name="name" class="form-control form-control-line" value="{{$user->name}}" placeholder="nom et prenom"> </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label>Nom d'utilisateur</label>
                                                    <input type="text" class="form-control form-control-line" value="{{$user->username}}" name="username"> </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label>Role</label>
                                                    <select class="form-control" name="role" required> 
                                                        <option value="injecteur" {{$user->role == "injecteur"? 'selected':''}}>Injecteur</option>
                                                        <option value="caissiere" {{$user->role == "caissiere"? 'selected':''}}>Caissiere</option>
                                                        <option value="donneur" {{$user->role == "donneur"? 'selected':''}}>Donneur</option>
                                                        <option value="admin" {{$user->role == "admin"? 'selected':''}}>Admin</option>
                                                    </select>
                                                </div>
                                            </div>
                                         </form>  

                                    </div>
                                    <div class="panel-footer"> Panel Footer </div>
                                </div>
                            </div>
                        </div>
                    @endif
              @endforeach
            </div>
        </div>
    </div>

    <div class="panel panel-primary">
        <div class="panel-heading"> Injecteur
            <div class="pull-right"><a href="#" data-perform="panel-collapse"><i class="ti-minus"></i></a> <a href="#" data-perform="panel-dismiss"><i class="ti-close"></i></a> </div>
        </div>
        <div class="panel-wrapper collapse in" aria-expanded="true">
            <div class="panel-body">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum tincidunt est vitae ultrices accumsan. Aliquam ornare lacus adipiscing, posuere lectus et, fringilla augue.</p>
            </div>
        </div>
    </div>

    <div class="panel panel-primary">
        <div class="panel-heading"> Caissiere
            <div class="pull-right"><a href="#" data-perform="panel-collapse"><i class="ti-minus"></i></a> <a href="#" data-perform="panel-dismiss"><i class="ti-close"></i></a> </div>
        </div>
        <div class="panel-wrapper collapse in" aria-expanded="true">
            <div class="panel-body">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum tincidunt est vitae ultrices accumsan. Aliquam ornare lacus adipiscing, posuere lectus et, fringilla augue.</p>
            </div>
        </div>
    </div>

    <div class="panel panel-primary">
        <div class="panel-heading"> Donneur
            <div class="pull-right"><a href="#" data-perform="panel-collapse"><i class="ti-minus"></i></a> <a href="#" data-perform="panel-dismiss"><i class="ti-close"></i></a> </div>
        </div>
        <div class="panel-wrapper collapse in" aria-expanded="true">
            <div class="panel-body">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum tincidunt est vitae ultrices accumsan. Aliquam ornare lacus adipiscing, posuere lectus et, fringilla augue.</p>
            </div>
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
<script>

@endsection