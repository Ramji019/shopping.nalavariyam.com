<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Hash;
use Auth;

class SellerController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function ManageSeller()
	{
        if(Auth::user()->user_type == 3){
        return redirect('admin/dashboard')->with('error', 'You have no permission to access');
        }
                
        $seller = DB::table('users')->where('usertype_id','=',3)->orderBy('id','asc')->get();
        $sql="select id,district_name from district";
        $district = DB::select($sql);
		return view("admin/seller/seller",compact('seller','district'));
	}

    public function ManageSell($seller_id){
        $sellerproducts = DB::table('products')->where('shop_id',$seller_id)->get();
		return view("admin/sellerproduct/sellerproduct",compact('sellerproducts'));
	}

    public function addseller(Request $request){
        $name = $request->name;
        $email = $request->email;
        $phone = $request->phone;
        $dist_id = $request->dist_id;
        $taluk_id = $request->taluk_id;
        $vao_area = $request->vao_area;
        $owner_name = $request->owner_name;
        $gst_number = $request->gst_number;
        $pan_number = $request->pan_number;
        $landline_phone = $request->landline_phone;
        $status = 1;
        $plainpassword = rand(1001,9999);
        $password = Hash::make($plainpassword);
        $usertype_id = 3;
        $query = "insert into users (name,email,phone,status,password,plainpassword,usertype_id,dist_id,taluk_id,vao_area,owner_name,gst_number,pan_number,landline_phone) values (?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $values = [$name,$email,$phone,$status,$password,$plainpassword,$usertype_id,$dist_id,$taluk_id,$vao_area,$owner_name,$gst_number,$pan_number,$landline_phone];
        DB::insert($query, $values);
        return redirect('admin/seller')->with('success', 'Seller Added Successfully'); 
    }

    public function editseller(Request $request){
        $id = $request->user_id;
        $name = $request->name;
        $email = $request->email;
        $phone = $request->phone;
        $status = $request->status;
        $plainpassword = $request->password;
        $password = Hash::make($plainpassword);
        $dist_id = $request->dist_id;
        $taluk_id = $request->taluk_id;
        $vao_area = $request->vao_area;
        $owner_name = $request->owner_name;
        $gst_number = $request->gst_number;
        $pan_number = $request->pan_number;
        $landline_phone = $request->landline_phone;
        $query = "update users set name=?,email=?,phone=?,status=?,plainpassword=?,password=?,dist_id=?,taluk_id=?,vao_area=?,owner_name=?,gst_number=?,pan_number=?,landline_phone=? where id = ?";
        $values = [$name,$email,$phone,$status,$plainpassword,$password,$dist_id,$taluk_id,$vao_area,$owner_name,$gst_number,$pan_number,$landline_phone,$id];
        DB::update($query, $values);
        return redirect('admin/seller')->with('success', 'Seller Updated Successfully'); 
    }

    
}
