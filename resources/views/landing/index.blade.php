@extends('layouts.land.master')

@section('title', 'Pain Cure | Dr. Amr Saeed for back pain treatment | دكتور عمرو سعيد لعلاج الالم')

<!-- css insert -->
@section('css')

<!-- animate.css -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

<link rel="stylesheet" href="{{ URL::asset('plugins/owl/owl.carousel.min.css') }}">

@endsection

<!-- content insert -->
@section('content')


<div id="noti_land_top" class=" text-green-ligh-bg-grad text-white py-3">
    <div class="container d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-light text-s3 "><i class="fas fa-tag me-2"></i>One of the best travel agencies in
            <span class=" fw-bold">Egypt<span>
        </h5>
        <a class="text-s mb-0" href="{{ route('school_route.appointment') }}"><button type="button"
                class="btn text-green-ligh-bg b-r-xs text-white">Book Now</button></a>
    </div>
</div>

<div class="px-2 px-md-5 position-relative"
    style="background-image: url('{{ asset('img/dashboard/system/landing/about-bg.jpg') }}'); background-size: cover;background-position: 60% 0%;">

    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light pt-3">
            <div class="container-fluid">
                <a class="navbar-brand  me-md-5" href="{{ route('landing') }}"> <img
                        src="{{ URL::asset('img/dashboard/system/pc-loader.png') }}" alt=""> </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse ms-5" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ route('landing') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('school_route.about') }}">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('school_route.blogs') }}">Blogs</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('school_route.appointment') }}">Appointment</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="{{ route('school_route.contact') }}">
                                Contact
                            </a>
                        </li>
                    </ul>

                    @auth('school')
                    <!-- Nav Item - User Information -->
                    <div class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle d-flex" href="#" id="userDropdown" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="img-profile rounded-circle avatar-small2"
                                src="{{ URL::asset('img/useravatar/' . Auth::guard('school')->user()->avatar) }}">
                            <div class="ms-2 my-auto">
                                <span class="text-gray-300 mb-0">Welcome</span>

                                <h6 class="text-gray-600 mb-0">{{ Auth::guard('school')->user()->first_name }}</h6>
                            </div>
                        </a>

                        <!-- Dropdown - User Information -->
                        <div class="dropdown-list-profile dropdown-menu border-0 dropdown-menu-right shadow animated--grow-in py-0"
                            aria-labelledby="userDropdown" style="width: min-content;">
                            <div class="dropdown-header bg-primary p-3 px-4"
                                style="background-color: #26a299 !important; ">
                                <div class="d-flex wd-100p">
                                    <div class="main-img-user">
                                        <img class="img-profile rounded-circle avatar-m" alt=""
                                            src="{{ URL::asset('img/useravatar/' . Auth::guard('school')->user()->avatar) }}"
                                            class="">
                                    </div>
                                    <div class="ms-3 my-auto">
                                        <h6 class="text-white fw-normal">
                                            {{ Auth::guard('school')->user()->first_name }}
                                        </h6>
                                        <span class="" style="color: #b0dfdb !important;">Patient
                                            Member</span>
                                    </div>
                                </div>
                            </div>
                            <a class="dropdown-item" href="{{ route('school_route.profile') }}">
                                <i class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i>
                                Medical Profile
                            </a>
                            <a class="dropdown-item" href="{{ route('school_route.appointment') }}">
                                <i class="fas fa-cogs fa-sm fa-fw me-2 text-gray-400"></i>
                                Edit Profile
                            </a>
                            <a class="dropdown-item" href="{{ route('school_route.appointment') }}">
                                <i class="bi bi-calendar-week-fill fa-sm fa-fw me-2 text-gray-400"></i>
                                Appointment
                            </a>
                            <a class="dropdown-item mb-2 border-bottom-0 " href="{{ route('school_route.logout') }}"
                                onclick="event.preventDefault();
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('school_route.logout') }}" method="POST"
                                class="d-none">
                                @csrf
                            </form>
                        </div>
                    </div>
                    @endauth

                    @guest('school')
                    <a class="text-s" href="{{ route('school_route.login') }}"><button type="button"
                            class="btn text-green-ligh-bg-grad b-r-xs text-white"><i class="fas fa-user me-1"></i> Login
                            | Register</button></a>
                    @endguest


                </div>
            </div>
        </nav>

        <div class="row" style="padding-top: 150px; padding-bottom: 190px;">

            <div
                class="col-12 col-md-5 align-self-center pt-3 pt-md-0 mb-3 mb-md-0 animate__animated animate__backInLeft animate__slow">

                <div id="carouselExampleDark" class="carousel carousel-dark slide carousel-fade" data-bs-ride="carousel"
                    data-bs-interval="5000">
                    <div class="carousel-indicators dots-radius-carousel-land" style="bottom:-93px;">
                        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active"
                            aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1"
                            aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2"
                            aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-inner">

                        <div class="carousel-item active">
                            <h1 class="text-petroleum2">
                                TAKE CARE OF YOUR
                                BACK <strong class="text-green-ligh">PAIN</strong>
                            </h1>
                            <p class="text-petroleum-light mb-4">
                                With one of the most famous doctor in Egypt, with
                                a profissional team works only for you to take care of you nack paim
                            </p>
                            <button type="button" class="btn text-green-ligh-bg-grad btn-lg b-r-xs"><a
                                    class="text-s2 text-white" href="{{ route('school_route.appointment') }}">
                                    Book Now</a></button>
                        </div>

                        <div class="carousel-item">
                            <h1 class="text-petroleum2">
                                YOUR BACK PAIN IS OUR <strong class="text-green-ligh">MISSION</strong>
                            </h1>
                            <p class="text-petroleum">
                                With one of the most famous doctor in Egypt, with
                                a profissional team works only for you to take care of you nack paim
                            </p>
                            <button type="button" class="btn text-green-ligh-bg-grad btn-lg b-r-xs"><a
                                    class="text-s2 text-white" href="{{ route('school_route.appointment') }}">
                                    Book Now</a></button>
                        </div>

                        <div class="carousel-item">
                            <h1 class="text-petroleum2">
                                DISCOVER OUR NEW <strong class="text-green-ligh">SYSTEM</strong>
                            </h1>
                            <p class="text-petroleum">
                                With one of the most famous doctor in Egypt, with
                                a profissional team works only for you to take care of you nack paim
                            </p>
                            <button type="button" class="btn text-green-ligh-bg-grad btn-lg b-r-xs"><a
                                    class="text-s2 text-white" href="{{ route('school_route.appointment') }}">
                                    Book Now</a></button>
                        </div>

                    </div>
                </div>

            </div>
            <div class="col-12 col-md-7 text-end">
            </div>

        </div>
    </div>
