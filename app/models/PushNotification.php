<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use App\models\BloodRequest;
use App\models\SeenNotification;
use App\models\BloodDonner;

class PushNotification extends Model
{

    
    public function blood_request(){
        return $this->belongsTo(BloodRequest::class,'blood_request_id');
    }
    public function notify_from(){
    	return $this->belongsTo("App\models\User",'notify_from');
    }

     public function notify_to(){
    	return $this->belongsTo("App\models\User",'notify_to');
    }

    public function seen_notification(){
    	return $this->hasMany(SeenNotification::class,'notification_id');
    }

    public function blood_donner(){
        return $this->hasMany(BloodDonner::class,'notification_id');
    }
    
}
