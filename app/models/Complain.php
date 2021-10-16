<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Complain extends Model
{
    protected $guarded=[];

    public function user(){
    	return $this->belongsTo('App\models\User','user_id');
    }
}
