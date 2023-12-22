<div class="col-12 col-xxl-3 p-0">

    <div class="p-3 h-100 mt-4">
        <div class="d-flex align-items-center mb-4">
            <div class="dropdown">
                <a class=" dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="{{ URL::asset('img/useravatar/' . Auth::guard('school')->user()->avatar) }}"
                        class="rounded-circle wpx-50 hpx-50" alt="" />
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{route('school_route.edit_profile')}}">profile</a></li>
                    <li style="color:#D62829;">
                        <a class="dropdown-item" style="color:#D62829;" href="{{ route('school_route.logout') }}"
                            onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">log out
                        </a>

                        <form id="logout-form" action="{{ route('school_route.logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                    <!-- <li><a class="dropdown-item" href="#"></a></li> -->
                </ul>
            </div>
            <div class="ms-2">
                <h2 class="fs-5 m-0 fw-bold text-capitalize">
                    {{Auth::guard('school')->user()->first_name}}
                    {{Auth::guard('school')->user()->second_name}}
                </h2>
                <span class="fs-8 gray">{{Auth::guard('school')->user()->email}}</span>
            </div>
        </div>

        <div class="col-12 mb-2">
            <div class="d-flex justify-content-center search_all_invoice">
                <div id="datepicker" data-date="12/03/2012"></div>
                <input type="hidden" name="month_year_srch" id="my_hidden_input" />
            </div>
        </div>
        <div class="mt-3">
            <h2 class="fs-5 m-0 fw-bold text-capitalize">
                <span class="pink">Pink</span> tourism
            </h2>
            <p class="fs-7 gray">welcome back and discover the world</p>
            <div class="d-flex position-relative p-3 shadow rate radius-20 mb-2">
                <img class="radius-10" src="images/slide1.png" alt="" />
                <div class="ms-2 mt-2">
                    <div class="float-end rate-image position-absolute me-2 mt-2">
                        <div class="overlay text-center p-1 fs-7 rounded-circle">
                            +7
                        </div>
                        <img class="rounded-circle z-index-1" style="margin-right: -9px" src="images/slide1.png"
                            alt="" />
                        <img class="rounded-circle z-index-2" src="images/slide1.png" alt="" />
                    </div>
                    <h2 class="fs-6 text-capitalize fw-bold">island trips</h2>
                    <p class="fs-8 gray mb-0">

                        Singapore, officially the Republic of Singapore, is a
                        sovereign
                    </p>
                    <i class="fa-solid fa-share-nodes position-absolute me-2"></i>
                </div>
            </div>
            <div class="d-flex position-relative p-3 shadow rate radius-20 mb-2">
                <img class="radius-10" src="images/slide1.png" alt="" />
                <div class="ms-2 mt-2">
                    <div class="float-end rate-image position-absolute me-2 mt-2">
                        <div class="overlay text-center p-1 fs-7 rounded-circle">
                            +7
                        </div>
                        <img class="rounded-circle z-index-1" style="margin-right: -9px" src="images/slide1.png"
                            alt="" />
                        <img class="rounded-circle z-index-2" src="images/slide1.png" alt="" />
                    </div>
                    <h2 class="fs-6 text-capitalize fw-bold">island trips</h2>
                    <p class="fs-8 gray mb-0">
                        Singapore, officially the Republic of Singapore, is a
                        sovereign
                    </p>
                    <i class="fa-solid fa-share-nodes position-absolute me-2"></i>
                </div>
            </div>
            <div class="d-flex position-relative p-3 shadow rate radius-20 mb-2">
                <img class="radius-10" src="images/slide1.png" alt="" />
                <div class="ms-2 mt-2">
                    <div class="float-end rate-image position-absolute me-2 mt-2">
                        <div class="overlay text-center p-1 fs-7 rounded-circle">
                            +7
                        </div>
                        <img class="rounded-circle z-index-1" style="margin-right: -9px" src="images/slide1.png"
                            alt="" />
                        <img class="rounded-circle z-index-2" src="images/slide1.png" alt="" />
                    </div>
                    <h2 class="fs-6 text-capitalize fw-bold">island trips</h2>
                    <p class="fs-8 gray mb-0">
                        Singapore, officially the Republic of Singapore, is a
                        sovereign
                    </p>
                    <i class="fa-solid fa-share-nodes position-absolute me-2"></i>
                </div>
            </div>
        </div>
        <div class="mt-5">
            <h2 class="fs-5 fw-bold text-capitalize m-0">
                last favourits
            </h2>
            <p class="fs-7 gray">welcome back and discover the world</p>
            <div class="position-relative p-3 radius-20 shadow rate-2 mb-2">
                <div class="d-flex flex-wrap flex-md-nowrap">
                    <img class="radius-10" src="images/slide1.png" alt="" />
                    <div class="ms-2 mt-2">
                        <div class="float-end blue  fs-5 rate-image position-absolute me-2 mt-3">
                            $440
                        </div>
                        <h2 class="fs-6 text-capitalize fw-bold">island trips</h2>
                        <p class="fs-8 gray mb-0">
                            Singapore, officially the Republic of Singapore, is a
                            sovereign
                        </p>
                    </div>
                </div>
                <div class="d-flex mt-2 flex-wrap">
                    <p class="ms-2 fs-8 gray m-0">
                        <i class="fa-solid fa-location-arrow me-2 blue"></i>
                        Approx 2 night trip
                    </p>
                    <p class="fs-8 ms-2 gray m-0">
                        <i class="fa-solid fa-user me-2 blue"></i> available for 5
                        persons
                    </p>
                </div>
            </div>
            <div class="position-relative p-3 radius-20 shadow rate-2 mb-2">
                <div class="d-flex flex-wrap flex-md-nowrap">
                    <img class="radius-10" src="images/slide1.png" alt="" />
                    <div class="ms-2 mt-2">
                        <div class="float-end blue  fs-5 rate-image position-absolute me-2 mt-3">
                            $440
                        </div>
                        <h1 class="fs-6 text-capitalize fw-bold">island trips</h1>
                        <p class="fs-8 gray mb-0">
                            Singapore, officially the Republic of Singapore, is a
                            sovereign
                        </p>
                    </div>
                </div>
                <div class="d-flex mt-2 flex-wrap">
                    <p class="ms-2 fs-8 gray m-0">
                        <i class="fa-solid fa-location-arrow me-2 blue"></i>
                        Approx 2 night trip
                    </p>
                    <p class="fs-8 ms-2 gray m-0">
                        <i class="fa-solid fa-user me-2 blue"></i> available for 5
                        persons
                    </p>
                </div>
            </div>
            <div class="position-relative p-3 radius-20 shadow rate-2 mb-2">
                <div class="d-flex flex-wrap flex-md-nowrap">
                    <img class="radius-10" src="images/slide1.png" alt="" />
                    <div class="ms-2 mt-2">
                        <div class="float-end blue  fs-5 rate-image position-absolute me-2 mt-3">
                            $440
                        </div>
                        <h1 class="fs-6 text-capitalize fw-bold">island trips</h1>
                        <p class="fs-8 gray mb-0">
                            Singapore, officially the Republic of Singapore, is a
                            sovereign
                        </p>
                    </div>
                </div>
                <div class="d-flex mt-2 flex-wrap">
                    <p class="ms-2 fs-8 gray m-0">
                        <i class="fa-solid fa-location-arrow me-2 blue"></i>
                        Approx 2 night trip
                    </p>
                    <p class="fs-8 ms-2 gray m-0">
                        <i class="fa-solid fa-user me-2 blue"></i> available for 5
                        persons
                    </p>
                </div>
            </div>
            <div class="position-relative p-3 radius-20 shadow rate-2 mb-2">
                <div class="d-flex flex-wrap flex-md-nowrap">
                    <img class="radius-10" src="images/slide1.png" alt="" />
                    <div class="ms-2 mt-2">
                        <div class="float-end blue  fs-5 rate-image position-absolute me-2 mt-3">
                            $440
                        </div>
                        <h1 class="fs-6 text-capitalize fw-bold">island trips</h1>
                        <p class="fs-8 gray mb-0">
                            Singapore, officially the Republic of Singapore, is a
                            sovereign
                        </p>
                    </div>
                </div>
                <div class="d-flex mt-2 flex-wrap">
                    <p class="ms-2 fs-8 gray m-0">
                        <i class="fa-solid fa-location-arrow me-2 blue"></i>
                        Approx 2 night trip
                    </p>
                    <p class="fs-8 ms-2 gray m-0">
                        <i class="fa-solid fa-user me-2 blue"></i> available for 5
                        persons
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>