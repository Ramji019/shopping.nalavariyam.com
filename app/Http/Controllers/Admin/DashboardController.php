<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class DashboardController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
	
	 
    public function index()
    {
        $sql = " select count(*) as plancount from plan ";
        $result = DB::select(DB::raw($sql));
        if (count($result) > 0) {
            $plancount = $result[0]->plancount;
        }
        $sql = " select count(*) as userscount from users where usertype_id='2'";
        $result = DB::select(DB::raw($sql));
        if (count($result) > 0) {
            $userscount = $result[0]->userscount;
        }
        $sql = " select count(*) as sellercount from users  where usertype_id='3'";
        $result = DB::select(DB::raw($sql));
        if (count($result) > 0) {
            $sellercount = $result[0]->sellercount;
        }
        $sql = " select count(*) as buyercount from users where usertype_id='4'";
        $result = DB::select(DB::raw($sql));
        if (count($result) > 0) {
            $buyercount = $result[0]->buyercount;
        }
        $shop_id = Auth::user()->id;
        if(Auth::user()->usertype_id==1)
            $sql = " select count(*) as productscount from products ";
        else
            $sql = " select count(*) as productscount from products where shop_id=$shop_id";
        $result = DB::select(DB::raw($sql));
        if (count($result) > 0) {
            $productscount = $result[0]->productscount;
        }

		if(Auth::user()->usertype_id==1){
            $sql = "select a.*,b.name,phone from orders a,users b where a.customer_id=b.id and a.status='Pending'";
        }else{
            $sql = "select a.*,b.name,phone from orders a,users b where a.customer_id=b.id and a.status='Pending' and a.id in (select order_id from order_details where shop_id=$shop_id and status='Pending')";
        }
        $orderscount = DB::select(DB::raw($sql));
       
		
        $sql = " select count(*) as categorycount from category ";
        $result = DB::select(DB::raw($sql));
        if (count($result) > 0) {
            $categorycount = $result[0]->categorycount;
        }
        return view("admin/dashboard", compact('plancount','userscount','sellercount','buyercount','productscount','categorycount','orderscount'));

    }
}
