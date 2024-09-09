@extends('layouts.other_app')
@section('content')
<section class="bg-light">
    <div class="container">
        <div class="card">
            <div class="card-body">
                @if (Auth::user())
                <input type="hidden" id="user_loggedin" value="1">
                @else
                <input type="hidden" id="user_loggedin" value="0">
                @endif
                <table id="cart" class="table table-hover table-condensed">
                    <thead>
                        <tr>
                            <th>Item Name</th>
                            <th style='text-align:right'>Price</th>
                            <th style='text-align:right'>Quantity</th>
                            <th style='text-align:right'>Subtotal</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="cartbody">

                    </tbody>
                   
                </table>
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <label id="reqname" style="color:red"></label>
                        <div class="form-group">
                            <div class="input-with-icon">
                                <input type="text" name="delivery_person" id="delivery_person" required="required"
                                    maxlength="50" class="form-control" placeholder="Delivery Person Name">
                                <i class="ti-user"></i>
                            </div>
                        </div>
                    </div>
                 
                    <div class="col-lg-6 col-md-6">
                        <label id="reqphone" style="color:red"></label>
                        <div class="form-group">
                            <div class="input-with-icon">
                                <input type="text" name="deliveryphone" id="deliveryphone" maxlength="15"
                                    required="required" class="form-control number" placeholder="Delivery Person Mobile No">
                                <i class="lni-phone-handset"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12">
                        <label id="address" style="color:red"></label>
                        <div class="form-group">
                            <div class="input-with-icon">
                                <textarea row="2" type="text" name="deliveryaddress" id="deliveryaddress" maxlength="250"
                                    required="required" class="form-control" placeholder="Delivery Address"></textarea>
                                <i class="ti-email"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <a href="{{ url('/') }}" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a>
                    <a onclick="return place_order()" type="button"  class="btn btn-success"><i class="fa fa-angle-right"></i> Place Order</a>
                </div>
            </div>
        </div>
    </div>

</section>
@endsection

@push('page_scripts')
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
            html += '&nbsp;<input type"text" size="2" maxlength="2" class="value number" readonly value="'+products[i]["quantity"]+'" />&nbsp;';
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
		        return false;
		    }

            var deliverymobile = $("#deliveryphone").val().trim();
		    if(deliverymobile == ""){
		    	alert('Please enter Delivery Person Mobile No');
		        return false;
		    }

            var deliveryaddress = $("#deliveryaddress").val().trim();
		    if(deliveryaddress == ""){
		    	alert('Please enter Delivery Address');
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
        var CSRF_TOKEN = $("input[name=_token]").val();
        $.ajax({
            url: "{{ url('/savecart') }}",
            type: "POST",
            data: {
                products: products,
                _token: CSRF_TOKEN,deliveryperson : delivery_person,deliverymobile : deliverymobile,deliveryaddress : deliveryaddress,
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
        $('#loginshop').modal('show');
    }
}
</script>
@endpush

