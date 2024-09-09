@extends('mobile/layouts.other_app')
@section('mobile/content')
 <div class="page-content-wrapper py-3">
    <div class="container">
      <!-- Cart Wrapper -->
      <div class="cart-wrapper-area">
        <div class="cart-table card mb-3">
		 @if (Auth::user())
                <input type="hidden" id="user_loggedin" value="1">
                @else
                <input type="hidden" id="user_loggedin" value="0">
                @endif
				<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">

          <div class="table-responsive card-body">
            <table class="table mb-0 text-center">
              <thead>
                <tr>
                  <th scope="col">Item Name</th>
                  <th scope="col">Price</th>
                  <th scope="col">Quantity</th>
                  <th scope="col">SubTotal</th>
                  <th scope="col">X</th>
                </tr>
              </thead>
              <tbody id="cartbody">

              </tbody>
            </table>
            <hr>
            <div class="form-group text-start mb-3">
              <input class="form-control" type="text" name="delivery_person" id="delivery_person"  maxlength="50" placeholder="Delivery Person Name">
            </div>
  
            <div class="form-group text-start mb-3">
              <input class="form-control number" type="text" name="deliveryphone" id="deliveryphone"  maxlength="20" placeholder="Delivery Person Mobile No">
            </div>
  
            <div class="form-group text-start mb-3">
              <textarea class="form-control" name="deliveryaddress" id="deliveryaddress" maxlength="250" cols="3" rows="5"
              placeholder="Delivery Person Address..."></textarea>
              </div>
            <div class="row">
            <div class="col-6">
            <a href="{{ url('/') }}" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a>
            </div>

            <div class="col-6">
              <a onclick="return place_order()" type="button"  class="btn btn-success float-right"> Place Order</a>
              </div>
            </div>
          </div>
        </div> 
      </div>
    </div>
  </div>

