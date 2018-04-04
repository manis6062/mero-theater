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
                        <div class="row gutters">
                            <div class=" col-md-12 col-sm-12">
                                <div class="card">
                                    <div class="card-header">Group List</div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table id="basicExample" class="table table-bordered common-table">
                                                <thead>
                                                        <tr>
                                                            <th>Select</th>
                                                            <th>Frist Name</th>
                                                            <th>Last Name</th>
                                                            <th>Email Address</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <th scope="row">
                                                                <input type="checkbox" class="form-check-input">
                                                            </th>
                                                            <td>
                                                                Esingature
                                                            </td>
                                                            <td>Pvt . Ltd</td>
                                                            <td>
                                                                es.prem.khanal@gmail.com
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">
                                                                <input type="checkbox" class="form-check-input">
                                                            </th>
                                                            <td>
                                                                Esingature
                                                            </td>
                                                            <td>Pvt . Ltd</td>
                                                            <td>
                                                                es.prem.khanal@gmail.com
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">
                                                                <input type="checkbox" class="form-check-input">
                                                            </th>
                                                            <td>
                                                                Esingature
                                                            </td>
                                                            <td>Pvt . Ltd</td>
                                                            <td>
                                                                es.prem.khanal@gmail.com
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">
                                                                <input type="checkbox" class="form-check-input">
                                                            </th>
                                                            <td>
                                                                Esingature
                                                            </td>
                                                            <td>Pvt . Ltd</td>
                                                            <td>
                                                                es.prem.khanal@gmail.com
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">
                                                                <input type="checkbox" class="form-check-input">
                                                            </th>
                                                            <td>
                                                                Esingature
                                                            </td>
                                                            <td>Pvt . Ltd</td>
                                                            <td>
                                                                es.prem.khanal@gmail.com
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Row end -->

                    </div>

        <div class="modal fade" id="addContactsToGroupModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add contacts to group</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal" role="form" method="POST"
                              action="{{ url('admin/box-office/email-marketing/group/add-contacts') }}">

                            {{ csrf_field() }}
                            <input type="hidden" name="group_id" value="{{$groupId}}">

                            <table class="table table-striped table-bordered table-hover no-footer"
                                   id="contactsInGroupAssigningTable" role="grid">
                                <thead>
                                <tr>
                                    <th>
                                        <input type="checkbox" id="select-all"/>
                                        <label for="select-all"></label>
                                    </th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Phone</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if ($allContacts)
                                    @foreach($allContacts as $key => $contact)
                                        <tr>
                                            <td>
                                                <input type="checkbox" name="contacts[]" class="contact"
                                                       id="select-{{$contact->id}}" value="{{$contact->id}}"/>
                                                <label for="select-{{$contact->id}}"></label>
                                            </td>
                                            <td>{{$contact->first_name}}</td>
                                            <td>{{$contact->last_name}}</td>
                                            <td>{{$contact->country_code.$contact->phone}}</td>
                                        </tr>
                                    @endforeach


                                @endif
                                </tbody>
                            </table>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit"
                                            class="btn btn-primary {{(count($allContacts)==0) ? 'disabled' : ''}}">
                                        <i class="fa fa-btn"></i> Add contact
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- END: .main-content -->
    </div>



@endsection

<!--Loading page specific css-->
@section('page_js')
    <!-- DataTables JavaScript -->
    <script src="{{ asset('bower_components/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js') }}"></script>
    <!--Custom js-->
    <script src="{{ asset('custom/js/datatable.js') }}"></script>
@endsection
<!--/-->


@section('scripts')
    <script>
        $('#contactsInGroupAssigningTable').DataTable();
    </script>

    <script>
        $(document).ready(function () {
            // Removing contact from this group
            $('.selectedGroup').on('click', function () {
                if (confirm("Are you sure to remove contact from this group")) {
                    var contactId = $(this).data('contact_id');
                    var groupId = $(this).data('group_id');

                    if (contactId != "" && contactId > 0 && groupId != "" && groupId > 0) {
                        // Ajax call to delete the contact associated with the group
                        $.ajax({
                            method: "POST",
                            url: baseurl + "/admin/box-office/email-marketing/group/delete-contacts",
                            data: {contact_id: contactId, group_id: groupId}
                        })
                            .done(function (response) {
                                location.reload();
                            });
                    }
                    else {
                        alert("Incomplete request");
                    }
                }

            });

            // Check or uncheck the contacts
            $("#select-all").on("change", function (evt) {

                if ($(this).prop("checked") == true) {
                    $(".contact").prop("checked", true);
                } else {
                    $(".contact").prop('checked', false);
                }

            });

        });
    </script>
    <script src="{{asset('custom/js/tooltip.js')}}"></script>

    <!-- Javascript -->
    <script>
        $(function () {
            $("#tooltip-1").tooltip();
        });
    </script>
@endsection
