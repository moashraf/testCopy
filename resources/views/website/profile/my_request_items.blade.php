@extends('website.layouts.master', ['no_transparent_header' => false])
@section('css')

<!-- boostrap datepicker -->
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css" />

@endsection
@section('content')

<section class="px-2 px-md-5 pt-4">

    <div class="row pb-0 pb-md-5 pt-2 px-0 px-md-5 mx-0 mx-md-5">

        <div class="col-12 col-md-3">

            @include('website.layouts.includes.leftside_profile', ['type' => "requests"])


        </div>


        <div class="col-12 col-md-9">

            <div class="justify-content-between align-items-center mt-0 mb-3">

                <div class="d-flex justify-content-between align-items-center mt-2 mb-3">
                    <div>
                        <h2 class="fs-4 fw-bold text-capitalize">My Requests Of <span class="text-gray-300">{{
                                $on_request->code }}
                            </span> </h2>
                        <p class="fs-8 text-secondary mb-0">
                            Here is your last Requests
                        </p>
                    </div>


                    @if($on_request->invoice)

                    @if ($on_request->invoice->status == 0)
                    @php
                    $msg_invoice = __('basic.not paid');
                    $text_color_invoice = 'cancel-color-btn';
                    @endphp
                    @elseif ($on_request->invoice->status == 1)
                    @php
                    $text_color_invoice = 'pend-color-btn';
                    $msg_invoice = __('basic.pending');
                    @endphp
                    @elseif ($on_request->invoice->status == 2)
                    @php
                    $text_color_invoice = 'prog-color-btn';
                    $msg_invoice = __('basic.installment');
                    @endphp
                    @elseif ($on_request->invoice->status == 3)
                    @php
                    $text_color_invoice = 'done-color-btn';
                    $msg_invoice = __('basic.paid');
                    @endphp
                    @elseif ($on_request->invoice->status == 4)
                    @php
                    $msg_invoice = __('basic.refund');
                    $text_color_invoice = 'cancel-color-btn';
                    @endphp
                    @endif
                    <a href="{{ route('school_route.invoice_show', $on_request->invoice->code) }}"><span
                            class="badge rounded-pill {{ $text_color_invoice }} badge-padd-l"><small>Invoice </small>{{
                            $msg_invoice
                            }}</span></a>
                    @else
                    <span class="badge rounded-pill cancel-color-btn badge-padd-l">No Invoice</span>
                    @endif

                </div>


                @foreach ($on_request->items as $item)

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


                @if ($item->type === "hotel")
                @php
                $img = URL::asset('img/unit/' . $item->requestable->hotel->main_image);
                @endphp
                @elseif ($item->type === "trip")
                @php
                $img = URL::asset('img/trip/' . $item->requestable->trip->main_image);
                @endphp
                @elseif ($item->type === "package")
                @php
                $img = URL::asset('img/package/' . $item->requestable->package->main_image);
                @endphp
                @elseif ($item->type === "visa")
                @php
                $img = URL::asset('img/visa/cat/' . $item->requestable->visa->main_image);
                @endphp
                @endif

                <div
                    class="d-flex bg-white justify-content-evenly justify-content-lg-between align-items-center shadow mb-3 p-3 radius-20 b-r-l-cont">
                    <div class="d-flex align-items-center  text-truncate">
                        <img src="{{ $img }}" class="radius-10 me-3 mb-2 b-r-xs" width="90px" height="90px" alt="" />
                        <div class="m-2 text-truncate text-capitalize">
                            <p class="fs-5 text-gray-900 fw-bold text-truncate mb-0">
                                {{ $item->name }}
                            </p>

                            @if ($item->type === "hotel")
                            <div class="fs-8 mb-0 fw-bold text-gray-600"><span
                                    class="text-gray-400 text-xs fw-light">Type: </span>{{
                                $item->cat
                                }}</div>
                            <div class="fs-8 fw-bold text-gray-600"><span class="text-gray-400 text-xs fw-light">Meal:
                                </span>{{
                                $item->meal
                                }}</div>
                            @elseif($item->type === "package")
                            <div class="fs-8 fw-bold text-gray-600"><span class="text-gray-400 text-xs fw-light">Type:
                                </span>{{
                                $item->cat
                                }}</div>
                            <div class="fs-8 fw-bold text-gray-600"><span
                                    class="text-gray-400 text-xs fw-light">Capacity:
                                </span>{{
                                $item->capacity
                                }} People</div>
                            @elseif($item->type === "visa")
                            <div class="fs-8 fw-bold text-gray-600"><span class="text-gray-400 text-xs fw-light">Type:
                                </span>{{ $item->cat }}</div>
                            <div class="fs-8 fw-bold text-gray-600"><span class="text-gray-400 text-xs fw-light">Valid
                                    for:
                                </span>{{ $item->capacity }} Days</div>
                            @endif
                        </div>
                    </div>

                    <div class="m-1 text-center">
                        <div class="fs-8 m-0 mb-2  ext-gray-400 text-xs">
                            <i class="fa-regular fa-calendar me-1 text-gray-400 text-xs"></i> Status
                        </div>
                        <p>
                            <span class="badge rounded-pill {{ $text_color }} badge-padd-l">{{$msg}}</span>
                        </p>
                    </div>

                    <div class="m-1">
                        <p class="fs-8 gray mb-2">
                            <i class="fa-solid fa-calendar me-1 blue"></i> {{ $item->start_at }}
                        </p>
                        @if ($item->end_at)
                        <p class="fs-8 gray mb-2">
                            <i class="fa-solid fa-calendar me-2 blue"></i> {{ $item->end_at }}
                        </p>
                        @endif
                    </div>
                    <div class="m-1">

                        @if($item->discount > 0)
                        <p class="fw-bold blue mb-1 text-xs"><span class="text-gray-400">Discount: </span>{{
                            $item->discount }} <span class="text-gray-400 text-xs"> L.E</span></p>
                        @endif

                        <p class="fw-bold blue mb-1 fs-4">{{ $item->final_price }} <span
                                class="text-gray-400 fw-light text-xs">
                                L.E</span></p>
                    </div>
                </div>

                @endforeach

                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="bg-white b-r-l-cont py-3 px-2">
                            <div class="row px-0 px-md-3 px-lg-5 my-2">
                                <div class="col-7">
                                    <i class="fas fa-coins me-2 text-gray-400"></i><span
                                        id="service_final_info">Subtotal</span>
                                </div>
                                <div class="col-5 text-center">
                                    <div class="text-s2 text-gray-500">{{ $item->subtotal }}<small
                                            class="text-gray-300 text-xxxs">EGP</small>
                                    </div>
                                </div>
                            </div>

                            <div class="row px-0 px-md-3 px-lg-5 my-2">
                                <div class="col-7">
                                    <i class="fas fa-percent me-2 text-gray-400"></i><span
                                        id="service_final_info">Discount</span>
                                </div>
                                <div class="col-5 text-center">
                                    <div class="text-s2 text-gray-600 text-decoration-line-through">
                                        {{ $item->discount }} <small class="text-gray-300 text-xxxs"> EGP</small>
                                    </div>
                                </div>
                            </div>

                            <div class="row px-0 px-md-3 px-lg-5 my-2 mb-2">
                                <div class="col-7 fw-bold">
                                    <i class="fas fa-dollar-sign me-2"></i>
                                    <span id="service_final_info">Final Price</span>
                                </div>
                                <div class="col-5 text-center">
                                    <div class="text-s2 text-gray-600 fw-bold">{{ $item->final_price }}<small
                                            class="text-gray-300 text-xxxs"> EGP</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-between ">
                    <a href="{{route('school_route.my_requests')}}" class="text-gray-400 link-cust-text"><button
                            class="btn see-all"><i class="fa-solid fa-arrow-left"></i> Previous</button></a>
                </div>

            </div>

        </div>
    </div>

    </div>

