@extends('layouts.land.master_top')

@section('title', 'Blogs - Pain Cure | Dr. Amr Saeed')

<!-- css insert -->
@section('css')

    <!-- animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <link rel="stylesheet" href="{{ URL::asset('plugins/owl/owl.carousel.min.css') }}">


@endsection

<!-- content insert -->
@section('content')

    <div class="bradcam_area breadcam_bg bradcam_overlay"
        style="background-image: url('{{ asset('img/dashboard/system/landing/bradcam4.jpg') }}')">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="text-white">
                        <h1>Blogs</h1>
                        <a class="text-gray-200" href="{{ route('landing') }}">Home /</a> Blogs</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container bg-white position-relative b-r-s-cont p-5 shadow" style="margin-top: -40px; z-index:9;">

        <div class="mb-4">
            <h2 class="text-green-ligh"><i class="fas fa-video"></i> Watch US</h2>
            <div class="hr-land text-green-ligh-bg mb-4"></div>
            <iframe id="video_modal_iframe" class="w-100" height="415"
                src="https://www.youtube.com/embed/IGTd7xFca4A" title="YouTube video player" frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen></iframe>
        </div>
        <h4 class=" text-petroleum mb-4">Watch More <i class="fas fa-chevron-right ms-1"></i></h4>
        <div class="row">

            <div class="col-12">

                <div class="owl-carousel owl-theme owl-loaded owl-video-land">

                    <div class="item d-flex justify-content-center shadow pb-5 position-relative"
                        style="background-image: url('{{ asset('img/dashboard/system/landing/vid-1.jpg') }}'); background-size: cover; width:100%; height: 152px;">
                        <div class="overlay-video"></div>
                        <div class="rounded-circle text-green-ligh-bg mb-2 p-3 d-flex align-items-center justify-content-center shadow clickable-item-pointer click_modal_video_iframe"
                            data-video_url="https://www.youtube.com/embed/1bxxS9_2_1g"
                            style="width: 50px;height: 50px;position: absolute;z-index: 5;  top: 50%; left: 50%; transform: translate(-50%, -50%);">
                            <i class="fas fa-play fs-5 text-white"></i>
                        </div>
                    </div>
                    <div class="item d-flex justify-content-center shadow pb-5 position-relative "
                        style="background-image: url('{{ asset('img/dashboard/system/landing/vid-2.jpg') }}'); background-size: cover; width:100%; height: 152px;">
                        <div class="overlay-video"></div>
                        <div class="rounded-circle text-green-ligh-bg mb-2 p-3 d-flex align-items-center justify-content-center shadow clickable-item-pointer click_modal_video_iframe"
                            data-video_url="https://www.youtube.com/embed/WpHzgbOuVJ8"
                            style="width: 50px;height: 50px;position: absolute;z-index: 5;  top: 50%; left: 50%; transform: translate(-50%, -50%);">
                            <i class="fas fa-play fs-5 text-white"></i>
                        </div>
                    </div>
                    <div class="item d-flex justify-content-center shadow pb-5 position-relative "
                        style="background-image: url('{{ asset('img/dashboard/system/landing/vid-3.jpg') }}'); background-size: cover; width:100%; height: 152px;">
                        <div class="overlay-video"></div>
                        <div class="rounded-circle text-green-ligh-bg mb-2 p-3 d-flex align-items-center justify-content-center shadow clickable-item-pointer click_modal_video_iframe"
                            data-video_url="https://www.youtube.com/embed/KYhP5SXWC4k"
                            style="width: 50px;height: 50px;position: absolute;z-index: 5;  top: 50%; left: 50%; transform: translate(-50%, -50%);">
                            <i class="fas fa-play fs-5 text-white"></i>
                        </div>
                    </div>
                    <div class="item d-flex justify-content-center shadow pb-5 position-relative "
                        style="background-image: url('{{ asset('img/dashboard/system/landing/vid-4.jpg') }}'); background-size: cover; width:100%; height: 152px;">
                        <div class="overlay-video"></div>
                        <div class="rounded-circle text-green-ligh-bg mb-2 p-3 d-flex align-items-center justify-content-center shadow clickable-item-pointer click_modal_video_iframe"
                            data-video_url="https://www.youtube.com/embed/r1I0be_s3_g"
                            style="width: 50px;height: 50px;position: absolute;z-index: 5;  top: 50%; left: 50%; transform: translate(-50%, -50%);">
                            <i class="fas fa-play fs-5 text-white"></i>
                        </div>
                    </div>
                    <div class="item d-flex justify-content-center shadow pb-5 position-relative"
                        style="background-image: url('{{ asset('img/dashboard/system/landing/vid-5.jpg') }}'); background-size: cover; width:100%; height: 152px;">
                        <div class="overlay-video"></div>
                        <div class="rounded-circle text-green-ligh-bg mb-2 p-3 d-flex align-items-center justify-content-center shadow clickable-item-pointer click_modal_video_iframe"
                            data-video_url="https://www.youtube.com/embed/21NKWXgpuG0"
                            style="width: 50px;height: 50px;position: absolute;z-index: 5;  top: 50%; left: 50%; transform: translate(-50%, -50%);">
                            <i class="fas fa-play fs-5 text-white"></i>
                        </div>
                    </div>

                    <div class="item d-flex justify-content-center shadow pb-5 position-relative"
                        style="background-image: url('{{ asset('img/dashboard/system/landing/vid-6.jpg') }}'); background-size: cover; width:100%; height: 152px;">
                        <div class="overlay-video"></div>
                        <div class="rounded-circle text-green-ligh-bg mb-2 p-3 d-flex align-items-center justify-content-center shadow clickable-item-pointer click_modal_video_iframe"
                            data-video_url="https://www.youtube.com/embed/I_qdEJaoNkQ"
                            style="width: 50px;height: 50px;position: absolute;z-index: 5;  top: 50%; left: 50%; transform: translate(-50%, -50%);">
                            <i class="fas fa-play fs-5 text-white"></i>
                        </div>
                    </div>

                    <div class="item d-flex justify-content-center shadow pb-5 position-relative"
                        style="background-image: url('{{ asset('img/dashboard/system/landing/vid-7.jpg') }}'); background-size: cover; width:100%; height: 152px;">
                        <div class="overlay-video"></div>
                        <div class="rounded-circle text-green-ligh-bg mb-2 p-3 d-flex align-items-center justify-content-center shadow clickable-item-pointer click_modal_video_iframe"
                            data-video_url="https://www.youtube.com/embed/rOADbCAPNzI"
                            style="width: 50px;height: 50px;position: absolute;z-index: 5;  top: 50%; left: 50%; transform: translate(-50%, -50%);">
                            <i class="fas fa-play fs-5 text-white"></i>
                        </div>
                    </div>


                    <div class="item d-flex justify-content-center shadow pb-5 position-relative"
                        style="background-image: url('{{ asset('img/dashboard/system/landing/vid-8.jpg') }}'); background-size: cover; width:100%; height: 152px;">
                        <div class="overlay-video"></div>
                        <div class="rounded-circle text-green-ligh-bg mb-2 p-3 d-flex align-items-center justify-content-center shadow clickable-item-pointer click_modal_video_iframe"
                            data-video_url="https://www.youtube.com/embed/jyYGeL0G6LA"
                            style="width: 50px;height: 50px;position: absolute;z-index: 5;  top: 50%; left: 50%; transform: translate(-50%, -50%);">
                            <i class="fas fa-play fs-5 text-white"></i>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>

@endsection

<!-- js insert -->
@section('js')


    <script src="{{ URL::asset('plugins/owl/owl.carousel.min.js') }}"></script>

    <script>
        $('.owl-carousel').owlCarousel({
            loop: true,
            margin: 0,
            responsiveClass: true,
            autoplaySpeed: 800,
            dots: false,
            nav: true,
            navText: ['<i class="fa fa-angle-left" aria-hidden="true"></i>',
                '<i class="fa fa-angle-right" aria-hidden="true"></i>'
            ],
            responsive: {
                0: {
                    items: 2,
                    nav: true
                },
                600: {
                    items: 3,
                    nav: true
                },
                1000: {
                    items: 4,
                    nav: true,
                    loop: true,
                }
            }
        })

        $(document).on('click', '.click_modal_video_iframe', function() {
            var url = $(this).data('video_url');
            $("#video_modal_iframe").attr("src", url);
        });
    </script>

@endsection
