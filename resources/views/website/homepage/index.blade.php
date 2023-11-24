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
<header class="header_hp">

    <div class="position-absolute z-2 w-100">
        <div class="container px-md-5 px-3 pt-2 pt-md-4">
            @include('website.layouts.includes.topbar_transp')
        </div>
    </div>

    <div class="full_height_width_slider z-0">
        <div class="swiper full_height_width_slider_swiper">
            <div class="swiper-wrapper">
                @foreach ($main_slider as $item)
                <div class="swiper-slide"
                    style="background-image:url('{{ URL::asset('img/sliders/' . $item->img) }}'); object-fit: cover; background-position: center center;">
                    <div class="text-shadow-200 px-5 full_height_width_slider_swiper_text">
                        <div class="px-0 pe-md-5">
                            <h3 class="text-white-80 fw-lighter">{{ $item->name }}</h3>
                            <h1 class="text-white text-xxl2 mb-3">
                                {!! $item->description !!}
                            </h1>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    @include('website.layouts.components.main_search')


</header>


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

                <input type="hidden" name="search_hotel_input" class="search_hotel_input" required>
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
                <span class="text-gray-300 link-cust-text clickable-item-pointer" data-bs-dismiss="offcanvas">Never
                    Mind</span>
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
                <span class="text-gray-300 link-cust-text clickable-item-pointer" data-bs-dismiss="offcanvas">Never
                    Mind</span>
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
                <span class="text-gray-300 link-cust-text clickable-item-pointer" data-bs-dismiss="offcanvas">Never
                    Mind</span>
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




<section class="bg-white py-5 " style="border-radius: 20px 20px 0px 0px; position: relative; z-index: 1; top: -1rem;">
    <div class="row ps-4 mx-0">
        <div class="col-12 col-md-3 ps-5 mb-3 mb-md-0 ">

            <div class="ps-0 ps-md-3 pe-2">
                <h1 class="fw-bold text-xx2 mb-0">
                    Discover Our <span class="fw-light"> Services</span>
                </h1>
                <div class="hr-land second-color-bg b-r-l-cont  ms-md-0 mt-0" style="width: 64%;">
                </div>
                <p class=" text-gray-400 fs-6">
                    Here is the list of our best services to you with the best qulity
                </p>
            </div>

        </div>
        <div class="col-12 col-md-9 pe-0">

            <div class="swiper our_services_slider_hp">
                <div class="swiper-wrapper">
                    <div class="swiper-slide border_radius_20"
                        style="background-image:url('{{ URL::asset('img/website/hp/service_slider/slider_service_1.jpg') }}'); background-size: cover;background-position: center;">
                        <a href="{{ route('school_route.show_tag', 'sun_and_beach') }}">
                            <div class="position-absolute bottom-0 z-2 mb-4 px-4 text-shadow-200">
                                <p class="text-white-80 fw-light mb-0">Discover the best serivce ever</p>
                                <h5 class="text-white fw-bold mb-0">Sun and beach</h5>
                            </div>
                        </a>
                    </div>

                    <div class="swiper-slide border_radius_20"
                        style="background-image:url('{{ URL::asset('img/website/hp/service_slider/slider_service_6.jpg') }}'); background-size: cover;background-position: center;">
                        <a href="{{ route('school_route.show_tag', 'disable-tourism') }}">
                            <div class="position-absolute bottom-0 z-2 mb-4 px-4 text-shadow-200">
                                <p class="text-white-80 fw-light mb-0">Discover the best serivce ever</p>
                                <h5 class="text-white fw-bold mb-0">Deaf and Dumb</h5>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide border_radius_20"
                        style="background-image:url('{{ URL::asset('img/website/hp/service_slider/slider_service_2.jpg') }}'); background-size: cover;background-position: center;">
                        <a href="{{ route('school_route.all_visa') }}">
                            <div class="position-absolute bottom-0 z-2 mb-4 px-4 text-shadow-200">
                                <p class="text-white-80 fw-light mb-0">Discover the best serivce ever</p>
                                <h5 class="text-white fw-bold mb-0">Visa</h5>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide border_radius_20"
                        style="background-image:url('{{ URL::asset('img/website/hp/service_slider/slider_service_3.jpg') }}'); background-size: cover;background-position: center;">
                        <a href="{{ route('school_route.show_tag', 'honeymoon') }}">
                            <div class="position-absolute bottom-0 z-2 mb-4 px-4 text-shadow-200">
                                <p class="text-white-80 fw-light mb-0">Discover the best serivce ever</p>
                                <h5 class="text-white fw-bold mb-0">Honeymoon</h5>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide border_radius_20"
                        style="background-image:url('{{ URL::asset('img/website/hp/service_slider/slider_service_4.jpg') }}'); background-size: cover;background-position: center;">
                        <a href="{{ route('school_route.show_tag', 'pink_tourism') }}">
                            <div class="position-absolute bottom-0 z-2 mb-4 px-4 text-shadow-200">
                                <p class="text-white-80 fw-light mb-0">Discover the best serivce ever</p>
                                <h5 class="text-white fw-bold mb-0">Pink Tourism</h5>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide border_radius_20"
                        style="background-image:url('{{ URL::asset('img/website/hp/service_slider/slider_service_5.jpg') }}'); background-size: cover;background-position: center;">
                        <a href="{{ route('school_route.all_airline') }}">
                            <div class="position-absolute bottom-0 z-2 mb-4 px-4 text-shadow-200">
                                <p class="text-white-80 fw-light mb-0">Discover the best serivce ever</p>
                                <h5 class="text-white fw-bold mb-0">Airline tickets</h5>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>




