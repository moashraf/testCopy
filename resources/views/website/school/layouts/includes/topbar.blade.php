<!-- Topbar -->
<nav class="topbar navbar navbar-expand navbar-light mb-2 static-top">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle me-0 me-md-3">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Topbar Search // to hide the div smaller than small screen -->
    <div class="pagetitle-navbar col-1 col-md-7 d-flex fullsc_topbar_hide">
        <form class="d-none d-md-inline-block form-inline my-2 my-md-0 mw-100 navbar-search">

            <div class="position-relative search_topbar">
                <div class="input-group ">
                    <input id="search-eng_topbar" type="search" placeholder="ابحث عن .." style="height: 40px !important"
                        aria-describedby="button-addon1" class="form-control border-0 bg-transparent ">
                    <div class="input-group-append pe-2 align-self-center">
                        <button id="button-addon1" type="submit" class="btn btn-link text-primary"><i
                                class="fa fa-search text-gray-300"></i></button>
                    </div>
                </div>

                <div id="search-eng-show-list_topbar"
                    class="search-eng-results position-absolute w-100 list-group p-4 bg-white b-r-l-b-cont text-start"
                    style="box-shadow: -1px 1rem 1rem 7px rgb(58 59 69 / 15%) !important; display:none; z-index:9999; left:0px; margin-top: -13px;">
                </div>
            </div>

        </form>
    </div>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ms-auto me-5">

        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
        <li class="nav-item dropdown no-arrow d-sm-none">
            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-bs-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
            </a>
            <!-- Dropdown - Search Messages -->
            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                aria-labelledby="searchDropdown">
                <form class="form-inline me-auto w-100 navbar-search">
                    <div class="input-group">
                        <input id="search-eng_topbar_small" type="text" class="form-control bg-light border-0 small"
                            placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-primary btn-seacrh" type="button">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>

                    <div id="search-eng-show-list_topbar_small"
                        class="search-eng-results list-group p-4 bg-white b-r-l-b-cont text-start"
                        style="box-shadow: -1px 1rem 1rem 7px rgb(58 59 69 / 15%) !important; display:none">
                    </div>
                </form>
            </div>
        </li>

        <!-- full screen -->
        <li class="nav-item dropdown no-arrow mx-1 d-none d-sm-block">
            <a id="full_screen" data-full_screen_tr="max" class="nav-link dropdown-toggle clickable-item-pointer">
                <i class="fas fa-expand fa-fw"></i>
            </a>
        </li>

        <!-- Nav Item - Alerts -->
        <li class="nav-item dropdown no-arrow mx-1 fullsc_topbar_hide">
            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-bs-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <div class="search_bar_icon">
                    <img class="" src="{{ URL::asset('img/icons/ball_not.svg') }}">
                    <!-- Counter - Alerts -->
                    <span class="badge badge-danger badge-counter">3+</span>
                </div>
            </a>
            <!-- Dropdown - Alerts -->
            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">
                    Alerts Center
                </h6>
                <a class="dropdown-item d-flex align-items-center" href="#">
                    <div class="me-3">
                        <div class="icon-circle bg-primary">
                            <i class="fas fa-file-alt text-white"></i>
                        </div>
                    </div>
                    <div>
                        <div class="small">December 12, 2019</div>
                        <span class="fw-bold">A new monthly report is ready to download!</span>
                    </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                    <div class="me-3">
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
                    <div class="me-3">
                        <div class="icon-circle bg-warning">
                            <i class="fas fa-exclamation-triangle text-white"></i>
                        </div>
                    </div>
                    <div>
                        <div class="small text-gray-500">December 2, 2019</div>
                        Spending Alert: We've noticed unusually high spending for your account.
                    </div>
                </a>
                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
            </div>
        </li>

        <!-- Topbar-divider -->
        <div class="topbar-divider d-none d-sm-block fullsc_topbar_hide"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow fullsc_topbar_hide">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <img class="img-profile rounded-circle me-2" width="10px" src="{{ URL::asset('img/icons/users.svg') }}">
                <h6 class="text-xs mb-0">{{ Auth::user()->first_name }}</h6>
            </a>
            <!-- Dropdown - User Information -->

            <div class="dropdown-list-profile dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="userDropdown">
                <div class="dropdown-header bg-primary p-3">
                    <div class="d-flex wd-100p">
                        <div class="main-img-user">
                            <img class="img-profile rounded-circle avatar-m " alt=""
                                src="{{ URL::asset('img/useravatar/' . Auth::user()->avatar) }}" class="">
                        </div>
                        <div class="ms-3 my-auto">
                            <span class="text-blue-300">مدير مدرسة</span>
                            <h6>{{ Auth::user()->first_name }}</h6>
                        </div>
                    </div>
                </div>
                {{-- <a class="dropdown-item" href="{{ route('sett.edit_profile_user') }}">
                    <i class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i>
                    {{ __('basic.my profile') }}
                </a> --}}

                <a class="dropdown-item mb-2 border-bottom-0 " href="{{ route('school_route.logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>
                    تسجيل الخروج
                </a>
                <form id="logout-form" action="{{ route('school_route.logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </li>

    </ul>
</nav>
<!-- End of Topbar -->