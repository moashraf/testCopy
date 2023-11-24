<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml"
    xmlns:o="urn:schemas-microsoft-com:office:office">

<head>
    <meta charset="UTF-8"> <!-- utf-8 works for most cases -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- Use the latest (edge) version of IE rendering engine -->
    <meta name="x-apple-disable-message-reformatting"> <!-- Disable auto-scale in iOS 10 Mail entirely -->
    <title>Booking </title> <!-- The title tag shows in email notifications, like Android 4.4. -->
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:200,300,400,500,600,700" rel="stylesheet">
    <style>
        html,
        body {
            font-family: 'Work Sans', sans-serif;
            margin: 0 auto !important;
            padding: 0 !important;
            height: 100% !important;
            width: 100% !important;
        }

        /* What it does: Stops email clients resizing small text. */
        * {
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
        }

        /* What it does: Centers email on Android 4.4 */
        div[style*="margin: 16px 0"] {
            margin: 0 !important;
        }

        /* What it does: Fixes webkit padding issue. */
        table {
            border-spacing: 0 !important;
            border-collapse: collapse !important;
            table-layout: fixed !important;
            margin: 0 auto !important;
        }

        /* What it does: Uses a better rendering method when resizing images in IE. */
        img {
            -ms-interpolation-mode: bicubic;
        }

        /* What it does: Prevents Windows 10 Mail from underlining links despite inline CSS. Styles for underlined links should be inline. */
        a {
            text-decoration: none;
        }

        /* What it does: A work-around for email clients meddling in triggered links. */
        *[x-apple-data-detectors],
        /* iOS */
        .unstyle-auto-detected-links *,
        .aBn {
            border-bottom: 0 !important;
            cursor: default !important;
            color: inherit !important;
            text-decoration: none !important;
            font-size: inherit !important;
            font-family: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
        }

        /* What it does: Prevents Gmail from displaying a download button on large, non-linked images. */
        .a6S {
            display: none !important;
            opacity: 0.01 !important;
        }

        /* What it does: Prevents Gmail from changing the text color in conversation threads. */
        .im {
            color: inherit !important;
        }

        /* If the above doesn't work, add a .g-img class to any image in question. */
        img.g-img+div {
            display: none !important;
        }

        /* What it does: Removes right gutter in Gmail iOS app: https://github.com/TedGoas/Cerberus/issues/89  */
        /* Create one of these media queries for each additional viewport size you'd like to fix */

        /* iPhone 4, 4S, 5, 5S, 5C, and 5SE */
        @media only screen and (min-device-width: 320px) and (max-device-width: 374px) {
            u~div .email-container {
                min-width: 320px !important;
            }

            .center_cont {
                padding: 10px !important;
            }

            .product-entry img {
                float: left;
                width: 100px !important;
                padding-left: 10px !important;
                display: none;
            }

            .price {
                color: #000000;
                font-size: 17px !important;
                text-align: center;
            }

            .fs-7 {
                font-size: .6rem !important;
            }
        }

        /* iPhone 6, 6S, 7, 8, and X */
        @media only screen and (min-device-width: 375px) and (max-device-width: 413px) {
            u~div .email-container {
                min-width: 375px !important;
            }

        }

        /* iPhone 6+, 7+, and 8+ */
        @media only screen and (min-device-width: 414px) {
            u~div .email-container {
                min-width: 414px !important;
            }
        }
    </style>

    <!-- CSS Reset : END -->

    <!-- Progressive Enhancements : BEGIN -->

    <style>
        /* basic elements */
        h1 {
            font-size: 3.5rem;
            margin-top: 0px;
            margin-bottom: 15px;
        }

        h2 {
            font-size: 2.5rem;
            margin-top: 0px;
            margin-bottom: 15px;
        }

        h3 {
            font-size: 2.0rem;
            margin-top: 0px;
            margin-bottom: 15px;
        }

        h5 {
            font-size: 1.25rem;
            margin-top: 0px;
            margin-bottom: 15px;
        }

        h6 {
            font-size: 1rem;
            margin-top: 0px;
            margin-bottom: 15px;
        }

        .fs-6 {
            font-size: 1rem;
        }

        .fs-7 {
            font-size: .8rem;
        }

        p {
            margin-top: 5px;
            margin-bottom: 20px;
        }

        .m-0 {
            margin: 0px;
        }

        .mb-0 {
            margin: 0px;
        }

        .mb-1 {
            margin-bottom: 3rem;
        }

        .mb-2 {
            margin-bottom: 2.5rem;
        }

        .mb-3 {
            margin-bottom: 2.0rem;
        }

        .mb-4 {
            margin-bottom: 1.5rem;
        }

        .mb-5 {
            margin-bottom: 1rem;
        }

        .mb-6 {
            margin-bottom: .5rem;
        }

        .mt-0 {
            margin-top: 0px;
        }

        .mt-1 {
            margin-top: 3rem;
        }

        .mt-2 {
            margin-top: 2.5rem;
        }

        .mt-3 {
            margin-top: 2.0rem;
        }

        .mt-4 {
            margin-top: 1.5rem;
        }

        .mt-5 {
            margin-top: 1rem;
        }

        .mt-6 {
            margin-top: .5rem;
        }


        .border_radius_25 {
            border-radius: 25px
        }

        .border_radius_15 {
            border-radius: 10px
        }

        .border_radius_10 {
            border-radius: 10px
        }

        .border_radius_5 {
            border-radius: 5px
        }

        .p-1 {
            padding: 40px
        }

        .p-2 {
            padding: 30px
        }

        .p-3 {
            padding: 25px
        }

        .p-4 {
            padding: 20px
        }

        .p-5 {
            padding: 10px;
        }

        .p-6 {
            padding: 5px;
        }

        .pt-1 {
            padding-top: 40px
        }

        .pt-2 {
            padding-top: 30px
        }

        .pt-3 {
            padding-top: 25px
        }

        .pt-4 {
            padding-top: 20px
        }

        .pt-5 {
            padding-top: 10px;
        }

        .pt-6 {
            padding-top: 5px;
        }

        .pb-1 {
            padding-bottom: 40px
        }

        .pb-2 {
            padding-bottom: 30px
        }

        .pb-3 {
            padding-bottom: 25px
        }

        .pb-4 {
            padding-bottom: 20px
        }

        .pb-5 {
            padding-bottom: 10px;
        }

        .pb-6 {
            padding-bottom: 5px;
        }

        .center_cont {
            padding: 25px;
            background-color: white;
        }

        .main-color-bg {
            background-color: #323ac8 !important;
        }

        .text-white {
            color: #ffffff
        }

        .main-color-bg {
            background-color: #323ac8 !important;
        }

        .main-color-bg-200 {
            background-color: #4ea5f4 !important;
        }

        .color-gray-400-bg {
            background-color: #f4f4f4 !important;
        }

        .main-color {
            color: #323ac8 !important;
        }

        .main-color-500 {
            color: #5a6b83 !important;
        }

        .text-red {
            color: #CF637F !important;
        }

        .text-red-bg {
            background-color: #CF637F !important;
        }

        .text-red-200 {
            color: #c97187 !important;
        }

        .text-red-error {
            color: #dc3545 !important;
        }

        .text-green-ligh {
            color: #20AA9E;
        }

        .text-green-light-300 {
            color: #9fe9e1;
        }

        .text-green-ligh-bg {
            background-color: #20AA9E;
        }

        .text-green-ligh-bg-grad {
            background: linear-gradient(45deg, #1de099, #1dc8cd);

        }

        .text-petroleum {
            color: #223a66;
        }

        .text-petroleum-light {
            color: #6F8BA4;
        }

        .text-petroleum2 {
            color: #1B2050;
        }

        .text-petroleum2-bg {
            background-color: #1B2050;
        }

        .text-green {
            color: #52c37f !important;
        }

        .text-orange {
            color: #CF637F !important;
        }

        /* - blue - */

        .text-blue-200 {
            color: #E4EEFD !important
        }

        .text-blue-300 {
            color: #BDD4F5 !important
        }

        .text-blue-400 {
            color: #75a5ea !important
        }

        .text-blue-700 {
            color: #1d5398 !important
        }

        .text-blue-800 {
            color: #183c6a !important
        }

        /* - gray - */

        .text-gray-100 {
            color: #e7e7e7 !important
        }

        .text-gray-200 {
            color: #D0D0D0 !important
        }

        .text-gray-300 {
            color: #b5b5b5 !important;
        }

        .text-gray-400 {
            color: #9C9C9C !important;
        }

        .text-gray-600 {
            color: #6f6f6f !important;
        }

        .text-gray-500 {
            color: #757474 !important;
        }

        .text-gray-700 {
            color: #585858 !important;
        }

        .text-gray-800 {
            color: #444444 !important
        }

        .text-gray-900 {
            color: #292929 !important
        }

        .text-center {
            text-align: center;
        }

        .fw-light {
            font-weight: lighter;
        }

        .fw-bold {
            font-weight: bold;
        }

        .fw-normal {
            font-weight: normal;
        }

        .btn.btn-primary {
            border-radius: 5px;
            background: #333ac8;
            color: #ffffff;
        }

        .btn {
            padding: 10px 15px;
            display: inline-block;
        }


        /* html */
        .product-entry {
            display: block;
            float: left;
            padding-top: 20px;
            width: 100%;
        }

        .product-entry img {
            float: left;
            width: 30px;
            display: block;
        }

        .product-entry .text {
            padding-left: 10px;
            float: left;
        }

        .price {
            color: #000000;
            font-size: 25px;
            text-align: center;
        }
    </style>


</head>

<body width="100%" style="margin: 0; padding: 0 !important; mso-line-height-rule: exactly; background-color: #F5F8FA;">

    <div style="max-width: 600px; margin: 0 auto; padding: 0px 22px;" class="email_container">

        <img class="mt-5 mb-5" src="{{ URL::asset('img/dashboard/system/paincurelogo.png') }}">

        <div class="center_cont border_radius_15">
            <div class="text-center">
                <img alt="" width="200" src="{{ URL::asset('img/svg/undraw_confirmed_re_sef7-svg.svg') }}">
            </div>
            <h3 class="mb-6 mt-4">Hello <span class="text-gray-500 fw-light">Shady Hesham</span></h3>
            <h6 class="text-gray-500 fw-normal">Welcome to <span> companuy namy </span> Your booking
                has been confirmed
                successfully</h6>
            <h6 class="fw-normal">Here is your confirmation code:</h6>
            <div class="text-center main-color-bg text-white p-4 border_radius_10">
                <h6 class="mb-0"> Soqkxnq2</h6>
            </div>

            <br class="mb-2">

            @php
            $total_sell = 0;
            @endphp

            <table class="bg_white" role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">

                <tr class="fs-6" style="border-bottom: 1px solid rgba(0,0,0,.05);">
                    <th width="100%" style="text-align:left; padding: 0 2.5em; color: #000; padding-bottom: 20px">
                        {{ __('basic.item') }}
                    </th>
                    <th width="100%" style="text-align:right; padding: 0 2.5em; color: #000; padding-bottom: 20px">
                        {{ __('basic.price') }}
                    </th>
                </tr>

                @if(count($booking->hotel) > 0)

                <tr class="fs-6">
                    <th style="text-align:left; padding: 0; color: #5d5d5d; padding-bottom: 20px">
                        {{ __('basic.hotel bookings') }}
                    </th>
                </tr>

                @foreach ($booking->hotel as $item)

                @if($item->invoice_item)
                @php
                $total_sell += $item->invoice_item->subtotal;
                $selling_price = $item->invoice_item->subtotal;
                @endphp
                @endif

                <tr style="border-bottom: 1px solid rgba(0,0,0,.05); padding-bottom: 20px;">
                    <td valign="middle" width="100%" style="text-align:left; padding: 0 0.5em;">
                        <div class="product-entry">
                            @if($item->offer_room)
                            <img alt="" src="{{ URL::asset('img/unit/rooms/' . $item->offer_room->img) }}">
                            @else
                            <img alt="" src="{{ URL::asset('img/unit/rooms/default.jpg') }}">
                            @endif

                            <div class="text">
                                <h6 class="mb-6"> {{ $item->hotel->name }}</h6>
                                <p class="fs-7 mb-0 text-gray-300 fw-bold">
                                    {{ __('basic.check in') . ':'}} <span class="text-gray-700">{{
                                        date('d M Y', strtotime($item->start_at)) }}</span>
                                </p>
                                <p class="fs-7 mb-0 text-gray-300 fw-bold">
                                    {{ __('basic.check out') . ':'}} <span class="text-gray-700">{{
                                        date('d M Y', strtotime($item->end_at)) }}</span>
                                </p>
                                <hr>
                                <p class="fs-7 mb-0 text-xs text-gray-300">
                                    {{ __('basic.room') . ':'}} <span class="text-gray-700">{{ $item->quantity . " " .
                                        $item->room_type->name . " " . __('basic.rooms') }}</span></p>
                                <p class="fs-7 mb-0 text-xs text-gray-300">
                                    {{ __('basic.room meal') . ':'}} <span class="text-gray-700">{{
                                        $item->room_meal->name }}</span></p>
                                <p class="fs-7 mb-5 text-xs text-gray-300">
                                    {{ __('basic.room view') . ':'}} <span class="text-gray-700">{{
                                        $item->room_view->name }}</span>
                                </p>

                            </div>
                        </div>
                    </td>
                    <td valign="middle" width="100%" style="text-align:right; padding: 0 2.5em;">
                        <p class="mb-0 text-gray-400 fs-7">{{ __('basic.price for') . ' ' .$item->nights . ' ' .
                            __('basic.nights') }}</p>
                        @if($item->invoice_item && $booking->invoice)
                        <span class="price">{{ $selling_price }}<small class="text-gray-300 fs-7">{{
                                $booking->invoice->currency->code
                                }}</small></span>
                        @endif
                    </td>
                </tr>
                @endforeach
                @endif

                {{-- transporation booking --}}
                @if(count($booking->transportation) > 0)

                <tr class="fs-6">
                    <th style="text-align:left; padding: 0; color: #5d5d5d; padding-bottom: 20px; padding-top: 20px">
                        {{ __('basic.transportation bookings') }}
                    </th>
                </tr>

                @foreach ($booking->transportation as $item)

                @if($item->invoice_item)
                @php
                $total_sell += $item->invoice_item->subtotal;
                $selling_price = $item->invoice_item->subtotal;
                @endphp
                @endif

                <tr style="border-bottom: 1px solid rgba(0,0,0,.05); padding-bottom: 20px;">
                    <td valign="middle" width="100%" style="text-align:left; padding: 0 0.5em;">
                        <div class="product-entry">
                            <img alt="" src="{{ URL::asset('img/vehicle/' . $item->vehicle->main_image) }}">
                            <div class="text">
                                <h6 class="mb-6"> @if($item->bus_trip)
                                    {{ $item->bus_trip->name }}
                                    @else
                                    {{ $item->vehicle->name }}
                                    @endif</h6>

                                @if($item->fromable)
                                <p class="fs-7 mb-0 text-gray-300 fw-bold">
                                    {{ __('basic.from') . ':'}} <span class="text-gray-700">{{ $item->fromable->name
                                        }}</span>
                                </p>
                                @else
                                @php
                                $from_transp = "";
                                @endphp
                                @endif
                                @if($item->toable)
                                <p class="fs-7 mb-0 text-gray-300 fw-bold">
                                    {{ __('basic.to') . ':'}} <span class="text-gray-700">{{ $item->toable->name
                                        }}</span>
                                </p>
                                @else
                                @php
                                $to_transp = "";
                                @endphp
                                @endif

                                <p class="fs-7 mb-0 text-gray-300 fw-bold">
                                    {{ __('basic.vehicle') . ':'}} <span class="text-gray-700">{{
                                        $item->vehicle->name }}</span>
                                </p>
                                <hr>
                                <p class="fs-7 mb-0 text-xs text-gray-300">
                                    {{ __('basic.start') . ':'}} <span class="text-gray-700">{{ date('d M Y h:i A',
                                        strtotime($item->start_at))}}</span></p>
                                <p class="fs-7 mb-0 text-xs text-gray-300">
                                    {{ __('basic.end') . ':'}} <span class="text-gray-700">{{date('d M Y h:i A',
                                        strtotime($item->end_at)) }}</span></p>

                                @if($item->cat == 1)
                                <p class="fs-7 mb-1 text-xs text-gray-300">
                                    {{ __('basic.days number') . ':'}} <span class="text-gray-700">{{ $item->days . ' '
                                        . __('basic.days') }}</span>
                                </p>
                                @else
                                <p class="fs-7 mb-5 text-xs text-gray-300">
                                    {{ __('basic.tickets') . ':'}} <span class="text-gray-700">{{ $item->qty . ' ' .
                                        __('basic.tickets') }} </span>
                                </p>
                                <p class="fs-7 mb-5 text-xs text-gray-300">
                                    {{ __('basic.seat numbers') }} <span class="text-gray-700">
                                        @foreach ($item->seats as $item_seat)
                                        <span class="text-gray-700">{{ $item_seat->seat }} </span>
                                        @endforeach

                                        {{ __('basic.numbers') }} </span>
                                </p>
                                @endif
                            </div>
                        </div>
                    </td>
                    <td valign="middle" width="100%" style="text-align:right; padding: 0 2.5em;">
                        @if($item->invoice_item && $booking->invoice)
                        <span class="price">{{ $selling_price }}<small class="text-gray-300 fs-7">{{
                                $booking->invoice->currency->code
                                }}</small></span>
                        @endif
                    </td>
                </tr>
                @endforeach

                @endif

                {{-- visa booking --}}
                @if(count($booking->visa) > 0)

                <tr class="fs-6">
                    <th style="text-align:left; padding: 0; color: #5d5d5d; padding-bottom: 20px; padding-top: 20px">
                        {{ __('basic.visa bookings') }}
                    </th>
                </tr>

                @foreach ($booking->visa as $item)

                @if($item->invoice_item)
                @php
                $total_sell += $item->invoice_item->subtotal;
                $selling_price = $item->invoice_item->subtotal;
                @endphp
                @endif

                <tr style="border-bottom: 1px solid rgba(0,0,0,.05); padding-bottom: 20px;">
                    <td valign="middle" width="100%" style="text-align:left; padding: 0 0.5em;">
                        <div class="product-entry">
                            <div class="text">
                                <h6 class="mb-6"> {{ $item->visa->name }}</h6>

                                <p class="fs-7 mb-0 text-gray-300 fw-bold">
                                    {{ __('basic.type') . ':'}} <span class="text-gray-700">{{
                                        $item->visa_type->name }}</span>
                                </p>
                                <hr>
                                <p class="fs-7 mb-0 text-xs text-gray-300">
                                    {{ __('basic.arrival date') . ':'}} <span class="text-gray-700">{{ date('d M Y h:i
                                        A', strtotime($item->start_at)) }}</span></p>

                                <p class="fs-7 mb-5 text-xs text-gray-300">
                                    {{ __('basic.duration') . ':'}} <span class="text-gray-700">{{ $item->duration . ' '
                                        . __('basic.days') }}</span></p>
                            </div>
                        </div>
                    </td>
                    <td valign="middle" width="100%" style="text-align:right; padding: 0 2.5em;">
                        @if($item->invoice_item && $booking->invoice)
                        <span class="price">{{ $selling_price }}<small class="text-gray-300 fs-7">{{
                                $booking->invoice->currency->code
                                }}</small></span>
                        @endif
                    </td>
                </tr>
                @endforeach

                @endif


                {{-- trip booking --}}
                @if(count($booking->trip) > 0)

                <tr class="fs-6">
                    <th style="text-align:left; padding: 0; color: #5d5d5d; padding-bottom: 20px; padding-top: 20px">
                        {{ __('basic.trip bookings') }}
                    </th>
                </tr>

                @foreach ($booking->trip as $item)

                @if($item->invoice_item)
                @php
                $total_sell += $item->invoice_item->subtotal;
                $selling_price = $item->invoice_item->subtotal;
                @endphp
                @endif

                <tr style="border-bottom: 1px solid rgba(0,0,0,.05); padding-bottom: 20px;">
                    <td valign="middle" width="100%" style="text-align:left; padding: 0 0.5em;">
                        <div class="product-entry">

                            <img alt="" src="{{ URL::asset('img/trip/' . $item->trip->main_image) }}">

                            <div class="text">
                                <h6 class="mb-6"> {{ $item->trip->name }}</h6>
                                <p class="fs-7 mb-0 text-gray-300 fw-bold">
                                    {{ __('basic.destination') . ':'}} <span class="text-gray-700">{{
                                        $item->destination->name }}</span>
                                </p>
                                <p class="fs-7 mb-5 text-gray-300 fw-bold">
                                    {{ __('basic.start date') . ':'}} <span class="text-gray-700">{{ date('d M Y h:i A',
                                        strtotime($item->start_at)) }}</span>
                                </p>

                            </div>
                        </div>
                    </td>
                    <td valign="middle" width="100%" style="text-align:right; padding: 0 2.5em;">
                        <p class="mb-0 text-gray-400 fs-7">{{ 'price for ' . $item->qty . ' ' . __('basic.people') }}
                        </p>
                        @if($item->invoice_item && $booking->invoice)
                        <span class="price">{{ $selling_price }}<small class="text-gray-300 fs-7">{{
                                $booking->invoice->currency->code
                                }}</small></span>
                        @endif
                    </td>
                </tr>
                @endforeach
                @endif


                {{-- airline booking --}}
                @if(count($booking->airline) > 0)

                <tr class="fs-6">
                    <th style="text-align:left; padding: 0; color: #5d5d5d; padding-bottom: 20px; padding-top: 20px">
                        {{ __('basic.airline bookings') }}
                    </th>
                </tr>

                @foreach ($booking->airline as $item)

                @if($item->invoice_item)
                @php
                $total_sell += $item->invoice_item->subtotal;
                $selling_price = $item->invoice_item->subtotal;
                @endphp
                @endif

                <tr style="border-bottom: 1px solid rgba(0,0,0,.05); padding-bottom: 20px;">
                    <td valign="middle" width="100%" style="text-align:left; padding: 0 0.5em;">
                        <div class="product-entry">

                            <div class="text">
                                <h6 class="mb-6"> {{ $item->name }}</h6>
                                <p class="fs-7 mb-0 text-gray-300 fw-bold">
                                    {{ __('basic.from') . ':'}} <span class="text-gray-700">{{
                                        $item->from->name }}</span>
                                </p>
                                <p class="fs-7 mb-0 text-gray-300 fw-bold">
                                    {{ __('basic.to') . ':'}} <span class="text-gray-700">{{ $item->to->name }}</span>
                                </p>
                                <p class="fs-7 mb-0 text-gray-300 fw-bold">
                                    {{ __('basic.from') . ':'}} <span class="text-gray-700">{{
                                        $item->from->name }}</span>
                                </p>
                                <p class="fs-7 mb-0 text-gray-300 fw-bold">
                                    {{ __('basic.start date') . ':'}} <span class="text-gray-700">{{ date('d M Y h:i A',
                                        strtotime($item->start_at)) }}</span>
                                </p>
                                <p class="fs-7 mb-5 text-gray-300 fw-bold">
                                    {{ __('basic.end date') . ':'}} <span class="text-gray-700">{{ date('d M Y h:i A',
                                        strtotime($item->end_at)) }}</span>
                                </p>
                            </div>
                        </div>
                    </td>
                    <td valign="middle" width="100%" style="text-align:right; padding: 0 2.5em;">
                        <p class="mb-0 text-gray-400 fs-7">{{ 'price for ' . $item->qty . ' ' . __('basic.people') }}
                        </p>
                        @if($item->invoice_item && $booking->invoice)
                        <span class="price">{{ $selling_price }}<small class="text-gray-300 fs-7">{{
                                $booking->invoice->currency->code
                                }}</small></span>
                        @endif
                    </td>
                </tr>
                @endforeach
                @endif

                {{-- package booking --}}
                @if(count($booking->package) > 0)

                <tr class="fs-6">
                    <th style="text-align:left; padding: 0; color: #5d5d5d; padding-bottom: 20px; padding-top: 20px">
                        {{ __('basic.package bookings') }}
                    </th>
                </tr>

                @foreach ($booking->package as $item)

                @if($item->invoice_item)
                @php
                $total_sell += $item->invoice_item->subtotal;
                $selling_price = $item->invoice_item->subtotal;
                @endphp
                @endif

                <tr style="border-bottom: 1px solid rgba(0,0,0,.05); padding-bottom: 20px;">
                    <td valign="middle" width="100%" style="text-align:left; padding: 0 0.5em;">
                        <div class="product-entry">

                            <img alt="" src="{{ URL::asset('img/package/' . $item->package->main_image) }}">

                            <div class="text">
                                <h6 class="mb-6"> {{ $item->package->name }}</h6>
                                <p class="fs-7 mb-0 text-gray-300 fw-bold">
                                    {{ __('basic.type') . ':'}} <span class="text-gray-700">{{
                                        $item->type_qty . " " . __('basic.trip') }}</span>
                                </p>
                                <p class="fs-7 mb-0 text-gray-300 fw-bold">
                                    {{ __('basic.type') . ':'}} <span class="text-gray-700">
                                        @if($item->type == 1)
                                        @php
                                        $package_type = __('basic.customized');
                                        @endphp
                                        @elseif ($item->type == 2)
                                        @php
                                        $package_type = __('basic.commission');
                                        @endphp
                                        @endif
                                        {{ $package_type }}
                                    </span>
                                </p>
                                <p class="fs-7 mb-0 text-gray-300 fw-bold">
                                    {{ __('basic.start date') . ':'}} <span class="text-gray-700">{{ date('d M Y h:i A',
                                        strtotime($item->start_at)) }}</span>
                                </p>
                                <p class="fs-7 mb-5 text-gray-300 fw-bold">
                                    {{ __('basic.end date') . ':'}} <span class="text-gray-700">{{ date('d M Y h:i A',
                                        strtotime($item->end_at)) }}</span>
                                </p>
                            </div>
                        </div>
                    </td>
                    <td valign="middle" width="100%" style="text-align:right; padding: 0 2.5em;">
                        <p class="mb-0 text-gray-400 fs-7">{{ 'price for ' . $item->qty . ' ' . __('basic.people') }}
                        </p>
                        @if($item->invoice_item && $booking->invoice)
                        <span class="price">{{ $selling_price }}<small class="text-gray-300 fs-7">{{
                                $booking->invoice->currency->code
                                }}</small></span>
                        @endif
                    </td>
                </tr>
                @endforeach
                @endif

                <br>
                <tr class="fs-6"
                    style="border-bottom: 1px solid rgba(0,0,0,.05); padding-top:2rem; background-color:#e2e2e2;">
                    <th width="100%"
                        style="text-align:left; padding: 0 2.5em; color: #000; padding-bottom: 30px; padding-top: 30px">
                        {{ __('basic.total') }}
                    </th>
                    <th width="100%"
                        style="text-align:right; padding: 0 2.5em; color: #000; padding-bottom: 30px; padding-top: 30px">
                        @if($booking->invoice)
                        <span class="price">{{ $total_sell }}<small class="text-gray-300 fs-7">{{
                                $booking->invoice->currency->code
                                }}</small></span>
                        @endif
                    </th>
                </tr>

                <tr>
                    <td valign="middle" style="text-align:left; padding: 1.4em 0em 0em .5em;">
                        <p><a href="{{ route('booking_print', $booking->code) }}" class="btn btn-primary">
                                <img width="15" src="{{ URL::asset('img/icons/downloadsvgrepo-com.svg') }}">
                                Download Your Booking</a></p>
                    </td>
                </tr>

            </table>
        </div>

        <tr>
            <td class="bg_white mt-2 mb-2 pt-4 pb-4" style="text-align: center;">
                <p class="text-gray-400 mt-6 mb-3 pb-6">Copyright © 2023 Tripo TUR v1.6 | Tripo
                </p>
            </td>
        </tr>
    </div>



</body>

</html>