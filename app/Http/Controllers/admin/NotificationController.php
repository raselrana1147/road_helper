<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\admin\Notification;
use Yajra\DataTables\Facades\DataTables;
use App\Libary\Helper;
use App\models\User;
class NotificationController extends Controller
{
    
	function __construct(){
		$this->middleware('auth:admin');
	}

	public function datatable(){
		 $datas=Notification::orderBy('id','DESC')->get();
        return DataTables::of($datas)

        	->editColumn('content',function(Notification $data){
        		return htmlspecialchars_decode($data->content);
        	})
       
            ->editColumn('action',function(Notification $data){
            return '<a href="'.route('notification.edit',$data->id).'" class="btn btn-success btn-sm">
                  <i class="fa fa-edit"></i>
                  Edit</a>
                   <a href="javascript:;" class="btn btn-danger btn-sm delete_item" data-action="'.route('notification.delete').'"  item_id="'.$data->id.'">
                   <i class="fa fa-trash"></i>
                  Delete</a>';
        })
       ->rawColumns(['content','action'])
        ->make(true);
	}


	public function index(){
		$items=Notification::latest()->get();

		return view('admin.notification.index',compact('items'));

	}




	public function createForm(){
		return view('admin.notification.create');
	}


	public function store(Request $request){

		$data=new Notification();
		$data->subject=$request->subject;
		$data->content =$request->content;
		$data->save();

		


		$SERVER_API_KEY = Helper::server_api_key();
        $device_token = [];
        $users=User::where('token','!=',null)->get();
       
        foreach ($users as $user) {
                $device_token[] = $user->token;   
        }

        
        $data_info = [
            "registration_ids" => $device_token,
            "priority" => "high",
            "notification" => [
                "title" => 'You have a new announcement from Road Helper',
                'body' =>strip_tags($request->content)
            ]
        ];

        $dataString = json_encode($data_info);

        $headers = [
            'Authorization: key=' . $SERVER_API_KEY,
            'Content-Type: application/json',
        ];


        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
        $response = curl_exec($ch);
        curl_close($ch);

		$notification=['alert'=>'success','message'=>'Successfully Added','status'=>200];

		return json_encode($notification);

	}

	public function edit($id){
		$item=Notification::findOrFail($id);
		return view('admin.notification.edit',compact('item'));

	}


	public function update(Request $request){

	        //dd($request->all());
			$data=Notification::findOrFail($request->id);

		    $data->subject=$request->subject;
	        $data->content =$request->content;

	        $data->save();
			
			$notification=['alert'=>'success','message'=>'Successfully Updated','status'=>200];

			return json_encode($notification);

	}

	public function destroy(Request $request){
		
		$data=Notification::findOrFail($request->item_id);
		$data->delete();
		$notification=['alert'=>'success','message'=>'Successfully Delete','status'=>200];

		return json_encode($notification);

	}
    
}
