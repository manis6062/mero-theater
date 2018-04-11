@extends('admin.layout.master1')

@section('styles')
<style>
.create-form {
    width: 70%;
    margin-left: 15%;
    margin-right: 15%;
    margin-top: 5%;
    margin-bottom: 5%;
    border: 1px solid #ddd;
    padding: 2%;
}

#screen-name {
    margin: 10px 0 0 0;
}

#seatImageSpan {
    margin: 10px 0 0 0;
    display: block;
}

.subBtn {
    margin: 10px 0;
}

.help-block {
    display: block;
    color: red;
    font-size: 15px;
    font-weight: 500;
}

.info-span{
    font-size: 18px;
    text-align: center;
    font-weight: 600;
    color: magenta;
}

small{
    color: red;
}

span.note{
    font-size: 11px;
    margin: 0;
    padding: 0;
}
</style>
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
                        <i class="icon-border_outer"></i>
                    </div>
                    <div class="page-title">
                        <h5>Group Manage</h5>
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

    <!-- Modal -->
    <div id="add-contacts-to-group" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">

            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <form class="form-horizontal" role="form" method="POST"
                        action="{{ url('admin/email-marketing/emailcontact/add-contacts') }}">
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
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($otherContacts)
                            @foreach($otherContacts as $otherContact)
                            <tr>
                                <td>
                                    <input type="checkbox" name="otherContact[]" class="contact"
                                    id="select-{{$otherContact->id}}" value="{{$otherContact->id}}"/>
                                    <label for="select-{{$otherContact->id}}"></label>
                                </td>
                                <td>{{$otherContact->first_name}}</td>
                                <td>{{$otherContact->last_name}}</td>
                                <td>{{$otherContact->email}}</td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit"
                            class="btn btn-primary {{(count($otherContacts)==0) ? 'disabled' : ''}}">
                            <i class="fa fa-btn"></i> Add contact
                        </button>

                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>
</div>

</div>
</div>
<!-- END: .main-heading -->
<!-- BEGIN .main-content -->
<div class="main-content">
    <div class="row gutters">
        <div class=" col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header">Group List</div>

                <div class="form-group" style="margin-top: 20px">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add-contacts-to-group">Add Contacts To Group</button>
                        <a href="#" class="btn btn-primary" id="deleteCheckedContactsButton" style="display:none;"><span class="glyphicon glyphicon-remove"></span>Remove Contact</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="card-body"  id="recentlyAddedContactModal">
                        <div class="table-responsive">
                            <table id="basicExample" class="table table-bordered common-table">
                                <thead>
                                    <tr>
                                        <th>
                                            <input type="checkbox" id="selectAllContacts" class="select-all-contacts">&nbsp Select All
                                        </th>
                                        <th>Frist Name</th>
                                        <th>Last Name</th>
                                        <th>Email Address</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   @foreach($items as $item)
                                   <tr>
                                    <td>
                                        <input type="checkbox" class="select-all-contacts" value="{{$item->id}}">
                                    </td>
                                    <td>
                                        {{$item->first_name}}
                                    </td>
                                    <td>
                                        {{$item->last_name}}
                                    </td>
                                    <td>
                                        {{$item->email}}
                                    </td>
                                    <td>
                                        <a href="" class="remove-contact" data-toggle="modal" data-placement="top" data-uid="{{$item->id}}" title="Remove contact from group">
                                            <i class="icon-delete"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>

                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<!-- END: .app-main -->
@stop
@section('scripts')
@if (isset($item) && !empty($item))
<script>
   $(document).ready(function () {
                // Showing modal
                

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
                    if($(this).val() != 'on')
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
                    url: baseurl + '/admin/email-marketing/emailgroup/mass-remove',
                    data: {
                        contacts: contacts,
                        groupId: "{{$groupId}}"
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
       alertify.confirm("Are you sure to remove the contact from this group ?",
        function () {
            deleteCheckedContacts(contactIds);
        },
        function () {

        });
   }
   
});
})
</script>
<script>
 $('#contactsInGroupAssigningTable').DataTable();
 $('#create-form').on('submit', function (e) {
    $('.error').html('');

    if ($('#group-name').val() == '') {
        e.preventDefault();
        $('.group-name-error').html('<strong>Please enter the  group name.</strong>');
    }
});
 function removeError() {
    $('.error').html('');
}

$('.remove-contact').on('click', function (e) {
    e.preventDefault();
    var cid = $(this).data('uid');
    var gid = '{{$groupId}}';
    alertify.confirm("Are you sure to remove the contact from this group ?",
        function () {
            $.ajax({
                url: baseurl + '/admin/email-marketing/emailgroup/contact/remove?cid=' + cid +'&gid='+gid,
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
                            url: baseurl + "/admin/box-office/smsCampaigns/group/delete-contacts",
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

    @stop





