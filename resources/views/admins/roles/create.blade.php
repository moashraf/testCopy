@extends('layouts.master')

@section('title', 'New Role | Lam - School Management App')

@section('title-topbar', 'New Role')

<!-- css insert -->
@section('css')

<!-- select 2 -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/css/select2.min.css"
    integrity="sha512-aD9ophpFQ61nFZP6hXYu4Q/b/USW7rpLCQLX6Bi0WJHXNO7Js/fUENpBQf/+P4NtpzNX0jSgR5zVvPOJp+W2Kg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

@endsection


<!-- content insert -->
@section('content')

<div class="container-fluid px-2 mt-3">

    <!-- page title link -->
    <div class="d-sm-flex align-items-center justify-content-between mb-3">
        <span class="mb-0">
            <a class="link-cust-text text-gray-200 fw-light" href="{{ route('sett.home') }}">Dashboard |</a>
            <a class="link-cust-text text-gray-200 fw-light" href="{{ route('sett.role.index') }}">Roles | </a>
            <a class="text-gray-300">Add user</a>
        </span>
    </div>

    <div class="card card-input shadow mb-3 pb-3">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 fw-bold text-gray-500"><i class="fas fa-plus me-2"></i> Add new role</h6>
        </div>

        <!-- Card Body -->
        <div class="card-body px-3">

            <form id="myforminput" method="POST" action="{{ route('sett.role.store') }}">

                @csrf

                <div class="row mb-2">

                    <div class="col-12 col-md-6 mb-2">
                        <label class="form-label">Role name <small>(required)</small></label>
                        <input name="rolename" type="text" class="form-control @error('rolename') is-invalid @enderror"
                            placeholder="Write the given role here.." required>

                        @error('rolename')
                        <span class="error-msg-form">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="col-12 col-md-6 mb-2">
                        <label class="form-label">Permission <small>(required)</small></label>

                        <select id="multiselect" class="js-example-basic-single form-control" multiple=""
                            name="permissions[]" aria-hidden="true" required>
                            @foreach ($permissions as $iteam)
                            <option value="{{ $iteam->id }}">{{ $iteam->name }}</option>
                            @endforeach
                        </select>
                        <div id="permissions-js-error-valid"></div>

                        @error('permissions')
                        <span class="error-msg-form">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="d-flex pt-4 justify-content-center">
                    <button type="submit" class="btn btn-default btn-primary">Send Now
                    </button>
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

            //multi select
            $('#multiselect').select2();
            $('#multiselect').on('select2:opening select2:closing', function(event) {
                var $searchfield = $(this).parent().find('.select2-search__field');
                $searchfield.prop('disabled', true);
            });
        });
</script>

<!-- validate jquery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"
    integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    //Rules for the Validator plugin
        var $validator = $('#myforminput').validate({
            rules: {
                rolename: {
                    maxlength: 100,
                },
            },
            //for inserting erros for some inputs that makes posation problem such as selector 2 and bt datapicker
            errorPlacement: function(error, element) {
                switch (element.attr("name")) {
                    case 'permissions':
                        error.insertAfter($("#permissions-js-error-valid"));
                        break;

                    default:
                        error.insertAfter(element);
                }

            },
        });
</script>

@endsection