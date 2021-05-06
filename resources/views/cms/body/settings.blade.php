@extends('cms.master')
@section('body')

	<div class="content-wrapper">
		<div class="container-fluid">
      		<h3 class="title mt-3">Settings</h3>
	      	<div class="v-line mb-5"></div>

	      	<div class="row">
	      		<div class="col-md-9 mx-md-auto">
	      			<form id="frmSettings">

	      				<div class="form-group">
		      				<label>Email Recipient <span class="text-danger">*</span></label>
		      				<input type="text" name="email" class="form-control" value="{{ $setting ? $setting->email : '' }}">
		      			</div>

		      			<div class="form-group">
		      				<label>Phone Number <span class="text-danger">*</span></label>
		      				<input type="text" name="phone_number" class="form-control" value="{{ $setting ? $setting->phone : '' }}">
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
	        	appCms.initSettingsData();
	        });
	    </script>

@endsection