<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar" style="height: auto;">
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">

            <li {{(\Illuminate\Support\Facades\Request::is('dashboard'))? 'class=active' : ''}}>
                <a href="{{ url('admin/dashboard') }}">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>

                </a>
            </li>

            <!-- Side Bar For Box Office -->
            <li class="treeview {{(\Illuminate\Support\Facades\Request::is('admin/boxoffice/*') || \Illuminate\Support\Facades\Request::is('admin/boxoffice'))? 'active' : ''}}">
                <a href="#">
                    <i class="fa fa-clone"></i>
                    <span>Box Office</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">

                    <li {{(\Illuminate\Support\Facades\Request::is('admin/box-office/artist'))? 'class=active' : ''}}><a
                                href="{{ url('admin/box-office/artist') }}"><i class="fa fa-circle-o"></i> Manage Artists</a>
                    </li>

                    <li {{(\Illuminate\Support\Facades\Request::is('admin/box-office/movies'))? 'class=active' : ''}}><a
                                href="{{ url('admin/box-office/movies') }}"><i class="fa fa-circle-o"></i> Manage Films</a>
                    </li>

                    <li {{(\Illuminate\Support\Facades\Request::is('admin/box-office/tickets'))? 'class=active' : ''}}><a
                                href="{{ url('admin/tickets') }}"><i class="fa fa-circle-o"></i>Tickets</a>
                    </li>
                </ul>
            </li>
            <!-- Side bar for Box Office End -->


            {{--side bar for screens--}}
            <li class="treeview {{(\Illuminate\Support\Facades\Request::is('admin/seat-management/*') || \Illuminate\Support\Facades\Request::is('admin/seat-management'))? 'active' : ''}}">
                <a href="#">
                    <i class="fa fa-clone"></i>
                    <span>Seat Management</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    {{--<li {{(\Illuminate\Support\Facades\Request::is('admin/screens/create'))? 'class=active' : ''}}><a--}}
                                {{--href="{{ url('admin/screens/create') }}"><i class="fa fa-circle-o"></i> Add Screen</a>--}}
                    {{--</li>--}}
                    <li {{(\Illuminate\Support\Facades\Request::is('admin/seat-management/screens'))? 'class=active' : ''}}><a
                                href="{{ url('admin/seat-management/screens') }}"><i class="fa fa-circle-o"></i> Screens</a></li>
                </ul>
            </li>
            {{--side bar for screens--}}
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
