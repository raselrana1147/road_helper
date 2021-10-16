<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\admin\Division;
use App\models\admin\District;
use App\models\admin\BloodBank;
use Yajra\DataTables\Facades\DataTables;

class BloodBankController extends Controller
{
    

    function __construct(){
    	$this->middleware('auth:admin');
    }

        public function datatable(){
             $datas=BloodBank::orderBy('id','DESC')->get();
        return DataTables::of($datas)
       
        ->editColumn('division', function(BloodBank $data) {
            return  $data->division->name;
        })
        ->editColumn('district', function(BloodBank $data) {
            return  $data->district->name;
        })
        ->editColumn('address', function(BloodBank $data) {
            return  htmlspecialchars_decode($data->address);
        })
         ->editColumn('action',function(BloodBank $data){
            return '<a href="'.route('blood_bank.edit',$data->id).'" class="btn btn-success btn-sm">
                  <i class="fa fa-edit"></i></a>
                   <a href="javascript:;" class="btn btn-danger btn-sm delete_item" data-action="'.route('blood_bank.delete').'"  item_id="'.$data->id.'">
                   <i class="fa fa-trash"></i></a>';
        })
        ->rawColumns(['address','action'])
        ->make(true);  
   }

    public function index(){
    	return view('admin.blood_bank.index');
    }


    public function createForm(){
    	return view('admin.blood_bank.create');
    }


    public function store(Request $request){

      
    		
    	$data=new BloodBank();
    	$data->bank_name       =$request->bank_name;
        $data->help_number     =$request->help_number;
        $data->email           =$request->email;
    	$data->division_id     =$request->division_id;
        $data->district_id     =$request->district_id;
        $data->address         =$request->address;
    	$data->save();
    

    	$notification=['alert'=>'success','message'=>'Successfully Added','status'=>200];

    	return json_encode($notification);

    }

    public function edit($id){
    	$item=BloodBank::findOrFail($id);
    	return view('admin.blood_bank.edit',compact('item'));

    }


    public function update(Request $request){

           // dd($request->all());
    		$data=BloodBank::findOrFail($request->id);
    	   	  
    	   	       $data->bank_name       =$request->bank_name;
                   $data->help_number     =$request->help_number;
                   $data->email           =$request->email;
                   $data->division_id     =$request->division_id;
                   $data->district_id     =$request->district_id;
                   $data->address         =$request->address;
                   $data->save();
    		
    		$notification=['alert'=>'success','message'=>'Successfully Updated','status'=>200];

    		return json_encode($notification);

    }

    public function destroy(Request $request){
    	
    	$data=BloodBank::findOrFail($request->item_id);
    	$data->delete();
    	$notification=['alert'=>'success','message'=>'Successfully Delete','status'=>200];
    	return json_encode($notification);
    }
}
