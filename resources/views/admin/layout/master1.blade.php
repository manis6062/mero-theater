<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="Unify Admin Panel" />
    <meta name="keywords" content="Admin, Dashboard, Bootstrap4, Sass, CSS3, HTML5, Responsive Dashboard, Responsive Admin Template, Admin Template, Best Admin Template, Bootstrap Template, Themeforest" />
    <meta name="author" content="Bootstrap Gallery" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{asset('admins/theme/img/favicon.png')}}" />
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>



    <title>MeroTheatre Dashboard</title>

    <!-- Common CSS -->
    @include('admin.include.styles')
    <style>
        .ajs-header{
            display: none !important;
        }
    </style>

    @yield('styles')
    @include('admin.include.scripts1')
    <script src="{{url('/custom/js/jquery.toaster.js')}}"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
    <script type="text/javascript">
        $.toaster({ settings : {timeout : 5000} });


    </script>



    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>
<div class="loading-wrapper" style="display: none;">
    <div class="loading">
        <div class="img"></div>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
    </div>
</div>

<div class="app-wrap">
    @include('admin.include.header1')
    <div class="app-container">
        @include('admin.include.sidebar1')
        @yield('main-body')
    </div>

    @include('admin.include.footer1')
</div>
</body>
</html>
<script>
    var baseurl = "<?php echo URL::to('/') ?>";
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        }
    });
    $('.closeResponseMessageDiv').on('click', function () {
        $('.responseMessageDiv').hide();
    });
</script>
@yield('scripts')

