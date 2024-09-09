@extends('mobile/layouts.use_other_app')
@section('mobile/content')
<div class="page-content-wrapper py-3">
	<div class="container">
		<div class="card user-data-card">
			<div class="card-header">
				<h5 class="mb-1 text-center">Edit Product</h5>
			</div>

			<section class="gray-simple">
				<div class="container-fluid">


					<div class="row">

						<div class="col-lg-9 col-md-12">

							<div class="dashboard-wraper">

								<div class="row">

									<!-- Submit Form -->
									<div class="col-lg-12 col-md-12">

										<div class="submit-pages">
											<form action="{{ url('/updateproduct') }}" method="post" enctype="multipart/form-data" >
												{{ csrf_field() }}
												<input type="hidden" name="product_id" value="{{ $products->id }}">
												<div class="form-submit">	
													<div class="submit-section">
														<div class="row">
															<div class="form-group col-md-6">
																<label><span style="color:red">*</span>Category</label>
																<select disabled="disabled" name="cat_id" id="cat_id" required="required" class="form-control">
																	<option value="">Select Category</option>
																	@foreach($category as $cat)
																	<option @if($cat_id == $cat["id"]) selected @endif value="{{ $cat['id'] }}">{{ $cat["category_name"] }}</option>
																	@endforeach
																</select>
															</div>
															<div class="form-group col-md-6">
																<label><span style="color:red">*</span>Sub Category</label>
																<select disabled="disabled" name="sub_cat_id" id="sub_cat_id" required="required" class="form-control">
																	<option value="">Select Subcategory</option>
																	@foreach($sub_category as $cat)
																	<option @if($sub_cat_id == $cat->id) selected @endif value="{{ $cat->id }}">{{ $cat->category_name }}</option>
																	@endforeach
																</select>
															</div>
															<div class="form-group col-md-6">
																<label><span style="color:red">*</span>Title</label>
																<input value="{{ $products->product_name }}" required="required" name="product_name" maxlength="100" type="text" class="form-control">
															</div>

															<div class="form-group col-md-6">
																<label><span style="color:red">*</span>Price</label>
																<input value="{{ $products->price }}" required="required" name="price" type="text" class="form-control number" maxlength="8" >
															</div>

															<div class="form-group col-md-12">
																<label><span style="color:red">*</span>Description</label>
																<textarea required="required" rows="4" name="description" maxlength="5000" class="form-control">{{ $products->description }}</textarea>
															</div>

															<div class="row" id="attrdiv">
																@foreach($attrs as $att)
																@php
																if($att->attr_type != "checkbox"){
																	$name = "attr_".$att->id;
																}else{
																	$name = "attr_check_".$att->id;
																}
																$option = "";
																if($att->attr_type == "dropdown"){
																	$option = "<select name='".$name."' class='form-control'>";
																	$option = $option . "<option value=''>Select</option>";	
																	$myarray = explode(",",$att->attr_value);
																	foreach($myarray as $myval){
																		$option = $option . "<option ";
																		if($att->attr_value2 == $myval) $option = $option . " selected ";
																		$option = $option . " value='".$myval."'>".$myval."</option>";
																	}
																	$option = $option . "</select>";
																}
																if($att->attr_type == "checkbox"){
																	$myarray2 = explode(",",$att->attr_value2);
																	$myarray = explode(",",$att->attr_value);
																	 $label = "<label> $att->attr_name </label>";
																	foreach($myarray as $myval){
																		$option = $option .  " <label class='checkbox-inline' ><input name='".$name."[]' type='checkbox' ";
																		if(in_array($myval,$myarray2)){
																			$option = $option . " checked ";
																		}
																		$option = $option . " value='".$myval."' />".$myval."</label>";
																	}
																	$option = $label . " : " . $option;
																}

																if($att->attr_type == "radio"){
																	$myarray2 = explode(",",$att->attr_value2);
																	$myarray = explode(",",$att->attr_value);
																	 $label = "<label> $att->attr_name </label>";
																	foreach($myarray as $myval){
																		$option = $option .  " <label class='checkbox-inline' ><input name='".$name."' type='radio' ";
																		if(in_array($myval,$myarray2)){
																			$option = $option . " checked ";
																		}
																		$option = $option . " value='".$myval."' />".$myval."</label>";
																	}
																	$option = $label . " : " . $option;
																}

														@endphp
														@if($att->attr_type == "text")
														<div class='form-group col-md-6'><label>{{ $att->attr_name }}</label><input name='{{ $name }}' value="{{ $att->attr_value2 }}" type='text' maxlength='100' class='form-control'  /></div>
														@elseif($att->attr_type == "date")
														<div class='form-group col-md-6'><label>{{ $att->attr_name }}</label><input name='{{ $name }}' value="{{ $att->attr_value2 }}" type='date' onkeyup='return false' class='form-control'  /></div>
														@elseif($att->attr_type == "textarea")
														<div class='form-group col-md-6'><label>{{ $att->attr_name }}</label><textarea name='{{ $name }}' maxlength='500' class='form-control' >{{ $att->attr_value2 }}</textarea></div>
														@elseif($att->attr_type == "dropdown")
														<div class='form-group col-md-6'><label>{{ $att->attr_name }}</label><div>@php echo $option; @endphp</div></div>
														@elseif($att->attr_type == "checkbox" || $att->attr_type == "radio")
														<div class='form-group col-md-12'>@php echo $option; @endphp</div>
														@endif
														@endforeach
													</div>

													<div class="row">
														<div class="form-group col-md-12">
															<div class="single-setting-panel">
																<div class="form-check form-switch mb-2">
																	<input @if($products->current_location == 1) checked @endif class="form-check-input" name="current_location" id="current_location" type="checkbox" value="1" data-toggle="toggle" data-on="Current Location" data-off="Choose Location" data-width="200" data-height="25" data-onstyle="success" data-offstyle="danger">
																	<label class="form-check-label" for="current_location">Current Location</label>
																</div>
															</div>
														</div>	
													</div>
													<div class="row" id="showdiv1" @if($products->current_location == 1) style="display: none;" @endif>
														<div class="form-group col-md-6">
															<label><span style="color:red">*</span>State</label>
															<select name="state_id" id="state_id" required="required" class="form-control">
																<option value="">Select State</option>
																@foreach($states as $state)
																<option @if($products->state_id == $state->name) selected @endif value="{{ $state->name }}">{{ $state->name }}</option>
																@endforeach
															</select>
														</div>
														<div class="form-group col-md-6">
															<label><span style="color:red">*</span>Sub City</label>
															<select name="city_id" id="city_id" required="required" class="form-control">
																<option value="">Select City</option>
																@foreach($cities as $city)
																<option @if($products->city_id == $city->city) selected @endif value="{{ $city->city }}">{{ $city->city }}</option>
																@endforeach
															</select>
														</div>
														<div class="form-group col-md-6">
															<label><span style="color:red">*</span>Address</label>
															<textarea required="required" name="address" id="address" class="form-control">{{ $products->address }}</textarea>
														</div>
														<div class="col-md-3">
															<label>&nbsp;</label>
															<button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#myMapModal">Choose Location</button>
														</div>
														<div class="col-md-3"></div>
													</div>


													<div class="row" id="showdiv2" @if($products->current_location == 0) style="display: none;" @endif >	
														<div class="form-group col-md-6">
															<label><span style="color:red">*</span>Address</label>
															<textarea  name="address2" id="address2" class="form-control">{{ $products->address }}</textarea>
														</div>
					 									<div class="form-group col-md-3">
															<label>&nbsp;</label>
															<button type="button" onclick="getcurrentLocation()" class="btn btn-primary btn-sm btn-block ">Get Current Location</button>
														</div>	
														<div class="col-md-3"></div>
													</div>

													<div class="row">
														<div class="form-group col-md-12">
															<input readonly="readonly" name="location" id="location2" type="hidden" class="form-control" >
														</div>
													</div>
													<div class="col-md-3">
														<label>Status</label>
														<select name="status" class="form-control">
															<option @if($products->status=="Active") selected @endif value="Active">Active</option>
															<option @if($products->status=="Inactive") selected @endif value="Inactive">Inactive</option>
															<option @if($products->status=="Sold") selected @endif value="Sold">Sold</option>
														</select>
													</div>
												</div>
											</div>
										</div>
 


										<div class="row">
											<div class="col-md-6">
												<label>Photo</label>
									            <input class="form-control" accept="image/png, image/jpeg" id="photo" name="photo[]" type="file" multiple="multiple" />
											</div>
										</div>

										<div class="row">
											@foreach($product_photos as $photo)
											<div class="col-md-3">
												<img style="margin: 10px 10px 10px 10px;" src="{{ URL::to('/') }}/uploads/products/{{ $photo->photo }}" width="100" height="75">
												@if(count($product_photos) > 1)
												<a onclick="return confirm('Do you want to Confirm delete operation?')"	href="{{ url('/removeimage', $photo->id) }}" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></a>
												@endif
											</div>
											@endforeach
										</div>

										<div class="row">
											<div class="col-md-12">&nbsp;</div>
										</div>

										<div class="form-group col-lg-12 col-md-12 text-center">
											<input class="btn btn-success" type="submit" value="Update" />
										</div>
									</form>

								</div>
							</div>

						</div>

					</div>
				</div>

			</div>
		</div>
	</section>
</div>
</div>
<div class="modal fade" id="myMapModal" tabindex="-1" aria-labelledby="fullscreenModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-fullscreen-md-down">
			<div class="modal-content">
				<div class="modal-header">
					<h6 class="modal-title" id="fullscreenModalLabel">Choose Location</h6>
					<button class="btn btn-close p-1 ms-auto" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
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
</div>
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
</div>
@endsection

