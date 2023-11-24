@extends('layouts.master')

@section('title', 'Workers | Lam - School Management App')

@section('title-topbar', __('basic.workers'))

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

<!-- session successful message -->
@if (Session::has('error_delete'))
<div id="flash-msg" class="shadow pt-3" style="background-color:#ff4152;">
    <div class="d-flex justify-content-between mb-2">
        <i class="fas fs-1 fa-times"></i>
        <a id="flash-msg-btn" class="text-blue-300 clickable-item-pointer"><i class="fas fa-times"
                style="color:#ffb4bc"></i></a>
    </div>
    <h3>We can't do it!</h3>
    <p style="color:#ffb4bc">{{ Session::get('error_delete') }}</p>
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
            <a class="text-gray-300"> {{ __('basic.workers') }}</a>
        </span>

        <div class="d-flex justify-content-center">

            <a href="{{ route('sett.admin.create') }}"
                class=" main-color-bg text-white btn btn-sm shadow-sm b-r-l-cont p-2 px-4 me-1"><i
                    class="fas fa-plus fa-sm me-1"></i> {{ __('basic.new worker') }}</a>
        </div>
    </div>

    <div class="card shadow mb-3 pb-2">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 fw-bold text-gray-500"><i class="fas fa-users me-2"></i> {{ __('basic.all workers') }}</h6>
            <div class="dropdown no-arrow">
                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-300"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                    aria-labelledby="dropdownMenuLink">
                    <div class="dropdown-header">Action:</div>
                    <a class="dropdown-item" href="{{ route('sett.admin.create') }}"><i class="fas fa-user me-1"></i>
                        new user</a>
                    <a class="dropdown-item" href="{{ route('sett.role.index') }}"><i class="fas fa-plus me-1"></i>
                        roles</a>
                    <a class="dropdown-item" href="{{ route('sett.role.create') }}"><i class="fas fa-plus me-1"></i>
                        new roles</a>
                </div>
            </div>
        </div>

        <!-- Card Body -->
        <div class="card-body">

            <div class="table-responsive">
                <table class="table display datatable-modal" id="p-lab-table" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-xxs">{{ __('basic.name') }}</th>
                            <th class="text-xxs text-center">{{ __('basic.role') }}</th>
                            <th class="text-xxs text-center">{{ __('basic.activation') }}</th>
                            <th class="text-xxs text-center">{{ __('basic.handle') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $iteam)
                        <tr>
                            <td>
                                <a class="d-flex align-items-center">
                                    <img class="rounded-circle avatar-small me-2"
                                        src="{{ URL::asset('img/useravatar/' . $iteam->avatar) }}">
                                    <div class="">
                                        <h6 class=" mb-1
                                                text-s fw-bold text-gray-mixed-400">
                                            {{ $iteam->first_name . ' ' . $iteam->second_name }}</h6>
                                        <p class="mb-0 text-xs text-gray-300">{{ $iteam->started_work }}</p>
                                    </div>
                                </a>
                            </td>

                            <td class="text-center">
                                @foreach ($iteam->getRoleNames() as $roles)
                                <span class="badge rounded-pill pend-color-btn badge-padd-l">
                                    {{ $roles }}
                                </span>
                                @endforeach
                            </td>

                            <td class="text-center">
                                @if ($iteam->deactivate == 0)
                                <i class="fas fa-circle me-2 text-xxs mb-0 main-color"></i><span
                                    class="main-color fw-bold"> {{ __('basic.actived') }}</span>
                                @else
                                <i class="fas fa-circle me-2 text-xxs mb-0 text-red"></i><span class="text-red fw-bold">
                                    {{ __('basic.deactivated') }}</span>
                                @endif
                            </td>

                            <td class="text-center">
                                <a href="{{ route('sett.admin.edit', $iteam->id) }}"
                                    class="btn btn-sm status-col-link active-color-btn b-r-xs mb-1" title="delete"><i
                                        class="fas fa-pencil-alt"></i> </a>
                            </td>

                            <!-- Modal -->
                            <div class="modal fade" id="delete1" tabindex="-1" aria-labelledby="exampleModalLabel"
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

                                        <form action="{{ route('sett.admin.destroy', 'test') }}" method="post">
                                            {{ method_field('delete') }}
                                            {{ csrf_field() }}

                                            <!-- Modal content -->
                                            <div class="modal-body px-4">

                                                <div class="modal-body delete-conf-input text-center py-0">
                                                    <p class="mb-0">{{ __('basic.delete msg') }}</p><br>
                                                    <input type="hidden" name="user_id" value="">
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

<!-- delete confirmation modal -->
<script>
    $('.delete-conf').click(function(event) {


            var user_id = $(this).data("user_id");
            var username = $(this).data("username");
            console.log(user_id);
            var modal = $('.delete-conf-input [name="user_id"]')
            modal.val(user_id);
            $('#username').val(username);
        })
</script>

<script>
    $(document).ready(function() {
            var table = $('#p-lab-table').DataTable({
                lengthChange: true,
                buttons: [{
                    extend: 'csv',
                    split: ['pdf', 'excel'],
                }]
            });
        });
</script>

<!-- -- datatables plugin -- -->
<script type="text/javascript" src="https://cdn.datatables.net/1.11.2/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.2/js/dataTables.bootstrap5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.bootstrap5.min.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.html5.min.js"></script>
<script type="text/javascript" language="javascript"
    src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.print.min.js"></script>
<script type="text/javascript" language="javascript"
    src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.colVis.min.js"></script>



@endsection