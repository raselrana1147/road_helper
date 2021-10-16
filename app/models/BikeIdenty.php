<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class BikeIdenty extends Model
{
    protected $guarded=[];

    public function user(){
    	return $this->belongsTo('App\models\User');
    }
}
