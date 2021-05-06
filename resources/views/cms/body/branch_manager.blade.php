@extends('cms.master')
@section('body')

	<div class="content-wrapper">
		<div class="container-fluid">
			@if(!empty($type))
      		<h3 class="title mt-3">{{ $type != 'edit' ? 'Add Branch' : 'Update Branch' }}</h3>
	      	<div class="v-line mb-5"></div>

	      	<div class="row">
	      		<div class="col-md-9 mx-md-auto">
	      			<form id="frmAddBranches">
	      				<h3 class="title text-center">SEO Content</h3>
	      				<div class="v-line mx-auto mb-4"></div>

		      			<input type="hidden" name="seo_id" value="{{ $branch ? $branch->seo_id : '' }}">

		      			<div class="form-group">
		      				<label>Meta Title <span class="text-danger">*</span></label>
		      				<input type="text" name="seo_title" class="form-control" value="{{ $branch ? $branch->title : '' }}">
		      			</div>
		      			<div class="form-group">
		      				<label>Meta Description <span class="text-danger">*</span></label>
		      				<textarea name="seo_description" rows="4" class="form-control">{{ $branch ? $branch->description : '' }}</textarea>
		      			</div>
		      			<div class="form-group">
		      				<label>Meta Keywords <span class="text-danger">*</span></label>
		      				<input type="text" name="seo_keywords" class="form-control" value="{{ $branch ? $branch->keywords : '' }}">
		      			</div>

		      			<h3 class="title text-center mt-5">Branch Content</h3>
		      			<div class="v-line mx-auto mb-4"></div>

		      			<div class="form-group">
		      				<label>Name <span class="text-danger">*</span></label>
		      				<input type="text" name="branch_name" class="form-control" value="{{ $branch ? $branch->branch_name : '' }}">
		      			</div>
			      		<div class="row">
			      			<div class="col-md-6">
			      				<div class="form-group">
				      				<label>Street <span class="text-danger">*</span></label>
	      							<input type="text" name="branch_street" class="form-control" value="{{ $branch ? $branch->street : '' }}">
	      						</div>
			      			</div>
			      			<div class="col-md-6">
			      				<div class="form-group">
				      				<label>Barangay <span class="text-danger">*</span></label>
	      							<input type="text" name="branch_barangay" class="form-control" value="{{ $branch ? $branch->barangay : '' }}">
	      						</div>
			      			</div>
			      			<div class="col-md-6">
			      				<div class="form-group">
				      				<label>Province <span class="text-danger">*</span></label>
				      				<select name="branch_province" class="form-control select2" data-placeholder="Select Province">
				      					<option></option>
				      					@foreach($province as $row)
				      					<option value="{{ $row->id }}" {{ $branch ? $branch->province_id != $row->id ? '' : 'selected' : ''  }}>{{ $row->province }}</option>
				      					@endforeach
				      				</select>
				      			</div>
			      			</div>
			      			<div class="col-md-6">
			      				<div class="form-group">
				      				<label>City <span class="text-danger">*</span></label>
				      				<select name="branch_city" class="form-control select2" data-placeholder="Select City">
				      					<option></option>
				      					@foreach($city as $row1)
				      					<option value="{{ $row1->id }}" {{ $branch ? $branch->city_id != $row1->id ? '' : 'selected' : ''  }}>{{ $row1->city }}</option>
				      					@endforeach
				      				</select>
				      			</div>
			      			</div>
			      			<div class="col-md-6">
			      				<div class="form-group">
				      				<label>Longitude <span class="text-danger">*</span></label>
	      							<input type="text" name="branch_longitude" class="form-control" value="{{ $branch ? $branch->longitude : '' }}">
	      						</div>
			      			</div>
			      			<div class="col-md-6">
			      				<div class="form-group">
				      				<label>Latitude  <span class="text-danger">*</span></label>
	      							<input type="text" name="branch_latitude" class="form-control" value="{{ $branch ? $branch->latitude : '' }}">
	      						</div>
			      			</div>
			      			<div class="col-md-6">
			      				<div class="form-group">
				      				<label>Phone <span class="text-danger">*</span></label>
	      							<input type="text" name="branch_phone_number" class="form-control" value="{{ $branch ? $branch->phone : '' }}">
	      						</div>
			      			</div>
			      			<div class="col-md-6">
			      				<div class="form-group">
				      				<label>Fax <span class="text-danger">*</span></label>
	      							<input type="text" name="branch_fax_number" class="form-control" value="{{ $branch ? $branch->fax : '' }}">
	      						</div>
			      			</div>
			      			<div class="col-md-6">
			      				<div class="form-group">
				      				<label>Mobile <span class="text-danger">*</span></label>
	      							<input type="text" name="branch_mobile_number" class="form-control" value="{{ $branch ? $branch->mobile : '' }}">
	      						</div>
			      			</div>
			      			<div class="col-md-2">
			      				<div class="form-group">
				      				<label>Map Zoom <span class="text-danger">*</span></label>
	      							<input type="number" name="branch_map_zoom" class="form-control" value="{{ $branch ? $branch->zoom : '' }}" min="0" max="19">
	      						</div>
			      			</div>
			      			<div class="col-md-4">
			      				<div class="form-group">
				      				<label>Status <span class="text-danger">*</span></label>
				      				<select name="status" class="form-control select2">
				      					<option value="1" {{ $branch ? $branch->status_id != 1 ? '' : 'selected' : '' }}>Active</option>
				      					<option value="2" {{ $branch ? $branch->status_id != 2 ? '' : 'selected' : '' }}>Inactive</option>
			      				</select>
	      						</div>
			      			</div>
			      		</div>
		      			<div class="form-group text-right">
		      				<a href="{{ url('/cms/branch-manager') }}" class="btn btn-dark">Cancel</a>
		      				<button type="submit" class="btn btn-primary btnSave">Save Changes</button>
		      			</div>
		      		</form>
		      		@if(!empty($id))
		      		<hr class="my-5">
		      		<h3 class="title text-center">Rates Content</h3>
	      			<div class="v-line mx-auto mb-4"></div>
	      			<div class="text-right">
	      				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addRate">Add Rate</button>
	      			</div>
	      			<div class="modal fade" id="addRate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
						          	<h4 class="modal-title">Add Rate</h4>
						          	<button type="button" class="close" data-dismiss="modal">&times;</button>
						        </div>
						        <form id="frmAddRates">
								<div class="modal-body">

									<div class="ajax-response">
										<div class="ajax-message"></div>
									</div>

									<input type="hidden" name="id">
									<input type="hidden" name="branch_id" value="{{ $id }}">
				      				<div class="form-group">
					      				<label>Rate Type <span class="text-danger">*</span></label>
		      							<select name="rate_type" class="form-control select2" data-placeholder="Select Rate Type">
		      								<option></option>
					      					<option value="weekdays">Weekdays</option>
					      					<option value="weekend">Weekend</option>
					      				</select>
		      						</div>
						      		<div class="form-group">
					      				<label>Room Type <span class="text-danger">*</span></label>
		      							<select name="room_type" class="form-control select2" data-placeholder="Select Room Type">
		      								<option></option>
		      								@foreach($rooms as $row3)
					      					<option value="{{ $row3->id }}">{{ $row3->name }}</option>
					      					@endforeach
					      				</select>
		      						</div>
				      				<div class="form-group">
					      				<label>12 Hours Rate <span class="text-danger">*</span></label>
		      							<input type="number" name="12_hours_rate" class="form-control">
		      						</div>
				      				<div class="form-group">
					      				<label>24 Hours Rate <span class="text-danger">*</span></label>
					      				<input type="number" name="24_hours_rate" class="form-control">
		      						</div>
				      				<div class="form-group">
					      				<label>Status <span class="text-danger">*</span></label>
					      				<select name="status" class="form-control select2">
					      					<option value="1">Active</option>
					      					<option value="2">Inactive</option>
					      				</select>
				      				</div>
								</div>
								<div class="modal-footer">
						          	<button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
						          	<button type="submit" class="btn btn-primary">Save Changes</button>
						        </div>
						        </form>
							</div>
						</div>
					</div>
	      			<div class="table-responsive mt-4 mb-4">
		      			<table class="table table-striped table-bordered tableRatesData" data-url="rates" data-id="{{ $id }}">
		      				<thead>
		      					<th width="15%">Rate Type</th>
		      					<th width="15%">Room Type</th>
		      					<th width="25%">12 Hours</th>
		      	      			<th width="25%">24 Hours</th>
		      	      			<th width="10%">Status</th>
		      					<th width="10%">Action</th>
		  					</thead>
		      				<tbody></tbody>
		      			</table>
		      		</div>

		      		<hr class="my-5">
		      		<h3 class="title text-center">Gallery Content</h3>
	      			<div class="v-line mx-auto mb-4"></div>
	      			<form method="POST" action="{{ url('/api/gallery/save') }}" accept-charset="UTF-8" class="dropzone mb-4" id="my-dropzone" enctype="multipart/form-data">
	      				<input type="hidden" name="_token" value="{{ csrf_token() }}">
	      				<input type="hidden" name="id" value="{{ $id }}">
	      			</form>
	      			@endif
	      		</div>
	      	</div>
      		
      		@else
      		<div class="row align-items-center">
				<div class="col-md-6">
		      		<h3 class="title mt-3">{{ ucwords(replace_dashes(Request::segment(3).' '.Request::segment(2))) }}</h3>
      				<div class="v-line mb-4"></div>
			    </div>
			    <div class="col-md-6 text-right">
			    	<a href="{{ url('/cms/branch-manager/add') }}" class="btn btn-primary">Add Branch</a>
			    </div>
			</div>
      		<div class="table-responsive mt-4 mb-4">
      			<table class="table table-striped table-bordered table-hover tableData" data-url="branches">
      				<thead>
      					<th width="25%">Province</th>
      					<th width="25%">City</th>
      					<th width="30%">Name</th>
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
	            appCms.initBranchesData();
	            @if(!empty($id))
	            appCms.initRatesData();
	            @endif
	        });
	    </script>

	    <script type="text/javascript">

	    	Dropzone.options.myDropzone = {
		        addRemoveLinks: true,
		        dictDefaultMessage: '<strong>Drop Images here or click to upload.</strong>',
		        dictRemoveFileConfirmation: 'Are you sure you want to remove selected Image?',
		        acceptedFiles: 'image/*',
		        init: function(){
		          	this.on('addedfile', function(file){
		            	file.previewTemplate.id = file.id;
		            	file.previewElement.addEventListener("click", function(){
						   	swal({

			                    title: "Are you sure?",
			                    text: "Do you want to set this as primary image?",
			                    type: 'warning',
			                    showCancelButton: true,

			                }).then((result) => {

			                    if(result.value){

			                    	var gallery_id = $(this).attr('id');
			                    	var branch_id = {{ $id ? $id : 0 }};

				                    $.ajax({
			                            type: 'POST',
			                            url: base_url + '/api/gallery/active',
			                            data: {"gallery_id": gallery_id, "branch_id": branch_id},
			                            dataType: 'json',
			                            cache: false,

			                            beforeSend : function() {
			                            },
			                            complete : function() {
			                            },
			                            success : function(data) {

			                                if(data.status){

			                                    swal("Success", data.message, "success").then(function(){
			                                        $('.dz-image').removeClass('active');
			                                        $('#' + gallery_id).find('.dz-image').addClass('active');
			                                    });
			                                    
			                                }else{
			                                    swal("Failed", data.message, "error");
			                                }
			                            },
			                            error : function() {
			                                swal("Failed", "Unable to connect to server.", "error");
			                            }              
			                            
			                        });

			                    }

			                });
						});
		          	});
		          	this.on('success', function(file, response){
		            	file.previewElement.id = response.id;
		          	});
		          	this.on('removedfile', function(file){
		              	if(file.isMock){

	                        $.ajax({
	                            type: 'POST',
	                            url: base_url + '/api/gallery/delete',
	                            data: {"item": file.id},
	                            dataType: 'json',
	                            cache: false,

	                            beforeSend : function() {
	                            },
	                            complete : function() {
	                            },
	                            success : function(data) {
	                                if(data.status){
	                                    console.log(data.message);
	                                }else{
	                                	alert("Can't delete this data.");
	                                }
	                            },
	                            error : function() {
	                                alert("Unable to connect to server.");
	                            }              
	                            
	                        });

		              	}
		          	});
		          	@foreach($gallery as $row2)
		          	var img_url = "{{ asset('/images/'.$row2->directory.'/'.$row2->filename) }}";
		            var mockFile = {id: {{ $row2->gallery_id }}, name: '{{ $row2->filename }}', size: {{ $row2->size }}, isMock: true, serverImgUrl: img_url};
		            this.emit('addedfile', mockFile);
		            this.emit('thumbnail', mockFile, img_url);
		            this.emit('complete', mockFile);
		            @if($row2->status_id == 1)
		            $('#{{ $row2->gallery_id }}').find('.dz-image').addClass('active');
		            @endif
		            @endforeach
		        }
		    };
	    </script>

@endsection