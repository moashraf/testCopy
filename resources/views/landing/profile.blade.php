@extends('layouts.land.master_top')

@section('title', 'My medical Profile - Pain Cure | Dr. Amr Saeed')

<!-- css insert -->
@section('css')

    <!-- tables -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.2/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/autofill/2.3.9/css/autoFill.bootstrap5.min.css">

@endsection

<!-- content insert -->
@section('content')


    <div class="bradcam_area breadcam_bg bradcam_overlay"
        style="background-image: url('{{ asset('img/dashboard/system/landing/bradcam.jpg') }}')">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="text-white">
                        <h1>My Medical Profile</h1>
                        <p><a class="text-gray-200" href="{{ route('landing') }}">Home /</a> my medical profile</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container bg-white position-relative b-r-s-cont p-4 shadow" style="margin-top: -40px; z-index:9;">


        <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">

            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="appointments-tab" data-bs-toggle="tab" data-bs-target="#appointments"
                    type="button" role="tab" aria-controls="appointments" aria-selected="true" class="text-gray-500"><i
                        class="bi bi-calendar-week-fill me-1"></i>
                    Appointments</button>
            </li>

            <li class="nav-item" role="presentation">
                <button class="nav-link" id="treatments-tab" data-bs-toggle="tab" data-bs-target="#treatments"
                    type="button" role="tab" aria-controls="treatments" aria-selected="true" class="text-gray-500"><i
                        class="fas fa-user-md me-1"></i>
                    Treatments</button>
            </li>

            <li class="nav-item" role="presentation">
                <button class="nav-link" id="medicines-tab" data-bs-toggle="tab" data-bs-target="#medicines"
                    type="button" role="tab" aria-controls="medicines" aria-selected="true" class="text-gray-500"><i
                        class="fas fa-pills me-1"></i>
                    Medicines</button>
            </li>

            <li class="nav-item" role="presentation">
                <button class="nav-link" id="lab-tab" data-bs-toggle="tab" data-bs-target="#lab" type="button"
                    role="tab" aria-controls="lab" aria-selected="true" class="text-gray-500"><i
                        class="fas fa-flask me-1"></i>
                    Lab</button>
            </li>
        </ul>

        <div class="tab-content" id="myTabContent">

            <div class="tab-pane fade show active pt-2" id="appointments" role="tabpanel" aria-labelledby="appointments">

                <div class="table-responsive mb-2">
                    <table class="table display datatable-modal" id="table-appointment" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-xs">Name</th>
                                <th class="text-xs text-center">Branch</th>
                                <th class="text-xs text-center">Doctor</th>
                                <th class="text-xs text-center">Start Date</th>
                                <th class="text-xs text-center">End Date</th>
                                <th class="text-xs text-center">status</th>
                                <th class="text-xs text-center">Pay. status</th>
                                <th class="text-xs text-center">Pay. code</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $accepted_appointment = [2, 3, 4];
                            @endphp

                            @foreach ($appointments as $item)
                                @if (in_array($item->status, $accepted_appointment))
                                    @php
                                        $text_color = 'done-color-btn';
                                        $msg = 'Done';
                                    @endphp
                                @else
                                    @php
                                        $text_color = 'cancel-color-btn';
                                        $msg = 'Not finished';
                                    @endphp
                                @endif

                                @if ($item->invoice_item)
                                    @if ($item->invoice_item->invoice->status == 0)
                                            @php
                                                $text_color_invoice = 'cancel-color-btn';
                                                $msg_invoice = __('basic.not paid');
                                            @endphp
                                        @elseif ($item->invoice_item->invoice->status == 1)
                                            @php
                                                $text_color_invoice = 'pend-color-btn';
                                                $msg_invoice = __('basic.pending');
                                            @endphp
                                        @elseif ($item->invoice_item->invoice->status == 2)
                                            @php
                                                $text_color_invoice = 'prog-color-btn';
                                                $msg_invoice = __('basic.installment');
                                            @endphp
                                        @elseif ($item->invoice_item->invoice->status == 3)
                                            @php
                                                $text_color_invoice = 'done-color-btn';
                                                $msg_invoice = __('basic.paid');
                                            @endphp
                                        @elseif ($item->invoice_item->invoice->status == 4)
                                            @php
                                                $text_color_invoice = 'cancel-color-btn';
                                                $msg_invoice = __('basic.refund');
                                            @endphp
                                    @endif
                                @else
                                    @php
                                        $msg_invoice = 'Old Appointment';
                                        $text_color_invoice = 'done-color-btn';
                                    @endphp
                                @endif

                                <tr>
                                    <td>{{ $item->service_item->name }}</td>
                                    <td class="text-center">{{ $item->branch->name }}</td>
                                    <td class="text-center">
                                        @isset($item->doctor->first_name)
                                            {{ $item->doctor->first_name }}
                                        @endisset
                                    </td>
                                    <td class="text-center">
                                        {{ date('Y-m-d', strtotime($item->start_at)) }} <br>
                                        {{ date('h:i a', strtotime($item->start_at)) }}</td>
                                    <td class="text-center">
                                        {{ date('Y-m-d', strtotime($item->end_at)) }} <br>
                                        {{ date('h:i a', strtotime($item->end_at)) }}</td>
                                    <td class="text-center"> <span
                                            class="badge rounded-pill {{ $text_color }} badge-padd-l">{{ $msg }}</span>
                                    </td>
                                    <td class="text-center"> <span
                                            class="badge rounded-pill {{ $text_color_invoice }} badge-padd-l">{{ $msg_invoice }}</span>
                                    </td>
                                    <td class="text-center">
                                        @if ($item->invoice)
                                            {{ $item->invoice_item->invoice->code }}
                                        @else
                                            Old appointment
                                        @endif
                                    </td>

                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>

                <p class="text-gray-300 mb-0"><i class="fas fa-info-circle me-1"></i>Contact the call center if you want to
                    edit any appointment date</p>

            </div>


            <div class="tab-pane fade" id="medicines" role="tabpanel" aria-labelledby="medicines">

                <div class="table-responsive mb-2">
                    <table class="table display datatable-modal" id="table-medicine" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-xs w-25">Name</th>
                                <th class="text-xs text-center">Start</th>
                                <th class="text-xs text-center">End</th>
                                <th class="text-xs text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($medicine as $item)
                                @if ($item->status == 0)
                                    @php
                                        $text_color = 'active-color-btn';
                                        $msg = 'On medicine';
                                    @endphp
                                @elseif ($item->status == 1)
                                    @php
                                        $text_color = 'cancel-color-btn';
                                        $msg = 'No result';
                                    @endphp
                                @elseif ($item->status == 2)
                                    @php
                                        $text_color = 'done-color-btn';
                                        $msg = 'Done';
                                    @endphp
                                @endif

                                <tr>
                                    <td class="w-25">
                                        {{ $item->medicinescats->name }}</td>
                                    <td>{{ $item->start }}</td>
                                    <td class="text-center">{{ $item->end }}</td>
                                    <td class="text-center"> <span
                                            class="badge rounded-pill {{ $text_color }} badge-padd-l">{{ $msg }}</span>
                                    </td>

                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>

            <div class="tab-pane fade" id="treatments" role="tabpanel" aria-labelledby="treatments">

                <div class="table-responsive mb-2">
                    <table class="table display datatable-modal" id="table-treatment" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-xs">Treat. ID</th>
                                <th class="text-xs">Name</th>
                                <th class="text-xs text-center">Start</th>
                                <th class="text-xs text-center">End</th>
                                <th class="text-xs text-center">sessions</th>
                                <th class="text-xs text-center">sessions done</th>
                                <th class="text-xs text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($treatment as $item)
                                @if ($item->status == 0)
                                    @php
                                        $text_color = 'active-color-btn';
                                        $msg = 'In prog';
                                    @endphp
                                @elseif ($item->status == 1)
                                    @php
                                        $text_color = 'done-color-btn';
                                        $msg = 'Done';
                                    @endphp
                                @endif

                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td class="">
                                        {{ $item->treatment_cat->name }}</td>
                                    <td>{{ $item->start }}</td>
                                    <td class="text-center">{{ $item->end }}</td>
                                    <td class="text-center">{{ $item->sessions }}</td>
                                    <td class="text-center">{{ $item->sessions_done }}</td>
                                    <td class="text-center"> <span
                                            class="badge rounded-pill {{ $text_color }} badge-padd-l">{{ $msg }}</span>
                                    </td>

                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>

            </div>


            <div class="tab-pane fade" id="lab" role="tabpanel" aria-labelledby="lab">

                <div class="table-responsive">
                    <table class="table display datatable-modal" id="table-lab" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-xs">Name</th>
                                <th class="text-xs text-center">Code</th>
                                <th class="text-xs text-center">Pay. Code</th>
                                <th class="text-xs text-center">status</th>
                                <th class="text-xs text-center">Created</th>
                                <th class="text-xs text-center">Download</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($lab as $item)
                                @if ($item->status == 0)
                                    @php
                                        $text_color = 'active-color-btn';
                                        $msg = 'Sent';
                                    @endphp
                                @elseif ($item->status == 1)
                                    @php
                                        $text_color = 'done-color-btn';
                                        $msg = 'Done';
                                    @endphp
                                @endif


                                @if ($item->invoice_item->invoice->status == 0)
                                    @php
                                        $text_color_invoice = 'cancel-color-btn';
                                        $msg_invoice = 'Not Paid';
                                    @endphp
                                @elseif ($item->invoice_item->invoice->status == 1)
                                    @php
                                        $text_color_invoice = 'pend-color-btn';
                                        $msg_invoice = 'Pending';
                                    @endphp
                                @elseif ($item->invoice_item->invoice->status == 2)
                                    @php
                                        $text_color_invoice = 'done-color-btn';
                                        $msg_invoice = 'Paid';
                                    @endphp
                                @endif

                                <tr>
                                    <td><a class="link-cust-text text-gray-500 text-truncate"><i
                                                class="fas fa-file-medical-alt link-cust-text text-gray-300 me-1 text-truncate"></i>
                                            {{ $item->service_item->name }}</a></td>
                                    <td class="text-center">{{ $item->code }}</td>
                                    <td class="text-center">{{ $item->invoice_item->invoice->code }}</td>
                                    <td class="text-center"> <span
                                            class="badge rounded-pill {{ $text_color }} badge-padd-l">{{ $msg }}</span>
                                    </td>

                                    <td class="text-center">{{ date('d M Y', strtotime($item->created_at)) }}
                                    </td>

                                    <td class="text-center">

                                        @if (!empty($item->xray_file))
                                            <a href="{{ URL::asset('img/lab/' . $item->xray_file) }}"
                                                class="btn btn-sm modal-effect status-col-link active-color-btn b-r-xs mb-1"
                                                title="download"><i class="fas fa-trash"></i> Download
                                            </a>
                                        @endif

                                    </td>

                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>

        </div>

    </div>

