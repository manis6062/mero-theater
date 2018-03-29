<header class="app-header login-dash-header">
    <div class="container-fluid">
        <div class="row gutters">
            <div class="col-xl-6 col-lg-6 col-md-6">
                <a href="index.html" class="logo">
                    <img src="{{asset('admins/theme/img/mero-theatre-logo.png')}}" alt="Merotheatre Admin Dashboard">
                </a>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6">
                <ul class="header-actions">
                    <li class="dropdown">
                        <a href="#" id="notifications" data-toggle="dropdown" aria-haspopup="true">
                            Search
                        </a>
                        <div class="dropdown-menu dropdown-menu-right lg" aria-labelledby="notifications">
                            <ul class="imp-notify">
                                <li>
                                    <div class="input-group">
                                        <input class="form-control" placeholder="Search" type="text">
                                        <span class="input-group-addon"><i class="icon-search"></i></span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a href="#" id="notifications">
                            Pasto
                        </a>
                    </li>
                    <li class="dropdown">
                        <a href="#" id="notifications" data-toggle="dropdown" aria-haspopup="true">
                            Date
                        </a>
                        <div class="dropdown-menu dropdown-menu-right lg" aria-labelledby="notifications">
                            <ul class="imp-notify">
                                <li>
                                    <div class="input-group date">
                                        <input class="form-control" placeholder="select date" type="text">
                                        <span class="input-group-addon"><i class="icon-calendar"></i></span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a href="#" id="notifications">
                            Shows
                        </a>
                    </li>
                    <li class="dropdown">
                        <a href="#" id="userSettings" class="user-settings" data-toggle="dropdown" aria-haspopup="true">
                            <img class="avatar" src="{{asset('admins/theme/img/user.png')}}" alt="User Thumb">
                            <span class="user-name">Katy Perry</span>
                            <i class="icon-chevron-small-down"></i>
                        </a>
                        <div class="dropdown-menu lg dropdown-menu-right" aria-labelledby="userSettings">
                            <ul class="user-settings-list">
                                <li>
                                    <a href="profile.html">
                                        <div class="icon">
                                            <i class="icon-account_circle"></i>
                                        </div>
                                        <p>Profile</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="profile.html">
                                        <div class="icon red">
                                            <i class="icon-cog3"></i>
                                        </div>
                                        <p>Settings</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="filters.html">
                                        <div class="icon yellow">
                                            <i class="icon-schedule"></i>
                                        </div>
                                        <p>Activity</p>
                                    </a>
                                </li>
                            </ul>
                            <div class="logout-btn">
                                <a href="login.html" class="btn btn-primary">Logout</a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>