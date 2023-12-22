@extends('layouts.land.master_top')

@section('title', 'Appointment - Pain Cure | Dr. Amr Saeed')

<!-- css insert -->
@section('css')

<!-- select 2 -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/css/select2.min.css"
    integrity="sha512-aD9ophpFQ61nFZP6hXYu4Q/b/USW7rpLCQLX6Bi0WJHXNO7Js/fUENpBQf/+P4NtpzNX0jSgR5zVvPOJp+W2Kg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

<!-- boostrap datepicker -->
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css" />

@endsection

<!-- content insert -->
@section('content')

<div class="bradcam_area breadcam_bg bradcam_overlay"
    style="background-image: url('{{ asset('img/dashboard/system/landing/bradcam.jpg') }}')">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="text-white">
                    <h1>Appointment</h1>
                    <p><a class="text-gray-200" href="{{ route('landing') }}">Home /</a> Appointment</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container bg-white position-relative b-r-s-cont p-3 shadow" style="margin-top: -40px; z-index:9;">

    @foreach ($errors->all() as $error)
    <div class="text-red"><i class="fas fa-exclamation me-1"></i> {{ $error }}</div>
    @endforeach

    <div class="multi-setps-form-calander col-12">

        <form id="myform" method="POST" action="{{ route('school_route.store_appointment') }}"
            enctype="multipart/form-data">

            @csrf

            <!-- progressbar -->
            <ul class="ps-0 progressbar" id="progressbar">
                <li class="active" style="width: 33%">

                    <a>
                        <!-- in case we want to use prog selector href="#clinics" -->
                        <div class="icon-circle checked d-flex align-items-center justify-content-center">
                            <i class="bi bi-calendar4-range"></i>
                        </div>
                        Time
                    </a>
                </li>

                <li style="width: 33%">
                    <a>
                        <div class="icon-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-info"></i>
                        </div>
                        Details
                    </a>
                </li>
                <li style="width: 33%">
                    <a>
                        <div class="icon-circle d-flex align-items-center justify-content-center">
                            <i class="far fa-paper-plane"></i>
                        </div>
                        Sending
                    </a>
                </li>
            </ul>

            <!-- content -->

            <div class="cont_tap px-0" id="clinics">

                <div class="row justify-content-center mb-4">
                    <h5 class="text-center text-gray-400 mb-4">Choose your the nearest clinic and the wanted
                        date?
                    </h5>

                    <div class="row justify-content-center">

                        <div class="col mb-3">

                            <div class="my-4">
                                <label class="form-label">{{ __('basic.specialty') }}
                                    <small>({{ __('basic.required') }})</small></label>
                                <select id="specialty_selc_form"
                                    class="js-example-basic-single select2-no-search select2-hidden-accessible @error('specialty_id') is-invalid @enderror"
                                    name="specialty_id" required>
                                    @foreach ($specialties as $iteam)
                                    <option value="{{ $iteam->id }}" data-specialty_name="{{ $iteam->name }}">
                                        {{ $iteam->name }}
                                    </option>
                                    @endforeach
                                </select>

                                @error('specialty_id')
                                <span class="error-msg-form">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>

                            <div class="my-4">
                                <label class="form-label">Branch <small>(required)</small></label>
                                <select id="branches_selc_form"
                                    class="js-example-basic-single select2-no-search select2-hidden-accessible @error('branch_id') is-invalid @enderror"
                                    name="branch_id" required>
                                    @foreach ($branches as $iteam)
                                    <option value="{{ $iteam->id }}" data-branch_name="{{ $iteam->name }}"
                                        data-branch_address="{{ $iteam->address }}">
                                        {{ $iteam->name }}
                                    </option>
                                    @endforeach
                                </select>

                                @error('branch_id')
                                <span class="error-msg-form">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>


                            <div class="my-3">
                                <label class="form-label">{{ __('basic.unit') }}
                                    <small>({{ __('basic.required') }})</small></label>
                                <select id="units_selc_form"
                                    class="js-example-basic-single select2-no-search select2-hidden-accessible @error('unit_id') is-invalid @enderror"
                                    name="unit_id" required>
                                    <option disabled>- Select Branch First -</option>
                                </select>

                                @error('unit_id')
                                <span class="error-msg-form">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>


                            <div class="my-4">
                                <label class="form-label">Service <small>(required)</small></label>
                                <select id="services"
                                    class="js-example-basic-single select2-hidden-accessible @error('service_id') is-invalid @enderror"
                                    name="service_id" required>
                                    @foreach ($services as $iteam)
                                    <option value="{{ $iteam->id }}" data-price="{{ $iteam->price }}"
                                        data-name="{{ $iteam->name }}">
                                        {{ $iteam->name }} -
                                        {{ $iteam->price }} <small>EGP</small></option>
                                    @endforeach
                                </select>

                                @error('service_id')
                                <span class="error-msg-form">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>


                            <div class="mt-5 d-flex justify-content-lg-between">

                                <div class="">
                                    Will you bring someone with you?
                                </div>

                                <div class="
                                    switch-checkbox">
                                    <input name="withsomeone" type="checkbox" value="1" id="switch"><label
                                        for="switch">Toggle</label>
                                </div>

                            </div>


                        </div>

                        <!-- calander -->
                        <div
                            class="col px-0 position-relative justify-content-sm-center calander-left-border text-center align-self-center">
                            <div class="calander_cont mx-auto" id="calander_cont">
                                <!-- calander ajax content -->
                            </div>

                            <!-- showing waiting during ajax performance -->
                            <div id="waiting" class="w-100 h-100 text-center"
                                style="position: absolute; top:0px; left:0px;z-index:999999; background-color: #ffffffba;">
                                <div class="spinner-grow text-primary" role="status"
                                    style="position: relative; top: 50%; transform: translateY(-50%);">
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </div>

                            <input type="hidden" name="calander_date_day" id="calander_date_day" value="" required>
                            <input type="hidden" name="calander_date_start" id="calander_date_start" value="">
                            <input type="hidden" name="calander_date_end" id="calander_date_end" value="">
                            <input type="hidden" name="search_patient_id" id="search_patient_id"
                                value="{{ Auth::guard('school')->id() }}">

                            @error('calander_date_day')
                            <span class="error-msg-form text-center">
                                <p>{{ $message }}</p>
                            </span>
                            @enderror
                        </div>

                    </div>


                </div>

                <div class="d-flex justify-content-end mt-3">
                    <input id="next_details" type="button" name="next"
                        class="next-form-steps btn btn-primary action-button-next" value="Continue" />
                </div>
            </div>


            <!-- slide 3 appointment info -->

            <div class="cont_tap" id="about">

                <!-- <div class="text-end px-lg-5">
                                                                                                                                                                                                                                    <a href="#"
                                                                                                                                                                                                                                        class="d-none bg-white d-sm-inline-block btn btn-sm shadow-sm b-r-l-cont p-2 px-4 text-gray-400"><i
                                                                                                                                                                                                                                            class="fas fa-download fa-sm text-gray-300 me-1"></i> Print</a>
                                                                                                                                                                                                                        </div> -->

                <div class="d-flex justify-content-around align-items-center flex-wrap mt-4">

                    <div class="d-flex mb-4 align-items-center me-2 mb-2">
                        <img id="avatar_final_info" class="rounded-circle avatar-m me-3"
                            src="{{ URL::asset('img/useravatar/' . Auth::guard('school')->user()->avatar) }}">
                        <div class="">
                            <p class=" mb-0 text-xs text-gray-300">
                                Patient</p>
                            <h5 id="name_final_info" class="mb-1 fw-bold text-gray-600">
                                {{ Auth::guard('school')->user()->first_name }}
                            </h5>
                            <p id="number_final_info" class="mb-0 text-xs text-gray-400">
                                {{ Auth::guard('school')->user()->phone_number }}</p>
                        </div>
                    </div>

                    <div class="me-2">
                        <h6 class="text-gray-300 text-xs mb-1">Branch</h6>
                        <p id="branch_final_info" class="text-gray-600 text-s fw-bold">Branch Not Selected</p>
                    </div>

                    <div class="me-2">
                        <h6 class="text-gray-300 text-xs mb-1">Address</h6>
                        <p id="addre_final_info" class="text-gray-600 text-s fw-bold">Not Selected</p>
                    </div>
                </div>

                <hr>

                <div class="px-lg-5 mt-4">

                    <div class="d-flex justify-content-between align-items-center px-lg-5 mb-3">
                        <div class="me-2">
                            <i class="fas fa-suitcase-rolling me-2 text-gray-400"></i>
                            <span id="service_final_info">
                                Service Not Selected
                            </span>
                        </div>
                        <div id="service_price_final_info" class="text-center">
                            Not Selected
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center px-lg-5 mb-3">
                        <div class="me-2">
                            <i class="fas fa-tag me-2 text-gray-400"></i> Coupon
                        </div>

                        <div class="text-center">
                            <div class="input-group">
                                <input type="text" name="coupon_input" class="form-control custom-select"
                                    id="coupon_input" style="border-radius: 5px 0px 0px 5px !important;"
                                    placeholder="Discount code here ..">

                                <input type="hidden" name="coupon_id" id="coupon_id">

                                <div class="input-group-append">
                                    <button id="coupon-buttn" class="btn btn-outline-secondary" class="form-control "
                                        type="button">Send</button>
                                </div>
                            </div>

                            @error('coupon_id')
                            <span class="error-msg-form">
                                {{ $message }}
                            </span>
                            @enderror

                            <div id="search-result-input"></div>

                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center px-lg-5 mb-3 d-none"
                        id="discount_amount_div">
                        <div class="me-2">
                            <i class="fas fa-percent me-2 text-gray-400"></i> Discount
                        </div>
                        <div id="discount_amount_place" class="text-center text-decoration-line-through">
                            Not Selected
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center px-lg-5 mb-4">
                        <div class="me-2 fw-bold">
                            <i class="fas fa-dollar-sign me-2"></i> Total price to pay
                        </div>
                        <div id="price_total_final_info" class="fw-bold text-center">
                            Not Selected
                        </div>
                    </div>

                    <div class="row mb-2 px-lg-5">
                        <div class="mb-3">
                            <label class="form-label">Note <small>(optional)</small></label>
                            <textarea name="appointment_note" class="form-control"
                                placeholder="Write here your notes .." rows="4" spellcheck="false"></textarea>
                        </div>
                    </div>

                    @error('appointment_note')
                    <span class="error-msg-form">
                        {{ $message }}
                    </span>
                    @enderror

                    <div class="row align-items-center main-color-bg text-white px-lg-5 b-r-s-cont px-4 py-4">
                        <div class="col-12 col-md text-blue-300 mb-2 mb-md-0">
                            You should come 15 minutes before the appointment to finish the procedders
                        </div>
                        <div class="col-12 col-md text-center">

                            <h6 class="text-xs mb-1 text-blue-300">Appointment Time</h6>
                            <p id="date_final_info" class="text-l fs-4 fw-bold mb-0">Not Selected</p>
                            <p id="time_final_info" class="text-s text-blue-200">Not Selected</p>
                        </div>

                    </div>


                </div>
                <div class="d-flex justify-content-between p-4">
                    <input type="button" name="previous"
                        class="previous-form-steps btn btn-secondary action-button-previous me-3" value="Previous" />
                    <input type="submit" name="next" class="next-form-steps btn btn-primary action-button-next"
                        value="Send" />
                </div>
            </div>

            <!-- slide 4 -->

            <div class="cont_tap" id="sending">
                <div class="d-flex justify-content-center p2">
                    <img src="{{ URL::asset('img/dashboard/system/loading-dash.svg') }}" style="width: 195px;"
                        alt="Loading" />
                </div>
            </div>

        </form>
    </div>


