<div class="header-area" id="headerArea">
    <div class="container">
        <!-- Header Content -->
        <div
            class="header-content header-style-five position-relative d-flex align-items-center justify-content-between">
            <!-- Logo Wrapper -->
            <div class="logo-wrapper">
                <a href="{{ url('/') }}">
                    <img src="{!! asset('mobile/img/images.jpg') !!}" alt="S NV">
                </a>
            </div>
            <input type="hidden" id="latitudetop" value="">
            <input type="hidden" id="longitudetop" value="">
            <a onclick="showselectmap()"><i class="bi bi-geo-alt-fill"></i></a>
            <a id="current_locationtop" data-bs-toggle="offcanvas" data-bs-target="#map"
                aria-controls="offcanvasBottom">Location
            </a>
            @if (Auth::user() && Auth::user()->usertype_id == 4)
            <div class="navbar--toggler" id="affanNavbarToggler" data-bs-toggle="offcanvas"
                data-bs-target="#affanOffcanvas" aria-controls="affanOffcanvas">
                <i class="bi bi-person"></i>
            </div>
            @else
            <a data-bs-toggle="offcanvas" data-bs-target="#login" aria-controls="offcanvasBottom">
                <i class="bi bi-box-arrow-in-left"></i>
            </a>
            @endif
        </div>
    </div>
</div>
<div class="offcanvas offcanvas-top" tabindex="-1" data-bs-backdrop="false" id="login"
    aria-labelledby="offcanvasBottomLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasBottomLabel">
            <span class="mtitle">Login</span>
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="card">
        <div class="container mt-2 mb-4">
            <div class="col-sm-8 ml-auto mr-auto">
                <ul class="nav nav-pills nav-fill mb-1" id="pills-tab" role="tablist">
                    <li class="nav-item"> <a class="nav-link active" id="pills-signin-tab" data-toggle="pill"
                            onclick="showlogin()" role="tab" aria-controls="pills-signin" aria-selected="true">Sign
                            In</a> </li>
                    <li class="nav-item"> <a class="nav-link" id="pills-signup-tab" data-toggle="pill"
                            onclick="showregister()" role="tab" aria-controls="pills-signup" aria-selected="false">Sign
                            Up</a> </li>
                </ul>

                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-signin" role="tabpanel"
                        aria-labelledby="pills-signin-tab">

                        <div class="col-sm-12 border-primary shadow rounded pt-2">
                            <div class="container">
                                <!-- <div class="text-center"><img src="https://placehold.it/80x80" class="rounded-circle border p-1"></div>-->
                                <form method="post" id="singninFrom">
                                    <div class="form-group">
                                        <label id="errormessage" class="text-center" style="color:red"></label>
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-bold">Email or Mobile No<span
                                                class="text-danger">*</span></label>
                                        <input type="email" name="logemail" id="logemail" class="form-control"
                                            placeholder="Email or Mobile No" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-bold">Password <span
                                                class="text-danger">*</span></label>
                                        <input type="password" name="logpassword" id="logpassword" class="form-control"
                                            placeholder="Password" required>
                                    </div>
                                    <div class="form-group text-center">
                                        <input id="loginsubmit" type="button" name="submit" value="Sign In"
                                            class="btn btn-block btn-primary">
                                    </div>
                                </form>
                                </BR>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="pills-signup" role="tabpanel" aria-labelledby="pills-signup-tab">
                        <div class="col-sm-12 border-primary shadow rounded pt-2">
                            <div class="container">
                                <form method="post" id="singnupFrom">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Name <span
                                                class="text-danger">*</span></label>&nbsp;<label id="reqname"
                                            style="color:red"></label>
                                        <input maxlength="30" type="text" name="name" id="sellername"
                                            class="form-control" placeholder="Name" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-bold">Email <span
                                                class="text-danger">*</span></label>&nbsp;<label id="reqemail"
                                            style="color:red"></label>
                                        <input maxlength="50" type="text" name="selleremail" id="selleremail"
                                            class="form-control" placeholder="Email" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-bold">Mobile No <span
                                                class="text-danger">*</span></label>&nbsp;<label id="reqphone"
                                            style="color:red"></label>
                                        <input maxlength="15" type="text" name="sellerphone" id="sellerphone"
                                            class="form-control number" placeholder="Mobile No" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-bold">Password <span
                                                class="text-danger">*</span></label>&nbsp;<label id="reqpassword"
                                            style="color:red"></label>
                                        <input maxlength="15" type="password" name="password" id="sellerpassword"
                                            class="form-control" placeholder="Password" required>
                                    </div>
                                    <div class="form-group text-center">
                                        <input type="button" name="signupsubmit" id="regsubmit" value="Sign Up"
                                            class="btn btn-block btn-primary">
                                    </div>
                                    </br>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="myMapModaltop" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Choose Location</h5>
            </div>
            <div class="modal-body">
                <div id="map-canvas3" style="height: 300px;"></div>
            </div>
            <div class="modal-footer">
                <button id="confirm_btn" onclick="confirmshowselectmap()" type="button" class="btn btn-primary"
                    data-dismiss="modal">Confirm</button>
                <button onclick="closeshowselectmap()" type="button" class="btn btn-primary"
                    data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>