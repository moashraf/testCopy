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


<div class="row">
    <!-- Card Body -->
    <div class="card-body">

        <div class="card card-input py-4 shadow px-5">

            <!-- Card Body -->
            <div class="card-body px-0 py-0">

                <div class="row d-flex justify-content-around align-items-center ">

                    <div class="col-7 col-md-5 d-flex align-items-center mb-3 mb-md-0">
                        <img id="avatar_final_info" class="rounded-circle avatar-m me-2"
                            src="{{ URL::asset('img/useravatar/' . $appointment->receivable->avatar) }}">
                        <div class="">
                            <p class=" mb-0 text-xs text-gray-300">
                                {{ __('basic.patient') }}</p>
                            <p id="name_final_info" class="mb-1 fw-bold text-gray-600 fs-6">
                                {{ $appointment->receivable->full_name }}
                            </p>
                            <p id="number_final_info" class="mb-0 text-xs text-gray-400">
                                {{ $appointment->receivable->phone_number }}</p>
                        </div>
                    </div>

                    <div class="col-4 col-md-3">
                        <h6 class="text-gray-300 text-xs mb-2">{{ __('patientappo.pay status') }}</h6>

                        @if ($appointment->status == 0)
                        @php
                        $msg_invoice_debtor = __('basic.not paid');
                        $text_color_invoice_debtor = 'cancel-color-btn';
                        @endphp
                        @elseif ($appointment->status == 1)
                        @php
                        $text_color_invoice_debtor = 'pend-color-btn';
                        $msg_invoice_debtor = __('basic.pending');
                        @endphp
                        @elseif ($appointment->status == 2)
                        @php
                        $text_color_invoice_debtor = 'prog-color-btn';
                        $msg_invoice_debtor = __('basic.installment');
                        @endphp
                        @elseif ($appointment->status == 3)
                        @php
                        $text_color_invoice_debtor = 'done-color-btn';
                        $msg_invoice_debtor = __('basic.paid');
                        @endphp
                        @elseif ($appointment->status == 4)
                        @php
                        $msg_invoice_debtor = __('basic.refund');
                        $text_color_invoice_debtor = 'cancel-color-btn';
                        @endphp
                        @endif

                        <span class="badge rounded-pill {{ $text_color_invoice_debtor }} badge-padd-l">
                            {{ $msg_invoice_debtor }}</span>
                    </div>

                    <div class="col-4 col-md-2">
                        <h6 class="text-gray-300 text-xs mb-1">{{ __('basic.creator') }}</h6>
                        <p id="addre_final_info" class="text-gray-600 text-s fw-bold">
                            {{ $appointment->creator->first_name }}</p>
                    </div>

                    <div class="col-4 col-md-2">
                        <div class="visible-print text-center">
                            {!! QrCode::color(68, 95,
                            129)->size(60)->style('round')->eye('circle')->generate($appointment->code) !!}
                            <p class="mt-1 mb-0 text-xxs fw-bold text-gray-300">{{ $appointment->code }}</p>
                        </div>
                    </div>
                </div>

                <hr>

                <div class="px-2 mt-4">

                    @foreach ($appointment->invoice_items as $item)
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="me-2">

                            @if ($item->debtor)

                            @php
                            $debtor_ur_wa = route('school_route.land_show_pat_appointment_public', $appointment->code);
                            @endphp

                            @if ($item->type == 1)
                            @php
                            $service_type = "Hotel";
                            @endphp
                            @elseif ($item->type == 2)
                            @php
                            $service_type = "Single Bus";
                            @endphp
                            @elseif ($item->type == 3)
                            @php
                            $service_type = "Round Bus";
                            @endphp
                            @elseif ($item->type == 4)
                            @php
                            $service_type = "Visa";
                            @endphp
                            @elseif ($item->type == 5)
                            @php
                            $service_type = "Airline Single";
                            @endphp
                            @elseif ($item->type == 6)
                            @php
                            $service_type = "airline round";
                            @endphp
                            @elseif ($item->type == 7)
                            @php
                            $service_type = "Package";
                            @endphp
                            @elseif ($item->type == 8)
                            @php
                            $service_type = "Trip";
                            @endphp
                            @endif
                            @endif

                            <i class="fas fa-suitcase me-1 text-gray-400"></i>
                            <span class="text-gray-300">{{ $service_type }}</span>
                            <span id="service_final_info">
                                @if ($item->room_type)
                                {{ $item->room_type }} Room
                                @endif {{ $item->categorizable->name }} @if ($item->days)
                                for {{ $item->days }} days
                                @endif
                                {{ "*" . $item->qty }}
                            </span>

                        </div>

                        <div id="service_price_final_info" class="text-center">
                            @if ($item->final_price)
                            {{ $item->final_price }} <small class="text-gray-300 text-xxxs">
                                {{ __('basic.egp') }}</small>
                            @else
                            No fees
                            @endif
                        </div>
                    </div>

                    @endforeach

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="me-2">
                            <i class="fas fa-percent me-2 text-gray-400"></i> {{ __('basic.discount') }}
                        </div>
                        <div id="discount_amount_place" class="text-center text-decoration-line-through">
                            @if ($appointment->invoice_item)
                            @if (!empty($invoice->invoice_item->invoice->discount))
                            {{ $appointment->invoice_item->invoice->discount }} <small class="text-gray-300 text-xxxs">
                                {{ __('basic.egp') }}</small>
                            @else
                            0
                            @endif
                            @else
                            No Discount
                            @endif
                        </div>
                    </div>

                    <hr>

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="me-2 fw-bold">
                            <i class="fas fa-dollar-sign me-2"></i> {{ __('basic.total price') }}
                        </div>
                        <div id="price_total_final_info" class="fw-bold text-center">

                            {{ $appointment->final_price }} <small class="text-gray-300 text-xxxs">
                                {{ __('basic.egp') }}</small>

                        </div>
                    </div>

                    <div class="row mb-2 ">
                        <div class="mb-3">
                            <label class="form-label text-gray-300">{{ __('basic.note') }}</label>
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
                        <div class="col-12 col-md mb-2 mb-md-0 text-white">
                            Here is the total price including tax
                        </div>
                        <div class="col-12 col-md text-center">

                            <h6 class="text-xs mb-1">{{ __('Final price') }}</h6>
                            <p id="date_final_info" class="text-l fs-4 fw-bold mb-0">
                                {{ $appointment->final_price }}
                            </p>
                            <p id="time_final_info" class="text-s text-blue-200">
                                {{ date('d M Y', strtotime($appointment->created_at)) }}</p>
                        </div>

                    </div>

                </div>

            </div>

        </div>


        <div class="d-flex justify-content-between mt-4 mb-2">
            <div class="d-flex justify-content-between ">
                <a class="btn see-all" href="{{route('school_route.my_invoices')}}">Previous</a>
            </div>
        </div>
    </div>
</div>

@endsection
@section('js')
@endsection