@extends('layouts.master')

@section('title', 'Online Requests | Lam - School Management App')

@section('title-topbar', 'Online Requests')

<!-- css insert -->
@section('css')

<!-- -- datatables plugin -- -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.2/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.0/css/buttons.bootstrap5.min.css">
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
    <div class="d-sm-flex align-items-center justify-content-between mb-3">
        <span class="mb-0">
            <a class="link-cust-text text-gray-200 fw-light" href="{{ route('sett.home') }}">{{ __('basic.dashboard') }}
                |</a>
            <a class="text-gray-300">{{ __('Online Requests') }}</a>
        </span>
    </div>

    <div class="card shadow mb-3 pb-2">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 fw-bold text-gray-500"><i class="fas fa-paper-plane me-2"></i>{{ __('Online Requests') }}
            </h6>
            <div class="dropdown no-arrow">
                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-300"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                    aria-labelledby="dropdownMenuLink">
                    <div class="dropdown-header">Action:</div>
                </div>
            </div>
        </div>

        <!-- Card Body -->
        <div class="card-body">

            <div class="table-responsive">
                <table class="table display datatable-modal" id="table-tripo" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-xxs">{{ __('basic.id') }}</th>
                            <th class="text-xxs">{{ __('basic.code') }}</th>
                            <th class="text-xxs">{{ __('basic.traveler') }}</th>
                            <th class="text-xxs">{{ __('basic.status') }}</th>
                            <th class="text-xxs">{{ __('basic.discount') }}</th>
                            <th class="text-xxs">{{ __('basic.total') }}</th>
                            <th class="text-xxs">{{ __('basic.created') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($on_requests as $item)

                        @if ($item->status == 1)
                        @php
                        $text_color = 'not_accepted-color-btn';
                        $msg = __('Send');
                        @endphp
                        @elseif ($item->status == 2)
                        @php
                        $text_color = 'pend-color-btn';
                        $msg = __('In progress');
                        @endphp
                        @elseif ($item->status == 3)
                        @php
                        $text_color = 'done-color-btn';
                        $msg = __('Accept');
                        @endphp
                        @elseif ($item->status == 4)
                        @php
                        $text_color = 'cancel-color-btn';
                        $msg = __('Not accept');
                        @endphp
                        @elseif ($item->status == 5)
                        @php
                        $text_color = 'cancel-color-btn';
                        $msg = __('Canceled');
                        @endphp
                        @endif

                        <tr>
                            <td>
                                {{ $item->id }}
                            </td>
                            <td>
                                <a class="link-cust-text text-gray-500 fw-bold mb-1"
                                    href="{{route('sett.on_request.show', $item->id)}}">
                                    {{ $item->code }}
                                </a>
                            </td>
                            <td>
                                <a class="link-cust-text text-gray-500 fw-bold mb-1"
                                    href="{{route('sett.managers.show', $item->patient_id)}}">
                                    {{ $item->patient->full_name }}
                                </a>
                            </td>
                            <td>
                                <span class="badge rounded-pill {{ $text_color }} badge-padd-l">{{
                                    $msg
                                    }}</span>
                            </td>
                            <td>
                                {{ $item->discount }}
                            </td>
                            <td>
                                {{ $item->final_price }}
                            </td>
                            <td>
                                {{ $item->created_at }}
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
<script>
    $(document).ready(function() {
            
            var table = $('#table-tripo').DataTable({
                    lengthChange: false,
    
                    buttons: {
                        dom: {
                            button: {
                                className: 'btn btn-table-export me-0'
                            }
                        },
                        buttons: ['copy', 'excel', 'pdf', 'print']
                    }
                }
    
            );
            table.buttons().container()
                .appendTo('#table-tripo_wrapper .col-md-6:eq(0)');
    
    });
</script>


<!-- jquery ui datepicker -->
<script type="text/javascript"
    src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>

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


@endsection