@extends('layouts.master')

@section('title', 'New User | Lam - School Management App')

@section('title-topbar', __('basic.new worker'))

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
            <a class="link-cust-text text-gray-200 fw-light" href="{{ route('sett.home') }}">{{ __('basic.dashboard')}}
                |</a>
            <a class="link-cust-text text-gray-200 fw-light" href="{{ route('sett.admin.index') }}">{{
                __('basic.workers')}} | </a>
            <a class="text-gray-300">{{ __('basic.new worker')}}</a>
        </span>
    </div>

    <div class="card card-input shadow mb-3 pb-3">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 fw-bold text-gray-500"><i class="fas fa-user me-2"></i> {{ __('basic.new worker')}}</h6>
        </div>

        <!-- Card Body -->
        <div class="card-body px-3">

            <div class="multi-setps-form-calander col-12">

                <form id="myform" class="myform" method="POST" action="{{ route('sett.admin.store') }}"
                    enctype="multipart/form-data">

                    @csrf

                    <!-- progressbar -->
                    <ul class="ps-0 progressbar" id="progressbar">
                        <li class="active">

                            <a>
                                <!-- in case we want to use prog selector href="#clinics" -->
                                <div class="icon-circle checked d-flex align-items-center justify-content-center">
                                    <i class="bi bi-gear"></i>
                                </div>
                                {{ __('patientappo.basic')}}
                            </a>
                        </li>

                        <li>
                            <a>
                                <div class="icon-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-person"></i>
                                </div>
                                {{ __('patientappo.personal')}}
                            </a>
                        </li>

                        <li>
                            <a>
                                <div class="icon-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-pin-map"></i>
                                </div>
                                {{ __('basic.work')}}
                            </a>
                        </li>
                        <li>
                            <a>
                                <div class="icon-circle d-flex align-items-center justify-content-center">
                                    <i class="far fa-paper-plane"></i>
                                </div>
                                {{ __('basic.sending')}}
                            </a>
                        </li>
                    </ul>

                    <!-- content -->

                    <div class="cont_tap " id="clinics">

                        <div class="row mb-1">
                            <div class="col-12 col-md-5 align-self-center mb-2">

                                <div class="avatar-update-container">
                                    <div class="picture">
                                        <img src="{{ URL::asset('img/dashboard/avatars/default-pp.png') }}"
                                            class="picture-src" id="mib_PicturePreview" title="" />
                                        <input type="file" name='avatar' accept="image/*" id="mib_img_input">
                                    </div>
                                    <h6 class="text-gray-300"> {{ __('basic.choose pic')}}</h6>

                                    @error('avatar')
                                    <span class="error-msg-form">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>


                            </div>


                            <div class="col-12 col-md-7 mb-2">
                                <div class="mb-3">
                                    <label class="form-label"> {{ __('patientappo.first name')}} <small>({{
                                            __('basic.required')}})</small></label>
                                    <input name="first_name" type="text"
                                        class="form-control @error('first_name') is-invalid @enderror"
                                        placeholder="Ahmed..." value="{{ old('first_name') }}" autofocus required>
                                </div>

                                @error('first_name')
                                <span class="error-msg-form">
                                    {{ $message }}
                                </span>
                                @enderror

                                <div class="mb-3">
                                    <label class="form-label">{{ __('patientappo.second name')}} <small>({{
                                            __('basic.required')}})</small></label>
                                    <input name="second_name" type="text"
                                        class="form-control @error('second_name') is-invalid @enderror"
                                        placeholder="Yousef..." value="{{ old('second_name') }}" required>
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
                                <label class="form-label">{{ __('patientappo.email')}} <small>({{
                                        __('basic.required')}})</small></label>
                                <input name="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    placeholder="Write your email here" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                <span class="error-msg-form">
                                    {{ $errors->first('email') }}
                                </span>
                                @else
                                <div class="form-text text-gray-200">We'll never share your email with anyone else.
                                </div>
                                @endif

                            </div>

                            <div class="col-12 col-md-6 mb-2">
                                <label class="form-label">{{ __('basic.role')}} <small>(required)</small></label>
                                <select class="js-example-basic-single select2-no-search select2-hidden-accessible"
                                    name="role[]" multiple required>
                                    @foreach ($roles as $iteam)
                                    <option value="{{ $iteam->id }}">{{ $iteam->name }}</option>
                                    @endforeach
                                </select>
                                <div id="role-js-error-valid"></div>

                                @error('role')
                                <span class="error-msg-form">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>

                        </div>

                        <div class="row mb-2">
                            <div class="col-12 col-md-6 mb-2">
                                <label class="form-label">{{ __('patientappo.password')}} <small>({{
                                        __('basic.required')}})</small></label>
                                <input id="password" name="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    placeholder="Wrtie your password here..." value="{{ old('password') }}" required>

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
                                <label class="form-label">{{ __('patientappo.confirm password')}} <small>({{
                                        __('basic.required')}})</small></label>
                                <input name="password_confirmation" type="password" class="form-control"
                                    placeholder="Confirm your password..." id="password-confirm"
                                    value="{{ old('password_confirmation') }}" required>
                            </div>

                        </div>

                        <div class="d-flex justify-content-end mt-3">
                            <input type="button" name="next" class="next-form-steps btn btn-primary action-button-next"
                                value="Continue" />
                        </div>
                    </div>


                    <div class="cont_tap" id="time">

                        <div class="row mb-2">

                            <div class="col-12 col-md-3 mb-2">
                                <label class="form-label">{{
                                    __('patientappo.gendar')}} <small>({{
                                        __('basic.required')}})</small></label>
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

                            <div class="col-12 col-md-3 mb-2">
                                <label class="form-label">{{
                                    __('basic.religion')}} <small>({{
                                        __('basic.optional')}})</small></label>
                                <select
                                    class="js-example-basic-single select2-no-search select2-hidden-accessible @error('religion') is-invalid @enderror"
                                    name="religion">
                                    <option value="1">{{ __('basic.not selected') }}</option>
                                    <option value="2">{{ __('basic.muslim') }}</option>
                                    <option value="3">{{ __('basic.christian') }}</option>
                                </select>
                                <div id="religion-js-error-valid"></div>

                                @error('religion')
                                <span class="error-msg-form">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>

                            <div class="col-12 col-md-3 mb-2">
                                <label class="form-label">{{ __('basic.identity document number')}} <small>({{
                                        __('basic.optional')}})</small></label>
                                <input name="identity_doc_number" type="text"
                                    class="form-control @error('identity_doc_number') is-invalid @enderror"
                                    placeholder="identity document numbers ..."
                                    value="{{ old('identity_doc_number') }}">
                                @error('identity_doc_number')
                                <span class="error-msg-form">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>

                            <div class="col-12 col-md-3 mb-2">
                                <label class="form-label">{{
                                    __('patientappo.birthday')}} <small>({{
                                        __('basic.required')}})</small></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="bi bi-calendar2-week-fill"></i> </div>
                                    </div>
                                    <input name="birthday" type="text"
                                        class="form-control hasdatetimepicker @error('birthday') is-invalid @enderror"
                                        placeholder="YYYY/MM/DD" value="{{ old('birthday') }}" required>
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
                                <label class="form-label">{{
                                    __('patientappo.country')}} <small>(required)</small></label>
                                <select
                                    class="js-example-basic-single select2-hidden-accessible @error('country') is-invalid @enderror"
                                    name="country" required>
                                    @foreach ($countries as $iteam)
                                    <option value="{{ $iteam->id }}">{{ $iteam->name }}</option>
                                    @endforeach
                                </select>
                                <div id="country-js-error-valid"></div>

                                @error('country')
                                <span class="error-msg-form">
                                    {{ $message }}
                                </span>
                                @enderror

                            </div>

                            <div class="col-12 col-md-4 mb-2">
                                <label class="form-label">{{
                                    __('patientappo.city')}} <small>({{
                                        __('basic.required')}})</small></label>
                                <select
                                    class="js-example-basic-single select2-hidden-accessible @error('city') is-invalid @enderror"
                                    name="city" required>
                                    <option disabled selected>Open this select menu</option>
                                </select>

                                <div id="city-js-error-valid"></div>

                                @if ($errors->has('city'))
                                <span class="error-msg-form">
                                    {{ $errors->first('city') }}
                                </span>
                                @else
                                <div class="form-text text-gray-200">Select the country first
                                </div>
                                @endif
                            </div>

                            <div class="col-12 col-md-4 mb-2">
                                <label class="form-label">{{ __('basic.address')}} <small>({{
                                        __('basic.optional')}})</small></label>
                                <input name="address" type="text"
                                    class="form-control @error('address') is-invalid @enderror"
                                    placeholder="User Address ..." value="{{ old('address') }}">
                                @error('address')
                                <span class="error-msg-form">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>

                        </div>

                        <hr>

                        <div class="row mb-2">

                            <div class="col-12 col-md-3 mb-2">
                                <label class="form-label">{{
                                    __('basic.educational qualification')}} <small>({{
                                        __('basic.optional')}})</small></label>
                                <select
                                    class="js-example-basic-single select2-hidden-accessible @error('user_edu_qualification_id') is-invalid @enderror"
                                    name="user_edu_qualification_id">
                                    @foreach ($edu_qualifications as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                <div id="user_edu_qualification_id-js-error-valid"></div>
                                @error('user_edu_qualification_id')
                                <span class="error-msg-form">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>

                            <div class="col-12 col-md-3 mb-2">
                                <label class="form-label">{{
                                    __('basic.marital status')}} <small>({{
                                        __('basic.optional')}})</small></label>
                                <select
                                    class="js-example-basic-single select2-hidden-accessible @error('marital_status') is-invalid @enderror"
                                    name="marital_status">
                                    <option value="1">{{ __('basic.not selected') }}</option>
                                    <option value="2">{{ __('basic.single martial status') }}</option>
                                    <option value="3">{{ __('basic.married') }}</option>
                                    <option value="4">{{ __('basic.divorced') }}</option>
                                    <option value="5">{{ __('basic.widowed') }}</option>
                                </select>
                                <div id="marital_status-js-error-valid"></div>
                                @error('marital_status')
                                <span class="error-msg-form">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>

                            <div class="col-12 col-md-3 mb-2">
                                <label class="form-label">{{
                                    __('basic.military status')}} <small>({{ __('basic.optional') }})</small></label>
                                <select
                                    class="js-example-basic-single select2-hidden-accessible @error('military_status') is-invalid @enderror"
                                    name="military_status">
                                    <option value="1">{{ __('basic.not selected') }}</option>
                                    <option value="2">{{ __('basic.does not have') }}</option>
                                    <option value="3">{{ __('basic.done') }}</option>
                                    <option value="4">{{ __('basic.exempted') }}</option>
                                    <option value="5">{{ __('basic.postponed') }}</option>
                                </select>
                                <div id="military_status-js-error-valid"></div>

                                @error('military_status')
                                <span class="error-msg-form">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>

                            <div class="col-12 col-md-3 mb-2">
                                <label class="form-label">{{
                                    __('basic.driving license')}} <small>({{ __('basic.optional') }})</small></label>
                                <select
                                    class="js-example-basic-single select2-hidden-accessible @error('driving_license') is-invalid @enderror"
                                    name="driving_license">
                                    <option value="1">{{ __('basic.not selected') }}</option>
                                    <option value="2">{{ __('basic.private license') }}</option>
                                </select>
                                <div id="driving_license-js-error-valid"></div>

                                @error('driving_license')
                                <span class="error-msg-form">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>

                        </div>

                        <hr>

                        <div class="row mb-2">

                            <div class="col-12 col-md-6 mb-2">
                                <label class="form-label">{{
                                    __('patientappo.phone number')}} <small>({{
                                        __('basic.required')}})</small></label>
                                <input id="int-miphone" name="phone_number" type="tel"
                                    class="form-control @error('phone_number') is-invalid @enderror"
                                    value="{{ old('phone_number') }}" required>

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
                                <label class="form-label">{{
                                    __('patientappo.second phone number')}} <small>({{
                                        __('basic.optional')}})</small></label>
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

                            <div class="col-12 col-md-4 mb-2">
                                <label class="form-label">{{
                                    __('basic.job title')}} <small>({{ __('basic.optional') }})</small></label>
                                <select
                                    class="js-example-basic-single select2-hidden-accessible @error('job_title_id') is-invalid @enderror"
                                    name="job_title_id">
                                    @foreach ($job_titles as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                <div id="job_title_id-js-error-valid"></div>

                                @error('job_title_id')
                                <span class="error-msg-form">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>

                            <div class="col-12 col-md-4 mb-2">
                                <label class="form-label">{{
                                    __('basic.started work')}} <small>({{
                                        __('basic.required')}})</small></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="bi bi-calendar2-week-fill"></i> </div>
                                    </div>
                                    <input name="started_work" type="text"
                                        class="form-control hasdatetimepicker @error('started_work') is-invalid @enderror"
                                        placeholder="YYYY/MM/DD" value="{{ old('started_work') }}" required>
                                </div>
                                <div id="startedwork-js-error-valid"></div>


                                @error('started_work')
                                <span class="error-msg-form">
                                    {{ $message }}
                                </span>
                                @enderror

                            </div>

                            <div class="col-12 col-md-4 mb-2">
                                <label class="form-label">{{
                                    __('basic.activision')}} <small>(({{
                                        __('basic.required')}}))</small></label>
                                <select
                                    class="js-example-basic-single select2-no-search select2-hidden-accessible @error('deactivate') is-invalid @enderror"
                                    name="deactivate" required>
                                    <option value="0">Active</option>
                                    <option value="1">Deactivate</option>
                                </select>
                                <div id="deactivate-js-error-valid"></div>

                                @error('deactivate')
                                <span class="error-msg-form">
                                    {{ $message }}
                                </span>
                                @enderror

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 align-self-start mb-2">
                                <label class="form-label">{{ __('basic.choose img') }} <small>({{ __('basic.optional')
                                        }})</small></label><br>
                                <input class="form-control file_dropzone_cuts" type="file" name="all_imgs[]"
                                    id="myGreatDropzone" multiple>
                                @error('all_imgs')
                                <span class="error-msg-form">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="mb-3">
                                <label class="form-label">{{
                                    __('basic.note')}} <small>({{
                                        __('basic.optional')}})</small></label>
                                <textarea name="note" class="form-control" placeholder="Write here your notes .."
                                    rows="4" spellcheck="false">{{ old('note') }}</textarea>
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
                                value="{{
                                    __('basic.send')}}" />
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
            }).on('change', function(){
                $('.datepicker').hide();
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

            },
        });
</script>
<script>
    //for country and cities ajax inputs
        $('select[name="country"]').on('change', function(e) {
            e.preventDefault();

            var countryID = $(this).val();
            var url = "{{ route('sett.createcityajax', ':id') }}";
            url = url.replace(':id', countryID);

            if (countryID) {
                $.ajax({
                    url: url,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('select[name="city"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="city"]').append('<option value="' +
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