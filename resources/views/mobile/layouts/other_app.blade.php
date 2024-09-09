<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>{{ config('app.name') }}</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, viewport-fit=cover, shrink-to-fit=no">
<meta name="google-site-verification" content="l1WHPb1Jb9hv-164zHGRs-vPSWee-pCr2qvVR0K_wnM" />
    <link rel="icon" href="{!! asset('mobile/img/icons/icon-72x72.png') !!}">
    <link rel="apple-touch-icon" href="{!! asset('mobile/img/icons/icon-96x96.png') !!}">
    <link rel="apple-touch-icon" sizes="152x152" href="{!! asset('mobile/img/icons/icon-152x152.png') !!}">
    <link rel="apple-touch-icon" sizes="167x167" href="{!! asset('mobile/img/icons/icon-167x167.png') !!}">
    <link rel="apple-touch-icon" sizes="180x180" href="{!! asset('mobile/img/icons/icon-180x180.png') !!}">

    <link rel="stylesheet" href="{!! asset('mobile/css/bootstrap.min.css') !!}">
    <link rel="stylesheet" href="{!! asset('mobile/css/animate.css') !!}">
    <link rel="stylesheet" href="{!! asset('mobile/css/all.min.css') !!}">
    <link rel="stylesheet" href="{!! asset('mobile/css/brands.min.css') !!}">
    <link rel="stylesheet" href="{!! asset('mobile/css/solid.min.css') !!}">
    <link rel="stylesheet" href="{!! asset('mobile/css/owl.carousel.min.css') !!}">
    <link rel="stylesheet" href="{!! asset('mobile/css/magnific-popup.css') !!}">
    <link rel="stylesheet" href="{!! asset('mobile/css/nice-select.css') !!}">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Stylesheet -->
    <link rel="stylesheet" href="{!! asset('mobile/style.css') !!}">
    <!-- Web App Manifest -->
    <link rel="manifest" href="{!! asset('mobile/manifest.json') !!}">

  @yield('mobile/third_party_stylesheets')

  @stack('mobile/page_css')
  <style>
    
.mobmenuitem1 {
  
  margin-bottom: 10px;
  overflow: hidden;
}

.mobheader1 {
  background-color: #f5f5f5;
  padding: 10px;
  cursor: pointer;
  transition: transform 0.3s cubic-bezier(0.42, -0.07, 0.58, 1.04);
  border: 1px solid #ccc;
}

.mobcontent1{
  transition: transform 0.3s cubic-bezier(0.42, -0.07, 0.58, 1.04);
}


.active1 {
  transform: translateX(-100%);
}



a.affan-element-item1 {
    margin: 0.5rem 0;
    background-color: #ffffff;
    padding: 0.625rem 0.75rem;
    color: #073984;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    border-radius: 0.5rem;
    font-weight: 500;
    font-size: 14px;
    -webkit-box-shadow: 0 1px 2px 1px rgba(15, 7, 23, 0.05);
    box-shadow: 0 1px 2px 1px rgba(15, 7, 23, 0.05);
}
  </style>
</head>
<body>

<!--
<div id="preloader">
  <div class="spinner-grow text-primary" role="status">
    <span class="visually-hidden">Loading...</span>
  </div>
</div>
-->
<!-- Internet Connection Status -->
<div class="internet-connection-status" id="internetStatus"></div>

@include('mobile/layouts.header')
@include('mobile/layouts.menu')


@yield('mobile/content')
    <div class="pt-5"></div>

@include('mobile/layouts.footer')

