<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    //

    protected $fillable = [
        'name', 
    ];


public function client()
    {
        return $this->hasOne('App\Client');
    }
}
