@extends('layouts.app')
@section('content')
    <section class="bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7 col-md-10 text-center">
                    <div class="sec-heading center">
                        <h2>{{ $state }}</h2>
                        <p></p>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($products as $prod)
                    <div class="col-lg-4 col-md-6 col-sm-12 product_div">
                        <div class="property-listing property-2">
                            <div class="listing-img-wrapper">
                                <div class="list-img-slide">
                                    <div class="click">
                                        @foreach ($prod->photo as $photo)
                                            <div><a href="{{ url('/product', $prod->product_url) }}"><img
                                                        src="{{ URL::to('/') }}/uploads/products/{{ $photo }}"
                                                        class="img-fluid mx-auto" /></a></div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="listing-detail-wrapper">
                                <div class="listing-short-detail-wrap">
                                    <div class="listing-short-detail">
                                        <a href="{{ url('/product', $prod->product_url) }}">
                                            <h4 class="listing-name">{{ $prod->product_name }}
                                        </a></h4>
                                    </div>
                                    <div class="listing-short-detail-flex">
                                        <a href="{{ url('/product', $prod->product_url) }}">
                                            <h6 class="listing-card-info-price">₹{{ $prod->price }}</h6>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="listing-detail-footer">
                                <div class="footer-first">
                                    <div class="foot-location"><a href="{{ url('/product', $prod->product_url) }}"><img
                                                src="/assets/img/pin.svg" width="18"
                                                alt="" />{{ $prod->city_id }}</a></div>
                                </div>

                                <div style="margin-right: 10px">{{ date('d-M-Y', strtotime($prod->post_date)) }}</div>
                                <div class="footer-flex">

                                    @if (Auth::user())
                                        @if (in_array($prod->id, $favorites))
                                            <a onclick="addfavorites(this,{{ Auth::user()->id }},{{ $prod->id }})"
                                                class="prt-view-t"><i class="fas fa-heart"></i></a>
                                        @else
                                            <a onclick="addfavorites(this,{{ Auth::user()->id }},{{ $prod->id }})"
                                                class="prt-view"><i class="fas fa-heart"></i></a>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection

@push('page_scripts')
    <script></script>
@endpush
