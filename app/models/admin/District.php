<?php

namespace App\models\admin;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    //

    public function division(){
    	 return $this->belongsTo('App\models\admin\Division');
    }

    
}
