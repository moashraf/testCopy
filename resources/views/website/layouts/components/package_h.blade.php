<div class="tourism_product_h row mx-0 mb-2">
    {{-- <span data-product_id="31" class="wishlist-comp add_wishlist_ajax clickable-item-pointer shadow"><i
            class="fa-solid fa-heart"></i></span> --}}

    <div
        class="col-4 col-md-3 text-center align-self-center justify-content-between px-2 align-items-center calander-left-border">

        <div class="d-flex justify-content-center">
            <div>
                @if($item['status'] == true)
                <p class="text-xs text-gray-500 mb-0">Started from</p>
                <h2 class="fw-bold mb-0">{{ $item->single_price }} <small class="text-xxs texst-gray-400 fw-light">L.E
                    </small>
                </h2>
                <a
                    href="{{ route('school_route.package_show', $item->slug . '?slug=' . $item->slug . '&search_hotel_input=' . $slug . '&from_ht_date=' . $from . '&to_ht_date=' . $to . '&type=direct') }}">
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
        <a href="#" class="text-gray-900 fw-bold fs-5">{{ $item->name }}
        </a>

        <p class="text-gray-300 text-s text-truncate"><span> {{
                $item->destination->name }}</span> <i class="fa-solid fa-location-dot"></i></p>


        <p class="text-gray-300 text-s two_line_linit">{{ $item->short_description }}</p>

        <h6 class="text-gold-200"><i class="fa-solid fa-star"></i> 5.0</h6>
    </div>

    <div class="col-12 col-md-3 px-0">
        <img src="{{ URL::asset('img/package/' . $item->main_image) }}" title="cover">
    </div>

</div>