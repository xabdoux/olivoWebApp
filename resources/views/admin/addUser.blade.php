@extends('layouts.adminDashLayout')
@section('title')
<title>Welcome to Dashboard</title>
@endsection
@section('stylesheet')
<link href="{{ asset('ample/plugins/bower_components/sweetalert/sweetalert.css') }}" rel="stylesheet" type="text/css">
@endsection
@section('page_title')
<h4 class="page-title">Gestion utilisateur</h4>
@endsection
@section('breadcrumb')
<li><a href="#">Dashboard</a></li>
<li class="active">Gestion utilisateur</li>
@endsection
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-inverse">
            <div class="panel-heading"><i class="icon-badge"> </i> Ajouter utilisateur
                <div class="pull-right"><a href="#" data-perform="panel-collapse"><i class="ti-minus"></i></a> <a href="#"></i></a> </div>
            </div>
        <div class="panel-wrapper collapse in" aria-expanded="true">
                <div class="panel-body">

                    <form method="POST" action="{{ url('addUser') }}" data-toggle="validator">
                        @csrf
                        <div class="col-xs-12">


                            <div class="form-group {{$errors->has('name') ? 'has-error':''}} col-xs-4">
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
                            <div class="form-group {{$errors->has('username') ? 'has-error':''}} col-xs-4">
                                <label for="exampleInputEmail1">Nom d'utilisateur</label>
                                <input type="text" name="username" class="form-control" id="exampleInputEmail1" placeholder="Nom d'utilisateur" value="{{old('username')}}" required>
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
                            <div class="form-group {{$errors->has('role') ? 'has-error':''}} col-xs-4">
                                <label>Role</label>
                                <select class="form-control" name="role" required>
                                    <option value=""></option>
                                    <option value="injecteur" {{old('role')=='injecteur'?'selected':''}}>Responsable clientèle</option>
                                    <option value="caissiere" {{old('role')=='caissiere'?'selected':''}}>Caissier</option>
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
                        </div>
                        <div class="col-xs-12">


                            <div class="form-group {{$errors->has('password') ? 'has-error':''}} col-xs-6">
                                <label for="exampleInputPassword1">Mot de passe</label>
                                <input type="password" name="password" value="{{old('password')}}" class="form-control" placeholder="Password" data-toggle="validator" data-minlength="6" id="inputPassword" required>
                                <p class="text-muted">Choisir un mot de passe de 6 nombres <span dir="rtl" style="float: right"> يجب أن تتكون كلمة السر من 6 أرقام</span></p>
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
                            <div class="form-group col-xs-6">
                                <label for="exampleInputPassword1">Confirmer Mdp</label>
                                <input type="password" name="password_confirmation" class="form-control" id="inputPasswordConfirm" data-match="#inputPassword" data-match-error="عفوًا ، هذه لا تتطابق" placeholder="Confirm" required>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Submit</button>
                        <button type="submit" class="btn btn-inverse waves-effect waves-light">Cancel</button>
                    </form>


                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="panel">
                <div class="panel-heading">GESTION D'UTILISATEUR</div>
                <div class="table-responsive">
                    <table class="table table-hover manage-u-table">
                        <thead>
                            <tr>
                                <th class="text-center">Nom et Prenom</th>
                                <th class="text-center">Nom d'utilisateur</th>
                                <th class="text-center">Role</th>
                                <th class="text-center">MANAGE</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <td class="text-center">
                                    <span class="font-medium">{{$user->name}}</span>
                                </td>
                                <td class="text-center">
                                    {{$user->username}}
                                </td>
                                <td class="text-center">
                                    {{$user->role}}
                                </td>
                                <td class="text-center">
                                   <a href="{{ url('deleteUser', [$user->id]) }}"> <button type="button" class="btn btn-info btn-outline btn-circle btn-lg m-r-5"><i class="icon-trash"></i></button></a>
                                <button type="button" class="btn btn-info btn-outline btn-circle btn-lg m-r-5" data-toggle="modal" data-target="#{{$user->id}}"><i class="ti-pencil-alt"></i></button>
                                </td>
                            </tr>
                            <div class="modal fade" id="{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="exampleModalLabel1">Modifier {{$user->name}}</h4> </div>
                                        <div class="modal-body">
                                            <form method="POST" action="{{ url('updateUser', $user->id) }}" data-toggle="validator">
                                                @csrf
                                                <div class="col-xs-12">
                                                    <div class="form-group {{$errors->has('name') ? 'has-error':''}} col-xs-4">
                                                        <label for="exampleInputEmail1">Nom et Prenom</label>
                                                        <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="nom et prenom" value="{{$user->name}}" required>
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
                                                    <div class="form-group {{$errors->has('username') ? 'has-error':''}} col-xs-4">
                                                        <label for="exampleInputEmail1">Nom d'utilisateur</label>
                                                        <input type="text" name="username" class="form-control" id="exampleInputEmail1" placeholder="Nom d'utilisateur" value="{{$user->username}}" required>
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
                                                    <div class="form-group {{$errors->has('role') ? 'has-error':''}} col-xs-4">
                                                        <label>Role</label>
                                                        <select class="form-control" name="role" required>
                                                            <option value=""></option>
                                                            <option value="injecteur" {{$user->role=='injecteur'?'selected':''}}>Injecteur</option>
                                                            <option value="caissiere" {{$user->role=='caissiere'?'selected':''}}>Caissiere</option>
                                                            <option value="donneur" {{$user->role=='donneur'?'selected':''}}>Donneur</option>
                                                            <option value="admin" {{$user->role=='admin'?'selected':''}}>Admin</option>
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
                                                </div>
                                                <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Envoyer</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            
                        </tbody>
                    </table>
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