<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use SoftDeletes;
    //

    protected $fillable = [
        'name', 'phone', 'tour', 'zone_id', 'litre', 'type', 'created_at', 'deleted_at'
    ];

    protected $dates = ['payed_at', 'served_at', 'deleted_at'];

    public function produits()
    {
        return $this->belongsToMany('App\Produit', 'client_produits', 'client_id', 'produit_id');
    }

    public function zone()
    {
        return $this->belongsTo('App\Zone');
    }
}
