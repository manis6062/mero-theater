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
            <li {{(\Illuminate\Support\Facades\Request::is('movies'))? 'class=active' : ''}}>
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Movies</span>
                </a>
                <ul class="treeview-menu">
                    <li {{(\Illuminate\Support\Facades\Request::is('admin/events/create'))? 'class=active' : ''}}>
                        <a href="{{ url('admin/movies/create') }}"><i class="fa fa-circle-o"></i>Add Movie</a>
                    </li>
                    <li {{(\Illuminate\Support\Facades\Request::is('admin/events'))? 'class=active' : ''}}>
                        <a href="{{ url('admin/movies') }}"><i class="fa fa-circle-o"></i>Movies List</a>
                    </li>
                </ul>
            </li>



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
