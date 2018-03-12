@extends('admin.layout.master')

@section('main-body')
    <section class="content">
        <div class="row">
            <div class="screen-list" style="width: 80%; margin: 5% 10%;">
                <a href="{{url('admin/box-office/ticket-types/classes/create')}}">Add New Ticket Class</a>
                @if(\Illuminate\Support\Facades\Session::has('message'))
                    <div class="alert alert-success">
                        <i class="fa fa-times pull-right closeMessage"></i>
                        <p class="text-center">{{\Illuminate\Support\Facades\Session::get('message')}}</p>
                    </div>
                @endif
                <table class="table table-responsive table-bordered">
                    <thead>
                    <th>Class Name</th>
                    <th>Class Description</th>
                    <th>Created On</th>
                    <th width="100">Action</th>
                    </thead>

                    <tbody>
                    @if(isset($ticketClasses) && $ticketClasses->count() > 0)
                        @foreach($ticketClasses as $tt)
                            <tr>
                                <td>{{$tt->class_name}}</td>
                                <td>{{$tt->class_description}}</td>
                                <td>{{date('M d, Y', strtotime($tt->created_at))}}</td>
                                <td>
                                <span><a href="{{url('admin/box-office/ticket-types/classes/'.$tt->slug.'/edit')}}"><i
                                                class="fa fa-edit"></i> Edit</a></span>&nbsp;&nbsp;&nbsp;
                                    <br>
                                    <span class="delete-ticket-class" data-tcid="{{$tt->id}}"><a href=""><i
                                                    class="fa fa-trash"></i> Delete</a></span>&nbsp;&nbsp;&nbsp;
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="12" class="text-center">No Any Ticket Class Found !</td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@stop

@section('scripts')
    <script>
        $(document).find('.closeMessage').on('click', function () {
            $(this).parent('div').remove();
        });
        $('.delete-ticket-class').on('click', function (e) {
            e.preventDefault();
            var classId = $(this).data('tcid');
            alertify.confirm("Delete this ticket class ?",
                function () {
                    $.ajax({
                        url: baseurl + '/admin/box-office/ticket-types/delete-ticket-class?classId=' + classId,
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