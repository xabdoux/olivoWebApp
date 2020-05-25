<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produit extends Model
{
	
    //



     public function clients()
    {
        return $this->belongsToMany('App\Client','client_produits','client_id','produit_id');
    }

    
}
