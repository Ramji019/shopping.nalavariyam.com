@extends('layouts.admin_app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="content-header">
            </div>
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Seller Products</h3>
                </div>
                <div class="card-body">
                    @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissable" style="margin: 15px;">
                        <a href="#" style="color:white !important" class="close" data-dismiss="alert"
                            aria-label="close">&times;</a>
                        <strong> {{ session('success') }} </strong>
                    </div>
                    @endif

                    <table id="example2" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th>Address</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sellerproducts as $prod)
                            <tr>
                                <td>{{ $prod->id }}</td>
                                <td>{{ $prod->product_name }}</td>
                                <td>{{ $prod->description }}</td>
                                <td>{{ $prod->price }}</td>
                                <td>{{ $prod->address }}</td>
                                @if ($prod->status == "Active")
                                <td>Active</td>
                                @else
                                <td>Inactive</td>
                                @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('page_scripts')
@endpush