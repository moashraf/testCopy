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


            <div class="row">

                <div class="row main_cot_bg p-2 align-items-center mb-4" style=" font-size: .9rem;  background-color: #0A3A81;">

                    <div class="col-12 col-xl-12">
                        <h5 class="  text-s2" style="     margin-top: 0.5rem;   color: white;">
                            إجتماعات اللجان والفرق
                        </h5>

                    </div>

                </div>



                <div class="col-12 mb-3 mb-md-0">
                    <div class="main_cot_bg p-3 py-3 h-100">

                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active tabcontent_active " id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button"
                                        role="tab" aria-controls="pills-home" aria-selected="true">
                                       بيانات الاجتماع
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button"
                                        role="tab" aria-controls="pills-profile" aria-selected="false">
                                      محضر الاجتماع
                                </button>
                            </li>

                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade  show active " id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">


                                <div class="container form-container">
                                    <div class="card custom-card">
                                        <div class="   Committees_and_teams_meetings_create_title ">
                                            إنشاء اجتماع اللجنة الإدارية



                                        </div>
                                        <div class="row">
                                            <div class="col-md-8 " >
                                                <div class="card-body custom-card-body">
                                                    <form action="{{ route('school_route.meetings.store') }}" method="POST" enctype="multipart/form-data" class="custom-form">
                                                        @csrf <!-- CSRF Token for Laravel protection -->

                                                        <input type="hidden" id="committees_and_teams_id" name="committees_and_teams_id" value="{{ request('Committees_id')}}" class="  form-control">
                                                        <input type="hidden" id="status" name="status" value="1" class="  form-control">

                                                        <div class="  form-group">
                                                            <div class="row">
                                                                <div class="col-md-3 align-self-center ">
                                                            <label  for="committee" class="form-label  ">نوع الاجتماع</label>
                                                                </div>
                                                                <div class="col-md-9">
                                                                <select required name="type" id="type"  class=" form-control custom-select">
                                                                <option   selected>اختر نوع الاجتماع</option>
                                                                <option value="1"  >طارئ</option>
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
                                                                    <label  for="committee" class="form-label  " >عنوان  الاجتماع </label>
                                                                </div>
                                                                <div class="col-md-9">

                                                                    <input type="text" id="title" name="title" value=" " class="  form-control">

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
                                                                    <label  for="committee" class="form-label  ">مكان  الاجتماع </label>
                                                                </div>
                                                                <div class="col-md-9">
                                                                    <input type="text" id="committee_place" name="committee_place" class="  form-control">
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


                                                        <!-- Repeat for other fields with appropriate classes -->

                                                        <div class="row form-group " style="padding-top: 51px;" >
                                                            <div class="col-md-6">
                                                                <button  style="color: #0A3A81; border: 1px solid #e6a935; width: 50%;" type="reset" class="col-md-3 btn btn-default  custom-reset-button">إنهاء</button>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <button style=" background-color: #0A3A81;  width: 50%;  "  type="submit" class="col-md-3 float-end btn btn-primary custom-submit-button">التالي</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="col-md-4"></div>
                                        </div>

                                    </div>
                                </div>

                            </div>
                            <div class="tab-pane fade   " id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">



                                <div class="container form-container">
                                    <div class="card custom-card">
                                        <div class="   Committees_and_teams_meetings_create_title ">
                                            إنشاء اجتماع اللجنة الإدارية
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12" >
                                                <div class="card-body custom-card-body">
                                                    <form action="{{url('school/meetings')}}" method="POST" enctype="multipart/form-data" class="custom-form">
                                                        @csrf <!-- CSRF Token for Laravel protection -->

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
                                                                    <input type="text" id="title" name="title" value=" " class="  form-control">

                                                                </div>

                                                                <div class="col-md-1 align-self-center ">
                                                                    <label  for="committee" class="form-label  " >    2 </label>
                                                                </div>
                                                                <div class="col-md-11 add-padding-bottom ">
                                                                    <input type="text" id="title" name="title" value=" " class="  form-control">

                                                                </div>


                                                                <div class="col-md-1 align-self-center ">
                                                                    <label  for="committee" class="form-label  " >    3 </label>
                                                                </div>
                                                                <div class="col-md-11 add-padding-bottom">
                                                                    <input type="text" id="title" name="title" value=" " class="  form-control">

                                                                </div>


                                                            </div>
                                                        </div>


                                                        <div class="  form-group">
                                                            <div class="row">
                                                                <label  for="committee" class="form-label  "> التوصيات    </label>


                                                                <div class="col-md-3 add-padding-bottom">
                                                                    <input type="text" id="time" name="start_time" class="  form-control">
                                                                </div>
                                                                <div class="col-md-3 add-padding-bottom">
                                                                    <input type="text" id="time" name="start_time" class="  form-control">
                                                                </div>
                                                                <div class="col-md-3 add-padding-bottom">
                                                                    <input type="text" id="time" name="start_time" class="  form-control">
                                                                </div>
                                                                <div class="col-md-3 add-padding-bottom">
                                                                    <input type="text" id="time" name="start_time" class="  form-control">
                                                                </div>

                                                                <div class="col-md-3">
                                                                    <input type="text" id="time" name="start_time" class="  form-control">
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <input type="text" id="time" name="start_time" class="  form-control">
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <input type="text" id="time" name="start_time" class="  form-control">
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <input type="text" id="time" name="start_time" class="  form-control">
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
                                                    </form>
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
