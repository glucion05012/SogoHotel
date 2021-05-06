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

	<section class="each_branch bg-default scrolly font-arial mb-3">
		<div class="container">
			<nav aria-label="breadcrumb">
			  	<ol class="breadcrumb">
				    <li class="breadcrumb-item"><a href="{{ url('/branches') }}">Branches</a></li>
				    <li class="breadcrumb-item active" aria-current="page">Hotel Sogo {{ $branch->branch_name }}</li>
			  	</ol>
			</nav>
			<div class="row">
				<div class="col-md-6 probootstrap-animate" data-animate-effect="fadeInLeft">
					<div class="title">
						<h4 class="m-0">Hotel Sogo - {{ $branch->branch_name }}</h4>
					</div>
					<div class="item mb-3">
						<ul id="image-gallery" class="gallery list-unstyled cS-hidden">
							@foreach($galleries as $row)
		                    <li data-thumb="{{ asset('images/'.$row->directory.'/'.$row->filename) }}"> 
		                        <img src="{{ asset('images/'.$row->directory.'/'.$row->filename) }}" width="100%" alt="{{ $row->alt }}">
		                    </li>
		                    @endforeach
		                </ul>
					</div>
					<h5><strong>{{ $branch->street.' '.$branch->barangay.' '.$branch->city.', '.$branch->province }}</strong></h5>

					<div id="gmaps" class="mt-4" style="width: 100%; height: 400px;"></div>
				</div>
				<div class="col-md-6 probootstrap-animate" data-animate-effect="fadeInRight">
					<div class="table-responsive">
						<table class="table table-bordered m-0">
							<thead>
								<tr>
									<th colspan="3"><h5 class="text-center m-1">WEEKDAYS RATES</h5></th>	
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><strong>Room Type</strong></td>
									<td><strong>12 Hours</strong></td>
									<td><strong>24 Hours</strong></td>
								</tr>
								@foreach($rates as $row1)
								@if($row1->type == 'weekdays')
								<tr>
									<td>{{ $row1->room_name }}</td>
									<td>Php {{ number_format($row1->hours_12, 2) }}</td>
									<td>Php {{ number_format($row1->hours_24, 2) }}</td>
								</tr>
								@endif
								@endforeach
							</tbody>
						</table>
						<table class="table table-bordered m-0">
							<thead>
								<tr>
									<th colspan="3"><h5 class="text-center m-1">WEEKEND RATES</h5></th>	
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><strong>Room Type</strong></td>
									<td><strong>12 Hours</strong></td>
									<td><strong>24 Hours</strong></td>
								</tr>
								@foreach($rates as $row2)
								@if($row2->type == 'weekend')
								<tr>
									<td>{{ $row2->room_name }}</td>
									<td>Php {{ number_format($row2->hours_12, 2) }}</td>
									<td>Php {{ number_format($row2->hours_24, 2) }}</td>
								</tr>
								@endif
								@endforeach
							</tbody>
						</table>
					</div>
					<div class="card border-0 mt-4">
						<div class="row no-gutters">
							<div class="col-6 p-2 d-flex flex-wrap align-items-center justify-content-center text-center">
								<div class="p-2">
									<i class="fas fa-phone"></i>
								</div>
								<div class="p-2">
								 	 {{ $branch->phone.(!empty($branch->fax) ? ' / '.$branch->fax : '') }}
								</div>
							</div>
							<div class="col-6 p-2 d-flex flex-wrap align-items-center justify-content-center text-center">
								<div class="p-2">
									<i class="fas fa-mobile-alt"></i>
								</div>
								<div class="p-2">
								 	 {{ $branch->mobile }}
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	@include('website.body.cta')

	<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCDcWNUQahp0t4bxvHnSJ1Z3CZB2xZVMFA&callback=initMap"></script>

	<script>
		function initMap(){

            var latitude = {{ $branch->longitude }};
            var longitude = {{ $branch->latitude }};
            var icon = {
				url : '{{ asset('images/pin.png') }}',
				scaledSize: new google.maps.Size(45,50),
			}
            var options = {
                zoom: {{ $branch->zoom }},
                center: new google.maps.LatLng(latitude, longitude),
                streetViewControl: false
            };

            var map = new google.maps.Map(document.getElementById("gmaps"), options);
            var marker = new google.maps.Marker({
                position: {lat: latitude, lng: longitude},
                map: map,
                icon: icon
            });

        };
    </script>

@endsection