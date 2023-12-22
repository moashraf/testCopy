@extends('website.layouts.master', ['no_header' => true, 'no_transparent_header' => false])

@section('css')
<style>
    .under_line_cust_img {
        position: relative;
    }

    .under_line_cust_img::after {
        content: "";
        position: absolute;
        background-image: url("{{ URL::asset('img/website/other/decore.png')}}");
        width: 100%;
        height: 9px;
        bottom: -8px;
        right: 0px;
        border-radius: 20px;
    }
</style>
<!-- datepicker time and date -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.css"
    integrity="sha512-MQXduO8IQnJVq1qmySpN87QQkiR1bZHtorbJBD0tzy7/0U9+YIC93QWHeGTEoojMVHWWNkoCp8V6OzVSYrX0oQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/dark.css">

@endsection

@section('content')

<div class="top_small_header_addv">
    One of the best travel agencies in Egypt
</div>

<!-- header -->
<header class="header_hp" style="height: 400px !important">

    <div class="position-absolute z-2 w-100">
        <div class="container px-md-5 px-3 pt-2 pt-md-4">
            @include('website.layouts.includes.topbar_transp')
        </div>
    </div>

    <div class="full_height_width_slider z-0">
        <div class="swiper full_height_width_slider_swiper">
            <div class="swiper-wrapper">
                @foreach ($article->imgs as $item)
                <div class="swiper-slide"
                    style="background-image:url('{{ URL::asset('img/article/' . $item->img) }}'); object-fit: cover; background-position: center center;">
                    <div class="text-shadow-200 px-5 full_height_width_slider_swiper_text">
                        <div class="px-0 pe-md-5">
                            <h3 class="text-white-80 fw-lighter mb-0">Discover</h3>
                            <h1 class="text-white text-xxl2 mb-0">
                                {{ $article->name }}
                            </h1>
                            <h3 class="text-white-80 fw-lighter  text-truncate">{{ $article->short_description }}
                            </h3>

                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

</header>

{{-- for hotel search for small devices --}}

