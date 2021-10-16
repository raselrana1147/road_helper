<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use App\models\User;
use App\models\admin\Payment;


class PaidUser extends Model
{
    
   public function user(){
   	  return $this->belongsTo(User::class);
   }
   
   public function payment(){
   	  return $this->belongsTo(Payment::class);
   }
}
