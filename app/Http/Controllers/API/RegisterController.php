<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\User;
use Hash;
use Illuminate\Http\Response;
use Image;
use Str;
use App\Libary\Mobile;

class RegisterController extends Controller
{

	public function __construct()
	{
	    $this->middleware('guest:api');
	}

    public function register(Request $request){


    	$this->validate($request,[
    		'name'       =>'required|string',
    		'email'      =>'required|email|unique:users',
    		'phone'      =>'required|unique:users',
        'password'   =>'required',
    		'blood_group'=>'required',
    		'avatar'     =>'nullable|mimes:jpeg,png,jpg,bmp',
    	]);


    	if ($request->isMethod('post')) {
    		$user=new User();
    		$user->name       =$request->name;
    		$user->email      =$request->email;
    		$user->phone      =$request->phone;
    		$user->blood_group=$request->blood_group;
    		$user->password=Hash::make($request->password);

             // save image
            if ($request->hasFile('avatar')) {

                  $avatar=$request->file('avatar');
                  $avatar_name=time().'.'.$avatar->getClientOriginalExtension();
                  $image_path=base_path('/assets/profile_image/');
                  $image_url=$image_path.$avatar_name;
                  $avatar->move($image_path,$avatar_name);
                  $user->avatar=$avatar_name;
                }

                 $insert=$user->save();

                 $mobile_otp=rand(10000,99999);
                 $user->mobile_otp=$mobile_otp;
                 $user->save();

                 $message="Dear user, your registration has been successfully completed. Please use ".$mobile_otp." OTP code to active your account. Road helper";
                 $to=$request->phone;
                 Mobile::send_otp($message,$to);


              if ($insert) {
                   return response()->json([
                   'data'=>'Your Registration is Successfully',
                   'status'=>200],Response::HTTP_CREATED);
              }else{
                  return response()->json([
                 'data'=>'Something went wrong',
                 'status'=>500],Response::HTTP_INTERNAL_SERVER_ERROR);
              }

    	}else{
              return response()->json([
                'data'=>'The uses method is not support',
                'status'=>400],Response::HTTP_INTERNAL_SERVER_ERROR);
           }
      }

      public  function  verify_phone_number(Request $request){
            $this->validate($request,[
                'mobile_otp'=>"required",
            ]);

            $user=User::where('mobile_otp',$request->mobile_otp)->first();
            if (!is_null($user)){
                $user->is_active=2;
                $user->mobile_otp=null;
                $user->save();
                return response()->json([
                    'message'=>'Your account is successfully activated',
                    'status'=>200,
                ],Response::HTTP_OK);

            }else{
                return response()->json([
                    'message'=>'No account is found for this OTP',
                    'status'=>404
                ],Response::HTTP_NOT_FOUND);
            }


      }


      public function forget_otp(Request $request){

            $this->validate($request,[
               'phone'=>'required',
            ]);

            if ($request->isMethod('post')) {
                $user=User::where('phone',$request->phone)->first();
                if (!is_null($user)) {

                   $mobile_otp=rand(10000,99999);
                   $message="Dear user, your OTP code is ".$mobile_otp.".Please use this OTP code to reset your password";
                   $to=$request->phone;
                   Mobile::send_otp($message,$to);
                    $user->mobile_otp=$mobile_otp;
                    $user->save();
                   return response()->json([
                    'message'=>'You have been sent an OTP code to your phone number',
                    'status'=>200,
                    ],Response::HTTP_OK);
                }else{
                     return response()->json([
                    'message'=>'No account is found',
                    'status'=>404
                   ],Response::HTTP_NOT_FOUND);
                }    
            }

      }

      public function forget_password(Request $request){
              $this->validate($request,[
               'mobile_otp'=>'required',
               'password'=>'required'
            ]);

            if ($request->isMethod('post')) {
                $user=User::where('mobile_otp',$request->mobile_otp)->first();
                if (!is_null($user)) {

                    $user->password=Hash::make($request->password);
                    $user->mobile_otp=null;
                    $user->save();
                   return response()->json([
                    'message'=>'Yor password has been reset successfully',
                    'status'=>200,
                    ],Response::HTTP_OK);
                }else{
                     return response()->json([
                    'message'=>'No user is found for this OTP',
                    'status'=>404
                   ],Response::HTTP_NOT_FOUND);
                }    
            }

      }



}
