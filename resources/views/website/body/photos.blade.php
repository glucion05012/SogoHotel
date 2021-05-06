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

	<section class="photos bg-default scrolly font-arial pb-2">
		<div class="container">
			<ul class="menu list-unstyled d-flex flex-wrap mt-2">
				@foreach($categories as $row)
				<li class="p-1 pb-3 mb-4">
					<a href="{{ url('/photos/'.$row->url) }}" class="item {{ $row->url != Request::segment(2) ? '' : 'active' }}">{{ $row->name }}</a>
				</li>
				@endforeach
			</ul>
		</div>
		<hr>
		<div class="container">
			<h4 class="title pt-4 mb-3">{{ $category->category_name }}</h4>
			<div class="body text-justify mb-5">
				{!! $category->category_description !!}
			</div>
			<div class="row">
				@foreach($photos as $row1)
				<div class="col-lg-3 col-md-4 col-sm-6 mb-3 probootstrap-animate">
					<div class="items">
						<a href="javascript:void(0)" class="view" id="{{ $row1->photos_id }}">
							<img src="{{ asset('images/'.$row1->directory.'/'.$row1->filename) }}" width="100%" alt="{{ $row1->alt }}">
							<div class="caption">
								<h3 class="title mb-3">{{ $row1->title }}</h3>
								<div class="body">{!! str_limit($row1->description, 300) !!}</div>
							</div>
						</a>
					</div>
				</div>
				@endforeach
			</div>
		</div>
	</section>

	@include('website.body.cta')

	<div class="modal fade" id="photo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
			<div class="modal-content border-0">
				<div class="modal-header">
			        <h4 class="modal-title w-100 text-center"></h4>
			        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        </div>
				<div class="modal-body">
					<div class="preload text-center">
						<img src="{{ asset('images/ajax-loader.gif') }}">
					</div>
					<img src="" width="100%" class="img">
					<p class="body mt-4"></p>
				</div>
			</div>
		</div>
	</div>

@endsection