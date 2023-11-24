@extends('website.layouts.master', ['no_header' => true, 'no_footer' => true, 'no_transparent_header' => false])

@section('title', "انشاء حساب جديد في نظام لام - استمتع بتجربة مجانية لمدة 14 يوم بدون دفع الاشتراك")
@section('description', "انشاء حساب جديد في نظام لام - استمتع بتجربة مجانية لمدة 14 يوم بدون دفع الاشتراك")
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
            <div class="col-12 col-md-10 col-lg-7 col-xl-6 px-0">

                <div class="bg-white b-r-l-cont shadow py-5 px-4 px-md-5 my-4">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h6 class="fw-bold"> اهلا بك في لام</h6>
                        <a href="{{ route('website_homepage') }}">
                            <div class="link-cust-text text-gray-400 fw-normal text-s mb-3">
                                الرجوع الي الرئيسية
                                <i class="fa-solid fa-arrow-left ms-1"></i>
                            </div>
                        </a>
                    </div>

                    <div class="text-center">
                        <h3 class="fw-bold mb-2">إنشاء حساب</h3>
                        <h6 class="text-gray-400 fw-light">استمتع بتجربة مجانية لمدة 14 يوم بدون دفع الاشتراك</h6>
                    </div>
                    <form id="myform_register" method="post" action="{{ route('school_route.register_store') }}"
                        style="z-index: 5">
                        @csrf
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label class="form-label">الاسم
                                    <small class="fw-light">(مطلوب)</small></label>
                                <input name="first_name" type="text"
                                    class="form-control @error('first_name') is-invalid @enderror"
                                    placeholder="اكتب هنا الاسم .." autofocus minlength="3"
                                    value="{{ old('first_name') }}" required>

                                @error('first_name')
                                <span class="error-msg-form">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label">البريد الالكتروني
                                    <small class="fw-light @error('email') is-invalid @enderror">(مطلوب)</small></label>
                                <input name="email" type="email" class="form-control"
                                    placeholder="اكتب هنا البريد الالكتروني .." value="{{ old('email') }}" required>
                                @error('email')
                                <span class="error-msg-form">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>

                            <div class="col-12 mb-3">
                                <label class="form-label">رقم الجوال
                                    <small
                                        class="fw-light @error('phone_number') is-invalid @enderror">(مطلوب)</small></label>

                                <div class="position-relative">
                                    <input id="phone_number" name="phone_number" type="number" class="form-control"
                                        style="padding-left: 81px !important;" placeholder="اكتب هنا رقم الجوال .."
                                        value="{{ old('phone_number') }}" minlength="11" maxlength="11" required>
                                    <div class=" position-absolute top-0 end-0">
                                        <div class="input-group-text">966+
                                        </div>
                                    </div>
                                </div>

                                <div id="phone_number-js-error-valid"></div>
                                @error('phone_number')
                                <span class="error-msg-form">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>

                            <div class="col-12 mb-0 px-0">
                                <div class="d-flex flex-wrap flex-md-nowrap four_digit_sms justify-content-center mb-2">

                                    <button id="otp_btn" disabled
                                        class="disabled_btn text-xs border_radius_10 py-3 fw-bold w-100 mt-1 ms-2 mb-2 mb-md-0"
                                        style="height: 56px;">تحقق الان</button>

                                    <input name="digit_1" class="form-control digit_check" type="text" maxLength="1"
                                        size="1" min="0" max="9" pattern="[0-9]{1}" required readonly />
                                    <input name="digit_2" class="form-control digit_check" type="text" maxLength="1"
                                        size="1" min="0" max="9" pattern="[0-9]{1}" required readonly />
                                    <input name="digit_3" class="form-control digit_check" type="text" maxLength="1"
                                        size="1" min="0" max="9" pattern="[0-9]{1}" required readonly />
                                    <input name="digit_4" id="digit_4" class="form-control digit_check" type="text"
                                        maxLength="1" size="1" min="0" max="9" pattern="[0-9]{1}" required readonly />

                                </div>
                                <div id="otp_verify_msg"></div>
                                <div id="otp_resend"></div>
                                {{-- <div id="digit_4-js-error-valid"></div>
                                <div id="digit_3-js-error-valid"></div>
                                <div id="digit_2-js-error-valid"></div>
                                <div id="digit_1-js-error-valid"></div> --}}
                            </div>
                            <div class="col-12 mb-4">
                                <div class="position-relative">
                                    <label class="form-label">كلمة المرور
                                        <small
                                            class="fw-light @error('passworc') is-invalid @enderror">(مطلوب)</small></label>
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

                            <h6 class="text-xs mb-3 text-gray-500">بمجرد انشاءك حسابك في منصة لام فانت توافق علي <span
                                    class="main-color link-cust-text clickable-item-pointer fw-bold"
                                    data-bs-toggle="modal" data-bs-target="#rules_modal"> الشروط والاحكام</span></h6>

                            <div class="text-center mb-3">
                                <button type="button" id="form_submit"
                                    class="main_btn border_radius_20 px-5 fw-bold w-100">تسجيل
                                    الدخول</button>
                            </div>

                            <h6 class="text-xs text-gray-400 mb-0 text-center">
                                هل لديك حساب؟ <a class="main-color link-cust-text clickable-item-pointer fw-bold"
                                    href="{{ route('school_route.login') }}"> تسجيل
                                    الدخول </a>
                            </h6>

                        </div>

                    </form>
                </div>
            </div>
        </div>

    </div>