<section class="container pt-4 mb-4 mb-md-3">
    <div class="d-flex justify-content-between mb-0">

        <div class="mb-3">

            <h3 class="text-gray-800 fw-bold mb-0">
                Top Destination
            </h3>
            <h6 class="text-gray-300 text-xs mb-1">
                Here is the top destinations in destino
            </h6>
        </div>

        <a href="{{ route('school_route.unit_search', ['type=direct']) }}">
            <div class="border_black_btn border_radius_20 fw-normal"> Discover More
            </div>
        </a>
    </div>

    <div class="row">

        <div class="col-12 col-md-3">
            <div class="top_destination_hp border_radius_20 mb-3 mb-md-3"
                style="background-image:url('{{ URL::asset('img/destination/' . $top_destination[5]->image) }}'); background-size: cover;background-position: center;">
                <a href="{{ route('school_route.show_destination', $top_destination[5]->slug) }}">
                    <div class="position-absolute bottom-0 z-2 mb-4 px-4 text-shadow-200">
                        <h5 class="text-white fw-bold mb-0">{{ $top_destination[5]->name }}</h5>
                        <p class="text-white-80 fw-light mb-0">{{ $top_destination[5]->unit->count() }} Hotels - {{
                            $top_destination[5]->package->count() }}
                            Packages - {{
                            $top_destination[5]->trip->count() }} Trips</p>
                    </div>
                </a>
            </div>

            <div class="top_destination_hp border_radius_20 mb-0 mb-3 mb-md-0"
                style="background-image:url('{{ URL::asset('img/destination/' . $top_destination[0]->image) }}'); background-size: cover;background-position: center;">
                <a href="{{ route('school_route.show_destination', $top_destination[0]->slug) }}">
                    <div class="position-absolute bottom-0 z-2 mb-4 px-4 text-shadow-200">
                        <h5 class="text-white fw-bold mb-0">{{ $top_destination[0]->name }}</h5>
                        <p class="text-white-80 fw-light mb-0">{{ $top_destination[0]->unit->count() }} Hotels - {{
                            $top_destination[0]->package->count() }} Packages - {{ $top_destination[0]->trip->count() }}
                            Trips</p>
                    </div>
                </a>
            </div>
        </div>



        <div class="col-12 col-md-5 mb-3 mb-md-0">

            <div class="top_destination_hp border_radius_20 mb-3 mb-md-3"
                style="background-image:url('{{ URL::asset('img/destination/' . $top_destination[4]->image) }}'); background-size: cover;background-position: center; min-height:100%">
                <a href="{{ route('school_route.show_destination', $top_destination[4]->slug, ['type' => 'direct'])
                    }}">
                    <div class="position-absolute bottom-0 z-2 mb-4 px-4 text-shadow-200">
                        <h3 class="text-white fw-bold mb-0">{{ $top_destination[4]->name }}</h3>
                        <p class="text-white-80 fw-light mb-0">{{ $top_destination[4]->unit->count() }} Hotels - {{
                            $top_destination[4]->package->count() }} Packages - {{ $top_destination[4]->trip->count() }}
                            Trips</p>
                    </div>
                </a>
            </div>

        </div>


        <div class="col-12 col-md-4">
            <div class="top_destination_hp border_radius_20 mb-3 mb-md-3"
                style="background-image:url('{{ URL::asset('img/destination/' . $top_destination[2]->image) }}'); background-size: cover;background-position: center;">
                <a href="{{ route('school_route.show_destination', $top_destination[2]->slug) }}">
                    <div class="position-absolute bottom-0 z-2 mb-4 px-4 text-shadow-200">
                        <h4 class="text-white fw-bold mb-0">{{ $top_destination[2]->name }}</h4>
                        <p class="text-white-80 fw-light mb-0">{{ $top_destination[2]->unit->count() }} Hotels - {{
                            $top_destination[2]->package->count() }} Packages - {{ $top_destination[2]->trip->count() }}
                            Trips</p>
                    </div>
                </a>
            </div>

            <div class="row">
                <div class="col-6">
                    <div class="top_destination_hp border_radius_20 mb-0"
                        style="background-image:url('{{ URL::asset('img/destination/' . $top_destination[1]->image) }}'); background-size: cover;background-position: center;">
                        <a href="{{ route('school_route.show_destination', $top_destination[1]->slug) }}">
                            <div class="position-absolute bottom-0 z-2 mb-4 px-4 text-shadow-200">
                                <h5 class="text-white fw-bold mb-0">{{ $top_destination[1]->name }}</h5>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-6">
                    <div class="top_destination_hp border_radius_20 mb-0"
                        style="background-image:url('{{ URL::asset('img/destination/' . $top_destination[3]->image) }}'); background-size: cover;background-position: center;">
                        <a href="{{ route('school_route.show_destination', $top_destination[3]->slug) }}">
                            <div class="position-absolute bottom-0 z-2 mb-4 px-4 text-shadow-200">
                                <h5 class="text-white fw-bold mb-0">{{ $top_destination[3]->name }}</h5>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

        </div>

    </div>

