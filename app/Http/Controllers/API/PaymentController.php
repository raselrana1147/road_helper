<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\models\admin\Payment;
use App\models\PaidUser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{

    public function __construct(){
   	   $this->middleware('auth:api');
    }

    public function get_method(){
        $data=DB::table('payments')->get();
        return response()->json([
            'data'=>$data,
            'status'=>200,
        ],Response::HTTP_OK);
    }

    public function paid_user(Request $request){
    	$this->validate($request,[
    		'payment_id'=>'required',
    		'transaction_number'=>'required',
    		'amount'=>'required'
    	]);

        if ($request->isMethod("post")){
            $user=Auth::user();
            $paided_at=date('Y-m-d');
            $expired_at=date('Y-m-d', strtotime("+365 days"));
            $check_paid=PaidUser::where('user_id',$user->id)->first();

            if (is_null($check_paid)){
                $paid_user=new PaidUser();
                $paid_user->transaction_number=$request->transaction_number;
                $paid_user->user_id=$user->id;
                $paid_user->payment_id=$request->payment_id;
                $paid_user->amount=$request->amount;
                $paid_user->paided_at=$paided_at;
                $paid_user->expired_at=$expired_at;
                $paid_user->save();
            }else{
                $check_paid->transaction_number=$request->transaction_number;
                $check_paid->payment_id=$request->payment_id;
                $check_paid->amount=$request->amount;
                $check_paid->paided_at=$paided_at;
                $check_paid->expired_at=$expired_at;
                $check_paid->save();
            }

                $user->is_paid=2;
                $user->paid_at=$paided_at;
                $user->expired_at=$expired_at;
                $user->save();

                return response()->json([
                'data'=>'Now your are a paid user for 1 year.',
                'status'=>200],Response::HTTP_CREATED);
        }

    }
}
