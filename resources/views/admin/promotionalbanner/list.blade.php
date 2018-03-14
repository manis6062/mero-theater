@extends('admin.layout.master')

@section('main-body')
    <section class="content">
        <div class="screen-list" style="width: 80%; margin: 5% 10%;">
            <a href="{{url('admin/content-management/promotional-banner/create')}}">Add New Promotional Banner</a>
            <table class="table table-responsive table-bordered">
                <thead>
                <th>SN</th>
                <th>Name</th>
                <th>Image</th>
                <th>Description</th>
                <th>Links</th>
                <th>Created On</th>
                <th>Action</th>
                </thead>

                <tbody>
                @if(isset($data) && $data->count() > 0)
                    @php $i=1 @endphp 
                    @foreach($data as $dat)
                        <tr>
                            <td>{{$i}}</td>
                            <td>{{$dat->banner_name}}</td>
                            <td><img src="{{asset('promotional-banner/'.$dat->image)}}" alt=""></td>
                            <td>{!! $dat->description !!}</td>
                            <td>{{$dat->link}}</td>
                            <td>{{date('M d, Y', strtotime($dat->created_at))}}</td>
                            <td>
                                <span><a href="{{url('admin/content-management/promotional-banner/'.$dat->id.'/edit')}}"><i
                                                class="fa fa-edit"></i> Edit</a></span>&nbsp;&nbsp;&nbsp;
                                <br>
                                <span class="delete-banner" data-id="{{$dat->id}}"><a href=""><i
                                                class="fa fa-trash"></i> Delete</a></span>
                            </td>
                        </tr>
                        @php $i++ @endphp
                    @endforeach
                @else
                    <tr>
                        <td colspan="7" class="text-center">No Any Data Found !</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </section>
@stop

@section('scripts')
    <script>
        $('.delete-banner').on('click', function (e) {
            e.preventDefault();
            var Id = $(this).data('id');
            alertify.confirm("Delete this screen ?",
                function () {
                    $.ajax({
                        url: baseurl + '/admin/content-management/promotional-banner/delete?Id=' + Id,
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