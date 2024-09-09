@extends('layouts.other_app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-body">
                    <h4>Seller Registeration</h4>
                    <div class="login-form">
                        <form action="{{ url('/sellerregister') }}" method="post">
                            {{ csrf_field() }}
                            <input name="plan_id" type="hidden" value="1">
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <label id="reqname" style="color:red"></label>
                                    <div class="form-group">
                                        <div class="input-with-icon">
                                            <input type="text" name="name" id="sellername" required="required"
                                                maxlength="50" class="form-control" placeholder="Full Name">
                                            <i class="ti-user"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <label id="reqemail" style="color:red"></label>
                                    <div class="form-group">
                                        <div class="input-with-icon">
                                            <input value="" name="selleremail" id="selleremail" required="required"
                                                maxlength="50" type="email" class="form-control" placeholder="Email">
                                            <i class="ti-email"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <label id="reqpassword" style="color:red"></label>
                                    <div class="form-group">
                                        <div class="input-with-icon">
                                            <input type="password" id="sellerpassword" maxlength="20" name="sellerpassword"
                                                required="required" class="form-control" placeholder="Password">
                                            <i class="ti-unlock"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <label id="reqphone" style="color:red"></label>
                                    <div class="form-group">
                                        <div class="input-with-icon">
                                            <input type="text" name="sellerphone" id="sellerphone" maxlength="15"
                                                required="required" class="form-control number" placeholder="Mobile No">
                                            <i class="lni-phone-handset"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                <div class="col-lg-12 col-md-12">
                                    <label id="reqphone" style="color:red"></label>
                                    <div class="form-group">
                                        <div class="input-with-icon">
                                            <textarea name="address" id="address" maxlength="200" required="required" class="form-control number" placeholder="Address"></textarea>
                                        </div>
                                    </div>
                                </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 text-center">
                                        <label id="reqotp" style="color:red"></label>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4"></div>
                            </div>
                            <div class="form-group">
                                <input name="submit" id="submit" type="submit"
                                    class="btn btn-md full-width btn-theme-light-2 rounded" value="Sign UP">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
