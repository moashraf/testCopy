<div class="swiper-slide">
    <div class="product">
        <span data-product_id="{{ $item->id }}"
            class="wishlist-comp add_wishlist_ajax clickable-item-pointer shadow-hotel "><i
                class="fa-solid fa-heart"></i></span>

        <a href="{{ route('school_route.package_show', [$item->slug, 'direct']) }}">
            <img class="mb-2 img_slider" src="{{ URL::asset('img/package/' . $item->main_image) }}" title="cover">
        </a>

        <div class="mb-1">
            <a href="{{ route('school_route.show_tag', $item->tags[0]->tag->slug) }}">
                <span class="badge badge_tags px-3 me-1 text-xxs"
                    style="background-color: {{ $item->tags[0]->tag->color }}"> {{ $item->tags[0]->tag->name }}</span>
            </a>
        </div>

        <div class="row">

            <div class="col-7">
                <a href="{{ route('school_route.package_show', [$item->slug, 'direct']) }}"
                    class="text-gray-900 fw-light text-s">{{ $item->name }}</a>
                <div>
                    <a href="#" class="text-gray-400 fw-light text-s text-truncate">
                        <img class="me-1" width="10px" src="img/icons/location_pin.svg" alt="" />
                        {{ $item->destination->name }}
                    </a>
                </div>
            </div>
            <div class="col-5">
                <div class="fw-bold text-end">
                    @if($item->lowest)
                    <p class="text-xxs texst-gray-400 fw-light mb-0">Started</p>
                    <h4 class="mb-0 fw-bold fs-5">
                        {{ $item->lowest }}
                    </h4>
                    <p class="text-xxs texst-gray-400 fw-light mb-0">LE</p>
                    @else
                    <h4 class="mb-0 fw-bold text-s">
                        <a href="{{ route('school_route.contact_us') }}">
                            <p class="mb-0 text-green">Special Offer</p>
                            <h6 class="text-gray-500">Ask for Price</h6>
                        </a>
                    </h4>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>