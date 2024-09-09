@extends('layouts.admin_app')

@section('content')
<div class="container-fluid">
<div class="row">
<div class="col-md-12">
<div class="content-header">
</div>
<div class="card card-primary">
<div class="card-header">
<h3 class="card-title">Products</h3>
<button type="button" class="btn btn-sm btn-secondary float-right" data-toggle="modal" data-target="#addproduct"><i class="fa fa-plus"></i>Add Product</button>
</div>
<div class="card-body">
@if (session()->has('success'))
<div class="alert alert-success alert-dismissable" style="margin: 15px;">
<a href="#" style="color:white !important" class="close" data-dismiss="alert"
aria-label="close">&times;</a>
<strong> {{ session('success') }} </strong>
</div>
@endif
<table id="example2" class="table table-bordered">
<thead>
<tr>
<th>ID</th>
<th>Product Name</th>
<th>Min Quantity</th>
<th>Quantity</th>
<th>Price</th>
<th>Status</th>
<th>Action</th>
</tr>
</thead>
<tbody>
@foreach($products as $product)
<tr>
<td>{{ $product->id }}</td>
<td>{{ $product->product_name }}</td>
<td>{{ $product->min_quantity }}</td>
<td>{{ $product->quantity }}</td>
<td>{{ $product->price }}</td>
<td>{{ $product->status }}</td>
<td>
<a href="{{ url('/admin/products/edit') }}/{{ $product->id }}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i>Edit</a>
<a href="{{ url('/admin/photos') }}/{{ $product->id }}" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i>Photos</a>
@if($product->quantity < $product->min_quantity)
<a onclick='stockupdate("{{ $product->id }}","{{ $product->product_name }}","{{ $product->min_quantity }}","{{ $product->quantity }}")'
    href="#" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i>Stock Update</a>
    @endif
</td>
</tr>
@endforeach
</tbody>
</table>
        <div class="modal fade" id="stock" tabindex="-1" aria-hidden="true">
            <form action="{{ url('/updatestock') }}" method="post">
                {{ csrf_field() }}
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalScrollable">Stock Update</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="product_id" id="product_id">
                            <div class="row">
                                <div class="col-md-12">
                                 <div class="form-group">
                                   <label for="name">Product Name<span
                                    style="color:red"></span></label>
                                    <input type="text" class="form-control" id="stockproduct" disabled maxlength="50" required>
                                </div> 

                                <div class="form-group">
                                   <label for="email">Min Quantity<span
                                    style="color:red"></span></label>
                                    <input type="text" class="form-control" id="stockmin" disabled maxlength="50" required>
                                </div>

                                <div class="form-group">
                                   <label for="phone">Available Quantity<span
                                    style="color:red"></span></label>
                                    <input type="text" class="form-control number" id="stockquantity" disabled maxlength="10" required>
                                </div> 

                                <div class="form-group">
                                    <label for="editpassword"><span
                                        style="color:red">*</span>Quantity</label>
                                        <input required="required" type="text"
                                        class="form-control number" name="quantity"
                                        maxlength="10" placeholder="Quantity">
                                    </div>
                           </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default"
                            data-dismiss="modal">Close</button>
                            <input class="btn btn-primary" type="submit" value="Submit" />
                        </div>
                    </div>
                </div>
            </form>
        </div>
</div>
</div>
</div>

<div class="modal fade" id="addproduct" tabindex="-1" aria-hidden="true">
<form action="{{ url('/addproduct') }}" method="post" enctype="multipart/form-data">
{{ csrf_field() }}
<div class="modal-dialog modal-md">
<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollable">Add Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group row">
                    <label for="product_name" class="col-sm-4 col-form-label"><span
                        style="color:red">*</span>Category</label>
                        <div class="col-sm-8">
                            <select name="cat_id" id="cat_id" required="required" class="form-control">
                                <option value="">Select Category</option>
                                @foreach($category as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->category_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
            <label for="product_name" class="col-sm-4 col-form-label"><span
                        style="color:red">*</span>Sub Category</label>
                         <div class="col-sm-8">
            <select name="sub_cat_id" id="sub_cat_id" required="required" class="form-control">
                <option value="">Select Subcategory</option>
            </select>
        </div>
        </div>

        <div class="form-group row">
            <label for="third_cat_id" class="col-sm-4 col-form-label"><span
                        style="color:red">*</span>Third Category</label>
                         <div class="col-sm-8">
            <select name="third_cat_id" id="third_cat_id" required="required" class="form-control">
                <option value="">Select Thirdcategory</option>
            </select>
        </div>
        </div>
                    <div class="form-group row">
                        <label for="product_name" class="col-sm-4 col-form-label"><span
                            style="color:red">*</span>Product Name</label>
                            <div class="col-sm-8">
                                <input required="required" type="text" class="form-control"
                                name="product_name" maxlength="50"
                                placeholder="Product Name">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-sm-4 col-form-label"><span
                                style="color:red">*</span>Description</label>
                                <div class="col-sm-8">
                                    <textarea rows="2" required="required" class="form-control"
                                    name="description"  maxlength="500"
                                    placeholder="Description" ></textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="min_quantity" class="col-sm-4 col-form-label"><span
                                    style="color:red">*</span>Min Quantity</label>
                                    <div class="col-sm-8">
                                        <input required="required" type="text" class="form-control number"
                                        name="min_quantity" id="min_quantity" maxlength="10"
                                        placeholder="Min Quantity">
                                    </div>
                                </div>
            
                                <div class="form-group row">
                                    <label for="quantity" class="col-sm-4 col-form-label"><span
                                        style="color:red">*</span>Quantity</label>
                                        <div class="col-sm-8">
                                            <input required="required" type="text" class="form-control number"
                                            name="quantity" id="quantity" maxlength="10"
                                            placeholder="Quantity">
                                        </div>
                                    </div>

                            <div class="form-group row">
                                <label for="description" class="col-sm-4 col-form-label"><span
                                    style="color:red">*</span>Price</label>
                                    <div class="col-sm-8">
                                        <input required="required" type="text" class="form-control number"
                                        name="price" maxlength="8"
                                        placeholder="Price">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="description" class="col-sm-4 col-form-label"><span
                                        style="color:red">*</span>Photo</label>
                                        <div class="col-sm-8">
                                            <input multiple="multiple" required="required" type="file" class="form-control number"
                                            name="photo[]" >
                                        </div>
                                    </div>

                                </div>
        </div>
                                <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-default"
                                    data-dismiss="modal">Close</button>
                                    <input class="btn btn-primary" type="submit" value="Submit" />
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            
        </div>
@endsection
@push('page_scripts')
<script>
    function stockupdate(id, product_name, minquantity, quantity ) {
        $("#stockproduct").val(product_name);
        $("#stockmin").val(minquantity);
        $("#stockquantity").val(quantity);
        $("#product_id").val(id);
        $("#stock").modal("show");
    }
</script>

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