@extends('admin.layout.master')

@section('main-body')
<div class="main-content">
	<div class="row gutters">
		<div class=" col-md-12 col-sm-12">
			<div class="card">
				<div class="card-header artist-header"><a href="{{url('admin/content-management/payment-gateway/create')}}"> Create Payment Gateway</a></div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table m-0 table-bordered common-table">
							<thead>
								<tr>
									<th>Name</th>
									<th>Image</th>
									<th>Description</th>
									<th>Link</th>
									<th>Status</th>
									<th class="table-action">Action</th>
								</tr>
							</thead>
							<tbody>
								@if(isset($data) && $data->count() > 0)
                    				@foreach($data as $dat)
										<tr>
											<th scope="row">{{$dat->name}}</th>
											<th><img src="{{asset('payment/'.$dat->image)}}" class="img img-responsive"></th>
											<td>{{$dat->description}}</td>
											<td>{{$dat->link}}</td>
											<td>{{$dat->status}}</td>
											<td>
												<a href="{{url('admin/content-management/payment-gateway/'.$dat->id.'/edit')}}" class="table-content-edit" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit">
													<i class="icon-edit2"></i>Edit
												</a>
												<a href="#" class="table-content-delete" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" data-id="{{$dat->id}}">
													<i class="icon-delete2"></i>Delete
												</a>
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
</div>
@stop

@section('scripts')
    <script>
        $('.table-content-delete').on('click', function (e) {
            e.preventDefault();
            var Id = $(this).data('id');
            alertify.confirm("Delete It confirm ?",
                function () {
                    $.ajax({
                        url: baseurl + '/admin/content-management/payment-gateway/delete?Id='+Id,
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
    </script>
@stop