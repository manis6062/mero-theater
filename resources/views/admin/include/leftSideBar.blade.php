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
            <li class="treeview {{(\Illuminate\Support\Facades\Request::is('admin/box-office/*') || \Illuminate\Support\Facades\Request::is('admin/box-office'))? 'active' : ''}}">
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

                    <li {{(\Illuminate\Support\Facades\Request::is('admin/box-office/ticket-types/classes'))? 'class=active' : ''}}>
                        <a href="{{ url('admin/box-office/ticket-types/classes') }}"><i class="fa fa-circle-o"></i>Ticket Classes</a></li>

                    <li {{(\Illuminate\Support\Facades\Request::is('admin/box-office/ticket-types') || \Illuminate\Support\Facades\Request::is('admin/box-office/ticket-types/create') || \Illuminate\Support\Facades\Request::is('admin/box-office/ticket-types/edit'))? 'class=active' : ''}}><a
                                href="{{ url('admin/box-office/ticket-types') }}"><i class="fa fa-circle-o"></i>Ticket Types</a></li>

                    <li {{(\Illuminate\Support\Facades\Request::is('admin/box-office/price-card-management') || \Illuminate\Support\Facades\Request::is('admin/box-office/price-card-management/*'))? 'class=active' : ''}}><a
                                href="{{ url('admin/box-office/price-card-management') }}"><i class="fa fa-circle-o"></i>Price Card Management</a></li>
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
                    <li {{(\Illuminate\Support\Facades\Request::is('admin/seat-management/screens'))? 'class=active' : ''}}><a
                                href="{{ url('admin/seat-management/screens') }}"><i class="fa fa-circle-o"></i> Screens</a></li>
                </ul>
            </li>

        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
