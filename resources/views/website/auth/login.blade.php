@extends('website.layouts.master', ['no_header' => true, 'no_footer' => true, 'no_transparent_header' => false])

@section('title', "تسجيل الدخول في منصة لام - استمتع بتجربة مجانية لمدة 14 يوم بدون دفع الاشتراك")
@section('description', "تسجيل الدخول في منصة لام - استمتع بتجربة مجانية لمدة 14 يوم بدون دفع الاشتراك")
@section('keywords', "نظام لام,نظام تعليمي شامل,افضل نظام للمدارس السعودية,نظام تعليمي سعودي,")

@section('css')


<!-- datepicker time and date -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.css"
    integrity="sha512-MQXduO8IQnJVq1qmySpN87QQkiR1bZHtorbJBD0tzy7/0U9+YIC93QWHeGTEoojMVHWWNkoCp8V6OzVSYrX0oQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/dark.css">

<!-- tdatepicker -->
<link rel="stylesheet" href="{{ asset('js/datepicker/t-datepicker.min.css') }}" />
<link rel="stylesheet" href="{{ asset('js/datepicker/themes/t-datepicker-main.css') }}" />

<link rel="stylesheet" href="{{ asset('js/datepicker/themes/t-datepicker-main.css') }}" />

<style>

</style>
@endsection


@section('content')

