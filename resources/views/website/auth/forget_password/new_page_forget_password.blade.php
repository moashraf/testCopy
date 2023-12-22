@extends('website.layouts.master', ['no_header' => true, 'no_footer' => true, 'no_transparent_header' => false])

@section('title', "استعادة كلمة المرور في منصة لام - استمتع بتجربة مجانية لمدة 14 يوم بدون دفع الاشتراك")
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
                        <a href="{{ route('school_route.forget_password') }}">
                            <div class="link-cust-text text-gray-400 fw-normal text-s mb-3">
                                الرجوع الي استعادة كلمة المرور
                                <i class="fa-solid fa-arrow-left ms-1"></i>
                            </div>
                        </a>
                    </div>

                    <div class="text-center mb-4">
                        <h3 class="fw-bold mb-2">استعادة كلمة المرور</h3>
                    </div>
                    <form id="myform" method="post" action="{{ route('school_route.new_page_forget_password_store') }}"
                        style="z-index: 5">
                        @csrf

                        <div class="row">
                            <div class="col-12 mb-2">
                                <div class="position-relative">
                                    <label class="form-label">كلمة المرور الجديدة
                                        <small
                                            class="fw-light @error('password') is-invalid @enderror">(مطلوب)</small></label>
                                    <input type="password" id="password" name="password"
                                        class="form-control password_input_show" placeholder="*********" minlength="7"
                                        required>
                                    <span class="fa fa-fw field-icon toggle-password fa-eye"></span>

                                    @error('password')
                                    <span class="error-msg-form">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                                @error('password')
                                <div class="error-msg-form mt-2">
                                    <i class="fas fa-times-circle"></i> {{ $message }}
                                </div>
                                @enderror
                            </div>


                            <div id="password_rules" class="mb-3" style="display: none">
                                <h6 class="text-gray-400 mb-2">يجب أن تحتوي كلمة المرور على :</h6>
                                <div class="row">
                                    <div class="col-6">
                                        <h6 class="text-s">
                                            <i class="fas fa-key text-red me-1" id="password_rules_minimum"></i>
                                            ثمانية أحرف على الأقل
                                        </h6>
                                    </div>
                                    <div class="col-6">
                                        <h6 class="text-s">
                                            <i class="fas fa-key text-red me-1" id="password_rules_numbers"></i>
                                            رقمين على الأقل
                                        </h6>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <h6 class="text-s">
                                            <i class="fas fa-key text-red me-1" id="password_rules_uppercase"></i>
                                            حرف كبير A
                                        </h6>
                                    </div>
                                    <div class="col-6">
                                        <h6 class="text-s">
                                            <i class="fas fa-key text-red me-1"
                                                id="password_rules_special_characters"></i>
                                            احد الرموز التالية @,#,$
                                        </h6>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 mb-4">
                                <div class="position-relative">
                                    <label class="form-label">اعادة كلمة المرور الجديدة
                                        <small
                                            class="fw-light @error('password_confirmation') is-invalid @enderror">(مطلوب)</small></label>
                                    <input type="password" name="password_confirmation"
                                        class="form-control password_input_show" placeholder="*********" minlength="7"
                                        required>
                                    <span class="fa fa-fw field-icon toggle-password fa-eye"></span>

                                    @error('password_confirmation')
                                    <span class="error-msg-form">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                                @error('password_confirmation')
                                <div class="error-msg-form mt-2">
                                    <i class="fas fa-times-circle"></i> {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="text-center mb-3">
                                <button type="button" id="send_form"
                                    class="main_btn border_radius_20 px-5 fw-bold w-100">تغيير كلمة
                                    المرور</button>
                            </div>

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
    $(document).on('click', '#send_form', function(e) {
        e.preventDefault();
        var check_pasword = password_validation();
        if(check_pasword == false){
            return false
        }else{
            $('#myform').submit();
        }
    })


    $(document).on('keyup', '#password', function() {
        password_validation();
    })


    function password_validation(e) {

        var password = $("#password").val();

        if (password.length >= 1 ) {
            $('#password_rules').show();
        }else{
            $('#password_rules').hide();
        }

        //length
        if (password.length >= 8 ) {
            $('#password_rules_minimum').removeClass('text-red').addClass('text-green');
        } else {
            $('#password_rules_minimum').removeClass('text-green').addClass('text-red');
            var status = false;
        }
        //letter
        // if ( password.match(/[A-z]/) ) {
        //      $('#password_rules_uppercase').addClass('text-green');
        // } else {
        //     $('#password_rules_uppercase').removeClass('text-green');
        // }

        // special_characters;
        var regex = /[^\w\s]/gi;
        if ( password.match(regex) ) {

            $('#password_rules_special_characters').removeClass('text-red').addClass('text-green');
        } else {
            $('#password_rules_special_characters').removeClass('text-green').addClass('text-red');
            var status = false;
        }

        //validate capital letter
        if ( password.match(/[A-Z]/) ) {
            $('#password_rules_uppercase').removeClass('text-red').addClass('text-green');
        } else {
            $('#password_rules_uppercase').removeClass('text-green').addClass('text-red');
            var status = false;
        }

        //validate number
        if ( password.match(/\d/) ) {
            $('#password_rules_numbers').removeClass('text-red').addClass('text-green');
        } else {
            $('#password_rules_numbers').removeClass('text-green').addClass('text-red');
            var status = false;
        }

        return status;
    };



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