</section>

<section class="container  pt-4 mb-4 mb-md-1">

    <div class="d-flex justify-content-between mb-0">

        <div class="mb-3">

            <h3 class="text-gray-800 fw-bold mb-0">
                Discover our top packages
            </h3>
            <h6 class="text-gray-300 text-xs mb-1">
                Here is the top destinations in destino
            </h6>
        </div>

        <a href="{{ route('school_route.search_package', ['type=direct&']) }}">
            <div class="border_black_btn border_radius_20 fw-normal"> Discover More
            </div>
        </a>
    </div>


</section>


<section class="container">
    <div class="swiper swiper_products">

        <div class="swiper-wrapper">
            @foreach ($best_package as $item)
            @include('website.layouts.components.product_slider')
            @endforeach
        </div>

        <div class="swiper-pagination"></div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
</section>


<section class="px-0 px-md-0 px-md-0 pt-4 mb-0">

    <div class="swiper full_height_width_slider_swiper_weekly header_destination">
        <div class="swiper-wrapper">

            @foreach ($weekly_slider as $item)
            <div class="swiper-slide">
                <div class="row">
                    <div class="col-12">
                        <a href="#">
                            <div class="weekly_destination object-fit-cover px-3 px-md-5 mb-0"
                                style="background-image: url('{{ URL::asset('img/sliders/'. $item->img) }}'); background-size: cover; background-position: center;">
                                <div
                                    class="d-flex flex-wrap position-absolute bottom-0 z-2 px-2 px-md-3 align-items-center mb-5 pb-5">

                                    <div class="">
                                        <h1 class="text-white fw-bold">{{ $item->name }}</h1>
                                        <div class="text-white-80 fw-light mb-2 w-75 mb-4 d-none d-md-block">
                                            {!! $item->description !!}</div>
                                        <a href="#" class="white_btn border_radius_20 mb-4 px-5">Discover Now</a>
                                    </div>

                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach


        </div>
        <div class="swiper-pagination"></div>

    </div>
