<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            @if (Auth::user()->role == 'admin')
                <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/admin') }}">
            @endif
            @if (Auth::user()->role == 'sales')
                <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/sales') }}">
            @endif
            @if (Auth::user()->role == 'superadmin')
                <a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
            @endif

            <div class="sidebar-brand-icon">
                <img src="{{ asset('img/colorful.svg') }}" style="width: 65px; height: 65px;">
            </div>
            <div class="sidebar-brand-text mx-3">CRM<sup>A6</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            @if (Auth::user()->role == 'sales')
                <li class="nav-item {{ Request::is('sales') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('/sales') }}">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Dashboard Sales</span>
                    </a>
                </li>
            @endif
            @if (in_array(Auth::user()->role, ['admin', 'superadmin']))
                <li class="nav-item {{ Request::is('admin') || Request::is('superadmin') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url(Auth::user()->role == 'admin' ? '/admin' : '/superadmin') }}">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Dashboard {{ ucfirst(Auth::user()->role) }}</span>
                    </a>
                </li>
            @endif



            <!-- Divider -->
            <hr class="sidebar-divider">
            @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                <!-- Heading -->
                <div class="sidebar-heading">
                    Sales Management
                </div>
            @endif

            @if (Auth::user()->role == 'sales')
                <!-- Heading -->
                <div class="sidebar-heading">
                    Prospects Management
                </div>
                <!-- Nav Item - Prospects Collapse Menu -->
                <li class="nav-item {{ Request::is('prospects/*') ? 'active' : '' }}">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                        aria-expanded="{{ Request::is('prospects/*') ? 'true' : 'false' }}" aria-controls="collapseTwo">
                        <i class="fas fa-fw fa-user-plus"></i>
                        <span>Prospects</span>
                    </a>
                    <div id="collapseTwo" class="collapse {{ Request::is('prospects/*') ? 'show' : '' }}"
                        aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Manage Prospects:</h6>
                            <a class="collapse-item {{ Request::is('prospects/add-prospect') ? 'active' : '' }}"
                                href="{{ url('prospects/add-prospect') }}">Add Prospect</a>
                            <a class="collapse-item {{ Request::is('prospects/manage-prospects') ? 'active' : '' }}"
                                href="{{ url('prospects/manage-prospects') }}">Manage Prospects</a>
                        </div>
                    </div>
                </li>

                <!-- Nav Item - Activities Collapse Menu -->
                <li class="nav-item {{ Request::is('activities/*') ? 'active' : '' }}">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapactivity"
                        aria-expanded="{{ Request::is('activities/*') ? 'true' : 'false' }}"
                        aria-controls="collapactivity">
                        <i class="fas fa-fw fa-calendar-alt"></i>
                        <span>Activities</span>
                    </a>
                    <div id="collapactivity" class="collapse {{ Request::is('activities/*') ? 'show' : '' }}"
                        aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Manage Activities:</h6>
                            <a class="collapse-item {{ Request::is('activities/list-prospects') ? 'active' : '' }}"
                                href="{{ url('activities/list-prospects') }}">Add Activity</a>
                            <a class="collapse-item {{ Request::is('activities/manage-activities') ? 'active' : '' }}"
                                href="{{ url('activities/manage-activities') }}">Manage Activities</a>
                        </div>
                    </div>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Heading -->
                <div class="sidebar-heading">
                    Customer Management
                </div>
                <!-- Nav Item - Account Collapse Menu -->
                <li class="nav-item {{ Request::is('accounts/*') ? 'active' : '' }}">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAccount"
                        aria-expanded="{{ Request::is('accounts/*') ? 'true' : 'false' }}"
                        aria-controls="collapseAccount">
                        <i class="fas fa-fw fa-building"></i>
                        <span>Account</span>
                    </a>
                    <div id="collapseAccount" class="collapse {{ Request::is('accounts/*') ? 'show' : '' }}"
                        aria-labelledby="headingAccount" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Manage Accounts:</h6>
                            <a class="collapse-item {{ Request::is('accounts/add-account') ? 'active' : '' }}"
                                href="{{ url('/accounts/add-account/') }}">Add Account</a>
                            <a class="collapse-item {{ Request::is('accounts/manage-accounts') ? 'active' : '' }}"
                                href="{{ url('/accounts/manage-accounts/') }}">Manage Accounts</a>
                        </div>
                    </div>
                </li>

                <!-- Nav Item - Contact Collapse Menu -->
                <li class="nav-item {{ Request::is('contacts/*') ? 'active' : '' }}">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseContact"
                        aria-expanded="{{ Request::is('contacts/*') ? 'true' : 'false' }}"
                        aria-controls="collapseContact">
                        <i class="fas fa-fw fa-user"></i>
                        <span>Contact</span>
                    </a>
                    <div id="collapseContact" class="collapse {{ Request::is('contacts/*') ? 'show' : '' }}"
                        aria-labelledby="headingContact" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Manage Contacts:</h6>
                            <a class="collapse-item {{ Request::is('contacts/add-contact') ? 'active' : '' }}"
                                href="{{ url('/contacts/add-contact') }}">Add Contact</a>
                            <a class="collapse-item {{ Request::is('contacts/manage-contacts') ? 'active' : '' }}"
                                href="{{ url('/contacts/manage-contacts') }}">Manage Contacts</a>
                        </div>
                    </div>
                </li>

                <!-- Nav Item - Deals Collapse Menu -->
                <li class="nav-item {{ Request::is('deals/*') ? 'active' : '' }}">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseDeals"
                        aria-expanded="{{ Request::is('deals/*') ? 'true' : 'false' }}"
                        aria-controls="collapseDeals">
                        <i class="fas fa-fw fa-handshake"></i>
                        <span>Deals</span>
                    </a>
                    <div id="collapseDeals" class="collapse {{ Request::is('deals/*') ? 'show' : '' }}"
                        aria-labelledby="headingDeals" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Manage Deals:</h6>
                            <a class="collapse-item {{ Request::is('deals/add-deal') ? 'active' : '' }}"
                                href="{{ url('/deals/add-deal') }}">Add Deal</a>
                            <a class="collapse-item {{ Request::is('deals/manage-deals') ? 'active' : '' }}"
                                href="{{ url('/deals/manage-deals') }}">Manage Deals</a>
                        </div>
                    </div>
                </li>
            @endif

            @if (Auth::user()->role == 'superadmin')
                <li class="nav-item {{ Request::is('manage-admin') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('/manage-admin') }}">
                        <i class="fas fa-fw fa-user-shield"></i>
                        <span>Manage Admin</span>
                    </a>
                </li>
            @endif
            <!-- Nav Item - Additional Menus for Admin -->
            @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                <li class="nav-item {{ Request::is('sales/manage-sales') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('/sales/manage-sales') }}">
                        <i class="fas fa-fw fa-users"></i>
                        <span>Manage Sales</span>
                    </a>
                </li>

                <hr class="sidebar-divider">
                <div class="sidebar-heading">
                    Report Management
                </div>

                <li class="nav-item {{ Request::is('reports/reports-sales') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('/reports/reports-sales') }}">
                        <i class="fas fa-chart-line"></i>
                        <span>Report & Statistic</span>
                    </a>
                </li>
                <!-- Divider -->
                <hr class="sidebar-divider d-none d-md-block">
                <div class="sidebar-heading">
                    All Data
                </div>

                <li class="nav-item {{ Request::is('reports/reports-prospects') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('/reports/reports-prospects') }}">
                        <i class="fas fa-user-tag"></i>
                        <span>All Prospects</span>
                    </a>
                </li>
                <li class="nav-item {{ Request::is('reports/reports-activities') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('/reports/reports-activities') }}">
                        <i class="fas fa-calendar-alt"></i>
                        <span>All Activities</span>
                    </a>
                </li>

                <li class="nav-item {{ Request::is('reports/reports-accounts') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('/reports/reports-accounts') }}">
                        <i class="fas fa-building"></i>
                        <span>All Accounts</span>
                    </a>
                </li>

                <li class="nav-item {{ Request::is('reports/reports-contacts') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('/reports/reports-contacts') }}">
                        <i class="fas fa-address-book"></i>
                        <span>All Contacts</span>
                    </a>
                </li>

                <li class="nav-item {{ Request::is('reports/reports-deals') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('/reports/reports-deals') }}">
                        <i class="fas fa-handshake"></i>
                        <span>All Deals</span>
                    </a>
                </li>
            @endif




            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <!-- End of Sidebar -->


        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small"
                                placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <span class="badge badge-danger badge-counter">3+</span>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Alerts Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary">
                                            <i class="fas fa-file-alt text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 12, 2019</div>
                                        <span class="font-weight-bold">A new monthly report is ready to
                                            download!</span>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-success">
                                            <i class="fas fa-donate text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 7, 2019</div>
                                        $290.29 has been deposited into your account!
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-warning">
                                            <i class="fas fa-exclamation-triangle text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 2, 2019</div>
                                        Spending Alert: We've noticed unusually high spending for your account.
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Show All
                                    Alerts</a>
                            </div>
                        </li>

                        <!-- Nav Item - Messages -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-envelope fa-fw"></i>
                                <!-- Counter - Messages -->
                                <span class="badge badge-danger badge-counter">7</span>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header">
                                    Message Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_1.svg" alt="...">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div class="font-weight-bold">
                                        <div class="text-truncate">Hi there! I am wondering if you can help me with a
                                            problem I've been having.</div>
                                        <div class="small text-gray-500">Emily Fowler · 58m</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_2.svg" alt="...">
                                        <div class="status-indicator"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">I have the photos that you ordered last month, how
                                            would you like them sent to you?</div>
                                        <div class="small text-gray-500">Jae Chun · 1d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_3.svg" alt="...">
                                        <div class="status-indicator bg-warning"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Last month's report looks great, I am very happy
                                            with
                                            the progress so far, keep up the good work!</div>
                                        <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle"
                                            src="https://source.unsplash.com/Mv9hjnEUHR4/60x60" alt="...">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Am I a good boy? The reason I ask is because someone
                                            told me that people say this to all dogs, even if they aren't good...</div>
                                        <div class="small text-gray-500">Chicken the Dog · 2w</div>
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Read More
                                    Messages</a>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span
                                    class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
                                <img class="img-profile rounded-circle"
                                    src="{{ url('') }}/img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal"
                                    data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                @yield('content')
