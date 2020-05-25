<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Client;
use App\Client_produit;
use App\Produit;
use App\Zone;

class ApiInjecteurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return  Client::where('served_by', NULL)->orderBy('id', 'desc')->get();
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $Client = new Client();
        $Client->content = $request->content;
        $Client->active = $request->active;

        $Client->save();
        return $Client;
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
    public function update(Request $request, $id)
    {
        $Client = Client::find($id);
        $Client->content = $request->content;
        $Client->active = $request->active;

        $Client->save();
        return $Client;
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

        return response()->json([]);
    }
}
