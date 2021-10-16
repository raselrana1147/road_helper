<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\admin\Admin;
use Image;
use Str;
use Hash;
use App\models\BloodRequest;
use App\models\User;
use File;
use Yajra\DataTables\Facades\DataTables;
use App\models\Complain;
use Carbon\Carbon;

class AdminController extends Controller
{
    

    function __construct(){
    	$this->middleware('auth:admin');
    }

    public function index(){
    	return view('admin.home');
    }

    public function profile(){

    	return view('admin.profile.profile');
    }

    public function paid_status(Request $request){
            $data=User::find($request->id);
            if ($data->is_paid==1) {
                $data->is_paid=2;
            }else{
                 $data->is_paid=1;
            }
            $data->save();
            $notification=['alert'=>'success','message'=>'Successfully updated','status'=>200];

           return json_encode($notification);

    }

    public function update(Request $request){
        
          	
    	$data=Admin::findOrFail($request->id);
    	$data->name=$request->name;
    	$data->phone=$request->phone;

        if ($request->hasFile('avatar')) {
                                              
         if (File::exists(base_path('/assets/backend/profile/'.$data->avatar))) {
             File::delete(base_path('/assets/backend/profile/'.$data->avatar));
         }

           $avatar=$request->avatar;
           $avatar_name=strtolower(Str::random(10)).time().".".$avatar->getClientOriginalExtension();
           $location=base_path('/assets/backend/profile/'.$avatar_name);
           Image::make($avatar)->save($location);

            $data->avatar=$avatar_name;
        }

    	$data->save();
    	$notification=['alert'=>'success','message'=>'Successfully updated','status'=>200];

    	return json_encode($notification);
    }

    public function password_form(){

    	return view('admin.profile.password');
    }

    public function password_change(Request $request){

    		   $admin=Admin::findOrFail($request->id);

    		    if ($request->cpass) {
    		      if (Hash::check($request->cpass,$admin->password)) {
    		          if ($request->npass==$request->password_confirmation) {
    		              $admin->password=Hash::make($request->npass);
    		                 $admin->save();
    		                 $notification=['alert'=>'error','message'=>'Password Successfully updated','status'=>200];
    		          }else{
    		           $notification=['alert'=>'error','message'=>'Confirm password not match','status'=>500];
    		           
    		          }
    		      }else{
    		          $notification=['alert'=>'error','message'=>'Old Password not match','status'=>500];
    		       // return redirect()->back()->with($notification);
    		      }
    		    } 


    		return json_encode($notification);
    }

    public function datatable_blood_request(){
        $datas=BloodRequest::orderBy('id','DESC')->get();
        return DataTables::of($datas)
        ->editColumn('request_at',function(BloodRequest $data){
            return $data->created_at->diffForHumans();
        })
       ->rawColumns(['request_at'])
        ->make(true);
    }

     public function blood_request(){
        return view('admin.blood_request');
    }

    public function user_datatable(){
        $datas=User::latest()->get();
        return DataTables::of($datas)
        ->editColumn('image',function(User $data){
                 $url=$data->avatar !=null ? asset("assets/profile_image/".$data->avatar) : asset("assets/profile_image/default.jpg");

                return '<img src='.$url.' border="0" width="150" height="80" class="img-rounded" align="center" />';       
        })
        ->editColumn('detail',function(User $data){

            return '<a href="javascript:;" user_id="'.$data->id.'" data-action="'.route('show.user.detail').'" class="btn bg-gradient-primary btn-sm show-modal"> <i class="fa fa-eye"></i>  View</a>';
        })
        ->editColumn('is_paid',function(User $data){
                 $paid = $data->is_paid == 2 ? 'selected' : '';
                 $unpaid = $data->is_paid == 1 ? 'selected' : '';
                return '<select class="form-control chnagePaidStatus" item_id="'.$data->id.'" data-action="'.route('user.paid.status').'">
                       <option value="2" '.$paid.' >Paid</option>
                       <option value="1" '.$unpaid.' >Unpaid</option>
                  </select>';
        })
       ->rawColumns(['image','detail','is_paid'])
        ->make(true);

    }

    public function paid_user_datatable(){

         $datas=User::latest()->where('is_paid','=','2')->where('is_check','=',"1")->get();
        return DataTables::of($datas)
        ->editColumn('image',function(User $data){
                 $url=$data->avatar !=null ? asset("assets/profile_image/".$data->avatar) : asset("assets/profile_image/default.jpg");

                return '<img src='.$url.' border="0" width="150" height="80" class="img-rounded" align="center" />';       
        })
        ->editColumn('detail',function(User $data){

            return '<a href="javascript:;" user_id="'.$data->id.'" data-action="'.route('show.user.detail').'" class="btn bg-gradient-primary btn-sm show-modal"> <i class="fa fa-eye"></i>  View</a>';
        })
        ->editColumn('is_paid',function(User $data){
                 $paid = $data->is_paid == 2 ? 'selected' : '';
                 $unpaid = $data->is_paid == 1 ? 'selected' : '';
                return '<select class="form-control chnagePaidStatus" item_id="'.$data->id.'" data-action="'.route('user.paid.status').'">
                       <option value="2" '.$paid.' >Paid</option>
                       <option value="1" '.$unpaid.' >Unpaid</option>
                  </select>';
        })
        ->editColumn('transaction_number',function(User $data){
                 return  $data->paid_user !=null ? $data->paid_user->transaction_number : 'N/A';
                
        })
       ->rawColumns(['image','detail','is_paid','transaction_number'])
        ->make(true);
    }

