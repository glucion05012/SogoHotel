@extends('website.master')
@section('body')

	<section class="search-result bg-default">
		<div class="container">
			<div class="row">
				<div class="col-md-9 mx-md-auto"> 
					@if($promos->count() > 0 || $events->count() > 0 || $branches->count() > 0 || $photos->count() > 0 || $foods->count() > 0)

					<div class="no-search-found text-center">
						<h2 class="title mb-3">Search Result(s)</h2>
						<hr>
					</div>

					@if($branches->count() > 0)
						<div class="mb-4">
							<h3 class="title mb-3">Branches</h3>
							@foreach($branches as $row)
							<div class="mb-1">
								<a href="{{ url('/branches/'.$row->url) }}">
									HOTEL SOGO - {{ strtoupper($row->name) }}
								</a>
							</div>
						@endforeach
						</div>
						<hr>
					@endif

					@if($promos->count() > 0)
						<div class="mb-4">
							<h3 class="title mb-3">Promos</h3>
							@foreach($promos as $row1)
							<div class="mb-1">
								<a href="{{ url('/promos/'.$row1->url) }}">
									{{ $row1->title }}
									<small><p class="ellipsis-2">{{ strip_tags($row1->description) }}</p></small>
								</a>
							</div>
							@endforeach
						</div>
						<hr>
					@endif

					@if($events->count() > 0)
						<div class="mb-4">
							<h3 class="title mb-3">Events</h3>
							@foreach($events as $row2)
							<div class="mb-1">
								<a href="{{ url('/events/'.$row2->url) }}">
									{{ $row2->title }}
									<small><p class="ellipsis-2">{{ strip_tags($row2->description) }}</p></small>
								</a>
							</div>
							@endforeach
						</div>
						<hr>
					@endif

					@if($foods->count() > 0)
						<div class="mb-4">
							<h3 class="title mb-3">Foods & Beverages</h3>
							@foreach($foods as $row3)
							<div class="mb-1">
								<a href="{{ url('/food-beverages/'.$row3->cat_url.'/'.$row3->url) }}">
									{{ $row3->title }}
									<small><p class="ellipsis-2">{{ strip_tags($row3->description) }}</p></small>
								</a>
							</div>
							@endforeach
						</div>
						<hr>
					@endif

					@if($photos->count() > 0)
						<div class="mb-4">
							<h3 class="title mb-3">Photos</h3>
							@foreach($photos as $row4)
							<div class="mb-1">
								<a href="{{ url('/photos/'.$row4->url) }}">
									{{ $row4->title }}
									<small><p class="ellipsis-2">{{ strip_tags($row4->description) }}</p></small>
								</a>
							</div>
							@endforeach
						</div>
					@endif

					@else
					<div class="no-search-found text-center">
						<h2 class="title mb-3">Search Result</h2>
						<hr>
						<p class="body mb-0">We're sorry<br>We cannot find any matches from your search term.</p>
					</div>
					@endif
				</div>
			</div>
		</div>
	</section>

@endsection