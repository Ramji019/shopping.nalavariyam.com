@extends('layouts.app')
@section('content')
<section class="bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7 col-md-10 text-center">
                <div class="sec-heading center">
                    <h2>Explore ThirdCategory</h2>
                    <p></p>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ($thirdcategory as $third)
            <div class="col-lg-3 col-md-6 col-sm-12 product_div">
                <div class="property-listing property-2">
                    <div class="listing-img-wrapper">
                        <div class="list-img-slide">
                            <div class="click">
                                <div><a href="{{ url('/category', $third->id) }}"><img
                                    src="{{ URL::to('/') }}/uploads/category/{{ $third->photo }}"
                                    class="img-fluid mx-auto" /></a></div>
                                </div>
                            </div>
                        </div>
                        <div class="listing-detail-wrapper">
                            <div class="listing-short-detail-wrap">
                                <div class="listing-short-detail">
                                    <a href="{{ url('/category', $third->id) }}">
                                        <center><h4 class="listing-name">{{ $third->category_name }}
                                        </a></h4></center>
                                    </div>
									
                                </div>
                            </div>
                           
						   
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="clearfix"></div>
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