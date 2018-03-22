@extends('admin.layout.master1')

<!--Page specific css-->
@section('page_css')
    <link rel="stylesheet" href="{{asset('admin/plugins/datatables/dataTables.bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('admin/plugins/datatables/jquery.dataTables.min.css')}}">
@endsection
<!--/-->

@section('main-body')
    <div class="app-main">
        <!-- BEGIN .main-heading -->
        <header class="main-heading">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8">
                        <div class="page-icon">
                            <i class="icon-laptop_windows"></i>
                        </div>
                        <div class="page-title">
                            <h5>Mero Theatre</h5>
                            <h6 class="sub-heading">Welcome to your Dashboard</h6>
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
            <div class="col-xs-12">
                <div class="box" style="border-top: 5px solid green;">
                    <div class="box-header">
                        <h4><strong>List of group</strong></h4>
                        <a href="{{url('admin/box-office/smsCampaigns/group/create')}}" class="btn btn-primary"><span
                                    class="glyphicon glyphicon-plus"></span> Add Group</a>

                        <a href="#" class="btn btn-danger" id="deleteCheckedContactsButton" style="display: none;"><span
                                    class="glyphicon glyphicon-remove"></span> Delete Groups</a>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive" style="padding: 10px;">
                        <table class="table table-striped table-bordered table-hover no-footer"
                               id="" role="grid">
                            <thead>
                            <tr>
                                <th>
                                    <input type="checkbox" id="selectAllContacts">
                                </th>
                                <th>Name</th>
                                <th>No of Contacts</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if ($items)
                                @foreach($items as $key => $item)
                                    <tr>
                                        <td>
                                            <input type="checkbox" class="select-all-contacts" value="{{ $item->id }}">
                                        </td>
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->countContact()}}</td>
                                        <td>
                                            <a href="{{route('group.edit', $item->id)}}">
                                                <span class="glyphicon glyphicon-pencil">Edit |</span>
                                            </a>
                                            &nbsp;&nbsp;
                                            <a href="{{route('group.show', $item->id)}}">
                                                <span class="glyphicon glyphicon-eye-open">View |</span>
                                            </a>
                                            &nbsp;&nbsp;

                                            {!! Form::open([
                                                'method' => 'DELETE',
                                                'route' => ['group.destroy', $item->id],
                                                'style' => 'display:inline',
                                                'onSubmit' => "return confirm('Do you want to delete?');"
                                                ])
                                            !!}
                                            <button type="submit" class="btn btn-danger btn-xs"><span
                                                        class="glyphicon glyphicon-remove">Del</span>
                                            </button>
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>

                        </table>
                        {{ $items->links() }}
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- END: .main-content -->
        </div>
        <!-- END: .main-content -->
    </div>


@stop

@section('scripts')
    <script src="{{ asset('admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
    <script>
        $('#groupTable').DataTable();
    </script>
    <script>
        $(document).on('click', '.close', function () {
            $('.alert').hide();
        });
    </script>
    <script>
        $(document).ready(function () {
            // Detect checkbox check and uncheck of the header
            $('#selectAllContacts').on('change', function (evt) {
                evt.preventDefault();

                // Check or uncheck checkbox based on parent checkbox
                $("input:checkbox[class=select-all-contacts]").prop('checked', this.checked);

                if ($(this).is(":checked")) {
                    // Show delete button
                    showDeleteButton($('#deleteCheckedContactsButton'));
                } else {
                    // Hide delete buttons
                    hideDeleteButton($('#deleteCheckedContactsButton'));
                }
            });

            // Detect individuals contact checked or unchecked
            $('.select-all-contacts').on('change', function (evt) {
                evt.preventDefault();

                // get all checked contacts
                var contactIds = getAllCheckedContactsIds();
                if (contactIds.length == 0) {
                    showAlertToCheckContacts();
                    hideDeleteButton($('#deleteCheckedContactsButton'));
                } else {
                    showDeleteButton($('#deleteCheckedContactsButton'));
                }
            });

            function getAllCheckedContactsIds() {
                var allIds = [];
                $('.select-all-contacts:checked').each(function () {
                    allIds.push($(this).val());
                });
                return allIds;
            }

            function showDeleteButton(selectorElement) {
                selectorElement.show();
            }

            function hideDeleteButton(selectorElement) {
                selectorElement.hide();
            }

            function deleteCheckedContacts(contacts) {
                console.log("Ajax calling contacts : ", JSON.stringify(contacts));
                console.log(baseurl);

                $.ajax({
                    url: baseurl + '/admin/box-office/smsCampaigns/group/mass-delete',
                    data: {
                        contacts: contacts
                    },
                    error: function () {
                        showAlertToCheckContacts("Oops!! Server Error Occured");
                    },
                    dataType: 'json',

                    success: function (data) {
                        console.log(data);
                        removeCheckedRows();
                    },
                    type: 'POST'
                });

            }

            function removeCheckedRows() {
                location.reload();
            }

            function showAlertToCheckContacts(message) {
                var alertMessage = message || "Opps!! Check contact to delete";
//                alert(alertMessage);
            }

            $('#deleteCheckedContactsButton').on('click', function (evt) {
                var contactIds = getAllCheckedContactsIds();
                if (contactIds.length == 0) {
                    showAlertToCheckContacts();
                    hideDeleteButton();
                    return 0;
                }

                deleteCheckedContacts(contactIds);
            });
        })
    </script>
@endsection
