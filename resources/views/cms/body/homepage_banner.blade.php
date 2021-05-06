@extends('cms.master')
@section('body')

	<div class="content-wrapper">
		<div class="container-fluid">
			@if(!empty($type))
      		<h3 class="title mt-3">{{ $type != 'edit' ? 'Add New Banner' : 'Update Banner' }}</h3>
	      	<div class="v-line mb-5"></div>

	      	<div class="row">
	      		<div class="col-md-9 mx-md-auto">
	      			<form id="frmAddSlider">
		      			<input type="hidden" name="image_id" value="{{ $slider ? $slider->image_id : '' }}">
		      			<div class="form-group">
		      				<input type="file" name="image" accept="image/*" style="display: none;">
		      				<a href="javascript:void(0)" id="upload">
		      					<img src="{{ $slider ? asset('images/slider/'.$slider->filename) : asset('images/slider/default.jpg') }}" class="banner" width="100%">
		      				</a>
		      				<p class="text-danger text-right mb-0">Note: required image <strong>(1920 x 973)</strong></p>
		      			</div>
			      		<div class="row">
			      			<div class="col-md-8">
			      				<div class="form-group">
				      				<label>Alt Text <span class="text-danger">*</span></label>
				      				<input type="text" name="alt" class="form-control" value="{{ $slider ? $slider->alt : '' }}">
				      			</div>
			      			</div>
			      			<div class="col-md-4">
			      				<div class="form-group">
				      				<label>Status <span class="text-danger">*</span></label>
				      				<select name="status" class="form-control select2">
				      					<option value="1" {{ $slider ? $slider->status_id != 1 ? '' : 'selected' : '' }}>Active</option>
				      					<option value="2" {{ $slider ? $slider->status_id != 2 ? '' : 'selected' : '' }}>Inactive</option>
				      				</select>
				      			</div>
			      			</div>
				      	</div>
		      			<div class="form-group text-right">
		      				<a href="{{ url('/cms/maintenance/homepage-banner') }}" class="btn btn-dark">Cancel</a>
		      				<button type="submit" class="btn btn-primary btnSave">Save Changes</button>
		      			</div>
		      		</form>
	      		</div>
	      	</div>
      		
      		@else

      		<div class="row align-items-center">
				<div class="col-md-6">
		      		<h3 class="title mt-3">{{ ucwords(replace_dashes(Request::segment(3).' '.Request::segment(2))) }}</h3>
      				<div class="v-line mb-4"></div>
			    </div>
			    <div class="col-md-6 text-right">
			    	<a href="{{ url('/cms/maintenance/homepage-banner/add') }}" class="btn btn-primary">Add Homepage Banner</a>
			    </div>
			</div>
      		<div class="table-responsive mt-4 mb-4">
      			<table class="table table-striped table-bordered tableData" data-url="slider">
      				<thead>
      					<th width="80%">Image</th>
      					<th width="10%">Status</th>
      					<th width="10%">Action</th>
  					</thead>
      				<tbody></tbody>
      			</table>
      		</div>
      		@endif
		</div>

		<script type="text/javascript">
	        $(function(){
	        	appCms.init();
	            appCms.initSliderData();
	        });
	    </script>

@endsection