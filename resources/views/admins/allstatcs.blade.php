@extends('layouts.master')

@section('title', 'Statistics | Lam - School Management App')

@section('title-topbar', 'Statistics')

<!-- css insert -->
@section('css')

<!-- select 2 -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/css/select2.min.css"
    integrity="sha512-aD9ophpFQ61nFZP6hXYu4Q/b/USW7rpLCQLX6Bi0WJHXNO7Js/fUENpBQf/+P4NtpzNX0jSgR5zVvPOJp+W2Kg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

<!-- boostrap datepicker -->
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css" />

@endsection

<!-- content insert -->
@section('content')

<div class="container-fluid px-2 mt-3">

    <!-- page title link -->
    <div class="d-flex align-items-center justify-content-between mb-3">

        <span class="mb-0">
            <a class="link-cust-text text-gray-200 fw-light" href="{{ route('sett.home') }}">Dashboard |</a>
            <a class="text-gray-300">Workers statistics</a>
        </span>

        <div class="d-flex justify-content-center mt-2 mt-md-0">

            <a class="main-color-bg text-white btn btn-sm shadow-sm b-r-l-cont p-2 px-4 me-1" data-bs-toggle="modal"
                data-bs-target="#new_record"><i class="fas fa-filter fa-sm me-1"></i> Filter</a>

            <!-- Modal for search filtering -->
            <div class="modal fade" id="new_record" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">

                    <form class="mb-0" action="{{ route('sett.user_allstatcs') }}" method="GET"
                        style="display: contents">

                        <div class="modal-content b-r-s-cont border-0">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-clipboard me-1"></i>
                                    Search Filter</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>

                            <!-- Modal content -->
                            <div class="modal-body px-5 py-3">

                                <div class="row">

                                    <div class="col-12 mb-2">
                                        <label class="form-label">Specialty
                                            <small>(optional)</small></label>
                                        <select
                                            class="myselect2-record-insert myselect2-record-insert-nosearch select2-hidden-accessible"
                                            id="specialty" name="specialty">
                                            <option value="all">
                                                All
                                            </option>
                                            @foreach ($specialty_cat as $item)
                                            <option value="{{ $item->id }}" @if ($specialty==$item->id) selected @endif
                                                @if ($specialty == $item->id) selected @endif>
                                                {{ $item->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-12 mb-2">
                                        <label class="form-label">Branch
                                            <small>(optional)</small></label>
                                        <select
                                            class="myselect2-record-insert myselect2-record-insert-nosearch select2-hidden-accessible"
                                            id="branch" name="branch">
                                            <option value="all">
                                                All
                                            </option>
                                            @foreach ($branches as $item)
                                            <option value="{{ $item->id }}" @if ($branch==$item->id) selected @endif
                                                @if ($branch == $item->id) selected @endif>
                                                {{ $item->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-12 mb-2">
                                        <label class="form-label">From
                                            <small>(optional)</small></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"><i class="bi bi-calendar2-week-fill"></i>
                                                </div>
                                            </div>
                                            <input name="from" type="text" class="form-control hasdatetimepicker"
                                                value="{{ $from }}" placeholder="YYYY/MM">
                                        </div>
                                    </div>

                                    <div class="col-12 mb-2">
                                        <label class="form-label">To
                                            <small>(optional)</small></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"><i class="bi bi-calendar2-week-fill"></i>
                                                </div>
                                            </div>
                                            <input name="to" type="text" class="form-control hasdatetimepicker"
                                                value="{{ $to }}" placeholder="YYYY/MM">
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="modal-footer">
                                <div class="left-side">
                                    <button type="button" class="btn btn-default btn-link" data-bs-dismiss="modal">Never
                                        Mind</button>
                                </div>
                                <div class="divider"></div>
                                <div class="right-side">
                                    <button type="submit" class="btn btn-default btn-link main-color">Search</button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>

            </div>
        </div>

    </div>

    <div class="row mb-2">
        <ul class="nav nav-tabs nav-tabs-nobg mb-3 justify-content-center border-bottom-0 pe-0" id="myTab"
            role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="year_invoice-tab" data-bs-toggle="tab"
                    data-bs-target="#year_invoice" type="button" role="tab" aria-controls="year_invoice"
                    aria-selected="true" class="text-gray-500"><i class="fas fa-money-check me-1"></i>
                    Total workers</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="specialty-tab" data-bs-toggle="tab" data-bs-target="#specialty_stat"
                    type="button" role="tab" aria-controls="home" aria-selected="true" class="text-gray-500"><i
                        class="fas fa-users me-1"></i>
                    Top creators | confirmation</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="branches-tab" data-bs-toggle="tab" data-bs-target="#branches" type="button"
                    role="tab" aria-controls="operation_tab" aria-selected="true" class="text-gray-500"><i
                        class="fas fa-suitcase-rolling me-1"></i>
                    Top worker</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button"
                    role="tab" aria-controls="home" aria-selected="true" class="text-gray-500"><i
                        class="fas fa-coins me-1"></i>
                    Top accountants</button>
            </li>
        </ul>
    </div>

    <div class="row">

        <div class="col-12">
            <div class="card card-input shadow mb-3 pb-3">

                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 fw-bold text-gray-500"><i class="fas fa-chart-bar me-1"></i> Workers Statistics
                    </h6>
                </div>

                <!-- Card Body -->
                <div class="card-body">

                    <div class="tab-content" id="myTabContent">

                        <div class="tab-pane fade show active" id="year_invoice" role="tabpanel"
                            aria-labelledby="year_invoice">

                            <div class="row">

                                <div class="col-12 px-0 px-md-2">

                                    <div class="row">
                                        <div class="col-12 col-md-6 mb-3 mb-md-0 border-flex">
                                            <div class="chart-pie pt-4 pb-2">
                                                <canvas id="myChart-total-worker">
                                                    <!-- the code and its style is printed from js -->
                                                </canvas>
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6 text-center align-self-center">
                                            <h6 class="text-gray-400">Total workers</h6>
                                            @php
                                            //$profit = $all_pulses->sum('total_paid') - $all_pulses->sum('total_paid');
                                            @endphp
                                            <span class="fs-1">{{ $branch_worker->sum('total') }}<small
                                                    class="text-gray-300 text-xxxs">
                                                    workers</small></span>
                                        </div>

                                    </div>


                                </div>


                            </div>

                        </div>

                        <div class="tab-pane fade" id="specialty_stat" role="tabpanel" aria-labelledby="specialty-tab">

                            <div class="row">
                                <div class="col-12 col-md-6 border-flex mb-3">
                                    <h5 class="text-center text-gray-300">Top Appointment Creators</h5>
                                    <div class="chart-pie px-1 pb-3">
                                        <canvas id="myChart-top-creator-appointment">
                                            <!-- the code and its style is printed from js -->
                                        </canvas>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 border-flex mb-3">
                                    <h5 class="text-center text-gray-300">
                                        @if ($from !== 'all')
                                        Top Appointment Creators in the given date
                                        @else
                                        Top Appointment Creators this month
                                        @endif
                                    </h5>
                                    <div class="chart-pie px-1 pb-3">
                                        <canvas id="myChart-top-creator-appointment_month">
                                            <!-- the code and its style is printed from js -->
                                        </canvas>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 col-md-6 border-flex mb-3">
                                    <h5 class="text-center text-gray-300">Top Appointment Confirmation Workers</h5>
                                    <div class="chart-pie px-1 pb-3">
                                        <canvas id="myChart-top-confirmation-appointment">
                                            <!-- the code and its style is printed from js -->
                                        </canvas>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 border-flex mb-3">
                                    <h5 class="text-center text-gray-300">
                                        @if ($from !== 'all')
                                        Top Appointment Confirmation Workers in the given date
                                        @else
                                        Top Appointment Confirmation Workers this month
                                        @endif
                                    </h5>
                                    <div class="chart-pie px-1 pb-3">
                                        <canvas id="myChart-top-confirmation-appointment_month">
                                            <!-- the code and its style is printed from js -->
                                        </canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="branches" role="tabpanel" aria-labelledby="branches-tab">

                            <div class="row">
                                <div class="col-12 col-md-6 border-flex mb-3">
                                    <h5 class="text-center text-gray-300">Top Worker taking Appointments</h5>
                                    <div class="chart-pie px-1 pb-3">
                                        <canvas id="myChart-top-taking-appointment">
                                            <!-- the code and its style is printed from js -->
                                        </canvas>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 border-flex mb-3">
                                    <h5 class="text-center text-gray-300">
                                        @if ($from !== 'all')
                                        Top worker taking Appointment in the given date
                                        @else
                                        Top worker taking Appointment this month
                                        @endif
                                    </h5>
                                    <div class="chart-pie px-1 pb-3">
                                        <canvas id="myChart-top-taking-appointment_month">
                                            <!-- the code and its style is printed from js -->
                                        </canvas>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="home-tab">

                            <div class="row">
                                <div class="col-12 col-md-6 border-flex mb-3">
                                    <h5 class="text-center text-gray-300">Top Accountants
                                    </h5>
                                    <div class="chart-pie px-1 pb-3">
                                        <canvas id="myChart-accountants">
                                            <!-- the code and its style is printed from js -->
                                        </canvas>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <h5 class="text-center text-gray-300">
                                        @if ($from !== 'all')
                                        Top Accountants in the given date
                                        @else
                                        Top Accountants this month
                                        @endif
                                    </h5>
                                    <div class="chart-pie px-1">
                                        <canvas id="myChart-accountants_month">
                                            <!-- the code and its style is printed from js -->
                                        </canvas>
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

    <!-- select 2 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/js/select2.min.js"
        integrity="sha512-4MvcHwcbqXKUHB6Lx3Zb5CEAVoE9u84qN+ZSMM6s7z8IeJriExrV3ND5zRze9mxNlABJ6k864P/Vl8m0Sd3DtQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function() {

                $(".myselect2-record-insert").select2({
                    dropdownParent: $("#new_record")
                });

                //hide search
                $('.myselect2-record-insert-nosearch').select2({
                    dropdownParent: $("#new_record"),
                    minimumResultsForSearch: -1
                });

            })
    </script>

    <!-- jquery ui datepicker -->
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
    <script>
        $(function() {
                $('.hasdatetimepicker').datepicker({
                    todayHighlight: true,
                    format: "mm-yyyy",
                    viewMode: "months",
                    minViewMode: "months"
                }).on('change', function(){
                    $('.datepicker').hide();
                });
            });
    </script>

    <!-- -- Chart.js plugin -- -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.6.0/chart.min.js"
        integrity="sha512-GMGzUEevhWh8Tc/njS0bDpwgxdCJLQBWG3Z2Ct+JGOpVnEmjvNx6ts4v6A2XJf1HOrtOsfhv3hBKpK9kE5z8AQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    @php
    $chart_color = ['#323ac8', '#38dfa8','#1a78f1', '#d13c62', '#12c7d9', '#03c2c3', '#5035df', '#17a673', '#2e59d9',
    '#9aeded',
    '#f3d56a', '#7c859d', '#a4adc5', '#80142f', '#33d293', '#bed233', '#3958e9', '#10c86f', '#654fb6', '#a44fb6',
    '#89728e', '#c85110', '#6d769d', '#1b6954', '#204494', '#94206b', '#948320', '#209493', '#292094', '#203a65',
    '#4e6fa5', '#e29031', '#e23168', '#31e0e2', '#e29131', '#319fe2', '#8131e2', '#31a8e2', '#31e2c0', '#31c3e2',
    '#e2a931', '#3157e2', '#dc3545', '#51b24b', '#a94bb2', '#4b8bb2', '#57b24b', '#a5b24b', '#b2804b', '#b24b4b',
    '#834bb2', '#b24b6a', '#574bb2', '#236368', '#232c68', '#682345', '#4b2368', '#234b68', '#306823', '#a39f39',
    '#a239a3', '#a33963', '#a33951', '#a33939', '#c73737', '#6837c7'];
    @endphp

    <script>
        function number_format(number, decimals, dec_point, thousands_sep) {
                // *     example: number_format(1234.56, 2, ',', ' ');
                // *     return: '1 234,56'
                number = (number + '').replace(',', '').replace(' ', '');
                var n = !isFinite(+number) ? 0 : +number,
                    prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
                    sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
                    dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
                    s = '',
                    toFixedFix = function(n, prec) {
                        var k = Math.pow(10, prec);
                        return '' + Math.round(n * k) / k;
                    };
                // Fix for IE parseFloat(0.55).toFixed(0) = 0;
                s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
                if (s[0].length > 3) {
                    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
                }
                if ((s[1] || '').length < prec) {
                    s[1] = s[1] || '';
                    s[1] += new Array(prec - s[1].length + 1).join('0');
                }
                return s.join(dec);
            }
    </script>

    <script>
        // --------- credit chart ---------
            var ctx_recourse = document.getElementById("myChart-total-worker");
            var myPieChart2 = new Chart(ctx_recourse, {
                type: 'doughnut',
                data: {
                    labels: [
                        @foreach ($branch_worker as $item)
                            @if ($item->branch)
                                "{{ $item->branch->name }}",
                            @else
                                "All",
                            @endif
                        @endforeach
                    ],
                    datasets: [{
                        data: [
                            @foreach ($branch_worker as $item)
                                {{ $item->total . ',' }}
                            @endforeach
                        ],
                        @php
                            $i = 0;
                        @endphp
                        backgroundColor: [
                            @foreach ($branch_worker as $item)
                                '{{ $chart_color[$i] }}',
                                @php
                                    $i++;
                                @endphp
                            @endforeach
                        ],
                    }],
                },
                options: {
                    maintainAspectRatio: false,
                    tooltips: {
                        backgroundColor: "rgb(255,255,255)",
                        bodyFontColor: "#858796",
                        borderColor: '#dddfeb',
                        borderWidth: 1,
                        xPadding: 15,
                        yPadding: 15,
                        displayColors: false,
                        caretPadding: 10,
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.yLabel;
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: true
                        },
                        colorschemes: {
                            scheme: 'brewer.Paired12'
                        }
                    },
                    cutoutPercentage: 80,
                },
            });

            // --------- specialty income chart year ---------
            var ctx_recourse = document.getElementById("myChart-top-creator-appointment");
            var myPieChart2 = new Chart(ctx_recourse, {
                type: 'polarArea',
                data: {
                    labels: [
                        @foreach ($creator as $item)
                            "{{ $item->creator->name }}",
                        @endforeach
                    ],
                    datasets: [{
                        data: [
                            @foreach ($creator as $item)
                                {{ $item->total . ',' }}
                            @endforeach
                        ],
                        @php
                            $i = 0;
                        @endphp
                        backgroundColor: [
                            @foreach ($creator as $item)
                                '{{ $chart_color[$i] }}',
                                @php
                                    $i++;
                                @endphp
                            @endforeach
                        ],
                    }],
                },
                options: {
                    maintainAspectRatio: false,
                    tooltips: {
                        backgroundColor: "rgb(255,255,255)",
                        bodyFontColor: "#858796",
                        borderColor: '#dddfeb',
                        borderWidth: 1,
                        xPadding: 15,
                        yPadding: 15,
                        displayColors: false,
                        caretPadding: 10,
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.yLabel;
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: true
                        },
                        colorschemes: {
                            scheme: 'brewer.Paired12'
                        }
                    },
                    cutoutPercentage: 80,
                },
            });
            // --------- specialty income chart month ---------
            var ctx_recourse = document.getElementById("myChart-top-creator-appointment_month");
            var myPieChart2 = new Chart(ctx_recourse, {
                type: 'polarArea',
                data: {
                    labels: [
                        @foreach ($creator_month as $item)
                            "{{ $item->creator->name }}",
                        @endforeach
                    ],
                    datasets: [{
                        data: [
                            @foreach ($creator_month as $item)
                                {{ $item->total . ',' }}
                            @endforeach
                        ],
                        @php
                            $i = 0;
                        @endphp
                        backgroundColor: [
                            @foreach ($creator_month as $item)
                                '{{ $chart_color[$i] }}',
                                @php
                                    $i++;
                                @endphp
                            @endforeach
                        ],
                    }],
                },
                options: {
                    maintainAspectRatio: false,
                    tooltips: {
                        backgroundColor: "rgb(255,255,255)",
                        bodyFontColor: "#858796",
                        borderColor: '#dddfeb',
                        borderWidth: 1,
                        xPadding: 15,
                        yPadding: 15,
                        displayColors: false,
                        caretPadding: 10,
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.yLabel;
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: true
                        },
                        colorschemes: {
                            scheme: 'brewer.Paired12'
                        }
                    },
                    cutoutPercentage: 80,
                },
            });

            // --------- specialty income chart year ---------
            var ctx_recourse = document.getElementById("myChart-top-confirmation-appointment");
            var myPieChart2 = new Chart(ctx_recourse, {
                type: 'polarArea',
                data: {
                    labels: [
                        @foreach ($confirmation as $item)
                            "{{ $item->last_update_person->name }}",
                        @endforeach
                    ],
                    datasets: [{
                        data: [
                            @foreach ($confirmation as $item)
                                {{ $item->total . ',' }}
                            @endforeach
                        ],
                        @php
                            $i = 0;
                        @endphp
                        backgroundColor: [
                            @foreach ($confirmation as $item)
                                '{{ $chart_color[$i] }}',
                                @php
                                    $i++;
                                @endphp
                            @endforeach
                        ],
                    }],
                },
                options: {
                    maintainAspectRatio: false,
                    tooltips: {
                        backgroundColor: "rgb(255,255,255)",
                        bodyFontColor: "#858796",
                        borderColor: '#dddfeb',
                        borderWidth: 1,
                        xPadding: 15,
                        yPadding: 15,
                        displayColors: false,
                        caretPadding: 10,
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.yLabel;
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: true
                        },
                        colorschemes: {
                            scheme: 'brewer.Paired12'
                        }
                    },
                    cutoutPercentage: 80,
                },
            });
            // --------- specialty income chart month ---------
            var ctx_recourse = document.getElementById("myChart-top-confirmation-appointment_month");
            var myPieChart2 = new Chart(ctx_recourse, {
                type: 'polarArea',
                data: {
                    labels: [
                        @foreach ($confirmation_month as $item)
                            "{{ $item->last_update_person->name }}",
                        @endforeach
                    ],
                    datasets: [{
                        data: [
                            @foreach ($confirmation_month as $item)
                                {{ $item->total . ',' }}
                            @endforeach
                        ],
                        @php
                            $i = 0;
                        @endphp
                        backgroundColor: [
                            @foreach ($confirmation_month as $item)
                                '{{ $chart_color[$i] }}',
                                @php
                                    $i++;
                                @endphp
                            @endforeach
                        ],
                    }],
                },
                options: {
                    maintainAspectRatio: false,
                    tooltips: {
                        backgroundColor: "rgb(255,255,255)",
                        bodyFontColor: "#858796",
                        borderColor: '#dddfeb',
                        borderWidth: 1,
                        xPadding: 15,
                        yPadding: 15,
                        displayColors: false,
                        caretPadding: 10,
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.yLabel;
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: true
                        },
                        colorschemes: {
                            scheme: 'brewer.Paired12'
                        }
                    },
                    cutoutPercentage: 80,
                },
            });
            // --------- specialty expenses chart year ---------
            var ctx_recourse = document.getElementById("myChart-top-taking-appointment");
            var myPieChart2 = new Chart(ctx_recourse, {
                type: 'polarArea',
                data: {
                    labels: [
                        @foreach ($doctor as $item)
                            @if ($item->doctor)
                                "{{ $item->doctor->name }}"
                            @else
                                "No doctor"
                            @endif ,
                        @endforeach
                    ],
                    datasets: [{
                        data: [
                            @foreach ($doctor as $item)
                                {{ $item->total . ',' }}
                            @endforeach
                        ],
                        @php
                            $i = 0;
                        @endphp
                        backgroundColor: [
                            @foreach ($doctor as $item)
                                '{{ $chart_color[$i] }}',
                                @php
                                    $i++;
                                @endphp
                            @endforeach
                        ],
                    }],
                },
                options: {
                    maintainAspectRatio: false,
                    tooltips: {
                        backgroundColor: "rgb(255,255,255)",
                        bodyFontColor: "#858796",
                        borderColor: '#dddfeb',
                        borderWidth: 1,
                        xPadding: 15,
                        yPadding: 15,
                        displayColors: false,
                        caretPadding: 10,
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.yLabel;
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: true
                        },
                        colorschemes: {
                            scheme: 'brewer.Paired12'
                        }
                    },
                    cutoutPercentage: 80,
                },
            });

            // --------- specialty expenses chart month ---------
            var ctx_recourse = document.getElementById("myChart-top-taking-appointment_month");
            var myPieChart2 = new Chart(ctx_recourse, {
                type: 'polarArea',
                data: {
                    labels: [
                        @foreach ($doctor_month as $item)
                            @if ($item->doctor)
                                "{{ $item->doctor->name }}"
                            @else
                                "No doctor"
                            @endif ,
                        @endforeach
                    ],
                    datasets: [{
                        data: [
                            @foreach ($doctor_month as $item)
                                {{ $item->total . ',' }}
                            @endforeach
                        ],
                        @php
                            $i = 0;
                        @endphp
                        backgroundColor: [
                            @foreach ($doctor_month as $item)
                                '{{ $chart_color[$i] }}',
                                @php
                                    $i++;
                                @endphp
                            @endforeach
                        ],
                    }],
                },
                options: {
                    maintainAspectRatio: false,
                    tooltips: {
                        backgroundColor: "rgb(255,255,255)",
                        bodyFontColor: "#858796",
                        borderColor: '#dddfeb',
                        borderWidth: 1,
                        xPadding: 15,
                        yPadding: 15,
                        displayColors: false,
                        caretPadding: 10,
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.yLabel;
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: true
                        },
                        colorschemes: {
                            scheme: 'brewer.Paired12'
                        }
                    },
                    cutoutPercentage: 80,
                },
            });


            // --------- specialty expenses chart year ---------
            var ctx_recourse = document.getElementById("myChart-accountants");
            var myPieChart2 = new Chart(ctx_recourse, {
                type: 'polarArea',
                data: {
                    labels: [
                        @foreach ($accountant as $item)
                            "{{ $item->payment[0]->worker->name }}",
                        @endforeach
                    ],
                    datasets: [{
                        data: [
                            @foreach ($accountant as $item)
                                {{ $item->sums . ',' }}
                            @endforeach
                        ],
                        @php
                            $i = 0;
                        @endphp
                        backgroundColor: [
                            @foreach ($accountant as $item)
                                '{{ $chart_color[$i] }}',
                                @php
                                    $i++;
                                @endphp
                            @endforeach
                        ],
                    }],
                },
                options: {
                    maintainAspectRatio: false,
                    tooltips: {
                        backgroundColor: "rgb(255,255,255)",
                        bodyFontColor: "#858796",
                        borderColor: '#dddfeb',
                        borderWidth: 1,
                        xPadding: 15,
                        yPadding: 15,
                        displayColors: false,
                        caretPadding: 10,
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.yLabel;
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: true
                        },
                        colorschemes: {
                            scheme: 'brewer.Paired12'
                        }
                    },
                    cutoutPercentage: 80,
                },
            });

            // --------- specialty expenses chart month ---------
            var ctx_recourse = document.getElementById("myChart-accountants_month");
            var myPieChart2 = new Chart(ctx_recourse, {
                type: 'polarArea',
                data: {
                    labels: [
                        @foreach ($accountant_month as $item)
                            "{{ $item->payment[0]->worker->name }}",
                        @endforeach
                    ],
                    datasets: [{
                        data: [
                            @foreach ($accountant_month as $item)
                                {{ $item->sums . ',' }}
                            @endforeach
                        ],
                        @php
                            $i = 0;
                        @endphp
                        backgroundColor: [
                            @foreach ($accountant_month as $item)
                                '{{ $chart_color[$i] }}',
                                @php
                                    $i++;
                                @endphp
                            @endforeach
                        ],
                    }],
                },
                options: {
                    maintainAspectRatio: false,
                    tooltips: {
                        backgroundColor: "rgb(255,255,255)",
                        bodyFontColor: "#858796",
                        borderColor: '#dddfeb',
                        borderWidth: 1,
                        xPadding: 15,
                        yPadding: 15,
                        displayColors: false,
                        caretPadding: 10,
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.yLabel;
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: true
                        },
                        colorschemes: {
                            scheme: 'brewer.Paired12'
                        }
                    },
                    cutoutPercentage: 80,
                },
            });
    </script>
    @endsection