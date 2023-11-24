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
        "positionClass": "toast-bottom-center",
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


@yield('js')

<!-- own script -->
<script src="{{ URL::asset('js/website.js') }}"></script>

<script>
    //--------------------- search engine ajax -------------------

    $(document).ready(function() {
        // Send Search Text to the server
        $("#search-eng_topbar").keyup(function() {
            let search_query = $(this).val();
            if (search_query != "") {

                var url = "{{ route('sett.pat_patient_search', ':id') }}";
                url = url.replace(':id', search_query);

                $.ajax({
                    url: url,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $("#search-eng-show-list_topbar").show();

                        if (data !== "") {
                            var html = ''
                            $.each(data, function(key, value) {

                                var url_show =
                                    "{{ route('sett.managers.show', ':id') }}";
                                url_show = url_show.replace(':id', value.id);

                                html +=
                                    '<a href="' + url_show +
                                    '" class="search-eng-a list-group-item list-group-item-action border-1 text-gray-500" style="cursor: pointer;"><i class="fas fa-search text-gray-200 me-2"></i> ' +
                                    value.full_name + '</a>';
                            });
                            $('#search-eng-show-list_topbar').html(html);
                        }

                        if (data == "") {
                            $('#search-eng-show-list_topbar').html(
                                '<a class="list-group-item list-group-item-action border-0"><i class="fas fa-search text-gray-200 me-2"></i>No Record</a>'
                            );
                        }
                    },
                });
            } else {
                $("#search-eng-show-list_topbar").empty();
                $("#search-eng-show-list_topbar").hide();;
            }
        });
        $("#search-eng_topbar_small").keyup(function() {
            let search_query = $(this).val();
            if (search_query != "") {

                var url = "{{ route('sett.pat_patient_search', ':id') }}";
                url = url.replace(':id', search_query);

                $.ajax({
                    url: url,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $("#search-eng-show-list_topbar_small").show();

                        if (data !== "") {
                            var html = ''
                            $.each(data, function(key, value) {

                                var url_show =
                                    "{{ route('sett.managers.show', ':id') }}";
                                url_show = url_show.replace(':id', value.id);

                                html +=
                                    '<a href="' + url_show +
                                    '" class="search-eng-a list-group-item list-group-item-action border-1 text-gray-500" style="cursor: pointer;"><i class="fas fa-search text-gray-200 me-2"></i> ' +
                                    value.full_name + '</a>';
                            });
                            $('#search-eng-show-list_topbar_small').html(html);
                        }

                        if (data == "") {
                            $('#search-eng-show-list_topbar_small').html(
                                '<a class="list-group-item list-group-item-action border-0"><i class="fas fa-search text-gray-200 me-2"></i>No Record</a>'
                            );
                        }
                    },
                });
            } else {
                $("#search-eng-show-list_topbar_small").empty();
                $("#search-eng-show-list_topbar_small").hide();;
            }
        });

        // chatboat

        // press enter on keyboad to send the chat
        $(".chatbot_send_msg_textarea").trigger('click');

            $(".chatbot_send_msg_textarea").keypress(function (e) {
            var code = (e.keyCode ? e.keyCode : e.which);
            //alert(code);
            if (code == 13) {
                send_chatboat_text();
            }

        });

        $(document).on('click', '.chatbot_send_msg_btn', function() {
            send_chatboat_text();
        })

        function send_chatboat_text() {

            var search_query = $('.chatbot_send_msg_textarea').val();

            avatar_url = '{{ URL::asset('img/useravatar') }}';

            bot_avatar_url = '{{ URL::asset('img/icons/avatar/chatbot_avatar.png') }}';

            var sender_msg = '<div class="d-flex flex-row justify-content-end p-3 pb-2">'+
                    '<div class="chat_sender">' + 
                        search_query +
                    '</div>' +
                    '<img class="chatbot_avatar" src=' + avatar_url + '/{{ Auth::user()->avatar }}>'
                '</div>';
                             
            $('.chatboat_body').append(sender_msg);
            $('.chatbot_send_msg_textarea').val('')

            if (search_query != "") {

                var url = "{{ route('sett.chatboat', ':id') }}";
                url = url.replace(':id', search_query);

                $.ajax({
                    url: url,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {

                        if (data !== "") {
                            var html = ''
                            console.log('www');

                            var url_show =
                                "{{ route('sett.managers.show', ':id') }}";
                            url_show = url_show.replace(':id', data.id);
                         
                            console.log(data);
                            html +=
                            '<div class="d-flex flex-row p-3 pb-2">'+
                                '<img class="chatbot_avatar" src="' + bot_avatar_url + '">' +
                                '<div class="chat_receiver">' + 
                                    data.result
                                '</div>' +
                            '</div>';
                             
                            $('.chatboat_body').append(html);
                        }

                        if (data == "") {
                            $('#chatboat_body').html(
                                '<a class="list-group-item list-group-item-action border-0"><i class="fas fa-search text-gray-200 me-2"></i>No Record</a>'
                            );
                        }
                    },
                });
            } else {
                console.log('wwwa');

                $("#search-eng-show-list_topbar").empty();
            }
            console.log('21212');

            $('.chatboat_body').scrollTop($('.chatboat_body')[0].scrollHeight);
            $(".chatboat_body").animate({ scrollTop: $('.chatboat_body').prop("scrollHeight")}, 1000);

        };


        


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
                case 'established_date':
                error.insertAfter($("#established_date-js_error_valid"));
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


