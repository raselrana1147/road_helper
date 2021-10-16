<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\admin\PoliceStation;
use Illuminate\Http\Response;
use Auth;
use App\models\admin\Ambulance;
use App\models\admin\TouringPlace;
use App\models\admin\Hotel;
use App\models\admin\BloodBank;
use App\models\BloodRequest;
use App\models\admin\Notification;
use App\models\admin\Hospital;
use App\models\admin\District;
use App\models\admin\Division;
use App\models\User;
use App\models\PushNotification;
use App\Libary\Helper;
use App\models\SeenNotification;
use App\models\BloodDonner;
use App\models\UserNotification;

class SearchController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');

    }

    // search police station

    public function search_police_station(Request $request)
    {

        if ($request->has(['division_id', 'district_id'])) {
            $data = PoliceStation::where(['district_id' => $request->district_id, 'district_id' => $request->district_id])
                ->orderBy('id', 'DESC')->get();

        } elseif ($request->has('district_id')) {
            $data = PoliceStation::where(['district_id' => $request->district_id])
                ->orderBy('id', 'DESC')->get();


        } elseif ($request->has('division_id')) {

            $data = PoliceStation::where(['division_id' => $request->division_id])->orderBy('id', 'DESC')->get();
        } else {
            $data = PoliceStation::orderBy('id', 'DESC')->get();
        }

        if (count($data) > 0) {
            return response()->json([
                'data' => $data,
                'status' => 200],
                Response::HTTP_OK);
        } else {
            return response()->json([
                'data' => "No data found",
                'status' => 500],
                Response::HTTP_INTERNAL_SERVER_ERROR);
        }


    }

    public  function search_place(Request $request){
            $data = TouringPlace::where('place_name','LIKE','%'.$request->search_content.'%')
            ->get();

             return response()->json([
                'data' => $data,
                'status' => 200],
                Response::HTTP_OK);
    }

