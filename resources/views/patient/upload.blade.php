@extends('layouts.master')

@section('title', 'Upload Clients | Lam - School Management App')

@section('title-topbar', __('basic.upload clients'))

<!-- css insert -->
@section('css')

<!-- select 2 -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/css/select2.min.css"
    integrity="sha512-aD9ophpFQ61nFZP6hXYu4Q/b/USW7rpLCQLX6Bi0WJHXNO7Js/fUENpBQf/+P4NtpzNX0jSgR5zVvPOJp+W2Kg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

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

<div class="container-fluid px-0 px-md-2 mt-3">

    <!-- page title link -->
    <div class="d-sm-flex align-items-center justify-content-between mb-3">
        <span class="mb-0">
            <a class="link-cust-text text-gray-200 fw-light" href="{{ route('sett.home') }}">{{ __('basic.dashboard') }}
                |</a>
            <a class="link-cust-text text-gray-200 fw-light" href="{{ route('sett.managers.index') }}">{{
                __('basic.patients') }} |
            </a>
            <a class="text-gray-300">{{ __('basic.upload clients') }}</a>
        </span>
    </div>

    <div class="card card-input shadow mb-3 pb-3">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 fw-bold text-gray-500"><i class="fas fa-file me-1"></i>
                {{ __('basic.upload clients') }}</h6>
        </div>


        <!-- Card Body -->
        <div class="card-body px-4 px-md-5">

            <form id="myform" method="POST" action="{{ route('sett.upload_clients_store') }}"
                enctype="multipart/form-data">
                @csrf
                <div class="row mb-1 justify-content-center">

                    <div class="col-12 col-md-10 col-lg-7">
                        <div class="row">
                            <div class="col-12 mb-2">

                                <svg xmlns="http://www.w3.org/2000/svg" class="d-none">
                                    <symbol id="info-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
                                    </symbol>
                                </svg>
                                <div class="alert alert-primary d-flex align-items-center" role="alert">
                                    <svg class="bi flex-shrink-0 me-2" role="img" height="23px" width="23px"
                                        aria-label="Info:">
                                        <use xlink:href="#info-fill" />
                                    </svg>
                                    <div>
                                        {{ __('basic.uploade client file 1') }}
                                        <ul>
                                            <li>{{ __('basic.uploade client file 2') }} <a
                                                    href="{{ URL::asset('file/sheets/travelers.xlsx') }}"
                                                    class="alert-link text-decoration-underline">{{
                                                    __('basic.click here to download') }}</a> </li>
                                            <li>{{ __('basic.uploade client file 3') }}</li>
                                            <li>{{ __('basic.uploade client file 4') }}</li>
                                            <li>{{ __('basic.uploade client file 5') }}</li>
                                            <li>{{ __('basic.uploade client file 6') }}</li>
                                        </ul>


                                    </div>
                                </div>
                            </div>

                            <div class="col-12 mb-3">
                                <label class="form-label">{{ __('basic.branch') }} <small>({{ __('basic.required')
                                        }})</small></label>
                                <select id="branch_id" class="js-example-basic-single form-control" name="branch_id"
                                    aria-hidden="true" required>
                                    @foreach ($branches as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}
                                    </option>
                                    @endforeach
                                </select>
                                <div id="branch_id-js-error-valid"></div>
                                @error('branch_id')
                                <span class="error-msg-form">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>

                            <div class="col-12 mb-2">
                                <label class="form-label"> {{ __('basic.clients file') }}
                                    <small>({{ __('basic.required') }})</small></label>
                                <input class="form-control" name='client_file' accept=".xlsx" type="file" id="formFile">

                                <div class="form-text text-gray-200">{{ __('basic.attached img') }}</div>

                                <span id="client_file-error" class="error-msg-form"></span>

                                @error('client_file')
                                <span class="error-msg-form">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end mt-4 mb-2">
                    <input type="submit" name="next" class="next-form-steps btn btn-primary action-button-next"
                        value="{{ __('basic.upload') }}">
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

<!-- validate jquery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"
    integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    //Rules for the Validator plugin
        var $validator = $('#myform').validate({
            rules: {
                name: {
                    minlength: 3,
                },
            },
            messages: {
                email: {
                    required: "We need your email address to contact you",
                    email: "Your email address must be in the format of name@domain.com"
                },
                password_confirmation: {
                    equalTo: "Password does not match",
                }
            },
            //for inserting erros for some inputs that makes posation problem such as selector 2 and bt datapicker
            errorPlacement: function(error, element) {
                switch (element.attr("name")) {
                    case 'role':
                        error.insertAfter($("#role-js-error-valid"));
                        break;
                    case 'gendar':
                        error.insertAfter($("#gendar-js-error-valid"));
                        break;
                    default:
                        error.insertAfter(element);
                }

            },
        });
</script>

@endsection