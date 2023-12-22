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

            <div class="justify-content-between align-items-center mt-2 mb-3">
                <div class="mb-3">
                    <h2 class="fs-4 fw-bold text-capitalize mb-0">My Requests</h2>
                    <p class="fs-8 text-secondary mb-0">
                        Here is your last Requests
                    </p>
                </div>

                @foreach ($on_request as $item)

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

                <div
                    class="d-flex bg-white justify-content-evenly justify-content-lg-between align-items-center shadow mb-3 p-3 px-4 radius-20 flex-wrap b-r-l-cont">
                    <div class="d-flex align-items-center">
                        <i class="fa-solid fa-paper-plane fs-1 me-2"></i>
                        <div class="m-2">
                            <a class="fs-7 link-cust-text text-gray-900 fw-bold mb-1"
                                href="{{route('school_route.my_request_items', $item->code)}}">
                                {{ $item->code }}
                            </a>

                            {{-- <span class="fs-8 gray">Singapore, officially the </span> --}}
                        </div>
                    </div>

                    <div class="m-1 text-center">
                        <h6 class="fs-8 gray m-0 mb-2 text-gray-400 text-xs">
                            <i class="fa-regular fa-calendar me-1"></i> Status
                        </h6>
                        <p> <span class="badge rounded-pill {{ $text_color }} badge-padd-l">{{
                                $msg
                                }}</span></p>
                    </div>
                    <div class="m-1 text-center">
                        <h6 class="fs-8 gray m-0 mb-2 text-gray-400 text-xs">
                            <i class="fa-regular fa-calendar me-1"></i> Created
                        </h6>
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