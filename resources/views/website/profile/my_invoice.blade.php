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
        <h2 class="fs-4 fw-bold text-capitalize">My Invoices</h2>
        <p class="fs-8 text-secondary mb-0">
            Here is your last Invoices
        </p>
    </div>


    @foreach ($invoices as $item)

    @if ($item->status == 0)
    @php
    $msg = __('basic.not paid');
    $text_color = 'cancel-color-btn';
    @endphp
    @elseif ($item->status == 1)
    @php
    $msg = 'pend-color-btn';
    $text_color = __('basic.pending');
    @endphp
    @elseif ($item->status == 2)
    @php
    $msg = 'prog-color-btn';
    $text_color = __('basic.installment');
    @endphp
    @elseif ($item->status == 3)
    @php
    $msg = 'done-color-btn';
    $text_color = __('basic.paid');
    @endphp
    @elseif ($item->status == 4)
    @php
    $msg = __('basic.refund');
    $text_color = 'cancel-color-btn';
    @endphp
    @endif


    <div
        class="d-flex bg-white justify-content-evenly justify-content-lg-between align-items-center shadow mb-3 p-3 radius-20 flex-wrap">
        <div class="d-flex align-items-center">
            <i class="fa-solid fa-file-invoice fs-1 me-2"></i>
            <div class="m-2">
                <a class="fs-7 link-cust-text text-gray-900 fw-bold mb-1"
                    href="{{route('school_route.invoice_show', $item->code)}}">
                    {{ $item->code }}
                </a>

                {{-- <span class="fs-8 gray">Singapore, officially the </span> --}}
            </div>
        </div>

        <div class="m-1">
            <div class="fs-8 gray m-0 mb-2">
                <i class="fa-solid fa-signal me-1 blue"></i> Status
            </div>
            <p> <span class="badge rounded-pill {{ $text_color }} badge-padd-l">{{
                    $msg
                    }}</span></p>
        </div>
        <div class="m-1">
            <div class="fs-8 gray m-0">
                <i class="fa-regular fa-calendar me-1 blue"></i> Created
            </div>
            <p>{{ $item->created_at }}</p>
        </div>
        <div class="m-1">
            @if($item->discount)
            <p class="text-gray-400 text-decoration-line-through mb-0">{{ $item->discount }}</p>
            @endif
            <p class="fw-bold blue mb-1 fs-4">{{ $item->final_price }}</p>
        </div>
    </div>

    @endforeach


</div>

@endsection
@section('js')
@endsection