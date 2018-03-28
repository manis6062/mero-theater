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


            {{--side bar for programming--}}
            <li {{(\Illuminate\Support\Facades\Request::is('admin/programming') || \Illuminate\Support\Facades\Request::is('admin/programming/*'))? 'class=active' : ''}}>
                <a href="{{ url('admin/programming') }}">
                    <i class="fa fa-bars"></i> <span>Programming</span>

                </a>
            </li>


            <!-- Side Bar for Content Management -->
            <li class="treeview {{(\Illuminate\Support\Facades\Request::is('admin/content-management/*') || \Illuminate\Support\Facades\Request::is('admin/content-management'))?'active':''}}">
                <a href="#">
                    <i class="fa fa-clone"></i>
                    <span>Content Management</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>

                <ul class="treeview-menu">
                    <li {{ (\Illuminate\Support\Facades\Request::is('admin/content-management/manage-pages'))?'class=active':'' }}>
                        <a href="{{url('admin/content-management/manage-pages') }}"><i class="fa fa-circle-o"></i>Manage Pages</a>
                    </li>
                </ul>

                <ul class="treeview-menu {{(\Illuminate\Support\Facades\Request::is('admin/content-management/manage-news/*') || \Illuminate\Support\Facades\Request::is('admin/content-management/manage-news'))?'active':''}} ">
                    <a href="#">
                        <i class="fa fa-clone"></i>
                        <span>Manage News</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>

                    <li {{ (\Illuminate\Support\Facades\Request::is('admin/content-management/manage-news/manage-category'))?'class=active':'' }}>
                        <a href="{{url('admin/content-management/manage-news/manage-category') }}"><i class="fa fa-circle-o"></i>Manage Category</a>
                    </li>

                    <li {{ (\Illuminate\Support\Facades\Request::is('admin/content-management/manage-news/news'))?'class=active':'' }}>
                        <a href="{{url('admin/content-management/manage-news/news') }}"><i class="fa fa-circle-o"></i>News List</a>
                    </li>

                    <li {{ (\Illuminate\Support\Facades\Request::is('admin/content-management/manage-news/news/create'))?'class=active':'' }}>
                        <a href="{{url('admin/content-management/manage-news/news/create') }}"><i class="fa fa-circle-o"></i>Add News</a>
                    </li>
                </ul>

                <ul class="treeview-menu ">
                    <li {{ (\Illuminate\Support\Facades\Request::is('admin/content-management/inquiry'))?'class=active':'' }}>
                        <a href="{{url('admin/content-management/inquiry') }}"><i class="fa fa-circle-o"></i>List of Inquiry</a>
                    </li>
                </ul>

                <ul class="treeview-menu {{(\Illuminate\Support\Facades\Request::is('admin/content-management/notification/*') || \Illuminate\Support\Facades\Request::is('admin/content-management/notification'))?'active':''}} ">
                    <a href="#">
                        <i class="fa fa-clone"></i>
                        <span>List of Notification</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>

                    <li {{ (\Illuminate\Support\Facades\Request::is('admin/content-management/notification/footer'))?'class=active':'' }}>
                        <a href="{{url('admin/content-management/notification/footer') }}"><i class="fa fa-circle-o"></i>Footer Copyright content</a>
                    </li>

                    <li {{ (\Illuminate\Support\Facades\Request::is('admin/content-management/notification/footer'))?'class=active':'' }}>
                        <a href="{{url('admin/content-management/notification/message') }}"><i class="fa fa-circle-o"></i>Message After registration</a>
                    </li>
                </ul>

                <ul class="treeview-menu">
                    <li {{ (\Illuminate\Support\Facades\Request::is('admin/content-management/promotional-banner'))?'class=active':'' }}>
                        <a href="{{url('admin/content-management/promotional-banner') }}"><i class="fa fa-circle-o"></i>Promotional Banner</a>
                    </li>
                </ul>

                <ul class="treeview-menu">
                    <li {{ (\Illuminate\Support\Facades\Request::is('admin/content-management/movie-banner'))?'class=active':'' }}>
                        <a href="{{url('admin/content-management/movie-banner') }}"><i class="fa fa-circle-o"></i>Movie Banner</a>
                    </li>
                </ul>

                <ul class="treeview-menu">
                    <li {{ (\Illuminate\Support\Facades\Request::is('admin/content-management/payment-gateway'))?'class=active':'' }}>
                        <a href="{{url('admin/content-management/payment-gateway') }}"><i class="fa fa-circle-o"></i>List of Payment Gateway</a>
                    </li>
                </ul>

                <ul class="treeview-menu">
                    <li {{ (\Illuminate\Support\Facades\Request::is('admin/content-management/social-media'))?'class=active':'' }}>
                        <a href="{{url('admin/content-management/social-media') }}"><i class="fa fa-circle-o"></i>Social Media Links</a>
                    </li>
                </ul>

                <ul class="treeview-menu">
                    <li {{ (\Illuminate\Support\Facades\Request::is('admin/content-management/contact-us'))?'class=active':'' }}>
                        <a href="{{url('admin/content-management/contact-us') }}"><i class="fa fa-circle-o"></i>Contact Us</a>
                    </li>
                </ul>
            </li>
            <!-- Side bar for Content Managemet Ends -->

>>>>>>> Stashed changes

        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
