@extends('layouts.master')

@section('title', $patient->first_name . ' ' . $patient->second_name . ' | Lam - School Management App')
@section('title-topbar', __('patientappo.patient profile'))

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

<!-- tables -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.2/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/autofill/2.3.9/css/autoFill.bootstrap5.min.css">

@endsection


@section('fixedcontent')

<!-- session successful message -->
@if (Session::has('success'))
<div id="flash-msg" class=" shadow-lg pt-3">
    <div class="d-flex justify-content-between mb-2">
        <i class="fas fs-1 fa-check"></i>
        <a id="flash-msg-btn" class="text-blue-300 clickable-item-pointer"><i class="fas fa-times"></i></a>
    </div>
    <h3>Done</h3>
    <p class="text-blue-300">{{ Session::get('success') }}</p>
</div>
@endif


<!-- session successful message -->
@if (Session::has('error_delete'))
<div id="flash-msg" class="shadow pt-3" style="background-color:#ff4152;">
    <div class="d-flex justify-content-between mb-2">
        <i class="fas fs-1 fa-times"></i>
        <a id="flash-msg-btn" class="text-blue-300 clickable-item-pointer"><i class="fas fa-times"
                style="color:#ffb4bc"></i></a>
    </div>
    <h3>Can not be deleted</h3>
    <p style="color:#ffb4bc">{{ Session::get('error_delete') }}</p>
</div>
@endif
@endsection

<!-- content insert -->
@section('content')