{{-- for hotel search for small devices --}}
<div class="offcanvas h-75 offcanvas-top px-2 px-md-5" tabindex="-1" id="offcanvas_search_hotel"
    aria-labelledby="offcanvasTopLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasTopLabel"><i class="fa-solid fa-magnifying-glass"></i> Search for the
            best hotels offers</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>

    <form class="mb-0 myfrom" action="{{ route('school_route.unit_search') }}" method="GET" style="display: contents">
        @csrf
        <div class="offcanvas-body">


            <div>
                <div class="d-flex align-items-center text-s fw-bold text-gray-700 mb-0">
                    <i class="fa-solid fa-location-dot me-2"></i>
                    Destination
                </div>
                <input type="text" name="search_hotel" class="booking_search_input search_hotel"
                    data-bs-toggle="dropdown" aria-expanded="false" placeholder="Sharm Elshekh"
                    id="dropdown_destination_book">

                <ul class="search_destination_cont" class="px-4 py-0 mb-0" aria-labelledby="dropdown_destination_book">
                </ul>
            </div>


            <div class="mb-3">
                <div class="d-flex align-items-center text-s fw-bold text-gray-700 mb-0">
                    <i class="fa-solid fa-location-dot me-2"></i>
                    From
                </div>
                <input name="from_ht_date" type="text"
                    class="booking_search_input border-0 datepicker_time bg-white @error('from_ht_date') is-invalid @enderror"
                    placeholder="Thu 16 Feb" data-enable-time="true" value="{{ old('from_ht_date') }}" required>
            </div>

            <div class="mb-3">
                <div class="d-flex align-items-center text-s fw-bold text-gray-700 mb-0">
                    <i class="fa-solid fa-location-dot me-2"></i>
                    To
                </div>
                <input name="to_ht_date" type="text"
                    class="booking_search_input border-0 datepicker_time bg-white @error('to_ht_date') is-invalid @enderror"
                    placeholder="Thu 19 Feb" data-enable-time="true" value="{{ old('to_ht_date') }}" required>
            </div>

            <hr class="text-gray-300">

            <div>
                <div class="d-flex align-items-center text-s fw-bold text-gray-700 mb-0">
                    <i class="fa-solid fa-users me-2"></i>
                    Room and Traveler
                </div>
                <ul class=" px-0">
                    <li class="d-flex justify-content-between align-items-center mb-2">
                        <h6 class="mb-0">Rooms </h6>
                        <div class="counter_book_btn pe-4">
                            <span data-type="room" class="plus_counter_btn bg-dark">+</span>
                            <input type="text" class="counter_book_count" name="room_qty" value="1" readonly>
                            <span data-type="room" class="minus_counter_btn bg-dark">-</span>
                        </div>
                    </li>
                    <hr class="text-gray-300">
                    <li class="d-flex justify-content-between align-items-center mb-2">
                        <h6 class="mb-0">Adult </h6>
                        <div class="counter_book_btn pe-4">
                            <span data-type="adult" class="plus_counter_btn bg-dark">+</span>
                            <input type="text" class="counter_book_count" name="adult_qty" value="1" readonly>
                            <span data-type="adult" class="minus_counter_btn bg-dark">-</span>
                        </div>
                    </li>
                    <li class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="mb-0">Children</h6>
                        <div class="counter_book_btn pe-4">
                            <span data-type="child" class="plus_counter_btn bg-dark">+</span>
                            <input type="text" class="counter_book_count" name="child_qty" value="0" readonly>
                            <span data-type="child" class="minus_counter_btn bg-dark">-</span>
                        </div>
                    </li>
                </ul>
            </div>

        </div>

        <div class="modal-footer">
            <div class="right-side">
                <a class="text-gray-300 link-cust-text clickable-item-pointer" data-bs-dismiss="offcanvas">Never
                    Mind</a>
            </div>
            <div class="divider"></div>
            <div class="left-side">
                <button type="submit" class="btn btn-default btn-link main-color fw-bold">
                    Search <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </div>
        </div>
    </form>
</div>

{{-- for destination search for small devices --}}
<div class="offcanvas h-75 offcanvas-top px-2 px-md-5" tabindex="-1" id="offcanvas_search_destination"
    aria-labelledby="offcanvasTopLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasTopLabel"><i class="fa-solid fa-magnifying-glass"></i> Discover the
            world</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>


    <form class="mb-0 myfrom" action="{{ route('school_route.unit_search') }}" method="GET" style="display: contents">
        @csrf
        <div class="offcanvas-body">


            <div>
                <div class="d-flex align-items-center text-s fw-bold text-gray-700 mb-0">
                    <i class="fa-solid fa-location-dot me-2"></i>
                    Destination
                </div>
                <input type="text" name="search_hotel" class="booking_search_input search_hotel"
                    data-bs-toggle="dropdown" aria-expanded="false" placeholder="Sharm Elshekh"
                    id="dropdown_destination_book">
                <ul class="search_destination_cont" class="px-4 py-0 mb-0" aria-labelledby="dropdown_destination_book">
                </ul>
            </div>

        </div>

        <div class="modal-footer">
            <div class="right-side">
                <a class="text-gray-300 link-cust-text clickable-item-pointer" data-bs-dismiss="offcanvas">Never
                    Mind</a>
            </div>
            <div class="divider"></div>
            <div class="left-side">
                <button type="submit" class="btn btn-default btn-link main-color fw-bold">
                    Search <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </div>
        </div>
    </form>
</div>


