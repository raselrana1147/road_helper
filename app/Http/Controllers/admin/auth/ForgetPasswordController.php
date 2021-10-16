<?php

namespace App\Http\Controllers\admin\auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\Admin\Admin;
use Illuminate\Support\Facades\Auth;
use Mail;
use App\Mail\AdminForgetPassword;
use Str;
use Hash;


class ForgetPasswordController extends Controller
{
 
    public function __construct()
    {
       $this->middleware('guest:admin');
    }

   public function showLinkRequestForm()
   {
       return view('admin.auth.email');
   }

   public function send_link(Request $request){
        
        $email=$request->email;
        $token=strtolower(Str::random(80));
        $admin=Admin::where('email',$email)->first();
        if (!is_null($admin)) {

            $admin->remember_token=$token;
            $admin->save();
            Mail::send(new AdminForgetPassword($email,$token));
            $notification=['alert'=>'success','message'=>'You have sent an email.Please check your email.','status'=>200];
            return json_encode($notification);
        }else{

            $notification=['alert'=>'error','message'=>'Account not found','status'=>500];
            return json_encode($notification);
        }
       
        
    }

    public function reset_form($token){

        return view('admin.auth.forget_password',compact('token'));
      
    }

    public function set_password(Request $request){
        $data=Admin::where('remember_token',$request->remember_token)->first();

        if (!is_null($data)) {
            $data->password=Hash::make($request->password);
            $data->remember_token=null;
            $data->save();
            $notification=['alert'=>'success','message'=>'Password reset successfully','status'=>200];
            return json_encode($notification);
        }else{
             $notification=['alert'=>'error','message'=>'Token has been expired','status'=>500];
            return json_encode($notification);
        }


    }
}
