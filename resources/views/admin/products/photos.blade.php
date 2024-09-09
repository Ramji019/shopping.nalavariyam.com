@extends('layouts.admin_app')

@section('content')
<div class="container-fluid">
<div class="row">
<div class="col-md-12">
<div class="content-header">
</div>
<div class="card card-primary">
<div class="card-header">
<h3 class="card-title">Product Photos</h3>
</div>
<div class="card-body">
    <div class="row">
    @foreach($photos as $photo)
        <div class="col-md-3">
            @if(count($photos) > 1)
            <a href="{{ url('/admin/delete') }}/{{ $photo->id }}/{{ $photo->product_id }}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
            @endif
            <img height="200" border="1" style=" margin: 5px;" src="{{ URL::to('/') }}/uploads/products/{{ $photo->photo }}" class="img-fluid mx-auto" />
        </div>
    @endforeach
</div>
</div>
</div>
</div>


    </div>
</div>
@endsection
@push('page_scripts')
<script>
    function edit_products(id, product_name, description, status,price ) {
        $("#editproductsname").val(product_name);
        $("#editdescription").val(description);
        $("#editstatus").val(status);
        $("#editprice").val(price);
        $("#product_id").val(id);
        $("#editproducts").modal("show");
    }
</script>
@endpush