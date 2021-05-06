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

	<section class="food_beverages bg-default scrolly font-arial mb-3">
		<div class="container">
			<ul class="menu list-unstyled d-flex flex-wrap mt-2">
				@foreach($categories as $row)
				<li class="p-1 pb-3 mb-4">
					<a href="{{ url('/food-beverages/'.strtolower(replace_spaces($row->name))) }}" class="item {{ strtolower(replace_spaces($row->name)) != Request::segment(2) ? '' : 'active' }}">{{ $row->name }}</a>
				</li>
				@endforeach
			</ul>
		</div>
		<hr>
		@if(!empty($sub))
		<div class="each-food-beverages owl-carousel pt-4">
			@foreach($foods as $row1)
			<div class="item">
				<div class="row">
					<div class="col-lg-5 col-md-6 d-flex justify-content-center align-items-center">
						<img src="{{ asset('images/'.$row1->directory.'/'.$row1->filename) }}" class="rounded-circle" alt="{{ $row1->alt }}">
					</div>
					<div class="col-lg-6 offset-lg-1 col-md-6">
						<nav aria-label="breadcrumb">
						  	<ol class="breadcrumb">
							    <li class="breadcrumb-item"><a href="{{ dirname(url()->current()) }}">{{ $row1->category_name }}</a></li>
							    <li class="breadcrumb-item active" aria-current="page">{{ $row1->title }}</li>
						  	</ol>
						</nav>
						<div class="mt-4">
							<h4 class="title mb-5">{{ $row1->title }}</h4>
							<div class="body">{!! $row1->description !!}</div>
						</div>
					</div>
				</div>
			</div>
			@endforeach
		</div>
		@else
		<div class="container">
			<div class="pt-4 pb-4">
				<img src="{{ asset('images/'.$category->directory.'/'.$category->filename) }}" width="100%" alt="{{ $category->alt }}">
			</div>
		</div>
		<div class="food-beverages owl-carousel mt-4">
			@foreach($foods as $row2)
			<div class="item">
				<a href="{{ url()->current().'/'.strtolower(replace_spaces($row2->title)) }}">
					<img src="{{ asset('images/'.$row2->directory.'/'.$row2->filename) }}" class="rounded-circle" alt="{{ $row2->alt }}">

					<p class="subtitle mt-3 text-center">{{ $row2->title }}</p>
				</a>
			</div>
			@endforeach
		</div>
		@endif
	</section>

	@include('website.body.cta')

@endsection