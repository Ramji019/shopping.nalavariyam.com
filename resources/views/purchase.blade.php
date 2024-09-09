@extends('layouts.other_app')
@section('content')
<section>
	<div class="container-fluid">
		
		<div class="row justify-content-center">
			<div class="col-lg-7 col-md-10 text-center">
				<div class="sec-heading center">
					<h2>Plans</h2>
				</div>
			</div>
		</div>
		
		<div class="row">
			@include('user.user-menu')
			
			@foreach($plans as $plan)
			<div class="col-lg-4 col-md-4">
				<div class="pricing-wrap platinum-pr recommended">
					<div class="pricing-header">
						<h4 class="pr-value"><sup>&#8377;</sup>{{ $plan->amount }}</h4>
						<h4 class="pr-title">{{ $plan->plan_name }}</h4>
					</div>
					<div class="pricing-body">
						<ul>
							<li class="available">{{ $plan->no_of_products }} Products</li>
							<li class="available">{{ $plan->days }} </li>
						</ul>
					</div>
					<div>
						<p>{{ $plan->description }}</p>
					</div>  
					<div class="pricing-bottom">
						<a href="#" class="btn btn-primary">Choose Plan</a>
					</div>
				</div>
			</div>
			@endforeach
		</div>
	</div>	
</section>
@endsection

@push('page_scripts')
<script>
	
</script>
@endpush