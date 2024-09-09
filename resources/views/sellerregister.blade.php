@extends('layouts.other_app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-body">
                    <h4>Seller Registeration</h4>
                    <div class="login-form">
                        <form action="{{ url('/savesellerregister') }}" method="post">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <label id="reqname" style="color:red"></label>
                                    <div class="form-group">
                                        <div class="input-with-icon">
                                            <input type="text" name="name" value="{{ old('name') }}" id="sellername" required="required"
                                                maxlength="50" class="form-control" placeholder="Full Name">
                                            <i class="ti-user"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <label id="reqemail" style="color:red"></label>
                                    <div class="form-group">
                                        <div class="input-with-icon">
                                            <input value="{{ old('selleremail') }}" name="selleremail" id="selleremail" required="required"
                                                maxlength="50" type="email" class="form-control" placeholder="Email">
                                            <i class="ti-email"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <label id="reqpassword" style="color:red"></label>
                                    <div class="form-group">
                                        <div class="input-with-icon">
                                            <input type="password" id="sellerpassword" maxlength="20" value="{{ old('sellerpassword') }}" name="sellerpassword"
                                                required="required" class="form-control" placeholder="Password">
                                            <i class="ti-unlock"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <label id="reqphone" style="color:red"></label>
                                    <div class="form-group">
                                        <div class="input-with-icon">
                                            <input type="text" value="{{ old('sellerphone') }}" name="sellerphone" id="sellerphone" maxlength="15"
                                                required="required" class="form-control number" placeholder="Mobile No">
                                            <i class="lni-phone-handset"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6">
                                    <label id="reqphone" style="color:red"></label>
                                    <div class="form-group">
                                        <div class="input-with-icon">
                                            <select id="dist_id" class="form-control" name="dist_id" required>
                                                <option>&nbsp;</option>
                                                @foreach($district as $dist)
                                                <option value="{{ $dist->id }}">{{ $dist->district_name }}</option>
                                                @endforeach
                                            </select>
                                            <i class="lni-phone-handset"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6">
                                    <label id="reqphone" style="color:red"></label>
                                    <div class="form-group">
                                        <div class="input-with-icon">
                                            <select id="taluk_id" value="{{ old('taluk_id') }}" class="form-control" name="taluk_id" required>
                                                <option value="">&nbsp;</option>
                                            </select>
                                            <i class="lni-phone-handset"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6">
                                    <label id="reqphone" style="color:red"></label>
                                    <div class="form-group">
                                        <div class="input-with-icon">
                                            <input type="text" value="{{ old('owner_name') }}" name="owner_name" id="sellerphone" maxlength="50"
                                                required="required" class="form-control" placeholder="Owner Name">
                                            <i class="lni-phone-handset"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6">
                                    <label id="reqphone" style="color:red"></label>
                                    <div class="form-group">
                                        <div class="input-with-icon">
                                            <input type="text" value="{{ old('landline_phone') }}" name="landline_phone" id="sellerphone" maxlength="15"
                                                required="required" class="form-control number" placeholder="Landline No">
                                            <i class="lni-phone-handset"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6">
                                    <label id="reqphone" style="color:red"></label>
                                    <div class="form-group">
                                        <div class="input-with-icon">
                                            <input type="text" name="gst_number" value="{{ old('gst_number') }}" id="sellerphone" maxlength="20"
                                                required="required" class="form-control number" placeholder="GST NO">
                                            <i class="lni-phone-handset"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6">
                                    <label id="reqphone" style="color:red"></label>
                                    <div class="form-group">
                                        <div class="input-with-icon">
                                            <input type="text" name="pan_number" value="{{ old('pan_number') }}" id="sellerphone" maxlength="10"
                                                required="required" class="form-control" placeholder="PAN NO">
                                            <i class="lni-phone-handset"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                <div class="col-lg-12 col-md-12">
                                    <label id="vao_area" style="color:red"></label>
                                    <div class="form-group">
                                        <div class="input-with-icon">
                                            <textarea name="vao_area" id="vao_area" maxlength="50" required="required" class="form-control" placeholder="VAO Area">{{ old('vao_area') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 col-md-12">
                                        <label id="reqphone" style="color:red"></label>
                                        <div class="form-group">
                                            <div class="input-with-icon">
                                                <textarea name="address" id="address" maxlength="200" required="required" class="form-control" placeholder="Address">{{ old('address') }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                <div class="col-lg-4 col-md-4"></div>
                            </div>
                            <div class="form-group">
                                <input name="submit" id="submit" type="submit"
                                    class="btn btn-md full-width btn-theme-light-2 rounded" value="Sign UP">
                            </div>
                        </form>

                        <div class="text-center">
                            <p class="mt-5"><a href="{{ url('admin') }}" class="link">Existing User Login</a></p>
                       </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('page_scripts')
<script>
    $('#dist_id').on('change',function(){
        var dist_id = this.value;
        $("#taluk_id").html('');
        $.ajax({
            url: "{{url('/gettalukfront')}}",
            type: "POST",
            data: {
                dist_id: dist_id,
                _token: '{{csrf_token()}}'
            },
            dataType: 'json',
            success: function (result) {
                $('#taluk_id').html('<option value="">Select Taluk</option>');
                $.each(result, function (key, value) {
                    $("#taluk_id").append('<option value="' + value
                        .id + '">' + value.taluk_name + '</option>');
                });
            }   
        });
    });

    </script>

@endpush