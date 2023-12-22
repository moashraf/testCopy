@extends('layouts.land.master')

@section('title', 'Pain Cure | Dr. Amr Saeed')

<!-- css insert -->
@section('css')

    <script src="{{ URL::asset('plugins/owl/owl.carousel.min.css') }}"></script>

    <style>
        *-------------------------------------------------------------- # Featured Services --------------------------------------------------------------*/ .featured-services .icon-box {
            padding: 30px;
            position: relative;
            overflow: hidden;
            background: #fff;
            box-shadow: 0 0 29px 0 rgba(68, 88, 144, 0.12);
            transition: all 0.3s ease-in-out;
            border-radius: 8px;
            z-index: 1;
        }

        .featured-services .icon-box::before {
            content: '';
            position: absolute;
            background: #cbe0fb;
            right: 0;
            left: 0;
            bottom: 0;
            top: 100%;
            transition: all 0.3s;
            z-index: -1;
        }

        .featured-services .icon-box:hover::before {
            background: #106eea;
            top: 0;
            border-radius: 0px;
        }

        .featured-services .icon {
            margin-bottom: 15px;
        }

        .featured-services .icon i {
            font-size: 48px;
            line-height: 1;
            color: #106eea;
            transition: all 0.3s ease-in-out;
        }

        .featured-services .title {
            font-weight: 700;
            margin-bottom: 15px;
            font-size: 18px;
        }

        .featured-services .title a {
            color: #111;
        }

        .featured-services .description {
            font-size: 15px;
            line-height: 28px;
            margin-bottom: 0;
        }

        .featured-services .icon-box:hover .title a,
        .featured-services .icon-box:hover .description {
            color: #fff;
        }

        .featured-services .icon-box:hover .icon i {
            color: #fff;
        }

    </style>
@endsection

<!-- content insert -->
@section('content')


    <div class="container px-2 px-md-5">

        <nav class="navbar navbar-expand-lg navbar-light pt-3">
            <div class="container-fluid">
                <a class="navbar-brand me-5" href="#"> <img src="{{ URL::asset('img/dashboard/system/pc-loader.png') }}"
                        alt=""> </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse ms-5" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Services</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Our team
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Blogs</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contact</a>
                        </li>
                    </ul>
                    <button type="button" class="btn text-green-ligh-bg btn-lg b-r-xs"><a class="text-s text-white"
                            href="#"><i class="bi bi-calendar-range me-1"></i> Get your appointment</a></button>
                </div>
            </div>
        </nav>

        <div class="row">

            <div class="col-12 col-md-5 align-self-center pt-3 pt-md-0 mb-3 mb-md-0">

                <div id="carouselExampleDark" class="carousel carousel-dark slide carousel-fade" data-bs-ride="carousel"
                    data-bs-interval="5000">
                    <div class="carousel-indicators dots-radius-carousel-land" style="bottom:-93px;">
                        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0"
                            class="active" aria-current="true" aria-label="Slide 1"></button>
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
                            <button type="button" class="btn text-green-ligh-bg btn-lg b-r-xs"><a class="text-s2 text-white"
                                    href="#">
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
                            <button type="button" class="btn text-green-ligh-bg btn-lg b-r-xs"><a class="text-s2 text-white"
                                    href="#">
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
                            <button type="button" class="btn text-green-ligh-bg btn-lg b-r-xs"><a class="text-s2 text-white"
                                    href="#">
                                    Book Now</a></button>
                        </div>

                    </div>
                </div>

            </div>
            <div class="col-12 col-md-7 text-end">
                <img class="" src="{{ URL::asset('img/dashboard/system/header-dr.png') }}" alt="">
            </div>

        </div>

    </div>


    <div class=" p-5 mt-5 mb-4 position-relative"
        style="background-image: url('{{ asset('img/dashboard/system/landing/video1.png') }}');">

        <div class="overlay-video"></div>

        <div class="row">
            <div class="col-6">sad</div>
            <div class="col-6">sad</div>
        </div>

    </div>

    <div class="container px-2 px-md-5">


        <div class="row justify-content-center mb-5">
            <div class="col-3 shadow b-r-s-cont p-4">
                <div class="rounded-circle text-petroleum2-bg mb-2   p-2 text-center" style="width: 50px; height: 50px;">
                    <i class="bi  fs-5 bi-calendar-range text-white"></i>
                </div>
                <p>
                    Online Appoinment
                </p>
            </div>
            <div class="col-3"></div>
            <div class="col-3"></div>
        </div>

        <div class="row">
            <div class="col-6 px-5 align-self-center">
                <div class="hr-land text-green-ligh-bg"></div>
                <h1 class="text-petroleum">Our Blogs</h1>
                <p class="text-petroleum-light">
                    Problems trying to resolve the conflict between
                    the two major realms of Classical physics:
                    Newtonian mechanics
                </p>
            </div>

            <div class="col-6 bg-video-image b-r-s-cont"
                style="background-image: url('{{ asset('img/dashboard/system/landing/video1.png') }}');">
                <div class="overlay-video"></div>
                <div class="rounded-circle text-green-ligh-bg mb-2 p-3 d-flex align-items-center justify-content-center play-video-land"
                    style="width: 75px; height: 75px;">
                    <i class="fas fa-play fs-2 text-white"></i>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-12">
                <!-- ======= Featured Services Section ======= -->
                <section id="featured-services" class="featured-services">
                    <div class="container" data-aos="fade-up">

                        <div class="row">
                            <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
                                <div class="icon-box" data-aos="fade-up" data-aos-delay="100">
                                    <div class="icon"><i class="bx bxl-dribbble"></i></div>
                                    <h4 class="title"><a href="">Lorem Ipsum</a></h4>
                                    <p class="description">Voluptatum deleniti atque corrupti quos dolores et quas
                                        molestias excepturi</p>
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
                                <div class="icon-box" data-aos="fade-up" data-aos-delay="200">
                                    <div class="icon"><i class="bx bx-file"></i></div>
                                    <h4 class="title"><a href="">Sed ut perspiciatis</a></h4>
                                    <p class="description">Duis aute irure dolor in reprehenderit in voluptate velit
                                        esse cillum dolore</p>
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
                                <div class="icon-box" data-aos="fade-up" data-aos-delay="300">
                                    <div class="icon"><i class="bx bx-tachometer"></i></div>
                                    <h4 class="title"><a href="">Magni Dolores</a></h4>
                                    <p class="description">Excepteur sint occaecat cupidatat non proident, sunt in
                                        culpa qui officia</p>
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
                                <div class="icon-box" data-aos="fade-up" data-aos-delay="400">
                                    <div class="icon"><i class="bx bx-world"></i></div>
                                    <h4 class="title"><a href="">Nemo Enim</a></h4>
                                    <p class="description">At vero eos et accusamus et iusto odio dignissimos
                                        ducimus
                                        qui blanditiis</p>
                                </div>
                            </div>

                        </div>

                    </div>
                </section><!-- End Featured Services Section -->

            </div>
        </div>
    </div>

@endsection

<!-- js insert -->
@section('js')

    <script src="{{ URL::asset('plugins/owl/owl.carousel.min.js') }}"></script>

    <script>

    </script>

@endsection
