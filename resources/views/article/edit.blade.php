@extends('layouts.master')

@section('title', 'Edit articles')

@section('title-topbar', __('basic.edit article'))

<!-- css insert -->
@section('css')

<!-- select 2 -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/css/select2.min.css"
    integrity="sha512-aD9ophpFQ61nFZP6hXYu4Q/b/USW7rpLCQLX6Bi0WJHXNO7Js/fUENpBQf/+P4NtpzNX0jSgR5zVvPOJp+W2Kg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />


<link href="https://fastly.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">

@endsection


<!-- content insert -->
@section('content')

<div class="container-fluid px-2 mt-3">

    <!-- page title link -->
    <div class="d-sm-flex align-items-center justify-content-between">
        <span class="mb-0">
            <a class="link-cust-text text-gray-200 fw-light" href="{{ route('sett.article.index') }}">{{
                __('basic.articles') }}
                | </a>
            <a class="text-gray-300">{{ __('basic.edit article') }}</a>
        </span>
    </div>

    <!-- page title link -->
    <div class="d-sm-flex align-items-center justify-content-between mb-3">
        <span class="mb-0">
            {{-- <a class="link-cust-text text-gray-200 fw-light" href="{{ route('sett.home') }}">Dashboard |</a> --}}
            {{-- <a class="link-cust-text text-gray-200 fw-light" href="{{ route('sett.countries.index') }}">Countries |
            </a> --}}
            {{-- <a class="text-gray-300">Edit Countries</a> --}}
        </span>
    </div>

    <div class="card card-input shadow mb-3 pb-3">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 fw-bold text-gray-500"><i class="fas fa-pencil-alt"></i> {{ __('basic.edit article') }} </h6>
        </div>

        <!-- Card Body -->
        <div class="card-body px-4 px-md-5">

            <form id="myforminput" method="POST" action="{{ route('sett.article.update', $article->id) }}"
                enctype="multipart/form-data">
                {{ method_field('PUT') }}
                @csrf

                <div class="row mb-1">

                    <div class="row mb-2 ">
                        <div class="col-12 col-md-5 align-self-center mb-2">
                            <div class="avatar-update-container">
                                <div class="picture">
                                    <img src="{{ URL::asset('img/article/' . $article->main_img) }}" class="picture-src"
                                        id="mib_PicturePreview" title="" />
                                    <input type="file" name='main_img' accept="image/*" id="mib_img_input">
                                </div>
                                <h6 class="text-gray-300">{{ __('basic.choose pic') }}</h6>

                                @error('image')
                                <span class="error-msg-form">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-md-7 mb-2">

                            <div class="mb-3">
                                <label class="form-label"> {{ __('basic.name') }}<small>({{ __('basic.required')
                                        }})</small></label>
                                <input name="name" id="title_name" type="text"
                                    class="form-control @error('name') is-invalid @enderror"
                                    placeholder="Write the barnd name nrabic here.." value="{{ $article->name }}"
                                    autofocus>
                            </div>

                            @error('name')
                            <span class="error-msg-form">
                                {{ $message }}
                            </span>
                            @enderror

                            <label class="form-label">{{ __('basic.slug') }}<small>({{ __('basic.required')
                                    }})</small></label>
                            <input name="slug" id="slug_name" type="text"
                                class="form-control @error('slug') is-invalid @enderror"
                                placeholder="Write the slug arabic  here.." value="{{ $article->slug }}" required>

                            @error('slug_ar')
                            <span class="error-msg-form">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row">


                        <div class="col-12 mb-3">
                            <label class="form-label">{{ __('basic.tags') }}
                                <small>({{ __('basic.required') }})</small></label>
                            <select id="tags"
                                class="js-example-basic-single select2-hidden-accessible @error('tags') is-invalid @enderror"
                                name="tags[]" multiple required>
                                @foreach ($tags as $item)
                                <option @if (in_array($item->id, $article_tags))
                                    selected
                                    @endif value="{{ $item->id }}">{{ $item->name }}</option>
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
                </div>
                <hr>

                <div class="row mb-2 ">


                    <div class="col-12 col-md-6 mb-2">
                        <label class="form-label">{{ __('basic.short description') }} <small>({{ __('basic.required')
                                }})</small></label>
                        <textarea name="short_description" minlength="3" maxlength="150" class="form-control"
                            placeholder="Write here your description arabic .." rows="4"
                            spellcheck="false">{{ $article->short_description }}</textarea>
                        @error('short_description')
                        <span class="error-msg-form">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="col-12 col-md-6 mb-2">
                        <label class="form-label">{{ __('basic.description') }} <small>({{ __('basic.required')
                                }})</small></label>
                        <textarea class="description" name="description">{{ $article->description }}</textarea>

                        @error('description')
                        <span class="error-msg-form">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>


                    <div class="row">
                        @foreach ($article->imgs as $item)
                        <div class="col-12 col-md-3 mb-2 position-relative w-60 h-60">
                            <img src="{{ URL::asset('img/article/' . $item->img) }}" class="picture-src w-50 "
                                id="mib_PicturePreview" title="" style="height: 113px !important;" />
                            <a class="btn btn-danger position-absolute z-index-1" style="right:107px; opacity:70%;"
                                href="{{ route('sett.deleteImage_article', $item->id) }}"><i
                                    class="far fa-trash-alt"></i></a>
                        </div>
                        @endforeach

                    </div>


                    <div class="col-12 align-self-center mb-2">
                        <div>
                            <input class="form-control file_dropzone_cuts" type="file" name="all_imgs[]" id="inputImage"
                                multiple>
                            @error('all_imgs')
                            <span class="error-msg-form">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>



                    <div class="d-flex justify-content-end mt-4 mb-2">
                        <input type="submit" name="next" class="next-form-steps btn btn-primary action-button-next"
                            value="{{ __('basic.update') }}">
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
        ['insert', ['link']],
        ['view', ['fullscreen', 'codeview', 'help']]
      ]
    });
</script>



<!-- select 2 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/js/select2.min.js"
    integrity="sha512-4MvcHwcbqXKUHB6Lx3Zb5CEAVoE9u84qN+ZSMM6s7z8IeJriExrV3ND5zRze9mxNlABJ6k864P/Vl8m0Sd3DtQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script></script>
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


        $("#title_name").keyup(function() {
            var text = $(this).val();
            text = text.toLowerCase();
            var regExp = /\s+/g;
            text = text.replace(regExp,'-');
            $("#slug_name").val(text);        
        });
        });
        
</script>

<!-- validate jquery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"
    integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
{{-- <script>
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
</script> --}}


@endsection