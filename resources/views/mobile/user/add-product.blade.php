@extends('mobile/layouts.use_other_app')
@section('mobile/content')
    <div class="page-content-wrapper py-3">
        <div class="container">
            <div class="card user-data-card">
                <div class="card-header">
                    <h5 class="mb-1 text-center">Add Product</h5>
                </div>
                <div class="card-body">
                    <form action="{{ url('/saveproduct') }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-submit">
                            <div class="submit-section">
                                <div class="form-group">
                                    <label class="form-label" for="defaultSelect">Category</label>
                                    <select class="form-select" name="cat_id" id="cat_id"
                                        aria-label="Default select example">
                                        <option value="">Select Category</option>
                                        @foreach ($category as $cat)
                                            <option value="{{ $cat['id'] }}">{{ $cat['category_name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="defaultSelect">Sub Category</label>
                                    <select class="form-select" name="sub_cat_id" id="sub_cat_id"
                                        aria-label="Default select example" required="requiered">
                                        <option value="">Select Subcategory</option>

                                    </select>
                                </div>



                                <div class="form-group">
                                    <label><span style="color:red">*</span>Title</label>
                                    <input required="required" name="product_name" maxlength="50" type="text"
                                        class="form-control">
                                </div>

                                <div class="form-group">
                                    <label><span style="color:red">*</span>Price</label>
                                    <input required="required" name="price" type="text" class="form-control number"
                                        maxlength="8">
                                </div>

                                <div class="form-group">
                                    <label><span style="color:red">*</span>Description</label>
                                    <textarea rows="2" required="required" name="description" maxlength="5000" class="form-control"></textarea>
                                </div>

                            </div>
                        </div>

                        <div class="row" id="attrdiv">

                        </div>


                        <div class="row">
                            <div class="form-group col-md-12">
                                <div class="single-setting-panel">
                                    <div class="form-check form-switch mb-2">
                                        <input class="form-check-input" name="current_location" id="current_location"
                                            type="checkbox" value="1" data-toggle="toggle" data-on="Current Location"
                                            data-off="Choose Location" data-width="200" data-height="25"
                                            data-onstyle="success" data-offstyle="danger">
                                        <label class="form-check-label" for="current_location">Current Location</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row" id="showdiv1">
                            <div class="form-group col-md-6">
                                <label><span style="color:red">*</span>State</label>
                                <select name="state_id" id="state_id" required="required" class="form-control">
                                    <option value="">Select State</option>
                                    @foreach ($states as $state)
                                        <option @if ($state->id == 21) selected @endif
                                            value="{{ $state->name }}">{{ $state->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label><span style="color:red">*</span>City</label>
                                <select name="city_id" id="city_id" required="required" class="form-control">
                                    <option value="">Select City</option>
                                    @foreach ($cities as $city)
                                        <option @if ($city->id == 476) selected @endif
                                            value="{{ $city->city }}">{{ $city->city }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label><span style="color:red">*</span>Address</label>
                                <textarea rows="2" required="required" name="address" id="address" class="form-control"></textarea>
                            </div>

                            <div class="col-md-3">
                                <label>&nbsp;</label>
                                <button class="btn btn-primary" type="button" data-bs-toggle="modal"
                                    data-bs-target="#myMapModal">Choose Location</button>

                            </div>
                            <div class="col-md-3"></div>
                        </div>
                        <div class="row" id="showdiv2" style="display: none;">
                            <div class="form-group col-md-6">
                                <label><span style="color:red">*</span>Address</label>
                                <textarea name="address2" id="address2" class="form-control"></textarea>
                            </div>
                            <div class="form-group col-md-3">
                                <label>&nbsp;</label>
                                <button type="button" onclick="getcurrentLocation()"
                                    class="btn btn-primary btn-sm btn-block ">Get Current Location</button>
                            </div>
                            <div class="col-md-3"></div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-12">
                                <input readonly="readonly" name="location" id="location2" type="hidden"
                                    class="form-control">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <label>Photo<span style="color:red">*</span></label>
                                <input class="form-control" required="required" accept="image/png, image/jpeg"
                                    id="photo" name="photo[]" type="file" multiple="multiple" />
                            </div>
                        </div>
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
        <div class="modal fade" id="myMapModal" tabindex="-1" aria-labelledby="fullscreenModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-fullscreen-md-down">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title" id="fullscreenModalLabel">Choose Location</h6>
                        <button class="btn btn-close p-1 ms-auto" type="button" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div id="map-canvas" style="height: 300px;"></div>
                    </div>
                    <div class="modal-footer">
                        <button id="confirm_btn" onclick="get_location()" type="button" class="btn btn-primary"
                            data-dismiss="modal">Confirm</button>
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                    </div>


                </div>
            </div>
        </div>

    </div>

    </div>
@endsection
