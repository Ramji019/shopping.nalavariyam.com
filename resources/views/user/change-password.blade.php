@extends('layouts.other_app')
@section('content')
<section class="bg-light">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="filter_search_opt">
                    <a href="javascript:void(0);" onclick="openFilterSearch()">Dashboard Navigation<i
                        class="ml-2 ti-menu"></i></a>
                    </div>
                </div>
            </div>

            <div class="row">
              @if(session()->has('success'))
              <div class="alert alert-success alert-dismissable" style="margin: 15px;">
                <a href="#" style="color:white !important" class="close" data-dismiss="alert"
                aria-label="close">&times;</a>
                <strong> {{ session('success') }} </strong>
            </div>
            @endif
            @if(session()->has('error'))
            <div class="alert alert-danger alert-dismissable" style="margin: 15px;">
                <a href="#" style="color:white !important" class="close" data-dismiss="alert"
                aria-label="close">&times;</a>
                <strong> {{ session('error') }} </strong>
            </div>
            @endif

            @include('user.user-menu')

            <div class="col-lg-9 col-md-12">
                <div class="dashboard-wraper">

                    <!-- Basic Information -->
                    <div class="form-submit">
                        <h4>Change Your Password</h4>
                        <form action="{{ url('/update_password') }}" method="post">
                          {{ csrf_field() }}
                          <div class="submit-section">
                            <div class="row">
                                <div class="form-group col-lg-12 col-md-6">
                                    <label>Old Password</label>
                                    <input maxlength="30" type="password" name="old_password" required="required"
                                    class="form-control">
                                </div>

                                <div class="form-group col-md-6">
                                    <label>New Password</label>
                                    <input maxlength="30" type="password" name="new_password" required="required"
                                    class="form-control">
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Confirm password</label>
                                    <input maxlength="30" type="text" name="confirm_password" required="required"
                                    class="form-control">
                                </div>

                                <div class="form-group col-lg-12 col-md-12">
                                    <input class="btn btn-theme-light-2 rounded" type="submit"
                                    value="Update Password">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>
</section>
<!-- ============================ User Dashboard End ================================== -->
<!-- ============================ Call To Action ================================== -->
<section class="theme-bg call-to-act-wrap">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">

                <div class="call-to-act">
                    <div class="call-to-act-head">
                        <h3>Want to Become a Real Estate Agent?</h3>
                        <span>We'll help you to grow your career and growth.</span>
                    </div>
                    <a href="#" class="btn btn-call-to-act">SignUp Today</a>
                </div>

            </div>
        </div>
    </div>
</section>
@endsection