<div class="row login_page_cont mx-0">


    <div class="col-12 col-md-4 main-color-bg p-5 d-none d-md-block overflow-hidden">

        <div class="d-flex align-items-center h-100 position-relative">

            <img class="position-absolute z-0" width="500px" style="position: absolute;
            top: 50%;
            right: -95%;
            opacity: 0.03;
            transform: translate(-50%, -50%);" src="{{ URL::asset('img/website/logo/lam_logo_white.svg') }}" alt="">
            <div class="position-absolute z-1">
                <h3 class="text-white mb-3">إنشاء حساب <br>
                    لنظام الإدارة للمدارس</h3>
                <h6 class=" text-white-80 fw-light">يتم إضافة نص ترحيبي هنا، يتم إضافة نص ترحيبي هنا، يتم
                    إضافة نص ترحيبي هنا، يتم إضافة نص ترحيبي هنا</h6>
            </div>
        </div>




    </div>

    <div class="col-12 col-md-8 align-self-center">

        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-7 col-xl-6">

                <div class="bg-white b-r-l-cont shadow py-5 px-4 px-md-5 my-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="fw-bold"> اهلا بك في لام</h6>
                        <a href="{{ route('website_homepage') }}">
                            <div class="link-cust-text text-gray-400 fw-normal text-s mb-3">
                                الرجوع الي الرئيسية
                                <i class="fa-solid fa-arrow-left ms-1"></i>
                            </div>
                        </a>
                    </div>

                    <div class="text-center mb-4">
                        <h3 class="fw-bold mb-2">تسجيل الدخول</h3>
                    </div>
                    <form id="myform_register" method="post" action="{{ route('school_route.login_otp') }}"
                        style="z-index: 5">
                        @csrf

                        <div class="row">
                            <div class="col-12 mb-3">
                                <label class="form-label">رقم الجوال او البريد الالكتروني
                                    <small
                                        class="fw-light @error('phone_number') is-invalid @enderror">(مطلوب)</small></label>

                                <input id="phone_number" name="phone_number" type="text" class="form-control"
                                    placeholder="اكتب هنا رقم الجوال او البريد الالكتروني .."
                                    value="{{ old('phone_number') }}" minlength="5" maxlength="40" required>

                                <div id="phone_number-js-error-valid"></div>
                            </div>

                            <div class="col-12 mb-2">
                                <div class="position-relative">
                                    <label class="form-label">كلمة المرور
                                        <small
                                            class="fw-light @error('password') is-invalid @enderror">(مطلوب)</small></label>
                                    <input type="password" name="password" class="form-control password_input_show"
                                        placeholder="*********" minlength="7" required>
                                    <span class="fa fa-fw field-icon toggle-password fa-eye"></span>

                                    @error('password')
                                    <span class="error-msg-form">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                                @error('phone_number')
                                <div class="error-msg-form mt-2">
                                    <i class="fas fa-times-circle"></i> {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <div class="custom-control custom-checkbox small">
                                    <input type="checkbox" class="custom-control-input-user" name="remember"
                                        id="remember" id="customCheck" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="custom-control-label-user" for="remember">تذكرني</label>


                                </div>
                            </div>
                            <div class="text-center mb-3">
                                <button type="submit" class="main_btn border_radius_20 px-5 fw-bold w-100">تسجيل
                                    الدخول</button>
                            </div>
                            <h6 class="text-xs mb-3 text-center"><a class="text-gray-400 link-cust-text"
                                    href="{{ route('school_route.forget_password') }}">
                                    نسيت كلمة المرور</a>
                            </h6>
                            <h6 class="text-xs text-gray-400 mb-0 text-center">
                                ليس لديك حساب؟ <a class="main-color link-cust-text fw-bold"
                                    href="{{ route('school_route.register') }}"> أنشئ حساب</a>
                            </h6>
                        </div>

                    </form>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection


@section('js')


<script>
    $(function() {
    
  'use strict';

  var four_digit_sms = $('.four_digit_sms');

  function goToNextInput(e) {
    var key = e.which,
      t = $(e.target),
      sib = t.next('input');

    if (key != 9 && (key < 48 || key > 57)) {
      e.preventDefault();
      return false;
    }

    if (key === 9) {
      return true;
    }
    if (!sib || !sib.length) {
      sib = four_digit_sms.find('input').eq(0);
    }
    sib.select().focus();
  }

  function onKeyDown(e) {
    var key = e.which;

    if (key === 9 || (key >= 48 && key <= 57)) {
      return true;
    }

    e.preventDefault();
    return false;
  }
  
  function onFocus(e) {
    $(e.target).select();
  }

  four_digit_sms.on('keyup', 'input', goToNextInput);
  four_digit_sms.on('keydown', 'input', onKeyDown);
  four_digit_sms.on('click', 'input', onFocus);

})
</script>

<script>
    //Rules for the Validator plugin
    var $validator = $('#myform_register').validate({
        rules: {
            first_name: {
                maxlength: 60,
            },
            name_street: {
                maxlength: 50,
            },
            address_details: {
                maxlength: 50,
            },
            building_number: {
                maxlength: 50,
            },
            apartment_number: {
                maxlength: 50,
            },
            phone: {
                maxlength: 50,
            },

        },

        //for inserting erros for some inputs that makes posation problem such as selector 2 and bt datapicker
        errorPlacement: function(error, element) {
            switch (element.attr("name")) {
                case 'phone_number':
                    error.insertAfter($("#phone_number-js-error-valid"));
                    break;
                case 'digit_4':
                error.insertAfter($("#digit_4-js-error-valid"));
                break;
                case 'digit_3':
                error.insertAfter($("#digit_3-js-error-valid"));
                break;
                case 'digit_2':
                error.insertAfter($("#digit_2-js-error-valid"));
                break;
                case 'digit_1':
                error.insertAfter($("#digit_1-js-error-valid"));
                break;
                default:
                    error.insertAfter(element);
            }

            
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
    var full_height_width_slider_swiper = new Swiper(".full_height_width_slider_swiper", {
    pagination: {
        el: ".swiper-pagination",
    },
});

var swiper = new Swiper(".to_do_desti_swiper", {
    slidesPerView: "auto",
    loop: true,
    touchEventsTarget: 'container',
    slidesPerView: "auto",
    touchEventsTarget: 'container',
    spaceBetween: 10,
    loop: true,

});
</script>


<script src="{{ asset('js/datepicker/t-datepicker.min.js') }}"></script>


<script>
    $('.t-datepicker').tDatePicker({
    autoClose: true,
    durationArrowTop: 200,
    numCalendar: 2,
});


$(".toggle-password").click(function() {
    $(this).toggleClass("fa-eye fa-eye-slash");
    var input = $(this).parent().find( ".password_input_show");
    
    if (input.attr("type") == "password") {
    input.attr("type", "text");
    } else {
    input.attr("type", "password");
    }
});
</script>

@endsection