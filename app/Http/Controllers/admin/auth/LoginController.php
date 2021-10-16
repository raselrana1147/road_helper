<?php

namespace App\Http\Controllers\admin\auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\Admin\Admin;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
 

    use AuthenticatesUsers;

    
   //protected $redirectTo = RouteServiceProvider::DASHBOARD;

 
    public function __construct()
    {
       $this->middleware('guest:admin')->except('logout');
    }

    public function showLoginForm(){
        return view('admin.auth.login');
    }

    public function login(Request $request){
       

            if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {

                $notification=array(
                 'message'=>'Your session is started !',
                 'alert-type'=>'success'
                 );

                return redirect()->intended(route('admin.dashboard'))->with($notification);
            }else{
                session()->flash('error_message','Information did not match');
                return Redirect()->back();
            }    

    }

    public function logout(Request $request)
    {
        $this->guard()->logout();
        $request->session()->invalidate();
        session()->flash('success_message','successfully loged out...');
        return redirect()->route('admin.login');
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }

    
}
