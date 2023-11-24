@extends('layouts.land.master_top')

@section('title', 'Contact - Pain Cure | Dr. Amr Saeed')

<!-- css insert -->
@section('css')

    <!-- animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <link rel="stylesheet" href="{{ URL::asset('plugins/owl/owl.carousel.min.css') }}">


@endsection

<!-- content insert -->
@section('content')

    <div class="bradcam_area breadcam_bg bradcam_overlay"
        style="background-image: url('{{ asset('img/dashboard/system/landing/bradcam2.jpg') }}')">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="text-white">
                        <h1>Contact Us</h1>
                        <a class="text-gray-200" href="{{ route('landing') }}">Home /</a> Contact Us</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container bg-white position-relative b-r-s-cont p-5 shadow" style="margin-top: -40px; z-index:9;">

        <div class="container px-0" style="position: relative; top:-83px">
            <div class="row animate__animated animate__backInUp">
                <div class="col-12 col-md px-5 py-3 me-3 mb-3 shadow b-r-s-cont bg-white text-center">
                    <i class="bi bi-headset text-xl text-green-ligh"></i>
                    <h4 class="text-petroleum">Call Us</h4>
                    <p class="text-petroleum-light mb-0">+02-0123-4500-271</p>
                    <p class="text-petroleum-light">+02-0155-1776-699</p>
                </div>

                <div class="col-12 col-md px-5 py-3 me-3 mb-3 shadow b-r-s-cont bg-white text-center">
                    <i class="fas fa-envelope text-xl text-green-ligh my-3"></i>
                    <h4 class="text-petroleum">Email Us</h4>
                    <p class="fw-light text-petroleum-light mb-0">Info@dramrsaeed.com</p>
                    <p class="fw-light text-petroleum-light">Support@dramrsaeed.com</p>
                </div>
                <div class="col-12 col-md px-5 py-3 mb-3 shadow b-r-s-cont bg-white text-center">
                    <i class="fas fa-clock text-xl text-green-ligh my-3"></i>
                    <h4 class="text-petroleum">Opening Hours</h4>
                    <p class="fw-light text-petroleum-light mb-1">
                        Everyday
                        <br>09:00 AM - 11:00 PM
                        <br>
                        Except Friday Closed
                    </p>
                </div>
            </div>

        </div>

        <div class="ps-3" style="position: relative; top:-50px">
            <h2 class=" text-green-ligh">Get in Touch</h2>
            <div class="hr-land text-green-ligh-bg"></div>
        </div>

        <div class="row justify-content-center px-3">

            <div class="col-lg-7 mb-2 mb-md-0">
                <form class="form-contact contact_form" action="contact_process.php" method="post" id="contactForm"
                    novalidate="novalidate">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <textarea class="form-control w-100" name="message" id="message" cols="30" rows="9"
                                    onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Message'"
                                    placeholder="Enter Message"></textarea>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input class="form-control valid" name="name" id="name" type="text"
                                    onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter your name'"
                                    placeholder="Enter your name">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input class="form-control valid" name="email" id="email" type="email"
                                    onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter email address'"
                                    placeholder="Email">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <input class="form-control" name="subject" id="subject" type="text"
                                    onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Subject'"
                                    placeholder="Enter Subject">
                            </div>
                        </div>
                    </div>
                    <div class="form-group mt-2">
                        <button type="submit" class="btn text-green-ligh-bg text-white px-4">Send</button>
                    </div>
                </form>
            </div>
            <div class="col-lg-4 offset-lg-1">
                <div class="mb-4">
                    <h4 class="text-petroleum"><i class="fas fa-map-marked-alt me-1"></i> Branches</h4>
                    <div class="hr-land" style="width: 20px; background-color: #223a66"></div>
                </div>
                <div class="">
                    <h6 class="text-petroleum"><i class="fas fa-map-marker-alt me-1"></i> Tahrer Branch</h6>
                    <p class=" text-petroleum-light"> 129 Tahrer st, Next to Russian Cultural Center Giza, Egypt</p>
                </div>
                <hr>
                <div class="">
                    <h6 class="text-petroleum"><i class="fas fa-map-marker-alt me-1"></i> 7 Ammrat El-Shbab st in front of
                        Panda Market, Cairo, Egypt</h6>
                    <p class=" text-petroleum-light">Nasr City Branch</p>
                </div>
                <hr>
                <div class="">
                    <h6 class="text-petroleum"><i class="fas fa-map-marker-alt me-1"></i> 10 Mokhtar Abd El-Haleem st, Saba
                        Pasha, Alexandria, Egypt</h6>
                    <p class=" text-petroleum-light">Alexandria Branch</p>
                </div>
            </div>
        </div>
        <hr class="mb-4">
        <section id="google-map">
            <!-- How to change your own map point
                                                                           1. Go to Google Maps
                                                                           2. Click on your location point
                                                                           3. Click "Share" and choose "Embed map" tab
                                                                           4. Copy only URL and paste it within the src="" field below
                                                                   -->
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1726.970048059515!2d31.214404156149868!3d30.038576397752337!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1458150e497790ab%3A0xef31065117fef964!2z2K8gLyDYudmF2LHZiCDZhdit2YXYryDYs9i52YrYrw!5e0!3m2!1sen!2seg!4v1640517256319!5m2!1sen!2seg"
                width="100%" height="350" frameborder="0" style="border:0" allowfullscreen=""></iframe>
        </section>
    </div>


@endsection

<!-- js insert -->
@section('js')


@endsection
