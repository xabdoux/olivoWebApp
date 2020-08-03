@extends('layouts.app')

@section('content')

<div class="preloader">
  <svg class="circular" viewBox="25 25 50 50">
    <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
  </svg>
</div>
<!-- Preloader -->
<section id="wrapper" class="new-login-register">
  <div class="lg-info-panel">
    <div class="inner-panel">
      <a href="javascript:void(0)" class="p-20 di"><img src="{{ asset('ample/plugins/images/admin-logo.png') }}" width="60px" height="70px"></a>
      <div class="lg-content">
        <h2>OLIVO AL'CAZAR</h2>
        <p class="text-muted">
          TRITURATION DES OLIVES, LA VALORISATION, LA TRANSFORMATION, LE CONDITIONNEMENT, L EMBALLAGE ET LA VENTE DES PRODUITS DE L'OLIVIER
        </p>
        <br><br><br>
        <p>Copyright © 2018 OLIVO AL-CAZAR - All Rights Reserved</p>
        <p><a href="{{ url('privacy-policy') }}">Privacy policy</a></p>
      </div>
    </div>
  </div>
  <div class="new-login-box m-t-0">
    <div class="white-box">
        <div class="panel panel-default">
            <div class="panel-heading">Privacy policy</div>
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <p>La procédure de gestion de la production des olives a pour objectif d'enregistrer toutes
                        les informations nécessaires pour assurer la traçabilité en amont de la chaîne de
                        production. Il s'agit d'identifier les producteurs/fournisseurs d'olives, les parcelles, la
                        conduite de la culture et la récolte. </p>

                        <p>Cette procédure s'articule autour de 3 modules différents:
                            - L'identification des vergers ;
                            - La conduite de la culture ;
                            - La récolte.
                            A la veille de chaque campagne oléicole, chaque producteur d'olive adresse,
                            directement ou par le biais de son association, une demande d'adhésion au système
                            de traçabilité à l'unité de trituration. Une fois sa demande est acceptée, le producteur
                            s'engage à respecter de manière stricte cette procédure de gestion de la production
                            des olives. </p>
                   
                </div>
            </div>
        </div>
    </div>
  </div>
</section>


<!-- jQuery -->
<script src="{{ asset('ample/plugins/bower_components/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap Core JavaScript -->
<script src="{{ asset('ample/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- Menu Plugin JavaScript -->
<script src="{{ asset('ample/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js') }}"></script>

<!--slimscroll JavaScript -->
<script src="{{ asset('ample/js/jquery.slimscroll.js') }}"></script>
<!--Wave Effects -->
<script src="{{ asset('ample/js/waves.js') }}"></script>
<!-- Custom Theme JavaScript -->
<script src="{{ asset('ample/js/custom.min.js') }}"></script>
<!--Style Switcher -->
<script src="{{ asset('ample/plugins/bower_components/styleswitcher/jQuery.style.switcher.js') }}"></script>
@endsection