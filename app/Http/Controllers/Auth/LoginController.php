<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request){
        $message = "";
        $username = array("email" => $request->email, "password" => $request->password);
        $phone = array("phone" => $request->email, "password" => $request->password);
        
        if(Auth::attempt($username) || Auth::attempt($phone)) {
            if(Auth::user()->status == 0){
                $message = "Please Wait for the admin Approval";
                Auth::logout();
                return redirect('/admin')->with('message',$message);
            }
            Auth::loginUsingId(Auth::user()->id);
            return redirect('/admin/dashboard');
          }else{
            $message = 'Login Failed';
            return redirect('/admin')->with('message',$message);
          }
          
        }
}
