<div class="swiper-slide">
    <div class="product">
        <span data-product_id="{{ $item->id }}"
            class="wishlist-comp add_wishlist_ajax clickable-item-pointer shadow-hotel "><i
                class="fa-solid fa-heart"></i></span>
        <a href="{{ route('school_route.trip_show', [$item->slug, 'direct']) }}"> <img class="mb-2 img_slider"
                src="{{ URL::asset('img/trip/' . $item->main_image) }}" title="cover">
        </a>
        @if(count($item->tags) > 0)
        <div class=" mb-1">
            <a href="{{ route('school_route.show_tag', $item->tags[0]->tag->slug) }}">
                <span class="badge badge_tags px-3 me-1 text-xxs"
                    style="background-color: {{ $item->tags[0]->tag->color }}"> {{ $item->tags[0]->tag->name }}</span>
            </a>
        </div>
        @endif


        <div class="row">

            <div class="col-8">
                <a href="{{ route('school_route.trip_show', [$item->slug, 'direct']) }}"
                    class="text-gray-900 fw-light text-s">{{
                    $item->name }}</a>
                <div>
                    <a href="{{ route('school_route.trip_show', $item->slug) }}" class="text-gray-400 fw-light text-s">
                        <img class="me-1" width="10px" src="img/icons/location_pin.svg" alt="" />
                        {{ $item->destination->name }}
                    </a>
                </div>
            </div>
            <div class="col-4">
                <div class="fw-bold">
                    @if($item->lowest)
                    <p class="text-xxs texst-gray-400 fw-light mb-0">Started</p>
                    <h4 class="mb-0 fw-bold">
                        {{ $item->lowest }}
                    </h4>
                    <p class="text-xxs texst-gray-400 fw-light mb-0">LE</p>
                    @else
                    <h4 class="mb-0 fw-bold">
                        {{ $item->lowest }}
                        <h6 class=" text-red">Fully Booked</h6>
                    </h4>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>