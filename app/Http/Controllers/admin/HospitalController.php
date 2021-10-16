<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\admin\Hospital;
use App\models\admin\Division;
use App\models\admin\District;
use Yajra\DataTables\Facades\DataTables;

class HospitalController extends Controller
{
    function __construct(){
    	$this->middleware('auth:admin');
    }
    public function datatable(){
         $datas=Hospital::orderBy('id','DESC')->get();
        return DataTables::of($datas)

         ->editColumn('description',function(Hospital $data){
                return '<a href="javascript:;" data_id="'.$data->id.'" data-action="'.route('show.hospital.detail').'" class="btn bg-gradient-primary btn-sm show-modal"> <i class="fa fa-eye"></i>  View</a>';
         })
        ->editColumn('division',function(Hospital $data){
            return $data->division->name;
        })
        ->editColumn('district',function(Hospital $data){
                return $data->district->name;
         })
        ->editColumn('action',function(Hospital $data){
            return '<a href="'.route('hospital.edit',$data->id).'" class="btn btn-success btn-sm">
                  <i class="fa fa-edit"></i>
                  Edit</a>
                   <a href="javascript:;" class="btn btn-danger btn-sm delete_item" data-action="'.route('hospital.delete').'"  item_id="'.$data->id.'">
                   <i class="fa fa-trash"></i>
                  Delete</a>';
        })
       ->rawColumns(['description','division','district','action'])
        ->make(true);
    }
    public function index(){
    	$items=Hospital::latest()->get();

    	return view('admin.hospital.index',compact('items'));

    }

    public function get_district(Request $request){

           $districts=District::where('division_id',$request->division_id)->get();
           $notification=['alert'=>'success','districts'=>$districts,'status'=>200];

           return json_encode($notification);
    }


    public function createForm(){
    	return view('admin.hospital.create');
    }


    public function store(Request $request){

       

    	$data=new Hospital();
    	$data->hospital_name   =$request->hospital_name;
    	$data->division_id     =$request->division_id;
      $data->district_id     =$request->district_id;
      $data->help_number     =$request->help_number;
      $data->address         =$request->address;
  
    	$data->save();
    

    	$notification=['alert'=>'success','message'=>'Successfully Added','status'=>200];

    	return json_encode($notification);

    }

    public function edit($id){
    	$item=Hospital::findOrFail($id);
    	return view('admin.hospital.edit',compact('item'));

    }


    public function update(Request $request){

           // dd($request->all());
    		$data=Hospital::findOrFail($request->id);

    	   	   $data->hospital_name   =$request->hospital_name;
    	       $data->division_id     =$request->division_id;
    	       $data->district_id     =$request->district_id;
    	       $data->help_number     =$request->help_number;
    	       $data->address         =$request->address;
              $data->save();
    		
    		$notification=['alert'=>'success','message'=>'Successfully Updated','status'=>200];

    		return json_encode($notification);

    }

    public function destroy(Request $request){
    	
    	$data=Hospital::findOrFail($request->item_id);
    	$data->delete();
    	$notification=['alert'=>'success','message'=>'Successfully Delete','status'=>200];
    	return json_encode($notification);

    }

    public function hospital_detail(Request $request){
               $data=Hospital::findOrFail($request->data_id);
               return json_encode($data);
      }
}
