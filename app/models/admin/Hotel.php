<?php

namespace App\models\admin;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    

     protected $guarded=[];

     public function division(){
    	 return $this->belongsTo('App\models\admin\Division');
    }

    public function district(){
    	 return $this->belongsTo('App\models\admin\District');
    }
}
