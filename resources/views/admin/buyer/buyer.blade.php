@extends('layouts.admin_app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="content-header">
                </div>
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Buyers</h3>
                        <button type="button" class="btn btn-sm btn-secondary float-right" data-toggle="modal"
                            data-target="#addbuyer"><i class="fa fa-plus"> </i> Add Buyer</button>
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
                                    <th>Address</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                 @foreach($buyer as $buy)
                    <tr> 
                    <td>{{ $buy->id }}</td>
                    <td>{{ $buy->name }}</td>
                    <td>{{ $buy->email }}</td>
                    <td>{{ $buy->phone }}</td>
                    <td>{{ $buy->address }}</td>
                    @if ($buy->status == 1)
                         <td>Active</td>
                    @else
                         <td>Inactive</td>
                    @endif
                    </td>
                    <td>
             <a onclick="edit_buyer('{{ $buy->id }}','{{ $buy->name }}','{{ $buy->email }}','{{ $buy->dob }}','{{ $buy->phone }}','{{ $buy->gender }}','{{ $buy->address }}','{{ $buy->remember_token }}','{{ $buy->status }}')"
          href="#" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i>Edit</a>
                 </tr>
                 @endforeach
                            </tbody>
                        </table>

                        <div class="modal fade" id="addbuyer">
                            <form action="{{ url('/addbuyer') }}" method="post">
                                {{ csrf_field() }}
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Add Buyer</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group row">
                                                        <label for="plan_name" class="col-sm-4 col-form-label"><span
                                                                style="color:red">*</span>Name</label>
                                                        <div class="col-sm-8">
                                                            <input required="required" type="text" class="form-control"
                                                                name="plan_name" id="plan_name" maxlength="50"
                                                                placeholder="Plan Name">
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="description" class="col-sm-4 col-form-label"><span
                                                                style="color:red">*</span>Description</label>
                                                                <div class="col-sm-8">
                                                            <input required="required" type="text" class="form-control"
                                                                name="description" id="description" maxlength="500"
                                                                placeholder="Description">
                                                              </div>
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

                        <div class="modal fade" id="editbuyer" tabindex="-1" aria-hidden="true">
                            <form action="{{ url('/editbuyer') }}" method="post">
                                {{ csrf_field() }}
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalScrollable">Edit Buyer</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <input type="Hidden" name="user_id" id="user_id">
                                                    <div class="form-group row">
                                                        <label for="name" class="col-sm-4 col-form-label"><span
                                                                style="color:red">*</span>Name</label>
                                                        <div class="col-sm-8">
                                                            <input required="required" type="text"
                                                                class="form-control" name="name" id="editname"
                                                                maxlength="50" placeholder="Name">
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="email" class="col-sm-4 col-form-label"><span
                                                                style="color:red">*</span>Email</label>
                                                        <div class="col-sm-8">
                                                           <input required="required" type="text" class="form-control" name="email" id="editemail" maxlength="500" placeholder="Email">
                                                        </div>
                                                    </div>

                                                    <!--<div class="form-group row">
                                                        <label for="email_verified_at" class="col-sm-4 col-form-label"><span
                                                                style="color:red">*</span>Email Verified</label>
                                                        <div class="col-sm-8">
                                                           <input required="required" type="text" class="form-control" name="email_verified_at" id="editemailverified" maxlength="500" placeholder="Email">
                                                        </div>
                                                    </div>-->

                                                    <div class="form-group row">
                                                        <label for="dob" class="col-sm-4 col-form-label"><span
                                                                style="color:red">*</span>Dob</label>
                                                        <div class="col-sm-8">
                                                           <input required="required" type="text" class="form-control" name="dob" id="editdob" maxlength="500" placeholder="Dob">
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="phone" class="col-sm-4 col-form-label"><span
                                                                style="color:red">*</span>Phone</label>
                                                        <div class="col-sm-8">
                                                           <input required="required" type="text" class="form-control" name="phone" id="editphone" maxlength="500" placeholder="Phone">
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="gender" class="col-sm-4 col-form-label"><span
                                                                style="color:red">*</span>Gender</label>
                                                        <div class="col-sm-8">
                                                           <input required="required" type="text" class="form-control" name="gender" id="editgender" maxlength="500" placeholder="Gender">
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="address" class="col-sm-4 col-form-label"><span
                                                                style="color:red">*</span>Address</label>
                                                        <div class="col-sm-8">
                                                           <input required="required" type="text" class="form-control" name="address" id="editaddress" maxlength="500" placeholder="Address">
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="remember_token" class="col-sm-4 col-form-label"><span
                                                                style="color:red">*</span>Remember Token</label>
                                                        <div class="col-sm-8">
                                                           <input required="required" type="text" class="form-control" name="remember_token" id="editremember" maxlength="500" placeholder="Remember Token">
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="name" class="col-sm-4 col-form-label"><span
                                                                style="color:red">*</span>Status</label>
                                                        <div class="col-sm-8">
                                                            <select name="status" class="form-control" id="editstatus">
                                                                <option value="1">Active</option>
                                                                <option value="0">Inactive</option>
                                                            </select>
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
            </div>
        </div>
    </div>
@endsection
@push('page_scripts')
<script>
        function edit_buyer(id, name, email, dob, phone, gender, address , remember_token, status,) {
            $("#editname").val(name);
            $("#editemail").val(email);
          //  $("#editemailverified").val(email_verified_at);
            $("#editdob").val(dob);
            $("#editphone").val(phone);
            $("#editgender").val(gender);
            $("#editaddress").val(address);
            $("#editremember").val(remember_token);
            $("#editstatus").val(status);
            $("#user_id").val(id);
            $("#editbuyer").modal("show");
        }
    </script>
@endpush
