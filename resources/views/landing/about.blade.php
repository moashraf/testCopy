@extends('layouts.land.master_top')

@section('title', 'About us - Pain Cure | Dr. Amr Saeed')

<!-- css insert -->
@section('css')

    <!-- animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <link rel="stylesheet" href="{{ URL::asset('plugins/owl/owl.carousel.min.css') }}">


@endsection

<!-- content insert -->
@section('content')

    <div class="bradcam_area breadcam_bg bradcam_overlay"
        style="background-image: url('{{ asset('img/dashboard/system/landing/bradcam3.jpg') }}')">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="text-white">
                        <h1>About Us</h1>
                        <a class="text-gray-200" href="{{ route('landing') }}">Home /</a> About us</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container bg-white position-relative b-r-s-cont p-5 shadow" style="margin-top: -40px; z-index:9;">


        <div class="welcome_docmed_area">
            <div class="container px-0">
                <div class="row">
                    <div class="col-xl-6 col-lg-6 mb-5">
                        <div class="welcome_thumb">
                            <div class="thumb_1">
                                <img src="img/about/1.png" alt="">
                            </div>
                            <div class="pe-md-4">
                                <img width="100%" src="{{ asset('img/dashboard/system/landing/about_dr.jpg') }}" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 pt-4">
                        <div class="welcome_docmed_info">
                            <h2 class="text-green-ligh">Who is Amr Saeed?</h2>
                            <div class="hr-land text-green-ligh-bg mb-3"></div>
                            <p class="text-petroleum-light">Amr Saeed is an egyptian doctor who spirit temper too say adieus
                                who direct esteem.
                                It esteems luckily or picture placing drawing. Apartments frequently or motionless on
                                reasonable projecting expression.</p>
                            <ul class="text-petroleum-light">
                                <li> <i class="flaticon-right"></i> Apartments frequently or motionless. </li>
                                <li> <i class="flaticon-right"></i> Duis aute irure dolor in reprehenderit in voluptate.
                                </li>
                                <li> <i class="flaticon-right"></i> Voluptatem quia voluptas sit aspernatur. </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="ps-3 mb-5 mt-4">
            <h2 class=" text-green-ligh">Discover Our Serivces</h2>
            <div class="hr-land text-green-ligh-bg"></div>
        </div>
        <div class="row">
            <div class="col-xl-4 col-md-6 col-lg-4 mb-4">
                <div class=" b-r-s-cont shadow">
                    <div class="">
                        <img class="w-100" style="border-radius: 0px 18px;"
                            src="{{ asset('img/dashboard/system/landing/service-1.jpg') }}" alt="">
                    </div>
                    <div class="p-4">
                        <h3 class="text-petroleum">Plasma Therapy</h3>
                        <p class="text-petroleum-light">Esteem spirit temper too say adieus who direct esteem.</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6 col-lg-4 mb-4">
                <div class=" b-r-s-cont shadow">
                    <div class="">
                        <img class="w-100" style="border-radius: 0px 18px;"
                            src="{{ asset('img/dashboard/system/landing/service-2.jpg') }}" alt="">
                    </div>
                    <div class="p-4">
                        <h3 class="text-petroleum">Personal Care</h3>
                        <p class="text-petroleum-light">Esteem spirit temper too say adieus who direct esteem.</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6 col-lg-4 mb-4">
                <div class=" b-r-s-cont shadow">
                    <div class="">
                        <img class="w-100" style="border-radius: 0px 18px;"
                            src="{{ asset('img/dashboard/system/landing/service-3.jpg') }}" alt="">
                    </div>
                    <div class="p-4">
                        <h3 class="text-petroleum">CT scan</h3>
                        <p class="text-petroleum-light">Esteem spirit temper too say adieus who direct esteem.</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6 col-lg-4 mb-4">
                <div class=" b-r-s-cont shadow">
                    <div class="">
                        <img class="w-100" style="border-radius: 0px 18px;"
                            src="{{ asset('img/dashboard/system/landing/service-4.jpg') }}" alt="">
                    </div>
                    <div class="p-4">
                        <h3 class="text-petroleum">Child Care</h3>
                        <p class="text-petroleum-light">Esteem spirit temper too say adieus who direct esteem.</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6 col-lg-4 mb-4">
                <div class=" b-r-s-cont shadow">
                    <div class="">
                        <img class="w-100" style="border-radius: 0px 18px;"
                            src="{{ asset('img/dashboard/system/landing/service-5.jpg') }}" alt="">
                    </div>
                    <div class="p-4">
                        <h3 class="text-petroleum">Examination & Diag</h3>
                        <p class="text-petroleum-light">Esteem spirit temper too say adieus who direct esteem.</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6 col-lg-4 mb-4">
                <div class=" b-r-s-cont shadow">
                    <div class="">
                        <img class="w-100" style="border-radius: 0px 18px;"
                            src="{{ asset('img/dashboard/system/landing/service-6.jpg') }}" alt="">
                    </div>
                    <div class="p-4">
                        <h3 class="text-petroleum">Back Pain's disease</h3>
                        <p class="text-petroleum-light">Esteem spirit temper too say adieus who direct esteem.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="ps-3 mb-5 mt-4">
            <h2 class=" text-green-ligh">Our Team</h2>
            <div class="hr-land text-green-ligh-bg"></div>
        </div>

        <section id="team" class="mt-5">
            <div class="container">
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
                            <span class="text-petroleum-light">Orthopedic specialist</span>
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


    </div>


@endsection

<!-- js insert -->
@section('js')


@endsection
