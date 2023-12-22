<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml"
    xmlns:o="urn:schemas-microsoft-com:office:office">

<head>
    <meta charset="UTF-8"> <!-- utf-8 works for most cases -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- Use the latest (edge) version of IE rendering engine -->
    <meta name="x-apple-disable-message-reformatting"> <!-- Disable auto-scale in iOS 10 Mail entirely -->
    <title>Invoice</title> <!-- The title tag shows in email notifications, like Android 4.4. -->
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
                width: 20px !important;
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
            width: 20%;
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

<div width="100%" style="margin: 0; padding: 0 !important; mso-line-height-rule: exactly; background-color: #F5F8FA;">

    <div style="max-width: 600px; margin: 0 auto; padding: 0px 22px;" class="email_container">

        <img class="mt-5 mb-5" src="{{ URL::asset('img/dashboard/system/' . $details['company_logo']) }}">

        <div class="center_cont border_radius_15">
            <div class="text-center">
                <img alt="" width="200" src="{{ URL::asset('img/svg/undraw_opened_re_i38e2.svg') }}">
            </div>
            <h3 class="mb-6 mt-4">Hello <span class="text-gray-500 fw-light">{{ $details['client_name'] }}</span></h3>
            <h6 class="text-gray-500 fw-normal">Welcome to <span> {{ $details['company_name'] }}.</span> Here is the
                details of your invoice.</h6>
            <h6 class="fw-normal">Your invoice reference code:</h6>
            <div class="text-center main-color-bg text-white p-4 border_radius_10">
                <h6 class="mb-0">{{ $details['invoice']->code }}</h6>
            </div>

            <br class="mb-2">

            <table class="bg_white" role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">

                <tr class="fs-6" style="border-bottom: 1px solid rgba(0,0,0,.05);">
                    <th width="50%" style="text-align:left; padding: 0 2.5em; color: #000; padding-bottom: 20px">
                        {{ __('basic.item') }}
                    </th>
                    <th width="10%" style="text-align:left; padding: 0 2.5em; color: #000; padding-bottom: 20px">
                        {{ __('basic.qty') }}
                    </th>
                    <th width="40%" style="text-align:right; padding: 0 2.5em; color: #000; padding-bottom: 20px">
                        {{ __('basic.price') }}
                    </th>
                </tr>

                @foreach ($details['invoice']->invoice_items as $item)
                <tr style="border-bottom: 1px solid rgba(0,0,0,.05); padding-bottom: 20px;">
                    <td valign="middle" width="50%" style="text-align:left; padding: 0 0.5em;">
                        <div class="product-entry">
                            <div class="text">
                                <h6 class="mb-6 fw-normal mb-0"> {{ $item->categorizable->name }} @if ($item->days)
                                    for {{ $item->days }} days
                                    @endif</h6>
                                <p class="fs-7 mb-0 text-gray-300 fw-bold">
                                    {{ __('basic.unit price') . ':'}} <span class="text-gray-700">{{ $item->price
                                        }} <small class="text-gray-300 fs-7">{{ $details['invoice']->currency->code
                                            }}</small></span>
                                </p>
                            </div>
                        </div>
                    </td>
                    <td valign="middle" width="10%" style="text-align:right; padding: 0 2.5em;">
                        <span class="price" style="color: #000; font-size: 20px;">{{ $item->qty }}</span>
                    </td>
                    <td valign="middle" width="40%" style="text-align:right; padding: 0 2.5em;">
                        <span class="price" style="color: #000; font-size: 20px;">{{ $item->subtotal }}<small
                                class="text-gray-300 fs-7">{{ $details['invoice']->currency->code }}</small></span>
                    </td>
                </tr>

                @endforeach
            </table>

            <br>
            <table>

                <tr class="fs-6">
                    <th width="80%" style="text-align:left; padding: .5rem 2.5em; color: #000;">
                        {{ __('basic.subtotal') }}
                    </th>
                    <th width="100%" style="text-align:right; padding: .5rem 2.5em; color: #000;">
                        <span class="price" style="color: #000; font-size: 20px;">{{ $details['invoice']->items_price
                            }}<small class="text-gray-300 fs-7">{{ $details['invoice']->currency->code }}</small></span>
                    </th>
                </tr>

                <tr class="fs-6">
                    <th width="80%" style="text-align:left; padding: .5rem 2.5em; color: #000;">
                        {{ __('basic.discount') }}
                    </th>
                    <th width="100%" style="text-align:right; padding: .5rem 2.5em; color: #000;">
                        <span class="price" style="color: #000; font-size: 20px;">
                            @if (!empty($details['invoice']->discount))
                            {{ $details['invoice']->discount }}
                            @else
                            0
                            @endif<small class="text-gray-300 fs-7">{{ $details['invoice']->currency->code
                                }}</small></span>
                    </th>
                </tr>

                <tr class="fs-6">
                    <th width="80%" style="text-align:left; padding: .5rem 2.5em; color: #000;">
                        {{ __('basic.tax') }}
                    </th>
                    <th width="100%" style="text-align:right; padding: .5rem 2.5em; color: #000;">
                        <span class="price" style="color: #000; font-size: 20px;">{{ $details['invoice']->total_tax
                            }}<small class="text-gray-300 fs-7">{{ $details['invoice']->currency->code }}</small></span>
                    </th>
                </tr>

                <tr class="fs-6"
                    style="border-bottom: 1px solid rgba(0,0,0,.05); padding-top:2rem; background-color:#e2e2e2;">
                    <th width="80%"
                        style="text-align:left; padding: 0 2.5em; color: #000; padding-bottom: 30px; padding-top: 30px">
                        {{ __('basic.total') }}
                    </th>
                    <th width="100%"
                        style="text-align:right; padding: 0 2.5em; color: #000; padding-bottom: 30px; padding-top: 30px">
                        <span class="price" style="color: #000; font-size: 20px;">{{ $details['invoice']->final_price
                            }}<small class="text-gray-300 fs-7">{{ $details['invoice']->currency->code }}</small></span>
                    </th>
                </tr>
            </table>

            <tr>
                <td valign="middle" style="text-align:left; padding: 1.4em 0em 0em .5em;">
                    <p><a href="{{ route('invo_invoice_print', $details['invoice']->code) }}" class="btn btn-primary">
                            <img width="15" src="{{ URL::asset('img/icons/downloadsvgrepo-com.svg') }}">
                            Download Your Invoice</a></p>
                </td>
            </tr>

        </div>

        <tr>
            <td class="bg_white mt-2 mb-2 pt-4 pb-4" style="text-align: center;">
                <p class="text-gray-400 mt-6 mb-3 pb-6">Copyright © 2023 Tripo TUR v1.6 | {{ $details['company_name'] }}
                </p>
            </td>
        </tr>
    </div>



</div>

</html>