<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\BikeIdenty;
use Illuminate\Http\Response;
use Auth;
use App\models\ProfileView;
use App\models\PushNotification;
use App\Libary\Helper;

class BikeRiderController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth:api');
    }

// get all bike information

    public function index(){

    	$data=BikeIdenty::latest()->get();
        if (count($data)>0) {
            return response()->json(['data'=>$data,'status'=>200],Response::HTTP_OK);
        }else{
            return response()->json([
            'data'=>"No data found",
            'status'=>500],
            Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

// add new bike information
    public function store(Request $request){

    	// make validate


    	$this->validate($request,[
    		'bike_number'       =>'required|string|unique:bike_identies',
    		'driver_name'       =>'required|string',
    		'license_number'    =>'nullable|string|unique:bike_identies',
    		'emergency_number_1'=>'required|string',
    		'emergency_number_2'=>'nullable|string',
    		'emergency_number_3'=>'nullable|string',
    		'address'            =>'required',
    		'user_id'            =>'nullable'
    	]);


    	if ($request->isMethod('post')){

            $check=BikeIdenty::where('user_id',Auth::user()->id)->first();
                if (is_null($check)) {
                        $data=new BikeIdenty();
                        $data->bike_number       =$request->bike_number;
                        $data->driver_name       =$request->driver_name;
                        $data->license_number    =$request->license_number;
                        $data->emergency_number_1=$request->emergency_number_1;

                        if (!empty($request->emergency_number_2)){
                            $data->emergency_number_2=$request->emergency_number_2;
                        }
                        if (!empty($request->emergency_number_3)){
                            $data->emergency_number_3=$request->emergency_number_3;
                        }

                        $data->address           =$request->address;
                        $data->user_id           =Auth::user()->id;
                        $insert=$data->save();
                        if ($insert) {
                           return response()
                           ->json([
                                'data'=>'Successfully added',
                                'insert_id'=>$data->id,
                            'status'=>200],Response::HTTP_CREATED);
                        }else{
                            return response()
                            ->json([
                            'data'=>'Something went wrong',
                            'status'=>500],Response::HTTP_INTERNAL_SERVER_ERROR);
                        }
            }else{
                   return response()
                   ->json([
                        'data'=>'Already Added BikeIdenty',
                        'insert_id'=>$data->id,
                    'status'=>402],Response::HTTP_CREATED);
            }
    	}else{
            return response()->json([
            'data'=>'The uses method Not Support for this route',
            'status'=>400],Response::HTTP_INTERNAL_SERVER_ERROR);
        }



    }


// upadte bike information
    public function update(Request $request){

    	// make validate
    	$data=BikeIdenty::findOrFail($request->id);
    	$this->validate($request,[
    		'bike_number'       =>'required|string|unique:bike_identies,bike_number,'.$data->id,
    		'driver_name'       =>'required|string',
    		'license_number'    =>'required|string|unique:bike_identies,license_number,'.$data->id,
    		'emergency_number_1'=>'required|string',
    		'emergency_number_2'=>'required|string',
    		'emergency_number_3'=>'required|string',
    		'address'           =>'required',
    		'user_id'           =>'nullable'
    	]);


            if ($request->isMethod('post')) {
                    $data->bike_number       =$request->bike_number;
                    $data->driver_name       =$request->driver_name;
                    $data->license_number    =$request->license_number;
                    $data->emergency_number_1=$request->emergency_number_1;
                    $data->emergency_number_2=$request->emergency_number_2;
                    $data->emergency_number_3=$request->emergency_number_3;
                    $data->address           =$request->address;
                    $update=$data->save();

                    if ($update) {
                        return response()
                        ->json(['data'=>'Successfully Updated','status'=>200],Response::HTTP_CREATED);
                    }else{
                        return response()
                        ->json([
                        'data'=>'Something went wrong',
                        'status'=>500],Response::HTTP_INTERNAL_SERVER_ERROR);
                    }
            }else{
                return response()->json([
                'data'=>'The uses method Not Support for this route',
                'status'=>400],Response::HTTP_INTERNAL_SERVER_ERROR);
            }



    }

// show single bike information
    public function show($id){

    	$data=BikeIdenty::find($id);

        if (!is_null($data)) {
            return response()->json(['data'=>$data,'status'=>200],Response::HTTP_OK);
        }else{
            return response()->json([
            'data'=>'No data found',
            'status'=>500],
            Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }

// delete bike information
    public function destroty($id){

    	    $data=BikeIdenty::find($id);
            if (!is_null($data)) {
                 $data->delete();
                 return response()->json([
                'data'=>"Successfully deleted",
                'status'=>200],Response::HTTP_OK);
            }else{
                 return response()->json([
                'data'=>"No data found",
                'status'=>500],Response::HTTP_INTERNAL_SERVER_ERROR);
            }
    }

    public function generate_qr($id){
            $data=BikeIdenty::with('user')->find($id);
            if (!is_null($data)) {
                 return response()->json([
                'data'=>$data,
                'status'=>200],Response::HTTP_OK);
            }else{
                 return response()->json([
                'data'=>"No data found",
                'status'=>500],Response::HTTP_INTERNAL_SERVER_ERROR);
            }
    }

    // search bike
    public function search_bike($bike_number){

        $data=BikeIdenty::where('bike_number',$bike_number)->first();
      //  return $data;

        if (!is_null($data)) {

        
            if (Auth::user()->id !=$data->user_id) {

                $user_check=$data->user;

                $register_date=date('Y-m-d',strtotime($user_check->created_at));
                $today=date('Y-m-d');
            
                $register_string_date=date(strtotime($register_date));
                $today_st=date(strtotime($today));
                $remain=$today_st-$register_string_date;

                
               $day=$remain/(60*60*24);

              if (($day>15 && $user_check->is_paid==2) || ($day<15 && $user_check->is_paid==1)) {
                  
                   $SERVER_API_KEY=Helper::server_api_key();

                 $data_info =[
                   "to"=>$data->user->token, //this is for single users
                   "priority"=>"high",
                   "notification"=>[
                           "title"=>'Someone search your bike'
                          ]
                  ];

                $dataString = json_encode($data_info);

                  $headers = [
                      'Authorization: key=' . $SERVER_API_KEY,
                      'Content-Type: application/json',
                  ];

                  $ch = curl_init();
                  curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
                  curl_setopt($ch, CURLOPT_POST, true);
                  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                  curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
                  curl_exec($ch);
                  curl_close($ch);

                  // end

                    $notify=new PushNotification();
                    $notify->notify_to=$data->user_id;
                    $notify->notify_from=Auth::user()->id;
                    $notify->title="Bike Search";
                    $notify->message="Someone search your bike";
                    $notify->type="bike";
                    $notify->save();


                    return response()->json([
                    'data'=>$data,
                    'status'=>200],
                    Response::HTTP_OK);

               }
                /// push notofication section
               

        }
        }else{
             return response()->json([
            'data'=>"No data found",
            'status'=>500],Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    public function exist_bike_register(){
        $check_bike_register=BikeIdenty::where('user_id',Auth::user()->id)->first();
        if (is_null($check_bike_register)) {
            return response()->json([
            'data'=>"Please register your bike",
            'status'=>200],
            Response::HTTP_OK);
        }else{
            return response()->json([
            'data'=>"You have already register bike",
            'status'=>402],
            Response::HTTP_OK);
        }

    }

}
