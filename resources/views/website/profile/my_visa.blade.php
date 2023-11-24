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
        <h2 class="fs-4 fw-bold text-capitalize">Your Visa Applications</h2>
        <p class="fs-8 text-secondary mb-0">
            Here is your last Visa applications
        </p>
    </div>


    @foreach ($on_request as $item)


    @if ($item->status == 0)
    @php
    $text_color = 'not_accepted-color-btn';
    $msg = __('in progress');
    @endphp
    @elseif ($item->status == 1)
    @php
    $text_color = 'pend-color-btn';
    $msg = __('review documents');
    @endphp
    @elseif ($item->status == 2)
    @php
    $text_color = 'cancel-color-btn';
    $msg = __('Document problem');
    @endphp
    @elseif ($item->status == 3)
    @php
    $text_color = 'prog-color-btn';
    $msg = __('Return Document');
    @endphp
    @elseif ($item->status == 4)
    @php
    $text_color = 'active-color-btn';
    $msg = __('Send to broker');
    @endphp
    @elseif ($item->status == 5)
    @php
    $text_color = 'cancel-color-btn';
    $msg = __('Refused');
    @endphp
    @elseif ($item->status == 6)
    @php
    $text_color = 'main-color-btn';
    $msg = __('Approved');
    @endphp
    @elseif ($item->status == 7)
    @php
    $text_color = 'done-color-btn';
    $msg = __('ready to collect');
    @endphp
    @endif


    @if ($item->type === "unit_package")
    @php
    $img = $item->requestable->hotel->main_image;
    @endphp
    @elseif ($item->type === "trip")
    @php
    $img = $item->requestable->trip->main_image;
    @endphp
    @elseif ($item->type === "full_package")
    @php
    $img = $item->requestable->package->main_image;
    @endphp
    @elseif ($item->type === "visa")
    @php
    $img = $item->requestable->destination->image;
    @endphp
    @elseif ($item->status == 5)
    @php
    $text_color = 'cancel-color-btn';
    @endphp
    @endif

    <div
        class="d-flex bg-white justify-content-evenly justify-content-lg-between align-items-center shadow mb-3 p-3 radius-20 flex-wrap">
        <div class="d-flex align-items-center">
            <img src="{{ URL::asset('img/products/' . $item->visa->destination->image) }}" class="radius-10 me-3 mb-2"
                width="90px" height="90px" alt="" />
            <div class="m-2">

                <a class="fs-7 link-cust-text text-gray-900 fw-bold mb-1"
                    href="{{route('school_route.visa_traveler_show', $item->code)}}">
                    {{ $item->visa->name }}
                </a>
                <span class="fs-8 gray">{{ $item->type }}</span>
                <div class="fs-8 gray">{{ $item->cat }}</div>

            </div>
        </div>

        <div class="m-1">
            <div class="fs-8 gray m-0 mb-2">
                <i class="fa-regular fa-calendar me-1 blue"></i> Status
            </div>
            <p> <span class="badge rounded-pill {{ $text_color }} badge-padd-l">{{
                    $msg
                    }}</span></p>
        </div>

        <div class="m-1">
            <p class="fs-8 gray mb-2">
                <i class="fa-solid fa-calendar me-1 blue"></i> {{ $item->start_at }}
            </p>
            <p class="fs-8 gray mb-2">
                <i class="fa-solid fa-clock me-2 blue"></i> {{ $item->duration }}
            </p>
            <p class="fs-8 gray m-0">
                <i class="fa-solid fa-location-dot me-2 blue"></i> {{ $item->visa->destination->name }}
            </p>
        </div>

        <div class="m-1">
            <p class="fw-bold blue mb-1 fs-4">{{ $item->sell }}</p>
        </div>
    </div>

    @endforeach
    <div class="d-flex justify-content-between ">
        <a href="{{route('school_route.my_requests')}}"><button class="btn see-all">Previous</button></a>
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