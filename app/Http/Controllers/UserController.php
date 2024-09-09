<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use Illuminate\Support\Facades\DB;
use Hash;
use App\SMS;

class UserController extends Controller
 {

    public function register() {
        return view( 'buyerregister' );
    }

  public function savebuyerregister(Request $request)
  {   
    $buyerphone = trim($request->buyerphone);
    $buyeremail = trim($request->buyeremail);
    $sql = "SELECT * FROM users where phone='$buyerphone'";
    $users = DB::select(DB::raw($sql));
    $sql = "SELECT * FROM users where email='$buyeremail'";
    $users2 = DB::select(DB::raw($sql));
    if(count($users) > 0){
      return redirect('/buyerregister')->with('error', 'Mobile number already registered')->withInput();
    }elseif(count($users2) > 0){
      return redirect('/buyerregister')->with('error', 'Email already registered')->withInput();
    }else{
     $buyerregister = DB::table('users')->insert([
      'name'               => $request->name,
      'email'              => $buyeremail,
      'password'           => Hash::make($request->buyerpassword),
      'plainpassword'      => $request->buyerpassword,
      'phone'              => $buyerphone,
      'usertype_id'        => 4,
      'created_at'         => date('Y-m-d H:i:s'),
    ]);
   }

   $admin = DB::getPdo()->lastInsertId();
   Auth::loginUsingId($admin);

   if (auth()->user()) 
   {
    return redirect('/user/dashboard')->with( 'success', 'Login Successfully' );
  }
}


public function SellerRegister(){
    $district = DB::table('district')->where('status','Active')->get();
    if ( $this->ismobile ) {
        return view("mobile/sellerregister",compact('district'));
    }else{
        return view("sellerregister",compact('district'));
    }
}

public function savesellerregister(Request $request)
{   
  $sellerphone = trim($request->sellerphone);
  $selleremail = trim($request->selleremail);
  $sql = "SELECT * FROM users where phone='$sellerphone'";
  $users = DB::select(DB::raw($sql));
  $sql = "SELECT * FROM users where email='$selleremail'";
  $users2 = DB::select(DB::raw($sql));
  if(count($users) > 0){
    return redirect('/sellerregister')->with('error', 'Mobile number already registered')->withInput();
  }elseif(count($users2) > 0){
    return redirect('/sellerregister')->with('error', 'Email already registered')->withInput();
  }else{
    DB::table('users')->insert([
    'name'               => $request->name,
    'email'              => $selleremail,
    'password'           => Hash::make($request->sellerpassword),
    'plainpassword'      => $request->sellerpassword,
    'dist_id'            => $request->dist_id,
    'taluk_id'           => $request->taluk_id,
    'landline_phone'     => $request->landline_phone,
    'owner_name'         => $request->owner_name,
    'gst_number'         => $request->gst_number,
    'pan_number'         => $request->pan_number,
    'address'            => $request->address,
    'vao_area'           => $request->vao_area,
    'phone'              => $sellerphone,
    'usertype_id'        => 3,
    'status'             => 0,
    'created_at'         => date('Y-m-d H:i:s'),
  ]);
 }

  return redirect('/')->with( 'success', 'Please Wait For The Admin Approval' );
}



public function gettalukfront(Request $request){
    $dist_id = $request->dist_id;
    $sql = "select id,taluk_name from taluk where parent=$dist_id and status=1 order by taluk_name";
    $taluk = DB::select(DB::raw($sql));
    return response()->json($taluk);
}

    public function dashboard()
 {

        $user_id = Auth::user()->id;
        $sql = " select count(*) as product from products where status='Active' and seller_id =$user_id ";
        $result = DB::select( DB::raw( $sql ) );
        if ( count( $result ) > 0 ) {
            $product = $result[ 0 ]->product;
        }
        $sql = " select count(*) as sellproduct from products where status='Sold' and seller_id =$user_id ";
        $result = DB::select( DB::raw( $sql ) );
        if ( count( $result ) > 0 ) {
            $sellproduct = $result[ 0 ]->sellproduct;
        }
        $sql = " select count(*) as favproduct from favorites where user_id =$user_id ";
        $result = DB::select( DB::raw( $sql ) );
        if ( count( $result ) > 0 ) {
            $favproduct = $result[ 0 ]->favproduct;
        }
        if ( Auth::user() && Auth::user()->usertype_id == 3 ) {
            $plan_id = Auth::user()->plan_id;
            $sql = "select * from plan where id=$plan_id";
            $plan = DB::select( DB::raw( $sql ) );
            $plan = $plan[ 0 ];
            if ( $this->ismobile ) {
                return view( 'mobile/user/dashboard', compact( 'product', 'sellproduct', 'favproduct', 'plan' ) );
            } else {
                return view( 'user/dashboard', compact( 'product', 'sellproduct', 'favproduct', 'plan' ) );
            }
        } else {
            return redirect( '/' );
        }
    }

    public function buyerregister() {
        return view( 'buyerregister' );
    }

    public function registeruser() {
        return view( 'registeruser' );
    }

    public function forgotpassotp( $mobile ) {
        $response = array();
        $status = 'fail';
        $status_type = 0;
        $message =  '';
        $sql = "SELECT * FROM users where phone='$mobile'";
        $users = DB::select( DB::raw( $sql ) );
        if ( count( $users ) > 0 ) {
            $status = 'success';
            $status_type = 1;
            $otp = rand( 1001, 9999 );
            $otp = '1234';
            $sql = "insert into password_otp (phone,otp) values ('$mobile','$otp')";
            DB::insert( DB::raw( $sql ) );
            $msg = "Dear Customer, use code $otp to reset your GSALE Account Login password. Never share your OTP with anyone.";
            //SMS::send( $mobile, $msg );
        } else {
            $message = 'Invalid Mobile No';
            $status_type = 1;
        }
        $response[ 'status' ] = $status;
        $response[ 'message' ] = $message;
        $response[ 'status_type' ] = $status_type;
        return response()->json( $response );
    }

    public function changepassword( Request $request ) {
        $response = array();
        $otp = '';
        $status = 'fail';
        $status_type = 0;
        $message =  '';
        $mobile = trim( $request->mobile );
        $otp = trim( $request->otp );
        $password = trim( $request->password );
        $conpassword = trim( $request->conpassword );
        $sql = "SELECT otp FROM password_otp where phone='$mobile' order by id desc limit 1";
        $message = $sql;
        $result = DB::select( DB::raw( $sql ) );
        if ( count( $result ) > 0 && ( $result[ 0 ]->otp == $otp ) ) {
            $sql2 = "SELECT id FROM users where phone='$mobile'";
            $result2 = DB::select( DB::raw( $sql2 ) );
            $user_id = $result2[ 0 ]->id;
            $updated_at = date( 'Y-m-d H:i:s' );
            $password = Hash::make( $password );
            $sql = "update users set password = '$password',updated_at='$updated_at' where id=$user_id";
            DB::update( DB::raw( $sql ) );
            $status = 'success';
            $status_type = 1;
            Auth::loginUsingId( $user_id );
        } else {
            $status_type = 1;
            $message = 'Invalid OTP';
        }
        $response[ 'status' ] = $status;
        $response[ 'message' ] = $message;
        $response[ 'status_type' ] = $status_type;
        $response[ 'otp' ] = $otp;
        return response()->json( $response );
    }

    public function buyerregistermobile( Request $request ) {
        $response = array();
        $status = 'fail';
        $status_type = 0;
        $message =  '';
        $email = trim( $request->email );
        $mobile = trim( $request->mobile );
        $name = trim( $request->name );
        $plainpassword = trim( $request->password );
        $sql = "SELECT * FROM users where email='$email'";
        $users = DB::select( DB::raw( $sql ) );
        $sql = "SELECT * FROM users where phone='$mobile'";
        $users2 = DB::select( DB::raw( $sql ) );
        if ( count( $users ) > 0 ) {
            $message = 'Email already registered';
            $status_type = 1;
        } elseif ( count( $users2 ) > 0 ) {
            $message = 'Mobile no already registered';
            $status_type = 2;
        } else {
                    $status = 'success';
                    $status_type = 2;
                    $usertype_id = 4;
                    $created_at = date( 'Y-m-d H:i:s' );
                    $password = Hash::make( $plainpassword );
                    $sql = "insert into users (name,email,phone,password,plainpassword,usertype_id,created_at) values ('$name','$email','$mobile','$password','$plainpassword','$usertype_id','$created_at')";
                    DB::insert( DB::raw( $sql ) );
                    $admin = DB::getPdo()->lastInsertId();
                    Auth::loginUsingId( $admin );
            }
        
        $response[ 'status' ] = $status;
        $response[ 'message' ] = $message;
        $response[ 'status_type' ] = $status_type;
        return response()->json( $response );
    }

    public function profile()
 {
        if ( Auth::user() ) {
            
            if ( $this->ismobile ) {
                return view( 'mobile/user/profile');
            } else {
                return view( 'user/profile');
            }
        } else {
            return redirect( '/' );
        }
    }

    public function getplan( Request $request ) {
        $plan_id = $request->plan_id;
        $sql = "select * from plan where id=$plan_id";
        $plan = DB::select( DB::raw( $sql ) );
        return response()->json( $plan );
    }

    public function bookmark()
 {
        if ( Auth::user() ) {
            if ( $this->ismobile ) {
                return view( 'mobile/user/bookmark' );
            } else {
                return view( 'user/bookmark' );
            }
        } else {
            return redirect( '/' );
        }
        //return view( 'user/bookmark' );
    }

    public function myproducts()
 {
        if ( Auth::user() ) {
            $seller_id = Auth::user()->id;
            $sql = "select * from products where seller_id=$seller_id order by id desc";
            $products = DB::select( DB::raw( $sql ) );
            $products = json_decode( json_encode( $products ), true );
            foreach ( $products as $key => $prod ) {
                $product_id = $prod[ 'id' ];
                $sql = "select photo from product_photo where product_id = $product_id order by id";
                $result = DB::select( DB::raw( $sql ) );
                $j = 0;
                if ( count( $result ) > 0 ) {
                    foreach ( $result as $res ) {
                        $products[ $key ][ 'photo' ][ $j ] = $res->photo;
                        $j++;
                    }
                }
            }
            $products = json_decode( json_encode( $products ) );
            // echo '<pre>';
            // print_r( $products );
            // echo'</pre>';
            // die;
            if ( $this->ismobile ) {
                return view( 'mobile/user/my-products', compact( 'products' ) );
            } else {
                return view( 'user/my-products', compact( 'products' ) );
            }
        } else {
            return redirect( '/' );
        }
    }

    public function soldproducts()
 {
        if ( Auth::user() ) {
            $seller_id = Auth::user()->id;
            $sql = "select * from products where status='Sold' and seller_id=$seller_id order by id desc";
            $products = DB::select( DB::raw( $sql ) );
            $products = json_decode( json_encode( $products ), true );
            foreach ( $products as $key => $prod ) {
                $product_id = $prod[ 'id' ];
                $sql = "select photo from product_photo where product_id = $product_id order by id";
                $result = DB::select( DB::raw( $sql ) );
                $j = 0;
                if ( count( $result ) > 0 ) {
                    foreach ( $result as $res ) {
                        $products[ $key ][ 'photo' ][ $j ] = $res->photo;
                        $j++;
                    }
                }
            }
            $products = json_decode( json_encode( $products ) );
            if ( $this->ismobile ) {
                return view( 'mobile/user/sold-products', compact( 'products' ) );
            } else {
                return view( 'user/sold-products', compact( 'products' ) );
            }
        } else {
            return redirect( '/' );
        }
    }

    public function wish()
 {
        if ( Auth::user() ) {
            $user_id = Auth::user()->id;
            $sql = "select * from products where id in (select product_id from favorites where user_id=$user_id) order by id desc";
            $products = DB::select( DB::raw( $sql ) );
            $products = json_decode( json_encode( $products ), true );
            foreach ( $products as $key => $prod ) {
                $product_id = $prod[ 'id' ];
                $sql = "select photo from product_photo where product_id = $product_id order by id";
                $result = DB::select( DB::raw( $sql ) );
                $j = 0;
                if ( count( $result ) > 0 ) {
                    foreach ( $result as $res ) {
                        $products[ $key ][ 'photo' ][ $j ] = $res->photo;
                        $j++;
                    }
                }
            }
            $products = json_decode( json_encode( $products ) );
            if ( $this->ismobile ) {
                return view( 'mobile/user/wish_list', compact( 'products' ) );
            } else {
                return view( 'user/wish_list', compact( 'products' ) );
            }
        } else {
            return redirect( '/' );
        }
    }

    public function wishlist()
 {
        if ( Auth::user() ) {
            $user_id = Auth::user()->id;
            $sql = "select * from products where id in (select product_id from favorites where user_id=$user_id) order by id desc";
            $products = DB::select( DB::raw( $sql ) );
            $products = json_decode( json_encode( $products ), true );
            foreach ( $products as $key => $prod ) {
                $product_id = $prod[ 'id' ];
                $sql = "select photo from product_photo where product_id = $product_id order by id";
                $result = DB::select( DB::raw( $sql ) );
                $j = 0;
                if ( count( $result ) > 0 ) {
                    foreach ( $result as $res ) {
                        $products[ $key ][ 'photo' ][ $j ] = $res->photo;
                        $j++;
                    }
                }
            }
            $products = json_decode( json_encode( $products ) );
            if ( $this->ismobile ) {
                return view( 'user/wishlist', compact( 'products' ) );
            } else {
                return view( 'user/wishlist', compact( 'products' ) );
            }
        } else {
            return redirect( '/' );
        }
    }

    public function addwish()
 {
        if ( Auth::user() ) {
            $sql = 'select * from category where parent_id=0 and status=1 order by id';
            $category = DB::select( DB::raw( $sql ) );
            $category = json_decode( json_encode( $category ), true );
            $sql = 'select * from states order by name';
            $states = DB::select( DB::raw( $sql ) );
            $sql = 'select * from cities where state_id = 21 order by city';
            $cities = DB::select( DB::raw( $sql ) );
            if ( $this->ismobile ) {
                return view( 'mobile/user/add-product', compact( 'category', 'states', 'cities' ) );
            } else {
                return view( 'user/add-product', compact( 'category', 'states', 'cities' ) );
            }
        } else {
            return redirect( '/' );
        }
    }

    public function addfavorites( $user_id, $product_id ) {
        $created_at = date( 'Y-m-d H:i:s' );
        $sql = "select * from favorites where product_id=$product_id and user_id=$user_id";
        $result = DB::select( DB::raw( $sql ) );
        if ( count( $result ) == 0 ) {
            $sql = "insert into favorites (user_id,product_id,created_at) value ($user_id,$product_id,'$created_at')";

            DB::insert( DB::raw( $sql ) );
        }
        $response[ 'status' ] = 'success';
        return response()->json( $response );
    }

    public function removefavorites( $user_id, $product_id ) {
        $sql = "delete from favorites where product_id=$product_id and user_id=$user_id";
        $result = DB::delete( DB::raw( $sql ) );
        $response[ 'status' ] = 'success';
        return response()->json( $response );
    }

    public function markassold( $product_id ) {
        $sql = "update products set status = 'Sold' where id=$product_id";
        $result = DB::update( DB::raw( $sql ) );
        $response[ 'status' ] = 'success';
        return response()->json( $response );
    }

    public function marksold( $product_id ) {
        $sql = "update products set status = 'Sold' where id=$product_id";
        $result = DB::update( DB::raw( $sql ) );
        $response[ 'status' ] = 'success';
        return response()->json( $response );
    }

    public function addproduct()
 {
        if ( Auth::user() ) {
            $sql = 'select * from category where parent_id=0 and status=1 order by id';
            $category = DB::select( DB::raw( $sql ) );
            $category = json_decode( json_encode( $category ), true );
            $sql = 'select * from states order by name';
            $states = DB::select( DB::raw( $sql ) );
            $sql = 'select * from cities where state_id = 21 order by city';
            $cities = DB::select( DB::raw( $sql ) );
            $sql = 'select * from payment_method order by payment_name';
            $payment = DB::select( DB::raw( $sql ) );
            if ( $this->ismobile ) {
                return view( 'mobile/user/add-product', compact( 'category', 'states', 'cities', 'payment' ) );
            } else {
                return view( 'user/add-product', compact( 'category', 'states', 'cities', 'payment' ) );
            }
        } else {
            return redirect( '/' );
        }
    }

    public function removeimage( $id ) {
        $sql = "select * from product_photo where id=$id";
        $result = DB::select( DB::raw( $sql ) );
        $product_id = $result[ 0 ]->product_id;
        $filepath = public_path( 'uploads'.DIRECTORY_SEPARATOR.'products'.DIRECTORY_SEPARATOR );
        $photo = $result[ 0 ]->photo;
        if ( !empty( $photo ) ) {
            unlink( $filepath.$photo );
        }

        $sql = "delete from product_photo where id=$id";
        DB::delete( DB::raw( $sql ) );
        if ( $this->ismobile ) {
            return redirect( "/user/edit_product/$product_id" )->with( 'success', 'Image Removed Successfully' );
        } else {
            return redirect( "/user/edit_product/$product_id" )->with( 'success', 'Image Removed Successfully' );
        }
    }

    public function delete_product( $id )
 {
        $seller_id = Auth::user()->id;
        $sql = "select * from products where id=$id";
        $products = DB::select( DB::raw( $sql ) );
        $products = $products[ 0 ];
        if ( $seller_id == $products->seller_id ) {
            $filepath = public_path( 'uploads'.DIRECTORY_SEPARATOR.'products'.DIRECTORY_SEPARATOR );
            $sql = "select * from product_photo where product_id=$id";
            $result = DB::select( DB::raw( $sql ) );

            foreach ( $result as $res ) {
                $photo = $res->photo;
                if ( !empty( $photo ) ) {
                    unlink( $filepath.$photo );
                }
            }

            $sql = "delete from product_attribute where product_id = $id";
            DB::delete( DB::raw( $sql ) );
            $sql = "delete from product_photo where product_id = $id";
            DB::delete( DB::raw( $sql ) );
            $sql = "delete from favorites where product_id = $id";
            DB::delete( DB::raw( $sql ) );
            $sql = "delete from products where id = $id";
            DB::delete( DB::raw( $sql ) );
            if ( $this->ismobile ) {
                return redirect( '/user/my_products' )->with( 'success', 'Product Deleted Successfully' );
            } else {
                return redirect( '/user/my_products' )->with( 'success', 'Product Deleted Successfully' );
            }
        }
    }

    public function edit_product( $id )
 {
        if ( Auth::user() ) {
            $seller_id = Auth::user()->id;
            $sql = "select * from products where id=$id";
            $products = DB::select( DB::raw( $sql ) );
            $products = $products[ 0 ];
            if ( $seller_id == $products->seller_id ) {
                $sql = 'select * from category where parent_id=0 and status=1 order by id';
                $category = DB::select( DB::raw( $sql ) );
                $category = json_decode( json_encode( $category ), true );
                $sql = "select * from products where id=$id";
                $products = DB::select( DB::raw( $sql ) );
                $sub_cat_id = $products[ 0 ]->category_id;
                $sql = "select parent_id from category where id=$sub_cat_id";
                $maicat = DB::select( DB::raw( $sql ) );
                $cat_id = $maicat[ 0 ]->parent_id;
                $sql = "select * from category where parent_id=$cat_id and status=1 order by category_name";
                $sub_category = DB::select( DB::raw( $sql ) );
                $products = $products[ 0 ];
                $sql = "select a.attr_value as attr_value2,b.* from product_attribute a,attribute b where a.attr_id=b.id and a.product_id=$id";
                $attrs = DB::select( DB::raw( $sql ) );
                // $state_name = $products->state_id;
                // $sql = 'select * from states order by name';
                // $states = DB::select( DB::raw( $sql ) );
                // $sql = "select * from states where name='$state_name'";
                // $state_res = DB::select( DB::raw( $sql ) );
                // $state_id = $state_res[ 0 ]->id;
                // $sql = "select * from cities where state_id = $state_id order by city";
                $cities = DB::select( DB::raw( $sql ) );
                $sql = "select * from product_photo where product_id = $id";
                $product_photos = DB::select( DB::raw( $sql ) );
                if ( $this->ismobile ) {
                    return view( 'mobile/user/edit-product', compact( 'category', 'sub_category', 'products', 'attrs', 'sub_cat_id', 'cat_id', 'states', 'cities', 'product_photos' ) );
                } else {
                    return view( 'user/edit-product', compact( 'category', 'sub_category', 'products', 'attrs', 'sub_cat_id', 'cat_id', 'states', 'cities', 'product_photos' ) );
                }
            } else {
                return redirect( '/' );
            }
        } else {
            return redirect( '/' );
        }
    }

    public function updateproduct( Request $request ) {
        if ( isset( $request->current_location ) ) {
            $current_location = 1;
        } else {
            $current_location = 0;
        }
        $address = '';
        if ( $current_location == 1 ) {
            $address = $request->address2;
        } else {
            $address = $request->address;
        }
        $seller_id = Auth::user()->id;
        $product_id = $request->product_id;
        $name = $request->product_name;
        $product_name = str_replace( "'", '', $name );

        $product_name = str_replace( [ '\\', '/' ], ' ', $product_name );

        $description = $request->description;
        $price = $request->price;
        $location = $request->location;
        $status = $request->status;
        $state_id = $request->state_id;
        $city_id = $request->city_id;
        $updated_at = date( 'Y-m-d H:i:s' );
        //$sql = "update products set product_name = '$product_name',description = '$description',status = '$status', address = '$address',location = '$location',price = '$price',updated_at = '$updated_at',state_id = '$state_id',city_id = '$city_id',current_location=$current_location where id=$product_id";
        //DB::update( DB::raw( $sql ) );
        $updateuser = DB::table( 'products' )->where( 'id', $product_id )->update( [
            'product_name' => $product_name,
            'description' => $description,
            'status' => $status,
            'address' => $address,
            'location' => $location,
            'price' => $price,
            'updated_at' => $updated_at,
            'state_id' => $state_id,
            'city_id' => $city_id,
            'current_location' => $current_location,
        ] );
        $sql = "delete from product_attribute where product_id=$product_id";
        DB::delete( DB::raw( $sql ) );
        foreach ( $request->all() as $key => $attr_value ) {
            if ( str_contains( $key, 'attr_' ) ) {

                $second = explode( '_', $key )[ 1 ];
                $attr_id = 0;
                $attr_value2 = '';
                if ( $second != 'check' ) {
                    $attr_id = $second;
                    $attr_value2 = $attr_value;
                } else {
                    $attr_id = explode( '_', $key )[ 2 ];
                    $attr_varr = array();
                    foreach ( $request->$key as $v ) {
                        array_push( $attr_varr, $v );
                    }
                    $attr_value2 = implode( ',', $attr_varr );
                }
                //echo $attr_id.'->'.$attr_value2.'<br>';
                $sql = "insert into product_attribute (product_id,attr_id,attr_value) values ($product_id,'$attr_id','$attr_value2')";
                DB::insert( DB::raw( $sql ) );
            }
        }
        $no_of_images = count( $_FILES[ 'photo' ][ 'name' ] );
        for ( $i = 0 ; $i < $no_of_images ; $i++ ) {
            if ( $_FILES[ 'photo' ][ 'tmp_name' ][ $i ] != '' ) {
                $sql = "insert into product_photo (product_id) values ($product_id)";
                DB::insert( $sql );
                $file_id = DB::getPdo()->lastInsertId();
                $sql = "select product_name from products where id = $product_id";
                $title = DB::select( DB::raw( $sql ) );
                $changename = $title[ 0 ]->product_name;
                $output = preg_replace( '!\s+!', ' ', $changename );
                $photoname =  strtolower( str_replace( ' ', '_', $output ) );
                $extension = pathinfo( $_FILES[ 'photo' ][ 'name' ][ $i ], PATHINFO_EXTENSION );
                $target_filename = $photoname .'_' .$file_id . '.' . $extension;
                $tmpFilePath = $_FILES[ 'photo' ][ 'tmp_name' ][ $i ];
                $filepath = public_path( 'uploads'.DIRECTORY_SEPARATOR.'products'.DIRECTORY_SEPARATOR );
                if ( $tmpFilePath != '' ) {
                    $newFilePath = $filepath.$target_filename;
                    move_uploaded_file( $tmpFilePath, $newFilePath );
                    $sql = "update product_photo set photo='$target_filename' where id=$file_id";
                    DB::update( $sql );
                }
            }
        }
        if ( $this->ismobile ) {
            return redirect( '/user/my_products' )->with( 'success', 'Product Updated Successfully' );
        } else {
            return redirect( '/user/my_products' )->with( 'success', 'Product Updated Successfully' );
        }
    }

    public function saveprofile( Request $request ) {
        $seller_id = Auth::user()->id;
        $name = $request->name;
        $address = $request->address;
        $photo = 'photo.png';
        if ( $_FILES[ 'photo' ][ 'name' ] != '' ) {
            $target_dir = 'uploads/photo/';
            $extension = strtolower( pathinfo( $_FILES[ 'photo' ][ 'name' ], PATHINFO_EXTENSION ) );
            $photo = $seller_id .'.'. $extension ;
            move_uploaded_file( $_FILES[ 'photo' ][ 'tmp_name' ], $target_dir . $photo );
        }
        $sql = "update users set name='$name',photo='$photo' where id=$seller_id";
        DB::update( $sql );
        if ( $this->ismobile ) {
            return redirect( 'user/profile' )->with( 'success', 'Profile Saved Successfully' );
        } else {
            return redirect( '/user/profile' )->with( 'success', 'Profile Saved Successfully' );
        }
    }

    public function saveproduct( Request $request ) {
        $image_data_url = $request->image_data_url;
        $post_date = date( 'Y-m-d' );
        if ( isset( $request->current_location ) ) {
            $current_location = 1;
        } else {
            $current_location = 0;
        }
        $address = '';
        if ( $current_location == 1 ) {
            $address = $request->address2;
        } else {
            $address = $request->address;
        }
        $seller_id = Auth::user()->id;
        $cat_id = $request->cat_id;
        $sub_cat_id = $request->sub_cat_id;
        $name = $request->product_name;
        $product_name = str_replace( "'", '', $name );

        $product_name = str_replace( [ '\\', '/' ], ' ', $product_name );

        $output = preg_replace( '!\s+!', ' ', $product_name );
        $product_url =  strtolower( str_replace( " '", '_', $output ) );

        $description = $request->description;
        $price = $request->price;
        $quantity = $request->quantity;
        $location = $request->location;
        $payment_method = $request->payment_method;
        $status = 'Active';
        $state_id = $request->state_id;
        $city_id = $request->city_id;
        $created_at = date( 'Y-m-d H:i:s' );
        //$sql = "insert into products (category_id,product_name,description,status,address,location,price,created_at,seller_id,state_id,city_id,current_location,post_date) values ($sub_cat_id,'$product_name','$description','$status','$address','$location','$price','$created_at',$seller_id,'$state_id','$city_id',$current_location,'$post_date')";
        //DB::insert( DB::raw( $sql ) );
        $adduser = DB::table( 'products' )->insert( [
            'category_id' => $sub_cat_id,
            'product_name' => $product_name,
            'product_url' => $product_url,
            'description' => $description,
            'status' => $status,
            'address' => $address,
            'location' => $location,
            'payment_method' => $payment_method,
            'price' => $price,
            'quantity' => $quantity,
            'created_at' => $created_at,
            'seller_id' => $seller_id,
            'state_id' => $state_id,
            'city_id' => $city_id,
            'current_location' => $current_location,
            'post_date' => $post_date,
        ] );
        $product_id = DB::getPdo()->lastInsertId();
        foreach ( $request->all() as $key => $attr_value ) {
            if ( str_contains( $key, 'attr_' ) ) {

                $second = explode( '_', $key )[ 1 ];
                $attr_id = 0;
                $attr_value2 = '';
                if ( $second != 'check' ) {
                    $attr_id = $second;
                    $attr_value2 = $attr_value;
                } else {
                    $attr_id = explode( '_', $key )[ 2 ];
                    $attr_varr = array();
                    foreach ( $request->$key as $v ) {
                        array_push( $attr_varr, $v );
                    }
                    $attr_value2 = implode( ',', $attr_varr );
                }
                //echo $attr_id.'->'.$attr_value2.'<br>';
                $sql = "insert into product_attribute (product_id,attr_id,attr_value) values ($product_id,'$attr_id','$attr_value2')";
                DB::insert( DB::raw( $sql ) );
            }
        }

        $no_of_images = count( $_FILES[ 'photo' ][ 'name' ] );
        for ( $i = 0 ; $i < $no_of_images ; $i++ ) {
            if ( $_FILES[ 'photo' ][ 'tmp_name' ][ $i ] != '' ) {
                $sql = "insert into product_photo (product_id) values ($product_id)";
                DB::insert( $sql );
                $file_id = DB::getPdo()->lastInsertId();
                $sql = "select product_name from products where id = $product_id";
                $title = DB::select( DB::raw( $sql ) );
                $changename = $title[ 0 ]->product_name;
                $output = preg_replace( '!\s+!', ' ', $changename );
                $photoname =  strtolower( str_replace( ' ', '_', $output ) );
                $extension = pathinfo( $_FILES[ 'photo' ][ 'name' ][ $i ], PATHINFO_EXTENSION );
                $target_filename = $photoname .'_' .$file_id . '.' . $extension;
                $tmpFilePath = $_FILES[ 'photo' ][ 'tmp_name' ][ $i ];
                $filepath = public_path( 'uploads'.DIRECTORY_SEPARATOR.'products'.DIRECTORY_SEPARATOR );
                if ( $tmpFilePath != '' ) {
                    $newFilePath = $filepath.$target_filename;
                    move_uploaded_file( $tmpFilePath, $newFilePath );
                    $sql = "update product_photo set photo='$target_filename' where id=$file_id";
                    DB::update( $sql );
                }
            }
        }

        if ( $this->ismobile ) {
            return redirect( '/user/my_products' )->with( 'success', 'Product Added Successfully' );
        } else {
            return redirect( '/user/my_products' )->with( 'success', 'Product Added Successfully' );
        }
    }

    public function change_password()
 {
        if ( Auth::user() ) {
            if ( $this->ismobile ) {
                return view( 'mobile/user/change-password' );
            } else {
                return view( 'user/change-password' );
            }
        } else {
            return redirect( '/' );
        }
    }

    public function update_password( Request $request ) {
        $id = auth()->user()->id;
        $old_password = trim( $request->get( 'old_password' ) );
        $currentPassword = auth()->user()->password;
        if ( Hash::check( $old_password, $currentPassword ) ) {
            $new_password = trim( $request->get( 'new_password' ) );
            $confirm_password = trim( $request->get( 'confirm_password' ) );
            if ( $new_password != $confirm_password ) {
                if ( $this->ismobile ) {
                    return redirect( 'user/change_password' )->with( 'error', 'Passwords does not match' );
                } else {
                    return redirect( 'user/change_password' )->with( 'error', 'Passwords does not match' );
                }
            } else {
                $update = DB::table( 'users' )->where( 'id', '=', $id )->update( [
                    'password' => Hash::make( $new_password ),
                    'updated_at'    => date( 'Y-m-d H:i:s' ),
                ] );
                if ( $this->ismobile ) {
                    return redirect( 'user/change_password' )->with( 'success', 'Password Changed Successfully' );
                } else {
                    return redirect( 'user/change_password' )->with( 'success', 'Password Changed Successfully' );
                }
            }
        } else {
            if ( $this->ismobile ) {
                return redirect( 'user/change_password' )->with( 'error', 'Sorry, your current password was not recognised' );
            } else {
                return redirect( 'user/change_password' )->with( 'error', 'Sorry, your current password was not recognised' );
            }
        }
    }

}