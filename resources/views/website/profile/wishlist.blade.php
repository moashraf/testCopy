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
        <h2 class="fs-4 fw-bold text-capitalize">Your Favorite Services Is Over Here</h2>
        <p class="fs-8 text-secondary mb-0">
            Here is your last favorite services
        </p>
    </div>


    <div class="row justify-content-center">
        @foreach ($wishlist as $item)



        @if ($item->status == 1)
        @php
        $text_color = 'not_accepted-color-btn';
        $msg = __('Send');
        @endphp
        @elseif ($item->status == 2)
        @php
        $text_color = 'pend-color-btn';
        $msg = __('In progress');
        @endphp
        @elseif ($item->status == 3)
        @php
        $text_color = 'done-color-btn';
        $msg = __('Accept');
        @endphp
        @elseif ($item->status == 4)
        @php
        $text_color = 'cancel-color-btn';
        $msg = __('Not accept');
        @endphp
        @elseif ($item->status == 5)
        @php
        $text_color = 'cancel-color-btn';
        $msg = __('Canceled');
        @endphp
        @endif


        @if ($item->itemable_type === "App\Models\Branch\Unit_offer")
        @php
        $img = $item->itemable->hotel->main_image;
        $service_url = "school_route.unit_package_show";
        @endphp
        @elseif ($item->itemable_type === "App\Models\Branch\Unit")
        @php
        $img = $item->itemable->main_image;
        $service_url = "school_route.unit_show";
        @endphp
        @elseif ($item->itemable_type === "App\Models\Branch\Trip")
        @php
        $img = $item->itemable->main_image;
        $service_url = "school_route.trip_show";
        @endphp
        @elseif ($item->itemable_type === "App\Models\Branch\Package")
        @php
        $img = $item->itemable->main_image;
        $service_url = "school_route.package_show";
        @endphp
        @elseif ($item->itemable_type === "App\Models\Branch\Visa")
        @php
        $img = $item->itemable->destination->image;
        $service_url = "school_route.visa_show";
        @endphp
        @endif

        <div class="col-9 col-md-4 card-product-div px-2">
            <div class="radius-20 shadow position-relative p-3">
                <div class="position-absolute icon-product mt-2 ms-2">
                    @if($item->airline)
                    <i class="fa-solid fa-plane-up"></i>
                    @endif
                    @if($item->transp)
                    <i class="fa-solid fa-bus"></i>
                    @endif
                    @if($item->trip)
                    <i class="fa-solid fa-suitcase"></i>
                    @endif
                    @if($item->guide)
                    <i class="fa-solid fa-microphone"></i>
                    @endif
                    @if($item->fav)
                    <i class="fa-solid fa-star"></i>
                    @endif
                    <i class="fa-solid fa-utensils"></i>
                </div>

                <a href="{{ route('school_route.unit_package_show', $item->id) }}"> <img
                        src="{{ URL::asset('img/products/' . $img) }}" alt=""></a>
                <div class="d-flex justify-content-between align-items-baseline pt-3">
                    <h2 class="fs-6 fw-600 w-75 text-truncate">
                        <a href="{{ route($service_url, $item->itemable_id) }}" class="text-dark">
                            {{ $item->itemable->name }}</a>
                    </h2>
                    <p class="fs-8 secandry-light mb-0 text-end text-truncate"><i
                            class="fa-solid fa-location-arrow color-i"></i>
                        {{ $item->itemable->name }}</p>
                </div>
                <p class="secandry-light fs-8 text-truncate">{{
                    $item->itemable->short_description }}</p>
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="fw-600 color-title m-0 fs-5">
                            @if ($item->itemable_type !== "App\Models\Branch\Unit")
                            {{ $item->itemable->lowest }}
                            @endif
                        </h3>
                        <p class="secandry-light fs-9 m-0">Lowest Price for a person</p>
                    </div>

                    <button data-id="{{ $item->itemable_id }}" data-type="unit"
                        class="wishlist-btn fs-8 py-2 text-capitalize add_wishlist_ajax wishlist-btn_active">
                        <i class="fa-solid fa-heart"></i>
                        add to favourite
                    </button>

                </div>
            </div>

        </div>
        @endforeach
    </div>
</div>

@endsection
@section('js')
@endsection