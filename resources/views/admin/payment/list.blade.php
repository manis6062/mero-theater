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
                            <h5>Payment Gateway</h5>
                            <h6 class="sub-heading">Welcome to Merotheatre Admin</h6>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
                        <div class="right-actions">
                            @include('admin.last-login-time')
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
                    <div class="card">
                        <div class="card-header artist-header"><a href="{{url('admin/content-management/payment-gateway/create')}}"> Create Payment Gateway</a></div>
                        <div class="card-body">
                                 @if(\Illuminate\Support\Facades\Session::has('message'))
                                <div class="alert alert-success">
                                    <i class="fa fa-times pull-right closeMessage"></i>
                                    <p class="text-center">{{\Illuminate\Support\Facades\Session::get('message')}}</p>
                                </div>
                            @endif
                            <div class="table-responsive">
        <table class="table m-0 table-bordered common-table">
							<thead>
								<tr>
                                    <th>ID</th>
									<th>Company Name</th>
									<!-- <th>Description</th> -->
									<!-- <th>Link</th> -->
                                    <th>Authorized Person</th>
                                     <th>Number</th>
                                     <th>Logo</th>
									<th>Status</th>
									<th class="table-action">Action</th>
								</tr>
							</thead>
							<tbody>
								@if(isset($data) && $data->count() > 0)
                    				@foreach($data as $dat)
										<tr>
											<th scope="row">{{$dat->gateway_id}}</th>
                                            <th scope="row">{{$dat->name}}</th>
											<!-- <td>{{$dat->description}}</td> -->
											<!-- <td>{{$dat->link}}</td> -->
                                            <td>{{$dat->contact_person}}</td>
                                            <td>{{$dat->phone}}</td>
                                            <td><img width="30" height="30" src="{{asset('payment/'.$dat->image)}}" class="img img-responsive"></td>
											<td>{{ucwords($dat->status)}}</td>
											<td>
												<a href="{{url('admin/content-management/payment-gateway/'.$dat->id.'/edit')}}" class="table-content-edit" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit">
													<i class="icon-edit2"></i>
												</a>
                                                <a href="{{url('admin/content-management/payment-gateway/'.$dat->id.'/api_details')}}" class="table-content-edit" data-toggle="tooltip" data-placement="top" title="" data-original-title="API">
                                                    <i class="icon-link"></i>
                                                </a>
												<!-- <a href="#" class="table-content-delete" data-toggle="tooltip" data-placement="top" title="" data-original-title="Suspensed" data-id="{{$dat->id}}">
													<i class="icon-delete2"></i>
												</a> -->
                                                
											</td>
										</tr>
									@endforeach
                				@else
		                				<tr>
					                        <td colspan="7" class="text-center">No Any Data Found !</td>
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
        
        // $('.table-content-delete').on('click', function (e) {
        //     e.preventDefault();
        //     var Id = $(this).data('id');
        //     alertify.confirm("Delete It confirm ?",
        //         function () {
        //             $.ajax({
        //                 url: baseurl + '/admin/content-management/payment-gateway/delete?Id='+Id,
        //                 type: 'get',
        //                 success: function (data) {
        //                     if (data == 'true') {
        //                         window.location.reload();
        //                     } else {
        //                         alertify.alert("Oops ! something went wrong. Please try again.");
        //                     }
        //                 }, error: function (data) {

        //                 }
        //             });
        //         },
        //         function () {

        //         });
        // });


        
    </script>
@stop

