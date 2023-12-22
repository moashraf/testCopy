@extends('layouts.master')

@section('title', __('basic.lab'))

<!-- css insert -->
@section('css')

<!-- select 2 -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/css/select2.min.css"
    integrity="sha512-aD9ophpFQ61nFZP6hXYu4Q/b/USW7rpLCQLX6Bi0WJHXNO7Js/fUENpBQf/+P4NtpzNX0jSgR5zVvPOJp+W2Kg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

<!-- tables -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.2/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/autofill/2.3.9/css/autoFill.bootstrap5.min.css">

@endsection

<!-- content insert -->
@section('content')

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#sidemodal">
    Launch demo modal
</button>

<!-- Modal -->
<div class="modal side_modal_prox fade" id="sidemodal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <span class="text-gray-300 clickable-item-pointer me-3" data-bs-dismiss="modal">Close</span>
                <button type="button" class="btn btn-primary px-5">Save changes</button>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid px-2 mt-3">

    <!-- page title link -->
    <div class="d-sm-flex align-items-center justify-content-between mb-3">
        <span class="mb-0">
            <a class="link-cust-text text-gray-200 fw-light" href="{{ route('sett.home') }}">Dashboard |</a>
            <a class="text-gray-300">Lab search</a>
        </span>


        <div class="d-flex justify-content-center">
            <a href="{{ route('sett.appointment.create') }}"
                class="bg-white  btn btn-sm shadow-sm b-r-l-cont p-2 px-4 text-gray-400"><i
                    class="fas fa-plus fa-sm text-gray-300 me-1"></i> New</a>
        </div>


    </div>


    <div class="row justify-content-center position-relative">

        <div class="col-12 col-md-10 col-lg-8 col-xl-7">
            <img class="img-fluid p-md-2" src="{{ URL::asset('img/dashboard/undraw_medical_research_qg4d.svg') }}"
                alt="">

            <div class="search-eng-cont">

                <div class="p-1 bg-white rounded rounded-pill"
                    style="box-shadow: -1px 1rem 1rem 7px rgb(58 59 69 / 15%) !important; ">

                    <div class="input-group">
                        <input id="search-eng" type="search" placeholder="Write here the x-ray code .."
                            aria-describedby="button-add" class="form-control border-0 bg-transparent px-4">
                        <div class="input-group-append pe-2 d-flex">
                            <button id="button-addon1" type="submit" class="btn btn-link text-primary typeahead"><i
                                    class="fa fa-search text-gray-300"></i></button>
                        </div>
                    </div>

                </div>

                <div id="search-eng-show-list" class="search-eng-results list-group p-4 bg-white b-r-l-b-cont"
                    style="box-shadow: -1px 1rem 1rem 7px rgb(58 59 69 / 15%) !important; display:none">
                </div>

            </div>

        </div>
    </div>


    <div class="d-sm-flex align-items-center justify-content-between mb-3">
        <span class="mb-0">
        </span>


        <div class="d-flex justify-content-center mt-2">
            <a href="http://localhost:8000/appointment/create"
                class="bg-white  btn btn-sm shadow-sm b-r-l-cont p-2 px-4 text-gray-400"><i
                    class="fas fa-plus fa-sm text-gray-300 me-1"></i> New</a>
        </div>


    </div>


    <div class="row">
        <div class="col-12 col-md-6">
            <div class="card card-input shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 fw-bold"><i class="fas fa-x-ray"></i> Waiting for paying</h6>
                    <div class="dropdown no-arrow d-flex">
                        <div class="cont-branch-calendar me-2">
                            <select id="select-branch-table"
                                class="js-example-basic-single select2-no-search select2-hidden-accessible">
                                @foreach ($branches as $iteam)
                                <option value="{{ $iteam->id }}">
                                    {{ $iteam->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <a class="dropdown-toggle align-self-center" href="#" role="button" id="dropdownMenuLink"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-300"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                            aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Dropdown Header:</div>
                            <a class="dropdown-item" href="#">Action</a>
                        </div>
                    </div>
                </div>

                <!-- Card Body -->
                <div class="card-body overflow-scroll" id="lab_nopay_table_cont">

                    <div class="text-center text-gray-400">
                        <div><i class="far fa-check-circle fs-3 mb-1"></i></div>
                        No Lab Results
                    </div>

                </div>

                <!-- Card footer -->
                <div class="card-footer text-center ">

                </div>

            </div>
        </div>




        <div class="col-12 col-md-6">
            <div class="card card-input shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 fw-bold"><i class="fas fa-x-ray"></i> Latest lab results</h6>
                    <div class="dropdown no-arrow d-flex">
                        <div class="cont-branch-calendar me-2">
                            <select id="select-branch-table"
                                class="js-example-basic-single select2-no-search select2-hidden-accessible">
                                @foreach ($branches as $iteam)
                                <option value="{{ $iteam->id }}">
                                    {{ $iteam->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <a class="dropdown-toggle align-self-center" href="#" role="button" id="dropdownMenuLink"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-300"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                            aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Dropdown Header:</div>
                            <a class="dropdown-item" href="#">Action</a>
                        </div>
                    </div>
                </div>

                <!-- Card Body -->
                <div class="card-body">

                    <div class="table-responsive" id="lab_result_table_cont">
                        <div class="text-center text-gray-400">
                            <div><i class="far fa-check-circle fs-3 mb-1"></i></div>
                            No Lab Results
                        </div>

                        <!-- Card footer -->
                        <div class="card-footer text-center ">

                        </div>

                    </div>
                </div>
            </div>


        </div>
        @endsection

        <!-- js insert -->
        @section('js')

        <!-- select 2 -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/js/select2.min.js"
            integrity="sha512-4MvcHwcbqXKUHB6Lx3Zb5CEAVoE9u84qN+ZSMM6s7z8IeJriExrV3ND5zRze9mxNlABJ6k864P/Vl8m0Sd3DtQ=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script>
            $(document).ready(function() {
                    $('.js-example-basic-single').select2();
                    //hide search
                    $('.select2-no-search').select2({
                        minimumResultsForSearch: -1
                    });
                });
        </script>

        <script>
            $(document).ready(function() {

                    //--------------------- search engine ajax -------------------


                    // Send Search Text to the server

                    $("#search-eng").keyup(function() {

                        var branch_id = $('#select-method-search').val();

                        let search_query = $(this).val();


                        var url = "{{ route('sett.lab_lab_search', ':search_query') }}";
                        url = url.replace(':search_query', search_query);

                        if (search_query != "") {
                            $.ajax({
                                url: url,
                                type: "GET",
                                dataType: "json",
                                success: function(data) {
                                    $("#search-eng-show-list").show();

                                    if (data !== "") {
                                        var html = ''
                                        $.each(data, function(key, value) {
                                            var url_show = "{{ url('/lab/') }}" +
                                                "/" +
                                                value.id;
                                            html +=
                                                '<a href="' + url_show +
                                                '" class="search-eng-a list-group-item list-group-item-action border-1 text-gray-500" style="cursor: pointer;"><i class="fas fa-search text-gray-200 me-2"></i> ' +
                                                value.code + '</a>';
                                        });
                                        $('#search-eng-show-list').html(html);
                                    }

                                    if (data == "") {
                                        $('#search-eng-show-list').html(
                                            '<a class="list-group-item list-group-item-action border-0"><i class="fas fa-search text-gray-200 me-2"></i>No Record</a>'
                                        );
                                    }
                                },
                            });
                        } else {
                            $("#search-eng-show-list").empty();
                            $("#search-eng-show-list").hide();;
                        }
                    });


                    //--------------------- search engine ajax -------------------

                    var branch_id = $('#select-branch-table').val();


                    lab_result_nopay_table();

                    function lab_result_nopay_table(branch = branch_id) {

                        $.ajax({
                            url: '{{ url('/lab/lab_result_nopay_index') }}/' + branch,
                            type: "GET",
                            dataType: "json",
                            success: function(data) {

                                if (data.length > 0) {

                                    var html = ''

                                    $.each(data, function(key, value) {
                                        var url_show = "{{ url('/lab/') }}" +
                                            "/" +
                                            value.id;

                                        if (value.invoice.status == 0) {
                                            var text_color = 'cancel-color-btn';
                                            var msg = 'Not Paid';
                                        } else if (value.invoice.status == 1) {
                                            var text_color = 'done-color-btn';
                                            var msg = 'Paid';
                                        }

                                        html +=
                                            '<div class="row overflow-scroll flex-nowrap overflow-auto mb-2 ">' +

                                            '<div class="col-3 d-flex align-items-center position-relative">' +
                                            '<i class="fas fa-file-medical-alt me-2 fs-3"></i>' +
                                            '<div class="text-truncate">' +
                                            '<h6 class="mb-1 fw-bold text-gray-600 text-truncate">' +
                                            value.service_item.name + '</h6>' +

                                            '<p class="mb-0 text-xs text-gray-300 text-truncate">' +
                                            value.created_at +
                                            '</p>' +

                                            '</div>' +

                                            '<a href="' + url_show +
                                            '" class="stretched-link"></a>' +
                                            '</div>' +

                                            '<div class="col-3 text-center align-self-center">' +
                                            '<p class="text-xs text-gray-200 mb-0">Patient</p>' +
                                            '<h6 class="text-s text-gray-400">' + value.patient.name +
                                            '</h6></div>' +

                                            '<div class="col-3 text-center align-self-center">' +
                                            '<p class="text-xs text-gray-200 mb-0">Pay. code</p>' +
                                            '<h6 class="text-s text-gray-400">' + value.invoice.code +
                                            '</h6></div>' +

                                            '<div class="col-3 text-center align-self-center">' +
                                            '<p class="text-xs text-gray-200 mb-1">Status</p>' +
                                            '<span class="badge rounded-pill badge-padd-l ' +
                                            text_color + '">' + msg +
                                            '</span></div>' +

                                            '</div>'

                                    })
                                }

                                $('#lab_nopay_table_cont').html(html);

                            }

                        })
                    };


                    lab_result_table();

                    function lab_result_table(branch = branch_id) {

                        $.ajax({
                            url: '{{ url('/lab/lab_result_index') }}/' + branch,
                            type: "GET",
                            dataType: "json",
                            success: function(data) {

                                if (data.length > 0) {

                                    var html = ''

                                    $.each(data, function(key, value) {
                                        var url_show = "{{ url('/lab/') }}" +
                                            "/" +
                                            value.id;

                                        if (value.status == 0) {
                                            var text_color = 'cancel-color-btn';
                                            var msg = 'Sent';
                                        } else if (value.status == 1) {
                                            var text_color = 'done-color-btn';
                                            var msg = 'Done';
                                        }

                                        html +=
                                            '<div class="row overflow-scroll flex-nowrap overflow-auto mb-2 ">' +

                                            '<div class="col-4 d-flex align-items-center position-relative">' +
                                            '<i class="fas fa-file-medical-alt me-2 fs-3"></i>' +
                                            '<div class="text-truncate">' +
                                            '<h6 class="mb-1 fw-bold text-gray-600 text-truncate">' +
                                            value.service_item.name + '</h6>' +

                                            '<p class="mb-0 text-xs text-gray-300 text-truncate">' +
                                            value.created_at +
                                            '</p>' +

                                            '</div>' +

                                            '<a href="' + url_show +
                                            '" class="stretched-link"></a>' +
                                            '</div>' +

                                            '<div class="col-4 text-center align-self-center">' +
                                            '<p class="text-xs text-gray-200 mb-0">Patient</p>' +
                                            '<h6 class="text-s text-gray-400">' + value.patient.name +
                                            '</h6></div>' +

                                            '<div class="col-4 text-center align-self-center">' +
                                            '<p class="text-xs text-gray-200 mb-1">Status</p>' +
                                            '<span class="badge rounded-pill badge-padd-l ' +
                                            text_color + '">' + msg +
                                            '</span></div>' +

                                            '</div>'

                                    })
                                }

                                $('#lab_result_table_cont').html(html);

                            }

                        })
                    };


                });
        </script>



        <!-- -- datatables plugin -- -->
        <script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js">
        </script>
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.bootstrap5.min.js">
        </script>

        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js">
        </script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js">
        </script>
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>

        <script type="text/javascript" language="javascript"
            src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>

        <script type="text/javascript" language="javascript"
            src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.colVis.min.js"></script>

        <script>
            $(document).ready(function() {

                    var table = $('#table-lab').DataTable({
                            lengthChange: false,
                            "order": [
                                [4, "ASC"]
                            ],
                            buttons: {
                                dom: {
                                    button: {
                                        className: 'btn btn-table-export me-0' //Primary class for all buttons
                                    }
                                },
                                buttons: ['copy', 'excel', 'pdf']
                            }
                        }

                    );
                    table.buttons().container()
                        .appendTo('#table-lab_wrapper .col-md-6:eq(0)');

                });
        </script>

        @endsection