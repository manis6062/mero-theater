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
                        <i class="icon-laptop_windows"></i>
                    </div>
                    <div class="page-title">
                        <h5>Manage Email Contact</h5>
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
        @if(\Session::has('message'))
        @php $invalidEmail= \Session::get('message')
        @endphp
        <span style="color: green">
            <strong>Message!</strong> Sucessfully imported.
        </span>
        @endif
        <div class="row gutters">
            <div class=" col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-header artist-header"><a href="{{url('admin/email-marketing/emailcontact/create')}}">Add Contact</a>
                        <a href="#" class="btn btn-danger" id="deleteCheckedContactsButton" style="display:none;"><span class="glyphicon glyphicon-remove"></span> Delete Groups</a></div>
                        <div class="card-body"  id="recentlyAddedContactModal">
                            <div class="table-responsive">

                                <table class="table m-0 table-bordered common-table">
                                    <thead>
                                        <tr>
                                           <th>
                                            <input type="checkbox" id="selectAllContacts" class="select-all-contacts">
                                        </th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Email</th>
                                        <th>Date Added</th>
                                        <th class="table-action">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($items)
                                    @foreach($items as $key => $item)
                                    <tr>
                                        <td>
                                            <input type="checkbox" class="select-all-contacts" value="{{$item->id}}">
                                        </td>
                                        <th>{{$item->first_name}}</th>
                                        <th>{{$item->last_name}}</th>
                                        <th>{{$item->email}}</th>
                                        <td>20{{$item->created_at->format('y-m-d')}}</td>
                                        <td>
                                            <a href="{{route('emailcontact.edit',$item->id)}}" class="table-content-edit" data-toggle="tooltip" data-placement="top" title="Edit"><i class="icon-edit2"></i>
                                            </a>
                                            <a href="" class="table-content-delete delete-contact" data-uid="{{$item->id}}" data-toggle="tooltip" data-placement="top" title="Delete">
                                                <i class="icon-delete2"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td colspan="7" class="text-center">No Any User Found !</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                            {{ $items->links() }}
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
@if (isset($contacts) && !empty($contacts))
<script>
    $(document).ready(function () {
                // Showing modal
                $('#recentlyAddedContactModal').modal('show');

                // Checking or unchecking all
                $('body').on('change', '#check-all', function () {
                    $(".check-all").prop('checked', $(this).prop('checked'));
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
            $('.delete-contact').on('click', function (e) {
                e.preventDefault();
                var uid = $(this).data('uid');
                alertify.confirm("Delete this contact  ?",
                    function () {
                        $.ajax({
                            url: baseurl + '/admin/email-marketing/emailcontact/'+ uid,
                            type: 'DELETE',
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
                $.ajax({
                    url: baseurl + '/admin/email-marketing/emailcontact/mass-remove',
                    data: {
                        contacts: contacts
                    },
                    error: function() {
                        showAlertToCheckContacts("Oops!! Server Error Occured");
                    },

                    success: function(data) {
                       window.location.reload();
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
    } else{
       if(alertify.confirm("Do you want to delete?")) {
           return true;
       } 
   }
   deleteCheckedContacts(contactIds);
});
})
</script>
@stop