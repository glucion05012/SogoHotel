
	<footer class="footer bg-default pb-2">
		<div class="container">
			<div class="body links text-center">
				<div class="d-flex flex-wrap justify-content-center">
					<div class="p-3 pl-4 pr-4">
						<a href="{{ url('/about-us') }}">About Us</a>
					</div>
					<div class="p-3 pl-4 pr-4">
						<a href="https://foodandbeverages.hotelsogo.com/">Food & Beverages</a>
						<!-- <a href="{{ url('/food-beverages/healthy-breakfast') }}">Food & Beverages</a> -->
					</div>
					<div class="p-3 pl-4 pr-4">
						<a href="https://update.hotelsogo.com/">Updates</a>
					</div>
					<div class="p-3 pl-4 pr-4">
						<a href="https://sogocares.ph/">Sogo Cares</a>
					</div>
					<div class="p-3 pl-4 pr-4">
						<a href="{{ url('/careers') }}">Careers</a>
					</div>
				</div>
			</div>
		</div>
		<hr>
		<div class="container">
			<div class="copyright body">
				<div class="d-flex flex-column flex-md-wrap flex-lg-row justify-content-around align-items-center">
					<div class="p-2">
						Stay Connected
						@foreach($social_icons as $key => $row)
						<a href="{{ $row->url }}" target="_blank" class="icons mr-2 mb-2 {{ $key > 0 ? '' : 'ml-3' }}">
							<i class="{{ $row->icon }}"></i>
						</a>
						@endforeach
					</div>
					<div class="p-2">
						®2017-2021 Hotel Sogo. All Rights Reserved
					</div>
					<div class="p-2 d-flex flex-column flex-md-row justify-content-around align-items-center">
						<div class="p-1 p-md-2">
							Get the SOGO App
						</div>
						<div class="p-1 p-md-2">
							<a href="#">
								<img src="{{ asset('images/google.png') }}" class="google mb-2" width="155">
							</a>
						</div>
						<div class="p-1 p-md-2">
							<a href="#">
								<img src="{{ asset('images/apple.png') }}" class="apple mb-2" width="155">
							</a>
						</div>						
					</div>
				</div>
			</div>
		</div>
	</footer>

	<div class="modal fade" id="search" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content border-0">
				<div class="modal-header">
					<h4 class="modal-title w-100 text-center">Hotel SOGO Search</h4>
			        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        </div>
				<div class="modal-body">
					<form action="{{ url('/search') }}" method="GET">
						<input type="search" name="key" class="form-control" placeholder="Search">
						<div class="text-center text-md-right mt-3">
							<button type="submit" class="btn btn-warning">SEARCH</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<!--back to top-->
    <a href="#" class="back-to-top" id="back-to-top"><i class="ti-angle-up"></i></a>
