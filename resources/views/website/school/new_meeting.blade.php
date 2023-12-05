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

    $action = isset($item_val['id']) ? route('school_route.meetings.update', $item_val['id']) : route('school_route.meetings.store');
    $method = isset($item_val['id']) ? 'PUT' : 'POST';
@endphp
@section('title', 'الصفحة الرئيسية لمدرستك في منصة لام | منصة لام')
@section('topbar', 'الصفحة الرئيسية لمدرستك في منصة لام | منصة لام')

<!-- css insert -->
@section('css')
    <link rel="stylesheet" href="https://fastly.jsdelivr.net/npm/swiper/swiper-bundle.min.css" />
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
            <form action="{{ $action }}" method="POST" enctype="multipart/form-data" class="custom-form">
                @csrf
                @if(isset($item_val['id']))
                    @method($method) <!-- Laravel's method spoofing for PUT request -->
                @endif
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

                                                    <input type="hidden" id="committees_and_teams_id" name="committees_and_teams_id" value="{{ request('Committees_id') ?? (  isset($item_val)  ?$item_val['committees_and_teams_id']:'')}}" class="  form-control">
                                                    <input type="hidden" id="status" name="status" value="{{ isset($item_val)   ?$item_val['status']:0}}" class="  form-control">

                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-md-3 align-self-center">
                                                                <label for="type" class="form-label">نوع الاجتماع</label>
                                                            </div>
                                                            <div class="col-md-9">

                                                                <select  name="type" id="type" class="form-control custom-select">
                                                                    <option value="">اختر نوع الاجتماع</option>
                                                                    @foreach ([1=>'طارئ', 0=>'دوري'] as $index=>$value)
                                                                        <option value="{{ $index }}"
                                                                                @isset($item_val)
                                                                                @if($item_val['Target_group'] == $index) selected @endif
                                                                                @endisset>
                                                                            {{ $value }}</option>
                                                                    @endforeach
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
                                                                <input type="date" id="date" name="start_date"  value="{{ isset($item_val) ? $item_val['start_date']: ''}}" class=" form-control">

                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="  form-group">
                                                        <div class="row">
                                                            <div class="col-md-3 align-self-center ">
                                                                <label  for="committee" class="form-label" >عنوان  الاجتماع </label>
                                                            </div>
                                                            <div class="col-md-9">

                                                                <input   required type="text" id="title" name="title" value="{{ isset($item_val)  ?$item_val['title']:''}}" class="  form-control">


                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="  form-group">
                                                        <div class="row">
                                                            <div class="col-md-3 align-self-center ">
                                                                <label  for="committee" class="form-label  ">موعد الاجتماع </label>
                                                            </div>
                                                            <div class="col-md-9">
                                                                <input type="time" id="time" name="start_time" value="{{ isset($item_val) ? $item_val['start_time']: ''}}" class="  form-control">
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="  form-group">
                                                        <div class="row">
                                                            <div class="col-md-3 align-self-center ">
                                                                <label  for="committee" class="form-label">مكان  الاجتماع </label>
                                                            </div>
                                                            <div class="col-md-9">
                                                                <input type="text" name="location" class="form-control" value="{{ isset($item_val) ?$item_val['location']:''}}">
                                                            </div>
                                                        </div>
                                                    </div>



                                                    <div class="  form-group">
                                                        <div class="row">
                                                            <div class="col-md-3 align-self-center ">
                                                                <label  for="committee" class="form-label  "> الفصل الدراسي    </label>
                                                            </div>
                                                            <div class="col-md-9">
                                                                <input type="text"  name="Semester" value="{{ isset($item_val) ? $item_val['Semester']: ''}}" class="  form-control">
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
                                                                <select  name="Target_group" id="Target_group" class="form-control custom-select">
                                                                    <option value="">اختر نوع الفئه</option>
                                                                    @foreach ([1=>'المصريين', 2=>'الاجانب'] as $index=>$value)
                                                                        <option value="{{ $index }}"
                                                                                @isset($item_val)
                                                                                    @if($item_val['Target_group'] == $index) selected @endif
                                                                                @endisset >
                                                                            {{ $value }}</option>
                                                                    @endforeach
                                                                    <!-- Other options -->
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <input type="hidden" name="meeting_id" id="meeting_id" value="{{ isset($item_val)  ?$item_val['id']:''}}">
                                                    <div class="  form-group">
                                                        <div class="row">
                                                            <div class="col-md-2 align-self-center ">
                                                                <label  for="committee" class="form-label  "> عدد الحاضرين    </label>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <select  id="Number_of_attendees" name="Number_of_attendees" class="form-control custom-select">
                                                                    <option value="">عدد الحاضرين</option>
                                                                    @foreach ([5, 10, 15, 20, 30] as $value)
                                                                        <option value="{{ $value }}"
                                                                                @isset($item_val)
                                                                                @if($item_val['Number_of_attendees'] == $value) selected @endif @endisset >
                                                                            {{ $value }}
                                                                        </option>
                                                                    @endforeach
                                                                    <!-- Other options -->
                                                                </select>

                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="  form-group">
                                                        <div class="row">
                                                            <label  for="committee" class="form-label" >    جدول اعمل الاجتماع  </label>
                                                            @if(!$item_val['meeting_recommendations']->isEmpty())
                                                            @foreach  ($item_val['meeting_agenda'] as $key => $agenda)
                                                                    <div class="col-md-1 add-padding-bottom">
                                                                        <span class="add_meeting_agenda_span_num"> {{ $key+1 }} </span>
                                                                    </div>
                                                                    <div class="col-md-8 add-padding-bottom">
                                                                    <input type="text" name="meeting_agenda_item[]" class="form-control" value="{{ $agenda->Item }}">
                                                                    <input type="hidden" name="meeting_agenda_id[]" class="form-control" value="{{ $agenda->id }}">

                                                                </div>
                                                                    <div class="col-md-3  align-self-center ">
                                                                        <a href="#" onclick="delete_meeting_agenda(this)"  >
                                                                            <img style=" width: 45px; height: 50px; "  class="me-2" alt="school" src="{{ URL::asset('img/website/data/delete.PNG') }}">
                                                                        </a>
                                                                        <a href="#" onclick="add_meeting_agenda()" class="add_meeting_agenda_class_add"  >
                                                                            <img style=" width: 45px; height: 50px; "  class="me-2" alt="school" src="{{ URL::asset('img/website/data/add.PNG') }}">
                                                                        </a>


                                                                    </div>



                                                            @endforeach
                                                            @else

                                                        <div  id="container_of_all_meeting_agenda">


                                                        </div>
                                                            @endif

                                                        </div>
                                                    </div>


                                                    <div class="  form-group">
                                                        <div class="row">
                                                            <label  for="committee" class="form-label  "> التوصيات    </label>
                                                            @if(!$item_val['meeting_recommendations']->isEmpty())
                                                            @foreach ($item_val['meeting_recommendations'] as $recommendation)
                                                                <div class="col-md-3 add-padding-bottom">
                                                                    <input type="text" name="recommendation_item[]" class="form-control" value="{{ $recommendation->Item }}">
                                                                    <input type="hidden" name="recommendation_id[]" class="form-control" value="{{ $recommendation->id }}">
                                                                    <input type="hidden" name="recommendation_status[]" class="form-control" value="{{ $recommendation->status }}">
                                                                    <input type="hidden" name="recommendation_reason[]" class="form-control" value="{{ $recommendation->reason }}">
                                                                </div>
                                                            @endforeach
                                                                  @else
                                                                @for ($i = 0; $i < 3; $i++)
                                                                    <div class="col-md-3 add-padding-bottom">
                                                                        <input type="text" name="recommendation_item[]" class="form-control" value="">
                                                                        <input type="hidden" name="recommendation_status[]" class="form-control" value="1">
                                                                        <input type="hidden" name="recommendation_reason[]" class="form-control" value="">
                                                                    </div>
                                                                @endfor
                                                         @endif
                                                        </div>
                                                    </div>


                                                    <div class="  form-group">
                                                        <div class="row">
                                                            <div class="col-md-3 align-self-center ">
                                                                <label  for="committee" class="form-label  ">  موعد انتهاء الاجتماع  </label>
                                                            </div>
                                                            <div class="col-md-9">
                                                                <input type="time"  name="end_time"  value="{{ isset($item_val) ?$item_val['end_time']:''}}" class="  form-control">
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


        add_meeting_agenda();
        function add_meeting_agenda(){
            debugger
        if(typeof event != "undefined")
        {
            event.preventDefault();
        }
             var datacount=  $(".add_meeting_agenda_div").length+1
           var newElement=   ` <div   class=" row add_meeting_agenda_div" id="add_meeting_agenda_div">
                                <div class="col-md-1 add-padding-bottom">
                                      <span class="add_meeting_agenda_span_num"> ${datacount} </span>
                                </div>
                               <div class="col-md-8 add-padding-bottom">

                                     <input type="text" name="meeting_agenda_item[]" class="form-control input_meeting_agenda_item " value="">

                                    </div>


                                <div class="col-md-3  align-self-center ">
                                    <a href="#" onclick="delete_meeting_agenda(this)"  >
                                        <img style=" width: 45px; height: 50px; "  class="me-2" alt="school" src="{{ URL::asset('img/website/data/delete.PNG') }}">
                                    </a>

                                    <a href="#" onclick="add_meeting_agenda()" class="add_meeting_agenda_class_add"   >
                                        <img style=" width: 45px; height: 50px; "  class="me-2" alt="school" src="{{ URL::asset('img/website/data/add.PNG') }}">
                                     </a>


                                </div>
                            </div>` ;


                $('#container_of_all_meeting_agenda').append(newElement);
            let add_meeting_agenda_class_add_elements = document.querySelectorAll('.add_meeting_agenda_class_add');

            Remove_all_but_the_last_element(add_meeting_agenda_class_add_elements);

            // var newElement=  $(".add_meeting_agenda_div").first();
            //  $('#myDiv').append(newElement.clone());
            //  $('#myDiv').prepend(newElement.clone());
          //  newElement.find('input').val("");
           // newElement.find('.add_meeting_agenda_span_num').text(datacount+1);
         }

        function Remove_all_but_the_last_element(vla){
            // Remove all but the last element
            if (vla.length > 1) {
                for (let i = 0; i < vla.length - 1; i++) {
                    vla[i].remove();
                }
            }
        }

        function delete_meeting_agenda(this_this){
            event.preventDefault();

            var datacount=  $(".add_meeting_agenda_div").length
            if (datacount > 1){
                this_this.parentElement.parentElement.remove();
            }

         }


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
