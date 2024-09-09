<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Hash;


class BuyerController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function ManageBuyer()
	{
        $buyer = DB::table('users')->where('usertype_id','=',4)->orderBy('id','asc')->get();
		return view("admin/buyer/buyer",compact('buyer','buyer'));
	}

    public function AddBuyer(Request $request){

        $addbuyer = DB::table('users')->insert([
            'plan_name'       =>   $request->plan_name,
            'description'     =>   $request->description,
            'created_at'      =>   date('Y-m-d H:i:s'),
            'status'          =>   1,
       // 'login_id'        =>   auth()->user()->id,
        ]);

        return redirect('admin/buyer')->with('success', 'Buyer Added Successfully'); 
    }

    public function EditBuyer(Request $request){
    
        $editbuyer = DB::table('users')->where('id',$request->user_id)->update([
            'name'                  =>   $request->name,
            'email'                 =>   $request->email,
            'dob'                   =>   $request->dob,
            'gender'                =>   $request->gender,
            'address'               =>   $request->address,
            'remember_token'        =>   $request->remember_token,
            'updated_at'            =>   date('Y-m-d H:i:s'),
            'status'                =>   1,
        //'login_id'        =>   auth()->user()->id,
        ]);

        return redirect('admin/buyer')->with('success', 'Buyer Updated Successfully'); 
    }
    public function DeleteClass($id){
        $deleteclass = DB::table('class_list')->where('id',$id)->delete();
        
        return redirect('/class')->with('success', 'Class Deleted Successfully');
    }

}
