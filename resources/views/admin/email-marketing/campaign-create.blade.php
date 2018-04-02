@extends('admin.layout.master1')

@section('main-body')

	<!-- BEGIN .app-main -->
	<div class="app-main">
		<!-- BEGIN .main-heading -->
		<header class="main-heading">
			<div class="container-fluid">
				<div class="row">
					<div class="col-xl-8 col-lg-8 col-md-8 col-sm-8">
						<div class="page-icon">
							<i class="icon-border_outer"></i>
						</div>
						<div class="page-title">
							<h5>Campaign</h5>
							<h6 class="sub-heading">Welcome to Merotheatre Admin </h6>
						</div>
					</div>
					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
						<div class="right-actions">
							<span class="last-login">Last Login: 2 hours ago</span>
						</div>
					</div>
				</div>
			</div>
		</header>
		<!-- END: .main-heading -->
		<!-- BEGIN .main-content -->
		<div class="main-content">
			
			<!-- Row start -->
			<div class="row gutters">
				<div class=" col-md-12 col-sm-12">
					<div class="row">
						<div class="col-xl-8 col-lg-8 col-md-8 col-sm-8">
							<div class="card">
								<div class="card-body">
									<div class="campaign-form">
										<form class="form" role="form" autocomplete="off">
			                                <div class="form-group row">
			                                    <label class="col-lg-3 col-form-label form-control-label">
			                                    	Name 
			                                    	<a href="#" class="notice" data-toggle="tooltip" data-placement="bottom" title="Name">
			                                    		<i class="icon-notifications_none"></i>
			                                    	</a>
			                                    </label>
			                                    <div class="col-lg-9">
			                                        <input class="form-control" type="text" value="Jane">
			                                    </div>
			                                </div>
			                                <div class="form-group row">
			                                    <label class="col-lg-3 col-form-label form-control-label">
			                                    	Choose Contact group 
			                                    	<a href="#" class="notice" data-toggle="tooltip" data-placement="bottom" title="Choose Contact group">
			                                    		<i class="icon-notifications_none"></i>
			                                    	</a>
			                                    </label>
			                                    <div class="col-lg-9">
			                                        <select name="" class="custom-select">
			                                        	<option value="" class="selected">Choose Contact Group</option>
			                                        	<option value="">Esign</option>
			                                        	<option value="">Vikash</option>
			                                        	<option value="">Esignature</option>
			                                        </select>
			                                    </div>
			                                </div>
			                                <div class="form-group row">
			                                    <label class="col-lg-3 col-form-label form-control-label">
			                                    	Add Or Upload File
			                                    	<a href="#" class="notice" data-toggle="tooltip" data-placement="bottom" title="Add Or Upload File">
			                                    		<i class="icon-notifications_none"></i>
			                                    	</a>
			                                    </label>
			                                    <div class="col-lg-9">
			                                        <label class="custom-file">
														<input type="file" id="file2" class="custom-file-input">
														<span class="custom-file-control"></span>
													</label>
													<div class="sample-file">
			                                        	<a href="#">Sample 1</a><a href="#">Sample 2</a>
			                                        </div>
			                                    </div>
			                                </div>
			                                <div class="form-group row">
			                                    <label class="col-lg-3 col-form-label form-control-label">Do you want to use Template ?</label>
			                                    <div class="col-lg-9">
			                                    	<div class="form-check">
				                                       <input class="form-check-input" type="radio"> 
				                                       <label class="form-check-label" for="gridCheck">
				                                       		Yes
															</label>
				                                        <input class="form-check-input" type="radio">
				                                        <label class="form-check-label" for="gridCheck">
				                                       		No
															</label>
				                                    </div>
			                                    </div>
			                                </div>
			                                <div class="form-group row">
			                                    <label class="col-lg-3 col-form-label form-control-label">
			                                    	Message

			                                	</label>
			                                    <div class="col-lg-12">
		                                        	<textarea name="editor1" id="editor" class="form-control" placeholder="Type your cureent status"></textarea>
			                                    </div>
			                                </div>
			                                <div class="form-group row">
			                                    <label class="col-lg-3 col-form-label form-control-label"></label>
			                                    <div class="col-lg-9">
			                                    	<div class="save-template">
			                                    		<i class="icon-note"></i>
			                                    		<span>Save Template</span>
			                                    		<i class="icon-notifications_none"></i>
				                                    </div>
			                                    </div>
			                                </div>
			                                <div class="form-group row">
			                                    <label class="col-lg-3 col-form-label form-control-label"></label>
			                                    <div class="col-lg-9">
			                                        <button type="submit" class="btn btn-primary">Create</button>
			                                    </div>
			                                </div>
			                            </form>
			                        </div>
								</div>
							</div>
						</div>
						<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
							<div class="card">
								<div class="card-body">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Row end -->

		</div>
		<!-- END: .main-content -->
	</div>
	<!-- END: .app-main -->
@stop


@section('scripts')
<script src="{{asset('ckeditor/ckeditor.js')}}"></script>
<script>
	CKEDITOR.replace( 'editor1' );
</script>
@stop