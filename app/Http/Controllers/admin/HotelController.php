<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\admin\Division;
use App\models\admin\District;
use App\models\admin\Hotel;
use Yajra\DataTables\Facades\DataTables;
class HotelController extends Controller
{
    
    function __construct(){
    	$this->middleware('auth:admin');
    }

    public function datatable(){
             $datas=Hotel::orderBy('id','DESC')->get();
        return DataTables::of($datas)
       
        ->editColumn('division', function(Hotel $data) {
            return  $data->division->name;
        })
        ->editColumn('district', function(Hotel $data) {
            return  $data->district->name;
        })
        ->editColumn('address', function(Hotel $data) {
            return  htmlspecialchars_decode($data->address);
        })
         ->editColumn('action',function(Hotel $data){
            return '<a href="'.route('hotel.edit',$data->id).'" class="btn btn-success btn-sm">
                  <i class="fa fa-edit"></i></a>
                   <a href="javascript:;" class="btn btn-danger btn-sm delete_item" data-action="'.route('hotel.delete').'"  item_id="'.$data->id.'">
                   <i class="fa fa-trash"></i></a>';
        })
        ->rawColumns(['action','address'])
        ->make(true);  
   }
    public function index(){
    	
    	return view('admin.hotel.index');
    }


    public function createForm(){
    	return view('admin.hotel.create');
    }


    public function store(Request $request){

      
    	$data=new Hotel();
    	$data->hotel_name      =$request->hotel_name;
    	$data->division_id     =$request->division_id;
        $data->district_id     =$request->district_id;
        $data->address         =$request->address;
        $data->help_number     =$request->help_number;
        $data->email           =$request->email;
    	$data->save();

    	$notification=['alert'=>'success','message'=>'Successfully Added','status'=>200];

    	return json_encode($notification);

    }

    public function edit($id){
    	$item=Hotel::findOrFail($id);
    	return view('admin.hotel.edit',compact('item'));

    }


    public function update(Request $request){

           // dd($request->all());
    		$data=Hotel::findOrFail($request->id);
    	   	  
    	   	   $data->hotel_name=$request->hotel_name;
    	   	   	$data->division_id=$request->division_id;
    	   	    $data->district_id=$request->district_id;
    	   	    $data->address    =$request->address;
                $data->help_number     =$request->help_number;
                $data->email           =$request->email;
                $data->save();
    		
    		$notification=['alert'=>'success','message'=>'Successfully Updated','status'=>200];

    		return json_encode($notification);

    }

    public function destroy(Request $request){
    	
    	$data=Hotel::findOrFail($request->item_id);
    	$data->delete();
    	$notification=['alert'=>'success','message'=>'Successfully Delete','status'=>200];
    	return json_encode($notification);
    }

    
}
