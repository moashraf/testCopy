@extends('layouts.land.master_top')

@section('title', 'Register - Pain Cure | Dr. Amr Saeed')

<!-- css insert -->
@section('css')

<!-- animate.css -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

<link rel="stylesheet" href="{{ URL::asset('plugins/owl/owl.carousel.min.css') }}">

<!-- select 2 -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/css/select2.min.css"
    integrity="sha512-aD9ophpFQ61nFZP6hXYu4Q/b/USW7rpLCQLX6Bi0WJHXNO7Js/fUENpBQf/+P4NtpzNX0jSgR5zVvPOJp+W2Kg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

<!-- boostrap datepicker -->
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css" />

<!-- international telephone input -->
<link href="{{ URL::asset('plugins/internationaltelephone/intlTelInput.css') }}" rel="stylesheet">

<!-- google recaptcha -->
<script src="https://www.google.com/recaptcha/api.js" async defer></script>

@endsection

<!-- content insert -->
@section('content')

<div class="bradcam_area breadcam_bg bradcam_overlay"
    style="background-image: url('{{ asset('img/dashboard/system/landing/bradcam.jpg') }}')">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="text-white">
                    <div class="fs-1">
                        <a class="text-white">Register</a>
                        <span style="color: #c6ddd0 !important;"> | </span> <a href="{{ route('school_route.login') }}"
                            class="text-white" style="color: #c6ddd0 !important;">Login</a>
                    </div>

                    <p><a class="text-gray-200" href="{{ route('landing') }}">Home /</a> Register</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container bg-white position-relative b-r-s-cont p-4 shadow" style="margin-top: -40px; z-index:9;">

    @foreach ($errors->all() as $error)
    <div class="text-red"><i class="fas fa-exclamation me-1"></i> {{ $error }}</div>
    @endforeach

    <div class="multi-setps-form-calander col-12">

        <form id="myform" method="POST" action="{{ route('school_route.store') }}" enctype="multipart/form-data">

            @csrf

            <!-- progressbar -->
            <ul class="ps-0 progressbar" id="progressbar">
                <li class="active">

                    <a>
                        <!-- in case we want to use prog selector href="#clinics" -->
                        <div class="icon-circle checked d-flex align-items-center justify-content-center">
                            <i class="bi bi-gear"></i>
                        </div>
                        Basic
                    </a>
                </li>

                <li>
                    <a>
                        <div class="icon-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-person"></i>
                        </div>
                        Personal
                    </a>
                </li>

                <li>
                    <a>
                        <div class="icon-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-pin-map"></i>
                        </div>
                        Medical
                    </a>
                </li>
                <li>
                    <a>
                        <div class="icon-circle d-flex align-items-center justify-content-center">
                            <i class="far fa-paper-plane"></i>
                        </div>
                        Sending
                    </a>
                </li>
            </ul>

            <!-- content -->

            <div class="cont_tap " id="clinics">

                <div class="row mb-1">
                    <div class="col-12 col-md-5 align-self-center mb-2">

                        <div class="avatar-update-container">
                            <div class="picture">
                                <img src="{{ URL::asset('img/dashboard/avatars/default-pp.png') }}" class="picture-src"
                                    id="mib_PicturePreview" title="" />
                                <input type="file" name='avatar' accept="image/*" id="mib_img_input">
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
                            <label class="form-label">{{ __('patientappo.first name') }}
                                <small>({{ __('basic.required') }})</small></label>
                            <input name="first_name" type="text"
                                class="form-control @error('first_name') is-invalid @enderror"
                                placeholder="Write your first name here" required value="{{ old('first_name') }}">
                        </div>

                        @error('first_name')
                        <span class="error-msg-form">
                            {{ $message }}
                        </span>
                        @enderror

                        <div class="mb-3">
                            <label class="form-label">{{ __('patientappo.second name') }}
                                <small>({{ __('basic.required') }})</small></label>
                            <input name="second_name" type="text"
                                class="form-control @error('second_name') is-invalid @enderror"
                                placeholder="Write your second name here" required value="{{ old('second_name') }}">
                        </div>

                        @error('second_name')
                        <span class="error-msg-form">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                </div>

                <div class="row mb-2">

                    <div class="col-12 col-md-6 mb-2">
                        <label class="form-label">{{ __('patientappo.email') }}
                            <small>({{ __('basic.optional') }})</small></label>
                        <input name="email" type="text" class="form-control @error('email') is-invalid @enderror"
                            placeholder="Yousef@gmail.com..." value="{{ old('email') }}">
                        @error('email')
                        <span class="error-msg-form">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="col-12 col-md-6 mb-2">
                        <label class="form-label">{{ __('patientappo.mother name') }}
                            <small>({{ __('basic.optional') }})</small></label>
                        <input name="mother_name" type="text"
                            class="form-control @error('mother_name') is-invalid @enderror"
                            placeholder="Write your mother's name here" value="{{ old('mother_name') }}">

                        @error('mother_name')
                        <span class="error-msg-form">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                </div>

                <div class="row mb-2">
                    <div class="col-12 col-md-6 mb-2">
                        <label class="form-label">Password <small>(required)</small></label>
                        <input id="password" name="password" type="password"
                            class="form-control @error('password') is-invalid @enderror"
                            placeholder="Wrtie your password here..." required>

                        @if ($errors->has('password'))
                        <span class="error-msg-form">
                            {{ $errors->first('password') }}
                        </span>
                        @else
                        <div class="form-text text-gray-200">We'll never share your email with anyone else.
                        </div>
                        @endif
                    </div>


                    <div class="col-12 col-md-6 mb-2">
                        <label class="form-label">Confirm password <small>(required)</small></label>
                        <input name="password_confirmation" type="password" class="form-control"
                            placeholder="Confirm your password..." id="password-confirm" required>
                    </div>

                </div>

                <div class="d-flex justify-content-end mt-3">
                    <input type="button" name="next" class="next-form-steps btn btn-primary action-button-next"
                        value="Continue" />
                </div>
            </div>


            <div class="cont_tap" id="time">

                <div class="row mb-2">

                    <div class="col-12 col-md-4 mb-2">
                        <label class="form-label">Branch <small>(required)</small></label>
                        <select
                            class="js-example-basic-single select2-no-search select2-hidden-accessible @error('first_branch_id') is-invalid @enderror"
                            name="first_branch_id" required>
                            @foreach ($branches as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}
                            </option>
                            @endforeach
                        </select>
                        <div id="first_branch_id-js-error-valid"></div>

                        @error('first_branch_id')
                        <span class="error-msg-form">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="col-12 col-md-4 mb-2">
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

                    <div class="col-12 col-md-4 mb-2">

                        <label class="form-label">Birthday <small>(required)</small></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="bi bi-calendar2-week-fill"></i> </div>
                            </div>
                            <input name="birthday" type="text"
                                class="form-control hasdatetimepicker @error('birthday') is-invalid @enderror"
                                placeholder="YYYY/MM/DD" required value="{{ old('birthday') }}">
                        </div>
                        <div id="birthday-js-error-valid"></div>

                        @error('birthday')
                        <span class="error-msg-form">
                            {{ $message }}
                        </span>
                        @enderror

                    </div>

                </div>

                <hr>


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

                <div class="row mb-2">

                    <div class="col-12 col-md-6 mb-2">
                        <label class="form-label">Phone Number <small>(required)</small></label>
                        <input id="int-miphone" name="phone_number" type="tel"
                            class="form-control @error('phone_number') is-invalid @enderror" required
                            value="{{ old('phone_number') }}">

                        <div id="phonenumber-js-error-valid"></div>

                        @if ($errors->has('phone_number'))
                        <span class="error-msg-form">
                            {{ $errors->first('phone_number') }}
                        </span>
                        @else
                        <div class="form-text text-gray-200">We'll never share your email with anyone else.
                        </div>
                        @endif
                    </div>



                    <div class="col-12 col-md-6 mb-2">
                        <label class="form-label">Second Phone Number <small>(optional)</small></label>
                        <input id="int-miphone2" name="sec_phone_number" type="tel"
                            class="form-control @error('sec_phone_number') is-invalid @enderror"
                            value="{{ old('sec_phone_number') }}">

                        <div id="secphonenumber-js-error-valid"></div>

                        @error('sec_phone_number')
                        <span class="error-msg-form">
                            {{ $message }}
                        </span>
                        @enderror


                    </div>


                </div>

                <div class="d-flex justify-content-between p-4">
                    <input type="button" name="previous"
                        class="previous-form-steps btn btn-secondary action-button-previous" value="Previous" />
                    <input type="button" name="next" class="next-form-steps btn btn-primary action-button-next"
                        value="Continue" />
                </div>
            </div>

            <div class="cont_tap" id="about">


                <div class="row mb-2">

                    <div class="col-12 col-md-6 mb-2">
                        <label class="form-label">Height <small>(optional)</small></label>
                        <input name="height" type="number" class="form-control @error('height') is-invalid @enderror"
                            placeholder="Write your height here" value="{{ old('height') }}">

                        @error('height')
                        <span class="error-msg-form">
                            {{ $message }}
                        </span>
                        @enderror

                    </div>

                    <div class="col-12 col-md-6 mb-2">
                        <label class="form-label">Weight <small>(optional)</small></label>
                        <input name="weight" type="number" class="form-control @error('weight') is-invalid @enderror"
                            placeholder="Write your weight here" value="{{ old('weight') }}">

                        @error('weight')
                        <span class="error-msg-form">
                            {{ $message }}
                        </span>
                        @enderror

                    </div>


                </div>

                <div class="row mb-2">

                    <div class="col-12 col-md-6 mb-2">
                        <label class="form-label">Blood type <small>(optional)</small></label>
                        <input name="blood_type" type="text"
                            class="form-control @error('blood_type') is-invalid @enderror"
                            placeholder="Write your blood type here" value="{{ old('blood_type') }}">

                        @error('blood_type')
                        <span class="error-msg-form">
                            {{ $message }}
                        </span>
                        @enderror

                    </div>

                    <div class="col-12 col-md-6 mb-2">
                        <label class="form-label">Insurance<small> (optional)</small></label>
                        <input name="insurance" type="text"
                            class="form-control @error('insurance') is-invalid @enderror"
                            placeholder="Write your insurance company here" value="{{ old('insurance') }}">

                        @error('insurance')
                        <span class="error-msg-form">
                            {{ $message }}
                        </span>
                        @enderror

                    </div>
                </div>

                <div class="row mb-2">
                    <div class="mb-3">
                        <label class="form-label">Note <small>(optional)</small></label>
                        <textarea name="note" class="form-control" placeholder="Write here your notes .." rows="4"
                            spellcheck="false">{{ old('note') }}</textarea>
                    </div>
                </div>

                @error('note')
                <span class="error-msg-form">
                    {{ $message }}
                </span>
                @enderror


                <div class="d-flex text-center align-content-center mb-2">
                    <div class="g-recaptcha" id="feedback-recaptcha" data-sitekey="{{ env('GOOGLE_RECAPTCHA_KEY') }}">
                    </div>
                </div>

                @error('g-recaptcha-response')
                <span class="error-msg-form">
                    {{ $message }}
                </span>
                @enderror


                <div class="d-flex justify-content-between p-4">
                    <input type="button" name="previous"
                        class="previous-form-steps btn btn-secondary action-button-previous" value="Previous" />
                    <input type="submit" name="next" class="next-form-steps btn btn-primary action-button-next"
                        value="Send" />
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

            },
        });
</script>
<script>
    //for country and cities ajax inputs
        $('select[name="country_id"]').on('change', function(e) {
            e.preventDefault();

            var countryID = $(this).val();
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
                $('select[name="city"]').empty();
            }
        });
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