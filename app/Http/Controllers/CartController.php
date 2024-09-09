<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;

class CartController extends Controller {
/*public function __construct() {
$this->middleware( 'auth' );
}*/

public function cart()
{

    if ( $this->ismobile ) {
        return view( 'mobile.cart');
    } else {
        return view( 'cart');
    }

}


public function savecart( Request $request ) {
    $products = $request->products;
    $productsarray = json_decode( $products, true );

    $order_no = 0;
    $sql = "select max(order_no) orderno from orders";
        $result = DB::select( DB::raw( $sql ) );
        if ( count( $result ) > 0 ) {
            $order_no = $result[ 0 ]->orderno;
            $order_no = $order_no + 1;
        }
    DB::table('orders')->insert([
        'order_no'        =>   $order_no,
        'order_date'      =>   date('Y-m-d'),
        'order_time'      =>   date('H:i:s'),
        'receivername'      =>   $request->deliveryperson,
        'receiverphone'      =>   $request->deliverymobile,
        'receiveraddress'      =>  $request->deliveryaddress,
        'customer_id'     =>   auth()->user()->id,
        'status'          =>   'Pending',
    ]);
    $orderid = DB::getPdo()->lastInsertId();
    $total = 0;
    $gst = 0;
    foreach ( $productsarray as $prod ) {
        $product_id = $prod[ 'id' ];
        $product_name = $prod[ 'name' ];
        $quantity = $prod[ 'quantity' ];
        $price = $prod[ 'price' ];
        $subtotal = $quantity * $price;
        $total = $total + $subtotal;
        $nettotal = $gst + $total;

        $shop_id = DB::table( 'products' )->select('shop_id')->where( 'id', $product_id )->pluck('shop_id')->first();
        $sql = "update products set quantity = quantity - $quantity where id = $product_id";
        DB::update($sql); 
      

        DB::table('order_details')->insert([
            'order_id'           =>   $orderid,
            'shop_id'            =>   $shop_id,
            'product_id'         =>   $product_id,
            'product_name'       =>   $product_name,
            'quantity'           =>  $quantity,
            'price'              =>   $price,
            'subtotal'           =>   $subtotal,
            'status'             =>   'Pending',
        ]);
    }
    DB::table('orders')->where('id',$orderid)->update([
        'total'    =>   $total,
        'net_total'    =>   $nettotal,
    ]);
}

public function deletecart( $id ) {

    $deletecart = DB::table( 'cart' )->where( 'id', $id )->delete();

    return redirect( '/cart' )->with( 'success', 'AddToCart Delete Successfully' );
}
}