@extends('layouts.other_app')

@section('content')

<section class="bg-light">
    <div class="container-fluid">
        <!-- 
					<div class="row">
						<div class="col-lg-12 col-md-12">
							<div class="filter_search_opt">
								<a href="javascript:void(0);" onclick="openFilterSearch()">Dashboard Navigation<i class="ml-2 ti-menu"></i></a>
							</div>
						</div>
					</div> -->

        <div class="row">
            @include('user.user-menu')
            <div class="col-lg-9 col-md-12">

                <div class="row">

                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="dashboard-stat widget-1">
                            <div class="dashboard-stat-content">
                                <h4>{{ $product }}</h4> <span><a href="{{ route('my_products') }}" >No of Products</a></span>
                            </div>
                            <div class="dashboard-stat-icon"><i class="ti-gift"></i></div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="dashboard-stat widget-2">
                            <div class="dashboard-stat-content">
                                <h4>{{ $sellproduct }}</h4><span><a href="{{ route('sold_products') }}">Products Sold</a></span>
                            </div>
                            <div class="dashboard-stat-icon"><i class="ti-stats-up"></i></div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="dashboard-stat widget-3">
                            <div class="dashboard-stat-content">
                                <h4>{{ $favproduct }}</h4> <span><a href="{{ route('wishlist') }}">Favourite Products</a></span>
                            </div>
                            <div class="dashboard-stat-icon"><i class="ti-heart"></i></div>
                        </div>
                    </div>


                </div>

            </div>

        </div>
    </div>
</section>
<!-- ============================ User Dashboard End ================================== -->

<!-- ============================ Call To Action ================================== -->
<section class="theme-bg call-to-act-wrap">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">

                <div class="call-to-act">
                    <div class="call-to-act-head">
                        <h3>Want to Become a Real Estate Agent?</h3>
                        <span>We'll help you to grow your career and growth.</span>
                    </div>
                    <a href="#" class="btn btn-call-to-act">SignUp Today</a>
                </div>

            </div>
        </div>
    </div>
</section>
@endsection

@push('page_scripts')
<script>
$('#photo').on('change', function() {
    oFiles = this.files,
        nFiles = oFiles.length;
    if (nFiles == 0) return;
    for (var nFileId = 0; nFileId < nFiles; nFileId++) {
        fileSize = oFiles[nFileId].size / 1024 / 1024;
        if (fileSize > 10) {
            alert('File size exceeds 10 MB');
            $('#photo').val('');
            return;
        }
    }
});
</script>
@endpush