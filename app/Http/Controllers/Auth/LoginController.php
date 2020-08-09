<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    //protected $redirectTo = '/admin';

    public function authenticated($request , $user){
        if($user->user_type=='guest'){
            return redirect()->route('homeicc') ;
        }elseif($user->user_type=='admin'){
            return redirect()->route('home') ;
        }elseif($user->user_type=='user'){
            return redirect()->route('home') ;
        }
        elseif($user->user_type=='tenant'){
            return redirect()->route('mallwp') ;
        }
        
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // This below 2 lines used to limit the login - How to Limit Login Attempts in Laravel
    protected $maxAttempts = 3; // default is 5
    protected $decayMinutes = 2; // default is 1

  

}
