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
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default" style="border-top: 5px solid green;">
                        <div class="panel-heading">
                            <div class="row">
                                <!--Adding quick link-->
                                <div class="col-md-6 pull-left">
                                    <a href="{{url('admin/box-office/smsCampaigns/contact')}}" class="btn btn-success btn-sm">List contact</a>
                                    &nbsp;
                                    <a href="{{ url('admin/box-office/smsCampaigns/contact/create') }}"
                                       class="btn btn-primary btn-sm">Add Contact</a>
                                </div>
                            </div>
                        </div>

                        <div class="panel-body">
                            {!! Form::model($item, [ 'method' => 'PATCH', 'route' => ['contact.update', $item->id], 'role' => 'form', 'class' => 'form-horizontal' ] ) !!}

                            <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                                {!! Form::label('first_name', 'First Name*', array('class' => 'col-md-4 control-label')) !!}

                                <div class="col-md-6">
                                    {!! Form::text('first_name', old('first_name'), ['class' => 'form-control', 'id' => 'first_name']) !!}

                                    @if ($errors->has('first_name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('first_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                                {!! Form::label('last_name', 'Last Name*', array('class' => 'col-md-4 control-label')) !!}

                                <div class="col-md-6">
                                    {!! Form::text('last_name', old('last_name'), ['class' => 'form-control', 'id' => 'last_name']) !!}

                                    @if ($errors->has('last_name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                                {!! Form::label('phone', 'Phone*', array('class' => 'col-md-4 control-label')) !!}

                                <div class="col-md-6">
                                    {!! Form::text('phone', old('phone'), ['class' => 'form-control', 'id' => 'phone']) !!}

                                    @if ($errors->has('phone'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-btn"></i> Update
                                    </button>
                                </div>
                            </div>
                            {!! Form::close() !!}

                            {{--@if ($selectedGroups)--}}
                                {{--<hr>--}}
                                {{--<div class="row">--}}
                                    {{--<!--Showing added groups-->--}}
                                    {{--<div class="form-group">--}}
                                        {{--{!! Form::label('last_name', 'Added in Groups', array('class' => 'col-md-4 control-label')) !!}--}}

                                        {{--<div class="col-md-6">--}}
                                            {{--@foreach($selectedGroups as $selectedGroup)--}}
                                                {{--<a class="btn btn-default btn-sm selectedGroup"--}}
                                                   {{--data-id="{{$selectedGroup->contact_group_id}}"--}}
                                                {{-->--}}
                                                    {{--<span class="glyphicon glyphicon-remove"></span> {{$selectedGroup->name}}--}}
                                                {{--</a>--}}
                                            {{--@endforeach--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--@endif--}}

                            {{--@if ($notSelectedGroups)--}}
                                {{--<hr>--}}
                                {{--<div class="row">--}}
                                    {{--<!--Show Unadded groups-->--}}
                                    {{--<div class="form-group">--}}
                                        {{--{!! Form::label('last_name', 'Add in Group', array('class' => 'col-md-4 control-label')) !!}--}}

                                        {{--<div class="col-md-6">--}}
                                            {{--@foreach($notSelectedGroups as $notSelectedGroup)--}}
                                                {{--<a class="btn btn-default btn-sm notSelectedGroup"--}}
                                                   {{--data-gid="{{$notSelectedGroup->id}}"--}}
                                                   {{--data-cid="{{$contactId}}"--}}
                                                {{-->--}}
                                                    {{--<span class="glyphicon glyphicon-plus"></span> {{$notSelectedGroup->name}}--}}
                                                {{--</a>--}}
                                            {{--@endforeach--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--@endif--}}

                        </div>
                    </div>
                </div>
            </div>
            <!-- END: .main-content -->
        </div>
        <!-- END: .main-content -->
    </div>


@endsection



@section('scripts')
    <script>
        $(document).ready(function () {
            // Removing selected group
            $('.selectedGroup').on('click', function () {
                if (confirm("Are you sure to remove this group")) {
                    var contactGroupId = $(this).data('id');

                    if (contactGroupId != "" && contactGroupId > 0) {
                        // Ajax call to delete the contact associated with the group
                        $.ajax({
                            method: "POST",
                            url: baseurl + "/contact/associated-group/delete",
                            data: {contactGroupId: contactGroupId}
                        })
                            .done(function (response) {
                                if (response.error == false) {
                                    // Showing success message
                                    alert(response.message);

                                    // Reloading the page instead of Remove the group
                                    location.reload();
                                }
                                else {
                                    alert(response.message);
                                }
                            });
                    }
                    else {
                        alert("else part");
                    }
                }

            });

            // Adding group
            $('.notSelectedGroup').on('click', function () {
                if (confirm("Are you sure to add this group")) {
                    var groupId = $(this).data('gid');
                    var contactId = $(this).data('cid');

                    if (groupId != "" && groupId > 0 && contactId != "" && contactId > 0) {
                        // Ajax call to add contact to group
                        $.ajax({
                            method: "POST",
                            url: baseurl + "/contact/associated-group/add",
                            data: {groupId: groupId, contactId: contactId}
                        })
                            .done(function (response) {
                                if (response.error == false) {
                                    // Showing success message
                                    alert(response.message);

                                    // Reloading the page instead of Remove the group
                                    location.reload();
                                }
                                else {
                                    alert(response.message);
                                }
                            });
                    }
                    else {
                        alert("Error occured");
                    }
                }

            });
        });
    </script>
@endsection