{{-- for Package search for small devices --}}
<div class="offcanvas h-75 offcanvas-top px-2 px-md-5" tabindex="-1" id="offcanvas_search_package"
    aria-labelledby="offcanvasTopLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasTopLabel"><i class="fa-solid fa-magnifying-glass"></i> Search for your
            Package</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>

    <form class="mb-0 myfrom" action="{{ route('school_route.search_package') }}" method="GET"
        style="display: contents">
        @csrf
        <div class="offcanvas-body">

            <div>
                <div class="d-flex align-items-center text-s fw-bold text-gray-700 mb-0">
                    <i class="fa-solid fa-location-dot me-2"></i>
                    Destination
                </div>
                <input type="text" name="search_hotel" class="booking_search_input search_hotel"
                    data-bs-toggle="dropdown" aria-expanded="false" placeholder="Sharm Elshekh"
                    id="dropdown_destination_book">
                <ul class="search_destination_cont" class="px-4 py-0 mb-0" aria-labelledby="dropdown_destination_book">
                </ul>
            </div>


            <div class="mb-3">
                <div class="d-flex align-items-center text-s fw-bold text-gray-700 mb-0">
                    <i class="fa-solid fa-location-dot me-2"></i>
                    From
                </div>
                <input name="from_ht_date" type="text"
                    class="booking_search_input border-0 datepicker_time bg-white @error('from_ht_date') is-invalid @enderror"
                    placeholder="Thu 16 Feb" data-enable-time="true" value="{{ old('from_ht_date') }}" required>
            </div>

            <div class="mb-3">
                <div class="d-flex align-items-center text-s fw-bold text-gray-700 mb-0">
                    <i class="fa-solid fa-location-dot me-2"></i>
                    To
                </div>
                <input name="to_ht_date" type="text"
                    class="booking_search_input border-0 datepicker_time bg-white @error('to_ht_date') is-invalid @enderror"
                    placeholder="Thu 19 Feb" data-enable-time="true" value="{{ old('to_ht_date') }}" required>
            </div>

        </div>

        <div class="modal-footer">
            <div class="right-side">
                <a class="text-gray-300 link-cust-text clickable-item-pointer" data-bs-dismiss="offcanvas">Never
                    Mind</a>
            </div>
            <div class="divider"></div>
            <div class="left-side">
                <button type="submit" class="btn btn-default btn-link main-color fw-bold">
                    Search <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </div>
        </div>
    </form>
</div>


<section class="bg-white pb-5 pt-0 mb-4 px-5"
    style="border-radius: 20px 20px 0px 0px; position: relative; z-index: 1; top: -1rem;">
    <div class="row ps-4 pt-5">


        <div class="row px-5">


            <div class="col-9">
                <div class="mb-2">
                    <span>
                        <a class="link-cust-text text-gray-300 fw-light" href="{{ route('website_homepage') }}">{{
                            __('HomePage') }}
                            |</a>
                        <a class="link-cust-text text-gray-300 fw-light"
                            href="{{ route('school_route.articles') }}">Articles |
                        </a>
                        <a class="text-gray-600">{{ $article->name }}</a>
                    </span>
                </div>

                <div class="mb-1">
                    @foreach ($article->tags as $item)
                    <a href="{{ route('school_route.show_tag', $item->tag->slug)}}">
                        <span class="badge badge_tags px-3 me-1 text-xxs"
                            style="background-color: {{ $item->tag->color }}">
                            {{
                            $item->tag->name }}</span>
                    </a>
                    @endforeach
                </div>
                <h1>{{ $article->name }}</h1>
                <p class="fs-5">{!! $article->description !!}</p>
            </div>

            <div class="col-3">
                <div>
                    <h6 class="text-gray-400 text-s m-0"><i class="fas fa-calendar-alt"></i> Created at</h6>
                    <p class="fw-bold">{{ date('d M Y', strtotime($article->created_at)) }}</p>
                </div>
                <div>
                    <h6 class="text-gray-400 text-s m-0"><i class="fas fa-calendar-alt"></i> Destination</h6>
                    <p class="fw-bold"><i class="fas fa-map-marker-alt"></i> {{ $article->destination->name }}</p>
                </div>
            </div>
        </div>


    </div>
</section>



{{-- related articles --}}

