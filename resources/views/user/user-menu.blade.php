
<div class="col-lg-3 col-md-12">
							
							<div class="simple-sidebar sm-sidebar" id="filter_search">
								
								<div class="search-sidebar_header">
									<h4 class="ssh_heading">Close Filter</h4>
									<button onclick="closeFilterSearch()" class="w3-bar-item w3-button w3-large"><i class="ti-close"></i></button>
								</div>
								
								<div class="sidebar-widgets">
									<div class="dashboard-navbar">
										
										<div class="d-user-avater">
				<img src="{{ URL::to('/') }}/uploads/photo/{{ Auth::user()->photo }}" class="img-fluid avater" >
											<h4>{{ Auth::user()->name }}</h4>
										</div>
										
										<div class="d-navigation">
											<ul>
												@if(Auth::user()->usertype_id == 3)
												<li><a href="{{ url('/user/dashboard') }}"><i class="ti-dashboard"></i>Dashboard</a></li>
												
												<li><a href="{{ url('/user/profile') }}"><i class="ti-user"></i>My Profile</a></li>
												{{-- <li><a href="{{ url('/purchase') }}"><i class="ti-user"></i>Purchase Plan</a></li> 
											<li><a href="{{ route('my_products') }}"><i class="ti-layers"></i>My Products</a></li>
												<li><a href="{{ route('add_product') }}"><i class="ti-pencil-alt"></i>Add Products</a></li>
												<li><a href="{{ route('wishlist') }}"><i class="ti-heart"></i>Wish List</a></li>
												<li><a href="{{ route('sold_products') }}"><i class="ti-layers"></i>Sold Products</a></li> --}}
												@endif
												<li><a href="{{ route('change_password') }}"><i class="ti-unlock"></i>Change Password</a></li>
												<li><a href="{{ url('/sellerlogout') }}"><i class="ti-power-off"></i>Log Out</a></li>
											</ul>
										</div>
										
									</div>
								</div>
								
							</div>
						</div>