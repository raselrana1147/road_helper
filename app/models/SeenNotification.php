<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use App\models\User;
use App\models\PushNotification;

class SeenNotification extends Model
{
    

    public function user(){
    	return $this->belongsTo(User::class);
    }

    public function notification(){
    	return $this->belongsTo(PushNotification::class,'notification_id');
    }
}
