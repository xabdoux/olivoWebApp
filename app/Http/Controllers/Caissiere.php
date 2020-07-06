<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Auth;
use DB;
use App\Client;
use App\Client_produit;
use App\Produit;
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
//use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use App\item;
use Illuminate\Support\Facades\DB as FacadesDB;
use PhpParser\Node\Stmt\TryCatch;

class Caissiere extends Controller
{

    public function allClients()
    {
        $alert = FacadesDB::table('clients')
            ->select('tour')
            ->where('served_at', NULL)
            ->where('deleted_at', NULL)
            ->groupBy('tour')
            ->havingRaw('COUNT(*) > 1')
            ->get();

        $clients = Client::where('served_by', NULL)->orderBy('id', 'desc')->get();
        /*return dd($clients);*/

        return view('caissiere/dashboard', compact(['clients', 'alert']));
    }

    public function profileClient($clientId)
    {
        $client = Client::find($clientId);
        return view('caissiere/profileClient', compact(['client']));
    }

    public function proceedToPayment($clientId)
    {
        $user = Auth()->user()->id;
        $today = date('Y-m-d H:i:s');
        $client = Client::find($clientId);
        $client->payed_by = $user;
        $client->payed_at = $today;
        $client->save();
        //print invoice
        $client  = Client::find($clientId);
        try {
            $connector = new WindowsPrintConnector("SHAREDPRINTER");
            /* Start the printer */
            $printer = new Printer($connector);
            /* Initialize */
            $printer->initialize();

            //   /* Print top logo */
            //   $printer -> setJustification(Printer::JUSTIFY_CENTER);
            //   $olivo = EscposImage::load("resources/olivoalcazar.png", false);
            //   $printer -> bitImage($olivo);
            //   $printer -> feed();
            //   //$printer -> setTextSize(2, 3);
            //   $printer -> text("06 44 87 17 96\n");
            // $printer -> text("----------\n");
            //   $ldate = $client->created_at->format('d/m/Y');
            //   $ltime = $client->created_at->format('H:i');
            //   //$printer -> setTextSize(4, 4);
            //   $printer -> text(new item("$ldate", "$ltime"));
            //   $printer -> setJustification(Printer::JUSTIFY_CENTER);
            //   $printer -> setTextSize(2, 2);
            //   $printer -> text("$client->tour");
            //   $printer -> feed();
            //   $printer -> feed();
            // $printer -> selectPrintMode();
            // $printer -> setJustification(Printer::JUSTIFY_CENTER);
            // $printer -> text(strtoupper($client->name));
            // $printer -> feed();

            //   $printer -> selectPrintMode(Printer::MODE_EMPHASIZED);
            //   $printer -> text(new item("Sac", "Poids"));
            //   $printer -> text(" ---                      ----- \n");
            // $printer -> selectPrintMode();

            //   $totalSac = 0;
            //   $totalTonnage = 0;
            //   foreach ($client->produits as $produit) {
            //       $printer -> text(new item("$produit->nombre_sac", "$produit->tonnage Kg"));
            //       $totalSac += $produit->nombre_sac;
            //       $totalTonnage += $produit->tonnage;
            //   }

            //   $printer -> text("________________________________\n");
            //   $printer -> selectPrintMode();
            // $printer -> setTextSize(1, 1);
            //   $printer -> text(new item("$totalSac Sac", "$totalTonnage Kg"));
            //   $printer -> setJustification(Printer::JUSTIFY_CENTER);
            //   $printer -> setTextSize(2, 2);
            //   if ($totalTonnage <= 400) {
            //       $totalPrix = 200;
            //   }else {
            //       $totalPrix = $totalTonnage/2;
            //   }
            //   $printer -> text("$totalPrix DH");
            //   $printer -> feed();
            //   $printer -> feed();

            //   $printer -> setJustification(Printer::JUSTIFY_CENTER);
            //   $paye = EscposImage::load("resources/paye.png", false);
            //   $printer -> bitImage($paye);
            //   $printer -> feed();
            //   $printer -> feed();
            //   $printer -> selectPrintMode(Printer::MODE_EMPHASIZED);
            //   $todayId = $client->created_at->format('Ymd');
            //   $clientIdentifiant = "$todayId"." $clientId";
            //   $printer -> text("# $clientIdentifiant");

            $printer->feed();
            $printer->feed();
            $printer->feed();

            /* Cut the receipt and open the cash drawer */
            //$printer -> cut();
            // send to app
            //$printer -> pulse();

            $printer->close();
        } catch (\Throwable $th) {
            return redirect()->route('profileClient', [$client])->with('success', 'Paiement effectué avec succès')->with('printerWarning', 'Can not connect to the printer !');
        }



        //return redirect()->back()->with('success','Paiement effectué avec succès');
        return redirect()->route('profileClient', [$client])->with('success', 'Paiement effectué avec succès');
    }


