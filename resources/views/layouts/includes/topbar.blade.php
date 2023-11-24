<!-- Topbar -->
<nav class="topbar navbar navbar-expand navbar-light mb-2 static-top">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle me-0 me-md-3">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Topbar Search // to hide the div smaller than small screen -->
    <div class="pagetitle-navbar col-1 col-md-7 d-flex fullsc_topbar_hide">
        <span class="text-gray-600 d-none d-md-block text-truncate">@yield('title-topbar', 'Tripo') </span>
        <form
            class="d-none d-md-inline-block form-inline me-auto ms-md-3 my-2 my-md-0 mw-100 ms-4 ms-lg-3 navbar-search">

            <div class="p-1 bg-white rounded rounded-pill shadow-lgg position-relative">
                <div class="input-group">
                    <input id="search-eng_topbar" type="search" placeholder="{{ __('basic.topbar search msg') }}"
                        aria-describedby="button-addon1" class="form-control border-0 bg-transparent">
                    <div class="input-group-append pe-2">
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
    <ul class="navbar-nav ms-auto">

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
                <img class="me-1"
                    src="{{ URL::asset('img/dashboard/country_flags/' . LaravelLocalization::getCurrentLocaleIcon()) }}">

                {{-- src="{{ URL::asset('img/dashboard/country_flags/' . LaravelLocalization::getCurrentLocale()) }}">
                --}}

                {{ LaravelLocalization::getCurrentLocale() }}
            </a>
            <!-- Dropdown - Alerts -->
            <ul class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in main-color-bg px-2 py-2"
                aria-labelledby="alertsDropdown" style="width: auto !important;">
                @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                <li class="p-1">
                    <a class="text-white" rel="alternate" hreflang="{{ $localeCode }}"
                        href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"><img
                            src="{{ URL::asset('img/dashboard/country_flags/' . $properties['icon']) }}">
                        {{ $properties['native'] }}
                    </a>
                </li>
                @endforeach
            </ul>
        </li>

        <!-- Nav Item - Alerts -->
        <li class="nav-item dropdown no-arrow mx-1 fullsc_topbar_hide">
            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-bs-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
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

        <!-- Nav Item - Messages -->
        <li class="nav-item dropdown no-arrow mx-1 fullsc_topbar_hide">
            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-bs-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
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
                    <div class="dropdown-list-image me-3">
                        <img class="rounded-circle" src="{{ URL::asset('img/useravatar/Amr1635915748.jpeg') }}" alt="">
                        <div class="status-indicator bg-success"></div>
                    </div>
                    <div class="font-weight-bold">
                        <div class="text-truncate">Hi there! I am wondering if you can help me with a
                            problem I've been having.</div>
                        <div class="small text-gray-500">Emily Fowler · 58m</div>
                    </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                    <div class="dropdown-list-image me-3">
                        <img class="rounded-circle" src="{{ URL::asset('img/useravatar/Amr1635915748.jpeg') }}" alt="">
                        <div class="status-indicator"></div>
                    </div>
                    <div>
                        <div class="text-truncate">I have the photos that you ordered last month, how
                            would you like them sent to you?</div>
                        <div class="small text-gray-500">Jae Chun · 1d</div>
                    </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                    <div class="dropdown-list-image me-3">
                        <img class="rounded-circle" src="{{ URL::asset('img/useravatar/Amr1635915748.jpeg') }}" alt="">
                        <div class="status-indicator bg-warning"></div>
                    </div>
                    <div>
                        <div class="text-truncate">Last month's report looks great, I am very happy with
                            the progress so far, keep up the good work!</div>
                        <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                    </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                    <div class="dropdown-list-image me-3">
                        <img class="rounded-circle" src="" alt="">
                        <div class="status-indicator bg-success"></div>
                    </div>
                    <div>
                        <div class="text-truncate">Am I a good boy? The reason I ask is because someone
                            told me that people say this to all dogs, even if they aren't good...</div>
                        <div class="small text-gray-500">Chicken the Dog · 2w</div>
                    </div>
                </a>
                <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
            </div>
        </li>

        <!-- Topbar-divider -->
        <div class="topbar-divider d-none d-sm-block fullsc_topbar_hide"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow fullsc_topbar_hide">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <img class="img-profile rounded-circle"
                    src="{{ URL::asset('img/useravatar/' . Auth::user()->avatar) }}">
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
                            <h6>{{ Auth::user()->first_name . ' ' . Auth::user()->second_name }}</h6>
                            <span class="text-blue-300">{{ Auth::user()->roles->pluck('name')[0] }}</span>
                        </div>
                    </div>
                </div>
                <a class="dropdown-item" href="{{ route('sett.edit_profile_user') }}">
                    <i class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i>
                    {{ __('basic.my profile') }}
                </a>

                <a class="dropdown-item mb-2 border-bottom-0 " href="{{ route('sett.logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>
                    {{ __('basic.logout') }}
                </a>
                <form id="logout-form" action="{{ route('sett.logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </li>

    </ul>
</nav>
<!-- End of Topbar -->