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
              <div class="col-xs-12">
                @if(count($alert))
               <!-- <div dir="rtl" class="alert alert-danger"> <i class="fa fa-warning"></i>&nbsp;&nbsp;يجب ابلاغ الزبون بأن سعر طحن الزيتون الأقل من 400kg هو 200 درهم   </div> -->
               <div class="alert alert-danger"> <i class="fa fa-warning"></i> Attention! les numeros suivants sont repetés:
                 <ul>
                    @foreach($alert as $num)
                        
                            <li>{{ $num->tour }}</li>
                       
                    @endforeach
                 </ul>
                </div>
            @endif
                @php $tonnageAlert = 0; @endphp
                @foreach ($client->produits as $produit)
                    @php
                      $tonnageAlert += $produit->tonnage; 
                    @endphp
                @endforeach
                @if ($tonnageAlert < 400)
                  <div dir="rtl" class="alert alert-warning"> <i class="fa fa-warning"></i>&nbsp;&nbsp;يجب ابلاغ الزبون بأن سعر طحن الزيتون الأقل من 400kg هو 200 درهم   </div>
                @endif
              </div>
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
                <h3>Modifier</h3>
                <button id="modifier" type="button" class="btn btn-primary btn-circle btn-xl"><i class="fa fa-pencil-square-o"></i> </button>
              </div>
              <div class="col-xs-4">
                <h3>Imprimer</h3>
                <button type="button" class="btn btn-success btn-circle btn-xl" onclick='ajax_print("{{ url('printInvoice', $client->id) }}")'><i class="fa fa-print"></i></button>
              </div>   
              <div class="col-xs-4">
                <h3>Ajouter</h3>
                <a href="{{ url('ajouter-client') }}"> <button type="button" class="btn btn-info btn-circle btn-xl"><i class="fa fa-plus"></i></button></a>
              </div>
            </div>
        </div>
    </div>
</div>
<div class="row modifyDetails" style="display: none">
          <form class="m-b-20 " method="post" action="{{ url('modifyData',$client->id) }}">
            @csrf
              <h3 class="text-center m-t-0">Info Personnel</h3>
            <div class="col-xs-12">
                <div class="form-group m-b-20">
                    <div class="input-group">
                        <input type="text" name="name" class="form-control" id="exampleInputuname" placeholder="Nom et Premon" value="{{$client->name}}" style="height: 46px; font-size: 25px;">
                        <div class="input-group-addon"><i class="ti-user"></i></div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <input type="tel" name="phone" class="form-control" id="exampleInputphone" placeholder="Numero de telephone" value="{{$client->phone}}" style="height: 46px; font-size: 25px;"> 
                        <div class="input-group-addon"><i class="ti-mobile"></i></div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <input list="zones" name="zone" class="form-control" id="exampleInputphone" placeholder="zone" style="height: 46px; font-size: 25px;" value="{{$client->zone_id? $client->zone->name:''}}">
                        <datalist id="zones">
                          @foreach ($zones as $zone)
                            <option value="{{$zone->name}}">
                          @endforeach
                        </datalist> 
                        <div class="input-group-addon"><i class="fa  fa-map-marker"></i></div>
                    </div>
                </div>
                <div class="form-group col-xs-6 col-xs-push-3">
                    <div class="input-group">
                       <div class="input-group-addon"><i class="icon-people"></i></div>
                        <input type="tel" name="tour" class="form-control" id="exampleInputphone" placeholder="Tour" value="{{$client->tour}}" style="height: 46px; font-size: 25px;"> 
                    </div>
                </div>
            </div>
            <div class="col-xs-12">
              <div class="col-xs-8 col-xs-push-2 m-b-20"  style="border-top: 1px solid;"></div>
            </div>
             <h3 class="text-center" style="border-bottom: 1px solid">Information Produit</h3>
             <div id="formContainer">
                <div class="col-xs-4">
                  <h3>Sac</h3>
                </div>
                <div class="col-xs-6">
                  <h3>Poids</h3>
                </div>
                
                @foreach ($client->produits as $key => $produit)
                <div class="col-xs-12">
                    <div class="col-xs-4" >
                      <div class="form-group">
                        <div class="input-group">
                            <input type="tel" name="nombre_sac[]" class="form-control sac" id="exampleInputphone" placeholder="" value="{{$produit->nombre_sac}}" style="height: 46px; font-size: 25px;"> 
                            {{-- <div class="input-group-addon"><i class="ti-mobile"></i></div> --}}
                        </div>
                      </div>
                    </div>
                    <div class="col-xs-6">
                      <div class="form-group">
                            <div class="input-group">
                                <input type="tel" name="tonnage[]" class="form-control tonnage" id="exampleInputphone" placeholder="" value="{{$produit->tonnage}}" style="height: 46px; font-size: 25px;"> 
                                <div class="input-group-addon" style="font-size: 20px;">Kg</div>
                            </div>
                        </div>
                    </div> 
                    @if ($key > 0)
                  <div class="col-xs-2 text-center" style="padding: 0px;">
                   <div class="form-group">
                    <div class="input-group m-t-5">
                      <button type="button" class="btn btn-danger btn-circle" id="remove"><i class="fa fa-times"></i> </button>
                    </div>
                     </div>
                   </div>
                @endif   
                </div>

                @endforeach
            </div>   
            <div class="col-xs-12 m-b-40">
              
                <div class="col-xs-4 col-xs-push-4">
                  <button id="add" type="button" class="btn btn-success btn-circle btn-lg"><i class="fa fa-plus"></i> </button>
                </div>
            </div>
            <div class="col-xs-12">
              <div class="col-xs-8 col-xs-push-2 m-b-20"  style="border-top: 1px solid"></div>
            </div>

            <div class="col-md-12" id="toucheTotal">
              <div class="col-xs-3">
                <h3>Total:</h3>
              </div>
              <div class="col-xs-4">
                <h3 id="totalSac"></h3>
              </div>
              <div class="col-xs-5">
                <h3 id="totalTonnage"></h3>
              </div>

              
            </div>
              
              <div class="text-right">
                <div class="col-xs-12 m-b-40 m-t-40"> 
                  <button type="submit" class="btn btn-success waves-effect waves-light m-r-10" style="font-size: 25px;">Envoyer</button>
                  <a id="backToDetails" class="btn btn-inverse waves-effect waves-light" style="float:left;
                  font-size: 25px;"><i class="fa fa-arrow-left"></i></a>
              </div>
            </div>  
          </form>