    public function productOut($clientId)
    {
        $user = Auth()->user()->id;
        $today = date('Y-m-d H:i:s');
        $client = Client::find($clientId);
        $client->served_by = $user;
        $client->served_at = $today;
        $client->save();
        return redirect()->back()->with('success', 'Le client est terminé avec succès');
    }

    public function productOutCanceled($clientId)
    {
        $user = Auth()->user()->id;
        $today = date('Y-m-d H:i:s');
        $client = Client::find($clientId);
        $client->served_by = NULL;
        $client->served_at = Null;
        $client->save();
        return redirect()->back()->with('success', 'Modifié avec succes');
    }

    public function paymentCanceled($clientId)
    {
        $user = Auth()->user()->id;
        $today = date('Y-m-d H:i:s');
        $client = Client::find($clientId);
        $client->payed_by = NULL;
        $client->payed_at = NULL;
        $client->save();
        return redirect()->back()->with('success', 'Le paiement a été annulé avec succès');
    }


    public function finishedClients()
    {
        $clients = Client::where('served_by', '!=', NULL)->orderBy('served_at', 'desc')->get();
        /*return dd($clients);*/

        return view('caissiere/finishedClients', compact(['clients']));
    }


    public function ajaxtest()
    {
        return "Hello first ajax test";
    }

    public function printInvoicePayed($clientId)
    {
        $client  = Client::find($clientId);
        $connector = new WindowsPrintConnector("SHAREDPRINTER");
        /* Start the printer */
        $printer = new Printer($connector);
        /* Initialize */
        // $printer -> initialize();

        //   /* Print top logo */
        //   $printer -> setJustification(Printer::JUSTIFY_CENTER);
        //   $olivo = EscposImage::load("resources/olivoalcazar.png", false);
        //   $printer -> bitImage($olivo);
        //   $printer -> feed();
        //   //$printer -> setTextSize(2, 3);
        //   $printer -> text("06 44 87 17 96\n");
        // $printer -> text("----------\n");
        //   $ldate = $client->created_at->format('d/m/Y');
        //   $ltime = $client->created_at->format('H:i');
        //   //$printer -> setTextSize(4, 4);
        //   $printer -> text(new item("$ldate", "$ltime"));
        //   $printer -> setJustification(Printer::JUSTIFY_CENTER);
        //   $printer -> setTextSize(2, 2);
        //   $printer -> text("$client->tour");
        //   $printer -> feed();
        //   $printer -> feed();
        // $printer -> selectPrintMode();
        // $printer -> setJustification(Printer::JUSTIFY_CENTER);
        // $printer -> text(strtoupper($client->name));
        // $printer -> feed();

        //   $printer -> selectPrintMode(Printer::MODE_EMPHASIZED);
        //   $printer -> text(new item("Sac", "Poids"));
        //   $printer -> text(" ---                      ----- \n");
        // $printer -> selectPrintMode();

        //   $totalSac = 0;
        //   $totalTonnage = 0;
        //   foreach ($client->produits as $produit) {
        //       $printer -> text(new item("$produit->nombre_sac", "$produit->tonnage Kg"));
        //       $totalSac += $produit->nombre_sac;
        //       $totalTonnage += $produit->tonnage;
        //   }

        //   $printer -> text("________________________________\n");
        //   $printer -> selectPrintMode();
        // $printer -> setTextSize(1, 1);
        //   $printer -> text(new item("$totalSac Sac", "$totalTonnage Kg"));
        //   $printer -> setJustification(Printer::JUSTIFY_CENTER);
        //   $printer -> setTextSize(2, 2);
        //   if ($totalTonnage <= 400) {
        //       $totalPrix = 200;
        //   }else {
        //       $totalPrix = $totalTonnage/2;
        //   }
        //   $printer -> text("$totalPrix DH");
        //   $printer -> feed();
        //   $printer -> feed();

        //   $printer -> setJustification(Printer::JUSTIFY_CENTER);
        //   $paye = EscposImage::load("resources/paye.png", false);
        //   $printer -> bitImage($paye);
        //   $printer -> feed();
        //   $printer -> feed();
        //   $printer -> selectPrintMode(Printer::MODE_EMPHASIZED);
        //   $todayId = $client->created_at->format('Ymd');
        //   $clientIdentifiant = "$todayId"." $clientId";
        //   $printer -> text("# $clientIdentifiant");

        $printer->feed();
        $printer->feed();
        $printer->feed();

        /* Cut the receipt and open the cash drawer */
        // $printer -> cut();
        // send to app
        //$printer -> pulse();

        $printer->close();
    }
}
