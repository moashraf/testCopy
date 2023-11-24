@extends('layouts.master')

@section('title', 'All Patients | Lam - School Management App')

@section('title-topbar', __('basic.all patients'))

<!-- css insert -->
@section('css')

<!-- select 2 -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/css/select2.min.css"
    integrity="sha512-aD9ophpFQ61nFZP6hXYu4Q/b/USW7rpLCQLX6Bi0WJHXNO7Js/fUENpBQf/+P4NtpzNX0jSgR5zVvPOJp+W2Kg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

<!-- boostrap datepicker -->
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css" />

<!-- datepicker time and date -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.css"
    integrity="sha512-MQXduO8IQnJVq1qmySpN87QQkiR1bZHtorbJBD0tzy7/0U9+YIC93QWHeGTEoojMVHWWNkoCp8V6OzVSYrX0oQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://fastly.jsdelivr.net/npm/flatpickr@4.6.13/dist/plugins/monthSelect/style.min.css">

@endsection

<!-- content insert -->

<!-- content insert -->
@section('content')

@section('fixedcontent')

<!-- session successful message -->
@if (Session::has('success'))
<div id="flash-msg" class="shadow pt-3">
    <div class="d-flex justify-content-between mb-2">
        <i class="fas fs-1 fa-check"></i>
        <a id="flash-msg-btn" class="text-blue-300 clickable-item-pointer"><i class="fas fa-times"></i></a>
    </div>
    <h3>Sent Successfully</h3>
    <p class="text-blue-300">{{ Session::get('success') }}</p>
</div>
@endif

@endsection

