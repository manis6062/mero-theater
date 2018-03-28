<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Meroshows | Admin Dashboard</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <meta name="csrf-token" content="{{ csrf_token() }}" />


    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="{{asset('admins/css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('admins/dist/css/AdminLTE.min.css')}}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{asset('admins/dist/css/skins/_all-skins.min.css')}}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{asset('admins/plugins/iCheck/flat/blue.css')}}">
    <!-- Morris chart -->
    <link rel="stylesheet" href="{{asset('admins/plugins/morris/morris.css')}}">
    <!-- jvectormap -->
    <link rel="stylesheet" href="{{asset('admins/plugins/jvectormap/jquery-jvectormap-1.2.2.css')}}">
    <!-- Date Picker -->
    <link rel="stylesheet" href="{{asset('admins/plugins/datepicker/datepicker3.css')}}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{asset('admins/plugins/daterangepicker/daterangepicker.css')}}">
    <!-- time picker -->
    <link rel="stylesheet" href="{{asset('admins/plugins/timepicker/bootstrap-timepicker.css')}}">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="{{asset('admins/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">

    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('admins/css/style.css')}}">


    <link rel="stylesheet" href="{{asset('admins/css/icol.css')}}">


    <link rel="stylesheet" href="{{asset('admins/plugins/searchable-option-list/sol.css')}}">

    <link rel="stylesheet" href="{{asset('admins/plugins/alertify/alertify.min.css')}}">

    {{--<link rel="stylesheet" href="{{asset('admins/plugins/datatables/css/dataTables.bootstrap.css')}}">--}}

    {{--<link rel="stylesheet" href="{{asset('admins/plugins/datatables/css/dataTables.jqueryui.css')}}">--}}
    <style>
        .ajs-header{
            display: none !important;
        }
    </style>

    {{--<script src="{{asset('admins/plugins/datatables/css/jquery.dataTables.css')}}"></script>--}}

    {{--<script src="{{asset('admins/plugins/datatables/jquery.dataTables_themeroller.css')}}"></script>--}}


    @yield('styles')
    @include('admin.include.scripts')
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="hold-transition fixed skin-blue sidebar-mini" style="font-family: 'Roboto', sans-serif;">
<div class="wrapper">
    @include('admin.include.header')
    @include('admin.include.leftSideBar')
        <div class="content-wrapper">


            @if(Session::has('success'))
                <div class="alert alert-info responseMessageDiv">
                    <span style="cursor: pointer;" class="pull-right closeResponseMessageDiv">x</span>
                    <p>{{ Session::get('success') }}</p>
                </div>
            @endif


            @if(Session::has('error'))
                <div class="alert alert-warning responseMessageDiv">
                    <span style="cursor: pointer;" class="pull-right closeResponseMessageDiv">x</span>
                    <p>{{ Session::get('error') }}</p>
                </div>
            @endif


            @yield('main-body')


        </div>
    @include('admin.include.footer')
</div>
    @yield('scripts')
<script>
    var baseurl = "<?php echo URL::to('/') ?>";
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('.closeResponseMessageDiv').on('click', function () {
        $('.responseMessageDiv').hide();
    });
</script>
</body>
</html>
