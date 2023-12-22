@extends('layouts.normmaster')

@section('title', 'contact us')

<!-- css insert -->
@section('css')
@endsection


<!-- content insert -->
@section('content')

<div class="video_intro_log">
    <video width="320" height="240" autoplay>
        <source src="movie.mp4" type="video/mp4">
        <source src="movie.ogg" type="video/ogg">
        Your browser does not support the video tag.
    </video>
</div>




<div class="container-fluid px-0 min-vh-100">

    <!-- Outer Row -->
    <div class="row min-vh-100">
        <div class="col-12 col-md-6 col-lg-7 min-vh-100 position-relative login_body d-flex d-none d-md-block"
            style="background-image: url('{{ asset('img/dashboard/system/doctor-putting-protective-goggles.jpg') }}');">
            <div class="overlay-dark1"></div>

            <div class="position-relative min-vh-100 d-flex align-items-end pb-5">
                <div>
                    <div class=" px-5  ">
                        <h1 class="text-white fw-bold text-xl">Let's <span class="fw-light fs-1">Go Somewhere</span>
                        </h1>

                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 col-lg-5 px-0">
            <div class="bg-white overflow-hidden border-0 shadow-lg min-vh-100  d-flex align-items-center">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="p-5">

                        <div class="mb-2 mb-md-5 text-center text-md-start">
                            <svg class="me-2 border-end border-light pe-3 pb-3" viewBox="25.719 60.652 225.906 78.613"
                                xmlns="http://www.w3.org/2000/svg" width="175px" highet="100px">
                                <text
                                    style="fill: #0d6efd; font-family: Arial, sans-serif; font-size: 65px; font-weight: 700; letter-spacing: -5.1px; white-space: pre;"
                                    x="25.734" y="124.092">Proxima</text>
                                <text
                                    style="fill: #0d6efd; font-family: Arial, sans-serif; font-size: 10px; white-space: pre;"
                                    x="29.252" y="139.145">Tomorrow is Brighter</text>

                            </svg>
                        </div>
                        <div class="px-4">
                            <div class="text-start">
                                <h3 class="text-gray-800 mb-2 fw-bold">Sign in</h3>
                            </div>

                            <form method="POST" action="{{ route('sett.login') }}">
                                @csrf

                                <div class="form-group">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">Phone
                                        Number</label>
                                    <input id="identify" name="identify" type="text"
                                        class="form-control form-control-user @error('identify') is-invalid @enderror"
                                        id="exampleInputEmail" value="{{ old('identify') }}" required
                                        autocomplete="identify" autofocus placeholder="Enter your Mobile or Email...">
                                    @error('identify')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">{{
                                        __('Password') }}</label>

                                    <input name="password" type="password"
                                        class="form-control form-control-user @error('password') is-invalid @enderror"
                                        id="password" placeholder="Password" required autocomplete="current-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <div class="custom-control custom-checkbox small">
                                        <input type="checkbox" class="custom-control-input-user" name="remember"
                                            id="remember" id="customCheck" {{ old('remember') ? 'checked' : '' }}>
                                        <label class="custom-control-label-user" for="remember">Remember
                                            Me</label>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary btn-user col-12">
                                    Login
                                </button>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="{{ route('sett.password.request') }}">Forgot
                                    Password?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="register.html">Create an Account!</a>
                            </div>
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