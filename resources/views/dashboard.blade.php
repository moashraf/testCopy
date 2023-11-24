@extends('layouts.master')

@section('title', 'Dashboard | Lam - School Management App')

@section('title-topbar', __('basic.dashboard'))

<!-- css insert -->
@section('css')


{{-- swiper --}}
<link rel="stylesheet" href="https://fastly.jsdelivr.net/npm/swiper/swiper-bundle.min.css" />

@endsection


<!-- content insert -->
@section('content')



{{-- install pwa --}}
<div id="install-app-btn-container" class="toaster_fixed_status" style="display: none">
    <div class="d-flex">
        <div class="icont_cont me-2"><i class="fas fa-arrow-down"></i></div>
        <div>
            <span class="fw-bold">Install Lam Web App</span>
            <p class=" text-blue-200 mb-0">Get the most out of Lam</p>

        </div>

    </div>

    <div id="install_pwa_btn" class="clickable-item-pointer">
        <div class="white-color-btn status-col-link rounded-pill p-2 px-3 clickable-item-pointer"
            style="width: fit-content;">
            Install
        </div>
    </div>


    <div
        class="d-flex align-items-center justify-content-center rounded-circle avatar-xxs cancel-color-btn clickable-item-pointer close_toaster_fixed">
        <i class="fas fa-times"></i>
    </div>

</div>

