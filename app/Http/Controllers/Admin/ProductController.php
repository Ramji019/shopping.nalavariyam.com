<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Hash;
use Auth;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function ManageProduct()
	{ 
        $user_id = Auth::user()->id;
        $sql = "select a.*,b.parent_id,c.parent_id as cat_id from products a,category b,category c where a.category_id=b.id and b.parent_id=c.id and shop_id=$user_id";
        $products = DB::select($sql);
        $sql = 'select * from category where parent_id=0 and status=1 order by id';
        $category = DB::select( DB::raw( $sql ) );
		return view("admin/products/products",compact('products','category'));
	}

    public function Edit($id)
	{ 
        $user_id = Auth::user()->id;
        $sql = "select a.*,b.parent_id,c.parent_id as cat_id from products a,category b,category c where a.category_id=b.id and b.parent_id=c.id and a.id=$id and shop_id=$user_id";
        //echo $sql;die;
        $products = DB::select($sql);
        $products =$products[0];
        $sql = 'select * from category where parent_id=0 and status=1 order by id';
        $category = DB::select( DB::raw( $sql ) );

        $sub_cat_id = $products->category_id;

        $sql = "select parent_id from category where id=$sub_cat_id";
        $maicat = DB::select( DB::raw( $sql ) );

        $cat_id = 0;
        if (count($maicat) > 0) {
            $cat_id = $maicat[ 0 ]->parent_id;
        }

        $sql = "select parent_id from category where id=$cat_id";
        $thirdcat = DB::select( DB::raw( $sql ) );

        $third_cat_id = 0;
        if (count($thirdcat) > 0) {
            $third_cat_id = $thirdcat[ 0 ]->parent_id;
        }
        

        $sql = "select * from category where status=1 and parent_id = $third_cat_id and  parent_id != 0 order by category_name ";
        //echo $sql;die;
        $sub_category = DB::select( DB::raw( $sql ) );

        $sql = "select * from category where status=1 and parent_id = $cat_id and  parent_id != 0 order by category_name ";
        //echo $sql;die;
        $third_category = DB::select( DB::raw( $sql ) );
        

		return view("admin/products/edit",compact('products','category','sub_category','third_category'));
	}

    public function orders(){
        $usertype_id = Auth::user()->usertype_id;
        $shop_id = Auth::user()->id;
        if($usertype_id == 1){
            $sql = "select a.*,b.name,phone,b.address from orders a,users b where a.customer_id=b.id and a.status='Pending'";
        }else{
            $sql = "select a.*,b.name,phone,b.address from orders a,users b where a.customer_id=b.id and a.status='Pending' and a.id in (select order_id from order_details where shop_id=$shop_id and status='Pending')";
        }
        $orders = DB::select($sql);
        return view("admin/products/orders",compact('orders'));
    }

    public function details($id){
        $usertype_id = Auth::user()->usertype_id;
        $shop_id = Auth::user()->id;
        if($usertype_id == 1){
            $sql = "select * from order_details where order_id=$id and  status='Pending'";
        }else{
            $sql = "select * from order_details  where order_id=$id and status='Pending' and shop_id=$shop_id";
        }
        $orders = DB::select($sql);
        return view("admin/products/details",compact('orders'));
    }

    public function photos($product_id)
    { 
        $sql = "select * from product_photo where product_id=$product_id";
        $photos = DB::select($sql);
        return view("admin/products/photos",compact('photos'));
    }

    public function delete($id,$product_id){
        $sql = "delete from product_photo where id=$id";
        DB::delete($sql);
        $sql = "select * from product_photo where product_id=$product_id";
        $photos = DB::select($sql);
        return view("admin/products/photos",compact('photos'));
    }

    public function AddProduct(Request $request){
        $category_id = $request->third_cat_id;
        $shop_id = Auth::user()->id;
        $product_id = DB::table('products')->insert([
            'product_name'       =>   $request->product_name,
            'category_id'        =>   $category_id,
            'shop_id'            =>   $shop_id,
            'description'        =>   $request->description,
            'price'              =>   $request->price,
            'min_quantity'       =>   $request->min_quantity,
            'quantity'           =>   $request->quantity,
            'status'             =>   'Active',
            'updated_at'         =>   date('Y-m-d H:i:s'),
        ]);
        $product_id = DB::getPdo()->lastInsertId();
        $no_of_images = count( $_FILES[ 'photo' ][ 'name' ] );
        for ( $i = 0 ; $i < $no_of_images ; $i++ ) {
            if ( $_FILES[ 'photo' ][ 'tmp_name' ][ $i ] != '' ) {
                $sql = "insert into product_photo (product_id) values ($product_id)";
                DB::insert( $sql );
                $file_id = DB::getPdo()->lastInsertId();
                $extension = pathinfo( $_FILES[ 'photo' ][ 'name' ][ $i ], PATHINFO_EXTENSION );
                $target_filename = $file_id . '.' . $extension;
                $tmpFilePath = $_FILES[ 'photo' ][ 'tmp_name' ][ $i ];
                $filepath = public_path( 'uploads'.DIRECTORY_SEPARATOR.'products'.DIRECTORY_SEPARATOR );
                $newFilePath = $filepath.$target_filename;
                move_uploaded_file( $tmpFilePath, $newFilePath );
                $sql = "update product_photo set photo='$target_filename' where id=$file_id";
                DB::update( $sql );
            }
        }
        return redirect('admin/products')->with('success', 'Product added successfully'); 
    }
    
    public function EditProduct(Request $request){
        $category_id = $request->third_cat_id;
        $product_id = $request->product_id;
        $editproduct = DB::table('products')->where('id',$request->product_id)->update([
            'product_name'       =>   $request->product_name,
            'category_id'        =>   $category_id,
            'description'        =>   $request->description,
            'price'              =>   $request->price,
            'min_quantity'       =>   $request->min_quantity,
            'status'             =>   $request->status,
            'updated_at'         =>   date('Y-m-d H:i:s'),
        ]);
        $no_of_images = count( $_FILES[ 'photo' ][ 'name' ] );
        for ( $i = 0 ; $i < $no_of_images ; $i++ ) {
            if ( $_FILES[ 'photo' ][ 'tmp_name' ][ $i ] != '' ) {
                $sql = "insert into product_photo (product_id) values ($product_id)";
                DB::insert( $sql );
                $file_id = DB::getPdo()->lastInsertId();
                $extension = pathinfo( $_FILES[ 'photo' ][ 'name' ][ $i ], PATHINFO_EXTENSION );
                $target_filename = $file_id . '.' . $extension;
                $tmpFilePath = $_FILES[ 'photo' ][ 'tmp_name' ][ $i ];
                $filepath = public_path( 'uploads'.DIRECTORY_SEPARATOR.'products'.DIRECTORY_SEPARATOR );
                $newFilePath = $filepath.$target_filename;
                move_uploaded_file( $tmpFilePath, $newFilePath );
                $sql = "update product_photo set photo='$target_filename' where id=$file_id";
                DB::update( $sql );
            }
        }
        return redirect('admin/products')->with('success', 'Products Updated Successfully'); 
    }

    public function updatestock(Request $request){
        $sql = "update products set quantity = quantity + $request->quantity where id = $request->product_id";
        DB::update($sql); 
        return redirect('admin/products')->with('success', 'Stock Updated Successfully'); 
    }
}