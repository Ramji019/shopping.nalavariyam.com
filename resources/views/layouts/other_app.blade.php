<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name') }}</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta name="description" content="Kanyakumari Property Realestate nagercoil , Best to Buy / Sell all your property in Kanyakumari plot for sale house for sale">
<meta name="keywords" content="Kanyakumari property Realestate nagercoil , Best to Buy / Sell all your property in Kanyakumari plot for sale house for sale">
<title data-react-helmet="true">Kanyakumari property Realestate nagercoil , Best to Buy / Sell all your property in Kanyakumari plot for sale house for sale</title>

<meta name="contact" content="9344332244" />

<meta name="address" content="Asaripallam Rd, Weavers Colony, NesamonyNagar, TamilNadu 629003, India, " />

<meta name="link" content="https://kanyakumariproperty.in/" />

<meta name="map" content="https://goo.gl/maps/iEtHnQSkN1aR3dkLA" />

<meta name="author" content="Galaxy Kannan" />
    <link href="{!! asset('assets/css/styles.css') !!}" rel="stylesheet">
    <link href="{!! asset('assets/css/colors.css') !!}" rel="stylesheet">

    <meta name="theme-color" content="#6777ef" />
    <link rel="apple-touch-icon" href="{{ asset('/AdminLTELogo.PNG') }}">
    <!--  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"> -->
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css"
        rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />

    @yield('third_party_stylesheets')

    @stack('page_css')
</head>

