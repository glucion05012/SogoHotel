@extends('website.master')
@section('body')
	
	<div class="pt-header">
		<div class="slider">
			@foreach($slider as $row)
			<div class="items">
				<img src="{{ asset('images/'.$row->directory.'/'.$row->filename) }}" width="100%" alt="{{ $row->alt }}">
				<div class="scroll-down text-center">
					<a href="#" class="btn-scroll">
						<p class="text">Scroll Down</p>
						<div class="icon">
							<span class="faa-bounce animated"><i class="fas fa-angle-down"></i></span>
						</div>
					</a>
				</div>
			</div>
			@endforeach
		</div>
	</div>

	<section class="home-about-us bg-gradient-red text-center scrolly">
		<div class="container">
			<h4 class="subtitle text-yellow">WELCOME TO</h4>
			<h1 class="title font-arial">HOTEL SOGO</h1>
			<h5 class="body">for inquiry call</h5>
			<a href="tel:{{$settings->phone}}" style="text-decoration:none;">
			    <h2 class="number font-arial mb-3"> {{ $settings->phone }}</h2>
			</a>
			<a href="#" class="btn btn-warning mb-3">RESERVE NOW</a>
			<h2 class="number font-arial mb-4">SO CLEAN... SO GOOD!</h2>
			<div class="row probootstrap-animate">
				<div class="col-md-3 mb-md-0 mb-3">
					<div class="rounded-circle mx-auto">
						<a href="{{ url('/branches') }}">
							<img src="{{ asset('images/icons/branch.svg') }}" width="100%">
						</a>
					</div>
					<div class="panel mx-auto">
						<h4 class="panel-title mt-4">OUR BRANCHES</h4>
						<p class="panel-body m-0">Explore and see where you can stay</p>
					</div>
				</div>
				<div class="col-md-3 mb-md-0 mb-3">
					<div class="rounded-circle mx-auto">
						<a href="https://foodandbeverages.hotelsogo.com/">
						<!-- <a href="{{ url('/food-beverages/healthy-breakfast') }}"> -->
							<img src="{{ asset('images/icons/food.svg') }}">
						</a>
					</div>
					<div class="panel mx-auto">
						<h4 class="panel-title mt-4">FOOD & BEVERAGES</h4>
						<p class="panel-body m-0">Choose and dine in our mouthwatering dishes.</p>
					</div>
				</div>
				<div class="col-md-3 mb-md-0 mb-3">
					<div class="rounded-circle mx-auto">
						<a href="{{ url('/photos/executive-garage') }}">
							<img src="{{ asset('images/icons/gallery.svg') }}">
						</a>
					</div>
					<div class="panel mx-auto">
						<h4 class="panel-title mt-4">PHOTOS</h4>
						<p class="panel-body m-0">Discover what can Hotel Sogo offer.</p>
					</div>
				</div>
				<div class="col-md-3 mb-md-0 mb-3">
					<div class="rounded-circle mx-auto">
						<a href="{{ url('/inquiry-comments') }}">
							<img src="{{ asset('images/icons/comment.svg') }}">
						</a>
					</div>
					<div class="panel mx-auto">
						<h4 class="panel-title mt-4">COMMENTS OR SUGGESTIONS</h4>
						<p class="panel-body m-0">What do you think about us? Message us here</p>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="youtube bg-default p-0">
		<div class="row no-gutters">
			<div class="col-md-6 probootstrap-animate" data-animate-effect="fadeInLeft">
				<iframe width="100%" height="500" src="https://www.youtube.com/embed/{{ $page->link }}" frameborder="0" allowfullscreen></iframe>
			</div>
			<div class="col-md-6 home-desc d-flex flex-wrap align-items-center probootstrap-animate" data-animate-effect="fadeInRight">
				<div class="panel">
					<h4 class="panel-title mb-4">{{ $page->description_title }}</h4>
					<div class="panel-body ellipsis-6">{!! $page->page_description !!}</div>
				</div>
			</div>
		</div>
	</section>

	<section class="facebook bg-default p-0">
		<div class="row no-gutters">
			<div class="col-lg-4 col-md-6 probootstrap-animate" data-animate-effect="fadeInLeft">
				<a href="{{ url('/events') }}">
					<img src="{{ asset('images/events/'.($event ? $event->thumbnail : 'default1.jpg')) }}" width="100%" alt="{{ $event ? $event->alt : 'Events' }}">
					{{-- <h3 class="title">{{ $event->title }}</h3> --}}
				</a>
			</div>
			<div class="col-lg-4 col-md-6 probootstrap-animate" data-animate-effect="fadeIn">
				<a href="{{ url('/promos') }}">
					<img src="{{ asset('images/promos/'.($promo ? $promo->thumbnail : 'default1.jpg')) }}" width="100%" alt="{{ $promo ? $promo->alt : 'Promos' }}">
					{{-- <h3 class="title">{{ $promo->title }}</h3> --}}
				</a>
			</div>
			<div class="col-lg-4 text-center text-lg-left probootstrap-animate" data-animate-effect="fadeInRight">
				<div class="fb-page">
					<iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FHotelSogoOfficialPage%2F&tabs=timeline&width=500&height=550&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId" width="500" height="550" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>
				</div>
			</div>
		</div>
	</section>

@endsection