@endsection


<!-- js insert -->
@section('js')


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

            //------ appointment table
            var table = $('#table-appointment').DataTable({
                    lengthChange: false,
                    buttons: {
                        dom: {
                            button: {
                                className: 'btn btn-table-export me-0'
                            }
                        },
                        buttons: ['copy', 'excel', 'pdf']
                    }
                }

            );
            table.buttons().container()
                .appendTo('#table-appointment_wrapper .col-md-6:eq(0)');

            //------ treatment table
            var table = $('#table-treatment').DataTable({
                lengthChange: false,
                buttons: {
                    dom: {
                        button: {
                            className: 'btn btn-table-export me-0'
                        }
                    },
                    buttons: ['copy', 'excel', 'pdf']
                }
            });
            table.buttons().container()
                .appendTo('#table-treatment_wrapper .col-md-6:eq(0)');


            //------ medicines table
            var table = $('#table-medicine').DataTable({
                lengthChange: false,
                buttons: {
                    dom: {
                        button: {
                            className: 'btn btn-table-export me-0'
                        }
                    },
                    buttons: ['copy', 'excel', 'pdf']
                }
            });
            table.buttons().container()
                .appendTo('#table-medicine_wrapper .col-md-6:eq(0)');


            //------ lab table
            var table = $('#table-lab').DataTable({
                lengthChange: false,
                buttons: {
                    dom: {
                        button: {
                            className: 'btn btn-table-export me-0'
                        }
                    },
                    buttons: ['copy', 'excel', 'pdf']
                }
            });
            table.buttons().container()
                .appendTo('#table-lab_wrapper .col-md-6:eq(0)');

        });
    </script>
@endsection
