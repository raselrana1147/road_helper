<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use App\models\User;

class BloodRequest extends Model
{
    
    protected $guarded=[];

    public function requester(){
    	return $this->belongsTo(User::class,'requester_id');
    }

    
}
