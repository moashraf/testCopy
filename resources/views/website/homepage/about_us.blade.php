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
                    style="background-image:url('{{ URL::asset('img/sliders/about_us.jpg') }}'); object-fit: cover; background-position: center center;">
                    <div class="text-shadow-200 px-5 full_height_width_slider_swiper_text">
                        <div class="px-0 pe-md-5">
                            <h3 class="text-white-80 fw-lighter mb-0 fs-5">We are more than a travel agency? </h3>
                            <h1 class="text-white text-xxl2 mb-0 fw-lighter">
                                <span class="fw-bold">Let's get know Destino Tours</span>
                            </h1>
                            <h3 class="text-white-80 fw-lighter">Discover us more</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</header>

<section class="bg-white pt-5 pb-5 mb-5"
    style="border-radius: 20px 20px 20px 20px; position: relative; z-index: 1; top: -1rem;">
    <div class="container">

        <div class="row px-5">
            <div class="col-12 col-md-4 text-center align-self-center mb-2">
                <h1 class="main-color fw-bold">Who We Are</h1>
                <div class="hr-land main-color-bg b-r-l-cont mx-auto" style="width: 64%;">
                </div>
            </div>
            <div class="col-12 col-md-8">
                <p>DESTINO TOURS IS A FULL SERVICE ONLINE TRAVEL AGENCY FOUNDED IN 1989 BASED IN EGYPT WHICH PROVIDES
                    BOTH
                    RECREATION AND CORPORATE PARTNERSHIP. IT'S A "ONE - STOP" ENTERPRISE WHICH OFFERS FULL TRAVEL
                    SERVICES.
                    OUR INSTITUTION IS AN EXPERIENCED EXPERT IN THE TRAVEL AND TOURISM FIELD AS IT WORKS TO PROVIDE THE
                    BEST
                    QUALITY SERVICES FOR OUR CLIENTS AND COMMUNITY.</p>
            </div>
        </div>

        <hr class=" text-gray-400">
        <div class="row px-5">
            <div class="col-12 col-md-4 text-center align-self-center mb-2">
                <h1 class="main-color fw-bold">THE BUSINESS</h1>
                <div class="hr-land main-color-bg b-r-l-cont mx-auto" style="width: 64%;">
                </div>
            </div>
            <div class="col-12 col-md-8">
                <p>OUR CORE BUSINESS IS PROVIDING VARIOUS TRAVEL AND TOURISM SERVICES THROUGH CUSTOMER'S ONLINE
                    PLATFORMS (B2B), AS WELL AS (B2C) SERVICES.
                    WE PROVIDE SEVERAL SERVICES STARTING FROM ACCOMMODATION TO FLIGHTS AND GROUND TRANSPORTATIONS, AND
                    CUSTOMIZED PACKAGES TO MATCH DIFFERENT CUSTOMER SEGMENTS TO SATISFY THEIR NEEDS.</p>
            </div>

        </div>

        <hr class="text-gray-400">
        <div class="row px-5">
            <div class="col-12 col-md-4 text-center align-self-center mb-2">
                <h1 class="main-color fw-bold">COMPANY VALUES</h1>
                <div class="hr-land main-color-bg b-r-l-cont mx-auto" style="width: 64%;">
                </div>
            </div>
            <div class="col-12 col-md-8">
                <div>
                    <h4 class="mb-0 text-gray-600 fw-bold"> <i class="fa-solid fa-check me-2 text-gray-300"></i>
                        SERVICES QUALITY</h4>
                    <p class=" text-gray-400">BY PUTTING ALL OUR EFFORT TO BE SUCCESSFUL IN PROVIDING THE BEST
                        SERVICE QUALITY.
                        WE CONDUCT OUR WORK WITHOUT MAKING MISTAKES BY STAYING FOCUSED ON TOTAL CUSTOMER
                        SATISFACTION.</p>
                </div>
                <div>
                    <h4 class="mb-0 text-gray-600 fw-bold"> <i
                            class="fa-solid fa-chart-line me-2 text-gray-300"></i>SERVICES QUALITY</h4>
                    <p class=" text-gray-400">BY PUTTING ALL OUR EFFORT TO BE SUCCESSFUL IN PROVIDING THE BEST SERVICE
                        QUALITY.
                        WE CONDUCT OUR WORK WITHOUT MAKING MISTAKES BY STAYING FOCUSED ON TOTAL CUSTOMER SATISFACTION.
                    </p>
                </div>
                <div>
                    <h4 class="mb-0 text-gray-600 fw-bold"> <i
                            class="fa-solid fa-lightbulb me-2 text-gray-300"></i>HONESTY AND TRUST</h4>
                    <p class=" text-gray-400">PROVIDING OUR CUSTOMERS HONEST AND TRUE INFORMATION IS OUR PRIORITY WHICH
                        MAKES US DIFFERENT.</p>
                </div>
            </div>
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