@endsection
@push('mobile/page_scripts')
<script>
    function removeProduct(id){
        $("#row_" + id).remove();
        let products = [];
        let items = JSON.parse(localStorage.getItem('products'));
        for (var i =0; i< items.length; i++) {
            if (items[i].id != id) {
                products.push({'id' : items[i].id ,'name' : items[i].name ,'price' : items[i].price,'quantity' : items[i].quantity});
            }
        }
        localStorage.removeItem(products);
        localStorage.setItem('products', JSON.stringify(products));
        toastr.options.timeOut = 5000;
        toastr.success("Item removed from cart");
        show_cart();
    }

    function plus_item(row,id,self){
        var total = 0.0;
        var divUpd = $(self).parent().find('.value');
        var divAmt = $(self).parent().parent().find('.amount');
        newVal = parseInt(divUpd.val(), 10) + 1;
        divUpd.val(newVal);
        let storageProducts = JSON.parse(localStorage.getItem('products'));
        for (i = 0; i < storageProducts.length; i++) {
          if(storageProducts[i]["id"]==id){
            storageProducts[i]["quantity"] = newVal;
            divAmt.html("&#2352;&nbsp;"+  storageProducts[i]["quantity"] * storageProducts[i]["price"]);
          }
          total = total + storageProducts[i]["quantity"] * storageProducts[i]["price"];
        }
        localStorage.setItem('products', JSON.stringify(storageProducts));
        $("#mytotal").html(total);
    }

    function minus_item(row,id,self){
        var total = 0.0;
        var divUpd = $(self).parent().find('.value');
        var divAmt = $(self).parent().parent().find('.amount');
        newVal = parseInt(divUpd.val(), 10) - 1;
        if (newVal >= 1) {
            divUpd.val(newVal);
            let storageProducts = JSON.parse(localStorage.getItem('products'));
            for (i = 0; i < storageProducts.length; i++) {
              if(storageProducts[i]["id"]==id){
                storageProducts[i]["quantity"] = newVal;
                divAmt.html("&#2352;&nbsp;"+  storageProducts[i]["quantity"] * storageProducts[i]["price"]);
              }
              total = total + storageProducts[i]["quantity"] * storageProducts[i]["price"];
            }
            localStorage.setItem('products', JSON.stringify(storageProducts));
            $("#mytotal").html(total);
        }
    }

    function show_cart(){
        $("#cartbody").html("");
        let products = [];
        if(localStorage.getItem('products')){
            products = JSON.parse(localStorage.getItem('products'));
        }
        var exists = false;
        var html = "";
        var subtotal = 0;
        var total = 0;
        var id = 0;
        for (i = 0; i < products.length; i++) {
            id = products[i]["id"];
            subtotal = products[i]["price"] * products[i]["quantity"];
            total = total + subtotal;
            exists = true;
            html = html + "<tr id='row_"+id+"'><td>" + products[i]["name"] + "</td><td style='text-align:right'>" + products[i]["price"] + "</td><td style='text-align:right' valign='center'>";
			
            html += "<a onclick='minus_item("+i+","+id+",this)' class='btn btn-danger btn-sm'>-</a>";
            html += '<input type"text" size="2" maxlength="2" class="value number" readonly value="'+products[i]["quantity"]+'" />';
            html += "<a onclick='plus_item("+i+","+id+",this)' class='btn btn-success btn-sm'>+</a>";
			
            html = html + "</td><td style='text-align:right' class='amount'>&#2352; " + subtotal + "</td><td><a onclick='removeProduct("+id+")' class='btn btn-sm btn-danger'>X</a></td></tr>";
        }
        if(exists){
            html = html + "<tr><td style='text-align:right' colspan='4'>Total&nbsp;&#2352;&nbsp;<span id='mytotal'>" + total + "</span><td></tr>";
            $("#cartbody").append(html);
        }
        if(!exists){
            $("#cartbody").html("<tr><td style='text-align:right' colspan='4'>Your Shopping Cart is empty</td></tr>");
        }
        $("#lblCartCount").html(products.length);
 }
	$( document ).ready(function() {
    show_cart();
	});

 function place_order() {
  var delivery_person = $("#delivery_person").val().trim();
		    if(delivery_person == ""){
		    	alert('Please enter Delivery Person Name');
          $("#delivery_person").focus()
		        return false;
		    }

            var deliverymobile = $("#deliveryphone").val().trim();
		    if(deliverymobile == ""){
		    	alert('Please enter Delivery Person Mobile No');
          $("#deliveryphone").focus()
		        return false;
		    }

            var deliveryaddress = $("#deliveryaddress").val().trim();
		    if(deliveryaddress == ""){
		    	alert('Please enter Delivery Address');
          $("#deliveryaddress").focus()
		        return false;
		    }
    let products = [];
    if(localStorage.getItem('products')){
        products = JSON.parse(localStorage.getItem('products'));
    }
    if(products.length == 0){
        alert("No items in cart to place an order");
        return;
    }
    var total = parseFloat($("#mytotal").html());
    if(total < 3000) {
        alert("Minimum shopping amount is ₹ 3000");
        return;
    }
    var user_loggedin = $("#user_loggedin").val();
    if(user_loggedin == 1){
        if(localStorage.getItem('products')){
            products = JSON.parse(localStorage.getItem('products'));
        }
        products = JSON.stringify(products);
        
        $.ajax({
            url: "{{ url('/savecart') }}",
            type: "POST",
            data: {
                products: products,
                "_token": $('#token').val(),deliveryperson : delivery_person,deliverymobile : deliverymobile,deliveryaddress : deliveryaddress,
            },
            success: function(productsarray) {
                localStorage.removeItem("products");
                show_cart();
                $('#delivery_person').val('');
                $('#deliveryphone').val('');
                $('#deliveryaddress').val('');
                alert("Order placed successfully");
            }
        });
    }else{
       alert("Please Login First");
    }
}
</script>
@endpush
