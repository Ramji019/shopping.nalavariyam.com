<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Hash;


class PlanController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function ManagePlan()
	{
        $plans = DB::table('plan')->orderBy('id','desc')->get();
		return view("admin/plan/plan",compact('plans','plans'));
	}

    public function AddPlan(Request $request){
        $plan_name = $request->plan_name;
        $description = $request->description;
        $days = $request->days;
        $no_of_products = $request->no_of_products;
        $amount = $request->amount;
        $gst = $request->gst;
        $status = "Active";
        $created_at = date('Y-m-d H:i:s');
        $sql = "insert into plan (plan_name,description,days,no_of_products,amount,gst,status,created_at) values ('$plan_name','$description','$days','$no_of_products','$amount','$gst','$status','$created_at')";
        DB::insert(DB::raw($sql));
        return redirect('admin/plan')->with('success', 'Plan Added Successfully'); 
    }

    public function EditPlan(Request $request){
        $plan_id = $request->plan_id;
        $plan_name = $request->plan_name;
        $description = $request->description;
        $days = $request->days;
        $no_of_products = $request->no_of_products;
        $amount = $request->amount;
        isset($request->gst) ? $gst = $request->gst : $gst = 0;
        isset($request->status) ? $status = $request->status : $status = "Active";
        $updated_at = date('Y-m-d H:i:s');
        $sql = "update plan set plan_name='$plan_name',description='$description',days='$days',no_of_products='$no_of_products',amount='$amount',gst='$gst',status='$status',updated_at='$updated_at' where id=$plan_id";
        DB::update(DB::raw($sql));
        return redirect('admin/plan')->with('success', 'Plan Updated Successfully'); 
    }
    public function DeleteClass($id){
        $deleteclass = DB::table('class_list')->where('id',$id)->delete();
        
        return redirect('/class')->with('success', 'Class Deleted Successfully');
    }

}