</div>

@endsection

<!-- js insert -->
@section('js')

<!-- select 2 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/js/select2.min.js"
    integrity="sha512-4MvcHwcbqXKUHB6Lx3Zb5CEAVoE9u84qN+ZSMM6s7z8IeJriExrV3ND5zRze9mxNlABJ6k864P/Vl8m0Sd3DtQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function() {
            $('.js-example-basic-single').select2();
            //hide search
            $('.select2-no-search').select2({
                minimumResultsForSearch: -1
            });
        });
</script>

<!-- jquery ui datepicker -->
<script type="text/javascript"
    src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<script>
    $(function() {
            $('.hasdatetimepicker').datepicker({
                todayHighlight: true,
                format: "yyyy-mm-dd",
            });
        });
</script>

<!-- validate jquery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"
    integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    //Rules for the Validator plugin
        var $validator = $('#myform').validate({

            //ignore: [], //to enable vlidation for hidden inputs
            //ignore: ['#calander_date_daya'],
            onkeyup: false,
            ignore: ":hidden:not(#calander_date_day)", //select for enable hidden input

            rules: {
                first_name: {
                    minlength: 3,
                    maxlength: 30,
                },
                second_name: {
                    minlength: 3,
                    maxlength: 60,
                },
                mother_name: {
                    minlength: 4,
                    maxlength: 60,
                },
                email: {
                    email: true,
                },
                password: {
                    minlength: 7,
                    maxlength: 100,
                },
                password_confirmation: {
                    minlength: 7,
                    maxlength: 100,
                    equalTo: '#password',
                },
                appointment_note: {
                    maxlength: 255,
                },
            },
            messages: {
                email: {
                    required: "We need your email address to contact you",
                    email: "Your email address must be in the format of name@domain.com"
                },
                password_confirmation: {
                    equalTo: "Password does not match",
                }
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
                    case 'country_id':
                        error.insertAfter($("#country-js-error-valid"));
                        break;
                    case 'city_id':
                        error.insertAfter($("#city-js-error-valid"));
                        break;
                    case 'started_work':
                        error.insertAfter($("#startedwork-js-error-valid"));
                        break;
                    case 'phone_number':
                        error.insertAfter($("#phonenumber-js-error-valid"));
                        break;
                    case 'sec_phone_number':
                        error.insertAfter($("#secphonenumber-js-error-valid"));
                        break;
                    case 'from_recourse_id':
                        error.insertAfter($("#from-recourse-js-error-valid"));
                        break;
                    case 'search-eng':
                        error.insertAfter($("#search-eng-js-error-valid"));
                        break;

                    default:
                        error.insertAfter(element);
                }


            },
        });
