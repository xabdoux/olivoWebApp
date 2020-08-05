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
        <div class="white-box p-t-10 ">
            <div class="table-responsive ">
                <table class="table color-table primary-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre clients</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                       @foreach ($clients as $client)
                       <tr>
                        <td>{{$clients->count() - $loop->index}}</td>
                        <td>{{$client->total}}</td>
                        @php
                            $date = \Carbon\Carbon::parse($client->counted_at)->format('YmdHis');
                        @endphp
                        <td>{{$client->counted_at}}</td>
                        <td><a href="{{ url('comptabilite-historique', $date) }}"><button class="btn btn-success btn-rounded">Afficher</button></a></td>
                      </tr>
                       @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')

@endsection