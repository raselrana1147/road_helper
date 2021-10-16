<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Http\Response;
use App\models\User;

class AuthController extends Controller
{


	/**
	    * Create a new AuthController instance.
	    *
	    * @return void
	    */
	   public function __construct()
	   {
	       $this->middleware('auth:api', ['except' => ['login']]);
	   }

	   /**
	    * Get a JWT token via given credentials.
	    *
	    * @param  \Illuminate\Http\Request  $request
	    *
	    * @return \Illuminate\Http\JsonResponse
	    */
	   public function login(Request $request)
	   {


	   		$data=User::where('phone',$request->phone)->first();
	   		if (!is_null($data)) {

	   	      if ($data->is_active==2){
                  $credentials = $request->only('phone', 'password');

                  if ($token = $this->guard()->attempt($credentials)) {
                      $user=auth()->user();
                      $user->token=$request->token;
                      $user->save();
                      return $this->respondWithToken($token);
                  }

                  return response()->json(['data'=>'Credendial did not match','status' => '401'],401);
              }else{
                  return response()->json([
                      'message'=>'Your account is not active',
                      'status'=>401,
                  ],Response::HTTP_NOT_FOUND);
              }

	   		}else{

	   			return response()->json([
	   				'message'=>'No account is found for this phone',
                    'status'=>401,
	   			],Response::HTTP_NOT_FOUND);
	   		}


	   }

	   /**
	    * Get the authenticated User
	    *
	    * @return \Illuminate\Http\JsonResponse
	    */
	   public function me()
	   {
	   		

	       return response()->json($this->guard()->user());
	   }

	   /**
	    * Log the user out (Invalidate the token)
	    *
	    * @return \Illuminate\Http\JsonResponse
	    */
	   public function logout()
	   {
	   		$user=auth()->user();
	   		$user->token=null;
	   		$user->save();

	       $this->guard()->logout();
	       return response()->json(['message' => 'Successfully logged out']);
	   }

	   /**
	    * Refresh a token.
	    *
	    * @return \Illuminate\Http\JsonResponse
	    */
	   public function refresh()
	   {
	       return $this->respondWithToken($this->guard()->refresh());
	   }

	   /**
	    * Get the token array structure.
	    *
	    * @param  string $token
	    *
	    * @return \Illuminate\Http\JsonResponse
	    */
	   protected function respondWithToken($token)
	   {
	       return response()->json([
	       	   'user'=>auth()->user(),
	           'access_token' => $token,
	           'token_type' => 'bearer',
	           'expires_in' => $this->guard()->factory()->getTTL() * 60
	       ]);
	   }

	   /**
	    * Get the guard to be used during authentication.
	    *
	    * @return \Illuminate\Contracts\Auth\Guard
	    */
	   public function guard()
	   {
	       return Auth::guard();
	   }

}
