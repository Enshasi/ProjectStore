<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Laravel\Sanctum\PersonalAccessToken;

class AccessTokensController extends Controller
{
    //Login
    public function store(Request   $request){
        $request->validate([
            'email' =>'required|email|max:255',
            'password' =>'required|string|min:6',
            'device_name' => 'string|max:255',
            'abilities'=> 'nullable|array'
        ]);
        $user = User::where('email', $request->email)->first();
        if($user && Hash::check($request->password , $user->password)){
            $device_name = $request->post('device_name' , $request->userAgent());//userAgent in web Client Browser Name
            $token = $user->createToken($device_name);
            return Response::json([
                'code' =>1,
                'token' =>$token,
                'user' =>$user
            ],201);
        }
        return Response::json([
            'code' =>0 ,
            'message' =>'Invalid credentials',

        ]);
    }

    //user has many tokens (relation "tokens")
    //Logout
    public function destroy($token = null){
        $user  = Auth::guard('sanctum')->user();
        //delete All Token
        // $user->tokens()->delete();
        if(null == $token ){
            $user->currentAccessToken()->delete();
            return ;
        }
        $personalAccessToken = PersonalAccessToken::findToken($token);
        if($user->id == $personalAccessToken->tokenable_id && get_class($user) == $personalAccessToken->tokenable_type ){
            $personalAccessToken->delete();
        }
    }

}
