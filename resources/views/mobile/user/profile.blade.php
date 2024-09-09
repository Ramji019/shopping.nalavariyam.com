@extends('mobile/layouts.use_other_app')
@section('mobile/content')
 <div class="page-content-wrapper py-3">
    <div class="container">
    <div class="card user-data-card">
      <div class="card-header">
        <h5 class="mb-1 text-center">My Profile</h5>
      </div>
      <div class="card">
        <div class="card-body">

        <form action="{{ url('/saveprofile') }}" method="post" enctype="multipart/form-data" >
            {{ csrf_field() }}

            <div class="form-group mb-3">
              <label class="form-label" for="Username">Name</label>
              <input maxlength="50" class="form-control" name="name" id="name" type="text" placeholder="Name" value="{{ auth()->user()->name }}">
            </div>

            <div class="form-group mb-3">
              <label class="form-label" for="fullname">Email</label>
              <input readonly="readonly" maxlength="50" value="{{ auth()->user()->email }}" name="email" class="form-control" id="email" type="text" placeholder="Email" >
            </div>

            <div class="form-group mb-3">
              <label class="form-label" for="email">Phone</label>
              <input class="form-control" value="{{ auth()->user()->phone }}" name="phone" id="phone" type="text" placeholder="Email Address" readonly="readonly">
            </div>

            <div class="form-group mb-3">
              <label class="form-label" for="email">Current Plan</label>
              <input readonly="readonly" type="text" class="form-control" value="{{ $plan->plan_name }}">
            </div>

            <div class="form-group mb-3">
              <label class="form-label" for="email">Photo</label>
              <input accept="image/gif, image/jpeg, image/png" type="file" class="form-control" name="photo" id="photo">
            </div>


            <div class="form-group mb-12 text-center">
              <button class="btn btn-success" type="submit">Save</button>
            </div>
          </form>
         </div>
       </div>
    </div>
  </div>
</div>
@endsection
