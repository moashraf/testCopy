<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="Description" content="Proxima for medical management">
    <meta name="Author" content="Proxima | medical management">
    <link rel="icon" type="image/x-icon" href="{{ URL::asset('img/dashboard/system/favicon.png') }}">
    <meta name='robots' content='noindex, nofollow'>

    <!-- Head and css files -->
    @include('layouts.includes.head')

    @laravelPWA
</head>

<body>

    <!-- Page Loader -->
    <div class="loader-page justify-content-center align-items-center">
        <div class="loader-page-cont">
            <div class="lds-ellipsis">
                <div></div>
                <div></div>
            </div>
            <img class="mb-2" width="80" src="{{ URL::asset('img/website/logo/lam_logo.svg') }}" alt="">

            <p class="text-gray-400 text-xs mb-0">Lam For School Managament</p>
            {{-- <p class="text-gray-400 text-xxs">Powered by SHM</p> --}}

        </div>
    </div>

    <!-- fixed content -->
    @yield('fixedcontent')

    @yield('full_content')

    <!-- Page Wrapper -->
    <div id="wrapper" class="d-flex">

        <!-- side bar -->
        @unless(isset($no_sidebar))
        @include('layouts.includes.sidebar')
        @endunless

        {{-- to hide wrapper in specific pages --}}
        @unless(isset($no_wrapper))
        <!-- Content right Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column flex-grow-1">

            <!-- top bar -->
            @include('layouts.includes.topbar')

            <!-- Begin Page Content -->
            @yield('content')
            <!-- End content Wrapper -->

            <!-- footer -->
            @include('layouts.includes.footer')

        </div> <!-- End content left Wrapper -->
        @endunless

    </div> <!-- End content Wrapper -->

    <!-- js scripts -->
    @include('layouts.includes.footer-script')

</body>


</html>