// search ambulance
    public function ambulance_search(Request $request)
    {

        if ($request->has(['division_id', 'district_id'])) {
            $data = Ambulance::where(['district_id' => $request->district_id, 'district_id' => $request->district_id])
                ->orderBy('id', 'DESC')->get();

        } elseif ($request->has('district_id')) {
            $data = Ambulance::where(['district_id' => $request->district_id])
                ->orderBy('id', 'DESC')->get();


        } elseif ($request->has('division_id')) {

            $data = Ambulance::where(['division_id' => $request->division_id])->orderBy('id', 'DESC')->get();
        } else {
            $data = Ambulance::orderBy('id', 'DESC')->get();
        }

        if (count($data) > 0) {
            return response()->json([
                'data' => $data,
                'status' => 200],
                Response::HTTP_OK);
        } else {
            return response()->json([
                'data' => "No data found",
                'status' => 500],
                Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }


// search touring place
    public function touring_place_search(Request $request)
    {

        if ($request->has(['division_id', 'district_id'])) {
            $data = TouringPlace::where(['district_id' => $request->district_id, 'district_id' => $request->district_id])
                ->orderBy('id', 'DESC')->paginate(5);

        } elseif ($request->has('district_id')) {
            $data = TouringPlace::where(['district_id' => $request->district_id])
                ->orderBy('id', 'DESC')->paginate(5);


        } elseif ($request->has('division_id')) {

            $data = TouringPlace::where(['division_id' => $request->division_id])->orderBy('id', 'DESC')->paginate(5);
        } else {
            $data = TouringPlace::orderBy('id', 'DESC')->paginate(5);
        }

        if (count($data) > 0) {
            return response()->json([
                'data' => $data,
                'status' => 200],
                Response::HTTP_OK);
        } else {
            return response()->json([
                'data' => "No data found",
                'status' => 500],
                Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }

// search hotel
    public function hotel_search(Request $request)
    {

        if ($request->has(['division_id', 'district_id'])) {
            $data = Hotel::where(['district_id' => $request->district_id, 'district_id' => $request->district_id])
                ->orderBy('id', 'DESC')->get();

        } elseif ($request->has('district_id')) {
            $data = Hotel::where(['district_id' => $request->district_id])
                ->orderBy('id', 'DESC')->get();


        } elseif ($request->has('division_id')) {

            $data = Hotel::where(['division_id' => $request->division_id])->orderBy('id', 'DESC')->get();
        } else {
            $data = Hotel::orderBy('id', 'DESC')->get();
        }

        if (count($data) > 0) {
            return response()->json([
                'data' => $data,
                'status' => 200],
                Response::HTTP_OK);
        } else {
            return response()->json([
                'data' => "No data found",
                'status' => 500],
                Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }

    public function search_hospital(Request $request)
    {

        if ($request->has(['division_id', 'district_id'])) {
            $data = Hospital::where(['district_id' => $request->district_id, 'district_id' => $request->district_id])
                ->orderBy('id', 'DESC')->get();

        } elseif ($request->has('district_id')) {
            $data = Hospital::where(['district_id' => $request->district_id])
                ->orderBy('id', 'DESC')->get();


        } elseif ($request->has('division_id')) {

            $data = Hospital::where(['division_id' => $request->division_id])->orderBy('id', 'DESC')->get();
        } else {
            $data = Hospital::orderBy('id', 'DESC')->get();
        }

        if (count($data) > 0) {
            return response()->json([
                'data' => $data,
                'status' => 200],
                Response::HTTP_OK);
        } else {
            return response()->json([
                'data' => "No data found",
                'status' => 500],
                Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

// search blood bank
    public function blood_bank_search(Request $request)
    {

        if ($request->has(['division_id', 'district_id'])) {
            $data = BloodBank::where(['district_id' => $request->district_id, 'district_id' => $request->district_id])
                ->orderBy('id', 'DESC')->get();

        } elseif ($request->has('district_id')) {
            $data = BloodBank::where(['district_id' => $request->district_id])
                ->orderBy('id', 'DESC')->get();


        } elseif ($request->has('division_id')) {

            $data = BloodBank::where(['division_id' => $request->division_id])->orderBy('id', 'DESC')->get();
        } else {
            $data = BloodBank::orderBy('id', 'DESC')->get();
        }

        if (count($data) > 0) {
            return response()->json([
                'data' => $data,
                'status' => 200],
                Response::HTTP_OK);
        } else {
            return response()->json([
                'data' => "No data found",
                'status' => 500],
                Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    //make blood request

    public function blood_request(Request $request)
    {

        $this->validate($request, [

            'hospital_name' => 'required|string',
            'address' => 'required',
            'phone' => 'required|string',
            'blood_needed' => 'required',
            'blood_group' => 'required|string',
        ]);

        $data = new BloodRequest();
        $data->hospital_name = $request->hospital_name;
        $data->requester_id = Auth::user()->id;
        $data->address = $request->address;
        $data->phone = $request->phone;
        $data->blood_group = $request->blood_group;
        $data->blood_needed = $request->blood_needed;
        $data->when_needed = $request->when_needed;
        $insert = $data->save();

        $users = User::where('blood_group', $request->blood_group)
            ->where('id', '!=', Auth::user()->id)
            ->get();


        $SERVER_API_KEY = Helper::server_api_key();
        $device_token = [];

        foreach ($users as $user) {
            if ($user->token != null) {
                $device_token[] = $user->token;
            }
        }
        $data_info = [
            "registration_ids" => $device_token, //this is for multiple users
            "priority" => "high",
            "notification" => [
                "title" => 'You have a new blood request from ' . Auth::user()->name,
                'body' => "Hospital " . $request->hospital_name . ' Blood group ' . $request->blood_group
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
        $response = curl_exec($ch);
        curl_close($ch);

        $notify = new PushNotification();
        $notify->notify_from = Auth::user()->id;
        $notify->blood_request_id = $data->id;
        $notify->title = "You have new blood request from " . Auth::user()->name;
        $notify->message = "Blood group " . $request->blood_group . ' Hospital ' . $request->hospital_name;
        $notify->blood_needed = $request->blood_needed;
        $notify->type = "blood";
        $notify->blood_group = $request->blood_group;

        $notify->save();


        if ($insert) {
            return response()->json([
                'data' => 'your request is sent successfully',
                'status' => 200], Response::HTTP_CREATED);
        } else {
            return response()->json([
                'data' => 'Something went wrong',
                'status' => 500], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    // my all blood request
    public function get_blood_request()
    {
        $user = Auth::user();
        $data = BloodRequest::where('blood_group', $user->blood_group)->get();
        if (count($data) > 0) {
            return response()->json(['data' => $data, 'status' => 200], Response::HTTP_OK);
        } else {
            return response()->json(['data' => "No data found", 'status' => 500], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }

    // my last blood request
    public function get_last_blood_request()
    {
        $user = Auth::user();
        $data = BloodRequest::where('blood_group', $user->blood_group)->latest()->first();
        if (!is_null($data)) {
            return response()->json(['data' => $data, 'status' => 200], Response::HTTP_OK);
        } else {
            return response()->json(['data' => "No data found", 'status' => 500], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }

    // my all notification
    public function notification()
    {

        $data = Notification::latest()->get();
        if (count($data) > 0) {
            return response()->json(['data' => $data, 'status' => 200], Response::HTTP_OK);
        } else {
            return response()
                ->json(['data' => "No data found", 'status' => 500], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }


    public function get_division()
    {
        $data = Division::latest()->get();
        if (count($data) > 0) {
            return response()->json(['data' => $data, 'status' => 200], Response::HTTP_OK);
        } else {
            return response()
                ->json(['data' => "No data found", 'status' => 500], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }

    public function get_district($id)
    {
        $data = District::where('division_id', $id)->get();
        if (count($data) > 0) {
            return response()->json(['data' => $data, 'status' => 200], Response::HTTP_OK);
        } else {
            return response()
                ->json(['data' => "No data found", 'status' => 500], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }

    public function get_push_notify()
    {

             $notifications = PushNotification::with('seen_notification','notify_from', 'notify_to','blood_request')
            ->where('notify_to', Auth::user()->id)
            ->orWhere('blood_group', Auth::user()->blood_group)
            ->latest()->get();


            foreach ($notifications as $key=> $notify) {
                $check_notify=UserNotification::where('notification_id',$notify->id)
                ->where('user_id',Auth::user()->id)
                ->first();

                if (is_null($check_notify)) {
                    $user_notification=new UserNotification();
                    $user_notification->blood_request_id=$notify->blood_request_id;
                    $user_notification->notify_from     =$notify->notify_from;
                    $user_notification->notify_to       =$notify->notify_to;
                    $user_notification->notification_id =$notify->id;
                    $user_notification->user_id         =Auth::user()->id;
                    $user_notification->title           =$notify->title;
                    $user_notification->message         =$notify->message;
                    $user_notification->type            =$notify->type;
                    $user_notification->needed_blood    =$notify->blood_needed;
                    $user_notification->collected_blood =$notify->blood_collected;
                    $user_notification->created_at      =$notify->created_at;
                    $user_notification->updated_at      =$notify->updated_at;
                    $user_notification->save();
                    
                }
            }


               $data=UserNotification::where('user_id',Auth::user()->id)->get();
               $unseen_notify=UserNotification::where('user_id',Auth::user()->id)
               ->where('seen_or_unseen',0)->count();
              

               
                      $notify_info = array(
                             'notifications' => $data,
                             'total_notification'=>count($data),
                             'unseen_notify'=>$unseen_notify
                        );

        return response()->json([
            'data' => $notify_info,
            'status' => 200],
            Response::HTTP_OK);
    }

    public function update_push(Request $request){
               

             $notification=UserNotification::findOrFail($request->id);
             $notification->seen_or_unseen=1;
             $notification->save();
                
           return response()->json([
          'data' => "Notification is seen successfully",
          'status' => 200],
           Response::HTTP_OK);
                

              

    }

    public function donate_blood(Request $request, $id)
    {
        $this->validate($request, [
            'blood_collected' => 'required|numeric'
        ]);

        $notify = PushNotification::findOrFail($id);

           $remain_blood=$notify->blood_needed-$notify->blood_collected;
     
            if ($remain_blood >= $request->blood_collected && $res
                ->blood_collected !=0){

                // update push notification
               $available_blood = $notify->blood_collected;
               $total_collected_blood = $available_blood + $request->blood_collected;
               $notify->blood_collected = $total_collected_blood;
               $notify->save();

               // update user notification
               $user_notification=UserNotification::where('notification_id',$id)->get();

               if (count($user_notification)>0) {

                    foreach ($user_notification as  $user_notify) {
                        
                        $available_user_blood = $user_notify->collected_blood;
                        $total_user_collected_blood = $available_user_blood + $request->blood_collected;
                        $user_notify->collected_blood = $total_user_collected_blood;
                        $user_notify->save();
                    }           
                    
               }
               
              


                // donner list

               $blood_donner=BloodDonner::where('notification_id',$id)
               ->where('user_id',Auth::user()->id)
               ->first();
               if (is_null($blood_donner)) {
                   $donner=new BloodDonner();
                   $donner->notification_id=$id;
                   $donner->user_id=Auth::user()->id;
                   $donner->quantity=$request->blood_collected;
                   $donner->save();
               }else{
                    $current_quantity=$blood_donner->quantity;
                    $total=$current_quantity+$request->blood_collected;
                    $blood_donner->quantity=$total;
                    $blood_donner->save();
                }

                // end donner

               $blood_request=$notify->blood_request;
               if (!is_null($blood_request)){

                   $available_blood_request=$blood_request->blood_collected;
                   $total_blood_request=$available_blood_request+$request->blood_collected;
                   $blood_request->blood_collected=$total_blood_request;
                   $blood_request->save();
               }



         $SERVER_API_KEY = Helper::server_api_key();

          $device_token = $blood_request->requester->token;
       
        $data_info = [
            "to" => $device_token,
            "priority" => "high",
            "notification" => [
                "title" => 'Blood Donation ',
                'body' => Auth::user()->name." wants to donate ".$request->blood_collected." bags blood"
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
        $response = curl_exec($ch);
        curl_close($ch);


               return \response([
                   'message'=>'Blood donated successfully',
                   'status'=>200
               ],Response::HTTP_OK);
            }else{
                return \response([
                    'message'=>'Invalid Blood Entry',
                    'status'=>200
                ],Response::HTTP_OK);
            }
        
    }

    public function donner_list($id){

            $donners=BloodDonner::with('user')->where('notification_id',$id)->get();
              return \response([
                    'data'=>$donners,
                    'status'=>200
                ],Response::HTTP_OK);
    }

    public function check_donner(Request $request){

            $this->validate($request,[
                    'notification_id'=>$request->notification_id
                ]);

            $donner=BloodDonner::where('notification_id',$request->notification_id)
            ->where('user_id',Auth::user()->id)
            ->first();
            if (!is_null($donner)) {
                 return \response([
                    'data'=>"Accepted",
                    'status'=>200,
                    'code'=>1
                ],Response::HTTP_OK);
            }else{
                 return \response([
                    'data'=>"Not Accepted",
                    'status'=>200,
                    'code'=>0
                ],Response::HTTP_OK);
            }

    }


}
