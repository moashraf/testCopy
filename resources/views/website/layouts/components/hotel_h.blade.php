<div class="tourism_product_h row mx-0 mb-2">
    {{-- <a data-product_id="31" class="wishlist-comp add_wishlist_ajax clickable-item-pointer shadow"><i
            class="fa-solid fa-heart"></i></a> --}}

    @if($item['status'] == true)
    @php
    $url = route('school_route.unit_show', $item->slug . '?slug=' . $item->slug . '&search_hotel_input=' . $slug .
    '&from_ht_date=' . $from . '&to_ht_date=' . $to . '&room_qty=' . $room_qty. '&adult_qty=' . $adult_qty);
    @endphp
    @elseif($type === "direct")
    @php
    $url = route('school_route.unit_show', [$item->slug, 'direct']);
    @endphp
    @else
    @php
    $url = route('school_route.unit_show', [$item->slug, 'direct']);
    @endphp
    @endif
    <div
        class="col-4 col-md-3 text-center align-self-center justify-content-between px-2 align-items-center calander-left-border">

        <div class="d-flex justify-content-center">
            <div>
                @if($item['status'] == true)
                <p class="text-xs text-gray-500 mb-0">Total Price for {{ $item->nights }} Nights</p>
                <h2 class="fw-bold mb-0">{{ $item->price }} <small class="text-xxs texst-gray-400 fw-light">L.E
                    </small>
                </h2>
                <a href="{{ $url }}">
                    <div class="yellow_400 border_radius_20 fw-normal text-s m-0"> <i
                            class="fas fa-arrow-right ms-1"></i>
                        Check Availability
                    </div>
                </a>
                @elseif($type === "direct")
                <h5 class="fw-bold mb-0 text-gray-400">Choose Date</h5>
                @else
                <h5 class="fw-bold mb-0 text-red">Fully Booked</h5>
                <p class="text-gray-400 text-s">Try another Date</p>
                @endif

            </div>

        </div>

    </div>

    <div class="col-8 col-md-6 px-3 py-4 text-start">
        <span class="text-xs"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
        </span>
        <a href="{{ $url }}" class="text-gray-900 fw-bold fs-5">{{ $item->name }}
        </a>

        <p class="text-gray-300 text-s text-truncate"><i class="fa-solid fa-location-dot"></i> <span> {{
                $item['address'] }}</span></p>


        <p class="text-gray-300 text-s two_line_linit">{{ $item->short_description }}</p>

        <h6 class="text-gold-200"><i class="fa-solid fa-star"></i> 5.0</h6>
    </div>

    <div class="col-12 col-md-3 px-0">
        <a href="{{ $url }}">
            <img src="{{ URL::asset('img/unit/' . $item->main_image) }}" title="cover">
        </a>
    </div>

</div>