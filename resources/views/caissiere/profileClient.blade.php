@extends('layouts.caissiereDashLayout')
@section('title')
<title>Profile | {{ucwords($client->name)}}</title>
@endsection
@section('stylesheet')
<link href="{{ asset('ample/css/printedStyle.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('ample/plugins/bower_components/switchery/dist/switchery.min.css') }}" rel="stylesheet" />
<link href="{{ asset('ample/plugins/bower_components/toast-master/css/jquery.toast.css') }}" rel="stylesheet" />

@endsection
@section('page_title')
<h4 class="page-title">Profile de {{ucwords($client->name)}}</h4>
@endsection
@section('breadcrumb')
<li><a href="#">Dashboard</a></li>
<li class="active">Page de Profile</li>
@endsection
@section('content')

<div class="row">
    <div class="col-md-6 col-sm-12 col-lg-4">
        <div class="panel">
            <span class="pull-right m-l-5" id="changeLang"> <input type="checkbox" class="js-switch" data-color="#f96262" data-secondary-color="#99d683" /></span>
            <span class="pull-right">
                <a id='arBtn' href="javascript:void(0)" class="btn btn-rounded btn-success">Ar</a>
                <a id='frBtn' href="javascript:void(0)" class="btn btn-rounded btn-danger" style="display: none;">Fr</a>
            </span>

            <div class="p-30">
                <div class="row">
                    {{-- <div class="col-xs-4"><img src="{{ asset('ample/plugins/images/users/oldAvatar.png') }}" alt="varun" class="img-circle img-responsive"></div> --}}
                <div class="col-xs-12 text-center">
                    <h2 class="m-b-5">{{ucwords($client->name)}}</h2>
                    <h4 class="m-t-5"><i class="fa fa-phone"></i> {{$client->phone}}</h4>

                    @if ($client->zone_id)
                    <h4 class="m-t-5"><i class="fa fa-map-marker"></i> {{$client->zone->name}}</h4>
                    @else
                    <h4 class="m-t-5"><i class="fa fa-map-marker"></i> ---</h4>
                    @endif
                    <a href="javascript:void(0)" class="btn btn-rounded btn-success tooltip-primary" data-toggle="tooltip" data-placement="bottom" title data-original-title="Tour"><i class="fa fa-users"></i> {{ucwords($client->tour)}}</a>
                    <a href="javascript:void(0)" class="btn btn-rounded btn-info tooltip-primary" data-toggle="tooltip" data-placement="bottom" title data-original-title="ID"><i class="fa fa-hashtag"></i> {{ucwords($client->id)}}</a>
                </div>
            </div>
            <div class="row text-center m-t-30">
                <div class="col-xs-4 b-r">
                    <h2>{{$Cnt = count($client->produits)}}</h2>
                    <h4>PALETE{{$Cnt>1 ?'S':''}}</h4>
                </div>
                <div class="col-xs-4 b-r">
                    @php
                    $sac = 0;
                    foreach ($client->produits as $produit) {
                    $sac += $produit->nombre_sac;
                    }
                    @endphp
                    <h2>{{$sac}}</h2>
                    <h4>SAC</h4>
                </div>
                <div class="col-xs-4">
                    @php
                    $tng = 0;
                    foreach ($client->produits as $produit) {
                    $tng += $produit->tonnage;
                    }
                    @endphp
                    <h2>{{$tng}}</h2>
                    <h4>Kg</h4>
                </div>
            </div>
        </div>
        <hr class="m-t-0">
        <div class="col-lg-12" style="float: none">
            <div class="white-box">
                <h3 class="box-title m-b-30">ACTIVITÉ CLIENT</h3>
                <div class="steamline">
                    <div class="sl-item">
                        <div class="sl-left bg-success"> <i class="ti-user"></i></div>
                        <div class="sl-right">
                            <div style="margin-bottom: 6px">
                                <h3> L'entrer du client</h3>
                            </div>
                            <div class="desc">
                                <i class="fa fa-calendar" style="font-size: 15px"></i>
                                {{$client->created_at->format('d/m/Y')}}
                                <br>
                                <i class="fa  fa-clock-o" style="font-size: 15px"></i>
                                {{date('H:i:s',strtotime('+1 hour',strtotime($client->created_at->format('H:i:s'))))}}
                            </div>
                            <div class="desc">

                            </div>
                        </div>
                    </div>
                    <div class="sl-item">
                        <div class="sl-left bg-info"><i class="fa fa-money"></i></div>
                        <div class="sl-right">
                            <div style="margin-bottom: 6px">
                                <h3>Date de paiement</h3>
                            </div>
                            @if ($client->payed_by)
                            <div class="desc">
                                <i class="fa fa-calendar" style="font-size: 15px"></i>
                                {{$client->payed_at->format('d/m/Y')}}
                                <br>
                                <i class="fa  fa-clock-o" style="font-size: 15px"></i>
                                {{date('H:i:s',strtotime('+1 hour',strtotime($client->payed_at->format('H:i:s'))))}}
                            </div>
                            @if (!$client->served_by)
                            <div class="row inline-photos">
                                <div class="col-xs-10"><a href="{{ url('paymentCanceled',$client->id) }}"><button class="btn btn-block btn-outline btn-rounded btn-danger"><i class="fa fa-rotate-left "></i> Annuler paiement</button></a></div>
                            </div>
                            @endif
                            @else
                            <div class="desc">
                                <p>Le client pas encore payer sa facture</p>
                                <div class="row inline-photos">
                                    <div class="col-xs-10"><a href="{{ url('proceedToPayment',$client->id) }}"><button class="btn btn-block btn-outline btn-rounded btn-info"> Payer maintenant</button></a></div>
                                </div>
                            </div>
                            @endif

                        </div>
                    </div>
                    @if ($client->payed_at)
                    <div class="sl-item">
                        <div class="sl-left bg-primary"><i class="fa fa-sign-out"></i></div>
                        <div class="sl-right">
                            <div style="margin-bottom: 6px">
                                <h3>Date de sortie</h3>
                            </div>
                            @if ($client->served_by)
                            <div class="desc">
                                <i class="fa fa-calendar" style="font-size: 15px"></i>
                                {{$client->served_at->format('d/m/Y')}}
                                <br>
                                <i class="fa  fa-clock-o" style="font-size: 15px"></i>
                                {{date('H:i:s',strtotime('+1 hour',strtotime($client->served_at->format('H:i:s'))))}}
                            </div>
                            <div class="row inline-photos">
                                <div class="col-xs-10"><a href="{{ url('productOutCanceled/'.$client->id) }}"><button class="btn btn-block btn-outline btn-rounded btn-danger"><i class="fa fa-rotate-left"></i> Annuler</button></a></div>
                            </div>
                            @else
                            <div class="desc">
                                <p>Le client n'a pas encore reçu le produit</p>
                                <div class="row inline-photos">
                                    <div class="col-xs-10"><a href="{{ url('productOut',$client->id) }}"><button class="btn btn-block btn-outline btn-rounded btn-info"> Service reçu</button></a></div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-8">
    <div class="white-box" id="printableArea" style="display: none;">
        <div class="printableArea">
            <h3 id="facturePrint"><b>FACTURE</b> <span class="pull-right">#{{$client->created_at->format('Ymd').' '.$client->id}}</span></h3>
            <hr class="m-t-0 m-b-5" style="border-color: rgba(0, 0, 0, 0.32);">
            <div class="row">
                <div class="col-md-12">
                    <div class="pull-left">
                        <address>
                            <h4 id="factoryInfo"> &nbsp;<b class="text-danger">OLIVO AL'CAZAR</b></h4>
                            <p class="text-muted m-l-5">E 104, Dharti-2, <br />
                                Nr' Viswakarma Temple, <br />
                                Talaja Road, <br />
                                Bhavnagar - 364002</p>
                        </address>
                    </div>
                    <div class="pull-right text-right">
                        <address class="m-b-0">
                            <h4 id="clientName" class="font-bold">{{ucwords($client->name)}},</h4>
                            <p class="text-muted m-l-30"><i class="fa fa-phone"></i> {{$client->phone}}, <br />
                                Date d'entrée: {{$client->created_at->format('d/m/Y')}}, à {{$client->created_at->format('H:i')}}, <br />
                                Tour: {{$client->tour}}, <br />
                                <p class="m-t-10"><b>Date de paiement :</b> <i class="fa fa-calendar"></i> {{$client->payed_at==NULL ? 'EN ATTENTE,':$client->payed_at->format('d/m/Y')}},<br>
                                    <b>à :</b> <i class="fa  fa-clock-o"></i> {{$client->payed_at==NULL ?'EN ATTENTE': $client->payed_at->format('H:i')}}</p>
                        </address>
                    </div>
                </div>
                <div class="col-md-12 m-t-0">
                    <div class="table-responsive m-t-0" style="clear: both;">
                        <table class="table table-hover">
                            <thead>
                                <tr class="trPrint">
                                    <th class="text-center">#</th>
                                    <th>Sac</th>
                                    <th class="text-right">Poids</th>
                                    <th class="text-right">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $total = 0;
                                @endphp
                                @foreach ($client->produits as $key => $produit)
                                <tr class="trPrint">
                                    <td class="text-center tdPrint" style="padding: 8px">{{$key+1}}</td>
                                    <td class="tdPrint" style="padding: 8px">{{$produit->nombre_sac}} Sacs</td>
                                    <td class="text-right tdPrint" style="padding: 8px">{{$produit->tonnage}} Kg </td>
                                    <td class="text-right tdPrint" style="padding: 8px"> {{$produit->tonnage/2}} DH </td>
                                </tr>
                                @php
                                $total += $produit->tonnage;
                                @endphp
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="pull-right m-t-5 text-right">
                        <p>Poids > 400 kg => 0.5dh/kg </p>
                        <p>Poids < 400 kg=> 200dh</p>
                        <hr class="m-t-0" style="border-color: rgba(0, 0, 0, 0.32);">
                        <h4><b>Total :</b> {{$total <= 400 ? "200": $total/2 }} DH</h4>
                    </div>
                    @if ($client->payed_at)
                    <div class="text-center">
                        <img src="{{ asset('ample/plugins/images/paid-stamp-fr.png') }}" height='115px'>
                    </div>
                    @endif
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        @if ($client->payed_at)
        <div class="text-left">
            <button id="print" class="btn btn-danger" type="button"> <span><i class="fa fa-print"></i> Imprimer</span> </button>
        </div>
        @endif
    </div>
    <div class="white-box" id="printableAreaArabic">
        <div class="printableAreaArabic">
            <h3 id="facturePrint">#{{$client->created_at->format('Ymd').' '.$client->id}} <span class="pull-right"><b>فاتورة</b></span></h3>
            <hr class="m-t-0 m-b-5" style="border-color: rgba(0, 0, 0, 0.32);">
            <div class="row">
                <div class="col-md-12">
                    <div class="pull-left text-left">
                        <address class="m-b-0">
                            <h4 id="clientName" class="font-bold">{{ucwords($client->name)}},</h4>
                            <p class="text-muted"><i class="fa fa-phone"></i> {{$client->phone}}, <br />
                                {{$client->created_at->format('H:i')}} <i class="fa  fa-clock-o"></i> {{$client->created_at->format('d/m/Y')}} :تاريخ الدخول , <br>

                                {{$client->tour}} :ترتيب , <br />
                                <p class="m-t-10">{{$client->payed_at==NULL ? 'EN ATTENTE,':$client->payed_at->format('d/m/Y')}} <i class="fa fa-calendar"></i> <b> : تاريخ الأداء </b> ,<br>
                                    {{$client->payed_at==NULL ?'EN ATTENTE': $client->payed_at->format('H:i')}} <i class="fa  fa-clock-o"></i> <b> : مع</b> </p>
                        </address>
                    </div>
                    <div class="pull-right text-right">
                        <address>
                            <h4 id="factoryInfo"> &nbsp;<b class="text-danger">معصرة القصر </b></h4>
                            <p class="text-muted m-l-5"><br />
                                <br />
                                <br />
                            </p>
                        </address>

                    </div>
                </div>
                <div class="col-md-12 m-t-0">
                    <div class="table-responsive m-t-0" style="clear: both;">
                        <table class="table table-hover" dir="rtl">
                            <thead>
                                <tr class="trPrint">
                                    <th class="text-center">#</th>
                                    <th class="text-right">الأكياس </th>
                                    <th class="text-right">الكتلة </th>
                                    <th class="text-left">المجموع</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $total = 0;
                                @endphp
                                @foreach ($client->produits as $key => $produit)
                                <tr class="trPrint">
                                    <td class="text-center tdPrint" style="padding: 8px">{{$key+1}}</td>
                                    <td class="tdPrint" style="padding: 8px">{{$produit->nombre_sac}} أكياس</td>
                                    <td class="text-right tdPrint" style="padding: 8px">{{$produit->tonnage}} كجم </td>
                                    <td class="text-left tdPrint" style="padding: 8px"> {{$produit->tonnage/2}} درهم </td>
                                </tr>
                                @php
                                $total += $produit->tonnage;
                                @endphp
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="pull-left m-t-5 text-right">
                        <p dir="rtl">الكتلة > 400 كجم => 0.5 درهم/كجم </p>
                        <p dir="rtl">الكتلة < 400 كجم=> 200 درهم</p>
                        <hr class="m-t-0" style="border-color: rgba(0, 0, 0, 0.32);">
                        <h4><span dir="rtl" style="float: left;"> {{$total <= 400 ? "200": $total/2 }} درهم</span> : <b>المجموع</b></h4>
                    </div>
                    @if ($client->payed_at)
                    <div class="text-center">
                        <img src="{{ asset('ample/plugins/images/paid-stamp.png') }}" height='115px'>
                    </div>
                    @endif
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        @if ($client->payed_at)
        <div class="text-right">
            <button class="btn btn-danger" type="button" id="printArabic"> <span><i class="fa fa-print"></i> اطبع الفاتورة</span> </button>
            <button class="btn btn-danger" type="button" onclick='ajax_print("{{ url('printInvoicePayed', $client->id) }}")'> <span><i class="fa fa-print"></i> Ticket</span> </button>

        </div>
        @endif
    </div>
