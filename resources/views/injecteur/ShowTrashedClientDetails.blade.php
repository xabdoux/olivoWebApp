@extends('layouts.injecteurDashLayout')
@section('title')
<title>Client Details</title>
@endsection
@section('stylesheet')
<link href="{{ asset('ample/plugins/bower_components/sweetalert/sweetalert.css') }}" rel="stylesheet" type="text/css">
@endsection
@section('page_title')
<h4 class="page-title">Details de client</h4>
@endsection
@section('breadcrumb')
<li><a href="#">Dashboard</a></li>
<li class="active">Client Details</li>
@endsection

@section('content')
<div class="row clientDetails">
    <div class="col-md-12">
        <div class="white-box">
          <div class="row">

              <div class="col-xs-2">
                <i class="ti-user" style="font-size: 30px"></i>
              </div>
              <div class="col-xs-10" style="font-size: 25px">
                {{$client->name}}
              </div>

              <div class="col-xs-2">
                <i class="fa fa-phone" style="font-size: 30px"></i>
              </div>
              <div class="col-xs-10" style="font-size: 25px">
                {{$client->phone}}
              </div>
              
                  <div class="col-xs-2">
                    <i class=" icon-clock" style="font-size: 30px"></i>
                  </div>
                  <div class="col-xs-10" style="font-size: 25px">
                    {{$client->deleted_at}}
                  </div>
             
              
              
              <div class="col-xs-12 text-center m-t-10 m-b-10">
                
                <button type="button" class="btn btn-primary btn-circle btn-xl">{{$client->tour}} </button>
              </div>
              <div class="col-xs-12 m-b-10" style="border-top: 1px dashed ;"></div>

              <div class="table-responsive">
                  <table class="table color-table primary-table">
                      <thead>
                          <tr>
                              <th class="text-center" style="font-size: 22px">Sac</th>
                              <th class="text-center" style="font-size: 22px">Tonnage</th>
                          </tr>
                      </thead>
                      <tbody>
                        @php
                          $tonnage = 0;
                          $sac     = 0;
                        @endphp
                        @foreach ($client->produits as $produit)
                        @php
                          $tonnage += $produit->tonnage; 
                          $sac     += $produit->nombre_sac; 
                        @endphp
                          <tr>
                              <td class="text-center" style="font-size: 25px">{{$produit->nombre_sac}}</td>
                              <td class="text-center" style="font-size: 25px">{{$produit->tonnage}} Kg</td>
                          </tr>
                        @endforeach
                      </tbody>
                  </table>
              </div>
                  <div class="text-center" style="font-size: 30px">Total</div>
              <div class="table-responsive">
                  <table class="table color-table primary-table">
                      <tbody>
                        <tr class="info">
                            <td class="text-center" style="font-size: 25px">{{$sac}}</td>
                            <td class="text-center" style="font-size: 25px">{{$tonnage}} Kg</td>
                        </tr>
                      </tbody>
                  </table>
              </div>

              <div class="col-xs-4 text-center">
                
              </div>
              <div class="col-xs-4">
                <h3>Restorer</h3>
                
                <button data-toggle="modal" data-target=".{{$client->id}}" id="{{$client->id}}"class="btn btn-danger btn-circle btn-xl"><i class=" icon-share-alt"></i></button>
              </div> 
              <!-- sample modal content -->
                    <div class="modal fade {{$client->id}}" tabindex="1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: none;top: 30%;">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="mySmallModalLabel"><div data-icon="G" class="linea-icon linea-basic text-center text-danger"> êtes-vous sûr de vouloir restorer !<div></h4>
                            </div>
                            <div class="modal-body"> 
                                
                                <button data-dismiss="modal" class="btn btn-outline btn-default waves-effect waves-light "> <i class="fa fa-times"></i> 
                                    <span>Non, Annuler</span>
                                </button>
                              
                               
                                <a href="{{ url('restorerClient',$client->id) }}" class="btn btn-info waves-effect waves-light ">
                                    <span>Oui, Restorer</span> <i class="fa fa-check"></i>
                                </a>
                                
                            </div>
                        </div>
                        <!-- /.modal-content -->  
              <div class="col-xs-4">
                
              </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
@if(session()->has('storeData'))
<script src="{{ asset('ample/plugins/bower_components/sweetalert/sweetalert.min.js') }}"></script>
<script src="{{ asset('ample/plugins/bower_components/sweetalert/jquery.sweet-alert.custom.js') }}"></script>

    <script>
        swal('Success!', "{{session()->get('storeData')}}", 'success');
    </script>
@endif 
@endsection