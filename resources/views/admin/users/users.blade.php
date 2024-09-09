@extends('layouts.admin_app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="content-header">
            </div>
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">User Details</h3>
                </div>
                <div class="card-body">
                    @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissable" style="margin: 15px;">
                        <a href="#" style="color:white !important" class="close" data-dismiss="alert"
                        aria-label="close">&times;</a>
                        <strong> {{ session('success') }} </strong>
                    </div>
                    @endif
                    <div class="table-responsive">
                        <table id="example2" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Mobile No</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->phone }}</td>
                                    @if($user->status == 1)
                                    <td>Active</td>
                                    @else
                                    <td>Inactive</td>
                                    @endif
                                    <td width="10%" style="white-space: nowrap">
                                        <a onclick="edit_user('{{ $user->id }}','{{ $user->name }}','{{ $user->email }}','{{ $user->phone }}','{{ $user->status }}')"
                                            href="#" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i>
                                        Edit</a>
                                        <a onclick="return confirm('Do you want to Confirm delete operation?')"
                                        href="{{ url('/deleteuser', $user->id) }}"
                                        class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="modal fade" id="adduser">
                        <form action="{{ url('/addusers') }}" method="post">
                            {{ csrf_field() }}
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Add User</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group row">
                                                    <label for="name" class="col-sm-4 col-form-label"><span
                                                        style="color:red">*</span>Full Name</label>
                                                        <div class="col-sm-8">
                                                            <input required="required" type="text" class="form-control"
                                                            name="name"  maxlength="50"
                                                            placeholder="Full Name">
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="email" class="col-sm-4 col-form-label"><span
                                                            style="color:red">*</span>Email</label>
                                                            <div class="col-sm-8">
                                                                <input required="required" type="email" class="form-control"
                                                                name="email"  maxlength="30"
                                                                placeholder="Email">
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label for="password" class="col-sm-4 col-form-label"><span style="color:red">*</span>Password</label>
                                                            <div class="col-sm-8">
                                                                <input required="required" type="password" class="form-control" name="password"  maxlength="20" placeholder="Password">
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label for="phone" class="col-sm-4 col-form-label"><span style="color:red">*</span>Mobile No</label>
                                                            <div class="col-sm-8">
                                                                <input required="required" type="text" class="form-control" name="phone"  maxlength="20" placeholder="Mobile Number">
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

                            <div class="modal fade" id="editusers" tabindex="-1" aria-hidden="true">
                                <form action="{{ url('/editusers') }}" method="post">
                                    {{ csrf_field() }}
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalScrollable">Edit User</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                               <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group row">
                                                        <input type="hidden" name="user_id" id="user_id">
                                                        <label for="name" class="col-sm-4 col-form-label"><span
                                                            style="color:red">*</span>Full Name</label>
                                                            <div class="col-sm-8">
                                                                <input required="required" type="text" class="form-control" name="name"  maxlength="50"
                                                                placeholder="Full Name" id="username">
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label for="email" class="col-sm-4 col-form-label"><span
                                                                style="color:red">*</span>Email</label>
                                                                <div class="col-sm-8">
                                                                    <input required="required" type="email" class="form-control"
                                                                    name="email"  maxlength="30"
                                                                    placeholder="Email" id="useremail">
                                                                </div>
                                                            </div>


                                                            <div class="form-group row">
                                                                <label for="phone" class="col-sm-4 col-form-label"><span style="color:red">*</span>Mobile No</label>
                                                                <div class="col-sm-8">
                                                                    <input required="required" type="text" class="form-control" name="phone"  maxlength="20" placeholder="Mobile Number" id="usermobile">
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <label for="email" class="col-sm-4 col-form-label"><span
                                                                    style="color:red">*</span>Status</label>
                                                                    <div class="col-sm-8">
                                                                        <select id="status" name="status" class="form-control">
                                                                            <option  value="1">Active</option>
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
                        function edit_user(id, name, email, phone, status ) {
                            $("#username").val(name);
                            $("#useremail").val(email);
                            $("#usermobile").val(phone);
                            $("#status").val(status);
                            $('#user_id').val(id);
                            $("#editusers").modal("show");
                        }
                    </script>
                    @endpush