<!-- Begin Page Content -->
<div class="container-fluid px-2 mt-0 mt-md-5 pt-0 pt-md-4">

    <!-- welcome msg & note -->
    <div class="row mb-4">
        <div class="col-12 col-md-8 mb-4 mb-md-0">
            <div class="card shadow h-100">
                <!-- Card Body -->
                <div class="wlc-msg d-flex card-body h-100">

                    <div class="row flex-row-reverse justify-content-between align-items-center">

                        <div class="col-12 col-md-5">
                            <img class="img-fluid p-md-2" width="240"
                                src="{{ URL::asset('img/svg/undraw_reading_book_re_kqpk.svg') }}" alt="">
                        </div>

                        <div class="col-12 col-md-7 ps-4">
                            <h1 class="main-color fw-bold mt-1 lh-1">
                                {{ __('basic.hello') }}
                                <small class="fs-6 fw-bold text-gray-600 lh-1 text-capitalize">
                                    {{ Auth::user()->first_name . ' ' . Auth::user()->second_name }}</small>
                            </h1>
                            <p class="text-gray-400 mb-2">{{ __('basic.dashboard msg') }}</p>
                        </div>

                    </div>

                </div>

            </div>
        </div>

        <div class="col">
            <div class="card shadow notes-dashbaord h-100">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 fw-bold">{{ __('basic.note') }}</h6>
                    <div class="dropdown no-arrow">

                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                            aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Dropdown Header:</div>
                            <a class="dropdown-item" href="#">Action</a>
                        </div>
                    </div>
                </div>

                <!-- Card Body -->
                <div class="card-body d-flex align-items-center text-center h-100 justify-content-center position-relative"
                    id="note_add">
                    @if (!empty($user_note->note))
                    <textarea id="note_insert" name="note" style="height: 68px !important;"
                        class="form-control border-0" placeholder="Write here your notes .." rows="4"
                        spellcheck="false">{{ $user_note->note }}</textarea>
                    @else
                    <a class="add-new-note link-cust-text text-gray-400" href="#">
                        <i class="fas fa-plus-circle fa-sm fa-fw fs-4"></i>
                        <p class="fw-light mb-0">{{ __('basic.put your note') }}</p>
                    </a>
                    @endif

                </div>

            </div>
        </div>
    </div>


    <!-- overview analysis -->
    <div class="row">

        <!-- total doctors -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card shadow h-100 main-color-bg p-1 ">
                <div class="card-body p-2 px-5 px-md-4">
                    <div class="row no-gutters align-items-center">
                        <p class="text-center text-s fw-bold text-blue-200">{{ __('basic.total users') }}</p>

                        <div class="col me-2 p-0">
                            <div class="h1 mb-0 fw-bold text-white">{{ $patient_total }}</div>
                            <div class="text-xxs text-blue-300 text-uppercase">
                                {{ __('basic.users') }}</div>
                        </div>

                        <div class="col-auto p-0 text-white">
                            <i class="fas fa-users text-xl"></i>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!-- total income -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card shadow h-100 p-1 ">
                <div class="card-body p-2 px-5 px-md-4">
                    <div class="row no-gutters align-items-center">


                        <p class="text-center text-s fw-bold text-gray-400">{{ __('basic.total schools') }}</p>
                        <div class="col me-2 p-0">
                            <div class="h1 mb-0 fw-bold text-grat-800">
                                {{ $schools_total }}
                            </div>
                            <div class="text-xxs text-gray-400 text-uppercase">
                                {{ __('basic.schools') }}</div>
                        </div>
                        <div class="col-auto p-0 text-white">
                            <i class="fas fa-school px-3 px-md-2 fa-3x text-gray-400"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- total doctors -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card shadow h-100 p-1 ">
                <div class="card-body p-2 px-5 px-md-4">
                    <div class="row no-gutters align-items-center">
                        <p class="text-center text-s fw-bold text-gray-400">{{ __('basic.total students') }}</p>

                        <div class="col me-2 p-0">
                            <div class="h1 mb-0 fw-bold text-grat-800">{{ $students_total }}</div>
                            <div class="text-xxs text-gray-400 text-uppercase">
                                {{ __('basic.students') }}</div>
                        </div>

                        <div class="col-auto p-0 text-white">
                            <svg width="75px" height="75px" viewBox="0 0 48 48" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M24 13C26.4853 13 28.5 10.9853 28.5 8.5C28.5 6.01472 26.4853 4 24 4C21.5147 4 19.5 6.01472 19.5 8.5C19.5 10.9853 21.5147 13 24 13ZM37.9201 15.4404C38.2292 16.5008 37.6201 17.6111 36.5596 17.9201C34.1842 18.6124 32.0379 19.1337 30 19.4812V30.9944L30 31V42C30 43.0693 29.1589 43.9495 28.0906 43.998C27.0224 44.0464 26.105 43.246 26.0082 42.1811L25.0082 31.1811C25.0027 31.1206 25 31.0602 25 31H23C23 31.0602 22.9973 31.1206 22.9918 31.1811L21.9918 42.1811C21.895 43.246 20.9776 44.0464 19.9094 43.998C18.8412 43.9495 18 43.0693 18 42L18 19.4443C15.9674 19.0938 13.8288 18.583 11.4653 17.9272C10.4009 17.6319 9.7775 16.5296 10.0728 15.4653C10.3682 14.4009 11.4704 13.7775 12.5348 14.0728C17.1431 15.3515 20.6058 15.9845 24.0087 15.9997C27.4047 16.0149 30.8587 15.4152 35.4404 14.0799C36.5009 13.7708 37.6111 14.3799 37.9201 15.4404Z"
                                    fill="#9C9C9C" />
                            </svg>
                        </div>

                    </div>
                </div>
            </div>


        </div>

        <!-- total income -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card shadow h-100 p-1 ">
                <div class="card-body p-2 px-5 px-md-4">
                    <div class="row no-gutters align-items-center">
                        <p class="text-center text-s fw-bold text-gray-400">{{ __('basic.total teachers') }}</p>
                        <div class="col me-2 p-0">
                            <div class="h1 mb-0 fw-bold text-grat-800">
                                {{ $teachers_total }}
                            </div>
                            <div class="text-xxs text-gray-400 text-uppercase">
                                {{ __('basic.teachers') }}</div>
                        </div>
                        <div class="col-auto p-0 text-white">
                            <i class="fas fa-chalkboard-teacher px-3 px-md-2 fa-3x text-gray-400"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- today's appointments -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 fw-bold">{{ __('basic.patients overview') }}</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                            aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Dropdown Header:</div>
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </div>
                </div>

                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area pb-4">
                        <div class="">

                            <canvas id="patient_overview" class="profit_expense">
                                <!-- the code and its style is printed from js -->

                            </canvas>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- last patients -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 fw-bold">{{ __('basic.last patients') }}</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                            aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Dropdown Header:</div>
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body pb-0">

                    @foreach ($last_patient as $item)
                    <a class="d-flex mb-3 align-items-center" href="{{ route('sett.managers.show', $item->id) }}">
                        <img class="rounded-circle avatar-small me-2"
                            src="{{ URL::asset('img/useravatar/' . $item->avatar) }}">
                        <div class=" ">
                            <h6 class="mb-1 text-s fw-bold text-gray-700">{{ $item->full_name }}</h6>
                            <p class="mb-0 text-xs text-gray-300">{{ $item->created_at }}</p>
                        </div>
                    </a>
                    @endforeach

                </div>

                <!-- Card footer -->
                <div class="card-footer text-center ">
                    <a href="{{ route('sett.pat_show_all_patients') }}"
                        class="text-xs link-cust-text text-gray-300 clickable-item-pointer">
                        <i class="fas fa-chevron-down"></i> {{ __('basic.more') }}
                    </a>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection

