@extends('admin.layout.master1')

@section('styles')
	
@stop

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
                           <h5>CRM</h5>
						   <h6 class="sub-heading">Welcome to Merotheatre Admin</h6>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
                        <div class="right-actions">
                            <span class="last-login"> @include('admin.last-login-time')</span>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- END: .main-heading -->
        <!-- BEGIN .main-content -->
       <div class="main-content">
						
						<!-- Row start -->
						 <div class="card-header artist-header"><a href="{{url('admin/crm/user/create')}}"> Create New User</a></div>
						<div class="row gutters">
							<div class=" col-md-12 col-sm-12">
								<div class="card">
									<div class="card-body">
										<div class="filter-div">
											<div class="crm-title">
												<h4>Filter Option</h4>
											</div>
											<form action="crm_submit" method="get" accept-charset="utf-8">
												<div class="row">
													<div class="col-md-3">
														<div class="input-group date">
														  <input id="registeredDatePicker" type="text" class="form-control" placeholder="Select Registered Date">
														  <span class="input-group-addon"><i class="icon-calendar"></i></span>
														</div>
													</div>
													<div class="col-md-3">
				                                        <select name="" class="custom-select">
				                                        	<option value="" class="selected">Registren From</option>
				                                        	<option value="by admin">Registered by Admin</option>
				                                        	<option value="from excel">Registered From Excel</option>
				                                        </select>
													</div>
													<div class="col-md-3">
														<button type="submit" class="btn btn-primary">Submit</button>
													</div>
												</div>
											</form>
										</div>
										<div class="table-responsive">
											<table class="table m-0 table-bordered common-table ticket-type-table">
												<thead>
													<tr>
														<th>S.N</th>						
														<th>Registered Date</th>
														<th>Name</th>
														<th>Email</th>
														<th>Mobile</th>
														<th>Registered Via</th>
														<th>Suspend</th>
														<th class="table-action">Action</th>
													</tr>
												</thead>
												<tbody>
													@if(isset($data) && $data->count() > 0)
                                        @foreach($data as $dt)
													<tr>

														<th scope="row"><a href="#">{{$dt->id}}</a></th>
														<td>{{$dt->created_at}}</td>
														<td>{{$dt->name}}</td>
														<td>{{$dt->email}}</td>
														<td>{{$dt->mobile}}</td>
														<td>{{$dt->registered_type}}</td>
														<td id="suspend-status-{{$dt->id}}">{{$dt->suspend}}</td>
														<td>
															<a href="{{url('admin/crm/user/'.$dt->id.'/edit')}}" class="table-content-edit" data-toggle="tooltip" data-placement="top" title="Edit">
																<i class="icon-edit2"></i>
															</a>
															<a href="#" class="suspend-user table-content-edit" data-toggle="tooltip" data-placement="top" data-uid="{{$dt->id}}" title="Suspensed">
																<i class="icon-theaters"></i>
															</a>
															<a href="" class="table-content-delete delete-user" data-uid="{{$dt->id}}" data-toggle="tooltip" data-placement="top" title="Delete">
																<i class="icon-delete2"></i>
															</a>
															<a href="#" class="table-content-edit table-content-sms" data-toggle="tooltip" data-placement="top" title="SMS">
																<i class="icon-message"></i>
																SMS
															</a>
															<a href="#" class="table-content-edit table-content-email" data-toggle="tooltip" data-placement="top" title="Email">
																<i class="icon-email"></i>
																Email
															</a>

														</td>
													</tr>
											@endforeach
                                    @else
                                        <tr>
                                            <td colspan="7" class="text-center">No Any Screen Found !</td>
                                        </tr>
                                    @endif									
												</tbody>
											</table>
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
<script type="text/javascript" src="{{asset('admins/theme/js/bootstrap-datepicker.min.js')}}"></script>
    <script>
        $(document).find('.closeMessage').on('click', function () {
            $(this).parent('div').remove();
        });
        $('.delete-user').on('click', function (e) {
            e.preventDefault();
            var uid = $(this).data('uid');
            alertify.confirm("Delete this user  ?",
                function () {
                    $.ajax({
                        url: baseurl + '/admin/crm/user/delete?uid=' + uid,
                        type: 'get',
                        success: function (data) {
                            if (data == 'true') {
                                window.location.reload();
                            } else {
                                alertify.alert("Oops ! something went wrong. Please try again.");
                            }
                        }, error: function (data) {

                        }
                    });
                },
                function () {

                });
        });
        $('.suspend-user').on('click', function (e) {
		e.preventDefault();
		var uid = $(this).data('uid');
		var currentStatus = $(document).find('td#suspend-status-'+uid).text();
		if(currentStatus == 'yes')
			var message = 'Reactivate this user ?';
		else{
			var message = 'Suspend this user ?';
		}
		alertify.confirm(message,
			function () {
				$.ajax({
					url: baseurl + '/admin/crm/user/suspend?uid=' + uid,
					type: 'get',
					success: function (data) {
						if (data == 'true') {
							var currentStatus = $(document).find('td#suspend-status-'+uid).text();

							if(currentStatus == 'yes')
								$(document).find('td#suspend-status-'+uid).text('no');
							else
								$(document).find('td#suspend-status-'+uid).text('yes');
							
						} else {
							alertify.alert("Oops ! something went wrong. Please try again.");
						}
					}, error: function (data) {

					}
				});
			},
			function () {

			});
	});

        $('#registeredDatePicker').datepicker();
    </script>
@stop