</div>

<div class="container" style="position: relative; top:-83px">
    <div class="row animate__animated animate__backInUp animate__delay-1s animate__slow">
        <div class="col-12 col-md px-5 py-3 me-3 mb-3 shadow b-r-s-cont bg-white text-center">
            <i class="bi bi-calendar2-range text-xl text-green-ligh" style="color: "></i>
            <h4 class="text-petroleum">Online Appoinment</h4>
            <p class="fw-light text-petroleum-light">Now with our new system you can book an appointment online in all
                our clinics</p>
        </div>

        <div class="col-12 col-md px-5 py-3 me-3 mb-3 shadow b-r-s-cont bg-white text-center">
            <i class="fas fa-suitcase-rolling text-xl text-green-ligh my-3"></i>
            <h4 class="text-petroleum">Advace Techology</h4>
            <p class="fw-light text-petroleum-light">a new system that enables you to get all your lab
                results, treatments, medicines, and Appointments online</p>
        </div>
        <div class="col-12 col-md px-5 py-3 mb-3 shadow b-r-s-cont bg-white text-center">
            <i class="bi bi-headset text-xl text-green-ligh"></i>
            <h4 class="text-petroleum">Call Center</h4>
            <p class="fw-light text-petroleum-light mb-1">Get you appointment through our Call Center
                medicine.</p>
            <h5 class="text-petroleum">02-2121-2122</h5>
        </div>
    </div>

</div>

