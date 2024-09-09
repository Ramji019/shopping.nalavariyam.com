@extends('layouts.other_app')

@section('content')

<section class="bg-light">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="filter_search_opt">
                    <a href="javascript:void(0);" onclick="openFilterSearch()">Dashboard Navigation<i
                            class="ml-2 ti-menu"></i></a>
                </div>
            </div>
        </div>
        <div class="row">
            @include('user.user-menu')
            <div class="col-lg-9 col-md-12">
                <div class="dashboard-wraper">
                    <div class="form-submit">
                        <h4>Sold Products</h4>
                    </div>
                    <div class="row">
                        @foreach($products as $prod)
                        <div class="col-md-12 col-sm-12 col-md-12">
                            <div class="singles-dashboard-list">
                                <div class="sd-list-left">
                                    @foreach($prod->photo as $k => $photo)
                                    @if($k > 0)
                                    @break
                                    @endif
                                    <img style="padding: 10px 10px 10px 10px;"
                                        src="{{ URL::to('/') }}/uploads/products/{{ $photo }}" class="img-fluid" />
                                    @endforeach
                                </div>
                                <div class="sd-list-right">
                                    <h4 class="listing_dashboard_title">{{ $prod->product_name }}</h4>
                                    <div class="user_dashboard_listed">
                                        {{ $prod->description }}
                                    </div>
                                    <div class="user_dashboard_listed">
                                        Price: {{ $prod->price }}
                                    </div>
                                    @if($prod->status == "Sold")
                                    <a class="btn btn-success btn-sm">Sold</a>
                                    @else
                                    <a onclick="markassold({{ $prod->id }})" class="btn btn-primary btn-sm"
                                        style="color:white;" href="#">Mark as Sold</i></a>
                                    @endif
                                    <div class="action">
                                        <a href="{{ url('/user/edit_product/') }}/{{ $prod->id }}"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><i
                                                class="ti-pencil"></i></a>
                                        <a href="{{ url('/user/delete_product', $prod->id) }}" data-bs-toggle="tooltip"
                                            data-bs-placement="top" title="Delete" class="delete"><i
                                                class="ti-close"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection