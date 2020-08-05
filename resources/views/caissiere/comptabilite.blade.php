@extends('layouts.caissiereDashLayout')
@section('title')
<title>Comptabilite</title>
@endsection
@section('stylesheet')
<link href="{{ asset('ample/plugins/bower_components/datatables/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('page_title')
<h4 class="page-title">CLIENTS</h4>
@endsection
@section('breadcrumb')
<li><a href="#">Dashboard</a></li>
<li class="active">List des clients</li>
@endsection
@section('content')
<style>
    @media print {
       .noprint {
          visibility: hidden;
       }
    }
</style>
<div class="row">
    <div class="col-lg-12">
        <div class="white-box p-t-0">
            <div class="row">
                <div class="col-xs-6 m-t-20">
                    {{Carbon\Carbon::now()}}
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nom & Prenom</th>
                            <th>Numero Tel</th>
                            <th>Tour</th>
                            <th>Poids Total</th>
                            <th>Prix à payer</th>
                        </tr>
                    </thead>
                    <tbody>
                       
                        @foreach ($clients as $client)
                      @php
                         $poids = 0;
                         foreach ($client->produits as $produit) {
                             $poids += $produit->tonnage;
                         }
                      @endphp
                        <tr>
                            <td>{{ $client->id }}</td>
                            <td>{{$client->name}} </td>
                            <td>{{$client->phone}}</td>
                            <td>{{$client->tour}} </td>
                            <td> {{$poids}} Kg</td>
                            <td>  {{$poids <= 400 ? "200": $poids/2 }} Dh</td>
                        </tr>

                        @endforeach
                       
                    </tbody>
                </table>
                <hr>
                @if ($clients->isEmpty())
                <div class="text-center">
                    Aucune données
                </div>
               @endif
            </div>
            
            <div class="col-xs-4 text-center">
                <p style="font-size:16px ">Total Clients {{$clients->count()}}</p>
            </div>
            <div class="col-xs-4 text-center">
                <p style="font-size:16px ">Total Poids {{$totalPoids}} Kg</p>
            </div>
            <div class="col-xs-4 text-center">
                <p style="font-size:16px ">Total Revenue {{$totalPrix}} Dh</p>
            </div>
        </div>
            <div class="col-lg-2 col-sm-4 col-xs-12 noprint">
               <a href="{{ url('archiver') }}"> <button class="btn btn-block btn-info">Archiver</button></a>
            </div>
            <div class="col-lg-2 col-sm-4 col-xs-12 noprint">
                 <button onclick="window.print()" class="btn btn-block btn-success">Imprimer</button>
             </div>
    </div>
</div>
@endsection
@section('script')

@endsection