<div id="serivces" class="container  wow fadeInUp animated">
    <div class="row align-items-center  mb-5">
        <div class="col-lg-3 col-sm-6 wow fadeInUp animated animate__backInDown">
            <div class="">
                <img src="{{ URL::asset('img/dashboard/system/landing/img-1.jpg') }}" alt="" class="img-fluid shadow">
                <img src="{{ URL::asset('img/dashboard/system/landing/img-2.jpg') }}" alt=""
                    class="img-fluid mt-4 shadow">
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="about-img mt-4 mt-lg-0">
                <img src="{{ URL::asset('img/dashboard/system/landing/img-3.jpg') }}" alt="" class="img-fluid shadow">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="about-content px-4 mt-4 mt-lg-0">
                <div class="hr-land text-green-ligh-bg"></div>
                <h1 class="text-petroleum">Personal care <br>&amp; healthy living</h1>
                <p class="mt-4 text-petroleum-light mb-2">We provide best leading medicle service Nulla perferendis
                    veniam deleniti
                    ipsum officia dolores repellat laudantium obcaecati neque.</p>

                <ul class="list-group border-0 ps-3 mb-4">
                    <li class="list-group-item border-0 text-petroleum-light"><i
                            class="fas fa-thermometer me-2 text-green-ligh"></i>
                        Laser Treatment
                    </li>
                    <li class="list-group-item border-0 text-petroleum-light"><i
                            class="fas fa-thermometer me-2 text-green-ligh"></i> No
                        surgery</li>
                    <li class="list-group-item border-0 text-petroleum-light"><i
                            class="fas fa-microscope me-2 text-green-ligh"></i>Continuous Testing</li>
                    <li class="list-group-item border-0 text-petroleum-light"><i
                            class="fas fa-heart me-2 text-green-ligh"></i> Safty
                    </li>
                </ul>
                <a href="{{ route('school_route.about') }}"><button
                        class="btn text-white text-green-ligh-bg-grad ms-2">Discover more</button></a>
            </div>
        </div>
    </div>
</div>

<br>

