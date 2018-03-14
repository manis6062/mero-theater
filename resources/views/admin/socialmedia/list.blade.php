@extends('admin.layout.master')

@section('main-body')
    <section class="content">
        <div class="screen-list" style="width: 80%; margin: 5% 10%;">
            <a href="{{url('admin/content-management/social-media/create')}}">Add New Social Media</a>
            <table class="table table-responsive table-bordered">
                <thead>
                <th>Name</th>
                <th>Links</th>
                <th>Icon</th>
                <th>Action</th>
                </thead>

                <tbody>
                @if(isset($data) && $data->count() > 0)
                    @foreach($data as $dat)
                        <tr>
                            <td>{{$dat->name}}</td>
                            <td>{{$dat->link}}</td>
                            <td><img src="{{asset('socialmedia/'.$dat->icon)}}" class="img img-responsive"></td>
                            <td>
                                <span><a href="{{url('admin/content-management/social-media/'.$dat->id.'/edit')}}"><i class="fa fa-edit"></i> Edit</a></span>&nbsp;&nbsp;&nbsp;
                                <br>
                                <span class="delete-socialmedia" data-id="{{$dat->id}}"><a href=""><i class="fa fa-trash"></i> Delete</a></span>
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
    </section>
@stop

@section('scripts')
    <script>
        $('.delete-socialmedia').on('click', function (e) {
            e.preventDefault();
            var Id = $(this).data('id');
            alertify.confirm("Delete It confirm ?",
                function () {
                    $.ajax({
                        url: baseurl + '/admin/content-management/social-media/delete?Id=' + Id,
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