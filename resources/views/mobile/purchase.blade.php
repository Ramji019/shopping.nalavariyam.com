@extends('mobile/layouts.use_other_app')
@section('mobile/content')
<div class="page-content-wrapper py-3">
    <div class="container">
        <div class="card user-data-card">
            <div class="card-header">
                <h5 class="mb-1 text-center">Plans</h5>
            </div>
        </div>
        <div class="row g-3">
            @foreach($plans as $plan)
            <div class="col-12 col-sm-12 col-lg-12">
                <div class="card single-product-card">
                    <div class="card-body p-3">
                        <div class="single-price-content shadow-sm">
                            <div class="price">
                                <span class="text-white mb-2">{{ $plan->plan_name }}</span>
                                <h6 class="display-3"><sup>&#8377;</sup>{{ $plan->amount }}</h6>
                            </div>
                            <!-- Pricing Desc -->
                            <div class="pricing-desc">
                                <ul class="ps-0">
                                    <li><i class="bi bi-check-lg me-2"></i>{{ $plan->no_of_products }} Products</li>
                                    <li><i class="bi bi-check-lg me-2"></i>{{ $plan->days }} Days</li>
                                </ul>
                            </div>
                            <div>
                                <p>{{ $plan->description }}</p>
                            </div>
                            <!-- Purchase -->
                            <div class="purchase text-center">
                                <a class="btn btn-primary btn-lg btn-creative" href="#">Choose Plan</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection