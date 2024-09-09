@extends('layouts.other_app')

@section('content')

			<section class="bg-light">
				<div class="container-fluid">
				<!-- 
					<div class="row">
						<div class="col-lg-12 col-md-12">
							<div class="filter_search_opt">
								<a href="javascript:void(0);" onclick="openFilterSearch()">Dashboard Navigation<i class="ml-2 ti-menu"></i></a>
							</div>
						</div>
					</div> -->
								
					<div class="row">
@include('user.user-menu')
						<div class="col-lg-9 col-md-12">
									
							<div class="dashboard-wraper">
							
								<!-- Basic Information -->
								<div class="form-submit">	
									<h4>My Profile</h4>
									<div class="submit-section">
										<form action="{{ url('/saveprofile') }}" method="post" enctype="multipart/form-data" >
										{{ csrf_field() }}
										<div class="row">

											<div class="form-group col-md-3">
												<label>Name</label>
												<input required="required" name="name" maxlength="50" type="text" class="form-control" value="{{ auth()->user()->name }}">
											</div>
											
											<div class="form-group col-md-3">
												<label>Email</label>
												<input readonly="readonly" type="email" class="form-control" value="{{ auth()->user()->email }}">
											</div>
											
											<div class="form-group col-md-3">
												<label>Phone</label>
												<input readonly="readonly" type="text" class="form-control" value="{{ auth()->user()->phone }}">
											</div>

											{{-- <div class="form-group col-md-3">
												<label>Plan</label>
												<input readonly="readonly" type="text" class="form-control" value="{{ $plan->plan_name }}">
											</div> --}}

											<div class="form-group col-md-3">
												<label>Photo</label>
												<input accept="image/gif, image/jpeg, image/png" type="file" class="form-control" name="photo" id="photo">
											</div>

											<div class="row">

											<div class="form-group col-md-12">
												<label>Address</label>
												<textarea name="address" id="address" maxlength="200" required="required" class="form-control number" placeholder="Address">{{ auth()->user()->address }}</textarea>
											</div>
										</div>
											<div class="form-group col-lg-12 col-md-12 text-center">
												<button class="btn btn-success" type="submit">Update Profile</button>
											</div>
										</div>
										</form>
									</div>
								</div>
							</div>
						</div>
						
					</div>
				</div>
			</section>
			<!-- ============================ User Dashboard End ================================== -->
			
			<!-- ============================ Call To Action ================================== -->
			<section class="theme-bg call-to-act-wrap">
				<div class="container">
					<div class="row">
						<div class="col-lg-12">
							
							<div class="call-to-act">
								<div class="call-to-act-head">
									<h3>Want to Become a Real Estate Agent?</h3>
									<span>We'll help you to grow your career and growth.</span>
								</div>
								<a href="#" class="btn btn-call-to-act">SignUp Today</a>
							</div>
							
						</div>
					</div>
				</div>
			</section>
@endsection

@push('page_scripts')
<script>
	$('#photo').on('change', function() {
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
	});
</script>
@endpush
