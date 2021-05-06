@extends('cms.master')
@section('body')

	<div class="content-wrapper">
		<div class="container-fluid">
			@if(!empty($type))
      		<h3 class="title mt-3">{{ $type != 'edit' ? 'Add Food & Beverage' : 'Update Food & Beverage' }}</h3>
	      	<div class="v-line mb-5"></div>

	      	<div class="row">
	      		<div class="col-md-9 mx-md-auto">
	      			<form id="frmAddFoodBeverages">
		      			<input type="hidden" name="image_id" value="{{ $foods ? $foods->image_id : '' }}">
		      			<div class="form-group">
		      				<select name="category" class="form-control select2">
		      					@foreach($category as $row)
		      					<option value="{{ $row->id }}" {{ $foods ? $foods->category_id != $row->id ? '' : 'selected' : '' }}>{{ $row->name }}</option>
		      					@endforeach
		      				</select>
				      	</div>
		      			<div class="form-group">
		      				<input type="file" name="image" accept="image/*" style="display: none;">
		      				<div class="text-center">
			      				<a href="javascript:void(0)" id="upload">
			      					<img src="{{ $foods ? asset('images/food_beverages/'.$foods->filename) : asset('images/food_beverages/default.jpg') }}" class="banner" width="50%">
			      				</a>
			      				<p class="text-danger mb-0">Note: required image <strong>(500 x 500)</strong></p>
			      			</div>
		      			</div>
		      			<div class="form-group">
		      				<label>Title <span class="text-danger">*</span></label>
		      				<input type="text" name="title" class="form-control" value="{{ $foods ? $foods->title : '' }}">
		      			</div>
		      			<div class="form-group">
		      				<label>Description <span class="text-danger">*</span></label>
		      				<textarea name="description" id="editor">{{ $foods ? $foods->description : '' }}</textarea>
		      			</div>
			      		<div class="row">
			      			<div class="col-md-8">
			      				<div class="form-group">
				      				<label>Alt Text <span class="text-danger">*</span></label>
			      					<input type="text" name="alt" class="form-control" value="{{ $foods ? $foods->alt : '' }}">
			      				</div>
			      			</div>
			      			<div class="col-md-4">
			      				<div class="form-group">
				      				<label>Status <span class="text-danger">*</span></label>
				      				<select name="status" class="form-control select2">
				      					<option value="1" {{ $foods ? $foods->status_id != 1 ? '' : 'selected' : '' }}>Active</option>
				      					<option value="2" {{ $foods ? $foods->status_id != 2 ? '' : 'selected' : '' }}>Inactive</option>
				      				</select>
				      			</div>
			      			</div>
			      		</div>
		      			<div class="form-group text-right">
		      				<a href="{{ url('/cms/maintenance/food-beverages') }}" class="btn btn-dark">Cancel</a>
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
			    	<a href="{{ url('/cms/maintenance/food-beverages/add') }}" class="btn btn-primary">Add Food & Beverage</a>
			    </div>
			</div>
      		<div class="table-responsive mt-4 mb-4">
      			<table class="table table-striped table-bordered tableData" data-url="food-beverages">
      				<thead>
      					<th width="15%">Image</th>
      					<th width="15%">Category</th>
      					<th width="15%">Title</th>
      					<th width="35%">Description</th>
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
	            appCms.initFoodBeveragesData();
	        });
	    </script>

@endsection