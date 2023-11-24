@extends('layouts.master')

@section('title', 'New Appointment - Proxima clinic')

<!-- css insert -->
@section('css')

<!-- select 2 -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/css/select2.min.css"
    integrity="sha512-aD9ophpFQ61nFZP6hXYu4Q/b/USW7rpLCQLX6Bi0WJHXNO7Js/fUENpBQf/+P4NtpzNX0jSgR5zVvPOJp+W2Kg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

<!-- boostrap datepicker -->
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css" />

<!-- international telephone input -->
<link href="{{ URL::asset('plugins/internationaltelephone/intlTelInput.css') }}" rel="stylesheet">


@endsection


<!-- content insert -->
@section('content')

<div class="container-fluid px-2 mt-3">

    <!-- page title link -->
    <div class="d-sm-flex align-items-center justify-content-between mb-3">
        <span class="mb-0">
            <a class="link-cust-text text-gray-200 fw-light" href="{{ route('sett.home') }}">Dashboard |</a>
            <a class="link-cust-text text-gray-200 fw-light" href="{{ route('sett.appointment.index') }}">Appointment
                | </a>
            <a class="text-gray-300">Add New Appointment</a>
        </span>
    </div>

    <div class="card card-input shadow mb-3 pb-3">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 fw-bold text-gray-500"><i class="fas fa-calendar me-2"></i> Add new appointment</h6>
        </div>

        <!-- Card Body -->
        <div class="card-body px-3">
            asd
            @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
            @endforeach

            <div class="multi-setps-form-calander col-12">

                <form id="myform" method="POST" action="{{ route('sett.appointment.store') }}"
                    enctype="multipart/form-data">

                    @csrf

                    <!-- progressbar -->
                    <ul class="ps-0 progressbar" id="progressbar">
                        <li class="active">

                            <a>
                                <!-- in case we want to use prog selector href="#clinics" -->
                                <div class="icon-circle checked d-flex align-items-center justify-content-center">
                                    <i class="bi bi-pin-map"></i>
                                </div>
                                Clinics
                            </a>
                        </li>

                        <li>
                            <a>
                                <div class="icon-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-calendar4-range"></i>
                                </div>
                                Time
                            </a>
                        </li>

                        <li>
                            <a>
                                <div class="icon-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-person"></i>
                                </div>
                                Paitent
                            </a>
                        </li>
                        <li>
                            <a>
                                <div class="icon-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-info"></i>
                                </div>
                                Details
                            </a>
                        </li>
                    </ul>

                    <!-- content -->

                    <div class="cont_tap " id="clinics">

                        <div class="row justify-content-center mb-4">
                            <h5 class="text-center text-gray-400 mb-4">Choose your the nearest clinic and the wanted
                                date?
                            </h5>

                            <div class="row justify-content-center">

                                <div class="col ps-lg-5 pe-5">

                                    <div class="my-4">
                                        <label class="form-label">Branch <small>(required)</small></label>
                                        <select id="branches_selc_form"
                                            class="js-example-basic-single select2-no-search select2-hidden-accessible @error('branch_id') is-invalid @enderror"
                                            name="branch_id" required>
                                            @foreach ($branches as $iteam)
                                            <option value="{{ $iteam->id }}">{{ $iteam->name }}</option>
                                            @endforeach
                                        </select>

                                        @error('branch_id')
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
                                            <option value="{{ $iteam->id }}" data-price="{{ $iteam->price }} data-name="
                                                {{ $iteam->name }}">
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
                                <div class="col ps-4 justify-content-sm-center calander-left-border text-center">
                                    <div class="calander_cont mx-auto" id="calander_cont">
                                        <!-- calander ajax content -->
                                    </div>

                                    <input type="hidden" name="calander_date_day" id="calander_date_day" value=""
                                        required>
                                    <input type="hidden" name="calander_date_start" id="calander_date_start" value="">
                                    <input type="hidden" name="calander_date_end" id="calander_date_end" value="">

                                    @error('calander_date_day')
                                    <span class="error-msg-form text-center">
                                        <p>{{ $message }}</p>
                                    </span>
                                    @enderror
                                </div>

                            </div>


                        </div>

                        <div class="d-flex justify-content-end mt-3">
                            <input type="button" name="next" class="next-form-steps btn btn-primary action-button-next"
                                value="Continue" />
                        </div>
                    </div>

                    <!-- slide 2 -->

                    <div class="cont_tap" id="time">

                        <div class="row justify-content-around">

                            <div class="col-12">

                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab"
                                            data-bs-target="#home" type="button" role="tab" aria-controls="home"
                                            aria-selected="true" class="text-gray-500"><i class="fas fa-user me-1"></i>
                                            Patient</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab"
                                            data-bs-target="#profile" type="button" role="tab" aria-controls="profile"
                                            aria-selected="false" class="main-color"><i class="fas fa-plus me-1"></i>
                                            New</button>
                                    </li>
                                </ul>

                                <div class="tab-content" id="myTabContent">

                                    <!-- search for patients -->
                                    <div class="tab-pane fade show active" id="home" role="tabpanel"
                                        aria-labelledby="home-tab">

                                        <div class="row pt-5 justify-content-center">

                                            <h5 class="text-center text-gray-400">What patient you want to make
                                                the appointment for?
                                            </h5>

                                            <div class="col-12 col-md-9 my-4">

                                                <div class="search-eng-cont-calander">

                                                    <div class="p-1 bg-white rounded rounded-pill border-all"
                                                        style="box-shadow: -1px 1rem 1rem 7px rgb(58 59 69 / 15%) !important; ">

                                                        <div class="input-group">
                                                            <input id="search-eng" type="search"
                                                                placeholder="What're you searching for .."
                                                                aria-describedby="button-add"
                                                                class="form-control border-0 bg-transparent px-4"
                                                                required>
                                                            <div class="input-group-append pe-2">
                                                                <button class="btn btn-link text-primary typeahead"><i
                                                                        class="fa fa-search text-gray-300"></i></button>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div id="search-eng-show-list"
                                                        class="search-eng-results list-group p-4 bg-white b-r-l-b-cont"
                                                        style="box-shadow: -1px 1rem 1rem 7px rgb(58 59 69 / 15%) !important; display:none">
                                                    </div>

                                                </div>

                                                @error('search_patient_id')
                                                <span class="error-msg-form">
                                                    {{ $message }}
                                                </span>
                                                @enderror

                                                <!-- patient id from search bar via ajax-->
                                                <input type="hidden" name="search_patient_id" id="search_patient_id"
                                                    value="" required>

                                                <div id="search-eng-js-error-valid"></div>


                                            </div>


                                            <div class="row mt-4" id="patient_info_ajax">
                                            </div>

                                        </div>


                                    </div>



                                    <div class="tab-pane fade" id="profile" role="tabpanel"
                                        aria-labelledby="profile-tab">

                                        <h5 class="text-gray-400 mt-4">Add new patient
                                        </h5>

                                        <div class="row mb-1 mt-5">

                                            <div class="col-12 col-md-5 align-self-center mb-2">
                                                <div class="avatar-update-container">
                                                    <div class="picture">
                                                        <img src="{{ URL::asset('img/dashboard/avatars/default-pp.png') }}"
                                                            class="picture-src" id="mib_PicturePreview" title="" />
                                                        <input type="file" name='avatar' accept="image/*"
                                                            id="mib_img_input">
                                                    </div>
                                                    <h6 class="text-gray-300">Choose Picture</h6>

                                                    @error('avatar')
                                                    <span class="error-msg-form">
                                                        {{ $message }}
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-12 col-md-7 mb-2">
                                                <div class="mb-3">
                                                    <label class="form-label">Username
                                                        <small>(required)</small></label>
                                                    <input name="username" type="text"
                                                        class="form-control @error('username') is-invalid @enderror"
                                                        placeholder="Ahmed..." autofocus required>
                                                </div>

                                                @error('username')
                                                <span class="error-msg-form">
                                                    {{ $message }}
                                                </span>
                                                @enderror

                                                <div class="mb-3">
                                                    <label class="form-label">Email
                                                        <small>(required)</small></label>
                                                    <input name="email" type="text"
                                                        class="form-control @error('email') is-invalid @enderror"
                                                        placeholder="Yousef@gmail.com...">
                                                </div>

                                                @error('email')
                                                <span class="error-msg-form">
                                                    {{ $message }}
                                                </span>
                                                @enderror

                                            </div>

                                        </div>

                                        <div class="row mb-2">
                                            <div class="col-12 col-md-6 mb-2">
                                                <label class="form-label">Password
                                                    <small>(required)</small></label>
                                                <input id="password" name="password" type="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    placeholder="Wrtie your password here..." required>

                                                @if ($errors->has('password'))
                                                <span class="error-msg-form">
                                                    {{ $errors->first('password') }}
                                                </span>
                                                @else
                                                <div class="form-text text-gray-200">We'll never share your
                                                    email with anyone else.
                                                </div>
                                                @endif
                                            </div>


                                            <div class="col-12 col-md-6 mb-2">
                                                <label class="form-label">Confirm password
                                                    <small>(required)</small></label>
                                                <input name="password_confirmation" type="password" class="form-control"
                                                    placeholder="Confirm your password..." id="password-confirm"
                                                    required>
                                            </div>

                                        </div>

                                        <hr>
                                        <h6 class="text-gray-400 mb-">Personal Information</h6>

                                        <div class="row mb-2">

                                            <div class="col-12 col-md-4 mb-2">
                                                <label class="form-label">First Name
                                                    <small>(required)</small></label>
                                                <input name="first_name" type="text"
                                                    class="form-control @error('first_name') is-invalid @enderror"
                                                    placeholder="Write your first name here" required>

                                                @error('first_name')
                                                <span class="error-msg-form">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                            </div>

                                            <div class="col-12 col-md-4 mb-2">
                                                <label class="form-label">Middle Name
                                                    <small>(required)</small></label>
                                                <input name="middle_name" type="text"
                                                    class="form-control @error('middle_name') is-invalid @enderror"
                                                    placeholder="Write your middle name here" required>

                                                @error('middle_name')
                                                <span class="error-msg-form">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                            </div>

                                            <div class="col-12 col-md-4 mb-2">
                                                <label class="form-label">Last Name
                                                    <small>(required)</small></label>
                                                <input name="second_name" type="text"
                                                    class="form-control @error('second_name') is-invalid @enderror"
                                                    placeholder="Write your last name here" required>

                                                @error('second_name')
                                                <span class="error-msg-form">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                            </div>

                                        </div>


                                        <div class="row mb-2">

                                            <div class="col-12 col-md-6 mb-2">
                                                <label class="form-label">Gendar <small>(required)</small></label>
                                                <select
                                                    class="js-example-basic-single select2-no-search select2-hidden-accessible @error('gendar') is-invalid @enderror"
                                                    name="gendar" required>
                                                    <option value="male">Male</option>
                                                    <option value="female">Female</option>
                                                </select>
                                                <div id="gendar-js-error-valid"></div>

                                                @error('gendar')
                                                <span class="error-msg-form">
                                                    {{ $message }}
                                                </span>
                                                @enderror

                                            </div>

                                            <div class="col-12 col-md-6 mb-2">


                                                <label class="form-label">Birthday
                                                    <small>(required)</small></label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text"><i
                                                                class="bi bi-calendar2-week-fill"></i> </div>
                                                    </div>
                                                    <input name="birthday" type="text"
                                                        class="form-control hasdatetimepicker @error('birthday') is-invalid @enderror"
                                                        placeholder="YYYY/MM/DD" required>
                                                </div>
                                                <div id="birthday-js-error-valid"></div>

                                                @error('birthday')
                                                <span class="error-msg-form">
                                                    {{ $message }}
                                                </span>
                                                @enderror

                                            </div>

                                        </div>


                                        <div class="row mb-2">

                                            <div class="col-12 col-md-4 mb-2">
                                                <label class="form-label">Country <small>(required)</small></label>
                                                <select
                                                    class="js-example-basic-single select2-hidden-accessible @error('country_id') is-invalid @enderror"
                                                    name="country_id" required>
                                                    @foreach ($countries as $iteam)
                                                    <option value="{{ $iteam->id }}">{{ $iteam->name }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                                <div id="country-js-error-valid"></div>

                                                @error('country_id')
                                                <span class="error-msg-form">
                                                    {{ $message }}
                                                </span>
                                                @enderror

                                            </div>

                                            <div class="col-12 col-md-4 mb-2">
                                                <label class="form-label">City <small>(required)</small></label>
                                                <select
                                                    class="js-example-basic-single select2-hidden-accessible @error('city_id') is-invalid @enderror"
                                                    name="city_id" required>
                                                    <option disabled selected>Open this select menu</option>
                                                </select>

                                                <div id="city-js-error-valid"></div>

                                                @if ($errors->has('city_id'))
                                                <span class="error-msg-form">
                                                    {{ $errors->first('city_id') }}
                                                </span>
                                                @else
                                                <div class="form-text text-gray-200">Select the country first
                                                </div>
                                                @endif
                                            </div>


                                            <div class="col-12 col-md-4 mb-2">
                                                <label class="form-label">How do you know us?
                                                    <small>(required)</small></label>
                                                <select
                                                    class="js-example-basic-single select2-hidden-accessible select2-no-search @error('from_recourse_id') is-invalid @enderror"
                                                    name="from_recourse_id">
                                                    @foreach ($from_recourses as $iteam)
                                                    <option value="{{ $iteam->id }}">{{ $iteam->name }}
                                                    </option>
                                                    @endforeach
                                                </select>

                                                <div id="from-recourse-js-error-valid"></div>

                                                @error('from_recourse_id')
                                                <span class="error-msg-form">
                                                    {{ $message }}
                                                </span>
                                                @enderror

                                            </div>

                                        </div>


                                        <hr>
                                        <h6 class="text-gray-400 mb-">Contact Information</h6>

                                        <div class="row mb-2">

                                            <div class="col-12 col-md-6 mb-2">
                                                <label class="form-label">Phone Number
                                                    <small>(required)</small></label>
                                                <input id="int-miphone" name="phone_number" type="tel"
                                                    class="form-control @error('phone_number') is-invalid @enderror"
                                                    required>

                                                <div id="phonenumber-js-error-valid"></div>

                                                @if ($errors->has('phone_number'))
                                                <span class="error-msg-form">
                                                    {{ $errors->first('phone_number') }}
                                                </span>
                                                @else
                                                <div class="form-text text-gray-200">We'll never share your email
                                                    with anyone else.
                                                </div>
                                                @endif
                                            </div>

                                            <div class="col-12 col-md-6 mb-2">
                                                <label class="form-label">Second Phone Number
                                                    <small>(optional)</small></label>
                                                <input id="int-miphone2" name="sec_phone_number" type="tel"
                                                    class="form-control @error('sec_phone_number') is-invalid @enderror">

                                                <div id="secphonenumber-js-error-valid"></div>

                                                @error('sec_phone_number')
                                                <span class="error-msg-form">
                                                    {{ $message }}
                                                </span>
                                                @enderror


                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>

                        </div>

                        <div class="d-flex justify-content-between p-4 pb-0">
                            <input type="button" name="previous"
                                class="previous-form-steps btn btn-secondary action-button-previous me-3"
                                value="Previous" />
                            <input type="button" name="next" class="next-form-steps btn btn-primary action-button-next"
                                value="Continue" />
                        </div>
                    </div>

                    <!-- slide 3 appointment info -->

                    <div class="cont_tap" id="about">

                        <div class="d-flex justify-content-around align-items-center flex-wrap">

                            <div class="d-flex mb-4 align-items-center me-2 mb-2">
                                <img class="rounded-circle avatar-m me-3"
                                    src="{{ URL::asset('img/dashboard/avatars/GGeMmsPz.jpeg') }}">
                                <div class="">
                                    <p class=" mb-0 text-xs text-gray-300">
                                        Patient</p>
                                    <h5 id="name_final_info" class="mb-1 fw-bold text-gray-600">Ahmed Ibrahm</h5>
                                    <p id="number_final_info" class="mb-0 text-xs text-gray-400">ID <strong>
                                            2122</strong></p>
                                </div>
                            </div>

                            <div class="me-2">
                                <h6 class="text-gray-300 text-xs mb-1">Branch</h6>
                                <p id="branch_final_info" class="text-gray-600 text-s fw-bold">Haram</p>
                            </div>

                            <div class="me-2">
                                <h6 class="text-gray-300 text-xs mb-1">Address</h6>
                                <p id="addre_final_info" class="text-gray-600 text-s fw-bold">20 Dec 1992</p>
                            </div>
                        </div>

                        <hr>


                        <div class="px-lg-5">
                            <div class="d-flex justify-content-between align-items-center px-lg-5 mb-3">
                                <div class="me-2">
                                    <i id="service_final_info" class="fas fa-suitcase-rolling me-2 text-gray-400"></i>
                                    Estimated days to find a
                                    buyer
                                </div>
                                <div class=" text-center">
                                    $200,00
                                </div>
                            </div>

                            <div class="d-flex justify-content-between align-items-center px-lg-5 mb-3">
                                <div class="me-2">
                                    <i class="fas fa-tag me-2 text-gray-400"></i> Coupon
                                </div>

                                <div class=" text-center">
                                    <div class="input-group">
                                        <input type="text" class="form-control" class="custom-select" id="coupon-input"
                                            style="border-radius: 5px 0px 0px 5px !important;"
                                            placeholder="Discount code here ..">
                                        <div class="input-group-append">
                                            <button id="coupon-buttn" class="btn btn-outline-secondary"
                                                class="form-control " type="button">Send</button>
                                        </div>
                                    </div>
                                    <div id="search-result-input"></div>

                                </div>
                            </div>

                            <div class="d-flex justify-content-between align-items-center px-lg-5 mb-3 d-none"
                                id="discount_amount_div">
                                <div class="me-2">
                                    <i class="fas fa-percent me-2 text-gray-400"></i> Discount
                                </div>
                                <div id="discount_amount_place" class="text-center">
                                    0
                                </div>
                            </div>

                            <div class="d-flex justify-content-between align-items-center px-lg-5 mb-4">
                                <div class="me-2 fw-bold">
                                    <i class="fas fa-dollar-sign me-2"></i> Total price to pay
                                </div>
                                <div id="pricetotal_final_info" id="total_amount_place" class="fw-bold text-center">
                                    $200,00
                                </div>
                            </div>

                            <div class="row align-items-center main-color-bg text-white px-lg-5 b-r-s-cont px-4 py-4">
                                <div class="col-12 col-md text-blue-300 mb-2 mb-md-0">
                                    You should come 15 minutes before the appointment to finish the procedders
                                </div>
                                <div class="col-12 col-md text-center">

                                    <h6 class="text-xs mb-1 text-blue-300">Appointment Time</h6>
                                    <p id="date_final_info" class="text-l fs-4 fw-bold mb-0">10:00 AM - 12:00 PM</p>
                                    <p id="time_final_info" class="text-s text-blue-200">Mondey 21 2017</p>
                                </div>

                            </div>

                        </div>
                        <div class="d-flex justify-content-between p-4">
                            <input type="button" name="previous"
                                class="previous-form-steps btn btn-secondary action-button-previous me-3"
                                value="Previous" />
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
                },
                second_name: {
                    minlength: 3,
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
    //insert passwrod depends on the username
        $('input[name="username"]').keyup(function(e) {
            e.preventDefault();

            username = $(this).val();
            new_password = 'proxima' + username;
            $('input[name="password"]').val(new_password);
            $('input[name="password_confirmation"]').val(new_password);
        })

        //for country and cities ajax inputs
        $('select[name="country_id"]').on('change', function(e) {
            e.preventDefault();
            var countryID = $(this).val();
            if (countryID) {
                $.ajax({
                    url: '/admin/createcityajax/' + encodeURI(countryID),
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
        });
</script>


<script>
    //--------------------- appointment ajax -------------------

        //default calander ajax
        $(document).ready(function() {

            fetchCalander();

            function fetchCalander(month = {{ date('m') }}, year = {{ date('Y') }}) {
                var branches_selc = $('#branches_selc_form').val();

                var branch_id = branches_selc;
                $.ajax({
                    url: '{{ url('/appointment/calander_appointment_ajax') }}/' + month + '/' + year +
                        '/' +
                        branch_id,
                    type: "GET",
                    success: function(data) {
                        $("#calander_cont").html(data);
                    }
                });
            }

            //reinsert calander when branch selector is changed (#branches_selc_form)
            $(document).on('change', '#branches_selc_form', function() {
                fetchCalander()
            });


            //reinsert the calander when the month arrows are clicked
            $(document).on('click', '#change_month', function() {
                var month = $(this).data('month');
                var year = $(this).data('year');
                fetchCalander(month, year)
            });
        });



        // ----------------- timeslots -----------------
        //-- to show the available timeslots for given day
        //when (#available_day_ajax) is clicked in calander days, (data-timeslots attribute) will be taken which containing the give date
        //it will be send to timeslots.php to selecet the booked date from db then check the availability and excute timeslot fun
        $(document).on('click', '.monthly_to_timeline_calendar', function() {

            $day = $(this).data("timeslot");


            $('#calander_date_day').val($day);
            $('#calander_date_start').val($start);
            $('#calander_date_end').val($end);
        });
</script>




<script>
    //--------------------- search engine ajax -------------------

        $(document).ready(function() {
            // Send Search Text to the server
            $("#search-eng").keyup(function() {
                let search_query = $(this).val();
                if (search_query != "") {
                    $.ajax({
                        url: '{{ url('/appointment/calander_patient_search') }}/' +
                            search_query,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $("#search-eng-show-list").show();

                            if (data !== "") {
                                var html = ''
                                $.each(data, function(key, value) {
                                    html += '<a data-id="' + value.id +
                                        '" data-first_name="' + value.first_name +
                                        '"data-middle_name="' + value.middle_name +
                                        '" data-second_name="' + value.second_name +
                                        '" data-phone_number="' + value
                                        .phone_number +
                                        '" data-birthday="' + value.birthday +
                                        '" data-avatar="' + value.avatar +
                                        '" class="search-eng-a list-group-item list-group-item-action border-1 text-gray-500" style="cursor: pointer;"><i class="fas fa-search text-gray-200 me-2"></i> ' +
                                        value.first_name + ' ' + value.middle_name +
                                        ' ' + value
                                        .second_name + '</a>';
                                });
                                $('#search-eng-show-list').html(html);

                            }
                            if (data == "") {
                                $('#search-eng-show-list').html(
                                    '<a class="list-group-item list-group-item-action border-0"><i class="fas fa-search text-gray-200 me-2"></i>No Record</a>'
                                );
                            }
                        },
                    });
                } else {
                    $("#search-eng-show-list").empty();
                    $("#search-eng-show-list").hide();;
                }
            });

            // fetch the wanted search info to show
            $(document).on("click", ".search-eng-a", function() {
                $("#search-eng").val($(this).text());
                $("#search-eng-show-list").hide();;

                id = $(this).data('id');
                first_name = $(this).data('first_name');
                middle_name = $(this).data('middle_name');
                second_name = $(this).data('second_name');
                phone_number = $(this).data('phone_number');
                birthday = $(this).data('birthday');
                avatar = $(this).data('avatar');

                //send to the last final details 
                $("#name_final_info").text(first_name + " " + middle_name + " " + second_name);
                $("#number_final_info").text(phone_number);
                avatar = $(this).data('avatar');


                $('#search_patient_id').val(id);

                avatar_url = '{{ URL::asset('img/useravatar') }}' + '/' + avatar;


                $("#patient_info_ajax").html(
                    '<h6 class="text-gray-600 mb-3">Patient Information </h6>' +
                    '<div class="col d-flex">' +
                    '<img class="rounded-circle avatar-small me-3"' +
                    'src=' + avatar_url +
                    '> <div><p class = "mb-0 text-xs text-gray-300 ">Patient </p> <p class = "mb-0 text-xs fw-bold text-gray-600" >' +
                    first_name + ' ' + middle_name + ' ' + second_name + '</p> </div> </div>' +
                    '<div class="col">' +
                    '<h6 class="text-gray-300 text-xs mb-1">Phone Number</h6>' +
                    '<p class="text-gray-600 text-s fw-bold">' + phone_number + '</p></div>' +
                    '<div class="col">' +
                    '<h6 class="text-gray-300 text-xs mb-1">Birthday</h6>' +
                    '<p class="text-gray-600 text-s fw-bold">' + birthday + '</p></div>'

                );

            });

            //in case the user chosse new patient to add the appointment for
            $(document).on('click', '#profile-tab', function() {
                $("#search_patient_id").prop('disabled', true);
            });
        });
</script>


<script>
    //--------------------- getting appointment final details -------------------

        $(document).ready(function() {
            var branches_selc = $('#branches_selc_form').val();
            var service_name = $('#services').find(':selected').data('name');
            var service_price = $('#services').find(':selected').data('price');
            $('#branch_final_info').val(branches_selc);


            var search_query = $('#coupon-input').val();

        })



        //--------------------- coupons -------------------
        $(document).on('click', '#coupon-buttn', function() {

            var search_query = $('#coupon-input').val();
            var patient_check = $('#search_patient_id').val();
            //service price
            var total_price = $('#services').find(':selected').data('price');

            if (!patient_check) {
                var patient_id = 'null';
            } else {
                var patient_id = patient_check;
            }

            $.ajax({
                url: '{{ url('/appointment/discount_search') }}/' + search_query + '/' + patient_id +
                    '/' + total_price,
                type: "GET",
                dataType: "json",
                success: function(data) {
                    //if the coupon is not valid
                    if (!data.discount_amount) {
                        $("#discount_amount_div").addClass('d-none');
                        $("#search-result-input").html(data.msg);
                        $("#total_amount_place").html('$' + total_price);
                        //if the coupon is valid
                    } else {
                        $("#discount_amount_div").removeClass('d-none');

                        $("#search-result-input").html('<p class="me-2">' + data.msg +
                            '<small id="delete_coupon" class="text-red clickable-item-pointer"> DELETE</small><p>'
                        );
                        $("#discount_amount_place").html('$' + data.discount_amount);

                        var after_discount = total_price - data.discount_amount;
                        $("#total_amount_place").html('$' + after_discount);
                    }
                }

            });
        });

        //in case the user want to delete the coupon
        $(document).on('click', '#delete_coupon', function() {
            var total_price = $('#search_patient_id').data('price');
            $("#discount_amount_div").addClass('d-none');
            $('#coupon-input').val('');
            $("#search-result-input").html('');
            $("#total_amount_place").html('$' + total_price);
        })
</script>




<!-- international telephone input -->
<script src="{{ URL::asset('plugins/internationaltelephone/intlTelInput.min.js') }}"></script>

<script>
    //to enable international telephone input (#int-miphone) is where we need to insert it
        const phoneInputField = document.querySelector("#int-miphone");
        const phoneInput = window.intlTelInput(phoneInputField, {
            //preferred countries https://en.wikipedia.org/wiki/ISO_3166-1_alpha-2
            preferredCountries: ["eg", "sa", "ae", "qa"],
            utilsScript: "{{ URL::asset('plugins/intltelinput/utils.js') }}",
        });
        const phoneInputField2 = document.querySelector("#int-miphone2");
        const phoneInput2 = window.intlTelInput(phoneInputField2, {
            //preferred countries https://en.wikipedia.org/wiki/ISO_3166-1_alpha-2
            preferredCountries: ["eg", "sa", "ae", "qa"],
            utilsScript: "{{ URL::asset('plugins/intltelinput/utils.js') }}",
        });
</script>



@endsection