@extends('layouts.admin_app')

@section('content')
<div class="container-fluid">
<div class="row">
<div class="col-md-12">
<div class="content-header">
</div>
<div class="card card-primary">
<div class="card-header">
<h3 class="card-title">Edit Products</h3>
</div>
<div class="card-body">
@if (session()->has('success'))
<div class="alert alert-success alert-dismissable" style="margin: 15px;">
<a href="#" style="color:white !important" class="close" data-dismiss="alert"
aria-label="close">&times;</a>
<strong> {{ session('success') }} </strong>
</div>
@endif
<form action="{{ url('/editproducts') }}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
<div class="row">
<div class="col-md-12">
    <input type="hidden" name="product_id" value="{{ $products->id }}">
    <div class="form-group row">
        <label for="product_name" class="col-sm-4 col-form-label"><span
            style="color:red">*</span>Category</label>
            <div class="col-sm-8">
                <select name="cat_id" id="cat_id" required="required" class="form-control select2">
                    <option value="">Select Category</option>
                    @foreach($category as $cat)
                    <option value="{{ $cat->id }}" @if($products->cat_id == $cat->id) selected @endif>{{ $cat->category_name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
 
        <div class="form-group row">
            <label for="product_name" class="col-sm-4 col-form-label"><span
            style="color:red">*</span>Sub Category</label>
            <div class="col-sm-8">
            <select name="sub_cat_id" id="sub_cat_id" required="required" class="form-control select2">
                <option value="">Select Subcategory</option>
                @foreach($sub_category as $cat)
                    <option value="{{ $cat->id }}" @if($products->parent_id == $cat->id) selected @endif>{{ $cat->category_name }}</option>
                    @endforeach
            </select>
        </div>
        </div>
        <div class="form-group row">
            <label for="third_cat_id" class="col-sm-4 col-form-label"><span
                        style="color:red">*</span>Third Category</label>
                         <div class="col-sm-8">
            <select name="third_cat_id" id="third_cat_id" required="required" class="form-control select2">
                <option value="">Select Subcategory</option>
                @foreach($third_category as $cat)
                <option value="{{ $cat->id }}" @if($products->category_id == $cat->id) selected @endif>{{ $cat->category_name }}</option>
                @endforeach
            </select>
        </div>
        </div>
        <div class="form-group row">
            <label for="product_name" class="col-sm-4 col-form-label"><span
                style="color:red">*</span>Product Name</label>
                <div class="col-sm-8">
                    <input required="required" type="text" class="form-control"
                    name="product_name" value="{{ $products->product_name }}" id="editproductsname" maxlength="50"
                    placeholder="Product Name">
                </div>
            </div>

            <div class="form-group row">
                <label for="description" class="col-sm-4 col-form-label"><span
                    style="color:red">*</span>Description</label>
                    <div class="col-sm-8">
                        <textarea rows="2" required="required" class="form-control"
                        name="description" id="editdescription" maxlength="500"
                        placeholder="Description" >{{ $products->description }}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="min_quantity" class="col-sm-4 col-form-label"><span
                        style="color:red">*</span>Min Quantity</label>
                        <div class="col-sm-8">
                            <input required="required" type="text" class="form-control number"
                            name="min_quantity" value="{{ $products->min_quantity }}" id="min_quantity" maxlength="10"
                            placeholder="Min Quantity">
                        </div>
                    </div>


                <div class="form-group row">
                    <label for="description" class="col-sm-4 col-form-label"><span
                        style="color:red">*</span>Price</label>
                        <div class="col-sm-8">
                            <input required="required" type="text" class="form-control number"
                            name="price" value="{{ $products->price }}" id="editprice" maxlength="8"
                            placeholder="Price">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="description" class="col-sm-4 col-form-label">Photo</label>
                        <div class="col-sm-8">
                            <input multiple="multiple" type="file" class="form-control number"
                            name="photo[]" >
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="status" class="col-sm-4 col-form-label"><span
                            style="color:red">*</span>Status</label>
                            <div class="col-sm-8">
                                <select name="status" class="form-control" id="editstatus">
                                    <option>Select</option>
                                    <option @if($products->status == "Active") selected @endif value="Active">Active</option>
                                    <option @if($products->status == "Inactive") selected @endif value="Inactive">Inactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12 text-center">
                                <input id="save" class="btn btn-info" type="submit" name="submit"
                                    value="Submit" />
                                <a href="{{ url('/admin/products') }}" class="btn btn-info">Back</a>
                            </div>
                        </div>
                    </div>
                 
    </form>
</div>
                </div>
</div>
</div>
</div>

            </div>

            
        </div>
@endsection
@push('page_scripts')
<script>
     $('#cat_id').on('change',function(){
        var cat_id = this.value;
        $("#sub_cat_id").html('');
        $.ajax({
            url: "{{url('/getsubcategory')}}",
            type: "POST",
            data: {
            cat_id: cat_id,
            _token: '{{csrf_token()}}'
            },
            dataType: 'json',
            success: function (result) {
            $('#sub_cat_id').html('<option value="">Select Sub Category</option>');
            $.each(result, function (key, value) {
            $("#sub_cat_id").append('<option value="' + value
            .id + '">' + value.category_name + '</option>');
            });
            }   
        });
    });

    $('#sub_cat_id').on('change',function(){
        var cat_id = this.value;
        $("#third_cat_id").html('');
        $.ajax({
            url: "{{url('/getsubcategory')}}",
            type: "POST",
            data: {
            cat_id: cat_id,
            _token: '{{csrf_token()}}'
            },
            dataType: 'json',
            success: function (result) {
            $('#third_cat_id').html('<option value="">Select Sub Category</option>');
            $.each(result, function (key, value) {
            $("#third_cat_id").append('<option value="' + value
            .id + '">' + value.category_name + '</option>');
            });
            }   
        });
    });

</script>
@endpush