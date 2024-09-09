@extends('layouts.app')
@section('content')
<section class="bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7 col-md-10 text-center">
                <div class="sec-heading center">
                    <h2>{{ $category_name }}</h2>
                    <p></p>
                </div>
            </div> 
        </div>
        <div class="row">
            @foreach($products as $prod)
            <div class="col-lg-4 col-md-6 col-sm-12 product_div">
                <div class="property-listing property-2">
                    <div class="listing-img-wrapper">
                        <div class="list-img-slide">
                            <div class="click">
                                @foreach($prod->photo as $photo)
                                <div><a href="{{ url('/product', $prod->id) }}"><img src="{{ URL::to('/') }}/uploads/products/{{ $photo->photo }}"
                                            class="img-fluid mx-auto" /></a></div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="listing-detail-wrapper">
                        <div class="listing-short-detail-wrap">
                            <div class="listing-short-detail">
                                <a href="{{ url('/product', $prod->id) }}">
                                <h4 class="listing-name">{{ $prod->product_name }}</a></h4>
                            </div>
                            <div class="listing-short-detail-flex">
                                <a href="{{ url('/product', $prod->id) }}">
                                <h6 class="listing-card-info-price">₹ {{ $prod->price }}</a></h6>
                            </div>
                        </div>
                    </div>
                  
                    <div class="listing-detail-footer addtocart">
                        
                        <input type="button" value="-" class="minus btn btn-sm btn-danger"
                        id="min" />
                        <input class="col-md-2 number quantity" maxlength="2" style="height:28px;" name="quantity" type="text" value="1" />
                        <input type="button" value="+" class="plus btn btn-sm btn-success"
                        id="plus">
                        &nbsp;&nbsp;
                        <button onclick='addProduct(this,"{{ $prod->id }}","{{ $prod->product_name }}","{{ $prod->price }}")' type="button" class="btn btn-sm btn-warning">Add to cart</button>
                        &nbsp;&nbsp;
                        <div class="footer-flex" style="text-align: right">
                            @if(Auth::user())
                            @if(in_array($prod->id,$favorites))
                            <a onclick="addfavorites(this,{{ Auth::user()->id }},{{ $prod->id }})" class="prt-view"><i class="fas fa-heart"></i></a>
                            @else
                            <a onclick="addfavorites(this,{{ Auth::user()->id }},{{ $prod->id }})" class="prt-view"><i class="fas fa-heart"></i></a>
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
    </div>
</section> 
@endsection
@push('page_scripts')
        <script>
            $('.minus').click(function() {
                quantityField = $(this).next();
                if (quantityField.val() != 0) {
                    quantityField.val(parseInt(quantityField.val(), 10) - 1);
                }
            });
            $('.plus').click(function() {
                quantityField = $(this).prev();
                quantityField.val(parseInt(quantityField.val(), 10) + 1);
                console.log($(this).prev());
            });

            function addProduct(self,id,name,price){
                var quantity = $(self).parent().find('.quantity').val();
                let products = [];
                if(localStorage.getItem('products')){
                    products = JSON.parse(localStorage.getItem('products'));
                }
                var exists = false;
                for (i = 0; i < products.length; i++) {
                    if(products[i]["id"]==id){
                        exists = true;
                        toastr.options.timeOut = 5000;
                        toastr.error("Item already added to cart");
                    }
                }
                if(!exists) products.push({'id' : id ,'name' : name ,'price' : price,'quantity' : quantity});
                localStorage.setItem('products', JSON.stringify(products));
                if(!exists){
                    toastr.options.timeOut = 5000;
                    toastr.success("Item added to cart");
                }
                $("#lblCartCount").html(products.length);
            }
            $( document ).ready(function() {
                let products = [];
                if(localStorage.getItem('products')){
                    products = JSON.parse(localStorage.getItem('products'));
                }
                $("#lblCartCount").html(products.length);
            });
            
        </script>
        
        @endpush