</script>
<script>
    fetchServices_cat();

        function fetchServices_cat(specialty = $('#specialty_selc_form').val(), branch = $('#branches_selc_form').val()) {

            var url = "{{ route('school_route.land_fetch_servicecat_ajax', [':date', ':date2']) }}";
            url = url.replace(':date', specialty).replace(':date2', branch);

            $.ajax({
                url: url,
                type: "GET",
                dataType: "json",
                success: function(data) {
                    $('#services').empty();
                    $.each(data, function(key, value) {
                        $('#services').append('<option value="' +
                            value.id + '" data-price="' + value.price + '" data-name="' + value
                            .name + '">' + value.name + ' - ' + value.price +
                            ' {{ __('basic.egp') }}</option>');
                    });
                }
            });
        }


        //for showing loading icon until the ajax is done
        $(document).ajaxStart(function() {
            $("#waiting, #waiting2").show();
        });

        $(document).ajaxStop(function() {
            $("#waiting, #waiting2").hide();
        });

        //insert passwrod depends on the username
        $('input[name="first_name"]').keyup(function(e) {
            e.preventDefault();

            first_name = $(this).val();
            new_password = 'prox' + first_name;
            $('input[name="password"]').val(new_password);
            $('input[name="password_confirmation"]').val(new_password);
        })


        fetchCity();

        //for country and cities ajax inputs
        function fetchCity(countryID = $('select[name="country_id"]').val()) {

            var url = "{{ route('school_route.createcityajax', ':id') }}";
            url = url.replace(':id', countryID);

            if (countryID) {
                $.ajax({
                    url: url,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('select[name="city_id"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="city_id"]').append('<option value="' +
                                value.id + '">' + value.name + '</option>');
                        });
                    }
                });
            } else {
                $('select[name="city_id"]').empty();
            }
        }

        $('select[name="country_id"]').on('change', function(e) {
            var country_id = $(this).val();
            fetchCity(country_id)
        });
