@extends('website.layouts.master')
@section('css')
@endsection
@section('content')
<div class="container-fluid service">
    <div class="containery">
        <!-- navbar  -->
        <header>
            @include('website.layouts.includes.topbar')
            <!-- hero section  -->
            <section class="row mb-5 card">
                <h2 class="mb-2 text-capitalize ">Cairo, Egypt - Dubai, United Arab Emirates (Round Trip).</h2>
                <p class="fs-4 fw-light ">Located in Sharm El Sheikh, a 2-minute walk from Nabq Bay</p>
                <div class="swiper mySwiper hotel ">
                    <div class="swiper-wrapper">
                        <div
                            class="swiper-slide d-flex  align-items-center justify-content-center radius-50 border pt-3 pb-3 ps-2 pe-2">
                            <img src="images/mariot.png" alt="">
                            <div class="name">
                                <p class="fs-8 m-0 mb-1 ms-2 baby-blue">Marriot hotels</p>
                                <p class="fs-9 m-0 ms-2">150 a trip results</p>
                            </div>
                        </div>
                        <div
                            class="swiper-slide d-flex  align-items-center justify-content-center radius-50 border pt-3 pb-3 ps-2 pe-2">
                            <img src="images/4season.png" alt="">
                            <div class="name">
                                <p class="fs-8 m-0 mb-1 ms-2 baby-blue">Marriot hotels</p>
                                <p class="fs-9 m-0 ms-2">150 a trip results</p>
                            </div>
                        </div>
                        <div
                            class="swiper-slide d-flex  align-items-center justify-content-center radius-50 border pt-3 pb-3 ps-2 pe-2">
                            <img src="images/4season.png" alt="">
                            <div class="name">
                                <p class="fs-8 m-0 mb-1 ms-2 baby-blue">Marriot hotels</p>
                                <p class="fs-9 m-0 ms-2">150 a trip results</p>
                            </div>
                        </div>
                        <div
                            class="swiper-slide d-flex  align-items-center justify-content-center radius-50 border pt-3 pb-3 ps-2 pe-2">
                            <img src="images/hilton.png" alt="">
                            <div class="name">
                                <p class="fs-8 m-0 mb-1 ms-2 baby-blue">Marriot hotels</p>
                                <p class="fs-9 m-0 ms-2">150 a trip results</p>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="swiper-pagination "></div>
            </section>

        </header>

        <section class="row mt-5 mb-5">
            <div class="col-12 col-xl-4 col-xxl-3 position-relative p-0">
                <div class="filter-offcanvas" data-bs-toggle="offcanvas" data-bs-target="#offcanvasTop"
                    aria-controls="offcanvasTop">
                    <input type="text" placeholder="filter"
                        class="shadow position-relative radius-10 btn-drop w-100 mb-3">
                    <i class="fa-solid fa-arrow-down-wide-short position-absolute fs-6 text-secondary"
                        style="top: 1.8rem;right: 1.5rem;"></i>
                </div>
                <div class="offcanvas offcanvas-top h-100 filter-offcanvas" tabindex="-1" id="offcanvasTop"
                    aria-labelledby="offcanvasTopLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasTopLabel"><img src="images/Logo.png" class="w-50 p-2"
                                alt=""></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body p-0">
                        <div class="card">
                            <div class="d-flex justify-content-between align-items-center ps-3 pe-3">
                                <div>
                                    <p class="mb-0">Filter Your Search</p>
                                    <p class="fs-8 text-secondary mb-0"> to narrow down your search</p>
                                </div>
                                <button class=" pt-2 pb-2 reset" style="float: left;">reset</button>
                            </div>
                            <form action="" class="position-relative mt-5 mb-4 ps-3 pe-3 ">
                                <input type="text "
                                    class="form-control shadow2 border-0 related-card pt-4 pb-4 position-relative "
                                    placeholder="Where you want to go" style="padding-left: 2rem;" />
                                <i class="fa-solid fa-magnifying-glass position-absolute text-xs secandry-light"
                                    style="left: 27px; bottom:30px "></i>
                                <button class="btn position-absolute fs-7"
                                    style="padding: 0.8rem 1.1rem;right:25px;bottom: 10px;">Explore </button>
                            </form>
                            <hr class="m-3 secandry-light">
                            <div class="d-flex justify-content-between mt-3 mb-3 ps-3 pe-3">
                                <button class="accordion text-capitalize is-open ">price</button>
                                <button class="clear fs-7 text-secondary">clear</button>
                            </div>

                            <div class="accordion-content ps-3 pe-3 ">
                                <div class="price-wrap mt-3 mb-3 justify-content-between">
                                    <div class="price-wrap-1 d-flex">
                                        <label for="one-offcan">EGP</label>
                                        <input id="one-offcan">
                                    </div>
                                    <div class="price-wrap-2 d-flex">
                                        <label for="two-offcan">EGP</label>
                                        <input id="two-offcan">
                                    </div>
                                </div>
                                <fieldset class="filter-price pb-5">
                                    <div class="price-field position-relative">
                                        <input type="range" min="1000" max="15000" value="1000" id="lower-offcan">
                                        <input type="range" min="1000" max="15000" value="500" id="upper-offcan">
                                    </div>

                                </fieldset>
                            </div>
                            <hr class="m-3 secandry-light">
                            <div class="d-flex justify-content-between mt-3 mb-3 ps-3 pe-3">
                                <button class="accordion text-capitalize is-open">duration</button>
                                <button class="clear fs-7 text-secondary">clear</button>
                            </div>
                            <div class="accordion-content p-3">
                                <select class="form-select shadow2 radius-10 btn-drop" id="single-select-field"
                                    data-placeholder="Choose one thing">
                                    <option>Approx 2 night trip</option>
                                    <option>Reactive</option>
                                    <option>Solution</option>
                                    <option>Conglomeration</option>
                                    <option>Algoritm</option>
                                    <option>Holistic</option>
                                </select>
                            </div>
                            <hr class="m-3 secandry-light">
                            <div class="d-flex justify-content-between ps-3 pe-3">
                                <button class="accordion text-capitalize is-open ">numbers</button>
                                <button class="clear fs-7 text-secondary">clear</button>
                            </div>
                            <div class="accordion-content p-3 d-flex">
                                <select class="form-select shadow2 radius-10 btn-drop m-1" id="single-select-field"
                                    data-placeholder="Choose one thing">
                                    <option>2 adults</option>
                                    <option>Reactive</option>
                                    <option>Solution</option>
                                    <option>Conglomeration</option>
                                    <option>Algoritm</option>
                                    <option>Holistic</option>
                                </select>
                                <select class="form-select shadow2 radius-10 btn-drop m-1" id="single-select-field"
                                    data-placeholder="Choose one thing">
                                    <option>2 childs</option>
                                    <option>Reactive</option>
                                    <option>Solution</option>
                                    <option>Conglomeration</option>
                                    <option>Algoritm</option>
                                    <option>Holistic</option>
                                </select>
                            </div>

                            <hr class="m-3 secandry-light">
                            <div class="d-flex justify-content-between  ps-3 pe-3">
                                <button class="accordion text-capitalize is-open">rooms</button>
                                <button class="clear fs-7 text-secondary">clear</button>
                            </div>
                            <div class="accordion-content  p-3">
                                <select class="form-select shadow2 radius-10 btn-drop" id="single-select-field"
                                    data-placeholder="Choose one thing">
                                    <option>1 room - 3 beds - 1 bathroom</option>
                                    <option>Reactive</option>
                                    <option>Solution</option>
                                    <option>Conglomeration</option>
                                    <option>Algoritm</option>
                                    <option>Holistic</option>
                                </select>
                            </div>
                            <hr class="m-3 secandry-light">
                            <div class="d-flex justify-content-between  ps-3 pe-3">
                                <button class="accordion text-capitalize is-open">district</button>
                                <button class="clear fs-7 text-secondary">clear</button>
                            </div>
                            <div class="accordion-content  p-3">
                                <select class="form-select shadow2 radius-10 btn-drop" id="single-select-field"
                                    data-placeholder="Choose one thing">
                                    <option>aswan</option>
                                    <option>Reactive</option>
                                    <option>Solution</option>
                                    <option>Conglomeration</option>
                                    <option>Algoritm</option>
                                    <option>Holistic</option>
                                </select>
                            </div>
                            <hr class="m-3 secandry-light">
                            <div class="d-flex justify-content-between  ps-3 pe-3">
                                <button class="accordion text-capitalize is-open">hotel</button>
                                <button class="clear fs-7 text-secondary">clear</button>
                            </div>
                            <div class="accordion-content ">
                                <button class="select-btn text-capi1talize m-1">aswan</button>
                                <button class="select-btn text-capi1talize m-1">califronia</button>
                                <button class="select-btn text-capi1talize m-1">aswan</button>
                                <button class="select-btn text-capi1talize m-1">nuba</button>
                                <button class="select-btn text-capi1talize m-1">antaaarcaticca</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card filter shadow ps-3 pe-3 pt-3 me-3">
                    <img src="images/Logo.png" class="w-50 p-3" alt="">
                    <div class="d-flex justify-content-between align-items-center ps-3 pe-3 mt-3">
                        <div>

                            <p class="mb-0 fw-600">Filter Your Search</p>
                            <p class="fs-8 text-secondary mb-0"> to narrow down your search</p>
                        </div>

                        <button class=" pt-2 pb-2 reset" style="float: left;">reset</button>
                    </div>
                    <form action="" class="position-relative mt-5 mb-4 ps-3 pe-3 ">
                        <input type="text "
                            class="form-control shadow2 border-0 related-card pt-4 pb-4  position-relative fs-8 "
                            placeholder="Where you want to go" style="padding-left: 2rem;" />
                        <i class="fa-solid fa-magnifying-glass position-absolute fs-7 secandry-light"
                            style="left: 27px; bottom:27px "></i>
                        <button class="btn position-absolute fs-8 "
                            style="padding: 0.8rem 1.1rem;right: 25px;bottom: 10px;">Explore </button>
                    </form>
                    <hr class="m-3 secandry-light">
                    <div class="d-flex justify-content-between mt-3 mb-3 ps-3 pe-3">
                        <button class="accordion text-capitalize is-open ">price</button>
                        <button class="clear fs-7 text-secondary">clear</button>
                    </div>

                    <div class="accordion-content ps-3 pe-3">
                        <div class="price-wrap mt-3 mb-3 justify-content-between">
                            <div class="price-wrap-1 d-flex">
                                <label for="one">EGP</label>
                                <input id="one">
                            </div>
                            <div class="price-wrap-2 d-flex">
                                <label for="two">EGP</label>
                                <input id="two">
                            </div>
                        </div>
                        <fieldset class="filter-price pb-5">
                            <div class="price-field position-relative">
                                <input type="range" min="1000" max="15000" value="1000" id="lower">
                                <input type="range" min="1000" max="15000" value="500" id="upper">
                            </div>

                        </fieldset>

                        <style>

                        </style>
                    </div>
                    <hr class="m-3 secandry-light">
                    <div class="d-flex justify-content-between mt-3 mb-3 ps-3 pe-3">
                        <button class="accordion text-capitalize is-open">duration</button>
                        <button class="clear fs-7 text-secondary">clear</button>
                    </div>
                    <div class="accordion-content p-3">
                        <select class="form-select shadow2 radius-10 btn-drop" id="single-select-field"
                            data-placeholder="Choose one thing">
                            <option>Approx 2 night trip</option>
                            <option>Reactive</option>
                            <option>Solution</option>
                            <option>Conglomeration</option>
                            <option>Algoritm</option>
                            <option>Holistic</option>
                        </select>
                    </div>
                    <hr class="m-3 secandry-light">
                    <div class="d-flex justify-content-between ps-3 pe-3">
                        <button class="accordion text-capitalize is-open ">numbers</button>
                        <button class="clear fs-7 text-secondary">clear</button>
                    </div>

                    <div class="accordion-content  p-3 d-flex">
                        <select class="form-select shadow2 radius-10 btn-drop m-1" id="single-select-field"
                            data-placeholder="Choose one thing">
                            <option>2 adults</option>
                            <option>Reactive</option>
                            <option>Solution</option>
                            <option>Conglomeration</option>
                            <option>Algoritm</option>
                            <option>Holistic</option>
                        </select>
                        <select class="form-select shadow2 radius-10 btn-drop m-1" id="single-select-field"
                            data-placeholder="Choose one thing">
                            <option>2 childs</option>
                            <option>Reactive</option>
                            <option>Solution</option>
                            <option>Conglomeration</option>
                            <option>Algoritm</option>
                            <option>Holistic</option>
                        </select>
                    </div>


                    <hr class="m-3 secandry-light">
                    <div class="d-flex justify-content-between ps-3 pe-3">
                        <button class="accordion text-capitalize is-open">rooms</button>
                        <button class="clear fs-7 text-secondary">clear</button>
                    </div>
                    <div class="accordion-content  p-3">
                        <select class="form-select shadow2 radius-10 btn-drop" id="single-select-field"
                            data-placeholder="Choose one thing">
                            <option>1 room - 3 beds - 1 bathroom</option>
                            <option>Reactive</option>
                            <option>Solution</option>
                            <option>Conglomeration</option>
                            <option>Algoritm</option>
                            <option>Holistic</option>
                        </select>
                    </div>
                    <hr class="m-3 secandry-light">
                    <div class="d-flex justify-content-between ps-3 pe-3">
                        <button class="accordion text-capitalize is-open">district</button>
                        <button class="clear fs-7 text-secondary">clear</button>
                    </div>
                    <div class="accordion-content  p-3">
                        <select class="form-select shadow2 radius-10 btn-drop" id="single-select-field"
                            data-placeholder="Choose one thing">
                            <option>aswan</option>
                            <option>Reactive</option>
                            <option>Solution</option>
                            <option>Conglomeration</option>
                            <option>Algoritm</option>
                            <option>Holistic</option>
                        </select>
                    </div>
                    <hr class="m-3 secandry-light">
                    <div class="d-flex justify-content-between ps-3 pe-3">
                        <button class="accordion text-capitalize is-open">hotel</button>
                        <button class="clear fs-7 text-secondary">clear</button>
                    </div>
                    <div class="accordion-content ps-3 pe-3">
                        <button class="select-btn text-capi1talize m-1">aswan</button>
                        <button class="select-btn text-capi1talize m-1">califronia</button>
                        <button class="select-btn text-capi1talize m-1">aswan</button>
                        <button class="select-btn text-capi1talize m-1">nuba</button>
                        <button class="select-btn text-capi1talize m-1">antaaarcaticca</button>
                    </div>
                </div>


            </div>
            <div class="col-12 col-xl-8 col-xxl-9 ">
                <div class="row p-3 pt-0">
                    <div class="banner radius-20" style="height: 310px">
                        <div class="w-50 float-end pt-5 text-light">
                            <h1 class="fw-bold text-light fs-5">the easiest way</h1>
                            <h2 class="fw-bold ">to discover the world</h2>
                            <p class=" fs-8">Lorem Ipsum is simply dummy text of the printing and typesetting
                                industry.
                                Lorem Ipsum has been the industrys standard dummy text </p>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    @foreach ($unit as $item)
                    <div class="col-12 col-md-6 col-lg-6 col-xl-3 mb-4 ">
                        <div class="card-product radius-20 shadow position-relative p-3">
                            <div class="position-absolute icon-product mt-2 ms-2">
                                <i class="fa-solid fa-plane-up"></i>
                                <i class="fa-solid fa-utensils"></i>
                            </div>
                            {{-- <img src="images/Mask Group 4.png" alt=""> --}}
                            <img src="{{ URL::asset('img/products/' . $item->unit->main_image) }}">
                            <div class="d-flex justify-content-between align-items-baseline pt-3">
                                <a href="" class="text-dark">
                                    <h2 class="fs-5 fw-600">{{$item->unit->name}}</h2>
                                </a>
                                <p class="fs-8 secandry-light"><i class="fa-solid fa-location-arrow color-i"></i>
                                    {{$item->name}}
                                </p>
                            </div>
                            <p class="fs-6 fw-600 w-50 text-truncate">
                                {{$item->unit->short_description}}
                            </p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h3 class="fw-600 color-title m-0">$420 <span
                                            class="secandry-light fs-6 fw-500">$450</span></h3>
                                    <p class="secandry-light fs-9 m-0">available for 5 persons</p>
                                </div>
                                <a href="{{route('school_route.show_all_item_destination')}}"
                                    class="btn yellow-btn text-capitalize fs-8 radius-10 ">Book now</a>
                            </div>
                        </div>
                    </div>

                    @endforeach
                </div>
            </div>
        </section>

        <section class="row mb-6 p-5 blue-bg text-light radius-20 contact">
            <form id="contactForm ">
                <div class="col-12 col-md-6">
                    <h2 class="fw-bold">Contact Us</h2>
                    <p>
                        On the Windows talking painted pasture yet its express partiesuse Sure last upon he same knew
                        next Of believed or
                    </p>
                </div>

                <!-- Name input -->
                <div class="mb-3 d-flex row">
                    <div class="col-12 col-md-4">
                        <input class="form-control contact p-3 mt-3 fw-300 text-light" id="name" type="text"
                            placeholder="Name" data-sb-validations="required" />
                    </div>
                    <div class="col-12 col-md-4">
                        <input class="form-control contact p-3 mt-3 fw-300 col-md-4 col-12 text-light" id="emailAddress"
                            type="email" placeholder="Email Address" data-sb-validations="required, email" />
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
                    <textarea class="form-control contact p-2 fw-300 text-light" id="message" type="text"
                        placeholder="Message" style="height: 10rem" data-sb-validations="required"></textarea>
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
    // range of price filter
        var lowerSlider = document.querySelector('#lower');
        var upperSlider = document.querySelector('#upper');

        document.querySelector('#two').value = upperSlider.value;
        document.querySelector('#one').value = lowerSlider.value;

        var lowerVal = parseInt(lowerSlider.value);
        var upperVal = parseInt(upperSlider.value);

        upperSlider.oninput = function() {
            lowerVal = parseInt(lowerSlider.value);
            upperVal = parseInt(upperSlider.value);

            if (upperVal < lowerVal + 4) {
                lowerSlider.value = upperVal - 4;
                if (lowerVal == lowerSlider.min) {
                    upperSlider.value = 4;
                }
            }
            document.querySelector('#two').value = this.value
        };

        lowerSlider.oninput = function() {
            lowerVal = parseInt(lowerSlider.value);
            upperVal = parseInt(upperSlider.value);
            if (lowerVal > upperVal - 4) {
                upperSlider.value = lowerVal + 4;
                if (upperVal == upperSlider.max) {
                    lowerSlider.value = parseInt(upperSlider.max) - 4;
                }
            }
            document.querySelector('#one').value = this.value
        };


        // range of price in offcanvas
        var lowerSlider1 = document.querySelector('#lower-offcan');
        var upperSlider1 = document.querySelector('#upper-offcan');

        document.querySelector('#two-offcan').value = upperSlider1.value;
        document.querySelector('#one-offcan').value = lowerSlider1.value;

        var lowerValu = parseInt(lowerSlider1.value);
        var upperValu = parseInt(upperSlider1.value);

        upperSlider1.oninput = function() {
            lowerValu = parseInt(lowerSlider1.value);
            upperValu = parseInt(upperSlider1.value);

            if (upperVal < lowerValu + 4) {
                lowerSlider1.value = upperValu - 4;
                if (lowerValu == lowerSlider1.min) {
                    upperSlider1.value = 4;
                }
            }
            document.querySelector('#two-offcan').value = this.value
        };

        lowerSlider1.oninput = function() {
            lowerValu = parseInt(lowerSlider1.value);
            upperValu = parseInt(upperSlider1.value);
            if (lowerValu > upperValu - 4) {
                upperSlider1.value = lowerValu + 4;
                if (upperValu == upperSlider1.max) {
                    lowerSlider1.value = parseInt(upperSlider1.max) - 4;
                }
            }
            document.querySelector('#one-offcan').value = this.value
        };
        var swiper = new Swiper(".hotel", {
            loop: true,
            freeMode: true,
            spaceBetween: 0,
            grabCursor: true,
            slidesPerView: 7,
            touchEventsTarget: 'container',
            loop: true,
            loopFillGroupWithBlank: true,
            loop: true,
            freeMode: true,
            speed: 4000,
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
                    slidesPerView: 2,
                    spaceBetween: 20,
                },
                640: {
                    slidesPerView: 3,
                    spaceBetween: 40,
                },
                750: {
                    slidesPerView: 3,
                    spaceBetween: 20,
                },
                1024: {
                    slidesPerView: 4,
                    spaceBetween: 20,
                },
                1440: {
                    slidesPerView: 7,
                    spaceBetween: 20,
                },
                2500: {
                    slidesPerView: 8,
                    spaceBetween: 20,
                }
            },

        });
        // accordion
        const accordionBtns = document.querySelectorAll(".accordion");
        accordionBtns.forEach(el => {
            if (el.classList.contains("is-open")) {
                el.parentElement.nextElementSibling.style.maxHeight = "max-content";
            }
        });
        accordionBtns.forEach((accordion) => {
            accordion.onclick = function() {
                this.classList.toggle("is-open");
                let content = this.parentElement.nextElementSibling;
                if (content.style.maxHeight) {
                    content.style.transition = "all  0.2s ";
                    content.style.maxHeight = null;
                } else {
                    content.style.transition = "all  0.2s ";

                    content.style.maxHeight = content.scrollHeight + "px";
                    console.log(content.style.maxHeight);
                }
            };
        });
</script>
@endsection