<body class="blue-skin">
    <div id="preloader">
        <div class="preloader">
            <span></span><span></span>
        </div>
    </div>
    <div id="main-wrapper">
        @include('layouts.header')
        @yield('content')
        @include('layouts.footer')

        @yield('third_party_scripts')
        <!-- Bootstrap -->
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCMFPPAlejgNNF0FPoxBNjqVpThqXRvy_s"></script>
        <script src="{!! asset('assets/js/jquery.min.js') !!}"></script>
        <script src="{!! asset('assets/js/popper.min.js') !!}"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="{!! asset('assets/js/rangeslider.js') !!}"></script>
        <script src="{!! asset('assets/js/select2.min.js') !!}"></script>
        <script src="{!! asset('assets/js/jquery.magnific-popup.min.js') !!}"></script>
        <script src="{!! asset('assets/js/slick.js') !!}"></script>
        <script src="{!! asset('assets/js/slider-bg.js') !!}"></script>
        <script src="{!! asset('assets/js/lightbox.js') !!}"></script>
        <script src="{!! asset('assets/js/imagesloaded.js') !!}"></script>
        <script src="{!! asset('assets/js/custom.js') !!}"></script>
        <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>

        <script src="{!! asset('assets/js/bootstrap.min.js') !!}"></script>
        <!-- ============================================================== -->
        <!-- This page plugins -->
        <!-- ============================================================== -->

        <script src="{!! asset('assets/js/dropzone.js') !!}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>

        @stack('page_scripts')
        <script>
            $(document).ready(function() {
                toastr.options.timeOut = 10000;
                @if (Session::has('error'))
                    toastr.error('{{ Session::get('error') }}');
                @elseif(Session::has('success'))
                    toastr.success('{{ Session::get('success') }}');
                @endif
            });
    
        </script>
        <script>
            
            $('#loginsubmit').click(function() {
                var email = $("#logemail").val().trim();
                $("#errormessage").html("");
                if (email == "") {
                    $("#errormessage").html("Please enter Email or Mobile No");
                    $("#logemail").focus();
                } else if ($("#logpassword").val().trim() == "") {
                    $("#errormessage").html("Please enter Password");
                    $("#logpassword").focus();
                } else {
                    var email = $("#logemail").val().trim();
                    var password = $("#logpassword").val().trim();
                    $.ajax({
                        url: "{{ url('/checkLogin') }}",
                        type: "POST",
                        data: {
                            email: email,
                            password: password,
                            _token: '{{ csrf_token() }}'
                        },
                        dataType: 'json',
                        success: function(result) {
                            if (result.status == "fail") {
                                $("#errormessage").html("Invalid Login Credentials");
                            } else if (result.status == "success") {
                                window.location.href = "{{ url('/cart') }}";
                            }
                        },
                        error: function(error) {
                            console.log(JSON.stringify(error));
                        }
                    });
                }
            });

            $('#regsubmit').click(function() {
                var pattern = /^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i
                var email = $("#selleremail").val().trim();
                $("#reqname").html("");
                $("#reqemail").html("");
                $("#reqpassword").html("");
                $("#reqphone").html("");
                $("#reqplan").html("");
                if ($("#sellername").val().trim() == "") {
                    $("#reqname").html("Please enter Full Name");
                    $("#sellername").focus();
                } else if (email == "") {
                    $("#reqemail").html("Please enter email");
                    $("#selleremail").focus();
                } else if (!pattern.test(email)) {
                    $("#reqemail").html("Please enter a valid email address");
                    $("#selleremail").focus();
                } else if ($("#sellerpassword").val().trim() == "") {
                    $("#reqpassword").html("Please enter password");
                    $("#sellerpassword").focus();
                } else if ($("#sellerphone").val().trim() == "") {
                    $("#reqphone").html("Please enter mobile no");
                    $("#sellerphone").focus();
                } else {

                    var mobile = $("#sellerphone").val().trim();
                    var name = $("#sellername").val().trim();
                    var password = $("#sellerpassword").val().trim();
                    var otpgenerated = $("#otpgenerated").val().trim();
                    var otp = "";
                    if (otpgenerated == 1) {
                        otp = $("#otp1").val() + $("#otp2").val() + $("#otp3").val() + $("#otp4").val();
                    }
                    $.ajax({
                        url: "{{ url('/generateotp') }}",
                        type: "POST",
                        data: {
                            email: email,
                            mobile: mobile,
                            name: name,
                            password: password,
                            otpgenerated: otpgenerated,
                            otp: otp,
                            _token: '{{ csrf_token() }}'
                        },
                        dataType: 'json',
                        success: function(result) {
                            if (result.status == "fail" && result.status_type == "1") {
                                $("#reqemail").html(result.message);
                            } else if (result.status == "fail" && result.status_type == "2") {
                                $("#reqphone").html(result.message);
                            } else if (result.status == "fail" && result.status_type == "3") {
                                $("#reqotp").html(result.message);
                            } else if (result.status == "success" && result.status_type == "1") {
                                $("#otpdiv").show();
                                $("#selleremail").attr("readonly", true);
                                $("#sellerphone").attr("readonly", true);
                                $("#otpgenerated").val("1");
                            } else if (result.status == "success" && result.status_type == "2") {
                                window.location.href = '/user/dashboard';
                            }
                        },
                        error: function(error) {
                            //console.log(JSON.stringify(error));
                        }
                    });
                }
            });

            function fogotpass() {
                $("#loginformdiv").hide();
                $("#logintitle").html("Forgot Password");
                $("#forgotpassdiv").show();
            }

            function sendotp() {
                if ($("#forphone").val().trim() == "") {
                    $("#lforphone").html("Please enter mobile no");
                    $("#forphone").focus();
                } else {
                    var mobile = $("#forphone").val().trim();
                    $.ajax({
                        url: "{{ url('/forgotpassotp') }}/" + mobile,
                        type: "GET",
                        dataType: 'json',
                        success: function(result) {
                            if (result.status == "fail" && result.status_type == "1") {
                                $("#lforphone").html(result.message);
                            } else if (result.status == "success" && result.status_type == "1") {
                                $("#forgotpassdiv").hide();
                                $("#forgototpdiv").show();
                            }
                        },
                        error: function(error) {
                            console.log(JSON.stringify(error));
                        }
                    });
                }
            }

            function changepassword() {
                $("#lotplabel").html("");
                $("#lpasslabel").html("");
                $("#lconpasslabel").html("");
                var mobile = $("#forphone").val().trim();
                var password = $("#forpass").val().trim();
                var conpassword = $("#forconpass").val().trim();
                if ($("#lotp1").val().trim() == "") {
                    $("#lotplabel").html("Please enter OTP");
                } else if ($("#lotp2").val().trim() == "") {
                    $("#lotplabel").html("Please enter OTP");
                } else if ($("#lotp3").val().trim() == "") {
                    $("#lotplabel").html("Please enter OTP");
                } else if ($("#lotp4").val().trim() == "") {
                    $("#lotplabel").html("Please enter OTP");
                } else if (password == "") {
                    $("#lpasslabel").html("Please enter password");
                } else if (conpassword == "") {
                    $("#lconpasslabel").html("Please enter confirm password");
                } else if (password != conpassword) {
                    $("#lconpasslabel").html("Passwords does not match");
                } else {
                    var otp = $("#lotp1").val() + $("#lotp2").val() + $("#lotp3").val() + $("#lotp4").val();
                    $.ajax({
                        url: "{{ url('/changepassword') }}",
                        type: "POST",
                        data: {
                            otp: otp,
                            mobile: mobile,
                            password: password,
                            conpassword: conpassword,
                            _token: '{{ csrf_token() }}'
                        },
                        dataType: 'json',
                        success: function(result) {
                            console.log(JSON.stringify(result));
                            if (result.status == "fail" && result.status_type == "1") {
                                $("#lotplabel").html(result.message);
                            } else if (result.status == "success" && result.status_type == "1") {
                                window.location.href = '/user/dashboard';
                            }
                        },
                        error: function(error) {
                            console.log(JSON.stringify(error));
                        }
                    });
                }
            }

            function backsignin() {
                $("#forgotpassdiv").hide();
                $("#forgototpdiv").hide();
                $("#loginformdiv").show();
                $("#logintitle").html("Log In");
            }

            $(".inputs").keyup(function() {
                if (this.value.length == this.maxLength) {
                    $(this).next('.inputs').focus();
                }
            });

            $("#state_dropdown").on('change', function() {
                var state_id = this.value;
                window.location.href = "{{ url('statewise') }}/" + state_id;
            });

            $('.number').keypress(function(event) {
                var keycode = event.which;
                if (!(event.shiftKey == false && (keycode == 8 || keycode == 37 || keycode == 39 || (keycode >=
                        48 && keycode <= 57)))) {
                    event.preventDefault();
                }
            });

            $(".decimal").keypress(function(evt) {
                var charCode = (evt.which) ? evt.which : event.keyCode;
                if (charCode != 46 && charCode > 31 &&
                    (charCode < 48 || charCode > 57)) {
                    return false;
                }
                if (charCode == 46 && this.value.indexOf(".") !== -1) {
                    return false;
                }
                return true;
            });


            document.addEventListener("DOMContentLoaded", function() {
                /////// Prevent closing from click inside dropdown
                document.querySelectorAll('.dropdown-menu').forEach(function(element) {
                    element.addEventListener('click', function(e) {
                        e.stopPropagation();
                    });
                })
                // make it as accordion for smaller screens
                if (window.innerWidth < 992) {
                    // close all inner dropdowns when parent is closed
                    document.querySelectorAll('.navbar .dropdown').forEach(function(everydropdown) {
                        everydropdown.addEventListener('hidden.bs.dropdown', function() {
                            // after dropdown is hidden, then find all submenus
                            this.querySelectorAll('.submenu')
                                .forEach(function(everysubmenu) {
                                    // hide every submenu as well
                                    everysubmenu
                                        .style
                                        .display =
                                        'none';
                                });
                        })
                    });
                    document.querySelectorAll('.dropdown-menu a').forEach(function(element) {
                        element.addEventListener('click', function(e) {
                            let nextEl = this.nextElementSibling;
                            if (nextEl && nextEl.classList
                                .contains('submenu')) {
                                // prevent opening link if link needs to open dropdown
                                e.preventDefault();
                                console.log(nextEl);
                                if (nextEl.style.display ==
                                    'block') {
                                    nextEl.style.display =
                                        'none';
                                } else {
                                    nextEl.style.display =
                                        'block';
                                }
                            }
                        });
                    })
                }
                // end if innerWidth
            });
            // DOMContentLoaded  end


            function removefavorites(user_id, product_id) {
                var url = "{{ url('/removefavorites') }}/" + user_id + "/" + product_id;
                $.ajax({
                    url: url,
                    type: "GET",
                    success: function(result) {
                        window.location.href = "{{ url('/user/wishlist') }}";
                    },
                    error: function(error) {
                        console.log(JSON.stringify(error));
                    }
                });
            }

            function productfavorites(obj, user_id, product_id) {
                var url = "";
                if ($(obj).hasClass("btn-danger")) {
                    url = "{{ url('/removefavorites') }}/" + user_id + "/" + product_id;
                } else {
                    url = "{{ url('/addfavorites') }}/" + user_id + "/" + product_id;
                }
                $.ajax({
                    url: url,
                    type: "GET",
                    success: function(result) {
                        if ($(obj).hasClass("btn-danger")) {
                            $(obj).removeClass("btn-danger");
                            $(obj).addClass("btn-success");
                        } else {
                            $(obj).removeClass("btn-success");
                            $(obj).addClass("btn-danger");
                        }
                    },
                    error: function(error) {
                        console.log(JSON.stringify(error));
                    }
                });
            }

            function markassold(product_id) {
                $.ajax({
                    url: "{{ url('/marksold') }}/" + product_id,
                    type: "GET",
                    success: function(result) {
                        window.location.href = "{{ url('/user/my_products') }}";
                    },
                    error: function(error) {
                        console.log(JSON.stringify(error));
                    }
                });
            }
        </script>

</body>

</html>
