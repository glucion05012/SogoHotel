@extends('cms.master')
@section('body')

	<div class="content-wrapper">
		<div class="container-fluid">
			@if(!empty($type))
      		<h3 class="title mt-3">{{ $page->page_title }} Page</h3>
	      	<div class="v-line mb-5"></div>

	      	<div class="row">
	      		<div class="col-md-9 mx-md-auto">
	      			<form id="frmAddPage">
	      				<h3 class="title text-center">SEO Content</h3>
	      				<div class="v-line mx-auto mb-4"></div>

	      				<input type="hidden" name="seo_id" value="{{ $page->seo_id }}">
		      			<input type="hidden" name="image_id" value="{{ $page->image_id }}">

		      			<div class="form-group">
		      				<label>Meta Title <span class="text-danger">*</span></label>
		      				<input type="text" name="seo_title" class="form-control" value="{{ $page->title }}">
		      			</div>
		      			<div class="form-group">
		      				<label>Meta Description <span class="text-danger">*</span></label>
		      				<textarea name="seo_description" rows="4" class="form-control">{{ $page->description }}</textarea>
		      			</div>
		      			<div class="form-group">
		      				<label>Meta Keywords <span class="text-danger">*</span></label>
		      				<input type="text" name="seo_keywords" class="form-control" value="{{ $page->keywords }}">
		      			</div>

		      			<h3 class="title text-center mt-5">Page Content</h3>
		      			<div class="v-line mx-auto mb-4"></div>

		      			<div class="form-group">
		      				<label>Title <span class="text-danger">*</span></label>
		      				<input type="text" name="page_title" class="form-control" value="{{ $page->page_title }}" {{ !empty($page->url) ? '' : 'readonly' }}>
		      			</div>

		      			@if(!empty($page->url))
		      			<div class="form-group">
		      				<input type="file" name="image" accept="image/*" style="display: none;">
		      				<a href="javascript:void(0)" id="upload">
		      					<img src="{{ asset('images/banner/'.$page->filename) }}" class="banner" width="100%">
		      				</a>
		      				<p class="text-danger text-right mb-0">Note: required image <strong>(2023 x 533)</strong></p>
		      			</div>
		      			<div class="form-group">
		      				<label>Alt Text <span class="text-danger">*</span></label>
	      					<input type="text" name="alt" class="form-control" value="{{ $page ? $page->alt : '' }}">
	      				</div>
			      			@if($page->url == 'careers')
			      			<div class="form-group">
			      				<label>Description Title <span class="text-danger">*</span></label>
			      				<input type="text" name="page_description_title" class="form-control" value="{{ $page->description_title }}">
			      			</div>
			      			<div class="form-group">
			      				<label>Description <span class="text-danger">*</span></label>
			      				<textarea name="page_description" id="editor">{{ $page->page_description }}</textarea>
			      			</div>
			      			@endif
		      			@else
		      			<div class="form-group">
		      				<label>Description Title <span class="text-danger">*</span></label>
		      				<input type="text" name="page_description_title" class="form-control" value="{{ $page->description_title }}">
		      			</div>
		      			<div class="form-group">
		      				<label>Description <span class="text-danger">*</span></label>
		      				<textarea name="page_description" id="editor">{{ $page->page_description }}</textarea>
		      			</div>
		      			<div class="form-group">
		      				<label>Youtube Link <span class="text-danger">* <small>Copy and paste below, the youtube ID </small></span><small>(https://www.youtube.com/watch?v=<strong class="bg-warning">-bKB68FBrtc</strong>)</small></label>
		      				<input type="text" name="youtube_link" class="form-control" value="{{ $page->link }}">
		      			</div>
		      			@endif

		      			<div class="form-group text-right">
		      				<a href="{{ url('/cms/page-manager') }}" class="btn btn-dark">Cancel</a>
		      				<button type="submit" class="btn btn-primary btnSave">Save Changes</button>
		      			</div>
		      		</form>
	      		</div>
	      	</div>
      		
      		@else
      		
	      	<h3 class="title mt-3">{{ ucwords(replace_dashes(Request::segment(2))) }}</h3>
	      	<div class="v-line mb-4"></div>

      		<div class="table-responsive">
      			<table class="table table-striped table-bordered tableData" data-url="page-manager">
      				<thead>
      					<th width="80%">Name</th>
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
	            appCms.initPageManagerData();
	        });
	    </script>

@endsection