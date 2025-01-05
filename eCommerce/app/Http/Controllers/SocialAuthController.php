<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    //sociallite redirect to provider
    public function redirect($provider){
       // dd($provider);
        return Socialite::driver($provider)->redirect();
    }

    //socialite receive callback from provider
    public function callback($provider){
        $request = Socialite::driver($provider)->user();
        //dd($request);
        //$user->token
        $user = User::updateOrCreate([
            'provider_id' => $request->id,
        ], [
            'name' => $request->name,
            'email' => $request->email,
            'provider_token' => $request->token,
            'provider' => $provider,
        ]);

        Auth::login($user);

        //return redirect('/dashboard');
        return to_route('user#home');
    }
}
