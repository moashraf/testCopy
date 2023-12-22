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
                        <a href="{{ route('school_route.login') }}">
                            <div class="link-cust-text text-gray-400 fw-normal text-s">
                                رجوع
                                <i class="fa-solid fa-arrow-left ms-1"></i>
                            </div>
                        </a>
                    </div>

                    <div class="text-center mb-4">
                        <h3 class="fw-bold mb-4">رمز التحقق</h3>
                        <h6 class="text-gray-400 fw-light">قم بإدخال رمز التحقق الذي تم إرساله إلى رقم الجوال </h6>
                        <h6 class="text-gray-400 fw-light">{{ $short_phone_number }} **** ***</h6>
                    </div>
                    <form id="myform_register" method="post" action="{{ route('school_route.login_sub') }}"
                        style="z-index: 5">
                        @csrf

                        <div class="row">
                            <div class="col-12 mb-3 px-0 text-center">
                                <div class="d-flex flex-wrap flex-md-nowrap four_digit_sms justify-content-center mb-2">
                                    <input name="digit_1" class="form-control" type="text" maxLength="1" size="1"
                                        min="0" max="9" pattern="[0-9]{1}" required />
                                    <input name="digit_2" class="form-control" type="text" maxLength="1" size="1"
                                        min="0" max="9" pattern="[0-9]{1}" required />
                                    <input name="digit_3" class="form-control" type="text" maxLength="1" size="1"
                                        min="0" max="9" pattern="[0-9]{1}" required />
                                    <input name="digit_4" class="form-control" type="text" maxLength="1" size="1"
                                        min="0" max="9" pattern="[0-9]{1}" required />
                                </div>
                                <div id="otp_verify_msg"></div>
                                <div id="digit_4-js-error-valid" class="text-center"></div>
                                {{-- <div id="digit_4-js-error-valid"></div>
                                <div id="digit_3-js-error-valid"></div>
                                <div id="digit_2-js-error-valid"></div>
                                <div id="digit_1-js-error-valid"></div> --}}
                            </div>

                            <div id="otp_resend" class="text-center mb-3">
                                <h6 class="text-gray-400">اذا لم يصلك كود التفعيل يمكنك ارسال كود اخر خلال <span
                                        class="fw-bold text-gray-700" id="otp_resend_seconds">{{ $diff_seconds }}</span>
                                    ثانية</h6>
                            </div>

                            <div class="text-center">
                                <button type="button" id="otp_btn" data-resend="false"
                                    class="main_btn border_radius_20 px-5 fw-bold w-100">تحقق
                                    الان</button>
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


<script>
    var maxTicks = {{ $diff_seconds }};
    var tickCount = 0;
    
    setInterval(function(){
        if (tickCount >= maxTicks)
        {
            // Stops the interval.
            // clearInterval(myInterval);
            // return;
        }
        /* The particular code you want to excute on each tick */
        $("#otp_resend_seconds").html(maxTicks - tickCount);
        tickCount++;
    }, 1000);

    var delay = {{ $diff_seconds }} + "000"; 
    setTimeout(function(){  
        $('#otp_resend').html(
            '<h6 class="text-gray-400">اذا لم يصلك كود التفعيل <span class="fw-bold text-gray-700 clickable-item-pointer text-decoration-underline" id="otp_btn" data-type="resend">اضغط هنا لارسال الكود مرة اخري </span></h6>'
        ) 
        $('#otp_btn').html('اعادة ارسال الكود');
        $('#otp_btn').attr('data-resend', true);
    }, delay);


    //otp confirm
    $(document).on('click', "#otp_btn", function(e) {
    e.preventDefault();

        var resend = $(this).data("resend");

        console.log(resend);
        if(resend !== true){
            if (!$('#myform_register').valid()) {
                return false;
            }   
        }

        //run vlidation plugin
        var digit_1 = $("input[name='digit_1']").val();
        var digit_2 = $("input[name='digit_2']").val();
        var digit_3 = $("input[name='digit_3']").val();
        var digit_4 = $("input[name='digit_4']").val();
        var digits = digit_1 + digit_2 + digit_3 + digit_4;

        var url = "{{ route('school_route.check_otp_login') }}";

        //add spinner to button
        $('#otp_btn').html(
            '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> جاري الارسال '
        );

        that = $(this);

        $.ajax({
            url: url
            , type: 'POST'
            , dataType: "json"
            , data: {
                '_token': "{{ csrf_token() }}"
                , 'digits': digits
                , 'resend': resend
            , }
            , success: function(data) {

                if (data.status === "resend") {
                   
                    toastr.success(data.msg);

                    var diff_seconds = data.diff_seconds;

                    $("#enter_otp_cont").hide();
                    $("#correct_opt_cont").show();

                    $('#otp_btn').prop("disabled", false);
                    $('#otp_btn').html('التفعيل');

                    $('#otp_resend').html(
                        '<h6 class="text-gray-400">اذا لم يصلك كود التفعيل يمكنك ارسال كود اخر خلال <span class="fw-bold text-gray-700" id="otp_resend_seconds">' + diff_seconds + '</span> ثانية</h6>'
                    )
                                        
                    // Start calling timer function every 1 second.
                    var tickCount = 0;

                    myInterval = setInterval(function(){
                        if (tickCount >= diff_seconds)
                        {
                            // Stops the interval.
                            // clearInterval(myInterval);
                            // return;
                        }
                        $("#otp_resend_seconds").html(diff_seconds - tickCount);
                        tickCount++;
                    }, 1000);

                    // clearInterval(myInterval);
                    
                    // Your delay in milliseconds
                    var delay = diff_seconds + "000"; 
                    setTimeout(function(){  
                    $('#otp_resend').html(
                        '<h6 class="text-gray-400">اذا لم يصلك كود التفعيل <span class="fw-bold text-gray-700 clickable-item-pointer text-decoration-underline" id="otp_btn" data-resend="true">اضغط هنا لارسال الكود مرة اخري </span></h6>'
                    ) }, delay);
                
                } 
                else if (data.status === "done") {
                    toastr.success(data.msg);
                    
                    var url = data.url;

                    $('#otp_resend').html(
                        '<h6 class="text-green"><i class="fas fa-check-circle"></i> تم التحقق بنجاح <a class="fw-bold text-gray-500" href="' + url + '"> اضغط هنا اذا لم يتم انتقالك اليا</a></h6>'
                    )
                    
                    window.location.href = url;
                }
                else {
                    $('#otp_btn').html('التحقق الان');
                    toastr.error(data.msg);
                }
            }
            , error: function(err) {
                $(".error_ajax_msg").remove();

                // remove spinner to button
                $('#otp_btn').html('التحقق الان');

                toastr.error(err.responseJSON.message);
                //show error message after the input and in toaster
                $.each(err.responseJSON.errors, function (input_name, error) {
                        var el = $(document).find('[name="'+input_name+'"]');
                        el.after($('<div class="error_ajax_msg" style="color: red;">'+error[0]+'</div>'));
                        toastr.error(error[0]);
                });

            }
        , });

    });

</script>

@endsection