@yield('mobile/third_party_scripts')

    <script src="{!! asset('mobile/js/bootstrap.bundle.min.js') !!}"></script>
    <script src="{!! asset('mobile/js/jquery.min.js') !!}"></script>
    <script src="{!! asset('mobile/js/waypoints.min.js') !!}"></script>
    <script src="{!! asset('mobile/js/jquery.easing.min.js') !!}"></script>
    <script src="{!! asset('mobile/js/owl.carousel.min.js') !!}"></script>
    <script src="{!! asset('mobile/js/jquery.magnific-popup.min.js') !!}"></script>
    <script src="{!! asset('mobile/js/jquery.counterup.min.js') !!}"></script>
    <script src="{!! asset('mobile/js/jquery.countdown.min.js') !!}"></script>
    <script src="{!! asset('mobile/js/jquery.passwordstrength.js') !!}"></script>
    <script src="{!! asset('mobile/js/jquery.nice-select.min.js') !!}"></script>
    <script src="{!! asset('mobile/js/theme-switching.js') !!}"></script>
    <script src="{!! asset('mobile/js/no-internet.js') !!}"></script>
    <script src="{!! asset('mobile/js/active.js') !!}"></script>
    <script src="{!! asset('mobile/js/pwa.js') !!}"></script>
	 <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

 @stack('mobile/page_scripts')
<script>

$('#dist_ids').select2();
$('#taluk_ids').select2();

$(document).ready(function() {
                toastr.options.timeOut = 10000;
                @if (Session::has('error'))
                    toastr.error('{{ Session::get('error') }}');
                @elseif(Session::has('success'))
                    toastr.success('{{ Session::get('success') }}');
                @endif
            });

 $(document).ready(function() {
  var accordionHeaders = $('.mobheader1');
  var accordionContents = $('.mobcontent1');
  var backButton = $('.back-button1');
  var categoryTitle = $('.mtitle1');
  var allCategoriesHeader = $('.all-categories-header1');

  // Hide mobcontent elements initially
  accordionContents.hide();

  accordionHeaders.on('click', function() {
    var selectedCategory = $(this).text(); // Get the text of the clicked mobheader
    categoryTitle.text(selectedCategory); // Replace the category title with the selected text

    // Accordion click event handling
    var isShown = $(this).hasClass('show');

    accordionHeaders.css({
      'transform': 'translateX(-200%)',
      'display': 'block',
      'padding': '0px',
      'height': '0px',
      'opacity': '0'
    }).removeClass('show');

    accordionContents.hide();

    if (!isShown) {
      var accordionContent = $(this).next('.mobcontent1');
      accordionContent.css({
        'display': 'block'
      }).animate({
        'margin-left': 0
      }, 500); // Adjust the duration as needed (in milliseconds)
      $(this).addClass('show');

      backButton.css('display', 'inline-block');
      accordionHeaders.not(this).css('display', 'none'); // Hide other accordion headers
    }
  });

  backButton.on('click', function() {
    categoryTitle.text("ALL CATEGORIES"); // Reset the category title to "ALL CATEGORIES"

    // Reset accordion state
    accordionHeaders.css({
      'transform': '',
      'display': '',
      'padding': '',
      'height': '',
      'opacity': ''
    }).removeClass('show');

    accordionContents.hide();

    backButton.css('display', 'none');
    allCategoriesHeader.css('display', 'block');
  });
}); 
</script>
  <script>
function showlogin(){
  $("#pills-signup-tab").removeClass("active");
  $("#pills-signup").hide();
  $("#pills-signin-tab").addClass("active");
  $("#pills-signin").show();
  $("#pills-forgotpass-tab").removeClass("active");
  $("#pills-forgotpass").hide();
}

function showregister(){
  $("#pills-signin-tab").removeClass("active");
  $("#pills-signin").hide();
  $("#pills-signup-tab").addClass("active");
  $("#pills-signup").show();
  $("#pills-forgotpass-tab").removeClass("active");
  $("#pills-forgotpass").hide();
}

function fogotpass(){
  $("#pills-signin-tab").removeClass("active");
  $("#pills-signin").hide();
  $("#pills-forgotpass-tab").addClass("active");
  $("#pills-forgotpass").show();
  $("#logintitle").html("Forgot Password");
}

