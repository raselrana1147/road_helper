<?php

namespace App\Libary;
use App\models\MobilApi;
use DB;

class Mobile
{
	
	public static function send_otp($message,$to){
                                                     
            $data=DB::table('mobil_apis')->first();
			 $curl = curl_init();
                 $credential =[
                     "username"=>$data->username,
                     "password"=>$data->password,
                     "sender"=>$data->sender,
                     "message"=>$message,
                     "to"=>$data->country_code.$to
                 ];
                 curl_setopt_array($curl, array(
                 CURLOPT_URL => $data->api_url,
                 CURLOPT_RETURNTRANSFER => true,
                 CURLOPT_ENCODING => "",
                 CURLOPT_MAXREDIRS => 10,
                 CURLOPT_TIMEOUT => 30,
                 CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                 CURLOPT_CUSTOMREQUEST => "POST",
                 CURLOPT_POSTFIELDS => json_encode($credential),
                 CURLOPT_HTTPHEADER => array(
                 "Content-Type: application/json",
                 ),
                 ));
                 $response = curl_exec($curl);
                 return $response;

	   }
}