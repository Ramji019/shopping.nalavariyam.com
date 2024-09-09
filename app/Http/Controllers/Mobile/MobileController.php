<?php

namespace App\Http\Controllers\Mobile;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MobileController extends Controller
{

    public function index()
    {
        $sql = " select count(*) as product from products where seller_id ";
        $result = DB::select(DB::raw($sql));
        if (count($result) > 0) {
            $product = $result[0]->product;
        }
        $sql = " select count(*) as sellproduct from products where seller_id ";
        $result = DB::select(DB::raw($sql));
        if (count($result) > 0) {
            $sellproduct = $result[0]->sellproduct;
        }
        $user_id= Auth::user()->id;
        $sql = " select count(*) as favproduct from favorites where product_id =$user_id ";
        $result = DB::select(DB::raw($sql));
        if (count($result) > 0) {
            $favproduct = $result[0]->favproduct;
        }
        return view('/mobile/index',compact('product','sellproduct','favproduct'));
    }
}

/*     public function dashboard()
    {
        $sql = " select count(*) as mobproduct from products where seller_id ";
        $result = DB::select(DB::raw($sql));
        if (count($result) > 0) {
            $mobproduct = $result[0]->mobproduct;
        }
        $sql = " select count(*) as sellproduct from products where seller_id ";
        $result = DB::select(DB::raw($sql));
        if (count($result) > 0) {
            $sellproduct = $result[0]->sellproduct;
        }
        return view('/mobile/dashboard',compact('mobproduct','sellproduct'));  
    } */
