@extends('layouts.other_app')
@section('content')

    <section class="gray-simple">
        <div class="page-content-wrapper py-3">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-12 col-sm-12">
                        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                @foreach ($prod->photo as $photo)
                                    <div class="carousel-item active">
                                        <img src="{{ URL::to('/') }}/uploads/products/{{ $photo->photo }}"
                                            class="d-block w-100" alt="...">
                                    </div>
                                @endforeach
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
                                data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
                                data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            </button>
                        </div>



                        <div class="property_block_wrap style-2 p-4">
                            <div class="prt-detail-title-desc">
                                <span class="prt-types sale">For Sale</span>
                                <h3>{{ $prod->product_name }}</h3>
                                <span><i class="lni-map-marker"></i>{{ $prod->address }}</span>
                                <h3 class="prt-price-fix">₹ {{ $prod->price }}<sub></sub></h3>

                                      <div class="input-group">
               <input type="button" value="-" class="minus btn btn-sm btn-dange" id="min" />
               <input class="form-control number quantity" maxlength="2" style="height:28px;" name="quantity" type="text" value="1" />
               <input type="button" value="+" class="plus btn btn-sm btn-success" id="plus">
			   <button onclick="addProduct(this,'{{ $prod->id }}','{{ $prod->product_name }}','{{ $prod->price }}')" type="button" class="btn btn-sm btn-warning"><i class="bi bi-cart"></i></button>
           </div>  
                            </div>
                        </div>

                        <div class="property_block_wrap style-2">
                            <div class="property_block_wrap_header">
                                <h4 class="property_block_title">Description</h4>
                            </div>
                            <div id="clTwo" class="panel-collapse collapse show">
                                <div class="block-body">
                                    <p style="white-space: pre-line;">{{ $prod->description }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="property_block_wrap style-2">
                            <div class="property_block_wrap_header">
                                <h4 class="property_block_title">Detail & Features</h4>
                            </div>
                            <div id="clOne" class="panel-collapse collapse show" aria-labelledby="clOne">
                                <div class="block-body">
                                    <ul class="deatil_features">
                                        @foreach ($attrs as $attr)
                                            @if ($attr->attr_type != 'checkbox')
                                                <li><strong>{{ $attr->attr_name }}</strong>{{ $attr->attr_value2 }}</li>
                                            @else
                                                @php($attr_value = explode(',', $attr->attr_value))
                                                @php($attr_value2 = explode(',', $attr->attr_value2))
                                                @foreach ($attr_value as $v)
                                                    @if (in_array($v, $attr_value2))
                                                        <li><i class="fa fa-check"></i>{{ $v }}</li>
                                                    @else
                                                        <li><i class="fa fa-times"></i>{{ $v }}</li>
                                                    @endif
                                                @endforeach
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                            </div>

                        </div>



                        <div class="property_block_wrap style-2">
                            <div class="property_block_wrap_header">
                                <h4 class="property_block_title">Address</h4>
                            </div>
                            <div id="clTwo" class="panel-collapse collapse show">
                                <div class="block-body">
                                    <p style="white-space: break-space;">{{ $prod->address }}</p>
                                </div>
                            </div>
                        </div>

                    </div>



                    <!-- property Sidebar -->
                    <div class="col-lg-4 col-md-12 col-sm-12">

                        <div class="details-sidebar">

                            <div class="sides-widget">

                            </div>

                        </div>

                       <!--  <div class="property_block_wrap style-2">

                            <div class="property_block_wrap_header text-center">
                                <h4 class="property_block_title ">Location</h4>
                            </div>

                            <div id="clSix" class="panel-collapse">
                                <div class="block-body">
                                    <div class="map-container text-center">
                                        @if (trim($prod->location) != '')
                                            <iframe width="300" height="600"
                                                src="https://maps.google.com/maps?q={{ $prod->location }}&hl=es;z=14&amp;output=embed"></iframe>
                                        @endif
                                    </div>

                                </div>
                            </div>

                        </div> -->
                    </div>

                </div>
            </div>
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