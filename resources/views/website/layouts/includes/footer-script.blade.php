<!-- bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
</script>

<!-- Toastr alert -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script>
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-bottom-left",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }

    @if (Session::has('success'))
        toastr.success("{{ Session::get('success') }}");
    @endif

    @if (Session::has('errors'))
        toastr.error("{{ session()->get('errors')->first() }}");
    @endif

    @if (Session::has('info'))
        toastr.info("{{ session('info') }}");
    @endif

    @if (Session::has('warning'))
        toastr.warning("{{ session('warning') }}");
    @endif
</script>


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

<!-- Validator plugin -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"
    integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    //Rules for the Validator plugin
    var $validator = $('#myform').validate({
        rules: {
            favorite_address: {
                maxlength: 50,
            },
            name_street: {
                maxlength: 50,
            },
            address_details: {
                maxlength: 50,
            },
            building_number: {
                maxlength: 50,
            },
            apartment_number: {
                maxlength: 50,
            },
            phone: {
                maxlength: 50,
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

    // translate the jquery validatpr
    jQuery.extend(jQuery.validator.messages, {
        required: "ناسف ولكن هذا الحقل مطلوب",
        remote: "برجاء اصلاح هذا الحقل",
        email: "يرجى إدخال عنوان بريد إلكتروني صالح",
        url: "برجاء ادخال رابط الكترونيا صحيحا",
        date: "برجاء ادخال تاريخ صحيح",
        dateISO: "برجاء ادخال تاريخ صحيح (ISO)",
        number: "برجاء ادخال رقم صحيحا.",
        digits: "الرجاء إدخال أرقام فقط",
        creditcard: "الرجاء إدخال رقم بطاقة ائتمان صالحة",
        equalTo: "من فظلك ادخل نفس القيمة مرة أخرى",
        accept: "الرجاء إدخال قيمة بملحق صالح",
        maxlength: jQuery.validator.format("برجاء ادخال قيمة اقل من {0} حرف او رقم."),
        minlength: jQuery.validator.format("يجب ادخال علي الاقل {0} رقم او حرف."),
        rangelength: jQuery.validator.format("برجاء ادخال قيمة بين {0} بين {1} رقم"),
        range: jQuery.validator.format("برجاء ادخال قيمة بين {0} و {1}."),
        max: jQuery.validator.format("برجاء ادخال قيمة اقل من {0}."),
        min: jQuery.validator.format("برجاء ادخال قيمة اعلي من {0}.")
    });
</script>

{{-- own script --}}
<script src="{{ asset('js/website.js') }}"></script>
@yield('js')