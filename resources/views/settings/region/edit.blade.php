@extends('layouts.master')

@section('title', 'Region | Lam - School Management App')

@section('title-topbar', __('basic.region'))

<!-- css insert -->
@section('css')

<!-- select 2 -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/css/select2.min.css"
    integrity="sha512-aD9ophpFQ61nFZP6hXYu4Q/b/USW7rpLCQLX6Bi0WJHXNO7Js/fUENpBQf/+P4NtpzNX0jSgR5zVvPOJp+W2Kg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

<!-- boostrap datepicker -->
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css" />

<!-- datepicker time and date -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.css"
    integrity="sha512-MQXduO8IQnJVq1qmySpN87QQkiR1bZHtorbJBD0tzy7/0U9+YIC93QWHeGTEoojMVHWWNkoCp8V6OzVSYrX0oQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

@endsection


<!-- content insert -->
@section('content')

<div class="container-fluid px-0 px-md-2 mt-3">

    <!-- page title link -->
    <div class="d-sm-flex align-items-center justify-content-between mb-3">
        <span class="mb-0">
            <a class="link-cust-text text-gray-200 fw-light" href="{{ route('sett.home') }}">{{ __('basic.dashboard') }}
                |</a>
            <a class="link-cust-text text-gray-200 fw-light" href="{{ route('sett.region.index') }}">{{
                __('basic.regions') }} |
            </a>
            <a class="text-gray-300">{{ __('basic.region') }}</a>
        </span>
    </div>

    <div class="card card-input shadow mb-3 pb-3">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 fw-bold text-gray-500"><i class="fas fa-map-marker-alt me-1"></i>
                {{ __('basic.region') }}</h6>
        </div>


        <!-- Card Body -->
        <div class="card-body px-4 px-md-5">

            <form id="myform" method="POST" action="{{ route('sett.region.update', $region->id) }}">

                @csrf
                @method('PUT')

                <div class="row mb-1 justify-content-center">

                    <div class="col-12 col-md-10 col-lg-7">
                        <div class="row">


                            <div class="col-12 mb-3">
                                <label class="form-label">{{ __('basic.country') }}
                                    <small>({{ __('basic.required') }})</small></label>
                                <select id="country_id"
                                    class="js-example-basic-single select2-hidden-accessible @error('country_id') is-invalid @enderror"
                                    name="country_id" required>
                                    @foreach ($countries as $item)
                                    <option @if ($item->id == $region->country_id)
                                        selected
                                        @endif value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                <div id="country_id-js-error-valid"></div>

                                @error('country_id')
                                <span class="error-msg-form">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>

                            <div class="col-12 mb-2">
                                <label class="form-label">{{ __('patientappo.city') }}
                                    <small>({{ __('basic.required') }})</small></label>
                                <select
                                    class="js-example-basic-single select2-hidden-accessible @error('city_id') is-invalid @enderror"
                                    name="city_id" required>
                                    @foreach ($cities as $item)
                                    <option value="{{ $item->id }}" @if($region->city_id == $item->id) selected @endif>
                                        {{ $item->name }}
                                    </option>
                                    @endforeach
                                </select>

                                <div id="city-js-error-valid"></div>

                                @if ($errors->has('city_id'))
                                <span class="error-msg-form">
                                    {{ $errors->first('city_id') }}
                                </span>
                                @else
                                <div class="form-text text-gray-200">{{ __('patientappo.city msg') }}
                                </div>
                                @endif
                            </div>


                            <div class="col-12 mb-3">
                                <label class="form-label">{{ __('basic.name') }}
                                    <small>({{ __('basic.required') }})</small></label>
                                <input name="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                    value="{{ $region->name }}" placeholder="Name .." required>

                                @error('name')
                                <span class="error-msg-form">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>

                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end mt-4 mb-2">
                    <input type="submit" name="next" class="next-form-steps btn btn-primary action-button-next"
                        value="{{ __('basic.send') }}">
                </div>

            </form>
        </div>

    </div>

</div>

@endsection

<!-- js insert -->
@section('js')


<!-- jquery ui datepicker -->
<script type="text/javascript"
    src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<script>
    $(function() {
            $('.hasdatetimepicker').datepicker({
                todayHighlight: true,
                format: "yyyy-mm-dd",
            }).on('change', function() {
                $('.datepicker').hide();
            });
        });
</script>

<!-- select 2 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/js/select2.min.js"
    integrity="sha512-4MvcHwcbqXKUHB6Lx3Zb5CEAVoE9u84qN+ZSMM6s7z8IeJriExrV3ND5zRze9mxNlABJ6k864P/Vl8m0Sd3DtQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function() {
            $('.js-example-basic-single').select2();
            //hide search
            $('.select2-no-search').select2({
                minimumResultsForSearch: -1
            });
        });


        //for country and cities ajax inputs
        function fetchCity(countryID = $('select[name="country_id"]').val()) {

        var url = "{{ route('sett.createcityajax', ':id') }}";
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
</script>


@endsection