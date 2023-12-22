@extends('website.school.layouts.master', ['no_sidebar' => true])

@section('title', 'الصفحة الرئيسية لمدرستك في منصة لام | منصة لام')
@section('topbar', 'الصفحة الرئيسية لمدرستك في منصة لام | منصة لام')

<!-- css insert -->
@section('css')

<!-- select 2 -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/css/select2.min.css"
    integrity="sha512-aD9ophpFQ61nFZP6hXYu4Q/b/USW7rpLCQLX6Bi0WJHXNO7Js/fUENpBQf/+P4NtpzNX0jSgR5zVvPOJp+W2Kg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />


<!-- tables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.2/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/autofill/2.3.9/css/autoFill.bootstrap5.min.css">


<!-- datepicker time and date -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.css"
    integrity="sha512-MQXduO8IQnJVq1qmySpN87QQkiR1bZHtorbJBD0tzy7/0U9+YIC93QWHeGTEoojMVHWWNkoCp8V6OzVSYrX0oQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://fastly.jsdelivr.net/npm/flatpickr@4.6.13/dist/plugins/monthSelect/style.min.css">

@endsection

<!-- content insert -->
@section('content')

<div class="cont_wrapper pb-2">

    <div class="main_cont py-4 px-0 px-md-4 py-5 text-center">

        <h5 class="mb-4 fw-bold">اختر المدرسة التي تود العمل عليها في الفترة الحالية</h5>

        <div class="row justify-content-center">

            <div class="col-12 col-md-7">
                <div data-school_type="1"
                    class="border_dark_blue_btn svg_white_hove py-3 border_radius_10 px-3 px-md-5 fw-bold finished_roadmap_btn mb-2 d-flex justify-content-between w-100 mx-auto">
                    <h6 class="mb-0">
                        <img class="me-2" alt="school" src="{{ URL::asset('img/icons/sidebar/school.svg') }}">
                        انتقل الي {{Auth::guard('school')->user()->first_school->name }}
                    </h6>
                    <div>
                        دخول
                        <i class="fas fa-arrow-left ms-3"></i>
                    </div>
                </div>
            </div>

            <div class="col-12  col-md-7">
                <div data-school_type="1"
                    class="border_dark_blue_btn svg_white_hove py-3 border_radius_10 px-3 px-md-5 fw-bold finished_roadmap_btn mb-2 d-flex justify-content-between w-100 mx-auto">
                    <h6 class="mb-0">
                        <img class="sidebare_icon me-2" alt="school"
                            src="{{ URL::asset('img/icons/sidebar/school.svg') }}">
                        انتقل الي {{Auth::guard('school')->user()->second_school->name }}
                    </h6>
                    <div>
                        دخول
                        <i class="fas fa-arrow-left ms-3"></i>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>

@endsection

<!-- js insert -->
@section('js')


<script>
    $(document).on('click', ".finished_roadmap_btn", function(e) {
e.preventDefault();

    var url = "{{ route('school_route.choose_school_start_store') }}";

    var type = $(this).data('school_type');

    that = this;

    $.ajax({
        url: url
        , type: 'POST'
        , dataType: "json"
        , data: {
            '_token': "{{ csrf_token() }}"
            , 'type': type
        , }
        , success: function(data) {
            if (data.status == true) {
                toastr.success(data.msg);
                var url = data.url;
                    $('#choose_school_page').hide();
                    $('#cong_page').show();
                    var delay = 1500;
                    setTimeout(function(){ window.location.href = url; }, delay);
            } 
            else {
                toastr.error(data.msg);
            }
        }
        , error: function(err) {
            toastr.error(err.responseJSON.message);
            //show error message after the input and in toaster
            $.each(err.responseJSON.errors, function (input_name, error) {
                    var el = $(document).find('#'+input_name+'-js_error_valid');
                    el.html($('<div class="error_ajax_msg" style="color: red;">'+error[0]+'</div>'));
                    toastr.error(error[0]);
            });

        }
    , });

});
</script>

@endsection