$('#loginsubmit').click(function(){
  var email = $("#logemail").val().trim();
  $("#errormessage").html("");
  if(email == ""){
    $("#errormessage").html("Please enter Email or Mobile No");
    $("#logemail").focus();
  }else if($("#logpassword").val().trim() == ""){
    $("#errormessage").html("Please enter Password");
    $("#logpassword").focus();
  }else{
    var email = $("#logemail").val().trim();
    var password = $("#logpassword").val().trim();
    $.ajax({
      url: "{{url('/checkLogin')}}",
      type: "POST",
      data: {
        email: email,
        password: password,
        _token: '{{csrf_token()}}'
      },
      dataType: 'json',
      success: function (result) {
        if(result.status == "fail"){
          $("#errormessage").html("IInvalid Login Credentials");
        }else if(result.status == "success"){
          window.location.href = "{{ url('user/dashboard') }}";
        }
      },
      error: function (error) {  
        console.log(JSON.stringify(error));
      }
    });
  }
});

$('#regsubmit').click(function(){
  var pattern = /^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i
  var email = $("#selleremail").val().trim();
  $("#reqname").html("");
  $("#reqemail").html("");
  $("#reqpassword").html("");
  $("#reqphone").html("");
  $("#reqplan").html("");
  if($("#sellername").val().trim() == ""){
    $("#reqname").html("Please enter Full Name");
    $("#sellername").focus();
  }else if(email == ""){
    $("#reqemail").html("Please enter email");
    $("#selleremail").focus();
  }else if(!pattern.test(email)){
    $("#reqemail").html("Invalid email address");
    $("#selleremail").focus();
  }else if($("#sellerpassword").val().trim() == ""){
    $("#reqpassword").html("Please enter password");
    $("#sellerpassword").focus();
  }else if($("#sellerphone").val().trim() == ""){
    $("#reqphone").html("Please enter mobile no");
    $("#sellerphone").focus();
  }else{
    
    var mobile = $("#sellerphone").val().trim();
    var name = $("#sellername").val().trim();
    var password = $("#sellerpassword").val().trim();
    $.ajax({
      url: "{{url('/buyerregistermobile')}}",
      type: "POST",
      data: {
        email: email,
        mobile: mobile,
        name: name,
        password: password,
        _token: '{{csrf_token()}}'
      },
      dataType: 'json',
      success: function (result) {
        if(result.status == "fail" && result.status_type == "1"){
          $("#reqemail").html(result.message);
        }else if(result.status == "fail" && result.status_type == "2"){
          $("#reqphone").html(result.message);
        }else if(result.status == "fail" && result.status_type == "3"){
          $("#reqotp").html(result.message);
        }else if(result.status == "success" && result.status_type == "2"){
          window.location.href = "{{ url('/user/dashboard') }}";
        }
      },
      error: function (error) {  
                //console.log(JSON.stringify(error));
              }
            });
  }
});

