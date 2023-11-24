@extends('website.client.client_dashboard')
@section('css')
@endsection
@section('content')
    <div class="row p-3 pt-0">

        <div class="banner-4 radius-20">
            <div class="w-50 float-end pt-3">
                <h2 class="fw-bold ">you want to travel ! use destino with your friend</h2>
                <p class=" fs-8">Lorem Ipsum is simply dummy text of the printing and typesetting
                    industry.
                    Lorem Ipsum has been the industry's standard dummy text </p>
            </div>
        </div>

        <div class=" mt-5 ">
            <ul class="nav nav-pills mb-3 " id="pills-tab" role="tablist">
                <li class="nav-item m-0 text-capitalize " role="presentation">
                    <button class="nav-link active gray me-3 fs-6" id="pills-current-trip-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home"
                        aria-selected="true">current trip</button>
                </li>
                <li class="nav-item m-0 text-capitalize" role="presentation">
                    <button class="nav-link gray fs-6" id="pills-last-trip-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile"
                        aria-selected="false">last trip</button>
                </li>

            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                    aria-labelledby="pills-current-trip-tab" tabindex="0">

                    <div class="d-flex  justify-content-between align-items-center shadow mb-3 p-3 radius-20 flex-wrap">
                        <div class="d-flex align-items-center">
                            <img src="images/slide1.png" class="radius-10 me-3 mb-2" width="90px" height="90px"
                                alt="" />
                            <div class="">
                                <h2 class="fs-7 fw-bold mb-1 text-dark text-capitalize">omar ahmed</h2>
                                {{-- <span class="fs-8 gray">Singapore, officially the </span> --}}
                                <div class="">
                                    <p class="fs-8 gray mb-1 mt-1">
                                        <i class="fa-solid fa-location-arrow me-1 blue"></i> Approx
                                        2 night trip
                                    </p>
                                    <p class="fs-8 gray m-0">
                                        <i class="fa-solid fa-user me-1 blue"></i> check in 15 Sep
                                        2022
                                    </p>
                                </div>
                            </div>

                        </div>


                        <div class="m-1">
                            <p class="fs-8 gray mb-2">
                                <i class="fa-regular fa-calendar me-1 blue"></i> Approx 2
                                night trip
                            </p>
                            <p class="fs-8 gray m-0">
                                <i class="fa-regular fa-calendar me-1 blue"></i> check in 15
                                Sep 2022
                            </p>
                        </div>
                        <div class="m-1">
                            <p class="fs-8 gray mb-2">
                                <i class="fa-solid fa-location-dot me-1 blue"></i>from cairo Egypt
                            </p>
                            <p class="fs-8 gray m-0">
                                <i class="fa-solid fa-location-dot me-1 blue"></i>to paris france
                            </p>
                        </div>
                        <div class="m-1">
                            <p class="fs-5 blue mb-1">$420</p>
                            <p class="fs-8 gray m-0">20/8/2022</p>
                        </div>

                        <div class="m-1">
                            <button class="yellow-btn btn m-1"> cancel</button>
                        </div>

                    </div>
                    <div class="d-flex  justify-content-between align-items-center shadow mb-3 p-3 radius-20 flex-wrap">
                        <div class="d-flex align-items-center">
                            <img src="images/slide1.png" class="radius-10 me-3 mb-2" width="90px" height="90px"
                                alt="" />
                            <div class="">
                                <h2 class="fs-7 fw-bold mb-1 text-dark text-capitalize">omar ahmed</h2>
                                {{-- <span class="fs-8 gray">Singapore, officially the </span> --}}
                                <div class="">
                                    <p class="fs-8 gray mb-1 mt-1">
                                        <i class="fa-solid fa-location-arrow me-1 blue"></i> Approx
                                        2 night trip
                                    </p>
                                    <p class="fs-8 gray m-0">
                                        <i class="fa-solid fa-user me-1 blue"></i> check in 15 Sep
                                        2022
                                    </p>
                                </div>
                            </div>

                        </div>


                        <div class="m-1">
                            <p class="fs-8 gray mb-2">
                                <i class="fa-regular fa-calendar me-1 blue"></i> Approx 2
                                night trip
                            </p>
                            <p class="fs-8 gray m-0">
                                <i class="fa-regular fa-calendar me-1 blue"></i> check in 15
                                Sep 2022
                            </p>
                        </div>
                        <div class="m-1">
                            <p class="fs-8 gray mb-2">
                                <i class="fa-solid fa-location-dot me-1 blue"></i>from cairo Egypt
                            </p>
                            <p class="fs-8 gray m-0">
                                <i class="fa-solid fa-location-dot me-1 blue"></i>to paris france
                            </p>
                        </div>
                        <div class="m-1">
                            <p class="fs-5 blue mb-1">$420</p>
                            <p class="fs-8 gray m-0">20/8/2022</p>
                        </div>

                        <div class="m-1">
                            <button class="yellow-btn btn m-1"> cancel</button>
                        </div>

                    </div>
                </div>
                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-last-trip-tab"
                    tabindex="0">

                    <div class="row">
                        <div
                            class="d-flex  justify-content-between align-items-center shadow mb-3 p-3 radius-20 flex-wrap">
                            <div class="d-flex align-items-center">
                                <img src="images/slide1.png" class="radius-10 me-3 mb-2" width="90px" height="90px"
                                    alt="" />
                                <div class="">
                                    <h2 class="fs-7 fw-bold mb-1 text-dark text-capitalize">omar ahmed</h2>
                                    {{-- <span class="fs-8 gray">Singapore, officially the </span> --}}
                                    <div class="">
                                        <p class="fs-8 gray mb-1 mt-1">
                                            <i class="fa-solid fa-location-arrow me-1 blue"></i> Approx
                                            2 night trip
                                        </p>
                                        <p class="fs-8 gray m-0">
                                            <i class="fa-solid fa-user me-1 blue"></i> check in 15 Sep
                                            2022
                                        </p>
                                    </div>
                                </div>

                            </div>


                            <div class="m-1">
                                <p class="fs-8 gray mb-2">
                                    <i class="fa-regular fa-calendar me-1 blue"></i> Approx 2
                                    night trip
                                </p>
                                <p class="fs-8 gray m-0">
                                    <i class="fa-regular fa-calendar me-1 blue"></i> check in 15
                                    Sep 2022
                                </p>
                            </div>
                            <div class="m-1">
                                <p class="fs-8 gray mb-2">
                                    <i class="fa-solid fa-location-dot me-1 blue"></i>from cairo Egypt
                                </p>
                                <p class="fs-8 gray m-0">
                                    <i class="fa-solid fa-location-dot me-1 blue"></i>to paris france
                                </p>
                            </div>
                            <div class="m-1">
                                <p class="fs-5 blue mb-1">$420</p>
                                <p class="fs-8 gray m-0">20/8/2022</p>
                            </div>

                            <div class="m-1">
                                <button class="yellow-btn btn m-1"> cancel</button>
                            </div>

                        </div>
                        <div
                            class="d-flex  justify-content-between align-items-center shadow mb-3 p-3 radius-20 flex-wrap">
                            <div class="d-flex align-items-center">
                                <img src="images/slide1.png" class="radius-10 me-3 mb-2" width="90px" height="90px"
                                    alt="" />
                                <div class="">
                                    <h2 class="fs-7 fw-bold mb-1 text-dark text-capitalize">omar ahmed</h2>
                                    {{-- <span class="fs-8 gray">Singapore, officially the </span> --}}
                                    <div class="">
                                        <p class="fs-8 gray mb-1 mt-1">
                                            <i class="fa-solid fa-location-arrow me-1 blue"></i> Approx
                                            2 night trip
                                        </p>
                                        <p class="fs-8 gray m-0">
                                            <i class="fa-solid fa-user me-1 blue"></i> check in 15 Sep
                                            2022
                                        </p>
                                    </div>
                                </div>

                            </div>


                            <div class="m-1">
                                <p class="fs-8 gray mb-2">
                                    <i class="fa-regular fa-calendar me-1 blue"></i> Approx 2
                                    night trip
                                </p>
                                <p class="fs-8 gray m-0">
                                    <i class="fa-regular fa-calendar me-1 blue"></i> check in 15
                                    Sep 2022
                                </p>
                            </div>
                            <div class="m-1">
                                <p class="fs-8 gray mb-2">
                                    <i class="fa-solid fa-location-dot me-1 blue"></i>from cairo Egypt
                                </p>
                                <p class="fs-8 gray m-0">
                                    <i class="fa-solid fa-location-dot me-1 blue"></i>to paris france
                                </p>
                            </div>
                            <div class="m-1">
                                <p class="fs-5 blue mb-1">$420</p>
                                <p class="fs-8 gray m-0">20/8/2022</p>
                            </div>

                            <div class="m-1">
                                <button class="yellow-btn btn m-1"> cancel</button>
                            </div>

                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection
@section('js')
@endsection
