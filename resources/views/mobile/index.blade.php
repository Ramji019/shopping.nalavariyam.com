@extends('mobile/layouts.app')
@section('mobile/content')
    <div class="top-products-area">
        <div class="container">
            <div class="row g-3">
                @foreach ($category as $categorylist)
                    <div class="col-6 col-sm-4 col-lg-3 product_div">
                        <div class="card single-product-card">
                            <div class="card-body p-1">
                              <a class="product-thumbnail d-block" href="{{ url('/subcategory', $categorylist->id) }}">
                                <div class="product-thumbnail d-block">
                                    <div
                                        style="width: 150px; height: 100px; background-image: url('{{ URL::to('/') }}/uploads/category/{{ $categorylist->photo }}'); background-size: contain; background-repeat: no-repeat; background-position: 50% 50%;">
                                    </div>
                            </div>
                              </a>
                            <center><a class="product-title d-block text-truncate"
                                href="{{ url('/subcategory', $categorylist->id) }}">{{ $categorylist->category_name }}</a></center>
                            
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="pt-3"></div>
    </div>
	
    <div class="pt-3"></div>
@endsection
 @push('mobile/page_scripts')
        <script>

            $(document).ready(function() {
                toastr.options.timeOut = 10000;
                @if(Session::has('success'))
                    toastr.success('{{ Session::get('success') }}');
                @endif
            });

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
