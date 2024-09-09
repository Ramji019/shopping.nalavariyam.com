<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Session;

class HomeController extends Controller
{

    public function index()
    {
        $currentRouteName = Route::currentRouteName();

        $sql = "select * from category where parent_id='0' order by id";
        $category = DB::select(DB::raw($sql));
		
        if($this->ismobile){
            return view('mobile.index', compact('category'));
        }else{
           return view('welcome', compact('category'));
        }
    }

    public function subcategory($catid)
    {
        $currentRouteName = Route::currentRouteName();
        $sql = "select * from category where parent_id=$catid order by id";
        $subcategory = DB::select(DB::raw($sql));
		
		//echo "<pre>";print_r($subcategory);echo "</pre>";die;
        if($this->ismobile){
            return view('mobile.subcategory', compact('subcategory'));
        }else{
           return view('subcategory', compact('subcategory'));
        }
    }

    public function thirdcategory($subid)
    {
        $currentRouteName = Route::currentRouteName();
        $sql = "select * from category where parent_id=$subid order by id";
        $thirdcategory = DB::select(DB::raw($sql));
		
		
        if($this->ismobile){
            return view('mobile.thirdcategory', compact('thirdcategory'));
        }else{
           return view('thirdcategory', compact('thirdcategory'));
        }
    }

    function distance($lat1, $lon1, $lat2, $lon2) {
      $theta = $lon1 - $lon2;
      $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
      $dist = acos($dist);
      $dist = rad2deg($dist);
      $miles = $dist * 60 * 1.1515;
      return round(($miles * 1.609344),0)/1000;
    }

    public function nearby($lat,$lng)
    {
        $currentRouteName = "nearby";
        $sql = "select * from products where status='Active' and location <> ''";
        $products = DB::select(DB::raw($sql));
        $products = json_decode(json_encode($products),true);
        foreach ($products as $key => $prod) {
            $location = $prod["location"];
            $location = explode(",",$location);
            $latitude = $location[0];
            $longitude = $location[1];
            $distance = self::distance($lat,$lat,$latitude,$longitude);
            $products[$key]["distance"] = $distance;
            $product_id = $prod["id"];
            if($distance > 10 ) {
                unset($products[$key]);
                continue;
            }
            $sql = "select photo from product_photo where product_id = $product_id order by id";
            $result = DB::select(DB::raw($sql));
            $j=0;
            if(count($result) > 0){
                foreach ($result as $res) {
                    $products[$key]["photo"][$j] = $res->photo;
                    $j++;
                }
            }
        }
        $products = json_decode(json_encode($products));
        $sql = "select * from plan where status='Active' order by id";
        $plans = DB::select(DB::raw($sql));
        $sql = "select * from plan where id = 1";
        $plan = DB::select(DB::raw($sql));
        $plan = $plan[0];
        $favorites = array();
        $j=0;
        if(Auth::user()){
            $user_id = Auth::user()->id;
            $sql = "select product_id from favorites where user_id = $user_id";
            $result = DB::select(DB::raw($sql));
            foreach($result as $res){
                $favorites[$j] = $res->product_id;
                $j++;
            }
        }
        if($this->ismobile){
            return view('mobile.index', compact('products','plans','plan','favorites','currentRouteName'));
        }else{
            return view('welcome', compact('products','plans','plan','favorites','currentRouteName'));
        }
    }


