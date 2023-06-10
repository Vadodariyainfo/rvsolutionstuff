<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class GoogleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
        
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleGoogleCallback()
    {
        try {
      
            $user = Socialite::driver('google')->user();

            $finduser = User::where('google_id', $user->id)->first();
       
            if(!is_null($finduser)){

                Auth::login($finduser);
                
                if(auth()->user()->is_admin == 1){
                    return redirect()->intended('admin/dashboard');
                }else{
                    return redirect()->intended('user/dashboard');
                }
            }else{
                $userExist = User::where('email', $user->email)->where('google_id', $user->id)->first();

                if(is_null($userExist)){

                    $newUser = User::create([
                        'name' => $user->name,
                        'email' => $user->email,
                        'google_id'=> $user->id,
                        'is_admin'=> 0,
                        'profile'=> $user->avatar,
                        'password' => encrypt('123456dummy')
                    ]);
          
                    Auth::login($newUser);
          
                    if(auth()->user()->is_admin == 1){
                        return redirect()->intended('admin/dashboard');
                    }else{
                        return redirect()->intended('user/dashboard');
                    }
                }else{
                    return redirect()->intended('login')->with('error','user Email Are Already Here.');   
                }
            }
      
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
