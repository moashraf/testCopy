<div class="row justify-content-center mx-0 mt-5">
    <div class="col-10">
        <div class="footer_app_mobile row text-center pt-4">

            <h4 class=" text-white fw-light text-blue-200">
                Discover Our <span class="fw-bold text-white">Partners</span>
            </h4>
            <div>
                <div class="swiper hp_our_partners">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <img src="{{ URL::asset('img/website/hp/partners/partner1.png') }}" alt="">
                        </div>
                        <div class="swiper-slide">
                            <img src="{{ URL::asset('img/website/hp/partners/partner2.png') }}" alt="">
                        </div>
                        <div class="swiper-slide">
                            <img src="{{ URL::asset('img/website/hp/partners/partner3.png') }}" alt="">
                        </div>
                        <div class="swiper-slide">
                            <img src="{{ URL::asset('img/website/hp/partners/partner4.png') }}" alt="">
                        </div>
                        <div class="swiper-slide">
                            <img src="{{ URL::asset('img/website/hp/partners/partner6.png') }}" alt="">
                        </div>
                        <div class="swiper-slide">
                            <img width="150px" src="{{ URL::asset('img/website/hp/partners/partner7.png') }}" alt="">
                        </div>
                        <div class="swiper-slide">
                            <img width="140px" src="{{ URL::asset('img/website/hp/partners/partner8.png') }}" alt="">
                        </div>
                        <div class="swiper-slide">
                            <img width="160px" src="{{ URL::asset('img/website/hp/partners/partner9.png') }}" alt="">
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>

<footer class="pb-2 pt-5" style="background-color: #FFFFFF">
    <div class="container pt-5 pt-md-4">

        <div class="row ">
            <div class="col-12 col-md-3 align-self-center  pt-0 ps-5">
                <img class="mb-1" width="180px" src="{{ URL::asset('img/website/logo/destino_color.png') }}"
                    alt="Meidaa">
                <p class="text-s text-gray-400">A FULL SERVICE ONLINE TRAVEL AGENCY FOUNDED IN 1989 BASED IN EGYPT WHICH
                    PROVIDES BOTH RECREATION AND CORPORATE PARTNERSHIP.
                </p>
                <div class="social_icons">
                    <a class="text-dark" target="_blank" href="https://web.facebook.com/DestinoToursEg"><i
                            class="fa-brands fa-facebook-f dark-blue m-1"></i></a>
                    <a target="_blank" href="https://www.instagram.com/destino_tours/"><i
                            class="fa-brands fa-instagram dark-blue m-1"></i></a>
                    <a target="_blank"
                        href="https://wa.me/+201223344249?text=Hello,%20I%20need%20to%20make%20a%20booking?%20Thanks"><i
                            class="fa-brands fa-whatsapp dark-blue m-1"></i></a>
                    <a target="_blank" href="https://t.me/Destino_tours"><i
                            class="fa-brands fa-telegram dark-blue m-1"></i></a>
                    <a target="_blank" href="#"><i class="fa-brands fa-twitter dark-blue m-1"></i></a>
                    <a target="_blank" href="https://eg.linkedin.com/company/destino-tours/"><i
                            class="fa-brands fa-linkedin dark-blue m-1"></i></a>
                    <a target="_blank" href="#"><i class="fa-brands fa-pinterest-p dark-blue m-1"></i></a>
                </div>
            </div>
            <div class="col-12 col-md-2 mt-4">
                <h5 class="fs-5 fw-bold mb-2">Pages</h5>
                <ul class="no_dots_ul px-0">
                    <li class="mb-2"> <a class="text-gray-500 fw-light" href="{{ route('website_homepage') }}">Home</a>
                    </li>
                    <li class="mb-2"> <a class="text-gray-500 fw-light"
                            href="{{ route('school_route.about_us') }}">About Us</a> </li>
                    <li class="mb-2"> <a class="text-gray-500 fw-light"
                            href="{{ route('school_route.contact_us') }}">Contact Us</a> </li>
                </ul>
            </div>
            <div class="col-12 col-md-2 mt-4">
                <h5 class="fs-5 fw-bold mb-2">Services</h5>
                <ul class="no_dots_ul px-0">
                    <li class="mb-2"> <a class="text-gray-500 fw-light"
                            href="{{ route('school_route.show_tag', 'visit_egypt') }}">Visit Egypt</a> </li>
                    <li class="mb-2"> <a class="text-gray-500 fw-light"
                            href="{{ route('school_route.show_tag', 'domestic') }}">Domestic</a> </li>
                    <li class="mb-2"> <a class="text-gray-500 fw-light"
                            href="{{ route('school_route.show_tag', 'hajj-and-umrah') }}">Hajj & Ummrah</a> </li>
                    <li class="mb-2"> <a class="text-gray-500 fw-light"
                            href="{{ route('school_route.all_visa') }}">Visa</a> </li>
                    <li class="mb-2"> <a class="text-gray-500 fw-light"
                            href="{{ route('school_route.show_tag', 'pink_tourism') }}">Pink Tourism</a> </li>
                    <li class="mb-2"> <a class="text-gray-500 fw-light"
                            href="{{ route('school_route.show_tag', 'disable-tourism') }}">Deaf and Dumb Tourism</a>
                    </li>
                </ul>
            </div>
            <div class="col-12 col-md-2 mt-4">
                <h5 class="fs-5 fw-bold mb-2">Account</h5>
                <ul class="no_dots_ul px-0">
                    <li class="mb-2"> <a class="text-gray-500 fw-light"
                            href="{{ route('school_route.register', 'login') }}">Login</a> </li>
                    <li class="mb-2"> <a class="text-gray-500 fw-light"
                            href="{{ route('school_route.register', 'register') }}">Register</a> </li>
                    <li class="mb-2"> <a class="text-gray-500 fw-light" href="#">Newsletter</a> </li>
                </ul>
            </div>
            <div class="col-12 col-md-3 mt-4 align-self-center">
                <ul class="no_dots_ul ps-0">
                    <li class="mb-2"><i class="fas fa-map-marker-alt"></i> <a class="text-gray-500 fw-light"
                            target="_blank"
                            href="https://www.google.com/maps/place/Destino+Tours/@30.0783148,31.3120604,15z/data=!4m2!3m1!1s0x0:0xe34f1a266888ba79?sa=X&ved=2ahUKEwiimff6pJ3_AhWO_rsIHZhNAKkQ_BJ6BAhKEAg">
                            10 El Obour Buildings., Salah Salem Rd., front of Al Moustafa Mosque, Cairo, Egypt
                        </a> </li>
                    <li class="mb-2"><i class="fas fa-headset"></i> <a class="text-gray-500 fw-light"
                            href="tel:+201223344249" target="_blank">+201223344249</a> </li>
                    <li class="mb-2"><i class="fas fa-envelope"></i> <a class="text-gray-500 fw-light"
                            href="mailto:info@destinotours.net" target="_blank">info@destinotours.net</a> </li>
                </ul>
            </div>
        </div>
        <hr class="text-gray-300">
        <div class="d-flex justify-content-center">
            <span class="text-gray-600 text-xs ps-4">All Copyright © reserved to Destino Tours</span>
        </div>
    </div>
</footer>