<section class="container mb-0 bg-white b-r-l-cont pt-4">
    <div class="d-flex justify-content-between mb-0">

        <div class="mb-3">

            <h3 class="text-gray-800 fw-bold mb-0">
                Articles You Might Like
            </h3>
            <h6 class="text-gray-300  mb-1">
                Here is a list of packages for you
            </h6>
        </div>
        <a href="{{ route('school_route.articles') }}">
            <div class="border_black_btn border_radius_20 fw-normal"> Discover More
            </div>
        </a>
    </div>
    <div class="swiper swiper_products">

        <div class="swiper-wrapper">
            @foreach ($related_articles as $item)

            <div class="col-12 col-md-4 mb-3">
                <div class="">
                    <div class="tourism_product" style="background-color: transparent !important;box-shadow: none;">
                        <a href="{{ route('school_route.article_show', $item->slug) }}">
                            <img class="mb-2" src="{{ URL::asset('img/article/' . $item->main_img) }}" title="cover">
                        </a>

                        <div class="d-flex justify-content-between px-2 mb-1">
                            <a href="{{ route('school_route.article_show', $item->slug) }}"
                                class="text-gray-900 fw-bold">{{
                                $item->name }}</a>
                        </div>
                        <div class="d-flex justify-content-between px-2">
                            <div class="text-s">
                                <div class="d-flex text-gray-400 ">
                                    <i class="fa-solid fa-location-dot me-2"></i> <span>
                                        {{ $item->destination->name }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            @endforeach
        </div>

        <div class="swiper-pagination"></div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
</section>


@endsection
@section('js')
<script>
    var full_height_width_slider_swiper = new Swiper(".full_height_width_slider_swiper", {
        autoplay: {
            delay: 4000,
        },  
        loop: true,
        touchEventsTarget: 'container',
        effect: 'fade',
        fadeEffect: {
            crossFade: true
        },
    });

    var full_height_width_slider_swiper_weekly = new Swiper(".full_height_width_slider_swiper_weekly", {
        pagination: {
        el: ".swiper-pagination",
      },
      autoplay: {
            delay: 4000,
        },  
        loop: true,
        touchEventsTarget: 'container',
    });

    var swiper = new Swiper(".our_services_slider_hp", {
      autoplay: {
            delay: 2000,
        },  
      touchEventsTarget: 'container',
      slidesPerView: "auto",
      spaceBetween: 12,  
      loop: true,    
    });

    var swiper = new Swiper(".swiper_center", {
      slidesPerView: "auto",
      loop: true,
      touchEventsTarget: 'container',
      slidesPerView: "auto",
      touchEventsTarget: 'container',
      spaceBetween: 10,
    });

    var swiper = new Swiper(".swiper_top_destination", {
      slidesPerView: "auto",
      loop: true,
      touchEventsTarget: 'container',
      touchEventsTarget: 'container',
      spaceBetween: 30,
      loop: true,
    });
    

</script>



<!-- datapicker date and time -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.js"
    integrity="sha512-K/oyQtMXpxI4+K0W7H25UopjM8pzq0yrVdFdG21Fh5dBe91I40pDd9A4lzNlHPHBIP2cwZuoxaUSX0GJSObvGA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    //-------- datepicker time --------
        $('.datepicker_time').flatpickr({
            enableTime: false,
            dateFormat: "Y-m-d",
            theme: "dark", // defaults to "light"
        });
</script>


<script>
    //Rules for the Validator plugin
        var $validator = $('#myform_destination').validate({
        //for inserting erros for some inputs that makes posation problem such as selector 2 and bt datapicker
        errorPlacement: function(error, element) {
            switch (element.attr("name")) {
                case 'permissions':
                    error.insertAfter($("#permissions-js-error-valid"));
                    break;

                default:
                    error.insertAfter(element);
            }

        },
    });
    var $validator = $('#myform_visa').validate({
        //for inserting erros for some inputs that makes posation problem such as selector 2 and bt datapicker
        errorPlacement: function(error, element) {
            switch (element.attr("name")) {
                case 'permissions':
                    error.insertAfter($("#permissions-js-error-valid"));
                    break;

                default:
                    error.insertAfter(element);
            }

        },
    });
</script>
@endsection