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
<th>Order #</th>
<th>Order Date</th>
<th>Amount</th>
<th>Name</th>
<th>Phone</th>
<th>Action</th>
</tr>
</thead>
<tbody>
@foreach($orders as $order)
<tr>
<td>{{ $order->order_no }}</td>
<td>{{ date("d-m-Y",strtotime($order->order_date)) }}</td>
<td>{{ $order->net_total }}</td>
<td>{{ $order->name }}</td>
<td>{{ $order->phone }}</td>
<td>
<a onclick='viewaddress("{{ $order->receivername }}","{{ $order->receiverphone }}","{{ $order->receiveraddress }}")' href="#" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i>View Address</a>
<a href="{{ url('/admin/details') }}/{{ $order->id }}" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i>Order Details</a>
<a onclick='order_status("{{ $order->id }}")' href="#" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i>Order Status</a></td>
</tr>
@endforeach
</tbody>
</table>
</div>
</div>
</div>
</div>
<div class="modal fade" id="updateorder" tabindex="-1" aria-hidden="true">
            <form action="{{ route('updateorder') }}" method="post">
                {{ csrf_field() }}
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalScrollable">Update Order Status</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="hidden" id="order_id" name="order_id">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-12 text-center">
                                 <select class="form-control" name="status" id="status"  style="width: 100%;" required="required">
                                    <option value="Completed">Completed</option>    
                                </select>
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

<div class="modal fade" id="viewaddress" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalScrollable">Customer Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="" class="col-sm-4 col-form-label"><span style="color:red"></span> Name </label>
                        <label for="" class="col-sm-8 col-form-label"><span style="color:red"
                                id="receivername"></span> </label>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-4 col-form-label"><span style="color:red"></span> Mobile
                        </label>
                        <label for="" class="col-sm-8 col-form-label"><span style="color:red"
                                id="receiverphone"></span> </label>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-4 col-form-label"><span style="color:red"></span> Address
                        </label>
                        <label for="" class="col-sm-8 col-form-label"><span style="color:red"
                                id="address"></span> </label>
                    </div>
                </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default"
                data-dismiss="modal">Close</button>
            </div>
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

    function order_status(order_id){
        $("#order_id").val(order_id);
        $("#updateorder").modal("show");
    }

    function viewaddress(name,phone,address){
        $("#receivername").html(name);
        $("#receiverphone").html(phone);
        $("#address").html(address);
        $("#viewaddress").modal("show");  
    }
</script>
@endpush