<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\models\admin\Division;
use App\models\admin\District;
use App\models\admin\PoliceStation;
use Yajra\DataTables\Facades\DataTables;

class PoliceController extends Controller
{
    

    function __construct(){
    	$this->middleware('auth:admin');
    }

    public function datatable(){
         $datas=PoliceStation::orderBy('id','DESC')->get();
        return DataTables::of($datas)
       
        ->editColumn('division', function(PoliceStation $data) {
            return  $data->division->name;
        })
        ->editColumn('district', function(PoliceStation $data) {
            return  $data->district->name;
        })
        ->editColumn('address', function(PoliceStation $data) {
            return  htmlspecialchars_decode($data->address);
        })
         ->editColumn('action',function(PoliceStation $data){
            return '<a href="'.route('police_station.edit',$data->id).'" class="btn btn-success btn-sm">
                  <i class="fa fa-edit"></i>
                  </a>
                   <a href="javascript:;" class="btn btn-danger btn-sm delete_item" data-action="'.route('police_station.delete').'"  item_id="'.$data->id.'">
                   <i class="fa fa-trash"></i></a>';
        })
        ->rawColumns(['division','district','address','action'])
        ->make(true);
    }

    public function index(){

    	return view('admin.police_station.index');

    }

    public function get_district(Request $request){

           $districts=District::where('division_id',$request->division_id)->get();
           $notification=['alert'=>'success','districts'=>$districts,'status'=>200];

           return json_encode($notification);
    }


    public function createForm(){
    	return view('admin.police_station.create');
    }


    public function store(Request $request){

          //dd($request->all());
    	

    	$data=new PoliceStation();
    	$data->station_name=$request->station_name;
    	$data->division_id =$request->division_id;
        $data->district_id =$request->district_id;
        $data->help_number =$request->help_number;
        $data->fax         =$request->fax;
        $data->email       =$request->email;
        $data->latitute    =$request->latitute;
        $data->logitute    =$request->logitute;
    	$data->address     =$request->address;
    	$data->save();
    

    	$notification=['alert'=>'success','message'=>'Successfully Added','status'=>200];

    	return json_encode($notification);

    }

    public function edit($id){
    	$item=PoliceStation::findOrFail($id);
    	return view('admin.police_station.edit',compact('item'));

    }


    public function update(Request $request){

            //dd($request->all());
    		$data=PoliceStation::findOrFail($request->id);

    	    $data->station_name=$request->station_name;
            $data->division_id =$request->division_id;
            $data->district_id =$request->district_id;
            $data->help_number =$request->help_number;
            $data->fax         =$request->fax;
            $data->email       =$request->email;
            $data->latitute    =$request->latitute;
            $data->logitute    =$request->logitute;
            $data->address     =$request->address;
            $data->save();
    		
    		$notification=['alert'=>'success','message'=>'Successfully Updated','status'=>200];

    		return json_encode($notification);

    }

    public function destroy(Request $request){
    	
    	$data=PoliceStation::findOrFail($request->item_id);
    	$data->delete();
    	$notification=['alert'=>'success','message'=>'Successfully Delete','status'=>200];

    	return json_encode($notification);

    }

}
