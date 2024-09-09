@extends('mobile/layouts.other_app')
@section('mobile/content')
</br>
</br>
<div class="container">
  <div class="card product-details-card mb-3">
    @if(Auth::user())
    @if($fav == 1 )
    <span class="badge btn-danger text-dark position-absolute product-badge">
      <a onclick="addfavorites(this,{{ Auth::user()->id }},{{ $prod->id }})" class=" btn-danger"><i class="bi bi-heart"></i></a></span>
      @else
      <span class="badge btn-warning text-dark position-absolute product-badge">
        <a onclick="addfavorites(this,{{ Auth::user()->id }},{{ $prod->id }})" class=" btn-warning"><i class="bi bi-heart"></i></a></span>  
        @endif  
        @endif  
        <div class="card-body">
          <div class="product-gallery-wrapper">
            <div class="product-gallery gallery-img">
              
             @foreach($prod->photo as $photo)
             <a href="{{ URL::to('/') }}/uploads/products/{{ $photo->photo }}" class="image-zooming-in-out" title="Product" data-gall="gallery2">
              <img class="rounded" src="{{ URL::to('/') }}/uploads/products/{{ $photo->photo }}" alt="">
            </a>
            @endforeach
          </div>
        </div>
      </div>
    </div>

    <div class="card product-details-card mb-3 direction-rtl">
      <div class="card-body">
        <h3>{{ $prod->product_name }}</h3>
        <h1>₹ {{ number_format($prod->price,2,".",",") }}</h1>
        <p>{{ $prod->address }}</p>
       <div class="input-group">
               <input type="button" value="-" class="minus btn btn-sm btn-dange" id="min" />
               <input class="form-control number quantity" maxlength="2" style="height:28px;" name="quantity" type="text" value="1" />
               <input type="button" value="+" class="plus btn btn-sm btn-success" id="plus">
			   <button onclick="addProduct(this,'{{ $prod->id }}','{{ $prod->product_name }}','{{ $prod->price }}')" type="button" class="btn btn-sm btn-warning"><i class="bi bi-cart"></i></button>
           </div>   
      </div>
    </div>

    <div class="card product-details-card mb-3 direction-rtl">
      <div class="card-body">
        <h5>Description</h5>
        <div class="block-body">
          <p style="white-space: pre-line;">{{ $prod->description }}</p>
        </div>
      </div>
    </div>
    
    <div class="card product-details-card mb-3 direction-rtl">
      <div class="card-body">
        <h5>Features</h5>  
        <div class="block-body">
         <ul class="deatil_features">
          @foreach($attrs as $attr)
          @if($attr->attr_type != "checkbox")
          <li><strong>{{ $attr->attr_name }}</strong>  : {{ $attr->attr_value2 }}</li>
          @else
          @php($attr_value  = explode(",",$attr->attr_value))
          @php($attr_value2  = explode(",",$attr->attr_value2))
          <li><strong>{{ $attr->attr_name }}</strong></li>
          @foreach($attr_value as $v)
          @if(in_array($v,$attr_value2))
          <li><i class="bi bi-check"></i>{{ $v }}</li>
          @else
          <li><i class="bi bi-x"></i>{{ $v }}</li>
          @endif
          @endforeach
          @endif
          @endforeach
        </ul>
      </div>
    </div>
  </div>

  <div class="card product-details-card mb-3 direction-rtl">
    <div class="card-body">
      <h5>Location</h5>
      <div class="map-container text-center">
       @if(trim($prod->location) != "")
       <iframe width="250" height="250" src = "https://maps.google.com/maps?q={{ $prod->location }}&hl=es;z=14&amp;output=embed"></iframe>
       @endif 
     </div>
   </div>
 </div>
</div>
<div class="row g-3">&nbsp;</div>
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