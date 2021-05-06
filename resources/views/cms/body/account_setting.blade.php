@extends('cms.master')
@section('body')

	<div class="content-wrapper">
		<div class="container-fluid">
      		<h3 class="title mt-3">My Account</h3>
	      	<div class="v-line mb-5"></div>

	      	<div class="row">
	      		<div class="col-md-5 mx-md-auto">
	      			<form id="frmUpdateAccount">
	      				<div class="form-group">
		      				<label>Name <span class="text-danger">*</span></label>
		      				<input type="text" name="name" class="form-control" value="{{ $account ? $account->name : '' }}">
		      			</div>
		      			<div class="form-group">
		      				<label>Email <span class="text-danger">*</span></label>
		      				<input type="text" name="email" class="form-control" value="{{ $account ? $account->email : '' }}">
		      			</div>
		      			<div class="form-group">
		      				<label>New Password</label>
		      				<input type="password" name="password" class="form-control">
		      			</div>
		      			<div class="form-group">
		      				<label>Confirm Password</label>
		      				<input type="password" name="password_confirmation" class="form-control">
		      			</div>
		      			<div class="form-group text-right">
		      				<button type="submit" class="btn btn-primary btnSave">Save Changes</button>
		      			</div>
	      			</form>
	      		</div>
	      	</div>
		</div>

		<script type="text/javascript">
	        $(function(){
	        	appCms.initAccountData();
	        });
	    </script>

@endsection