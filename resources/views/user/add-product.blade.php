@extends('layouts.other_app')
@section('content')
<style>
.g-height-50 {
  height: 50px;
}

.g-width-50 {
  width: 50px !important;
}

@media (min-width: 0){
  .g-pa-30 {
    padding: 2.14286rem !important;
  }
}

.g-bg-secondary {
  background-color: #fafafa !important;
}

.u-shadow-v18 {
  box-shadow: 0 5px 10px -6px rgba(0, 0, 0, 0.15);
}

.g-color-gray-dark-v4 {
  color: #777 !important;
}

.g-font-size-12 {
  font-size: 0.85714rem !important;
}

.media-comment {
  margin-top:20px
}
.singleImageCanvasContainer{
  overflow: hidden;
  height: 200px;
  width: 30%;
  display: inline-block;
  position: relative;
  padding-right: 0px;
  margin-right: 15px;
  border: 2px solid #dfdfdf;
  margin-bottom: 10px;
  padding: 4px;
  border-radius: .25rem;
}

.singleImageCanvasContainer .singleImageCanvasCloseBtn{
  position: absolute;
  right: 0;
}
.singleImageCanvasContainer .singleImageCanvas{
  width: 100%;
  height: 100%;
  object-fit: cover;
}
</style>
<section class="gray-simple">
	<div class="container">
		<div class="row">

			@include('user.user-menu')

			<div class="col-lg-9 col-md-12">

				<div class="dashboard-wraper">

					<div class="row">

						<!-- Submit Form -->
						<div class="col-lg-12 col-md-12">

							<div class="submit-pages">
								<form action="{{ url('/saveproduct') }}" method="post" enctype="multipart/form-data" >
									{{ csrf_field() }}
									<div class="form-submit">	
										<h3>Add Product</h3>
										<div class="submit-section">
											<div class="row">
												<div class="form-group col-md-6">
													<label><span style="color:red">*</span>Category</label>
													<select name="cat_id" id="cat_id" required="required" class="form-control">
														<option value="">Select Category</option>
														@foreach($category as $cat)
														<option value="{{ $cat['id'] }}">{{ $cat["category_name"] }}</option>
														@endforeach
													</select>
												</div>
												<div class="form-group col-md-6">
													<label><span style="color:red">*</span>Sub Category</label>
													<select name="sub_cat_id" id="sub_cat_id" required="required" class="form-control">
														<option value="">Select Subcategory</option>
													</select>
												</div>
												<div class="form-group col-md-6">
													<label><span style="color:red">*</span>Title</label>
													<input required="required" name="product_name" maxlength="50" type="text" class="form-control" id="title_add">
												</div>

												<div class="form-group col-md-6">
													<label><span style="color:red">*</span>Price</label>
													<input required="required" name="price" type="text" class="form-control number" maxlength="8" >
												</div>

												
												<div class="form-group col-md-6">
													<label><span style="color:red">*</span>Quantity</label>
													<input required="required" name="quantity" type="text" class="form-control" maxlength="100" >
												</div>

													<div class="form-group col-md-6">
														<label>Payment Method<span style="color:red">*</span></label>
														<select name="payment_method" id="payment_method" required="required" class="form-control">
															<option value="">Select Pyment</option>
															 @foreach($payment as $key=>$pay)
															<option value="{{ $pay->id }}">{{ $pay->payment_name }}</option>
															@endforeach
														</select>
													</div>
												</div>

												<div class="form-group col-md-12">
													<label>Photo<span style="color:red">*</span></label>
													<input type="hidden" id="post_img_data" name="image_data_url">
													<input class="form-control" required="required" accept="image/png, image/jpeg" name="photo[]" type="file" multiple="multiple" />
												</div>
											</div>
												
												<div class="form-group col-md-12">
													<label><span style="color:red">*</span>Description</label>
													<textarea rows="2" required="required" name="description" maxlength="5000" class="form-control"></textarea>
												</div>
											</div>
										</div>
									</div>

									<div class="row" id="attrdiv">
									</div>

									<div class="row">
										<div class="col-md-12">&nbsp;</div>
									</div>

									{{-- <div class="row">
										<div class="form-group col-md-12">
											<input name="current_location" id="current_location" type="checkbox" value="1" data-toggle="toggle" data-on="Current Location" data-off="Choose Location" data-width="200" data-height="25" data-onstyle="success" data-offstyle="danger">
										</div>	
									</div> --}}

									{{-- <div class="row" id="showdiv1">
										<div class="form-group col-md-6">
											<label><span style="color:red">*</span>State</label>
											<select name="state_id" id="state_id" required="required" class="form-control">
												<option value="">Select State</option>
												@foreach($states as $state)
												<option @if($state->id == 21) selected @endif value="{{ $state->name }}">{{ $state->name }}</option>
												@endforeach
											</select>
										</div>
										<div class="form-group col-md-6">
											<label><span style="color:red">*</span>City</label>
											<select name="city_id" id="city_id" required="required" class="form-control">
												<option value="">Select City</option>
												@foreach($cities as $city)
												<option @if($city->id == 476) selected @endif value="{{ $city->city }}">{{ $city->city }}</option>
												@endforeach
											</select>
										</div>
										
										<div class="form-group col-md-6">
											<label><span style="color:red"></span>Description</label>
											<textarea rows="2" required="required" name="description" id="description" class="form-control"></textarea>
										</div>	
										<div class="col-md-3">
											<label>&nbsp;</label>
											<button type="button" class="btn btn-primary btn-sm btn-block"  data-toggle="modal" data-target="#myMapModal" >Choose Location</button>
										</div>
										<div class="col-md-3"></div>
									</div> --}}
									{{-- <div class="row" id="showdiv2" style="display: none;">
										<div class="form-group col-md-6">
											<label><span style="color:red">*</span>Address</label>
											<textarea  name="address2" id="address2" class="form-control"></textarea>
										</div>
										<div class="form-group col-md-3">
											<label>&nbsp;</label>
											<button type="button" onclick="getcurrentLocation()" class="btn btn-primary btn-sm btn-block ">Get Current Location</button>
										</div>	
										<div class="col-md-3"></div>
									</div> --}}

									{{-- <div class="row">
										<div class="form-group col-md-12">
											<input readonly="readonly" name="location" id="location2" type="hidden" class="form-control" >
										</div>
									</div> --}}

									
									<div class="row">
										<div class="col-md-12">&nbsp;</div>
									</div>

									<div class="form-group col-lg-12 col-md-12 text-center">
										<input class="btn btn-success" type="submit" value="Submit" />
									</div>
								</form>

							</div>
							
						</div>

					</div>

				</div>
			</div>
		</div>
	</div>
	</div>


