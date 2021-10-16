<?php
namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\admin\Division;
use App\models\admin\District;
use App\models\admin\Ambulance;
use Yajra\DataTables\Facades\DataTables;

class AmbulanceController extends Controller
{
    
    function __construct(){
    	$this->middleware('auth:admin');
    }

    public function datatable(){
        $datas=Ambulance::orderBy('id','DESC')->get();
        return DataTables::of($datas)
       
        ->editColumn('division', function(Ambulance $data) {
            return  $data->division->name;
        })
        ->editColumn('district', function(Ambulance $data) {
            return  $data->district->name;
        })
         ->editColumn('address', function(Ambulance $data) {
            return  htmlspecialchars_decode($data->address);
        })
         ->editColumn('action',function(Ambulance $data){
            return '<a href="'.route('ambulance.edit',$data->id).'" class="btn btn-success btn-sm">
                  <i class="fa fa-edit"></i></a>
                   <a href="javascript:;" class="btn btn-danger btn-sm delete_item" data-action="'.route('ambulance.delete').'"  item_id="'.$data->id.'">
                   <i class="fa fa-trash"></i></a>';
        })
        ->rawColumns(['action'])
        ->make(true);              
    }

    public function index(){
    	

    	return view('admin.ambulance.index');

    }

    public function get_district(Request $request){

           $districts=District::where('division_id',$request->division_id)->get();
           $notification=['alert'=>'success','districts'=>$districts,'status'=>200];

           return json_encode($notification);
    }


    public function createForm(){
    	return view('admin.ambulance.create');
    }


    public function store(Request $request){

         // dd($request->all());

    	 $data=new Ambulance();
    	
      	$data->division_id     =$request->division_id;
        $data->district_id     =$request->district_id;
        $data->help_number     =$request->help_number;
        $data->address         =$request->address;
        $data->email           =$request->email;
        $data->company_name    =$request->company_name;

    	$data->save();

    	$notification=['alert'=>'success','message'=>'Successfully Added','status'=>200];

    	return json_encode($notification);

    }

    public function edit($id){
    	$item=Ambulance::findOrFail($id);
    	return view('admin.ambulance.edit',compact('item'));

    }


    public function update(Request $request){

           // dd($request->all());
    	       	    $data=Ambulance::findOrFail($request->id);
                  $data->division_id     =$request->division_id;
                  $data->district_id     =$request->district_id;
                  $data->help_number     =$request->help_number;
                  $data->address         =$request->address;
                  $data->email           =$request->email;
                  $data->company_name    =$request->company_name;
                  $data->save();
    		
    		$notification=['alert'=>'success','message'=>'Successfully Updated','status'=>200];

    		return json_encode($notification);

    }

    public function destroy(Request $request){
    	
    	$data=Ambulance::findOrFail($request->item_id);
    	$data->delete();
    	$notification=['alert'=>'success','message'=>'Successfully Delete','status'=>200];

    	return json_encode($notification);

    }
}
