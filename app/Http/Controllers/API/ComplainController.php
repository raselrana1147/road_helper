<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\Complain;
use Auth;
use Illuminate\Http\Response;
class ComplainController extends Controller
{

	public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function store(Request $request){

    	$this->validate($request,[
    		'subject'=>'required',
    		'description'=>'required'
    	]);
    		if ($request->isMethod('post')){

    			$data=new Complain();
    			$data->subject     =$request->subject;
    			$data->description =$request->description;
    			$data->user_id           =Auth::user()->id;
    			$insert=$data->save();
    	        if ($insert) {
    	           return response()
    	           ->json(['data'=>'Successfully added',
    	            'status'=>200],Response::HTTP_CREATED);
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
}
