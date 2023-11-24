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
                            <h3 class="text-white-80 fw-lighter mb-0 fs-5">Do You have any question? </h3>
                            <h1 class="text-white text-xxl2 mb-0 fw-lighter">
                                <span class="fw-bold">Contact With Destino Tours Now</span>
                            </h1>
                            <h3 class="text-white-80 fw-lighter">We answer your request within 24h</h3>
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

        <form id="myform" class="myform" method="POST" action="{{ route('school_route.send_email_from') }}"
            enctype="multipart/form-data">
            @csrf

            <div class="row">

                <div class="col-12 col-md-6 align-self-center">
                    <div class="px-4">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d13810.216204891503!2d31.3120604!3d30.0783148!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14583fc1353df46b%3A0xe34f1a266888ba79!2sDestino%20Tours!5e0!3m2!1sar!2seg!4v1687084989311!5m2!1sar!2seg"
                            width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                        <ul class="no_dots_ul px-2">
                            <li class="mb-2"><i class="fas fa-map-marker-alt"></i> <a class="text-gray-500 fw-light"
                                    target="_blank"
                                    href="https://www.google.com/maps/place/Destino+Tours/@30.0783148,31.3120604,15z/data=!4m2!3m1!1s0x0:0xe34f1a266888ba79?sa=X&ved=2ahUKEwiimff6pJ3_AhWO_rsIHZhNAKkQ_BJ6BAhKEAg">
                                    10 El Obour Buildings., Salah Salem Rd., front of Al Moustafa Mosque, Cairo, Egypt
                                </a> </li>
                            <li class="mb-2"><i class="fas fa-headset"></i> <a class="text-gray-500 fw-light"
                                    href="tel:+201223344249" target="_blank">+201223344249</a> </li>
                            <li class="mb-2"><i class="fas fa-envelope"></i> <a class="text-gray-500 fw-light"
                                    href="mailto:info@destinotours.net" target="_blank">info@destinotours.net</a> </li>
                        </ul>
                    </div>

                </div>

                <div class="col-12 col-md-6">
                    <div class="col-12 mb-3">
                        <label class="form-label fs-6 fw-bold">Phone Number
                            <small class="fw-light">(Required)</small></label>
                        <input name="phone_number" type="text" class="form-control"
                            placeholder="Write here your phone number" minlength="11" maxlength="11" required>
                        @error('phone_number')
                        <span class="error-msg-form">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="col-12 mb-3">
                        <label class="form-label fs-6 fw-bold">Email
                            <small class="fw-light">(optional)</small></label>
                        <input name="email" type="email" class="form-control" minlength="9" maxlength="30"
                            placeholder="Write here your Email">
                        @error('email')
                        <span class="error-msg-form">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>


                    <div class="col-12 mb-3">
                        <label class="form-label fs-6 fw-bold">Subject
                            <small class="fw-light">(Required)</small></label>
                        <input name="subject" type="text" class="form-control" placeholder="Write here your subject"
                            minlength="3" maxlength="100" required>
                        @error('subject')
                        <span class="error-msg-form">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="col-12 mb-3">
                        <label class="form-label fs-6 fw-bold">Content
                            <small class="fw-light">(Required)</small></label>

                        <textarea id="note_insert" name="content" class="form-control border-0"
                            placeholder="Write here your content .." rows="4" spellcheck="false" minlength="5"
                            maxlength="255" required></textarea>
                        @error('content')
                        <span class="error-msg-form">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="text-center">
                        <button type="submit" class="black_btn border-0 border_radius_20 px-5 fw-bold w-100">Let's
                            Go</button>
                    </div>

                </div>
            </div>

        </form>
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