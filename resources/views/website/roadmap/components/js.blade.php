<script>
    $(document).ready(function() {

// ------------ 2- choose school -------------
// show modal at first
  $('#choose_school_modal').modal('show');

//choose school
$(document).on('click', ".shared_school_btn", function(e) {
e.preventDefault();

    var type = $(this).data("type");

    var url = "{{ route('school_route.choose_school_store') }}";

    $.ajax({
        url: url
        , type: 'POST'
        , dataType: "json"
        , data: {
            '_token': "{{ csrf_token() }}"
            , 'type': type
        , }
        , success: function(data) {
            if (data.status == true) {
                toastr.success(data.msg);
                $('#choose_school_modal').modal('hide');
            } 
            else {
                toastr.error(data.msg);
            }
        }
        , error: function(err) {
            
            $("input[name='digit_4']").prop('disabled', true);
            $(".error_ajax_msg").remove();
            toastr.error(err.responseJSON.message);
            //show error message after the input and in toaster
            $.each(err.responseJSON.errors, function (input_name, error) {
                    var el = $(document).find('[name="'+input_name+'"]');
                    el.after($('<div class="error_ajax_msg" style="color: red;">'+error[0]+'</div>'));
                    toastr.error(error[0]);
            });

        }
    , });

});


// ------------ 3- general school info -------------
$(document).on('click', "#general_info", function(e) {
e.preventDefault();

    var school = $("input[name='school']").val();
    var school_gendar = $("input[name='school_gendar']:checked").val();
    var school_level = $("select[name=school_level] option:selected").val();
    var school_name = $("input[name='school_name']").val();
    var ministerial_number = $("input[name='ministerial_number']").val();
    var school_type = $("input[name='school_type']:checked").val();
    var school_department = $("select[name=school_department] option:selected").val();
    var school_department_office = $("select[name=school_department_office] option:selected").val();
    var established_date = $("input[name='established_date']").val();
    var school_period = $("input[name='school_period']:checked").val();
    var address = $("input[name='address']").val();


    var url = "{{ route('school_route.roadmap_general_info_store') }}";

    var $validator = $('#myform_general_info').validate({
        //for inserting erros for some inputs that makes posation problem such as selector 2 and bt datapicker
        errorPlacement: function(error, element) {
            switch (element.attr("name")) {
                case 'established_date':
                error.insertAfter($("#established_date-js_error_valid"));
                break;
                default:
                    error.insertAfter(element);
            }

        },
    });

    if (!$('#myform_general_info').valid()) {
            toastr.warning("لا يمكنك الانتقال للمرحلة التالية قبل إكمال كافة البيانات");
            return false;
    }

    that = this;

    $.ajax({
        url: url
        , type: 'POST'
        , dataType: "json"
        , data: {
            '_token': "{{ csrf_token() }}"
            , 'school': school
            , 'school_gendar': school_gendar
            , 'school_level': school_level
            , 'school_name': school_name
            , 'ministerial_number': ministerial_number
            , 'school_type': school_type
            , 'school_department': school_department
            , 'school_department_office': school_department_office
            , 'established_date': established_date
            , 'school_period': school_period
            , 'address': address
        , }
        , success: function(data) {
            if (data.status == true) {
                toastr.success(data.msg);
                //------ next step in roadmap -------
                current_fs = $(that).closest(".cont_tap");

                next_fs = $(that).closest(".cont_tap").next();
                //show the next div
                next_fs.show();
                //Add Class (Active) and (checked) progress bar
                $("#progressbar li").eq($(".cont_tap").index(next_fs)).addClass("active");
                //eq() is to select an element with a specific index number.
                $("#progressbar li .icon-circle").eq($(".cont_tap").index(next_fs)).addClass("checked");
                
                //hide the current div with style
                current_fs.animate({ opacity: 0 }, {
                    step: function (now) {
                        // for making the div appear animation
                        opacity = 1 - now;
                        current_fs.css({
                            'display': 'none',
                            'position': 'relative'
                        });
                        next_fs.css({ 'opacity': opacity });
                    },
                    duration: 500
                });
            } 
            else {
                toastr.error(data.msg);
            }
        }
        , error: function(err) {
            toastr.error(err.responseJSON.message);
            //show error message after the input and in toaster
            $.each(err.responseJSON.errors, function (input_name, error) {
                    var el = $(document).find('#'+input_name+'-js_error_valid');
                    el.html($('<div class="error_ajax_msg" style="color: red;">'+error[0]+'</div>'));
                    toastr.error(error[0]);
            });

        }
    , });

});
// fetch office by department
fetchOffice();
//for country and cities ajax inputs
function fetchOffice(department_id = $('select[name="school_department"]').val()) {

    var url = "{{ route('school_route.fetch_department_office', ':id') }}";
    url = url.replace(':id', department_id);

    if (department_id) {
        $.ajax({
            url: url,
            type: "GET",
            dataType: "json",
            success: function(data) {
                $('select[name="school_department_office"]').empty();
                $.each(data, function(key, value) {
                    $('select[name="school_department_office"]').append('<option value="' +
                        value.id + '">' + value.name + '</option>');
                });
            }
        });
    } else {
        $('select[name="school_department_office"]').empty();
    }
}
$('select[name="school_department"]').on('change', function(e) {
    var department_id = $(this).val();
    fetchOffice(department_id)
});

// ------------ 4- school facilities -------------
// sum rooms total
$(document).on("change", ".facilities_number", function(){
    var rooms = $('.facilities_number');
    var total = 0;
    $.each(rooms, function(key, value) {
                if(this.value > 0){
                    total += parseFloat(this.value);
                }
    });
    $('#total_facilities_rooms').val(total);
})
$(document).on('click', "#facilities_btn", function(e) {
e.preventDefault();

    var school = $("input[name='school']").val();
    var building_type = $("input[name='building_type']:checked").val();
    var building_status = $("input[name='building_status']:checked").val();
    var classes_number = $("input[name='classes_number']").val();
    var established_date = $("input[name='established_date']").val();
    var bathroom_number = $("input[name='bathroom_number']").val();
    var floors_number = $("input[name='floors_number']").val();
    var teachers_room_number = $("input[name='teachers_room_number']").val();
    var management_room_number = $("input[name='management_room_number']").val();
    var computers_room_number = $("input[name='computers_room_number']").val();
    var lab_room_number = $("input[name='lab_room_number']").val();
    var stock_room_number = $("input[name='stock_room_number']").val();
    var learning_resources_room_number = $("input[name='learning_resources_room_number']").val();
    var activities_room_number = $("input[name='activities_room_number']").val();
    var meetings_room_number = $("input[name='meetings_room_number']").val();
    var sport_room_number = $("input[name='sport_room_number']").val();
    var theaters_number = $("input[name='theaters_number']").val();
    var grounds_number = $("input[name='grounds_number']").val();
    var outdoor_room_number = $("input[name='outdoor_room_number']").val();
    var indoor_room_number = $("input[name='indoor_room_number']").val();

    var url = "{{ route('school_route.roadmap_facilities_store') }}";

    if (!$('#myform_facilities').valid()) {
            toastr.warning("لا يمكنك الانتقال للمرحلة التالية قبل إكمال كافة البيانات");
            return false;
    }

    that = this;

    $.ajax({
        url: url
        , type: 'POST'
        , dataType: "json"
        , data: {
            '_token': "{{ csrf_token() }}"
            , 'school': school
            , 'building_type': building_type
            , 'building_status': building_status
            , 'classes_number': classes_number
            , 'bathroom_number': bathroom_number
            , 'floors_number': floors_number
            , 'teachers_room_number': teachers_room_number
            , 'management_room_number': management_room_number
            , 'computers_room_number': computers_room_number
            , 'lab_room_number': lab_room_number
            , 'stock_room_number': stock_room_number
            , 'learning_resources_room_number': learning_resources_room_number
            , 'activities_room_number': activities_room_number
            , 'meetings_room_number': meetings_room_number
            , 'sport_room_number': sport_room_number
            , 'theaters_number': theaters_number
            , 'grounds_number': grounds_number
            , 'outdoor_room_number': outdoor_room_number
            , 'indoor_room_number': indoor_room_number
        , }
        , success: function(data) {
            if (data.status == true) {
                toastr.success(data.msg);
                //------ next step in roadmap -------
                current_fs = $(that).closest(".cont_tap");

                next_fs = $(that).closest(".cont_tap").next();
                //show the next div
                next_fs.show();
                //Add Class (Active) and (checked) progress bar
                $("#progressbar li").eq($(".cont_tap").index(next_fs)).addClass("active");
                //eq() is to select an element with a specific index number.
                $("#progressbar li .icon-circle").eq($(".cont_tap").index(next_fs)).addClass("checked");
                
                //hide the current div with style
                current_fs.animate({ opacity: 0 }, {
                    step: function (now) {
                        // for making the div appear animation
                        opacity = 1 - now;
                        current_fs.css({
                            'display': 'none',
                            'position': 'relative'
                        });
                        next_fs.css({ 'opacity': opacity });
                    },
                    duration: 500
                });
            } 
            else {
                toastr.error(data.msg);
            }
        }
        , error: function(err) {
            toastr.error(err.responseJSON.message);
            //show error message after the input and in toaster
            $.each(err.responseJSON.errors, function (input_name, error) {
                    var el = $(document).find('#'+input_name+'-js_error_valid');
                    el.html($('<div class="error_ajax_msg" style="color: red;">'+error[0]+'</div>'));
                    toastr.error(error[0]);
            });

        }
    , });

});


// ------------ 5- student -------------
//upload file after selecting
$(document).on('change', "#students_file_upload", function(e) {
    $("#myform_student").submit();
});
$(document).on('change', "#students_file_upload_resend", function(e) {
    $("#myform_student_resend").submit();
});

$(document).on('click', "#next_students", function(e) {
e.preventDefault();

    var school = $("input[name='school']").val();

    var url = "{{ route('school_route.roadmap_students_next_store') }}";

    that = this;

    $.ajax({
        url: url
        , type: 'POST'
        , dataType: "json"
        , data: {
            '_token': "{{ csrf_token() }}"
            , 'school': school
        , }
        , success: function(data) {
            if (data.status == true) {
                toastr.success(data.msg);
                //------ next step in roadmap -------
                current_fs = $(that).closest(".cont_tap");

                next_fs = $(that).closest(".cont_tap").next();
                //show the next div
                next_fs.show();
                //Add Class (Active) and (checked) progress bar
                $("#progressbar li").eq($(".cont_tap").index(next_fs)).addClass("active");
                //eq() is to select an element with a specific index number.
                $("#progressbar li .icon-circle").eq($(".cont_tap").index(next_fs)).addClass("checked");
                
                //hide the current div with style
                current_fs.animate({ opacity: 0 }, {
                    step: function (now) {
                        // for making the div appear animation
                        opacity = 1 - now;
                        current_fs.css({
                            'display': 'none',
                            'position': 'relative'
                        });
                        next_fs.css({ 'opacity': opacity });
                    },
                    duration: 500
                });
            } 
            else {
                toastr.error(data.msg);
            }
        }
        , error: function(err) {
            toastr.error(err.responseJSON.message);
            //show error message after the input and in toaster
            $.each(err.responseJSON.errors, function (input_name, error) {
                    var el = $(document).find('#'+input_name+'-js_error_valid');
                    el.html($('<div class="error_ajax_msg" style="color: red;">'+error[0]+'</div>'));
                    toastr.error(error[0]);
            });

        }
    , });

});

// ------------ 6- entsab -------------
$(document).on('change', "input[name='have_entsab']", function(e) {
    var have_entsab = $("input[name='have_entsab']:checked").val();
    if(have_entsab == 1){
        $("#have_entsab_cont").show();
    }else{
        $("#have_entsab_cont").hide();
    }
});

$(document).on('click', "#next_entsab", function(e) {
e.preventDefault();

    var school = $("input[name='school']").val();

    var url = "{{ route('school_route.roadmap_entsab_store') }}";




    var $validator = $('#myform_entsab').validate({
        //for inserting erros for some inputs that makes posation problem such as selector 2 and bt datapicker
        errorPlacement: function(error, element) {
            switch (element.attr("name")) {
                case 'have_entsab':
                error.insertAfter($("#have_entsab-js_error_valid"));
                break;
                default:
                    error.insertAfter(element);
            }

        },
    });

    if (!$('#myform_entsab').valid()) {
            toastr.warning("لا يمكنك الانتقال للمرحلة التالية قبل إكمال كافة البيانات");
            return false;
    }

    that = this;

    $.ajax({
        url: url
        , type: 'POST'
        , dataType: "json"
        , data: $("#myform_entsab").serialize()
        , success: function(data) {
            if (data.status == true) {
                toastr.success(data.msg);
                //------ next step in roadmap -------
                current_fs = $(that).closest(".cont_tap");

                next_fs = $(that).closest(".cont_tap").next();
                //show the next div
                next_fs.show();
                //Add Class (Active) and (checked) progress bar
                $("#progressbar li").eq($(".cont_tap").index(next_fs)).addClass("active");
                //eq() is to select an element with a specific index number.
                $("#progressbar li .icon-circle").eq($(".cont_tap").index(next_fs)).addClass("checked");
                
                //hide the current div with style
                current_fs.animate({ opacity: 0 }, {
                    step: function (now) {
                        // for making the div appear animation
                        opacity = 1 - now;
                        current_fs.css({
                            'display': 'none',
                            'position': 'relative'
                        });
                        next_fs.css({ 'opacity': opacity });
                    },
                    duration: 500
                });
            } 
            else {
                toastr.error(data.msg);
            }
        }
        , error: function(err) {
            toastr.error(err.responseJSON.message);
            //show error message after the input and in toaster
            $.each(err.responseJSON.errors, function (input_name, error) {
                    var el = $(document).find('#'+input_name+'-js_error_valid');
                    el.html($('<div class="error_ajax_msg" style="color: red;">'+error[0]+'</div>'));
                    toastr.error(error[0]);
            });

        }
    , });

});


// ------------ 7- teachers -------------
//upload file after selecting
$(document).on('change', "#teachers_file_upload", function(e) {
    $("#myform_teachers").submit();
});
$(document).on('change', "#teachers_file_upload_resend", function(e) {
    $("#myform_teachers_resend").submit();
});

$(document).on('change', ".teacher_speciality_select", function(e) {
e.preventDefault();

    var school = "fr1ksa";
    var speciality = $(this).val();
    var code = $(this).data('code');

    var url = "{{ route('school_route.roadmap_teachers_update_speciality') }}";

    that = this;

    $.ajax({
        url: url
        , type: 'POST'
        , dataType: "json"
        , data: {
            '_token': "{{ csrf_token() }}"
            , 'school': school
            , 'speciality': speciality
            , 'code': code
        , }
        , success: function(data) {
            if (data.status == true) {
                toastr.success(data.msg);
            } 
            else {
                toastr.error(data.msg);
            }
        }
        , error: function(err) {
            toastr.error(err.responseJSON.message);
            //show error message after the input and in toaster
            $.each(err.responseJSON.errors, function (input_name, error) {
                    var el = $(document).find('#'+input_name+'-js_error_valid');
                    el.html($('<div class="error_ajax_msg" style="color: red;">'+error[0]+'</div>'));
                    toastr.error(error[0]);
            });

        }
    , });

});

$(document).on('click', "#next_teachers", function(e) {
e.preventDefault();

    var school = $("input[name='school']").val();

    var url = "{{ route('school_route.roadmap_teachers_next_store') }}";

    that = this;

    $.ajax({
        url: url
        , type: 'POST'
        , dataType: "json"
        , data: {
            '_token': "{{ csrf_token() }}"
            , 'school': school
        , }
        , success: function(data) {
            if (data.status == true) {
                toastr.success(data.msg);
                //------ next step in roadmap -------
                current_fs = $(that).closest(".cont_tap");

                next_fs = $(that).closest(".cont_tap").next();
                //show the next div
                next_fs.show();
                //Add Class (Active) and (checked) progress bar
                $("#progressbar li").eq($(".cont_tap").index(next_fs)).addClass("active");
                //eq() is to select an element with a specific index number.
                $("#progressbar li .icon-circle").eq($(".cont_tap").index(next_fs)).addClass("checked");
                
                //hide the current div with style
                current_fs.animate({ opacity: 0 }, {
                    step: function (now) {
                        // for making the div appear animation
                        opacity = 1 - now;
                        current_fs.css({
                            'display': 'none',
                            'position': 'relative'
                        });
                        next_fs.css({ 'opacity': opacity });
                    },
                    duration: 500
                });
            } 
            else {
                toastr.error(data.msg);
            }
        }
        , error: function(err) {
            toastr.error(err.responseJSON.message);
            //show error message after the input and in toaster
            $.each(err.responseJSON.errors, function (input_name, error) {
                    var el = $(document).find('#'+input_name+'-js_error_valid');
                    el.html($('<div class="error_ajax_msg" style="color: red;">'+error[0]+'</div>'));
                    toastr.error(error[0]);
            });

        }
    , });

});



// ------------ 8- administrator -------------
$(document).on('click', "#new_admin_btn", function(e) {
e.preventDefault();

    var school = $("input[name='school']").val();
    var admin_name = $("input[name='admin_name']").val();
    var admin_identification_number = $("input[name='admin_identification_number']").val();
    var admin_phone_number = $("input[name='admin_phone_number']").val();
    var admin_email = $("input[name='admin_email']").val();
    var admin_school_job = $("select[name=admin_school_job] option:selected").val();
    var admin_speciality_id = $("select[name=admin_speciality_id] option:selected").val();

    var admin_school_job_text = $("select[name=admin_school_job] option:selected").text();
    var admin_speciality_id_text = $("select[name=admin_speciality_id] option:selected").text();

    var url = "{{ route('school_route.roadmap_administrator_store') }}";

    if (!$('#myform_admin').valid()) {
            toastr.warning("برجاء مراجعة كافة الحقول");
            return false;
    }

    that = this;

    $.ajax({
        url: url
        , type: 'POST'
        , dataType: "json"
        , data: {
            '_token': "{{ csrf_token() }}"
            , 'school': school
            , 'admin_name': admin_name
            , 'admin_identification_number': admin_identification_number
            , 'admin_phone_number': admin_phone_number
            , 'admin_email': admin_email
            , 'admin_school_job': admin_school_job
            , 'admin_speciality_id': admin_speciality_id
        , }
        , success: function(data) {
            if (data.status == true) {
                $('#add_new_administrator').modal('hide');
                $('#admin_cont_add_new').hide();
                $('#admin_cont_add_new_empty').hide();
                $('#admin_table_cont').show();

                
                var tr = $('<tr id="row_' + data.code + '" >' +
                        '<td class="">' +  admin_name + '</td>' + 
                        '<td class="">' +  admin_identification_number + '</td>' + 
                        '<td class="">' +  admin_phone_number + '</td>' + 
                        '<td class="">' +  admin_email + '</td>' + 
                        '<td class="">' +  admin_school_job_text + '</td>' + 
                        '<td class="">' +  admin_speciality_id_text + '</td>' + 
                        '<td>' + 
                            '<div class="dropdown no-arrow">' +
                                '<a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fas fa-ellipsis-v fs-6 fa-fw text-gray-700"></i> </a>' +

                                '<div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink"> <a class="dropdown-item text-green update_admin" href="#" data-code="' + data.code +'" data-name="' + admin_name + '" data-identification_number="' + admin_identification_number + '" data-phone_number="' +  admin_phone_number + '" data-email="' + admin_email +'" data-school_job_id="' + admin_school_job + '" data-teacher_speciality_id="' + admin_speciality_id + '"><i class="fas fa-trash-alt me-1"></i> تعديل</a>' +
                                   '<a class="dropdown-item text-red" href="#" data-bs-toggle="modal"   data-bs-target="#delete_admin_modal' + data.code + '"><i class="fas fa-trash-alt me-1"></i> حذف</a>' +
                                '</div>' +
                            '</div>' +

                            '<div class="modal fade" id="delete_admin_modal' + data.code + '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">'  + 
                                '<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable "> <div class="modal-content b-r-s-cont border-0">' +
                                        '<div class="modal-header"> <div class="modal-title" id="exampleModalLabel"><i class="fas fa-trash me-1"></i> حذف الاداري </div>' +
                                            '<button type="button" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>' +
                                        '</div>' +
                                        '<form>' +
                                            '<div class="modal-body px-4">' +
                                               '<div class="modal-body delete-conf-input text-center py-0">' +
                                                    '<p class="mb-0">هل انت متاكد من حذف الاداري</p>' +
                                                    '<br>' +
                                                '</div>' +
                                            '</div>' + 

                                            '<div class="modal-footer">' +
                                                '<div class="right-side">' +
                                                    '<button type="button" data-code="' + data.code + '" class="btn btn-default btn-link text-red fw-bold delete_admin_btn">حذف</button>' + 
                                                '</div>' +
                                               ' <div class="divider"></div>' +
                                                '<div class="left-side">' +
                                                    '<button type="button" class="btn btn-default btn-link"  data-bs-dismiss="modal">غلق النافذة</button>' +
                                                '</div>' +
                                           '</div>' +
                                        '</form>' +
                                    '</div>' +
                               '</div>' +
                            '</div>' +

                        '</td>'+ 
                    '</tr>');

                //add new in datatable
                const table = $('#p_3-table').DataTable();
                table.row.add(tr[0]).draw();


                // empty inputs 
                $("input[name='admin_name']").val("");
                $("input[name='admin_identification_number']").val("");
                $("input[name='admin_phone_number']").val("");
                $("input[name='admin_email']").val("");
                toastr.success(data.msg);
            } 
            else {
                toastr.error(data.msg);
            }
        }
        , error: function(err) {
            toastr.error(err.responseJSON.message);
            //show error message after the input and in toaster
            $.each(err.responseJSON.errors, function (input_name, error) {
                    var el = $(document).find('#'+input_name+'-js_error_valid');
                    el.html($('<div class="error_ajax_msg" style="color: red;">'+error[0]+'</div>'));
                    toastr.error(error[0]);
            });

        }
    , });

});

$(document).on('click', ".update_admin", function(e) {
e.preventDefault();

    var index = $(this).data('index');
    var code = $(this).data('code');
    var name = $(this).data('name');
    var identification_number = $(this).data('identification_number');
    var phone_number = $(this).data('phone_number');
    var email = $(this).data('email');
    var school_job_id = $(this).data('school_job_id');
    var teacher_speciality_id = $(this).data('teacher_speciality_id');
    
    $('input[name = "admin_index_update"]').val(index);
    $('input[name = "admin_code_update"]').val(code);
    $('input[name = "admin_name_update"]').val(name);
    $('input[name = "admin_identification_number_update"]').val(identification_number);
    $('input[name = "admin_phone_number_update"]').val(phone_number);
    $('input[name = "admin_email_update"]').val(email);
    $("#admin_school_job_update").select2("val", String(school_job_id));
    $("#admin_speciality_id_update").select2("val", String(teacher_speciality_id));

    $("#update_new_administrator").modal('show');
});

$(document).on('click', "#update_admin_btn", function(e) {
e.preventDefault();

    var index = $('input[name = "admin_index_update"]').val();
    var code = $('input[name = "admin_code_update"]').val();
    var name = $('input[name = "admin_name_update"]').val();
    var identification_number = $('input[name = "admin_identification_number_update"]').val();
    var phone_number = $('input[name = "admin_phone_number_update"]').val();
    var email = $('input[name = "admin_email_update"]').val();
    var school_job_id = $("select[name=admin_school_job_update] option:selected").val();
    var teacher_speciality_id = $("select[name=admin_speciality_id_update] option:selected").val();
    var school_job_text = $("select[name=admin_school_job_update] option:selected").text();
    var teacher_speciality_text = $("select[name=admin_speciality_id_update] option:selected").text();

    var url = "{{ route('school_route.roadmap_administrator_update_speciality') }}";

    if (!$('#myform_update_admin').valid()) {
            toastr.warning("برجاء مراجعة كافة الحقول");
            return false;
    }

    that = this;

    $.ajax({
        url: url
        , type: 'POST'
        , dataType: "json"
        , data: {
            '_token': "{{ csrf_token() }}"
            , 'code': code
            , 'admin_name': name
            , 'admin_identification_number': identification_number
            , 'admin_phone_number': phone_number
            , 'admin_email': email
            , 'admin_school_job': school_job_id
            , 'admin_speciality_id': teacher_speciality_id
        , }
        , success: function(data) {
            if (data.status == true) {
                toastr.success(data.msg);
                $("#update_new_administrator").modal('hide');

                var tr = '<td class="">' + name + '</td>' + 
                        '<td class="">' + identification_number + '</td>' + 
                        '<td class="">' + phone_number + '</td>' + 
                        '<td class="">' + email + '</td>' + 
                        '<td class="">' + school_job_text + '</td>' + 
                        '<td class="">' + teacher_speciality_text + '</td>' + 
                        '<td>' + 
                            '<div class="dropdown no-arrow">' +
                                '<a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fas fa-ellipsis-v fs-6 fa-fw text-gray-700"></i> </a>' +

                                '<div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink"> <a class="dropdown-item text-green update_admin" href="#" data-code="' + code +'" data-name="' + name + '" data-identification_number="' + identification_number + '" data-phone_number="' +  phone_number + '" data-email="' + email +'" data-school_job_id="' + school_job_id + '" data-teacher_speciality_id="' + teacher_speciality_id + '"><i class="fas fa-trash-alt me-1"></i> تعديل</a>' +
                                   '<a class="dropdown-item text-red" href="#" data-bs-toggle="modal"   data-bs-target="#delete_admin_modal' + code + '"><i class="fas fa-trash-alt me-1"></i> حذف</a>' +
                                '</div>' +
                            '</div>' +

                            '<div class="modal fade" id="delete_admin_modal' + code + '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">'  + 
                                '<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable "> <div class="modal-content b-r-s-cont border-0">' +
                                        '<div class="modal-header"> <div class="modal-title" id="exampleModalLabel"><i class="fas fa-trash me-1"></i> حذف الاداري </div>' +
                                            '<button type="button" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>' +
                                        '</div>' +
                                        '<form>' +
                                            '<div class="modal-body px-4">' +
                                               '<div class="modal-body delete-conf-input text-center py-0">' +
                                                    '<p class="mb-0">هل انت متاكد من حذف الاداري</p>' +
                                                    '<br>' +
                                                '</div>' +
                                            '</div>' + 

                                            '<div class="modal-footer">' +
                                                '<div class="right-side">' +
                                                    '<button type="button" data-code="' + code + '" class="btn btn-default btn-link text-red fw-bold delete_admin_btn">حذف</button>' + 
                                                '</div>' +
                                               ' <div class="divider"></div>' +
                                                '<div class="left-side">' +
                                                    '<button type="button" class="btn btn-default btn-link"  data-bs-dismiss="modal">غلق النافذة</button>' +
                                                '</div>' +
                                           '</div>' +
                                        '</form>' +
                                    '</div>' +
                               '</div>' +
                            '</div>' +
                        '</td>';

                $("#row_" + code ).html(tr);

            } 
            else {
                toastr.error(data.msg);
            }
        }
        , error: function(err) {
            toastr.error(err.responseJSON.message);
            //show error message after the input and in toaster
            $.each(err.responseJSON.errors, function (input_name, error) {
                    var el = $(document).find('#'+input_name+'-js_error_valid');
                    el.html($('<div class="error_ajax_msg" style="color: red;">'+error[0]+'</div>'));
                    toastr.error(error[0]);
            });

        }
    , });

});

$(document).on('click', ".delete_admin_btn", function(e) {
e.preventDefault();

    var code = $(this).data('code');
    var modal_code = "#delete_admin_modal" + code;

    var url = "{{ route('school_route.roadmap_administrator_delete_speciality') }}";

    if (!$('#myform_admin').valid()) {
            toastr.warning("برجاء مراجعة كافة الحقول");
            return false;
    }

    that = this;

    $.ajax({
        url: url
        , type: 'POST'
        , dataType: "json"
        , data: {
            '_token': "{{ csrf_token() }}"
            , 'code': code
        , }
        , success: function(data) {
            if (data.status == true) {

                $(modal_code).modal('hide');
                toastr.success(data.msg);

                //Delete in datatable
                var row = $("#row_" + code);
                var myTable = $('#p_3-table').DataTable();
                myTable.row(row).remove().draw();
            } 
            else {
                toastr.error(data.msg);
            }
        }
        , error: function(err) {
            toastr.error(err.responseJSON.message);
            //show error message after the input and in toaster
            $.each(err.responseJSON.errors, function (input_name, error) {
                    var el = $(document).find('#'+input_name+'-js_error_valid');
                    el.html($('<div class="error_ajax_msg" style="color: red;">'+error[0]+'</div>'));
                    toastr.error(error[0]);
            });

        }
    , });

});

$(document).on('click', "#next_administrators", function(e) {
e.preventDefault();

    var school = $("input[name='school']").val();

    var url = "{{ route('school_route.roadmap_administrator_next_store') }}";

    that = this;

    $.ajax({
        url: url
        , type: 'POST'
        , dataType: "json"
        , data: {
            '_token': "{{ csrf_token() }}"
            , 'school': school
        , }
        , success: function(data) {
            if (data.status == true) {
                toastr.success(data.msg);
                //------ next step in roadmap -------
                current_fs = $(that).closest(".cont_tap");

                next_fs = $(that).closest(".cont_tap").next();
                //show the next div
                next_fs.show();
                //Add Class (Active) and (checked) progress bar
                $("#progressbar li").eq($(".cont_tap").index(next_fs)).addClass("active");
                //eq() is to select an element with a specific index number.
                $("#progressbar li .icon-circle").eq($(".cont_tap").index(next_fs)).addClass("checked");
                
                //hide the current div with style
                current_fs.animate({ opacity: 0 }, {
                    step: function (now) {
                        // for making the div appear animation
                        opacity = 1 - now;
                        current_fs.css({
                            'display': 'none',
                            'position': 'relative'
                        });
                        next_fs.css({ 'opacity': opacity });
                    },
                    duration: 500
                });
            } 
            else {
                toastr.error(data.msg);
            }
        }
        , error: function(err) {
            toastr.error(err.responseJSON.message);
            //show error message after the input and in toaster
            $.each(err.responseJSON.errors, function (input_name, error) {
                    var el = $(document).find('#'+input_name+'-js_error_valid');
                    el.html($('<div class="error_ajax_msg" style="color: red;">'+error[0]+'</div>'));
                    toastr.error(error[0]);
            });

        }
    , });

});



// ------------ 9- other info -------------
$(document).on('click', "#other_info_btn", function(e) {
e.preventDefault();

    var school = $("input[name='school']").val();
    var school_telephone = $("input[name='school_telephone']").val();
    var school_phone_number = $("input[name='school_phone_number']").val();
    var school_whatsapp = $("input[name='school_whatsapp']").val();
    var school_twitter = $("input[name='school_twitter']").val();
    var school_website = $("input[name='school_website']").val();
    var school_facebook = $("input[name='school_facebook']").val();
    var school_snapchat = $("input[name='school_snapchat']").val();
    var school_tiktok = $("input[name='school_tiktok']").val();
    var school_telegram = $("input[name='school_telegram']").val();


    var url = "{{ route('school_route.roadmap_other_info_store') }}";

    if (!$('#myform_other_info').valid()) {
            toastr.warning("لا يمكنك الانتقال للمرحلة التالية قبل إكمال كافة البيانات");
            return false;
    }

    that = this;

    $.ajax({
        url: url
        , type: 'POST'
        , dataType: "json"
        , data: {
            '_token': "{{ csrf_token() }}"
            , 'school': school
            , 'school_telephone': school_telephone
            , 'school_phone_number': school_phone_number
            , 'school_whatsapp': school_whatsapp
            , 'school_twitter': school_twitter
            , 'school_website': school_website
            , 'school_facebook': school_facebook
            , 'school_snapchat': school_snapchat
            , 'school_tiktok': school_tiktok
            , 'school_telegram': school_telegram
        , }
        , success: function(data) {
            if (data.status == true) {
                toastr.success(data.msg);
                //------ next step in roadmap -------
                current_fs = $(that).closest(".cont_tap");

                next_fs = $(that).closest(".cont_tap").next();
                //show the next div
                next_fs.show();
                //Add Class (Active) and (checked) progress bar
                $("#progressbar li").eq($(".cont_tap").index(next_fs)).addClass("active");
                //eq() is to select an element with a specific index number.
                $("#progressbar li .icon-circle").eq($(".cont_tap").index(next_fs)).addClass("checked");
                
                //hide the current div with style
                current_fs.animate({ opacity: 0 }, {
                    step: function (now) {
                        // for making the div appear animation
                        opacity = 1 - now;
                        current_fs.css({
                            'display': 'none',
                            'position': 'relative'
                        });
                        next_fs.css({ 'opacity': opacity });
                    },
                    duration: 500
                });
            } 
            else {
                toastr.error(data.msg);
            }
        }
        , error: function(err) {
            toastr.error(err.responseJSON.message);
            //show error message after the input and in toaster
            $.each(err.responseJSON.errors, function (input_name, error) {
                    var el = $(document).find('#'+input_name+'-js_error_valid');
                    el.html($('<div class="error_ajax_msg" style="color: red;">'+error[0]+'</div>'));
                    toastr.error(error[0]);
            });

        }
    , });

});


// ------------ 10- finish -------------
$(document).on('click', ".finished_roadmap_btn", function(e) {
e.preventDefault();

    var school = $("input[name='school']").val();

    var url = "{{ route('school_route.roadmap_finish_store') }}";

    var type = $(this).data('school_type');

    that = this;

    $.ajax({
        url: url
        , type: 'POST'
        , dataType: "json"
        , data: {
            '_token': "{{ csrf_token() }}"
            , 'school': school
            , 'type': type
        , }
        , success: function(data) {
            if (data.status == true) {
                toastr.success(data.msg);
                var url = data.url;
                if(data.type === "done"){
                    $('#choose_school_page').hide();
                    $('#cong_page').show();
                    var delay = 5000;
                    setTimeout(function(){ window.location.href = url; }, delay);
                }else if (data.type === "to_second_school"){
                    // Your delay in milliseconds
                    window.location.href = url;
                }

            } 
            else {
                toastr.error(data.msg);
            }
        }
        , error: function(err) {
            toastr.error(err.responseJSON.message);
            //show error message after the input and in toaster
            $.each(err.responseJSON.errors, function (input_name, error) {
                    var el = $(document).find('#'+input_name+'-js_error_valid');
                    el.html($('<div class="error_ajax_msg" style="color: red;">'+error[0]+'</div>'));
                    toastr.error(error[0]);
            });

        }
    , });

});


});
</script>