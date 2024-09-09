<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use Auth;

class AppServiceProvider extends ServiceProvider
{

    public $category;
    public $state;
    public $cart;

    public function register()
    {
        
    }

    public function boot()
    {
       
       

        view()->composer('layouts.header', function($view) {
            
            $sql = "select * from category where parent_id=0 and status=1 order by category_name";
            $category = DB::select(DB::raw($sql));
            $category = json_decode(json_encode($category),true);
            foreach ($category as $key => $cat) {
                $category_id = $cat["id"];
                $sql = "select id,category_name from category where parent_id = $category_id";
                $result = DB::select(DB::raw($sql));
                $category[$key]["subcat"] = $result;
            }
          
            $this->category = json_decode(json_encode($category));
            $sql = "select name as  state_id from states where name = 'TAMIL NADU'";
            $state1 = DB::select(DB::raw($sql));
            $state1 = json_decode(json_encode($state1),true);
            $sql = "select distinct state_id from products where state_id <> 'TAMIL NADU' order by state_id";
            $state2 = DB::select(DB::raw($sql));
            $state2 = json_decode(json_encode($state2),true);
            if(count($state2) > 0) {
                $state = array_merge($state1,$state2);
            }else{
                $state = $state1;
            }
            //echo "<pre>"; print_r($this->category);  echo "</pre>";die;
            $this->state = json_decode(json_encode($state));
            $this->cart = 0;
            if(Auth::check()){
            $userid = Auth::user()->id;
          
            $sql = "select count(*) as cartcount from cart where customer_id=$userid and status='Pending'";
            $cartcount = DB::select(DB::raw($sql));
       
            
            if(count($cartcount) > 0){
                $this->cart = $cartcount[0]->cartcount;
            }
        }

            $view->with(['category' => $this->category,'state' => $this->state,'cart' => $this->cart]);
        });
        view()->composer('mobile.layouts.footer', function($view) {

            $sql = "select * from category where parent_id=0 and status=1 order by category_name";
            $category = DB::select(DB::raw($sql));
            $category = json_decode(json_encode($category),true);
            foreach ($category as $key => $cat) {
                $category_id = $cat["id"];
                $sql = "select id,category_name from category where parent_id = $category_id";
                $result = DB::select(DB::raw($sql));
                $category[$key]["subcat"] = $result;
            }
          
            $this->category = json_decode(json_encode($category));
            $sql = "select name as  state_id from states where name = 'TAMIL NADU'";
            $state1 = DB::select(DB::raw($sql));
            $state1 = json_decode(json_encode($state1),true);
            $sql = "select distinct state_id from products where state_id <> 'TAMIL NADU' order by state_id";
            $state2 = DB::select(DB::raw($sql));
            $state2 = json_decode(json_encode($state2),true);
            if(count($state2) > 0) {
                $state = array_merge($state1,$state2);
            }else{
                $state = $state1;
            }
            //echo "<pre>"; print_r($this->category);  echo "</pre>";die;
            $this->state = json_decode(json_encode($state));
            $view->with(['category' => $this->category,'state' => $this->state]);
        });
    }
}
