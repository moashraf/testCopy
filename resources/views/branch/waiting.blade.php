@extends('layouts.master')

@section('title', 'Queue')

@section('title', 'Queue | Lam - School Management App')

@section('title-topbar', 'Queue')

<!-- css insert -->
@section('css')

<!-- Load Facebook SDK for JavaScript -->
<div id="fb-root"></div>
<script async defer src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.2"></script>


<!-- tables -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.2/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/autofill/2.3.9/css/autoFill.bootstrap5.min.css">

@endsection

<!-- content insert -->
@section('content')
<div class="container-fluid px-2">


    <div class="row">


        <div class="col-12">

            <div class="card card-input shadow h-100">

                <!-- Card Body -->
                <div class="card-body overflow-scroll position-relative">

                    <div class="col-12 px-5 position-absolute p-4" id="waiting_place"
                        style="z-index: 8;bottom: 120px;left: 0;">

                    </div>

                    <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-bs-ride="carousel"
                        data-bs-pause="false" data-bs-interval="5000">
                        <div class="carousel-indicators dots-radius-carousel">
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0"
                                class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                                aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                                aria-label="Slide 3"></button>
                        </div>
                        <div class="carousel-inner">
                            <div class="carousel-item active" data-bs-interval="800000">

                                <div class="fb-video"
                                    data-href="https://www.facebook.com/dramrsaeed/videos/367365894911466/"
                                    data-width="1200" data-show-text="false" data-autoplay="true">
                                    <blockquote cite="https://www.facebook.com/dramrsaeed/videos/216180993816935/"
                                        class="fb-xfbml-parse-ignore"><a
                                            href="https://www.facebook.com/dramrsaeed/videos/216180993816935/"></a>
                                    </blockquote>
                                </div>

                            </div>
                            <div class="carousel-item">
                                asdasd
                            </div>
                            <div class="carousel-item">
                                asdasd
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>


    </div>


    @endsection

    <!-- js insert -->
    @section('js')


    <script>
        $(document).ready(function() {

                //--------------------- fetch appoingtments -------------------

                waiting_ajax();

                sound_once = 0;

                function waiting_ajax() {

                    $.ajax({
                        url: '{{ route('sett.app_witing_branch_data') }}',
                        type: "GET",
                        dataType: "json",
                        success: function(data) {

                            if (data.length > 0) {

                                var html = ''

                                $.each(data, function(key, value) {

                                    var url_show = "{{ URL::asset('img/useravatar/') }}" +
                                        "/" +
                                        value.patient.avatar;

                                    if (value.status == 3) {

                                        if (value.queue_show == 0 && sound_once == 0) {

                                            audio =
                                                '<audio autoplay><source src="{{ URL::asset('sound/next_patient_ar_amr.wav') }}" type="audio/wav">Your browser does not support the audio element.</audio>';

                                            sound_once = '1';

                                            queue_show_update(value.id);

                                        } else {
                                            audio = "";
                                        }


                                        html +=
                                            '<div class="d-flex justify-content-between align-items-center shadow b-r-s-cont bg-white overflow-scroll p-3 mb-3" style="box-shadow: -5px 6px 12px 15px rgb(0 0 0 / 44%) !important;">' +
                                            '<div class="d-flex align-items-center text-truncate"><img class="rounded-circle avatar-m2 me-3" src="' +
                                            url_show + '">' +
                                            '<div class="text-truncate">' +
                                            '<p class="mb-0 text-xs text-gray-300"> Patient</p> ' +
                                            '<h5 class="mb-1 fw-bold text-gray-600 text-truncate">' +
                                            value.patient.name + '</h5>' +
                                            '<p class="mb-0 text-xs text-gray-400">ID <strong>' +
                                            value.patient.id + '</strong>' +
                                            '</p>' +
                                            '</div>' +
                                            '</div>' +
                                            '<div class="text-end mb-0 fw-normal"> <span class="text-gray-500 me-1">With Doctor</span>' +
                                            '<div class="spinner-grow spinner-grow-sm text-danger" role="status">' +
                                            '<span class="sr-only">Loading...</span></div>' +
                                            audio +
                                            '</div></div>'
                                    } else {

                                        if (value.status == 2) {
                                            text_color = 'timeslots_appointment_arrived';
                                            msg = 'Arrived';
                                        } else if (value.status == 3) {
                                            text_color = 'timeslots_appointment_done';
                                            msg = 'Done';
                                        }


                                        html +=
                                            '<div id="weekly_calendar_fetch_pat" class="' +
                                            text_color +
                                            ' d-flex text-center mb-2 align-items-center rounded-pill shadow justify-content-between" style="box-shadow: -5px 6px 12px 15px rgb(0 0 0 / 44%) !important;">' +
                                            '<div class="d-flex align-items-center "><img class="rounded-circle avatar-small me-2" src="' +
                                            url_show + '">' +
                                            '<div class="">' +
                                            '<h5 class="text-s2 mb-0 fw-normal ">' + value.patient
                                            .name + '</h5>' +
                                            '</div> </div>' +
                                            '<h6 class="text-xs text-end mb-0 fw-normal ">' + msg +
                                            '</h6>' +
                                            '</div>';
                                    }

                                })

                                sound_once = '0';

                                $('#waiting_place').html(html);

                            } else {
                                $('#waiting_place').html(
                                    '<div class="text-center text-gray-400">' +
                                    '<div><i class="far fa-laugh-wink fs-3 mb-1"></i></div>' +
                                    'No Next Appointment</div>');
                            }


                        }


                    })


                    timer = setTimeout(function() {
                        waiting_ajax();
                    }, 90000);

                };


                //reinsert the calander when the date paicker are changed
                function queue_show_update(id) {

                    appointment_id = id;

                    var url = "{{ route('sett.app_queue_show_update', ':id') }}";
                    url = url.replace(':id', appointment_id);

                    console.log(appointment_id);
                    $.ajax({
                        url: url,
                        type: "POST",
                        data: {
                            '_token': "{{ csrf_token() }}",
                            '_method': "PATCH",
                            'status': 1,
                        },
                        success: function(data) {
                            if (data.querystatue == true) {}
                        }
                    });

                }

            });
    </script>







    @endsection