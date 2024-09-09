@extends('layouts.admin_app')
@section('content')
<div class="container-fluid">
<div class="row">
<div class="col-md-12">
<div class="content-header">
</div>
<div class="card card-primary">
<div class="card-header">
<h3 class="card-title">Orders</h3>
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
<th>Seller ID</th>
<th>Product ID</th>
<th>Product Name</th>
<th>Price</th>
<th>Qty</th>
<th>Amount</th>
</tr>
</thead>
<tbody>
@foreach($orders as $order)
<tr>
<td>{{ $order->shop_id }}</td>
<td>{{ $order->product_id }}</td>
<td>{{ $order->product_name }}</td>
<td>{{ $order->price }}</td>
<td>{{ $order->quantity }}</td>
<td>{{ $order->subtotal }}</td>
</tr>
@endforeach
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
@endsection
@push('page_scripts')
<script>
    function edit_products(id, product_name, description, status,price ) {
        $("#editproductsname").val(product_name);
        $("#editdescription").val(description);
        $("#editstatus").val(status);
        $("#editprice").val(price);
        $("#product_id").val(id);
        $("#editproducts").modal("show");
    }
</script>
@endpush