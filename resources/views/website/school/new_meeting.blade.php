@extends('website.school.layouts.master', ['no_header' => true, 'no_transparent_header' => false])
@php
    $initialTab = 'pills-home'; // Replace 'pills-home' with the actual tab ID you want to set from the backend
    $tabs = [
        [
            'id' => 'pills-home',        // Unique ID for the tab
            'label' => 'بيانات الاجتماع',    // Tab label
        ],
        [
            'id' => 'pills-profile',
            'label' => 'محضر الاجتماع',
        ],
    ];
@endphp
@section('title', 'الصفحة الرئيسية لمدرستك في منصة لام | منصة لام')
@section('topbar', 'الصفحة الرئيسية لمدرستك في منصة لام | منصة لام')

<!-- css insert -->
@section('css')
    <!-- swiper -->
    <link rel="stylesheet" href="https://fastly.jsdelivr.net/npm/swiper/swiper-bundle.min.css" />
    <style>
        /* Add your custom CSS styles here */
    </style>
@endsection

@section('fixedcontent')
    <!-- Your fixed content here -->
@endsection

<!-- content insert -->
@section('content')
    <div class="container-fluid px-4 px-md-5 py-3 py-md-4">
        <div class="row">
            <div class="row main_cot_bg p-2 align-items-center mb-4" style=" font-size: .9rem;  background-color: #0A3A81;">
                <div class="col-12 col-xl-12">
                    <h5 class="  text-s2" style="     margin-top: 0.5rem;   color: white;">
                        إجتماعات اللجان والفرق
                    </h5>
                </div>
            </div>
            <form action="{{ route('school_route.meetings.store') }}" method="POST" enctype="multipart/form-data" class="custom-form">
                @csrf <!-- CSRF Token for Laravel protection -->
            <div class="col-12 mb-3 mb-md-0">
                <div class="main_cot_bg p-3 py-3 h-100">
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        @foreach ($tabs as $tab)
                            <li class="nav-item" role="presentation">
                                <button class="nav-link{{ $tab['id'] === $initialTab ? ' active tabcontent_active' : '' }}" id="{{ $tab['id'] }}-tab" data-bs-toggle="pill" data-bs-target="#{{ $tab['id'] }}" type="button" role="tab" aria-controls="{{ $tab['id'] }}" aria-selected="{{ $tab['id'] === $initialTab ? 'true' : 'false' }}">
                                    {{ $tab['label'] }}
                                </button>
                            </li>
                        @endforeach
                    </ul>

                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade  show active " id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                            <div class="container form-container">
                                <div class="card custom-card">
                                    <div class="Committees_and_teams_meetings_create_title">
                                        إنشاء اجتماع اللجنة الإدارية
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="card-body custom-card-body">

                                                    <input type="hidden" id="committees_and_teams_id" name="committees_and_teams_id" value="{{ request('Committees_id') ?? ($item_val ?$item_val['committees_and_teams_id']:'')}}" class="  form-control">
                                                    <input type="hidden" id="status" name="status" value="1" class="  form-control">

                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-md-3 align-self-center">
                                                                <label for="type" class="form-label">نوع الاجتماع</label>
                                                            </div>
                                                            <div class="col-md-9">
                                                                <select required name="type" id="type" class="form-control custom-select">
                                                                    <option selected>اختر نوع الاجتماع</option>
                                                                    <option value="1">طارئ</option>
                                                                    <option value="2">دوري</option>
                                                                    <!-- Other options -->
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="  form-group">
                                                        <div class="row">
                                                            <div class="col-md-3 align-self-center ">
                                                                <label  for="committee" class="form-label  ">تاريخ الاجتماع </label>
                                                            </div>
                                                            <div class="col-md-9">
                                                                <input type="date" id="date" name="start_date" class=" form-control">

                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="  form-group">
                                                        <div class="row">
                                                            <div class="col-md-3 align-self-center ">
                                                                <label  for="committee" class="form-label" >عنوان  الاجتماع </label>
                                                            </div>
                                                            <div class="col-md-9">

                                                                <input type="text" id="title" name="title" value="{{$item_val ?$item_val['title']:''}}" class="  form-control">

                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="  form-group">
                                                        <div class="row">
                                                            <div class="col-md-3 align-self-center ">
                                                                <label  for="committee" class="form-label  ">موعد الاجتماع </label>
                                                            </div>
                                                            <div class="col-md-9">
                                                                <input type="time" id="time" name="start_time" class="  form-control">
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="  form-group">
                                                        <div class="row">
                                                            <div class="col-md-3 align-self-center ">
                                                                <label  for="committee" class="form-label">مكان  الاجتماع </label>
                                                            </div>
                                                            <div class="col-md-9">
                                                                <input type="text" id="committee_place" name="committee_place" class="form-control" value="{{$item_val?$item_val['location']:''}}">
                                                            </div>
                                                        </div>
                                                    </div>



                                                    <div class="  form-group">
                                                        <div class="row">
                                                            <div class="col-md-3 align-self-center ">
                                                                <label  for="committee" class="form-label  "> الفصل الدراسي    </label>
                                                            </div>
                                                            <div class="col-md-9">
                                                                <input type="text" id="Semester" name="Semester" class="  form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Add more form fields here -->

                                                    <div class="row form-group" style="padding-top: 51px;">
                                                        <div class="col-md-6">
                                                            <button style="color: #0A3A81; border: 1px solid #e6a935; width: 50%;" type="reset" class="col-md-3 btn btn-default custom-reset-button">إنهاء</button>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <button style="background-color: #0A3A81; width: 50%;" type="button" class="col-md-3 float-end btn btn-primary custom-submit-button" onclick="goToSecondTab()">التالي</button>
                                                        </div>
                                                    </div>

                                            </div>
                                        </div>
                                        <div class="col-md-4"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                            <!-- Second tab content goes here -->
                            <div class="container form-container">
                                <div class="card custom-card">
                                    <div id="meeting_title" class="   Committees_and_teams_meetings_create_title ">
                                        إنشاء اجتماع اللجنة الإدارية
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12" >
                                            <div class="card-body custom-card-body">

                                                    <div class="  form-group">
                                                        <div class="row">
                                                            <div class="col-md-2 align-self-center ">
                                                                <label  for="committee" class="form-label  ">   الفئه المستهدفه </label>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <select required name="committees_and_teams_id" id="committee"  class=" form-control custom-select">
                                                                    <option   selected>اختر نوع الفئه</option>
                                                                    <option value="1"  >1</option>
                                                                    <option value="2">2</option>
                                                                    <!-- Other options -->
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
<input type="hidden" name="meeting_id" id="meeting_id" value="{{$item_val ?$item_val['id']:''}}">
                                                    <div class="  form-group">
                                                        <div class="row">
                                                            <div class="col-md-2 align-self-center ">
                                                                <label  for="committee" class="form-label  "> عدد الحاضرين    </label>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <select required name="committees_and_teams_id" id="committee"  class=" form-control custom-select">
                                                                    <option   selected> عدد الحاضرين     </option>
                                                                    <option value="1"  >1</option>
                                                                    <option value="2">2</option>
                                                                    <!-- Other options -->
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="  form-group">
                                                        <div class="row">
                                                            <label  for="committee" class="form-label  " >    جدول اعمل الاجتماع  </label>

                                                            <div class="col-md-1 align-self-center ">
                                                                <label  for="committee" class="form-label  " >    1 </label>
                                                            </div>
                                                            <div class="col-md-11 add-padding-bottom">
                                                                <input type="text"  name="meeting_agenda_item[]" value=" " class="  form-control">
                                                            </div>

                                                            <div class="col-md-1 align-self-center ">
                                                                <label  for="committee" class="form-label  " >    2 </label>
                                                            </div>
                                                            <div class="col-md-11 add-padding-bottom ">
                                                                <input type="text"  name="meeting_agenda_item[]" value=" " class="  form-control">

                                                            </div>
                                                            <div class="col-md-1 align-self-center ">
                                                                <label  for="committee" class="form-label  " >    3 </label>
                                                            </div>
                                                            <div class="col-md-11 add-padding-bottom">
                                                                <input type="text"  name="meeting_agenda_item[]" value=" " class="  form-control">
                                                            </div>


                                                        </div>
                                                    </div>


                                                    <div class="  form-group">
                                                        <div class="row">
                                                            <label  for="committee" class="form-label  "> التوصيات    </label>


                                                            <div class="col-md-3 add-padding-bottom">
                                                                <input type="text"  name="recommendation_item[]" class="  form-control">
                                                            </div>
                                                            <div class="col-md-3 add-padding-bottom">
                                                                <input type="text"  name="recommendation_item[]" class="  form-control">
                                                            </div>
                                                            <div class="col-md-3 add-padding-bottom">
                                                                <input type="text"  name="recommendation_item[]" class="  form-control">
                                                            </div>
                                                            <div class="col-md-3 add-padding-bottom">
                                                                <input type="text"  name="recommendation_item[]" class="  form-control">
                                                            </div>

                                                            <div class="col-md-3">
                                                                <input type="text"  name="recommendation_item[]" class="  form-control">
                                                            </div>
                                                            <div class="col-md-3">
                                                                <input type="text"  name="recommendation_item[]" class="  form-control">
                                                            </div>
                                                            <div class="col-md-3">
                                                                <input type="text"  name="recommendation_item[]" class="  form-control">
                                                            </div>
                                                            <div class="col-md-3">
                                                                <input type="text"  name="recommendation_item[]" class="  form-control">
                                                            </div>

                                                        </div>
                                                    </div>


                                                    <div class="  form-group">
                                                        <div class="row">
                                                            <div class="col-md-3 align-self-center ">
                                                                <label  for="committee" class="form-label  ">  موعد انتهاء الاجتماع  </label>
                                                            </div>
                                                            <div class="col-md-9">
                                                                <input type="date" id="committee_place" name="committee_place" class="  form-control">
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <!-- Repeat for other fields with appropriate classes -->

                                                    <div class="row form-group " style="padding-top: 51px;" >
                                                        <div class="col-md-6">
                                                            <button  style="color: #0A3A81; border: 1px solid #e6a935; width: 50%;" type="reset" class="col-md-3 btn btn-default  custom-reset-button">  السابق    </button>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <button style=" background-color: #0A3A81;  width: 50%;  "  type="submit" class="col-md-3 float-end btn btn-primary custom-submit-button">حفظ وانهاء </button>
                                                        </div>
                                                    </div>

                                            </div>

                                </div>
                            </div>

                        </div>
                    </div>

                </div>
                    </div>
                </div>
            </div>
            </form>
        </div>

    </div>
@endsection

<!-- js insert -->
@section('js')
    {{-- swiper --}}
    <script src="https://fastly.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
    <script>
        function goToSecondTab(){
            $('.nav-link.active').removeClass('active');
            $('#pills-home').removeClass('show active');
            $('#pills-home-tab').removeClass('active');
            $('#pills-profile').addClass('show active');
            $('#pills-profile-tab').addClass('active');
        }

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
            var url = "{{ route('school_route.calander_tasks_ajax', [':month', ':year']) }}";
            url = url.replace(':month', month).replace(':year', year);
            $.ajax({
                url: url,
                type: "GET",
                success: function (data) {
                    $("#calander_cont").html(data);
                }
            });
        }

        // Reinsert the calendar when the month arrows are clicked
        $(document).on('click', '#change_month', function () {
            var month = $(this).data('month');
            var year = $(this).data('year');
            fetchCalander(month, year);
        });
    </script>
@endsection