<!-- js insert -->
@section('js')

<script src="https://fastly.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>

<script>
    var swiper = new Swiper(".swiper_more_features", {
        spaceBetween: 0,
        grabCursor: true,
        touchEventsTarget: 'container',
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
            dynamicBullets: true,
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        breakpoints: {
            300: {
                slidesPerView: 1,
                spaceBetween: 30,
            },
            500: {
                slidesPerView: 2,
                spaceBetween: 20,
            },
            640: {
                slidesPerView: 3,
                spaceBetween: 40,
            },
            750: {
                slidesPerView: 3,
                spaceBetween: 20,
            },
            1024: {
                slidesPerView: 6,
                spaceBetween: 15,
            },
            1440: {
                slidesPerView: 6,
                spaceBetween: 20,
            },
            2500: {
                slidesPerView: 8,
                spaceBetween: 20,
            }
        },

    });
</script>

<!-- -- Chart.js plugin -- -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.6.0/chart.min.js"
    integrity="sha512-GMGzUEevhWh8Tc/njS0bDpwgxdCJLQBWG3Z2Ct+JGOpVnEmjvNx6ts4v6A2XJf1HOrtOsfhv3hBKpK9kE5z8AQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

@php
$chart_color = ['#323ac8', '#38dfa8','#1a78f1', '#d13c62', '#12c7d9', '#03c2c3', '#5035df', '#17a673', '#2e59d9',
'#9aeded',
'#f3d56a', '#7c859d', '#a4adc5', '#80142f', '#33d293', '#bed233', '#3958e9', '#10c86f', '#654fb6', '#a44fb6', '#89728e',
'#c85110', '#6d769d', '#1b6954', '#204494', '#94206b', '#948320', '#209493', '#292094', '#203a65', '#4e6fa5', '#e29031',
'#e23168', '#31e0e2', '#e29131', '#319fe2', '#8131e2', '#31a8e2', '#31e2c0', '#31c3e2', '#e2a931', '#3157e2', '#dc3545',
'#51b24b', '#a94bb2', '#4b8bb2', '#57b24b', '#a5b24b', '#b2804b', '#b24b4b', '#834bb2', '#b24b6a', '#574bb2', '#236368',
'#232c68', '#682345', '#4b2368', '#234b68', '#306823', '#a39f39', '#a239a3', '#a33963', '#a33951', '#a33939', '#c73737',
'#6837c7'];
@endphp

<script>
    // Patient overview
        var ctx = document.getElementById("patient_overview");
        var myLineChart_patient = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                datasets: [{
                    label: "{{ __('basic.patients') }}",
                    lineTension: 0.5,
                    backgroundColor: "#1a78f1",
                    borderColor: "#1a78f1",
                    pointRadius: 3,
                    pointBackgroundColor: "#1a78f1",
                    pointBorderColor: "#1a78f1",
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
                            color: "#dc3545",
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
                    bodyFontColor: "#dc3545",
                    titleMarginBottom: 10,
                    titleFontColor: '#dc3545',
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
    $(document).ready(function() {

            $(document).on('click', '.add-new-note', function() {

                $('#note_add').html(
                    '<textarea id="note_insert" name="note" style="height: 68px !important;" class="form-control border-0" placeholder="Write here your notes .." rows="4" spellcheck="false"></textarea>'
                );
            })

            $(document).on('keyup', '#note_insert', function() {
                console.log('asdasd');

                var query_text = $(this).val();

                $.ajax({
                    url: '{{ route('sett.ad_note_ajax') }}',
                    type: "POST",
                    data: {
                        '_token': "{{ csrf_token() }}",
                        '_method': "PATCH",
                        'query': query_text,
                    },
                    success: function(data) {}
                });
            })

        })
</script>




{{-- PWA Application --}}

<script>
    let installPrompt = null;
    const install_pwa_btn = document.querySelector("#install_pwa_btn");
    let deferredPrompt;

    window.addEventListener("beforeinstallprompt", (event) => {
        event.preventDefault();
        installPrompt = event;
        install_pwa_btn.removeAttribute("hidden");

        $('#install-app-btn-container').show();

        // for install
        deferredPrompt = event;
    });

    install_pwa_btn.addEventListener('click', async () => {
        if (deferredPrompt !== null) {
            deferredPrompt.prompt();
            const { outcome } = await deferredPrompt.userChoice;
            if (outcome === 'accepted') {
                deferredPrompt = null;
            }
        }
    });
</script>

@endsection