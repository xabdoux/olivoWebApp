<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use DB;
use App\Client;
use App\Client_produit;
use App\Produit;
use App\Zone;
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
//use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\PrintConnectors\DummyPrintConnector;
use App\item;

class Injecteur extends Controller
{
    //
  public function addCustomer()
  {
    $nextNumber = Client::orderBy('created_at','desc')->first();
     $alert = DB::table('clients')
                    ->select('tour')
                    ->where('served_at', NULL)
                    ->where('deleted_at', NULL)
                    ->groupBy('tour')
                    ->havingRaw('COUNT(*) > 1')
                    ->get();
      $zones = Zone::all();
      return view('injecteur/dashboard', compact(['zones','alert','nextNumber']));
  }

    public function storeData(Request $request)
    {

      $userId = Auth()->user()->id;
      $client = Client::create($request->all());
      if ($request->zone) {
        $zone = Zone::where('name',"$request->zone")->first();
       if ($zone) {
            $client->zone_id = $zone->id;
            $client->save();
       }else{
        $createZone = new Zone;
        $createZone->name = $request->zone;
        $createZone->save();

        $client->zone_id = $createZone->id;
        $client->save();
       }
      }
      
    	$sac = $request->nombre_sac;
    	$tonnage = $request->tonnage;
    	foreach ($sac as $key => $value) {

    		$produit = new Produit;
    		$produit->nombre_sac = $sac[$key];
    		$produit->tonnage    = $tonnage[$key];
     		$produit->save();

     		$client_produit = new Client_produit;
     		$client_produit->client_id   = $client->id;
     		$client_produit->produit_id  = $produit->id;;
     		$client_produit->created_by  = $userId;
     		$client_produit->save();
    	}

    	return redirect()->route('ShowClientDetails', [$client])->with('storeData','Client enregistre avec succes');
    }


    public function ShowClientDetails($clientId)
    {
      $alert = DB::table('clients')
                    ->select('tour')
                    ->where('served_at', NULL)
                    ->where('deleted_at', NULL)
                    ->groupBy('tour')
                    ->havingRaw('COUNT(*) > 1')
                    ->get();
      $zones = Zone::all();
    	$client =  Client::find($clientId);
    	return view('injecteur/ShowClientDetails', compact(['client','zones','alert']));
    }

    public function ShowTrashedClientDetails($clientId)
    {
      /*$alert = DB::table('clients')
                    ->select('tour')
                    ->where('served_at', NULL)
                    ->where('deleted_at', NULL)
                    ->groupBy('tour')
                    ->havingRaw('COUNT(*) > 1')
                    ->get();*/
      
      $client =  Client::onlyTrashed()->find($clientId);
      return view('injecteur/ShowTrashedClientDetails', compact(['client']));
    }

