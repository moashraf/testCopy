@extends('layouts.normmaster')

@section('title', 'Login | Lam - School Management App')

<!-- css insert -->
@section('css')

<!-- google recaptcha -->
<script src="https://www.google.com/recaptcha/api.js" async defer></script>

@laravelPWA

@endsection


<!-- content insert -->
@section('content')
{{--
<div class="video_intro_log">
    <div style="position: relative; overflow: hidden; padding-top: 56.25%;"><iframe
            src="https://share.synthesia.io/embeds/videos/08600113-eb38-4da2-9c2e-94d3aaad89e2" loading="lazy"
            title="Synthesia video player - Your AI video" allow="encrypted-media; fullscreen;"
            style="position: absolute; width: 100%; height: 100%; top: 0; left: 0; border: none; padding: 0; margin: 0; overflow:hidden;"></iframe>
    </div>
</div> --}}



{{-- install pwa --}}
<div id="install-app-btn-container" class="toaster_fixed_status" style="display: none">
    <div class="d-flex">
        <div class="icont_cont me-2"><i class="fas fa-arrow-down"></i></div>
        <div>
            <span class="fw-bold">Install Lam Web App</span>
            <p class=" text-blue-200 mb-0">Get the most out of Lam</p>

        </div>

    </div>
    <div id="install_pwa_btn" class="clickable-item-pointer">
        <div class="white-color-btn status-col-link rounded-pill p-2 px-3 clickable-item-pointer"
            style="width: fit-content;">
            Install
        </div>
    </div>
    <div
        class="d-flex align-items-center justify-content-center rounded-circle avatar-xxs cancel-color-btn clickable-item-pointer close_toaster_fixed">
        <i class="fas fa-times"></i>
    </div>
</div>


<div class="login_body" style="background-image: url('{{ asset('img/dashboard/system/doctor-lab.jpg') }}');">

    <video class="video_full_resp" autoplay="" loop="" id="expert-video" muted="" playsinline=""
        class="absolute top-0 left-0 object-cover h-full w-full z-0" poster="{{ URL::asset('vid/NewMexico_3.jpeg') }}">
        <source src="{{ URL::asset('vid/learning.mp4') }}" type="video/mp4">
        <track kind="captions">
    </video>

    <div class="overlay-dark1"></div>

    <div class="">

        <!-- Outer Row -->
        <div class="row justify-content-center min-vh-100 align-content-center position-relative ">

            <div class="col-12 col-md-6 col-lg-4 order-last order-md-first px-0">
                <div class="card overflow-hidden border-0 shadow-lg"
                    style="height: 100% !important; border-radius: 0px;">
                    <div class="card-body d-flex align-items-center align-self-center p-0"
                        style="height: 100vh !important;">
                        <!-- Nested Row within Card Body -->
                        <div class="">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-2">{{ __('basic.welcome back') }}</h1>
                            </div>

                            <div class="row">
                                <div class="d-flex justify-content-center">
                                    @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                    <a class="me-2 @if (LaravelLocalization::getCurrentLocaleNative() == $properties['native']) text-gray-500
                                                @else
                                                    text-gray-300 @endif" rel="alternate" hreflang="{{ $localeCode }}"
                                        href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                        {{ $properties['native'] }}
                                    </a>
                                    @endforeach
                                </div>
                            </div>

                            <form method="POST" action="{{ route('sett.login') }}">
                                @csrf

                                <div class="form-group mb-1">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">{{
                                        __('patientappo.phone number') }}</label>
                                    <input id="identify" name="identify" type="text"
                                        class="form-control form-control-user @error('identify') is-invalid @enderror"
                                        id="exampleInputEmail" value="{{ old('identify') }}" required
                                        autocomplete="identify" autofocus placeholder="Enter your Mobile or Email...">

                                    @error('identify')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                    @if (count($errors) && in_array(__('auth.throttle'), $errors->get('identify')))
                                    <p>@lang('auth.throttle')</p>
                                    <button>Close</button>
                                    <button>Contact</button>
                                    @endif

                                </div>

                                <div class="form-group">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">{{
                                        __('patientappo.password') }}</label>

                                    <input name="password" type="password"
                                        class="form-control form-control-user @error('password') is-invalid @enderror"
                                        id="password" placeholder="Password" required autocomplete="current-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="d-flex text-center mb-2">
                                    <div class="g-recaptcha" id="feedback-recaptcha"
                                        data-sitekey="{{ env('GOOGLE_RECAPTCHA_KEY') }}"></div>
                                </div>

                                @error('g-recaptcha-response')
                                <span class="error-msg-form">
                                    {{ $message }}
                                </span>
                                @enderror

                                <div class="form-group">
                                    <div class="custom-control custom-checkbox small">
                                        <input type="checkbox" class="custom-control-input-user" name="remember"
                                            id="remember" id="customCheck" {{ old('remember') ? 'checked' : '' }}>
                                        <label class="custom-control-label-user" for="remember">{{ __('basic.remember
                                            me') }}</label>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary btn-user col-12">
                                    {{ __('basic.login') }}
                                </button>

                            </form>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-12 col-md-6 col-lg-8 align-self-center">
                <div class="row">
                    <div
                        class="col-12 px-1 px-md-5 mb-4 mb-md-2 pt-3 pt-md-0 text-center text-md-start d-none d-md-block">
                        <img class="me-2 pe-3" width="200" src="{{ asset('img/website/logo/lam_logo_white.svg') }}">
                    </div>
                    <div class="col-12 px-5 d-none d-md-block ">
                        <h1 class="text-white fw-bold text-xl">{{ __('basic.login msg head 1') }} <span
                                class="fw-light fs-1"> {{ __('basic.login msg line 1') }}</span> </h1>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>


{{-- PWA Application --}}

<script>
    // own toaster notification
setTimeout(()=>{ //hide the toast notification automatically after 5 seconds
    $('#install-app-btn-container').hide();
}, 20000);

$(document).on('click', '.close_toaster_fixed', function() {
    $('#install-app-btn-container').hide();
});


    let installPrompt = null;
    const install_pwa_btn = document.querySelector("#install_pwa_btn");
    let deferredPrompt;

    window.addEventListener("beforeinstallprompt", (event) => {
        event.preventDefault();
        installPrompt = event;
        install_pwa_btn.removeAttribute("hidden");
        $('#install-app-btn-container').show();
        // for install
        deferredPrompt = event;
    });

    install_pwa_btn.addEventListener('click', async () => {
        if (deferredPrompt !== null) {
            deferredPrompt.prompt();
            const { outcome } = await deferredPrompt.userChoice;
            if (outcome === 'accepted') {
                deferredPrompt = null;
            }
        }
    });
</script>
@endsection

<!-- js insert -->
@section('js')
<script>
    $(document).ready(function() {
            alert("Dom Loaded.")
        });

        $(window).on('load', function() {
            alert("Window Loaded.");
        });



</script>




@endsection