<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialGetUserInfoController extends Controller
{
    public function index($provider){
        $user = Auth::user();
        $provider_user =   Socialite::driver($provider)->userFromToken($user->provider_token);

        dd($provider_user);

    }

}
