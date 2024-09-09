@extends('layouts.other_app')
@section('content')
<div class="page-title">
				<div class="container">
					<div class="row">
						<div class="col-lg-12 col-md-12">
							
							<h2 class="ipt-title">Contact Us</h2>
							<span class="ipn-subtitle">Lists of our all Popular agencies</span>
							
						</div>
					</div>
				</div>
			</div>
			<!-- ============================ Page Title End ================================== -->
			
			<!-- ============================ Agency List Start ================================== -->
			

			<section style="background-color: white">
			
				<div class="container" >
				
					<!-- row Start -->
					<div class="row">
					
						<div class="col-lg-7 col-md-7">
							<form method="post" action="{{url('addcontactus')}}">
						{{csrf_field()}}
							<div class="row">
								<div class="col-lg-6 col-md-6">
									<div class="form-group">
										<label>Name</label>
										<input type="text" name="name" id="name" class="form-control simple">
									</div>
								</div>
								<div class="col-lg-6 col-md-6">
									<div class="form-group">
										<label>Email</label>
										<input type="text" name="email" id="email" class="form-control simple">
									</div>
								</div>
							</div>
							
							<div class="form-group">
								<label>Subject</label>
								<input type="text" name="subject" id="subject" class="form-control simple">
							</div>
							
							<div class="form-group">
								<label>Message</label>
								<textarea name="message" id="message" class="form-control simple" rows="3"></textarea>
							</div>
							
							<div class="form-group">
								<button class="btn btn-theme-light-2 rounded" type="submit">Submit Request</button>
							</div>
							</form>			
						</div>
						
						<div class="col-lg-5 col-md-5">
							<div class="contact-info">
								
								<h2>Get In Touch</h2>
								<p>Feel free to get in touch if you need any further assistance or have any inquiries.</p>
								
								<div class="cn-info-detail">
									<div class="cn-info-icon">
										<i class="ti-home"></i>
									</div>
									<div class="cn-info-content">
										<h4 class="cn-info-title">Reach Us</h4>
										Asaripallam Rd, <br>Weavers Colony,NesamonyNagar<br>TamilNadu 629001
									</div>
								</div>
								
								<div class="cn-info-detail">
									<div class="cn-info-icon">
										<i class="ti-email"></i>
									</div>
									<div class="cn-info-content">
										<h4 class="cn-info-title">Drop A Mail</h4>
										kumaritimes@gmail.com
									</div>
								</div>
								
								<div class="cn-info-detail">
									<div class="cn-info-icon">
										<i class="ti-mobile"></i>
									</div>
									<div class="cn-info-content">
										<h4 class="cn-info-title">Call Us</h4>
										+91 6380375996
									</div>
								</div>
								
							</div>
						</div>
						
					</div>
					<!-- /row -->		
					
				</div>
						
			</section>
			<!-- ============================ Agency List End ================================== -->
			
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
