@extends('layouts.master')

@section('title', 'Settings | Lam - School Management App')

@section('title-topbar', __('basic.settings'))

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
            <a class="text-gray-300">{{ __('basic.settings') }}</a>
        </span>
    </div>

    <div class="card card-input shadow mb-3 pb-3">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 fw-bold text-gray-500"><i class="fas fa-cogs me-1"></i> {{ __('basic.settings') }}</h6>
        </div>


        <!-- Card Body -->
        <div class="card-body px-4 px-md-5">

            <form id="myform" method="POST" action="{{ route('sett.options.update', '1') }}"
                enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <div class="row mb-1 justify-content-center">

                    <div class="col-12 col-md-10 col-lg-7">
                        <div class="row">

                            <div class="avatar-update-container">
                                <div class="picture">
                                    <img src="{{ URL::asset('img/dashboard/system/' . $option[9]->option_value) }}"
                                        class="picture-src" id="mib_PicturePreview" title="" />
                                    <input type="file" name='logo' accept="image/*" id="mib_img_input">
                                </div>
                                <h6 class="text-gray-300">{{ __('basic.choose pic') }}</h6>
                                <div class="form-text text-gray-200 mb-3">The logo must be less than 40kb with width of
                                    167px and height of 107px in PNG format
                                </div>
                                @error('logo')
                                <span class="error-msg-form">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>

                            @foreach ($option as $item)


                            @if ($item->option_name === 'logo')

                            @else <div class="col-12 mb-3">
                                @if ($item->option_name === 'timeslotduration')
                                <label class="form-label text-capitalize">{{ $item->option_name }}
                                    <small>({{ __('basic.required') }})</small></label>

                                <input name="{{ $item->option_name }}" type="text"
                                    class="form-control @error($item->option_name) is-invalid @enderror"
                                    placeholder="Branch Name.." value="{{ $item->option_value }}">

                                @elseif ($item->option_name === 'currency')

                                <div class="col-12 mb-3">
                                    <label class="form-label text-capitalize">{{ __('basic.currency') }} <small>
                                            ({{ __('basic.required') }})</small></label>
                                    <select id="currency" class="js-example-basic-single form-control" name="currency"
                                        aria-hidden="true">
                                        @foreach ($currencies as $item_c)
                                        <option @if ($item->option_value == $item_c->id) selected @endif
                                            value="{{ $item_c->id }}">
                                            {{ $item_c->name . "-" . $item_c->code }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>

                                @else
                                <label class="form-label text-capitalize">{{ $item->option_name }}
                                    <small>({{ __('basic.required') }})</small></label>

                                <input name="{{ $item->option_name }}" type="text"
                                    class="form-control @error($item->option_name) is-invalid @enderror"
                                    placeholder="Branch Name.." value="{{ $item->option_value }}" required>
                                @endif

                                @error($item->option_name)
                                <span class="error-msg-form">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>

                            @endif


                            @endforeach

                            <div class="col-12 mb-3">
                                <label class="form-label text-capitalize">timeslotweekends<small>
                                        ({{ __('basic.optional') }})</small></label>
                                <select id="multiselect" class="js-example-basic-single form-control" multiple=""
                                    name="timeslotweekends[]" aria-hidden="true">
                                    <option @if (in_array('saturday', $weekends)) selected @endif value="saturday">
                                        {{ __('basic.saturday') }}
                                    </option>
                                    <option @if (in_array('sunday', $weekends)) selected @endif value="sunday"> {{
                                        __('basic.sunday') }}
                                    </option>
                                    <option @if (in_array('monday', $weekends)) selected @endif value="monday"> {{
                                        __('basic.monday') }}
                                    </option>
                                    <option @if (in_array('tuesday', $weekends)) selected @endif value="tuesday"> {{
                                        __('basic.tuesday') }}
                                    </option>
                                    <option @if (in_array('wednesday', $weekends)) selected @endif value="wednesday">
                                        {{ __('basic.wednesday') }}</option>
                                    <option @if (in_array('thursday', $weekends)) selected @endif value="thursday">
                                        {{ __('basic.thursday') }}
                                    </option>
                                    <option @if (in_array('friday', $weekends)) selected @endif value="friday"> {{
                                        __('basic.friday') }}
                                    </option>
                                </select>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end mt-4 mb-2">
                    <input type="submit" name="next" class="next-form-steps btn btn-primary action-button-next"
                        value="{{ __('basic.update') }}">
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
        var $validator = $('#myform').validate({
            rules: {
                name: {
                    minlength: 3,
                },
                address: {
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