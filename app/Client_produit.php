<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Client_produit extends Model
{
	
    //
    protected $table = 'client_produits';

     protected $fillable = [
        'client_id','produit_id','created_by'
    ];

}
