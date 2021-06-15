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

	<section class="branches bg-default scrolly font-arial mb-3">
		<div class="container">
			<div class="card mb-5 probootstrap-animate">
			  	<div class="card-body d-flex justify-content-between align-items-center">
			  		<div class="p-0">
					    <h2 class="card-title m-0">Metro Manila</h2>
					</div>
					<div class="p-0">
					    <h4 class="card-title m-0">General No: {{ $settings->phone }}</h4>
					</div>
			  	</div>
			  	<div class="table-responsive">
					<table class="table">
						<thead>
							<tr>
								<!-- <th width="40%">Branch</th>
								<th width="25%"></th>
								<th width="30%">Telephone No.</th>
								<th width="5%"></th> -->
								<th width="30%">Branch</th>
								<th  width="25%"></th>
								<th  width="10%"></th>
								<th width="30%">Telephone No.</th>
								<th width="5%"></th>
							</tr>
						</thead>
						<tbody>
							@foreach($branches as $row)
							@if($row->region_id == 16)
							<tr>
								<td><a href="{{ url('/branches/'.$row->url) }}">{{ $row->name }}</a></td>
								<td><button onclick="window.location.href='{{ url('/branches/'.$row->url) }}'" style="background-color: red; border-radius: 30px; border: 0; color: white; cursor: pointer; padding: 0 40px;">Room Rates</button></td>
								<td><i class="fas fa-walking">&nbsp;&nbsp;&nbsp;<i class="fas fa-car"></i></td>
								
								<td><a href="tel:{{$row->phone}}" style="text-decoration:none;">
                        			    {{ $row->phone }}
                        			</a></td>
								<td class="text-right"><i class="far fa-dot-circle"></i></td>
							</tr>
							@endif
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
			<div class="card probootstrap-animate">
			  	<div class="card-body">
					<h2 class="card-title m-0">Provincial</h2>
			  	</div>
			  	<div class="table-responsive">
					<table class="table">
						<thead>
							<tr>
								<!-- <th width="40%">Branch</th>
								<th width="25%"></th>
								<th width="30%">Telephone No.</th>
								<th width="5%"></th> -->
								<th width="30%">Branch</th>
								<th  width="25%"></th>
								<th  width="10%"></th>
								<th width="30%">Telephone No.</th>
								<th width="5%"></th>
							</tr>
						</thead>
						<tbody>
							@foreach($branches as $row1)
							@if($row1->region_id != 16)
							<tr>
								<td><a href="{{ url('/branches/'.$row1->url) }}">{{ $row1->name }}</a></td>
								<td><button onclick="window.location.href='{{ url('/branches/'.$row1->url) }}'" style="background-color: red; border-radius: 30px; border: 0; color: white; cursor: pointer; padding: 0 40px;">Room Rates</button></td>
								<td><i class="fas fa-walking">&nbsp;&nbsp;&nbsp;<i class="fas fa-car"></i></td>
								<td><a href="tel:{{$row->phone}}" style="text-decoration:none;">
                        			    {{ $row1->phone }}
                        			</a></td>
								<td class="text-right"><i class="far fa-dot-circle"></i></td>
							</tr>
							@endif
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</section>

	<section class="newest-branch bg-red font-arial pb-0">
		<h2 class="title text-center pb-4">VISIT OUR NEWEST BRANCH</h2>
		<div class="row no-gutters">
			@foreach($new_branches as $key => $row2)
			<?php
				$effects = '';
				if($key == 0){
					$effects = 'fadeInLeft';
				}elseif($key == 1){
					$effects = 'fadeIn';
				}else{
					$effects = 'fadeInRight';
				}
			?>
			<div class="col-md-4 position-relative probootstrap-animate" data-animate-effect="{{ $effects }}">
				<img src="{{ asset('images/'.$row2->directory.'/'.$row2->filename) }}" width="100%" alt="{{ $row2->alt }}">
				<div class="caption text-center position-absolute">
					<img src="{{ asset('images/branches-pin.svg') }}" width="10%">
					<h2 class="title">Hotel Sogo - {{ $row2->name }}</h2>
				</div>
			</div>
			@endforeach
		</div>
	</section>

@endsection