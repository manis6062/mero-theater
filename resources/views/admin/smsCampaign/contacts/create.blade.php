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
                                    <a href="{{url('admin/box-office/smsCampaigns/contact')}}" class="btn btn-success btn-sm">List Contact</a>
                                </div>
                            </div>
                        </div>

                        <div class="panel-body">
                            <form class="form-horizontal" role="form" method="POST"
                                  action="{{ route('contact.store') }}">
                                {{ csrf_field() }}

                                <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                                    <label for="first_name" class="col-md-4 control-label">First Name<span
                                                class="required-indicator">*</span></label>

                                    <div class="col-md-6">
                                        <input id="first_name" type="text" class="form-control" name="first_name"
                                               value="{{ old('first_name') }}">

                                        @if ($errors->has('first_name'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                                    <label for="last_name" class="col-md-4 control-label">Last Name<span
                                                class="required-indicator">*</span></label>

                                    <div class="col-md-6">
                                        <input id="last_name" type="text" class="form-control" name="last_name"
                                               value="{{ old('last_name') }}">

                                        @if ($errors->has('last_name'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                                    <label for="phone" class="col-md-4 control-label">Phone<span class="required-indicator">*</span></label>

                                    <div class="col-md-6">
                                        <input id="phone" type="text" class="form-control" name="phone"
                                               value="{{ old('phone') }}">

                                        @if ($errors->has('phone'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('group_id') ? ' has-error' : '' }}">
                                    <label for="group_id" class="col-md-4 control-label">Group<span
                                                class="required-indicator">*</span></label>

                                    <div class="col-md-6">
                                        <select name="group_id" id="group_id" class="form-control">
                                            <option value="">Choose Group</option>
                                            @if ($groups)
                                                @foreach($groups as $group)
                                                    <option value="{{$group->id}}">{{$group->name}}</option>
                                                @endforeach
                                            @endif
                                        </select>

                                        @if ($errors->has('group_id'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('group_id') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-btn"></i> Create
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <hr>
                            <!--Importing excel file-->
                            <form class="form-horizontal" role="form" method="POST"
                                  action="{{ url('admin/box-office/smsCampaigns/contact/import/xlsx') }}" enctype="multipart/form-data">
                                {{ csrf_field() }}

                                <div class="form-group{{ $errors->has('contacts') ? ' has-error' : '' }}">
                                    <label for="contacts" class="col-md-4 control-label">Contact List File<span
                                                class="required-indicator">*</span></label>

                                    <div class="col-md-6">
                                        <input id="contacts" type="file" class="form-control" name="contacts"
                                               value="{{ old('contacts') }}">

                                        @if ($errors->has('contacts'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('contacts') }}</strong>
                                    </span>
                                        @endif
                                        <label for="">Download :
                                            <a href="{{url('/uploads/import/contacts-sample-1.xls')}}" target="_blank">Sample 1</a>
                                            |
                                            <a href="{{url('/uploads/import/contacts.xlsx')}}" target="_blank">Sample 2</a>
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('group_id') ? ' has-error' : '' }}">
                                    <label for="group_id_export" class="col-md-4 control-label">Group<span
                                                class="required-indicator">*</span></label>

                                    <div class="col-md-6">
                                        <select name="group_id" id="group_id" class="form-control">
                                            <option value="">Choose Group</option>
                                            @if ($groups)
                                                @foreach($groups as $group)
                                                    <option value="{{$group->id}}">{{$group->name}}</option>
                                                @endforeach
                                            @endif
                                        </select>

                                        @if ($errors->has('group_id'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('group_id') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-btn"></i> Import
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
        <!-- END: .main-content -->
    </div>




@endsection