<!-- select 2 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/js/select2.min.js"
    integrity="sha512-4MvcHwcbqXKUHB6Lx3Zb5CEAVoE9u84qN+ZSMM6s7z8IeJriExrV3ND5zRze9mxNlABJ6k864P/Vl8m0Sd3DtQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function() {
                $('.js-example-basic-single').select2({
                    // dropdownParent: $("#new_record"),
                });

                $('.js-example-basic-single_admin').select2({
                    dropdownParent: $("#add_new_administrator"),
                });

                $('.js-example-basic-single_admin_update').select2({
                    dropdownParent: $("#update_new_administrator"),
                });

                //hide search
                $('.select2-no-search').select2({
                    minimumResultsForSearch: -1
                });
    });
</script>

<!-- jquery ui datepicker -->
<script type="text/javascript"
    src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<script>
    $(function() {
            $('.hasdatetimepicker').datepicker({
                    todayHighlight: true,
                    format: "yyyy-mm-dd",
                }).on('change', function(){
                    $('.datepicker').hide();
                });
            });
</script>

{{-- data table --}}
<!-- -- datatables plugin -- -->
<script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js">
</script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.bootstrap5.min.js">
</script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js">
</script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js">
</script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
<script type="text/javascript" language="javascript"
    src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>

<script type="text/javascript" language="javascript"
    src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.colVis.min.js"></script>
<script
    src="https://nightly.datatables.net/fixedheader/js/dataTables.fixedHeader.js?_=f0de745b101295e88f1504c17177ff49">
</script>

