@extends('cms.master')
@section('body')

	<div class="content-wrapper">
		<div class="container-fluid">
			@if(!empty($type))
      		<h3 class="title mt-3">{{ $type != 'edit' ? 'Add Room Type' : 'Update Room Type' }}</h3>
	      	<div class="v-line mb-5"></div>

	      	<div class="row">
	      		<div class="col-md-9 mx-md-auto">
	      			<form id="frmAddRooms">
		      			<input type="hidden" name="id" value="{{ $rooms ? $rooms->id : '' }}">
		      			<div class="form-group">
		      				<label>Name <span class="text-danger">*</span></label>
		      				<input type="text" name="name" class="form-control" value="{{ $rooms ? $rooms->name : '' }}">
		      			</div>
		      			<div class="form-group">
				      		<div class="row">
				      			<div class="col-md-4">
				      				<label>Status <span class="text-danger">*</span></label>
				      				<select name="status" class="form-control select2">
				      					<option value="1" {{ $rooms ? $rooms->status_id != 1 ? '' : 'selected' : '' }}>Active</option>
				      					<option value="2" {{ $rooms ? $rooms->status_id != 2 ? '' : 'selected' : '' }}>Inactive</option>
				      				</select>
				      			</div>
				      		</div>
				      	</div>
		      			<div class="form-group text-right">
		      				<a href="{{ url('/cms/maintenance/rooms') }}" class="btn btn-dark">Cancel</a>
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
			    	<a href="{{ url('/cms/maintenance/rooms/add') }}" class="btn btn-primary">Add Room Type</a>
			    </div>
			</div>
      		<div class="table-responsive mt-4 mb-4">
      			<table class="table table-striped table-bordered tableData" data-url="rooms">
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
	            appCms.initRoomsData();
	        });
	    </script>

@endsection