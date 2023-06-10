<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = 'admin/dashboard';
   
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
   
    public function login(Request $request)
    {   
        $input = $request->all();
   
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if(auth()->attempt(array('email' => $input['email'], 'password' => $input['password'], 'is_admin' => '1')))
        {
            $user = auth()->user();
            if ($user->status == 0) {
                return redirect()->route('admin.dashboard');
            }else{
                auth()->logout();
                return redirect()->route('login')->with('error','Admin Is Suspension Your Account Please Contact Another Admin For Active Aour Account.');
            }
        }else if (auth()->attempt(array('email' => $input['email'], 'password' => $input['password'], 'is_admin' => '0'))) {
            $user = auth()->user();
            if ($user->status == 0) {
                return redirect()->route('user.admin.dashboard');
            }else{
                auth()->logout();
                return redirect()->route('login')->with('error','Your Account Are Suspension Please Contact You Admin for Active Your Account.');
            }
            
        }else{
            return redirect()->route('login')->with('error','Email-Address And Password Are Wrong.');
        }
          
    }
}
