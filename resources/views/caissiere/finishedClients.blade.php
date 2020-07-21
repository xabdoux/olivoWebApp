@extends('layouts.caissiereDashLayout')
@section('title')
<title>Welcome to Dashboard</title>
@endsection
@section('stylesheet')
<link href="{{ asset('ample/plugins/bower_components/datatables/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('ample/plugins/bower_components/sweetalert/sweetalert.css') }}" rel="stylesheet" type="text/css">
@endsection
@section('page_title')
<h4 class="page-title">Clients Termines</h4>
@endsection
@section('breadcrumb')
<li><a href="#">Dashboard</a></li>
<li class="active">Clients Termines</li>
@endsection
@section('content')
<style type="text/css">
    tfoot {
        display: table-header-group;
    }

    #myTable_length {
        display: none;
    }

    #myTable_filter {
        display: none;
    }
</style>
<div class="row">
    <div class="col-lg-12">
        <div class="white-box p-t-0">
            {{-- <button id="btnReload">rafrechir</button> --}}
            <div id="result"></div>
            <div class="table-responsive">
                <div class="col-xs-12 m-t-20 m-b-20">
                    <div class="col-xs-4">
                        <div class="col-xs-8">
                            <button id="reloadTableLifeTime" class="btn btn-block btn-outline btn-rounded btn-info">Tous les jours <i class="fa fa-refresh"></i></button>
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <div class="col-xs-8">
                            <button id="reloadTable30" class="btn btn-block btn-outline btn-rounded btn-info">30 days <i class="fa fa-refresh"></i></button>
                        </div>

                    </div>
                    <div class="col-xs-4">
                        <div class="col-xs-8">
                            <button id="reloadTable14" class="btn btn-block btn-info btn-outline btn-rounded"> 14 Days <i class="fa fa-refresh"></i></button>
                        </div>
                    </div>
                </div>
                <table id="myTable" class="table table-striped display" style="width:100%">

                    <thead>
                        <tr>
                            <th style="">#ID</th>
                            <th>Nom</th>
                            <th>Tour</th>
                            <th>Statut</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#ID</th>
                            <th>Nom</th>
                            <th>Tour</th>
                            <th>Statut</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    {{-- <tbody>

                        @foreach ($clients as $client)
                        <tr>
                            <td>{{$client->id}}</td>
                    <td>{{$client->name}}</td>
                    <td>{{$client->tour}}</td>
                    <td class="text-center">{!!$client->payed_at ? "<span class='label label-success label-rounded'>Payé</span>":"<span class='label label-warning label-rounded'>En Attente</span>" !!}</td>
                    <td class="text-center">
                        <a href="{{ url('profileClient',$client->id) }}" class="m-r-20"><button type="button" class="btn btn-info btn-circle"><i class="fa  fa-user"></i> </button></a>
                        <a href="{{ url('productOutCanceled',$client->id) }}" class="btn btn-danger btn-circle">
                            <i class="fa fa-repeat"></i>
                        </a>
                    </td>
                    </tr>
                    @endforeach
                    </tbody> --}}
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function() {

        // Setup - add a text input to each footer cell
        var x = 1;
        $('#myTable tfoot th').each(function() {
            var title = $(this).text();
            if (x == 5) {
                $(this).html('<input type="hidden" placeholder="" />');
            } else {
                $(this).html('<input type="text" placeholder="" />');
            }
            x++;
        });

        // DataTable
        var table = $('#myTable').DataTable({

            "ajax": "{{ url('getFinishedData',14) }}",
            "dataSrc": '',
            "columns": [{
                    "data": 'id'
                },
                {
                    "data": 'name'
                },
                {
                    "data": 'tour'
                },
                {
                    "data": 'payed_at',
                    "render": function(payed_at) {
                        var isPayed;
                        if (payed_at) {
                            isPayed = '<span class="label label-success label-rounded">Payé</span>';
                        } else {
                            isPayed = '<span class="label label-warning label-rounded">En Attente</span>';
                        }
                        return isPayed;
                    }

                },
                {
                    "data": 'id',
                    "render": function(id, type, row) {
                        return '<a href="/profileClient/' + id + '" class="m-r-20"><button type="button" class="btn btn-info btn-circle"><i class="fa  fa-user"></i> </button></a>' + '<a href="/productOutCanceled/' + id + '" class="btn btn-danger btn-circle"><i class="fa fa-repeat"></i></a>';

                    }

                }
            ],

            "order": [
                [4, 'desc']
            ],
            "displayLength": 15,

        });
        $("#reloadTable14").click(function() {
            table.ajax.url("{{ url('getFinishedData',14) }}").load();
        });

        $("#reloadTable30").click(function() {
            table.ajax.url("{{ url('getFinishedData',30) }}").load();
        });

        $("#reloadTableLifeTime").click(function() {
            table.ajax.url("{{ url('getFinishedData','lifetime') }}").load();
        });


        // Apply the search
        table.columns().every(function() {
            var that = this;

            $('input', this.footer()).on('keyup change', function() {
                if (that.search() !== this.value) {
                    that
                        .search(this.value)
                        .draw();
                }
            });
        });

    });
</script>
<script src="{{ asset('ample/plugins/bower_components/datatables/jquery.dataTables.min.js') }}"></script>
@if(session()->has('success'))
<script src="{{ asset('ample/plugins/bower_components/sweetalert/sweetalert.min.js') }}"></script>
<script src="{{ asset('ample/plugins/bower_components/sweetalert/jquery.sweet-alert.custom.js') }}"></script>

<script>
    swal('Success!', "{{session()->get('success')}}", 'success');
</script>
@endif
@endsection