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
                        <h4><strong>List of contacts</strong></h4>
                        <a href="{{ url('admin/box-office/smsCampaigns/contact/create') }}" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Add Contact</a>

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
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Mobile Number</th>
                                <th>Group</th>
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
                                        <td>{{$item->first_name}}</td>
                                        <td>{{$item->last_name}}</td>
                                        <td>{{$item->phone_number}}</td>
                                        <td>--</td>
                                        <td>
                                            <a href="{{route('contact.edit', $item->id)}}">
                                                <span class="glyphicon glyphicon-pencil">Edit</span>
                                            </a>
                                            &nbsp;&nbsp;
                                            {{--<a href="#">
                                                <span class="glyphicon glyphicon-remove"></span>
                                            </a>--}}
                                            {!! Form::open([
                                                'method' => 'DELETE',
                                                'route' => ['contact.destroy',$item->id],
                                                'style' => 'display:inline',
                                                'onSubmit' => "return confirm('Do you want to delete?');"
                                                ])
                                            !!}
                                            <button class="btn btn-danger btn-xs" type="submit"><span class="glyphicon glyphicon-remove"></span>Del</button>
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

                <!-- Modal to show recently imported  -->
                @if (isset($contacts) && !empty($contacts))
                    <div class="modal fade" id="recentlyAddedContactModal" role="dialog">
                        <div class="modal-dialog">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Recently Added Contacts</h4>
                                </div>
                                <div class="modal-body">
                                    <p>
                                    <table class="table table-striped table-bordered table-hover dataTable no-footer"
                                           id="data-tables" role="grid" aria-describedby="dataTables-example_info">
                                        <thead>
                                        <tr>
                                            <th><input type="checkbox" name="" class="check-all" id="check-all"></th>
                                            <th>ID</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Mobile Number</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($contacts as $item)
                                            <tr>
                                                <th><input type="checkbox" name="selectAll" class="check-all"
                                                           value="{{$item->id}}"></th>
                                                <td>{{$item->id}}</td>
                                                <td>{{$item->first_name}}</td>
                                                <td>{{$item->last_name}}</td>
                                                <td>{{$item->phone_number}}</td>
                                                <td>--</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    </p>
                                </div>
                                <div class="modal-footer">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="input-group my-group">
                                                <select id="groupSelected" class="selectpicker form-control" data-live-search="true"
                                                        title="Please select a group">
                                                    <option value="">Select Group</option>
                                                    @if ($groups)
                                                        @foreach ($groups as $group)
                                                            <option value="{{$group->id}}">{{$group->name}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                                <span class="input-group-btn">
                                            <button class="btn btn-default" type="submit" id="updateContactToSelectGroup">
                                                GO!
                                            </button>
                                        </span>
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            @endif
            <!--/Modal-->
            </div>
            <!-- END: .main-content -->
        </div>
        <!-- END: .main-content -->
    </div>
@stop

@section('page_js')
    <script src="{{ asset('admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
    <script>
        $('#userDraftTable').DataTable();
    </script>
@endsection


@section('scripts')
    @if (isset($contacts) && !empty($contacts))
        <script>
            $(document).ready(function () {
                // Showing modal
                $('#recentlyAddedContactModal').modal('show');

                // Checking or unchecking all
                $('body').on('change', '#check-all', function () {
                    $(".check-all").prop('checked', $(this).prop('checked'));
                });

                // Updating into the select groups
                $('body').on('click', '#updateContactToSelectGroup', function () {
                    // Get all checked checkbox value
                    var checkboxesCheckedValue = getCheckedBoxes("selectAll");
                    // Get group id
                    var groupId = $('.modal-footer #groupSelected').val();

                    // Ajax call to update contacts to group
                    $.ajax({
                        method: "POST",
                        url: baseurl + "/user/contact/add-contacts-to-group",
                        data: {groupId: groupId, contactsId: checkboxesCheckedValue}
                    })
                        .done(function (response) {
                            console.log(response);
                            if (response.error == false) {
                                // Showing success message
                                alert(response.message);

                                // Closing modal
                                $("#recentlyAddedContactModal").modal('hide');
                            }
                            else {
                                alert(response.message);
                            }
                        });

                });

                // Pass the checkbox name to the function
                function getCheckedBoxes(chkboxName) {
                    var checkboxes = document.getElementsByName(chkboxName);
                    var checkboxesCheckedValue = [];
                    // loop over them all
                    for (var i = 0; i < checkboxes.length; i++) {
                        // And stick the checked ones onto an array...
                        if (checkboxes[i].checked) {
                            checkboxesCheckedValue.push(checkboxes[i].value);
                        }
                    }
                    // Return array of checked value
                    return checkboxesCheckedValue.length > 0 ? checkboxesCheckedValue : null;
                }
            });
        </script>
    @endif

    <script>
        $(document).ready(function () {
            // Detect checkbox check and uncheck of the header
            $('#selectAllContacts').on('change', function(evt) {
                evt.preventDefault();

                // Check or uncheck checkbox based on parent checkbox
                $("input:checkbox[class=select-all-contacts]").prop('checked', this.checked);

                if ( $(this).is(":checked") ) {
                    // Show delete button
                    showDeleteButton($('#deleteCheckedContactsButton'));
                } else {
                    // Hide delete buttons
                    hideDeleteButton($('#deleteCheckedContactsButton'));
                }
            });

            // Detect individuals contact checked or unchecked
            $('.select-all-contacts').on('change', function(evt) {
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
                $('.select-all-contacts:checked').each(function() {
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
                    url: baseurl + '/admin/box-office/smsCampaigns/contact/mass-delete',
                    data: {
                        contacts: contacts
                    },
                    error: function() {
                        showAlertToCheckContacts("Oops!! Server Error Occured");
                    },
                    dataType: 'json',

                    success: function(data) {
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
//                alert( alertMessage );
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
