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

	<section class="careers bg-default scrolly">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-md-8 mx-md-auto mb-5">
					<div class="text-center font-arial">{!! $page->page_description !!}</div>
				</div>
				<div class="col-lg-9 col-md-10 mx-md-auto">
					<h4 class="title text-center mb-5">{{ $page->description_title }}</h4>

					<div id="accordion" class="mb-5">
						@foreach($careers as $key => $row)
					  	<div class="card border-0 bg-transparent mb-2 probootstrap-animate">
						    <div class="card-header border-bottom-0">
						      	<h5 class="mb-0">
						        	<button class="btn btn-link d-flex align-items-center justify-content-between w-100" data-toggle="collapse" data-target="#careers-{{ $row->id }}" aria-expanded="{{ $key == 0 ? 'true' : 'false' }}" aria-controls="careers-{{ $row->id }}">
					        			<div class="p-0"> 
							          		{{ $row->title }}
							          	</div>
					        			<div class="p-0"> 
						      				<i class="{{ $key == 0 ? 'far' : 'fas' }} fa-dot-circle fa-icon" id="{{ $key }}"></i>
						      			</div>
							      	</button>
						      	</h5>
						    </div>
						    <div id="careers-{{ $row->id }}" class="collapse {{ $key == 0 ? 'show' : '' }} mt-2" data-parent="#accordion">
						      	<div class="card-body font-arial">{!! $row->description !!}</div>
						    </div>
					  	</div>
					  	@endforeach
					</div>

					<h4 class="title text-center mb-4">BE PART OF OUR TEAM. APPLY NOW!</h4>
					<form id="frmContact">
						<div class="ajax-msg">
                            <div id="msg"></div>
                        </div>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="form-group probootstrap-animate" data-animate-effect="fadeInDown">
							<select name="type" class="form-control" required>
								<option value="" selected disabled>Type of Inquiry</option>
								<option value="comment">Comment</option>
								<option value="suggestion">Suggestion</option>
							</select>
						</div>
						<div class="row">
							<div class="col-md-4 probootstrap-animate" data-animate-effect="fadeInLeft">
								<div class="form-group">
									<input type="text" name="name" class="form-control" placeholder="Name">
								</div>
							</div>
							<div class="col-md-4 probootstrap-animate" data-animate-effect="fadeIn">
								<div class="form-group">
									<input type="text" name="email" class="form-control" placeholder="Email">
								</div>
							</div>
							<div class="col-md-4 probootstrap-animate" data-animate-effect="fadeInRight">
								<div class="form-group">
									<input type="text" name="number" class="form-control" placeholder="Number">
								</div>
							</div>
						</div>
						<div class="form-group probootstrap-animate">
							<textarea name="message" rows="10" class="form-control" placeholder="Message"></textarea>
						</div>
						<div class="text-center probootstrap-animate">
							<button class="btn btn-warning">SUBMIT</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>

	<script type="text/javascript">
		$(function(){
			$('.collapse').on('shown.bs.collapse, hidden.bs.collapse', function(){
				$('.fa-icon').removeClass('far');
				$('.fa-icon').addClass('fas');

				$('.btn-link').each(function(a){
					var data = $(this).attr('aria-expanded');
					
					if(data === 'true'){
						$('#' + a).removeClass('fas');
						$('#' + a).addClass('far');
					}
				});
			});
		});
	</script>

@endsection