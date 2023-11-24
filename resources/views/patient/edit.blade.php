@extends('layouts.master')

@section('title', 'Edit Traveler | Lam - School Management App')

@section('title-topbar', __('basic.edit traveler'))

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
            <a class="link-cust-text text-gray-200 fw-light" href="{{ route('sett.home') }}">{{ __('basic.dashboard') }}
                |</a>
            <a class="link-cust-text text-gray-200 fw-light" href="{{ route('sett.managers.index') }}">{{
                __('basic.travelers') }} | </a>
            <a class="text-gray-300">{{ __('basic.edit traveler') }}</a>
        </span>
    </div>

    <div class="card card-input shadow mb-3 pb-3">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 fw-bold text-gray-500"><i class="fas fa-user-edit me-2"></i> {{ __('basic.edit traveler') }}
            </h6>
        </div>

        @foreach ($errors->all() as $error)
        <div class="text-red"><i class="fas fa-exclamation me-1"></i> {{ $error }}</div>
        @endforeach

        <!-- Card Body -->
        <div class="card-body px-3">

            <div class="multi-setps-form-calander col-12">

                <form id="myform" class="myform" method="POST"
                    action="{{ route('sett.managers.update', $patient->id) }}" enctype="multipart/form-data">

                    @csrf
                    @method('PUT')

                    <!-- progressbar -->
                    <ul class="ps-0 progressbar" id="progressbar">
                        <li class="active">

                            <a>
                                <!-- in case we want to use prog selector href="#clinics" -->
                                <div class="icon-circle checked d-flex align-items-center justify-content-center">
                                    <i class="bi bi-gear"></i>
                                </div>
                                {{ __('patientappo.basic') }}
                            </a>
                        </li>

                        <li>
                            <a>
                                <div class="icon-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-person"></i>
                                </div>
                                {{ __('patientappo.personal') }}
                            </a>
                        </li>

                        <li>
                            <a>
                                <div class="icon-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-pin-map"></i>
                                </div>
                                {{ __('basic.other') }}

                            </a>
                        </li>
                        <li>
                            <a>
                                <div class="icon-circle d-flex align-items-center justify-content-center">
                                    <i class="far fa-paper-plane"></i>
                                </div>
                                {{ __('basic.sending') }}
                            </a>
                        </li>
                    </ul>

                    <!-- content -->

                    <div class="cont_tap " id="clinics">

                        <div class="row mb-1">

                            <div class="col-12 col-md-5 align-self-center mb-2">

                                <div class="avatar-update-container">
                                    <div class="picture">
                                        <img src="{{ URL::asset('img/useravatar/' . $patient->avatar) }}"
                                            class="picture-src" id="mib_PicturePreview" title="" />
                                        <input type="file" name='avatar' accept="image/*" id="mib_img_input">
                                    </div>
                                    <h6 class="text-gray-300">{{ __('basic.choose pic') }}</h6>

                                    @error('avatar')
                                    <span class="error-msg-form">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-12 col-md-7 mb-2">
                                <div class="mb-3">
                                    <label class="form-label">
                                        @if($patient->cat == 1)
                                        {{ __('patientappo.first name') }}
                                        @else
                                        {{ __('basic.company name') }}
                                        @endif
                                        <small>({{ __('basic.required') }})</small></label>
                                    <input name="first_name" type="text"
                                        class="form-control @error('first_name') is-invalid @enderror"
                                        placeholder="Write your first name here" required
                                        value="{{ $patient->first_name }}">
                                </div>

                                @error('first_name')
                                <span class="error-msg-form">
                                    {{ $message }}
                                </span>
                                @enderror

                                @if($patient->cat == 1)
                                <div class="mb-3">
                                    <label class="form-label">{{ __('patientappo.second name') }}
                                        <small>({{ __('basic.required') }})</small></label>
                                    <input name="second_name" type="text"
                                        class="form-control @error('second_name') is-invalid @enderror"
                                        placeholder="Write your second name here" value="{{ $patient->second_name }}">
                                </div>

                                @error('second_name')
                                <span class="error-msg-form">
                                    {{ $message }}
                                </span>
                                @enderror
                                @endif

                            </div>

                        </div>

                        <div class="row mb-2">

                            <div class="col-12 col-md mb-2">
                                <label class="form-label">{{ __('patientappo.email') }}
                                    <small>({{ __('basic.optional') }})</small></label>
                                <input name="email" type="text"
                                    class="form-control @error('email') is-invalid @enderror"
                                    placeholder="Yousef@gmail.com..." value="{{ $patient->email }}">

                                <input name="old_email" type="hidden" value="{{ $patient->email }}">

                                @error('email')
                                <span class="error-msg-form">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>


                            @if($patient->cat == 1)
                            <div class="col-12 col-md mb-2">
                                <label class="form-label">{{ __('basic.passport') }}
                                    <small>({{ __('basic.optional') }})</small></label>
                                <input name="passport" type="text"
                                    class="form-control @error('passport') is-invalid @enderror"
                                    placeholder="Passport number..." value="{{ $patient->passport }}">
                                @error('passport')
                                <span class="error-msg-form">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                            @endif


                            <div class="col-12 col-md mb-2">
                                <label class="form-label">{{ __('patientappo.phone number') }}
                                    <small>({{ __('basic.required') }})</small></label>
                                <input id="int-miphone" name="phone_number" type="tel"
                                    class="form-control @error('phone_number') is-invalid @enderror" required
                                    value="{{ $patient->phone_number }}">

                                <input name="old_phone_number" type="hidden" value="{{ $patient->phone_number }}">

                                <div id="phonenumber-js-error-valid"></div>

                                @if ($errors->has('phone_number'))
                                <span class="error-msg-form">
                                    {{ $errors->first('phone_number') }}
                                </span>
                                @else
                                <div class="form-text text-gray-200">{{ __('basic.email message')}}
                                </div>
                                @endif
                            </div>

                            <div class="col-12 col-md mb-2">
                                <label class="form-label">{{ __('patientappo.second phone number') }}
                                    <small>({{ __('basic.optional') }})</small></label>
                                <input id="int-miphone2" name="sec_phone_number" type="tel"
                                    class="form-control @error('sec_phone_number') is-invalid @enderror"
                                    value="{{ $patient->sec_phone_number }}">

                                <div id="secphonenumber-js-error-valid"></div>

                                @error('sec_phone_number')
                                <span class="error-msg-form">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>

                        @if($patient->cat == 2)
                        <div class="row mb-3">
                            <div class="col-12 col-md-6 mb-2">
                                <label class="form-label">{{ __('basic.commercial register') }}
                                    <small>({{ __('basic.optional') }})</small></label>
                                <input name="commercial_register" type="text"
                                    class="form-control @error('commercial_register') is-invalid @enderror"
                                    placeholder="Commercial Register..." value="{{ $patient->commercial_register }}">
                                @error('commercial_register')
                                <span class="error-msg-form">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                            <div class="col-12 col-md-6 mb-2">
                                <label class="form-label">{{ __('basic.tax number') }}
                                    <small>({{ __('basic.optional') }})</small></label>
                                <input name="tax_number" type="text"
                                    class="form-control @error('tax_number') is-invalid @enderror"
                                    placeholder="Tax Number..." value="{{ $patient->tax_number }}">
                                @error('tax_number')
                                <span class="error-msg-form">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>
                        @endif

                        <div class="row">
                            <div class="col-12 col-md-6 mb-2">
                                <label class="form-label">{{ __('basic.new password')
                                    }}<small> ({{ __('basic.required') }})</small></label>
                                <input id="password" name="newpassword" type="password"
                                    class="form-control @error('newpassword') is-invalid @enderror"
                                    placeholder="Wrtie your password here...">

                                @if ($errors->has('newpassword'))
                                <span class="error-msg-form">
                                    {{ $errors->first('newpassword') }}
                                </span>
                                @else
                                <div class="form-text text-gray-200">Leave it empty if you do not want to change it.
                                </div>
                                @endif
                            </div>

                            <div class="col-12 col-md-6 mb-2">
                                <label class="form-label">{{ __('basic.confirm new password')
                                    }} <small>({{ __('basic.required')}})</small></label>
                                <input name="newpassword_confirmation" type="password" class="form-control"
                                    placeholder="Confirm your password..." id="password-confirm">
                            </div>


                        </div>

                        <div class="d-flex justify-content-end mt-3">
                            <input type="button" name="next" class="next-form-steps btn btn-primary action-button-next"
                                value="{{ __('basic.continue') }}" />
                        </div>
                    </div>


                    <div class="cont_tap" id="time">

                        <div class="row mb-2">

                            <div class="col-12 col-md-6 mb-2">
                                <label class="form-label">{{ __('patientappo.gendar') }}
                                    <small>({{ __('basic.required') }})</small></label>
                                <select
                                    class="js-example-basic-single select2-no-search select2-hidden-accessible @error('gendar') is-invalid @enderror"
                                    name="gendar" required>
                                    <option @if ($patient->religion === "male") selected @endif value="male">{{
                                        __('patientappo.male') }}</option>
                                    <option @if ($patient->religion === "female") selected @endif value="female">{{
                                        __('patientappo.female') }}</option>
                                    <option @if ($patient->religion === "not selected") selected @endif value="not
                                        selected">{{ __('basic.not selected') }}</option>
                                </select>
                                <div id="gendar-js-error-valid"></div>

                                @error('gendar')
                                <span class="error-msg-form">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>

                            <div class="col-12 col-md-6 mb-2">

                                <label class="form-label">{{ __('patientappo.birthday') }}
                                    <small>({{ __('basic.optional') }})</small></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="bi bi-calendar2-week-fill"></i>
                                        </div>
                                    </div>
                                    <input name="birthday" type="text"
                                        class="form-control hasdatetimepicker @error('birthday') is-invalid @enderror"
                                        placeholder="YYYY/MM/DD" value="{{ $patient->birthday }}">
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

                            <div class="col-12 col-md-6 mb-2">
                                <label class="form-label">{{ __('patientappo.country') }}
                                    <small>({{ __('basic.required') }})</small></label>
                                <select
                                    class="js-example-basic-single select2-hidden-accessible @error('country_id') is-invalid @enderror"
                                    name="country_id" required>
                                    @foreach ($countries as $item)
                                    <option @if ($patient->country_id == $item->id) selected @endif value="{{ $item->id
                                        }}">{{ $item->name }}
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

                            <div class="col-12 col-md-6 mb-2">
                                <label class="form-label">{{ __('patientappo.city') }}
                                    <small>({{ __('basic.required') }})</small></label>
                                <select
                                    class="js-example-basic-single select2-hidden-accessible @error('city_id') is-invalid @enderror"
                                    name="city_id" required>
                                    <option value="{{ $patient->city->id }}" selected>
                                        {{ $patient->city->name }}
                                    </option>
                                </select>

                                <div id="city-js-error-valid"></div>

                                @if ($errors->has('city_id'))
                                <span class="error-msg-form">
                                    {{ $errors->first('city_id') }}
                                </span>
                                @else
                                <div class="form-text text-gray-200">{{ __('patientappo.city msg') }}
                                </div>
                                @endif
                            </div>


                        </div>

                        <div class="d-flex justify-content-between p-4">
                            <input type="button" name="previous"
                                class="previous-form-steps btn btn-secondary action-button-previous" value="Previous" />
                            <input type="button" name="next" class="next-form-steps btn btn-primary action-button-next"
                                value="{{ __('basic.continue') }}" />
                        </div>
                    </div>

                    <div class="cont_tap" id="about">


                        <div class="row mb-1">

                            <div class="col-12 col-md-6 mb-2">
                                <label class="form-label">{{ __('patientappo.know us') }}
                                    <small>({{ __('basic.required') }})</small></label>
                                <select
                                    class="js-example-basic-single select2-hidden-accessible select2-no-search @error('from_recourse_id') is-invalid @enderror"
                                    name="from_recourse_id">
                                    @foreach ($from_recourses as $item)
                                    <option @if ($patient->from_recourse_id == $item->id) selected @endif value="{{
                                        $item->id }}">{{ $item->name }}
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

                            <div class="col-12 col-md-6 mb-2">
                                <label class="form-label">{{ __('basic.activation') }}
                                    <small>({{ __('basic.required') }})</small></label>
                                <select
                                    class="js-example-basic-single select2-no-search select2-hidden-accessible @error('inactive') is-invalid @enderror"
                                    name="inactive" required>
                                    <option @if ($patient->inactive == 0) selected @endif value="0">{{
                                        __('basic.active') }}</option>
                                    <option @if ($patient->inactive == 1) selected @endif value="1">{{
                                        __('basic.inactive') }}</option>
                                </select>
                                <div id="type-js-error-valid"></div>

                                @error('inactive')
                                <span class="error-msg-form">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="mb-3">
                                <label class="form-label">{{ __('basic.note') }}
                                    <small>({{ __('basic.optional') }})</small></label>
                                <textarea name="note" class="form-control" placeholder="Write here your notes .."
                                    rows="4" spellcheck="false">{{ $patient->note }}</textarea>
                            </div>
                        </div>

                        @error('note')
                        <span class="error-msg-form">
                            {{ $message }}
                        </span>
                        @enderror

                        <div class="d-flex justify-content-between p-4">
                            <input type="button" name="previous"
                                class="previous-form-steps btn btn-secondary action-button-previous" value="Previous" />
                            <input type="submit" name="next" class="next-form-steps btn btn-primary action-button-next"
                                value="{{ __('basic.send') }}" />
                        </div>
                    </div>

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



