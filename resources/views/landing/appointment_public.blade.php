@extends('layouts.land.master_top')

@section('title', 'Register - Pain Cure | Dr. Amr Saeed')

<!-- css insert -->
@section('css')

<!-- animate.css -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

<link rel="stylesheet" href="{{ URL::asset('plugins/owl/owl.carousel.min.css') }}">

@endsection

<!-- content insert -->
@section('content')


<div class="bradcam_area breadcam_bg bradcam_overlay"
    style="background-image: url('{{ asset('img/dashboard/system/landing/bradcam.jpg') }}'); padding:87px;">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="text-white">
                    <h1>Appointment Confirmation</h1>
                    <p><a class="text-gray-200" href="{{ route('landing') }}">Home /</a> Appointment Confirmation</p>
                </div>
            </div>
        </div>
    </div>
</div>

@if ($appointment)
<div class="container bg-white position-relative b-r-s-cont p-3 shadow" style="margin-top: -84px; z-index:9;">

    <div class="row d-flex justify-content-around align-items-center my-2 px-1 px-md-5">

        <div class="col-8 col-md-4 d-flex align-items-center mb-3 mb-md-0">
            <img id="avatar_final_info" class="rounded-circle avatar-m me-3"
                src="{{ URL::asset('img/useravatar/' . $appointment->patient->avatar) }}">
            <div class="">
                <p class=" mb-0 text-xs text-gray-300">
                    {{ __('basic.patient') }}</p>
                <a href="{{ route('sett.managers.show', $appointment->id) }}" id="name_final_info"
                    class="mb-1 fw-bold text-gray-600 fs-6">
                    {{ $appointment->patient->name }}
                </a>
                <p id="number_final_info" class="mb-0 text-xs text-gray-400">
                    {{ $appointment->patient->phone_number }}</p>
            </div>
        </div>

        <div class="col-4 col-md-2">
            <h6 class="text-gray-300 text-xs mb-1">{{ __('basic.branch') }}</h6>
            <p id="branch_final_info" class="text-gray-600 text-s fw-bold">
                {{ $appointment->branch->name }}</p>
        </div>

        <div class="col-4 col-md-2">
            <h6 class="text-gray-300 text-xs mb-1">{{ __('basic.address') }}</h6>
            <p id="addre_final_info" class="text-gray-600 text-s fw-bold">
                {{ $appointment->branch->address }}</p>
        </div>

        <div class="col-4 col-md-2">
            <h6 class="text-gray-300 text-xs mb-1">{{ __('basic.creator') }}</h6>
            <p id="addre_final_info" class="text-gray-600 text-s fw-bold">
                {{ $appointment->creator->name }}</p>
        </div>

        <div class="col-4 col-md-2">
            <div class="visible-print text-center">
                {!! QrCode::color(68, 95, 129)->size(60)->style('round')->eye('circle')->generate($appointment->code)
                !!}
                <p class="mt-1 mb-0 text-xs fw-bold text-gray-300">{{ $appointment->code }}</p>
            </div>
        </div>
    </div>

    <hr>

    <div class="px-2 px-lg-5 mt-4">

        <div class="d-flex justify-content-between align-items-center px-lg-5 mb-3">
            <div class="me-2">
                <i class="fas fa-suitcase-rolling me-2 text-gray-400"></i>
                <span id="service_final_info">
                    {{ $appointment->service_item->name }}
                </span>
            </div>
            <div id="service_price_final_info" class="text-center">
                @if ($appointment->invoice_item)
                {{ $appointment->invoice_item->price }}
                @else
                No Fees
                @endif
            </div>
        </div>


        <div class="d-flex justify-content-between align-items-center px-lg-5 mb-3">
            <div class="me-2">
                <i class="fas fa-percent me-2 text-gray-400"></i> {{ __('basic.discount') }}
            </div>
            <div id="discount_amount_place" class="text-center text-decoration-line-through">
                @if ($appointment->invoice_item)
                {{ $appointment->invoice_item->invoice->discount }}
                @else
                No Fees
                @endif
            </div>
        </div>

        <div class="d-flex justify-content-between align-items-center px-lg-5 mb-4">
            <div class="me-2 fw-bold">
                <i class="fas fa-dollar-sign me-2"></i> {{ __('basic.total price') }}
            </div>
            <div id="price_total_final_info" class="fw-bold text-center">
                @if ($appointment->invoice_item)
                {{ $appointment->invoice_item->invoice->final_price }}
                @else
                No Fees
                @endif
            </div>
        </div>

        <div class="row mb-2 px-lg-5">
            <div class="mb-3">
                <label class="form-label">{{ __('basic.note') }}</label>
                <div class="form-control-textarea overflow-auto">{{ $appointment->note }}
                </div>
            </div>
        </div>

        @error('appointment_note')
        <span class="error-msg-form">
            {{ $message }}
        </span>
        @enderror

        <div class="row align-items-center main-color-bg text-white px-lg-5 b-r-s-cont px-4 py-4">
            <div class="col-12 col-md text-blue-300 mb-2 mb-md-0">
                {{ __('patientappo.come before 15 msg') }}
            </div>
            <div class="col-12 col-md text-center">

                <h6 class="text-xs mb-1 text-blue-300">{{ __('basic.appointment time') }}</h6>
                <p id="date_final_info" class="text-l fs-4 fw-bold mb-0">
                    {{ date('h:i a', strtotime($appointment->start_at)) . ' to ' . date('h:i a',
                    strtotime($appointment->end_at)) }}
                </p>
                <p id="time_final_info" class="text-s text-blue-200">
                    {{ date('d M Y', strtotime($appointment->start_at)) }}</p>
            </div>

        </div>

    </div>

    <div class="mt-3">
        <span class="text-gray-300"><i class="fas fa-question-circle"></i> You need to login to get all
            serivces </span> <a class=" text-green-ligh" href="{{ route('school_route.register') }}">
            Register Now</a>
    </div>
</div>
@else
<div class="container bg-white position-relative b-r-s-cont p-3 shadow" style="margin-top: -84px; z-index:9;">
    <div class="p-5 text-center text-gray-400">
        <i class="bi bi-brightness-alt-high-fill fs-1"></i>
        <h3>Sorry, there is no appointment available</h3>
    </div>
</div>
@endif


@endsection

<!-- js insert -->
@section('js')

@endsection