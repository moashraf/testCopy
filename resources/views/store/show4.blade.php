@extends('layouts.master')

@section('title', $patient->first_name . ' ' . $patient->second_name)

<!-- css insert -->
@section('css')

<!-- select 2 -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/css/select2.min.css"
    integrity="sha512-aD9ophpFQ61nFZP6hXYu4Q/b/USW7rpLCQLX6Bi0WJHXNO7Js/fUENpBQf/+P4NtpzNX0jSgR5zVvPOJp+W2Kg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

<!-- boostrap datepicker -->
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css" />

<!-- tables -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.2/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/autofill/2.3.9/css/autoFill.bootstrap5.min.css">

@endsection


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

<!-- content insert -->
@section('content')

<div class="container-fluid px-0">

    <!-- msg success -->
    <div id="flash-msg-cont"></div>

    @foreach ($errors->all() as $error)
    <div class="text-red"><i class="fas fa-exclamation me-1"></i> {{ $error }}</div>
    @endforeach

    <!-- page title link -->
    <div class="d-sm-flex align-items-center justify-content-between mb-3">

        <!-- page title link -->
        <span class="mb-0">
            <a class="link-cust-text text-gray-200 fw-light" href="{{ route('sett.home') }}">Dashboard |</a>
            <a class="link-cust-text text-gray-200 fw-light" href="{{ route('sett.managers.index') }}">Patient | </a>
            <a class="text-gray-300">{{ $patient->first_name }}</a>
        </span>

        <div class="d-flex justify-content-center">
            <a href="{{ route('sett.patient.edit', $patient->id) }}"
                class="bg-white  btn btn-sm shadow-sm b-r-l-cont p-2 px-4 text-gray-400 me-2"><i
                    class="fas fa-user-edit fa-sm text-gray-300 me-1"></i> Edit</a>

            <a href="#"
                class="d-none bg-white d-sm-inline-block btn btn-sm shadow-sm b-r-l-cont p-2 px-4 text-gray-400"><i
                    class="fas fa-download fa-sm text-gray-300 me-2"></i> Print</a>

        </div>

    </div>



    <!-- welcome msg & note -->
    <div class="row">
        <div class="col-lg-8 col-sm-12">
            <div class="card shadow mb-4">

                <!-- Card Body -->
                <div class="card-body row">
                    <div class="col align-self-center border-right-gray ps-3">

                        <div class="d-flex mb-4 align-items-center">
                            <img class="rounded-circle avatar-lg me-3"
                                src="{{ URL::asset('img/useravatar/' . $patient->avatar) }}">
                            <div class="">
                                <p class=" mb-0 text-xs text-gray-300">
                                    Patient</p>
                                <h5 class="mb-1 fw-bold text-gray-600">
                                    {{ $patient->first_name . ' ' . $patient->second_name }}</h5>
                                <p class="mb-0 text-xs text-gray-400">ID <strong> {{ $patient->id }}</strong></p>
                            </div>
                        </div>

                        <div class="d-flex ps-2 justify-content-between">

                            <div class="align-items-center text-center  ">
                                <p class="text-xxs fw-normal mb-1 text-gray-400">BLOOD</p>
                                <span class="text-s2 fw-bold text-gray-600"><i
                                        class="fas fa-tint fa-sm fa-fw text-gray-300"></i>
                                    {{ $patient->blood_type }}</span>
                            </div>

                            <div class="align-items-center text-center">
                                <p class="text-xxs fw-normal mb-1 text-gray-400">HEIGHT</p>
                                <span class="text-s2 fw-bold text-gray-600"><i
                                        class="fas fa-child fa-sm fa-fw text-gray-300"></i>
                                    {{ $patient->height }}<small class="text-xxs text-gray-200">cm</small></span>
                            </div>

                            <div class="align-items-center text-center me-2">
                                <p class="text-xxs fw-normal mb-1 text-gray-400">WEIGHT</p>
                                <span class="text-s2 fw-bold text-gray-600"><i
                                        class="fas fa-weight-hanging fa-sm fa-fw text-gray-300"></i>
                                    {{ $patient->weight }}<small class="text-xxs text-gray-200">kg</small></span>
                            </div>

                        </div>
                    </div>


                    <div class="col-12 col-sm ps-4 pt-3">

                        <div id="patient-info-caro" class="carousel slide" data-bs-ride="carousel"
                            data-bs-interval="false">

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
                                            <h6 class="text-gray-300 text-xs mb-1">Date of Birth</h6>
                                            <p class="text-gray-600 text-s fw-bold">
                                                {{ $patient->birthday }}
                                            </p>
                                        </div>
                                        <div class="col">
                                            <h6 class="text-gray-300 text-xs mb-1">Age</h6>
                                            <p class="text-gray-600 text-s fw-bold">
                                                {{
                                                \Carbon\Carbon::parse($patient->birthday)->diff(\Carbon\Carbon::now())->format('%y
                                                Years') }}
                                            </p>
                                        </div>

                                    </div>

                                    <div class="row mb-2">
                                        <div class="col">
                                            <h6 class="text-gray-300 text-xs mb-1">Gendar</h6>
                                            <p class="text-gray-600 text-s fw-bold">{{ $patient->gendar }}</p>
                                        </div>
                                        <div class="col">
                                            <h6 class="text-gray-300 text-xs mb-1">Address</h6>
                                            <p class="text-gray-600 text-s fw-bold">{{ $patient->city->name }} ,
                                                {{ $patient->country->name }}</p>
                                        </div>
                                    </div>

                                    <div class="row">

                                        <div class="col">
                                            <h6 class="text-gray-300 text-xs mb-1">Ph. number</h6>
                                            <p class="text-gray-600 text-xs fw-bold">{{ $patient->phone_number }}</p>
                                        </div>

                                        <div class="col pt-3">
                                            <p class="main-color text-xs fw-bold clickable-item-pointer"
                                                data-bs-toggle="modal" data-bs-target="#patient_note"><i
                                                    class="fas fa-comment-alt"></i>
                                                Note</p>




                                            <!-- Modal -->
                                            <div class="modal fade" id="patient_note" tabindex="-1"
                                                aria-labelledby="exampleModalLabel2" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                                    <div class="modal-content b-r-s-cont border-0">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel2"><i
                                                                    class="fas fa-quote-left me-1"></i>
                                                                Patient Note</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>

                                                        <!-- Modal content -->
                                                        <div class="modal-body px-4">
                                                            <div class="mb-3">
                                                                <label class="form-label">Note
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
                                                                    data-bs-dismiss="modal">Never
                                                                    Mind</button>
                                                            </div>
                                                            <div class="divider"></div>
                                                            <div class="right-side">
                                                                <button type="button" id="note_ajax"
                                                                    class="btn btn-default btn-link main-color"
                                                                    data-bs-dismiss="modal">Save
                                                                    changes</button>
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
                                            <h6 class="text-gray-300 text-xs mb-1">Sec. Ph. number</h6>
                                            <p class="text-gray-600 text-xs fw-bold">{{ $patient->sec_phone_number }}
                                            </p>
                                        </div>

                                        <div class="col">
                                            <h6 class="text-gray-300 text-xs mb-1">Insurance</h6>
                                            <p class="text-gray-600 text-s fw-bold">{{ $patient->insurance }}</p>
                                        </div>
                                    </div>

                                    <div class="row mb-2">

                                        <div class="col">
                                            <h6 class="text-gray-300 text-xs mb-1">Recource</h6>
                                            <p class="text-gray-600 text-s fw-bold">{{ $patient->recourse->name }}
                                            </p>
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

            <div class="row">

                <div class="col-6" style="padding-right: 3px;">
                    <div class="card shadow mb-4 min-height-card text-white" style="background-color: #FF7777;">
                        <!-- Card Header - Dropdown -->
                        <div
                            class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-transparent border-bottom-0">
                            <h6 class="m-0 fw-bold">Heart Rate</h6>
                            <div class="dropdown no-arrow">
                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-white"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                    aria-labelledby="dropdownMenuLink">
                                    <div class="dropdown-header">Dropdown Header:</div>
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </div>
                            </div>
                        </div>

                        <!-- Card Body -->
                        <div class="card-body align-items-center text-center p-0">
                            <div class="mb-2">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    aria-hidden="true" role="img" width="5em" height="5em"
                                    preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
                                    <path
                                        d="M21 11h-3.94a.78.78 0 0 0-.21 0h-.17a1.3 1.3 0 0 0-.15.1a1.67 1.67 0 0 0-.16.12a1 1 0 0 0-.09.13a1.32 1.32 0 0 0-.12.2l-1.6 4.41l-4.17-11.3a1 1 0 0 0-1.88 0L6.2 11H3a1 1 0 0 0 0 2H7.3a.86.86 0 0 0 .16-.1a1.67 1.67 0 0 0 .16-.12l.09-.13a1 1 0 0 0 .12-.2l1.62-4.53l4.16 11.42a1 1 0 0 0 .94.66a1 1 0 0 0 .94-.66l2.3-6.34H21a1 1 0 0 0 0-2z"
                                        fill="currentColor" />
                                </svg>
                            </div>
                            <h1 class="fw-bold mb-3">120<small class="text-xs fw-normal">bpm</small>
                            </h1>
                        </div>
                    </div>
                </div>

                <div class="col-6" style="padding-left: 3px;">
                    <div class="card shadow mb-4 min-height-card text-white" style="background-color: #77BEFF;">
                        <!-- Card Header - Dropdown -->
                        <div
                            class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-transparent border-bottom-0">
                            <h6 class="m-0 fw-bold">BL Pressure</h6>
                            <div class="dropdown no-arrow">
                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-white"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                    aria-labelledby="dropdownMenuLink">
                                    <div class="dropdown-header">Dropdown Header:</div>
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </div>
                            </div>
                        </div>

                        <!-- Card Body -->
                        <div class="card-body align-items-center text-center p-0">
                            <div class="mb-2">
                                <svg width="5em" height="5em" viewBox="0 0 48 48" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M9 19.0345C9 13.3091 12.8117 8 18.0312 8C21.6533 8 24.341 10.382 26 13.7611C27.6589 10.3822 30.3466 8 33.9688 8C39.1889 8 43 13.31 43 19.0345C43 31.2888 26 40 26 40C26 40 14.5487 34.4872 10.4431 25.4444H20.5848L22.1968 22.5788L24.0797 29.1692L28.4891 23.5H34V21.5H27.5109L24.9203 24.8308L22.8032 17.4212L19.4152 23.4444H9.67984C9.89182 24.1288 10.1486 24.7957 10.4431 25.4444L6 25.4443V23.4443L9.67984 23.4444C9.24643 22.0453 9 20.5731 9 19.0345Z"
                                        fill="#ffffff" />
                                </svg>
                            </div>
                            <h2 class="fw-bold mt-3 mb-3">70/120</h2>
                        </div>
                    </div>
                </div>



            </div>

        </div>
    </div>



    <!-- Content Row -->
    <div class="row">

        <!-- today's appointments -->
        <div class="col-12 col-lg-4">
            <div class="card shadow mb-4">

                <div id="current-trea-mec-caro" class="carousel slide curr-treament-info-carousel"
                    data-bs-ride="carousel" data-bs-interval="false">

                    <div class="carousel-indicators dots-radius-carousel" style="bottom: 34px; margin-bottom: 0px;">
                        <button type="button" data-bs-target="#current-trea-mec-caro" data-bs-slide-to=" 0"
                            class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#current-trea-mec-caro" data-bs-slide-to=" 1"
                            aria-label="Slide 2"></button>
                    </div>

                    <div class="carousel-inner">

                        <!-- Current Diseases -->
                        <div class="carousel-item active">

                            <!-- Card Header - Dropdown -->
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 fw-bold">Examination</h6>
                                <div class="dropdown no-arrow">
                                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-300"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                        aria-labelledby="dropdownMenuLink">
                                        <div class="dropdown-header">Dropdown Header:</div>
                                        <a class="dropdown-item clickable-item-pointer" data-bs-toggle="modal"
                                            data-bs-target="#adddisease">New Examination</a>
                                    </div>
                                </div>
                            </div>

                            <!-- Card Body -->


                            @if (!$lab->isEmpty())
                            <div class="card-body pb-4">
                                <div class="row">
                                    <div class="col align-self-center text-center">
                                        <svg id="Capa_1" fill="#151515" height="141" width="141" viewBox="0 0 512 512"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="m410.109 441.591-5.948-20.515c-1.808-6.232-6.302-11.185-12.329-13.586-6.029-2.402-12.695-1.898-18.293 1.385-7.104 4.165-14.647 7.412-22.506 9.724-.365-3.277-1.648-6.416-3.785-9.055-2.48-3.064-5.856-5.152-9.602-6.025 1.499-2.772 3.268-8.014 3.256-13.37 0-5.168-1.435-10.007-3.925-14.142 2.389-1.115 4.525-2.765 6.232-4.886 3.339-4.147 4.602-9.511 3.464-14.712l-2.718-12.427 6.442-3.776c10.502-6.156 22.482-9.631 34.647-10.048 6.757-.231 12.907-3.503 16.874-8.978 3.967-5.474 5.162-12.337 3.279-18.829l-4.392-15.145c-1.883-6.493-6.564-11.651-12.845-14.153-6.278-2.502-13.226-1.977-19.058 1.441-6.938 4.067-14.328 7.075-22.049 9.022-.464-2.994-1.686-5.852-3.646-8.286-2.614-3.248-6.233-5.391-10.235-6.177 1.472-2.753 3.211-7.952 3.198-13.257 0-4.92-1.305-9.538-3.578-13.537 2.526-.966 4.788-2.575 6.536-4.751 2.957-3.679 4.072-8.432 3.059-13.04l-3.26-14.833c9.359-4.056 19.621-6.369 29.895-6.705 6.228-.202 11.837-3.166 15.39-8.131 3.393-4.741 4.369-10.636 2.681-16.172l-5.351-17.554c-1.678-5.499-5.771-9.915-11.229-12.115-5.653-2.275-11.933-1.886-17.234 1.069-3.655 2.037-7.459 3.816-11.373 5.343l.481-2.19c1.014-4.609-.102-9.362-3.059-13.041-1.586-1.973-3.597-3.477-5.841-4.464 1.712-2.91 3.746-8.472 3.742-14.23 0-5.946-1.903-11.453-5.124-15.956 1.008-.783 1.938-1.684 2.759-2.704 3.148-3.914 4.336-8.974 3.258-13.881l-4.317-19.649c8.486-3.755 17.488-5.835 26.814-6.155 5.82-.199 11.118-3.018 14.536-7.733 3.419-4.716 4.449-10.629 2.827-16.224l-5.002-17.253c-1.621-5.594-5.654-10.039-11.064-12.195-5.415-2.157-11.398-1.703-16.422 1.242-2.3 1.348-4.669 2.579-7.09 3.702-.345-3.065-1.546-6.001-3.538-8.478-3.148-3.916-7.834-6.161-12.857-6.161h-27.534c-4.143 0-7.5 3.357-7.5 7.5s3.357 7.5 7.5 7.5h27.534c.594 0 .963.305 1.168.56.206.256.424.683.297 1.263l-4.854 22.094c-2.236 10.178-2.236 20.936 0 31.113l4.854 22.094c.127.58-.091 1.007-.297 1.263-.205.255-.574.56-1.168.56h-131.618c-.594 0-.963-.305-1.168-.56-.206-.256-.424-.683-.297-1.263l4.854-22.094c2.236-10.178 2.236-20.936 0-31.113l-4.854-22.094c-.127-.58.091-1.007.297-1.263.205-.255.574-.56 1.168-.56h69.02c4.143 0 7.5-3.357 7.5-7.5s-3.357-7.5-7.5-7.5h-69.02c-5.023 0-9.709 2.245-12.857 6.16-1.992 2.477-3.194 5.413-3.538 8.479-2.42-1.123-4.79-2.354-7.09-3.701-5.023-2.945-11.008-3.399-16.42-1.243-5.41 2.155-9.444 6.6-11.066 12.194l-5.004 17.255c-1.622 5.594-.592 11.507 2.827 16.223 3.418 4.716 8.716 7.534 14.535 7.733 9.326.321 18.329 2.401 26.815 6.156l-4.317 19.649c-1.078 4.907.109 9.967 3.258 13.881.821 1.021 1.75 1.921 2.759 2.704-3.221 4.503-5.124 10.01-5.124 15.956-.043 3.82.992 9.311 3.742 14.23-2.244.987-4.255 2.491-5.841 4.464-2.957 3.679-4.072 8.432-3.059 13.04l.482 2.191c-3.915-1.527-7.719-3.306-11.372-5.342-5.304-2.956-11.586-3.346-17.235-1.069-5.458 2.2-9.551 6.616-11.229 12.117l-5.351 17.55c-1.688 5.538-.712 11.433 2.681 16.173 3.553 4.966 9.163 7.93 15.39 8.132 10.276.336 20.539 2.649 29.895 6.706l-3.26 14.832c-1.014 4.609.102 9.362 3.059 13.041 1.749 2.175 4.01 3.784 6.536 4.751-2.272 4-3.578 8.618-3.578 13.537-.04 3.537.835 8.609 3.198 13.257-4.002.786-7.621 2.929-10.235 6.177-1.96 2.435-3.182 5.293-3.646 8.287-7.721-1.947-15.11-4.956-22.049-9.021-5.831-3.419-12.777-3.944-19.058-1.442s-10.962 7.66-12.845 14.153l-4.392 15.145c-1.883 6.492-.688 13.355 3.279 18.829 3.967 5.475 10.117 8.746 16.874 8.978 12.165.417 24.146 3.892 34.647 10.048l6.442 3.776-2.718 12.427c-1.138 5.201.125 10.564 3.464 14.712 1.707 2.121 3.843 3.771 6.232 4.886-2.49 4.135-3.925 8.973-3.925 14.142-.04 3.57.851 8.69 3.256 13.37-3.747.874-7.122 2.961-9.602 6.025-2.137 2.64-3.42 5.779-3.785 9.057-7.859-2.312-15.402-5.562-22.506-9.727-5.599-3.279-12.267-3.784-18.293-1.384-6.027 2.401-10.521 7.354-12.329 13.586l-5.948 20.515c-1.808 6.231-.661 12.818 3.146 18.072s9.71 8.396 16.196 8.618c14.521.498 28.822 4.645 41.356 11.993l.8.469-2.153 10.114c-1.104 5.189.177 10.531 3.516 14.655 3.338 4.123 8.295 6.488 13.601 6.488h31.329c4.143 0 7.5-3.357 7.5-7.5s-3.357-7.5-7.5-7.5h-31.329c-1.037 0-1.662-.581-1.942-.927-.28-.347-.719-1.079-.502-2.094l4.996-23.468c1.834-8.616 1.834-17.354 0-25.968l-4.996-23.469c-.217-1.015.222-1.747.502-2.094.28-.346.905-.927 1.942-.927h155.295c1.037 0 1.662.581 1.942.927.28.347.719 1.079.502 2.094l-4.996 23.468c-1.834 8.615-1.834 17.353 0 25.969l4.996 23.468c.217 1.015-.222 1.747-.502 2.094-.28.346-.905.927-1.942.927h-89.005c-4.143 0-7.5 3.357-7.5 7.5s3.357 7.5 7.5 7.5h89.005c5.306 0 10.263-2.365 13.601-6.488 3.339-4.124 4.62-9.466 3.516-14.655l-2.153-10.114.801-.469c12.533-7.348 26.834-11.494 41.356-11.992 6.485-.223 12.388-3.364 16.195-8.618s4.954-11.846 3.146-18.077zm-211.51-38.536c-6.2.112-12.668-5.818-12.5-12.906 0-6.893 5.607-12.5 12.5-12.5h50.04c4.143 0 7.5-3.357 7.5-7.5s-3.357-7.5-7.5-7.5h-66.215c-1.041 0-1.667-.584-1.947-.933-.28-.348-.717-1.084-.494-2.102l4.188-19.148c2.474-11.312 2.474-23.269 0-34.58l-4.188-19.148c-.223-1.018.214-1.754.494-2.102.28-.349.906-.933 1.947-.933h147.152c1.041 0 1.667.584 1.947.933.28.348.717 1.084.494 2.102l-4.188 19.148c-2.474 11.312-2.474 23.269 0 34.58l4.188 19.148c.223 1.018-.214 1.754-.494 2.102-.28.349-.906.933-1.947.933h-45.896c-4.143 0-7.5 3.357-7.5 7.5s3.357 7.5 7.5 7.5h29.721c6.893 0 12.5 5.607 12.5 12.5.294 6.059-5.26 12.85-12.5 12.906zm-7.77-146.852c-.294-6.059 5.26-12.85 12.5-12.906h105.342c6.893 0 12.5 5.607 12.5 12.5.294 6.059-5.26 12.85-12.5 12.906h-105.342c-6.892 0-12.5-5.607-12.5-12.5zm-5.879-27.906c-.071 0-.239 0-.39-.187s-.114-.351-.099-.421l3.28-14.922c3.444-15.664 3.444-32.223 0-47.886l-3.28-14.924c-.016-.069-.052-.233.099-.42s.318-.187.39-.187h48.433c4.143 0 7.5-3.357 7.5-7.5s-3.357-7.5-7.5-7.5h-30.914c-6.2.112-12.668-5.818-12.5-12.906 0-6.893 5.607-12.5 12.5-12.5h107.063c6.893 0 12.5 5.607 12.5 12.5.294 6.059-5.26 12.85-12.5 12.906h-41.042c-4.143 0-7.5 3.357-7.5 7.5s3.357 7.5 7.5 7.5h58.561c.071 0 .239 0 .39.187s.114.351.099.421l-3.28 14.922c-3.444 15.664-3.444 32.223 0 47.886l3.28 14.924c.016.069.052.233-.099.42s-.318.187-.39.187zm191.538 59.139c1.811-1.061 3.97-1.225 5.92-.447 1.951.777 3.405 2.38 3.99 4.396l4.392 15.145c.585 2.017.214 4.148-1.019 5.85-1.232 1.7-3.144 2.717-5.242 2.788-14.647.503-29.074 4.686-41.72 12.098l-1.624.952c-.485-6.399-.068-12.882 1.298-19.126l2.124-9.708c11.248-2.12 21.952-6.128 31.881-11.948zm-16.104-124.306c1.324-.737 2.9-.829 4.324-.258.724.292 2.011 1.016 2.487 2.577l5.351 17.554c.411 1.347-.062 2.411-.531 3.067-.814 1.138-2.155 1.818-3.682 1.868-10.749.351-21.494 2.535-31.504 6.36-.41-7.307.006-14.668 1.24-21.863 7.784-2.265 15.281-5.384 22.315-9.305zm-7.504-139.253c1.376-.808 2.647-.502 3.283-.248.635.253 1.767.906 2.211 2.438l5.004 17.253c.443 1.531-.164 2.689-.565 3.244-.401.554-1.313 1.491-2.905 1.546-9.723.333-19.158 2.244-28.15 5.678.046-3.922.474-7.839 1.312-11.653l2.232-10.157c6.104-2.116 12.006-4.834 17.578-8.101zm-203.692 22.686c-.401-.555-1.009-1.713-.565-3.243l5.004-17.254c.444-1.531 1.576-2.185 2.212-2.438s1.907-.56 3.282.249c5.571 3.266 11.472 5.979 17.578 8.096l2.233 10.161c.838 3.813 1.266 7.73 1.312 11.653-8.992-3.434-18.427-5.345-28.15-5.679-1.594-.053-2.505-.991-2.906-1.545zm-9.203 139.507c-.47-.656-.942-1.721-.531-3.069l5.351-17.55c.477-1.563 1.764-2.287 2.487-2.579 1.427-.573 3.002-.479 4.325.258 7.031 3.92 14.527 7.039 22.314 9.305 1.234 7.195 1.65 14.556 1.24 21.863-10.01-3.824-20.756-6.008-31.506-6.359-1.524-.05-2.865-.731-3.68-1.869zm-12.514 129.098c-2.099-.072-4.01-1.089-5.242-2.789-1.232-1.701-1.604-3.833-1.019-5.85l4.392-15.145c.585-2.017 2.039-3.619 3.99-4.396 1.95-.778 4.107-.614 5.921.448 9.928 5.819 20.632 9.827 31.88 11.946l2.124 9.709c1.366 6.244 1.783 12.727 1.298 19.126l-1.624-.952c-12.646-7.412-27.073-11.595-41.72-12.097zm-5.723 138.123c-1.828-.063-3.491-.948-4.564-2.43-1.073-1.48-1.396-3.336-.887-5.093l5.948-20.515c.51-1.756 1.776-3.152 3.475-3.829 1.7-.677 3.579-.534 5.155.391 10.177 5.965 21.135 10.294 32.607 12.931l2.751 12.922c1.249 5.864 1.369 11.802.379 17.683-13.798-7.362-29.219-11.524-44.864-12.06zm273.068-2.43c-1.073 1.481-2.736 2.366-4.563 2.43-15.646.536-31.068 4.698-44.865 12.06-.99-5.881-.87-11.819.379-17.684l2.75-12.918c11.474-2.637 22.432-6.968 32.607-12.933 1.576-.925 3.455-1.067 5.155-.391 1.698.677 2.965 2.073 3.475 3.829l5.948 20.515c.511 1.756.188 3.612-.886 5.092z" />
                                        </svg>
                                    </div>

                                    <div class="col">

                                        <div class="col">
                                            <h6 class="text-gray-300 text-xs mb-1">Examination</h6>
                                            <p class="text-gray-700 text-xs fw-bold">
                                                {{ $disease[0]->diseasecats->name }}</p>
                                        </div>
                                        <div class="col">
                                            <h6 class="text-gray-300 text-xs mb-1">Started on</h6>
                                            <p class="text-gray-700 text-xs fw-bold">
                                                {{ date('d M Y', strtotime($disease[0]->start)) }}</p>
                                        </div>

                                        @if ($disease[0]->status == 0)
                                        @php
                                        $msg = 'Still';
                                        @endphp
                                        @elseif ($disease[0]->status == 1)
                                        @php
                                        $msg = 'Healed';
                                        @endphp
                                        @endif

                                        <div class="col">
                                            <h6 class="text-gray-300 text-xs mb-1">Status</h6>
                                            <p class="text-gray-700 text-xs fw-bold">{{ $msg }}</p>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            @else
                            <div class="card-body align-items-center text-center">
                                <a class="add-new-iteam stretched-link link-cust-text text-gray-400" href="#"
                                    data-bs-toggle="modal" data-bs-target="#adddisease">
                                    <i class="fas fa-plus-circle fa-sm fa-fw fs-4"></i>
                                    <p class="fw-light mb-0">You can put your notes</p>
                                </a>
                            </div>
                            @endif

                            <!-- Card footer -->
                            <div class="card-footer text-center ">
                                <a class="text-xs link-cust-text text-gray-300 clickable-item-pointer"
                                    data-bs-toggle="modal" data-bs-target="#disease_show">
                                    <i class="fas fa-chevron-down"></i> More
                                </a>
                            </div>

                        </div>


                        <!-- Modal show all diseases -->
                        <div class="modal fade" id="disease_show" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
                                <div class="modal-content b-r-s-cont border-0">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel"><i
                                                class="fas fas fa-x-ray me-1"></i>
                                            Examination</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>

                                    <!-- Modal content -->
                                    <div class="modal-body px-4">


                                        <div class="table-responsive">
                                            <table class="table display datatable-modal" id="table-disease" width="100%"
                                                cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th class="text-xs w-25">Name</th>
                                                        <th class="text-xs text-center">Start</th>
                                                        <th class="text-xs text-center">End</th>
                                                        <th class="text-xs text-center">Status</th>
                                                        <th class="text-xs text-center">Handl</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($disease as $item)

                                                    @if ($item->status == 0)
                                                    @php
                                                    $text_color = 'active-color-btn';
                                                    $msg = 'Still';
                                                    @endphp
                                                    @elseif ($item->status == 1)
                                                    @php
                                                    $text_color = 'done-color-btn';
                                                    $msg = 'Healed';
                                                    @endphp
                                                    @endif

                                                    <tr>
                                                        <td class="w-25">
                                                            {{ $item->diseasecats->name }}</td>
                                                        <td>{{ $item->start }}</td>
                                                        <td class="text-center">{{ $item->end }}</td>
                                                        <td class="text-center"> <span
                                                                class="badge rounded-pill {{ $text_color }} badge-padd-l">{{
                                                                $msg }}</span>
                                                        </td>

                                                        <td class="text-center">
                                                            <a data-disease_id="{{ $item->id }}"
                                                                data-diseasecats_id="{{ $item->diseasecats->id }}"
                                                                data-status_disease="{{ $item->status }}"
                                                                data-start="{{ $item->start }}"
                                                                data-end="{{ $item->end }}"
                                                                class="btn btn-sm status-col-link active-color-btn b-r-xs mb-1 disease_edit_click"
                                                                title="edit"><i class="fas fa-pencil-alt"></i>
                                                                Edit </a>

                                                            <a data-disease_id="{{ $item->id }}"
                                                                class="btn btn-sm modal-effect status-col-link cancel-color-btn b-r-xs mb-1 disease_delete_click"
                                                                title="delete" data-effect="effect-scale"><i
                                                                    class="fas fa-trash"></i> Delete
                                                            </a>

                                                        </td>

                                                    </tr>
                                                    @endforeach

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <div class="left-side">
                                            <button type="button" class="btn btn-default btn-link"
                                                data-bs-dismiss="modal">Never
                                                Mind</button>
                                        </div>
                                        <div class="divider"></div>
                                        <div class="right-side">
                                            <button type="button" class="btn btn-default btn-link main-color">Save
                                                changes</button>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>


                        <!-- Modal disease insert data -->
                        <div class="modal fade" id="adddisease" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                <div class="modal-content b-r-s-cont border-0">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel"><i
                                                class="fas fas fa-x-ray me-1"></i>
                                            New Examination</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>

                                    <form action="{{ route('sett.disease.store') }}" method="post">
                                        {{ method_field('POST') }}
                                        {{ csrf_field() }}

                                        <!-- Modal content -->
                                        <div class="modal-body px-5 py-3">

                                            <div class="row mb-2">
                                                <div class="col-12 mb-2">
                                                    <label class="form-label">Disease
                                                        <small>(required)</small></label>
                                                    <select
                                                        class="myselect2-disease-insert select2-hidden-accessible @error('disease_cat') is-invalid @enderror"
                                                        id="disease_cat" multiple="" name="disease_cat[]" required>
                                                        @foreach ($disease_cat as $iteam)
                                                        <option value="{{ $iteam->id }}">
                                                            {{ $iteam->name }}
                                                        </option>
                                                        @endforeach
                                                    </select>

                                                    <span id="disease_cat_error" class="error-msg-form"></span>

                                                    @error('disease_cat')
                                                    <span class="error-msg-form">
                                                        {{ $message }}
                                                    </span>
                                                    @enderror

                                                </div>

                                                <div class="col-12 mb-2">
                                                    <label class="form-label">Start
                                                        <small>(required)</small></label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text"><i
                                                                    class="bi bi-calendar2-week-fill"></i> </div>
                                                        </div>
                                                        <input name="disease_start" type="text"
                                                            class="form-control hasdatetimepicker @error('disease_start') is-invalid @enderror"
                                                            placeholder="YYYY/MM/DD" required>
                                                    </div>
                                                    <span id="disease_start_error" class="error-msg-form"></span>

                                                    @error('disease_start')
                                                    <span class="error-msg-form">
                                                        {{ $message }}
                                                    </span>
                                                    @enderror
                                                </div>

                                            </div>

                                            <input name="last_appointment_id" value="{{ $appointments[0]->id }}"
                                                type="hidden">

                                            <input name="patient_id" value="{{ $patient->id }}" type="hidden">

                                        </div>

                                        <div class="modal-footer">
                                            <div class="left-side">
                                                <button type="button" class="btn btn-default btn-link"
                                                    data-bs-dismiss="modal">Never
                                                    Mind</button>
                                            </div>
                                            <div class="divider"></div>
                                            <div class="right-side">
                                                <button type="submit" class="btn btn-default btn-link main-color">Add
                                                    New</button>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>

                        </div>


                        <!-- Modal Disease update data -->
                        <div class="modal fade" id="disease_edit" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                <div class="modal-content b-r-s-cont border-0">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel"><i
                                                class="fas fa-capsules me-1"></i>
                                            Add new Examination</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>

                                    <form class="mb-0" action="{{ route('sett.disease.update', '21') }}" method="POST">
                                        @csrf
                                        @method('PUT')

                                        <!-- Modal content -->
                                        <div class="modal-body px-5 py-3">

                                            <div class="row mb-2">

                                                <div class="col-12 mb-2">
                                                    <label class="form-label">Disease
                                                        <small>(required)</small></label>
                                                    <select
                                                        class="myselect2-disease-update select2-hidden-accessible @error('disease_cat_update') is-invalid @enderror"
                                                        id="disease_cat_update" name="disease_cat_update" required>
                                                        @foreach ($disease_cat as $iteam)
                                                        <option value="{{ $iteam->id }}">
                                                            {{ $iteam->name }}
                                                        </option>
                                                        @endforeach
                                                    </select>

                                                    <span id="disease_cat_update_error" class="error-msg-form"></span>

                                                    @error('disease_cat_update')
                                                    <span class="error-msg-form">
                                                        {{ $message }}
                                                    </span>
                                                    @enderror

                                                </div>


                                                <div class="col-12 mb-2">
                                                    <label class="form-label">Status
                                                        <small>(required)</small></label>
                                                    <select
                                                        class="myselect2_disease select2-hidden-accessible select2-no-search-disease @error('status_medicine_update') is-invalid @enderror"
                                                        id="status_disease_update" name="status_disease_update"
                                                        required>
                                                        <option value="0">
                                                            Still
                                                        </option>
                                                        <option value="1">
                                                            Healed
                                                        </option>
                                                    </select>

                                                    <span id="status_disease_update_error"
                                                        class="error-msg-form"></span>

                                                    @error('status_disease_update')
                                                    <span class="error-msg-form">
                                                        {{ $message }}
                                                    </span>
                                                    @enderror

                                                </div>

                                                <div class="col-12 mb-2">
                                                    <label class="form-label">Start
                                                        <small>(required)</small></label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text"><i
                                                                    class="bi bi-calendar2-week-fill"></i> </div>
                                                        </div>
                                                        <input name="disease_start_update" type="text"
                                                            class="form-control hasdatetimepicker @error('disease_start_update') is-invalid @enderror"
                                                            placeholder="YYYY/MM/DD" required>
                                                    </div>
                                                    <span id="disease_start_update_error" class="error-msg-form"></span>

                                                    @error('disease_start_update')
                                                    <span class="error-msg-form">
                                                        {{ $message }}
                                                    </span>
                                                    @enderror
                                                </div>

                                                <div class="col-12 mb-2">
                                                    <label class="form-label">End
                                                        <small>(required)</small></label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text"><i
                                                                    class="bi bi-calendar2-week-fill"></i> </div>
                                                        </div>
                                                        <input name="disease_end_update" type="text"
                                                            class="form-control hasdatetimepicker @error('disease_end_update') is-invalid @enderror"
                                                            placeholder="YYYY/MM/DD" required>
                                                    </div>

                                                    @error('disease_end_update')
                                                    <span class="error-msg-form">
                                                        {{ $message }}
                                                    </span>
                                                    @enderror

                                                    <span id="medicine_end_update_error" class="error-msg-form"></span>
                                                </div>


                                            </div>

                                            <input name="patient_id" value="{{ $patient->id }}" type="hidden">
                                            <input name="last_appointment_id" value="{{ $appointments[0]->id }}"
                                                type="hidden">
                                            <input name="disease_id_update" value="" type="hidden">

                                        </div>

                                        <div class="modal-footer">
                                            <div class="left-side">
                                                <button type="button" class="btn btn-default btn-link"
                                                    data-bs-dismiss="modal">Never
                                                    Mind</button>
                                            </div>
                                            <div class="divider"></div>
                                            <div class="right-side">
                                                <button type="submit"
                                                    class="btn btn-default btn-link main-color">Update</button>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>

                        </div>

                        <!-- Disease Modal delete -->
                        <div class="modal fade" id="disease_delete" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable ">

                                <div class="modal-content shadow-lgg b-r-s-cont border-0">

                                    <div class="modal-header">
                                        <div class="modal-title" id="exampleModalLabel"><i
                                                class="fas fa-trash me-1"></i> Disease delete</div>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>

                                    <form action="{{ route('sett.disease.destroy', 'test') }}" method="post">
                                        {{ method_field('delete') }}
                                        {{ csrf_field() }}

                                        <!-- Modal content -->
                                        <div class="modal-body px-4">

                                            <div class="modal-body delete-conf-input text-center py-0">
                                                <p class="mb-0">ِAre
                                                    you sure you want to delete
                                                    this
                                                    examination?</p><br>
                                                <input type="hidden" name="disease_id_delete" value="">
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <div class="left-side">
                                                <button type="button" class="btn btn-default btn-link"
                                                    data-bs-dismiss="modal">Never
                                                    Mind</button>
                                            </div>
                                            <div class="divider"></div>
                                            <div class="right-side">
                                                <button type="submit" class="btn btn-default btn-link text-red">Delete
                                                </button>
                                            </div>

                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>




                        <!-- Current Medicines -->
                        <div class="carousel-item">

                            <!-- Card Header - Dropdown -->
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 fw-bold">Current Medicines</h6>
                                <div class="dropdown no-arrow">
                                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-300"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                        aria-labelledby="dropdownMenuLink">
                                        <div class="dropdown-header">Dropdown Header:</div>
                                        <a class="dropdown-item clickable-item-pointer" data-bs-toggle="modal"
                                            data-bs-target="#addmedic">Add
                                            Medicine</a>
                                    </div>
                                </div>
                            </div>

                            <!-- Card Body -->

                            @if (!$medicine->isEmpty())
                            <div id="medicine_card_home" class="card-body align-items-center">

                                @foreach ($medicine as $iteam)

                                @if ($iteam->status == 0)
                                @php
                                $text_color = 'main-color';
                                $msg = 'On medicine';
                                @endphp
                                @elseif ($iteam->status == 1)
                                @php
                                $text_color = 'cancel-color';
                                $msg = 'No result';
                                @endphp
                                @elseif ($iteam->status == 2)
                                @php
                                $text_color = 'done-color';
                                $msg = 'Done';
                                @endphp
                                @endif

                                @break($loop->index === 3)

                                <div class="d-flex justify-content-between align-items-center mb-3">

                                    <div class="me-1 d-flex align-self-center align-items-end me-2 text-truncate">
                                        <i class="fas fa-circle me-2 text-xxs mb-0 {{ $text_color }}"></i>

                                        <div class="text-truncate">
                                            <p class="text-s text-truncate text-gray-700 mb-0 fw-bold">
                                                {{ $iteam->medicinescats->name }}</p>
                                            <p class="text-xs text-gray-300 fw-bold mb-0">{{ $msg }}</p>
                                        </div>
                                    </div>

                                    <div class="text-s text-gray-600 fw-bold">
                                        {{ date('d M Y', strtotime($iteam->end)) }}
                                    </div>

                                </div>

                                @endforeach
                            </div>

                            @else
                            <div class="card-body align-items-center text-center">
                                <a class="add-new-iteam stretched-link link-cust-text text-gray-400" href="#"
                                    data-bs-toggle="modal" data-bs-target="#addmedic">
                                    <i class="fas fa-plus-circle fa-sm fa-fw fs-4"></i>
                                    <p class="fw-light mb-0">You can add new Medicines</p>
                                </a>
                            </div>

                            @endif



                            <!-- Card footer medicine -->
                            <div class="card-footer text-center ">
                                <a class="text-xs link-cust-text text-gray-300" href="#" data-bs-toggle="modal"
                                    data-bs-target="#medicine_show">
                                    <i class="fas fa-chevron-down"></i> More
                                </a>
                            </div>

                            <!-- Modal show all medicines -->
                            <div class="modal fade" id="medicine_show" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
                                    <div class="modal-content b-r-s-cont border-0">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel"><i
                                                    class="fas fas fa-capsules me-1"></i>
                                                Current Medicines</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>

                                        <!-- Modal content -->
                                        <div class="modal-body px-4">


                                            <div class="table-responsive">
                                                <table class="table display datatable-modal" id="table-medicine"
                                                    width="100%" cellspacing="0">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-xs w-25">Name</th>
                                                            <th class="text-xs text-center">Start</th>
                                                            <th class="text-xs text-center">End</th>
                                                            <th class="text-xs text-center">Status</th>
                                                            <th class="text-xs text-center">Handl</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($medicine as $item)

                                                        @if ($item->status == 0)
                                                        @php
                                                        $text_color = 'active-color-btn';
                                                        $msg = 'On medicine';
                                                        @endphp
                                                        @elseif ($item->status == 1)
                                                        @php
                                                        $text_color = 'cancel-color-btn';
                                                        $msg = 'No result';
                                                        @endphp
                                                        @elseif ($item->status == 2)
                                                        @php
                                                        $text_color = 'done-color-btn';
                                                        $msg = 'Done';
                                                        @endphp
                                                        @endif

                                                        <tr>
                                                            <td class="w-25">
                                                                {{ $item->medicinescats->name }}</td>
                                                            <td>{{ $item->start }}</td>
                                                            <td class="text-center">{{ $item->end }}</td>
                                                            <td class="text-center"> <span
                                                                    class="badge rounded-pill {{ $text_color }} badge-padd-l">{{
                                                                    $msg }}</span>
                                                            </td>

                                                            <td class="text-center">
                                                                <a data-medicine_id="{{ $item->id }}"
                                                                    data-medicinescats_id="{{ $item->medicinescats->id }}"
                                                                    data-status_medicine="{{ $item->status }}"
                                                                    data-start="{{ $item->start }}"
                                                                    data-end="{{ $item->end }}"
                                                                    class="btn btn-sm status-col-link active-color-btn b-r-xs mb-1 medicine_edit_click"
                                                                    title="edit"><i class="fas fa-pencil-alt"></i>
                                                                    Edit </a>

                                                                <a data-medicine_id="{{ $item->id }}"
                                                                    class="btn btn-sm modal-effect status-col-link cancel-color-btn b-r-xs mb-1 medicine_delete_click"
                                                                    title="delete" data-effect="effect-scale"
                                                                    data-bs-toggle="modal" data-bs-target="#delete1"><i
                                                                        class="fas fa-trash"></i> Delete
                                                                </a>

                                                            </td>

                                                        </tr>
                                                        @endforeach

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <div class="left-side">
                                                <button type="button" class="btn btn-default btn-link"
                                                    data-bs-dismiss="modal">Never
                                                    Mind</button>
                                            </div>
                                            <div class="divider"></div>
                                            <div class="right-side">
                                                <button type="button" class="btn btn-default btn-link main-color">Save
                                                    changes</button>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>

                            <!-- Modal Medicine insert data -->
                            <div class="modal fade" id="addmedic" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                    <div class="modal-content b-r-s-cont border-0">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel"><i
                                                    class="fas fa-capsules me-1"></i>
                                                Add new Medicines</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>

                                        <form class="mb-0" action="{{ route('sett.medicine.store') }}" method="post">
                                            {{ method_field('POST') }}
                                            {{ csrf_field() }}

                                            <!-- Modal content -->
                                            <div class="modal-body px-5 py-3">

                                                <div class="row mb-2">
                                                    <div class="col-12 mb-2">
                                                        <label class="form-label">Medicine
                                                            <small>(required)</small></label>
                                                        <select
                                                            class="myselect2-medicine-insert select2-hidden-accessible @error('medicine_pills') is-invalid @enderror"
                                                            multiple="" id="medicine_pills" name="medicine_pills[]"
                                                            required>
                                                            @foreach ($medicine_cat as $iteam)
                                                            <option value="{{ $iteam->id }}">
                                                                {{ $iteam->name . ' - ' . $iteam->price . 'EGP' }}
                                                            </option>
                                                            @endforeach
                                                        </select>

                                                        <span id="medicine_pills_error" class="error-msg-form"></span>

                                                        @error('medicine_pills')
                                                        <span class="error-msg-form">
                                                            {{ $message }}
                                                        </span>
                                                        @enderror

                                                    </div>

                                                    <div class="col-12 mb-2">
                                                        <label class="form-label">Medicine
                                                            <small>(required)</small></label>
                                                        <select
                                                            class="myselect2-medicine-insert-nosearch select2-hidden-accessible @error('medicine_status') is-invalid @enderror"
                                                            id="medicine_status" name="medicine_status" required>
                                                            <option value="0">
                                                                On medicine
                                                            </option>
                                                            <option value="1">
                                                                No result
                                                            </option>
                                                            <option value="2">
                                                                Done
                                                            </option>
                                                        </select>

                                                        <span id="medicine_status_error" class="error-msg-form"></span>

                                                        @error('medicine_status')
                                                        <span class="error-msg-form">
                                                            {{ $message }}
                                                        </span>
                                                        @enderror

                                                    </div>

                                                    <div class="col-12 mb-2">
                                                        <label class="form-label">Start
                                                            <small>(required)</small></label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text"><i
                                                                        class="bi bi-calendar2-week-fill"></i> </div>
                                                            </div>
                                                            <input name="medicine_start" type="text"
                                                                class="form-control hasdatetimepicker @error('medicine_start') is-invalid @enderror"
                                                                placeholder="YYYY/MM/DD" required>
                                                        </div>
                                                        <span id="medicine_start_error" class="error-msg-form"></span>

                                                        @error('medicine_start')
                                                        <span class="error-msg-form">
                                                            {{ $message }}
                                                        </span>
                                                        @enderror
                                                    </div>

                                                    <div class="col-12 mb-2">
                                                        <label class="form-label">End
                                                            <small>(required)</small></label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text"><i
                                                                        class="bi bi-calendar2-week-fill"></i> </div>
                                                            </div>
                                                            <input name="medicine_end" type="text"
                                                                class="form-control hasdatetimepicker @error('medicine_end') is-invalid @enderror"
                                                                placeholder="YYYY/MM/DD" required>
                                                        </div>

                                                        @error('medicine_end')
                                                        <span class="error-msg-form">
                                                            {{ $message }}
                                                        </span>
                                                        @enderror

                                                        <span id="medicine_end_error" class="error-msg-form"></span>
                                                    </div>

                                                </div>

                                                <input name="last_appointment_id" value="{{ $appointments[0]->id }}"
                                                    type="hidden">

                                                <input name="patient_id" value="{{ $patient->id }}" type="hidden">

                                            </div>

                                            <div class="modal-footer">
                                                <div class="left-side">
                                                    <button type="button" class="btn btn-default btn-link"
                                                        data-bs-dismiss="modal">Never
                                                        Mind</button>
                                                </div>
                                                <div class="divider"></div>
                                                <div class="right-side">
                                                    <button type="submit"
                                                        class="btn btn-default btn-link main-color">Add
                                                        New</button>
                                                </div>
                                            </div>
                                        </form>

                                    </div>
                                </div>

                            </div>

                            <!-- Modal Medicine update data -->
                            <div class="modal fade" id="medicine_edit" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                    <div class="modal-content b-r-s-cont border-0">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel"><i
                                                    class="fas fa-capsules me-1"></i>
                                                Add new Medicines</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>

                                        <form class="mb-0" action="{{ route('sett.medicine.update', '21') }}"
                                            method="POST">
                                            @csrf
                                            @method('PUT')

                                            <!-- Modal content -->
                                            <div class="modal-body px-5 py-3">

                                                <div class="row mb-2">

                                                    <div class="col-12 mb-2">
                                                        <label class="form-label">Medicine
                                                            <small>(required)</small></label>
                                                        <select
                                                            class="myselect2-medicine-update select2-hidden-accessible @error('medicine_pills_update') is-invalid @enderror"
                                                            id="medicine_pills_update" name="medicine_pills_update"
                                                            required>
                                                            @foreach ($medicine_cat as $iteam)
                                                            <option value="{{ $iteam->id }}">
                                                                {{ $iteam->name . ' - ' . $iteam->price . 'EGP' }}
                                                            </option>
                                                            @endforeach
                                                        </select>

                                                        <span id="medicine_pills_update_error"
                                                            class="error-msg-form"></span>

                                                        @error('medicine_pills_update')
                                                        <span class="error-msg-form">
                                                            {{ $message }}
                                                        </span>
                                                        @enderror

                                                    </div>


                                                    <div class="col-12 mb-2">
                                                        <label class="form-label">Status
                                                            <small>(required)</small></label>
                                                        <select
                                                            class="myselect2-medicine-update select2-hidden-accessible select2-no-search-medicine @error('status_medicine_update') is-invalid @enderror"
                                                            id="status_medicine_update" name="status_medicine_update"
                                                            required>
                                                            <option value="0">
                                                                On medicine
                                                            </option>
                                                            <option value="1">
                                                                No result
                                                            </option>
                                                            <option value="2">
                                                                Done
                                                            </option>
                                                        </select>

                                                        <span id="status_update_update_error"
                                                            class="error-msg-form"></span>

                                                        @error('status_update_update')
                                                        <span class="error-msg-form">
                                                            {{ $message }}
                                                        </span>
                                                        @enderror

                                                    </div>

                                                    <div class="col-12 mb-2">
                                                        <label class="form-label">Start
                                                            <small>(required)</small></label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text"><i
                                                                        class="bi bi-calendar2-week-fill"></i> </div>
                                                            </div>
                                                            <input name="medicine_start_update" type="text"
                                                                class="form-control hasdatetimepicker @error('medicine_start_update') is-invalid @enderror"
                                                                placeholder="YYYY/MM/DD" required>
                                                        </div>
                                                        <span id="medicine_start_update_error"
                                                            class="error-msg-form"></span>

                                                        @error('medicine_start_update')
                                                        <span class="error-msg-form">
                                                            {{ $message }}
                                                        </span>
                                                        @enderror
                                                    </div>

                                                    <div class="col-12 mb-2">
                                                        <label class="form-label">End
                                                            <small>(required)</small></label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text"><i
                                                                        class="bi bi-calendar2-week-fill"></i> </div>
                                                            </div>
                                                            <input name="medicine_end_update" type="text"
                                                                class="form-control hasdatetimepicker @error('medicine_end_update') is-invalid @enderror"
                                                                placeholder="YYYY/MM/DD" required>
                                                        </div>

                                                        @error('medicine_end_update')
                                                        <span class="error-msg-form">
                                                            {{ $message }}
                                                        </span>
                                                        @enderror

                                                        <span id="medicine_end_update_error"
                                                            class="error-msg-form"></span>
                                                    </div>


                                                </div>

                                                <input name="patient_id" value="{{ $patient->id }}" type="hidden">
                                                <input name="last_appointment_id" value="{{ $appointments[0]->id }}"
                                                    type="hidden">
                                                <input name="medicine_id_update" value="" type="hidden">

                                            </div>

                                            <div class="modal-footer">
                                                <div class="left-side">
                                                    <button type="button" class="btn btn-default btn-link"
                                                        data-bs-dismiss="modal">Never
                                                        Mind</button>
                                                </div>
                                                <div class="divider"></div>
                                                <div class="right-side">
                                                    <button type="submit"
                                                        class="btn btn-default btn-link main-color">Update</button>
                                                </div>
                                            </div>
                                        </form>

                                    </div>
                                </div>

                            </div>

                            <!-- Modal delete -->
                            <div class="modal fade" id="medicine_delete" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable ">

                                    <div class="modal-content shadow-lgg b-r-s-cont border-0">

                                        <div class="modal-header">
                                            <div class="modal-title" id="exampleModalLabel"><i
                                                    class="fas fa-trash me-1"></i>
                                                Medicine delete</div>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>

                                        <form class="mb-0" action="{{ route('sett.medicine.destroy', 'test') }}"
                                            method="post">
                                            {{ method_field('delete') }}
                                            {{ csrf_field() }}

                                            <!-- Modal content -->
                                            <div class="modal-body px-4">

                                                <div class="modal-body delete-conf-input text-center py-0">
                                                    <p class="mb-0">ِAre
                                                        you sure you want to delete
                                                        this
                                                        medicine?</p><br>
                                                    <input type="hidden" name="medicine_id_delete" value="">
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <div class="left-side">
                                                    <button type="button" class="btn btn-default btn-link"
                                                        data-bs-dismiss="modal">Never
                                                        Mind</button>
                                                </div>
                                                <div class="divider"></div>
                                                <div class="right-side">
                                                    <button type="submit"
                                                        class="btn btn-default btn-link text-red">Delete
                                                    </button>
                                                </div>

                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>


                        </div>

                    </div>
                </div>


            </div>
        </div>


        <!-- service -->
        <div class="col-12 col-lg-4">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 fw-bold">Diseases</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-300"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                            aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Dropdown Header:</div>
                            <a class="dropdown-item" href="#">Action</a>
                        </div>
                    </div>
                </div>

                <!-- Card Body -->
                <div class="card-body align-items-center text-center">
                    <a class="add-new-iteam stretched-link link-cust-text text-gray-400" href="#">
                        <i class="fas fa-plus-circle fa-sm fa-fw fs-4"></i>
                        <p class="fw-light mb-0">You can put your notes</p>
                    </a>
                </div>


                <!-- Card footer -->
                <div class="card-footer text-center ">
                    <a class="text-xs link-cust-text text-gray-300" href="#">
                        <i class="fas fa-chevron-down"></i> More
                    </a>
                </div>

            </div>
        </div>

        <!-- Lab results -->
        <div class="col-12 col-lg-4">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 fw-bold">Lab results</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-300"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                            aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Dropdown Header:</div>
                            <a class="dropdown-item" href="#">Action</a>
                        </div>
                    </div>
                </div>

                <!-- Card Body -->
                <div class="card-body pb-2">
                    <div class="list-group">

                        <div
                            class="list-group-item li-gr-it-no-space-flx justify-content-between align-items-center mb-2">
                            <div class="text-truncate">
                                <p class="text-gray-300 text-xs mb-0">17 Jun 2021</p>
                                <div class="text-xs text-gray-500 text-truncate"><i
                                        class="fas fa-file-medical-alt text-gray-300 me-1 text-truncate"></i>
                                    LR-Molar-3D XR.PDF</div>
                            </div>

                            <div>
                                <span class="badge rounded-pill cancel-color-btn py-2">Panding</span>
                            </div>
                        </div>

                        <div
                            class="list-group-item li-gr-it-no-space-flx justify-content-between align-items-center mb-2">
                            <div class="text-truncate">
                                <p class="text-gray-300 text-xs mb-0">17 Jun 2021</p>
                                <div class="text-xs text-gray-500 text-truncate"><i
                                        class="fas fa-file-medical-alt text-gray-300 me-1 text-truncate"></i>
                                    Laps-3D.PDF</div>
                            </div>

                            <div>
                                <a class="text-gray-400" href="#">
                                    <i class="fas fa-arrow-circle-down text-m"></i>
                                </a>
                            </div>
                        </div>

                        <div
                            class="list-group-item li-gr-it-no-space-flx justify-content-between align-items-center mb-2">
                            <div class="text-truncate">
                                <p class="text-gray-300 text-xs mb-0">17 Jun 2021</p>
                                <div class="text-xs text-gray-500 text-truncate"><i
                                        class="fas fa-file-medical-alt text-gray-300 me-1 text-truncate"></i>
                                    Ts101 XR.PDF</div>
                            </div>

                            <div>
                                <a class="text-gray-400" href="#">
                                    <i class="fas fa-arrow-circle-down text-m"></i>
                                </a>
                            </div>
                        </div>


                        <div
                            class="list-group-item li-gr-it-no-space-flx justify-content-between align-items-center mb-2">
                            <div class="text-truncate">
                                <p class="text-gray-300 text-xs mb-0">17 Jun 2021</p>
                                <div class="text-xs text-gray-500 text-truncate"><i
                                        class="fas fa-file-medical-alt text-gray-300 me-1 text-truncate"></i>
                                    SK211-3D.PDF</div>
                            </div>

                            <div>
                                <a class="text-gray-400" href="#">
                                    <i class="fas fa-arrow-circle-down text-m"></i>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Card footer -->
                <div class="card-footer text-center ">
                    <a class="text-xs link-cust-text text-gray-300" href="#" data-bs-toggle="modal"
                        data-bs-target="#labModal">
                        <i class="fas fa-chevron-down"></i> More
                    </a>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="labModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
                        <div class="modal-content b-r-s-cont border-0">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-microscope"></i>
                                    Lab results</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>

                            <!-- Modal content -->
                            <div class="modal-body px-4">


                                <div class="table-responsive">
                                    <table class="table display datatable-modal" id="p-lab-table" width="100%"
                                        cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th class="text-xs w-50">Name</th>
                                                <th class="text-xs text-center">responsible
                                                    dr</th>
                                                <th class="text-xs text-center">Statue</th>
                                                <th class="text-xs text-center">Handl</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="w-50">
                                                    <p class="text-gray-300 text-xs mb-0">17 Jun 2021
                                                    </p>
                                                    <div class="text-xs"><i
                                                            class="fas fa-file-medical-alt text-gray-300 me-1"></i>
                                                        LR-Molar-3D XR.PDF</div>
                                                </td>
                                                <td class="text-center">Hany Ahmed</td>
                                                <td class="text-center"> <span
                                                        class="badge rounded-pill pend-color-btn badge-padd-l">Panding</span>
                                                </td>
                                                <td class="lab-pp-edit text-center" data-id="2"><a><i
                                                            class="fas fa-edit"></i></a>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td class="w-50">
                                                    <p class="text-gray-300 text-xs mb-0">17 Jun 2021
                                                    </p>
                                                    <div class="text-xs"><i
                                                            class="fas fa-file-medical-alt text-gray-300 me-1"></i>
                                                        LR-Molar-3D XR.PDF</div>
                                                </td>
                                                <td class="text-center">Mohammed ahmed</td>
                                                </td>
                                                <td class="text-center"> <span
                                                        class="badge rounded-pill active-color-btn badge-padd-l">Done</span>
                                                </td>
                                                <td class="lab-pp-edit text-center" data-id="3"><a><i
                                                            class="fas fa-edit"></i></a>
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <div class="left-side">
                                    <button type="button" class="btn btn-default btn-link" data-bs-dismiss="modal">Never
                                        Mind</button>
                                </div>
                                <div class="divider"></div>
                                <div class="right-side">
                                    <button type="button" class="btn btn-default btn-link main-color">Save
                                        changes</button>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>

                <!-- Modal -->
                <div class="modal fade" id="labModal2" tabindex="-1" aria-labelledby="exampleModalLabel2"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
                        <div class="modal-content b-r-s-cont border-0">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel2"><i class="fas fa-microscope"></i>
                                    Lab results</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>

                            <!-- Modal content -->
                            <div class="modal-body px-4">

                                <div id="testmodalid"></div>
                            </div>


                            <div class="modal-footer">
                                <div class="left-side">
                                    <button type="button" class="btn btn-default btn-link" data-bs-dismiss="modal">Never
                                        Mind</button>
                                </div>
                                <div class="divider"></div>
                                <div class="right-side">
                                    <button type="button" class="btn btn-default btn-link main-color">Save
                                        changes</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div><!-- row end -->

    </div>



    <!-- Content Row -->
    <div class="row">

        <!-- Appointments -->
        <div class="col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 fw-bold">Appointments Timeline</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-300"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                            aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Dropdown Header:</div>
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </div>
                </div>

                <!-- Card Body -->
                <div class="card-body pb-2 overflow-scroll">
                    <ul class="list-group patient-timeline">

                        @foreach ($appointments as $iteam)

                        @if ($iteam->status == 0)
                        @php
                        $text_color = 'main-color';
                        $msg = 'Approved';
                        @endphp

                        @elseif ($iteam->status == 1)
                        @php
                        $text_color = 'cancel-color';
                        $msg = 'Canceled';
                        @endphp
                        @elseif ($iteam->status == 2)
                        @php
                        $text_color = 'arrived-color';
                        $msg = 'Arrived';
                        @endphp
                        @elseif ($iteam->status == 3)
                        @php
                        $text_color = 'inprog-color';
                        $msg = 'With the doctor';
                        @endphp
                        @elseif ($iteam->status == 4)
                        @php
                        $text_color = 'done-color';
                        $msg = 'Done';
                        @endphp

                        @endif

                        @break($loop->index === 3)

                        <li class="row flex-nowrap list-group-item d-flex justify-content-between position-relative">

                            <i class="col patient-timeline-pointer fas fa-circle text-xxs mb-0 {{ $text_color }}"></i>

                            <div class="col me-1">
                                <p class="text-xxs text-gray-200 mb-0">
                                    {{ date('h:i a', strtotime($iteam->start_at)) }}</p>
                                <h6 class="text-s fw-bold {{ $text_color }} mb-0">
                                    {{ date('d M Y', strtotime($iteam->start_at)) }}</h6>
                                <p class="text-xs {{ $text_color }} fw-bold mb-0">{{ $msg }}</p>
                            </div>

                            <div class="col text-center align-self-center me-1">
                                <p class="text-xs text-gray-200 mb-0">TYPE</p>
                                <h6 class="text-s text-gray-400">{{ $iteam->service_item->name }}</h6>
                            </div>

                            <div class="col text-center align-self-center me-1">
                                <p class="text-xs text-gray-200 mb-0">DOCTOR</p>
                                <h6 class="text-s text-gray-400 text-truncate">@if (isset($iteam->doctor->first_name))
                                    {{ $iteam->doctor->first_name }} @else Not selected @endif</h6>
                            </div>

                            <div class="col text-center align-self-center me-1">
                                <p class="text-xs text-gray-200 mb-0">BRNACH</p>

                                <h6 class="text-s text-gray-400">{{ $iteam->branch->name }}</h6>
                            </div>

                            <div class="col text-center align-self-center">
                                <a href="#" class="text-s text-gray-400">
                                    <i class="fas fa-info-circle m-1 fs-5"></i>
                                </a>
                            </div>

                        </li>
                        @endforeach

                    </ul>
                </div>

                <!-- Card footer -->
                <div class="card-footer text-center ">
                    <a class="text-xs link-cust-text text-gray-300" href="#">
                        <i class="fas fa-chevron-down"></i> More
                    </a>
                </div>

            </div>
        </div>

        <!-- Payment -->
        <div class="col-lg-5">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 fw-bold">Payment</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-300"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                            aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Dropdown Header:</div>
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body pb-2">

                    <div class="d-flex justify-content-between">
                        <p class="text-xs text-gray-300">Transaction</p>
                        <p class="text-xs text-gray-300">Amount</p>
                    </div>


                    @foreach ($treatment as $iteam)

                    @break($loop->index === 3)

                    @if ($iteam->status == 0)
                    @php
                    $text_color = 'cancel-color';
                    $msg = 'Not paid';
                    @endphp

                    @elseif ($iteam->status == 1)
                    @php
                    $text_color = 'main-color';
                    $msg = 'Paid';
                    @endphp
                    @endif

                    <div class="d-flex justify-content-between align-items-center mb-3">

                        <div class="me-1 d-flex align-self-center align-items-center me-2 text-truncate">
                            <i class="fas fa-circle me-2 text-xxs mb-0 {{ $text_color }}"></i>

                            <div class="text-truncate">
                                <p class="text-s text-truncate text-gray-700 mb-0 fw-bold">
                                    {{ $iteam->service_item->name }}</p>
                                <p class="text-xs text-gray-300 fw-bold mb-0">{{ $msg }}</p>
                            </div>
                        </div>

                        <div class="text-s text-gray-600 fw-bold">{{ $iteam->final_price }}<small
                                class="text-gray-300 text-xxxs">
                                EGP</small>
                        </div>

                    </div>

                    @endforeach

                </div>


                <!-- Card footer -->
                <div class="card-footer text-center ">
                    <a class="text-xs link-cust-text text-gray-300" href="#">
                        <i class="fas fa-chevron-down"></i> More
                    </a>
                </div>

            </div>
        </div>
    </div>




</div>


@endsection


@section('js')

<!-- select 2 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/js/select2.min.js"
    integrity="sha512-4MvcHwcbqXKUHB6Lx3Zb5CEAVoE9u84qN+ZSMM6s7z8IeJriExrV3ND5zRze9mxNlABJ6k864P/Vl8m0Sd3DtQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function() {


            $(".myselect2-medicine-insert").select2({
                dropdownParent: $("#addmedic")
            });

            //hide search
            $('.myselect2-medicine-insert-nosearch').select2({
                dropdownParent: $("#addmedic"),
                minimumResultsForSearch: -1
            });

            $(".myselect2-medicine-update").select2({
                dropdownParent: $("#medicine_edit")
            });

            //hide search
            $('.select2-no-search-medicine').select2({
                dropdownParent: $("#medicine_edit"),
                minimumResultsForSearch: -1
            });



            $(".myselect2-disease-insert").select2({
                dropdownParent: $("#adddisease")
            });

            $(".myselect2-disease-update").select2({
                dropdownParent: $("#disease_edit")
            });

            //hide search
            $('.select2-no-search-disease').select2({
                dropdownParent: $("#disease_edit"),
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

<script>
    //mediciens modals edit
        $(".medicine_edit_click").on('click', function() {

            var medicine_id = $(this).data("medicine_id");

            var medicinescats_id = $(this).data("medicinescats_id");
            var status_medicine = $(this).data("status_medicine");
            var start = $(this).data("start");
            var end = $(this).data("end");

            $("#medicine_pills_update").select2("val", String(medicinescats_id));

            $("#status_medicine_update").select2("val", String(status_medicine));

            $('input[name = "medicine_start_update"]').val(start);
            $('input[name = "medicine_end_update"]').val(end);
            $('input[name = "medicine_id_update"]').val(medicine_id);

            $('.modal').modal('hide');
            $('#medicine_edit').modal('show');

        });

        //mediciens modals delete
        $(".medicine_delete_click").on('click', function() {

            var medicine_id = $(this).data("medicine_id");

            $('input[name = "medicine_id_delete"]').val(medicine_id);

            $('.modal').modal('hide');
            $('#medicine_delete').modal('show');

        });


        //disease modals edit
        $(".disease_edit_click").on('click', function() {

            var disease_id = $(this).data("disease_id");

            var diseasecats_id = $(this).data("diseasecats_id");
            var status_disease = $(this).data("status_disease");
            var start = $(this).data("start");
            var end = $(this).data("end");

            $("#disease_cat_update").select2("val", String(diseasecats_id));

            $("#status_disease_update").select2("val", String(status_disease));

            $('input[name = "disease_start_update"]').val(start);
            $('input[name = "disease_end_update"]').val(end);
            $('input[name = "disease_id_update"]').val(disease_id);

            $('.modal').modal('hide');
            $('#disease_edit').modal('show');

        });

        //disease modals delete
        $(".disease_delete_click").on('click', function() {

            var disease_id = $(this).data("disease_id");

            $('input[name = "disease_id_delete"]').val(disease_id);

            $('.modal').modal('hide');
            $('#disease_delete').modal('show');

        });
</script>

<!-- -- datatables plugin -- -->
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

<script>
    $(document).ready(function() {

            var table = $('#table-medicine').DataTable({
                    lengthChange: false,

                    buttons: {
                        dom: {
                            button: {
                                className: 'btn btn-table-export me-0' //Primary class for all buttons
                            }
                        },
                        buttons: ['copy', 'excel', 'pdf']
                    }
                }

            );
            table.buttons().container()
                .appendTo('#table-medicine_wrapper .col-md-6:eq(0)');

            var table = $('#table-disease').DataTable({
                    lengthChange: false,

                    buttons: {
                        dom: {
                            button: {
                                className: 'btn btn-table-export me-0'
                            }
                        },
                        buttons: ['copy', 'excel', 'pdf']
                    }
                }

            );
            table.buttons().container()
                .appendTo('#table-disease_wrapper .col-md-6:eq(0)');

        });
</script>

<script>
    $(document).ready(function() {

            var id = '{{ $patient->id }}';

            //update note
            $(document).on('click', '#note_ajax', function() {

                var query_text = $("textarea[name='note']").val();

                $.ajax({
                    url: '{{ url('patient/note_ajax') }}/' + id,
                    type: "PATCH",
                    data: {
                        '_token': "{{ csrf_token() }}",
                        'query': query_text,
                    },
                    success: function(data) {
                        if (data.querystatue == true) {
                            var branch_id = $('#select-branch-calendar').val();
                            fetchTimeslotsCalander(year, month, day, branch_id)
                        }
                    }
                });
            });


        });

        //current Current Medicines
</script>

@endsection