<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\admin\Division;
use App\models\admin\District;
use App\models\admin\TouringPlace;
use File;
use Illuminate\Support\Str;
use Image;
use Yajra\DataTables\Facades\DataTables;

class TouringPlaceController extends Controller
{

    function __construct(){
    	$this->middleware('auth:admin');
    }

    public function datable(){
                                  
        $datas=TouringPlace::orderBy('id','DESC')->get();
        return DataTables::of($datas)
         ->editColumn('image', function(TouringPlace $data) {
            if ($data->image)
                {
                    $url=asset("assets/backend/touring/$data->image");
                    return '<img src='.$url.' border="0" width="240" height="80" class="img-rounded" align="center" />';  
                }
        })
        
        ->editColumn('division', function(TouringPlace $data) {
            return  $data->division->name;
        })
        ->editColumn('district', function(TouringPlace $data) {
            return  $data->district->name;
        })
         ->editColumn('description',function(TouringPlace $data){
              return '<a href="javascript:;" tour_id="'.$data->id.'" data-action="'.route('show.tour.detail').'" class="btn bg-gradient-primary btn-sm show-modal"> <i class="fa fa-eye"></i>  View</a>';
        })
         ->editColumn('action',function(TouringPlace $data){
            return '<a href="'.route('touring_place.edit',$data->id).'" class="btn btn-success btn-sm">
                  <i class="fa fa-edit"></i>
                  </a>
                   <a href="javascript:;" class="btn btn-danger btn-sm delete_item" data-action="'.route('touring_place.delete').'"  item_id="'.$data->id.'">
                   <i class="fa fa-trash"></i></a>';
        })
        ->rawColumns(['image','description','action'])
        ->make(true);
    }

    public function index(){

    	return view('admin.touring_place.index');

    }

    public function tour_detail(Request $resquest){
            $tour=TouringPlace::findOrFail($resquest->tour_id);
            return json_encode($tour);
    }

    public function get_district(Request $request){

           $districts=District::where('division_id',$request->division_id)->get();
           $notification=['alert'=>'success','districts'=>$districts,'status'=>200];

           return json_encode($notification);
    }


    public function createForm(){
    	return view('admin.touring_place.create');
    }


    public function store(Request $request){
    	$data=new TouringPlace();
    	$data->place_name      =$request->place_name;
    	$data->division_id     =$request->division_id;
        $data->district_id     =$request->district_id;
        $data->address         =$request->address;
        $data->help_number     =$request->help_number;
        $data->email           =$request->email;

        if ($request->hasFile('image')) {

            $image=$request->image;
            $image_name=strtolower(Str::random(10)).time().".".$image->getClientOriginalExtension();
            $location=base_path('/assets/backend/touring/'.$image_name);
            Image::make($image)->save($location);
            $data->image=$image_name;
        }

    	$data->save();
    	$notification=['alert'=>'success','message'=>'Successfully Added','status'=>200];

    	return json_encode($notification);

    }

    public function edit($id){
    	$item=TouringPlace::findOrFail($id);
    	return view('admin.touring_place.edit',compact('item'));

    }


    public function update(Request $request){

           // dd($request->all());
    		$data=TouringPlace::findOrFail($request->id);

    	   	       $data->place_name      =$request->place_name;
                   $data->division_id     =$request->division_id;
                   $data->district_id     =$request->district_id;
                   $data->address         =$request->address;
                   $data->help_number     =$request->help_number;
                   $data->email           =$request->email;


        if ($request->hasFile('image')) {

            if (File::exists(base_path('/assets/backend/touring/'.$data->image))) {
                File::delete(base_path('/assets/backend/touring/'.$data->image));
            }

            $image=$request->image;
            $image_name=strtolower(Str::random(10)).time().".".$image->getClientOriginalExtension();
            $location=base_path('/assets/backend/touring/'.$image_name);
            Image::make($image)->save($location);
            $data->image=$image_name;
        }

        $data->save();

    		    $notification=['alert'=>'success','message'=>'Successfully Updated','status'=>200];

    		  return json_encode($notification);

    }

    public function destroy(Request $request){

    	$data=TouringPlace::findOrFail($request->item_id);
    	$data->delete();
    	$notification=['alert'=>'success','message'=>'Successfully Delete','status'=>200];

    	return json_encode($notification);

    }
}