<!-- Modal include and exclude to insert data -->
<div class="modal fade" id="new_worker_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">


        <div class="modal-content b-r-s-cont border-0">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-plus me-1"></i>
                    {{ __('basic.add new') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Modal content -->
            <div class="modal-body px-5 py-3">

                <form id="add_worker_input_modal">

                    <div class="row mb-2">

                        <div class="col-12 mb-2">
                            <label class="form-label">{{ __('basic.name') }}
                                <small>({{ __('basic.required') }})</small></label>
                            <input id="worker_name_input" name="worker_name_input" type="text"
                                class="form-control @error('worker_name_input') is-invalid @enderror"
                                placeholder="Worker Name .." required>
                        </div>

                        <div class="col-12 mb-2">
                            <label class="form-label">{{ __('basic.phone number') }}
                                <small>({{ __('basic.required') }})</small></label>
                            <input id="worker_phone_input" name="worker_phone_input" type="text"
                                class="form-control @error('worker_phone_input') is-invalid @enderror"
                                placeholder="Worker Phone Number .." required>
                        </div>

                        <div class="col-12 mb-2">
                            <label class="form-label">{{ __('basic.email') }}
                                <small>({{ __('basic.required') }})</small></label>
                            <input id="worker_email_input" name="worker_email_input" type="text"
                                class="form-control @error('worker_email_input') is-invalid @enderror"
                                placeholder="Worker Email .." required>
                        </div>

                        <div class="col-12 mb-2">
                            <label class="form-label">{{ __('basic.position') }}
                                <small>({{ __('basic.required') }})</small></label>
                            <input id="worker_position_input" name="worker_position_input" type="text"
                                class="form-control @error('worker_position_input') is-invalid @enderror"
                                placeholder="Worker Position .." required>
                        </div>

                    </div>

                </form>
            </div>

            <div class="modal-footer">
                <div class="left-side">
                    <button type="button" class="btn btn-default btn-link" data-bs-dismiss="modal">{{
                        __('basic.never mind') }}</button>
                </div>
                <div class="divider"></div>
                <div class="right-side">
                    <button id="add_include_exclude" class="btn btn-default btn-link main-color">{{ __('basic.add new')
                        }}</button>
                </div>
            </div>
        </div>

    </div>

</div>

@endsection

<!-- js insert -->
@section('js')

<script>
    // add new worker
        $(document).on("click", ".new_worker_modal", function() {
            $('#new_worker_modal').modal('show');
    });

    $(document).on("click", "#add_include_exclude", function() {


            if(!$('#add_worker_input_modal').valid()) {
                        return false;
            }

            $('#add_new_worker').hide();
            $('#new_worker_modal').modal('hide');

            var name = $("#worker_name_input").val();
            var phone = $("#worker_phone_input").val();
            var email = $("#worker_email_input").val();
            var position = $("#worker_position_input").val();

            $('#workers_cont').append(
                '<li class="row flex-nowrap list-group-item d-flex justify-content-between position-relative price_div">'+

                '<div class="col d-flex align-items-center me-1">' +
                    '<i class="fas fa-user mb-0 text-gray-700 me-2 fs-4"></i>' +
                    '<div>' +
                        '<p class="text-xs text-gray-200 mb-0">{{ __("basic.name") }}</p>' +
                    '<h6 class="text-s text-gray-400 pe-2 fw-bold">' + name + '</h6>' +
                    '</div>' +
                '</div>' +
                         
                '<div class="col align-self-center me-1">' +
                    '<p class="text-xs text-gray-200 mb-0">{{ __("basic.phone number") }}</p>' +
                    '<h6 class="text-s text-gray-400 pe-2 fw-bold">' + phone + '</h6>' +
                '</div>' +
  
                '<div class="col align-self-center me-1">' +
                    '<p class="text-xs text-gray-200 mb-0">{{ __("basic.email") }}</p>' +
                    '<h6 class="text-s text-gray-400 pe-2 fw-bold">' + email + '</h6>' +
                '</div>' +
  
                '<div class="col align-self-center me-1">' +
                    '<p class="text-xs text-gray-200 mb-0">{{ __("basic.position") }}</p>' +
                    '<h6 class="text-s text-gray-400 pe-2 fw-bold">' + position + '</h6>' +
                '</div>' +

                '<div class="col-1 align-self-center"><h6 clasas="mb-0"><i class="fas fa-times text-red-200 clickable-item-pointer delete_worker"></i></h6></div>' +

                '<input type="hidden" name="worker_name[]" value="' + name + '" />' +
                '<input type="hidden" name="worker_phone[]" value="' + phone + '" />' +
                '<input type="hidden" name="worker_email[]" value="' + email + '" />' +
                '<input type="hidden" name="worker_position[]" value="' + position + '" />' +
                "</li>"
            )

            $('#add_worker_input_modal input').val('')

    });

    $(document).on("click", ".delete_worker", function() {
            $(this).parent().parent().parent().remove();
    });

</script>
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
            todayHighlight: true
            , format: "yyyy-mm-dd"
        , });
    });

