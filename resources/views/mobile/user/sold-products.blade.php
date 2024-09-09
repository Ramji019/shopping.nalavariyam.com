@extends('mobile/layouts.use_other_app')

@section('mobile/content')

<div class="page-content-wrapper py-3">
<div class="container">
  <div class="card user-data-card">
    <div class="card-header">
      <h5 class="mb-1 text-center">Sold Products</h5>
    </div>

    <div class="top-products-area">
      <div class="container">
        <div class="row g-3">
          @foreach($products as $prod)
          <!-- Single Top Product Card -->
          <div class="col-12 col-sm-12 col-lg-6">
            <div class="card single-product-card">
              <div class="card-body p-3">
                <!-- Product Thumbnail -->
                @foreach($prod->photo as $k => $photo)
                @if($k > 0)
                @break
                @endif
                <a class="product-thumbnail d-block" href="javascript:void(0);">
                  <img src="{{ URL::to('/') }}/uploads/products/{{ $photo }}" alt="">
                  <!-- Badge -->
                  <span class="badge bg-warning">Sale</span>
                </a>
                @endforeach
                <a class="product-title d-block text-truncate" href="">{{ $prod->product_name }}</a>
                <p class="sale-price">Price: ₹ {{ number_format($prod->price,2,".",",") }}</p>
                @if($prod->status == "Sold")
                <a class="btn btn-success" >Sold</a>
                @else
                <a onclick="markassold({{ $prod->id }})" class="btn btn-primary" href="#">Mark as Sold</i></a>
                @endif
                <a class="btn btn-primary" href="{{ url('/user/edit_product/') }}/{{ $prod->id }}"><i class="bi bi-pencil"></i></a>
                <a class="btn btn-danger" href="{{ url('/user/delete_product', $prod->id) }}"><i class="bi bi-trash"> </i></a>
              </div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
  @endsection
