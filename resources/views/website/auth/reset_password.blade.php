@extends('website.layouts.master', ['no_header' => true, 'no_footer' => true, 'no_transparent_header' => false])
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

<div class="login_page_cont"
    style="background-image: url('{{ URL::asset('img/website/other/modern-businessman-trying-his-new-car-automobile-salon1.png') }}');">


    <div class="login_page_side p-5">


        <div class="container pt-5" id="enter_otp_cont">


            <div id="info">

                <a href="{{ route('website_homepage') }}">
                    <div class=" border_black_btn border_radius_20 fw-normal text-s mb-3"> <i
                            class="fa-solid fa-arrow-left me-1"></i>
                        Go Back
                    </div>
                </a>

                <form id="myform" action="{{ route('school_route.store_new_password') }}" method="post">
                    @csrf

                    <input type="hidden" name="token" value="{{ $token }}">

                    <h5 class="fw-bold text-center">
                        Reset New Password
                    </h5>

                    @foreach ($errors->all() as $error)
                    <div class="text-red"><i class="fas fa-exclamation me-1"></i> {{ $error }}</div>
                    @endforeach


                    <div class="row">
                        <div class="col-12 mb-3">
                            <div class="position-relative">
                                <label class="form-label fs-6 fw-bold">Password
                                    <small class="fw-light">(Required)</small></label>
                                <input id="password" name="password" type="password"
                                    class="form-control password_input_show" placeholder="*********" minlength="7"
                                    maxlength="60" required>
                                <span class="fa fa-fw field-icon toggle-password fa-eye"></span>
                            </div>
                            @error('password')
                            <span class="error-msg-form">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>

                        <div id="password_rules" class="mb-3" style="display: none">
                            <h6 class="text-gray-400 mb-2">يجب أن تحتوي كلمة المرور على :</h6>
                            <div class="row">
                                <div class="col-5 me-3">
                                    <h6 class="text-s">
                                        <i class="fas fa-key text-red me-1" id="password_rules_minimum"></i>
                                        ثمانية أحرف على الأقل
                                    </h6>
                                </div>
                                <div class="col-5">
                                    <h6 class="text-s">
                                        <i class="fas fa-key text-red me-1" id="password_rules_numbers"></i>
                                        رقمين على الأقل
                                    </h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5 me-3">
                                    <h6 class="text-s">
                                        <i class="fas fa-key text-red me-1" id="password_rules_uppercase"></i>
                                        حرف كبير A
                                    </h6>
                                </div>
                                <div class="col-5">
                                    <h6 class="text-s">
                                        <i class="fas fa-key text-red me-1" id="password_rules_special_characters"></i>
                                        احد الرموز التالية @,#,$
                                    </h6>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 mb-3">
                            <div class="position-relative">
                                <label class="form-label fs-6 fw-bold">Confirm Password
                                    <small class="fw-light">(Required)</small></label>
                                <input id="password-confirm" name="password_confirmation" minlength="7" maxlength="60"
                                    type="password" class="form-control password_input_show" placeholder="*********"
                                    required>
                                <span class="fa fa-fw field-icon toggle-password fa-eye"></span>
                            </div>
                            @error('password_confirmation')
                            <span class="error-msg-form">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>

                        <div class="text-center mb-3">
                            <input type="button" id="send_form" name="next"
                                class="black_btn border_radius_20 px-5 fw-bold w-100" value="Update">
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
        if($check_pasword == false){
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
</script>
<!-- validate jquery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"
    integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    //Rules for the Validator plugin
    //Rules for the Validator plugin
    var $validator = $('#myform').validate({
        rules: {
            first_name: {
                minlength: 3
            , }
            , second_name: {
                minlength: 3
            , }
            , email: {
                email: true
            , }
            , password: {
                minlength: 7
                , maxlength: 100
            , }
            , password_confirmation: {
                minlength: 7
                , maxlength: 100
                , equalTo: '#password'
            , }
        , }
        , messages: {
            email: {
                required: "We need your email address to contact you"
                , email: "Your email address must be in the format of name@domain.com"
            }
            , password_confirmation: {
                equalTo: "Password does not match"
            , }
        },
        //for inserting erros for some inputs that makes posation problem such as selector 2 and bt datapicker
        errorPlacement: function(error, element) {
            switch (element.attr("name")) {
                case 'role':
                    error.insertAfter($("#role-js-error-valid"));
                    break;
                case 'first_branch_id':
                    error.insertAfter($("#first_branch_id-js-error-valid"));
                    break;
                case 'gendar':
                    error.insertAfter($("#gendar-js-error-valid"));
                    break;
                case 'birthday':
                    error.insertAfter($("#birthday-js-error-valid"));
                    break;
                case 'country':
                    error.insertAfter($("#country-js-error-valid"));
                    break;
                case 'city':
                    error.insertAfter($("#city-js-error-valid"));
                    break;
                case 'phone_number':
                    error.insertAfter($("#phonenumber-js-error-valid"));
                    break;
                case 'sec_phone_number':
                    error.insertAfter($("#secphonenumber-js-error-valid"));
                    break;

                default:
                    error.insertAfter(element);
            }

        }
    , });

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