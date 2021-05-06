@extends('cms.master')
@section('body')

	<div class="content-wrapper">
		<div class="container-fluid">
			
			<div class="d-flex flex-wrap justify-content-between align-items-center">
				<div class="p-0">
			      	<h3 class="title mt-3">{{ ucwords(replace_dashes(Request::segment(2))) }}</h3>
			      	<div class="v-line mb-4"></div>
			    </div>
			    <div class="p-0">
			    	<a href="{{ url('/export/inquiry/comment') }}" class="btn btn-success"><i class="far fa-file"></i> Export Comment</a>
			    	<a href="{{ url('/export/inquiry/suggestion') }}" class="btn btn-success"><i class="far fa-file"></i> Export Suggestion</a>
			    </div>
			</div>

      		<div class="table-responsive">
      			<table class="table table-striped table-bordered tableData" data-url="inquiry">
      				<thead>
      					<th width="25%">Date</th>
      					<th width="25%">Type</th>
      					<th width="40%">Email</th>
      					<th width="10%">Action</th>
  					</thead>
      				<tbody></tbody>
      			</table>
      		</div>
		</div>

		<div class="modal fade" id="viewInquiry" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
			          	<h4 class="modal-title"></h4>
			          	<button type="button" class="close" data-dismiss="modal">&times;</button>
			        </div>
					<div class="modal-body">
					</div>
					<div class="modal-footer">
			          	<button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
			        </div>
				</div>
			</div>
		</div>

		<script type="text/javascript">
	        $(function(){
	        	//appCms.init();
	            appCms.initInquiryData();
	        });
	    </script>

@endsection