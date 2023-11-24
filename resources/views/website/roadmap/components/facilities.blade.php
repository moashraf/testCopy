{{-------- Facilities Info --------}}
<div class="cont_tap" id="facilities">
    <h5 class="text-gray-800 fw-bold mb-5"><svg class="me-2" width="23" height="23" viewBox="0 0 23 23"
            fill="transparent" xmlns="http://www.w3.org/2000/svg">
            <path
                d="M8.35 22H14.65C19.9 22 22 19.9 22 14.65V8.35C22 3.1 19.9 1 14.65 1H8.35C3.1 1 1 3.1 1 8.35V14.65C1 19.9 3.1 22 8.35 22Z"
                stroke="#444444" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
            <path d="M17.2751 16.8342H15.3326" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
            <path d="M12.5185 16.8342H5.72504" stroke="#444444" stroke-width="1.5" stroke-linecap="round"
                stroke-linejoin="round" />
            <path d="M17.8 8.34985H5.20001" stroke="#444444" stroke-width="1.5" stroke-linecap="round"
                stroke-linejoin="round" />
            <path d="M17.275 12.8865H11.4685" stroke="#444444" stroke-width="1.5" stroke-linecap="round"
                stroke-linejoin="round" />
            <path d="M8.63354 12.8865H5.72504" stroke="#444444" stroke-width="1.5" stroke-linecap="round"
                stroke-linejoin="round" />
        </svg> بيانات مرافق المدرسة
    </h5>

    <div>
        <div class="row mb-4">
            <div class="col-12 col-md-4 col-xl-4 align-self-center">
                <label class="form-label mb-2 mb-xl-0">نوع المبني
                    <span class=" text-red fs-6">*</span></label>
            </div>
            <div class="col-12 col-md-7 col-xl-5">
                <div class="d-flex">
                    <div class="check_custom_index me-5">
                        <input checked type="radio" id="building_type_gov" name="building_type" value="1">
                        <label for="building_type_gov">حكومي</label>
                        <div class="check">
                            <div class="inside"></div>
                        </div>
                    </div>
                    <div class="check_custom_index me-3">
                        <input type="radio" id="building_type_rent" name="building_type" value="2">
                        <label for="building_type_rent">مستأجر</label>
                        <div class="check">
                            <div class="inside"></div>
                        </div>
                    </div>
                </div>
                <div id="school_gendar-js_error_valid"></div>
                @error('school_gendar')
                <span class="error-msg-form">
                    {{ $message }}
                </span>
                @enderror
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-12 col-md-4 col-xl-4 align-self-center">
                <label class="form-label mb-2 mb-xl-0">حالة المبني
                    <span class=" text-red fs-6">*</span></label>
            </div>
            <div class="col-12 col-md-7 col-xl-5">
                <div class="d-flex">
                    <div class="check_custom_index me-5">
                        <input checked type="radio" id="building_status_exc" name="building_status" value="1">
                        <label for="building_status_exc">ممتازة</label>
                        <div class="check">
                            <div class="inside"></div>
                        </div>
                    </div>
                    <div class="check_custom_index me-3">
                        <input type="radio" id="building_status_good" name="building_status" value="2">
                        <label for="building_status_good">جيدة</label>
                        <div class="check">
                            <div class="inside"></div>
                        </div>
                    </div>
                    <div class="check_custom_index me-3">
                        <input type="radio" id="building_status_bad" name="building_status" value="3">
                        <label for="building_status_bad">متهالكة</label>
                        <div class="check">
                            <div class="inside"></div>
                        </div>
                    </div>
                </div>
                <div id="school_gendar-js_error_valid"></div>
                @error('school_gendar')
                <span class="error-msg-form">
                    {{ $message }}
                </span>
                @enderror
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-12 col-md-4 col-xl-4 align-self-center">
                <label class="form-label mb-2 mb-xl-0">المرحلة الدراسية
                    <span class=" text-red fs-6">*</span></label>
            </div>
            <div class="col-12 col-md-7 col-xl-5">

                <select class="js-example-basic-single select2-no-search select2-hidden-accessible" name="school_level"
                    required>
                    <option value="1">المرحلة الابتدائية</option>
                    <option value="2">المرحلة الاعدادية</option>
                    <option value="3">المرحلة الثانوية</option>
                </select>

                <div id="school_level-js_error_valid"></div>
                @error('school_level')
                <span class="error-msg-form">
                    {{ $message }}
                </span>
                @enderror
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-12 col-md-4 col-xl-4 align-self-center">
                <label class="form-label mb-2 mb-xl-0">اسم المدرسة
                    <span class=" text-red fs-6">*</span></label>
            </div>
            <div class="col-12 col-md-7 col-xl-5">
                <input name="school_name" type="text" class="form-control" maxlength="100"
                    placeholder="اكتب هنا اسم المدرسة .." value="{{ old('school_name') }}" required>
                <div id="school_name-js_error_valid"></div>
                @error('school_name')
                <span class="error-msg-form">
                    {{ $message }}
                </span>
                @enderror
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-12 col-md-4 col-xl-4 align-self-center">
                <label class="form-label mb-2 mb-xl-0">الرقم الوزاري
                    <span class=" text-red fs-6">*</span></label>
            </div>
            <div class="col-12 col-md-7 col-xl-5">
                <input name="ministerial_number" type="text" minlength="4" maxlength="40" class="form-control"
                    placeholder="اكتب هنا الرقم الوزاري .." value="{{ old('ministerial_number') }}" required>
                <div id="ministerial_number-js_error_valid"></div>
                @error('ministerial_number')
                <span class="error-msg-form">
                    {{ $message }}
                </span>
                @enderror
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-12 col-md-4 col-xl-4 align-self-center">
                <label class="form-label mb-2 mb-xl-0">نوع المدرسة
                    <span class=" text-red fs-6">*</span></label>
            </div>
            <div class="col-12 col-md-7 col-xl-5">
                <div class="d-flex">
                    <div class="check_custom_index me-5">
                        <input checked type="radio" id="school_type_public_raido" name="school_type" value="1">
                        <label for="school_type_public_raido">حكومي</label>
                        <div class="check">
                            <div class="inside"></div>
                        </div>
                    </div>
                    <div class="check_custom_index me-3">
                        <input type="radio" id="school_type_private_raido" name="school_type" value="2">
                        <label for="school_type_private_raido">اهلي</label>
                        <div class="check">
                            <div class="inside"></div>
                        </div>
                    </div>
                </div>
                <div id="school_type-js_error_valid"></div>
                @error('school_type')
                <span class="error-msg-form">
                    {{ $message }}
                </span>
                @enderror
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-12 col-md-4 col-xl-4 align-self-center">
                <label class="form-label mb-2 mb-xl-0">المكتب التابع له المدرسة
                    <span class=" text-red fs-6">*</span></label>
            </div>
            <div class="col-12 col-md-7 col-xl-5">

                <select class="js-example-basic-single select2-hidden-accessible" name="school_department_office"
                    id="school_department_office" required>
                    <option> - يرجي اختيار ادارة التعليم اولا - </option>
                </select>

                <div id="school_department_office-js_error_valid"></div>
                @error('school_department_office')
                <span class="error-msg-form">
                    {{ $message }}
                </span>
                @enderror
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-12 col-md-4 col-xl-4 align-self-center">
            <label class="form-label mb-2 mb-xl-0">تاريخ تاسيس المدرسة
                <span class=" text-red fs-6">*</span></label>
        </div>
        <div class="col-12 col-md-7 col-xl-5">

            <div class="input-group">

                <input name="established_date" type="text" style="border-left: 0px;"
                    class="form-control hasdatetimepicker clickable-item-pointer @error('established_date') is-invalid @enderror"
                    placeholder="YYYY/MM/DD" value="{{ old('established_date') }}" required>
                <div class="input-group-prepend">
                    <div class="input-group-text"> <img class="platform_icon" alt="school"
                            src="{{ URL::asset('img/icons/calendar.svg') }}"> </div>
                </div>
            </div>
            <div id="established_date-js_error_valid"></div>
            @error('established_date')
            <span class="error-msg-form">
                {{ $message }}
            </span>
            @enderror
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-12 col-md-4 col-xl-4 align-self-center">
            <label class="form-label mb-2 mb-xl-0">فترة الدوام
                <span class=" text-red fs-6">*</span></label>
        </div>
        <div class="col-12 col-md-7 col-xl-5">
            <div class="d-flex">
                <div class="check_custom_index me-5">
                    <input checked type="radio" id="school_period_morning" name="school_period" value="1">
                    <label for="school_period_morning">صباحي</label>
                    <div class="check">
                        <div class="inside"></div>
                    </div>
                </div>
                <div class="check_custom_index me-5">
                    <input type="radio" id="school_period_afternoon" name="school_period" value="2">
                    <label for="school_period_afternoon">مسائي</label>
                    <div class="check">
                        <div class="inside"></div>
                    </div>
                </div>
                <div class="check_custom_index me-3">
                    <input type="radio" id="school_period_night" name="school_period" value="3">
                    <label for="school_period_night">ليلي</label>
                    <div class="check">
                        <div class="inside"></div>
                    </div>
                </div>
            </div>
            <div id="school_type-js_error_valid"></div>
            @error('school_type')
            <span class="error-msg-form">
                {{ $message }}
            </span>
            @enderror
        </div>
    </div>

    <div class="row mb-5">
        <div class="col-12 col-md-4 col-xl-4 align-self-center">
            <label class="form-label mb-2 mb-xl-0">عنوان المدرسة
                <span class=" text-red fs-6">*</span></label>
        </div>
        <div class="col-12 col-md-7 col-xl-5">
            <input name="address" type="text" class="form-control" minlength="5" maxlength="255"
                placeholder="منطقة - محافظة - مدينة أو حي" value="{{ old('address') }}" required>
            <div id="address-js_error_valid"></div>
            @error('address')
            <span class="error-msg-form">
                {{ $message }}
            </span>
            @enderror
        </div>
    </div>

    <div>
        <div class="previous-form-steps progressbar_roadmap_previous_btn">
            <h6 class="mb-0 ms-2">السابق</h6>
            <i class="fas fa-chevron-up"></i>
        </div>

        <div class="progressbar_roadmap_next_btn" id="general_info">
            <h6 class="mb-0 ms-2">التالي</h6>
            <i class="fas fa-chevron-down"></i>
        </div>

    </div>