<div class="container-fluid px-md-2 mt-3">

    <!-- page title link -->
    <div class="d-sm-flex align-items-center justify-content-between mb-3">
        <span class="mb-0">
            <a class="link-cust-text text-gray-200 fw-light" href="{{ route('sett.home') }}">{{ __('basic.dashboard') }}
                |</a>
            <a class="link-cust-text text-gray-200 fw-light" href="{{ route('sett.managers.index') }}">{{
                __('basic.patients') }} | </a>
            <a class="text-gray-300">{{ __('basic.all patients') }}</a>
        </span>
    </div>



    <div class="row">

        <div class="col me-0 me-md-3 mb-3 mb-md-0 px-0 ">

            <div class="position-relative" style="top: 0; left: 0; width: 100%; height: 100%;">

                <div class="bg-white b-r-s-cont shadow pb-4 position-sticky top-0">
                    <h6 class="mb-0 p-3 main-color-bg text-white" style="border-radius: 18px 18px 0px 0px;"><i
                            class="fas fa-filter"></i> {{ __('basic.search filter') }}</h6>

                    <form id="myform" class="mt-1" method="GET" action="{{ route('sett.pat_show_all_patients') }}">

                        <div class="accordion search-accordion" id="accordionExample">

                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingSpec">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseReco" aria-expanded="true"
                                        aria-controls="collapseReco">
                                        <i class="fas fa-user me-1"></i> {{ __('basic.recommendation') }}
                                    </button>
                                </h2>
                                <div id="collapseReco" class="accordion-collapse collapse" aria-labelledby="headingSpec"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body py-0 px-3">

                                        <div class="form-group">
                                            <div class="form-check mb-1">
                                                <input class="form-check-input" value="1" type="radio" name="reco_srch"
                                                    id="r1" @if (request()->get('reco_srch') == 1) checked @endif>
                                                <label class="form-check-label" for="r1">
                                                    {{ __('basic.normal') }}
                                                </label>
                                            </div>
                                            <div class="form-check mb-1">
                                                <input class="form-check-input" value="2" type="radio" name="reco_srch"
                                                    id="r2" @if (request()->get('reco_srch') == 2) checked @endif>
                                                <label class="form-check-label" for="r2">
                                                    {{ __('basic.recommended') }}
                                                </label>
                                            </div>
                                            <div class="form-check mb-1">
                                                <input class="form-check-input" value="3" type="radio" name="reco_srch"
                                                    id="r3" @if (request()->get('reco_srch') == 3) checked @endif>
                                                <label class="form-check-label" for="r3">
                                                    {{ __('basic.not recommended') }}
                                                </label>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#country_side_search" aria-expanded="false"
                                        aria-controls="country_side_search">
                                        <i class="fas fa-globe-africa me-1"></i> {{ __('patientappo.country') }}
                                    </button>
                                </h2>
                                <div id="country_side_search" class="accordion-collapse collapse"
                                    aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                    <div class="accordion-body py-0 px-3">

                                        <div class="form-group">
                                            @foreach ($country as $item)
                                            <div class="form-check mb-1">
                                                <input class="form-check-input" value="{{ $item->country_id }}"
                                                    type="radio" name="country_srch" id="co{{ $item->country_id }}">
                                                <label class="form-check-label" for="co{{ $item->country_id }}">
                                                    {{ $item->country->name }}
                                                </label>
                                            </div>
                                            @endforeach
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#reference_side_search" aria-expanded="false"
                                        aria-controls="reference_side_search">
                                        <i class="fas fa-share-alt me-1"></i> {{ __('patientappo.resources') }}
                                    </button>
                                </h2>
                                <div id="reference_side_search" class="accordion-collapse collapse"
                                    aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                    <div class="accordion-body py-0 px-3">

                                        <div class="form-group">
                                            @foreach ($resources as $item)
                                            <div class="form-check mb-1">
                                                <input class="form-check-input" value="{{ $item->id }}" type="radio"
                                                    name="resource_srch" id="re{{ $item->id }}">
                                                <label class="form-check-label" for="re{{ $item->id }}">
                                                    {{ $item->name }}
                                                </label>
                                            </div>
                                            @endforeach
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingThree">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#city_side_search" aria-expanded="false"
                                        aria-controls="city_side_search">
                                        <i class="fas fa-map-marked-alt me-1"></i> {{ __('patientappo.city') }}
                                    </button>
                                </h2>
                                <div id="city_side_search" class="accordion-collapse collapse"
                                    aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                    <div class="accordion-body py-0 px-3">

                                        <div class="form-group">
                                            @foreach ($city as $item)
                                            <div class="form-check mb-1">
                                                <input class="form-check-input" value="{{ $item->city_id }}"
                                                    type="radio" name="city_srch" id="ci{{ $item->city_id }}">
                                                <label class="form-check-label" for="ci{{ $item->city_id }}">
                                                    {{ $item->city->name }}
                                                </label>
                                            </div>
                                            @endforeach
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingThree">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#gendar_side_search" aria-expanded="false"
                                        aria-controls="gendar_side_search">
                                        <i class="fas fa-venus-mars me-1"></i> {{ __('patientappo.gendar') }}
                                    </button>
                                </h2>
                                <div id="gendar_side_search" class="accordion-collapse collapse"
                                    aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                    <div class="accordion-body py-0 px-3">

                                        <div class="form-group">

                                            <div class="form-check mb-1">
                                                <input class="form-check-input" value="male" type="radio"
                                                    name="gendar_srch" id="male" @if (request()->get('gendar_srch') ===
                                                'male') checked @endif>
                                                <label class="form-check-label" for="male">
                                                    {{ __('patientappo.male') }}
                                                </label>
                                            </div>
                                            <div class="form-check mb-1">
                                                <input class="form-check-input" value="female" type="radio"
                                                    name="gendar_srch" id="female" @if (request()->get('gendar_srch')
                                                === 'female') checked @endif>
                                                <label class="form-check-label" for="female">
                                                    {{ __('patientappo.female') }}
                                                </label>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingThree">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#date_side_search" aria-expanded="false"
                                        aria-controls="date_side_search">
                                        <i class="fas fa-calendar-alt me-1"></i> {{ __('basic.date') }}
                                    </button>
                                </h2>
                                <div id="date_side_search" class="accordion-collapse collapse"
                                    aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                    <div class="accordion-body py-0 px-3">

                                        <div class="form-group">

                                            <input name="date_srch" type="text"
                                                class="form-control datepicker_time bg-white"
                                                value="{{ request()->get('date_srch') }}" placeholder="YYYY/MM/DD HM"
                                                data-enable-time="true" required>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="d-flex justify-content-center align-items-center mt-3">
                            <a class="text-gray-300 me-2" href="{{ route('sett.pat_show_all_patients') }}">{{
                                __('basic.reset') }}</a>
                            <button class="b-r-l-cont btn btn-primary px-4">{{ __('basic.search') }}</button>
                        </div>
                    </form>

                </div>

            </div>

        </div>

        <div class="col-12 col-md-9">

            <div class="d-flex justify-content-between align-items-center mb-2">
                <p class="text-gray-400 mb-0">{{ __('patientappo.total patients') }}
                    <span>{{ $patients->total() }}</span>
                </p>
                <a data-bs-toggle="modal" data-bs-target="#send_sms"
                    class="main-color-bg text-white btn btn-sm shadow-sm b-r-l-cont p-2 px-4"><i
                        class="fas fa-mobile-alt fa-sm me-1"></i> {{ __('basic.sms') }}</a>
            </div>

            <div class="modal fade" id="send_sms" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">

                    <form class="mb-0" action="{{ route('sett.pat_show_all_patients') }}" method="GET"
                        style="display: contents">

                        <input name="type_srch" value="{{ request()->input('type_srch') }}" type="hidden">
                        <input name="reco_srch" value="{{ request()->input('reco_srch') }}" type="hidden">
                        <input name="askfor_srch" value="{{ request()->input('askfor_srch') }}" type="hidden">
                        <input name="branch_srch" value="{{ request()->input('branch_srch') }}" type="hidden">
                        <input name="resource_srch" value="{{ request()->input('resource_srch') }}" type="hidden">
                        <input name="country_srch" value="{{ request()->input('country_srch') }}" type="hidden">
                        <input name="city_srch" value="{{ request()->input('city_srch') }}" type="hidden">
                        <input name="gendar_srch" value="{{ request()->input('gendar_srch') }}" type="hidden">
                        <input name="date_srch" value="{{ request()->input('date_srch') }}" type="hidden">

                        <div class="modal-content b-r-s-cont border-0">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-mobile-alt me-1"></i>
                                    {{ __('patientappo.send sms') }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>

                            <!-- Modal content -->
                            <div class="modal-body px-5 py-3">

                                <div class="row mb-2">
                                    <div class="col-12 mb-2">
                                        <label class="form-label">{{ __('patientappo.sms content') }}
                                            <small>({{ __('basic.required') }})</small></label>
                                        <textarea name="sms_content" class="form-control"
                                            placeholder="Write here your the sms content .." rows="4" spellcheck="false"
                                            required></textarea>

                                        @error('sms_content')
                                        <span class="error-msg-form">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>

                                </div>

                            </div>

                            <div class="modal-footer">
                                <div class="left-side">
                                    <button type="button" class="btn btn-default btn-link" data-bs-dismiss="modal">{{
                                        __('basic.never mind') }}</button>
                                </div>
                                <div class="divider"></div>
                                <div class="right-side">
                                    <button type="submit" class="btn btn-default btn-link main-color">{{
                                        __('basic.send') }}</button>
                                </div>
                            </div>

                        </div>
                    </form>

                </div>

            </div>

            <div>
                @foreach ($patients as $item)
                @if ($item->type == 1)
                @php
                $type = __('basic.patient');
                $type_color = 'main-color';
                @endphp
                @elseif ($item->type == 2)
                @php
                $type = __('basic.leads no action');
                $type_color = 'text-petroleum-light';
                @endphp
                @elseif ($item->type == 3)
                @php
                $type = __('basic.leads interested');
                $type_color = 'text-green-ligh';
                @endphp
                @elseif ($item->type == 4)
                @php
                $type = __('basic.leads not interested');
                $type_color = 'text-red';
                @endphp
                @elseif ($item->type == 5)
                @php
                $type = __('basic.website');
                $type_color = 'text-green-ligh';
                @endphp
                @endif
                <div class="row align-items-center shadow b-r-s-cont bg-white p-2 mb-2">

                    <div class="col-12 col-md-4 d-flex align-items-center mb-2 mb-md-0">
                        <img class="rounded-circle avatar-small2 me-3"
                            src="{{ URL::asset('img/useravatar/' . $item->avatar) }}">
                        <div class="">
                            <p class="mb-0 text-xs text-gray-300">
                                {{ date('d M Y', strtotime($item->created_at)) }}</p>
                            <a href="{{ route('sett.managers.show', $item->id) }}"
                                class="mb-1 fw-bold text-s text-gray-600">
                                {{ $item->full_name }}
                            </a>
                            <p class="mb-0 text-xs text-gray-400"><strong>
                                    <i class="fas fa-circle {{ $type_color }} text-xxs"></i>
                                    {{ $type }}
                                </strong>
                            </p>
                        </div>
                    </div>

                    <div class="col text-center">
                        <h6 class="text-gray-300 text-xs mb-1">{{ __('patientappo.phone number') }}</h6>
                        <h6 class="text-s text-gray-500 text-truncate">{{ $item->phone_number }}
                        </h6>
                    </div>

                    <div class="col text-center">
                        <h6 class="text-gray-300 text-xs mb-1">{{ __('patientappo.age') }}</h6>
                        <h6 class="text-s text-gray-500 text-truncate">
                            {{ \Carbon\Carbon::parse($item->birthday)->diff(\Carbon\Carbon::now())->format('%y Years')
                            }}
                        </h6>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="d-flex mt-4 justify-content-end">
                {{ $patients->appends(request()->input())->links() }}
            </div>

        </div>
    </div>


</div>

@endsection


<!-- js insert -->
@section('js')

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/js/select2.min.js"
    integrity="sha512-4MvcHwcbqXKUHB6Lx3Zb5CEAVoE9u84qN+ZSMM6s7z8IeJriExrV3ND5zRze9mxNlABJ6k864P/Vl8m0Sd3DtQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    $('.js-example-basic-single').select2({
        minimumResultsForSearch: -1,
    });
    $(".myselect2-additem-insert").select2({
        dropdownParent: $("#add_notes")
    });
    //hide search
    $('.select2-no-search-additem').select2({
        dropdownParent: $("#add_notes"),
        minimumResultsForSearch: -1
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

<!-- datapicker date and time -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.js"
    integrity="sha512-K/oyQtMXpxI4+K0W7H25UopjM8pzq0yrVdFdG21Fh5dBe91I40pDd9A4lzNlHPHBIP2cwZuoxaUSX0GJSObvGA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://fastly.jsdelivr.net/npm/flatpickr@4.6.13/dist/plugins/monthSelect/index.min.js"></script>

<script>
    $(document).ready(function() {
        //-------- datepicker time --------
        $('.datepicker_time').flatpickr({
            enableTime: true,
            mode: "range",
            locale: {
                rangeSeparator: 'to'
            },
            plugins: [
                new monthSelectPlugin({
                    shorthand: true, //defaults to false
                    dateFormat: "m-Y", //defaults to "F Y"
                    altFormat: "F Y", //defaults to "F Y"
                    theme: "dark", // defaults to "light"
                })
            ]
        });

    })
</script>

@endsection