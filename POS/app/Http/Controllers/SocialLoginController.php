<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialLoginController extends Controller
{
    //    //redirect
    public function redirect($provider){
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider){
        $socialuser = Socialite::driver($provider)->user();

       //    dd($socialuser);

        $user = User::updateOrCreate([
            'provider_id' => $socialuser->id,
        ], [
            'name' => $socialuser->name,
            'nickname' => $socialuser->nickname,
            'email' => $socialuser->email,
            'role' => 'user',
            'provider'=>$provider,
            'provider_token'=>$socialuser->token,
        ]);

        Auth::login($user);
        return to_route('userHome');

    }
}
