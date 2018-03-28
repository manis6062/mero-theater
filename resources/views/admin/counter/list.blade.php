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
						<h5>Counter Management</h5>
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
		<div class="card-header artist-header"><a href="{{url('admin/counter/counteruser/create')}}"> Create New User</a></div>
		<div class="row gutters">
			<div class=" col-md-12 col-sm-12">
				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							 @if(\Session::has('message'))
                                <div class="alert alert-success">
                                    <i class="fa fa-times pull-right closeMessage"></i>
                                    <p class="text-center">{{\Session::get('message')}}</p>
                                </div>
                            @endif
							<table class="table m-0 table-bordered common-table ticket-type-table">
								<thead>
									<tr>
										<th>counter number</th>
										<th>Admin Name</th>
										<th>First name</th>				
										<th>Last name</th>
										<th>Designation</th>
										<th>username</th>
										<th>Email</th>
										<th>Mobile</th>
										<th>Suspend</th>
										<th class="table-action">Action</th>
									</tr>
								</thead>
								<tbody>
									@if(isset($data) && $data->count() > 0)
									@foreach($data as $dt)
									<tr>

										<th scope="row"><a href="#">{{$dt->counter_number}}</a></th>
										<td>{{$dt->admin->first_name}}</td>
										<td>{{$dt->first_name}}</td>
										<td>{{$dt->last_name}}</td>
										<td>{{$dt->designation}}</td>
										<td>{{$dt->username}}</td>
										<td>{{$dt->email}}</td>
										<td>{{$dt->mobile}}</td>
										<td id="suspend-status-{{$dt->id}}">{{$dt->suspend}}</td>
										<td>
											<a href="{{url('admin/counter/counteruser/'.$dt->id.'/edit')}}" class="table-content-edit" data-toggle="tooltip" data-placement="top" title="Edit">
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
										<td colspan="7" class="text-center">No Any Counter User Found !</td>
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
					url: baseurl + '/admin/counter/counteruser/delete?uid=' + uid,
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
					url: baseurl + '/admin/counter/counteruser/suspend?uid=' + uid,
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
</script>
@stop