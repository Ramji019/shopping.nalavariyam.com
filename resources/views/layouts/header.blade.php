<div class="header header-light head-shadow">
    <div class="container" style="height: 87px">

        <nav id="navigation" class="navigation navigation-landscape">
            <div class="nav-header">
                <a class="nav-brand" href="{{ URL::to('/') }}">
                    <img src="{!! asset('assets/img/images.jpg') !!}" class="logo" alt="" />
                </a>
                <div class="nav-toggle"></div>
            </div>

            <div class="nav-menus-wrapper" style="transition-property: none;">
                <ul class="nav-menu">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                         
                                <div class="form-group" style="padding-top:10px;">
                                    <div class="input-with-icon">
                                        <input id="searchbox" type="text" class="form-control" placeholder="Search">
                                    </div>
                                </div>
                  
                        </div>

                        <div class="col-lg-1 col-md-1 col-sm-12">

                            <ul class="nav-menu nav-menu-social align-to-right">
                                <a class="fa mt-4" href="{{ url('/cart') }}" style="font-size:24px">&#xf07a;</i></a>
                                <a href="{{ url('/cart') }}"><span class='badge badge-warning' id='lblCartCount'></span></a>
                            </ul>

                        </div>

                        {{-- <div class="col-lg-3 col-md-3 col-sm-12">
                            @if (isset($currentRouteName) && ($currentRouteName == 'home' || $currentRouteName == 'category' || $currentRouteName == 'statewise' || $currentRouteName == 'nearby'))
                                <div class="form-group" style="padding-top:10px;">
                                    <div class="input-with-icon">
                                        <div class="dropdown">
                                            <button type="button" id="current_location_span"
                                                class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">
                                            </button>
                                            <ul class="dropdown-menu" style="height:200px ! important;width:250px;">
                                                <li><a class="dropdown-item" onclick="nearby()" id="current_locationtop"
                                                        href="#"></a></li>
                                                @foreach ($state as $sta)
                                                    <li><a class="dropdown-item"
                                                            href="{{ url('statewise') }}/{{ $sta->state_id }}">{{ $sta->state_id }}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div> --}}
                        {{-- <div class="col-lg-2 col-md-2 col-sm-12">
                            <ul class="nav-menu nav-menu-social align-to-right">
                                <li><a href="JavaScript:Void(0);">
                                        @if (Auth::user())
                                            @if(Auth::user()->usertype_id == 3)
                                                Profile
                                            @endif
                                            @if(Auth::user()->usertype_id == 4)
                                                Profile
                                            @endif
                                        @endif
                                        <span class="submenu-indicator"></span>
                                    </a>
                                    <ul class="nav-dropdown nav-submenu">
                                        @if (Auth::user() )
                                            <li><a href="{{ url('/user/profile') }}">My Profile</a></li>
                                            <li><a href="{{ url('/sellerlogout') }}">Logout</a></li>
                                        @else
                                            <li><a href="{{ url('/buyer') }}">
                                                    Register</a></li>
                                            <li><a href="JavaScript:Void(0);" data-bs-toggle="modal"
                                                    data-bs-target="#buyerlogin">Log In</a>
                                            </li>
                                        @endif
                                    </ul>
                                </li>
                            </ul>
                        </div> --}}

                        <div class="col-lg-2 col-md-2 col-sm-12">
                            <ul class="nav-menu nav-menu-social align-to-right">
                                <li><a href="JavaScript:Void(0);">
                                        @if (Auth::user())
                                            Profile
                                        @else
                                            Register
                                        @endif
                                        <span class="submenu-indicator"></span>
                                    </a>
                                    <ul class="nav-dropdown nav-submenu">
                                        @if (Auth::user())
                                            <li><a href="{{ url('/user/profile') }}">My Profile</a></li>
                                            <li><a href="{{ url('/userlogout') }}">Logout</a></li>
                                        @else
                                            <li><a href="{{ url('buyerregister') }}">
                                                    New User Registration</a></li>
                                            <li><a href="JavaScript:Void(0);" data-bs-toggle="modal"
                                                    data-bs-target="#loginshop">Existing User Login</a>
                                            </li>
                                        @endif
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </ul>
            </div>
        </nav>
    </div>