    public function printInvoice($clientId)
    {

    	$client  = Client::find($clientId);
        $connector = new DummyPrintConnector();
      /* Start the printer */
      $printer = new Printer($connector);
      /* Initialize */
      $printer -> initialize();

      /* Print top logo */
      $printer -> setJustification(Printer::JUSTIFY_CENTER);
    	$olivo = EscposImage::load("resources/olivoalcazar.png", false);
	    $printer -> bitImage($olivo);
   		$printer -> feed();
   		//$printer -> setTextSize(2, 3);
   		$printer -> text("06 44 87 17 96\n");
      $printer -> text("----------\n");
   		$ldate = $client->created_at->format('d/m/Y');
   		$ltime = $client->created_at->format('H:i');
   		//$printer -> setTextSize(4, 4);
   		$printer -> text(new item("$ldate", "$ltime"));
      $printer -> setJustification(Printer::JUSTIFY_CENTER);
      $printer -> setTextSize(2, 2);
   		$printer -> text("$client->tour");
   		$printer -> feed();
   		$printer -> feed();
      $printer -> selectPrintMode();
      $printer -> setJustification(Printer::JUSTIFY_CENTER);
      $printer -> text(strtoupper($client->name));
      $printer -> feed();

   		$printer -> selectPrintMode(Printer::MODE_EMPHASIZED);
   		$printer -> text(new item("Sac", "Poids"));
   		$printer -> text(" ---                      ----- \n");
      $printer -> selectPrintMode();

   		$totalSac = 0;
   		$totalTonnage = 0;
   		foreach ($client->produits as $produit) {
   			$printer -> text(new item("$produit->nombre_sac", "$produit->tonnage Kg"));
   			$totalSac += $produit->nombre_sac;
   			$totalTonnage += $produit->tonnage;
   		}

   		$printer -> text("________________________________\n");
   		$printer -> selectPrintMode();
      $printer -> setTextSize(1, 1);
   		$printer -> text(new item("$totalSac Sac", "$totalTonnage Kg"));
   		$printer -> setJustification(Printer::JUSTIFY_CENTER);
   		$printer -> setTextSize(2, 2);
   		if ($totalTonnage <= 400) {
   			$totalPrix = 200;
   		}else {
   			$totalPrix = $totalTonnage/2;
   		}
   		$printer -> text("$totalPrix DH");
   		$printer -> feed();
   		$printer -> feed();

   		$testStr = "http://192.168.31.100:8000/productGone/".$clientId;
      $printer -> setJustification(Printer::JUSTIFY_CENTER);
      $printer -> qrCode($testStr, Printer::QR_ECLEVEL_L, 5);
      $printer -> feed();
      $printer -> selectPrintMode(Printer::MODE_EMPHASIZED);
      $todayId = $client->created_at->format('Ymd');
      $clientIdentifiant = "$todayId"." $clientId";
      $printer -> text("# $clientIdentifiant");

      $printer -> feed();
      $printer -> feed();
      $printer -> feed();

      /* Cut the receipt and open the cash drawer */
      $printer -> cut();
      // send to app
      echo "base64,".base64_encode($connector -> getData());
      $printer -> pulse();

      $printer -> close();

      //$connector->finalize();
    }
 

    public function modifyData(Request $request, $clientId)
    {
      $userId = Auth()->user()->id;
      $client = Client::find($clientId);
      $client->fill($request->all())->save();
      // modification de la zone
      if ($request->zone) {
        $zone = Zone::where('name',"$request->zone")->first();
       if ($zone) {
            $client->zone_id = $zone->id;
            $client->save();
       }else{
        $createZone = new Zone;
        $createZone->name = $request->zone;
        $createZone->save();

        $client->zone_id = $createZone->id;
        $client->save();
       }
      }else{
        $client->zone_id = NULL;
        $client->save();
      }

      //return $client->produits;
      foreach ($client->produits as $produit) {
        $produit->pivot->delete();
        $produit->delete();
      }

      $sac = $request->nombre_sac;
      $tonnage = $request->tonnage;
      foreach ($sac as $key => $value) {

        $produit = new Produit;
        $produit->nombre_sac = $sac[$key];
        $produit->tonnage    = $tonnage[$key];
        $produit->save();

        $client_produit = new Client_produit;
        $client_produit->client_id   = $clientId;
        $client_produit->produit_id  = $produit->id;;
        $client_produit->created_by  = $userId;
        $client_produit->save();
      }
      return redirect()->route('ShowClientDetails', [$client])->with('storeData','Bien modifié');

    }

    public function allClients()
    {
      $clients = Client::where('served_by', NULL)->orderBy('id','desc')->get();
      /*return dd($clients);*/

      return view('injecteur/allClients', compact(['clients']));
    }

    public function deleteClient($clientId)
    {
        $client = Client::find($clientId);
        /*I comment this part becouse I use soft delete in clients */
       /*foreach ($client->produits as $produit) {
        $produit->pivot->delete();
        $produit->delete();
      }*/

      $client->delete();
      return redirect()->back()->with('deleteClient','Supprimé avec succès');;
    }


    public function deletedClients()
    {
      $trashedClients = Client::onlyTrashed()->get();
      return view('injecteur/deletedClient',compact(['trashedClients']));
    }


    public function restorerClient($clientId)
    {
       $client = Client::withTrashed()->find($clientId);
       $client->restore();
       return redirect()->route('ShowClientDetails', [$client])->with('storeData','Client restorer avec succes');
    }
}
