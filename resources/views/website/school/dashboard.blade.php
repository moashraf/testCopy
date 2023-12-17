@extends('website.school.layouts.master', ['no_header' => true, 'no_transparent_header' => false])

@section('title', 'الصفحة الرئيسية لمدرستك في منصة لام | منصة لام')
@section('topbar', 'الصفحة الرئيسية لمدرستك في منصة لام | منصة لام')

<!-- css insert -->
@section('css')

<!-- swiper -->
<link rel="stylesheet" href="https://fastly.jsdelivr.net/npm/swiper/swiper-bundle.min.css" />

@endsection


@section('fixedcontent')

<div class="position-fixed main-color-bg text-white p-2 px-3 z-3 clickable-item-pointer" id="video_toutrial_cont"
    data-bs-toggle="modal" data-bs-target="#video_toutrial_modal"
    style="top: 18%; left:0%; border-radius: 0px 10px 10px 0px;">
    <div class="d-flex">
        <i class="fas fa-video me-2"></i>
        <h6 id="video_toutrial_modal_text" class="mb-0 text-s" style="display: none">شرح الصفحة الرئيسية </h6>
    </div>
</div>


<!-- Modal for search filtering -->
<div class="modal fade" id="video_toutrial_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">

        <div class="modal-content b-r-s-cont border-0">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="exampleModalLabel">
                    شرح الصفحة الرئيسية
                </h5>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
            </div>

            <!-- Modal content -->
            <div class="modal-body px-5 py-3">
                <div class="text-center">
                    <iframe class="col-12" width="560" height="315" src="{{ $video_tutorial->url }}"
                        title="YouTube video player" frameborder="0"
                        allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<!-- content insert -->
@section('content')

