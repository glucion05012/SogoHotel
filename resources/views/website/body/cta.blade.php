	
	<section class="cta bg-default pb-0">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-md-6 mb-4 probootstrap-animate" data-animate-effect="fadeInLeft">
					<div class="card">
					  	<div class="card-header bg-transparent text-center">Book Now</div>
				  		<div class="card-body d-flex flex-wrap align-items-center justify-content-center">
				    		<p class="card-text text-center">Hassle-free reservation right at your fingertips. Click here for more!</p>
						    <a href="#" class="link"><i class="fas fa-angle-right fa-2x ml-1"></i></a>
				  		</div>
					</div>
				</div>
				<div class="col-lg-3 col-md-6 mb-4 probootstrap-animate" data-animate-effect="fadeInLeft">
					<div class="card">
					  	<div class="card-header bg-transparent text-center">Where to find Hotel Sogo?</div>
				  		<div class="card-body d-flex flex-wrap align-items-center justify-content-center">
				    		<p class="card-text text-center">We're right here for you. Find us in our {{ $all_branches }} branches nationwide.</p>
						    <a href="{{ url('/branches') }}" class="link"><i class="fas fa-angle-right fa-2x ml-1"></i></a>
				  		</div>
					</div>
				</div>
				<div class="col-lg-3 col-md-6 mb-4 probootstrap-animate" data-animate-effect="fadeInRight">
					<div class="card">
					  	<div class="card-header bg-transparent text-center">Share this page!</div>
				  		<div class="card-body d-flex flex-wrap align-items-center justify-content-center">
				  			<p class="card-text text-center">Share your story with us and check our official pages below.</p>
				  			@foreach($social_icons as $row)
				    		<div class="p-4">
				    			<a href="{{ $row->url }}" target="_blank" class="card-text"><i class="{{ $row->icon }}"></i></a>
				    		</div>
				    		@endforeach
				  		</div>
					</div>
				</div>
				<div class="col-lg-3 col-md-6 mb-4 probootstrap-animate" data-animate-effect="fadeInRight">
					<div class="card">
					  	<div class="card-header bg-transparent text-center">Inquiry</div>
				  		<div class="card-body d-flex flex-wrap align-items-center justify-content-center">
				    		<p class="card-text text-center">Got a question? Message us here.</p>
						    <a href="{{ url('/inquiry-comments') }}" class="link"><i class="fas fa-angle-right fa-2x ml-1"></i></a>
				  		</div>
					</div>
				</div>
			</div>
		</div>
	</section>