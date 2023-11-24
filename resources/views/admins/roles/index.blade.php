@extends('layouts.master')

@section('title', 'Roles | Lam - School Management App')

@section('title-topbar', 'Roles')

<!-- css insert -->
@section('css')

<!-- -- datatables plugin -- -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.2/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.0/css/buttons.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/autofill/2.3.9/css/autoFill.bootstrap5.min.css">

@endsection



<!-- session successful message -->
@if (Session::has('success'))
<div id="flash-msg"><i class="bi bi-check-lg me-1"></i> {{ Session::get('success') }}</div>
@endif


<!-- content insert -->
@section('content')
<div class="container-fluid px-2 mt-3">

    <!-- page title link -->
    <div class="d-sm-flex align-items-center justify-content-between mb-3">
        <span class="mb-0">
            <a class="link-cust-text text-gray-200 fw-light" href="">Dashboard |</a>
            <a class="text-gray-300">Roles</a>
        </span>

        <div class="d-flex justify-content-center">
            <a href="{{ route('sett.role.create') }}"
                class=" main-color-bg text-white btn btn-sm shadow-sm b-r-l-cont p-2 px-4 me-1"><i
                    class="fas fa-plus fa-sm me-1"></i> New</a>
        </div>
    </div>

    <div class="card shadow mb-3 pb-2">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 fw-bold text-gray-500"><i class="fas fa-users me-2"></i>Roles Management</h6>
            <div class="dropdown no-arrow">
                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-300"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                    aria-labelledby="dropdownMenuLink">
                    <div class="dropdown-header">Action:</div>
                    <a class="dropdown-item" href="{{ route('sett.admin.index') }}"><i class="fas fa-users me-1"></i>
                        Users</a>
                    <a class="dropdown-item" href="{{ route('sett.admin.create') }}"><i class="fas fa-user me-1"></i>
                        New user</a>
                    <a class="dropdown-item" href="{{ route('sett.role.create') }}"><i class="fas fa-plus me-1"></i>
                        New roles</a>
                </div>
            </div>
        </div>

        <!-- Card Body -->
        <div class="card-body">

            <div class="table-responsive">
                <table class="table display datatable-modal" id="p-lab-table" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-xxs">NAME</th>
                            <th class="text-xxs text-center">HANDLE</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $iteam)
                        <tr>


                            <td>
                                <span>
                                    {{ $iteam->name }}
                                </span>
                            </td>

                            <td class="text-center">
                                <a href="{{ route('sett.role.edit', $iteam->id) }}"
                                    class="btn btn-sm status-col-link active-color-btn b-r-xs mb-1" title="edit"><i
                                        class="fas fa-pencil-alt"></i> Edit </a>

                                <a class="btn btn-sm modal-effect status-col-link cancel-color-btn b-r-xs mb-1 delete-conf"
                                    title="delete" data-effect="effect-scale" data-role_id="{{ $iteam->id }}"
                                    data-bs-toggle="modal" data-bs-target="#delete1"><i class="fas fa-trash"></i>
                                    Delete
                                </a>

                            </td>

                            <!-- Modal -->
                            <div class="modal fade" id="delete1" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable ">
                                    <div class="modal-content b-r-s-cont border-0">

                                        <div class="modal-header">
                                            <div class="modal-title" id="exampleModalLabel"><i
                                                    class="fas fa-trash me-1"></i>
                                                User delete</div>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>

                                        <form action="{{ route('sett.role.destroy', 'test') }}" method="post">
                                            {{ method_field('delete') }}
                                            {{ csrf_field() }}

                                            <!-- Modal content -->
                                            <div class="modal-body px-4">

                                                <div class="modal-body delete-conf-input text-center py-0">
                                                    <p class="mb-0">ِAre you sure you want to delete
                                                        this
                                                        user?</p><br>
                                                    <input type="hidden" name="role_id" value="">
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <div class="left-side">
                                                    <button type="button" class="btn btn-default btn-link"
                                                        data-bs-dismiss="modal">Never Mind</button>
                                                </div>
                                                <div class="divider"></div>
                                                <div class="right-side">
                                                    <button type="submit"
                                                        class="btn btn-default btn-link text-red">Delete
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


<!-- delete confirmation -->
<script>
    $('.delete-conf').click(function(event) {
            var role_id = $(this).data("role_id");
            var modal = $('.delete-conf-input [name="role_id"]')
            modal.val(role_id);
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