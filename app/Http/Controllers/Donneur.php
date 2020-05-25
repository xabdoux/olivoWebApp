<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Auth;
use App\Client;
use App\Client_produit;
use App\Produit;

class Donneur extends Controller
{
    //
    public function allClients()
    {
      $clients = Client::where('served_by', NULL)->where('payed_by','!=',NULL)->orderBy('id','desc')->get();
      /*return dd($clients);*/

      return view('donneur/dashboard', compact(['clients']));
    }


    public function productGone($clientId)
    {
    	$user = Auth()->user()->id;
        $today = date('Y-m-d H:i:s');
    	$client = Client::find($clientId);
    	if ($client->payed_at) {
    		$client->served_by = $user;
	    	$client->served_at = $today;
	    	$client->save();
	    	return redirect('donneur')->with('success','Le client est terminé avec succès');
    	}else{
    		return redirect('donneur')->with('error','هذا الزبون لم يدفع فاتورته بعد');
    	}
    	
    }

    public function clientDetails($clientId)
    {
        $client =  Client::find($clientId);
        return view('donneur/clientDetails', compact(['client']));
    }

    public function clientDetailsList()
    {
        $clients = Client::orderBy('id','desc')->get();
      /*return dd($clients);*/

      return view('donneur/clientDetailsList', compact(['clients']));
    }
}
