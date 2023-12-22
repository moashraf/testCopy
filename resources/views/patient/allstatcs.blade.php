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

        <span class="mb-0 me-1">
            <a class="link-cust-text text-gray-200 fw-light" href="{{ route('sett.home') }}">{{ __('basic.dashboard') }}
                |</a>
            <a class="link-cust-text text-gray-200 fw-light" href="{{ route('sett.managers.index') }}">{{
                __('basic.patients') }} | </a>
            <a class="text-gray-300">{{ __('patientappo.patients statistics') }}</a>
        </span>

        <div class="d-flex justify-content-center mt-2 mt-md-0">

            <a class="main-color-bg text-white btn btn-sm shadow-sm b-r-l-cont p-2 px-4 me-1" data-bs-toggle="modal"
                data-bs-target="#new_record"><i class="fas fa-filter fa-sm me-1"></i> Filter</a>

            <!-- Modal for search filtering -->
            <div class="modal fade" id="new_record" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">

                    <form class="mb-0" action="{{ route('sett.pat_allstatcs') }}" method="GET"
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

    <div class="row">

        <div class="col-12">
            <div class="card card-input shadow mb-3 pb-3">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 fw-bold text-gray-500"><i class="fas fa-chart-bar me-1"></i>
                        {{ __('patientappo.patients statistics') }}</h6>
                </div>

                <!-- Card Body -->
                <div class="card-body">

                    <ul class="nav nav-tabs mb-5" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="patient-tab" data-bs-toggle="tab"
                                data-bs-target="#patient" type="button" role="tab" aria-controls="patient"
                                aria-selected="true" class="text-gray-500"><i class="fas fa-user me-1"></i>
                                {{ __('patientappo.total patients') }}</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="branches-tab" data-bs-toggle="tab" data-bs-target="#branches"
                                type="button" role="tab" aria-controls="branches" aria-selected="false"
                                class="main-color"><i class="fas fa-globe-americas me-1"></i>
                                {{ __('basic.branches') }}</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="home-tab" data-bs-toggle="tab" data-bs-target="#home"
                                type="button" role="tab" aria-controls="home" aria-selected="true"
                                class="text-gray-500"><i class="fas fa-user me-1"></i>
                                {{ __('patientappo.gender resource') }}</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="country-tab" data-bs-toggle="tab" data-bs-target="#country"
                                type="button" role="tab" aria-controls="country" aria-selected="false"
                                class="main-color"><i class="fas fa-globe-americas me-1"></i>
                                {{ __('patientappo.country city') }}</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="examinations-tab" data-bs-toggle="tab"
                                data-bs-target="#examinations-treatment" type="button" role="tab"
                                aria-controls="examinations-treatment" aria-selected="false" class="main-color"><i
                                    class="fas fa-suitcase-rolling me-1"></i>
                                {{ __('basic.other statistics') }}</button>
                        </li>
                    </ul>

                    <div class="tab-content" id="myTabContent">


                        <div class="tab-pane fade show active" id="patient" role="tabpanel" aria-labelledby="patient">

                            <div class="row mb-1 justify-content-center">

                                <div class="col-12 mb-5">
                                    <div>
                                        <div class="text-center small">
                                            <span class="me-2">
                                                <i class="fas fa-circle text-success"></i> {{ __('basic.patients') }}
                                            </span>
                                        </div>


                                        <canvas id="myChart_world">
                                            <!-- the code and its style is printed from js -->

                                        </canvas>

                                        <canvas id="myChart-patient">
                                            <!-- the code and its style is printed from js -->

                                        </canvas>
                                    </div>
                                </div>

                                <div class="col-12 my-2 text-center">
                                    <div class="row">
                                        <div class="col-12 col-md-6 border-flex mb-3">
                                            <h5 class="text-center text-gray-300">
                                                Patient Per Branch @if ($from !== 'all')
                                                in the given date
                                                @endif
                                            </h5>
                                            <div class="chart-pie px-1 pb-3">
                                                <canvas id="each_branch">
                                                    <!-- the code and its style is printed from js -->
                                                </canvas>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 align-self-center">
                                            <h6 class="text-gray-400">Total Patient @if ($from !== 'all')
                                                in the given date
                                                @endif
                                            </h6>
                                            <span class="fs-1">{{ $patient_total }}<small
                                                    class="text-gray-300 text-xxxs">
                                                    {{ __('basic.patients') }}</small></span>
                                        </div>
                                    </div>


                                </div>

                            </div>

                        </div>


                        <div class="tab-pane fade" id="branches" role="tabpanel" aria-labelledby="branches-tab">

                            <div class="row mb-2">

                                <div class="col-12 mb-5">
                                    <div>
                                        <canvas id="branches_line">
                                            <!-- the code and its style is printed from js -->
                                        </canvas>
                                    </div>
                                </div>

                            </div>
                        </div>


                        <div class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="home-tab">

                            <div class="row">
                                <div class="col-12 col-md-6 border-flex mb-3">
                                    <h5 class="text-center text-gray-300">{{ __('patientappo.patient by gender') }}
                                        @if ($from !== 'all')
                                        in the given date
                                        @endif
                                    </h5>
                                    <div class="chart-pie px-1 pb-3">
                                        <canvas id="myChart">
                                            <!-- the code and its style is printed from js -->
                                        </canvas>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <h5 class="text-center text-gray-300">{{ __('patientappo.patient by resource') }}
                                        @if ($from !== 'all')
                                        in the given date
                                        @endif
                                    </h5>
                                    <div class="chart-pie px-1">
                                        <canvas id="myChart-resource">
                                            <!-- the code and its style is printed from js -->
                                        </canvas>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="tab-pane fade" id="country" role="tabpanel" aria-labelledby="country-tab">

                            <div class="row">
                                <div class="col-12 col-md-6 border-flex mb-3">
                                    <h5 class="text-center text-gray-300">{{ __('patientappo.patient by country') }}
                                        @if ($from !== 'all')
                                        in the given date
                                        @endif
                                    </h5>
                                    <div class="chart-pie px-1 pb-3">
                                        <canvas id="myChart-country">
                                            <!-- the code and its style is printed from js -->
                                        </canvas>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <h5 class="text-center text-gray-300">{{ __('patientappo.patient by city') }}
                                        @if ($from !== 'all')
                                        in the given date
                                        @endif
                                    </h5>
                                    <div class="chart-pie px-1">
                                        <canvas id="myChart-city">
                                            <!-- the code and its style is printed from js -->
                                        </canvas>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <h5 class="text-center text-gray-300">{{ __('basic.traveler by region') }}
                                        @if ($from !== 'all')
                                        in the given date
                                        @endif
                                    </h5>
                                    <div class="chart-pie px-1">
                                        <canvas id="myChart-region">
                                            <!-- the code and its style is printed from js -->
                                        </canvas>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="tab-pane fade" id="examinations-treatment" role="tabpanel"
                            aria-labelledby="examinations-tab">

                            <div class="row">
                                <div class="col-12 col-md-6 border-flex mb-3">
                                    <h5 class="text-center text-gray-300">{{ __('basic.most religions') }} @if ($from
                                        !==
                                        'all')
                                        in the given date
                                        @endif
                                    </h5>
                                    <div class="chart-pie px-1 pb-3">
                                        <canvas id="myChart-examination">
                                            <!-- the code and its style is printed from js -->
                                        </canvas>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <h5 class="text-center text-gray-300">{{ __('basic.most traveler catagory') }}
                                        @if($from !== 'all')
                                        in the given date
                                        @endif
                                    </h5>
                                    <div class="chart-pie px-1">
                                        <canvas id="myChart-treatment">
                                            <!-- the code and its style is printed from js -->
                                        </canvas>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 border-flex mb-3">
                                    <h5 class="text-center text-gray-300">{{ __('basic.most traveler classes') }}
                                        @if($from !== 'all')
                                        in the given date
                                        @endif
                                    </h5>
                                    <div class="chart-pie px-1 pb-3">
                                        <canvas id="myChart-medicine">
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
                });
            });
    </script>

    <!-- -- Chart.js plugin -- -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.6.0/chart.min.js"
        integrity="sha512-GMGzUEevhWh8Tc/njS0bDpwgxdCJLQBWG3Z2Ct+JGOpVnEmjvNx6ts4v6A2XJf1HOrtOsfhv3hBKpK9kE5z8AQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script type="text/javascript" src="https://unpkg.com/chartjs-chart-geo@3.5.2/build/index.umd.min.js"></script>

    <script>
        const url = "https://unpkg.com/world-atlas@2.0.2/countries-50m.json";
        // topojson = lines or arcs lines combines = a county
        // geojson = fixed shape of country;


        
        fetch(url).then((result) => result.json()).then((datapoint) => {
            const countries = ChartGeo.topojson.feature(datapoint, datapoint.objects.countries).features;


            // console.log(countries[0].properties.name);
            console.log(countries.map(country => country.properties.name));
            
            // setup 
            const data = {
                labels: countries.map(country => country.properties.name),
                datasets: [{
                    label: 'Countries',
                    data: countries.map(country => ({feature: country, value: Math.random() })),
                  
                }]
            };

            console.log(countries.map(country => ({feature: country, value: Math.random() })));

             // config 
            const config = {
                type: 'choropleth',
                data,
                options: {
                    // showOutline: true,
                    // showGraticule: true,
                    scales: {
                            xy: {
                                projection: 'equalEarth',
                            }
                    },
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                },
            };

            // render init block
            const myChart = new Chart(
                document.getElementById('myChart_world'),
                config
            );

            // Instantly assign Chart.js version
            const chartVersion = document.getElementById('chartVersion');
            chartVersion.innerText = Chart.version;
                
        })
    </script>



    @php
    $chart_color = ['#323ac8', '#38dfa8','#1a78f1', '#d13c62', '#12c7d9', '#03c2c3', '#5035df', '#17a673', '#2e59d9',
    '#9aeded',
    '#f3d56a', '#7c859d', '#a4adc5', '#80142f', '#33d293', '#bed233', '#3958e9', '#10c86f', '#654fb6', '#a44fb6',
    '#89728e', '#c85110', '#6d769d', '#1b6954', '#204494', '#94206b', '#948320', '#209493', '#292094', '#203a65',
    '#4e6fa5', '#e29031', '#e23168', '#31e0e2', '#e29131', '#319fe2', '#8131e2', '#31a8e2', '#31e2c0', '#31c3e2',
    '#e2a931', '#3157e2'];
    @endphp
    <script>
        const actions = [{
                    name: 'Randomize',
                    handler(chart) {
                        chart.data.datasets.forEach(dataset => {
                            dataset.data = Utils.numbers({
                                count: chart.data.labels.length,
                                min: -100,
                                max: 100
                            });
                        });
                        chart.update();
                    }
                },
                {
                    name: 'Add Dataset',
                    handler(chart) {
                        const data = chart.data;
                        const dsColor = Utils.namedColor(chart.data.datasets.length);
                        const newDataset = {
                            label: 'Dataset ' + (data.datasets.length + 1),
                            backgroundColor: Utils.transparentize(dsColor, 0.5),
                            borderColor: dsColor,
                            data: Utils.numbers({
                                count: data.labels.length,
                                min: -100,
                                max: 100
                            }),
                        };
                        chart.data.datasets.push(newDataset);
                        chart.update();
                    }
                },
                {
                    name: 'Add Data',
                    handler(chart) {
                        const data = chart.data;
                        if (data.datasets.length > 0) {
                            data.labels = Utils.months({
                                count: data.labels.length + 1
                            });

                            for (let index = 0; index < data.datasets.length; ++index) {
                                data.datasets[index].data.push(Utils.rand(-100, 100));
                            }

                            chart.update();
                        }
                    }
                },
                {
                    name: 'Remove Dataset',
                    handler(chart) {
                        chart.data.datasets.pop();
                        chart.update();
                    }
                },
                {
                    name: 'Remove Data',
                    handler(chart) {
                        chart.data.labels.splice(-1, 1); // remove the label first

                        chart.data.datasets.forEach(dataset => {
                            dataset.data.pop();
                        });

                        chart.update();
                    }
                }
            ];
    </script>



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

            // Area Chart Example
            var ctx = document.getElementById("myChart-patient");
            var myLineChart_patient = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                    datasets: [{
                        label: "Patient",
                        lineTension: 0.5,
                        backgroundColor: "#1cc88a",
                        borderColor: "#1cc88a",
                        pointRadius: 3,
                        pointBackgroundColor: "#1cc88a",
                        pointBorderColor: "#1cc88a",
                        pointHoverRadius: 3,
                        pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                        pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                        pointHitRadius: 10,
                        pointBorderWidth: 2,
                        data: [
                            @foreach ($patient_date as $item)
                                {{ $item . ',' }}
                            @endforeach
                        ],
                    }, ],
                },

                options: {
                    maintainAspectRatio: true,
                    layout: {
                        padding: {
                            left: 10,
                            right: 25,
                            top: 25,
                            bottom: 0
                        }
                    },
                    scales: {
                        xAxes: [{
                            time: {
                                unit: 'date'
                            },
                            gridLines: {
                                display: false,
                                drawBorder: false
                            },
                            ticks: {
                                maxTicksLimit: 7
                            }
                        }],
                        yAxes: [{
                            ticks: {
                                maxTicksLimit: 5,
                                padding: 10,
                                // Include a dollar sign in the ticks
                                callback: function(value, index, values) {
                                    return '$' + number_format(value);
                                }
                            },
                            gridLines: {
                                color: "rgb(234, 236, 244)",
                                zeroLineColor: "rgb(234, 236, 244)",
                                drawBorder: false,
                                borderDash: [2],
                                zeroLineBorderDash: [2]
                            }
                        }],
                    },
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    tooltips: {
                        backgroundColor: "rgb(255,255,255)",
                        bodyFontColor: "#858796",
                        titleMarginBottom: 10,
                        titleFontColor: '#6e707e',
                        titleFontSize: 14,
                        borderColor: '#dddfeb',
                        borderWidth: 1,
                        xPadding: 15,
                        yPadding: 15,
                        displayColors: false,
                        intersect: false,
                        mode: 'index',
                        caretPadding: 10,
                        callbacks: {
                            label: function(tooltipItem, chart) {
                                var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                                return datasetLabel + ': $' + number_format(tooltipItem.yLabel);
                            }
                        }
                    }
                }
            });


            // Area Chart for each branch
            var ctx = document.getElementById("branches_line");
            var myLineChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                    datasets: [
                        @php
                            $i = 0;
                        @endphp
                        @foreach ($patient_branches as $item)
                            {
                                label: "{{ $item->name }}",
                                lineTension: 0.5,
                                backgroundColor: '{{ $chart_color[$i] }}',
                                borderColor: '{{ $chart_color[$i] }}',
                                pointRadius: 3,
                                pointBackgroundColor: '{{ $chart_color[$i] }}',
                                pointBorderColor: '{{ $chart_color[$i] }}',
                                @php
                                    $i++;
                                @endphp
                                pointHoverRadius: 3,
                                pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                                pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                                pointHitRadius: 10,
                                pointBorderWidth: 2,
                                data: [
                                    @foreach ($item->total as $item4)
                                        {{ $item4 . ',' }}
                                    @endforeach
                                ],
                            },
                        @endforeach

                    ],
                },

                options: {
                    maintainAspectRatio: true,
                    layout: {
                        padding: {
                            left: 10,
                            right: 25,
                            top: 25,
                            bottom: 0
                        }
                    },
                    scales: {
                        xAxes: [{
                            time: {
                                unit: 'date'
                            },
                            gridLines: {
                                display: false,
                                drawBorder: false
                            },
                            ticks: {
                                maxTicksLimit: 7
                            }
                        }],
                        yAxes: [{
                            ticks: {
                                maxTicksLimit: 5,
                                padding: 10,
                                // Include a dollar sign in the ticks
                                callback: function(value, index, values) {
                                    return '$' + number_format(value);
                                }
                            },
                            gridLines: {
                                color: "rgb(234, 236, 244)",
                                zeroLineColor: "rgb(234, 236, 244)",
                                drawBorder: false,
                                borderDash: [2],
                                zeroLineBorderDash: [2]
                            }
                        }],
                    },
                    plugins: {
                        legend: {
                            display: true
                        }
                    },
                    tooltips: {
                        backgroundColor: "rgb(255,255,255)",
                        bodyFontColor: "#858796",
                        titleMarginBottom: 10,
                        titleFontColor: '#6e707e',
                        titleFontSize: 14,
                        borderColor: '#dddfeb',
                        borderWidth: 1,
                        xPadding: 15,
                        yPadding: 15,
                        displayColors: false,
                        intersect: false,
                        mode: 'index',
                        caretPadding: 10,
                        callbacks: {
                            label: function(tooltipItem, chart) {
                                var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                                return datasetLabel + ': $' + number_format(tooltipItem.yLabel);
                            }
                        }
                    }
                }
            });
    </script>

    <script>
        // Pie Chart Example
            var ctx = document.getElementById("myChart");
            var myPieChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: [
                        @foreach ($gendar as $item)
                            "{{ $item->gendar }}",
                        @endforeach
                    ],
                    datasets: [{
                        data: [
                            @foreach ($gendar as $item)
                                {{ $item->total . ',' }}
                            @endforeach
                        ],
                        backgroundColor: ['#1cc88a', '#4e73df'],
                        hoverBackgroundColor: ['#17a673', '#2e59d9'],
                        hoverBorderColor: "rgba(234, 236, 244, 1)",
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
                        }
                    },
                    cutoutPercentage: 80,
                },
            });


            // --------- resource chart ---------
            var ctx_recourse = document.getElementById("each_branch");
            var myPieChart2 = new Chart(ctx_recourse, {
                type: 'doughnut',
                data: {
                    labels: [
                        @foreach ($each_branches as $item)
                            "{{ $item->branch->name }}",
                        @endforeach
                    ],
                    datasets: [{
                        data: [
                            @foreach ($each_branches as $item)
                                {{ $item->total . ',' }}
                            @endforeach
                        ],
                        @php
                            $i = 0;
                        @endphp
                        backgroundColor: [
                            @foreach ($each_branches as $item)
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

            // --------- resource chart ---------
            var ctx_recourse = document.getElementById("myChart-resource");
            var myPieChart2 = new Chart(ctx_recourse, {
                type: 'doughnut',
                data: {
                    labels: [
                        @foreach ($resource as $item)
                            "{{ $item->recourse->name }}",
                        @endforeach
                    ],
                    datasets: [{
                        data: [
                            @foreach ($resource as $item)
                                {{ $item->total . ',' }}
                            @endforeach
                        ],
                        @php
                            $i = 0;
                        @endphp
                        backgroundColor: [
                            @foreach ($resource as $item)
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

            // --------- country chart ---------
            var ctx_recourse = document.getElementById("myChart-country");
            var myPieChart2 = new Chart(ctx_recourse, {
                type: 'doughnut',
                data: {
                    labels: [
                        @foreach ($country as $item)
                            "{{ $item->country->name }}",
                        @endforeach
                    ],
                    datasets: [{
                        data: [
                            @foreach ($country as $item)
                                {{ $item->total . ',' }}
                            @endforeach
                        ],
                        @php
                            $i = 0;
                        @endphp
                        backgroundColor: [
                            @foreach ($country as $item)
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


            // --------- city chart ---------
            var ctx_recourse = document.getElementById("myChart-city");
            var myPieChart2 = new Chart(ctx_recourse, {
                type: 'doughnut',
                data: {
                    labels: [
                        @foreach ($city as $item)
                            "{{ $item->city->name }}",
                        @endforeach
                    ],
                    datasets: [{
                        data: [
                            @foreach ($city as $item)
                                {{ $item->total . ',' }}
                            @endforeach
                        ],
                        @php
                            $i = 0;
                        @endphp
                        backgroundColor: [
                            @foreach ($city as $item)
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


            // --------- religion chart ---------
            var ctx_recourse = document.getElementById("myChart-region");
            var myPieChart2 = new Chart(ctx_recourse, {
                type: 'doughnut',
                data: {
                    labels: [
                        @foreach ($region as $item)
                        @if($item->region)
                            "{{ $item->region->name }}",
                        @else
                        "{{ __('basic.not found') }}",
                        @endif
                        @endforeach
                    ],
                    datasets: [{
                        data: [
                            @foreach ($region as $item)
                                {{ $item->total . ',' }}
                            @endforeach
                        ],
                        @php
                            $i = 0;
                        @endphp
                        backgroundColor: [
                            @foreach ($region as $item)
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

            // --------- exmaintion chart ---------
            var ctx_recourse = document.getElementById("myChart-examination");
            var myPieChart2 = new Chart(ctx_recourse, {
                type: 'doughnut',
                data: {
                    labels: [
                        @foreach ($relgion as $item)
                        @if($item->religion == 1)
                        @php 
                        $relgion_name = "Muslim";
                        @endphp
                        @elseif($item->religion == 2)
                        @php 
                        $relgion_name = "christine";
                        @endphp
                        @elseif($item->religion == 3)
                        @php 
                        $relgion_name = "not selected";
                        @endphp
                        @endif
                        "{{ $relgion_name }}",
                        @endforeach
                    ],
                    datasets: [{
                        data: [
                            @foreach ($relgion as $item)
                                {{ $item->total . ',' }}
                            @endforeach
                        ],
                        @php
                            $i = 0;
                        @endphp
                        backgroundColor: [
                            @foreach ($relgion as $item)
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

            // --------- city chart ---------
            var ctx_recourse = document.getElementById("myChart-treatment");
            var myPieChart2 = new Chart(ctx_recourse, {
                type: 'doughnut',
                data: {
                    labels: [
                        @foreach ($traveler_cat as $item)
                        @if($item->traveler_cat == 1)
                        @php 
                        $traveler_cat_name = "Not selected";
                        @endphp
                        @elseif($item->traveler_cat == 2)
                        @php 
                        $traveler_cat_name = "Outgoing";
                        @endphp
                        @elseif($item->traveler_cat == 3)
                        @php 
                        $traveler_cat_name = "Domestic";
                        @endphp
                        @elseif($item->traveler_cat == 4)
                        @php 
                        $traveler_cat_name = "incoming";
                        @endphp
                        @elseif($item->traveler_cat == 5)
                        @php 
                        $traveler_cat_name = "religious";
                        @endphp
                        @endif
                        "{{ $traveler_cat_name }}",
                        @endforeach
                    ],
                    datasets: [{
                        data: [
                            @foreach ($traveler_cat as $item)
                                {{ $item->total . ',' }}
                            @endforeach
                        ],
                        @php
                            $i = 0;
                        @endphp
                        backgroundColor: [
                            @foreach ($traveler_cat as $item)
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

            // --------- med chart ---------
            var ctx_recourse = document.getElementById("myChart-medicine");
            var myPieChart2 = new Chart(ctx_recourse, {
                type: 'doughnut',
                data: {
                    labels: [
                        @foreach ($traveler_class as $item)
                        @if($item->traveler_class == 1)
                        @php 
                        $traveler_class_name = "Vip";
                        @endphp
                        @elseif($item->traveler_class == 2)
                        @php 
                        $traveler_class_name = "5 Stars";
                        @endphp
                        @elseif($item->traveler_class == 3)
                        @php 
                        $traveler_class_name = "4 Stars";
                        @endphp
                        @elseif($item->traveler_class == 4)
                        @php 
                        $traveler_class_name = "3 Stars";
                        @endphp
                        @elseif($item->traveler_class == 5)
                        @php 
                        $traveler_class_name = "2 Stars";
                        @endphp
                        @elseif($item->traveler_class == 6)
                        @php 
                        $traveler_class_name = "1 Stars";
                        @endphp
                        @endif
                        "{{ $traveler_class_name }}",
                        @endforeach
                    ],
                    datasets: [{
                        data: [
                            @foreach ($traveler_class as $item)
                                {{ $item->total . ',' }}
                            @endforeach
                        ],
                        @php
                            $i = 0;
                        @endphp
                        backgroundColor: [
                            @foreach ($traveler_class as $item)
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