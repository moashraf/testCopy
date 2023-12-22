@extends('layouts.master')

@section('title', 'Rate | Lam - School Management App')

@section('title-topbar', 'Rate')

<!-- css insert -->
@section('css')

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
<div class="container-fluid px-2 mt-3">

    <div class="row mb-2 position-relative">

        <!-- showing waiting during ajax performance -->
        <div id="waiting" class="w-100 h-100 text-center"
            style="position: absolute; top:0px; left:0px;z-index:999999; background-color: #ffffffba;">
            <div class="spinner-grow text-primary" role="status"
                style="position: relative; top: 50%; transform: translateY(-50%);">
                <span class="sr-only">Loading...</span>
            </div>
        </div>

        <div id="store_rate_ajax" style="display: none;">


            <div class="row align-items-center shadow b-r-s-cont bg-white overflow-scroll p-4 mb-3">

                <div>
                    <a id="go_back_rate" class="text-gray-400 h4 clickable-item-pointer"><i
                            class="fas fa-arrow-left"></i></a>
                </div>

                <form class="mb-0" action="{{ route('sett.rate_appo.store') }}" method="POST" style="display: contents">

                    @csrf
                    @method('POST')

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
                    </div>

                    <div class="col-6 mb-2 text-center">
                        <label class="form-label">{{ __('basic.time') }}
                            <small>({{ __('basic.optional') }})</small></label>

                        <div class="rating text-center">
                            <input id="rate-time-5" type="radio" name="rate_time" value="5" /><label
                                for="rate-time-5"><i class="fas fa-star"></i></label>
                            <input id="rate-time-4" type="radio" name="rate_time" value="4" /><label
                                for="rate-time-4"><i class="fas fa-star"></i></label>
                            <input id="rate-time-3" type="radio" name="rate_time" value="3" /><label
                                for="rate-time-3"><i class="fas fa-star"></i></label>
                            <input id="rate-time-2" type="radio" name="rate_time" value="2" /><label
                                for="rate-time-2"><i class="fas fa-star"></i></label>
                            <input id="rate-time-1" type="radio" name="rate_time" value="1" /><label
                                for="rate-time-1"><i class="fas fa-star"></i></label>
                        </div>
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
                    </div>

                    <div class="col-6 mb-4">
                        <label class="form-label">{{ __('basic.note') }}
                            <small>({{ __('basic.optional') }})</small></label>
                        <textarea name="rate_note" class="form-control"
                            placeholder="Write here your the patient note .." rows="4" spellcheck="false"></textarea>
                    </div>

                    <div class="col-12 text-center">
                        <button type="submit" data-bs-toggle="modal" data-bs-target="#patient_note38"
                            class="main-color-bg text-white btn btn-sm shadow-sm b-r-l-cont p-2 px-4 rate-appointment"><i
                                class="fas fa-paper-plane fa-sm me-1"></i> SEND</button>
                    </div>

                    <input id="appointment_id" name="appointment_id_input" type="hidden">

                    <input name="rate_type" value="1" type="hidden">

                </form>
            </div>
        </div>

        <div class="col-12" id="rate-cont-ajax">
            Loding ..
        </div>
    </div>



</div>

@endsection

<!-- js insert -->
@section('js')

<script>
    $(document).ready(function() {

            //for showing loading icon until the ajax is done
            $(document).ajaxStart(function() {
                $("#waiting, #waiting2").show();
            });

            $(document).ajaxStop(function() {
                $("#waiting, #waiting2").hide();
            });


            //--------------------- fetch appointments rates -------------------

            rate_ajax();

            function rate_ajax() {

                $.ajax({
                    url: '{{ route('sett.app_rate_show') }}',
                    type: "GET",
                    dataType: "json",
                    success: function(data) {

                        if (data.length > 0) {

                            var html = ''

                            $.each(data, function(key, value) {
                                var url_show =
                                    "{{ URL::asset('img/useravatar/') }}" +
                                    "/" +
                                    value.patient.avatar;

                                html +=
                                    '<div class="row align-items-center shadow b-r-s-cont bg-white overflow-scroll p-4 mb-3">' +

                                    '<div class="col-5 d-flex align-items-center">' +
                                    '<img class="rounded-circle avatar-m2 me-3" src="' +
                                    url_show + '">' +
                                    '<div class="">' +
                                    '<p class=" mb-0 text-xs text-gray-300">Patient</p>' +
                                    '<h6 class="mb-1 fw-bold text-gray-600">' +
                                    value.patient.name +
                                    '</h6>' +
                                    '<p class="mb-0 text-xs text-gray-400">ID <strong>' +
                                    +value.patient.id +
                                    '</strong></p>' +
                                    '</div></div>' +

                                    '<div class="col text-center">' +
                                    '<h6 class="text-gray-300 text-xs mb-1">Appointment time</h6>' +
                                    '<h6 class="text-s text-gray-400 text-truncate">' +
                                    value
                                    .start_at +
                                    '</h6></div>' +

                                    '<div class="col text-center mt-3 mt-md-0">' +
                                    '<a data-id="' + value.id +
                                    '" class="click-rate active-color-btn btn btn-sm shadow-sm b-r-l-cont p-2 px-4"><i class="fas fa-star-half-alt fa-sm me-1"></i> Rate</a>' +
                                    '</div>' +

                                    '</div>'
                            })

                            $('#rate-cont-ajax').html(html);
                        } else {
                            $('#rate-cont-ajax').html(
                                '<div class="text-center text-gray-400">' +
                                '<div><i class="bi bi-brightness-alt-high-fill fs-3 mb-1"></i></div>' +
                                'No Appointment to rate</div>');
                        }
                    }

                })

                timer = setTimeout(function() {
                    rate_ajax();
                }, 20000);

            };


            $(document).on('click', '#go_back_rate', function() {
                rate_ajax()
                $('#store_rate_ajax').hide();
                $('#rate-cont-ajax').show();
            })

            $(document).on('click', '.click-rate', function() {
                var id = $(this).data("id");
                $('#rate-cont-ajax').hide();
                $('#store_rate_ajax').show();
                $('#appointment_id').val(id);
            })


        });
</script>

@endsection