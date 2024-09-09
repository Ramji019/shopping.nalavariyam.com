@extends('mobile/layouts.use_other_app')
@section('mobile/content')
 <div class="page-content-wrapper py-3">
    <div class="container">
    <div class="card user-data-card">
      <div class="card-header">
        <h5 class="mb-1 text-center">Dashboard</h5>
      </div>
      <div class="card">
        <div class="card-body">
          <div class="price-table-two d-flex align-items-center">
            <div class="single-price-table active-effect">
              <div class="text">
                <h6 class="fz-14">Products</h6>
              </div>
              <div class="price">
                <h3>{{ $product }}</h3>
              </div>
              <div class="purchase">
              <a href="{{url('/user/my_products')}}" class="fz-12">View</a>
              </div>
            </div>
           
            <!-- Single Price Table -->
            <div class="single-price-table active-effect active">
              <div class="text">
                <h6 class="fz-12">Sold</h6>
              </div>
              <div class="price">
                <h3>{{ $sellproduct }}</h3>
              </div>
               <div class="purchase">
                    <a href="{{url('/user/sold_products')}}" class="btn btn-light btn-lg btn-creative" >View</a>
                </div>
            </div>

            <!-- Single Price Table -->
            <div class="single-price-table active-effect">
              <div class="text">
                <h6 class="fz-14">Favourites</h6>
              </div>
              <div class="price">
                <h3>{{ $favproduct }}</h3>
              </div>
              <div class="purchase">
              <a href="{{url('user/wish')}}" class="fz-12">View</a>
              </div>
            </div>
          </div>
		  <hr>
		   <div class="price-table-two d-flex align-items-center">
            <!-- Single Price Table -->
            <div class="single-price-table active-effect active">
              <div class="price">
                <h3>{{ $plan->plan_name }}</h3>
              </div>
               <div class="purchase">
                    <a class="btn btn-light btn-lg btn-creative" href="{{ url('/purchase') }}">Upgrade</a>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