</section>

@endsection
@section('js')
<!-- jquery ui datepicker -->
<script type="text/javascript"
    src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<script>
    $(function() {
            $('.hasdatetimepicker').datepicker({
                todayHighlight: true,
                format: "yyyy-mm-dd",
            }).on('change', function(){
                $('.datepicker').hide();
            });
        });
</script>


<script>
    fetchCity();

//for country and cities ajax inputs
function fetchCity(countryID = $('select[name="country_id"]').val()) {

    var url = "{{ route('school_route.trav_createcityajax', ':id') }}";
    url = url.replace(':id', countryID);

    if (countryID) {
        $.ajax({
            url: url,
            type: "GET",
            dataType: "json",
            success: function(data) {
                $('select[name="city_id"]').empty();
                $.each(data, function(key, value) {
                    $('select[name="city_id"]').append('<option value="' +
                        value.id + '">' + value.name + '</option>');
                });
                fetchRegion();
            }
        });
    } else {
        $('select[name="city_id"]').empty();
    }
}

$('select[name="country_id"]').on('change', function(e) {
    var country_id = $(this).val();
    fetchCity(country_id)
});

fetchRegion();

//for country and cities ajax inputs
function fetchRegion(cityID = $('select[name="city_id"]').val()) {

    var url = "{{ route('school_route.trav_createregionajax', ':id') }}";
    url = url.replace(':id', cityID);

    console.log(2121221);
    if (cityID) {
        $.ajax({
            url: url,
            type: "GET",
            dataType: "json",
            success: function(data) {
                console.log(data);

                if (data.length > 0) {
                    console.log(55555);

                    $('select[name="region_id"]').empty();
                    $.each(data, function(key, value) {
                        $('select[name="region_id"]').append('<option value="' +
                            value.id + '">' + value.name + '</option>');
                    });
                } else {
                    console.log('www');
                    $('select[name="region_id"]').html('<option value="1">{{ __("basic.not selected") }}</option>');
                }
            }
        });
    } else {
        console.log('asdasd');
        $('select[name="region_id"]').html('<option value="1">{{ __("basic.not selected") }}</option>');
    }
}

$('select[name="city_id"]').on('change', function(e) {
    var city_id = $(this).val();
    fetchRegion(city_id)
});

</script>
@endsection