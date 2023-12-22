<!DOCTYPE html>
<html lang="en">

<head>
    @include('website.layouts.includes.head')

</head>

<body>

    <div class="loader-page justify-content-center align-items-center text-center">
        <div class="loader-page-cont text-center">
            <img src="{{ URL::asset('img/destino.gif') }}" alt="">
        </div>
    </div>

    <div class="containery">
        <div class="row">

            @include('website.layouts.includes.leftSide')
            <div class="col-12 col-xxl-7 col-md-12 p-4  mt-5 back radius-20">

                <div class="row">
                    <div class="row mb-3 mt-3">
                        <div class="col-12 col-xl-5 pt-2">
                            <h1 class="fs-4 fw-bold mb-1 text-capitalize">Hello,
                                {{Auth::guard('school')->user()->first_name}}
                            </h1>
                            <p class="fs-8 gray">welcome back and discover the world</p>
                        </div>
                        <div class="col-xl-7 d-none d-xl-block">
                            <div class="d-flex w-100 justify-content-between">
                                <div class="search-form shadow position-relative radius-15 w-80 ">
                                    <input type="text" placeholder="search your location"
                                        class="border-0 pe-3 pt-4 pb-4 w-100 radius-15 ">
                                    <i class="fa-solid fa-magnifying-glass position-absolute fs-8 text-xs secandry-light"
                                        style="left: 15px; bottom:27px "></i>
                                    <button class="btn position-absolute Explore-btn p-3 fs-8 "> <a href="#"
                                            class="text-light ">
                                            Explore now</a></button>
                                </div>
                                <button type="button" class="btn-ball radius-10 shadow position-relative">
                                    <i class="fa-regular fa-bell yellow fs-3"></i>
                                    <span
                                        class="position-absolute top-100 start-100 translate-middle badge rounded-pill text-light yellow">
                                        9
                                        <span class="visually-hidden">unread messages</span>
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>

                </div>

                @yield('content')
            </div>
            @include('website.layouts.includes.rightSide')

        </div>
    </div>


    @include('website.layouts.includes.footer-script')

</body>

</html>