<div id="blogs" class="mt-4 mb-4 position-relative text-center"
    style="background-image: url('{{ asset('img/dashboard/system/landing/screen1.jpg') }}'); background-size: cover; padding-top: 204px; padding-bottom: 280px; background-size: cover;">
    <div class="overlay-video"></div>
    <div class="videoContainer"
        style="position: absolute; z-index: 0; top:0; width: 100vw; height: 100%; overflow: hidden;">
        <iframe class="video_full_resp" width="1920" height="1080"
            src="https://www.youtube.com/embed/IGTd7xFca4A?autoplay=1&mute=1&controls=0&start=15&showinfo=0&loop=1&playlist=IGTd7xFca4A"
            allowfullscreen frameborder="0" allow="accelerometer">
        </iframe>
    </div>
    <div style="position: absolute; z-index: 4; width:100%; top: 50%; transform: translateY(-50%);">
        <div class="d-flex justify-content-center mx-0">
            <div class="text-start ps-5 align-self-center" style="width: 450px">
                <div class="hr-land bg-white"></div>
                <h1 class="text-white text-xl"><i class="fas fa-video"></i> Watch Now</h1>
                <p class="text-white fw-light">
                    Watch Dr. Amr Saeed blogs and his television interviews and know about the doctor more and more
                </p>
            </div>
            <div class=" d-flex justify-content-center align-items-center" style="width: 450px;">
                <div class="rounded-circle text-green-ligh-bg mb-2 p-3 d-flex align-items-center justify-content-center shadow clickable-item-pointer click_modal_video_iframe"
                    data-video_url="https://www.youtube.com/embed/IGTd7xFca4A" style="width: 75px; height: 75px;">
                    <i class="fas fa-play fs-2 text-white"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row justify-content-center mx-0" style="margin-top: -78px;">
    <div class="col-8 col-md-8 col-lg-5 pb-3">
        <div class="owl-carousel owl-theme owl-loaded owl-video-land">

            <div class="item d-flex justify-content-center shadow pb-5 position-relative rounded-circle"
                style="background-image: url('{{ asset('img/dashboard/system/landing/vid-1.jpg') }}'); background-size: cover; width:110px; height:110px">
                <div class="overlay-video rounded-circle"></div>
                <div class="rounded-circle text-green-ligh-bg mb-2 p-3 d-flex align-items-center justify-content-center shadow clickable-item-pointer click_modal_video_iframe"
                    data-video_url="https://www.youtube.com/embed/1bxxS9_2_1g"
                    style="width: 40px;height: 40px;position: absolute;z-index: 5;  top: 50%; left: 50%; transform: translate(-50%, -50%);">
                    <i class="fas fa-play fs-6 text-white"></i>
                </div>
            </div>
            <div class="item d-flex justify-content-center shadow pb-5 position-relative rounded-circle"
                style="background-image: url('{{ asset('img/dashboard/system/landing/vid-2.jpg') }}'); background-size: cover; width:110px; height:110px">
                <div class="overlay-video rounded-circle"></div>
                <div class="rounded-circle text-green-ligh-bg mb-2 p-3 d-flex align-items-center justify-content-center shadow clickable-item-pointer click_modal_video_iframe"
                    data-video_url="https://www.youtube.com/embed/WpHzgbOuVJ8"
                    style="width: 40px;height: 40px;position: absolute;z-index: 5;  top: 50%; left: 50%; transform: translate(-50%, -50%);">
                    <i class="fas fa-play fs-6 text-white"></i>
                </div>
            </div>
            <div class="item d-flex justify-content-center shadow pb-5 position-relative rounded-circle"
                style="background-image: url('{{ asset('img/dashboard/system/landing/vid-3.jpg') }}'); background-size: cover; width:110px; height:110px">
                <div class="overlay-video rounded-circle"></div>
                <div class="rounded-circle text-green-ligh-bg mb-2 p-3 d-flex align-items-center justify-content-center shadow clickable-item-pointer click_modal_video_iframe"
                    data-video_url="https://www.youtube.com/embed/KYhP5SXWC4k"
                    style="width: 40px;height: 40px;position: absolute;z-index: 5;  top: 50%; left: 50%; transform: translate(-50%, -50%);">
                    <i class="fas fa-play fs-6 text-white"></i>
                </div>
            </div>
            <div class="item d-flex justify-content-center shadow pb-5 position-relative rounded-circle"
                style="background-image: url('{{ asset('img/dashboard/system/landing/vid-4.jpg') }}'); background-size: cover; width:110px; height:110px">
                <div class="overlay-video rounded-circle"></div>
                <div class="rounded-circle text-green-ligh-bg mb-2 p-3 d-flex align-items-center justify-content-center shadow clickable-item-pointer click_modal_video_iframe"
                    data-video_url="https://www.youtube.com/embed/r1I0be_s3_g"
                    style="width: 40px;height: 40px;position: absolute;z-index: 5;  top: 50%; left: 50%; transform: translate(-50%, -50%);">
                    <i class="fas fa-play fs-6 text-white"></i>
                </div>
            </div>
            <div class="item d-flex justify-content-center shadow pb-5 position-relative rounded-circle"
                style="background-image: url('{{ asset('img/dashboard/system/landing/vid-5.jpg') }}'); background-size: cover; width:110px; height:110px">
                <div class="overlay-video rounded-circle"></div>
                <div class="rounded-circle text-green-ligh-bg mb-2 p-3 d-flex align-items-center justify-content-center shadow clickable-item-pointer click_modal_video_iframe"
                    data-video_url="https://www.youtube.com/embed/21NKWXgpuG0"
                    style="width: 40px;height: 40px;position: absolute;z-index: 5;  top: 50%; left: 50%; transform: translate(-50%, -50%);">
                    <i class="fas fa-play fs-6 text-white"></i>
                </div>
            </div>

            <div class="item d-flex justify-content-center shadow pb-5 position-relative rounded-circle"
                style="background-image: url('{{ asset('img/dashboard/system/landing/vid-6.jpg') }}'); background-size: cover; width:110px; height:110px">
                <div class="overlay-video rounded-circle"></div>
                <div class="rounded-circle text-green-ligh-bg mb-2 p-3 d-flex align-items-center justify-content-center shadow clickable-item-pointer click_modal_video_iframe"
                    data-video_url="https://www.youtube.com/embed/I_qdEJaoNkQ"
                    style="width: 40px;height: 40px;position: absolute;z-index: 5;  top: 50%; left: 50%; transform: translate(-50%, -50%);">
                    <i class="fas fa-play fs-6 text-white"></i>
                </div>
            </div>

            <div class="item d-flex justify-content-center shadow pb-5 position-relative rounded-circle"
                style="background-image: url('{{ asset('img/dashboard/system/landing/vid-7.jpg') }}'); background-size: cover; width:110px; height:110px">
                <div class="overlay-video rounded-circle"></div>
                <div class="rounded-circle text-green-ligh-bg mb-2 p-3 d-flex align-items-center justify-content-center shadow clickable-item-pointer click_modal_video_iframe"
                    data-video_url="https://www.youtube.com/embed/rOADbCAPNzI"
                    style="width: 40px;height: 40px;position: absolute;z-index: 5;  top: 50%; left: 50%; transform: translate(-50%, -50%);">
                    <i class="fas fa-play fs-6 text-white"></i>
                </div>
            </div>

            <div class="item d-flex justify-content-center shadow pb-5 position-relative rounded-circle"
                style="background-image: url('{{ asset('img/dashboard/system/landing/vid-8.jpg') }}'); background-size: cover; width:110px; height:110px">
                <div class="overlay-video rounded-circle"></div>
                <div class="rounded-circle text-green-ligh-bg mb-2 p-3 d-flex align-items-center justify-content-center shadow clickable-item-pointer click_modal_video_iframe"
                    data-video_url="https://www.youtube.com/embed/jyYGeL0G6LA"
                    style="width: 40px;height: 40px;position: absolute;z-index: 5;  top: 50%; left: 50%; transform: translate(-50%, -50%);">
                    <i class="fas fa-play fs-6 text-white"></i>
                </div>
            </div>
        </div>

    </div>
