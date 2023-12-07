@extends('website.school.layouts.master', ['no_header' => true, 'no_transparent_header' => false])

@section('title', 'اللجان والفرق | منصة لام')
@section('topbar', 'اللجان والفرق | منصة لام')

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
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item text-s2 active"  style="color: white;" aria-current="page">المدرسه</li>
                            <li class="breadcrumb-item text-s2" style="color: white;">اللجان والفرق</li>
                        </ol>
                    </nav>

                </div>

            </div>



            <div class="col-12 mb-3 mb-md-0">
                <div class="main_cot_bg p-3 py-3 h-100">

                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active tabcontent_active " id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button"
                                    role="tab" aria-controls="pills-home" aria-selected="true">
                                إجتماعات اللجان


                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button"
                                    role="tab" aria-controls="pills-profile" aria-selected="false">
                                إجتماعات الفرق
                            </button>
                        </li>

                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade  show active " id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">

                            <div style="    margin-top: 10%;" class="accordion" id="accordionExample">
                                @foreach ($Committees_and_teams as $key => $item)
                                 @if($item->classification ==1 )
                                <div class="accordion-item" style=" margin-bottom: 35px; ">

                                    <h2 class="accordion-header">

                            <div class="row background_button_body no-margin-left-right ">
                                <div class="col-8 no_arrows_data_to_show ">
                                    <button class="accordion-button   " type="button" data-bs-toggle="collapse" data-bs-target="#collapse_{{$item->id}}"
                                            aria-expanded="true"     aria-controls="collapse_{{$item->id}}">
                                        {{ $item->title   }}
                                    </button>
                                </div>
                                <div class="col-2">
                                      <a  href="{{ route('school_route.meetings.create',  ['Committees_id'=>$item ->id]  ) }} " class="link-cust-text main_btn border_radius_10 px-4 clickable-item-pointer text-xs"
                                         style="  margin-top: 5px; "    > <i class="fas fa-plus"></i>
                                        <span class="no_show_on_map">
                                        انشاء اجتماع جديد
                                        </span>
                                      </a>
                                </div>
                                <div class="col-2">
                                    <button class="accordion-button   " type="button" data-bs-toggle="collapse" data-bs-target="#collapse_{{$item->id}}"
                                            aria-expanded="true"     aria-controls="collapse_{{$item->id}}">

                                    </button>
                                </div>
                            </div>



                                    </h2>


                                    <div id="collapse_{{$item->id}}" class="accordion-collapse collapse  @if($key ==0 )  show @endif  "
                                         data-bs-parent="#accordionExample">
                                        <div class="accordion-body">

                                            <div class=" add_border_radius table-responsive" id="admin_table_cont" style="display: block"   >
                                                <table class="table display datatable-modal"   id="p_3-table" width="100%"  cellspacing="0">
                                                    <thead>
                                                    <tr>
                                                        <th  class=" table_title_color text-xs fw-bold">م</th>
                                                        <th  class=" table_title_color text-xs fw-bold">الاجتماع  </th>
                                                        <th class="table_title_color  text-xs fw-bold">   تاريخ الاجتماع </th>
                                                        <th class=" table_title_color  text-xs fw-bold">   نوع الاجتماع </th>
                                                        <th class=" table_title_color  text-xs fw-bold">   الفصل الدراسي </th>
                                                        <th class=" table_title_color  text-xs fw-bold">حاله الاجتماع  </th>
                                                        <th class=" table_title_color  text-xs fw-bold">   تاريخ الانشاء </th>
                                                        <th class=" table_title_color  text-xs fw-bold"></th>
                                                    </tr>
                                                    </thead>

                                                    <tbody id="admin_table_cont_tr">
                                                    @foreach ($item->get_meetings as $key_val => $item_val)
                                                    <tr id="row_cod11">
                                                        <td class="">
                                                            {{ $key_val+1   }}
                                                        </td>
                                                        <td class="">
                                                            {{ $item_val->title   }}
                                                        </td>
                                                        <td class="">
                                                           {{ \Carbon\Carbon::parse($item_val->start_date)->format('Y/m/d') }}
                                                        </td>
                                                        <td class="">
                                                            {{ $item_val->type?'طارئ':'دوري'   }}
                                                        </td>
                                                        <td class="">
                                                            {{ $item_val->Semester   }}
                                                        </td>
                                                        <td class="">
                                                            @if($item_val->status)
                                                           مكتمل
                                                            @else
                                                                غير مكتمل
                                                            @endif
                                                        </td>
                                                        <td class="">
                                                            {{ \Carbon\Carbon::parse($item_val->created_at)->format('Y/m/d') }}
                                                        </td>
                                                        <td>
                                                            <div class="dropdown no-arrow">
                                                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                                                   data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-popper-placement="bottom-start">
                                                                    <i class="fas fa-ellipsis-v fs-6 fa-fw text-gray-700"></i>
                                                                </a>
                                                                <div style="min-width: 20px;" class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                                                                    <a class="dropdown-item" href="#" data-bs-toggle="modal" data-meeting-id="{{$item_val->id}}" data-bs-target="#delete_admin_modal"><i class="fas fa-trash me-1 text-red"></i>حذف</a>
                                                                    <a class="dropdown-item update_admin" href="{{url('/school/meetings/'.$item_val->id.'/edit')}}"><i class="fas fa-edit me-1 text-green"></i>تعديل</a>
                                                                    <a class="dropdown-item update_admin" href="{{url('/school/meetings/'.$item_val->id.'/PrintPdf')}}"><i class="fas fa-print me-1 text-blue-400" ></i>طباعه </a>
                                                                    <a class="dropdown-item update_admin" href="{{url('/school/meetings/'.$item_val->id.'/download-pdf')}}"><i class="fas fa-file-download me-1 text-yellow"></i>تحميل </a>
                                                                </div>
                                                            </div>





                                                        </td>
                                                    </tr>
                                                    @endforeach

                                                    </tbody>

                                                </table>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                @endif
                                @endforeach
                            </div>

                        </div>
                        <div class="tab-pane fade   " id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                            <div style="    margin-top: 10%;" class="accordion" id="accordionExample">
                                @foreach ($Committees_and_teams as $key => $item)
                                    @if($item->classification ==2 )
                                        <div class="accordion-item" style=" margin-bottom: 35px; ">

                                            <h2 class="accordion-header">

                                                <div class="row background_button_body no-margin-left-right ">
                                                    <div class="col-8 no_arrows_data_to_show ">
                                                        <button class="accordion-button   " type="button" data-bs-toggle="collapse" data-bs-target="#collapse_{{$item->id}}"
                                                                aria-expanded="true"     aria-controls="collapse_{{$item->id}}">
                                                            {{ $item->title   }}
                                                        </button>
                                                    </div>
                                                    <div class="col-2">
                                                        <a  href="{{ route('school_route.meetings.create',  ['Committees_id'=>$item ->id]  ) }} " class="link-cust-text main_btn border_radius_10 px-4 clickable-item-pointer text-xs"
                                                            style="  margin-top: 5px; "    > <i class="fas fa-plus"></i>
                                                            <span class="no_show_on_map">
                                        انشاء اجتماع جديد
                                        </span>
                                                        </a>
                                                    </div>
                                                    <div class="col-2">
                                                        <button class="accordion-button   " type="button" data-bs-toggle="collapse" data-bs-target="#collapse_{{$item->id}}"
                                                                aria-expanded="true"     aria-controls="collapse_{{$item->id}}">

                                                        </button>
                                                    </div>
                                                </div>



                                            </h2>


                                            <div id="collapse_{{$item->id}}" class="accordion-collapse collapse  @if($key ==0 )  show @endif  "
                                                 data-bs-parent="#accordionExample">
                                                <div class="accordion-body">

                                                    <div class=" add_border_radius table-responsive" id="admin_table_cont" style="display: block"   >
                                                        <table class="table display datatable-modal"   id="p_3-table" width="100%"  cellspacing="0">
                                                            <thead>
                                                            <tr>
                                                                <th  class=" table_title_color text-xs fw-bold">الاجتماع  </th>
                                                                <th class="table_title_color  text-xs fw-bold">   تاريخ الاجتماع </th>
                                                                <th class=" table_title_color  text-xs fw-bold">   نوع الاجتماع </th>
                                                                <th class=" table_title_color  text-xs fw-bold">   الفصل الدراسي </th>
                                                                <th class=" table_title_color  text-xs fw-bold">حاله الاجتماع  </th>
                                                                <th class=" table_title_color  text-xs fw-bold">   تاريخ الانشاء </th>
                                                                <th class=" table_title_color  text-xs fw-bold"></th>
                                                            </tr>
                                                            </thead>

                                                            <tbody id="admin_table_cont_tr">
                                                            @foreach ($item->get_meetings as $key_val => $item_val)
                                                                <tr id="row_cod11">
                                                                    <td class="">
                                                                        {{ $item_val->title   }}
                                                                    </td>
                                                                    <td class="">
                                                                        {{ $item_val->start_date   }}
                                                                    </td>
                                                                    <td class="">
                                                                        {{ $item_val->type?'طارئ':'دوري'   }}
                                                                    </td>
                                                                    <td class="">
                                                                        {{ $item_val->Semester   }}
                                                                    </td>
                                                                    <td class="">
                                                                        @if($item_val->status)
                                                                            مكتمل
                                                                        @else
                                                                            غير مكتمل
                                                                        @endif
                                                                    </td>
                                                                    <td class="">
                                                                        {{ $item_val->created_at   }}
                                                                    </td>
                                                                    <td>
                                                                        <div class="dropdown no-arrow">
                                                                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                                                               data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                                <i class="fas fa-ellipsis-v fs-6 fa-fw text-gray-700"></i>
                                                                            </a>
                                                                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" style="min-width: unset"
                                                                                 aria-labelledby="dropdownMenuLink">
                                                                                <a class="dropdown-item text-green update_admin" href="{{url('/school/meetings/'.$item_val->id.'/edit')}}"><i class="fas fa-trash-alt me-1"></i>تعديل</a>

                                                                                <a class="dropdown-item text-red" href="#" data-bs-toggle="modal" data-meeting-id="{{$item_val->id}}" data-bs-target="#delete_admin_modal"><i class="fas fa-trash-alt me-1"></i>حذف</a>
                                                                                <a class="dropdown-item text-green update_admin" href="{{url('/school/meetings/'.$item_val->id.'/PrintPdf')}}"><i class="fas fa-print me-1"></i>طباعه </a>
                                                                                <a class="dropdown-item text-green update_admin" href="{{url('/school/meetings/'.$item_val->id.'/download-pdf')}}"><i class="fas fa-download me-1"></i>تحميل </a>
                                                                            </div>
                                                                        </div>



                                                                    </td>
                                                                </tr>
                                                            @endforeach

                                                            </tbody>

                                                        </table>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                    @endif
                                @endforeach
                            </div>
                        </div>
                     </div>





                </div>
            </div>

        </div>
        <!-- Delete Modal -->
        <div class="modal fade" id="delete_admin_modal" tabindex="-1"
             aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable ">
                <div class="modal-content b-r-s-cont border-0">

                    <div class="modal-header">
                        <div class="modal-title" id="exampleModalLabel"><i
                                class="fas fa-trash me-1"></i>
                            حذف الاداري </div>
                        <button type="button" data-bs-dismiss="modal"
                                aria-label="Close"><i class="fas fa-times"></i></button>
                    </div>
                    <form action="{{ route('school_route.meetings.destroy', $item_val['id']) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <!-- Modal content -->
                        <div class="modal-body px-4">
                            <div class="modal-body delete-conf-input text-center py-0">
                                <p class="mb-0">هل انت متاكد من حذف  الاجتماع</p>
                                <br>
                                <input type="hidden" name="meeting_id" id="modalMeetingId">

                            </div>
                        </div>

                        <div class="modal-footer">
                            <div class="right-side">
                                <button type="submit" data-code="cod11" class="btn btn-default btn-link text-red fw-bold delete_admin_btn">حذف
                                </button>
                            </div>
                            <div class="divider"></div>
                            <div class="left-side">
                                <button type="button" class="btn btn-default btn-link"
                                        data-bs-dismiss="modal">غلق النافذة</button>
                            </div>
                        </div>
                    </form>
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

        $('#delete_admin_modal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var meetingId = button.data('meeting-id');

            var modal = $(this);
            modal.find('#modalMeetingId').val(meetingId);
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
