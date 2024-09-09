@extends('mobile/layouts.use_other_app')
@section('mobile/content')
<div class="page-content-wrapper py-3">
<div class="container">
  <div class="card user-data-card">
    <div class="card-header">
      <h5 class="mb-1 text-center">My Wish List</h5>
    </div>

    <div class="top-products-area">
  <div class="container">
    <div class="row g-3">
      @foreach($products as $prod)
      <div class="col-6 col-sm-4 col-lg-3">
        <div class="card single-product-card">
          <div class="card-body p-3">
            <a class="product-thumbnail d-block" href="{{ url('/product', $prod->id) }}">
              @foreach($prod->photo as $k => $photo)
              @if($k > 0)
                @break
              @endif
              <img src="{{ URL::to('/') }}/uploads/products/{{ $photo }}" >
              @endforeach
            </a>
            <a class="product-title d-block text-truncate" href="{{ url('/product', $prod->id) }}">{{ $prod->product_name }}</a>
            <p class="sale-price">₹ {{ number_format($prod->price,2,".",",") }}</p>
            <a class="btn btn-primary rounded-pill btn-sm" href="{{ url('/product', $prod->id) }}">{{ date("d-M-Y",strtotime($prod->post_date)) }}</a>
            <span class="badge btn-danger btn"><a onclick="removefavorites({{ Auth::user()->id }},{{ $prod->id }})" class="btn-danger"><i class="bi bi-x"></i></a></span>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</div>
    
  </div>
  </div>
  </div>
  @endsection
