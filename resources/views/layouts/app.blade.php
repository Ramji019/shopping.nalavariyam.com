<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
<title data-react-helmet="true">Shoping Nalavariyam</title>
<meta name="description" content="Shoping Nalavariyam">
<meta name="google-site-verification" content="l1WHPb1Jb9hv-164zHGRs-vPSWee-pCr2qvVR0K_wnM" />
<meta name="keywords" content="Shoping Nalavariyam">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="address" content="Shoping Nalavariyam, TamilNadu 629003, India, " />
<meta name="author" content="Galaxy Kannan" />
<meta name="contact" content="9344332244" />


    <link href="{!! asset('assets/css/styles.css') !!}" rel="stylesheet">

    <link href="{!! asset('assets/css/colors.css') !!}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />

    @yield('third_party_stylesheets')

    @stack('page_css')
	
</head>

<body class="blue-skin">
    {{-- <div id="preloader">
        <div class="preloader">
            <span></span><span></span>
        </div>
    </div> --}}
    <div id="main-wrapper">
        @include('layouts.header')
        @if (session()->has('error'))
            <div class="alert alert-success alert-dismissable" style="margin: 15px;">
                <a href="#" style="color:white !important" class="close" data-dismiss="alert"
                    aria-label="close">&times;</a>
                <strong> {{ session('error') }} </strong>
            </div>
        @endif
        @include('layouts.banner')
        @yield('content')
        @include('layouts.footer')

        @yield('third_party_scripts')
        <!-- Bootstrap -->
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCMFPPAlejgNNF0FPoxBNjqVpThqXRvy_s"></script>
        <script src="{!! asset('assets/js/jquery.min.js') !!}"></script>
        <script src="{!! asset('assets/js/popper.min.js') !!}"></script>
        <script src="{!! asset('assets/js/bootstrap.min.js') !!}"></script>
        <script src="{!! asset('assets/js/rangeslider.js') !!}"></script>
        <script src="{!! asset('assets/js/select2.min.js') !!}"></script>
        <script src="{!! asset('assets/js/jquery.magnific-popup.min.js') !!}"></script>
        <script src="{!! asset('assets/js/slick.js') !!}"></script>
        <script src="{!! asset('assets/js/slider-bg.js') !!}"></script>
        <script src="{!! asset('assets/js/lightbox.js') !!}"></script>
        <script src="{!! asset('assets/js/imagesloaded.js') !!}"></script>
        <script src="{!! asset('assets/js/custom.js') !!}"></script>
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
                                window.location.href = '/cart';
                            }
                        },
                        error: function(error) {
                            console.log(JSON.stringify(error));
                        }
                    });
                }
            });

            $('#buyerloginsubmit').click(function() {
                var email = $("#buyemail").val().trim();
                $("#errormessage").html("");
                if (email == "") {
                    $("#errormessage").html("Please enter Email or Mobile No");
                    $("#buyemail").focus();
                } else if ($("#buypassword").val().trim() == "") {
                    $("#errormessage").html("Please enter Password");
                    $("#buypassword").focus();
                } else {
                    var email = $("#buyemail").val().trim();
                    var password = $("#buypassword").val().trim();
                    $.ajax({
                        url: "{{ url('/buyerLogin') }}",
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
                                window.location.href = '/user/dashboard';
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

            $(".inputs").keyup(function() {
                if (this.value.length == this.maxLength) {
                    $(this).next('.inputs').focus();
                }
            });
            $('.number').keypress(function(event) {
                var keycode = event.which;
                if (!(event.shiftKey == false && (keycode == 8 || keycode == 37 || keycode == 39 || (keycode >=
                        48 && keycode <= 57)))) {
                    event.preventDefault();
                } 
            });

            $("#state_dropdown").on('change', function() {
                var state_id = this.value;
                window.location.href = "{{ url('statewise') }}/" + state_id;
            });

            $(".alert-success").fadeTo(2000, 500).slideUp(500, function() {
                $(".alert-success").slideUp(500);
            });

            //chat

            $(function() {
                var INDEX = 0;
                $("#chat-submit").click(function(e) {
                    e.preventDefault();
                    var msg = $("#chat-input").val();
                    if (msg.trim() == '') {
                        return false;
                    }
                    generate_message(msg, 'self');
                    var buttons = [{
                            name: 'Existing User',
                            value: 'existing'
                        },
                        {
                            name: 'New User',
                            value: 'new'
                        }
                    ];
                    setTimeout(function() {
                        generate_message(msg, 'user');
                    }, 1000)

                })

                function generate_message(msg, type) {
                    INDEX++;
                    var str = "";
                    str += "<div id='cm-msg-" + INDEX + "' class=\"chat-msg " + type + "\">";
                    str += "          <span class=\"msg-avatar\">";
                    str +=
                        "            <img src=\"https:\/\/image.crisp.im\/avatar\/operator\/196af8cc-f6ad-4ef7-afd1-c45d5231387c\/240\/?1483361727745\">";
                    str += "          <\/span>";
                    str += "          <div class=\"cm-msg-text\">";
                    str += msg;
                    str += "          <\/div>";
                    str += "        <\/div>";
                    $(".chat-logs").append(str);
                    $("#cm-msg-" + INDEX).hide().fadeIn(300);
                    if (type == 'self') {
                        $("#chat-input").val('');
                    }
                    $(".chat-logs").stop().animate({
                        scrollTop: $(".chat-logs")[0].scrollHeight
                    }, 1000);
                }

                function generate_button_message(msg, buttons) {
                    /* Buttons should be object array 
                      [
                        {
                          name: 'Existing User',
                          value: 'existing'
                        },
                        {
                          name: 'New User',
                          value: 'new'
                        }
                      ]
                      */
                    INDEX++;
                    var btn_obj = buttons.map(function(button) {
                        return "              <li class=\"button\"><a href=\"javascript:;\" class=\"btn btn-primary chat-btn\" chat-value=\"" +
                            button.value + "\">" + button.name + "<\/a><\/li>";
                    }).join('');
                    var str = "";
                    str += "<div id='cm-msg-" + INDEX + "' class=\"chat-msg user\">";
                    str += "          <span class=\"msg-avatar\">";
                    str +=
                        "            <img src=\"https:\/\/image.crisp.im\/avatar\/operator\/196af8cc-f6ad-4ef7-afd1-c45d5231387c\/240\/?1483361727745\">";
                    str += "          <\/span>";
                    str += "          <div class=\"cm-msg-text\">";
                    str += msg;
                    str += "          <\/div>";
                    str += "          <div class=\"cm-msg-button\">";
                    str += "            <ul>";
                    str += btn_obj;
                    str += "            <\/ul>";
                    str += "          <\/div>";
                    str += "        <\/div>";
                    $(".chat-logs").append(str);
                    $("#cm-msg-" + INDEX).hide().fadeIn(300);
                    $(".chat-logs").stop().animate({
                        scrollTop: $(".chat-logs")[0].scrollHeight
                    }, 1000);
                    $("#chat-input").attr("disabled", true);
                }

                $(document).delegate(".chat-btn", "click", function() {
                    var value = $(this).attr("chat-value");
                    var name = $(this).html();
                    $("#chat-input").attr("disabled", false);
                    generate_message(name, 'self');
                })

                $("#chat-circle").click(function() {
                    $("#chat-circle").toggle('scale');
                    $(".chat-box").toggle('scale');
                })

                $(".chat-box-toggle").click(function() {
                    $("#chat-circle").toggle('scale');
                    $(".chat-box").toggle('scale');
                })

            })



            function addfavorites(obj, user_id, product_id) {
                var url = "";
                if ($(obj).hasClass("prt-view-t")) {
                    url = "{{ url('/removefavorites') }}/" + user_id + "/" + product_id;
                } else {
                    url = "{{ url('/addfavorites') }}/" + user_id + "/" + product_id;
                }
                $.ajax({
                    url: url,
                    type: "GET",
                    success: function(result) {
                        if ($(obj).hasClass("prt-view")) {
                            $(obj).removeClass("prt-view");
                            $(obj).addClass("prt-view-t");
                        } else {
                            $(obj).removeClass("prt-view-t");
                            $(obj).addClass("prt-view");
                        }
                    },
                    error: function(error) {
                        console.log(JSON.stringify(error));
                    }
                });
            }

            document.getElementById("searchbox").onkeyup = function() {
                var matcher = new RegExp(document.getElementById("searchbox").value, "gi");
                for (var i = 0; i < document.getElementsByClassName("product_div").length; i++) {
                    if (matcher.test(document.getElementsByClassName("listing-name")[i].innerHTML)) {
                        document.getElementsByClassName("product_div")[i].style.display = "inline-block";
                    } else {
                        document.getElementsByClassName("product_div")[i].style.display = "none";
                    }
                }
            }

            function load_addresstop(lat2, lng2) {
                $.getJSON("https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=" + lat2 + "&lon=" + lng2, function(
                    data) {
                    formattedAddress = '';
                    if (data.address.suburb != undefined) {
                        formattedAddress += data.address.suburb + ' ';
                    }
                    if (data.address.city != undefined) {
                        formattedAddress += data.address.city;
                    }
                    if (formattedAddress == "" && data.address.state != undefined) {
                        formattedAddress += data.address.state + ' ';
                    }
                    $("#current_locationtop").text(formattedAddress);
                    $("#current_location_span").text(formattedAddress);
                    $("#latitudetop").val(lat2);
                    $("#longitudetop").val(lng2);
                });
            }

            function nearby() {
                var lat = $("#latitudetop").val();
                var lng = $("#longitudetop").val();
                window.location.href = "{{ url('/nearby') }}/" + lat + "/" + lng;
            }

            function showLocationtop(position) {
                var latitude = position.coords.latitude;
                var longitude = position.coords.longitude;
                load_addresstop(latitude, longitude);
            }

            function errorHandlertop(err) {
                if (err.code == 1) {
                    //alert("Error: Access is denied!");
                } else if (err.code == 2) {
                    //alert("Error: Position is unavailable!");
                }
            }

            function getcurrentLocationtop() {
                if (navigator.geolocation) {
                    var options = {
                        timeout: 60000
                    };
                    navigator.geolocation.getCurrentPosition(showLocationtop, errorHandlertop, options);
                } else {
                    alert("Sorry, browser does not support geolocation!");
                }
            }

            jQuery(document).ready(function($) {
                getcurrentLocationtop();
            });

            function showselectmap() {
                $("#myMapModaltop").modal('show');
            }

            var lat = "";
            var lng = "";
            var map;

            function initialize(myCenter) {
                var marker = new google.maps.Marker({
                    position: myCenter
                });
                var mapProp = {
                    center: myCenter,
                    zoom: 14,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                };
                map = new google.maps.Map(document.getElementById("map-canvas3"), mapProp);
                marker.setMap(map);
                google.maps.event.addListener(map, "click", function(event) {
                    var myLatLng = event.latLng;
                    lat = myLatLng.lat();
                    console.log("here" + lat);
                    lng = myLatLng.lng();
                });
            }

            function closeshowselectmap() {
                $("#myMapModaltop").modal('hide');
            }

            function confirmshowselectmap() {
                load_addresstop(lat, lng);
                $("#myMapModaltop").modal('hide');
            }

            $('#myMapModaltop').on('shown.bs.modal', function(e) {
                var lat3 = $("#latitudetop").val();
                var lng3 = $("#longitudetop").val();
                initialize(new google.maps.LatLng(lat3, lng3));
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

            
        </script>

</body>

</html>
