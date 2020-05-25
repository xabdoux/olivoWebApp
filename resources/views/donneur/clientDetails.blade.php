@extends('layouts.donneurDashLayout')
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
                    <i class="fa fa-map-marker" style="font-size: 30px"></i>
                  </div>
                  <div class="col-xs-10" style="font-size: 25px">
                    @if ($client->zone_id)
                    {{$client->zone->name}}
                    @else
                      ---                    
                    @endif
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
                              <th class="text-center" style="font-size: 22px">Poids</th>
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
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
@endsection