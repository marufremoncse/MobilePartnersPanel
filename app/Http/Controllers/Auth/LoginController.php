<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
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
   /* protected $redirectTo = '/dashboard';*/

   /* protected function redirectTo()
    {
        return 'dashboard';
    }*/
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    protected function credentials(Request $request)
    {
        if(is_numeric($request->get('email'))){

            return ['mobile'=>$request->get('email'),'password'=>$request->get('password'),'status_active' => 1];
        }
        return ['email'=>$request->get('email'),'password'=>$request->get('password'),'status_active' => 1];
    }
}