</div>



<!-- Modal for search filtering -->
<div class="modal fade" id="rules_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">

        <div class="modal-content b-r-s-cont border-0">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="exampleModalLabel">
                    الشروط والأحكام
                </h5>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
            </div>

            <!-- Modal content -->
            <div class="modal-body px-5 py-3">

                <p class="fs-6 text-gray-400">
                    نأخذ على محمل الجد خصوصية زوار موقعنا الإلكتروني وأمن أية معلومات شخصية قد يقدمها زوار الموقع. ونؤمن
                    بحقك في معرفة نوع المعلومات التي
                    يجمعها الموقع، وكيف يتم حمايتها واستخدامها، وتحت أية ظروف يتم الكشف عنها. ولهذا أعددنا سياسة
                    الخصوصية هذه ونشرناها على موقعنا لكي
                    تساعدكم في فهم طبيعة البيانات التي نقوم بتجميعها عنكم عند زيارتكم لموقعنا على شبكة الإنترنت وكيفية
                    تعاملنا مع هذه البيانات. تصفح الموقع
                    لا يهدف هذا الموقع إلى جمع بياناتك الشخصية أثناء تصفحك للموقع، وإنما سيتم فقط استخدام البيانات
                    المقدمة من قبلك بمعرفتك ومحض إرادتك.
                    <br>
                    <br>
                    المعلومات التي يتم جمعها وكيفية الحصول عليها واستخدامها المعلومات الشخصية
                    تنطبق هذه السياسة على جميع المعلومات التي يتم جمعها أو المقدمة على موقعنا الإلكتروني. يمكن لزوار
                    الموقع تصفحه والحصول على المعلومات التي
                    يبحثون عنها والاشتراك في مختلف الأدوات والبرامج التي يقدمها الموقع وتلقي الرسائل الإلكترونية وتحميل
                    المواد بشكل مجاني. خلال هذه العمليات، لا
                    نقوم بجمع سوى المعلومات الشخصية المقدمة طوعاً من قبل المتصفح لهذا الموقع، وقد يشمل ذلك، ولكن ليس على
                    سبيل الحصر، الاسم وعنوان البريد
                    الإلكتروني، ومعلومات الاتصال، وأية بيانات أو تفاصيل ديموغرافية أخرى. نحن لا نشارك المعلومات الشخصية
                    التي تقدمها من خلال موقعنا على شبكة
                    الإنترنت مع أية مؤسسة أو شركة أو حكومة أو وكالة حكومية أو أي نوع من المنظمات الأخرى. ونلتزم في الكشف
                    عن المعلومات الشخصية في حالات
                    استثنائية حسب قانون البلد الذي نعمل فيه. نستخدم المعلومات التي يقدمها متصفح الموقع طوعاً لتقديم عدة
                    خدمات مثل النشرات الإخبارية عن طريق
                    البريد الإلكتروني، ودعوات للندوات والمؤتمرات، أو تنبيهات حول برامج أو أنشطة أو مواد ننشرها على
                    موقعنا.
                    <br>
                    <br>

                    لن يتم استخدام معلوماتك لأية أغراض تجارية أبداً، ولن نقوم ببيع، المتاجرة، تأجير، أو إفشاء أية من
                    معلوماتك لمصلحة أي طرف ثالث خارج هذا الموقع، أو
                    المواقع التابعة له، وسيتم الكشف عن المعلومات فقط في حالة صدور أمر بذلك من قبل سلطة قضائية أو تنظيمية
                    في البلد الذي نعمل فيه.معلومات
                    استخدام الموقع
                    عندما يقوم زائر الموقع بتصفح مواده أو تحميلها فإنه يتم جمع معلومات عامة عن هذه الزيارة. على سبيل
                    المثال، قد يسجل المخدم (server) عنوان
                    بروتوكول الإنترنت IP لجهاز الكمبيوتر الخاص بك، وقد يسجل معلومات عن المتصفح الذي تستخدمه ونظام
                    التشغيل، وتاريخ ووقت الزيارة، وعناوين
                    الإنترنت والصفحات التي يتم تصفحها أثناء الزيارة. وإذا كنت تبحث في الموقع، قد يتم تسجيل طلبات البحث
                    التي تقوم بها. نستخدم هذه المعلومات لقياس
                    عدد زوار الموقع إلى أقسامه المختلفة، ونستفيد منها في تشخيص أخطاء الموقع وتصحيحها، وإجراء الأبحاث
                    بهدف تحسين خدمة المعلومات، وميزات
                    وسهولة الاستخدام للموقع.
                </p>

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
            password: {
                required: true,
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

<script>
    $(document).on('keyup', "#phone_number", function(e) {

        var phone_number = $(this).val().length;

        if(phone_number == 11){
            $('#otp_btn').removeClass('disabled_btn');
            $('#otp_btn').addClass('main_btn');
            $('#otp_btn').prop("disabled", false);
        }else{
            $('#otp_btn').removeClass('main_btn');
            $('#otp_btn').addClass('disabled_btn');
            $('#otp_btn').prop("disabled", true);

        }

    });

    var maxTicks = 120;
    var tickCount = 0;

    var timer = function()
    {
        if (tickCount >= maxTicks)
        {
            // Stops the interval.
            clearInterval(myInterval);
            return;
        }
    
        /* The particular code you want to excute on each tick */
        $("#otp_resend_seconds").html(maxTicks - tickCount);
        tickCount++;
    };
    
    $(document).on('click', "#form_submit", function(e) {

        if (!$('#myform_register').valid()) {
            return false;
        }

        var password_validation_check = password_validation();
        if (password_validation_check == false) {
            return false;
        }

        var status = $('#otp_btn').data('verified');

        if(status == true){
            $("#myform_register").submit();
        }else{
            $("#otp_verify_msg").html('<h6 class="text-red"><i class="fas fa-times-circle"></i> يجب عليك ضغط زر التفعيل</h6>')
        }
        
    });

    //otp confirm
    
    $(document).on('click', "#otp_btn", function(e) {
        e.preventDefault();
        check_otp();
    })

    $(document).on('keyup', '#digit_4', function() {
        var credit = $('.digit_check');
        $.each(credit, function(key, value) {
            if(!this.value){
                return false
            }
        });
        check_otp();
    });

    function check_otp() {
        var phone_number = $("#phone_number").val();

        //run vlidation plugin
        var digit_1 = $("input[name='digit_1']").val();
        var digit_2 = $("input[name='digit_2']").val();
        var digit_3 = $("input[name='digit_3']").val();
        var digit_4 = $("input[name='digit_4']").val();
        var digits = digit_1 + digit_2 + digit_3 + digit_4;

        var type = $(this).data("type");

        if(type === "resend"){
            var digits = "";  
        }

        if(!digit_4){
            $(this).prop("disabled", true);
            //add spinner to button
            $('#otp_btn').html(
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> جاري الارسال '
            );
        }
    

        var url = "{{ route('school_route.check_otp') }}";

      

        that = $(this);

        $.ajax({
            url: url
            , type: 'POST'
            , dataType: "json"
            , data: {
                '_token': "{{ csrf_token() }}"
                , 'phone_number': phone_number
                , 'digits': digits
            , }
            , success: function(data) {
                if (data.status == true) {
                    // disable inputs
                    $("input[name='digit_1']").prop('readonly', false);
                    $("input[name='digit_2']").prop('readonly', false);
                    $("input[name='digit_3']").prop('readonly', false);
                    $("input[name='digit_4']").prop('readonly', false);
                    // otp btn
                    $('#otp_btn').removeClass('disabled_btn');
                    $('#otp_btn').addClass('main_btn');
                    toastr.success(data.msg);

                    var diff_seconds = data.diff_seconds;

                    $("#enter_otp_cont").hide();
                    $("#correct_opt_cont").show();

                    $('#otp_btn').prop("disabled", false);

                    if(diff_seconds > 0){
                        $('#otp_btn').html(
                            '<h6 class="text-gray-400">ثانية <span class="fw-bold text-white" id="otp_resend_seconds">' + diff_seconds + '</span></h6>'
                        )
                    }else{
                        $('#otp_btn').html(
                            '<h6 class="text-gray-400">اعادة الارسال</h6>'
                        )
                    }
                   
                                        
                    // Start calling timer function every 1 second.
                                    
                    var tickCount = 0;

                    myInterval = setInterval(function(){
                        if (tickCount >= diff_seconds)
                        {
                            // Stops the interval.
                            clearInterval(myInterval);
                            return;
                        }
                        $("#otp_resend_seconds").html(diff_seconds - tickCount);
                        tickCount++;
                    }, 1000);

                    // clearInterval(myInterval);
                    
                    // Your delay in milliseconds
                    var delay = diff_seconds + "000"; 
                    setTimeout(function(){  
                    $('#otp_resend').html(
                        '<h6 class="text-gray-400">اذا لم يصلك كود التفعيل <span class="fw-bold text-gray-700 clickable-item-pointer text-decoration-underline" id="otp_btn" data-type="resend">اضغط هنا لارسال الكود مرة اخري </span></h6>'
                    ) }, delay);
                
                } 
                else if(data.status === "done"){
                      // disable inputs
                    $("input[name='digit_1']").prop('readonly', true);
                    $("input[name='digit_2']").prop('readonly', true);
                    $("input[name='digit_3']").prop('readonly', true);
                    $("input[name='digit_4']").prop('readonly', true);
                    $('#otp_btn').prop("disabled", true);
                    $('#otp_btn').html('تم التفعيل <i class="fas fa-check-circle"></i>');
                    toastr.success(data.msg);

                    $('#otp_resend').html('')
                    $('#otp_btn').removeClass('main_btn');
                    $('#otp_btn').addClass('disabled_btn');
                    $('#otp_btn').attr('data-verified', true);   
                    $('#phone_number').prop("readonly", true);
                    $('#otp_resend').html(
                        '<h6 class="text-green"><i class="fas fa-check-circle"></i> تم التفعيل بنجاح</h6>'
                    )
                    $('#otp_verify_msg').html('')
                }
                else {
                    $('#otp_btn').prop("disabled", false);
                    toastr.error(data.msg);
                }
            }
            , error: function(err) {
                $("input[name='digit_1']").prop('disabled', true);
                $("input[name='digit_2']").prop('disabled', true);
                $("input[name='digit_3']").prop('disabled', true);
                $("input[name='digit_4']").prop('disabled', true);

                $(".error_ajax_msg").remove();

                // remove spinner to button
                $('#otp_btn').prop("disabled", false);
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

    };


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
    


</script>
@endsection