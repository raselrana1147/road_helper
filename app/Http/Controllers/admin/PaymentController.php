<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\admin\Payment;
use DB;
use File;
use Illuminate\Support\Str;
use Image;
use Yajra\DataTables\Facades\DataTables;

class PaymentController extends Controller
{

	 function __construct(){
    	$this->middleware('auth:admin');
    }

    public function datatable(){
         $datas=Payment::orderBy('id','DESC')->get();
        return DataTables::of($datas)

            ->editColumn('image',function(Payment $data){
                if ($data->image)
                {
                    $url=asset("assets/backend/payment/".$data->image);
                    return '<img src='.$url.' border="0" width="200" height="80" class="img-rounded" align="center" />';  
                }
            })
       
            ->editColumn('action',function(Payment $data){
            return '<a href="'.route('payment.edit',$data->id).'" class="btn btn-success btn-sm">
                  <i class="fa fa-edit"></i>
                  Edit</a>
                   <a href="javascript:;" class="btn btn-danger btn-sm delete_item" data-action="'.route('payment.delete').'"  item_id="'.$data->id.'">
                   <i class="fa fa-trash"></i>
                  Delete</a>';
        })
       ->rawColumns(['image','action'])
        ->make(true);                  
    }
     public function index(){
    	$payments=DB::table('payments')->get();

    	return view('admin.payment.index',compact('payments'));
    }

    public function create(){
    	return view('admin.payment.create');
    }

    public function store(Request $request){
    	$data=new Payment();
    	$data->operator_name =$request->operator_name;
    	$data->banking_number=$request->banking_number;
        $data->ref_number    =$request->ref_number;
        $data->type          =$request->type;
        

        if ($request->hasFile('image')) {

            $image=$request->image;
            $image_name=strtolower(Str::random(10)).time().".".$image->getClientOriginalExtension();
            $location=base_path('/assets/backend/payment/'.$image_name);
            Image::make($image)->save($location);
            $data->image=$image_name;
        }

    	$data->save();
    	$notification=['alert'=>'success','message'=>'Successfully Added','status'=>200];
    	return json_encode($notification);
    }

    public  function edit($id){
    	$item=Payment::findOrFail($id);
    	return view('admin.payment.edit',compact('item'));
    }

    public function update(Request $request){
    	 // dd($request->all());
	      $data=Payment::findOrFail($request->id);

   	       $data->operator_name =$request->operator_name;
           $data->banking_number=$request->banking_number;
           $data->ref_number    =$request->ref_number;
           $data->type           =$request->type;
                   
        if ($request->hasFile('image')) {

            if (File::exists(base_path('/assets/backend/payment/'.$data->image))) {
                File::delete(base_path('/assets/backend/payment/'.$data->image));
            }

            $image=$request->image;
            $image_name=strtolower(Str::random(10)).time().".".$image->getClientOriginalExtension();
            $location=base_path('/assets/backend/payment/'.$image_name);
            Image::make($image)->save($location);
            $data->image=$image_name;
        }

        $data->save();
    	$notification=['alert'=>'success','message'=>'Successfully Updated','status'=>200];
        return json_encode($notification);
    }

    public function destroy(Request $request){
    	$data=Payment::findOrFail($request->item_id);
    	if (File::exists(base_path('/assets/backend/payment/'.$data->image))) {
             File::delete(base_path('/assets/backend/payment/'.$data->image));
         }
    	$data->delete();
    	$notification=['alert'=>'success','message'=>'Successfully Delete','status'=>200];
    	return json_encode($notification);
    }
}
