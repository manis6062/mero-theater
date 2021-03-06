<aside class="app-side is-open" id="app-side" aria-expanded="true">
    <!-- BEGIN .side-content -->
    <div class="side-content ">
        <!-- BEGIN .user-actions -->
        <ul class="user-actions">
            <li>
                <a href="#" data-toggle="tooltip" data-placement="top" title="Box Office">
                    <i class="icon-movie_creation"></i>
                </a>
            </li>
            <li>
                <a href="#" data-toggle="tooltip" data-placement="top" title="Counter Management">
                    <i class="icon-meter"></i>
                </a>
            </li>
            <li>
                <a href="#">
                    <a href="#" data-toggle="tooltip" data-placement="top" title="Sales Management">
                        <i class="icon-price-tag"></i>
                    </a>
            </li>
            <li>
                <a href="setting.html" data-toggle="tooltip" data-placement="top" title="Setting">
                    <i class="icon-cog3"></i>
                </a>
            </li>
            <li>
                <a href="profile.html" data-toggle="tooltip" data-placement="top" title="Profile">
                    <i class="icon-account_circle"></i>
                </a>
            </li>
            <li>
                <a href="filters.html" data-toggle="tooltip" data-placement="top" title="Activity">
                    <i class="icon-schedule"></i>
                </a>
            </li>
        </ul>
        <!-- END .user-actions -->
        <!-- BEGIN .side-nav -->
        <nav class="side-nav">
            <!-- BEGIN: side-nav-content -->
            <ul class="unifyMenu" id="unifyMenu">

                <li>
                    <a href="{{url('admin/dashboard')}}">
								<span class="has-icon">
									<i class="icon-dashboard"></i>
								</span>
                        <span class="nav-title">Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="#" class="has-arrow" aria-expanded="false">
								<span class="has-icon">
									<i class="icon-movie_creation"></i>
								</span>
                        <span class="nav-title">Box Office</span>
                    </a>
                    <ul aria-expanded="false" class="collapse">
                        <li>
                            <a href="{{url('admin/box-office/artist')}}">
										<span class="has-icon">
											<i class="icon-accessibility"></i>
										</span>
                                <span class="nav-title">Manage Artists </span>
                            </a>
                        </li>
                        <li>
                            <a href="{{url('admin/box-office/movies')}}">
										<span class="has-icon">
											<i class="icon-film2"></i>
										</span>
                                <span class="nav-title">Manage Films </span>
                            </a>
                        </li>
                        <li>
                            <a href="{{url('admin/box-office/ticket-types/classes')}}">
										<span class="has-icon">
											<i class="icon-ticket"></i>
										</span>
                                <span class="nav-title">Ticket Classes </span>
                            </a>
                        </li>
                        <li>
                            <a href="{{url('admin/box-office/ticket-types')}}">
										<span class="has-icon">
											<i class="icon-ticket2"></i>
										</span>
                                <span class="nav-title">Ticket Types </span>
                            </a>
                        </li>
                        <li>
                            <a href="{{url('admin/box-office/price-card-management')}}">
										<span class="has-icon">
											<i class="icon-folder"></i>
										</span>
                                <span class="nav-title">Price Card Management </span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="{{url('admin/seat-management/screens')}}">
								<span class="has-icon">
									<i class="icon-airline_seat_individual_suite"></i>
								</span>
                        <span class="nav-title">Seat Management</span>
                    </a>
                </li>

                {{--side bar for programming--}}
                <li>
                    <a href="{{ url('admin/programming') }}">
                        <span class="has-icon">
									<i class="icon-code"></i>
								</span>
                        <span class="nav-title">Programming</span>
                    </a>
                </li>

                <li>
                    <a href="{{url('admin/counter')}}">
								<span class="has-icon">
									<i class="icon-meter"></i>
								</span>
                        <span class="nav-title">Counter Management</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="has-arrow" aria-expanded="false">
								<span class="has-icon">
									<i class="icon-envelope"></i>
								</span>
                        <span class="nav-title">Email Marketing</span>
                    </a>
                    <ul aria-expanded="false" class="collapse">
                        <li>
                            <a href="overview.html">
										<span class="has-icon">
											<i class="icon-eye-plus"></i>
										</span>
                                <span class="nav-title">Overview </span>
                            </a>
                        </li>
                        <li>
                            <a href="manage-contact.html">
										<span class="has-icon">
											<i class="icon-address-book"></i>
										</span>
                                <span class="nav-title">Manage Contact</span>
                            </a>
                        </li>
                        <li>
                            <a href="manage-group.html">
										<span class="has-icon">
											<i class="icon-users"></i>
										</span>
                                <span class="nav-title">Manage Groups </span>
                            </a>
                        </li>
                        <li>
                            <a href="campaign.html">
										<span class="has-icon">
											<i class="icon-announcement"></i>
										</span>
                                <span class="nav-title">Campaign </span>
                            </a>
                        </li>
                        <li>
                            <a href="list-template.html">
										<span class="has-icon">
											<i class="icon-list-numbered"></i>
										</span>
                                <span class="nav-title">List Template </span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="has-arrow" aria-expanded="false">
								<span class="has-icon">
									<i class="icon-textsms"></i>
								</span>
                        <span class="nav-title">SMS Marketing</span>
                    </a>
                    <ul aria-expanded="false" class="collapse">
                        <li>
                            <a href="{{url('admin/box-office/smsCampaigns/overView')}}">
										<span class="has-icon">
											<i class="icon-eye-plus"></i>
										</span>
                                <span class="nav-title">Overview </span>
                            </a>
                        </li>
                        <li>
                            <a href="manage-contact.html">
										<span class="has-icon">
											<i class="icon-address-book"></i>
										</span>
                                <span class="nav-title">Manage Contact</span>
                            </a>
                        </li>
                        <li>
                            <a href="manage-group.html">
										<span class="has-icon">
											<i class="icon-users"></i>
										</span>
                                <span class="nav-title">Manage Groups </span>
                            </a>
                        </li>
                        <li>
                            <a href="campaign.html">
										<span class="has-icon">
											<i class="icon-announcement"></i>
										</span>
                                <span class="nav-title">Campaign </span>
                            </a>
                        </li>
                        <li>
                            <a href="list-template.html">
										<span class="has-icon">
											<i class="icon-list-numbered"></i>
										</span>
                                <span class="nav-title">List Template </span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="has-arrow" aria-expanded="false">
								<span class="has-icon">
									<i class="icon-price-tag"></i>
								</span>
                        <span class="nav-title">Sales Management</span>
                    </a>
                    <ul aria-expanded="false">
                        <li>
                            <a href="reservation-report.html">
										<span class="has-icon">
											<i class="icon-presentation"></i>
										</span>
                                <span class="nav-title">Reservation Report </span>
                            </a>
                        </li>
                        <li>
                            <a href="sold-report.html">
										<span class="has-icon">
											<i class="icon-pricetags"></i>
										</span>
                                <span class="nav-title">Sold Reports </span>
                            </a>
                        </li>
                        <li>
                            <a href="transaction-log.html">
										<span class="has-icon">
											<i class="icon-spreadsheet"></i>
										</span>
                                <span class="nav-title">Transaction log </span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="has-arrow" aria-expanded="false">
								<span class="has-icon">
									<i class="icon-file-text"></i>
								</span>
                        <span class="nav-title">Content Manage</span>
                    </a>
                    <ul aria-expanded="false" class="collapse">
                        <li>
                            <a href="{{url('admin/content-management/manage-pages')}}">
										<span class="has-icon">
											<i class="icon-equalizer"></i>
										</span>
                                <span class="nav-title">Manage Pages </span>
                            </a>
                        </li>
                        <li>
                            <a href="{{url('admin/content-management/manage-news/news')}}">
										<span class="has-icon">
											<i class="icon-satellite"></i>
										</span>
                                <span class="nav-title">Manage News</span>
                            </a>
                        </li>
                         <li>
                            <a href="{{url('admin/content-management/manage-news/manage-category')}}">
                                        <span class="has-icon">
                                            <i class="icon-tags"></i>
                                        </span>
                                <span class="nav-title">Manage Category</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{url('admin/content-management/inquiry')}}">
										<span class="has-icon">
											<i class="icon-search"></i>
										</span>
                                <span class="nav-title">List of inquiry </span>
                            </a>
                        </li>
                        <li>
                            <a href="{{url('admin/content-management/notification/footer')}}">
										<span class="has-icon">
											<i class="icon-bell"></i>
										</span>
                                <span class="nav-title">List of Notification </span>
                            </a>
                        </li>
                      <!--   <li>
                            <a href="{{url('admin/content-management/payment-gateway')}}">
										<span class="has-icon">
											<i class="icon-credit-card"></i>
										</span>
                                <span class="nav-title">List of Payment Gateway </span>
                            </a>
                        </li> -->
                        <li>
                            <a href="{{url('admin/content-management/social-media')}}">
										<span class="has-icon">
											<i class="icon-share3"></i>
										</span>
                                <span class="nav-title">Social Media Links </span>
                            </a>
                        </li>
                        <li>
                            <a href="{{url('admin/content-management/contact-us')}}">
										<span class="has-icon">
											<i class="icon-phone"></i>
										</span>
                                <span class="nav-title">Contact Us </span>
                            </a>
                        </li>
                        <li>
                            <a href="{{url('admin/content-management/promotional-banner')}}">
										<span class="has-icon">
											<i class="icon-map3"></i>
										</span>
                                <span class="nav-title">Promotional Banner </span>
                            </a>
                        </li>
                        <li>
                            <a href="{{url('admin/content-management/movie-banner')}}">
										<span class="has-icon">
											<i class="icon-map2"></i>
										</span>
                                <span class="nav-title">Movie Banner </span>
                            </a>
                        </li>
                    </ul>
                </li>


  <li>
                    <a href="#" class="has-arrow" aria-expanded="false">
                                <span class="has-icon">
                                    <i class="icon-credit-card"></i>
                                </span>
                        <span class="nav-title">Payments</span>
                    </a>
                    <ul aria-expanded="false" class="collapse">
                         <li>
                    <a href="{{url('admin/content-management/payment-gateway')}}">
                                <span class="has-icon">
                                    <i class="icon-credit-card"></i>
                                </span>
                        <span class="nav-title">Payment Method</span>
                    </a>
                </li>
                  <li>
                    <a href="{{url('admin/payments/transactionlog')}}">
                                <span class="has-icon">
                                    <i class="icon-price-tag"></i>
                                </span>
                        <span class="nav-title">Transaction Log</span>
                    </a>
                </li>
                    </ul>
                </li>







              
                <li>
                    <a href="{{url('admin/crm')}}">
								<span class="has-icon">
									<i class="icon-supervisor_account"></i>
								</span>
                        <span class="nav-title">CRM</span>
                    </a>
                </li>
                <li>
                    <a href="#">
								<span class="has-icon">
									<i class="icon-business_center"></i>
								</span>
                        <span class="nav-title">Business Intelligence</span>
                    </a>
                </li>
                <li>
                    <a href="{{url('admin/coupon')}}">
								<span class="has-icon">
									<i class="icon-gift"></i>
								</span>
                        <span class="nav-title">Coupons &amp; Promo Codes</span>
                    </a>
                </li>
                <li>
                    <a href="#">
								<span class="has-icon">
									<i class="icon-share3"></i>
								</span>
                        <span class="nav-title">Social Media</span>
                    </a>
                </li>
                <li>
                    <a href="{{url('admin/profile')}}">
								<span class="has-icon">
									<i class="icon-account_circle"></i>
								</span>
                        <span class="nav-title">Profile</span>
                    </a>
                </li>
                <li>
                    <a href="{{url('admin/settings')}}">
								<span class="has-icon">
									<i class="icon-settings"></i>
								</span>
                        <span class="nav-title">Setting</span>
                    </a>
                </li>
                <li>
                    <a href="{{url('admin/logout')}}">
								<span class="has-icon">
									<i class="icon-power_settings_new"></i>
								</span>
                        <span class="nav-title">Logout</span>
                    </a>
                </li>


            </ul>
            <!-- END: side-nav-content -->
        </nav>
        <!-- END: .side-nav -->
    </div>
    <!-- END: .side-content -->
</aside>