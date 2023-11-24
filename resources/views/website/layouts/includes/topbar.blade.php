<header class="text-white pt-2 pb-5 pb-md-4 px-3 px-md-5" style="background-color: #005fbe !important;">

    <div class="mx-md-5 px-md-5">

        <nav class="navbar navbar_main">

            <a href="{{ route('website_homepage') }}">
                <img width="170px" src="{{ URL::asset('img/website/logo/logo_white.png') }}" title="cover">
            </a>

            <div class="d-none d-xl-block">
                <ul class="mx-auto mb-2 mb-lg-0 text-white ps-0">
                    <li>
                        <a class="nav-link active" aria-current="page"
                            href="{{ route('school_route.show_tag', 'visit_egypt') }}">Visit Egypt</a>
                    </li>
                    <li>
                        <a class="nav-link" aria-current="page"
                            href="{{ route('school_route.all_transp') }}">Flights</a>
                    </li>
                    <li>
                        <a class="nav-link" aria-current="page"
                            href="{{ route('school_route.show_tag', 'hajj-and-umrah') }}">Hajj & Umrah</a>
                    </li>
                    <li>
                        <a class="nav-link" aria-current="page" href="#">Visa</a>
                    </li>
                    <li>
                        <a class="nav-link" aria-current="page" href="{{ route('school_route.all_transp') }}">
                            <div class="dropdown no-arrow">
                                <a class="dropdown-toggle text-shadow-200 nav-link" href="#" role="button"
                                    id="dropdownMenuLink" data-bs-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    Domestic
                                </a>
                                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                    aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item"
                                        href="{{ route('school_route.show_destination', 'hurghada') }}">
                                        Hurghada</a>
                                    <a class="dropdown-item"
                                        href="{{ route('school_route.show_destination', 'sharm-el-sheikh') }}">
                                        Sharm El-sheikh</a>
                                    <a class="dropdown-item"
                                        href="{{ route('school_route.show_destination', 'dahab') }}">
                                        Dahab</a>
                                    <a class="dropdown-item"
                                        href="{{ route('school_route.show_destination', 'marsa-alam') }}">
                                        Mara Alam</a>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" aria-current="page"
                            href="{{ route('school_route.articles') }}">Inspiration</a>
                    </li>
                </ul>
            </div>

            <div class="d-none d-xl-block">
                <div class="d-flex align-items-center">

                    <span class="nav-link text-white me-3 clickable-item-pointer show_smal_cart_id"
                        data-bs-toggle="offcanvas" data-bs-target="#offcanvas_small_cart"
                        aria-controls="offcanvas_small_cart" aria-current="page"><i
                            class="fa-solid fa-basket-shopping fs-6"></i></span>

                    @auth('school')
                    <!-- Nav Item - User Information -->
                    <div class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle d-flex" href="#" id="userDropdown" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="img-profile rounded-circle avatar-small2"
                                src="{{ URL::asset('img/useravatar/' . Auth::guard('school')->user()->avatar) }}">
                            <div class="ms-2 my-auto">
                                <span class="text-blue-300 mb-0">Welcome</span>
                                <h6 class="text-white fw-bold mb-0 text-capitalize">{{
                                    Auth::guard('school')->user()->first_name }}</h6>
                            </div>
                        </a>
                        <!-- Dropdown - User Information -->

                        <div class="dropdown-list-profile dropdown-list-profile-website border-0 dropdown-menu dropdown-menu-right shadow animated--grow-in py-0"
                            aria-labelledby="userDropdown" style="width: min-content;">
                            <div class="dropdown-header bg-primary p-3 px-3"
                                style="background-color: #0670D4 !important; ">
                                <div class="d-flex wd-100p">
                                    <div class="main-img-user">
                                        <img class="img-profile rounded-circle avatar-m" alt=""
                                            src="{{ URL::asset('img/useravatar/' . Auth::guard('school')->user()->avatar) }}"
                                            class="">
                                    </div>
                                    <div class="ms-3 my-auto">
                                        <h6 class="text-white fw-normal fw-bold mb-0">
                                            {{ Auth::guard('school')->user()->first_name }}
                                        </h6>
                                        <span class="" style="color: #95bfe6 !important;">Traveler</span>
                                    </div>
                                </div>
                            </div>
                            <a class="dropdown-item" href="{{ route('school_route.dashboard') }}">
                                <i class="fas fa-cogs fa-sm fa-fw me-2 text-gray-400"></i>
                                My Profile
                            </a>
                            <a class="dropdown-item" href="{{ route('school_route.my_requests') }}">
                                <i class="fa-solid fa-paper-plane fa-sm fa-fw me-2 text-gray-400"></i>
                                My Requests
                            </a>
                            <a class="dropdown-item" href="{{ route('school_route.my_bookings') }}">
                                <i class="bi bi-calendar-week-fill fa-sm fa-fw me-2 text-gray-400"></i>
                                My Bookings
                            </a>
                            <a class="dropdown-item mb-2 border-bottom-0 " href="{{ route('school_route.logout') }}"
                                onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('school_route.logout') }}" method="POST"
                                class="d-none">
                                @csrf
                            </form>
                        </div>
                    </div>
                    @endauth

                    @guest('school')
                    <a href="{{ route('school_route.register', 'register') }}" class="text-white">
                        <div class="blue_200_btn border_radius_20 fw-normal text-s mb-0 text-white"> Become A traveler
                            <i class="fa-solid fa-user ms-1"></i>
                        </div>
                    </a>
                    @endguest

                </div>
            </div>

            <div class="d-flex d-xl-none align-items-center">
                <a class="nav-link text-white me-3 clickable-item-pointer show_smal_cart_id" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvas_small_cart" aria-controls="offcanvas_small_cart" aria-current="page"><i
                        class="fa-solid fa-basket-shopping fs-5 pt-2"></i></a>

                <div class="text-white d-flex px-2 py-2" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
                    <i class="fa-solid fa-bars-staggered"></i>
                </div>
            </div>

        </nav>
    </div>


</header>