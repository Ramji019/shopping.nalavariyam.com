@extends('mobile/layouts.other_app')
@section('mobile/content')
    <div class="page-content-wrapper py-3">
        <div class="container">
  <!-- Login Wrapper Area -->
  <div class="login-wrapper d-flex">
    <div class="container">
      <!-- Register Form -->
      <div class="register-form">

        @if (session()->has('success'))
        <div class="alert alert-success alert-dismissable" style="margin: 15px;">
          <a href="#" style="color:white !important" class="close" data-dismiss="alert"
          aria-label="close">&times;</a>
          <strong> {{ session('success') }} </strong>
        </div>
        @endif

        @if (session()->has('error'))
        <div class="alert custom-alert-1 alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-x-circle"></i>
           {{ session('error') }}
            <button class="btn btn-close position-relative p-1 ms-auto" type="button" data-bs-dismiss="alert"
              aria-label="Close"></button>
          </div>
        @endif

        <h6 class="mb-3 text-center">Register As Seller</h6>
        
        <form action="{{ url('/savesellerregister') }}" method="post">
            {{ csrf_field() }}
          <div class="form-group text-start mb-3">
            <input class="form-control" type="text" value="{{ old('name') }}" name="name" required maxlength="50" placeholder="Full Name">
          </div>

          <div class="form-group text-start mb-3">
            <input class="form-control" type="email" value="{{ old('selleremail') }}" name="selleremail" required maxlength="50" placeholder="Email address">
          </div>

          <div class="form-group text-start mb-3">
            <input class="form-control number" type="text" value="{{ old('sellerphone') }}" name="sellerphone" required maxlength="15" placeholder="Phone No">
          </div>

          <div class="form-group text-start mb-3 position-relative">
            <input class="form-control" id="psw-input" type="password" {{ old('sellerpassword') }} required maxlength="20" name="sellerpassword" placeholder="New password">
            <div class="position-absolute" id="password-visibility">
              <i class="bi bi-eye"></i>
              <i class="bi bi-eye-slash"></i>
            </div>
          </div>

          <div class="mb-3" id="pswmeter"></div>

          <div class="form-group text-start mb-3">
          <select class="form-control" id="dist_id" required="requiered" name="dist_id">
            <option>Select District</option>
            @foreach($district as $dist)
            <option value="{{ $dist->id }}">{{ $dist->district_name }}</option>
            @endforeach
          </select>
          </div>

          <div class="form-group text-start mb-3">
            <select class="form-control" id="taluk_id" name="taluk_id" required="requiered">
              <option>Select Taluk</option>
            </select>
            </div>

            <div class="form-group text-start mb-3">
                <input class="form-control" type="text" value="{{ old('owner_name') }}" name="owner_name" maxlength="50" placeholder="Owner Name">
              </div>

            <div class="form-group text-start mb-3">
                <input class="form-control number" type="text" value="{{ old('landline_phone') }}" name="landline_phone" maxlength="15" placeholder="Landline No">
              </div>

            <div class="form-group text-start mb-3">
                <input class="form-control" type="text" value="{{ old('gst_number') }}" name="gst_number" maxlength="15" placeholder="GST Number">
              </div>

            <div class="form-group text-start mb-3">
                <input class="form-control" type="text" value="{{ old('pan_number') }}" name="pan_number" required maxlength="10" placeholder="PAN Number">
              </div>

            <div class="form-group text-start mb-3">
                <input class="form-control" type="text" value="{{ old('vao_area') }}" name="vao_area" maxlength="50" placeholder="VAO Area">
              </div>

              <div class="form-group text-start mb-3">
              <textarea class="form-control" id="exampleTextarea1" name="address" cols="3" rows="5"
              placeholder="Write Address...">{{ old('address') }}</textarea>
              </div>

          <button class="btn btn-primary w-100" type="submit">Sign Up</button>
        </form>
      </div>

      <!-- Login Meta -->
      <div class="login-meta-data text-center">
        <p class="mt-3 mb-0">Already have an account? <a class="stretched-link" href="{{ url('/admin') }}">Login</a></p>
      </div>
    </div>
  </div>

</div>
</div>
@endsection
@push('mobile/page_scripts')
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