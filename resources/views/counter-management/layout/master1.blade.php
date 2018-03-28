<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="Unify Admin Panel"/>
    <meta name="keywords"
          content="Admin, Dashboard, Bootstrap4, Sass, CSS3, HTML5, Responsive Dashboard, Responsive Admin Template, Admin Template, Best Admin Template, Bootstrap Template, Themeforest"/>
    <meta name="author" content="Bootstrap Gallery"/>
    <link rel="shortcut icon" href="{{asset('admins/theme/img/favicon.png')}}"/>
    <title>MeroTheatre Dashboard</title>

    <!-- Common CSS -->
    @include('counter-management.include.styles')
    <style>
        .ajs-header {
            display: none !important;
        }
    </style>

@yield('styles')
@include('counter-management.include.scripts1')

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

<div class="app-wrap {{\Illuminate\Support\Facades\Request::is('counter-management/booking') ? 'details-movie' : ''}}">
    @if(\Illuminate\Support\Facades\Request::is('counter-management/dashboard'))
        @include('counter-management.include.header1')
    @endif
    <div class="login-dashboard">
        <div class="login-dash-wrapper">
            @yield('main-body')
        </div>
    </div>

    @include('counter-management.include.footer1')
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