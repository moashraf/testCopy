@extends('layouts.master')

@section('title', 'Client Form | Lam - School Management App')

@section('title-topbar', __('basic.website form'))

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
            <a class="text-gray-300">{{ __('basic.website forms') }}</a>
        </span>
    </div>

    <div class="card shadow mb-3 pb-2">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 fw-bold text-gray-500"><i class="fas fa-paper-plane me-2"></i>{{ __('basic.website forms') }}
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
                            <th class="text-xxs">{{ __('basic.phone number') }}</th>
                            <th class="text-xxs">{{ __('basic.email') }}</th>
                            <th class="text-xxs">{{ __('basic.status') }}</th>
                            <th class="text-xxs">{{ __('basic.worker') }}</th>
                            <th class="text-xxs">{{ __('basic.created') }}</th>
                            <th class="text-xxs">{{ __('basic.handle') }}</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($on_requests as $item)

                        @if ($item->status == 1)
                        @php
                        $text_color = 'not_accepted-color-btn';
                        $msg = __('basic.send');
                        @endphp
                        @elseif ($item->status == 2)
                        @php
                        $text_color = 'done-color-btn';
                        $msg = __('basic.accept');
                        @endphp
                        @elseif ($item->status == 3)
                        @php
                        $text_color = 'cancel-color-btn';
                        $msg = __('basic.rejected');
                        @endphp
                        @endif

                        <tr>
                            <td>
                                {{ $item->id }}
                            </td>
                            <td>
                                <a class="link-cust-text text-gray-500 fw-bold mb-1"
                                    href="{{route('sett.client_form.show', $item->id)}}">
                                    {{ $item->code }}
                                </a>
                            </td>
                            <td>
                                {{ $item->phone_number }}
                            </td>
                            <td>
                                {{ $item->email }}
                            </td>
                            <td>
                                <span class="badge rounded-pill {{ $text_color }} badge-padd-l">{{
                                    $msg
                                    }}</span>
                            </td>
                            <td>
                                {{ $item->worker->full_name }}
                            </td>
                            <td>
                                {{ $item->created_at }}
                            </td>
                            <td>
                                <a class="btn btn-sm status-col-link status-col-link not_accepted-color-btn b-r-xs mb-1"
                                    data-bs-toggle="modal" data-bs-target="#show_content" title="edit"><i
                                        class="fas fa-eye"></i></a>

                                @role('Super-admin|Operation-manager')
                                <a class="btn btn-sm status-col-link status-col-link cancel-color-btn b-r-xs mb-1"
                                    data-bs-toggle="modal" data-bs-target="#delete_modal" title="delete"><i
                                        class="fas fa-trash-alt"></i></a>
                                @endrole
                            </td>
                        </tr>


                        <div class="modal fade" id="show_content" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">

                                <div class="modal-content b-r-s-cont border-0">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel"><i
                                                class="fas fa-envelope-open-text me-1"></i>
                                            {{ __('basic.form content') }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>

                                    <!-- Modal content -->
                                    <div class="modal-body px-5 py-3">

                                        <div class="row mb-2">
                                            <div class="col-12 mb-2">

                                                <label class="form-label">{{ __('basic.subject')}}
                                                    <small>({{
                                                        __('basic.required')}})</small></label>
                                                <input type="text"
                                                    class="form-control @error('second_name') is-invalid @enderror"
                                                    readonly disabled value="{{ $item->subject }}">
                                            </div>

                                            <div class="col-12 mb-2">
                                                <label class="form-label">{{ __('basic.content') }}
                                                    <small>({{ __('basic.required') }})</small></label>
                                                <textarea class="form-control" rows="4" spellcheck="false" readonly
                                                    disabled>{{ $item->content }}</textarea>
                                            </div>

                                        </div>

                                    </div>

                                    <div class="modal-footer">
                                        <div class="left-side">
                                            <form id="myform m-0" class="myform m-0" method="POST"
                                                action="{{ route('sett.client_form_status', $item->id) }}"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="status" value="3">
                                                <button type="submit" class="btn btn-dengar btn-link text-danger">{{
                                                    __('basic.reject') }}</button>

                                            </form>
                                        </div>
                                        <div class="divider"></div>
                                        <div class="right-side">

                                            <form id="myform m-0" class="myform" method="POST"
                                                action="{{ route('sett.client_form_status', $item->id) }}"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="status" value="2">
                                                <button type="submit" class="btn btn-default btn-link text-green">{{
                                                    __('basic.accept') }}</button>

                                            </form>
                                        </div>
                                    </div>

                                </div>

                            </div>

                        </div>

                        @role('Super-admin|Operation-manager')
                        <!-- Modal -->
                        <div class="modal fade" id="delete_modal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable ">
                                <div class="modal-content b-r-s-cont border-0">

                                    <div class="modal-header">
                                        <div class="modal-title" id="exampleModalLabel"><i
                                                class="fas fa-trash me-1"></i>
                                            {{ __('basic.delete') }}</div>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>

                                    <form action="{{ route('sett.client_form.destroy', $item->id) }}" method="post">
                                        {{ method_field('delete') }}
                                        {{ csrf_field() }}

                                        <!-- Modal content -->
                                        <div class="modal-body px-4">

                                            <div class="modal-body delete-conf-input text-center py-0">
                                                <p class="mb-0">{{ __('basic.delete message') }}</p><br>
                                                <input type="hidden" name="station_id" value="{{ $item->id }}">
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <div class="left-side">
                                                <button type="button" class="btn btn-default btn-link"
                                                    data-bs-dismiss="modal">{{ __('basic.never mind') }}</button>
                                            </div>
                                            <div class="divider"></div>
                                            <div class="right-side">
                                                <button type="submit" class="btn btn-default btn-link text-red">{{
                                                    __('basic.delete') }}
                                                </button>
                                            </div>

                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                        @endrole

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