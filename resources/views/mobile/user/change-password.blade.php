@extends('mobile/layouts.use_other_app')
@section('mobile/content')
 <div class="page-content-wrapper py-3">
    <div class="container">
    <div class="card user-data-card">
      <div class="card-header">
        <h5 class="mb-1 text-center">Change Password</h5>
      </div>
      <div class="card user-data-card">
        <div class="card-body">
        <form action="{{ url('/update_password') }}" method="post">
			{{ csrf_field() }}
			<div class="submit-section">
				<div class="row">
						<div class="form-group col-lg-12 col-md-6">
							<label>Old Password</label>
							<input maxlength="30" type="password" name="old_password" required="required"
								class="form-control">
						</div>

						<div class="form-group col-md-6">
							<label>New Password</label>
							<input maxlength="30" type="password" name="new_password" required="required"
								class="form-control">
						</div>

						<div class="form-group col-md-6">
							<label>Confirm password</label>
							<input maxlength="30" type="text" name="confirm_password" required="required"
								class="form-control">
						</div>

						<div class="form-group col-lg-12 col-md-12 text-center">
							<input class="btn btn-primary" type="submit"
								value="Update Password">
						</div>
				</div>
				</form>
			</div>
		  </div>
		</div>
	  </div>
	</div>
</div>
  
@endsection
