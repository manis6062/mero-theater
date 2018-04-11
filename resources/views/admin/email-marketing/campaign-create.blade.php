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
					<div class="col-xl-8 col-lg-8 col-md-8">
						<div class="card">
							<div class="card-body">
								<div class="campaign-form">
									<form class="form" role="form" autocomplete="off" action="{{url('admin/email-marketing/campaign-manage')}}" method="post">
										{{csrf_field()}}
										<div class="form-group row">
											<label class="col-lg-3 col-form-label form-control-label">
												Name<span class="req">*</span> 
												<a href="#" class="notice" data-toggle="tooltip" data-placement="bottom" title="Name">
													<i class="icon-notifications_none"></i>
												</a>
											</label>
											<div class="col-lg-9">
												<input class="form-control" type="text" name = "campaign_name" value="" placeholder="Enter the campaign name">
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
												<select name="group" id="contact-group" class="form-control" onfocus="removeError();">
													<option value="">Choose Group</option>
													@if ($items)
													@foreach($items as $item)
													<option value="{{$item->id}}">{{$item->name}}</option>
													@endforeach
													@endif
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
												<div class="form-check">
													<input class="form-check-input" type="radio"> 
													<label class="form-check-label" for="gridCheck">
														English
													</label>
													<input class="form-check-input" type="radio">
													<label class="form-check-label" for="gridCheck">
														Nepali
													</label>
												</div>
											</label>
											<div class="col-lg-12">
												<textarea name="editor1" id="editor" class="form-control" placeholder="Type your cureent status"></textarea>
											</div>
										</div>
										
										<div class="form-group row">
											<label class="col-lg-3 col-form-label form-control-label"></label>
											<div class="col-lg-9">
												<div class="save-template">
													<a href="#" data-toggle="tooltip" data-placement="bottom" title="Save Template">
														<i class="icon-note"></i>
														<span>Save Template</span>
														<i class="icon-notifications_none"></i>
													</a>
												</div>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-lg-3 col-form-label form-control-label"></label>
											<div class="col-lg-9">
												<button type="submit" class="btn btn-primary">Send Email</button>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-4 col-lg-4 col-md-4">
						<div class="card">
							<div class="card-body">
								<div class="campaign-sidebar">
									<div class="sidebar-widget">
										<div class="card-header">
											<span>Shedule Message</span> 
											<a href="#" class="notice" data-toggle="tooltip" data-placement="bottom" title="Shedule Message">
												<i class="icon-notifications_none"></i>
											</a>
										</div>
										<div class="campaign-sidebar-info">
											<form class="form" role="form" autocomplete="off">
												<div class="form-group">
													<label class="col-form-label form-control-label">
														Send Later Date 
													</label>
													<div class="input-group">
														<input class="form-control" type="date" value="Date">
														<div class="input-group-prepend">
															<div class="input-group-text"><i class="icon-calendar"></i></div>
														</div>
													</div>
												</div>
											</form>
										</div>
									</div>
									<div class="sidebar-widget">
										<div class="campaign-sidebar-info">
											<form class="form" role="form" autocomplete="off">
												<div class="form-group">
													<label class="col-form-label form-control-label">
														Send Later Time 
													</label>
													<div class="input-group">
														<input class="form-control" type="time" value="Time">
														<div class="input-group-prepend">
															<div class="input-group-text"><i class="icon-clock"></i></div>
														</div>
													</div>
												</div>
												<div class="form-check">
													<input class="form-check-input" type="checkbox"> 
													<label class="form-check-label" for="gridCheck">
														Tagline
													</label>
												</div>
											</form>
										</div>
									</div>
								</div>
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