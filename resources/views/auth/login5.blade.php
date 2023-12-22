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




<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center min-vh-100 align-content-center">

        <div class="col-xl-10 col-lg-12 col-md-12">

            <div class="card overflow-hidden border-0 shadow-lg">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">

                        <div class="col-0 col-6 bg-login-image"
                            style="background-image: url('{{ asset('img/dashboard/system/login-amr.jpg') }}');">
                            <div class="overlay-1"></div>
                            <div class="bg-login-image-cont">
                                <img src="{{ asset('img/dashboard/system/paincurelogo.png') }}">
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="p-5">

                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                </div>

                                <form method="POST" action="{{ route('sett.login') }}">
                                    @csrf

                                    <div class="form-group">
                                        <label for="password" class="col-md-4 col-form-label text-md-right">Phone
                                            Number</label>
                                        <input id="identify" name="identify" type="text"
                                            class="form-control form-control-user @error('identify') is-invalid @enderror"
                                            id="exampleInputEmail" value="{{ old('identify') }}" required
                                            autocomplete="identify" autofocus
                                            placeholder="Enter your Mobile or Email...">
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
                                            id="password" placeholder="Password" required
                                            autocomplete="current-password">

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

                                    <hr>
                                    <button href="index.html" class="btn btn-google btn-user col-12 mb-2">
                                        <i class="fab fa-google fa-fw"></i> Login with Google
                                    </button>
                                    <button href="index.html" class="btn btn-facebook btn-user col-12">
                                        <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
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