</section>


<section class="container px-4 px-md-5 pt-4 mb-4 mb-md-3 justify-content-center">

    <div class="d-flex justify-content-center flex-wrap">

        @foreach ($articles as $item)
        <div class="border_radius_20 article_hp me-0 me-md-3 mb-3 mb-md-0"
            style="background-image:url('{{ URL::asset('img/article/' . $item->main_img) }}'); background-size: cover;background-position: center;">
            <a href="{{ route('school_route.article_show', $item->slug) }}">
                <div class="position-absolute bottom-0 z-2 mb-4 px-4 text-shadow-200">
                    <p class="text-white-80 fw-light mb-0">Discover the world around you</p>
                    <h5 class="text-white fw-bold mb-0">{{ $item->name }}</h5>
                </div>
            </a>
        </div>
        @endforeach

    </div>

</section>



{{-- best package --}}
<section class="container pt-4 mb-4 mb-md-1">
    <div class="d-flex justify-content-between mb-0">

        <div class="mb-3">

            <h3 class="text-gray-800 fw-bold mb-0">
                Discover {{ $random_destination_units[0]->name }}
            </h3>
            <h6 class="text-gray-300 text-xs mb-1">
                Here is the top destinations in destino
            </h6>
        </div>

        <a
            href="{{ route('school_route.search_package', ['type=direct&search_hotel_input=' . $random_destination_units[0]->slug]) }}">
            <div class="border_black_btn border_radius_20 fw-normal"> Discover More
            </div>
        </a>
    </div>
</section>

<section class="container mb-2">
    <div class="swiper swiper_products">

        <div class="swiper-wrapper">
            @foreach ($best_unit_first as $item)
            @include('website.layouts.components.hotel_slider')
            @endforeach
        </div>

        <div class="swiper-pagination"></div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
</section>



{{-- best hotels around the world --}}
<section class="container pt-4 mb-4 mb-md-1">
    <div class="d-flex justify-content-between mb-0">

        <div class="mb-3">

            <h3 class="text-gray-800 fw-bold mb-0">
                Stay in {{ $random_destination_units[1]->name }}
            </h3>
            <h6 class="text-gray-300 text-xs mb-1">
                Here is the top destinations in destino
            </h6>
        </div>

        <a
            href="{{ route('school_route.unit_search', ['type=direct&search_hotel_input=' . $random_destination_units[1]->slug ]) }}">
            <div class="border_black_btn border_radius_20 fw-normal"> Discover More
            </div>
        </a>
    </div>
</section>

<section class="container mb-5">
    <div class="swiper swiper_products">

        <div class="swiper-wrapper">
            @foreach ($best_unit_second as $item)
            @include('website.layouts.components.hotel_slider')
            @endforeach
        </div>

        <div class="swiper-pagination"></div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
</section>



