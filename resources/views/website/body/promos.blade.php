@extends('website.master')
@section('body')

	<div class="header pt-header">
		<img src="{{ asset('images/'.$page->directory.'/'.$page->filename) }}" width="100%" alt="{{ $page->alt }}">
		<div class="title">
			<h1 class="text-center">{{ $page->page_title }}</h1>
		</div>
		<div class="scroll-down text-center">
			<a href="#" class="btn-scroll">
				<p class="text wow fadeInDown">Scroll Down</p>
				<div class="icon wow fadeInUp" data-wow-delay=".5s">
					<span class="faa-bounce animated"><i class="fas fa-angle-down"></i></span>
				</div>
			</a>
		</div>
	</div>

	<section class="about-us bg-default py-0 mb-4 scrolly" style="background-image: url({{ asset('images/image-bg.png') }}); background-repeat: no-repeat; background-size: cover;">
		@if(!empty($pages))
		<div class="row no-gutters p-5">
			<div class="col-lg-6 probootstrap-animate" data-animate-effect="fadeInLeft">
				<img src="{{ asset('images/'.$promos->directory.'/'.$promos->filename) }}" width="100%" alt="{{ $promos->alt }}">
			</div>
			<div class="col-lg-6 probootstrap-animate" data-animate-effect="fadeInLeft">
				<div class="panel d-flex flex-wrap align-items-center h-100">
					<div>
						<h4 class="panel-title mb-4">{{ $promos->promos_title }}</h4>
						<div class="panel-body text-justify">{!! $promos->promos_description !!}</div>
					</div>
				</div>
			</div>
		</div>
		@else
			@foreach($promos as $key => $row)
			<div class="row no-gutters {{ $key % 2 == 0 ? '' : 'flex-lg-row-reverse' }}">
				<div class="col-lg-6 probootstrap-animate" data-animate-effect="{{ $key % 2 == 0 ? 'fadeInLeft' : 'fadeInRight' }}">
					<img src="{{ asset('images/'.$row->directory.'/'.$row->filename) }}" width="100%" alt="{{ $row->alt }}">
				</div>
				<div class="col-lg-6 probootstrap-animate" data-animate-effect="{{ $key % 2 == 0 ? 'fadeInRight' : 'fadeInLeft' }}">
					<div class="panel d-flex flex-wrap align-items-center h-100">
						<div>
							<h4 class="panel-title mb-4">{{ $row->title }}</h4>
							<div class="panel-body text-justify ellipsis-6">{!! $row->description !!}</div>
							<a href="{{ url('/promos/'.$row->url) }}" class="btn btn-warning mt-4">READ MORE</a>
						</div>
					</div>
				</div>
			</div>
			@endforeach
		@endif
	</section>

	@include('website.body.cta')

@endsection