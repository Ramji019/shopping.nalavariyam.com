<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Hash;


class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = DB::table('users')->where('usertype_id','=',3)->orderBy('id','desc')->get();

        return view('admin/users/users',compact('users'));
    }

    public function AddUsers(Request $request){

        $addusers = DB::table('users')->insert([
           'name'            =>   $request->name,
           'email'           =>   $request->email,
           'password'        =>   Hash::make($request->password),
           'usertype_id'     =>   2,
           'phone'           =>   $request->phone,
           'status'          =>   1,
           'created_at'      =>   date('Y-m-d H:i:s'),
           'login_id'        =>   auth()->user()->id,
       ]);

        return redirect('/users')->with('success', 'Users Added Successfully'); 
    }

    public function EditUsers(Request $request){

        $edituser = DB::table('users')->where('id',$request->user_id)->update([
            'name'            =>   $request->name,
           'email'           =>   $request->email,
           'phone'           =>   $request->phone,
           'status'           =>   $request->status,
           'updated_at'      =>   date('Y-m-d H:i:s'),
           'login_id'        =>   auth()->user()->id,
        ]);

        return redirect('/admin/users')->with('success', 'User Updated Successfully'); 
    }
    public function DeleteUsers($id){
        $deleteusers = DB::table('users')->where('id',$id)->delete();
        
        return redirect('/users')->with('success', 'Users Deleted Successfully');
    }

}
