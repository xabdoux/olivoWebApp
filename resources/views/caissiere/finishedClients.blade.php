@extends('layouts.caissiereDashLayout')
@section('title')
<title>Welcome to Dashboard</title>
@endsection
@section('stylesheet')
    <link href="{{ asset('ample/plugins/bower_components/datatables/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css" />
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
<style type="text/css">
    tfoot {
    display: table-header-group;
}

    #myTable_length{
        display: none;
    }
    #myTable_filter{
        display: none;
    }
</style>
<div class="row">
    <div class="col-lg-12">
        <div class="white-box p-t-0">
            <button id="btnReload">rafrechir</button>
            <div id="result"></div>
            <div class="table-responsive">
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
                    <tbody>

                        @foreach ($clients as $client)
                        <tr>
                            <td>{{$client->id}}</td>
                            <td>{{$client->name}}</td>
                            <td>{{$client->tour}}</td>
                            <td class="text-center">{!!$client->payed_at ? "<span class='label label-success label-rounded'>Payé</span>":"<span class='label label-warning label-rounded'>En Attente</span>" !!}</td>
                            <td class="text-center">
                                <a href="{{ url('profileClient',$client->id) }}" class="m-r-20"><button type="button" class="btn btn-info btn-circle"><i class="fa  fa-user"></i> </button></a>
                                @if ($client->payed_at)
                                    {{-- <button type="button" class="btn btn-danger btn-circle"><i class="fa   fa-repeat"></i> </button> --}}

                                    <a href="#" data-toggle="modal" data-target=".{{$client->id}}" id="{{$client->id}}" class="btn btn-danger btn-circle">
                                    <i class="fa fa-repeat" color: #5867a7"></i>
                                </a>



                                <!-- sample modal content -->
                    <div class="modal fade {{$client->id}}" tabindex="1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: none;top: 30%;">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="mySmallModalLabel"><div data-icon="G" class="linea-icon linea-basic text-center text-primary"> الزبون لم يخرج الزيت بعد  <div></h4>
                            </div>
                            <div class="modal-body"> 
                                
                                <button data-dismiss="modal" class="btn btn-outline btn-default waves-effect waves-light "> <i class="fa fa-times"></i> 
                                    <span>لا , إلغاء </span>
                                </button>
                              
                               
                               <div class="pull-right"><a  href="{{ url('productOutCanceled/'.$client->id) }}" class="btn btn-info waves-effect waves-light ">
                                    <span>نعم  , تأكيد </span> <i class="fa fa-check"></i>
                                </a></div>
                                
                            </div>
                        </div>
                        <!-- /.modal-content -->
                                    
                                @else
                                    <a href="{{ url('proceedToPayment',$client->id) }}"><button type="button" class="btn btn-default btn-circle"><i class="fa  fa-money"></i> </button></a>
                                @endif
                                
                            </td>
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
<script>

        
        $(document).ready(function() {

    // Setup - add a text input to each footer cell
    var x = 1;
    $('#myTable tfoot th').each( function () {
        var title = $(this).text();
        if (x == 5) {
            $(this).html( '<input type="hidden" placeholder="" />' );
        }else{
            $(this).html( '<input type="text" placeholder="" />' );
        }
        x++;
    } );

    // DataTable
    var table = $('#myTable').DataTable({

        "order": [[4, 'desc']]
              , "displayLength": 15,

    });

    // Apply the search
    table.columns().every( function () {
        var that = this;
 
        $( 'input', this.footer() ).on( 'keyup change', function () {
            if ( that.search() !== this.value ) {
                that
                    .search( this.value )
                    .draw();
            }
        } );
    } );
 
} );
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