@extends('layouts.donneurDashLayout')
@section('title')
<title>List des clients</title>
@endsection
@section('stylesheet')
<link href="{{ asset('ample/plugins/bower_components/sweetalert/sweetalert.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('ample/plugins/bower_components/datatables/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('page_title')
<h4 class="page-title">List des clients</h4>
@endsection
@section('breadcrumb')
<li><a href="#">Dashboard</a></li>
<li class="active">List des clients</li>
@endsection

@section('content')
<style type="text/css">
  .dataTables_filter input {
    width: 100%;
    height: 39px;
    font-size: 20px;


 }
</style>
<div class="table-responsive">
    <table id="myTable" class="table table-striped" style="font-size: 20px">
        <thead>
            <tr>
                <th>#Tour</th>
                <th>Nom</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
          @foreach ($clients as $client)
            <tr >
                <td>{{$client->tour}}</td>
                <td>{{$client->name}}</td>
                <td>
                  <div class="row">
                    <div class="col-xs-6">
                     <a href="{{ url('clientDetails', $client->id) }}"> <i class="fa fa-info-circle" style="font-size: 30px;color: #0082BA"></i></a>
                    </div>
                    <div class="col-xs-6">
                      {{-- <i class="fa fa-trash-o" style="font-size: 30px; color: red"></i> --}}
                      <!-- <a href="#" data-toggle="modal" data-target=".{{$client->id}}" id="{{$client->id}}">
                                    <i class="fa fa-sign-out" style="font-size: 30px; color: #5867a7"></i>
                                </a> -->
                    </div>
                  </div>
                </td>

                 <!-- sample modal content -->
                    <div class="modal fade {{$client->id}}" tabindex="1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: none;top: 30%;">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="mySmallModalLabel"><div data-icon="G" class="linea-icon linea-basic text-center text-primary"> هل سيتم إخراج الزيت للزبون  <div></h4>
                            </div>
                            <div class="modal-body"> 
                                
                                <button data-dismiss="modal" class="btn btn-outline btn-default waves-effect waves-light "> <i class="fa fa-times"></i> 
                                    <span>لا , إلغاء </span>
                                </button>
                              
                               
                               <div class="pull-right"><a  href="{{ url('productGone/'.$client->id) }}" class="btn btn-info waves-effect waves-light ">
                                    <span>نعم  , إستمر</span> <i class="fa fa-check"></i>
                                </a></div>
                                
                            </div>
                        </div>
                        <!-- /.modal-content -->
            </tr>
          @endforeach
            
        </tbody>
    </table>
</div>
@endsection
@section('script')
<script src="{{ asset('ample/plugins/bower_components/datatables/jquery.dataTables.min.js') }}"></script>
    <!-- start - This is for export functionality only -->
    <script src="{{ url('https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js') }}"></script>
<script>
        $(document).ready(function () {
            $('#myTable').DataTable({
              "order": [[2, 'desc']]
              , "displayLength": 25,
            });

            
            $(document).ready(function () {
                var table = $('#example').DataTable({
                    "columnDefs": [
                        {
                            "visible": false
                            , "targets": 2
                        }
          ]
                    , "order": [[1, 'desc']]
                    , "displayLength": 25
                    , "drawCallback": function (settings) {
                        var api = this.api();
                        var rows = api.rows({
                            page: 'current'
                        }).nodes();
                        var last = null;
                        api.column(2, {
                            page: 'current'
                        }).data().each(function (group, i) {
                            if (last !== group) {
                                $(rows).eq(i).before('<tr class="group"><td colspan="5">' + group + '</td></tr>');
                                last = group;
                            }
                        });
                    }
                });
            
            });
        });
        
    </script>
  
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
        swal('إنذار !', "{{session()->get('error')}}", 'error');
    </script>
@endif 

@endsection