</div>

<div class="modal fade" id="video_modal_show" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content b-r-s-cont bg-transparent border-0">
            <div class="clickable-item-pointer"
                style="position: absolute; top: -16px; right: 14px; color:rgb(255 255 255 / 63%)!important;"
                data-bs-dismiss="modal" aria-label="Close">
                <i class="fas fs-3 fa-times"></i>
            </div>
            <div class="modal-body align-self-center w-100">
                <iframe id="video_modal_iframe" class="w-100" height="415"
                    src="https://www.youtube.com/embed/IGTd7xFca4A" title="YouTube video player" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen></iframe>
            </div>
        </div>
    </div>
</div>

<!--
                <section id="team" class="mt-5" style="margin-bottom: 5rem">
                    <div class="container">
                        <div class="text-center mb-5">
                            <h2 class="text-petroleum mb-3">Our Team</h2>
                            <p class="text-petroleum-light">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium
                                doloremque</p>
                            <div class="hr-land text-green-ligh-bg ms-auto me-auto"></div>

                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-6">
                                <div class="text-center mb-3">
                                    <div class="mb-3"><img class="avatar-team rounded-circle"
                                            src="{{ asset('img/dashboard/system/landing/team1.jpg') }}" alt=""></div>
                                    <h4 class="text-petroleum mb-1">Soliman Atef</h4>
                                    <span class="text-petroleum-light">Pain Therapist</span>
                                    <div class="text-petroleum-light mt-2">
                                        <a class="text-petroleum-light me-1" href=""><i class="bi bi-twitter"></i></a>
                                        <a class="text-petroleum-light me-1" href=""><i class="bi bi-facebook"></i></a>
                                        <a class="text-petroleum-light" href=""><i class="bi bi-linkedin"></i></a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-6">
                                <div class="text-center mb-3">
                                    <div class="mb-3"><img class="avatar-team rounded-circle"
                                            src="{{ asset('img/dashboard/system/landing/team2.jpg') }}" alt=""></div>
                                    <h4 class="text-petroleum mb-1">Ahmed Soliman</h4>
                                    <span class="text-petroleum-light">Pain Therapist</span>
                                    <div class="text-petroleum-light mt-2">
                                        <a class="text-petroleum-light me-1" href=""><i class="bi bi-twitter"></i></a>
                                        <a class="text-petroleum-light me-1" href=""><i class="bi bi-facebook"></i></a>
                                        <a class="text-petroleum-light" href=""><i class="bi bi-linkedin"></i></a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-6">
                                <div class="text-center mb-3">
                                    <div class="mb-3"><img class="avatar-team rounded-circle"
                                            src="{{ asset('img/dashboard/system/landing/team3.jpg') }}" alt=""></div>
                                    <h4 class="text-petroleum mb-1">Mohamed Noman</h4>
                                    <span class="text-petroleum-light">Orthopedic Specialist</span>
                                    <div class="text-petroleum-light mt-2">
                                        <a class="text-petroleum-light me-1" href=""><i class="bi bi-twitter"></i></a>
                                        <a class="text-petroleum-light me-1" href=""><i class="bi bi-facebook"></i></a>
                                        <a class="text-petroleum-light" href=""><i class="bi bi-linkedin"></i></a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-6">
                                <div class="text-center mb-3">
                                    <div class="mb-3"><img class="avatar-team rounded-circle"
                                            src="{{ asset('img/dashboard/system/landing/team4.jpg') }}" alt=""></div>
                                    <h4 class="text-petroleum mb-1">Nedaa Saleem</h4>
                                    <span class="text-petroleum-light">Chief Executive Officer</span>
                                    <div class="text-petroleum-light mt-2">
                                        <a class="text-petroleum-light me-1" href=""><i class="bi bi-twitter"></i></a>
                                        <a class="text-petroleum-light me-1" href=""><i class="bi bi-facebook"></i></a>
                                        <a class="text-petroleum-light" href=""><i class="bi bi-linkedin"></i></a>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </section>
            -->

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
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
<script>
    //At the document ready event
        $(function() {
            new WOW().init();
        });

        //also at the window load event
        $(window).on('load', function() {

            new WOW().init();
        });

        $(document).on('click', '.click_modal_video_iframe', function() {
            var url = $(this).data('video_url');
            $("#video_modal_iframe").attr("src", url);
            $('#video_modal_show').modal('show');
        });
</script>



@endsection