@extends('mobile/layouts.other_app')
@section('mobile/content')
    <div class="page-content-wrapper py-3">
        <div class="container">
            <div class="card-header"> 
                <h5 class="mb-1 text-center">Explore SubCategory</h5>
            </div>
            <hr>

            <div class="top-products-area">
                <div class="container">
                    <div class="row g-3">
                        @foreach ($subcategory as $sub)
                            <div class="col-6 col-sm-4 col-lg-3 product_div">
                                <div class="card single-product-card">
                                    <div class="card-body p-1">
                                        <a class="product-thumbnail d-block" href="{{ url('/thirdcategory', $sub->id) }}">
                                            <div class="product-thumbnail d-block">
                                                <div
                                                    style="width: 150px; height: 100px; background-image: url('{{ URL::to('/') }}/uploads/category/{{ $sub->photo }}'); background-size: contain; background-repeat: no-repeat; background-position: 50% 50%;">
                                                </div>
                                        </div>
                                        </a>

                                   <center> <a class="product-title d-block text-truncate"
                                        href="{{ url('/thirdcategory', $sub->id) }}">{{ $sub->category_name }}</a></center>
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
