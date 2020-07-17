<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
use App\Client_produit;
use App\Produit;

class ApiInjecteurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $client =   Client::select('id', 'name', 'phone', 'tour', 'created_at', 'deleted_at')
            ->where('served_by', NULL)
            ->where('type', "principale")
            ->orderBy('tour', 'asc')
            ->with(['produits' => function ($query) {
                $query->select('nombre_sac', 'produits.id', 'tonnage');
            }])->get();

        return response()->json($client);
        // 
    }

    public function deletedClients()
    {
        // $clients = Client::onlyTrashed()->get();
        $clients =   Client::select('id', 'name', 'phone', 'tour', 'type', 'created_at', 'deleted_at')
            ->where('served_by', NULL)
            //->where('type', "principale") show all types
            ->orderBy('deleted_at', 'desc')
            ->onlyTrashed()
            ->with(['produits' => function ($query) {
                $query->select('nombre_sac', 'produits.id', 'tonnage');
            }])->get();
        return response()->json($clients);
    }
    public function awaitingClients()
    {
        $client =   Client::select('id', 'name', 'phone', 'tour', 'created_at', 'deleted_at', 'type')
            ->where('served_by', NULL)
            ->where('type', "attente")
            ->orderBy('tour', 'asc')
            ->with(['produits' => function ($query) {
                $query->select('nombre_sac', 'produits.id', 'tonnage');
            }])->get();

        return response()->json($client);
    }

    public function restoreClients($clientId)
    {

        $client = Client::withTrashed()->find($clientId);
        $client->restore();
        return response()->json('success');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $userId =  $request->userId;
        $client = Client::create($request->all());

        foreach ($request->produits as $item) {

            $produit = new Produit;
            $produit->nombre_sac = $item['nombre_sac'];
            $produit->tonnage    = $item['tonnage'];
            $produit->save();

            $client_produit = new Client_produit;
            $client_produit->client_id   = $client->id;
            $client_produit->produit_id  = $produit->id;;
            $client_produit->created_by  = $userId;
            $client_produit->save();
        }
        return $client;
        // return response()->json([
        //     'id' => $client->id,
        //     'sdsd'=>'sddsd',
        // ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Client  $Client
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Client::find($id);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Client  $Client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $clientId)
    {

        $userId = 2;
        $client = Client::find($clientId);
        $client->fill($request->all())->save();

        //delete to change it with the new data 
        foreach ($client->produits as $produit) {
            $produit->pivot->delete();
            $produit->delete();
        }


        foreach ($request->produits as $item) {

            $produit = new Produit;
            $produit->nombre_sac = $item['nombre_sac'];
            $produit->tonnage    = $item['tonnage'];
            $produit->save();

            $client_produit = new Client_produit;
            $client_produit->client_id   = $clientId;
            $client_produit->produit_id  = $produit->id;;
            $client_produit->created_by  = $userId;
            $client_produit->save();
        }
        return $clientId;
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Client  $Client
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Client  = Client::find($id);
        $Client->delete();
        return $Client;
    }
}
