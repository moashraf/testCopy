@extends('website.layouts.master', ['no_transparent_header' => false])
@section('css')

<!-- boostrap datepicker -->
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css" />

@endsection
@section('content')

<section class="px-2 px-md-5 pt-4">

    <div class="row pb-0 pb-md-5 pt-2 px-0 px-md-5 mx-0 mx-md-5">

        <div class="col-12 col-md-4">


            @include('website.layouts.includes.leftside_profile', ['type' => "my_profile"])


        </div>


        <div class="col-12 col-md-8">

            <div class="bg-white b-r-l-cont p-0 p-md-5 mb-3 py-4 px-3">

                <form id="myform" method="POST" action="{{ route('school_route.update_profile') }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('POST')

                    <div class="row mb-2 justify-content-center">


                        <div class="col-12 col-md-10 col-lg-10">

                            <div class="row mb-2 ">

                                <div class="col-12 align-self-start mb-3">
                                    <div class="avatar-update-container">
                                        <div class="picture">
                                            <img src="{{ URL::asset('img/useravatar/' . Auth::guard('school')->user()->avatar) }}"
                                                class="picture-src" id="mib_PicturePreview" title="" />
                                            <input type="file" name='img' accept="image/*" id="mib_img_input">
                                        </div>
                                        <h6 class="text-gray-300">{{ __('basic.choose img') }}</h6>
                                        @error('img')
                                        <span class="error-msg-form">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12 col-md-6 mb-3">
                                    <label class="form-label">{{ __('First name') }}
                                        <small>({{ __('basic.required') }})</small></label>
                                    <input id="first_name" name="first_name" type="text"
                                        class="form-control @error('first_name') is-invalid @enderror"
                                        placeholder="Write here your first name.."
                                        value="{{ Auth::guard('school')->user()->first_name }}">

                                    @error('first_name')
                                    <span class="error-msg-form">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>

                                <div class="col-12 col-md-6 mb-3">
                                    <label class="form-label">{{ __('Second name') }}
                                        <small>({{ __('basic.required') }})</small></label>
                                    <input id="second_name" name="second_name" type="text"
                                        class="form-control @error('second_name') is-invalid @enderror"
                                        placeholder="Write here your first name.."
                                        value="{{ Auth::guard('school')->user()->second_name }}">

                                    @error('second_name')
                                    <span class="error-msg-form">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>

                                <div class="col-12 mb-2">
                                    <label class="form-label">{{ __('Phone number') }} <small>({{
                                            __('basic.required')
                                            }})</small></label>
                                    <input type="number"
                                        class="form-control @error('phone_number') is-invalid @enderror"
                                        placeholder="Write your phone number here"
                                        value="{{ Auth::guard('school')->user()->phone_number }}" readonly disabled
                                        required>

                                    @if ($errors->has('phone_number'))
                                    <span class="invalid-feedback" role="alert">
                                        {{ $errors->first('phone_number') }}
                                    </span>
                                    @endif
                                </div>

                                <div class="col-12 mb-2">
                                    <label class="form-label">{{ __('patientappo.email') }} <small>({{
                                            __('basic.optional')
                                            }})</small></label>
                                    <input name="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        placeholder="Write your email here"
                                        value="{{ Auth::guard('school')->user()->email }}">

                                    <input name="old_email" type="hidden"
                                        value="{{ Auth::guard('school')->user()->email }}">

                                    @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        {{ $errors->first('email') }}
                                    </span>
                                    @else
                                    <div class="form-text text-gray-200">We'll never share your email with anyone else.
                                    </div>
                                    @endif
                                </div>


                                <div class="col-12 col-md-6 mb-2">
                                    <label class="form-label">{{ __('basic.new password') }} <small>({{
                                            __('basic.required')
                                            }})</small></label>
                                    <input id="password" name="newpassword" type="password"
                                        class="form-control @error('newpassword') is-invalid @enderror"
                                        placeholder="Wrtie your password here...">

                                    @if ($errors->has('newpassword'))
                                    <span class="error-msg-form">
                                        {{ $errors->first('newpassword') }}
                                    </span>
                                    @else
                                    <div class="form-text text-gray-200">Leave it empty if you do not want to change it.
                                    </div>
                                    @endif
                                </div>

                                <div class="col-12 col-md-6 mb-2">
                                    <label class="form-label">{{ __('basic.confirm new password') }} <small>({{
                                            __('basic.required')
                                            }})</small></label>
                                    <input name="newpassword_confirmation" type="password" class="form-control"
                                        placeholder="Confirm your password..." id="password-confirm">
                                </div>

                                <hr class="text-gray-400">

                                <div class="col-12 col-md-6 mb-2">
                                    <label class="form-label">{{ __('patientappo.gendar') }} <small>({{
                                            __('basic.optional')
                                            }})</small></label>
                                    <select
                                        class="js-example-basic-single select2-no-search select2-hidden-accessible @error('gendar') is-invalid @enderror"
                                        name="gendar" required>
                                        <option value="male" @if (Auth::guard('school')->user()->gendar === 'male')
                                            selected @endif>{{
                                            __('Male') }}</option>
                                        <option value="female" @if (Auth::guard('school')->user()->gendar === 'female')
                                            selected @endif>{{
                                            __('Female') }}
                                        </option>
                                        <option value="not selected" @if (Auth::guard('school')->user()->gendar ===
                                            'not selected')
                                            selected @endif>{{
                                            __('Not selected') }}
                                        </option>
                                    </select>
                                    <div id="gendar-js-error-valid"></div>

                                    @error('gendar')
                                    <span class="error-msg-form">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>

                                <div class="col-12 col-md-6 mb-3">

                                    <label class="form-label">{{ __('patientappo.birthday') }}
                                        <small>({{ __('basic.optional') }})</small></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="bi bi-calendar2-week-fill"></i>
                                            </div>
                                        </div>
                                        <input name="birthday" type="text"
                                            class="form-control hasdatetimepicker @error('birthday') is-invalid @enderror"
                                            placeholder="YYYY/MM/DD"
                                            value="{{ Auth::guard('school')->user()->birthday }}">
                                    </div>
                                    <div id="birthday-js-error-valid"></div>

                                    @error('birthday')
                                    <span class="error-msg-form">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>

                                <div class="row mx-0">

                                    <div class="col-12 col-md-6 mb-2">
                                        <label class="form-label">{{ __('patientappo.country') }}
                                            <small>({{ __('basic.optional') }})</small></label>
                                        <select
                                            class="js-example-basic-single select2-hidden-accessible @error('country_id') is-invalid @enderror"
                                            name="country_id" required>
                                            @foreach ($countries as $item)
                                            <option @if (Auth::guard('school')->user()->country_id == $item->id)
                                                selected
                                                @endif value="{{
                                                $item->id
                                                }}">{{ $item->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <div id="country-js-error-valid"></div>

                                        @error('country_id')
                                        <span class="error-msg-form">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="col-12 col-md-6 mb-2">
                                        <label class="form-label">{{ __('patientappo.city') }}
                                            <small>({{ __('basic.optional') }})</small></label>
                                        <select
                                            class="js-example-basic-single select2-hidden-accessible @error('city_id') is-invalid @enderror"
                                            name="city_id" required>
                                            <option value="{{ Auth::guard('school')->user()->city->id }}" selected>
                                                {{ Auth::guard('school')->user()->city->name }}
                                            </option>
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

                                </div>


                                <div class="row mx-0">


                                    <div class="col-12 col-md-6 mb-2">
                                        <label class="form-label">{{ __('basic.region') }}
                                            <small>({{ __('basic.optional') }})</small></label>
                                        <select
                                            class="js-example-basic-single select2-hidden-accessible @error('region_id') is-invalid @enderror"
                                            name="region_id" required>
                                            <option value="{{ Auth::guard('school')->user()->region->id }}" selected>
                                                {{ Auth::guard('school')->user()->region->name }}
                                            </option>
                                        </select>

                                        <div id="region-js-error-valid"></div>

                                        @error('region_id')
                                        <span class="error-msg-form">
                                            {{ $message }}
                                        </span>
                                        @enderror

                                    </div>

                                    <div class="col-12 col-md-6 mb-2">
                                        <label class="form-label">{{ __('patientappo.know us') }}
                                            <small>({{ __('basic.optional') }})</small></label>
                                        <select
                                            class="js-example-basic-single select2-hidden-accessible select2-no-search @error('from_recourse_id') is-invalid @enderror"
                                            name="from_recourse_id">
                                            @foreach ($resources as $item)
                                            <option @if (Auth::guard('school')->user()->from_recourse_id == $item->id)
                                                selected
                                                @endif value="{{
                                                $item->id }}">{{ $item->name }}
                                            </option>
                                            @endforeach
                                        </select>

                                        <div id="from-recourse-js-error-valid"></div>

                                        @error('from_recourse_id')
                                        <span class="error-msg-form">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                </div>


                            </div>

                        </div>
                    </div>


            </div>

            <div class="d-flex justify-content-end mt-4 mb-2">
                <input type="submit" name="next" class="next-form-steps btn btn-primary action-button-next"
                    value="{{ __('basic.update') }}">
            </div>

            </form>
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