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

                {{-- 4 digits sms --}}
                <div class="text-center my-5">
                    <h5 class="fw-bold">
                        Write here the 4 digits
                    </h5>
                    <p class="text-gray-800 mb-0">We have sent an sms and email to your account</p>
                    <p class="text-gray-400">Please look at spam email</p>

                    <div class="d-flex four_digit_sms justify-content-center mb-3">
                        <input name="digit_1" class="form-control" type="text" maxLength="1" size="1" min="0" max="9"
                            pattern="[0-9]{1}" />
                        <input name="digit_2" class="form-control" type="text" maxLength="1" size="1" min="0" max="9"
                            pattern="[0-9]{1}" />
                        <input name="digit_3" class="form-control" type="text" maxLength="1" size="1" min="0" max="9"
                            pattern="[0-9]{1}" />
                        <input name="digit_4" class="form-control" type="text" maxLength="1" size="1" min="0" max="9"
                            pattern="[0-9]{1}" />
                    </div>

                    <div class="text-center">
                        <button id="otp_send" class="black_btn border_radius_20 px-5 fw-bold w-100">Send</button>
                    </div>
                </div>

            </div>

        </div>

        {{-- confirmation --}}
        <div class="text-center my-5" id="correct_opt_cont" style="display: none">
            <img class="img-fluid ms-1" width="155px" src="{{ URL::asset('img/website/svg/success.svg') }}" alt="">
            <p class="text-gray-300 mb-0"> Welcome to Destino Tours</p>
            <h5 class="fw-bold">
                Your account is now actived
            </h5>
            <a href="{{ route('website_homepage') }}" class="link-cust-text text-gray-300 mb-0"> Click here if you are
                not redirected
                automatically</p>

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
    var $validator = $('#myform_2').validate({
        rules: {
            favorite_address: {
                maxlength: 50,
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
                case 'permissions':
                    error.insertAfter($("#permissions-js-error-valid"));
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
    numCalendar: 2
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


<script>
    //otp confirm
        $(document).on('click', "#otp_send", function(e) {
        e.preventDefault();

        //run vlidation plugin
        var digit_1 = $("input[name='digit_1']").val();
        var digit_2 = $("input[name='digit_2']").val();
        var digit_3 = $("input[name='digit_3']").val();
        var digit_4 = $("input[name='digit_4']").val();

        var digits = digit_1 + digit_2 + digit_3 + digit_4;

        var url = "{{ route('school_route.check_otp') }}";

        $(this).prop("disabled", true);
        // add spinner to button
        $(this).html(
            '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...'
        );

        $.ajax({
            url: url
            , type: 'POST'
            , dataType: "json"
            , data: {
                '_token': "{{ csrf_token() }}"
                , 'digits': digits
            , }
            , success: function(data) {
                if (data.status == true) {
                    toastr.success(data.msg);

                    $("#enter_otp_cont").hide();
                    $("#correct_opt_cont").show();

                    // Your delay in milliseconds
                    var delay = 5000; 
                    setTimeout(function(){ $(location).attr('href', data.url); }, delay);
                    
                } else {
                    $("#otp_send").prop("disabled", false);
                    $("#otp_send").html('Send');
                    toastr.error(data.msg);
                }
            }
            , error: function(err) {
                // remove spinner to button
                $("#otp_send").prop("disabled", false);
                $("#otp_send").html('Send');
                toastr.error(data.msg);
            }
        , });

    });
</script>
@endsection