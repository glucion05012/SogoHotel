@extends('cms.master')
@section('body')

	<div class="content-wrapper">
		<div class="container-fluid">
			@if(!empty($type))
      		<h3 class="title mt-3">{{ $type != 'edit' ? 'Add User' : 'Update User' }}</h3>
	      	<div class="v-line mb-5"></div>

	      	<div class="row">
	      		<div class="col-md-9 mx-md-auto">
	      			<form id="frmAddAccount">
	      				<input type="hidden" name="id" value="{{ $account ? $account->id : '' }}">
	      				<div class="form-group">
		      				<label>Name <span class="text-danger">*</span></label>
		      				<input type="text" name="name" class="form-control" value="{{ $account ? $account->name : '' }}">
		      			</div>
		      			<div class="form-group">
		      				<label>Email <span class="text-danger">*</span></label>
		      				<input type="text" name="email" class="form-control" value="{{ $account ? $account->email : '' }}">
		      			</div>
		      			<div class="form-group">
		      				<label>Password</label>
		      				<input type="password" name="password" class="form-control">
		      			</div>
		      			<div class="form-group">
		      				<label>Confirm Password</label>
		      				<input type="password" name="password_confirmation" class="form-control">
		      			</div>
		      			<div class="form-group">
				      		<div class="row">
				      			<div class="col-md-6">
				      				<label>Status <span class="text-danger">*</span></label>
				      				<select name="status" class="form-control select2">
				      					<option value="1" {{ $account ? $account->status_id != 1 ? '' : 'selected' : '' }}>Active</option>
				      					<option value="2" {{ $account ? $account->status_id != 2 ? '' : 'selected' : '' }}>Inactive</option>
				      				</select>
				      			</div>
				      		</div>
				      	</div>
		      			<div class="form-group text-right">
		      				<a href="{{ url('/cms/user-manager') }}" class="btn btn-dark">Cancel</a>
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
			    	<a href="{{ url('/cms/user-manager/add') }}" class="btn btn-primary">Add User</a>
			    </div>
			</div>
      		<div class="table-responsive mt-4 mb-4">
      			<table class="table table-striped table-bordered tableData" data-url="accounts">
      				<thead>
      					<th width="40%">Name</th>
      					<th width="40%">Email</th>
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
	            appCms.initAccountData();
	        });
	    </script>

@endsection