@extends('layouts.master')

@section('title', 'Clients | Lam - School Management App')

@section('title-topbar', __('basic.patients'))

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


@section('fixedcontent')

<!-- session successful message -->
@if (Session::has('success'))
<div id="flash-msg" class="shadow pt-3">
    <div class="d-flex justify-content-between mb-2">
        <i class="fas fs-1 fa-check"></i>
        <a id="flash-msg-btn" class="text-blue-300 clickable-item-pointer"><i class="fas fa-times"></i></a>
    </div>
    <h3>Sent Successfully</h3>
    <p class="text-blue-300">{{ Session::get('success') }}</p>
</div>
@endif

@endsection

<!-- content insert -->
@section('content')
<div class="container-fluid px-2 mt-3">

    <!-- page title link -->
    <div class="d-sm-flex align-items-center justify-content-between mb-0">
        <span class="mb-0">
            <a class="link-cust-text text-gray-200 fw-light" href="{{ route('sett.home') }}">{{ __('basic.dashboard') }}
                |</a>
            <a class="text-gray-300">{{ __('patientappo.patient search') }}</a>
        </span>

        <div class="mt-2 mt-md-0 text-center">

            <a href="{{ route('sett.pat_allstatcs') }}"
                class="bg-white btn btn-sm shadow-sm b-r-l-cont p-2 px-4 text-gray-400 me-1"><i
                    class="fas fa-chart-bar fa-sm text-gray-300 me-1"></i> {{ __('basic.statistics') }}</a>
        </div>

    </div>


    <div class="row justify-content-center position-relative">
        <div class="col-12 col-md-10 col-lg-8 col-xl-7 text-center">
            <img class="img-fluid p-md-2" width="510px" src="{{ URL::asset('img/svg/undraw_true_friends_c-94-g.svg') }}"
                alt="">

            <div class="search-eng-cont search-eng-cont-patient">

                <div class="p-1 bg-white rounded rounded-pill"
                    style="box-shadow: -1px 1rem 1rem 7px rgb(58 59 69 / 15%) !important; ">

                    <div class="input-group">
                        <input id="search-eng" type="search" placeholder="{{ __('patientappo.patient search msg') }}"
                            aria-describedby="button-add" class="form-control border-0 bg-transparent px-4" autofocus>
                        <div class="input-group-append pe-2">
                            <button id="button-addon1" type="submit" class="btn btn-link text-primary typeahead"><i
                                    class="fa fa-search text-gray-300"></i></button>
                        </div>
                    </div>

                </div>

                <div id="search-eng-show-list"
                    class="search-eng-results list-group p-4 bg-white b-r-l-b-cont text-start"
                    style="box-shadow: -1px 1rem 1rem 7px rgb(58 59 69 / 15%) !important; display:none">
                </div>

            </div>

        </div>
    </div>

    <div class="d-sm-flex align-items-center justify-content-between mb-3">
        <span class="mb-0">
        </span>

    </div>


    <div class="row">

        <div class="col-12 px-0 px-md-2">
            <div class="card card-input shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 fw-bold"><i class="fas fa-users"></i> {{ __('basic.new travelers') }}</h6>
                    <div class="dropdown no-arrow d-flex">
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

                    <div class="table-responsive" id="about_finished_cont">
                        <div class="text-center text-gray-400">
                            <div><i class="far fa-check-circle fs-3 mb-1"></i></div>
                            No Results Founded
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
    //--------------------- search engine ajax -------------------

        $(document).ready(function() {
            // Send Search Text to the server
            $("#search-eng").keyup(function() {
                let search_query = $(this).val();
                if (search_query != "") {

                    var url = "{{ route('sett.pat_patient_search', ':id') }}";
                    url = url.replace(':id', search_query);

                    $.ajax({
                        url: url,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $("#search-eng-show-list").show();

                            if (data !== "") {
                                var html = ''
                                $.each(data, function(key, value) {

                                    var url_show =
                                        "{{ route('sett.managers.show', ':id') }}";
                                    url_show = url_show.replace(':id', value.id);

                                    html +=
                                        '<a href="' + url_show +
                                        '" class="search-eng-a list-group-item list-group-item-action border-1 text-gray-500" style="cursor: pointer;"><i class="fas fa-search text-gray-200 me-2"></i> ' +
                                        value.full_name + '</a>';
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



            //--------------------- finished and close to finish sections -------------------

            var branch_id = $('#select-branch-table').val();
            new_patients();

            function new_patients(branch = branch_id) {

                var url = "{{ route('sett.pat_inven_new_patients_index', ':branch') }}";
                url = url.replace(':branch', branch);
                $.ajax({
                    url: url,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {

                        if (data.length > 0) {

                            var html = ''

                            $.each(data, function(key, value) {

                                var url_show = "{{ URL::asset('img/useravatar/') }}" +
                                    "/" +
                                    value.avatar;

                                var patient_url = "{{ route('sett.managers.show', ':id') }}";
                                patient_url = patient_url.replace(':id', value.id);

                                html +=
                                    '<div class="row mb-2 ">' +

                                    '<div class="col-4 d-flex align-items-center">' +
                                    '<img class="rounded-circle avatar-small2 me-3" src="' +
                                    url_show + '">' +
                                    '<div class="">' +
                                    '<p class=" mb-0 text-xs text-gray-300"> {{ __('basic.patient') }} </p>' +
                                    '<a href="' + patient_url +
                                    '" class="mb-1 fw-bold text-gray-600">' +
                                    value.full_name +
                                    '</a>' +
                                    '</div></div>' +

                                    '<div class="col-2 text-center align-self-center text-truncate">' +
                                    '<p class="text-xs text-gray-200 mb-0 text-truncate">Phone</p>' +
                                    '<h6 class="text-s text-gray-400 text-truncate">' + value
                                    .phone_number +
                                    '</h6></div>' +

                                    '<div class="col-2 text-center align-self-center">' +
                                    '<p class="text-xs text-gray-200 mb-0">Country</p>' +
                                    '<div class="text-s text-gray-600 fw-bold">' + value
                                    .country.name + '</div></div>' +

                                    '<div class="col-2 text-center align-self-center">' +
                                    '<p class="text-xs text-gray-200 mb-0">City</p>' +
                                    '<div class="text-s text-gray-600 fw-bold">' + value
                                    .city.name +
                                    '</div></div>' +

                                    '</div>'

                            })

                            $('#about_finished_cont').html(html);

                        } else {
                            $('#about_finished_cont').html(
                                '<div class="text-center text-gray-400">' +
                                '<div><i class="far fa-check-circle fs-3 mb-1"></i></div>' +
                                'No Result</div>');
                        }


                    }

                })
            };

            //reinsert patients results when branch selector is changed
            $(document).on('change', '#select-branch-table', function() {
                var branch = $(this).val();
                new_patients(branch);
            });

        });
</script>

<!-- -- datatables plugin -- -->
<script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.bootstrap5.min.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
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