<script>
    $(document).ready(function() {

                var table = $('#p-table').DataTable({
                lengthChange: false,
                "pageLength": 10,
                "language": {
                    "sProcessing": "جارٍ التحميل...",
                    "sLengthMenu": "أظهر _MENU_ مدخلات",
                    "sZeroRecords": "لم يعثر على أية سجلات",
                    "sInfo": "إظهار _START_ إلى _END_ من أصل _TOTAL_ مدخل",
                    "sInfoEmpty": "يعرض 0 إلى 0 من أصل 0 سجل",
                    "sInfoFiltered": "(منتقاة من مجموع _MAX_ مُدخل)",
                    "sInfoPostFix": "",
                    "sSearch": "ابحث:",
                    "sUrl": "",
                    "oPaginate": {
                        "sFirst": "الأول",
                        "sPrevious": "السابق",
                        "sNext": "التالي",
                        "sLast": "الأخير"
                    }
                },
                
                buttons: {
                    dom: {
                    button: {
                    className: 'btn btn-table-export me-0' //Primary class for all buttons
                    }
                    },
                    buttons: [{extend: 'copyHtml5',footer: true},
                    { extend: 'excelHtml5', footer: true },
                    // { extend: 'pdfHtml5', footer: true },
                    { extend: 'print', footer: true}
                    ]
                }
                }
                );
                table.buttons().container()
                .appendTo('#p-table_wrapper .col-md-6:eq(0)');



                var table = $('#p_2-table').DataTable({
                lengthChange: false,
                "pageLength": 10,
                "language": {
                    "sProcessing": "جارٍ التحميل...",
                    "sLengthMenu": "أظهر _MENU_ مدخلات",
                    "sZeroRecords": "لم يعثر على أية سجلات",
                    "sInfo": "إظهار _START_ إلى _END_ من أصل _TOTAL_ مدخل",
                    "sInfoEmpty": "يعرض 0 إلى 0 من أصل 0 سجل",
                    "sInfoFiltered": "(منتقاة من مجموع _MAX_ مُدخل)",
                    "sInfoPostFix": "",
                    "sSearch": "ابحث:",
                    "sUrl": "",
                    "oPaginate": {
                        "sFirst": "الأول",
                        "sPrevious": "السابق",
                        "sNext": "التالي",
                        "sLast": "الأخير"
                    }
                },
                buttons: {
                    dom: {
                    button: {
                    className: 'btn btn-table-export me-0' //Primary class for all buttons
                    }
                    },
                    buttons: [{extend: 'copyHtml5',footer: true},
                    { extend: 'excelHtml5', footer: true },
                    // { extend: 'pdfHtml5', footer: true },
                    { extend: 'print', footer: true}
                    ]
                }
                }
                );
                table.buttons().container()
                .appendTo('#p_2-table_wrapper .col-md-6:eq(0)');


                var table = $('#p_3-table').DataTable({
                lengthChange: false,
                "pageLength": 10,
                "language": {
                    "sProcessing": "جارٍ التحميل...",
                    "sLengthMenu": "أظهر _MENU_ مدخلات",
                    "sZeroRecords": "لم يعثر على أية سجلات",
                    "sInfo": "إظهار _START_ إلى _END_ من أصل _TOTAL_ مدخل",
                    "sInfoEmpty": "يعرض 0 إلى 0 من أصل 0 سجل",
                    "sInfoFiltered": "(منتقاة من مجموع _MAX_ مُدخل)",
                    "sInfoPostFix": "",
                    "sSearch": "ابحث:",
                    "sUrl": "",
                    "oPaginate": {
                        "sFirst": "الأول",
                        "sPrevious": "السابق",
                        "sNext": "التالي",
                        "sLast": "الأخير"
                    }
                },
                
                buttons: {
                    dom: {
                    button: {
                    className: 'btn btn-table-export me-0' //Primary class for all buttons
                    }
                    },
                    buttons: [{extend: 'copyHtml5',footer: true},
                    { extend: 'excelHtml5', footer: true },
                    // { extend: 'pdfHtml5', footer: true },
                    { extend: 'print', footer: true}
                    ]
                }
                }
                );
                table.buttons().container()
                .appendTo('#p_3-table_wrapper .col-md-6:eq(0)');
                
        });
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.js"
    integrity="sha512-K/oyQtMXpxI4+K0W7H25UopjM8pzq0yrVdFdG21Fh5dBe91I40pDd9A4lzNlHPHBIP2cwZuoxaUSX0GJSObvGA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    $(document).ready(function() {

        //-------- datepicker time --------
        $('.datepicker_time').flatpickr({
            mode: "range",
            enableTime: false,
            dateFormat: "Y-m-d",
            locale: {
                rangeSeparator: 'to'
            },
        });

    })
</script>

{{-- drop zone --}}
<script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>