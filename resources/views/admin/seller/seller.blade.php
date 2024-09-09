@extends('layouts.admin_app')
@section('content')
<div class="container-fluid">
<div class="row">
<div class="col-md-12">
    <div class="content-header">
    </div>
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Sellers</h3>
            <button type="button" class="btn btn-sm btn-secondary float-right" data-toggle="modal" data-target="#addseller"><i class="fa fa-plus"></i>Add Seller</button>
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
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($seller as $sell)
                    <tr>
                        <td>{{ $sell->id }}</td>
                        <td>{{ $sell->name }}</td>
                        <td>{{ $sell->email }}</td>
                        <td>{{ $sell->phone }}</td>
                        @if ($sell->status == 1)
                        <td>Active</td>
                        @else
                        <td>Inactive</td>
                        @endif
                    </td>
                        <td>
                        <a onclick="edit_seller('{{ $sell->id }}','{{ $sell->name }}','{{ $sell->email }}','{{ $sell->phone }}','{{ $sell->status }}','{{ $sell->plainpassword }}','{{ $sell->dist_id }}','{{ $sell->taluk_id }}','{{ $sell->vao_area }}','{{ $sell->owner_name }}','{{ $sell->gst_number }}','{{ $sell->pan_number }}','{{ $sell->landline_phone }}')" 
                            href="#" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i> Edit</a>
                            <a onclick="view_seller('{{ $sell->id }}','{{ $sell->name }}','{{ $sell->email }}','{{ $sell->phone }}','{{ $sell->plainpassword }}')" 
                                href="#" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i> View</a>
                            <a onclick="show_purchase_modal()" href="{{ url('sellerproduct', $sell->id) }}"
                                class="fas fa-arrow-circle-right">Product</a>
                            </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="modal fade" id="addseller" tabindex="-1" aria-hidden="true">
                        <form action="{{ url('/addseller') }}" method="post">
                            {{ csrf_field() }}
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalScrollable">Add Seller</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                             <div class="form-group">
                                               <label for="name">Name<span
                                                style="color:red">*</span></label>
                                                <input type="text" class="form-control" name="name" id="name" maxlength="50" required>
                                            </div> 

                                            <div class="form-group">
                                               <label for="email">Email<span
                                                style="color:red">*</span></label>
                                                <input type="email" class="form-control" name="email" id="email" maxlength="50" required>
                                            </div>

                                            <div class="form-group">
                                               <label for="phone">Phone<span
                                                style="color:red">*</span></label>
                                                <input type="text" class="form-control number" name="phone" id="phone" maxlength="10" required>
                                            </div> 
                                            <div class="form-group">
                                                <label>District Name</label>
                                                <select class="form-control select2" name="dist_id" id="dist_id" style="width: 100%;">
                                                    <option value="">Select District Name</option>
                                                    @foreach($district as $dist)
                                                    <option value="{{ $dist->id }}">{{ $dist->district_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label>Taluk Name</label>
                                                <select class="form-control select2" name="taluk_id" id="taluk_id"
                                                style="width: 100%;">
                                                <option value="">Select Taluk Name</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                           <label for="vao_area">VAO Area</label>
                                           <input type="text" class="form-control" name="vao_area" id="vao_area" maxlength="50" required>
                                       </div> 
                                   </div>
                                   <div class="col-md-6">
                                       <div class="form-group">
                                           <label for="owner_name">Owner Name<span
                                            style="color:red">*</span></label>
                                            <input type="text" class="form-control" name="owner_name" id="owner_name" maxlength="50" required>
                                        </div> 

                                        <div class="form-group">
                                           <label for="gst_nmber">GST Number<span
                                            style="color:red">*</span></label>
                                            <input type="text" class="form-control" name="gst_number" id="gst_number" maxlength="15" required>
                                        </div>

                                        <div class="form-group">
                                           <label for="pan_number">PAN Number<span
                                            style="color:red">*</span></label>
                                            <input type="text" class="form-control" name="pan_number" id="pan_number" maxlength="15" required>
                                        </div>
                                        <div class="form-group">
                                           <label for="landline_phone">Landline Phone<span
                                            style="color:red">*</span></label>
                                            <input type="text" class="form-control number" name="landline_phone" id="landline_phone" maxlength="20" required>
                                        </div> 
                                        <div class="form-group">
                                            <label>Address</label>
                                            <textarea class="form-control" name="address"rows="3" placeholder="Address"></textarea>
                                        </div>


                                    </div>
                                </div>
                                <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-default"
                                    data-dismiss="modal">Close</button>
                                    <input class="btn btn-primary" type="submit" value="Submit" />
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="editseller" tabindex="-1" aria-hidden="true">
            <form action="{{ url('/editseller') }}" method="post">
                {{ csrf_field() }}
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalScrollable">Edit Seller</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="user_id" id="user_id">
                            <div class="row">
                                <div class="col-md-6">
                                 <div class="form-group">
                                   <label for="name">Name<span
                                    style="color:red">*</span></label>
                                    <input type="text" class="form-control" name="name" id="editname" maxlength="50" required>
                                </div> 

                                <div class="form-group">
                                   <label for="email">Email<span
                                    style="color:red">*</span></label>
                                    <input type="email" class="form-control" name="email" id="editemail" maxlength="50" required>
                                </div>

                                <div class="form-group">
                                   <label for="phone">Phone<span
                                    style="color:red">*</span></label>
                                    <input type="text" class="form-control number" name="phone" id="editphone" maxlength="10" required>
                                </div> 

                                <div class="form-group">
                                    <label for="editpassword"><span
                                        style="color:red">*</span>Password</label>
                                        <input required="required" type="text"
                                        class="form-control number" name="password" id="editpassword"
                                        maxlength="15" placeholder="Password">
                                    </div>

                                    <div class="form-group">
                                        <label>District Name</label>
                                        <select class="form-control select2" name="dist_id" id="editdist_id" style="width: 100%;">
                                            <option value="">Select District Name</option>
                                            @foreach($district as $dist)
                                            <option value="{{ $dist->id }}">{{ $dist->district_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Taluk Name</label>
                                        <select class="form-control select2" name="taluk_id" id="edittaluk_id"
                                        style="width: 100%;">
                                        <option value="">Select Taluk Name</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                   <label for="vao_area">VAO Area</label>
                                   <input type="text" class="form-control" name="vao_area" id="editvao_area" maxlength="50" required>
                               </div> 
                           </div>
                           <div class="col-md-6">
                               <div class="form-group">
                                   <label for="owner_name">Owner Name<span
                                    style="color:red">*</span></label>
                                    <input type="text" class="form-control" name="owner_name" id="editowner_name" maxlength="50" required>
                                </div> 

                                <div class="form-group">
                                   <label for="gst_nmber">GST Number<span
                                    style="color:red">*</span></label>
                                    <input type="text" class="form-control" name="gst_number" id="editgst_number" maxlength="15" required>
                                </div>
                                <div class="form-group">
                                   <label for="pan_number">PAN Number<span
                                    style="color:red">*</span></label>
                                    <input type="text" class="form-control" name="pan_number" id="editpan_number" maxlength="15" required>
                                </div>
                                <div class="form-group">
                                   <label for="landline_phone">Landline Phone<span
                                    style="color:red">*</span></label>
                                    <input type="text" class="form-control number" name="landline_phone" id="editlandline_phone" maxlength="20" required>
                                </div> 
                                <div class="form-group">
                                    <label for="editstatus">Status</label>
                                    <select name="status" class="form-control" id="editstatus">
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Address</label>
                                    <textarea class="form-control" id="editaddress" name="address"rows="3" placeholder="Address"></textarea>
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

<div class="modal fade" id="viewseller" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalScrollable">View Seller</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                   <div class="col-md-12">
                    <div class="form-group row">
                        <label for="" class="col-sm-4 col-form-label"><span style="color:red"></span> ID </label>
                        <label for="" class="col-sm-8 col-form-label"><span style="color:red"
                                id="sellid"></span> </label>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-4 col-form-label"><span style="color:red"></span> Name </label>
                        <label for="" class="col-sm-8 col-form-label"><span style="color:red"
                                id="sellname"></span> </label>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-4 col-form-label"><span style="color:red"></span> Email </label>
                        <label for="" class="col-sm-8 col-form-label"><span style="color:red"
                                id="sellemail"></span> </label>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-4 col-form-label"><span style="color:red"></span> Password </label>
                        <label for="" class="col-sm-8 col-form-label"><span style="color:red"
                                id="sellpassword"></span> </label>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-4 col-form-label"><span style="color:red"></span> Phone </label>
                        <label for="" class="col-sm-8 col-form-label"><span style="color:red"
                                id="sellphone"></span> </label>
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
</div>
@endsection
@push('page_scripts')
<script>
    function edit_seller(id, name, email, phone, status,password,dist_id,taluk_id,vao_area,owner_name,gst_number,pan_number,landline_phone) {
        $("#editname").val(name);
        $("#editemail").val(email);
        $("#editphone").val(phone);
        $("#editdist_id").val(dist_id);
        $("#edittaluk_id").val(taluk_id);
        $("#editvao_area").val(vao_area);
        $("#editowner_name").val(owner_name);
        $("#editgst_number").val(gst_number);
        $("#editpan_number").val(pan_number);
        $("#editlandline_phone").val(landline_phone);
        $("#editstatus").val(status);
        $("#editpassword").val(password);
        $("#user_id").val(id);
        $("#editseller").modal("show");
    }

    function view_seller(id, name, email, phone,password) {
        $("#sellname").text(name);
        $("#sellemail").text(email);
        $("#sellphone").text(phone);
        $("#sellpassword").text(password);
        $("#sellid").text(id);
        $("#viewseller").modal("show");
    }

    $('#dist_id').on('change',function(){
        var dist_id = this.value;
        $("#taluk_id").html('');
        $.ajax({
            url: "{{url('/gettaluk')}}",
            type: "POST",
            data: {
                dist_id: dist_id,
                _token: '{{csrf_token()}}'
            },
            dataType: 'json',
            success: function (result) {
                $('#taluk_id').html('<option value="">Select Taluk</option>');
                $.each(result, function (key, value) {
                    $("#taluk_id").append('<option value="' + value
                        .id + '">' + value.taluk_name + '</option>');
                });
            }   
        });
    });

    $('#editdist_id').on('change',function(){
        var dist_id = this.value;
        $("#edittaluk_id").html('');
        $.ajax({
            url: "{{url('/gettaluk')}}",
            type: "POST",
            data: {
                dist_id: dist_id,
                _token: '{{csrf_token()}}'
            },
            dataType: 'json',
            success: function (result) {
                $('#edittaluk_id').html('<option value="">Select Taluk</option>');
                $.each(result, function (key, value) {
                    $("#edittaluk_id").append('<option value="' + value
                        .id + '">' + value.taluk_name + '</option>');
                });
            }   
        });
    });
</script>
@endpush