@extends('cms.master')
@section('body')

	<div class="content-wrapper">
		<div class="container-fluid">
			@if(!empty($type))
      		<h3 class="title mt-3">{{ $type != 'edit' ? 'Add Category' : 'Update Category' }}</h3>
	      	<div class="v-line mb-5"></div>

	      	<div class="row">
	      		<div class="col-md-9 mx-md-auto">
	      			<form id="frmAddCategory">
	      				<h3 class="title text-center">SEO Content</h3>
	      				<div class="v-line mx-auto mb-4"></div>

		      			<input type="hidden" name="seo_id" value="{{ $category ? $category->seo_id : '' }}">
		      			<input type="hidden" name="image_id" value="{{ $category ? $category->image_id : '' }}">
		      			<input type="hidden" name="type" value="photos">

		      			<div class="form-group">
		      				<label>Meta Title <span class="text-danger">*</span></label>
		      				<input type="text" name="seo_title" class="form-control" value="{{ $category ? $category->title : '' }}">
		      			</div>
		      			<div class="form-group">
		      				<label>Meta Description <span class="text-danger">*</span></label>
		      				<textarea name="seo_description" rows="4" class="form-control">{{ $category ? $category->description : '' }}</textarea>
		      			</div>
		      			<div class="form-group">
		      				<label>Meta Keywords <span class="text-danger">*</span></label>
		      				<input type="text" name="seo_keywords" class="form-control" value="{{ $category ? $category->keywords : '' }}">
		      			</div>
		      			<h3 class="title text-center mt-5">Category Content</h3>
		      			<div class="v-line mx-auto mb-4"></div>
		      			<div class="form-group">
		      				<label>Category <span class="text-danger">*</span></label>
		      				<input type="text" name="category_name" class="form-control" value="{{ $category ? $category->name : '' }}">
		      			</div>
		      			<div class="form-group">
		      				<label>Page Title <span class="text-danger">*</span></label>
		      				<input type="text" name="category_title" class="form-control" value="{{ $category ? $category->category_title : '' }}">
		      			</div>
		      			<div class="form-group">
		      				<label>Description <span class="text-danger">*</span></label>
		      				<textarea name="category_description" id="editor">{{ $category ? $category->category_description : '' }}</textarea>
		      			</div>
		      			<div class="form-group">
				      		<div class="row">
				      			<div class="col-md-4">
				      				<label>Status <span class="text-danger">*</span></label>
				      				<select name="status" class="form-control select2">
				      					<option value="1" {{ $category ? $category->status_id != 1 ? '' : 'selected' : '' }}>Active</option>
				      					<option value="2" {{ $category ? $category->status_id != 2 ? '' : 'selected' : '' }}>Inactive</option>
				      				</select>
				      			</div>
				      		</div>
				      	</div>
		      			<div class="form-group text-right">
		      				<a href="{{ url('/cms/category/photos') }}" class="btn btn-dark">Cancel</a>
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
			    	<a href="{{ url('/cms/category/photos/add') }}" class="btn btn-primary">Add Category</a>
			    </div>
			</div>
      		<div class="table-responsive mt-4 mb-4">
      			<table class="table table-striped table-bordered tableData" data-url="category" data-type="photos">
      				<thead>
      					<th width="20%">Name</th>
      					<th width="20%">Title</th>
      					<th width="40%">Description</th>
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
	            appCms.initCategoryData();
	        });
	    </script>

@endsection