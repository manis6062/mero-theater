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
                                    <a href="{{url('admin/box-office/smsCampaigns/group')}}" class="btn btn-success btn-sm">List Group</a>
                                    &nbsp;
                                    <a href="{{url('admin/box-office/smsCampaigns/group/create')}}"
                                       class="btn btn-primary btn-sm">Add Group</a>
                                </div>
                            </div>
                        </div>

                        <div class="panel-body">
                            {!! Form::model($item, [ 'method' => 'PATCH', 'route' => ['group.update', $item->id], 'role' => 'form', 'class' => 'form-horizontal' ] ) !!}

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                {!! Form::label('name', 'Name*', array('class' => 'col-md-4 control-label')) !!}

                                <div class="col-md-6">
                                    {!! Form::text('name', old('name'), ['class' => 'form-control', 'id' => 'name']) !!}

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-btn"></i> Update Group
                                    </button>
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: .main-content -->
        </div>
        <!-- END: .main-content -->
    </div>

@endsection
