<script>
    $(document).ready(function() {

        //------------------ start plugin ------------------

        //-------- select 2 --------
        $("#checked00").prop('checked', true);
        $(".myselect2-medicine-update").select2({
            dropdownParent: $("#medicine_edit")
        });

        $("#checked00").prop('checked', true);

        $(".myselect2-medicine-insert").select2({
            dropdownParent: $("#addmedic")
        });

        //hide search
        $('.myselect2-medicine-insert-nosearch').select2({
            dropdownParent: $("#addmedic"),
            minimumResultsForSearch: -1
        });

        $(".myselect2-medicine-update").select2({
            dropdownParent: $("#medicine_edit")
        });

        //hide search
        $('.select2-no-search-medicine').select2({
            dropdownParent: $("#medicine_edit"),
            minimumResultsForSearch: -1
        });

        $(".myselect2-disease-insert").select2({
            dropdownParent: $("#adddisease")
        });

        $(".myselect2-op-exp-insert").select2({
            dropdownParent: $("#add-pre-op")
        });


        $(".myselect2-disease-update").select2({
            dropdownParent: $("#disease_edit")
        });

        //hide search
        $('.select2-no-search-disease').select2({
            dropdownParent: $("#disease_edit"),
            minimumResultsForSearch: -1
        });

        $(".myselect2-treatment-insert").select2({
            dropdownParent: $("#addtreatment")
        });

        $(".myselect2-treatment-update").select2({
            dropdownParent: $("#treatment_edit")
        });

        //hide search
        $('.select2-no-search-treatment').select2({
            dropdownParent: $("#treatment_edit"),
            minimumResultsForSearch: -1
        });

        $(".myselect2-session-insert").select2({
            dropdownParent: $("#addsession")
        });

        $(".myselect2-session-insert-nosearch").select2({
            dropdownParent: $("#addsession"),
            minimumResultsForSearch: -1
        });

        $(".myselect2-session-update").select2({
            dropdownParent: $("#session_edit")
        });

        $(".myselect2-pulses-update").select2({
            dropdownParent: $("#pulses_edit")
        });

        //hide search
        $('.select2-no-search-session').select2({
            dropdownParent: $("#session_edit"),
            minimumResultsForSearch: -1
        });

        $(".myselect2-package-insert").select2({
            dropdownParent: $("#addpackage")
        });

        $(".myselect2-pulses-insert").select2({
            dropdownParent: $("#addpulses")
        });

        $(".myselect2-pulses-insert-nosearch").select2({
            dropdownParent: $("#addpulses"),
            minimumResultsForSearch: -1
        });

        $(".myselect2-pulses-update").select2({
            dropdownParent: $("#pulses_edit")
        });

        $(".myselect2-pulses-update-nosearch").select2({
            dropdownParent: $("#pulses_edit"),
            minimumResultsForSearch: -1
        });

        //hide search
        $('.select2-no-search-pulses').select2({
            dropdownParent: $("#pulses_edit"),
            minimumResultsForSearch: -1
        });

        $(".myselect2-lab-insert").select2({
            dropdownParent: $("#adddxـray")
        });

        //hide search
        $('.myselect2-lab-insert-nosearch').select2({
            dropdownParent: $("#adddxـray"),
            minimumResultsForSearch: -1
        });

        $(".myselect2-operation-insert").select2({
            dropdownParent: $("#add_operation")
        });

        //hide search
        $('.myselect2-oper-insert-nosearch').select2({
            dropdownParent: $("#add_operation"),
            minimumResultsForSearch: -1
        });

        //hide search
        $('.myselect2-operation-insert-nosearch').select2({
            dropdownParent: $("#edit_operation"),
            minimumResultsForSearch: -1
        });

        $(".myselect2-appo-insert").select2({
            dropdownParent: $("#add_past_app")
        });

        $(".myselect2-recom-insert").select2({
            dropdownParent: $("#edit_recom")
        });

        //hide search
        $('.myselect2-appo-insert-nosearch').select2({
            dropdownParent: $("#add_past_app"),
            minimumResultsForSearch: -1
        });

        //hide search
        $('.myselect2-wallet-insert-nosearch').select2({
            dropdownParent: $("#add_wallet"),
            minimumResultsForSearch: -1
        });

        $(".myselect2-appo-patient").select2({
            dropdownParent: $("#new_appo_patient")
        });

        //hide search
        $('.select2-no-search-appo-patient').select2({
            dropdownParent: $("#new_appo_patient"),
            minimumResultsForSearch: -1
        });

        $(".myselect2-operation-img-insert").select2({
            dropdownParent: $("#add_gallery"),
            minimumResultsForSearch: -1
        });

        //-------- datepicker time --------
        $('.datepicker_time').flatpickr({
            enableTime: true,
            dateFormat: "Y-m-d H:i",
        });

        //-------- jquery ui datepicker --------
        $(function() {
            $('.hasdatetimepicker').datepicker({
                todayHighlight: true,
                format: "yyyy-mm-dd",
            }).on('change', function(){
                $('.datepicker').hide();
            });
        });


        //-------- jquery ui datepicker --------

        //------ medicine table
        var table = $('#table-appointment').DataTable({
            lengthChange: false,
            buttons: {
                dom: {
                    button: {
                        className: 'btn btn-table-export me-0' //Primary class for all buttons
                    }
                },
                buttons: ['copy', 'excel', 'pdf', 'print']
            }
        });
        table.buttons().container()
            .appendTo('#table-appointment_wrapper .col-md-6:eq(0)');

        //------ disease table
        var table = $('#table-visa').DataTable({
                lengthChange: false,
                buttons: {
                    dom: {
                        button: {
                            className: 'btn btn-table-export me-0'
                        }
                    },
                    buttons: ['copy', 'excel', 'pdf', 'print']
                }
            }

        );
        table.buttons().container()
            .appendTo('#table-visa_wrapper .col-md-6:eq(0)');

        var table = $('#table-disease-exam').DataTable({
            lengthChange: false,

            buttons: {
                dom: {
                    button: {
                        className: 'btn btn-table-export me-0'
                    }
                },
                buttons: ['copy', 'excel', 'pdf']
            }
        });
        table.buttons().container()
            .appendTo('#table-disease-exam_wrapper .col-md-6:eq(0)');

        //------ treatment table
        var table = $('#table-treatment').DataTable({
                lengthChange: false,

                buttons: {
                    dom: {
                        button: {
                            className: 'btn btn-table-export me-0'
                        }
                    },
                    buttons: ['copy', 'excel', 'pdf']
                }
            }

        );
        table.buttons().container()
            .appendTo('#table-treatment_wrapper .col-md-6:eq(0)');

        //------ session table
        var table = $('#table-session').DataTable({
                lengthChange: false,

                buttons: {
                    dom: {
                        button: {
                            className: 'btn btn-table-export me-0'
                        }
                    },
                    buttons: ['copy', 'excel', 'pdf']
                }
            }

        );
        table.buttons().container()
            .appendTo('#table-session_wrapper .col-md-6:eq(0)');

        //------ bus table
        var table = $('#table-bus').DataTable({
                lengthChange: false,

                buttons: {
                    dom: {
                        button: {
                            className: 'btn btn-table-export me-0'
                        }
                    },
                    buttons: [{
                            extend: 'copyHtml5',
                            footer: true
                        },
                        {
                            extend: 'excelHtml5',
                            footer: true
                        },
                        {
                            extend: 'pdfHtml5',
                            footer: true
                        },
                        {
                            extend: 'print',
                            footer: true
                        }
                    ]
                }
            }

        );
        table.buttons().container()
            .appendTo('#table-bus_wrapper .col-md-6:eq(0)');


        //------ lab table
        var table = $('#table-hotel').DataTable({
                lengthChange: false,

                buttons: {
                    dom: {
                        button: {
                            className: 'btn btn-table-export me-0'
                        }
                    },
                    buttons: [{
                            extend: 'copyHtml5',
                            footer: true
                        },
                        {
                            extend: 'excelHtml5',
                            footer: true
                        },
                        {
                            extend: 'pdfHtml5',
                            footer: true
                        },
                        {
                            extend: 'print',
                            footer: true
                        }
                    ]
                }
            }

        );
        table.buttons().container()
            .appendTo('#table-hotel_wrapper .col-md-6:eq(0)');

        var table = $('#table-trip').DataTable({
                lengthChange: false,
            buttons: {
                dom: {
                    button: {
                        className: 'btn btn-table-export me-0'
                    }
                },
                buttons: [{
                        extend: 'copyHtml5',
                        footer: true
                    },
                    {
                        extend: 'excelHtml5',
                        footer: true
                    },
                    {
                        extend: 'pdfHtml5',
                        footer: true
                    },
                    {
                        extend: 'print',
                        footer: true
                    }
                ]
            }
            }
        );
        table.buttons().container()
            .appendTo('#table-trip_wrapper .col-md-6:eq(0)');

            var table = $('#table-package').DataTable({
                lengthChange: false,

                buttons: {
                    dom: {
                        button: {
                            className: 'btn btn-table-export me-0'
                        }
                    },
                    buttons: ['copy', 'excel', 'pdf', 'print'],
                }
            }

        );
        table.buttons().container()
            .appendTo('#table-package_wrapper .col-md-6:eq(0)');

        //------ appointment table
        var table = $('#table-airline').DataTable({
                lengthChange: false,

                buttons: {
                    dom: {
                        button: {
                            className: 'btn btn-table-export me-0'
                        }
                    },
                    buttons: [{
                            extend: 'copyHtml5',
                            footer: true
                        },
                        {
                            extend: 'excelHtml5',
                            footer: true
                        },
                        {
                            extend: 'pdfHtml5',
                            footer: true
                        },
                        {
                            extend: 'print',
                            footer: true
                        }
                    ]
                }
            }

        );
        table.buttons().container()
            .appendTo('#table-airline_wrapper .col-md-6:eq(0)');

        //------ operation table
        var table = $('#table-operation').DataTable({
            lengthChange: false,
            buttons: {
                dom: {
                    button: {
                        className: 'btn btn-table-export me-0'
                    }
                },
                buttons: ['copy', 'excel', 'pdf']
            }
        });
        table.buttons().container()
            .appendTo('#table-operation_wrapper .col-md-6:eq(0)');

        //------ payment table
        var table = $('#table-payment').DataTable({
                lengthChange: false,
                buttons: {
                    dom: {
                        button: {
                            className: 'btn btn-table-export me-0'
                        }
                    },
                    buttons: ['copy', 'excel', 'pdf']
                }
            }

        );
        table.buttons().container()
            .appendTo('#table-payment_wrapper .col-md-6:eq(0)');


        //------ payment table
        var table = $('#table-wallet').DataTable({
                lengthChange: false,
                buttons: {
                    dom: {
                        button: {
                            className: 'btn btn-table-export me-0'
                        }
                    },
                    buttons: ['copy', 'excel', 'pdf']
                }
            }

        );
        table.buttons().container()
            .appendTo('#table-wallet_wrapper .col-md-6:eq(0)');

        //------ workers table
        var table = $('#table-workers').DataTable({
            lengthChange: false,
            buttons: {
                dom: {
                    button: {
                        className: 'btn btn-table-export me-0' //Primary class for all buttons
                    }
                },
                buttons: ['copy', 'excel', 'pdf', 'print']
            }
        });
        table.buttons().container()
            .appendTo('#table-workers_wrapper .col-md-6:eq(0)');

        //------------------ end plugin ------------------


        //-------- patient id --------
        var id = '{{ $patient->id }}';


        //------------------ update note ------------------

        $(document).on('click', '#note_ajax', function() {

            var query_text = $("textarea[name='note']").val();

            var url = "{{ route('sett.pat_note_ajax', ':id') }}";
            url = url.replace(':id', id);

            $.ajax({
                url: url,
                type: "POST",
                data: {
                    '_token': "{{ csrf_token() }}",
                    '_method': "PATCH",
                    'query': query_text,
                },
                success: function(data) {}
            });
        });


        //------------------ drawing func for inserting new examination ------------------

        var $canvas = $('#canvas');
        var $canvas_b = $('#canvas_b');
        var ctx = $canvas[0].getContext('2d');
        var ctx_b = $canvas_b[0].getContext('2d');
        var color = '#000000';
        var color_b = '#000000';

        $('.color-selector-draw').on('click', function(e) {
            color = $(this).data('color');
        });

        $('.color-selector-draw_b').on('click', function(e) {
            color_b = $(this).data('color');
        });

        //---- front draw ----
        $(document).ready(function() {
            var flag, dot_flag = false,
                prevX, prevY, currX, currY = 0,
                thickness = 4;

            $canvas.on('mousemove mousedown mouseup mouseout', function(e) {
                prevX = currX;
                prevY = currY;
                currX = e.clientX - canvas.getBoundingClientRect().left;
                currY = e.clientY - canvas.getBoundingClientRect().top;

                if (e.type == 'mousedown') {
                    flag = true;
                }
                if (e.type == 'mouseup' || e.type == 'mouseout') {
                    flag = false;
                }
                if (e.type == 'mousemove') {
                    if (flag) {
                        ctx.beginPath();
                        ctx.moveTo(prevX, prevY);
                        ctx.lineTo(currX, currY);
                        ctx.strokeStyle = color;
                        ctx.lineWidth = thickness;
                        ctx.stroke();
                        ctx.closePath();
                    }
                }
            });
        });

        // Set up touch events for mobile, etc
        canvas.addEventListener("touchstart", function(e) {
            mousePos = getTouchPos(canvas, e);
            var touch = e.touches[0];
            var mouseEvent = new MouseEvent("mousedown", {
                clientX: touch.clientX,
                clientY: touch.clientY
            });
            canvas.dispatchEvent(mouseEvent);
        }, false);
        canvas.addEventListener("touchend", function(e) {
            var mouseEvent = new MouseEvent("mouseup", {});
            canvas.dispatchEvent(mouseEvent);
        }, false);
        canvas.addEventListener("touchmove", function(e) {
            var touch = e.touches[0];
            var mouseEvent = new MouseEvent("mousemove", {
                clientX: touch.clientX,
                clientY: touch.clientY
            });
            canvas.dispatchEvent(mouseEvent);
        }, false);

        // Get the position of a touch relative to the canvas
        function getTouchPos(canvasDom, touchEvent) {
            var rect = canvasDom.getBoundingClientRect();
            return {
                x: touchEvent.touches[0].clientX - rect.left,
                y: touchEvent.touches[0].clientY - rect.top
            };
        }

        //Prevent scrolling when touching the canvas
        document.body.addEventListener("touchstart", function(e) {
            if (e.target == canvas) {
                e.preventDefault();
            }
        }, false);
        document.body.addEventListener("touchend", function(e) {
            if (e.target == canvas) {
                e.preventDefault();
            }
        }, false);
        document.body.addEventListener("touchmove", function(e) {
            if (e.target == canvas) {
                e.preventDefault();
            }
        }, false);


        //---- back draw ----
        $(document).ready(function() {
            var flag, dot_flag = false,
                prevX, prevY, currX, currY = 0,
                thickness = 4;

            $canvas_b.on('mousemove mousedown mouseup mouseout', function(e) {
                prevX = currX;
                prevY = currY;
                currX = e.clientX - canvas_b.getBoundingClientRect().left;
                currY = e.clientY - canvas_b.getBoundingClientRect().top;

                if (e.type == 'mousedown') {
                    flag = true;
                }
                if (e.type == 'mouseup' || e.type == 'mouseout') {
                    flag = false;
                }
                if (e.type == 'mousemove') {
                    if (flag) {
                        ctx_b.beginPath();
                        ctx_b.moveTo(prevX, prevY);
                        ctx_b.lineTo(currX, currY);
                        ctx_b.strokeStyle = color_b;
                        ctx_b.lineWidth = thickness;
                        ctx_b.stroke();
                        ctx_b.closePath();
                    }
                }
            });

            // Set up touch events for mobile, etc
            canvas_b.addEventListener("touchstart", function(e) {
                mousePos = getTouchPos(canvas_b, e);
                var touch = e.touches[0];
                var mouseEvent = new MouseEvent("mousedown", {
                    clientX: touch.clientX,
                    clientY: touch.clientY
                });
                canvas_b.dispatchEvent(mouseEvent);
            }, false);
            canvas_b.addEventListener("touchend", function(e) {
                var mouseEvent = new MouseEvent("mouseup", {});
                canvas_b.dispatchEvent(mouseEvent);
            }, false);
            canvas_b.addEventListener("touchmove", function(e) {
                var touch = e.touches[0];
                var mouseEvent = new MouseEvent("mousemove", {
                    clientX: touch.clientX,
                    clientY: touch.clientY
                });
                canvas_b.dispatchEvent(mouseEvent);
            }, false);

            // Get the position of a touch relative to the canvas
            function getTouchPos(canvasDom, touchEvent) {
                var rect = canvasDom.getBoundingClientRect();
                return {
                    x: touchEvent.touches[0].clientX - rect.left,
                    y: touchEvent.touches[0].clientY - rect.top
                };
            }

            //Prevent scrolling when touching the canvas
            document.body.addEventListener("touchstart", function(e) {
                if (e.target == canvas_b) {
                    e.preventDefault();
                }
            }, false);
            document.body.addEventListener("touchend", function(e) {
                if (e.target == canvas_b) {
                    e.preventDefault();
                }
            }, false);
            document.body.addEventListener("touchmove", function(e) {
                if (e.target == canvas_b) {
                    e.preventDefault();
                }
            }, false);

        });

        $('#canvas-clear').on('click', function(e) {
            c_width = $canvas.width();
            c_height = $canvas.height();
            ctx.clearRect(0, 0, c_width, c_height);
            $('#canvasimg').hide();
        });


        $('#canvas-clear_b').on('click', function(e) {
            c_width_b = $canvas_b.width();
            c_height_b = $canvas_b.height();
            ctx_b.clearRect(0, 0, c_width_b, c_height_b);
            $('#canvasimg_b').hide();
        });

        //save the canv draw to input
        $('#imgsave').on('click', function(e) {

            //var image = canvas.toDataURL("image/png").replace("image/png",); // here is the most important part because if you dont replace you will get a DOM 18 exception.
            var image = new Image();
            image.src = canvas.toDataURL("image/png");

            //document.getElementById("finalImg").src = image.src;
            document.getElementById("front_input").value = image.src;

            //change the save icon
            $('#icon_save').addClass('fa-check-double').removeClass('fa-check');

        });

        //save the canv draw to input
        $('#imgsave_b').on('click', function(e) {

            var image_b = new Image();
            image_b.src = canvas_b.toDataURL("image/png");
            document.getElementById("back_input").value = image_b.src;

            //change the save icon
            $('#icon_save_b').addClass('fa-check-double').removeClass('fa-check');
        });


        //------------------ drawing func for inserting new examination in appointment ------------------

        var $canvas_appo = $('#canvas_appo');
        var $canvas_b_appo = $('#canvas_b_appo');
        var ctx_appo = $canvas_appo[0].getContext('2d');
        var ctx_b_appo = $canvas_b_appo[0].getContext('2d');
        var color = '#000000';
        var color_b = '#000000';

        $('.color-selector-draw').on('click', function(e) {
            color = $(this).data('color');
        });

        $('.color-selector-draw_b').on('click', function(e) {
            color_b = $(this).data('color');
        });

        //---- front draw ----
        $(document).ready(function() {
            var flag, dot_flag = false,
                prevX, prevY, currX, currY = 0,
                thickness = 4;

            $canvas_appo.on('mousemove mousedown mouseup mouseout', function(e) {
                prevX = currX;
                prevY = currY;
                currX = e.clientX - canvas_appo.getBoundingClientRect().left;
                currY = e.clientY - canvas_appo.getBoundingClientRect().top;

                if (e.type == 'mousedown') {
                    flag = true;
                }
                if (e.type == 'mouseup' || e.type == 'mouseout') {
                    flag = false;
                }
                if (e.type == 'mousemove') {
                    if (flag) {
                        ctx_appo.beginPath();
                        ctx_appo.moveTo(prevX, prevY);
                        ctx_appo.lineTo(currX, currY);
                        ctx_appo.strokeStyle = color;
                        ctx_appo.lineWidth = thickness;
                        ctx_appo.stroke();
                        ctx_appo.closePath();
                    }
                }
            });
        });

        // Set up touch events for mobile, etc
        canvas_appo.addEventListener("touchstart", function(e) {
            mousePos = getTouchPos(canvas_appo, e);
            var touch = e.touches[0];
            var mouseEvent = new MouseEvent("mousedown", {
                clientX: touch.clientX,
                clientY: touch.clientY
            });
            canvas_appo.dispatchEvent(mouseEvent);
        }, false);
        canvas_appo.addEventListener("touchend", function(e) {
            var mouseEvent = new MouseEvent("mouseup", {});
            canvas_appo.dispatchEvent(mouseEvent);
        }, false);
        canvas_appo.addEventListener("touchmove", function(e) {
            var touch = e.touches[0];
            var mouseEvent = new MouseEvent("mousemove", {
                clientX: touch.clientX,
                clientY: touch.clientY
            });
            canvas_appo.dispatchEvent(mouseEvent);
        }, false);

        // Get the position of a touch relative to the canvas
        function getTouchPos(canvasDom, touchEvent) {
            var rect = canvasDom.getBoundingClientRect();
            return {
                x: touchEvent.touches[0].clientX - rect.left,
                y: touchEvent.touches[0].clientY - rect.top
            };
        }

        //Prevent scrolling when touching the canvas
        document.body.addEventListener("touchstart", function(e) {
            if (e.target == canvas_appo) {
                e.preventDefault();
            }
        }, false);
        document.body.addEventListener("touchend", function(e) {
            if (e.target == canvas_appo) {
                e.preventDefault();
            }
        }, false);
        document.body.addEventListener("touchmove", function(e) {
            if (e.target == canvas_appo) {
                e.preventDefault();
            }
        }, false);


        //---- back draw ----
        $(document).ready(function() {
            var flag, dot_flag = false,
                prevX, prevY, currX, currY = 0,
                thickness = 4;

            $canvas_b_appo.on('mousemove mousedown mouseup mouseout', function(e) {
                prevX = currX;
                prevY = currY;
                currX = e.clientX - canvas_b_appo.getBoundingClientRect().left;
                currY = e.clientY - canvas_b_appo.getBoundingClientRect().top;

                if (e.type == 'mousedown') {
                    flag = true;
                }
                if (e.type == 'mouseup' || e.type == 'mouseout') {
                    flag = false;
                }
                if (e.type == 'mousemove') {
                    if (flag) {
                        ctx_b_appo.beginPath();
                        ctx_b_appo.moveTo(prevX, prevY);
                        ctx_b_appo.lineTo(currX, currY);
                        ctx_b_appo.strokeStyle = color_b;
                        ctx_b_appo.lineWidth = thickness;
                        ctx_b_appo.stroke();
                        ctx_b_appo.closePath();
                    }
                }
            });

            // Set up touch events for mobile, etc
            canvas_b_appo.addEventListener("touchstart", function(e) {
                mousePos = getTouchPos(canvas_b_appo, e);
                var touch = e.touches[0];
                var mouseEvent = new MouseEvent("mousedown", {
                    clientX: touch.clientX,
                    clientY: touch.clientY
                });
                canvas_b_appo.dispatchEvent(mouseEvent);
            }, false);
            canvas_b_appo.addEventListener("touchend", function(e) {
                var mouseEvent = new MouseEvent("mouseup", {});
                canvas_b_appo.dispatchEvent(mouseEvent);
            }, false);
            canvas_b_appo.addEventListener("touchmove", function(e) {
                var touch = e.touches[0];
                var mouseEvent = new MouseEvent("mousemove", {
                    clientX: touch.clientX,
                    clientY: touch.clientY
                });
                canvas_b_appo.dispatchEvent(mouseEvent);
            }, false);

            // Get the position of a touch relative to the canvas
            function getTouchPos(canvasDom, touchEvent) {
                var rect = canvasDom.getBoundingClientRect();
                return {
                    x: touchEvent.touches[0].clientX - rect.left,
                    y: touchEvent.touches[0].clientY - rect.top
                };
            }

            //Prevent scrolling when touching the canvas
            document.body.addEventListener("touchstart", function(e) {
                if (e.target == canvas_b_appo) {
                    e.preventDefault();
                }
            }, false);
            document.body.addEventListener("touchend", function(e) {
                if (e.target == canvas_b_appo) {
                    e.preventDefault();
                }
            }, false);
            document.body.addEventListener("touchmove", function(e) {
                if (e.target == canvas_b_appo) {
                    e.preventDefault();
                }
            }, false);

        });

        $('#canvas-clear_appo').on('click', function(e) {
            c_width_appo = $canvas_appo.width();
            c_height_appo = $canvas_appo.height();
            ctx_appo.clearRect(0, 0, c_width_appo, c_height_appo);
            $('#canvasimg').hide();
        });

        $('#canvas-clear_b_appo').on('click', function(e) {
            c_width_b_appo = $canvas_b_appo.width();
            c_height_b_appo = $canvas_b_appo.height();
            ctx_b_appo.clearRect(0, 0, c_width_b_appo, c_height_b_appo);
            $('#canvasimg_b').hide();
        });

        //save the canv draw to input
        $('#imgsave_appo').on('click', function(e) {

            //var image = canvas.toDataURL("image/png").replace("image/png",); // here is the most important part because if you dont replace you will get a DOM 18 exception.
            var image_appo = new Image();
            image_appo.src = canvas_appo.toDataURL("image/png");

            //document.getElementById("finalImg").src = image.src;
            document.getElementById("front_input_appo").value = image_appo.src;

            //change the save icon
            $('#icon_save_appo').addClass('fa-check-double').removeClass('fa-check');

        });

        //save the canv draw to input
        $('#imgsave_b_appo').on('click', function(e) {

            var image_b_appo = new Image();
            image_b_appo.src = canvas_b_appo.toDataURL("image/png");
            document.getElementById("back_input_appo").value = image_b_appo.src;

            //change the save icon
            $('#icon_save_b_appo').addClass('fa-check-double').removeClass('fa-check');
        });




        // ----------------- modals -----------------

        //for examination from operation or normal examinaion
        $(".add_exam_modal").on('click', function() {

            var type = $(this).data("type");
            var id = $(this).data("id");

            $('.modal').modal('hide');

            if (type === 'ex') {
                $('#exam-op-appointment').show();
                $('#last_appointment_id_op_app').prop("disabled", false);
            } else {
                $('#exam-op-appointment').hide();
                $('#last_appointment_id_op_app').prop("disabled", true);
                $('input[name="exam-op-id"]').val(id);
            }

            $('#adddisease').modal('show');
        });

        //for examination from operation or normal examinaion
        $(".add_op_during_modal").on('click', function() {
            var id = $(this).data("id");

            $('.modal').modal('hide');

            $('input[name="during-op-id"]').val(id);

            $('#add_during_op').modal('show');
        });


        //for examination from operation or normal examinaion
        $(".add_op_gallery_modal").on('click', function() {
            var id = $(this).data("id");
            $('.modal').modal('hide');
            $('input[name="gallery-op-id"]').val(id);
            $('#add_gallery').modal('show');
        });

        //delete gallery img
        $(document).on('click', ".op_img_delete_click", function() {
            var id = $(this).data("img_id");
            $('input[name = "opertion_id_op_delete"]').val(id);
            $('.modal').modal('hide');
            $('#op_gallery_img_delete').modal('show');
        });

        //disease modals edit
        $(document).on('click', ".disease_edit_click", function() {

            var disease_id = $(this).data("disease_id");

            var diseasecats_id = $(this).data("diseasecats_id");
            var status_disease = $(this).data("status_disease");
            var start = $(this).data("start");
            var end = $(this).data("end");

            $("#disease_cat_update").select2("val", String(diseasecats_id));

            $("#status_disease_update").select2("val", String(status_disease));

            $('input[name = "disease_start_update"]').val(start);
            $('input[name = "disease_end_update"]').val(end);
            $('input[name = "disease_id_update"]').val(disease_id);

            $('.modal').modal('hide');
            $('#disease_edit').modal('show');

        });

        //disease modals delete
        $(document).on('click', ".disease_delete_click", function() {

            var disease_id = $(this).data("disease_id");

            $('input[name = "disease_id_delete"]').val(disease_id);

            $('.modal').modal('hide');
            $('#disease_delete').modal('show');

        });

        // ----------------- treatment modals -----------------
        //treatment modals edit
        $(".treatment_edit_click").on('click', function() {

            var treatment_id = $(this).data("treatment_id");

            var treatment_cat_id = $(this).data("treatment_cat_id");
            var status_treatment = $(this).data("status_treatment");
            var sessions = $(this).data("sessions");
            var sessions_done = $(this).data("sessions_done");
            var start = $(this).data("start");
            var end = $(this).data("end");

            $("#treatment_cat_update").select2("val", String(treatment_cat_id));

            $("#status_treatment_update").select2("val", String(status_treatment));

            $('input[name = "treatment_session_update"]').val(sessions);
            $('input[name = "treatment_session_done_update"]').val(sessions_done);
            $('input[name = "treatment_start_update"]').val(start);
            $('input[name = "treatment_end_update"]').val(end);
            $('input[name = "treatment_id_update"]').val(treatment_id);

            $('.modal').modal('hide');
            $('#treatment_edit').modal('show');

        });

        $(".treatment_newsession_click").on('click', function() {

            var treatment_id = $(this).data("treatment_id");
            $('#related_treatment_id').select2("val", String(treatment_id));

            $('.modal').modal('hide');
            $('#addsession').modal('show');

        });


        //treatment modals delete
        $(".treatment_delete_click").on('click', function() {

            var treatment_id = $(this).data("treatment_id");

            $('input[name = "treatment_id_delete"]').val(treatment_id);

            $('.modal').modal('hide');
            $('#treatment_delete').modal('show');

        });


        // ----------------- session modals -----------------

        //session modals edit
        $(".session_edit_click").on('click', function() {

            var session_id = $(this).data("session_id");
            var status_session = $(this).data("status_session");
            var treat_id = $(this).data("treat_id");

            $("#status_session_update").select2("val", String(status_session));
            $("#related_treatment_id_update").select2("val", String(treat_id));

            $('input[name = "session_id_update"]').val(session_id);

            $('.modal').modal('hide');
            $('#session_edit').modal('show');
        });

        //session modals delete
        $(".session_delete_click").on('click', function() {

            var session_id = $(this).data("session_id");

            $('input[name = "session_id_delete"]').val(session_id);

            $('.modal').modal('hide');
            $('#session_delete').modal('show');

        });

        // ----------------- pulses modals -----------------

        //pulses modals edit
        $(".pulses_edit_click").on('click', function() {
            var id = $(this).data("id");
            var fluence = $(this).data("fluence");
            var pulse_area_id = $(this).data("pulse_area_id");
            var spot_size = $(this).data("spot_size");
            var used_pulses = $(this).data("used_pulses");

            $("#pulse_area_id_update").select2("val", String(pulse_area_id));
            $("#fluence_update_id").select2("val", String(fluence));
            $("#spot_size_update_id").select2("val", String(spot_size));

            $('input[name = "pulses_id_update"]').val(id);
            $('input[name = "used_pulses_update"]').val(used_pulses);

            $('.modal').modal('hide');
            $('#pulses_edit').modal('show');
        });

        //pulses modals delete
        $(".pulses_delete_click").on('click', function() {

            var id = $(this).data("id");

            $('input[name = "pulses_id_delete"]').val(id);

            $('.modal').modal('hide');
            $('#pulses_delete').modal('show');

        });


        //package modals delete
        $(".package_delete_click").on('click', function() {

            var id = $(this).data("id");

            $('input[name = "package_id_delete"]').val(id);

            $('.modal').modal('hide');
            $('#package_delete').modal('show');

        });

        // ----------------- mediciens modals -----------------

        //mediciens modals edit
        $(".medicine_edit_click").on('click', function() {

            var medicine_id = $(this).data("medicine_id");

            var medicinescats_id = $(this).data("medicinescats_id");
            var status_medicine = $(this).data("status_medicine");
            var start = $(this).data("start");
            var end = $(this).data("end");

            $("#medicine_pills_update").select2("val", String(medicinescats_id));

            $("#status_medicine_update").select2("val", String(status_medicine));

            $('input[name = "medicine_start_update"]').val(start);
            $('input[name = "medicine_end_update"]').val(end);
            $('input[name = "medicine_id_update"]').val(medicine_id);

            $('.modal').modal('hide');
            $('#medicine_edit').modal('show');

        });

        //mediciens modals delete
        $(".medicine_delete_click").on('click', function() {

            var medicine_id = $(this).data("medicine_id");

            $('input[name = "medicine_id_delete"]').val(medicine_id);

            $('.modal').modal('hide');
            $('#medicine_delete').modal('show');

        });

        // ----------------- Lab modals -----------------

        //lab modals delete
        $(".lab_delete_click").on('click', function() {

            var lab_id = $(this).data("lab_id");
            var invoice_id = $(this).data("invoice_id");

            $('input[name = "lab_id_delete"]').val(lab_id);
            $('input[name = "lab_invoice_id_delete"]').val(invoice_id);

            $('.modal').modal('hide');
            $('#lab_delete').modal('show');

        });


        // ----------------- operation modals -----------------

        //operation modals edit
        $(".operation_edit_click").on('click', function() {

            var operation_id = $(this).data("operation_id");
            var status_operation = $(this).data("status_operation");
            var note_operation = $(this).data("note_operation");
            var improvment_operation = $(this).data("improvement_rate");

            $('input[name = "operation_id_update"]').val(operation_id);
            $('textarea[name = "note_operation_up"]').val(note_operation);
            $('input[name = "operation_improvment_up"]').val(improvment_operation);
            $("#oper_status_up").select2("val", String(status_operation));

            $('.modal').modal('hide');
            $('#edit_operation').modal('show');
        });

        //session modals delete
        $(".operation_delete_click").on('click', function() {

            var session_id = $(this).data("operation_id");

            $('input[name = "opertion_id_delete"]').val(session_id);

            $('.modal').modal('hide');
            $('#operation_delete').modal('show');

        });

        // ----------------- appontment modals -----------------

        //lab modals delete
        $(".appointment_note_click").on('click', function() {

            var id = $(this).data("id");
            var note = $(this).data("note_doctor");

            $('input[name = "note_appointment_id"]').val(id);
            $('#appointment_note_input').val(note);

            $('.modal').modal('hide');
            $('#appointment_note').modal('show');
        });

        // ----------------- new patients info modals for existing appointment -----------------
        $(".add_info_exsit_appo").on('click', function() {

            $('#flash-msg-hide').hide();

            $('#exist_appointment_id_input').prop('disabled', false);

            $('#patient_add_info_old_appo').hide();
            $('#patient_add_info_exist_appo').show();
            $('.modal').modal('hide');
            $('#new_appo_patient').modal('show');
        });

        $(".add_info_old_appo").on('click', function() {

            $('#flash-msg-hide').hide();

            $('#exist_appointment_id_input').prop('disabled', true);

            $('#patient_add_info_exist_appo').hide();
            $('#patient_add_info_old_appo').show();
            $('.modal').modal('hide');
            $('#new_appo_patient').modal('show');
        });

        //for pulses
        $("#pulses_type").on('change', function() {
            var type = $(this).val();

            //for session
            if (type == 0 || type == 1) {
                $('#pulses_no_balance').hide();
                $('#invoice_area_pulses').show();
                $('#pulses_serv_item_sess_cont').show();
                $('#pulses_serv_item_package_cont').hide();
                $('#pulses_details_cont').show();
                $('#sessions_serv_item_package_cont').hide();
                $('#patient_balance_cont').hide();
                $('#pulses_record_cont').show();
                $('#free_session_price_cont').hide();
                //----
                $('input[name=fluence]').prop('disabled', false);
                $('input[name=spot_size]').prop('disabled', false);
                $('input[name=used_pulses]').prop('disabled', false);
                $('#pulses_cat_invoice_insert').prop('disabled', false);
                $('#machine_id').prop('disabled', false);
                $('#session_serv_item_package').prop('disabled', true);
                $('#pulses_record').prop('disabled', false);
                $('#free_session_price').prop('disabled', true);
                if (type == 1) {
                    $('#pulses_serv_item_sess_cont').hide();
                }
            }
            //for the package
            else if (type == 2) {
                if ($('#session_serv_item_package').has('option').length > 0) {
                    $('#pulses_no_balance').hide();
                    $('#invoice_area_pulses').hide();
                    $('#pulses_serv_item_sess_cont').hide();
                    $('#sessions_serv_item_package_cont').show();
                    $('#pulses_details_cont').show();
                    $('#patient_balance_cont').hide();
                    $('#pulses_record_cont').hide();
                    $('#free_session_price_cont').hide();
                    //----
                    $('input[name=fluence]').prop('disabled', false);
                    $('input[name=spot_size]').prop('disabled', false);
                    $('input[name=used_pulses]').prop('disabled', false);
                    $('#machine_id').prop('disabled', false);
                    $('#session_serv_item_package').prop('disabled', false);
                    $('#pulses_cat_invoice_insert').prop('disabled', true);
                    $('#pulses_record').prop('disabled', true);
                    $('#free_session_price').prop('disabled', true);
                } else {
                    $('#invoice_area_pulses').hide();
                    $('#pulses_serv_item_sess_cont').hide();
                    $('#pulses_serv_item_package_cont').hide();
                    $('#pulses_details_cont').hide();
                    $('#pulses_no_balance').show();
                    $('#pulses_record_cont').hide();
                }
            }
            //for used package
            else if (type == 3) {
                var balance = $('#pt_puls_balance').val();

                if (balance > 0) {
                    $('#pulses_no_balance').hide();
                    $('#invoice_area_pulses').hide();
                    $('#pulses_serv_item_sess_cont').hide();
                    $('#pulses_serv_item_package_cont').hide();
                    $('#pulses_details_cont').show();
                    $('#patient_balance_cont').show();
                    $('#sessions_serv_item_package_cont').hide();
                    $('#pulses_record_cont').hide();
                    $('#free_session_price_cont').hide();
                    //----
                    $('input[name=fluence]').prop('disabled', false);
                    $('input[name=spot_size]').prop('disabled', false);
                    $('input[name=used_pulses]').prop('disabled', false);
                    $('#machine_id').prop('disabled', false);
                    $('#pulses_cat_invoice_insert').prop('disabled', true);
                    $('#pulses_record').prop('disabled', true);
                    $('#free_session_price').prop('disabled', true);

                } else {
                    $('#invoice_area_pulses').hide();
                    $('#pulses_serv_item_sess_cont').hide();
                    $('#pulses_serv_item_package_cont').hide();
                    $('#pulses_details_cont').hide();
                    $('#pulses_no_balance').show();
                }
            } else if (type == 4) {
                $('#pulses_no_balance').hide();
                $('#invoice_area_pulses').show();
                $('#pulses_serv_item_sess_cont').show();
                $('#pulses_serv_item_package_cont').hide();
                $('#pulses_details_cont').show();
                $('#sessions_serv_item_package_cont').hide();
                $('#patient_balance_cont').hide();
                $('#pulses_record_cont').show();
                $('#free_session_price_cont').show();
                //----
                $('input[name=fluence]').prop('disabled', false);
                $('input[name=spot_size]').prop('disabled', false);
                $('input[name=used_pulses]').prop('disabled', false);
                $('#pulses_cat_invoice_insert').prop('disabled', false);
                $('#machine_id').prop('disabled', false);
                $('#session_serv_item_package').prop('disabled', true);
                $('#pulses_record').prop('disabled', false);
                $('#pulses_serv_item_sess_cont').hide();
                $('#free_session_price').prop('disabled', false);
            }

        });


        fetchMachine();

        function fetchMachine(branch_id = $('select[name="branch_id_pulses"]').val()) {
            var url = "{{ route('sett.pulses_machines_ajax', ':id') }}";
            url = url.replace(':id', branch_id);

            $.ajax({
                url: url,
                type: "GET",
                dataType: "json",
                success: function(data) {
                    $('select[name="machine_id"]').empty();
                    $.each(data, function(key, value) {
                        $('select[name="machine_id"]').append(
                            '<option value="' +
                            value.id + '">' + value.name + '</option>');
                    });
                }
            });
        }

        //for gettomg machines depnds on branch ajax
        $('select[name="branch_id_pulses"]').on('change', function(e) {
            e.preventDefault();
            var branch_id = $(this).val();
            fetchMachine(branch_id)
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
            first_name: {
                minlength: 3,
            },
            second_name: {
                minlength: 3,
            },
            email: {
                email: true,
            },
            password: {
                minlength: 7,
                maxlength: 100,
            },
            password_confirmation: {
                minlength: 7,
                maxlength: 100,
                equalTo: '#password',
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
                case 'birthday':
                    error.insertAfter($("#birthday-js-error-valid"));
                    break;
                case 'country':
                    error.insertAfter($("#country-js-error-valid"));
                    break;
                case 'city':
                    error.insertAfter($("#city-js-error-valid"));
                    break;
                case 'started_work':
                    error.insertAfter($("#startedwork-js-error-valid"));
                    break;
                case 'phone_number':
                    error.insertAfter($("#phonenumber-js-error-valid"));
                    break;
                case 'sec_phone_number':
                    error.insertAfter($("#secphonenumber-js-error-valid"));
                    break;
                case 'deactivate':
                    error.insertAfter($("#deactivate-js-error-valid"));
                    break;

                default:
                    error.insertAfter(element);
            }

        },
    });
</script>


<script>
    const myCarouselElement = document.querySelector('#patient-info-caro')
    const carousel = new bootstrap.Carousel(myCarouselElement, {
    interval: false,
    touch: false
    })
</script>