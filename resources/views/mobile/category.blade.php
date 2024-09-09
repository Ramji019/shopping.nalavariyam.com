@extends('mobile/layouts.other_app')
@section('mobile/content')
    <div class="page-content-wrapper py-3">
        <div class="container">
            <div class="card-header"> 
                <h5 class="mb-1 text-center">{{ $category_name }}</h5>
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
                                                    style="width: 150px; height: 100px; background-image: url('{{ URL::to('/') }}/uploads/products/{{ $photo->photo }}'); background-size: contain; background-repeat: no-repeat; background-position: 50% 50%;">
                                                </div>
                                            @endforeach
                                        </div>
                                        </a>

                                    <a class="product-title d-block text-truncate"
                                        href="{{ url('/product', $prod->id) }}">{{ $prod->product_name }}</a>
                                    <p class="sale-price">₹ {{ number_format($prod->price, 2, '.', ',') }}</p>
                                    <div class="row">
                                       
                                            <div class="col-9">
                                             <div class="center">
            
                <p></p>
                <p>
                      <div class="input-group">
                           <input type="button" value="-" class="minus btn btn-sm btn-danger" id="min" />
                           <input class="form-control number quantity" maxlength="2" style="height:28px;" name="quantity" type="text" value="1" />
                           <input type="button" value="+" class="plus btn btn-sm btn-success" id="plus">
                           <button onclick='addProduct(this,"{{ $prod->id }}","{{ $prod->product_name }}","{{ $prod->price }}")' type="button" class="btn btn-sm btn-warning"><i class="bi bi-cart"></i>Add to cart</button>
                       </div>           
                 </p>
            </div>
            
            
            
            
            
                                            </div>
                                          
                                    {{--     <div class="col-3" style="padding-left: 1px">
                                            @if (Auth::user())
                                                @if (in_array($prod->id, $favorites))
                                                    <span class="badge btn-danger btn"><a
                                                            onclick="addfavorites(this,{{ Auth::user()->id }},{{ $prod->id }})"
                                                            class="btn-danger"><i class="bi bi-heart"></i></a></span>
                                                @else
                                                    <span class="badge btn-warning btn"><a
                                                            onclick="addfavorites(this,{{ Auth::user()->id }},{{ $prod->id }})"
                                                            class="btn-warning"><i class="bi bi-heart"></i></a></span>
                                                @endif
                                            @endif
                                        </div> --}}

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
@endsection
@push('mobile/page_scripts')
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
