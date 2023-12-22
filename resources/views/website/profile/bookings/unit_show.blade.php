@extends('website.layouts.master_top')
@section('css')
@endsection
@section('content')
<div class="row p-3 pt-0">
    <div class="banner radius-20" style="height: 310px">
        <div class="w-50 float-end pt-5 text-light">
            <h1 class="fw-bold text-light fs-5">the easiest way</h1>
            <h2 class="fw-bold">to discover the world</h2>
            <p class="fs-8">
                Lorem Ipsum is simply dummy text of the printing and
                typesetting industry. Lorem Ipsum has been the industry's
                standard dummy text
            </p>
        </div>
    </div>
</div>

@if ($unit_packages->status == 0)
@php
$text_color = 'not_accepted-color-btn';
$msg = __('patientappo.not accepted');
@endphp
@elseif ($unit_packages->status == 1)
@php
$text_color = 'main-color-btn';
$msg = __('patientappo.accepted');
@endphp
@elseif ($unit_packages->status == 2)
@php
$text_color = 'active-color-btn';
$msg = __('broker inquire');
@endphp
@elseif ($unit_packages->status == 3)
@php
$text_color = 'prog-color-btn';
$msg = __('traveler payment');
@endphp
@elseif ($unit_packages->status == 4)
@php
$text_color = 'done-color-btn';
$msg = __('received payment');
@endphp
@elseif ($unit_packages->status == 5)
@php
$text_color = 'pend-color-btn';
$msg = __('send a payment to broker');
@endphp
@elseif ($unit_packages->status == 6)
@php
$text_color = 'prog-color-btn';
$msg = __('broker confirm');
@endphp
@elseif ($unit_packages->status == 7)
@php
$text_color = 'done-color-btn';
$msg = __('patientappo.done');
@endphp
@elseif ($unit_packages->status == 8)
@php
$text_color = 'cancel-color-btn';
$msg = __('patientappo.canceled');
@endphp
@endif

@if ($unit_packages->invoice_item)
@if ($unit_packages->invoice_item->invoice->status == 0)
@php
$msg_invoice = __('basic.not paid');
$text_color_invoice = 'cancel-color-btn';
@endphp
@elseif ($unit_packages->invoice_item->invoice->status == 1)
@php
$text_color_invoice = 'pend-color-btn';
$msg_invoice = __('basic.pending');
@endphp
@elseif ($unit_packages->invoice_item->invoice->status == 2)
@php
$text_color_invoice = 'prog-color-btn';
$msg_invoice = __('basic.installment');
@endphp
@elseif ($unit_packages->invoice_item->invoice->status == 3)
@php
$text_color_invoice = 'done-color-btn';
$msg_invoice = __('basic.paid');
@endphp
@elseif ($unit_packages->invoice_item->invoice->status == 4)
@php
$msg_invoice = __('basic.refund');
$text_color_invoice = 'cancel-color-btn';
@endphp
@endif
@else
@php
$msg_invoice = 'No fees';
$text_color_invoice = 'done-color-btn';
@endphp
@endif


<div class="justify-content-between align-items-center mt-5 mb-3">
    <div class="mb-3">
        <h2 class="fs-4 fw-bold text-capitalize">Booking details of <span class="text-gray-300">{{ $unit_packages->code
                }}
            </span></h2>
        <p class="fs-8 text-secondary mb-0">
            Here is your the information bookings from Destino Tours
        </p>
    </div>

    <div
        class="d-flex bg-white justify-content-evenly justify-content-lg-between align-items-center shadow mb-3 p-3 radius-20 flex-wrap">

        <div class="d-flex mb-2 align-items-center">
            <img class="rounded-circle avatar-lg me-3"
                src="{{ URL::asset('img/useravatar/' . $unit_packages->patient->avatar) }}">
            <div class="">
                <p class=" mb-0 text-xs text-gray-300">
                    {{ __('basic.patient') }}</p>
                <a class="mb-1 fw-bold fs-5 text-gray-600" href="{{
            route('sett.managers.show', $unit_packages->patient->id) }}">{{ $unit_packages->patient->first_name . ' '
                    . $unit_packages->patient->second_name }}
                </a>
                <p class="mb-0 text-xs text-gray-400">{{ __('Passport Number:') }} <strong>
                        {{ $unit_packages->patient->passport_number }}</strong>
                </p>
            </div>
        </div>

        <div class="visible-print text-center">
            {!! QrCode::color(68, 95,
            129)->size(75)->style('round')->eye('circle')->generate($unit_packages->code) !!}
            <p id="addre_final_info" class="text-gray-300 fs-6 fw-bold mt-1 mb-0 text-gray-300">
                {{ $unit_packages->code }}</p>
        </div>
    </div>


    <div
        class="d-flex bg-white justify-content-evenly justify-content-lg-between align-items-center shadow mb-3 p-3 radius-20 flex-wrap">


        <div class="d-flex align-items-center">
            <img src="{{ URL::asset('img/products/' . $unit_packages->hotel->main_image) }}" class="radius-10 me-3 mb-2"
                width="90px" height="90px" alt="" />
            <div class="m-2">

                <a class="fs-7 link-cust-text text-gray-900 fw-bold mb-1"
                    href="{{route('school_route.unit_package_book_show', $unit_packages->code)}}">
                    {{ $unit_packages->hotel->name }}
                </a>

                <p class="fs-8 gray mb-0">{{ $unit_packages->code }}</p>
                <div class="fs-8 gray"><i class="fa-solid fa-location-dot me-1 blue"></i>{{
                    $unit_packages->destination->name }}</div>

            </div>
        </div>

        <div class="m-1">
            <p class="fs-8 gray mb-2">
                <i class="fa-solid fa-calendar me-1 blue"></i> {{ $unit_packages->start_at }}
            </p>
            <p class="fs-8 gray mb-2">
                <i class="fa-solid fa-calendar me-1 blue"></i> {{ $unit_packages->end_at }}
            </p>
            <p class="fs-8 gray m-0">
                <i class="fa-solid fa-user me-2 blue"></i> {{ $unit_packages->room_type }} for {{
                $unit_packages->quantity }}
                people
            </p>
        </div>

        <div class="">
            <div class="fs-8 gray m-0 mb-2">
                <i class="fa-solid fa-signal me-1 blue"></i> Status
            </div>
            <p> <span class="badge rounded-pill {{ $text_color }} badge-padd-l">{{
                    $msg
                    }}</span></p>
            <div class="fs-8 gray m-0 mb-2">
                <i class="fa-solid fa-dollar me-1 blue"></i> Payment
            </div>
            <p> <span class="badge rounded-pill {{ $text_color_invoice }} badge-padd-l">{{
                    $msg_invoice
                    }}</span></p>
        </div>

    </div>

    <div class="d-flex justify-content-between mt-4 mb-2">
        <div class="d-flex justify-content-between ">
            <a class="btn see-all" href="{{route('school_route.my_bookings')}}">Previous</a>
        </div>
    </div>

</div>

<div class="row">
    <!-- Card Body -->
    <div class="card-body">


    </div>
</div>

@endsection
@section('js')
@endsection