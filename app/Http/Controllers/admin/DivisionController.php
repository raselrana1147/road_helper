<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\admin\Division;
use Yajra\DataTables\Facades\DataTables;
class DivisionController extends Controller
{
    
    function __construct(){
    	$this->middleware('auth:admin');
    }

    public function datatable(){
          $datas=Division::orderBy('id','DESC')->get();
        return DataTables::of($datas)
            ->editColumn('action',function(Division $data){
            return '<a href="'.route('division.edit',$data->id).'" class="btn btn-success btn-sm">
                  <i class="fa fa-edit"></i>
                  Edit</a>
                   <a href="javascript:;" class="btn btn-danger btn-sm delete_item" data-action="'.route('division.delete').'"  item_id="'.$data->id.'">
                   <i class="fa fa-trash"></i>
                  Delete</a>';
        })
       ->rawColumns(['action'])
        ->make(true);                           
    }

    public function index(){
                                
    	return view('admin.division.index');

    }

    public function createForm(){
    	return view('admin.division.create');
    }

    public function store(Request $request){


    	$this->validate($request,[
    		'name'=>'required|unique:divisions',
    		'division_code'=>'required|unique:divisions'
         ]);

    	$data=new Division();
    	$data->name=$request->name;
    	$data->division_code=$request->division_code;
    	$data->save();
    

    	$notification=['alert'=>'success','message'=>'Successfully Added','status'=>200];

    	return json_encode($notification);

    }

    public function edit($id){
    	$item=Division::findOrFail($id);
    	return view('admin.division.edit',compact('item'));

    }

    public function update(Request $request){
    		$data=Division::findOrFail($request->id);

    		$this->validate($request,[
    			'name'=>'required|unique:divisions,name,'.$data->id,
    			'division_code'=>'required|unique:divisions,division_code,'.$data->id
    	     ]);

    		$data->name=$request->name;
    		$data->division_code=$request->division_code;
    		$data->save();
    		

    		$notification=['alert'=>'success','message'=>'Successfully Updated','status'=>200];

    		return json_encode($notification);

    }

    public function destroy(Request $request){
    	//dd($request->all());
    	$data=Division::findOrFail($request->item_id);
    	$data->delete();
    	$notification=['alert'=>'success','message'=>'Successfully Delete','status'=>200];

    	return json_encode($notification);

    }
}
