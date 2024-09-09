@extends('layouts.admin_app')
@section('content')
<div class="container-fluid">
</div>
<section class="content">
    <div class="container-fluid">
        <div class="row">

            <div class="col-lg-3 col-6">
                <div class="small-box bg-primary">
                    <div class="inner">
                        <h3>{{ $categorycount }}</h3>
                        <p>Categories</p>
                    </div>
                    <div class="icon">
                        <i class="nav-icon nav-icon fas fa-shopping-cart"></i>
                    </div>
            @if(Auth::user()->usertype_id == 1)
                    <a href="{{url('admin/category')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right {{ Request::is('/category') ? 'active' : '' }}"></i></a>
@else
                    <a href="" class="small-box-footer">More info <i class="fas fa-arrow-circle-right {{ Request::is('/category') ? 'active' : '' }}"></i></a>

					@endif
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box bg-secondary">
                    <div class="inner">
                        <h3>{{ $productscount }}</h3>
                        <p>Products</p>
                    </div>
                    <div class="icon">
                        <i class="nav-icon nav-icon fas fa-shopping-cart"></i>
                    </div>
                    @if(Auth::user()->usertype_id == 1)
                    <a href="{{url('admin/seller')}}" class="small-box-footer">More info <i
                            class="fas fa-arrow-circle-right {{ Request::is('/seller') ? 'active' : '' }}"></i></a>
                    @else
                    <a href="{{url('admin/products')}}" class="small-box-footer">More info <i
                        class="fas fa-arrow-circle-right {{ Request::is('/products') ? 'active' : '' }}"></i></a>
                        @endif
                </div>
            </div>
			<div class="col-lg-3 col-6">
                <div class="small-box bg-secondary">
                    <div class="inner">
                        <h3>{{ count($orderscount) }}</h3>
                        <p>Orders</p>
                    </div>
                    <div class="icon">
                        <i class="nav-icon nav-icon fas fa-shopping-cart"></i>
                    </div>
                    <a href="{{url('admin/orders')}}" class="small-box-footer">More info <i
                            class="fas fa-arrow-circle-right {{ Request::is('/orders') ? 'active' : '' }}"></i></a>
                </div>
            </div>
			
            @if(Auth::user()->usertype_id == 1)
            <div class="col-lg-3 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ $sellercount }}</h3>
                        <p>Sellers</p>
                    </div>
                    <div class="icon">
                        <i class="nav-icon fas fa fa-store"></i>
                    </div>
                    <a href="{{url('admin/seller')}}" class="small-box-footer">More info <i
                            class="fas fa-arrow-circle-right {{ Request::is('/seller') ? 'active' : '' }}"></i></a>
                </div>
            </div>
            @endif
            
        </div>
</section>
@endsection