{{-- What our customer say ? --}}
<section class="pt-0 px-5 mb-0">
    <div class="row bg-white b-r-l-cont pb-5 pt-4 pb-md-0">
        <div class="col-12 col-md-7 px-5 align-self-center order-2 order-md-1">
            <h2 class="fw-light second-color-300 mb-2">
                What our <span class=" fw-bold">customer say?</span>
            </h2>
            <p class="fw-light text-gray-700">
                A Full Service Online Travel Agency Founded In 1989 Based In Egypt Which Provides Both Recreation And
                Corporate Partnership with more than 3000 customer in all over the world. we are more than a travel
                agency with a wonderful team waiting to help you.
            </p>

            <div class="rounded-pill py-2 px-4" style="background-color: #E6F1FA; width: fit-content;">
                <img class=" rounded-circle avatar-s" alt="destino_traveler"
                    src="{{ URL::asset('img/website/hp/reviews/avatar_1.jpg') }}">
                <img class="rounded-circle avatar-s" alt="destino_traveler"
                    src="{{ URL::asset('img/website/hp/reviews/avatar_2.jpg') }}" style=" margin-left: -14px;">
                <img class="rounded-circle avatar-s" alt="destino_traveler"
                    src="{{ URL::asset('img/website/hp/reviews/avatar_3.jpg') }}" style=" margin-left: -14px;">
                <img class="rounded-circle avatar-s" alt="destino_traveler"
                    src="{{ URL::asset('img/website/hp/reviews/avatar_4.jpg') }}" style=" margin-left: -14px;">
                <img class="rounded-circle avatar-s" alt="destino_traveler"
                    src="{{ URL::asset('img/website/hp/reviews/avatar_5.jpg') }}" style=" margin-left: -14px;">
                <img class="rounded-circle avatar-s" alt="destino_traveler"
                    src="{{ URL::asset('img/website/hp/reviews/avatar_6.jpg') }}" style=" margin-left: -14px;">
                <img class="rounded-circle avatar-s" alt="destino_traveler"
                    src="{{ URL::asset('img/website/hp/reviews/avatar_8.jpg') }}" style=" margin-left: -14px;">
                <a href="{{ route('school_route.register', 'register') }}" class="ms-2 text-black">
                    Join Our community <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>
        </div>

        <div class="col-12 col-md-5 order-1 order-md-2 mb-4 mb-md-0">

            <div class="swiper review_swiper pt-5 px-2 p-md-5">
                <div class="swiper-wrapper">

                    <div class="swiper-slide">

                        <div class="b-r-l-cont p-4 w-100"
                            style="background-color: #00182e !important; max-height: 260px;">
                            <div class="position-relative px-0 px-md-3 pt-4">
                                <img class="rounded-circle avatar-m position-absolute mx-auto client_review_img"
                                    alt="traveler_comment" src="{{ URL::asset('img/website/hp/reviews/avatar_8.jpg') }}"
                                    style="margin-top: -12px;">

                                <div class="d-flex justify-content-between">
                                    <div class="text-white me-2">
                                        <h4 class="fw-bold mb-0">Katende Phillip</h4>
                                        <p class="fw-light">USA</p>
                                    </div>
                                    <div class="align-items-center flex-wrap text-end">
                                        <div class="text-white ms-2 text-xs">
                                            <span><i class="fa-solid fa-star"></i></span>
                                            <span><i class="fa-solid fa-star"></i></span>
                                            <span><i class="fa-solid fa-star"></i></span>
                                            <span><i class="fa-solid fa-star"></i></span>
                                            <span><i class="fa-solid fa-star"></i></span>
                                        </div>
                                        <h3 class="fw-bold mb-0 text-white">4.5<small
                                                class="text-gray-500 fw-light text-s">/5</small>
                                        </h3>
                                    </div>
                                </div>
                                <p class=" text-gray-200">I have visited Egypt many times, and i alwyas go with Destino
                                    Tours. The team is super friendly and the prices are outstanding</p>
                            </div>
                        </div>
                    </div>


                    <div class="swiper-slide">

                        <div class="b-r-l-cont p-4 w-100"
                            style="background-color: #00182e !important; max-height: 260px;">
                            <div class="position-relative px-0 px-md-3 pt-4">
                                <img class="rounded-circle avatar-m position-absolute mx-auto client_review_img"
                                    src="{{ URL::asset('img/website/hp/reviews/avatar_7.jpg') }}" alt="traveler_comment"
                                    style="margin-top: -12px;">

                                <div class="d-flex justify-content-between">
                                    <div class="text-white me-2">
                                        <h4 class="fw-bold mb-0">Ahmed Hussen</h4>
                                        <p class="fw-light">Egypt</p>
                                    </div>
                                    <div class="align-items-center flex-wrap text-end">
                                        <div class="text-white ms-2 text-xs">
                                            <span><i class="fa-solid fa-star"></i></span>
                                            <span><i class="fa-solid fa-star"></i></span>
                                            <span><i class="fa-solid fa-star"></i></span>
                                            <span><i class="fa-solid fa-star"></i></span>
                                            <span><i class="fa-solid fa-star"></i></span>
                                        </div>
                                        <h3 class="fw-bold mb-0 text-white">4.5<small
                                                class="text-gray-500 fw-light text-s">/5</small>
                                        </h3>
                                    </div>
                                </div>
                                <p class=" text-gray-200">One of the best travel agency in egypt, i have tried many
                                    companies but destino is still the best when i am visiting to egypt</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="swiper-pagination"></div>
            </div>

        </div>
    </div>