</script>

<!-- validate jquery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"
    integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
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
            , newpassword: {
                minlength: 7
                , maxlength: 100
            , }
            , newpassword_confirmation: {
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
                case 'deactivate':
                    error.insertAfter($("#deactivate-js-error-valid"));
                    break;

                default:
                    error.insertAfter(element);
            }

        }
    , });

</script>
<script>
    //for country and cities ajax inputs
    $('select[name="country_id"]').on('change', function(e) {
        e.preventDefault();

        var countryID = $(this).val();

        var url = "{{ route('sett.pat_createcityajax', ':id') }}";
        url = url.replace(':id', encodeURI(countryID));

        if (countryID) {
            $.ajax({
                url: url
                , type: "GET"
                , dataType: "json"
                , success: function(data) {
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




    fetchRegion();

    //for country and cities ajax inputs
    function fetchRegion(countryID = $('select[name="city_id"]').val()) {

        var url = "{{ route('sett.pat_createregionajax', ':id') }}";
        url = url.replace(':id', countryID);

        if (countryID) {
            $.ajax({
                url: url
                , type: "GET"
                , dataType: "json"
                , success: function(data) {
                    $('select[name="region_id"]').empty();
                    if(data.length > 0){
                        $.each(data, function(key, value) {
                            $('select[name="region_id"]').append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                    }else{
                        $('select[name="region_id"]').html('<option value="1">{{ __("basic.not selected") }}</option>');
                    }
                }
            });
        } else {
            $('select[name="region_id"]').html('<option value="1">{{ __("basic.not selected") }}</option>');
        }
    }

    $('select[name="city_id"]').on('change', function(e) {
        var country_id = $(this).val();
        fetchRegion(country_id)
    });

    fetchAskFor();

    //for country and cities ajax inputs
    function fetchAskFor(ask_for_main_id = $('select[name="ask_for_main_id"]').val()) {

        var url = "{{ route('sett.pat_create_askfor_ajax', ':id') }}";
        url = url.replace(':id', ask_for_main_id);

        if (ask_for_main_id) {
            $.ajax({
                url: url
                , type: "GET"
                , dataType: "json"
                , success: function(data) {
                    $('select[name="ask_for_id"]').empty();
                    $.each(data, function(key, value) {
                        $('select[name="ask_for_id"]').append('<option value="' +
                            value.id + '">' + value.name + '</option>');
                    });
                }
            });
        } else {
            $('select[name="ask_for_id"]').empty();
        }
    }

    $('select[name="ask_for_main_id"]').on('change', function(e) {
        var ask_for_main_id = $(this).val();
        fetchAskFor(ask_for_main_id)
    });

</script>


<!-- international telephone input -->
<script src="{{ URL::asset('plugins/internationaltelephone/intlTelInput.min.js') }}"></script>

<script>
    //to enable international telephone input (#int-miphone) is where we need to insert it
    const phoneInputField = document.querySelector("#int-miphone");
    const phoneInput = window.intlTelInput(phoneInputField, {
        //preferred countries https://en.wikipedia.org/wiki/ISO_3166-1_alpha-2
        preferredCountries: ["eg", "sa", "ae", "qa"]
        , utilsScript: "{{ URL::asset('plugins/intltelinput/utils.js') }}"
    , });
    const phoneInputField2 = document.querySelector("#int-miphone2");
    const phoneInput2 = window.intlTelInput(phoneInputField2, {
        //preferred countries https://en.wikipedia.org/wiki/ISO_3166-1_alpha-2
        preferredCountries: ["eg", "sa", "ae", "qa"]
        , utilsScript: "{{ URL::asset('plugins/intltelinput/utils.js') }}"
    , });

</script>



@endsection