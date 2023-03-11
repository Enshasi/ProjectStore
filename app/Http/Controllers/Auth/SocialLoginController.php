<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str ;
class SocialLoginController extends Controller
{
    public function redirect($provider)
    {
        //redirect Page Google
        return  Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        try{


         // after Login Google

        $provider_user  = Socialite::driver($provider)->user();

        //$provider_user  = Socialite::driver($provider)->stateless()->user(); //send request to google and get user data
        $user = User::where([ //check if user exist
            'provider' => $provider,  //provider = google , facebook , twitter
            'provider_id' => $provider_user->id
        ])->first();
        if(!$user){
            $user = User::create([
                'name' => $provider_user->name,
                'email' => $provider_user->email,
                'password' => Hash::make(Str::random(8)),
                'provider' => $provider,
                'provider_id' => $provider_user->id,
                'provider_token' => $provider_user->token,
            ]);
        }
        Auth::login($user);

        return redirect()->route('home');
        // $user->token;
        }
        catch(\Throwable $e){
            return redirect()->route('login')->with('error' , $e->getMessage());
        }
    }
}