</section>

<div class="modal fade" id="cropperModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Crop</h4>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
        </div>
          
          <div class="modal-body p-4">
            <div class="img-preview"></div>
            <div id="galleryImages"></div>
            <div id="cropper">
              <canvas id="cropperImg" width="0" height="0"></canvas>
              <button type="button" class="cropImageBtn btn btn-danger" style="display:none;" id="cropImageBtn">Crop</button>
            </div>
            <div id="imageValidate" class="text-danger"></div>
          </div>
          <div class="modal-footer">
				<button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
			</div>
      </div>
    </div>
  </div>

<div class="modal fade" id="myMapModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Click on a location and confirm</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div id="map-canvas" style="height: 300px;"></div>
			</div>
			<div class="modal-footer">
				<button id="confirm_btn" onclick="get_location()" type="button" class="btn btn-primary" data-dismiss="modal">Confirm</button>
				<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>



@endsection

@push('page_scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.5/cropper.min.js" integrity="sha512-E4KfIuQAc9ZX6zW1IUJROqxrBqJXPuEcDKP6XesMdu2OV4LW7pj8+gkkyx2y646xEV7yxocPbaTtk2LQIJewXw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.5/cropper.min.css" integrity="sha512-Aix44jXZerxlqPbbSLJ03lEsUch9H/CmnNfWxShD6vJBbboR+rPdDXmKN+/QjISWT80D4wMjtM4Kx7+xkLVywQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script>
	
	var district2 = "";

	$('#current_location').on('change',function(){
		if($('#current_location').is(":checked")){
			$("#showdiv1").hide('slow');
			$("#showdiv2").show('slow');
		}else{
			$("#showdiv2").hide('slow');
			$("#showdiv1").show('slow');
		}
	});

	$('#cat_id').on('change',function(){
		var cat_id = this.value;
		$("#sub_cat_id").html('');
		$.ajax({
			url: "{{url('/getsubcategory')}}",
			type: "POST",
			data: {
				cat_id: cat_id,
				_token: '{{csrf_token()}}'
			},
			dataType: 'json',
			success: function (result) {
				$('#sub_cat_id').html('<option value="">Select Sub Category</option>');
				$.each(result, function (key, value) {
					$("#sub_cat_id").append('<option value="' + value
						.id + '">' + value.category_name + '</option>');
				});
			}   
		});
	});

	$('#state_id').on('change',function(){
		var state_id = this.value;
		load_city(state_id);
	});

	function load_city(state_id){
		$("#city_id").html('');
		$.ajax({
			url: "{{url('/getcity')}}",
			type: "POST",
			data: {
				state_id: state_id,
				_token: '{{csrf_token()}}'
			},
			dataType: 'json',
			success: function (result) {
				$('#city_id').html('<option value="">Select City</option>');
				$.each(result, function (key, value) {
					$("#city_id").append('<option value="' + value
						.city + '">' + value.city + '</option>');
				});
				$("#city_id").val(district2);
			}   
		});
	}

	$('#sub_cat_id').on('change',function(){
		var cat_id = $("#cat_id").val();
		var sub_cat_id = this.value;
		$("#attrdiv").html('');
		$.ajax({
			url: "{{url('/getattributes')}}",
			type: "POST",
			data: {
				cat_id: cat_id,
				sub_cat_id: sub_cat_id,
				_token: '{{csrf_token()}}'
			},
			dataType: 'json',
			success: function (result) {
				for (let i = 0; i < result.length; i++) {
					value = result[i];	
					if(value.attr_type == "checkbox"){
						name = "attr_check_"+result[i].id;
					}else{
						name = "attr_"+result[i].id;
					}

					if(value.attr_type == "text"){
						$("#attrdiv").append("<div class='form-group col-md-6'><label>"+value.attr_name+"</label><input name='"+name+"' type='text' maxlength='100' class='form-control'  /></div>");
					}else if(value.attr_type == "date"){
						$("#attrdiv").append("<div class='form-group col-md-6'><label>"+value.attr_name+"</label><input name='"+name+"' onkeyup='return false' type='date'  class='form-control'  /></div>");
					}else if(value.attr_type == "textarea"){
						$("#attrdiv").append("<div class='form-group col-md-6'><label>"+value.attr_name+"</label><textarea name='"+name+"' maxlength='500' class='form-control' ></textarea></div>");
					}else if(value.attr_type == "dropdown"){
						option = "<option value=''>Select</option>";	
						myArray = value.attr_value.split(",");
						let j = 0;
						while (j < myArray.length) {
							option = option + "<option value='"+myArray[j]+"' >"+myArray[j]+"</option>";
							j++;
						}
						$("#attrdiv").append("<div class='form-group col-md-6'><label>"+value.attr_name+"</label><select name='"+name+"' class='form-control'>"+option+"</select></div>");
					}else if(value.attr_type == "checkbox"){
						option = "";
						myArray = value.attr_value.split(",");
						let j = 0;
						option = "<label>"+value.attr_name+"&nbsp;</label>";
						while (j < myArray.length) {
							option = option + "<label class='checkbox-inline' ><input name='"+name +"[]' type='checkbox' value='"+myArray[j]+"' />&nbsp;"+myArray[j].toString()+"&nbsp;</label>";
							j++;
						}
						$("#attrdiv").append("<div class='col-md-12'>"+option +"</div>");
					}
				}
			},
			error: function (result) { 
				console.log(result);
			}  
		});
	});

	/*$('#file').on('change', function() {
		oFiles = this.files,
		nFiles = oFiles.length;
		if(nFiles == 0) return;
		for (var nFileId = 0; nFileId < nFiles; nFileId++) {
			fileSize = oFiles[nFileId].size / 1024 / 1024; 
			if (fileSize > 10) {
				alert('File size exceeds 10 MB');
				$('#photo').val(''); 
				return;
			}
		}
	});*/

	$('#myMapModal').on('shown.bs.modal', function(e) {
		$("#confirm_btn").attr("disabled", true);
		var location = "";
		location = $("#location2").val();
		if(location == ""){
			initialize(new google.maps.LatLng("8.18680451929113","77.41143559463588"));
		}else{
			var data = location.split(',')
			initialize(new google.maps.LatLng(data[0], data[1]));
		}
	});

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
		map = new google.maps.Map(document.getElementById("map-canvas"), mapProp);
		marker.setMap(map);
		google.maps.event.addListener(map, "click", function (event) {
			var myLatLng = event.latLng;
			lat = myLatLng.lat();
			lng = myLatLng.lng();
			$("#confirm_btn").removeAttr("disabled");
		});
	}

	function load_address(lat2,lng2){
		console.log(lat2);
		$.getJSON("https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat="+lat2+"&lon="+lng2, function(data){
			console.log(data.address);
			district2 = data.address.state_district;
			district2 = district2.replace(" District", "");
			state2 = data.address.state;
			state2 = state2.toUpperCase();
			postcode2 = data.address.postcode;
			formattedAddress = '';
			if (data.address.road != undefined) {
				formattedAddress += data.address.road + ' ';
			}
			if (data.address.neighbourhood != undefined) {
				formattedAddress += data.address.neighbourhood + ' ';
			}
			if (data.address.suburb != undefined) {
				formattedAddress += data.address.suburb + ' ';
			}
			if (data.address.city != undefined) {
				formattedAddress += data.address.city + ' ';
			}
			if (data.address.state != undefined) {
				formattedAddress += data.address.state + ' ';
			}
			if (data.address.postcode != undefined) {
				formattedAddress += data.address.postcode + ' ';
			}
			if (data.address.country != undefined) {
				formattedAddress += data.address.country + ' ';
			}
			$("#address").val(formattedAddress);
			$("#address2").val(formattedAddress);
			$("#state_id").val(state2);
			load_city(state2);
		});
	}

	function get_location(){
		if(lat != "") $("#location2").val(lat+","+lng);
		load_address(lat,lng);
	}

	function showPosition(position) {
		var latitude = position.coords.latitude;
		var longitude = position.coords.longitude;
		$("#location2").val(latitude+","+longitude);
		load_address(latitude,longitude);
	}


	function getcurrentLocation() {
		if(navigator.geolocation) {
			navigator.geolocation.getCurrentPosition(showPosition);
		} else {
			alert("Sorry, browser does not support geolocation!");
		}
	}

	$(document).ready(function(){
      $("body").on("change", "#file", function(e){
        $('.singleImageCanvasContainer').remove();
        $('#post_img_data').val('');
      });
    })

	$('#title_add').on('keypress', function(event) {
        let keyPressed = event.keyCode || event.which;
         if (keyPressed == 92 || keyPressed == 32) {
            event.preventDefault();
            return false;
        } 

    });


    var c;
    var galleryImagesContainer = document.getElementById('galleryImages');
    var imageCropFileInput = document.getElementById('file');
    var cropperImageInitCanvas = document.getElementById('cropperImg');
    var cropImageButton = document.getElementById('cropImageBtn');
    // Crop Function On change
    function imagesPreview(input) {
      var cropper;
        //cropImageButton.className = 'show';
        var img = [];
        if (input.files.length) {
          var i = 0;
          var index = 0;
          for (let singleFile of input.files) {
            var reader = new FileReader();
            reader.onload = function(event) {
              var blobUrl = event.target.result;
              img.push(new Image());
              img[i].onload = function(e) {
                        // Canvas Container
                        var singleCanvasImageContainer = document.createElement('div');
                        singleCanvasImageContainer.id = 'singleImageCanvasContainer'+index;
                        singleCanvasImageContainer.className = 'singleImageCanvasContainer';
                        // Canvas Close Btn
                        var singleCanvasImageCloseBtn = document.createElement('button');
                        var singleCanvasImageCloseBtnText = document.createTextNode('X');
                        // var singleCanvasImageCloseBtnText = document.createElement('i');
                        // singleCanvasImageCloseBtnText.className = 'fa fa-times';
                        singleCanvasImageCloseBtn.id = 'singleImageCanvasCloseBtn'+index;
                        singleCanvasImageCloseBtn.className = 'singleImageCanvasCloseBtn';
                        singleCanvasImageCloseBtn.classList.add("btn", "btn-sm");
                        singleCanvasImageCloseBtn.onclick = function() { 
                          removeSingleCanvas(this) 
                        };
                        singleCanvasImageCloseBtn.appendChild(singleCanvasImageCloseBtnText);
                        singleCanvasImageContainer.appendChild(singleCanvasImageCloseBtn);
                        // Image Canvas
                        var canvas = document.createElement('canvas');
                        canvas.id = 'imageCanvas'+index;
                        canvas.className = 'imageCanvas singleImageCanvas';
                        canvas.width = e.currentTarget.width;
                        canvas.height = e.currentTarget.height;
                        canvas.onclick = function() { cropInit(canvas.id); };
                        singleCanvasImageContainer.appendChild(canvas)
                        // Canvas Context
                        var ctx = canvas.getContext('2d');
                        ctx.drawImage(e.currentTarget,0,0);
                        // galleryImagesContainer.append(canvas);
                        galleryImagesContainer.appendChild(singleCanvasImageContainer);
                        // while (document.querySelectorAll('.singleImageCanvas').length == input.files.length) {
                        //     var allCanvasImages = document.querySelectorAll('.singleImageCanvas')[0].getAttribute('id');
                        //     console.log(allCanvasImages);
                        //     //commented by sam
                        //     //cropInit(allCanvasImages);
                        //     break;
                        // };
                        urlConversion();
                        index++;
                      };
                      img[i].src = blobUrl;
                      i++;
                    }
                    reader.readAsDataURL(singleFile);
                  }
                }
              }

              imageCropFileInput.addEventListener("change", function(event){
                
                $('#cropperModal').modal('show');
                var mediaValidation = validatePostMedia(event.target.files);
                if(!mediaValidation){
                  var $el = $('#file');
                  $el.wrap('<form>').closest('form').get(0).reset();
                  $el.unwrap();
                  return false;
                }

                $('#mediaPreview').empty();
                $('.singleImageCanvasContainer').remove();
                if(cropperImageInitCanvas.cropper){
                  cropperImageInitCanvas.cropper.destroy();
                  cropperImageInitCanvas.width = 0;
                  cropperImageInitCanvas.height = 0;
                  cropImageButton.style.display = 'none';
                }
                imagesPreview(event.target);
              });
    // Initialize Cropper
    function cropInit(selector) {
      c = document.getElementById(selector);
      
      if(cropperImageInitCanvas.cropper){
        cropperImageInitCanvas.cropper.destroy();
      }
      var allCloseButtons = document.querySelectorAll('.singleImageCanvasCloseBtn');
      for (let element of allCloseButtons) {
        element.style.display = 'block';
      }
      c.previousSibling.style.display = 'none';
        // c.id = croppedImg;
        var ctx=c.getContext('2d');
        var imgData=ctx.getImageData(0, 0, c.width, c.height);
        var image = cropperImageInitCanvas;
        image.width = c.width;
        image.height = c.height;
        var ctx = image.getContext('2d');
        ctx.putImageData(imgData,0,0);

        cropper = new Cropper(image, {
          aspectRatio: 16/9,
          viewMode: 4,
          preview: '.img-preview',
          crop: function(event) {
            cropImageButton.style.display = 'block';
          }
        });

      }
      
      function image_crop() {
        if(cropperImageInitCanvas.cropper){
          var cropcanvas = cropperImageInitCanvas.cropper.getCroppedCanvas({
            width: 250, height: 250
          });
            // document.getElementById('cropImages').appendChild(cropcanvas);
            var ctx=cropcanvas.getContext('2d');
            var imgData=ctx.getImageData(0, 0, cropcanvas.width, cropcanvas.height);
            // var image = document.getElementById(c);
            c.width = cropcanvas.width;
            c.height = cropcanvas.height;
            var ctx = c.getContext('2d');
            ctx.putImageData(imgData,0,0);
            cropperImageInitCanvas.cropper.destroy();
            cropperImageInitCanvas.width = 0;
            cropperImageInitCanvas.height = 0;
            cropImageButton.style.display = 'none';
            var allCloseButtons = document.querySelectorAll('.singleImageCanvasCloseBtn');
            for (let element of allCloseButtons) {
              element.style.display = 'block';
            }
            urlConversion();
          } else {
            alert('Please select any Image you want to crop');
          }
        }
        cropImageButton.addEventListener("click", function(){
          image_crop();
        });
    // Image Close/Remove
    function removeSingleCanvas(selector) {
      selector.parentNode.remove();
      urlConversion();
    }
    
    function urlConversion() {
      var allImageCanvas = document.querySelectorAll('.singleImageCanvas');
      var convertedUrl = '';
      canvasLength = allImageCanvas.length;
      for (let element of allImageCanvas) {
        convertedUrl += element.toDataURL('image/jpeg');
        convertedUrl += 'img_url';
      }
      document.getElementById('post_img_data').value = convertedUrl;
    }
    function validatePostMedia(files){

      $('#imageValidate').empty();
      let err = 0;
      let ResponseTxt = '';
      if(files.length > 10){
        err += 1;
        ResponseTxt += '<p> You can select maximum 10 files. </p>';
      }
      $(files).each(function(index, file) {
        if(file.size > 10048576){
          err +=  1;
          ResponseTxt += 'File : '+file.name + ' is greater than 10MB';
        }
      });

      if(err > 0){
        $('#imageValidate').html(ResponseTxt);
        return false;
      }
      return true;
      
    }

</script>
@endpush
