@extends('layouts.land.master_top')

@section('title', 'Register - Pain Cure | Dr. Amr Saeed')

<!-- css insert -->
@section('css')

<!-- select 2 -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/css/select2.min.css"
    integrity="sha512-aD9ophpFQ61nFZP6hXYu4Q/b/USW7rpLCQLX6Bi0WJHXNO7Js/fUENpBQf/+P4NtpzNX0jSgR5zVvPOJp+W2Kg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

<!-- animate.css -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

<link rel="stylesheet" href="{{ URL::asset('plugins/owl/owl.carousel.min.css') }}">

@endsection


<!-- session successful message -->
@if (Session::has('success'))
<div id="flash-msg" class="shadow pt-3">
    <div class="d-flex justify-content-between mb-2">
        <i class="fas fs-1 fa-check"></i>
        <a id="flash-msg-btn" class="text-blue-300 clickable-item-pointer"><i class="fas fa-times"></i></a>
    </div>
    <h3>Sent Successfully</h3>
    <p class="text-blue-300">{{ Session::get('success') }}</p>
</div>
@endif


<!-- content insert -->
@section('content')
<div class="bradcam_area breadcam_bg bradcam_overlay"
    style="background-image: url('{{ asset('img/dashboard/system/landing/bradcam.jpg') }}'); padding:87px;">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="text-white">
                    <h1>Rate Your Appointment</h1>
                    <p><a class="text-gray-200" href="{{ route('landing') }}">Home /</a> Rate Appointment</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container bg-white position-relative b-r-s-cont p-3 shadow" style="margin-top: -84px; z-index:9;">

    @if ($status == 1)
    <div class="row d-flex justify-content-around align-items-center my-2 px-1 px-md-5">

        <div class="col-8 col-md-4 d-flex align-items-center mb-3 mb-md-0">
            <img id="avatar_final_info" class="rounded-circle avatar-m me-3"
                src="{{ URL::asset('img/useravatar/' . $appointment->patient->avatar) }}">
            <div class="">
                <p class=" mb-0 text-xs text-gray-300">
                    {{ date('d M Y', strtotime($appointment->start_at)) }}</p>
                <a href="{{ route('sett.managers.show', $appointment->id) }}" id="name_final_info"
                    class="mb-1 fw-bold text-gray-600 fs-6">
                    {{ $appointment->patient->name }}
                </a>
                <p id="number_final_info" class="mb-0 text-xs text-gray-400">
                    {{ $appointment->patient->phone_number }}</p>
            </div>
        </div>

        <div class="col-4 col-md-2">
            <h6 class="text-gray-300 text-xs mb-1">{{ __('basic.branch') }}</h6>
            <p id="branch_final_info" class="text-gray-600 text-s fw-bold">
                {{ $appointment->branch->name }}</p>
        </div>

        <div class="col-4 col-md-2">
            <h6 class="text-gray-300 text-xs mb-1">{{ __('basic.doctor') }}</h6>
            <p id="addre_final_info" class="text-gray-600 text-s fw-bold">
                @if ($appointment->doctor)
                {{ $appointment->doctor->name }}
                @else
                No Doctor
                @endif
            </p>
        </div>

        <div class="col-4 col-md-2">
            <h6 class="text-gray-300 text-xs mb-1">{{ __('basic.creator') }}</h6>
            <p id="addre_final_info" class="text-gray-600 text-s fw-bold">
                {{ $appointment->creator->name }}</p>
        </div>

        <div class="col-4 col-md-2">
            <div class="visible-print text-center">
                {!! QrCode::color(68, 95, 129)->size(60)->style('round')->eye('circle')->generate($appointment->code)
                !!}
                <p class="mt-1 mb-0 text-xs fw-bold text-gray-300">{{ $appointment->code }}</p>
            </div>
        </div>
    </div>

    <hr>

    <div class="px-2 px-lg-5 mt-4">

        @if (in_array($appointment->status, [2, 3, 4]))
        <form class="mb-0" action="{{ route('school_route.land_rate_appo_public_store') }}" method="POST"
            style="display: contents">

            @csrf
            @method('POST')

            <input id="appointment_code_input" name="appointment_code_input" type="hidden"
                value="{{ request()->code }}">
            <input name="rate_type" type="hidden" value="1">

            <div class="row mb-2">

                <div class="col-6 mb-2 text-center">
                    <label class="form-label">{{ __('basic.service') }}
                        <small>({{ __('basic.optional') }})</small></label>

                    <div class="rating">
                        <input id="rate-service-5" type="radio" name="rate_service" value="5" /><label
                            for="rate-service-5"><i class="fas fa-star"></i></label>
                        <input id="rate-service-4" type="radio" name="rate_service" value="4" /><label
                            for="rate-service-4"><i class="fas fa-star"></i></label>
                        <input id="rate-service-3" type="radio" name="rate_service" value="3" /><label
                            for="rate-service-3"><i class="fas fa-star"></i></label>
                        <input id="rate-service-2" type="radio" name="rate_service" value="2" /><label
                            for="rate-service-2"><i class="fas fa-star"></i></label>
                        <input id="rate-service-1" type="radio" name="rate_service" value="1" /><label
                            for="rate-service-1"><i class="fas fa-star"></i></label>
                    </div>
                    <span id="rate_service" class="error-msg-form"></span>

                    @error('rate_service')
                    <span class="error-msg-form">
                        {{ $message }}
                    </span>
                    @enderror
                </div>

                <div class="col-6 mb-2 text-center">
                    <label class="form-label">{{ __('basic.doctors') }}
                        <small>({{ __('basic.optional') }})</small></label>

                    <div class="rating text-center">
                        <input id="rate-doctor-5" type="radio" name="rate_doctor" value="5" /><label
                            for="rate-doctor-5"><i class="fas fa-star"></i></label>
                        <input id="rate-doctor-4" type="radio" name="rate_doctor" value="4" /><label
                            for="rate-doctor-4"><i class="fas fa-star"></i></label>
                        <input id="rate-doctor-3" type="radio" name="rate_doctor" value="3" /><label
                            for="rate-doctor-3"><i class="fas fa-star"></i></label>
                        <input id="rate-doctor-2" type="radio" name="rate_doctor" value="2" /><label
                            for="rate-doctor-2"><i class="fas fa-star"></i></label>
                        <input id="rate-doctor-1" type="radio" name="rate_doctor" value="1" /><label
                            for="rate-doctor-1"><i class="fas fa-star"></i></label>
                    </div>
                    <span id="rate_doctor" class="error-msg-form"></span>

                    @error('rate_doctor')
                    <span class="error-msg-form">
                        {{ $message }}
                    </span>
                    @enderror
                </div>

                <div class="col-6 mb-2 text-center">
                    <label class="form-label">{{ __('basic.reception') }}
                        <small>({{ __('basic.optional') }})</small></label>

                    <div class="rating text-center">
                        <input id="rate-reception-5" type="radio" name="rate_reception" value="5" /><label
                            for="rate-reception-5"><i class="fas fa-star"></i></label>
                        <input id="rate-reception-4" type="radio" name="rate_reception" value="4" /><label
                            for="rate-reception-4"><i class="fas fa-star"></i></label>
                        <input id="rate-reception-3" type="radio" name="rate_reception" value="3" /><label
                            for="rate-reception-3"><i class="fas fa-star"></i></label>
                        <input id="rate-reception-2" type="radio" name="rate_reception" value="2" /><label
                            for="rate-reception-2"><i class="fas fa-star"></i></label>
                        <input id="rate-reception-1" type="radio" name="rate_reception" value="1" /><label
                            for="rate-reception-1"><i class="fas fa-star"></i></label>
                    </div>

                    <span id="rate_reception" class="error-msg-form"></span>

                    @error('rate_reception')
                    <span class="error-msg-form">
                        {{ $message }}
                    </span>
                    @enderror
                </div>

                <div class="col-6 mb-2 text-center">
                    <label class="form-label">{{ __('basic.time') }}
                        <small>({{ __('basic.optional') }})</small></label>

                    <div class="rating text-center">
                        <input id="rate-time-5" type="radio" name="rate_time" value="5" /><label for="rate-time-5"><i
                                class="fas fa-star"></i></label>
                        <input id="rate-time-4" type="radio" name="rate_time" value="4" /><label for="rate-time-4"><i
                                class="fas fa-star"></i></label>
                        <input id="rate-time-3" type="radio" name="rate_time" value="3" /><label for="rate-time-3"><i
                                class="fas fa-star"></i></label>
                        <input id="rate-time-2" type="radio" name="rate_time" value="2" /><label for="rate-time-2"><i
                                class="fas fa-star"></i></label>
                        <input id="rate-time-1" type="radio" name="rate_time" value="1" /><label for="rate-time-1"><i
                                class="fas fa-star"></i></label>
                    </div>

                    <span id="rate_time" class="error-msg-form"></span>

                    @error('rate_time')
                    <span class="error-msg-form">
                        {{ $message }}
                    </span>
                    @enderror
                </div>

                <div class="col-6 mb-2 text-center">
                    <label class="form-label">{{ __('basic.cleanliness') }}
                        <small>({{ __('basic.optional') }})</small></label>

                    <div class="rating text-center">
                        <input id="rate-clean-5" type="radio" name="rate_cleanliness" value="5" /><label
                            for="rate-clean-5"><i class="fas fa-star"></i></label>
                        <input id="rate-clean-4" type="radio" name="rate_cleanliness" value="4" /><label
                            for="rate-clean-4"><i class="fas fa-star"></i></label>
                        <input id="rate-clean-3" type="radio" name="rate_cleanliness" value="3" /><label
                            for="rate-clean-3"><i class="fas fa-star"></i></label>
                        <input id="rate-clean-2" type="radio" name="rate_cleanliness" value="2" /><label
                            for="rate-clean-2"><i class="fas fa-star"></i></label>
                        <input id="rate-clean-1" type="radio" name="rate_cleanliness" value="1" /><label
                            for="rate-clean-1"><i class="fas fa-star"></i></label>
                    </div>

                    <span id="rate_cleanliness" class="error-msg-form"></span>

                    @error('rate_cleanliness')
                    <span class="error-msg-form">
                        {{ $message }}
                    </span>
                    @enderror
                </div>
                <div class="col-6 mb-2">
                    <label class="form-label">{{ __('basic.note') }}
                        <small>({{ __('basic.optional') }})</small></label>
                    <textarea name="rate_note" class="form-control" placeholder="Write here your the patient note .."
                        rows="4" spellcheck="false"></textarea>

                    @error('rate_note')
                    <span class="error-msg-form">
                        {{ $message }}
                    </span>
                    @enderror
                </div>

            </div>

            <div class="d-flex justify-content-center mt-3">
                <input type="submit" name="submit" class="next-form-steps btn btn-primary px-5" value="Send">
            </div>
        </form>
        @elseif ($appointment->status == 6)
        <form class="mb-0" action="{{ route('school_route.land_rate_appo_public_store') }}" method="POST"
            style="display: contents">

            @csrf
            @method('POST')

            <input id="appointment_code_input" name="appointment_code_input" type="hidden"
                value="{{ request()->code }}">

            <input name="rate_type" type="hidden" value="2">

            <div class="row justify-content-center">
                <div class="col-12 col-md-6">
                    <div class="row mb-2">

                        <div class="col-12 mb-2">
                            <label class="form-label">Why did you cancel your appointment?
                                <small>(required)</small></label>
                            <select class="myselect2-insert-nosearch select2-hidden-accessible" name="reason" required>
                                @foreach ($cancel_reasons as $item)
                                <option value="{{ $item->id }}">
                                    {{ $item->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-12">
                            <label class="form-label">{{ __('basic.note') }}
                                <small>({{ __('basic.optional') }})</small></label>
                            <textarea name="rate_note" class="form-control"
                                placeholder="Write here your the patient note .." rows="4"
                                spellcheck="false"></textarea>

                            @error('rate_note')
                            <span class="error-msg-form">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>

                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-center mt-3">
                <input type="submit" name="submit" class="next-form-steps btn btn-primary px-5" value="Send">
            </div>
    </div>

    </form>
    @else
    <div class="p-5 text-center text-gray-400">
        <i class="bi bi-brightness-alt-high-fill fs-1"></i>
        <h3>Sorry, You can not rate this appointment</h3>
    </div>
    @endif

</div>
@else
<div class="p-5 text-center text-gray-400">
    <i class="bi bi-brightness-alt-high-fill fs-1"></i>
    <h3>Sorry, You have rated this appointment before</h3>
</div>
@endif


</div>

@endsection

<!-- js insert -->
@section('js')
<!-- select 2 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/js/select2.min.js"
    integrity="sha512-4MvcHwcbqXKUHB6Lx3Zb5CEAVoE9u84qN+ZSMM6s7z8IeJriExrV3ND5zRze9mxNlABJ6k864P/Vl8m0Sd3DtQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function() {
            $('.myselect2-insert-nosearch').select2({
                minimumResultsForSearch: -1
            });
        });
</script>
@endsection