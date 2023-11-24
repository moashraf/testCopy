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
        <div class="swiper full_height_width_slider_swiper_color">
            <div class="swiper-wrapper">
                <div class="swiper-slide"
                    style="background-image:url('{{ URL::asset('img/sliders/articlehero.jpg') }}'); object-fit: cover; background-position: center center;">
                    <div class="text-shadow-200 px-5 full_height_width_slider_swiper_text">
                        <div class="px-0 pe-md-5">
                            <h3 class="text-white-80 fw-lighter mb-0 fs-5">Let's go somewhere</h3>
                            <h1 class="text-white text-xxl2 mb-0 fw-lighter">
                                Get <span class="fw-bold">Inspiration</span>
                            </h1>
                            <h3 class="text-white-80 fw-lighter">We know what's the best things to do in the whole world
                            </h3>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</header>

<section class="bg-white pt-5 pb-3  mb-4"
    style="border-radius: 20px 20px 20px 20px; position: relative; z-index: 1; top: -1rem;">
    <div class="container">


        <div class="d-flex justify-content-between mb-0">

            <div class="mb-3">

                <h3 class="text-gray-800 fw-bold mb-0">
                    Discover more about the world
                </h3>
                <h6 class="text-gray-300 text-s mb-1">
                    Here is our list of articles
                </h6>
            </div>
        </div>


        <div class="row">

            @foreach ($articles as $item)
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
                                @if($item->destination->slug)
                                <a href="{{ route('school_route.show_destination', $item->destination->slug) }}">
                                    <div class="d-flex text-gray-400 ">
                                        <i class="fa-solid fa-location-dot me-2"></i> <span>
                                            {{ $item->destination->name }}</span>
                                    </div>
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            @endforeach

        </div>
        <div class="d-flex mt-2 justify-content-end">
            {{ $articles->appends(request()->input())->links() }}
        </div>

    </div>
</section>



@endsection
@section('js')
<script>
    var full_height_width_slider_swiper = new Swiper(".full_height_width_slider_swiper", {
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