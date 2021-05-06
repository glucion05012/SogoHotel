@extends('cms.master')
@section('body')

	<div class="content-wrapper">
		<div class="container-fluid">
			@if(!empty($type))
      		<h3 class="title mt-3">{{ $type != 'edit' ? 'Add Promo' : 'Update Promo' }}</h3>
	      	<div class="v-line mb-5"></div>

	      	<div class="row">
	      		<div class="col-md-9 mx-md-auto">
	      			<form id="frmAddPromos">
		      			<h3 class="title text-center">SEO Content</h3>
	      				<div class="v-line mx-auto mb-4"></div>

	      				<input type="hidden" name="seo_id" value="{{ $promos ? $promos->seo_id : '' }}">
		      			<input type="hidden" name="image_id" value="{{ $promos ? $promos->image_id : '' }}">

		      			<div class="form-group">
		      				<label>Meta Title <span class="text-danger">*</span></label>
		      				<input type="text" name="seo_title" class="form-control" value="{{ $promos ? $promos->title : '' }}">
		      			</div>
		      			<div class="form-group">
		      				<label>Meta Description <span class="text-danger">*</span></label>
		      				<textarea name="seo_description" rows="4" class="form-control">{{ $promos ? $promos->description : '' }}</textarea>
		      			</div>
		      			<div class="form-group">
		      				<label>Meta Keywords <span class="text-danger">*</span></label>
		      				<input type="text" name="seo_keywords" class="form-control" value="{{ $promos ? $promos->keywords : '' }}">
		      			</div>

		      			<h3 class="title text-center mt-5">Promos Content</h3>
		      			<div class="v-line mx-auto mb-4"></div>

		      			<div class="row">
		      				<div class="col-md-7">
				      			<div class="form-group">
				      				<label>Promos Main Image</label>
				      				<input type="file" name="image" accept="image/*" style="display: none;">
				      				<a href="javascript:void(0)" id="upload">
				      					<img src="{{ $promos ? asset('images/promos/'.$promos->filename) : asset('images/promos/default.jpg') }}" class="banner" width="100%">
				      				</a>
				      				<p class="text-danger text-right mb-0">Note: required image <strong>(952 x 680)</strong></p>
				      			</div>
				      		</div>
		      				<div class="col-md-5">
				      			<div class="form-group">
				      				<label>Thumbnail</label>
				      				<input type="file" name="thumbnail" accept="image/*" style="display: none;">
				      				<a href="javascript:void(0)" id="upload1">
				      					<img src="{{ $promos ? asset('images/promos/'.$promos->thumbnail) : asset('images/promos/default1.jpg') }}" class="banner1" width="100%">
				      				</a>
				      				<p class="text-danger text-right mb-0">Note: required thumbnail <strong>(639 x 834)</strong></p>
				      			</div>
				      		</div>
				      	</div>
		      			<div class="form-group">
		      				<label>Title <span class="text-danger">*</span></label>
		      				<input type="text" name="promos_title" class="form-control" value="{{ $promos ? $promos->title : '' }}">
		      			</div>
		      			<div class="form-group">
		      				<label>Description <span class="text-danger">*</span></label>
		      				<textarea name="promos_description" id="editor">{{ $promos ? $promos->description : '' }}</textarea>
		      			</div>
			      		<div class="row">
			      			<div class="col-md-8">
			      				<div class="form-group">
				      				<label>Alt Text <span class="text-danger">*</span></label>
			      					<input type="text" name="alt" class="form-control" value="{{ $promos ? $promos->alt : '' }}">
			      				</div>
			      			</div>
			      			<div class="col-md-4">
			      				<div class="form-group">
				      				<label>Status <span class="text-danger">*</span></label>
				      				<select name="status" class="form-control select2">
				      					<option value="1" {{ $promos ? $promos->status_id != 1 ? '' : 'selected' : '' }}>Active</option>
				      					<option value="2" {{ $promos ? $promos->status_id != 2 ? '' : 'selected' : '' }}>Inactive</option>
				      				</select>
				      			</div>
			      			</div>
			      		</div>
		      			<div class="form-group text-right">
		      				<a href="{{ url('/cms/maintenance/promos') }}" class="btn btn-dark">Cancel</a>
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
			    	<a href="{{ url('/cms/maintenance/promos/add') }}" class="btn btn-primary">Add Promo</a>
			    </div>
			</div>
      		<div class="table-responsive mt-4 mb-4">
      			<table class="table table-striped table-bordered tableData" data-url="promos">
      				<thead>
      					<th width="25%">Image</th>
      					<th width="15%">Title</th>
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
	            appCms.initPromosData();
	        });
	    </script>

@endsection