</div>
</div>
@endsection

@section('script')
<script type="text/javascript">
    function ajax_print(url) {
        $.get(url, function(data) {
            var S = "#Intent;scheme=rawbt;";
            var P = "package=ru.a402d.rawbtprinter;end;";
            window.location.href = "intent:" + data + S + P;
        })
    }
</script>
<script src="{{ asset('ample/js/jquery.PrintArea.js') }}" type="text/JavaScript"></script>
<script>
    $(document).ready(function() {
        $('#changeLang').click(function() {
            $('#printableArea').toggle();
            $('#printableAreaArabic').toggle();
            //btn icon 
            $('#arBtn').toggle();
            $('#frBtn').toggle();
        });
        $("#print").click(function() {
            var mode = 'iframe'; //popup
            var close = mode == "popup";
            var options = {
                mode: mode,
                popClose: close
            };
            $("div.printableArea").printArea(options);
        });

        $("#printArabic").click(function() {
            var mode = 'iframe'; //popup
            var close = mode == "popup";
            var options = {
                mode: mode,
                popClose: close
            };
            $("div.printableAreaArabic").printArea(options);
        });

        // Switchery
        var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
        $('.js-switch').each(function() {
            new Switchery($(this)[0], $(this).data());
        });
    });
</script>

@if(session()->has('success') || session()->has('printerWarning'))
<script src="{{ asset('ample/plugins/bower_components/toast-master/js/jquery.toast.js') }}"></script>
<script src="{{ asset('ample/js/toastr.js') }}"></script>
@if (session()->has('success'))
<script>
    $.toast({
        heading: 'Success',
        text: "{{session()->get('success')}}",
        position: 'top-right',
        loaderBg: '#2F97C1',
        icon: 'success',
        hideAfter: 3500,
        stack: 6
    });
</script>
@endif

@if(session()->has('printerWarning'))
<script>
    $.toast({
        heading: "Printer Warning",
        text: "{{session()->get('printerWarning')}}",
        position: 'top-right',
        loaderBg: '#ff6849',
        icon: 'warning',
        hideAfter: 7500,
        stack: 6
    });
</script>
@endif
@endif
<script src="{{ asset('ample/plugins/bower_components/switchery/dist/switchery.min.js') }}"></script>
@endsection