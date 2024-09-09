<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Hash;


class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function catattribute()
    {
        $sql = "select * from category where parent_id=0 and status=1 order by id";
        $category = DB::select(DB::raw($sql));
        $sql = "select * from attribute order by attr_name";
        $attributes = DB::select(DB::raw($sql));
        $sql = "select a.*,b.category_name,c.attr_name,c.attr_type,d.category_name as cat from category_attribute a,category b,attribute c,category d where a.category_id=b.id and a.attr_id=c.id and b.parent_id=d.id";
        $attrlink = DB::select(DB::raw($sql));
        return view("admin/category/catattribute", compact('category','attributes','attrlink'));
    }

    public function linkattribute(Request $request){
        $cat_id = $request->cat_id;
        $sub_cat_id = $request->sub_cat_id;
        $attr_id = $request->attr_id;
        $sql = "insert into category_attribute (category_id,attr_id) values ($sub_cat_id,$attr_id)";
        DB::insert(DB::raw($sql));
        return redirect('admin/catattribute')->with('success', 'Attribute Linked Successfully');
    }

    public function getsubcategory(Request $request){
        $parent_id = $request->cat_id;
        $sql = "select id,category_name from category where parent_id=$parent_id and status=1 order by id";
        $subcategory = DB::select(DB::raw($sql));
        return response()->json($subcategory);
    }

    public function gettaluk(Request $request){
        $dist_id = $request->dist_id;
        $sql = "select id,taluk_name from taluk where parent=$dist_id and status=1 order by taluk_name";
        $taluk = DB::select(DB::raw($sql));
        return response()->json($taluk);
    }

    public function getcity(Request $request){
        $name = $request->state_id;
        $sql = "select * from states where name='$name'";
        $state = DB::select(DB::raw($sql));
        $state_id = $state[0]->id;
        $sql = "select id,city from cities where state_id=$state_id order by city";
        $cities = DB::select(DB::raw($sql));
        return response()->json($cities);
    }

    public function getattributes(Request $request){
        $sub_cat_id = $request->sub_cat_id;
        $sql = "select b.* from category_attribute a,attribute b where a.attr_id = b.id and a.category_id=$sub_cat_id";
        $attributes = DB::select(DB::raw($sql));
        return response()->json($attributes);
    }

    public function attribute()
    {
        $sql = "select * from attribute order by attr_name";
        $attributes = DB::select(DB::raw($sql));
        $attributes = json_decode(json_encode($attributes),true);
        foreach ($attributes as $key => $attr) {
            $attr_id = $attr["id"];
            $sql = "select * from category_attribute where attr_id = $attr_id";
            $result = DB::select(DB::raw($sql));
            $attributes[$key]["can_delete"] = true;
            if(count($result) > 0){
                $attributes[$key]["can_delete"] = false;
            }
        }
        $attributes = json_decode(json_encode($attributes));
        return view("admin/category/attribute", compact('attributes'));
    }

    public function ManageCategory()
    {
        $sql = "select * from category where parent_id=0 and status=1 order by id";
        $category = DB::select(DB::raw($sql));
        return view("admin/category/category", compact('category'));
    }

    public function AddCategory(Request $request)
    {
        $addcategory = DB::table('category')->insert([
            'category_name' => $request->category_name,
            'created_at'    => date('Y-m-d H:i:s'),
            'status'        => 1,
        ]);

        $last_insert_id = DB::getPdo()->lastInsertId();

        $catimg = "";
        if ( $request->photo != null ) {
            $catimg = $last_insert_id . '.' . $request->file( 'photo' )->extension();
            $filepath = public_path( 'uploads' . DIRECTORY_SEPARATOR . 'category' . DIRECTORY_SEPARATOR );
            move_uploaded_file( $_FILES[ 'photo' ][ 'tmp_name' ], $filepath . $catimg );
        }
       
        $addimg = DB::table( 'category' )->where( 'id', $last_insert_id )->update( [
            'photo' => $catimg,
        ] );
        return redirect('admin/category')->with('success', 'Category Added Successfully');
    }
    public function AddSubCategory(Request $request)
    {

        $addsubcategory = DB::table('category')->insert([
            'parent_id'        => $request->category_id,
            'category_name'    => $request->subcategory_name,
            'created_at'       => date('Y-m-d H:i:s'),
            'status'           => 1,
        ]);

        
        $last_insert_id = DB::getPdo()->lastInsertId();

        $subimg = "";
        if ( $request->photo != null ) {
            $subimg = $last_insert_id . '.' . $request->file( 'photo' )->extension();
            $filepath = public_path( 'uploads' . DIRECTORY_SEPARATOR . 'category' . DIRECTORY_SEPARATOR );
            move_uploaded_file( $_FILES[ 'photo' ][ 'tmp_name' ], $filepath . $subimg );
        }
       
        $addimg = DB::table( 'category' )->where( 'id', $last_insert_id )->update( [
            'photo' => $subimg,
        ] );

        return redirect("admin/subcategory/" . $request->category_id)->with('success', 'SubCategory Added Successfully');
    }

    public function AddAttribute(Request $request)
    {
        $attr_value = "";
        if($request->attr_type == "dropdown" || $request->attr_type == "checkbox" || $request->attr_type == "radio"){
            $attr_value = $request->attr_value;
        } 
        $addattribute = DB::table('attribute')->insert([
            'attr_name'        => $request->attr_name,
            'attr_type'        => $request->attr_type,
            'attr_value'       => $attr_value,
        ]);
        return redirect('admin/attribute')->with('success', 'Attribute Added Successfully');
    }

    public function deleteattribute($id)
    {
        $sql = "select * from category_attribute where attr_id = $id";
        $result = DB::select(DB::raw($sql));
        if(count($result) > 0){
            return redirect('admin/attribute')->with('success', 'This Attribute Cannot be Deleted');
        }else{
            $sql = "delete from attribute where id=$id";
            DB::delete(DB::raw($sql));
        }
        return redirect('admin/attribute')->with('success', 'Attribute Deleted Successfully');
    }

    public function deleteattributelink($id)
    {
        $sql = "delete from category_attribute where id=$id";
        DB::delete(DB::raw($sql));
        return redirect('admin/catattribute')->with('success', 'Attribute Link Deleted Successfully');
    }

    public function EditCategory(Request $request)
    {
        $editcategory = DB::table('category')->where('id', $request->category_id)->update([
            'category_name' => $request->category_name,
            'updated_at'    => date('Y-m-d H:i:s'),
            'status'        => $request->status,
        ]);

        if ( $request->photo != null ) {
            $catimg = $request->category_id . '.' . $request->file( 'photo' )->extension();
            $filepath = public_path( 'uploads' . DIRECTORY_SEPARATOR . 'category' . DIRECTORY_SEPARATOR );
            move_uploaded_file( $_FILES[ 'photo' ][ 'tmp_name' ], $filepath . $catimg );

             DB::table( 'category' )->where( 'id', $request->category_id )->update( [
                'photo' => $catimg,
            ] );
        }

       
        return redirect('admin/category')->with('success', 'Category Updated Successfully');
    }

    public function EditSubCategory(Request $request)
    {

        $editsubcategory = DB::table('category')->where('id', $request->category_id)->update([
            'category_name' => $request->subcategory_name,
            'updated_at'       => date('Y-m-d H:i:s'),
            'status'           => $request->status,
        ]);

        if ( $request->photo != null ) {
            $subimg = $request->category_id . '.' . $request->file( 'photo' )->extension();
            $filepath = public_path( 'uploads' . DIRECTORY_SEPARATOR . 'category' . DIRECTORY_SEPARATOR );
            move_uploaded_file( $_FILES[ 'photo' ][ 'tmp_name' ], $filepath . $subimg );

             DB::table( 'category' )->where( 'id', $request->category_id )->update( [
                'photo' => $subimg,
            ] );
        }


        return redirect("admin/subcategory/". $request->parent_id)->with('success', 'Category Updated Successfully');
    }
    public function DeleteSubcat($id)
    {
       
        $cat = DB::table('category')->where('id', $id)->get();
        $parent_id = 0;
        if (count($cat) > 0) {
            $parent_id = $cat[0]->parent_id;
        }
        $filepath = public_path( 'uploads'.DIRECTORY_SEPARATOR.'category'.DIRECTORY_SEPARATOR );
        $photo = $cat[ 0 ]->photo;
        if ( !empty( $photo ) ) {
            unlink( $filepath.$photo );
        }
        $deletesubcat = DB::table('category')->where('id', $id)->delete();

        return redirect("admin/subcategory/". $parent_id)->with('success', 'Subcategory Deleted Successfully');
    }
    public function manageSubcategory($id)
    {
        $sql = "select * from category where parent_id=$id order by id";
        $subcat = DB::select(DB::raw($sql));
        $sql = "select * from category where id=$id";
        $cat = DB::select(DB::raw($sql));
        $cat_name = "";
        $cat_id = 0;
        if (count($cat) > 0) {
            $cat_name = $cat[0]->category_name;
            $cat_id = $cat[0]->id;
        }
        return view("admin/category/subcategory", compact('subcat', 'cat_name', 'cat_id'));
    }

    public function manageThirdcategory($id)
    {
        $sql = "select * from category where parent_id=$id order by id";
        $thirdcat = DB::select(DB::raw($sql));
        $sql = "select * from category where id=$id";
        $subcat = DB::select(DB::raw($sql));
        $sub_name = "";
        $sub_id = 0;
        if (count($subcat) > 0) {
            $sub_name = $subcat[0]->category_name;
            $sub_id = $subcat[0]->id;
        }
        return view("admin/category/thirdcategory", compact('thirdcat', 'sub_name', 'sub_id'));
    }

    public function AddThirdCategory(Request $request)
    {

         DB::table('category')->insert([
            'parent_id'        => $request->category_id,
            'category_name'    => $request->thirdcategory_name,
            'created_at'       => date('Y-m-d H:i:s'),
            'status'           => 1,
        ]);

        $last_insert_id = DB::getPdo()->lastInsertId();

        $thirdimg = "";
        if ( $request->photo != null ) {
            $thirdimg = $last_insert_id . '.' . $request->file( 'photo' )->extension();
            $filepath = public_path( 'uploads' . DIRECTORY_SEPARATOR . 'category' . DIRECTORY_SEPARATOR );
            move_uploaded_file( $_FILES[ 'photo' ][ 'tmp_name' ], $filepath . $thirdimg );
        }
       
        $addimg = DB::table( 'category' )->where( 'id', $last_insert_id )->update( [
            'photo' => $thirdimg,
        ] ); 
        return redirect("admin/thirdlevelcategory/" . $request->category_id)->with('success', 'Third Level Category Added Successfully');
    }

    public function EditThirdCategory(Request $request)
    {

         DB::table('category')->where('id', $request->category_id)->update([
            'category_name' => $request->thirdcategory_name,
            'updated_at'       => date('Y-m-d H:i:s'),
            'status'           => $request->status,
        ]);

        if ( $request->photo != null ) {
            $thirdimg = $request->category_id . '.' . $request->file( 'photo' )->extension();
            $filepath = public_path( 'uploads' . DIRECTORY_SEPARATOR . 'category' . DIRECTORY_SEPARATOR );
            move_uploaded_file( $_FILES[ 'photo' ][ 'tmp_name' ], $filepath . $thirdimg );

             DB::table( 'category' )->where( 'id', $request->category_id )->update( [
                'photo' => $thirdimg,
            ] );
        }

        return redirect("admin/thirdlevelcategory/". $request->parent_id)->with('success', 'Third Level Category Updated Successfully');
    }

    public function DeleteThirdCategory($id)
    {
       
        $cat = DB::table('category')->where('id', $id)->get();
        $parent_id = 0;
        if (count($cat) > 0) {
            $parent_id = $cat[0]->parent_id;
        }
        $filepath = public_path( 'uploads'.DIRECTORY_SEPARATOR.'category'.DIRECTORY_SEPARATOR );
        $photo = $cat[ 0 ]->photo;
        if ( !empty( $photo ) ) {
            unlink( $filepath.$photo );
        }
        $deletethirdcat = DB::table('category')->where('id', $id)->delete();

        return redirect("admin/thirdlevelcategory/". $parent_id)->with('success', 'Third Level Category Deleted Successfully');
    }

}