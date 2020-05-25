@extends('layouts.adminDashLayout')
@section('title')
<title>Welcome to Dashboard</title>
@endsection
@section('stylesheet')
    <link href="{{ asset('ample/plugins/bower_components/datatables/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css" />
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
@endsection