<div class="container-fluid px-4 px-md-5 py-3 py-md-4">

    <div class="row main_cot_bg p-4 align-items-center mb-4">

        <div class="col-12 col-xl-3 calander-left-border mb-3 mb-xl-0">
            <div class="row">
                <div class="col-6 col-md-12 d-flex align-items-center mb-0 mb-md-3">
                    <img class="me-2" alt="school" src="{{ URL::asset('img/icons/dashboard/dashboard_1.svg') }}">
                    <h6 class="fw-normal text-s mb-0">الفصل الدراسي: <span class="fw-bold">الاول</span></h6>
                </div>
                <div class="col-6 col-md-12 d-flex align-items-center">
                    <img class="me-2" alt="school" src="{{ URL::asset('img/icons/dashboard/dashboard_2.svg') }}">
                    <h6 class="fw-normal text-s mb-0">الاسبوع الدراسي: <span class="fw-bold">الخامس</span></h6>
                </div>
            </div>

        </div>
        <div class="col-12 col-xl-5 calander-left-border  mb-3 mb-xl-0">
            <div class="d-flex justify-content-between mb-2">
                <h6 class="text-s mb-0">عدد ايام الدراسة</h6>
                <h6 class="text-s mb-0 fw-bold">100</h6>
            </div>
            <div>
                <div class="progress progress_percentage mb-2">
                    <div class="progress-bar" role="progressbar" style="width: 40%" aria-valuenow="60" aria-valuemin="0"
                        aria-valuemax="100"></div>
                </div>
            </div>
            <div class="d-flex justify-content-between">
                <h6 class="text-s mb-0">عدد أيام الدراسة المتبقية</h6>
                <h6 class="text-s mb-0 fw-bold">40</h6>
            </div>
        </div>
        <div class="col-12 col-xl-4">
            <div class="d-flex flex-column ps-0 ps-xl-2">
                <div class="d-flex justify-content-start mb-2">
                    <div class="d-flex align-items-center me-5">
                        <img class="me-2" alt="school" src="{{ URL::asset('img/icons/dashboard/dashboard_2.svg') }}">
                        <h6 class="text-s mb-0 ">{{ $today_date_ar }}</h6>
                    </div>
                    <div class="d-flex align-items-center">
                        <img class="me-2" alt="school" width="19"
                            src="{{ URL::asset('img/icons/dashboard/dashboard_3.svg') }}">
                        <h6 class="text-s mb-0">{{ $hijri_date }}</h6>
                    </div>
                </div>

                <div class="d-flex align-items-center">
                    <div class="progress_bar_circle me-2">
                        <div class="single-chart">
                            <svg viewBox="0 0 36 36" class="circular-chart main_color_prog_bar_circle">
                                <path class="circle-bg" d="M18 2.0845
                            a 15.9155 15.9155 0 0 1 0 31.831
                            a 15.9155 15.9155 0 0 1 0 -31.831" />
                                <path class="circle" stroke-dasharray="65, 100" d="M18 2.0845
                            a 15.9155 15.9155 0 0 1 0 31.831
                            a 15.9155 15.9155 0 0 1 0 -31.831" />
                                <text x="18" y="20.35" class="percentage_circle fw-bold">65%</text>
                            </svg>
                        </div>
                    </div>
                    <h6 class="text-s mb-0">متبقي من رصيد الرسائل النصية 65%</h6>
                </div>
            </div>

        </div>

    </div>

    <div class="row mb-4">
        <div class="col-12 mx-0 px-0">
            <div class="swiper full_height_width_slider_swiper_weekly header_destination" style="height: 170px">
                <div class="swiper-wrapper">
                    @foreach ($sliders as $item)
                    <div class="swiper-slide weekly_destination object-fit-cover px-3 px-md-5 mb-0 border_radius_10"
                        style="background-image: url('{{ URL::asset('img/sliders/'. $item->img) }}'); background-size: cover; background-position: center;">
                        <div class="row">
                            <div class="col-12">
                                <a href="#">
                                    <div>
                                        <div
                                            class="d-flex flex-wrap position-absolute bottom-0 z-2 px-2 px-md-3 align-items-center mb-2 pb-1">
                                            <div class=" text-shadow-200">
                                                <h1 class="text-white fw-bold">{{ $item->name }}</h1>
                                                <div class="text-white-80 fw-light mb-2 w-75 mb-4 d-none d-md-block">
                                                    {!! $item->description !!}</div>
                                            </div>

                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </div>


    <div class="row mb-3">
        <div class="col-12 col-md-6 col-xl-3 px-2 mb-3 mb-md-3 mb-xl-0">
            <div class="d-flex main_cot_bg p-3">
                <img class="me-3" alt="school" src="{{ URL::asset('img/icons/dashboard/dashboard_4.svg') }}">
                <div>
                    <h6 class=" text-gray-400 mb-0">عدد فصول المدرسة</h6>
                    <h5 class="fw-bold">{{ count($school->grades) }} <span class="text-xxs text-gray-200">فصول</span>
                    </h5>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-xl-3 px-2 mb-3 mb-md-3 mb-xl-0">
            <div class="d-flex main_cot_bg p-3">
                <img class="me-3" alt="school" src="{{ URL::asset('img/icons/dashboard/dashboard_5.svg') }}">
                <div>
                    <h6 class=" text-gray-400 mb-0">عدد طلاب المدرسة</h6>
                    <h5 class="fw-bold">{{ count($school->students) }} <span class="text-xxs text-gray-200">طالب</span>
                    </h5>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-xl-3 px-2 mb-3 mb-md-3 mb-xl-0">
            <div class="d-flex main_cot_bg p-3">
                <img class="me-3" alt="school" src="{{ URL::asset('img/icons/dashboard/dashboard_6.svg') }}">
                <div>
                    <h6 class=" text-gray-400 mb-0">عدد معلمين المدرسة</h6>
                    <h5 class="fw-bold">{{ count($school->teachers) }} <span class="text-xxs text-gray-200">معلم</span>
                    </h5>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-xl-3 px-2 mb-3 mb-md-3 mb-xl-0">
            <div class="d-flex main_cot_bg p-3">
                <img class="me-3" alt="school" src="{{ URL::asset('img/icons/dashboard/dashboard_6.svg') }}">
                <div>
                    <h6 class=" text-gray-400 mb-0">عدد الاداريين المدرسة</h6>
                    <h5 class="fw-bold">{{ count($school->administrators) }} <span
                            class="text-xxs text-gray-200">اداري</span></h5>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-12 col-md-6 col-xl-3 px-2 mb-3 mb-md-3 mb-xl-0">
            <div class="d-flex main_cot_bg p-3">
                <img class="me-3" alt="school" src="{{ URL::asset('img/icons/dashboard/dashboard_7.svg') }}">
                <div>
                    <h6 class=" text-gray-400 mb-0">عدد حضور الطلاب</h6>
                    <h5 class="fw-bold">431 <span class="text-xxs text-gray-200">طالب</span>
                    </h5>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-xl-3 px-2 mb-3 mb-md-3 mb-xl-0">
            <div class="d-flex main_cot_bg p-3">
                <img class="me-3" alt="school" src="{{ URL::asset('img/icons/dashboard/dashboard_8.svg') }}">
                <div>
                    <h6 class=" text-gray-400 mb-0">عدد غياب الطلاب</h6>
                    <h5 class="fw-bold">20 <span class="text-xxs text-gray-200">طالب</span>
                    </h5>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-xl-3 px-2 mb-3 mb-md-3 mb-xl-0">
            <div class="d-flex main_cot_bg p-3">
                <img class="me-3" alt="school" src="{{ URL::asset('img/icons/dashboard/dashboard_7.svg') }}">
                <div>
                    <h6 class=" text-gray-400 mb-0">عدد حضور المعلمين</h6>
                    <h5 class="fw-bold">51 <span class="text-xxs text-gray-200">معلم</span>
                    </h5>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-xl-3 px-2 mb-3 mb-md-3 mb-xl-0">
            <div class="d-flex main_cot_bg p-3">
                <img class="me-3" alt="school" src="{{ URL::asset('img/icons/dashboard/dashboard_8.svg') }}">
                <div>
                    <h6 class=" text-gray-400 mb-0">عدد غياب المعلمين</h6>
                    <h5 class="fw-bold">5 <span class="text-xxs text-gray-200">اداري</span></h5>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-12 col-md-4 mb-3 mb-md-0">
            <div class="main_cot_bg p-3 py-4 h-100">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="fw-bold text-s2">التقويم</h5>
                    <button type="button" class="main_btn border_radius_5 text-s px-3 py-2 mb-0">خطة
                        المدير</button>
                </div>

                <div id="calander_cont">
                    <!-- calander ajax content -->
                </div>


            </div>
        </div>

        <div class="col-12 col-md-4 mb-3 mb-md-0">
            <div class="main_cot_bg p-3 py-4 h-100 ">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="fw-bold text-s2">الخطة اليومية</h5>
                        <p class="text-xs text-gray-400 mb-0">{{ $today_date_ar }}</p>
                    </div>
                    <button type="button" class="main_btn border_radius_5 text-s px-3 py-2 mb-0"><i
                            class="fas fa-plus me-1"></i>
                        اضافة مهمة</button>
                </div>
                <hr>
                <h5 class="text-s2 mb-3">المهمات (5)</h5>

                <ul class="no_dots_ul ps-0 mb-0" style="overflow: scroll; height: 16.7rem; ">
                    <li class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h6 class="text-xs text-decoration-line-through"> <i
                                    class="fas fa-check-circle main-color me-1"></i>
                                إجازة عيد الأضحي المبارك
                            </h6>
                        </div>

                        <div class="status_normal b-r-l-cont text-xs ms-2">
                            حدث
                        </div>
                    </li>
                    <li class="d-flex justify-content-between align-items-cente mb-3">
                        <div>
                            <h6 class="text-xs text-decoration-line-through"> <i
                                    class="fas fa-check-circle main-color me-1"></i>
                                زيارة لمدرسة الروضة الإعدادية يوم 30 أغسطس 2024
                            </h6>
                        </div>
                        <div class="red_normal b-r-l-cont text-xs ms-2">
                            مهمة
                        </div>
                    </li>
                    <li class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h6 class="text-xs text-decoration-line-through"> <i
                                    class="fas fa-check-circle main-color me-1"></i>
                                ترتيب وتنظيم أوراق التظلمات الخاصة بالطلاب للمراجعة قريبا
                            </h6>
                        </div>
                        <div class="red_normal b-r-l-cont text-xs ms-2">
                            مهمة
                        </div>
                    </li>
                    <li class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h6 class="text-xs"> <i class="far fa-circle main-color me-1"></i>
                                جدولة الإمتحانات الخاصة بطلاب الصف الأول الثانوي
                            </h6>
                        </div>
                        <div class="red_normal b-r-l-cont text-xs ms-2">
                            مهمة
                        </div>
                    </li>
                    <li class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h6 class="text-xs"> <i class="far fa-circle main-color me-1"></i>
                                إجتماع مع المدير لمناقشة بعض الأمور الخاصة بالمدرسة
                            </h6>
                        </div>
                        <div class="red_normal b-r-l-cont text-xs ms-2">
                            مهمة
                        </div>
                    </li>
                    <li class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h6 class="text-xs"> <i class="far fa-circle main-color me-1"></i>
                                إجتماع مع المدير لمناقشة بعض الأمور الخاصة بالمدرسة
                            </h6>
                        </div>
                        <div class="red_normal b-r-l-cont text-xs ms-2">
                            مهمة
                        </div>
                    </li>
                    <li class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h6 class="text-xs"> <i class="far fa-circle main-color me-1"></i>
                                إجتماع مع المدير لمناقشة بعض الأمور الخاصة بالمدرسة
                            </h6>
                        </div>
                        <div class="red_normal b-r-l-cont text-xs ms-2">
                            مهمة
                        </div>
                    </li>
                    <li class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h6 class="text-xs"> <i class="far fa-circle main-color me-1"></i>
                                إجتماع مع المدير لمناقشة بعض الأمور الخاصة بالمدرسة
                            </h6>
                        </div>
                        <div class="red_normal b-r-l-cont text-xs ms-2">
                            مهمة
                        </div>
                    </li>
                </ul>

            </div>
        </div>

        <div class="col-12 col-md-4 mb-3 mb-md-0">
            <div class="main_cot_bg p-3 py-4 h-100">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="fw-bold text-s2">الانشطة الاخيرة</h5>
                    </div>
                </div>

                <ul class="px-2 pe-md-4 progressbar_log_file mb-0 mt-0 py-0" style="overflow: scroll; height: 20.5rem;">
                    <li>
                        <a class="d-flex align-items-center">
                            <div class="icon-circle d-flex align-items-center justify-content-center me-2">
                                <img class="platform_icon" alt="upload file from nour platform"
                                    src="{{ URL::asset('img/icons/logs/trash.svg') }}">
                            </div>
                            <div>
                                <h6 class="mb-1 text-xxs fw-bold">تم حذف نموذج جدول المناوبة من قبل <span
                                        class="text-decoration-underline">أحمد عبد الرحمن</span></h6>
                                <h6 class="mb-0 text-xxxs">22 أغسطس 2023 </h6>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a class="d-flex align-items-center">
                            <div class="icon-circle d-flex align-items-center justify-content-center me-2">
                                <img class="platform_icon" alt="upload file from nour platform"
                                    src="{{ URL::asset('img/icons/logs/add.svg') }}">
                            </div>
                            <div>
                                <h6 class="mb-1 text-xxs fw-bold">تم إنشاء إجتماع اللجنة الصحية من قبل<span
                                        class="text-decoration-underline">أحمد صلاح</span></h6>
                                <h6 class="mb-0 text-xxxs">22 أغسطس 2023 </h6>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a class="d-flex align-items-center">
                            <div class="icon-circle d-flex align-items-center justify-content-center me-2">
                                <img class="platform_icon" alt="upload file from nour platform"
                                    src="{{ URL::asset('img/icons/logs/edit.svg') }}">
                            </div>
                            <div>
                                <h6 class="mb-1 text-xxs fw-bold">تم تعديل جدول الطلاب من قبل<span
                                        class="text-decoration-underline">ابراهيم الزيني</span></h6>
                                <h6 class="mb-0 text-xxxs">22 أغسطس 2023 </h6>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a class="d-flex align-items-center">
                            <div class="icon-circle d-flex align-items-center justify-content-center me-2">
                                <img class="platform_icon" alt="upload file from nour platform"
                                    src="{{ URL::asset('img/icons/logs/trash.svg') }}">
                            </div>
                            <div>
                                <h6 class="mb-1 text-xxs fw-bold">تم حذف نموذج جدول المناوبة من قبل<span
                                        class="text-decoration-underline">محمد حسين</span></h6>
                                <h6 class="mb-0 text-xxxs">22 أغسطس 2023 </h6>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>


    <div class="row">

        <div class="col-12 mb-3 mb-md-0">
            <div class="main_cot_bg p-3 py-3 h-100">
                <h5 class="fw-bold text-s2">الوصول السريع</h5>
                <p class="text-gray-300 text-xs">يمكنك الذهاب مباشرة للمنصات التي تهمك</p>


                <div class="row">
                    <div class="col-12 col-md-3 mb-3 mb-md-0">
                        <div
                            class="d-flex justify-content-between border_radius_10 border-gray-600 align-items-center p-2">
                            <img class="me-2" alt="school" src="{{ URL::asset('img/external_systems/system_1.png') }}">
                            <a href="#" target="__blank">
                                <button type="button" class="main_btn border_radius_5 text-xxs px-2 py-1 mb-0" style="height: 40px;font-size: 12px;
                                "><i class="fas fa-share-square me-1"></i>
                                    الذهاب الآن</button>
                            </a>
                        </div>
                    </div>
                    <div class="col-12 col-md-3 mb-3 mb-md-0">
                        <div
                            class="d-flex justify-content-between border_radius_10 border-gray-600 align-items-center p-2">
                            <img class="me-2" width="60" alt="school"
                                src="{{ URL::asset('img/external_systems/system_2.png') }}">
                            <a href="#" target="__blank">
                                <button type="button" class="main_btn border_radius_5 text-xxs px-2 py-1 mb-0" style="height: 40px;font-size: 12px;
                                "><i class="fas fa-share-square me-1"></i>
                                    الذهاب الآن</button>
                            </a>
                        </div>
                    </div>
                    <div class="col-12 col-md-3 mb-3 mb-md-0">
                        <div
                            class="d-flex justify-content-between border_radius_10 border-gray-600 align-items-center p-2">
                            <img class="me-2" width="95" alt="school"
                                src="{{ URL::asset('img/external_systems/system_3.png') }}">
                            <a href="#" target="__blank">
                                <button type="button" class="main_btn border_radius_5 text-xxs px-2 py-1 mb-0" style="height: 40px;font-size: 12px;
                                "><i class="fas fa-share-square me-1"></i>
                                    الذهاب الآن</button>
                            </a>
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div
                            class="d-flex justify-content-between border_radius_10 border-gray-600 align-items-center p-2">
                            <img class="me-2" alt="school" width="95"
                                src="{{ URL::asset('img/external_systems/system_4.png') }}">
                            <a href="#" target="__blank">
                                <button type="button" class="main_btn border_radius_5 text-xxs px-2 py-1 mb-0" style="height: 40px;font-size: 12px;
                                "><i class="fas fa-share-square me-1"></i>
                                    الذهاب الآن</button>
                            </a>
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

{{-- swiper --}}
<script src="https://fastly.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
<script>
    var full_height_width_slider_swiper_weekly = new Swiper(".full_height_width_slider_swiper_weekly", {
        pagination: {
        el: ".swiper-pagination",
      },
        autoplay: {
            delay: 5000,
        },
        loop: true,
        touchEventsTarget: 'container',
    });


    // Calendar
    fetchCalander();

    function fetchCalander(month = {{ date('m') }}, year = {{ date('Y') }}) {

        var url =
            "{{ route('school_route.calander_tasks_ajax', [':month', ':year']) }}";
        url = url.replace(':month', month).replace(':year', year)
        ;
        $.ajax({
            url: url,
            type: "GET",
            success: function(data) {
                $("#calander_cont").html(data);
            }
        });
    }

    //reinsert the calander when the month arrows are clicked
    $(document).on('click', '#change_month', function() {
        var month = $(this).data('month');
        var year = $(this).data('year');
        fetchCalander(month, year)
    });
</script>



@endsection