</script>


<script>
    //--------------------- calander appointment ajax -------------------

        //default calander ajax
        $(document).ready(function() {

            fetchCalander();

            function fetchCalander(month = {{ date('m') }}, year = {{ date('Y') }}) {
                var specialty_selc = $('#specialty_selc_form').val();
                var branch_id = $('#branches_selc_form').val();
                var unit_id = $('#units_selc_form').val();

                console.log(unit_id);
                var url =
                    "{{ route('school_route.land_calander_appointment_ajax', [':month', ':year', ':specialty_id', ':branch_id', ':unit_id']) }}";
                url = url.replace(':month', month).replace(':year', year).replace(':specialty_id', specialty_selc)
                    .replace(':branch_id', branch_id).replace(':unit_id', unit_id);

                $.ajax({
                    url: url,
                    type: "GET",
                    success: function(data) {
                        $("#calander_cont").html(data);
                    }
                });
            }

            //to get unit depnds on branch selected
            fetchUnit();

            function fetchUnit(branch = $('#branches_selc_form').val()) {

                var url = "{{ route('school_route.land_fetch_unit_ajax', [':date']) }}";
                url = url.replace(':date', branch);

                $.ajax({
                    url: url,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('#units_selc_form').empty();
                        $.each(data, function(key, value) {
                            $('#units_selc_form').append('<option value="' +
                                value.id + '">' + value.name + '</option>');
                        });
                        $('#units_selc_form').append(
                            '<option value="0"> Witing List</option>');
                        fetchCalander()
                    }
                });
            }

            //reinsert calander when specialty selector is changed (#specialty_selc_form)
            $(document).on('change', '#specialty_selc_form', function() {
                var specialty_id = $('#specialty_selc_form').val();
                var branch_id = $('#branches_selc_form').val();

                $('.calendar_datapicker_timeslots').hide();

                fetchServices_cat(specialty_id, branch_id);
                fetchCalander()
            });

            //reinsert calander when branch selector is changed (#branches_selc_form)
            $(document).on('change', '#branches_selc_form', function() {
                var specialty_id = $('#specialty_selc_form').val();
                var branch_id = $('#branches_selc_form').val();

                $('.calendar_datapicker_timeslots').hide();

                fetchUnit(branch_id)
                fetchServices_cat(specialty_id, branch_id);
                fetchCalander()
            });

            $(document).on('change', '#units_selc_form', function() {
                fetchCalander()
            });

            //reinsert the calander when the month arrows are clicked
            $(document).on('click', '#change_month', function() {
                var month = $(this).data('month');
                var year = $(this).data('year');
                fetchCalander(month, year)
            });
        });

        $(document).on('click', '.show_slots', function() {

            var today_date = $(this).data('timeslots');
            var specialty_selc = $('#specialty_selc_form').val();
            var branches_selc = $('#branches_selc_form').val();
            var unit_id = $('#units_selc_form').val();

            var show_slots_div = $(this).next('.calendar_datapicker_timeslots');

            var url =
                "{{ route('school_route.land_calander_show_slots_ajax', [':datetoday', ':specialty_id', ':branch_id', ':unit_id']) }}";
            url = url.replace(':datetoday', today_date).replace(':specialty_id', specialty_selc)
                .replace(':branch_id', branches_selc).replace(':unit_id', unit_id);

            $.ajax({
                url: url,
                type: "GET",
                success: function(data) {
                    show_slots_div.html(data);
                }
            });

            show_slots_div.hide();
            show_slots_div.show().css({
                    'opacity': 0,
                    'bottom': '-21%'
                })
                .animate({
                    'opacity': '1',
                    'bottom': '5px'
                }, 400);

        });


        $(document).on('click', '.click_day_calendar-close', function() {
            $('.calendar_datapicker_timeslots').hide();
        })


        // ----------------- timeslots -----------------
        //-- to show the available timeslots for given day
        //when (#available_day_ajax) is clicked in calander days, (data-timeslots attribute) will be taken which containing the give date
        //it will be send to timeslots.php to selecet the booked date from db then check the availability and excute timeslot fun
        $(document).on('click', '.available_day_ajax-selector', function() {
            //to reomove first classes booked and add booked to the selected day in calander
            $('.available_day_ajax_selected').removeClass('selected_day_calander');
            $('.calendar_booking_time_div').removeClass('selected_day_calander');
            $('.td_calander ').removeClass('selected_main_day_calander');
            $(this).parent().parent().parent().parent().closest('div').addClass("selected_main_day_calander")
        });

        $(document).ready(function() {

            $(document).on('mouseover click', '.available_day_ajax-selector', function() {

                if ($("a.firstClick").length > 0 && $("a.secondClick").length > 0) {
                    if (event.type === "click") {
                        $('.available_day_ajax-selector').removeClass("selected_day_calander");
                        $('.available_day_ajax-selector').removeClass("reserved");
                        $('.available_day_ajax-selector').removeClass("firstClick");
                        $('.available_day_ajax-selector').removeClass("secondClick");
                    }
                }

                if ($("a.firstClick").length > 0 && $("a.secondClick").length == 0) {
                    if (event.type === "mouseover") {
                        $('.available_day_ajax-selector').removeClass("selected_day_calander");
                        var tds = $('a.available_day_ajax-selector');
                        var firstClick = $(".firstClick");
                        var firstClickIndex = tds.index(firstClick);
                        var currentIndex = tds.index(this);

                        tds.filter(function() {
                            var idx = tds.index(this);
                            return idx >= firstClickIndex && idx <= currentIndex;
                        }).addClass("selected_day_calander")

                    }
                    if (event.type === "click") {
                        $(this).addClass("secondClick");
                        $('.selected_day_calander').addClass('reserved');

                        $end = $(this).data("end");
                        $('#calander_date_end').val($end);
                    }
                } else {
                    if (event.type === "click") {
                        $(this).addClass("firstClick");

                        $day = $(this).data("day");
                        $start = $(this).data("start");
                        $('#calander_date_day').val($day);
                        $('#calander_date_start').val($start);
                        $('#calander_date_end').val('');
                    }
                }

            });

        });
