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
    $text = isset($item_val['id']) ? 'تعديل' : 'إنشاء';
@endphp
@section('title', $text .' ' .$Committees_and_teams['title'])
@section('topbar', $text .' ' .$Committees_and_teams['title'])

<!-- css insert -->
@section('css')
    <link rel="stylesheet" href="https://fastly.jsdelivr.net/npm/swiper/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/css/select2.min.css"
          integrity="sha512-aD9ophpFQ61nFZP6hXYu4Q/b/USW7rpLCQLX6Bi0WJHXNO7Js/fUENpBQf/+P4NtpzNX0jSgR5zVvPOJp+W2Kg=="
          crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="{{ URL::asset('css/hijry/bootstrap-datetimepicker.min.css') }}" />

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
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item text-s2 active"  style="padding-left:20px; color: white;" aria-current="page">المدرسه</li>
                            <li class="breadcrumb-item text-s2" style="padding-left:20px; color: white;">اللجان</li>
                            <li class="breadcrumb-item text-s2" style="padding-left:20px; color: white;">{{$text}} {{$Committees_and_teams['title']}}</li>
                        </ol>
                    </nav>

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
                                    <button class="nav-link {{ $tab['id'] === $initialTab ? ' active tabcontent_active' : '' }}" id="{{ $tab['id'] }}-tab" data-bs-toggle="pill" data-bs-target="#{{ $tab['id'] }}" type="button" role="tab" aria-controls="{{ $tab['id'] }}" aria-selected="{{ $tab['id'] === $initialTab ? 'true' : 'false' }}">
                                        {{ $tab['label'] }}
                                    </button>
                                </li>
                            @endforeach
                        </ul>

                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active  " id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                <div class="container form-container">
                                    <div class="card custom-card">
                                        <div class="Committees_and_teams_meetings_create_title">
                                            {{$text}} {{$Committees_and_teams['title']}}
                                        </div>
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="card-body custom-card-body">

                                                    <input type="hidden" id="committees_and_teams_id" name="committees_and_teams_id" value="{{ request('Committees_id') ?? (  isset($item_val)  ?$item_val['committees_and_teams_id']:'')}}" class="  form-control">
                                                    <input type="hidden" id="status" name="status" value="@if(isset($item_val) && $item_val['status'] ){{$item_val['status']}} @endif" class="  form-control">

                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-md-3 align-self-center">
                                                                <label for="type" class="form-label bold_form_label "> نوع الاجتماع <span class="required-asterisk">*</span></label>
                                                            </div>
                                                            <div class="col-md-9">
                                                                <select required  name="type" id="type" class="form-control custom-select js-example-basic-single  select2-hidden-accessible">
                                                                    <option value="">اختر نوع الاجتماع</option>
                                                                    @foreach ([1=>'طارئ', 0=>'دوري'] as $index=>$value)
                                                                        <option value="{{ $index }}"
                                                                                @isset($item_val)
                                                                                    @if($item_val['type'] == $index) selected @endif
                                                                            @endisset>
                                                                            {{ $value }}</option>
                                                                    @endforeach
                                                                    <!-- Other options -->
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-md-3 align-self-center ">
                                                                <label  for="committee" class="form-label bold_form_label "> تاريخ الاجتماع<span class="required-asterisk">*</span> </label>
                                                            </div>
                                                            <div class="col-md-9">
                                                                <div class=" input-group">

                                                                    <input name="start_date" type="text" style="border-left: 0px;"
                                                                           class="  hijri-date-input   form-control   clickable-item-pointer @error('start_date') is-invalid @enderror"
                                                                           placeholder="  تاريخ الاجتماع"   value="{{ isset($item_val) ? $item_val['start_date']: ''}}" required>
                                                                    <div class="input-group-prepend">
                                                                        <div class="input-group-text"> <img class="platform_icon" alt="school"
                                                                                                            src="{{ URL::asset('img/icons/calendar.svg') }}"> </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-md-3 align-self-center ">
                                                                <label  for="committee" class="form-label bold_form_label " >عنوان  الاجتماع <span class="required-asterisk">*</span> </label>
                                                            </div>
                                                            <div class="col-md-9">

                                                                <input   required type="text" id="title"  name="title" value="{{ isset($item_val)  ?$item_val['title']:''}}" class="form-control">

                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="  form-group">
                                                        <div class="row">
                                                            <div class="col-md-3 align-self-center ">
                                                                <label  for="committee" class="form-label bold_form_label ">موعد الاجتماع<span class="required-asterisk">*</span> </label>
                                                            </div>
                                                            <div class="col-md-9">


                                                                <div class=" input-group">

                                                                    <input name="start_time" type="text" style="border-left: 0px;"
                                                                           class="form-control   timepicker  clickable-item-pointer @error('start_time') is-invalid @enderror"
                                                                           placeholder=" وقت الاجتماع"  value="{{ isset($item_val) ? $item_val['start_time']: ''}}" required>
                                                                    <div class="input-group-prepend">
                                                                        <div class="input-group-text">
                                                                            <img class="platform_icon" alt="school"   src="{{ URL::asset('img/icons/clock.svg') }}">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                    </div>


                                                        </div>
                                                    </div>


                                                    <div class="  form-group">
                                                        <div class="row">
                                                            <div class="col-md-3 align-self-center ">
                                                                <label  for="committee" class="form-label bold_form_label ">مكان  الاجتماع<span class="required-asterisk">*</span> </label>
                                                            </div>
                                                            <div class="col-md-9">
                                                                <input type="text" name="location" class="form-control" required  value="{{ isset($item_val) ?$item_val['location']:''}}">
                                                            </div>
                                                        </div>
                                                    </div>



                                                    <div class="  form-group">
                                                        <div class="row">
                                                            <div class="col-md-3 align-self-center ">
                                                                <label  for="committee" class="form-label bold_form_label "> الفصل الدراسي <span class="required-asterisk">*</span>   </label>
                                                            </div>
                                                            <div class="col-md-9">
                                                                <input type="text"  required name="Semester" value="{{ isset($item_val) ? $item_val['Semester']: ''}}" class="  form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Add more form fields here -->

                                                    <div class=" form-group" style="padding-top: 51px;">
                                                        <div class="row">
                                                            <div class=" col col-md-6">
                                                                <button  type="submit" class=" meetings_button_next_wi   btn btn-default custom-reset-button">إنهاء</button>
                                                            </div>
                                                            <div class=" col col-md-6">
                                                                <button id="nextButton" type="button" class=" meetings_button_next btn btn-primary custom-submit-button">التالي</button>
                                                            </div>
                                                        </div>

                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-md-4"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade  " id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                <!-- Second tab content goes here -->
                                <div class="container form-container">
                                    <div class="card custom-card">
                                        <div class="row">
                                            <div class="col-md-9">
                                                <div  class="Committees_and_teams_meetings_create_title ">
                                                    {{$text}} {{$Committees_and_teams['title']}}
                                                </div>
                                            </div>
                                            <div class="col-md-3 float-end">
                                                <button  type="submit" class=" Save_as_draft col-md-3 float-end btn btn-primary custom-submit-button">
                                                    <i class="fas fa-save" style="margin-left: 5px;"></i>
                                                    <span>حفظ كمسوده</span>
                                                </button>

                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12" >
                                                <div class="card-body custom-card-body">

                                                    <div class="  form-group">
                                                        <div class="row">
                                                            <div class="col-md-2 align-self-center ">
                                                                <label  for="committee" class="form-label bold_form_label ">   الفئه المستهدفه </label>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <select  name="Target_group" id="Target_group" class="form-control custom-select js-example-basic-single  select2-hidden-accessible ">
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


                                                    <div class="  form-group Number_of_attendees22">
                                                        <div class="row">
                                                            <div class="col-md-2 align-self-center ">
                                                                <label  for="committee" class="form-label bold_form_label "> عدد الحاضرين    </label>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <select  id="Number_of_attendees" name="Number_of_attendees" class="form-control custom-select js-example-basic-single  select2-hidden-accessible">
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


                                                    <div class="  form-group meeting_agenda">
                                                        <div class="row" id="container_of_all_meeting_agenda" >
                                                            <label  for="committee" class="form-label bold_form_label "  style="padding-bottom: 10px;">    جدول اعمال الاجتماع  </label>
                                                            @if((is_array($item_val['meeting_agenda']) && !empty($item_val['meeting_agenda'])))
                                                                @foreach  ($item_val['meeting_agenda'] as $key => $agenda)

                                                                    <div class="row add_meeting_agenda_div "   >
                                                                        <div class="col-md-9 add-padding-bottom ">
                                                                            <div class="input-group">
                                                                                <label for="name1" class="add_meeting_agenda_span_num align-self-center  side_number_div ">  {{ $key+1 }} </label>
                                                                                <input type="text" autocomplete="off"  name="meeting_agenda_item[]" class="form-control" value="{{ $agenda['Item'] }}">
                                                                                <input type="hidden" name="meeting_agenda_id[]" class="form-control" value="{{ $agenda['id'] }}">

                                                                            </div>

                                                                        </div>
                                                                        <div class="col-md-3  align-self-center ">
                                                                            <a href="#" onclick="delete_parentElement(this,'add_meeting_agenda_div')"  >
                                                                                <img    class="  plus_minus_class " alt="school" src="{{ URL::asset('img/website/data/delete.PNG') }}">
                                                                            </a>
                                                                            <a href="#" onclick="add_meeting_agenda()" class="add_meeting_agenda_class_add"  >
                                                                                <img    class="  plus_minus_class " alt="school" src="{{ URL::asset('img/website/data/add.PNG') }}">
                                                                            </a>


                                                                        </div>

                                                                    </div>

                                                                @endforeach
                                                            @else

                                                                <div  id="container_of_all_meeting_agenda">    </div>
                                                            @endif

                                                        </div>
                                                    </div>


                                                    <div class="  form-group meeting_recommendations ">
                                                        <div class="row meeting_recommendations_header_div ">
                                                            <div class="col-md-2 meeting_recommendations_table"  >التوصيه</div>
                                                            <div class="col-md-2 meeting_recommendations_table"    >الجهه المكلفه بالتنفيذ</div>
                                                            <div class="col-md-2 meeting_recommendations_table "    >مده التنفيذ</div>
                                                            <div class="col-md-2 meeting_recommendations_table "     >الجهه التابعه للتنفيذ</div>
                                                        </div>
                                                        <div class="row" id="container_of_all_add_meeting_recommendations_finished"  >
                                                            @if((is_array($item_val['meeting_recommendations']) && !empty($item_val['meeting_recommendations'])))
                                                                @foreach ($item_val['meeting_recommendations']   as $key => $recommendation)
                                                                    @if ($recommendation['status'] ==1)


                                                                        <div class="row add_meeting_recommendations_finished_div ">
                                                                            <input type="hidden" name="recommendation_id[]" class="form-control" value="{{ $recommendation['id'] }}">

                                                                            <div class="input-group">
                                                                                <label for="name1" class="align-self-center add-padding-bottom side_number_div "> {{ $key+1 }} </label>

                                                                                <div class="col-md-2 add-padding-bottom meeting_recommendations_table  "  >
                                                                                    <input type="text" autocomplete="off" name="recommendation_item[]" class="form-control"  value="{{ $recommendation['Item'] }}">
                                                                                </div>
                                                                                <div class="col-md-2 add-padding-bottom   meeting_recommendations_table "  >
                                                                                    <input type="text" autocomplete="off" name="entity_responsible_implementation[]" class="form-control"  value="{{ $recommendation['entity_responsible_implementation'] }}">
                                                                                </div>
                                                                                <div class="col-md-2 add-padding-bottom meeting_recommendations_table "  >
                                                                                    <input type="text" autocomplete="off" name="Implementation_period[]" class="form-control"  value="{{ $recommendation['Implementation_period'] }}">
                                                                                </div>
                                                                                <div class="col-md-2 add-padding-bottom meeting_recommendations_table "  >
                                                                                    <input type="text" autocomplete="off" name="entity_responsible_implementation_related[]" class="form-control"  value="{{ $recommendation['entity_responsible_implementation_related'] }}" >
                                                                                </div>
                                                                                <div class="col-md-2  align-self-center ">
                                                                                    <a href="#" onclick=" delete_parentElement(this,'add_meeting_recommendations_finished_div')"  >
                                                                                        <img    class="  plus_minus_class " alt="school" src="{{ URL::asset('img/website/data/delete.PNG') }}">
                                                                                    </a>
                                                                                    <a href="#" onclick="add_meeting_recommendations_finished()" class="add_meeting_recommendations_finished_class_add"  >
                                                                                        <img    class="  plus_minus_class " alt="school" src="{{ URL::asset('img/website/data/add.PNG') }}">
                                                                                    </a>


                                                                                </div>


                                                                            </div>
                                                                        </div>



                                                                    @endif
                                                                @endforeach
                                                            @else
                                                                <div  id="container_of_all_add_meeting_recommendations_finished">    </div>


                                                            @endif
                                                        </div>
                                                    </div>



                                                    <div class="  form-group meeting_recommendations_not " style="padding-top: 25px;">
                                                        <div class="row"  >
                                                            <div class="col-md-3 add-padding-bottom meeting_recommendations_not_side_div ">
                                                                <label  for="committee" class="form-label  meeting_recommendations_not_side_title  ">    ما  لم ينفذ من  التوصيات واسباب عدم التنفيذ  </label>
                                                            </div>
                                                            <div class="col-md-9 add-padding-bottom " id="container_of_all_meeting_recommendations_not" >

                                                                @if((is_array($item_val['meeting_recommendations']) && !empty($item_val['meeting_recommendations'])))
                                                                    @foreach  ($item_val['meeting_recommendations'] as $key => $recommendation_val)
                                                                        @if ($recommendation_val['status'] == 0)
                                                                            <div class="row add_meeting_recommendations_not_div "   >
                                                                                <div class="col-md-9 add-padding-bottom">
                                                                                    <input type="text" autocomplete="off"  name="meeting_recommendations_not_completed[]" class="form-control"
                                                                                           value="{{ $recommendation_val['Item'] }}">
                                                                                </div>
                                                                                <div class="col-md-3  align-self-center ">
                                                                                    <a href="#" onclick=" delete_parentElement(this,'add_meeting_recommendations_not_div')"  >
                                                                                        <img    class="  plus_minus_class " alt="school" src="{{ URL::asset('img/website/data/delete.PNG') }}">
                                                                                    </a>
                                                                                    <a href="#" onclick="add_meeting_recommendations_not()" class="add_meeting_recommendations_not_class_add"  >
                                                                                        <img    class="  plus_minus_class " alt="school" src="{{ URL::asset('img/website/data/add.PNG') }}">
                                                                                    </a>


                                                                                </div>
                                                                            </div>
                                                                        @endif
                                                                    @endforeach
                                                                @else

                                                                    <div  id="container_of_all_meeting_recommendations_not">    </div>
                                                                @endif

                                                            </div>
                                                        </div>
                                                    </div>



                                                    <div class="  form-group end_time ">
                                                        <div class="row">
                                                            <div class="col-md-3 align-self-center ">
                                                                <label  for="committee" class="form-label bold_form_label ">  موعد انتهاء الاجتماع  </label>
                                                            </div>
                                                            <div class=" input-group">

                                                                <input name="start_time" type="text" style="border-left: 0px;"
                                                                       class="form-control   clickable-item-pointer @error('end_time') is-invalid @enderror"
                                                                       placeholder=" وقت الاجتماع"  value="{{ isset($item_val) ? $item_val['end_time']: ''}}" required>
                                                                <div class="input-group-prepend">
                                                                    <div class="input-group-text"> <img class="platform_icon" alt="school"
                                                                                                        src="{{ URL::asset('img/icons/clock.svg') }}"> </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>


                                                    <!-- Repeat for other fields with appropriate classes -->

                                                    <div class="row form-group " style="padding-top: 51px;" >
                                                        <div class="col col-md-6">
                                                            <button id="prevButton"  type="button" class=" meetings_button_next_wi btn btn-default custom-reset-button">السابق</button>
                                                        </div>
                                                        <div class=" col col-md-6">
                                                            <button   type="submit" class=" meetings_button_next   float-end btn btn-primary custom-submit-button">حفظ وانهاء </button>
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
    <script src="{{ URL::asset('js/hijry/bootstrap-hijri-datepicker.min.js') }}"></script>
    <script src="{{ URL::asset('js/hijry/bootstrap-hijri-datetimepicker.min.js') }}"></script>

    {{-- swiper --}}
    <script src="https://fastly.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
    <!-- select 2 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/js/select2.min.js"
            integrity="sha512-4MvcHwcbqXKUHB6Lx3Zb5CEAVoE9u84qN+ZSMM6s7z8IeJriExrV3ND5zRze9mxNlABJ6k864P/Vl8m0Sd3DtQ=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- jquery ui datepicker -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
    <script>

        $(function() {
            $(".hijri-date-input").hijriDatePicker({
                locale: "ar-sa",
                  format: "YYYY-MM-DD",
                hijriFormat:"iYYYY-iMM-iDD",
                dayViewHeaderFormat: "MMMM YYYY",
                hijriDayViewHeaderFormat: "iMMMM iYYYY",
               //  showSwitcher: true,
               //  allowInputToggle: true,
               //  showTodayButton: false,
               //  useCurrent: true,
               // isRTL: false,
               //  viewMode:'months',
               //  keepOpen: false,
                //hijri: true,
               //  debug: true,
               //  showClear: true,
               //  showTodayButton: true,
               //  showClose: true
            });
        });
        /** indicator on hijri date **/
        var indicator_on_hijri_date =  new Date(document.getElementsByClassName("hijri-date-input")[0].value).getFullYear();
        if (indicator_on_hijri_date < 2000 ){
            $(".hijri-date-input").hijriDatePicker({
                hijri: true
            });
        }

         $(document).ready(function() {
            $('.js-example-basic-single').select2();
            // //hide search
            // $('.select2-no-search').select2({
            //     minimumResultsForSearch: -1
            // });
            $('#pills-profile-tab').on('click', function(e) {
                var isValid = true;
                $('#pills-home input').each(function() {
                    if (!this.checkValidity()) {
                        isValid = false;
                        $(this).addClass('is-invalid'); // Add error class for styling
                    } else {
                        $(this).removeClass('is-invalid');
                    }
                });

                if (!isValid) {
                    e.preventDefault(); // Prevent switching to tab2
                    e.stopPropagation();
                $('#pills-home-tab').tab('show');
                    return false;
                }
            });
            // Remove the 'is-invalid' class when the user corrects the input
            $('#pills-home input').on('input change', function() {
                if (this.checkValidity()) {
                    $(this).removeClass('is-invalid');
                }
            });
// Function to go to the next tab
            $('#nextButton').click(function() {
                $('.nav-pills .active').parent().next('li').find('button').trigger('click');
            });

// Function to go to the previous tab
            $('#prevButton').click(function() {
                $('.nav-pills .active').parent().prev('li').find('button').trigger('click');
            });
        });

        $(document).ready(function() {
            add_meeting_agenda();
            add_meeting_recommendations_not();
            add_meeting_recommendations_finished();
        });

        function add_meeting_agenda(){
            if(typeof event != "undefined")
            {
                event.preventDefault();
            }
            var datacount=  $(".add_meeting_agenda_div").length+1
            var newElement=   ` <div   class=" row add_meeting_agenda_div"  >
                                   <div class="col-md-9 add-padding-bottom">
                                   <div class="input-group">
                                       <label for="name1" class="add_meeting_agenda_span_num align-self-center  side_number_div ">   ${datacount} </label>
                                       <input type="text"  autocomplete="off" name="meeting_agenda_item[]" class="form-control input_meeting_agenda_item " value="">
                                   </div>
                                   </div>
                                   <div class="col-md-3  align-self-center ">
                                       <a href="#" onclick="delete_parentElement(this,'add_meeting_agenda_div')"  >
                                           <img    class="  plus_minus_class " alt="school" src="{{ URL::asset('img/website/data/delete.PNG') }}">
                                       </a>
                                       <a href="#" onclick="add_meeting_agenda()" class="add_meeting_agenda_class_add"   >
                                           <img    class="  plus_minus_class " alt="school" src="{{ URL::asset('img/website/data/add.PNG') }}">
                                       </a>
                                   </div>
                               </div>` ;


            $('#container_of_all_meeting_agenda').append(newElement);
            let add_meeting_agenda_class_add_elements = document.querySelectorAll('.add_meeting_agenda_class_add');

            Remove_all_but_the_last_element(add_meeting_agenda_class_add_elements);

        }

        function add_meeting_recommendations_not(){
            if(typeof event != "undefined")
            {
                event.preventDefault();
            }
            var datacount=  $(".add_meeting_recommendations_not_div").length+1
            var newElement=   ` <div   class=" row add_meeting_recommendations_not_div"  >

                <div class="col-md-9 add-padding-bottom">
                <input type="text"  autocomplete="off" name="meeting_recommendations_not_completed[]" class="form-control meeting_recommendations_not_completed " value="">
                </div>

                <div class="col-md-3  align-self-center ">
                <a href="#" onclick="delete_parentElement(this,'add_meeting_recommendations_not_div')"  >
                   <img    class="  plus_minus_class " alt="school" src="{{ URL::asset('img/website/data/delete.PNG') }}">
                </a>

                <a href="#" onclick="add_meeting_recommendations_not()" class="add_meeting_recommendations_not_class_add"   >
                   <img    class="  plus_minus_class " alt="school" src="{{ URL::asset('img/website/data/add.PNG') }}">
                </a>
                </div>
                </div>` ;


            $('#container_of_all_meeting_recommendations_not').append(newElement);
            let meeting_recommendations_not_elements = document.querySelectorAll('.add_meeting_recommendations_not_class_add');

            Remove_all_but_the_last_element(meeting_recommendations_not_elements);

        }

        function add_meeting_recommendations_finished(){

            if(typeof event != "undefined")
            {
                event.preventDefault();
            }
            var datacount=  $(".add_meeting_recommendations_finished_div").length+1
            var newElement=   `
    <div class="row add_meeting_recommendations_finished_div ">

                                <div class="input-group">
                                           <label for="name1" class="align-self-center add-padding-bottom side_number_div "> ${datacount} </label>

                                           <div class="col-md-2 add-padding-bottom meeting_recommendations_table  "  >
                                               <input type="text" autocomplete="off" name="recommendation_item[]" class="form-control" value="">
                                           </div>
                                           <div class="col-md-2 add-padding-bottom   meeting_recommendations_table "  >
                                               <input type="text" autocomplete="off" name="entity_responsible_implementation[]" class="form-control" value="">
                                           </div>
                                           <div class="col-md-2 add-padding-bottom meeting_recommendations_table "  >
                                               <input type="text" autocomplete="off" name="Implementation_period[]" class="form-control" value="">
                                           </div>
                                           <div class="col-md-2 add-padding-bottom meeting_recommendations_table "  >
                                               <input type="text" autocomplete="off" name="entity_responsible_implementation_related[]" class="form-control" value="">
                                           </div>
                                            <div class="col-md-2  align-self-center ">
                                                <a href="#" onclick=" delete_parentElement(this,'add_meeting_recommendations_finished_div')"  >
                                                    <img    class="  plus_minus_class " alt="school" src="{{ URL::asset('img/website/data/delete.PNG') }}">
                                                </a>
                                                <a href="#" onclick="add_meeting_recommendations_finished()" class="add_meeting_recommendations_finished_class_add"  >
                                                    <img    class="  plus_minus_class " alt="school" src="{{ URL::asset('img/website/data/add.PNG') }}">
                                                </a>


                                            </div>


                                </div>
                           </div>` ;


            $('#container_of_all_add_meeting_recommendations_finished').append(newElement);
            let meeting_recommendations_finished_class_add_elements = document.querySelectorAll('.add_meeting_recommendations_finished_class_add');

            Remove_all_but_the_last_element(meeting_recommendations_finished_class_add_elements);

        }

        function Remove_all_but_the_last_element(vla){
            // Remove all but the last element
            if (vla.length > 1) {
                for (let i = 0; i < vla.length - 1; i++) {
                    vla[i].remove();
                }
            }
        }

        function delete_parentElement(this_this,div_class){

            event.preventDefault();
            var datacount=  $("."+div_class).length
            if (datacount > 1){
                this_this.parentElement.parentElement.remove();
            }

        }

        // Call saveInputValues() before switching tabs
        // Call restoreInputValues() after switching back to the tab

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


    </script>
    <style>

        .time__heading {
            text-align: center;
            color: #fff;
            text-shadow: 4px 4px 0px rgba(0,0,0,0.2);
        }

        .time__input .timepicker {
            width: 100%;
            font-size: 25px;
            padding: 10px;
            font-weight: 300;
            text-align: center;
            border: solid 2px #303233;
            color: #303233;
            outline: none;
            box-shadow: 4px 4px 0px 0px rgba(0,0,0,0.1);
        }
        div[id^="tp_"].timepicker__wrapper {
            opacity: 0;
            height: auto;
            min-width: 150px;
            max-height: 0px;
            overflow: hidden;
            position: absolute;
            transition: max-height .1s ease-in-out;
             background:white;
            border-radius: 0px 0px 5px 5px;
             border-top: transparent;
            box-shadow: 4px 4px 0px 0px rgba(0,0,0,0.1);
            text-align: center;
        }
        div[id^="tp_"].timepicker__wrapper * {
            box-shadow: border-box;
        }
        div[id^="tp_"].timepicker__wrapper-active {
            direction: ltr;
            opacity: 1;
            max-height: 500px;
            padding: 15px;
            width: 100%!important;
            margin-top: 47px;
        }
        div[id^="tp_"].timepicker__wrapper-full > div {
            width: 33% !important;
        }
        div[id^="tp_"].timepicker__wrapper > div {
            margin: 0px;
            padding: 0px;
            display: inline-block;
            text-align: center;
            width: 50%;
            max-width: 75px;
        }
        div[id^="tp_"].timepicker__wrapper > div .display {
            color: #0a3a81;
             font-size: 30px;
            font-weight: 100;
            line-height: 35px;
            margin: 0px;
            text-transform: uppercase;
            user-select: none;
        }
        div[id^="tp_"].timepicker__wrapper > div .timepicker__button {
            margin: 15px auto;
            padding: 0px;
            background: #fff;
            cursor: pointer;
            background: transparent;
            border: solid 5px transparent;
        }
        div[id^="tp_"].timepicker__wrapper > div .timepicker__button__up > div {
            width: 45px;
            background: #0a3a81;
            border-radius: 10px;
            height: 0px;
            margin: auto;
            border-left: solid 5px transparent;
            border-right: solid 5px transparent;
            border-bottom: solid 5px #0a3a81;
        }
        div[id^="tp_"].timepicker__wrapper > div .timepicker__button__down > div {
            width: 45px;
            background: #0a3a81;
            border-radius: 10px;

            height: 0px;
            margin: auto;
            border-left: solid 5px transparent;
            border-right: solid 5px transparent;
            border-top: solid 5px #0a3a81;
        }

    </style>
    <script>
        /*
 *  Vanilla Javascript timepicker that allows setting of minTime and maxTime
 *
 *        View below code for a list of available methods
 *
 *  Developer: Lance Jernigan
 *  Version: 1.0.4
 *
 */


        /*
         *  Setup our arguments to pass to our timepicker
         *
         *  @args - format (boolean) - Whether to format the input value or leave in 24 hour
         *          minTime (string) - Minimum time the timepicker should reach (any valid time string Javascript's Date() will accept)
         *          maxTime (string) - Maximum time the timepicker should reach (any valid time string Javascript's Date() will accept)
         *          meridiem (boolean) - Whether the timepicker should display the meridiem (defaults to true if format is true and false if format is false)
         *          arrowColor (string) - Any valid color (Hex, RGB, RGBA, etc.) to use for the arrows
         *
         */

        var args = {
            // format: true,
            // minTime: '2:00 am',
            // maxTime: '1:00 pm',
            // meridiem: false
        }

        /*
         *  Create a new timepicker for our input and pass it our args
         */

        var tpicker = new timepicker(document.querySelector('input.timepicker'), args)

        /*
         *  Starts our Timepicker Functionality
         */

        function timepicker(element, args) {

            this.initialized = false
            this.element = null
            this.elements = {}
            this.timepicker = null
            this.time = new Date()
            this.settings = {
                format: true,
                meridiem: true,
                minTime: new Date(new Date().toDateString() + ' 00:00'),
                maxTime: new Date(new Date().toDateString() + ' 24:00'),
                onChange: false
            }
            this.active = false

            this.updateSettings = function(args) {

                args = args || {}

                for (a = 0; a < Object.keys(args).length; a++) {

                    var key = Object.keys(args)[a]
                    var val = args[Object.keys(args)[a]]

                    this.settings[key] = args[Object.keys(args)[a]]

                }

                if (! this.settings.format && typeof args.meridiem == 'undefined') {

                    this.settings.meridiem = false

                }

                this.settings.meridiem = this.settings.format ? true : this.settings.meridiem
                this.settings.minTime = ! (this.settings.minTime.getDate !== undefined || this.settings.minTime.getDate !== null) ? new Date(new Date().toDateString() + ' ' + this.settings.minTime) : new Date(new Date().toDateString() + ' 00:00')
                this.settings.maxTime = ! (this.settings.maxTime.getDate !== undefined || this.settings.maxTime.getDate !== null) ? new Date(new Date().toDateString() + ' ' + this.settings.maxTime) : this.settings.maxTime

                if (this.settings.maxTime.toString() == this.settings.minTime.toString()) {

                    var maxTime = new Date(this.settings.minTime)

                    maxTime.setHours(maxTime.getHours() + 24)

                    this.settings.maxTime = maxTime

                }

                if (this.element.value) {

                    var newTime = new Date(new Date().toDateString() + ' ' + this.element.value)

                    this.time = ! isNaN(newTime.getTime()) ? newTime : this.time

                }

                this.time.setMilliseconds(0)

                if (Object.keys(this.elements).length) {

                    this.updateTime('minute', true, 0)

                    this.render()

                }

                if (! this.validateTime()) {

                    this.time = this.settings.minTime ? this.settings.minTime : this.settings.maxTime

                }

            }

            this.buildTimepicker = function() {

                var wrapper = document.createElement('div')
                var elements = ['hour', 'minute', 'meridiem']

                wrapper.className = 'timepicker__wrapper'
                wrapper.setAttribute('id', 'tp_' + (Math.floor(Math.random() * 100) + 1))

                if (! Object.keys(this.elements).length) {

                    for (e = 0; e < elements.length; e++) {

                        this.elements[elements[e]] = document.createElement('div')
                        this.elements[elements[e]].className = 'timepicker__' + elements[e]

                        var up = document.createElement('div')
                        up.appendChild(document.createElement('div'))


                        var display = document.createElement('p')
                        var display_up_hour_data = document.createElement('p')
                        var display_down_hour_data = document.createElement('p')
                        var display_up_minute_data = document.createElement('p')
                        var display_down_minute_data = document.createElement('p')
                        var display_up_meridiem_data = document.createElement('p')
                        var display_down_meridiem_data = document.createElement('p')
                        var down = document.createElement('div')
                        down.appendChild(document.createElement('div'))

                        up.className = 'timepicker__button timepicker__button__up'
                        display.className = 'display'
                        display_up_hour_data.className = 'display_up_hour  timepicker__button timepicker__button__up '
                        display_down_hour_data.className = 'display_down_hour timepicker__button timepicker__button__down'
                        display_up_minute_data.className = 'display_up_minute  timepicker__button timepicker__button__up '
                        display_down_minute_data.className = 'display_down_minute timepicker__button timepicker__button__down'
                        display_up_meridiem_data.className = 'display_up_meridiem  timepicker__button timepicker__button__up '
                        display_down_meridiem_data.className = 'display_down_meridiem timepicker__button timepicker__button__down'
                         down.className = 'timepicker__button timepicker__button__down'

                        if (this.settings.arrowColor) {

                            up.childNodes[0].style['border-bottom-color'] = this.settings.arrowColor
                            down.childNodes[0].style['border-top-color'] = this.settings.arrowColor

                        }
                        if(elements[e]=='hour'){
                            this.elements[elements[e]].appendChild(display_up_hour_data)
                            this.elements[elements[e]].appendChild(up)
                            this.elements[elements[e]].appendChild(display)
                            this.elements[elements[e]].appendChild(down)
                            this.elements[elements[e]].appendChild(display_down_hour_data)
                        }else if(elements[e]== 'minute'){
                            this.elements[elements[e]].appendChild(display_up_minute_data)
                            this.elements[elements[e]].appendChild(up)
                            this.elements[elements[e]].appendChild(display)
                            this.elements[elements[e]].appendChild(down)
                            this.elements[elements[e]].appendChild(display_down_minute_data)
                        }else {
                            this.elements[elements[e]].appendChild(display_up_meridiem_data)
                            this.elements[elements[e]].appendChild(up)
                            this.elements[elements[e]].appendChild(display)
                            this.elements[elements[e]].appendChild(down)
                            this.elements[elements[e]].appendChild(display_down_meridiem_data)

                        }


                    }

                }

                this.timepicker = wrapper

                this.element.parentNode.insertBefore(wrapper, this.element.nextSibling)

                this.addListeners()

                this.render()

            }

            this.render = function() {

                var wrapper = this.cleanWrapper(this.timepicker)

                if (this.settings.meridiem) {

                    wrapper.className = wrapper.className.indexOf(' timepicker__wrapper-full') >= 0 ? wrapper.className : wrapper.className + ' timepicker__wrapper-full'

                }

                for (e = 0; e < Object.keys(this.elements).length; e++) {

                    var key = Object.keys(this.elements)[e]
                    var element = this.elements[key]
                    var func = 'get' + key.charAt(0).toUpperCase() + key.slice(1)

                    element.querySelector('.display').innerText = this[func]()
                    if (key == 'hour'){
                        element.querySelector('.display_up_hour').innerText = this[func]()+1;
                        element.querySelector('.display_down_hour').innerText = this[func]()-1;
                    }else if(key == 'minute'){
                        element.querySelector('.display_up_minute').innerText = parseInt(this[func]())+1;
                        element.querySelector('.display_down_minute').innerText =parseInt( this[func]() )-1 ;
                    }else {
                        element.querySelector('.display_up_meridiem').innerText = 'AM';
                        element.querySelector('.display_down_meridiem').innerText ='PM' ;
                    }

                    if (Object.keys(this.elements)[e] == 'meridiem' && ! this.settings.meridiem) {
                        continue
                    }

                    wrapper.appendChild(element)

                }

                this.timepicker = wrapper

                this.updateInput()

            }

            this.cleanWrapper = function(wrapper) {

                while(wrapper.hasChildNodes()){

                    wrapper.removeChild(wrapper.lastChild)

                }

                return wrapper

            }

            this.handleClick = function(e) {

                var element = e.currentTarget

                var parent = element.parentNode.className.replace('timepicker__', '')
                var add = element.className.indexOf('up') !== -1 ? true : false

                this.updateTime(parent, add)

            }

            this.validateInput = function(e) {

                var value = e.currentTarget.value
                var date = value.length ? new Date(new Date().toDateString() + ' ' + value) : false

                if (date && ! isNaN(date.getTime())) {

                    this.time = date

                }

                if (! this.validateTime()) {

                    var after = date.getTime() > this.settings.maxTime.getTime()
                    date = after ? new Date(this.settings.maxTime) : new Date(this.settings.minTime)
                    after ? date.setMinutes(date.getMinutes() - 1) : date.setMinutes(date.getMinutes() + 1)

                    this.time = date

                }

                this.render()

            }

            this.updateTime = function(method, add, amount) {

                var amount = amount || 1

                switch (method) {

                    case 'meridiem' :

                        this.time.getHours() > 12 ? this.time.setHours(this.time.getHours() - 12) : this.time.setHours(this.time.getHours() + 12)

                        break

                    default :

                        if (add) {

                            this.add(method, amount)

                        } else {

                            this.subtract(method, amount)

                        }

                }

                if (! this.validateTime()) {

                    var date = add ? new Date(this.settings.minTime) : new Date(this.settings.maxTime)
                    add ? date.setMinutes(date.getMinutes() + 1) : date.setMinutes(date.getMinutes() - 1)

                    this.time = date

                }

                this.render()

            }

            this.add = function(method, amount) {

                var amount = amount || 1

                switch (method) {

                    case 'minute' :

                        this.time.setMinutes(this.time.getMinutes() + amount)

                        break

                    case 'hour' :

                        this.time.setHours(this.time.getHours() + amount)

                        break

                }

            }

            this.subtract = function(method, amount) {

                var amount = amount || 1

                switch (method) {

                    case 'minute' :

                        this.time.setMinutes(this.time.getMinutes() - amount)

                        break

                    case 'hour' :

                        this.time.setHours(this.time.getHours() - amount)

                        break

                }

            }

            this.validateTime = function() {

                if (this.settings.minTime) {

                    this.settings.maxTime = this.settings.maxTime

                    this.time.setDate(new Date().getDate())

                    return this.time.getTime() < this.settings.maxTime.getTime() && this.time.getTime() > this.settings.minTime.getTime()

                }

                return true

            }

            this.updateInput = function(parent) {

                if (this.initialized) {

                    this.element.value = this.buildString()

                }

            }

            this.buildString = function() {

                return (this.getHour() + ":" + this.getMinute() + ' ' + this.getMeridiem()).trim()

            }

            this.toggleActive = function(e) {

                if (e.target == this.element) {

                    if (! this.initialized) {

                        this.initialized = true

                        this.updateInput()

                    }

                    this.updateBounds(this.timepicker, e.target)

                    this.active = true

                } else if (e.target.className.indexOf('timepicker__') == -1 && e.target.parentElement.className.indexOf('timepicker__') == -1) {

                    this.active = false

                }

                this.timepicker.className = this.active ? this.timepicker.className.indexOf(' timepicker__wrapper-active') >= 0 ? this.timepicker.className : this.timepicker.className + ' timepicker__wrapper-active' : this.timepicker.className.replace(' timepicker__wrapper-active', '')

            }

            this.updateBounds = function() {

                var bounds = this.element.getBoundingClientRect()

                this.timepicker.style.top = this.element.offsetTop + this.element.innerHeight + 'px'
                this.timepicker.style.width = bounds.width + 'px'

            }

            this.addListeners = function() {

                var elements = Object.keys(this.elements)

                for (e = 0; e < elements.length; e++) {

                    var element = this.elements[elements[e]]
                    var buttons = [].slice.call(element.childNodes).filter(function(node) {

                        return node.className.indexOf('button') !== -1

                    })

                    for (c = 0; c < buttons.length; c++) {

                        var button = buttons[c]

                        button.addEventListener('click', this.handleClick.bind(this))

                    }

                }

                this.element.addEventListener('change', this.validateInput.bind(this))
                document.body.addEventListener('click', this.toggleActive.bind(this))
                window.addEventListener('resize', this.updateBounds.bind(this))

            }

            this.getTime = function() {
                return this.time
            }

            this.getHour = function() {

                if (! this.settings.format) {

                    return this.time.getHours() < 10 ? '0' + this.time.getHours() : this.time.getHours()

                } else {

                    return this.time.getHours() > 12 ? this.time.getHours() % 12 : this.time.getHours() == 0 ? 12 : this.time.getHours()

                }

            }

            this.getMinute = function() {

                var minutes = this.time.getMinutes()

                return minutes < 10 ? '0' + minutes : minutes

            }

            this.getMeridiem = function() {

                if (! this.settings.meridiem) {

                    return ''

                } else {

                    return this.time.getHours() >= 12 ? 'pm' : 'am'

                }

            }

            this.init = function() {

                if (element.length) {

                    console.warn('Timepicker selector must be for a specific element, not a list of elements.')

                    return

                }

                this.element = element

                this.updateSettings(args)
                this.buildTimepicker()

            }

            this.init()

        }

        /*
         *  Timepicker Methods
         *
         *  updateSettings()
         *
         *     Update the settings originally passed to your timepicker
         *
         *     @parameters - args (a list of available arguments is provided above the code)
         *
         *
         *  updateTime()
         *
         *     Update the time based on parameters passed
         *
         *     @parameters - method (string) - What method to affect ('hour', 'minute', 'meridiem')
         *                   add (boolean) - True to add amount, false to subtract amount
         *                   amount /optional/ (number) - Number to add or subtract from method (defaults to 1)
         *
         *
         *  add()
         *
         *     Add amount to selected method
         *
         *     @parameters - method (string) - What method to affect ('hour', 'minute')
         *                   amount /optional/ (number) - Number to add to method (defaults to 1)
         *
         *
         *  subtract()
         *
         *     subtract amount from selected method
         *
         *     @parameters - method (string) - What method to affect ('hour', 'minute')
         *                   amount /optional/ (number) - Number to subtract from method (defaults to 1)
         *
         *
         *  buildString()
         *
         *     Returns the string that will be sent to the input
         *
         *
         *  getTime()
         *
         *     Returns the date object for the current selected time
         *
         *
         *  getHour()
         *
         *     Returns the current hour for the timepicker
         *
         *
         *  getMinute()
         *
         *     Returns the current Minute for the timepicker
         *
         *
         *  getMeridiem()
         *
         *     Returns the current Meridiem for the timepicker
         *
         *
         *  get
         */
        tpicker.updateSettings({minTime: '2:00 am'})
    </script>

@endsection
