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

<div class="justify-content-between align-items-center mt-5 mb-3">
    <div class="mb-3">
        <h2 class="fs-4 fw-bold text-capitalize">All Your Bookings</h2>
        <p class="fs-8 text-secondary mb-0">
            Here is your last bookings
        </p>
    </div>


    <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">

        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="package-tab" data-bs-toggle="tab" data-bs-target="#package_tap"
                type="button" role="tab" aria-controls="package_tap" aria-selected="true" class="text-gray-500"><i
                    class="fas fa-box-open me-1"></i>
                {{ __('Packages') }}</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="hotel-tab" data-bs-toggle="tab" data-bs-target="#hotel_tap" type="button"
                role="tab" aria-controls="hotel_tap" aria-selected="true" class="text-gray-500"><i
                    class="fas fa-hotel me-1"></i>
                {{ __('Hotel') }}</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="trip-tab" data-bs-toggle="tab" data-bs-target="#trip_tap" type="button"
                role="tab" aria-controls="trip_tap" aria-selected="false" class="main-color"><i
                    class="fas fa-suitcase me-1"></i>
                {{ __('Trips') }}</button>
        </li>
    </ul>

    <div class="tab-content" id="myTabContent">

        <div class="tab-pane fade show active mb-2" id="package_tap" role="tabpanel" aria-labelledby="package_tap">
            <div class="row justify-content-center position-relative">

                @foreach ($unit_packages as $item)

                @if ($item->status == 0)
                @php
                $text_color = 'not_accepted-color-btn';
                $msg = __('patientappo.not accepted');
                @endphp
                @elseif ($item->status == 1)
                @php
                $text_color = 'main-color-btn';
                $msg = __('patientappo.accepted');
                @endphp
                @elseif ($item->status == 2)
                @php
                $text_color = 'active-color-btn';
                $msg = __('broker inquire');
                @endphp
                @elseif ($item->status == 3)
                @php
                $text_color = 'prog-color-btn';
                $msg = __('traveler payment');
                @endphp
                @elseif ($item->status == 4)
                @php
                $text_color = 'done-color-btn';
                $msg = __('received payment');
                @endphp
                @elseif ($item->status == 5)
                @php
                $text_color = 'pend-color-btn';
                $msg = __('send a payment to broker');
                @endphp
                @elseif ($item->status == 6)
                @php
                $text_color = 'prog-color-btn';
                $msg = __('broker confirm');
                @endphp
                @elseif ($item->status == 7)
                @php
                $text_color = 'done-color-btn';
                $msg = __('patientappo.done');
                @endphp
                @elseif ($item->status == 8)
                @php
                $text_color = 'cancel-color-btn';
                $msg = __('patientappo.canceled');
                @endphp
                @endif

                @if ($item->invoice_item)
                @if ($item->invoice_item->invoice->status == 0)
                @php
                $msg_invoice = __('basic.not paid');
                $text_color_invoice = 'cancel-color-btn';
                @endphp
                @elseif ($item->invoice_item->invoice->status == 1)
                @php
                $text_color_invoice = 'pend-color-btn';
                $msg_invoice = __('basic.pending');
                @endphp
                @elseif ($item->invoice_item->invoice->status == 2)
                @php
                $text_color_invoice = 'prog-color-btn';
                $msg_invoice = __('basic.installment');
                @endphp
                @elseif ($item->invoice_item->invoice->status == 3)
                @php
                $text_color_invoice = 'done-color-btn';
                $msg_invoice = __('basic.paid');
                @endphp
                @elseif ($item->invoice_item->invoice->status == 4)
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

                <div
                    class="d-flex bg-white justify-content-evenly justify-content-lg-between align-items-center shadow mb-3 p-3 radius-20 flex-wrap">
                    <div class="d-flex align-items-center">
                        <img src="{{ URL::asset('img/products/' . $item->hotel->main_image) }}"
                            class="radius-10 me-3 mb-2" width="90px" height="90px" alt="" />
                        <div class="m-2">
                            <a class="fs-7 link-cust-text text-gray-900 fw-bold mb-1"
                                href="{{route('school_route.unit_package_book_show', $item->code)}}">
                                {{ $item->offer->name }}
                            </a>

                            <p class="fs-8 gray mb-0">{{ $item->code }}</p>
                            <div class="fs-8 gray"><i class="fa-solid fa-location-dot me-1 blue"></i>{{
                                $item->destination->name }}</div>

                        </div>
                    </div>

                    <div class="m-1">
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

                    <div class="m-1">
                        <p class="fs-8 gray mb-2">
                            <i class="fa-solid fa-calendar me-1 blue"></i> {{ $item->start_at }}
                        </p>
                        <p class="fs-8 gray mb-2">
                            <i class="fa-solid fa-calendar me-1 blue"></i> {{ $item->end_at }}
                        </p>
                        <p class="fs-8 gray m-0">
                            <i class="fa-solid fa-user me-2 blue"></i> {{ $item->room_type }} for {{ $item->quantity }}
                            people
                        </p>
                    </div>

                    <div class="m-1">
                        @if($item->invoice_item)
                        <p class="fw-bold blue mb-1 fs-4">{{ $item->invoice_item->final_price }}</p>
                        @else
                        No Invoice
                        @endif
                    </div>
                </div>
                @endforeach

                @foreach ($full_package as $item)

                @if ($item->status == 0)
                @php
                $text_color = 'not_accepted-color-btn';
                $msg = __('patientappo.not accepted');
                @endphp
                @elseif ($item->status == 1)
                @php
                $text_color = 'main-color-btn';
                $msg = __('patientappo.accepted');
                @endphp
                @elseif ($item->status == 2)
                @php
                $text_color = 'active-color-btn';
                $msg = __('broker inquire');
                @endphp
                @elseif ($item->status == 3)
                @php
                $text_color = 'prog-color-btn';
                $msg = __('traveler payment');
                @endphp
                @elseif ($item->status == 4)
                @php
                $text_color = 'done-color-btn';
                $msg = __('received payment');
                @endphp
                @elseif ($item->status == 5)
                @php
                $text_color = 'pend-color-btn';
                $msg = __('send a payment to broker');
                @endphp
                @elseif ($item->status == 6)
                @php
                $text_color = 'prog-color-btn';
                $msg = __('broker confirm');
                @endphp
                @elseif ($item->status == 7)
                @php
                $text_color = 'done-color-btn';
                $msg = __('patientappo.done');
                @endphp
                @elseif ($item->status == 8)
                @php
                $text_color = 'cancel-color-btn';
                $msg = __('patientappo.canceled');
                @endphp
                @endif

                @if ($item->invoice_item)
                @if ($item->invoice_item->invoice->status == 0)
                @php
                $msg_invoice = __('basic.not paid');
                $text_color_invoice = 'cancel-color-btn';
                @endphp
                @elseif ($item->invoice_item->invoice->status == 1)
                @php
                $text_color_invoice = 'pend-color-btn';
                $msg_invoice = __('basic.pending');
                @endphp
                @elseif ($item->invoice_item->invoice->status == 2)
                @php
                $text_color_invoice = 'prog-color-btn';
                $msg_invoice = __('basic.installment');
                @endphp
                @elseif ($item->invoice_item->invoice->status == 3)
                @php
                $text_color_invoice = 'done-color-btn';
                $msg_invoice = __('basic.paid');
                @endphp
                @elseif ($item->invoice_item->invoice->status == 4)
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

                <div
                    class="d-flex bg-white justify-content-evenly justify-content-lg-between align-items-center shadow mb-3 p-3 radius-20 flex-wrap">
                    <div class="d-flex align-items-center">
                        <img src="{{ URL::asset('img/products/' . $item->package_offer->package->main_image) }}"
                            class="radius-10 me-3 mb-2" width="90px" height="90px" alt="" />
                        <div class="m-2">

                            <a class="fs-7 link-cust-text text-gray-900 fw-bold mb-1"
                                href="{{route('school_route.full_package_book_show', $item->code)}}">
                                {{ $item->package_offer->name }}
                            </a>

                            <p class="fs-8 gray mb-0">{{ $item->code }}</p>
                            <div class="fs-8 gray"><i class="fa-solid fa-location-dot me-1 blue"></i>{{
                                $item->package_offer->package->destination->name }}</div>

                        </div>
                    </div>

                    <div class="m-1">
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

                    <div class="m-1">
                        <p class="fs-8 gray mb-2">
                            <i class="fa-solid fa-calendar me-1 blue"></i> {{ $item->start_at }}
                        </p>
                        <p class="fs-8 gray mb-2">
                            <i class="fa-solid fa-calendar me-1 blue"></i> {{ $item->end_at }}
                        </p>
                        <p class="fs-8 gray m-0">
                            <i class="fa-solid fa-user me-2 blue"></i> {{ $item->qty }}
                            people
                        </p>
                    </div>

                    <div class="m-1">
                        @if($item->invoice_item)
                        <p class="fw-bold blue mb-1 fs-4">{{ $item->invoice_item->final_price }}</p>
                        @else
                        No Invoice
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <div class="tab-pane fade show mb-2" id="hotel_tap" role="tabpanel" aria-labelledby="trip_tap">
            <div class="row justify-content-center mb-4">


                @foreach ($unit_bookings as $item)

                @if ($item->status == 0)
                @php
                $text_color = 'not_accepted-color-btn';
                $msg = __('patientappo.not accepted');
                @endphp
                @elseif ($item->status == 1)
                @php
                $text_color = 'main-color-btn';
                $msg = __('patientappo.accepted');
                @endphp
                @elseif ($item->status == 2)
                @php
                $text_color = 'active-color-btn';
                $msg = __('broker inquire');
                @endphp
                @elseif ($item->status == 3)
                @php
                $text_color = 'prog-color-btn';
                $msg = __('traveler payment');
                @endphp
                @elseif ($item->status == 4)
                @php
                $text_color = 'done-color-btn';
                $msg = __('received payment');
                @endphp
                @elseif ($item->status == 5)
                @php
                $text_color = 'pend-color-btn';
                $msg = __('send a payment to broker');
                @endphp
                @elseif ($item->status == 6)
                @php
                $text_color = 'prog-color-btn';
                $msg = __('broker confirm');
                @endphp
                @elseif ($item->status == 7)
                @php
                $text_color = 'done-color-btn';
                $msg = __('patientappo.done');
                @endphp
                @elseif ($item->status == 8)
                @php
                $text_color = 'cancel-color-btn';
                $msg = __('patientappo.canceled');
                @endphp
                @endif

                @if ($item->invoice_item)
                @if ($item->invoice_item->invoice->status == 0)
                @php
                $msg_invoice = __('basic.not paid');
                $text_color_invoice = 'cancel-color-btn';
                @endphp
                @elseif ($item->invoice_item->invoice->status == 1)
                @php
                $text_color_invoice = 'pend-color-btn';
                $msg_invoice = __('basic.pending');
                @endphp
                @elseif ($item->invoice_item->invoice->status == 2)
                @php
                $text_color_invoice = 'prog-color-btn';
                $msg_invoice = __('basic.installment');
                @endphp
                @elseif ($item->invoice_item->invoice->status == 3)
                @php
                $text_color_invoice = 'done-color-btn';
                $msg_invoice = __('basic.paid');
                @endphp
                @elseif ($item->invoice_item->invoice->status == 4)
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

                <div
                    class="d-flex bg-white justify-content-evenly justify-content-lg-between align-items-center shadow mb-3 p-3 radius-20 flex-wrap">
                    <div class="d-flex align-items-center">
                        <img src="{{ URL::asset('img/products/' . $item->hotel->main_image) }}"
                            class="radius-10 me-3 mb-2" width="90px" height="90px" alt="" />
                        <div class="m-2">

                            <a class="fs-7 link-cust-text text-gray-900 fw-bold mb-1"
                                href="{{route('school_route.unit_book_show', $item->code)}}">
                                {{ $item->hotel->name }}
                            </a>

                            <p class="fs-8 gray mb-0">{{ $item->code }}</p>
                            <div class="fs-8 gray"><i class="fa-solid fa-location-dot me-1 blue"></i>{{
                                $item->destination->name }}</div>

                        </div>
                    </div>

                    <div class="m-1">
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

                    <div class="m-1">
                        <p class="fs-8 gray mb-2">
                            <i class="fa-solid fa-calendar me-1 blue"></i> {{ $item->start_at }}
                        </p>
                        <p class="fs-8 gray mb-2">
                            <i class="fa-solid fa-calendar me-1 blue"></i> {{ $item->end_at }}
                        </p>
                        <p class="fs-8 gray m-0">
                            <i class="fa-solid fa-user me-2 blue"></i> {{ $item->room_type }} for {{ $item->quantity }}
                            people
                        </p>
                    </div>

                    <div class="m-1">
                        @if($item->invoice_item)
                        <p class="fw-bold blue mb-1 fs-4">{{ $item->invoice_item->final_price }}</p>
                        @else
                        No Invoice
                        @endif
                    </div>
                </div>
                @endforeach


            </div>
        </div>

        <div class="tab-pane fade show mb-2" id="trip_tap" role="tabpanel" aria-labelledby="trip_tap">
            <div class="row justify-content-center position-relative">

                @foreach ($trips as $item)

                @if ($item->status == 0)
                @php
                $text_color = 'not_accepted-color-btn';
                $msg = __('patientappo.not accepted');
                @endphp
                @elseif ($item->status == 1)
                @php
                $text_color = 'main-color-btn';
                $msg = __('patientappo.accepted');
                @endphp
                @elseif ($item->status == 2)
                @php
                $text_color = 'active-color-btn';
                $msg = __('broker inquire');
                @endphp
                @elseif ($item->status == 3)
                @php
                $text_color = 'prog-color-btn';
                $msg = __('traveler payment');
                @endphp
                @elseif ($item->status == 4)
                @php
                $text_color = 'done-color-btn';
                $msg = __('received payment');
                @endphp
                @elseif ($item->status == 5)
                @php
                $text_color = 'pend-color-btn';
                $msg = __('send a payment to broker');
                @endphp
                @elseif ($item->status == 6)
                @php
                $text_color = 'prog-color-btn';
                $msg = __('broker confirm');
                @endphp
                @elseif ($item->status == 7)
                @php
                $text_color = 'done-color-btn';
                $msg = __('patientappo.done');
                @endphp
                @elseif ($item->status == 8)
                @php
                $text_color = 'cancel-color-btn';
                $msg = __('patientappo.canceled');
                @endphp
                @endif

                @if ($item->invoice_item)
                @if ($item->invoice_item->invoice->status == 0)
                @php
                $msg_invoice = __('basic.not paid');
                $text_color_invoice = 'cancel-color-btn';
                @endphp
                @elseif ($item->invoice_item->invoice->status == 1)
                @php
                $text_color_invoice = 'pend-color-btn';
                $msg_invoice = __('basic.pending');
                @endphp
                @elseif ($item->invoice_item->invoice->status == 2)
                @php
                $text_color_invoice = 'prog-color-btn';
                $msg_invoice = __('basic.installment');
                @endphp
                @elseif ($item->invoice_item->invoice->status == 3)
                @php
                $text_color_invoice = 'done-color-btn';
                $msg_invoice = __('basic.paid');
                @endphp
                @elseif ($item->invoice_item->invoice->status == 4)
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

                <div
                    class="d-flex bg-white justify-content-evenly justify-content-lg-between align-items-center shadow mb-3 p-3 radius-20 flex-wrap">
                    <div class="d-flex align-items-center">
                        <img src="{{ URL::asset('img/products/' . $item->trip_offer->trip->main_image) }}"
                            class="radius-10 me-3 mb-2" width="90px" height="90px" alt="" />
                        <div class="m-2">

                            <a class="fs-7 link-cust-text text-gray-900 fw-bold mb-1"
                                href="{{route('school_route.trip_book_show', $item->code)}}">
                                {{ $item->trip_offer->name }}
                            </a>

                            <p class="fs-8 gray mb-0">{{ $item->code }}</p>
                            <div class="fs-8 gray"><i class="fa-solid fa-location-dot me-1 blue"></i>{{
                                $item->trip_offer->trip->destination->name }}</div>

                        </div>
                    </div>

                    <div class="m-1">
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

                    <div class="m-1">
                        <p class="fs-8 gray mb-2">
                            <i class="fa-solid fa-calendar me-1 blue"></i> {{ $item->start_at }}
                        </p>
                        <p class="fs-8 gray mb-2">
                            <i class="fa-solid fa-calendar me-1 blue"></i> {{ $item->end_at }}
                        </p>
                        <p class="fs-8 gray m-0">
                            <i class="fa-solid fa-user me-2 blue"></i> {{ $item->qty }}
                            people
                        </p>
                    </div>

                    <div class="m-1">
                        @if($item->invoice_item)
                        <p class="fw-bold blue mb-1 fs-4">{{ $item->invoice_item->final_price }}</p>
                        @else
                        No Invoice
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
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