</section>



@endsection

@section('js')
<script>
    var reviews = new Swiper(".review_swiper", {
        autoplay: {
            delay: 3500,
        },  
        loop: true,
        touchEventsTarget: 'container',
        effect: 'fade',
        fadeEffect: {
            crossFade: true
        },
    });


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
    

    var swiper = new Swiper(".hp_our_partners", {
      touchEventsTarget: 'container',
      loop: true,
      autoplay: {
            delay: 3000,
        },  
      slidesPerView: 2,
      spaceBetween: 15,
      breakpoints: {
        640: {
          slidesPerView: 2,
          spaceBetween: 20,
        },
        768: {
          slidesPerView: 4,
          spaceBetween: 40,
        },
        1024: {
          slidesPerView: 5,
          spaceBetween: 20,
        },
      },
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
    $(document).ready(function() {
    // Send Search Text to the server
    $("#search_hotel").keyup(function() {
        let search_query = $(this).val();
        if (search_query != "") {

            var url = "{{ route('school_route.destination_search', ':id') }}";
            url = url.replace(':id', search_query);

            $.ajax({
                url: url,
                type: "GET",
                dataType: "json",
                success: function(data) {
                    $("#search_cont_ht_destination").show();

                    if (data !== "") {
                        $("#search_no_result_ht_destination").hide();
                        $("#search_found_result_ht_destination").show();

                        var html = ''
                        $.each(data, function(key, value) {

                            var url_show =
                                "{{ route('sett.managers.show', ':id') }}";
                            url_show = url_show.replace(':id', value.id);

                            html += '<div data-id="' + value.name +
                                        '"  data-name="' + value.id +
                                        '"  class="search-eng-a text-end search_hotel_select list-group-item list-group-item-action border-0 text-gray-500" style="cursor: pointer;"><i class="fas fa-search text-gray-200 me-2"></i> ' +
                                        value.name + '</div>';
                        });
                        $('#search_found_result_ht_destination').html(
                        "<div class='text-end'><h6>Choose your destination</h6></div>" +    
                        html);
                    }

                    if (data == "") {
                        $("#search_no_result_ht_destination").show();
                        $("#search_found_result_ht_destination").hide();
                        // $('#search-eng-show-list').html(
                        //     '<a class="list-group-item list-group-item-action border-0"><i class="fas fa-search text-gray-200 me-2"></i>No Record</a>'
                        // );
                    }
                },
            });
        } else {
            $("#search_cont_ht_destination").hide();
            $("#search_found_result_ht_destination").empty();
        }
    });


    $(document).on('click', '.search_hotel_select', function() {

        var id = $(this).data('id');
        var name = $(this).data('name');

        $('#search_hotel').val(id);
        $('#search_hotel').val(id);

        $("#search_hotel").attr("placeholder", name);
        $("#search_cont_ht_destination").hide();
        $("#search_found_result_ht_destination").empty();

    })
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