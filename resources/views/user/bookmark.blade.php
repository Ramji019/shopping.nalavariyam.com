@extends('layouts.other_app')
@section('content')

			<section class="bg-light">
				<div class="container-fluid">
					
								
					<div class="row">
						
@include('user.user-menu')

						
						<div class="col-lg-9 col-md-12">
							<div class="dashboard-wraper">
							
								<!-- Bookmark Property -->
								<div class="form-submit">	
									<h4>Bookmark Property</h4>
								</div>
								
								<table class="property-table-wrap responsive-table bkmark">

									<tbody>
										<tr>
											<th><i class="fa fa-file-text"></i> Property</th>
											<th></th>
										</tr>

										<!-- Item #1 -->
										<tr>
											<td class="property-container">
												<img src="assets/img/p-2.jpg" alt="">
												<div class="title">
													<h4><a href="#">Serene Uptown</a></h4>
													<span>6 Bishop Ave. Perkasie, PA </span>
													<span class="table-property-price">$900 / monthly</span>
												</div>
											</td>
											<td class="action">
												<a href="#" class="delete"><i class="ti-close"></i> Delete</a>
											</td>
										</tr>

										<!-- Item #2 -->
										<tr>
											<td class="property-container">
												<img src="assets/img/p-3.jpg" alt="">
												<div class="title">
													<h4><a href="#">Oak Tree Villas</a></h4>
													<span>71 Lower River Dr. Bronx, NY</span>
													<span class="table-property-price">$535,000</span>
												</div>
											</td>
											<td class="action">
												<a href="#" class="delete"><i class="ti-close"></i> Delete</a>
											</td>
										</tr>

										<!-- Item #3 -->
										<tr>
											<td class="property-container">
												<img src="assets/img/p-4.jpg" alt="">
												<div class="title">
													<h4><a href="#">Selway Villas</a></h4>
													<span>33 William St. Northbrook, IL </span>
													<span class="table-property-price">$420,000</span>
												</div>
											</td>
											<td class="action">
												<a href="#" class="delete"><i class="ti-close"></i> Delete</a>
											</td>
										</tr>

										<!-- Item #4 -->
										<tr>
											<td class="property-container">
												<img src="assets/img/p-5.jpg" alt="">
												<div class="title">
													<h4><a href="#">Town Manchester</a></h4>
													<span> 7843 Durham Avenue, MD  </span>
													<span class="table-property-price">$420,000</span>
												</div>
											</td>
											<td class="action">
												<a href="#" class="delete"><i class="ti-close"></i> Delete</a>
											</td>
										</tr>

									</tbody>
								</table>
								
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