<div class="container-fluid px-0">

    <!-- msg success -->
    <div id="flash-msg-cont"></div>

    @foreach ($errors->all() as $error)
    <div class="text-red"><i class="fas fa-exclamation me-1"></i> {{ $error }}</div>
    @endforeach

    <!-- page title link -->
    <div class="d-flex flex-wrap align-items-center justify-content-between mb-3">

        <!-- page title link -->
        <span class="mb-0">
            <a class="link-cust-text text-gray-200 fw-light" href="{{ route('sett.home') }}">{{ __('basic.dashboard') }}
                |</a>
            <a class="link-cust-text text-gray-200 fw-light" href="{{ route('sett.managers.index') }}">{{
                __('basic.patient') }} | </a>
            <a class="text-gray-300">{{ $patient->first_name }}</a>
        </span>

        <div class="d-flex flex-wrap justify-content-center mt-2">


            @role('Super-admin|Trip-manager|Package-manager|Transport-manager|Visa-manager|Hotel-manager|Operation-manager|Operation-worker')

            <a data-bs-toggle="modal" data-bs-target="#send_sms"
                class="bg-white text-gray-400 btn btn-sm shadow-sm b-r-l-cont p-2 px-4 me-2 mb-2 mb-md-0"><i
                    class="fas fa-mobile-alt fa-sm me-1"></i> SMS</a>

            <div class="modal fade" id="send_sms" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">

                    <form class="mb-0" action="{{ route('sett.pat_sms_form_profile', $patient->id) }}" method="GET"
                        style="display: contents">

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
                                            placeholder="Write here your the sms content .." rows="4"
                                            spellcheck="false"></textarea>

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

            @role('Super-admin|Operation-manager')
            <a target="_blank" title="delete" data-effect="effect-scale" data-bs-toggle="modal"
                data-bs-target="#delete_modal" class="btn btn-danger text-xs shadow-sm b-r-l-cont p-2 px-4 me-2"><i
                    class="fas fa-trash-alt me-1"></i> {{ __('basic.delete') }}</a>

            <!-- Modal -->
            <div class="modal fade" id="delete_modal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable ">
                    <div class="modal-content b-r-s-cont border-0">

                        <div class="modal-header">
                            <div class="modal-title" id="exampleModalLabel"><i class="fas fa-trash me-1"></i>
                                {{ __('basic.delete') }}</div>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <form action="{{ route('sett.managers.destroy', 'test') }}" method="post">
                            {{ method_field('delete') }}
                            {{ csrf_field() }}

                            <!-- Modal content -->
                            <div class="modal-body px-4">

                                <div class="modal-body delete-conf-input text-center py-0">
                                    <p class="mb-0">{{ __('basic.delete message') }}</p><br>
                                    <input type="hidden" name="patient_id" value="{{ $patient->id }}">
                                </div>
                            </div>

                            <div class="modal-footer">
                                <div class="left-side">
                                    <button type="button" class="btn btn-default btn-link" data-bs-dismiss="modal">{{
                                        __('basic.never mind') }}</button>
                                </div>
                                <div class="divider"></div>
                                <div class="right-side">
                                    <button type="submit" class="btn btn-default btn-link text-red">{{
                                        __('basic.delete') }}
                                    </button>
                                </div>

                            </div>
                        </form>

                    </div>
                </div>
            </div>

            <a data-bs-toggle="modal" data-bs-target="#edit_recom"
                class="bg-white text-gray-400 btn btn-sm shadow-sm b-r-l-cont p-2 px-4 me-2 mb-2 mb-md-0"><i
                    class="fas fa-pen fa-sm me-1"></i> {{ __('basic.slight edit') }}</a>

            <!-- Modal for inserting the past appointments -->
            <div class="modal fade" id="edit_recom" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content b-r-s-cont border-0">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-pen me-1"></i>
                                {{ __('basic.edit') }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <form class="mb-0" action="{{ route('sett.pat_slight_edit') }}" method="post">
                            {{ method_field('PATCH') }}
                            {{ csrf_field() }}

                            <!-- Modal content -->
                            <div class="modal-body px-5 py-3">

                                <div class="row mb-2">

                                    <div class="col-12 mb-2">
                                        <label class="form-label">{{ __('basic.type') }}
                                            <small>({{ __('basic.required') }})</small></label>
                                        <select
                                            class="myselect2-recom-insert select2-hidden-accessible @error('edit_type_status') is-invalid @enderror"
                                            id="edit_type_status" name="edit_type_status" required>
                                            <option @if ($patient->inactive == 0) selected @endif value="1">
                                                {{ __('basic.active') }}
                                            </option>
                                            <option @if ($patient->inactive == 1) selected @endif value="2">
                                                {{ __('basic.inactive') }}
                                            </option>
                                        </select>

                                        <span id="edit_type_status_error" class="error-msg-form"></span>

                                        @error('edit_type_status')
                                        <span class="error-msg-form">
                                            {{ $message }}
                                        </span>
                                        @enderror

                                    </div>

                                    <div class="col-12 mb-2">
                                        <label class="form-label">{{ __('basic.recommendation') }}
                                            <small>({{ __('basic.required') }})</small></label>
                                        <select
                                            class="myselect2-recom-insert select2-hidden-accessible @error('edit_recom_status') is-invalid @enderror"
                                            id="edit_recom_status" name="edit_recom_status" required>
                                            <option @if ($patient->recommendation == 1) selected @endif value="1">
                                                {{ __('basic.normal') }}
                                            </option>
                                            <option @if ($patient->recommendation == 2) selected @endif value="2">
                                                {{ __('basic.recommended') }}
                                            </option>
                                            <option @if ($patient->recommendation == 3) selected @endif value="3">
                                                {{ __('basic.not recommended') }}
                                            </option>
                                        </select>

                                        <span id="edit_recom_status_error" class="error-msg-form"></span>

                                        @error('edit_recom_status')
                                        <span class="error-msg-form">
                                            {{ $message }}
                                        </span>
                                        @enderror

                                    </div>
                                </div>

                                <input name="patient_id" value="{{ $patient->id }}" type="hidden">

                            </div>

                            <div class="modal-footer">
                                <div class="left-side">
                                    <button type="button" class="btn btn-default btn-link" data-bs-dismiss="modal">{{
                                        __('basic.never mind') }}</button>
                                </div>
                                <div class="divider"></div>
                                <div class="right-side">
                                    <button type="submit" class="btn btn-default btn-link main-color">Edit
                                    </button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>

            </div>
            @endrole

            <a href="{{ route('sett.managers.edit', $patient->id) }}"
                class="bg-white btn btn-sm shadow-sm b-r-l-cont p-2 px-4 text-gray-400 me-2 mb-2 mb-md-0"><i
                    class="fas fa-user-edit fa-sm text-gray-300 me-1"></i> {{ __('basic.edit') }}</a>
            @endrole
        </div>

    </div>

    <!-- welcome msg & note -->
    <div class="row mb-4">
        <div class="col-lg-6 col-sm-12">
            <div class="card shadow mb-4 mb-lg-0">

                <!-- Card Body -->
                <div class="card-body row">
                    <div class="col align-self-center border-flex ps-3">

                        <div class="d-flex mb-4 align-items-center">
                            <div class="position-relative">
                                @if ($patient->recommendation == 1)
                                @php
                                $recom_color = 'main-color-bg-200';
                                $recom_msg = __('basic.normal');
                                @endphp
                                @elseif ($patient->recommendation == 2)
                                @php
                                $recom_color = 'text-green-ligh-bg';
                                $recom_msg = __('basic.recommended');
                                @endphp
                                @elseif ($patient->recommendation == 3)
                                @php
                                $recom_color = 'text-red-bg';
                                $recom_msg = __('basic.not recommended');
                                @endphp
                                @endif
                                <img class="rounded-circle avatar-lg me-3"
                                    src="{{ URL::asset('img/useravatar/' . $patient->avatar) }}">
                                <div data-toggle="tooltip" data-placement="top" title="{{ $recom_msg }}"
                                    class="status-indicator-img {{ $recom_color }}"></div>
                            </div>
                            <div class="">
                                <p class=" mb-0 text-xs text-gray-300">
                                    {{ $patient->created_at }}
                                </p>
                                <h5 class="mb-1 fw-bold text-gray-600">
                                    {{ $patient->first_name . ' ' . $patient->second_name }}</h5>
                                <p class="mb-0 text-xs text-gray-400">{{ __('basic.code') }} <strong>
                                        {{ $patient->code }}</strong></p>
                            </div>
                        </div>

                        <div class="d-flex ps-2 justify-content-between">


                            <div class="align-items-center text-center  ">
                                <p class="text-xxs fw-normal mb-1 text-gray-400">{{ __('basic.status') }}</p>
                                <span class="text-s fw-bold text-gray-600">
                                    @if ($patient->inactive == 0)
                                    <i class="fas fa-circle text-green me-1"></i> {{ __('basic.active') }}
                                    @elseif ($patient->type == 1)
                                    <i class="fas fa-circle text-red me-1"></i> {{ __('basic.inactive') }}
                                    @endif
                                </span>
                            </div>

                            <div class="align-items-center text-center  ">
                                <p class="text-xxs fw-normal mb-1 text-gray-400">{{ __('basic.creator') }}</p>
                                <span class="text-s fw-bold text-gray-600"><i
                                        class="fas fa-id-card-alt fa-sm fa-fw text-gray-300"></i>
                                    @if ($patient->creator)
                                    {{ $patient->creator->first_name }}
                                    @else
                                    No ONE
                                    @endif
                                    <small class="text-xxs text-gray-200"></small></span>
                            </div>
                        </div>
                    </div>


                    <div class="col-12 col-sm ps-4 pt-3">

                        <div id="patient-info-caro" class="carousel slide">

                            <div class="carousel-indicators dots-radius-carousel"
                                style="bottom: -28px; margin-bottom: 0px;">
                                <button type="button" data-bs-target="#patient-info-caro" data-bs-slide-to="0"
                                    class="active" aria-current="true" aria-label="Slide 1"></button>
                                <button type="button" data-bs-target="#patient-info-caro" data-bs-slide-to="1"
                                    aria-label="Slide 2"></button>
                            </div>

                            <div class="carousel-inner mb-3">

                                <!-- info 1 -->
                                <div class="carousel-item active">

                                    <div class="row mb-2">
                                        <div class="col">
                                            <h6 class="text-gray-300 text-xs mb-1">{{ __('basic.first school') }}</h6>
                                            <p class="text-gray-600 text-s fw-bold">
                                                @if($patient->first_school)
                                                {{ $patient->first_school->name }}
                                                @endif
                                            </p>
                                        </div>
                                        <div class="col">
                                            <h6 class="text-gray-300 text-xs mb-1">{{ __('basic.second school') }}</h6>
                                            <p class="text-gray-600 text-s fw-bold">
                                                @if($patient->second_school)
                                                {{ $patient->second_school->name }}
                                                @endif
                                            </p>
                                        </div>
                                    </div>

                                    <div class="row mb-2">
                                        <div class="col">
                                            <h6 class="text-gray-300 text-xs mb-1">{{ __('patientappo.ph number') }}
                                            </h6>
                                            <a href="tel:{{ $patient->phone_number }}"
                                                class="text-gray-600 text-xs fw-bold">{{ $patient->phone_number }}</a>
                                        </div>
                                        <div class="col">
                                            <h6 class="text-gray-300 text-xs mb-1">{{ __('basic.shared school') }}</h6>
                                            <p class="text-gray-600 text-s fw-bold">

                                                @if($patient->shared_school == 1)
                                                {{ __('basic.no') }}
                                                @else
                                                {{ __('basic.yes') }}

                                                @endif
                                            </p>
                                        </div>
                                    </div>

                                    <div class="row">

                                        <div class="col">
                                            <h6 class="text-gray-300 text-xs mb-1">{{ __('patientappo.resource') }}
                                            </h6>
                                            <p class="text-gray-600 text-s fw-bold">{{ $patient->recourse->name }}
                                            </p>
                                        </div>
                                        <div class="col pt-3">
                                            <p class="@if ($patient->note) text-green-ligh
                                                    @else
                                                    main-color @endif
                                                    text-xs fw-bold clickable-item-pointer" data-bs-toggle="modal"
                                                data-bs-target="#patient_note"><i class="fas fa-comment-alt"></i>
                                                {{ __('basic.note') }}

                                                @if ($patient->note)
                                                <span class="badge rounded badge-danger badge-counter"
                                                    style="border-radius: 50% !important;height: 15px;width: 15px;padding: 3px !important;">1</span>
                                                @endif

                                            </p>

                                            <!-- Modal -->
                                            <div class="modal fade" id="patient_note" tabindex="-1"
                                                aria-labelledby="exampleModalLabel2" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                                    <div class="modal-content b-r-s-cont border-0">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel2"><i
                                                                    class="fas fa-quote-left me-1"></i>
                                                                {{ __('patientappo.patient note') }}</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>

                                                        <!-- Modal content -->
                                                        <div class="modal-body px-4">
                                                            <div class="mb-3">
                                                                <label class="form-label">{{ __('basic.note') }}
                                                                    <small></small></label>
                                                                <textarea name="note" class="form-control"
                                                                    placeholder="Write here your notes .." rows="4"
                                                                    spellcheck="false"
                                                                    date-text="Write here your notes ..">{{ $patient->note }}</textarea>
                                                            </div>
                                                        </div>

                                                        <div class="modal-footer">
                                                            <div class="left-side">
                                                                <button type="button" class="btn btn-default btn-link"
                                                                    data-bs-dismiss="modal">{{ __('basic.never mind')
                                                                    }}</button>
                                                            </div>
                                                            <div class="divider"></div>
                                                            <div class="right-side">
                                                                <button type="button" id="note_ajax"
                                                                    class="btn btn-default btn-link main-color"
                                                                    data-bs-dismiss="modal">{{ __('basic.save changes')
                                                                    }}</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- info 2 -->
                                <div class="carousel-item">

                                    <div class="row mb-2">

                                        <div class="col">
                                            <h6 class="text-gray-300 text-xs mb-1">
                                                {{ __('patientappo.sec ph number') }}
                                            </h6>
                                            <p class="text-gray-600 text-xs fw-bold">
                                                {{ $patient->sec_phone_number }}
                                            </p>
                                        </div>
                                    </div>

                                    <div class="row mb-2">
                                        <div class="col">
                                            <h6 class="text-gray-300 text-xs mb-1">{{ __('patientappo.gendar') }}
                                            </h6>
                                            <p class="text-gray-600 text-s fw-bold">{{ $patient->gendar }}</p>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="row h-100">
                <div class="col-12 pe-2">
                    <div class="card h-100 shadow text-white" style="background-color: #77BEFF;">
                        <!-- Card Header - Dropdown -->
                        <div
                            class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-transparent border-bottom-0">
                            <h6 class="m-0 fw-bold">{{ __('basic.total students') }}</h6>
                        </div>

                        <!-- Card Body -->
                        <div class="card-body d-flex align-self-center align-items-center text-center p-0">
                            <div class="mb-2">
                                <i class="text-xl mb-3 fas fa-child"></i>
                                <h2 class="fw-bold">{{ count($patient->students) }} <div class=" text-xs">{{
                                        __('basic.students') }}</div>
                                </h2>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

        <div class="col">

            <div class="row h-100">

                <div class="col-12 pe-2">
                    <div class="card h-100 shadow text-white" style="background-color: #77BEFF;">
                        <!-- Card Header - Dropdown -->
                        <div
                            class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-transparent border-bottom-0">
                            <h6 class="m-0 fw-bold">{{ __('basic.total teachers') }}</h6>
                        </div>

                        <!-- Card Body -->
                        <div class="card-body d-flex align-self-center align-items-center text-center p-0">
                            <div class="mb-2">
                                <i class="fas fa-chalkboard-teacher text-xl mb-3"></i>
                                <h2 class="fw-bold">{{ count($patient->teachers) }} <div class=" text-xs">{{
                                        __('basic.teachers') }}</div>
                                </h2>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

        <div class="col">

            <div class="row h-100">

                <div class="col-12 pe-2">
                    <div class="card h-100 shadow text-white" style="background-color: #77BEFF;">
                        <!-- Card Header - Dropdown -->
                        <div
                            class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-transparent border-bottom-0">
                            <h6 class="m-0 fw-bold">{{ __('basic.total teachers') }}</h6>
                        </div>

                        <!-- Card Body -->
                        <div class="card-body d-flex align-self-center align-items-center text-center p-0">
                            <div class="mb-2">
                                <i class="text-xl mb-3 fas fa-chalkboard-teacher"></i>
                                <h2 class="fw-bold">{{ count($patient->administrators) }} <div class=" text-xs">{{
                                        __('basic.administrators') }}</div>
                                </h2>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>

    @if($patient->cat == 2)
    <!-- company workers  -->
    <div class="row pe-0">
        <div class="col-12 px-0">
            <div class="card shadow mb-4 px-0 mx-0">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 fw-bold text-gray-500"><i class="fas fa-users me-1"></i>
                        {{ __('basic.company workers') }}</h6>
                </div>

                <!-- Card Body -->
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table display datatable-modal" id="table-workers" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th class="text-xs">{{ __('basic.name') }}</th>
                                    <th class="text-xs">{{ __('basic.phone number') }}</th>
                                    <th class="text-xs">{{ __('basic.email') }}</th>
                                    <th class="text-xs">{{ __('basic.position') }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($patient->workers as $item)
                                <tr>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->phone_number }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->position }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
    @endif
</div> <!-- end of container-fluid -->


@endsection


@section('js')

<!-- select 2 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/js/select2.min.js"
    integrity="sha512-4MvcHwcbqXKUHB6Lx3Zb5CEAVoE9u84qN+ZSMM6s7z8IeJriExrV3ND5zRze9mxNlABJ6k864P/Vl8m0Sd3DtQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- datapicker date and time -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.js"
    integrity="sha512-K/oyQtMXpxI4+K0W7H25UopjM8pzq0yrVdFdG21Fh5dBe91I40pDd9A4lzNlHPHBIP2cwZuoxaUSX0GJSObvGA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!-- jquery ui datepicker -->
<script type="text/javascript"
    src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>

<script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.bootstrap5.min.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>

<script type="text/javascript" language="javascript"
    src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>

<script type="text/javascript" language="javascript"
    src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.colVis.min.js"></script>


<!------ all patient js code ------>
@include('patient.component.patientjs')

@endsection