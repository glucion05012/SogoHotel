
	<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
		<div class="container">
			<div class="d-flex flex-wrap justify-content-between align-items-center w-100">
				<div class="">
					<a class="navbar-brand" href="{{ url('/') }}">
				  		<img src="{{ asset('images/logo.jpg') }}" class="logo" alt="SOGO" height="70">
				  	</a>
				</div>
				<a class="d-block d-lg-none ml-auto mr-2 search" href="#" data-toggle="modal" data-target="#search"><i class="fas fa-search"></i></a>
			  	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
			    	<span class="navbar-toggler-icon"></span>
			  	</button>

			  	<div class="collapse navbar-collapse" id="navbarNavDropdown">
			    	<ul class="navbar-nav ml-auto mt-2 mt-lg-0">
			    		<li class="nav-item {{ Request::segment(1) != '' ? '' : 'active' }}">
			        		<a class="nav-link" href="{{ url('/') }}">Home</a>
			      		</li>
			      		<li class="nav-item {{ Request::segment(1) != 'about-us' ? '' : 'active' }}">
			        		<a class="nav-link" href="{{ url('/about-us') }}">About Us</a>
			      		</li>
			      		<li class="nav-item {{ Request::segment(1) != 'branches' ? '' : 'active' }}">
			        		<a class="nav-link" href="{{ url('/branches') }}">Branches</a>
			      		</li>
			      		<!-- <li class="nav-item {{ Request::segment(1) != 'food-beverages' ? '' : 'active' }}">
			        		<a class="nav-link" href="{{ url('/food-beverages/healthy-breakfast') }}">Food & Beverages</a>
			      		</li> -->
			      		<li class="nav-item {{ Request::segment(1) != 'food-beverages' ? '' : 'active' }}">
			        		<a class="nav-link" href="https://foodandbeverages.hotelsogo.com/">Food & Beverages</a>
			      		</li>
			      		<li class="nav-item {{ Request::segment(1) != 'promos' ? '' : 'active' }}">
			        		<a class="nav-link" href="{{ url('/promos') }}">Promos & Discounts</a>
			      		</li>
			      		<li class="nav-item">
			        		<a class="nav-link {{ Request::segment(1) != 'photos' ? '' : 'active' }}" href="{{ url('/photos/executive-garage') }}">Gallery</a>
			      		</li>
			      		<li class="nav-item">
			        		<a class="nav-link" target="_blank" href="https://update.hotelsogo.com/">Updates</a>
			      		</li>
			      		<!-- <li class="nav-item">
			        		<a class="nav-link" target="_blank" href="https://www.sogocares.com/">Sogo Cares</a>
			      		</li> -->
			      		<li class="nav-item">
			        		<a class="nav-link" href="https://sogocares.ph/">Sogo Cares</a>
			      		</li>
			      		<li class="nav-item {{ Request::segment(1) != 'careers' ? '' : 'active' }}">
			        		<a class="nav-link" href="{{ url('/careers') }}">Careers</a>
			      		</li>
			      		<li class="nav-item d-none d-lg-block">
				        	<a class="nav-link" href="#" data-toggle="modal" data-target="#search"><i class="fas fa-search"></i></a>
			      		</li>
			    	</ul>
			  	</div>
			</div>
		</div>
	</nav>