</script>

<script>
    //--------------------- coupons -------------------
        $(document).on('click', '#coupon-buttn', function() {

            var search_query = $('#coupon_input').val();
            var patient_id = {{ Auth::guard('school')->id() }};
            //service price
            var total_price = $('#services').find(':selected').data('price');

            $.ajax({
                url: '{{ url('/land/coupon_search') }}/' + search_query + '/' + patient_id +
                    '/' + total_price,
                type: "GET",
                dataType: "json",
                success: function(data) {
                    //if the coupon is not valid or used before
                    if (!data.discount_amount) {
                        $('#coupon_input').val("")
                        $("#discount_amount_div").addClass('d-none');
                        $("#search-result-input").html('<p class="text-red-error">' + data.msg +
                            '</p>');
                        $("#price_total_final_info").html('$' + total_price);

                        //if the coupon is valid
                    } else {
                        $("#discount_amount_div").removeClass('d-none');

                        $("#search-result-input").html('<p class="me-2 text-green">' + data.msg +
                            '<small id="delete_coupon" class="text-red clickable-item-pointer"> DELETE</small><p>'
                        );
                        $("#discount_amount_place").html('$' + data.discount_amount);

                        //insert the coupon id to the hidden input
                        $("#coupon_id").val(data.id);

                        var after_discount = total_price - data.discount_amount;
                        $("#price_total_final_info").html('$' + after_discount);
                    }
                }

            });
        });

        //in case the user want to delete the coupon
        $(document).on('click', '#delete_coupon', function() {
            var total_price = $('#services').find(':selected').data('price');
            $("#discount_amount_div").addClass('d-none');
            $('#coupon_input').val('');
            $("#search-result-input").html('');
            $("#price_total_final_info").html('$' + total_price);
            //set null to coupon id hidden input
            $("#coupon_id").val("");
        })


        //get the final details appointment to show in the last slide
        $(document).on("click", "#next_details", function() {

            id = $(this).data('id');


            var branch_name = $('#branches_selc_form').find(':selected').data('branch_name');
            var branch_address = $('#branches_selc_form').find(':selected').data('branch_address');
            var service_name = $('#services').find(':selected').data('name');
            var service_price = $('#services').find(':selected').data('price');

            var date_final = $('#calander_date_day').val();
            var start_time_appo = $('#calander_date_start').val();
            var end_time_appo = $('#calander_date_end').val();
            var time_appointment = start_time_appo + " - " + end_time_appo;

            $('#branch_final_info').text(branch_name);
            $('#addre_final_info').text(branch_address);
            $('#service_final_info').text(service_name);
            $('#service_price_final_info').text(service_price);
            $('#price_total_final_info').text(service_price);
            $('#date_final_info').text(time_appointment);
            $('#time_final_info').text(date_final);

        })
</script>

@endsection