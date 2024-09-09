<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Hash;
use Illuminate\Support\Facades\Auth;
use Session;


class LoginController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function index()
    {
      return view('admin/login');
    }
    
    public function sellerregister(Request $request)
    {   
      $otp = rand(1001,9999);
      $sellerphone = trim($request->sellerphone);
      $selleremail = trim($request->selleremail);
      $plan_id = $request->plan_id;
      $sql = "SELECT * FROM users where phone='$sellerphone'";
      $users = DB::select(DB::raw($sql));
      $sql = "SELECT * FROM users where email='$selleremail'";
      $users2 = DB::select(DB::raw($sql));
      if(count($users) > 0){
        return redirect('/')->with('error', 'Mobile number already registered');
      }elseif(count($users2) > 0){
        return redirect('/')->with('error', 'Email already registered');
      }else{
       $sellerregister = DB::table('users')->insert([
        'name'               => $request->name,
        'email'              => $selleremail,
        'password'           => Hash::make($request->sellerpassword),
        'phone'              => $sellerphone,
        'address'            => $request->address,
        'usertype_id'        => 4,
        'created_at'         => date('Y-m-d H:i:s'),
      ]);
     }

     $admin = DB::getPdo()->lastInsertId();
     Auth::loginUsingId($admin);

     if (auth()->user()) 
     {
      return redirect('/cart');
    }
  }

  public function buyerregister(Request $request)
  {   
    $otp = rand(1001,9999);
    $buyerphone = trim($request->buyerphone);
    $buyeremail = trim($request->buyeremail);
    $plan_id = $request->plan_id;
    $sql = "SELECT * FROM users where phone='$buyerphone'";
    $users = DB::select(DB::raw($sql));
    $sql = "SELECT * FROM users where email='$buyeremail'";
    $users2 = DB::select(DB::raw($sql));
    if(count($users) > 0){
      return redirect('/')->with('error', 'Mobile number already registered');
    }elseif(count($users2) > 0){
      return redirect('/')->with('error', 'Email already registered');
    }else{
     $buyerregister = DB::table('users')->insert([
      'name'               => $request->name,
      'email'              => $buyeremail,
      'password'           => Hash::make($request->buyerpassword),
      'plainpassword'      => $request->buyerpassword,
      'phone'              => $buyerphone,
      'plan_id'            => $request->plan_id,
      // 'otp'                => $otp,
      'usertype_id'        => 4,
      'created_at'         => date('Y-m-d H:i:s'),
    ]);
   }

   $admin = DB::getPdo()->lastInsertId();
   Auth::loginUsingId($admin);

   if (auth()->user()) 
   {
    return redirect('/user/dashboard');
  }
}

  public function checkLogin(Request $request){
    $response = array();
    $status = "fail";
    $email = array("email" => $request->email, "password" => $request->password);
    $phone = array("phone" => $request->email, "password" => $request->password);
    if(auth()->attempt($email) || auth()->attempt($phone)) {
      $admin = auth()->user();
      if(($admin->usertype_id == 4) && $admin->status == 1){
        $status = "success";
        Auth::loginUsingId($admin->id);
      }
    }
    $response["status"] = $status;
    return response()->json($response);
  }

  public function buyerLogin(Request $request){
    $response = array();
    $status = "fail";
    $email = array("email" => $request->email, "password" => $request->password);
    $phone = array("phone" => $request->email, "password" => $request->password);
    if(auth()->attempt($email) || auth()->attempt($phone)) {
      $admin = auth()->user();
      if($admin->usertype_id == 4 && $admin->status == 1){
        $status = "success";
        Auth::loginUsingId($admin->id);
      }
    }
    $response["status"] = $status;
    return response()->json($response);
  }
  public function sellerLogin(Request $request){
    $response = array();
    $status = "fail";
    $email = array("email" => $request->email, "password" => $request->password);
    $phone = array("phone" => $request->email, "password" => $request->password);
    if(auth()->attempt($email) || auth()->attempt($phone)) {
      $admin = auth()->user();
      if($admin->usertype_id == 3 && $admin->status == 1){
        $status = "success";
        Auth::loginUsingId($admin->id);
      }
    }
    $response["status"] = $status;
    return response()->json($response);
  }

  public function userlogout(Request $request) {
    Session::flush();
    Auth::logout();
    return redirect('/');
  }
}