    public function statewise($state)
    {
        $currentRouteName = Route::currentRouteName();
        if($state == "All"){
            return redirect('/');
        }else{
            $sql = "select * from products where status = 'Active' and state_id = '$state'";
            $products = DB::select(DB::raw($sql));
            $products = json_decode(json_encode($products),true);
            foreach ($products as $key => $prod) {
                $product_id = $prod["id"];
                $sql = "select photo from product_photo where product_id = $product_id order by id";
                $result = DB::select(DB::raw($sql));
                $j=0;
                if(count($result) > 0){
                    foreach ($result as $res) {
                        $products[$key]["photo"][$j] = $res->photo;
                        $j++;
                    }
                }
            }
            $products = json_decode(json_encode($products));
            $favorites = array();
            $j=0;
            if(Auth::user()){
                $user_id = Auth::user()->id;
                $sql = "select product_id from favorites where user_id = $user_id";
                $result = DB::select(DB::raw($sql));
                foreach($result as $res){
                    $favorites[$j] = $res->product_id;
                    $j++;
                }
            }
        if($this->ismobile){
            return view('mobile.statewise', compact('products','state','favorites','currentRouteName'));
        }else{
            return view('statewise', compact('products','state','favorites','currentRouteName'));
        }
		
        }
        
    }

   
    public function category($id)
    {
        $currentRouteName = Route::currentRouteName();
        $category_name = "";
        $sub_categories = "";
        $sql = "select * from category where id = $id";
        $category = DB::select(DB::raw($sql));
        foreach($category as $cat) {
            $parent_id = $cat->parent_id;
            $category_name = $cat->category_name;
            if($parent_id != 0){
                $sub_categories =  $id;
            }else{
                $sql = "select * from category where parent_id = $id";
                $result = DB::select(DB::raw($sql));
                foreach($result as $res){
                    $sub_categories = $sub_categories .$res->id .",";
                }
            }
        }
        if(substr($sub_categories, -1) == ","){
            $sub_categories = substr($sub_categories, 0, -1);
        }
        $products = array();
        if(trim($sub_categories) != ""){
            $sql = "select * from products where category_id in ($sub_categories)";
            $products = DB::select(DB::raw($sql));
        }
        $products = json_decode(json_encode($products),true);
        foreach ($products as $key => $prod) {
            $product_id = $prod["id"];
            $sql = "select photo from product_photo where product_id = $product_id order by id";
            $result = DB::select(DB::raw($sql));
            $products[$key]["photo"] = $result;
        }
        $products = json_decode(json_encode($products));
        $favorites = array();
        $j=0;
        if(Auth::user()){
            $user_id = Auth::user()->id;
            $sql = "select product_id from favorites where user_id = $user_id";
            $result = DB::select(DB::raw($sql));
            foreach($result as $res){
                $favorites[$j] = $res->product_id;
                $j++;
            }
        }
        //echo "<pre>";print_r($products);echo "</pre>";die;
        if($this->ismobile){
            return view('mobile.category', compact('products','category_name','favorites','currentRouteName'));
        }else{
             return view('category', compact('products','category_name','favorites','currentRouteName'));
        }
    }

    public function product($id)
    {
        $currentRouteName = Route::currentRouteName();
        $sql = "select * from products where id = '$id'";
        $product = DB::select(DB::raw($sql));
        $product = json_decode(json_encode($product),true);
        foreach ($product as $key => $prod) {
            $product_id = $prod["id"];
            $sql = "select photo from product_photo where product_id = $product_id order by id";
            $result = DB::select(DB::raw($sql));
            $product[$key]["photo"] = $result;
        }
        $product = json_decode(json_encode($product));
        $prod = $product[0];
        $seller_id = $prod->shop_id;
        $sql = "select name,phone from users where id=$seller_id";
        $seller = DB::select(DB::raw($sql));
        $seller = $seller[0];
        $sql ="select a.attr_value as attr_value2,b.* from product_attribute a,attribute b where a.attr_id=b.id and a.product_id=$product_id";
        $attrs = DB::select(DB::raw($sql));
        $product_id = $prod->id;
        $fav=0;
        if(Auth::user()){
            $user_id = Auth::user()->id;
            $sql ="select product_id from favorites where user_id=$user_id and product_id=$product_id";
            $result = DB::select(DB::raw($sql));
            if(count($result)>0){
                $fav=1;
            }
        }
        //echo "<pre>";print_r($prod);echo "</pre>";die;
        if($this->ismobile){
            return view('mobile.product', compact('prod','attrs','seller','currentRouteName','fav'));
        }else{
            return view('product', compact('prod','attrs','seller','currentRouteName','fav'));
        }
    }

    public function getsubcategory(Request $request)
    {
        $getsubcategory = DB::table('category')->where('parent_id', $request->category_id)->orderBy('id', 'Asc')->get();
        return response()->json($getsubcategory);
    }

    public function about_us()
    {
        if($this->ismobile){
            return view('mobile.about_us');


        }else{
            return view('about_us');
        }
		
    }
    public function faq()
    {
        if($this->ismobile){
            return view('mobile.faq');


        }else{
            return view('faq');
        }
		
    }
    public function addcontactus(Request $request)
    {
        $addcontact = DB::table('website_contacts')->insert([
            'name'=> $request->name,
            'email'=>$request->email,
            'subject'=>$request->subject,
            'message'=>$request->message,
        ]);
        return redirect()->back()->with( 'success', 'Contact Updated Successfully ... !' );
    }


    public function contactus()
    {
        if($this->ismobile){
            return view('mobile.contact_us');   
        }else{
        return view('contact_us');  
		}
    }

    // public function aboutus(){
    //     if($this->ismobile){
    //         return view('mobile.about');   
    //     }else{
    //     return view('about');  
	// 	}
    // }

    public function purchase()
    {
        $sql ="select * from plan where status = 'Active' and id <> 'Active'";
        $plans = DB::select(DB::raw($sql));
        if($this->ismobile){
            return view('mobile.purchase',compact('plans'));   
        }else{
             return view('purchase',compact('plans'));  
		}
    }

    
}