<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    public function userLogin(Request $request)
    {
        $user= User::where('email', $request->email)->first();
            if (!$user || !Hash::check($request->password, $user->password)) {
                return response([
                    'message' => ['These credentials do not match our records.']
                ], 404);
            }
        	if ($user) {
	            // $token = $user->createToken('my-app-token')->plainTextToken;
                // $token = $user->createToken($this->generateRandomString())->accessToken;
                $token = substr(md5(mt_rand()), 0, 100);
	            $response = [
	                'user' => $user,
	                'token' => $token
	            ];
            User::where('id',$user->id)->update(['api_token'=>$token]);
             return response($response, 200);
        	}else{
        		return response('Somthin went wrong',201);
        	}
           
    }
    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function userRegister(Request $request){
    	
        $data = [
            'name' 		=> $request['name'],
            'email' 	=> $request['email'],
            'password' 	=> Hash::make($request['password']),
            
        ];
       // return($data);
       $user = User::create($data);
       if(!empty($user)){
        $token = substr(md5(mt_rand()), 0, 100);
        $response = [
            'user' => $user,
            'token' => $token
        ];
        return $response;
       }else{
         return Response::json('status',201);
       }


    }
   
}
