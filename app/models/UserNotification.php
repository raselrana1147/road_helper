<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use App\models\BloodRequest;
use App\models\BloodDonner;

class UserNotification extends Model
{


    protected $guarded=[''];
    protected $with=['blood_request','notify_from','notify_to'];

    public function blood_request(){
        return $this->belongsTo(BloodRequest::class,'blood_request_id');
    }
    public function notify_from(){
    	return $this->belongsTo("App\models\User",'notify_from');
    }

    public function notify_to(){
    	return $this->belongsTo("App\models\User",'notify_to');
    }

     public function notification(){
    	return $this->belongsTo("App\models\Notification",'notification_id');
    }


    // public function blood_donner(){
    //     return $this->hasMany(BloodDonner::class,'notification_id');
    // }
}
