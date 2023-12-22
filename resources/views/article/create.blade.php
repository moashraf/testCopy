@extends('layouts.master')

@section('title', 'New Articles')

@section('title-topbar', __('basic.new article'))

<!-- css insert -->
@section('css')

<!-- select 2 -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/css/select2.min.css"
    integrity="sha512-aD9ophpFQ61nFZP6hXYu4Q/b/USW7rpLCQLX6Bi0WJHXNO7Js/fUENpBQf/+P4NtpzNX0jSgR5zVvPOJp+W2Kg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
<link href="https://fastly.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
@endsection


<!-- content insert -->
@section('content')

<div class="container-fluid px-2 mt-3">

    <!-- page title link -->
    <div class="d-sm-flex align-items-center justify-content-between mb-3">
        <span class="mb-0">
            {{-- <a class="link-cust-text text-gray-200 fw-light" href="{{ route('sett.home') }}">Dashboard |</a> --}}
            <a class="link-cust-text text-gray-200 fw-light" href="{{ route('sett.article.index') }}">{{
                __('basic.articles') }}
                | </a>
            <a class="text-gray-300">{{ __('basic.new article') }} </a>
        </span>
    </div>

    <div class="card card-input shadow mb-3 pb-3">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 fw-bold text-gray-500"><i class="fas fa-plus me-2"></i> {{ __('basic.new article') }} </h6>
        </div>

        <!-- Card Body -->
        <div class="card-body px-4 px-md-5">

            <form id="myforminput" method="POST" action="{{ route('sett.article.store') }}"
                enctype="multipart/form-data">

                @csrf


                <div class="row mb-1">

                    <div class="col-12 col-md-5 align-self-center mb-2">

                        <div class="avatar-update-container">
                            <div class="picture">
                                <img src="{{ URL::asset('img/dashboard/avatars/default-file.png') }}"
                                    class="picture-src" id="mib_PicturePreview" title="" />
                                <input type="file" name='main_img' accept="image/*" id="mib_img_input" required>
                            </div>
                            <h6 class="text-gray-300">{{ __('basic.choose pic') }}</h6>

                            @error('main_img')
                            <span class="error-msg-form">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>


                    </div>


                    <div class="col-12 col-md-7 mb-2">
                        <div class="mb-3">
                            <label class="form-label"> {{ __('basic.name') }} <small>({{ __('basic.required')
                                    }})</small></label>
                            <input name="name" id="title_name" type="text"
                                class="form-control @error('name') is-invalid @enderror"
                                placeholder="Write the name here.." value="{{ old('name') }}" autofocus required>
                        </div>

                        @error('name')
                        <span class="error-msg-form">
                            {{ $message }}
                        </span>
                        @enderror

                        <div class="mb-3">
                            <label class="form-label">{{ __('basic.slug') }} <small>({{ __('basic.required')
                                    }})</small></label>
                            <input name="slug" id="slug_name" type="text"
                                class="form-control @error('slug') is-invalid @enderror"
                                placeholder="Write the slug here.." value="{{ old('slug') }}" required>
                        </div>
                        @error('slug')
                        <span class="error-msg-form">
                            {{ $message }}
                        </span>
                        @enderror

                    </div>

                    <div class="row mb-3">

                        <div class="col-12 mb-2">
                            <label class="form-label">{{ __('basic.tags') }}
                                <small>({{ __('basic.required') }})</small></label>
                            <select id="tags"
                                class="js-example-basic-single select2-hidden-accessible @error('tags') is-invalid @enderror"
                                name="tags[]" multiple required>
                                @foreach ($tags as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            <div id="tags-js-error-valid"></div>

                            @error('tags')
                            <span class="error-msg-form">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>

                    </div>

                    <div class="row mb-2 ">

                        <div class="col-12 col-md-6 mb-2">


                            <label class="form-label">{{ __('basic.short description') }}
                                <small>({{ __('basic.required') }})</small></label>
                            {{-- <textarea class="description"
                                name="description_ar">{{ old('description_ar') }}</textarea>
                            --}}

                            <textarea name="short_description" minlength="3" maxlength="150" class="form-control"
                                placeholder="Write your short description here.." rows="4"
                                spellcheck="false">{{ old('short_description') }}</textarea>
                            @error('short_description')
                            <span class="error-msg-form">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>

                        <div class="col-12 col-md-6 mb-2">

                            <label class="form-label">{{ __('basic.description') }} <small>({{ __('basic.required')
                                    }})</small></label>
                            <textarea class="description" name="description"
                                style="50% !importent">{{ old('description') }}</textarea>

                            @error('description')
                            <span class="error-msg-form">
                                {{ $message }}
                            </span>
                            @enderror

                        </div>

                        <div class="col-12 align-self-center mb-2">
                            <div id="">
                                <label class="form-label">{{ __('basic.choose images') }}
                                    <small>({{ __('basic.required') }})</small></label><br>
                                <input class="form-control file_dropzone_cuts" type="file" name="all_imgs[]"
                                    id="myGreatDropzone" multiple>
                                @error('all_imgs')
                                <span class="error-msg-form">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="d-flex justify-content-end mt-4 mb-2">
                            <input type="submit" name="next" class="next-form-steps btn btn-primary action-button-next"
                                value="{{ __('basic.send') }}">

                        </div>
                    </div>
            </form>

        </div>

    </div>
</div>

@endsection

<!-- js insert -->
@section('js')


<script src="https://fastly.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.js"></script>
<script>
    $('.description').summernote({
      placeholder: 'Enter Description',
      tabsize: 2,
      height: 100,
      toolbar: [
        ['style', ['style']],
        ['font', ['bold', 'underline', 'clear']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['insert', ['link', 'table', 'hr', 'video']],
        ['view', ['fullscreen', 'codeview', 'help']]
      ],
    });
</script>


<!-- select 2 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/js/select2.min.js"
    integrity="sha512-4MvcHwcbqXKUHB6Lx3Zb5CEAVoE9u84qN+ZSMM6s7z8IeJriExrV3ND5zRze9mxNlABJ6k864P/Vl8m0Sd3DtQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
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
                nameAr: {
                    maxlength: 50,
                },
                nameEn: {
                    maxlength: 50,
                },
                slugAr: {
                    maxlength: 50,
                },
                slugEn: {
                    maxlength: 50,
                }
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


        $("#title_name").keyup(function() {
            var text = $(this).val();
            text = text.toLowerCase();
            var regExp = /\s+/g;
            text = text.replace(regExp,'-');
            $("#slug_name").val(text);        
        });
</script>

@endsection