        public function paid_uncheck_datatable(){

         $datas=User::latest()->where('is_paid','=','2')->where('is_check','=',"0")->get();
        return DataTables::of($datas)
        ->editColumn('image',function(User $data){
                 $url=$data->avatar !=null ? asset("assets/profile_image/".$data->avatar) : asset("assets/profile_image/default.jpg");

                return '<img src='.$url.' border="0" width="150" height="80" class="img-rounded" align="center" />';       
        })
        ->editColumn('detail',function(User $data){

            return '<a href="javascript:;" user_id="'.$data->id.'" data-action="'.route('show.user.detail').'" class="btn bg-gradient-primary btn-sm show-modal"> <i class="fa fa-eye"></i>  View</a>';
        })
        ->editColumn('is_paid',function(User $data){
                 $paid = $data->is_paid == 2 ? 'selected' : '';
                 $unpaid = $data->is_paid == 1 ? 'selected' : '';
                return '<select class="form-control chnagePaidStatus" item_id="'.$data->id.'" data-action="'.route('user.paid.status').'">
                       <option value="2" '.$paid.' >Paid</option>
                       <option value="1" '.$unpaid.' >Unpaid</option>
                  </select>';
        })
        ->editColumn('transaction_number',function(User $data){
                 return  $data->paid_user !=null ? $data->paid_user->transaction_number : 'N/A';
                
        })
        ->editColumn('uncheck',function(User $data){
                 return '<a href="javascript:;" class="btn btn-danger btn-sm chnageCheckStatus" data-action="'.route('check.user').'"  user_id="'.$data->id.'">
                  <i class="fas fa-times-circle"></i></a>';
                
        })
       ->rawColumns(['image','detail','is_paid','transaction_number','uncheck'])
        ->make(true);
    }

    public function uncheck_user(){
            return view('admin.paid_uncheck_user');
    }

      public function unpaid_user_datatable(){

         $datas=User::latest()->where('is_paid','=','1')->get();
        return DataTables::of($datas)
        ->editColumn('image',function(User $data){
                 $url=$data->avatar !=null ? asset("assets/profile_image/".$data->avatar) : asset("assets/profile_image/default.jpg");

                return '<img src='.$url.' border="0" width="150" height="80" class="img-rounded" align="center" />';       
        })
        ->editColumn('detail',function(User $data){

            return '<a href="javascript:;" user_id="'.$data->id.'" data-action="'.route('show.user.detail').'" class="btn bg-gradient-primary btn-sm show-modal"> <i class="fa fa-eye"></i>  View</a>';
        })
        ->editColumn('is_paid',function(User $data){
                 $paid = $data->is_paid == 2 ? 'selected' : '';
                 $unpaid = $data->is_paid == 1 ? 'selected' : '';
                return '<select class="form-control chnagePaidStatus" item_id="'.$data->id.'" data-action="'.route('user.paid.status').'">
                       <option value="2" '.$paid.' >Paid</option>
                       <option value="1" '.$unpaid.' >Unpaid</option>
                  </select>';
        })
         ->editColumn('uncheck',function(User $data){
                 $paid = $data->is_paid == 2 ? 'selected' : '';
                 $unpaid = $data->is_paid == 1 ? 'selected' : '';
                return '<select class="form-control chnagePaidStatus" item_id="'.$data->id.'" data-action="'.route('user.paid.status').'">
                       <option value="2" '.$paid.' >Paid</option>
                       <option value="1" '.$unpaid.' >Unpaid</option>
                  </select>';
        })
       ->rawColumns(['image','detail','is_paid'])
        ->make(true);
    }

    public function all_user(){
        
        return view('admin.user');
    }

    public function paid_user(){
       
        return view('admin.paid_user');
    }

     public function unpaid_user(){
        
        return view('admin.unpaid_user');
    }

    public function user_detail(Request $request){
       $user=user::with('paid_user')->findOrFail($request->user_id);
       return json_encode($user);
    }

    public function load_user_complain(){
         $datas=Complain::orderBy('id','DESC')->get();

        return DataTables::of($datas)
        ->editColumn('name',function(Complain $data){
                return $data->user->name;
        })
        ->make(true);
    }

    public function user_complain(){
        return view('admin.user_complain');
    }

    public function change_check(Request $request){

        $data=User::findOrFail($request->user_id);
        if ($data->is_check==0) {
            $data->is_check=1;
        }else{
            $data->is_check=0;
        }
        $data->save();
        $notification=['alert'=>'success','message'=>'Successfully updated','status'=>200];

        return json_encode($notification);

    }

}
