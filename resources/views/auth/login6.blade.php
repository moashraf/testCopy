@extends('layouts.normmaster')

@section('title', 'Login | Lam - School Management App')

<!-- css insert -->
@section('css')

<!-- google recaptcha -->
<script src="https://www.google.com/recaptcha/api.js" async defer></script>

@endsection


<!-- content insert -->
@section('content')

<div class="video_intro_log">
    <div style="position: relative; overflow: hidden; padding-top: 56.25%;"><iframe
            src="https://share.synthesia.io/embeds/videos/08600113-eb38-4da2-9c2e-94d3aaad89e2" loading="lazy"
            title="Synthesia video player - Your AI video" allow="encrypted-media; fullscreen;"
            style="position: absolute; width: 100%; height: 100%; top: 0; left: 0; border: none; padding: 0; margin: 0; overflow:hidden;"></iframe>
    </div>
</div>


<div class="login_body" style="background-image: url('{{ asset('img/dashboard/system/doctor-lab.jpg') }}');">

    <div class="overlay-dark1"></div>

    <div class="container-fluid px-3 px-md-5">

        <!-- Outer Row -->
        <div class="row justify-content-center min-vh-100 align-content-center position-relative">
            <div class="col-12 col-md-6 col-lg-7 align-self-center">
                <div class="row">
                    <div class="col-12 px-1 px-md-5 mb-2 mb-md-4 pt-3 pt-md-0 text-center text-md-start">
                        <svg class="me-2 border-end border-light pe-3 pb-3" viewBox="25.719 19.652 225.906 121.613"
                            xmlns="http://www.w3.org/2000/svg" width="160px">
                            <text
                                style="fill: rgb(255, 255, 255); font-family: Arial, sans-serif; font-size: 65px; font-weight: 700; letter-spacing: -5.1px; white-space: pre;"
                                x="25.734" y="124.092">Proxima</text>
                            <text
                                style="fill: rgb(255, 255, 255); font-family: Arial, sans-serif; font-size: 10px; white-space: pre;"
                                x="29.252" y="139.145">Tomorrow is Brighter</text>
                            <path
                                d="M 171.934 41.222 L 147.195 20.607 C 144.541 18.403 140.431 20.245 140.431 23.776 L 140.431 65.006 C 140.431 68.537 144.541 70.392 147.195 68.176 L 171.934 47.561 C 173.904 45.912 173.904 42.871 171.934 41.222 Z M 138.949 41.222 L 114.211 20.607 C 111.557 18.403 107.447 20.245 107.447 23.776 L 107.447 65.006 C 107.447 68.537 111.557 70.392 114.211 68.176 L 138.949 47.561 C 140.921 45.912 140.921 42.871 138.949 41.222 Z"
                                style="fill: rgb(255, 255, 255);" />
                        </svg>
                        <img src="{{ asset('img/dashboard/system/pc-loader-white.png') }}">
                    </div>
                    <div class="col-12 px-5 d-none d-md-block ">
                        <h1 class="text-white fw-bold text-xl">{{ __('basic.login msg head 1') }} <span
                                class="fw-light fs-1"> {{ __('basic.login msg line 1') }}</span> </h1>

                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6 col-lg-5 mb-4 mb-md-0">
                <div class="card overflow-hidden border-0 shadow-lg">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="p-5">
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
                                    <label for="password" class="col-md-7 col-form-label text-md-right">{{
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
        </div>

    </div>

</div>
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