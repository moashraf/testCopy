@php
    $hasStatusZero = false;
    foreach ($item_val['meeting_recommendations'] as $recommendation) {
        if ($recommendation['status'] == 0) {
            $hasStatusZero = true;
            break;
        }
    }
@endphp
<div class="print-section" style=" direction: rtl; text-align: right;">


<div class="container-fluid px-4 px-md-5 py-3 py-md-4">
    <div class="row">
            <div class="col-12 mb-3 mb-md-0">
                <div class="main_cot_bg p-3 py-3 h-100">


                            <div class="container form-container">
                                <div class="card custom-card">
                                    <div class="Committees_and_teams_meetings_create_title">
                                         {{$Committees_and_teams['title']}}
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="card-body custom-card-body">


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
                                                            <input required type="date" id="date" name="start_date"  value="{{ isset($item_val) ? $item_val['start_date']: ''}}" class=" form-control">

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
                                                            <input type="time" id="time" required name="start_time" value="{{ isset($item_val) ? $item_val['start_time']: ''}}" class="  form-control">
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



                                                <div class="  form-group">
                                                    <div class="row">
                                                        <div class="col-md-3 align-self-center ">
                                                            <label  for="committee" class="form-label bold_form_label ">   الفئه المستهدفه </label>
                                                        </div>
                                                        <div class="col-md-9">
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

                                                <div class="  form-group Number_of_attendees22">
                                                    <div class="row">
                                                        <div class="col-md-3 align-self-center ">
                                                            <label  for="committee" class="form-label bold_form_label "> عدد الحاضرين    </label>
                                                        </div>
                                                        <div class="col-md-9">
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
                                                        <label  for="committee" class="form-label bold_form_label "  style="    padding-bottom: 10px;">    جدول اعمال الاجتماع  </label>
                                                        @if((is_array($item_val['meeting_agenda']) && !empty($item_val['meeting_agenda'])))
                                                            @foreach  ($item_val['meeting_agenda'] as $key => $agenda)

                                                                <div class="row add_meeting_agenda_div "   >
                                                                    <div class="col-md-9 add-padding-bottom ">
                                                                        <div class="input-group">
                                                                            <label for="name1" class="add_meeting_agenda_span_num align-self-center  side_number_div ">  {{ $key+1 }} </label>
                                                                            <input type="text" autocomplete="off"  name="meeting_agenda_item[]" class="form-control" value="{{ $agenda['Item'] }}">

                                                                        </div>

                                                                    </div>


                                                                </div>

                                                            @endforeach
                                                        @else


                                                                <div class="row add_meeting_agenda_div "   >
                                                                    <div class="col-md-9 add-padding-bottom ">
                                                                        <span>  لم يتم انشاء جدول اعمال</span>

                                                                    </div>


                                                                </div>


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
                                                        @if( (is_array($item_val['meeting_recommendations']) && !empty($item_val['meeting_recommendations'])))
                                                            @foreach ($item_val['meeting_recommendations']   as $key => $recommendation)
                                                                @if ($recommendation['status'] ==1)


                                                                    <div class="row add_meeting_recommendations_finished_div ">
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

                                                                        </div>
                                                                    </div>



                                                                @endif
                                                            @endforeach
                                                        @else
                                                            <div  id="container_of_all_add_meeting_recommendations_finished">    </div>
                                                            لم يتم انشاء توصيات

                                                        @endif
                                                    </div>
                                                </div>



                                                <div class="  form-group meeting_recommendations_not " style="padding-top: 25px;">
                                                    <div class="row"  >
                                                        <div class="col-md-3 add-padding-bottom meeting_recommendations_not_side_div ">
                                                            <label  for="committee" class="form-label  meeting_recommendations_not_side_title  ">    ما  لم ينفذ من  التوصيات واسباب عدم التنفيذ  </label>
                                                        </div>
                                                        <div class="col-md-9 add-padding-bottom " id="container_of_all_meeting_recommendations_not" >

                                                            @if($hasStatusZero && (is_array($item_val['meeting_recommendations']) && !empty($item_val['meeting_recommendations'])))
                                                                @foreach  ($item_val['meeting_recommendations'] as $key => $recommendation_val)
                                                                    @if ($recommendation_val['status'] == 0)
                                                                        <div class="row add_meeting_recommendations_not_div "   >
                                                                            <div class="col-md-9 add-padding-bottom">
                                                                                <input type="text" autocomplete="off"  name="meeting_recommendations_not_completed[]" class="form-control"
                                                                                       value="{{ $recommendation_val['Item'] }}">
                                                                            </div>
                                                                        </div>
                                                                     @endif
                                                                @endforeach
                                                            @else

                                                                <div  style="padding: 15%;" id="container_of_all_meeting_recommendations_not">
                                                                        <span style="font-size: 40px">لايوجد</span>
                                                                </div>
                                                            @endif

                                                        </div>
                                                    </div>
                                                </div>



                                                <div class="  form-group end_time ">
                                                    <div class="row">
                                                        <div class="col-md-3 align-self-center ">
                                                            <label  for="committee" class="form-label bold_form_label ">  موعد انتهاء الاجتماع  </label>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <input type="time"  name="end_time"  value="{{ isset($item_val) ?$item_val['end_time']:''}}" class="  form-control">
                                                        </div>
                                                    </div>
                                                </div>


                                                <!-- Repeat for other fields with appropriate classes -->

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

<!-- bootstrap style -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css"
      integrity="sha384-nU14brUcp6StFntEOOEBvcJm4huWjB0OcIeQ3fltAfSmuZFrkAif0T+UtNGlKKQv" crossorigin="anonymous">
<link href="{{ URL::asset('css/website.css') }}" rel="stylesheet">

<style>
    @media print {
        @page {
            size: landscape;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid black;
            padding: 5px;
        }

        th {
            background-color: #f2f2f2;
        }

        tr {
            page-break-inside: avoid;
        }
    }

</style>
