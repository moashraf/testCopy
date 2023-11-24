@extends('layouts.master')

@section('title', 'DONE | Lam - School Management App')

@section('title-topbar', 'Done')

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

<div class="container-fluid px-0 px-md-2 mt-3">


    <div class="card card-input shadow mb-3 pb-3">

        <!-- Card Body -->
        <div class="card-body px-4 px-md-5">


            Done


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

                var table = $('#table-debitor').DataTable({
                        lengthChange: false,
                        "pageLength": 5,
                        "order": [
                            [0, "ASC"]
                        ],
                        buttons: {
                            dom: {
                                button: {
                                    className: 'btn btn-table-export me-0' //Primary class for all buttons
                                }
                            },
                            buttons: ['copy', 'excel', 'pdf']
                        }
                    }

                );
                table.buttons().container()
                    .appendTo('#table-debitor_wrapper .col-md-6:eq(0)');

            });
    </script>
    @endsection