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
                    style="background-image:url('{{ URL::asset('img/sliders/airlinehero.jpg') }}'); object-fit: cover; background-position: center center;">
                    <div class="text-shadow-200 px-5 full_height_width_slider_swiper_text">
                        <div class="px-0 pe-md-5">
                            <h3 class="text-white-80 fw-lighter mb-0 fs-5">Let's go somewhere</h3>
                            <h1 class="text-white text-xxl2 mb-0 fw-lighter">
                                Cheapst and Quickest <span class="fw-bold">Airline Tickets</span>
                            </h1>
                            <h3 class="text-white-80 fw-lighter">We provide the best price for the airline tickets</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</header>

<section class="bg-white pt-5 pb-5"
    style="border-radius: 20px 20px 20px 20px; position: relative; z-index: 1; top: -1rem;">
    <div class="container">
        @if (Session::has('success'))
        <div class="text-center">
            <img class="img-fluid ms-1" width="155px"
                src="{{ URL::asset('img/website/svg/undraw_confirmed_re_sef7.svg') }}" alt="">
            <p class="text-gray-300 mb-0">Thank you for using our service</p>
            <h5 class="fw-bold">
                Your request has been sent successfully
            </h5>
            <a href="{{ route('website_homepage') }}" class="link-cust-text text-gray-300 mb-0"> Discover the world now
                </p>

        </div>
        @else
        <form id="myform" class="myform" method="POST" action="{{ route('school_route.send_email_from') }}"
            enctype="multipart/form-data">
            @csrf

            <div class="row">

                <div class="col-12 col-md-6 align-self-center">
                    <div class="d-flex align-self-center justify-content-center mb-3">
                        <img class="img-fluid p-md-2 mb-2" width="300px"
                            src="{{ URL::asset('img/svg/undraw_mailbox_re_dvds.svg') }}" alt="">
                    </div>
                </div>

                <div class="col-12 col-md-6">

                    <div class="col-12 mb-3">
                        <label class="form-label fs-6 fw-bold">Phone Number
                            <small class="fw-light">(Required)</small></label>
                        <input name="phone_number" type="text" class="form-control"
                            placeholder="Write here your phone number" minlength="11" maxlength="11"
                            value="{{ old('phone_number') }}" required>
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
                            value="{{ old('email') }}" placeholder="Write here your Email">
                        @error('email')
                        <span class="error-msg-form">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="col-12 mb-3">
                        <label class="form-label">{{ __('basic.from') }}
                            <small>({{ __('basic.optional') }})</small></label>
                        <select
                            class="js-example-basic-single select2-hidden-accessible @error('from_destination_id') is-invalid @enderror"
                            name="from_destination_id" required>
                            @foreach ($destinations as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        <div id="from_destination_id-js-error-valid"></div>

                        @error('from_destination_id')
                        <span class="error-msg-form">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="col-12 mb-3">
                        <label class="form-label">{{ __('basic.to') }}
                            <small>({{ __('basic.optional') }})</small></label>
                        <select
                            class="js-example-basic-single select2-hidden-accessible @error('to_destination_id') is-invalid @enderror"
                            name="to_destination_id" required>
                            @foreach ($destinations as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        <div id="to_destination_id-js-error-valid"></div>

                        @error('to_destination_id')
                        <span class="error-msg-form">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="col-12 mb-3">
                        <label class="form-label fw-bold">{{ __('Traveling Date') }}
                            <small>({{ __('basic.optional') }})</small></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="bi bi-calendar2-week-fill"></i>
                                </div>
                            </div>

                            <input name="from_date" type="text"
                                class="form-control datepicker_time flatpickr-input valid" placeholder="Thu 16 Feb"
                                data-enable-time="true" required date-text="Thu 16 Feb" aria-invalid="false"
                                value="{{ old('from_date') }}">
                        </div>
                    </div>

                    <div class="col-12 mb-3">
                        <label class="form-label fw-bold">{{ __('Return Date') }}
                            <small>({{ __('basic.optional') }})</small></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="bi bi-calendar2-week-fill"></i>
                                </div>
                            </div>

                            <input name="to_date" type="text" class="form-control datepicker_time flatpickr-input valid"
                                placeholder="Thu 16 Feb" data-enable-time="true" required date-text="Thu 16 Feb"
                                aria-invalid="false" value="{{ old('to_date') }}">
                        </div>
                    </div>

                    <div class="col-12 mb-3">
                        <label class="form-label fs-6 fw-bold">Subject
                            <small class="fw-light">(Required)</small></label>
                        <input name="subject" type="text" class="form-control" placeholder="Write here your subject"
                            minlength="3" maxlength="100" value="{{ old('subject') }}" required>
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
                            maxlength="255" required>{{ old('content') }}</textarea>
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
        @endif



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