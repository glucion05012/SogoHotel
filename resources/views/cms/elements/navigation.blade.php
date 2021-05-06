	
		<div class="collapse navbar-collapse" id="navbarResponsive">
	      	<ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
	        	<li class="nav-item {{ Request::segment(2) != 'account-setting' ? '' : 'active' }}" data-toggle="tooltip" data-placement="right" title="Account Setting">
	          		<a class="nav-link" href="{{ url('/cms/account-setting') }}">
		            	<i class="far fa-fw fa-user mr-2"></i>
		            	<span class="nav-link-text">Account Setting</span>
	          		</a>
	        	</li>
	        	<li class="nav-item {{ Request::segment(2) != 'user-manager' ? '' : 'active' }}" data-toggle="tooltip" data-placement="right" title="User Manager">
	          		<a class="nav-link" href="{{ url('/cms/user-manager') }}">
		            	<i class="fas fa-fw fa-users-cog mr-2"></i>
		            	<span class="nav-link-text">User Manager</span>
	          		</a>
	        	</li>
	        	<li class="nav-item {{ Request::segment(2) != 'page-manager' ? '' : 'active' }}" data-toggle="tooltip" data-placement="right" title="Page Manager">
	          		<a class="nav-link" href="{{ url('/cms/page-manager') }}">
		            	<i class="far fa-fw fa-file mr-2"></i>
		            	<span class="nav-link-text">Page Manager</span>
	          		</a>
	        	</li>
	        	<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Maintenance">
		          	<a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#maintenance" data-parent="#exampleAccordion">
		            	<i class="fas fa-fw fa-cogs mr-2"></i>
		            	<span class="nav-link-text">Maintenance</span>
		          	</a>
		          	<ul class="sidenav-second-level collapse" id="maintenance">
		            	<li>
		              		<a href="{{ url('/cms/maintenance/homepage-banner') }}"><i class="fas fa-fw fa-angle-double-right mr-2"></i>Homepage Banner</a>
		           		</li>
		           		<li>
		              		<a href="{{ url('/cms/maintenance/about-us') }}"><i class="fas fa-fw fa-angle-double-right mr-2"></i>About Us</a>
		           		</li>
		           		<li>
		              		<a href="{{ url('/cms/maintenance/food-beverages') }}"><i class="fas fa-fw fa-angle-double-right mr-2"></i>Food & Beverages</a>
		           		</li>
		           		<li>
		              		<a href="{{ url('/cms/maintenance/promos') }}"><i class="fas fa-fw fa-angle-double-right mr-2"></i>Promos</a>
		           		</li>
		           		<li>
		              		<a href="{{ url('/cms/maintenance/careers') }}"><i class="fas fa-fw fa-angle-double-right mr-2"></i>Careers</a>
		           		</li>
		           		<li>
		              		<a href="{{ url('/cms/maintenance/events') }}"><i class="fas fa-fw fa-angle-double-right mr-2"></i>Events</a>
		           		</li>
		           		<li>
		              		<a href="{{ url('/cms/maintenance/photos') }}"><i class="fas fa-fw fa-angle-double-right mr-2"></i>Photos</a>
		           		</li>
		          	</ul>
		        </li>
		        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Categories">
		          	<a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#category" data-parent="#exampleAccordion">
		            	<i class="far fa-fw fa-list-alt mr-2"></i>
		            	<span class="nav-link-text">Categories</span>
		          	</a>
		          	<ul class="sidenav-second-level collapse" id="category">
		            	<li>
		              		<a href="{{ url('/cms/category/food-beverages') }}"><i class="fas fa-fw fa-angle-double-right mr-2"></i>Food & Beverages</a>
		           		</li>
		           		<li>
		              		<a href="{{ url('/cms/category/photos') }}"><i class="fas fa-fw fa-angle-double-right mr-2"></i>Photos</a>
		           		</li>
		          	</ul>
		        </li>
		        <li class="nav-item {{ Request::segment(2) != 'branch-manager' ? '' : 'active' }}" data-toggle="tooltip" data-placement="right" title="Branch Manager">
	          		<a class="nav-link" href="{{ url('/cms/branch-manager') }}">
		            	<i class="fas fa-fw fa-map-marker-alt mr-2"></i>
		            	<span class="nav-link-text">Branch Manager</span>
	          		</a>
	        	</li>
	        	<li class="nav-item {{ Request::segment(2) != 'social-media-management' ? '' : 'active' }}" data-toggle="tooltip" data-placement="right" title="Social Media Management">
	          		<a class="nav-link" href="{{ url('/cms/social-media-management') }}">
		            	<i class="far fa-fw fa-thumbs-up mr-2"></i>
		            	<span class="nav-link-text">Social Media</span>
	          		</a>
	        	</li>
	        	<li class="nav-item {{ Request::segment(2) != 'database-management' ? '' : 'active' }}" data-toggle="tooltip" data-placement="right" title="Database Management">
	          		<a class="nav-link" href="{{ url('/cms/database-management') }}">
		            	<i class="fas fa-fw fa-database mr-2"></i>
		            	<span class="nav-link-text">Database Management</span>
	          		</a>
	        	</li>
	        	<li class="nav-item {{ Request::segment(2) != 'activity-logs' ? '' : 'active' }}" data-toggle="tooltip" data-placement="right" title="Activity Logs">
	          		<a class="nav-link" href="{{ url('/cms/activity-logs') }}">
		            	<i class="fas fa-fw fa-list-ul mr-2"></i>
		            	<span class="nav-link-text">Activity Logs</span>
	          		</a>
	        	</li>
	        	<li class="nav-item {{ Request::segment(2) != 'settings' ? '' : 'active' }}" data-toggle="tooltip" data-placement="right" title="Settings">
	          		<a class="nav-link" href="{{ url('/cms/settings') }}">
		            	<i class="fas fa-fw fa-cog mr-2"></i>
		            	<span class="nav-link-text">Settings</span>
	          		</a>
	        	</li>
	 		</ul>
	 		<ul class="navbar-nav sidenav-toggler">
		        <li class="nav-item">
		          	<a class="nav-link text-center" id="sidenavToggler">
		            	<i class="fas fa-fw fa-angle-left"></i>
		          	</a>
		        </li>
		    </ul>
		    <ul class="navbar-nav ml-auto">
		        <li class="nav-item">
		          	<a class="nav-link" href="{{ url('/logout') }}">
		            <i class="fas fa-power-off"></i> Logout</a>
		        </li>
		    </ul>
	 	</div>
  	</nav>
