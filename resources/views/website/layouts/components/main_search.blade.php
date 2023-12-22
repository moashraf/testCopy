{{-- searching --}}
<div class="booking_search_cont_header px-3 px-md-5 absolute_pos_center z-2 w-100" @if(!empty($destination_page))
    style="bottom: -1.2rem" @else style="bottom: 2.7rem" @endif>


    <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="hotel-tab" data-bs-toggle="tab" data-bs-target="#hotel_tap"
                type="button" role="tab" aria-controls="hotel_tap" aria-selected="true" class="text-gray-500"><i
                    class="fas fa-hotel me-1"></i>
                Hotels</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="airline_tap-tab" data-bs-toggle="tab" data-bs-target="#airline_tap"
                type="button" role="tab" aria-controls="airline_tap" aria-selected="false" class="main-color"><i
                    class="fa-solid fa-plane me-1"></i>
                Flights</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="package-tab" data-bs-toggle="tab" data-bs-target="#package_tap" type="button"
                role="tab" aria-controls="package_tap" aria-selected="false" class="main-color"><i
                    class="fa-solid fa-suitcase-rolling me-1"></i>
                Package</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="package-tab" data-bs-toggle="tab" data-bs-target="#destination_tap"
                type="button" role="tab" aria-controls="package_tap" aria-selected="false" class="main-color"><i
                    class="fas fa-globe-africa me-1"></i>
                Destination</button>
        </li>
    </ul>

    <div class="tab-content" id="myTabContent">

        {{-- hoels --}}
        <div class="tab-pane fade show active" id="hotel_tap" role="tabpanel">
            <div class="row">

                <form id="myform" class="m-0" action="{{ route('school_route.unit_search') }}" method="GET">
                    @csrf

                    <div
                        class="bg-white border_radius_50 shadow-main py-3 px-3 px-md-5 d-flex align-items-center @if(!empty($destination_page)) shadow @endif">

                        {{-- for small devices (mobiles) --}}
                        <div class="calander-left-border px-0 px-md-3 flex-grow-1 d-block d-md-none">
                            <div class="d-flex">
                                <img class="me-3" width="17px" src="{{ URL::asset('img/icons/location_pin.svg') }}"
                                    alt="" />
                                <div>
                                    <div class="d-flex align-items-center text-s fw-bold text-gray-700 mb-0">
                                        Destination
                                    </div>

                                    <p class="text-gray-300 clickable-item-pointer mb-0" data-bs-toggle="offcanvas"
                                        data-bs-target="#offcanvas_search_hotel" aria-controls="offcanvasTop"> Click
                                        Here to search
                                    </p>
                                </div>
                            </div>
                        </div>

                        {{-- for large devices --}}

                        {{-- destination --}}
                        <div class="px-3 flex-grow-1 d-none d-md-block">

                            <div class="d-flex align-items-center">

                                <img class="me-3" width="17px" src="{{ URL::asset('img/icons/location_pin.svg') }}"
                                    alt="" />

                                <div>
                                    <div class="d-flex align-items-center text-s fw-bold text-gray-700 mb-0">
                                        Destination
                                    </div>

                                    <div class="dropdown">

                                        <input type="text" name="search_hotel" class="booking_search_input search_hotel"
                                            data-bs-toggle="dropdown" aria-expanded="false" placeholder="Sharm Elshikh"
                                            id="dropdown_destination_book" required @if(!empty($destination_slug))
                                            value="{{ $destination_slug }}" @endif>

                                        <input type="hidden" name="search_hotel_input" class="search_hotel_input"
                                            required @if(!empty($destination_slug)) value="{{ $destination_slug }}"
                                            @endif>

                                        <div
                                            class="dropdown-menu dropdown_booking_destination_cont dropdown-menu-end py-0">
                                            <div class="p-4 mb-0 pb-0">
                                                <p class="text-gray-300 text-xs mb-1 text-start"> What's your next
                                                    Destination?
                                                </p>
                                            </div>
                                            <ul class="search_destination_cont" class="px-4 py-0 mb-0"
                                                aria-labelledby="dropdown_destination_book">
                                            </ul>
                                            <hr class="my-2">
                                            <div class="p-4 pt-0 pb-3">
                                                <p class="text-gray-300 text-xs mb-0 text-start"> Write the desiination
                                                    name or its code..
                                                </p>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>


                        </div>

                        {{-- from date --}}
                        <div class="calander-left-border px-3 d-none d-md-block">
                            <div class="d-flex">
                                <img class="me-3" width="24px" src="{{ URL::asset('img/icons/calendar.svg') }}"
                                    alt="" />
                                <div>
                                    <div class="d-flex align-items-center text-s fw-bold text-gray-700 mb-0">
                                        From
                                    </div>
                                    <input name="from_ht_date" type="text"
                                        class="booking_search_input border-0 datepicker_time bg-white @error('from_ht_date') is-invalid @enderror"
                                        placeholder="Thu 16 Feb" data-enable-time="true"
                                        value="{{ old('from_ht_date') }}" required>
                                </div>
                            </div>
                        </div>

                        {{-- to date --}}
                        <div class="calander-left-border px-3 d-none d-md-block">
                            <div class="d-flex">
                                <img class="me-3" width="24px" src="{{ URL::asset('img/icons/calendar.svg') }}" src=""
                                    alt="" />
                                <div>
                                    <div class="d-flex align-items-center text-s fw-bold text-gray-700 mb-0">
                                        To
                                    </div>
                                    <input name="to_ht_date" type="text"
                                        class="booking_search_input border-0 datepicker_time bg-white @error('to_ht_date') is-invalid @enderror"
                                        placeholder="Thu 16 Feb" data-enable-time="true" value="{{ old('to_ht_date') }}"
                                        required>
                                </div>
                            </div>
                        </div>

                        {{-- qty --}}
                        <div class="px-3 d-none d-md-block">
                            <div class="d-flex align-items-center">

                                <img class="me-3" width="24px" src="{{ URL::asset('img/icons/users.svg') }}" alt="" />

                                <div>
                                    <div class="d-flex align-items-center text-s fw-bold text-gray-700 mb-0">
                                        Travelers
                                    </div>

                                    <div class="dropdown">

                                        <p class="clickable-item-pointer text-gray-300 mb-0 text-truncate" type="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <span id="room_show_qty">1 Room</span>
                                            <span id="adult_show_qty">1 Adult</span>
                                        </p>

                                        <ul class="dropdown-menu dropdown_booking_qty_cont p-4">
                                            <li class="d-flex justify-content-between align-items-center mb-2">
                                                <h6 class="mb-0"> Rooms</h6>
                                                <div class="counter_book_btn pe-4">
                                                    <span data-type="room" class="plus_counter_btn bg-dark">+</span>
                                                    <input type="text" class="counter_book_count" name="room_qty"
                                                        value="1" readonly required>
                                                    <span data-type="room" class="minus_counter_btn bg-dark">-</span>
                                                </div>
                                            </li>
                                            <hr>
                                            <li class="d-flex justify-content-between align-items-center mb-2">
                                                <h6 class="mb-0"> Adults</h6>
                                                <div class="counter_book_btn pe-4">
                                                    <span data-type="adult" class="plus_counter_btn bg-dark">+</span>
                                                    <input type="text" class="counter_book_count" name="adult_qty"
                                                        value="1" readonly required>
                                                    <span data-type="adult" class="minus_counter_btn bg-dark">-</span>
                                                </div>
                                            </li>
                                            <li class="d-flex justify-content-between align-items-center mb-3">
                                                <h6 class="mb-0"> Children</h6>
                                                <div class="counter_book_btn pe-4">
                                                    <span data-type="child" class="plus_counter_btn bg-dark">+</span>
                                                    <input type="text" class="counter_book_count" name="child_qty"
                                                        value="0" readonly>
                                                    <span data-type="child" class="minus_counter_btn bg-dark">-</span>
                                                </div>
                                            </li>
                                            <hr>

                                            <li class="d-flex justify-content-between align-items-center">
                                                <p class="text-gray-300 text-xs mb-0  text-end">You must be below 18
                                                    years
                                                    old
                                                </p>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                            </div>

                        </div>

                        {{-- submit --}}
                        <div class="px-3">
                            <button type="submit" class="yellow_400 border_radius_50 border-0">
                                <div class="d-flex fs-6">
                                    <i class="fa-solid fa-magnifying-glass me-2"></i> Search
                                </div>
                            </button>
                        </div>


                    </div>
                </form>

            </div>
        </div>


        {{-- airline --}}
        <div class="tab-pane fade show" id="airline_tap" role="tabpanel" aria-labelledby="airline_tap">
            <div class="row">
                <div
                    class="bg-white border_radius_50 shadow-main py-3 px-3 px-md-5 d-flex align-items-center @if(!empty($destination_page)) shadow @endif">


                    {{-- for small devices (mobiles) --}}
                    <div class="calander-left-border px-3 flex-grow-1 d-block d-md-none">
                        <div class="d-flex">
                            <img class="me-3" width="17px" src="{{ URL::asset('img/icons/location_pin.svg') }}"
                                alt="" />
                            <div>
                                <div class="d-flex align-items-center text-s fw-bold text-gray-700 mb-0">
                                    Destination
                                </div>

                                <p class="text-gray-300 clickable-item-pointer mb-0" data-bs-toggle="offcanvas"
                                    data-bs-target="#offcanvas_search" aria-controls="offcanvasTop"> Click here to
                                    search
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- for large devices --}}

                    {{-- destination --}}
                    <div class="px-3 flex-grow-1 d-none d-md-block">

                        <div class="d-flex align-items-center">

                            <img class="me-3" width="17px" src="{{ URL::asset('img/icons/location_pin.svg') }}"
                                alt="" />

                            <div>
                                <div class="d-flex align-items-center text-s fw-bold text-gray-700 mb-0">
                                    Destination
                                </div>

                                <div class="dropdown">

                                    <input type="text" name="search_hotel" class="booking_search_input search_hotel"
                                        data-bs-toggle="dropdown" aria-expanded="false" placeholder="Sharm Elshikh"
                                        id="dropdown_destination_book" @if(!empty($destination_slug))
                                        value="{{ $destination_slug }}" @endif required>

                                    <div class="dropdown-menu dropdown_booking_destination_cont dropdown-menu-end py-0">
                                        <div class="p-4 mb-0 pb-0">
                                            <p class="text-gray-300 text-xs mb-1 text-start"> What's your next
                                                Destination?
                                            </p>
                                        </div>
                                        <ul class="search_destination_cont" class="px-4 py-0 mb-0"
                                            aria-labelledby="dropdown_destination_book">
                                        </ul>
                                        <hr class="my-2">
                                        <div class="p-4 pt-0 pb-3">
                                            <p class="text-gray-300 text-xs mb-0 text-start"> Write the desiination name
                                                or its
                                                code..
                                            </p>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>


                    </div>

                    {{-- from date --}}
                    <div class="calander-left-border px-3 d-none d-md-block">
                        <div class="d-flex">
                            <img class="me-3" width="24px" src="{{ URL::asset('img/icons/calendar.svg') }}" alt="" />
                            <div>
                                <div class="d-flex align-items-center text-s fw-bold text-gray-700 mb-0">
                                    From
                                </div>
                                <input name="from_ht_date" type="text"
                                    class="booking_search_input border-0 datepicker_time bg-white @error('date') is-invalid @enderror"
                                    placeholder="Thu 16 Feb" data-enable-time="true" value="{{ old('date') }}" required>
                            </div>
                        </div>
                    </div>

                    {{-- to date --}}
                    <div class="calander-left-border px-3 d-none d-md-block">
                        <div class="d-flex">
                            <img class="me-3" width="24px" src="{{ URL::asset('img/icons/calendar.svg') }}" alt="" />
                            <div>
                                <div class="d-flex align-items-center text-s fw-bold text-gray-700 mb-0">
                                    To
                                </div>
                                <input name="from_ht_date" type="text"
                                    class="booking_search_input border-0 datepicker_time bg-white @error('date_return') is-invalid @enderror"
                                    placeholder="Thu 16 Feb" data-enable-time="true" value="{{ old('date_return') }}"
                                    required>
                            </div>
                        </div>
                    </div>

                    {{-- qty --}}
                    <div class="px-3 d-none d-md-block">
                        <div class="d-flex align-items-center">

                            <img class="me-3" width="24px" src="{{ URL::asset('img/icons/users.svg') }}" alt="" />

                            <div>
                                <div class="d-flex align-items-center text-s fw-bold text-gray-700 mb-0">
                                    Travelers
                                </div>
                                <div class="dropdown">

                                    <p class="clickable-item-pointer text-gray-300 mb-0 text-truncate"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <span id="room_show_qty">1 Room</span>
                                        <span id="adult_show_qty">1 Adult</span>
                                    </p>

                                    <ul class="dropdown-menu dropdown_booking_qty_cont p-4">
                                        <li class="d-flex justify-content-between align-items-center mb-2">
                                            <h6 class="mb-0"> Rooms</h6>
                                            <div class="counter_book_btn pe-4">
                                                <span data-type="room" class="plus_counter_btn bg-dark">+</span>
                                                <input type="text" class="counter_book_count" name="room_qty" value="1"
                                                    readonly>
                                                <span data-type="room" class="minus_counter_btn bg-dark">-</span>
                                            </div>
                                        </li>
                                        <hr>
                                        <li class="d-flex justify-content-between align-items-center mb-2">
                                            <h6 class="mb-0"> Adults</h6>
                                            <div class="counter_book_btn pe-4">
                                                <span data-type="adult" class="plus_counter_btn bg-dark">+</span>
                                                <input type="text" class="counter_book_count" name="adult_qty" value="1"
                                                    readonly>
                                                <span data-type="adult" class="minus_counter_btn bg-dark">-</span>
                                            </div>
                                        </li>
                                        <li class="d-flex justify-content-between align-items-center mb-3">
                                            <h6 class="mb-0"> Children</h6>
                                            <div class="counter_book_btn pe-4">
                                                <span data-type="child" class="plus_counter_btn bg-dark">+</span>
                                                <input type="text" class="counter_book_count" name="child_qty" value="0"
                                                    readonly>
                                                <span data-type="child" class="minus_counter_btn bg-dark">-</span>
                                            </div>
                                        </li>
                                        <hr>

                                        <li class="d-flex justify-content-between align-items-center">
                                            <p class="text-gray-300 text-xs mb-0  text-end">You must be below 18
                                                years
                                                old
                                            </p>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                        </div>

                    </div>

                    {{-- submit --}}
                    <div class="px-3">
                        <button type="submit" class="yellow_400 border_radius_50 border-0">
                            <div class="d-flex fs-6">
                                <i class="fa-solid fa-magnifying-glass me-2"></i> Search
                            </div>
                        </button>
                    </div>


                </div>
            </div>
        </div>


        {{-- package --}}
        <div class="tab-pane fade show" id="package_tap" role="tabpanel" aria-labelledby="package_tap">


            <div class="row">

                <form id="myform" class="m-0" action="{{ route('school_route.search_package') }}" method="GET">
                    @csrf

                    <div
                        class="bg-white border_radius_50 shadow-main py-3 px-3 px-md-5 d-flex align-items-center @if(!empty($destination_page)) shadow @endif">

                        {{-- for small devices (mobiles) --}}
                        <div class="calander-left-border px-0 px-md-3 flex-grow-1 d-block d-md-none">
                            <div class="d-flex">
                                <img class="me-3" width="17px" src="{{ URL::asset('img/icons/location_pin.svg') }}"
                                    alt="" />
                                <div>
                                    <div class="d-flex align-items-center text-s fw-bold text-gray-700 mb-0">
                                        Destination
                                    </div>

                                    <p class="text-gray-300 clickable-item-pointer mb-0" data-bs-toggle="offcanvas"
                                        data-bs-target="#offcanvas_search_package" aria-controls="offcanvasTop"> Click
                                        Here to search
                                    </p>
                                </div>
                            </div>
                        </div>

                        {{-- for large devices --}}

                        {{-- destination --}}
                        <div class="px-3 flex-grow-1 d-none d-md-block">

                            <div class="d-flex align-items-center">

                                <img class="me-3" width="17px" src="{{ URL::asset('img/icons/location_pin.svg') }}"
                                    alt="" />

                                <div>
                                    <div class="d-flex align-items-center text-s fw-bold text-gray-700 mb-0">
                                        Destination
                                    </div>

                                    <div class="dropdown">

                                        <input type="text" name="search_hotel" class="booking_search_input search_hotel"
                                            data-bs-toggle="dropdown" aria-expanded="false" placeholder="Sharm Elshikh"
                                            id="dropdown_destination_book" required @if(!empty($destination_slug))
                                            value="{{ $destination_slug }}" @endif>

                                        <input type="hidden" name="search_hotel_input" class="search_hotel_input"
                                            required @if(!empty($destination_slug)) value="{{ $destination_slug }}"
                                            @endif>

                                        <div
                                            class="dropdown-menu dropdown_booking_destination_cont dropdown-menu-end py-0">
                                            <div class="p-4 mb-0 pb-0">
                                                <p class="text-gray-300 text-xs mb-1 text-start"> What's your next
                                                    Destination?
                                                </p>
                                            </div>
                                            <ul class="search_destination_cont" class="px-4 py-0 mb-0"
                                                aria-labelledby="dropdown_destination_book">
                                            </ul>
                                            <hr class="my-2">
                                            <div class="p-4 pt-0 pb-3">
                                                <p class="text-gray-300 text-xs mb-0 text-start"> Write the desiination
                                                    name or its code..
                                                </p>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>


                        </div>

                        {{-- from date --}}
                        <div class="calander-left-border px-3 d-none d-md-block">
                            <div class="d-flex">
                                <img class="me-3" width="24px" src="{{ URL::asset('img/icons/calendar.svg') }}"
                                    alt="" />
                                <div>
                                    <div class="d-flex align-items-center text-s fw-bold text-gray-700 mb-0">
                                        From
                                    </div>
                                    <input name="from_ht_date" type="text"
                                        class="booking_search_input border-0 datepicker_time bg-white @error('from_ht_date') is-invalid @enderror"
                                        placeholder="Thu 16 Feb" data-enable-time="true"
                                        value="{{ old('from_ht_date') }}" required>
                                </div>
                            </div>
                        </div>

                        {{-- to date --}}
                        <div class="calander-left-border px-3 d-none d-md-block">
                            <div class="d-flex">
                                <img class="me-3" width="24px" src="{{ URL::asset('img/icons/calendar.svg') }}" src=""
                                    alt="" />
                                <div>
                                    <div class="d-flex align-items-center text-s fw-bold text-gray-700 mb-0">
                                        To
                                    </div>
                                    <input name="to_ht_date" type="text"
                                        class="booking_search_input border-0 datepicker_time bg-white @error('to_ht_date') is-invalid @enderror"
                                        placeholder="Thu 16 Feb" data-enable-time="true" value="{{ old('to_ht_date') }}"
                                        required>
                                </div>
                            </div>
                        </div>

                        {{-- submit --}}
                        <div class="px-3">
                            <button type="submit" class="yellow_400 border_radius_50 border-0">
                                <div class="d-flex fs-6">
                                    <i class="fa-solid fa-magnifying-glass me-2"></i> Search
                                </div>
                            </button>
                        </div>


                    </div>
                </form>

            </div>
        </div>

        {{-- destination --}}
        <div class="tab-pane fade show" id="destination_tap" role="tabpanel" aria-labelledby="destination_tap">
            <div class="row">

                <form id="myform_destination" class="mb-0" action="{{ route('school_route.show_destination') }}"
                    method="GET">
                    @csrf

                    <div
                        class="bg-white border_radius_50 shadow-main py-3 px-3 px-md-5 d-flex align-items-center @if(!empty($destination_page)) shadow @endif">

                        {{-- for small devices (mobiles) --}}
                        <div class="calander-left-border px-3 flex-grow-1 d-block d-md-none">
                            <div class="d-flex">
                                <img class="me-3" width="17px" src="img/icons/location_pin.svg" alt="" />
                                <div>
                                    <div class="d-flex align-items-center text-s fw-bold text-gray-700 mb-0">
                                        Destination
                                    </div>

                                    <p class="text-gray-300 clickable-item-pointer mb-0" data-bs-toggle="offcanvas"
                                        data-bs-target="#offcanvas_search_destination" aria-controls="offcanvasTop">
                                        Click here to
                                        search
                                    </p>
                                </div>
                            </div>
                        </div>

                        {{-- for large devices --}}

                        {{-- destination --}}
                        <div class="px-3 flex-grow-1 d-none d-md-block">

                            <div class="d-flex align-items-center">

                                <img class="me-3" width="17px" src="{{ URL::asset('img/icons/location_pin.svg') }}"
                                    alt="" />

                                <div>
                                    <div class="d-flex align-items-center text-s fw-bold text-gray-700 mb-0">
                                        Destination
                                    </div>

                                    <div class="dropdown">

                                        <input type="text" name="search_hotel" class="booking_search_input search_hotel"
                                            data-bs-toggle="dropdown" aria-expanded="false" placeholder="Sharm Elshikh"
                                            id="dropdown_destination_book" @if(!empty($destination_slug))
                                            value="{{ $destination_slug }}" @endif required>

                                        <input type="hidden" name="search_hotel_input" class="search_hotel_input"
                                            @if(!empty($destination_slug)) value="{{ $destination_slug }}" @endif
                                            required>

                                        <div
                                            class="dropdown-menu dropdown_booking_destination_cont dropdown-menu-end py-0">
                                            <div class="p-4 mb-0 pb-0">
                                                <p class="text-gray-300 text-xs mb-1 text-start"> What's your next
                                                    Destination?
                                                </p>
                                            </div>
                                            <ul class="search_destination_cont" class="px-4 py-0 mb-0"
                                                aria-labelledby="dropdown_destination_book">
                                            </ul>
                                            <hr class="my-2">
                                            <div class="p-4 pt-0 pb-3">
                                                <p class="text-gray-300 text-xs mb-0 text-start"> Write the desiination
                                                    name or its code..
                                                </p>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>


                        </div>

                        {{-- submit --}}
                        <div class="px-3">
                            <button type="submit" class="yellow_400 border_radius_50 border-0">
                                <div class="d-flex fs-6">
                                    <i class="fa-solid fa-magnifying-glass me-2"></i> Search
                                </div>
                            </button>
                        </div>


                    </div>
                </form>

            </div>
        </div>

    </div>

</div>
</div>
</div>