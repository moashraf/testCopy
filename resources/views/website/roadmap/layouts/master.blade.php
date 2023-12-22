<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>

    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Meta --}}
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title', 'نظام لام لادارة المدارس والمنشات التعليمية')</title>
    <meta name="description" content="@yield('description', 'نظام لام لادارة المدارس والمنشات التعليمية')">
    <meta name="author" content="نظام لام لادارة المدارس والمنشات التعليمية">
    <meta name="keywords"
        content="@yield('keywords', 'نظام لام,نظام تعليمي شامل,افضل نظام للمدارس السعودية,نظام تعليمي سعودي,')" />
    <meta name='copyright' content='نظام لام لادارة المدارس والمنشات التعليمية'>
    <meta name='robots' content='noindex, nofollow'>
    <meta name='language' content="AR">

    <!-- favicon -->
    <link rel="icon" type="image/x-icon" href="{{ URL::asset('img/dashboard/system/favicon_land.png') }}">

    <!-- Head and css files -->
    @include('website.roadmap.layouts.includes.head')
</head>

<body>

    <!-- Page Loader -->
    <div class="loader-page justify-content-center align-items-center">
        <div class="loader-page-cont">
            <div class="lds-ellipsis">
                <div></div>
                <div></div>
                <div></div>
            </div>
            <img width="100px" src="{{ URL::asset('img/website/logo/lam_logo.svg') }}" alt="">

            <p class="text-gray-400 text-xs mt-2 mb-0">نظام لام لادارة المدارس</p>
            {{-- <p class="text-gray-400 text-xxs">Powered by SHM</p> --}}

        </div>
    </div>

    {{-- help button --}}
    <div class="shadow" id="add_buttn_fixed2">
        <a target="_blank" href="https://wa.me/+201223344249?text=Hello,%20I%20need%20to%20make%20a%20booking?%20Thanks"
            class="text-white text-s">
            تحتاج المساعدة <i class="fas fa-headset"></i>
        </a>
    </div>


    <!-- fixed content -->
    @yield('fixedcontent')

    @yield('full_content')

    <!-- Page Wrapper -->
    <div id="wrapper multi-setps-form-calander " class="d-flex">

        <!-- side bar -->
        @unless(isset($no_sidebar))
        @include('website.roadmap.layouts.includes.sidebar')
        @endunless

        {{-- to hide wrapper in specific pages --}}
        @unless(isset($no_wrapper))
        <!-- Content right Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column flex-grow-1">

            <!-- top bar -->
            @include('website.roadmap.layouts.includes.topbar')

            <!-- Begin Page Content -->
            @yield('content')
            <!-- End content Wrapper -->

            <!-- footer -->
            @include('website.roadmap.layouts.includes.footer')

        </div> <!-- End content left Wrapper -->
        @endunless


    </div> <!-- End content Wrapper -->

    <!-- js scripts -->
    @include('website.roadmap.layouts.includes.footer-script')

</body>


</html>