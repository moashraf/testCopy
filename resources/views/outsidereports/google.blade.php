@extends('layouts.master')

@section('title', 'Google | Lam - School Management App')

@section('title-topbar', 'Google')

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
            <a class="text-gray-300">Google Reports</a>
        </span>


    </div>



    <div class="row">

        <div class="col-12">
            <div class="card card-input shadow mb-3 pb-3">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 fw-bold text-gray-500"><i class="fab fa-google me-1"></i> Google Analytics</h6>
                </div>

                <!-- Card Body -->
                <div class="card-body">


                    <div class="row mb-1 justify-content-center">

                        <div class="col-12 col-md-6 border-flex mb-3">
                            <h5 class="text-center text-gray-300">Most Visited</h5>

                            <div class="chart-pie px-1">
                                <canvas id="most_visited">
                                    <!-- the code and its style is printed from js -->

                                </canvas>
                            </div>

                        </div>

                        <div class="col-12 col-md-6">
                            <h5 class="text-center text-gray-300">Top Referrers</h5>
                            <div class="chart-pie px-1">

                                <canvas id="top_referrers">
                                    <!-- the code and its style is printed from js -->

                                </canvas>
                            </div>

                        </div>

                    </div>



                    <div class="row mb-1 justify-content-center">

                        <div class="col-12 col-md-6 border-flex mb-3">
                            <h5 class="text-center text-gray-300">User Type</h5>

                            <div class="chart-pie px-1">
                                <canvas id="user_type">
                                    <!-- the code and its style is printed from js -->

                                </canvas>
                            </div>

                        </div>

                        <div class="col-12 col-md-6">
                            <h5 class="text-center text-gray-300">Top Browsers</h5>
                            <div class="chart-pie px-1">

                                <canvas id="top_browsers">
                                    <!-- the code and its style is printed from js -->

                                </canvas>
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
    '#e2a931', '#3157e2'];
    @endphp


    <script>
        // --------- most visited chart ---------
            var ctx_recourse = document.getElementById("most_visited");
            var myPieChart2 = new Chart(ctx_recourse, {
                type: 'doughnut',
                data: {
                    labels: [
                        @foreach ($most_visited as $item)
                            "{{ $item['pageTitle'] }}",
                        @endforeach
                    ],
                    datasets: [{
                        data: [
                            @foreach ($most_visited as $item)
                                {{ $item['pageViews'] . ',' }}
                            @endforeach
                        ],
                        @php
                            $i = 0;
                        @endphp
                        backgroundColor: [
                            @foreach ($most_visited as $item)
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

            // --------- top visited chart ---------
            var ctx_recourse = document.getElementById("top_referrers");
            var myPieChart2 = new Chart(ctx_recourse, {
                type: 'doughnut',
                data: {
                    labels: [
                        @foreach ($top_referrers as $item)
                            "{{ $item['url'] }}",
                        @endforeach
                    ],
                    datasets: [{
                        data: [
                            @foreach ($top_referrers as $item)
                                {{ $item['pageViews'] . ',' }}
                            @endforeach
                        ],
                        @php
                            $i = 0;
                        @endphp
                        backgroundColor: [
                            @foreach ($top_referrers as $item)
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


            // --------- user type chart ---------
            var ctx_recourse = document.getElementById("user_type");
            var myPieChart2 = new Chart(ctx_recourse, {
                type: 'doughnut',
                data: {
                    labels: [
                        @foreach ($user_type as $item)
                            "{{ $item['type'] }}",
                        @endforeach
                    ],
                    datasets: [{
                        data: [
                            @foreach ($user_type as $item)
                                {{ $item['sessions'] . ',' }}
                            @endforeach
                        ],
                        @php
                            $i = 0;
                        @endphp
                        backgroundColor: [
                            @foreach ($user_type as $item)
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


            // --------- top visited chart ---------
            var ctx_recourse = document.getElementById("top_browsers");
            var myPieChart2 = new Chart(ctx_recourse, {
                type: 'doughnut',
                data: {
                    labels: [
                        @foreach ($top_browsers as $item)
                            "{{ $item['browser'] }}",
                        @endforeach
                    ],
                    datasets: [{
                        data: [
                            @foreach ($top_browsers as $item)
                                {{ $item['sessions'] . ',' }}
                            @endforeach
                        ],
                        @php
                            $i = 0;
                        @endphp
                        backgroundColor: [
                            @foreach ($top_browsers as $item)
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