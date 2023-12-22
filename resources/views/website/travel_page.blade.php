@extends('website.layouts.master')
@section('css')
    <style>
        .form-select ::data-placeholder {
            color: #ffa200;
        }

        input[type="date"]::before {
            color: #999999;
            content: attr(placeholder);
        }

        input[type="date"],
        input[type="date"]:focus,
        input[type="date"]:hover {
            color: #ffffff;
        }

        input[type="date"]:focus,
        input[type="date"]:valid {
            color: #1a093e;
        }

        input[type="date"]:focus::before,
        input[type="date"]:valid::before {
            content: "" !important;
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid travel-details">
        <div class="containery">
            <!-- navbar  -->
            <header>
                @include('website.layouts.includes.topbar')
                <!-- hero section  -->
                <section class="row pt-5 mb-5">
                    <div class="col-12 col-lg-6 ">

                            
                    
                        <div class="swiper mySwiper2 travel">
                            <div class="swiper-wrapper">
                                @foreach ($unit as $item)
                                    <div class="swiper-slide">
                                        <img src="{{ URL::asset('img/products/' . $item->unit_images) }}" class="radius-10" />
                                    </div>
                                @endforeach
                                
                            </div>
                        </div>
                               
                        <div thumbsSlider="" class="swiper mySwiper travel-detail">
                            <div class="swiper-wrapper">
                                @foreach ($unit as $item)
                                    <div class="swiper-slide">
                                        <img src="{{ URL::asset('img/products/' . $item->unit_images) }}" class="radius-10" />
                                    </div>
                               @endforeach
                            </div>
                        </div>
                        
                    </div>
                    <div class="col-12 col-lg-6 ">
                     @foreach ($units as $item)
                        <h2 class="fw-bold mb-4  fs-1 text-capitalize">
                            {{$item->name}}
                            <span class="color-title fw-500 fs-3 ms-1">Package</span>
                        </h2>
                        
                        <p class="mb-4">
                            {!! $item->description !!}

                        </p>
                        <h3 class="fw-600 color-title fs-1 mb-4">
                            $420 <s class="secandry-light fs-4 fw-lighter">$450</s>
                        </h3>
                        <p class="fw-600 mb-4">
                            Good
                            <span class="yellow">
                                <i class="fa-solid fa-star fs-8 yellow"></i>
                                <i class="fa-solid fa-star fs-8 yellow"></i>
                                <i class="fa-solid fa-star fs-8 yellow"></i>
                            </span>
                            <i class="fa-solid fa-star fs-8 secandry-light"></i><i
                                class="fa-solid fa-star fs-8 secandry-light"></i>
                            <span class="secandry-light fw-500"> (130 review)</span>
                        </p>
                        @endforeach
                        <div class="d-flex">
                            <p class="secandry-light">
                                <i class="fa-solid fa-user blue"></i> available for 5 persons
                            </p>
                            <p class="secandry-light">
                                <i class="fa-solid fa-location-arrow blue ms-3"></i> Approx 2
                                night trip
                            </p>
                        </div>
                        <p class="secandry-light">
                            <i class="fa-solid fa-location-dot blue"></i> El Salam Road Nabq
                            Bay, 46610 Sharm El Sheikh, Egypt
                        </p>
                        <div class="mt-3">
                            <button class="btn text-capitalize me-1 mb-1" data-bs-toggle="modal" href="#exampleModalToggle"
                                role="button" style="padding: 1rem 1.5rem">
                                <i class="fa-solid fa-location-arrow  fs-5"></i>
                                Book now
                            </button>


                            <button class="btn yellow-btn text-capitalize me-1 mb-1" style="padding: 1rem 1.5rem">
                                <i class="fa-solid fa-heart"></i>
                                add to favourite
                            </button>
                            <button class="btn share mb-1">
                                <i class="fa-solid fa-share-nodes fs-4"></i>
                            </button>
                            <div class="modal fade" id="exampleModalToggle" aria-hidden="true"
                                aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content p-4 radius-20" style="background-color: #FCFCFC">
                                        <div class="modal-header">
                                            <div class="modal-title" id="exampleModalToggleLabel">
                                                <h2 class="fw-bold text-capitalize">booking details</h2>
                                                <p class="text-secondary m-0">
                                                    welcome back and discover the world
                                                </p>
                                            </div>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body row">
                                            <div class="card d-flex flex-row p-3 mb-3">
                                                <img src="images/sharm.png" class="col-12 p-0 radius-20" alt=""
                                                    style="width: 100px;height: 120px;">
                                                <div class="d-flex flex-column justify-content-center  ms-3">
                                                    <h2 class="fs-6 fw-600 mb-1 text-capitalize">
                                                        iceland trip
                                                    </h2>
                                                    <p class="text-secondary fs-7 mb-1">
                                                        Lorem exercitationem praesentium, voluptates
                                                        voluptatum eos pariatur ipsa suscipit error,
                                                    </p>
                                                    <div class="d-flex flex-wrap">
                                                        <p class="fs-8 secandry-light me-2 m-0">
                                                            <i class="fa-solid fa-location-arrow color-i"></i>
                                                            Approx 2 night trip
                                                        </p>
                                                        <p class="fs-8 secandry-light m-0">
                                                            <i class="fa-solid fa-user color-i"></i>
                                                            available for 5 people
                                                        </p>
                                                    </div>
                                                </div>
                                                <h3 class="fw-500 fs-5 color-title m-0 ms-2">$420</h3>
                                            </div>
                                            <div class="d-flex p-0">
                                                <select class="form-select shadow radius-10 btn-drop mb-3 w-75 me-1"
                                                    id="single-select-field" data-placeholder="Choose one thing">
                                                    <option>select rooms</option>
                                                    <option>Reactive</option>
                                                    <option>Solution</option>
                                                    <option>Conglomeration</option>
                                                    <option>Algoritm</option>
                                                    <option>Holistic</option>
                                                </select>
                                                <select class="form-select shadow radius-10 btn-drop mb-3 w-25 ms-1"
                                                    id="single-select-field" data-placeholder="Choose one thing">
                                                    <option>select beds</option>
                                                    <option>Reactive</option>
                                                    <option>Solution</option>
                                                    <option>Conglomeration</option>
                                                    <option>Algoritm</option>
                                                    <option>Holistic</option>
                                                </select>
                                            </div>
                                            <div class="justify-content-center d-flex flex-column align-items-center p-0">
                                                <input type="date" placeholder="checkin date"
                                                    class="shadow radius-10 btn-drop w-100 mb-3" required />
                                                <input type="date" placeholder="checkout date"
                                                    class="shadow radius-10 btn-drop w-100 mb-3" required />
                                                <select class="form-select shadow radius-10 btn-drop mb-3"
                                                    id="single-select-field-payment">
                                                    <option value="payment method">payment method</option>
                                                    <option value="visa">
                                                        visa
                                                    </option>
                                                    <option value="master">master</option>
                                                    <option>Conglomeration</option>
                                                    <option>Algoritm</option>
                                                    <option>Holistic</option>
                                                </select>
                                                <form class="w-100 position-relative" id="pay-visa">
                                                    <input type="text" placeholder="Visa number"
                                                        class="shadow radius-10 btn-drop w-100 mb-3" required />
                                                    <i class="fa-regular fa-credit-card position-absolute fs-8"
                                                        style="top: 1.5rem; right: 0.8rem"></i>
                                                    <div class="d-flex">
                                                        <input type="text" placeholder="Expire date"
                                                            class="shadow radius-10 btn-drop mb-3 w-75 me-1" required />
                                                        <input type="text" placeholder="cvv"
                                                            class="shadow radius-10 btn-drop w-25 mb-3 ms-1" required />
                                                    </div>
                                                </form>
                                                <form class="w-100 position-relative" id="pay-master">
                                                    <input type="text" placeholder="Master Card number"
                                                        class="shadow radius-10 btn-drop w-100 mb-3" required />
                                                    <i class="fa-regular fa-credit-card position-absolute fs-8"
                                                        style="top: 1.5rem; right: 0.8rem"></i>
                                                    <div class="d-flex">
                                                        <input type="text" placeholder="Expire date"
                                                            class="shadow radius-10 btn-drop mb-3 w-75 me-1" required />
                                                        <input type="text" placeholder="cvv"
                                                            class="shadow radius-10 btn-drop w-25 mb-3 ms-1" required />
                                                    </div>
                                                </form>
                                                <button class="btn pt-3 pb-3" id="btn-pay">
                                                    complete payment
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </section>
            </header>
        </div>
    </div>
    <div class="containery">
        <section class="row mb-5">
            <h2 class="fw-bold mb-4 text-capitalize">about Club by Jaz Sharm.</h2>
            <p>
                Located in Sharm El Sheikh, a 2-minute walk from Nabq Bay Beach,
                Magic World Sharm - Club by Jaz has accommodations with a
                restaurant, free private parking, an outdoor swimming pool and a
                fitness center. With a bar, the property also has a shared lounge,
                as well as a garden. There's a sauna, evening entertainment and a
                24-hour front desk. The rooms at the resort come with a seating
                area, a flat-screen TV with cable channels and a safety deposit box.
                All rooms will provide guests with a closet and an electric tea pot.
                A buffet breakfast is available each morning at Magic World Sharm -
                Club by Jaz. The accommodation has a playground. You can play ping
                pong, darts and tennis at Magic World Sharm - Club by Jaz, and car
                rental is available. Popular points of interest near the resort
                include Nubian Beach, Rehana Royal Beach and La Strada Mall. The
                nearest airport is Sharm el-Sheikh International Airport, 11.3 km
                from Magic World Sharm - Club by Jaz. Couples in particular like the
                location – they rated it 8.9 for a two-person trip. Magic World
                Sharm - Club by Jaz has been welcoming Booking.com guests since May
                1, 2018 Distance in property description is calculated using ©
                OpenStreetMap
            </p>
            <div class="row mb-4 mt-5">
                <div class="swiper mySwiper tourist radius-20">
                    <div class="swiper-wrapper radius-20">
                        <div class="swiper-slide">
                            <img src="images/sharm.png" alt="" class="w-100" />
                        </div>
                        <div class="swiper-slide">
                            <img src="images/sharm.png" alt="" class="w-100" />
                        </div>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </section>
        <section class="row mb-5">
            <h2 class="fw-bold mb-1 text-capitalize text-center">
                5 reasons to choose Magic World Sharm - Club by Jaz
            </h2>
            <p class="text-center">
                Located in Sharm El Sheikh, a 2-minute walk from Nabq Bay Beach,
                Magic World Sharm - Club by Jaz
            </p>
            <div class="d-flex align-items-center mt-4 col-20 col-12 col-md-6">
                <i class="fa-solid fa-wallet fs-2 bg-yellow yellow p-3 radius-10"></i>
                <i class=""></i>
                <p class="light fs-6 ms-4 m-0">Prices you can't beat!</p>
            </div>
            <div class="d-flex align-items-center mt-4 col-20 col-12 col-md-6">
                <i class="fa-solid fa-lock fs-2 bg-yellow yellow p-3 radius-10"></i>
                <p class="light fs-6 ms-4 m-0">Booking is safe</p>
            </div>
            <div class="d-flex align-items-center mt-4 col-20 col-12 col-md-6">
                <i class="fa-solid fa-laptop fs-2 bg-yellow yellow p-3 radius-10"></i>
                <p class="light fs-6 ms-4 m-0">Manage your bookings online</p>
            </div>
            <div class="d-flex align-items-center mt-4 col-20 col-12 col-md-6">
                <i class="fa-solid fa-headset fs-2 bg-yellow yellow p-3 radius-10"></i>
                <p class="light fs-6 ms-4 m-0">The staff speaks English</p>
            </div>
            <div class="d-flex align-items-center mt-4 col-20 col-12 col-md-6">
                <i class="fa-solid fa-headset fs-2 bg-yellow yellow p-3 radius-10"></i>
                <p class="light fs-6 ms-4 m-0">Great location and facilities</p>
            </div>
        </section>
    </div>

    <div class="container-fluid" style="background-color: #F5FDFF;">
        <div class="containery">

            <section class="row mb-6 pt-5">
                <h2 class="fw-bold mb-1 text-capitalize">related places.</h2>
                <p>Located in Sharm El Sheikh, a 2-minute walk from Nabq</p>
                <div class="col-12 col-md-6 col-20">
                    <div class="card-product radius-20 shadow position-relative p-3">
                        <div class="position-absolute icon-product mt-2 ms-2">
                            <i class="fa-solid fa-plane-up"></i>
                            <i class="fa-solid fa-utensils"></i>
                        </div>
                        <img src="images/Mask Group 4.png" alt="" />
                        <div class="d-flex justify-content-between align-items-baseline pt-3">
                            <a href="" class="text-dark">
                                <h2 class="fs-5 fw-600">New york</h2>
                            </a>
                            <p class="fs-8 secandry-light">
                                <i class="fa-solid fa-location-arrow color-i"></i> Approx 2
                                night trip
                            </p>
                        </div>
                        <p class="secandry-light fs-8">
                            Singapore, officially the Republic of Singapore, is a sovereign
                            island city-state .
                        </p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h3 class=" color-title m-0">
                                    $420 <span class="secandry-light fs-6 fw-500">$450</span>
                                </h3>
                                <p class="secandry-light fs-9 m-0">available for 5 persons</p>
                            </div>
                            <button class="btn yellow-btn text-capitalize fs-8 radius-10">
                                Book now
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-20">
                    <div class="card-product radius-20 shadow position-relative p-3">
                        <div class="position-absolute icon-product mt-2 ms-2">
                            <i class="fa-solid fa-plane-up"></i>
                            <i class="fa-solid fa-utensils"></i>
                        </div>
                        <img src="images/Mask Group 4.png" alt="" />
                        <div class="d-flex justify-content-between align-items-baseline pt-3">
                            <a href="" class="text-dark">
                                <h2 class="fs-5 fw-600">New york</h2>
                            </a>
                            <p class="fs-8 secandry-light">
                                <i class="fa-solid fa-location-arrow color-i"></i> Approx 2
                                night trip
                            </p>
                        </div>
                        <p class="secandry-light fs-8">
                            Singapore, officially the Republic of Singapore, is a sovereign
                            island city-state .
                        </p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h3 class=" color-title m-0">
                                    $420 <span class="secandry-light fs-6 fw-500">$450</span>
                                </h3>
                                <p class="secandry-light fs-9 m-0">available for 5 persons</p>
                            </div>
                            <button class="btn yellow-btn text-capitalize fs-8 radius-10">
                                Book now
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-20">
                    <div class="card-product radius-20 shadow position-relative p-3">
                        <div class="position-absolute icon-product mt-2 ms-2">
                            <i class="fa-solid fa-plane-up"></i>
                            <i class="fa-solid fa-utensils"></i>
                        </div>
                        <img src="images/Mask Group 4.png" alt="" />
                        <div class="d-flex justify-content-between align-items-baseline pt-3">
                            <a href="" class="text-dark">
                                <h2 class="fs-5 fw-600">New york</h2>
                            </a>
                            <p class="fs-8 secandry-light">
                                <i class="fa-solid fa-location-arrow color-i"></i> Approx 2
                                night trip
                            </p>
                        </div>
                        <p class="secandry-light fs-8">
                            Singapore, officially the Republic of Singapore, is a sovereign
                            island city-state .
                        </p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h3 class=" color-title m-0">
                                    $420 <span class="secandry-light fs-6 fw-500">$450</span>
                                </h3>
                                <p class="secandry-light fs-9 m-0">available for 5 persons</p>
                            </div>
                            <button class="btn yellow-btn text-capitalize fs-8 radius-10">
                                Book now
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-20">
                    <div class="card-product radius-20 shadow position-relative p-3">
                        <div class="position-absolute icon-product mt-2 ms-2">
                            <i class="fa-solid fa-plane-up"></i>
                            <i class="fa-solid fa-utensils"></i>
                        </div>
                        <img src="images/Mask Group 4.png" alt="" />
                        <div class="d-flex justify-content-between align-items-baseline pt-3">
                            <a href="" class="text-dark">
                                <h2 class="fs-5 fw-600">New york</h2>
                            </a>
                            <p class="fs-8 secandry-light">
                                <i class="fa-solid fa-location-arrow color-i"></i> Approx 2
                                night trip
                            </p>
                        </div>
                        <p class="secandry-light fs-8">
                            Singapore, officially the Republic of Singapore, is a sovereign
                            island city-state .
                        </p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h3 class=" color-title m-0">
                                    $420 <span class="secandry-light fs-6 fw-500">$450</span>
                                </h3>
                                <p class="secandry-light fs-9 m-0">available for 5 persons</p>
                            </div>
                            <button class="btn yellow-btn text-capitalize fs-8 radius-10">
                                Book now
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-20">
                    <div class="card-product radius-20 shadow position-relative p-3">
                        <div class="position-absolute icon-product mt-2 ms-2">
                            <i class="fa-solid fa-plane-up"></i>
                            <i class="fa-solid fa-utensils"></i>
                        </div>
                        <img src="images/Mask Group 4.png" alt="" />
                        <div class="d-flex justify-content-between align-items-baseline pt-3">
                            <a href="" class="text-dark">
                                <h2 class="fs-5 fw-600">New york</h2>
                            </a>
                            <p class="fs-8 secandry-light">
                                <i class="fa-solid fa-location-arrow color-i"></i> Approx 2
                                night trip
                            </p>
                        </div>
                        <p class="secandry-light fs-8">
                            Singapore, officially the Republic of Singapore, is a sovereign
                            island city-state .
                        </p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h3 class=" color-title m-0">
                                    $420 <span class="secandry-light fs-6 fw-500">$450</span>
                                </h3>
                                <p class="secandry-light fs-9 m-0">available for 5 persons</p>
                            </div>
                            <button class="btn yellow-btn text-capitalize fs-8 radius-10">
                                Book now
                            </button>
                        </div>
                    </div>
                </div>
            </section>
            <section class="mb-6 justify-content-between align-items-center">
                <div>
                    <button class="btn see ms-3" style="height: fit-content;  float: right">
                        see all
                    </button>
                    <h2 class="fw-bold mb-1 text-capitalize">our clients opinions.</h2>
                    <p>
                        Located in Sharm El Sheikh, a 2-minute walk from Nabq Bay Beach,
                    </p>
                </div>
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="card-review radius-20 shadow p-4 mb-4">
                            <div class="d-flex justify-content-between align-items-center flex-wrap">
                                <div class="d-flex align-items-center">
                                    <img src="images/pexels-3586798.png" class="rounded-circle" alt="" style="height: 3.5rem">
                                    <div class="ms-3">
                                        <h6 class="m-0 fs-7 fw-600 text-secondary">Mike taylor</h6>
                                        <p class="fs-8 m-0">Lahore, Pakistan</p>
                                    </div>
                                </div>
                                <p class="fs-8 fw-600 mb-0 ms-2 mt-2">
                                    Good
                                    <span class="yellow">
                                        <i class="fa-solid fa-star fs-8 yellow"></i>
                                        <i class="fa-solid fa-star fs-8 yellow"></i>
                                        <i class="fa-solid fa-star fs-8 yellow"></i>
                                    </span>
                                    <i class="fa-solid fa-star fs-8 secandry-light"></i><i class="fa-solid fa-star fs-8 secandry-light"></i>
                                </p>
                            </div>
                            <p class="fs-8 mt-2 mb-0">
                                On the Windows talking painted pasture yet its express parties
                                use. Sure last upon he same as knew next. Of believed or
                                diverted no. “On the Windows talking painted p Sure last upon
                                he same as knew next.”
                            </p>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="card-review radius-20 shadow p-4 mb-4">
                            <div class="d-flex justify-content-between align-items-center flex-wrap">
                                <div class="d-flex align-items-center">
                                    <img src="images/pexels-3586798.png" class="rounded-circle" alt="" style="height: 3.5rem">
                                    <div class="ms-3">
                                        <h6 class="m-0 fs-7 fw-600 text-secondary">Mike taylor</h6>
                                        <p class="fs-8 m-0">Lahore, Pakistan</p>
                                    </div>
                                </div>
                                <p class="fs-8 fw-600 mb-0 ms-2 mt-2">
                                    Good
                                    <span class="yellow">
                                        <i class="fa-solid fa-star fs-8 yellow"></i>
                                        <i class="fa-solid fa-star fs-8 yellow"></i>
                                        <i class="fa-solid fa-star fs-8 yellow"></i>
                                    </span>
                                    <i class="fa-solid fa-star fs-8 secandry-light"></i><i class="fa-solid fa-star fs-8 secandry-light"></i>
                                </p>
                            </div>
                            <p class="fs-8 mt-2 mb-0">
                                On the Windows talking painted pasture yet its express parties
                                use. Sure last upon he same as knew next. Of believed or
                                diverted no. “On the Windows talking painted p Sure last upon
                                he same as knew next.”
                            </p>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="card-review radius-20 shadow p-4 mb-4">
                            <div class="d-flex justify-content-between align-items-center flex-wrap">
                                <div class="d-flex align-items-center">
                                    <img src="images/pexels-3586798.png" class="rounded-circle" alt="" style="height: 3.5rem">
                                    <div class="ms-3">
                                        <h6 class="m-0 fs-7 fw-600 text-secondary">Mike taylor</h6>
                                        <p class="fs-8 m-0">Lahore, Pakistan</p>
                                    </div>
                                </div>
                                <p class="fs-8 fw-600 mb-0 ms-2 mt-2">
                                    Good
                                    <span class="yellow">
                                        <i class="fa-solid fa-star fs-8 yellow"></i>
                                        <i class="fa-solid fa-star fs-8 yellow"></i>
                                        <i class="fa-solid fa-star fs-8 yellow"></i>
                                    </span>
                                    <i class="fa-solid fa-star fs-8 secandry-light"></i><i class="fa-solid fa-star fs-8 secandry-light"></i>
                                </p>
                            </div>
                            <p class="fs-8 mt-2 mb-0">
                                On the Windows talking painted pasture yet its express parties
                                use. Sure last upon he same as knew next. Of believed or
                                diverted no. “On the Windows talking painted p Sure last upon
                                he same as knew next.”
                            </p>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="card-review radius-20 shadow p-4 mb-4">
                            <div class="d-flex justify-content-between align-items-center flex-wrap">
                                <div class="d-flex align-items-center">
                                    <img src="images/pexels-3586798.png" class="rounded-circle" alt="" style="height: 3.5rem">
                                    <div class="ms-3">
                                        <h6 class="m-0 fs-7 fw-600 text-secondary">Mike taylor</h6>
                                        <p class="fs-8 m-0">Lahore, Pakistan</p>
                                    </div>
                                </div>
                                <p class="fs-8 fw-600 mb-0 ms-2 mt-2">
                                    Good
                                    <span class="yellow">
                                        <i class="fa-solid fa-star fs-8 yellow"></i>
                                        <i class="fa-solid fa-star fs-8 yellow"></i>
                                        <i class="fa-solid fa-star fs-8 yellow"></i>
                                    </span>
                                    <i class="fa-solid fa-star fs-8 secandry-light"></i><i class="fa-solid fa-star fs-8 secandry-light"></i>
                                </p>
                            </div>
                            <p class="fs-8 mt-2 mb-0">
                                On the Windows talking painted pasture yet its express parties
                                use. Sure last upon he same as knew next. Of believed or
                                diverted no. “On the Windows talking painted p Sure last upon
                                he same as knew next.”
                            </p>
                        </div>
                    </div>
                </div>
            </section>
            <section class="row mb-6 p-5 blue-bg text-light radius-20 contact">
                <form id="contactForm ">
                    <div class="col-12 col-md-6">
                        <h2 class="fw-bold">Contact Us</h2>
                        <p>
                            On the Windows talking painted pasture yet its express parties
                            use. Sure last upon he same as knew next. Of believed or
                        </p>
                    </div>

                    <!-- Name input -->
                    <div class="mb-3 d-flex row">
                        <div class="col-12 col-md-4">
                            <input class="form-control contact p-3 mt-3 fw-300 text-light" id="name" type="text"
                                placeholder="Name" data-sb-validations="required" />
                        </div>
                        <div class="col-12 col-md-4">
                            <input class="form-control contact p-3 mt-3 fw-300 col-md-4 col-12 text-light"
                                id="emailAddress" type="email" placeholder="Email Address"
                                data-sb-validations="required, email" />
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="input-group">
                                <select class="form-select contact p-3 mt-3 fw-300 text-light" id="inputGroupSelect01">
                                    <option selected>Service</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- Message input -->

                    <div class="mb-3 text-center">
                        <textarea class="form-control contact p-2 fw-300 text-light" id="message" type="text" placeholder="Message"
                            style="height: 10rem" data-sb-validations="required"></textarea>
                        <button class="btn btn-lg btn-send text-center mt-3 fs-6 text-light" type="submit">
                            send
                        </button>
                    </div>
                    <!-- Form submit button -->
                </form>
            </section>
        </div>
    </div>
@endsection
@section('js')
    <script>
        const select = document.getElementById("single-select-field-payment");
        let visa = document.getElementById("pay-visa");
        let master = document.getElementById("pay-master");

        let button = document.getElementById("btn-pay");
        select.addEventListener("change", function handleChange(event) {
            if (select.options[select.selectedIndex].text === "visa") {
                console.log("true");
                visa.style.display = "block";
                master.style.display = "none";
                button.innerText = "Book now";
            } else if (select.options[select.selectedIndex].text === "master") {
                master.style.display = "block";
                visa.style.display = "none";

                button.innerText = "Book now";
            } else {
                visa.style.display = "none";
                master.style.display = "none";
            }
        });
        var bswiper = new Swiper(".tourist", {
            loop: true,
            freeMode: true,
            spaceBetween: 20,
            grabCursor: true,
            slidesPerView: 7,
            touchEventsTarget: "container",
            loop: true,
            loopFillGroupWithBlank: true,
            loop: true,
            freeMode: true,
            speed: 5000,
            freeModeMomentum: false,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
                dynamicBullets: true,
            },
            breakpoints: {
                300: {
                    slidesPerView: 1,
                    spaceBetween: 30,
                },
                500: {
                    slidesPerView: 1,
                    spaceBetween: 40,
                },
                640: {
                    slidesPerView: 1,
                    spaceBetween: 40,
                },
                750: {
                    slidesPerView: 1,
                    spaceBetween: 40,
                },
                1024: {
                    slidesPerView: 1,
                    spaceBetween: 40,
                },
                1424: {
                    slidesPerView: 1,
                    spaceBetween: 30,
                },
            },
        });
        var swiper = new Swiper(".travel-detail", {
            loop: true,
            spaceBetween: 10,
            slidesPerView: 4,
            freeMode: true,
            watchSlidesProgress: true,
        });
        var swiper2 = new Swiper(".mySwiper2", {
            loop: true,
            spaceBetween: 10,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            thumbs: {
                swiper: swiper,
            },
        });
    </script>
@endsection
