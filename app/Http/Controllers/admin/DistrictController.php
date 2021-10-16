<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\admin\Division;
use App\models\admin\District;
use Yajra\DataTables\Facades\DataTables;

class DistrictController extends Controller
{
    
    function __construct(){
    	$this->middleware('auth:admin');
    }


    public function datatable(){

        $datas=District::orderBy('id','DESC')->get();
        return DataTables::of($datas)
        ->editColumn('division',function(District $data){
            return $data->division->name;
        })
        ->editColumn('action',function(District $data){
            return '<a href="'.route('district.edit',$data->id).'" class="btn btn-success btn-sm">
                  <i class="fa fa-edit"></i>
                  Edit</a>
                   <a href="javascript:;" class="btn btn-danger btn-sm delete_item" data-action="'.route('district.delete').'"  item_id="'.$data->id.'">
                   <i class="fa fa-trash"></i>
                  Delete</a>';
        })
       ->rawColumns(['division','action'])
        ->make(true);

    }

    public function index(){

    	return view('admin.district.index');
    }


    public function createForm(){
    	return view('admin.district.create');
    }


    public function store(Request $request){

    	//dd($request->all());
    	$this->validate($request,[
    		'name'=>'required|unique:districts',
    		'district_code'=>'required|unique:districts'
         ]);

    	$data=new District();
    	$data->name=$request->name;
    	$data->district_code=$request->district_code;
    	$data->division_id=$request->division_id;
    	$data->save();
    

    	$notification=['alert'=>'success','message'=>'Successfully Added','status'=>200];

    	return json_encode($notification);

    }

    public function edit($id){
    	$item=District::findOrFail($id);
    	return view('admin.district.edit',compact('item'));

    }


    public function update(Request $request){

    		$data=District::findOrFail($request->id);

    		$this->validate($request,[
    			'name'=>'required|unique:districts,name,'.$data->id,
    			'district_code'=>'required|unique:districts,district_code,'.$data->id
    	     ]);

    		$data->name=$request->name;
    		$data->district_code=$request->district_code;
    		$data->division_id=$request->division_id;
    		$data->save();
    		

    		$notification=['alert'=>'success','message'=>'Successfully Updated','status'=>200];

    		return json_encode($notification);

    }

    public function destroy(Request $request){
    	
    	$data=District::findOrFail($request->item_id);
    	$data->delete();
    	$notification=['alert'=>'success','message'=>'Successfully Delete','status'=>200];

    	return json_encode($notification);

    }


}
