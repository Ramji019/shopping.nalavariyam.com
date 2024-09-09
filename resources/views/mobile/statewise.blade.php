@extends('mobile/layouts.other_app')
@section('content')
    <div class="page-content-wrapper py-3">
        <div class="container">
                <div class="card-header">
                    <h5 class="mb-1 text-center">{{ $state }}</h5>
                </div>

                <div class="top-products-area">
                    <div class="container">
                        <div class="row g-3">
                            @foreach ($products as $prod)
                                <div class="col-6 col-sm-4 col-lg-3 product_div">
                                    <div class="card single-product-card">
                                        <div class="card-body p-1">
                                            <a class="product-thumbnail d-block" href="{{ url('/product', $prod->id) }}">

                                                <div class="product-thumbnail d-block">
                                                    @foreach ($prod->photo as $k => $photo)
                                                        @if ($k > 0)
                                                        @break
                                                    @endif
                                                    <div
                                                        style="width: 150px; height: 100px; background-image: url('{{ URL::to('/') }}/uploads/products/{{ $photo }}'); background-size: contain; background-repeat: no-repeat; background-position: 50% 50%;">
                                                    </div>
                                                @endforeach
                                            </div>
    
                                        </a>
                                        <a class="product-title d-block text-truncate"
                                            href="{{ url('/product', $prod->id) }}">{{ $prod->product_name }}</a>
                                        <p class="sale-price">₹ {{ number_format($prod->price, 2, '.', ',') }}</p>
                                        <div class="row">
                                            <div class="col-9">
                                                <a class="btn btn-primary rounded-pill btn-sm"
                                                    href="{{ url('/product', $prod->id) }}">{{ date('d-M-Y', strtotime($prod->post_date)) }}</a>
                                            </div>
                                            <div class="col-3" style="padding-left: 1px">
                                                @if (Auth::user())
                                                    @if (in_array($prod->id, $favorites))
                                                        <span class="badge btn-danger btn"><a
                                                                onclick="addfavorites(this,{{ Auth::user()->id }},{{ $prod->id }})"
                                                                class="btn-danger"><i
                                                                    class="bi bi-heart"></i></a></span>
                                                    @else
                                                        <span class="badge btn-warning btn"><a
                                                                onclick="addfavorites(this,{{ Auth::user()->id }},{{ $prod->id }})"
                                                                class="btn-warning"><i
                                                                    class="bi bi-heart"></i></a></span>
                                                    @endif
                                                @endif
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="row g-3">&nbsp;</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