$('.number').keypress(function(event) {
    var keycode = event.which;
    if (!(event.shiftKey == false && (keycode == 8 || keycode == 37 || keycode == 39 || (keycode >=
      48 && keycode <= 57)))) {
      event.preventDefault();
  }
});
</script>
  
 {{-- function showlogin(){
    $("#pills-signup-tab").removeClass("active");
    $("#pills-signup").hide();
    $("#pills-signin-tab").addClass("active");
    $("#pills-signin").show();
    $("#pills-forgotpass-tab").removeClass("active");
    $("#pills-forgotpass").hide();
  }

  function showregister(){
    $("#pills-signin-tab").removeClass("active");
    $("#pills-signin").hide();
    $("#pills-signup-tab").addClass("active");
    $("#pills-signup").show();
    $("#pills-forgotpass-tab").removeClass("active");
    $("#pills-forgotpass").hide();
  }

  function fogotpass(){
    $("#pills-signin-tab").removeClass("active");
    $("#pills-signin").hide();
    $("#pills-forgotpass-tab").addClass("active");
    $("#pills-forgotpass").show();
    $("#logintitle").html("Forgot Password");
  }

  function sendotp(){
    if($("#forphone").val().trim() == ""){
      $("#lforphone").html("Please enter mobile no");
      $("#forphone").focus();
    }else{
      var mobile = $("#forphone").val().trim();
      $.ajax({
          url: "{{ url('/forgotpassotp') }}/"+mobile,
          type: "GET",
          dataType: 'json',
          success: function (result) {
              if(result.status == "fail" && result.status_type == "1"){
                  $("#lforphone").html(result.message);
              }else if(result.status == "success" && result.status_type == "1"){
                  $("#forgotpassdiv").hide();
                  $("#forgototpdiv").show();
              }
          },
          error: function (error) {  
            console.log(JSON.stringify(error));
          }
      });
    }
  }

  function changepassword(){
    $("#lotplabel").html("");
    $("#lpasslabel").html("");
    $("#lconpasslabel").html("");
    var mobile = $("#forphone").val().trim();
    var password = $("#forpass").val().trim();
    var conpassword = $("#forconpass").val().trim();
    if($("#lotp1").val().trim() == ""){
      $("#lotplabel").html("Please enter OTP");
    }else if($("#lotp2").val().trim() == ""){
      $("#lotplabel").html("Please enter OTP");
    }else if($("#lotp3").val().trim() == ""){
      $("#lotplabel").html("Please enter OTP");
    }else if($("#lotp4").val().trim() == ""){
      $("#lotplabel").html("Please enter OTP");
    }else if(password == ""){
      $("#lpasslabel").html("Please enter password");
    }else if(conpassword == ""){
      $("#lconpasslabel").html("Please enter confirm password");
    }else if(password != conpassword){
      $("#lconpasslabel").html("Passwords does not match");
    }else{
      var otp = $("#lotp1").val()+$("#lotp2").val()+$("#lotp3").val()+$("#lotp4").val();
      $.ajax({
        url: "{{url('/changepassword')}}",
        type: "POST",
        data: {
        otp: otp,
        mobile: mobile,
        password: password,
        conpassword: conpassword,
        _token: '{{csrf_token()}}'
        },
        dataType: 'json',
        success: function (result) {
        console.log(JSON.stringify(result));
        if(result.status == "fail" && result.status_type == "1"){
            $("#lotplabel").html(result.message);
        }else if(result.status == "success" && result.status_type == "1"){
            window.location.href = '/user/dashboard';
        }
      },
      error: function (error) {  
        console.log(JSON.stringify(error));
      }
      });
    }
  }

  $('#loginsubmit').click(function(){
    var email = $("#logemail").val().trim();
    $("#errormessage").html("");
    if(email == ""){
      $("#errormessage").html("Please enter Email or Mobile No");
      $("#logemail").focus();
    }else if($("#logpassword").val().trim() == ""){
      $("#errormessage").html("Please enter Password");
      $("#logpassword").focus();
    }else{
      var email = $("#logemail").val().trim();
      var password = $("#logpassword").val().trim();
      $.ajax({
        url: "{{url('/checkLogin')}}",
        type: "POST",
        data: {
          email: email,
          password: password,
          _token: '{{csrf_token()}}'
        },
        dataType: 'json',
        success: function (result) {
          if(result.status == "fail"){
            $("#errormessage").html("IInvalid Login Credentials");
          }else if(result.status == "success"){
            window.location.href = "{{ url('user/dashboard') }}";
          }
        },
        error: function (error) {  
          console.log(JSON.stringify(error));
        }
      });
    }
  });

  $('#regsubmit').click(function(){
    var pattern = /^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i
    var email = $("#selleremail").val().trim();
    $("#reqname").html("");
    $("#reqemail").html("");
    $("#reqpassword").html("");
    $("#reqphone").html("");
    $("#reqplan").html("");
    if($("#sellername").val().trim() == ""){
      $("#reqname").html("Please enter Full Name");
      $("#sellername").focus();
    }else if(email == ""){
      $("#reqemail").html("Please enter email");
      $("#selleremail").focus();
    }else if(!pattern.test(email)){
      $("#reqemail").html("Invalid email address");
      $("#selleremail").focus();
    }else if($("#sellerpassword").val().trim() == ""){
      $("#reqpassword").html("Please enter password");
      $("#sellerpassword").focus();
    }else if($("#sellerphone").val().trim() == ""){
      $("#reqphone").html("Please enter mobile no");
      $("#sellerphone").focus();
    }else{
      
      var mobile = $("#sellerphone").val().trim();
      var name = $("#sellername").val().trim();
      var password = $("#sellerpassword").val().trim();
      var otpgenerated = $("#otpgenerated").val().trim();
      var otp = "";
      if(otpgenerated == 1){
        otp = $("#otp1").val()+$("#otp2").val()+$("#otp3").val()+$("#otp4").val();
      }
      $.ajax({
        url: "{{url('/generateotp')}}",
        type: "POST",
        data: {
          email: email,
          mobile: mobile,
          name: name,
          password: password,
          otpgenerated: otpgenerated,
          otp: otp,
          _token: '{{csrf_token()}}'
        },
        dataType: 'json',
        success: function (result) {
          if(result.status == "fail" && result.status_type == "1"){
            $("#reqemail").html(result.message);
          }else if(result.status == "fail" && result.status_type == "2"){
            $("#reqphone").html(result.message);
          }else if(result.status == "fail" && result.status_type == "3"){
            $("#reqotp").html(result.message);
          }else if(result.status == "success" && result.status_type == "1"){
            $("#otpdiv").show();
            $("#selleremail").attr("readonly",true);
            $("#sellerphone").attr("readonly",true);
            $("#otpgenerated").val("1");
            $("#otp1").focus();
          }else if(result.status == "success" && result.status_type == "2"){
            window.location.href = '/user/dashboard';
          }
        },
        error: function (error) {  
                  //console.log(JSON.stringify(error));
                }
              });
    }
  });

  $(".inputs").keyup(function () {
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


  function load_addresstop(lat2,lng2){
    $.getJSON("https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat="+lat2+"&lon="+lng2, function(data){
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

  function nearby(){
    var lat = $("#latitudetop").val();
    var lng = $("#longitudetop").val();
    window.location.href = "{{ url('/nearby') }}/"+lat+"/"+lng;
  }

  function showLocationtop(position) {
    var latitude = position.coords.latitude;
    var longitude = position.coords.longitude;
    load_addresstop(latitude,longitude);
  }

  function errorHandlertop(err) {
    if(err.code == 1) {
      //alert("Error: Access is denied!");
    } else if( err.code == 2) {
      alert("Error: Position is unavailable!");
    }
  }

  function getcurrentLocationtop() {
    if(navigator.geolocation) {
      var options = {timeout:60000};
      navigator.geolocation.getCurrentPosition(showLocationtop, errorHandlertop, options);
    } else {
      alert("Sorry, browser does not support geolocation!");
    }
  }

  jQuery(document).ready(function($) {
    getcurrentLocationtop();
  });

  function showselectmap(){
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
    google.maps.event.addListener(map, "click", function (event) {
      var myLatLng = event.latLng;
      lat = myLatLng.lat();
      console.log("here"+lat);
      lng = myLatLng.lng();
    });
  }

  function closeshowselectmap(){
    $("#myMapModaltop").modal('hide');
  }

  function confirmshowselectmap() {
    load_addresstop(lat,lng);
    $("#myMapModaltop").modal('hide');
  }

  $('#myMapModaltop').on('shown.bs.modal', function(e) {
    var lat3 = $("#latitudetop").val();
    var lng3 = $("#longitudetop").val();
    initialize(new google.maps.LatLng(lat3,lng3));
  });

  function addfavorites(obj,user_id,product_id){
    var url = "";
    if($(obj).hasClass("btn-danger")){
      url = "{{url('/removefavorites')}}/"+user_id+"/"+product_id;
    }else{
      url = "{{url('/addfavorites')}}/"+user_id+"/"+product_id;
    }
    $.ajax({
      url: url,
      type: "GET",
      success: function (result) {
        if($(obj).hasClass("btn-danger")){
          $(obj).removeClass("btn-danger");
          $(obj).parent().removeClass("btn-danger");
          $(obj).addClass("btn-warning");
          $(obj).parent().addClass("btn-warning");
        }else{
          $(obj).removeClass("btn-warning");
          $(obj).parent().removeClass("btn-warning");
          $(obj).addClass("btn-danger");
          $(obj).parent().addClass("btn-danger");
        }
      },
      error: function (error) {  
        console.log(JSON.stringify(error));
      }
    });
  }

</script> --}}

</body>
</html>
