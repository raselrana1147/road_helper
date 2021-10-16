<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Auth;
use File;
use Str;
use Image;
use App\models\User;
use Hash;

class ProfileController extends Controller
{
   public function __construct(){
   	   $this->middleware('auth:api');
    }

    public function view_profile(){
    	$data=auth()->user();
    	if (!is_null($data)) {
    		 return response()->json([
    		 	'data'=>$data,
    		 	'status'=>200],Response::HTTP_OK);
    	}else{
    		 return response()->json([
    		 	'data'=>'No data found','status'=>500],
    		 	Response::HTTP_INTERNAL_SERVER_ERROR);
    	}
    	return $data;
    }

    public function update(Request $request){
    	$user=Auth::user();
      $data=User::findOrFail($user->id);

    	$this->validate($request,[
    		'name'       =>'required|string',
    		'email'      =>'required|email|unique:users,email,'.$data->id,
    		'blood_group'=>'required',
    		'avatar'     =>'nullable',
    		'address'    =>'nullable',
    		'father_name'=>'nullable',
    		'mother_name'=>'nullable',
    		'nid'        =>'nullable|unique:users,nid,'.$data->id,
    		'passport'   =>'nullable|unique:users,passport,'.$data->id,
    		'dob'        =>'nullable'
    	]);

    	$data->name       =$request->name;
    	$data->email      =$request->email;
    	$data->blood_group=$request->blood_group;
    	$data->address    =$request->address;
    	$data->father_name=$request->father_name;
    	$data->mother_name=$request->mother_name;
    	$data->nid        =$request->nid;
    	$data->passport   =$request->passport;
    	$data->dob        =$request->dob;

    	if ($request->hasFile('avatar')) {

    		if (File::exists(base_path('/assets/profile_image/'.$data->avatar))) {
    		    File::delete(base_path('/assets/profile_image/'.$data->avatar));
    		}
    	      $avatar=$request->file('avatar');
             $avatar_name=time().'.'.$avatar->getClientOriginalExtension();
             $image_path=base_path('/assets/profile_image/');
             $image_url=$image_path.$avatar_name;
             $avatar->move($image_path,$avatar_name);
             $data->avatar=$avatar_name;
    	   }

    	   $update=$data->save();
    	   if ($update) {
    	   		return response()
    	   		->json(['data'=>'Successfully Updated','status'=>200],Response::HTTP_CREATED);
    	   }else{
    	   	  return response()->json([
    	   	  'data'=>'Something went wrong',
    	   	  'status'=>500],Response::HTTP_INTERNAL_SERVER_ERROR);
    	   }
    }

    public function change_password(Request $request){

              $this->validate($request,[
                      'current_password'=>'required',
                      'new_password'=>'required|min:4',
                  ]);
               
                $user=Auth::user();
                if ($request->current_password) {
                  if (Hash::check($request->current_password,$user->password)) {
                      if ($request->new_password===$request->password_confirmation) {
                          $user->password=Hash::make($request->new_password);
                             $user->save();
                             return response()->json([
                              'data'=>'Password updated successfully',
                              'status'=>200],Response::HTTP_OK);
                      }else{
                        return response()->json([
                        'data'=>'Confirm password not match',
                        'status'=>409],Response::HTTP_INTERNAL_SERVER_ERROR);
                       
                      }
                  }else{
                    return response()->json([
                    'data'=>'Current Password not match',
                    'status'=>409],Response::HTTP_INTERNAL_SERVER_ERROR);
                  }
                } 
    }


}