</div>
@endsection
@section('script')
<script type="text/javascript">
  function ajax_print(url){
   $.get(url,function(data){
    var S = "#Intent;scheme=rawbt;";
    var P = "package=ru.a402d.rawbtprinter;end;";
    window.location.href="intent:"+data+S+P;
   })
  }
</script>
<script type="text/javascript">
    $( function () {
      $("#warning").hide();
      // variables 
      var html='<div class="col-xs-12" id="test"><div class="col-xs-4"><div class="form-group"><div class="input-group"><input type="tel" name="nombre_sac[]" class="form-control sac" id="exampleInputphone" placeholder="" style="height: 46px; font-size: 25px;"> {{-- <div class="input-group-addon"><i class="ti-mobile"></i></div> --}}</div> </div> </div>  <div class="col-xs-6"> <div class="form-group"> <div class="input-group"><input type="tel" name="tonnage[]" class="form-control tonnage" id="exampleInputphone" placeholder="" style="height: 46px; font-size: 25px;"> <div class="input-group-addon" style="font-size: 20px;">Kg</div> </div> </div></div><div class="col-xs-2 text-center" style="padding: 0px;"> <div class="form-group"><div class="input-group m-t-5"><button type="button" class="btn btn-danger btn-circle" id="remove"><i class="fa fa-times"></i> </button></div> </div></div></div>';
      var MaxRows = 5;
      var x = 1;

      //Add rows to the forms 
      $('#add').click(function (e) {
       
        if (x <= 5) {

          $('#formContainer').append(html);
          x++;
        }else{
          $("#warning").show();
          $("#warning").css("color","#F00");
        }
      });

      //remove rows from the forms 
      $("#formContainer").on('click', '#remove', function (e){

        $(this).parent().parent().parent().parent().remove(); 
        x--;
        if (x <= 5) {
          $("#warning").hide();
        }

        var count = 0;
        $('.tonnage').each(function (index) {
          count += parseInt($(this).val());
        });
        count += ' Kg';
        $('#totalTonnage').html(count);

        var countSac = 0;
        $('.sac').each(function (index) {
          countSac += parseInt($(this).val());
        });
        countSac += ' Sac';
        $('#totalSac').html(countSac);
      }); 

      $(document).on('keyup','.tonnage', function(){
        var count = 0;
        $('.tonnage').each(function (index) {
          count += parseInt($(this).val());
        });
        count += ' Kg';
        $('#totalTonnage').html(count);
      }); 

      $(document).on('keyup','.sac', function(){
        var countSac = 0;
        $('.sac').each(function (index) {
          countSac += parseInt($(this).val());
        });
        countSac += ' Sac';
        $('#totalSac').html(countSac);
      }); 

      
      //touche Total and see the result of total sac
      var countSac = 0;
        $('.sac').each(function (index) {
          countSac += parseInt($(this).val());
        });
        countSac += ' Sac';
        $('#totalSac').html(countSac);
        //touche Total and see the result of total tonnage

        var count = 0;
        $('.tonnage').each(function (index) {
          count += parseInt($(this).val());
        });
        count += ' Kg';
        $('#totalTonnage').html(count);


      //populate value from the first row

      $("#modifier").click(function () {
       $('.clientDetails').fadeOut();
       $('.modifyDetails').fadeIn();

    });
    $("#backToDetails").click(function () {
       $('.clientDetails').fadeIn();
       $('.modifyDetails').fadeOut();

    });
      
    });
  </script>
  

@if(session()->has('storeData'))
<script src="{{ asset('ample/plugins/bower_components/sweetalert/sweetalert.min.js') }}"></script>
<script src="{{ asset('ample/plugins/bower_components/sweetalert/jquery.sweet-alert.custom.js') }}"></script>

    <script>
        swal('Success!', "{{session()->get('storeData')}}", 'success');
    </script>
@endif 
@endsection