@extends('website.layouts.master')
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



<section class="mx-5 mx-md-5 px-2 pb-0 pt-5 px-md-5 mb-0 mb-md-5">

    <div class="row bg-white border_radius_20 px-5">

        <div class="col-12 col-md-5 mb-4 mb-xl-0 calander-left-border pt-5">
            <img width="420px" class="img-fluid px-5"
                src="{{ URL::asset('img/website/other/undraw_confirmed_re_sef7.svg') }}" alt="">
        </div>

        <div class="col-12 col-md-7 mb-4 mb-xl-0 px-0 px-md-5 align-self-center">

            <h1 class="text-xl fw-bold">تهانينا!</h1>
            <p class=" text-gray-400">لقد تم بنجاح تاكيد حجزك وتم ارسال رسالة نصية SMS الي هاتفك تحتوي كود الحجز الخاص
                بك. سوف يتم الاتصال بك
                خلال ٢٤ ساعة من تاريخ الحجز من قبل فريقنا</p>
            <hr class=" text-gray-300">
            <div class="d-flex align-items-center">
                <div class="ms-5">
                    <label class="form-label text-gray-400">كود الحجز</label>
                    <div class="main-color-bg-200 border_radius_10 p-3 fw-bold fs-5">BK-22103uk</div>
                </div>
                <a href="#" class="text-dark px-3">الذهاب الي الحجز</a>
            </div>
        </div>
    </div>
</section>

<br>
@endsection


@section('js')

<!-- datapicker date and time -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.js"
    integrity="sha512-K/oyQtMXpxI4+K0W7H25UopjM8pzq0yrVdFdG21Fh5dBe91I40pDd9A4lzNlHPHBIP2cwZuoxaUSX0GJSObvGA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    //-------- datepicker time --------
$('.datepicker_time').flatpickr({
    enableTime: false,
    dateFormat: "Y-m-d",
    theme: "dark", // defaults to "light"
});
</script>

<script>
    var full_height_width_slider_swiper = new Swiper(".full_height_width_slider_swiper", {
    pagination: {
        el: ".swiper-pagination",
    },
});

var swiper = new Swiper(".to_do_desti_swiper", {
    slidesPerView: "auto",
    loop: true,
    touchEventsTarget: 'container',
    slidesPerView: "auto",
    touchEventsTarget: 'container',
    spaceBetween: 10,
    loop: true,

});
</script>


<script src="{{ asset('js/datepicker/t-datepicker.min.js') }}"></script>


<script>
    $('.t-datepicker').tDatePicker({
    autoClose: true,
    durationArrowTop: 200,
    numCalendar: 2
});
</script>

@endsection