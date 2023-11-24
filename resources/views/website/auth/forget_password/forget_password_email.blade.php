@extends('website.layouts.master', ['no_header' => true, 'no_footer' => true, 'no_transparent_header' => false])

@section('title', "تسجيل الدخول في منصة لام - استمتع بتجربة مجانية لمدة 14 يوم بدون دفع الاشتراك")
@section('description', "تسجيل الدخول في منصة لام - استمتع بتجربة مجانية لمدة 14 يوم بدون دفع الاشتراك")
@section('keywords', "نظام لام,نظام تعليمي شامل,افضل نظام للمدارس السعودية,نظام تعليمي سعودي,")

@section('css')


<!-- datepicker time and date -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.css"
    integrity="sha512-MQXduO8IQnJVq1qmySpN87QQkiR1bZHtorbJBD0tzy7/0U9+YIC93QWHeGTEoojMVHWWNkoCp8V6OzVSYrX0oQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/dark.css">

<!-- tdatepicker -->
<link rel="stylesheet" href="{{ asset('js/datepicker/t-datepicker.min.css') }}" />
<link rel="stylesheet" href="{{ asset('js/datepicker/themes/t-datepicker-main.css') }}" />

<link rel="stylesheet" href="{{ asset('js/datepicker/themes/t-datepicker-main.css') }}" />

<style>

</style>
@endsection


@section('content')

<div class="row login_page_cont mx-0">


    <div class="col-12 col-md-4 main-color-bg p-5 d-none d-md-block overflow-hidden">

        <div class="d-flex align-items-center h-100 position-relative">

            <img class="position-absolute z-0" width="500px" style="position: absolute;
            top: 50%;
            right: -95%;
            opacity: 0.03;
            transform: translate(-50%, -50%);" src="{{ URL::asset('img/website/logo/lam_logo_white.svg') }}" alt="">
            <div class="position-absolute z-1">
                <h3 class="text-white mb-3">إنشاء حساب <br>
                    لنظام الإدارة للمدارس</h3>
                <h6 class=" text-white-80 fw-light">يتم إضافة نص ترحيبي هنا، يتم إضافة نص ترحيبي هنا، يتم
                    إضافة نص ترحيبي هنا، يتم إضافة نص ترحيبي هنا</h6>
            </div>
        </div>




    </div>

    <div class="col-12 col-md-8 align-self-center">

        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-7 col-xl-6">

                <div class="bg-white b-r-l-cont shadow py-5 px-4 px-md-5 my-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="fw-bold"> اهلا بك في لام</h6>
                        <a href="{{ route('school_route.login') }}">
                            <div class="link-cust-text text-gray-400 fw-normal text-s mb-3">
                                الرجوع الي تسجيل الدخول
                                <i class="fa-solid fa-arrow-left ms-1"></i>
                            </div>
                        </a>
                    </div>

                    <div class="text-center mb-4">
                        <h3 class="fw-bold mb-2"> استعادة كلمة المرور</h3>
                    </div>
                    <form id="myform_register" method="post"
                        action="{{ route('school_route.check_email_forget_password') }}" style="z-index: 5">
                        @csrf

                        <div class="row">
                            <div class="col-12 mb-3">
                                <label class="form-label">البريد الالكتروني
                                    <small class="fw-light @error('email') is-invalid @enderror">(مطلوب)</small></label>

                                <input id="email" name="email" type="email" class="form-control"
                                    placeholder="اكتب هنا البريد الالكتروني .." value="{{ old('email') }}"
                                    maxlength="60" required>

                                <div id="email-js-error-valid"></div>

                                @error('email')
                                <span class="error-msg-form">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>

                            <div class="text-center mb-3">
                                <button type="submit" class="main_btn border_radius_20 px-5 fw-bold w-100">التالي
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection


@section('js')

@endsection