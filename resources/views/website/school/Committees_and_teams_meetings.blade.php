@extends('website.school.layouts.master', ['no_header' => true, 'no_transparent_header' => false])

@section('title', 'الصفحة الرئيسية لمدرستك في منصة لام | منصة لام')
@section('topbar', 'الصفحة الرئيسية لمدرستك في منصة لام | منصة لام')

<!-- css insert -->
@section('css')

    <!-- swiper -->
    <link rel="stylesheet" href="https://fastly.jsdelivr.net/npm/swiper/swiper-bundle.min.css" />

@endsection


@section('fixedcontent')

    <div class="position-fixed main-color-bg text-white p-2 px-3 z-3 clickable-item-pointer" id="video_toutrial_cont"
         data-bs-toggle="modal" data-bs-target="#video_toutrial_modal"
         style="top: 18%; left:0%; border-radius: 0px 10px 10px 0px;">
        <div class="d-flex">
            <i class="fas fa-video me-2"></i>
            <h6 id="video_toutrial_modal_text" class="mb-0 text-s" style="display: none">شرح الصفحة الرئيسية </h6>
        </div>
    </div>


    <!-- Modal for search filtering -->
    <div class="modal fade" id="video_toutrial_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">

            <div class="modal-content b-r-s-cont border-0">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="exampleModalLabel">
                        شرح الصفحة الرئيسية
                    </h5>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
                </div>

                <!-- Modal content -->
                <div class="modal-body px-5 py-3">
                    <div class="text-center">
                        <iframe class="col-12" width="560" height="315" src="{{ $video_tutorial->url }}"
                                title="YouTube video player" frameborder="0"
                                allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<!-- content insert -->
@section('content')

    <div class="container-fluid px-4 px-md-5 py-3 py-md-4">


        <div class="row">

            <div class="col-12 mb-3 mb-md-0">
                <div class="main_cot_bg p-3 py-3 h-100">
                    <h5 class="fw-bold text-s2">الوصول السريع</h5>
                    <p class="text-gray-300 text-xs">يمكنك الذهاب مباشرة للمنصات التي تهمك</p>


                    <div class="row">
                        <div class="col-12 col-md-3 mb-3 mb-md-0">
                            <div
                                class="d-flex justify-content-between border_radius_10 border-gray-600 align-items-center p-2">
                                <img class="me-2" alt="school" src="{{ URL::asset('img/external_systems/system_1.png') }}">
                                <a href="#" target="__blank">
                                    <button type="button" class="main_btn border_radius_5 text-xxs px-2 py-1 mb-0" style="height: 40px;font-size: 12px;
                                "><i class="fas fa-share-square me-1"></i>
                                        الذهاب الآن</button>
                                </a>
                            </div>
                        </div>
                        <div class="col-12 col-md-3 mb-3 mb-md-0">
                            <div
                                class="d-flex justify-content-between border_radius_10 border-gray-600 align-items-center p-2">
                                <img class="me-2" width="60" alt="school"
                                     src="{{ URL::asset('img/external_systems/system_2.png') }}">
                                <a href="#" target="__blank">
                                    <button type="button" class="main_btn border_radius_5 text-xxs px-2 py-1 mb-0" style="height: 40px;font-size: 12px;
                                "><i class="fas fa-share-square me-1"></i>
                                        الذهاب الآن</button>
                                </a>
                            </div>
                        </div>
                        <div class="col-12 col-md-3 mb-3 mb-md-0">
                            <div
                                class="d-flex justify-content-between border_radius_10 border-gray-600 align-items-center p-2">
                                <img class="me-2" width="95" alt="school"
                                     src="{{ URL::asset('img/external_systems/system_3.png') }}">
                                <a href="#" target="__blank">
                                    <button type="button" class="main_btn border_radius_5 text-xxs px-2 py-1 mb-0" style="height: 40px;font-size: 12px;
                                "><i class="fas fa-share-square me-1"></i>
                                        الذهاب الآن</button>
                                </a>
                            </div>
                        </div>
                        <div class="col-12 col-md-3">
                            <div
                                class="d-flex justify-content-between border_radius_10 border-gray-600 align-items-center p-2">
                                <img class="me-2" alt="school" width="95"
                                     src="{{ URL::asset('img/external_systems/system_4.png') }}">
                                <a href="#" target="__blank">
                                    <button type="button" class="main_btn border_radius_5 text-xxs px-2 py-1 mb-0" style="height: 40px;font-size: 12px;
                                "><i class="fas fa-share-square me-1"></i>
                                        الذهاب الآن</button>
                                </a>
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

    {{-- swiper --}}
    <script src="https://fastly.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
    <script>
        var full_height_width_slider_swiper_weekly = new Swiper(".full_height_width_slider_swiper_weekly", {
            pagination: {
                el: ".swiper-pagination",
            },
            autoplay: {
                delay: 5000,
            },
            loop: true,
            touchEventsTarget: 'container',
        });


        // Calendar
        fetchCalander();

        function fetchCalander(month = {{ date('m') }}, year = {{ date('Y') }}) {

            var url =
                "{{ route('school_route.calander_tasks_ajax', [':month', ':year']) }}";
            url = url.replace(':month', month).replace(':year', year)
            ;
            $.ajax({
                url: url,
                type: "GET",
                success: function(data) {
                    $("#calander_cont").html(data);
                }
            });
        }

        //reinsert the calander when the month arrows are clicked
        $(document).on('click', '#change_month', function() {
            var month = $(this).data('month');
            var year = $(this).data('year');
            fetchCalander(month, year)
        });
    </script>



@endsection
