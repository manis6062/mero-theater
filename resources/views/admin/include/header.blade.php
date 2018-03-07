<header class="main-header">
    <!-- Logo -->
    <a href="{{ url('admin/dashboard') }}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini" style="margin-top: 20px;"></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg" style="margin-top: 3px; width: 85px; height: auto;"></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="pull-right" style="margin-right: 20px;">
            <div class="logoutLink" style="margin-top: 12px;">
                <a href="{{ url('theatre_admin/logout') }}" style="color: #fff;"><i class="fa fa-sign-out"></i> Sign out</a>
            </div>
        </div>
    </nav>
</header>