</div>
<div class="clearfix"></div>
<div class="modal fade" id="loginshop" tabindex="-1" role="dialog" aria-labelledby="registermodal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered login-pop-form" role="document">
        <div class="modal-content" id="registermodal">
            <span class="mod-close" data-bs-dismiss="modal" aria-hidden="true"><i class="ti-close"></i></span>
            <div class="modal-body">
                <h6 class="modal-header-title text-center" id="logintitle">Log In</h6>
                <div class="login-form" id="loginformdiv">
                    <form action="" method="post">
                        {{ csrf_field() }}
                        <label id="errormessage" class="text-center" style="color:red"></label>
                        <div class="form-group">
                            <label>Email or Mobile No</label>
                            <div class="input-with-icon">
                                <input value="" type="text" name="logemail" id="logemail"
                                class="form-control" placeholder="Email or Mobile no">
                                <i class="ti-user"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <div class="input-with-icon">
                                <input value="" type="password" name="logpassword" id="logpassword"
                                class="form-control" placeholder="Password">
                                <i class="ti-unlock"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <input id="loginsubmit" type="button" name="submit"
                            class="btn btn-md full-width btn-theme-light-2 rounded" value="Login">
                        </div>
                        <div class="text-center">
                             <p class="mt-5"><a href="{{ url('buyerregister') }}" class="link">New User Registration</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- <div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="registermodal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered login-pop-form" role="document">
        <div class="modal-content" id="registermodal">
            <span class="mod-close" data-bs-dismiss="modal" aria-hidden="true"><i class="ti-close"></i></span>
            <div class="modal-body">
                <h6 class="modal-header-title text-center" id="logintitle">Log In</h6>
                <div class="login-form" id="loginformdiv">
                    <form action="" method="post">
                        {{ csrf_field() }}
                        <label id="errormessage" class="text-center" style="color:red"></label>
                        <div class="form-group">
                            <label>Email or Mobile no</label>
                            <div class="input-with-icon">
                                <input value="" type="text" name="logemail" id="logemail"
                                    class="form-control" placeholder="Email or Mobile no">
                                <i class="ti-user"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <div class="input-with-icon">
                                <input value="" type="password" name="logpassword" id="logpassword"
                                    class="form-control" placeholder="Password">
                                <i class="ti-unlock"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <input id="loginsubmit" type="button" name="submit"
                                class="btn btn-md full-width btn-theme-light-2 rounded" value="Login">
                        </div>
                    </form>
                    <div class="text-center">
                        <p class="mt-5"><a onclick="fogotpass()" href="#" class="link">Forgot
                                password?</a></p>
                    </div>
                </div>
                <div class="row" id="forgotpassdiv" style="display: none">
                    <div class="text-center">
                        <p class="mt-5"><a onclick="backsignin()" href="#" class="link">Signin</a></p>
                    </div>
                    <div class="col-lg-12 col-md-12">
                        <label id="lforphone" style="color:red"></label>
                        <div class="form-group">
                            <input type="text" name="forphone" id="forphone" maxlength="15" required="required"
                                class="form-control number" placeholder="Mobile No">
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 text-center">
                        <div class="form-group">
                            <input onclick="sendotp()" id="submitmobile" type="button"
                                class="btn btn-md full-width btn-theme-light-2 rounded" value="Submit">
                        </div>
                    </div>
                </div>
                <div class="row" id="forgototpdiv" style="display: none">
                    <div class="text-center">
                        <p class="mt-5"><a onclick="backsignin()" href="#" class="link">Signin</a></p>
                    </div>
                    <div class="col-lg-12 col-md-12">
                        <label>Enter OTP</label>
                        <label id="lotplabel" style="color:red"></label>
                        <div class="input-group mb-12 otp-input-group">
                            <input type="hidden" name="lotpgenerated" value="0" id="otpgenerated" />
                            <input id="lotp1" required="required" size="1" value="1" maxlength="1"
                                name="otp1" class="inputs number form-control">
                            <input id="lotp2" required="required" size="1" value="2" maxlength="1"
                                name="otp2" class="inputs number form-control">
                            <input id="lotp3" required="required" size="1" value="3" maxlength="1"
                                name="otp3" class="inputs number form-control">
                            <input id="lotp4" required="required" size="1" value="4" maxlength="1"
                                name="otp4" class="inputs number form-control">
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12">
                        <label>Password</label>
                        <label id="lpasslabel" style="color:red"></label>
                        <div class="form-group">
                            <input type="text" name="forpass" id="forpass" maxlength="15" required="required"
                                class="form-control" placeholder="Password">
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12">
                        <label>Confirm Password</label>
                        <label id="lconpasslabel" style="color:red"></label>
                        <div class="form-group">
                            <input type="text" name="forconpass" id="forconpass" maxlength="15"
                                required="required" class="form-control" placeholder="Confirm Password">
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 text-center">
                        <div class="form-group">
                            <input onclick="changepassword()" id="changepass" type="button"
                                class="btn btn-md full-width btn-theme-light-2 rounded" value="Change Password">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </ul>
</div> --}}
</nav>
</div>
</div>

