@extends('layouts.master')

@section('title', 'Online Requests | Lam - School Management App')

@section('title-topbar', __('basic.online request'))

<!-- css insert -->
@section('css')


<!-- select 2 -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/css/select2.min.css"
    integrity="sha512-aD9ophpFQ61nFZP6hXYu4Q/b/USW7rpLCQLX6Bi0WJHXNO7Js/fUENpBQf/+P4NtpzNX0jSgR5zVvPOJp+W2Kg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

<!-- -- datatables plugin -- -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.2/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/autofill/2.3.9/css/autoFill.bootstrap5.min.css">

<style>
    .select2-container {
        z-index: 99999;
    }
</style>
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
            <a class="link-cust-text text-gray-200 fw-light" href="{{ route('sett.on_request.index') }}">{{
                __('basic.online requests') }}
                |</a>
            <a class="text-gray-300">{{ __('basic.online request')}}</a>
        </span>

        <div class="d-flex justify-content-center">
            <a data-bs-toggle="modal" data-bs-target="#edit_item"
                class="bg-white text-gray-400 btn btn-sm shadow-sm b-r-l-cont p-2 px-4 me-2 mb-2 mb-md-0"><i
                    class="fas fa-pen fa-sm me-1"></i> {{ __('basic.edit') }}</a>

            <div class="modal fade" id="edit_item" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">

                    <form action="{{ route('sett.on_request_change_status', $on_request->id) }}" method="post">
                        {{ method_field('PUT') }}
                        {{ csrf_field() }}

                        <div class="modal-content b-r-s-cont border-0">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-edit me-1"></i>
                                    {{ __('basic.edit request') }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>

                            <!-- Modal content -->
                            <div class="modal-body px-5 py-3">

                                <div class="row mb-2">

                                    <div class="col-12 mb-2">
                                        <label class="form-label">{{ __('basic.status') }}
                                            <small>({{ __('basic.required') }})</small></label>
                                        <select
                                            class="js-example-basic-single select2-hidden-accessible @error('status') is-invalid @enderror"
                                            id="edit_status" name="status" required>
                                            <option @if ($on_request->status == 1) selected @endif value="1">
                                                {{ __('basic.send') }}
                                            </option>
                                            <option @if ($on_request->status == 2) selected @endif value="2">
                                                {{ __('basic.in progress') }}
                                            </option>
                                            <option @if ($on_request->status == 3) selected @endif value="3">
                                                {{ __('basic.acepted') }}
                                            </option>
                                            <option @if ($on_request->type == 4) selected @endif value="4">
                                                {{ __('basic.not Accepted') }}
                                            </option>
                                            <option @if ($on_request->type == 5) selected @endif value="5">
                                                {{ __('basic.canceled') }}
                                            </option>
                                        </select>

                                        <span id="status_error" class="error-msg-form"></span>

                                        @error('status')
                                        <span class="error-msg-form">
                                            {{ $message }}
                                        </span>
                                        @enderror

                                    </div>


                                    <div class="col-12 mb-2">
                                        <label class="form-label">{{ __('basic.worker note') }}
                                            <small>({{ __('basic.required') }})</small></label>
                                        <textarea name="worker_note" class="form-control"
                                            placeholder="Write here your the note .." rows="4"
                                            spellcheck="false">{{ $on_request->worker_note }}</textarea>

                                        @error('worker_note')
                                        <span class="error-msg-form">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>

                                </div>

                            </div>

                            <div class="modal-footer">
                                <div class="left-side">
                                    <button type="button" class="btn btn-default btn-link" data-bs-dismiss="modal">{{
                                        __('basic.never mind') }}</button>
                                </div>
                                <div class="divider"></div>
                                <div class="right-side">
                                    <button type="submit" class="btn btn-default btn-link main-color">{{
                                        __('basic.send') }}</button>
                                </div>
                            </div>

                        </div>
                    </form>

                </div>

            </div>


            @if ($on_request->invoice_id)
            <a href="{{ route('sett.invoice.show', $on_request->invoice_id) }}"
                class=" main-color-bg text-white btn btn-sm shadow-sm b-r-l-cont p-2 px-4 me-1"><i
                    class="fas fa-receipt fa-sm me-1"></i> {{ __('Invoice') }}</a>
            @else
            <a href="{{ route('sett.on_request.update', $on_request->id) }}" data-bs-toggle="modal"
                data-bs-target="#confirm_modal"
                class=" main-color-bg text-white btn btn-sm shadow-sm b-r-l-cont p-2 px-4 me-1"><i
                    class="fas fa-check fa-sm me-1"></i> {{ __('basic.accept and make an invoice') }}</a>
            @endif


        </div>
    </div>

    <div class="card shadow mb-3 pb-2">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 fw-bold text-gray-500"><i class="fas fa-paper-plane me-2"></i>{{ __('basic.online requests')
                }}
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

            <div class="row mb-4">

                <div class="col text-center">
                    <h6 class="text-gray-300 text-xs mb-1 text-center">{{ __('basic.code') }}</h6>
                    <p id="branch_final_info" class="text-gray-600 text-s fw-bold text-center text-truncate">
                        {{ $on_request->code }}
                    </p>
                </div>

                <div class="col text-center">
                    <h6 class="text-gray-300 text-xs mb-1 text-center">{{ __('basic.status') }}</h6>

                    @if ($on_request->status == 1)
                    @php
                    $text_color = 'not_accepted-color-btn';
                    $msg = __('basic.send');
                    @endphp
                    @elseif ($on_request->status == 2)
                    @php
                    $text_color = 'pend-color-btn';
                    $msg = __('basic.in progress');
                    @endphp
                    @elseif ($on_request->status == 3)
                    @php
                    $text_color = 'done-color-btn';
                    $msg = __('basic.accept');
                    @endphp
                    @elseif ($on_request->status == 4)
                    @php
                    $text_color = 'cancel-color-btn';
                    $msg = __('basic.not accept');
                    @endphp
                    @elseif ($on_request->status == 5)
                    @php
                    $text_color = 'cancel-color-btn';
                    $msg = __('basic.canceled');
                    @endphp
                    @endif
                    <span class="badge rounded-pill {{ $text_color }} badge-padd-l">{{
                        $msg
                        }}</span>
                </div>

                <div class="col text-center">
                    <h6 class="text-gray-300 text-xs mb-1 text-center">{{ __('basic.patient') }}</h6>
                    <a class="link-cust-text text-gray-500 fw-bold mb-1"
                        href="{{route('sett.managers.show', $on_request->patient_id)}}">
                        {{ $on_request->patient->full_name }}
                    </a>
                </div>

                <div class="col text-center">
                    <h6 class="text-gray-300 text-xs mb-1 text-center">{{ __('basic.sell') }}</h6>
                    <p id="branch_final_info" class="text-gray-600 text-s fw-bold text-center text-truncate">
                        {{ $on_request->final_price }}</p>
                </div>

                <div class="col text-center">
                    <h6 class="text-gray-300 text-xs mb-1 text-center">{{ __('basic.created') }}</h6>
                    <p id="branch_final_info" class="text-gray-600 text-s fw-bold text-center text-truncate">
                        {{ date('d M Y', strtotime($on_request->created_at)) }}</p>
                </div>

                @if ($on_request->invoice)

                <div class="col text-center">
                    @if ($on_request->invoice->status == 0)
                    @php
                    $msg_invoice = __('basic.not paid');
                    $text_color_invoice = 'cancel-color-btn';
                    @endphp
                    @elseif ($on_request->invoice->status == 1)
                    @php
                    $text_color_invoice = 'pend-color-btn';
                    $msg_invoice = __('basic.pending');
                    @endphp
                    @elseif ($on_request->invoice->status == 2)
                    @php
                    $text_color_invoice = 'prog-color-btn';
                    $msg_invoice = __('basic.installment');
                    @endphp
                    @elseif ($on_request->invoice->status == 3)
                    @php
                    $text_color_invoice = 'done-color-btn';
                    $msg_invoice = __('basic.paid');
                    @endphp
                    @elseif ($on_request->invoice->status == 4)
                    @php
                    $msg_invoice = __('basic.refund');
                    $text_color_invoice = 'cancel-color-btn';
                    @endphp
                    @endif

                    <h6 class="text-gray-300 text-xs mb-1 text-center">{{ __('Payment status') }}</h6>
                    <a href="{{ route('sett.invoice.show', $on_request->invoice_id) }}"><span
                            class="badge rounded-pill {{ $text_color_invoice }} badge-padd-l">{{
                            $msg_invoice
                            }}</span></a>
                </div>
                @endif

            </div>
            <div class="table-responsive">
                <table class="table display datatable-modal" id="table-tripo" width="100%" cellspacing="0">

                    <thead>
                        <tr>
                            <th class="text-xxs">{{ __('basic.image') }}</th>
                            <th class="text-xxs">{{ __('basic.name') }}</th>
                            <th class="text-xxs">{{ __('basic.type') }}</th>
                            <th class="text-xxs">{{ __('basic.status') }}</th>
                            <th class="text-xxs">{{ __('basic.info') }}</th>
                            <th class="text-xxs">{{ __('basic.quantity') }}</th>
                            <th class="text-xxs">{{ __('basic.start') }}</th>
                            <th class="text-xxs">{{ __('basic.end') }}</th>
                            <th class="text-xxs">{{ __('basic.subtotal') }}</th>
                            <th class="text-xxs">{{ __('basic.discount') }}</th>
                            <th class="text-xxs">{{ __('basic.total') }}</th>
                            {{-- <th class="text-xxs">{{ __('basic.handle') }}</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($on_request->items as $item)

                        @if ($item->type === "hotel")
                        @php
                        $url = "sett.unit_offer.edit";
                        $img = URL::asset('img/unit/' . $item->requestable->hotel->main_image);
                        @endphp
                        @elseif ($item->type === "trip")
                        @php
                        $url = "sett.trip_offer.edit";
                        $img = URL::asset('img/trip/' . $item->requestable->trip->main_image);
                        @endphp
                        @elseif ($item->type === "package")
                        @php
                        $url = "sett.package_offer.edit";
                        $img = URL::asset('img/package/' . $item->requestable->package->main_image);
                        @endphp
                        @elseif ($item->type === "visa")
                        @php
                        $url = "sett.visa.edit";
                        $img = URL::asset('img/visa/' . $item->requestable->destination->image);
                        @endphp
                        @endif


                        @if ($item->status == 1)
                        @php
                        $text_color = 'not_accepted-color-btn';
                        $msg = __('basic.send');
                        @endphp
                        @elseif ($item->status == 2)
                        @php
                        $text_color = 'pend-color-btn';
                        $msg = __('basic.in progress');
                        @endphp
                        @elseif ($item->status == 3)
                        @php
                        $text_color = 'done-color-btn';
                        $msg = __('basic.accept');
                        @endphp
                        @elseif ($item->status == 4)
                        @php
                        $text_color = 'cancel-color-btn';
                        $msg = __('basic.not accept');
                        @endphp
                        @elseif ($item->status == 5)
                        @php
                        $text_color = 'cancel-color-btn';
                        $msg = __('basic.canceled');
                        @endphp
                        @endif

                        <tr>
                            <td>
                                <img src="{{ $img }}" class="rounded-circle avatar-small me-2" alt="" />
                            </td>
                            <td>
                                <a class="link-cust-text text-gray-500 fw-bold mb-1"
                                    href="{{route($url, $item->requestable_id)}}">
                                    {{ $item->requestable->name }}
                                </a>
                            </td>
                            <td>
                                <a class="link-cust-text text-gray-500 fw-bold mb-1"
                                    href="{{route('sett.managers.show', $item->patient_id)}}">
                                    {{ $item->type }}
                                </a>
                            </td>
                            <td>
                                <span class="badge rounded-pill {{ $text_color }} badge-padd-l">{{
                                    $msg
                                    }}</span>
                            </td>
                            <td>
                                {{ $item->cat }}
                            </td>
                            <td>
                                {{ $item->qty }}
                            </td>
                            <td>
                                {{ $item->start_at }}
                            </td>
                            <td>
                                {{ $item->end_at }}
                            </td>
                            <td>
                                {{ $item->subtotal }}
                            </td>
                            <td>
                                {{ $item->discount }}
                            </td>
                            <td>
                                {{ $item->final_price }}
                            </td>
                            {{-- <td>
                                <a class="btn btn-sm status-col-link status-col-link not_accepted-color-btn b-r-xs mb-1"
                                    data-bs-toggle="modal" data-bs-target="#show_content" title="edit"><i
                                        class="fas fa-edit"></i></a>
                            </td> --}}
                        </tr>


                        <div class="modal fade" id="show_content" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">

                                <div class="modal-content b-r-s-cont border-0">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-edit me-1"></i>
                                            {{ __('basic.edit') }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>

                                    <form id="myform m-0" class="myform m-0" method="POST"
                                        action="{{ route('sett.update_request_item', $item->id) }}"
                                        enctype="multipart/form-data">
                                        @csrf

                                        <!-- Modal content -->
                                        <div class="modal-body px-5 py-3">

                                            <div class="row mb-2 justify-content-center">

                                                <div class="col-12 col-md-7 mb-2">
                                                    <div class="mb-3">
                                                        <label class="form-label"> {{ __('basic.final price')}}
                                                            <small>({{ __('basic.required')}})</small></label>
                                                        <input name="final_price" type="text"
                                                            class="form-control @error('final_price') is-invalid @enderror"
                                                            placeholder="Final price price..."
                                                            value="{{ $item->final_price }}" autofocus required>
                                                    </div>

                                                    @error('final_price')
                                                    <span class="error-msg-form">
                                                        {{ $message }}
                                                    </span>
                                                    @enderror
                                                </div>

                                                <div class="col-12 col-md-7 mb-2">
                                                    <div class="mb-3">
                                                        <label class="form-label"> {{ __('basic.buy')}}
                                                            <small>({{ __('basic.optional')}})</small></label>
                                                        <input name="buy" type="number"
                                                            class="form-control @error('buy') is-invalid @enderror"
                                                            placeholder="Buy price..." value="{{ $item->buy }}">
                                                    </div>

                                                    @error('buy')
                                                    <span class="error-msg-form">
                                                        {{ $message }}
                                                    </span>
                                                    @enderror
                                                </div>

                                                <div class="col-12 col-md-7 mb-2">
                                                    <label class="form-label">{{ __('basic.supplier')}}
                                                        <small>({{__('basic.optional')}})</small></label>
                                                    <select
                                                        class="js-example-basic-single select2-no-search select2-hidden-accessible @error('debtor_id') is-invalid @enderror"
                                                        name="debtor_id">
                                                        <option disabled selected>- {{ __('basic.not selected') }} -
                                                        </option>
                                                        @foreach ($debtors as $item)
                                                        <option value="{{ $item->id }}">{{ $item->company_name }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                    <div id="debtor_id-js-error-valid"></div>

                                                    @error('debtor_id')
                                                    <span class="error-msg-form">
                                                        {{ $message }}
                                                    </span>
                                                    @enderror
                                                </div>

                                            </div>

                                        </div>

                                        <div class="modal-footer">
                                            <div class="left-side">
                                                <button type="button" class="btn btn-default btn-link"
                                                    data-bs-dismiss="modal">Never
                                                    Mind</button>
                                            </div>
                                            <div class="divider"></div>
                                            <div class="right-side">
                                                <button type="submit" class="btn btn-default btn-link text-green">{{
                                                    __('basic.update') }}</button>

                                            </div>
                                        </div>

                                    </form>

                                </div>

                            </div>

                        </div>
                        @endforeach


                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="confirm_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable ">
        <div class="modal-content b-r-s-cont border-0">

            <div class="modal-header">
                <div class="modal-title" id="exampleModalLabel"><i class="fas fa-paper-plane me-1"></i>
                    {{ __('basic.accept') }}</div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="{{ route('sett.on_request.update', 'test') }}" method="post">
                {{ method_field('PUT') }}
                {{ csrf_field() }}

                <!-- Modal content -->
                <div class="modal-body px-4">

                    <div class="modal-body delete-conf-input text-center py-0">
                        <p class="mb-0">Are you sure you want to accept and make an invoice
                            this request?</p><br>
                        <input type="hidden" name="request_id" value="{{ $on_request->id }}">
                    </div>
                </div>

                <div class="modal-footer">
                    <div class="left-side">
                        <button type="button" class="btn btn-default btn-link" data-bs-dismiss="modal">{{
                            __('basic.never mind') }}</button>
                    </div>
                    <div class="divider"></div>
                    <div class="right-side">
                        <button type="submit" class="btn btn-default btn-link text-green">{{ __('basic.accept') }}
                        </button>
                    </div>

                </div>
            </form>

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

<!-- for confirmation modal -->
<script>
    // $('.delete-conf').click(function(event) {
    //         var item_id = $(this).data("item_id");
    //         var modal = $('.delete-conf-input [name="request_id"]')
    //         modal.val(item_id);
    //     })
</script>

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