<div class="clearfix"></div>
{{-- <div class="modal fade" id="buyerlogin" tabindex="-1" role="dialog" aria-labelledby="registermodal"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered login-pop-form" role="document">
        <div class="modal-content" id="registermodal">
            <span class="mod-close" data-bs-dismiss="modal" aria-hidden="true"><i class="ti-close"></i></span>
            <div class="modal-body">
                <h6 class="modal-header-title text-center" id="logintitle">Buyer Log In</h6>
                <div class="login-form" id="loginformdiv">
                    <form action="" method="post">
                        {{ csrf_field() }}
                        <label id="errormessage" class="text-center" style="color:red"></label>
                        <div class="form-group">
                            <label>Email or Mobile no</label>
                            <div class="input-with-icon">
                                <input value="" type="text" name="buyemail" id="buyemail"
                                    class="form-control" placeholder="Email or Mobile no">
                                <i class="ti-user"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <div class="input-with-icon">
                                <input value="" type="password" name="buypassword" id="buypassword"
                                    class="form-control" placeholder="Password">
                                <i class="ti-unlock"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <input id="buyerloginsubmit" type="button" name="submit"
                                class="btn btn-md full-width btn-theme-light-2 rounded" value="Login">
                        </div>
                    </form>
                    <div class="text-center">
                        <p class="mt-5"><a onclick="fogotpass()" href="#" class="link">Forgot
                                password?</a></p>
                    </div>
                </div>
                <div class="row" id="forgotpassdiv" style="display: none">
                    <div class="text-center">
                        <p class="mt-5"><a onclick="backsignin()" href="#" class="link">Signin</a></p>
                    </div>
                    <div class="col-lg-12 col-md-12">
                        <label id="lforphone" style="color:red"></label>
                        <div class="form-group">
                            <input type="text" name="forphone" id="forphone" maxlength="15" required="required"
                                class="form-control number" placeholder="Mobile No">
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 text-center">
                        <div class="form-group">
                            <input onclick="sendotp()" id="submitmobile" type="button"
                                class="btn btn-md full-width btn-theme-light-2 rounded" value="Submit">
                        </div>
                    </div>
                </div>
                <div class="row" id="forgototpdiv" style="display: none">
                    <div class="text-center">
                        <p class="mt-5"><a onclick="backsignin()" href="#" class="link">Signin</a></p>
                    </div>
                    <div class="col-lg-12 col-md-12">
                        <label>Enter OTP</label>
                        <label id="lotplabel" style="color:red"></label>
                        <div class="input-group mb-12 otp-input-group">
                            <input type="hidden" name="lotpgenerated" value="0" id="otpgenerated" />
                            <input id="lotp1" required="required" size="1" value="1" maxlength="1"
                                name="otp1" class="inputs number form-control">
                            <input id="lotp2" required="required" size="1" value="2" maxlength="1"
                                name="otp2" class="inputs number form-control">
                            <input id="lotp3" required="required" size="1" value="3" maxlength="1"
                                name="otp3" class="inputs number form-control">
                            <input id="lotp4" required="required" size="1" value="4" maxlength="1"
                                name="otp4" class="inputs number form-control">
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12">
                        <label>Password</label>
                        <label id="lpasslabel" style="color:red"></label>
                        <div class="form-group">
                            <input type="text" name="forpass" id="forpass" maxlength="15" required="required"
                                class="form-control" placeholder="Password">
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12">
                        <label>Confirm Password</label>
                        <label id="lconpasslabel" style="color:red"></label>
                        <div class="form-group">
                            <input type="text" name="forconpass" id="forconpass" maxlength="15"
                                required="required" class="form-control" placeholder="Confirm Password">
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 text-center">
                        <div class="form-group">
                            <input onclick="changepassword()" id="changepass" type="button"
                                class="btn btn-md full-width btn-theme-light-2 rounded" value="Change Password">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </ul>
</div> --}}

{{-- <div class="modal fade signup" id="signup" tabindex="-1" role="dialog" aria-labelledby="sign-up"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered login-pop-form" role="document">
        <div class="modal-content" id="sign-up">
            <span class="mod-close" data-bs-dismiss="modal" aria-hidden="true"><i class="ti-close"></i></span>
            <div class="modal-body">
                <h6 class="modal-header-title">Sign Up</h6>
                <div class="login-form">
                    <form action="{{ url('/seller') }}" method="post">
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
                                        <input value="" name="selleremail" id="selleremail"
                                            required="required" maxlength="50" type="email" class="form-control"
                                            placeholder="Email">
                                        <i class="ti-email"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <label id="reqpassword" style="color:red"></label>
                                <div class="form-group">
                                    <div class="input-with-icon">
                                        <input type="password" id="sellerpassword" maxlength="20" name="password"
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
                                <div class="col-lg-12 col-md-12 text-center">
                                    <label id="reqotp" style="color:red"></label>
                                </div>
                            </div>
                            <div class="row" id="otpdiv" style="display: none">
                                <div class="col-lg-4 col-md-4"></div>
                                <div class="col-lg-4 col-md-4 text-center">
                                    <label style="color:green">An OTP is sent to your mobile</label>
                                    <div class="input-group mb-3 otp-input-group">
                                        <input type="hidden" name="otpgenerated" value="0"
                                            id="otpgenerated" />
                                        <input id="otp1" required="required" size="1" value="1"
                                            maxlength="1" name="otp1" class="inputs number form-control">
                                        <input id="otp2" required="required" size="1" value="2"
                                            maxlength="1" name="otp2" class="inputs number form-control">
                                        <input id="otp3" required="required" size="1" value="3"
                                            maxlength="1" name="otp3" class="inputs number form-control">
                                        <input id="otp4" required="required" size="1" value="4"
                                            maxlength="1" name="otp4" class="inputs number form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4"></div>
                        </div>
                        <div class="form-group">
                            <input name="submit" id="regsubmit" type="button"
                                class="btn btn-md full-width btn-theme-light-2 rounded" value="Sign UP">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}


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
