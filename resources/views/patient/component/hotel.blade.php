<!---------- Lab results --------->
<div class="col-12 col-lg-4">
    <!-- Appointments -->
    <div class="page-break">


        <div class="card shadow mb-4">


            <div id="hotel_trip" class="carousel slide curr-treament-info-carousel">

                <div class="carousel-indicators dots-radius-carousel" style="bottom: 34px; margin-bottom: 0px;">
                    <button type="button" data-bs-target="#hotel_trip" data-bs-slide-to="0" class="active"
                        aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#hotel_trip" data-bs-slide-to="1"
                        aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#hotel_trip" data-bs-slide-to="2"
                        aria-label="Slide 3"></button>
                </div>

                <div class="carousel-inner">

                    <!-- Current treatments -->
                    <div class="carousel-item active">

                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <span class="m-0 fs-6 me-2 fw-bold clickable-item-pointer"><i class="fas fa-hotel"></i>
                                    {{ __('basic.hotel')
                                    }}</span>
                                <span
                                    class="m-0 me-2 text-x link-cust-text text-s fw-bold clickable-item-pointer text-gray-200"
                                    data-bs-target="#hotel_trip" data-bs-slide-to="1" aria-label="Slide 2"> <i
                                        class="fas fa-box-open"></i>
                                    {{ __('basic.packages') }}</span>
                                <span
                                    class="m-0 me-2 text-x link-cust-text text-s fw-bold clickable-item-pointer text-gray-200"
                                    data-bs-target="#hotel_trip" data-bs-slide-to="2" aria-label="Slide 3"> <i
                                        class="fas fa-shuttle-van"></i>
                                    {{ __('basic.trips') }}</span>
                            </div>

                            <div class="dropdown no-arrow">
                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-300"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                    aria-labelledby="dropdownMenuLink">
                                    <div class="dropdown-header">Appointment controller:</div>
                                    <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                        data-bs-target="#add_past_app">Add
                                        past Appointment</a>
                                    <a class="dropdown-item add_info_old_appo clickable-item-pointer">{{
                                        __('patientappo.old
                                        appointment
                                        info') }}</a>
                                    <a class="dropdown-item add_info_exsit_appo clickable-item-pointer">{{
                                        __('patientappo.exist
                                        appointment info') }}</a>
                                </div>
                            </div>
                        </div>

                        <!-- Card Body -->
                        <div class="card-body pb-2 overflow-scroll">

                            @if (count($patient->unit) > 0)
                            <ul class="list-group patient-timeline">

                                @foreach ($patient->unit as $item)

                                @if ($item->status == 0)
                                @php
                                $text_color = 'not_accepted-color';
                                $msg = __('not accepted');
                                @endphp
                                @elseif ($item->status == 1)
                                @php
                                $text_color = 'main-color';
                                $msg = __('accepted');
                                @endphp
                                @elseif ($item->status == 2)
                                @php
                                $text_color = 'arrived-color';
                                $msg = __('broker inquire');
                                @endphp
                                @elseif ($item->status == 3)
                                @php
                                $text_color = 'inprog-color';
                                $msg = __('travler payment');
                                @endphp
                                @elseif ($item->status == 4)
                                @php
                                $text_color = 'inprog-color';
                                $msg = __('received payment,');
                                @endphp
                                @elseif ($item->status == 5)
                                @php
                                $text_color = 'notresp-color';
                                $msg = __('send a payment to broker');
                                @endphp
                                @elseif ($item->status == 6)
                                @php
                                $text_color = 'notresp-color';
                                $msg = __('broker confirm');
                                @endphp
                                @elseif ($item->status == 7)
                                @php
                                $text_color = 'done-color';
                                $msg = __('done');
                                @endphp
                                @elseif ($item->status == 8)
                                @php
                                $text_color = 'cancel-color';
                                $msg = __('canceled');
                                @endphp
                                @endif


                                {{-- accept client and supplier invoice --}}
                                @if(in_array($item->payment_method, [1,2]) && $item->invoice_item->invoice_id !== 0)

                                @if ($item->invoice_item)
                                @if ($item->invoice_item->invoice->status == 0)
                                @php
                                $msg_invoice = __('basic.not paid');
                                @endphp
                                @elseif ($item->invoice_item->invoice->status == 1)
                                @php
                                $msg_invoice = __('basic.pending');
                                @endphp
                                @elseif ($item->invoice_item->invoice->status == 2)
                                @php
                                $msg_invoice = __('basic.installment');
                                @endphp
                                @elseif ($item->invoice_item->invoice->status == 3)
                                @php
                                $msg_invoice = __('basic.paid');
                                @endphp
                                @elseif ($item->invoice_item->invoice->status == 4)
                                @php
                                $msg_invoice = __('basic.refund');
                                @endphp
                                @endif
                                @else
                                @php
                                $msg_invoice = __('basic.no fees');
                                @endphp
                                @endif

                                @else
                                @php
                                $msg_invoice = __('basic.wallet');
                                @endphp
                                @endif


                                {{-- blade-formatter-disable-next-line --}}
                                @break($loop->index === 2)

                                @if ($item->note_doctor)
                                @php
                                $icon_note = 'fa-user-check text-blue-400';
                                @endphp
                                @else
                                @php
                                $icon_note = 'fa-user-edit text-grey-400';
                                @endphp
                                @endif

                                <li
                                    class="row flex-nowrap list-group-item d-flex justify-content-between position-relative">

                                    <i
                                        class="col patient-timeline-pointer fas fa-circle text-xxs mb-0 {{ $text_color }}"></i>

                                    <div class="col me-1">
                                        <p class="text-xxs text-gray-200 mb-0">
                                            {{ date('h:i a', strtotime($item->start_at)) }}</p>
                                        <h6 class="text-s fw-bold {{ $text_color }} mb-0">
                                            {{ date('d M Y', strtotime($item->start_at)) }}</h6>
                                        <p class="text-xs {{ $text_color }} fw-bold mb-0">
                                            {{ $msg . ', ' . $msg_invoice }}
                                        </p>
                                    </div>

                                    <div class="col text-center align-self-center me-1">
                                        <p class="text-xs text-gray-200 mb-0">{{ __('basic.service') }}</p>
                                        <h6 class="text-s text-gray-400">{{ $item->hotel->name }}</h6>
                                    </div>

                                    <div class="col text-center align-self-center me-1">
                                        <p class="text-xs text-gray-200 mb-0">{{ __('basic.worker') }}</p>
                                        <h6 class="text-s text-gray-400 text-truncate">
                                            @if (isset($item->creator->first_name))
                                            {{ $item->creator->first_name }}
                                            @else
                                            Not selected
                                            @endif
                                        </h6>
                                    </div>

                                    <div class="col text-center align-self-center">
                                        <p class="text-xs text-gray-200 mb-0">{{ __('basic.handle') }}</p>
                                        <a data-id="{{ $item->id }}" data-note_doctor="{{ $item->note_doctor }}"
                                            class="text-s text-gray-400 clickable-item-pointer get_all_info_appointment">
                                            <i class="fas fa-info-circle m-1 fs-6"></i>
                                        </a>
                                        <a data-id="{{ $item->id }}" data-note_doctor="{{ $item->note_doctor }}"
                                            class="text-s text-gray-400 clickable-item-pointer appointment_note_click">
                                            <i class="fas {{ $icon_note }} m-1 fs-6"></i>
                                        </a>
                                    </div>

                                </li>
                                @endforeach

                            </ul>
                            @else
                            <div class="text-center">
                                <i class="bi bi-brightness-alt-high-fill fa-sm fa-fw fs-2"></i>
                                <p class="fw-light mb-0">{{ __('basic.nothing to show') }}</p>
                            </div>
                            @endif
                        </div>

                        <!-- Card footer -->
                        <div class="card-footer text-center ">
                            <a class="text-xs link-cust-text text-gray-300" href="#" data-bs-toggle="modal"
                                data-bs-target="#hotel_show">
                                <i class="fas fa-chevron-down"></i> {{ __('basic.more') }}
                            </a>
                        </div>

                    </div>

                    <!-- Current treatments -->
                    <div class="carousel-item">

                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">


                            <div class="d-flex align-items-center">
                                <span class="m-0 fs-6 me-2 fw-bold clickable-item-pointer"><i
                                        class="fas fa-box-open"></i>
                                    {{ __('basic.packages')
                                    }}</span>
                                <span
                                    class="m-0 me-2 text-x link-cust-text text-s fw-bold clickable-item-pointer text-gray-200"
                                    data-bs-target="#hotel_trip" data-bs-slide-to="2" aria-label="Slide 3"> <i
                                        class="fas fa-shuttle-van"></i>
                                    {{ __('basic.trips') }}</span>
                                <span
                                    class="m-0 me-2 text-x link-cust-text text-s fw-bold clickable-item-pointer text-gray-200"
                                    data-bs-target="#hotel_trip" data-bs-slide-to="0" aria-label="Slide 1"> <i
                                        class="fas fa-hotel"></i>
                                    {{ __('basic.hotel') }}</span>
                            </div>

                            <div class="dropdown no-arrow">
                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-300"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                    aria-labelledby="dropdownMenuLink">
                                    <div class="dropdown-header">Appointment controller:</div>
                                    <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                        data-bs-target="#add_past_app">Add
                                        past Appointment</a>
                                    <a class="dropdown-item add_info_old_appo clickable-item-pointer">{{
                                        __('patientappo.old
                                        appointment
                                        info') }}</a>
                                    <a class="dropdown-item add_info_exsit_appo clickable-item-pointer">{{
                                        __('patientappo.exist
                                        appointment info') }}</a>
                                </div>
                            </div>
                        </div>

                        <!-- Card Body -->
                        <div class="card-body pb-2 overflow-scroll">

                            @if (count($patient->package) > 0)
                            <ul class="list-group patient-timeline">

                                @foreach ($patient->package as $item)

                                @if ($item->status == 0)
                                @php
                                $text_color = 'not_accepted-color';
                                $msg = __('not accepted');
                                @endphp
                                @elseif ($item->status == 1)
                                @php
                                $text_color = 'main-color';
                                $msg = __('accepted');
                                @endphp
                                @elseif ($item->status == 2)
                                @php
                                $text_color = 'arrived-color';
                                $msg = __('broker inquire');
                                @endphp
                                @elseif ($item->status == 3)
                                @php
                                $text_color = 'inprog-color';
                                $msg = __('travler payment');
                                @endphp
                                @elseif ($item->status == 4)
                                @php
                                $text_color = 'inprog-color';
                                $msg = __('received payment,');
                                @endphp
                                @elseif ($item->status == 5)
                                @php
                                $text_color = 'notresp-color';
                                $msg = __('send a payment to broker');
                                @endphp
                                @elseif ($item->status == 6)
                                @php
                                $text_color = 'notresp-color';
                                $msg = __('broker confirm');
                                @endphp
                                @elseif ($item->status == 7)
                                @php
                                $text_color = 'done-color';
                                $msg = __('done');
                                @endphp
                                @elseif ($item->status == 8)
                                @php
                                $text_color = 'cancel-color';
                                $msg = __('canceled');
                                @endphp
                                @endif


                                {{-- accept client and supplier invoice --}}
                                @if(in_array($item->payment_method, [1,2]) && $item->invoice_item->invoice_id !== 0)

                                @if ($item->invoice_item)
                                @if ($item->invoice_item->invoice->status == 0)
                                @php
                                $msg_invoice = __('basic.not paid');
                                @endphp
                                @elseif ($item->invoice_item->invoice->status == 1)
                                @php
                                $msg_invoice = __('basic.pending');
                                @endphp
                                @elseif ($item->invoice_item->invoice->status == 2)
                                @php
                                $msg_invoice = __('basic.installment');
                                @endphp
                                @elseif ($item->invoice_item->invoice->status == 3)
                                @php
                                $msg_invoice = __('basic.paid');
                                @endphp
                                @elseif ($item->invoice_item->invoice->status == 4)
                                @php
                                $msg_invoice = __('basic.refund');
                                @endphp
                                @endif
                                @else
                                @php
                                $msg_invoice = __('basic.no fees');
                                @endphp
                                @endif

                                @else
                                @php
                                $msg_invoice = __('basic.wallet');
                                @endphp
                                @endif


                                {{-- blade-formatter-disable-next-line --}}
                                @break($loop->index === 2)

                                @if ($item->note_doctor)
                                @php
                                $icon_note = 'fa-user-check text-blue-400';
                                @endphp
                                @else
                                @php
                                $icon_note = 'fa-user-edit text-grey-400';
                                @endphp
                                @endif

                                <li
                                    class="row flex-nowrap list-group-item d-flex justify-content-between position-relative">

                                    <i
                                        class="col patient-timeline-pointer fas fa-circle text-xxs mb-0 {{ $text_color }}"></i>

                                    <div class="col me-1">
                                        <p class="text-xxs text-gray-200 mb-0">
                                            {{ date('h:i a', strtotime($item->start_at)) }}</p>
                                        <h6 class="text-s fw-bold {{ $text_color }} mb-0">
                                            {{ date('d M Y', strtotime($item->start_at)) }}</h6>
                                        <p class="text-xs {{ $text_color }} fw-bold mb-0">
                                            {{ $msg . ', ' . $msg_invoice }}
                                        </p>
                                    </div>

                                    <div class="col text-center align-self-center me-1">
                                        <p class="text-xs text-gray-200 mb-0">{{ __('basic.service') }}</p>
                                        <h6 class="text-s text-gray-400">{{ $item->package_offer->name }}</h6>
                                    </div>

                                    <div class="col text-center align-self-center me-1">
                                        <p class="text-xs text-gray-200 mb-0">{{ __('basic.worker') }}</p>
                                        <h6 class="text-s text-gray-400 text-truncate">
                                            @if (isset($item->creator->first_name))
                                            {{ $item->creator->company_name }}
                                            @else
                                            Not selected
                                            @endif
                                        </h6>
                                    </div>

                                    <div class="col text-center align-self-center">
                                        <p class="text-xs text-gray-200 mb-0">{{ __('basic.handle') }}</p>
                                        <a data-id="{{ $item->id }}" data-note_doctor="{{ $item->note_doctor }}"
                                            class="text-s text-gray-400 clickable-item-pointer get_all_info_appointment">
                                            <i class="fas fa-info-circle m-1 fs-6"></i>
                                        </a>
                                        <a data-id="{{ $item->id }}" data-note_doctor="{{ $item->note_doctor }}"
                                            class="text-s text-gray-400 clickable-item-pointer appointment_note_click">
                                            <i class="fas {{ $icon_note }} m-1 fs-6"></i>
                                        </a>
                                    </div>

                                </li>
                                @endforeach

                            </ul>
                            @else
                            <div class="text-center">
                                <i class="bi bi-brightness-alt-high-fill fa-sm fa-fw fs-2"></i>
                                <p class="fw-light mb-0">{{ __('basic.nothing to show') }}</p>
                            </div>
                            @endif
                        </div>

                        <!-- Card footer -->
                        <div class="card-footer text-center ">
                            <a class="text-xs link-cust-text text-gray-300" href="#" data-bs-toggle="modal"
                                data-bs-target="#package_show">
                                <i class="fas fa-chevron-down"></i> {{ __('basic.more') }}
                            </a>
                        </div>

                    </div>

                    <!-- Current treatments -->
                    <div class="carousel-item">

                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <span class="m-0 fs-6 me-2 fw-bold clickable-item-pointer"><i
                                        class="fas fa-shuttle-van"></i>
                                    {{ __('basic.trips') }}</span>
                                <span
                                    class="m-0 me-2 text-x link-cust-text text-s fw-bold clickable-item-pointer text-gray-200"
                                    data-bs-target="#hotel_trip" data-bs-slide-to="0" aria-label="Slide 1"> <i
                                        class="fas fa-hotel"></i>
                                    {{ __('basic.hotel') }}</span>
                                <span
                                    class="m-0 me-2 text-x link-cust-text text-s fw-bold clickable-item-pointer text-gray-200"
                                    data-bs-target="#hotel_trip" data-bs-slide-to="1" aria-label="Slide 2"> <i
                                        class="fas fa-box-open"></i>
                                    {{ __('basic.packages') }}</span>
                            </div>

                            <div class="dropdown no-arrow">
                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-300"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                    aria-labelledby="dropdownMenuLink">
                                    <div class="dropdown-header">Appointment controller:</div>
                                    <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                        data-bs-target="#add_past_app">Add
                                        past Appointment</a>
                                    <a class="dropdown-item add_info_old_appo clickable-item-pointer">{{
                                        __('patientappo.old
                                        appointment
                                        info') }}</a>
                                    <a class="dropdown-item add_info_exsit_appo clickable-item-pointer">{{
                                        __('patientappo.exist
                                        appointment info') }}</a>
                                </div>
                            </div>
                        </div>

                        <!-- Card Body -->
                        <div class="card-body pb-2 overflow-scroll">

                            @if (count($patient->trip) > 0)
                            <ul class="list-group patient-timeline">

                                @foreach ($patient->trip as $item)

                                @if ($item->status == 0)
                                @php
                                $text_color = 'not_accepted-color';
                                $msg = __('not accepted');
                                @endphp
                                @elseif ($item->status == 1)
                                @php
                                $text_color = 'main-color';
                                $msg = __('accepted');
                                @endphp
                                @elseif ($item->status == 2)
                                @php
                                $text_color = 'arrived-color';
                                $msg = __('broker inquire');
                                @endphp
                                @elseif ($item->status == 3)
                                @php
                                $text_color = 'inprog-color';
                                $msg = __('travler payment');
                                @endphp
                                @elseif ($item->status == 4)
                                @php
                                $text_color = 'inprog-color';
                                $msg = __('received payment,');
                                @endphp
                                @elseif ($item->status == 5)
                                @php
                                $text_color = 'notresp-color';
                                $msg = __('send a payment to broker');
                                @endphp
                                @elseif ($item->status == 6)
                                @php
                                $text_color = 'notresp-color';
                                $msg = __('broker confirm');
                                @endphp
                                @elseif ($item->status == 7)
                                @php
                                $text_color = 'done-color';
                                $msg = __('done');
                                @endphp
                                @elseif ($item->status == 8)
                                @php
                                $text_color = 'cancel-color';
                                $msg = __('canceled');
                                @endphp
                                @endif



                                {{-- accept client and supplier invoice --}}
                                @if(in_array($item->payment_method, [1,2]) && $item->invoice_item->invoice_id !== 0)

                                @if ($item->invoice_item)
                                @if ($item->invoice_item->invoice->status == 0)
                                @php
                                $msg_invoice = __('basic.not paid');
                                @endphp
                                @elseif ($item->invoice_item->invoice->status == 1)
                                @php
                                $msg_invoice = __('basic.pending');
                                @endphp
                                @elseif ($item->invoice_item->invoice->status == 2)
                                @php
                                $msg_invoice = __('basic.installment');
                                @endphp
                                @elseif ($item->invoice_item->invoice->status == 3)
                                @php
                                $msg_invoice = __('basic.paid');
                                @endphp
                                @elseif ($item->invoice_item->invoice->status == 4)
                                @php
                                $msg_invoice = __('basic.refund');
                                @endphp
                                @endif
                                @else
                                @php
                                $msg_invoice = __('basic.no fees');
                                @endphp
                                @endif

                                @else
                                @php
                                $msg_invoice = __('basic.wallet');
                                @endphp
                                @endif


                                {{-- blade-formatter-disable-next-line --}}
                                @break($loop->index === 2)

                                @if ($item->note_doctor)
                                @php
                                $icon_note = 'fa-user-check text-blue-400';
                                @endphp
                                @else
                                @php
                                $icon_note = 'fa-user-edit text-grey-400';
                                @endphp
                                @endif

                                <li
                                    class="row flex-nowrap list-group-item d-flex justify-content-between position-relative">

                                    <i
                                        class="col patient-timeline-pointer fas fa-circle text-xxs mb-0 {{ $text_color }}"></i>

                                    <div class="col me-1">
                                        <p class="text-xxs text-gray-200 mb-0">
                                            {{ date('h:i a', strtotime($item->start_at)) }}</p>
                                        <h6 class="text-s fw-bold {{ $text_color }} mb-0">
                                            {{ date('d M Y', strtotime($item->start_at)) }}</h6>
                                        <p class="text-xs {{ $text_color }} fw-bold mb-0">
                                            {{ $msg . ', ' . $msg_invoice }}
                                        </p>
                                    </div>

                                    <div class="col text-center align-self-center me-1">
                                        <p class="text-xs text-gray-200 mb-0">{{ __('basic.service') }}</p>
                                        <h6 class="text-s text-gray-400">{{ $item->trip_offer->name }}</h6>
                                    </div>

                                    <div class="col text-center align-self-center me-1">
                                        <p class="text-xs text-gray-200 mb-0">{{ __('basic.worker') }}</p>
                                        <h6 class="text-s text-gray-400 text-truncate">
                                            @if (isset($item->creator->first_name))
                                            {{ $item->creator->first_name }}
                                            @else
                                            Not selected
                                            @endif
                                        </h6>
                                    </div>

                                    <div class="col text-center align-self-center">
                                        <p class="text-xs text-gray-200 mb-0">{{ __('basic.handle') }}</p>
                                        <a data-id="{{ $item->id }}" data-note_doctor="{{ $item->note_doctor }}"
                                            class="text-s text-gray-400 clickable-item-pointer get_all_info_appointment">
                                            <i class="fas fa-info-circle m-1 fs-6"></i>
                                        </a>
                                        <a data-id="{{ $item->id }}" data-note_doctor="{{ $item->note_doctor }}"
                                            class="text-s text-gray-400 clickable-item-pointer appointment_note_click">
                                            <i class="fas {{ $icon_note }} m-1 fs-6"></i>
                                        </a>
                                    </div>

                                </li>
                                @endforeach

                            </ul>
                            @else
                            <div class="text-center">
                                <i class="bi bi-brightness-alt-high-fill fa-sm fa-fw fs-2"></i>
                                <p class="fw-light mb-0">{{ __('basic.nothing to show') }}</p>
                            </div>
                            @endif
                        </div>

                        <!-- Card footer -->
                        <div class="card-footer text-center ">
                            <a class="text-xs link-cust-text text-gray-300" href="#" data-bs-toggle="modal"
                                data-bs-target="#trip_show">
                                <i class="fas fa-chevron-down"></i> {{ __('basic.more') }}
                            </a>
                        </div>

                    </div>
                </div>
            </div>


        </div>


        <!-- Modal show all packages -->
        <div class="modal fade" id="package_show" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
                <div class="modal-content b-r-s-cont border-0">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fas fa-box-open me-1"></i>
                            {{ __('basic.packages') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <!-- Modal content -->
                    <div class="modal-body px-4">

                        <div class="table-responsive">
                            <table class="table display datatable-modal" id="table-package" width="100%"
                                cellspacing="0">
                                <thead>
                                    <tr>
                                        <th class="text-xs">{{ __('basic.service') }}</th>
                                        <th class="text-xs text-center">{{ __('basic.quantity') }}</th>
                                        <th class="text-xs text-center">{{ __('basic.file id') }}</th>
                                        <th class="text-xs text-center">{{ __('basic.destination') }}</th>
                                        <th class="text-xs text-center">{{ __('basic.company') }}</th>
                                        <th class="text-xs text-center">{{ __('basic.worker') }}</th>
                                        <th class="text-xs text-center">{{ __('basic.start') }}</th>
                                        <th class="text-xs text-center">{{ __('basic.end') }}</th>
                                        <th class="text-xs text-center">{{ __('basic.status') }}</th>
                                        <th class="text-xs text-center">{{ __('patientappo.pay status') }}
                                        </th>
                                        <th class="text-xs text-center">{{ __('basic.handle') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($patient->package as $item)


                                    @if ($item->status == 0)
                                    @php
                                    $text_color = 'not_accepted-color-btn';
                                    $msg = __('patientappo.not accepted');
                                    @endphp
                                    @elseif ($item->status == 1)
                                    @php
                                    $text_color = 'main-color-btn';
                                    $msg = __('patientappo.accepted');
                                    @endphp
                                    @elseif ($item->status == 2)
                                    @php
                                    $text_color = 'active-color-btn';
                                    $msg = __('broker inquire');
                                    @endphp
                                    @elseif ($item->status == 3)
                                    @php
                                    $text_color = 'prog-color-btn';
                                    $msg = __('traveler payment');
                                    @endphp
                                    @elseif ($item->status == 4)
                                    @php
                                    $text_color = 'done-color-btn';
                                    $msg = __('received payment');
                                    @endphp
                                    @elseif ($item->status == 5)
                                    @php
                                    $text_color = 'pend-color-btn';
                                    $msg = __('send a payment to broker');
                                    @endphp
                                    @elseif ($item->status == 6)
                                    @php
                                    $text_color = 'prog-color-btn';
                                    $msg = __('broker confirm');
                                    @endphp
                                    @elseif ($item->status == 7)
                                    @php
                                    $text_color = 'done-color-btn';
                                    $msg = __('patientappo.done');
                                    @endphp
                                    @elseif ($item->status == 8)
                                    @php
                                    $text_color = 'cancel-color-btn';
                                    $msg = __('patientappo.canceled');
                                    @endphp
                                    @endif


                                    @if ($item->note_doctor)
                                    @php
                                    $icon_note = 'fa-user-check text-blue-400';
                                    @endphp
                                    @else
                                    @php
                                    $icon_note = 'fa-user-edit text-grey-400';
                                    @endphp
                                    @endif

                                    <tr>
                                        <td>{{ $item->package_offer->name }}</td>
                                        <td class="text-capitalize">{{ $item->qty }}</td>
                                        <td class="text-capitalize">{{ $item->file_id }}</td>
                                        <td class="text-center">{{ $item->package_offer->package->destination->name }}
                                        </td>
                                        <td class="text-center">
                                            @if ($item->debtor)
                                            {{ $item->debtor->company_name}}
                                            @else
                                            No Company
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @isset($item->creator->first_name)
                                            {{ $item->creator->first_name }}
                                            @endisset
                                        </td>
                                        <td class="text-center">
                                            {{ date('Y-m-d', strtotime($item->start_at)) }} <br>
                                            {{ date('h:i a', strtotime($item->start_at)) }}</td>
                                        <td class="text-center">
                                            {{ date('Y-m-d', strtotime($item->end_at)) }} <br>
                                            {{ date('h:i a', strtotime($item->end_at)) }}</td>
                                        <td class="text-center"> <span
                                                class="badge rounded-pill {{ $text_color }} badge-padd-l">{{ $msg
                                                }}</span>
                                        </td>

                                        <td class="text-center">


                                            {{-- accept client and supplier invoice --}}
                                            @if(in_array($item->payment_method, [1,2]) &&
                                            $item->invoice_item->invoice_id !== 0)
                                            @if ($item->invoice_item->invoice->status == 0)
                                            @php
                                            $msg_invoice_debtor = __('basic.not paid');
                                            $text_color_invoice_debtor = 'cancel-color-btn';
                                            @endphp
                                            @elseif ($item->invoice_item->invoice->status == 1)
                                            @php
                                            $text_color_invoice_debtor = 'pend-color-btn';
                                            $msg_invoice_debtor = __('basic.pending');
                                            @endphp
                                            @elseif ($item->invoice_item->invoice->status == 2)
                                            @php
                                            $text_color_invoice_debtor = 'prog-color-btn';
                                            $msg_invoice_debtor = __('basic.installment');
                                            @endphp
                                            @elseif ($item->invoice_item->invoice->status == 3)
                                            @php
                                            $text_color_invoice_debtor = 'done-color-btn';
                                            $msg_invoice_debtor = __('basic.paid');
                                            @endphp
                                            @elseif ($item->invoice_item->invoice->status == 4)
                                            @php
                                            $msg_invoice_debtor = __('basic.refund');
                                            $text_color_invoice_debtor = 'cancel-color-btn';
                                            @endphp
                                            @else
                                            @php
                                            $msg_invoice_debtor = __('basic.no fees');
                                            $text_color_invoice_debtor = 'not_accepted-color-btn';
                                            @endphp
                                            @endif

                                            <span
                                                class="badge rounded-pill {{ $text_color_invoice_debtor }} badge-padd-l"><a
                                                    class="{{ $text_color_invoice_debtor }}" href="{{ route('sett.invoice.show',
                                    $item->invoice_item->invoice_id) }}">{{
                                                    $msg_invoice_debtor }}</a></span>

                                            @else
                                            <span class="badge not_accepted-color-btn rounded-pill badge-padd-l"><i
                                                    class="fas fa-wallet"></i>
                                                {{ __('basic.no invoice') }}</span>

                                            @endif
                                        </td>


                                        <td class="text-center d-flex justify-content-center">
                                            <a data-id="{{ $item->id }}" data-note_doctor="{{ $item->note_doctor }}"
                                                class="text-s text-gray-400 clickable-item-pointer get_all_info_appointment">
                                                <i class="fas fa-info-circle m-1 fs-6"></i>
                                            </a>
                                            <a data-id="{{ $item->id }}" data-note_doctor="{{ $item->note_doctor }}"
                                                class="text-s text-gray-400 clickable-item-pointer appointment_note_click">
                                                <i class="fas {{ $icon_note }} m-1 fs-6"></i>
                                            </a>
                                        </td>

                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <div class="left-side">
                            <button type="button" class="btn btn-default btn-link" data-bs-dismiss="modal">{{
                                __('basic.never mind') }}</button>
                        </div>
                        <div class="divider"></div>
                        <div class="right-side">
                            <button type="button" class="btn btn-default btn-link main-color">{{ __('basic.save
                                changes')
                                }}</button>
                        </div>
                    </div>

                </div>
            </div>

        </div>

        <!-- Modal show all trip -->
        <div class="modal fade" id="trip_show" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
                <div class="modal-content b-r-s-cont border-0">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fas fa-hotel me-1"></i>
                            {{ __('basic.trips') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <!-- Modal content -->
                    <div class="modal-body px-4">

                        <div class="table-responsive">
                            <table class="table display datatable-modal" id="table-trip" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th class="text-xs">{{ __('basic.service') }}</th>
                                        <th class="text-xs text-center">{{ __('basic.quantity') }}</th>
                                        <th class="text-xs text-center">{{ __('basic.file id') }}</th>
                                        <th class="text-xs text-center">{{ __('basic.destination') }}</th>
                                        <th class="text-xs text-center">{{ __('basic.company') }}</th>
                                        <th class="text-xs text-center">{{ __('basic.worker') }}</th>
                                        <th class="text-xs text-center">{{ __('basic.start') }}</th>
                                        <th class="text-xs text-center">{{ __('basic.end') }}</th>
                                        <th class="text-xs text-center">{{ __('basic.status') }}</th>
                                        <th class="text-xs text-center">{{ __('patientappo.pay status') }}
                                        </th>
                                        <th class="text-xs text-center">{{ __('basic.handle') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($patient->trip as $item)


                                    @if ($item->status == 0)
                                    @php
                                    $text_color = 'not_accepted-color-btn';
                                    $msg = __('patientappo.not accepted');
                                    @endphp
                                    @elseif ($item->status == 1)
                                    @php
                                    $text_color = 'main-color-btn';
                                    $msg = __('patientappo.accepted');
                                    @endphp
                                    @elseif ($item->status == 2)
                                    @php
                                    $text_color = 'active-color-btn';
                                    $msg = __('broker inquire');
                                    @endphp
                                    @elseif ($item->status == 3)
                                    @php
                                    $text_color = 'prog-color-btn';
                                    $msg = __('traveler payment');
                                    @endphp
                                    @elseif ($item->status == 4)
                                    @php
                                    $text_color = 'done-color-btn';
                                    $msg = __('received payment');
                                    @endphp
                                    @elseif ($item->status == 5)
                                    @php
                                    $text_color = 'pend-color-btn';
                                    $msg = __('send a payment to broker');
                                    @endphp
                                    @elseif ($item->status == 6)
                                    @php
                                    $text_color = 'prog-color-btn';
                                    $msg = __('broker confirm');
                                    @endphp
                                    @elseif ($item->status == 7)
                                    @php
                                    $text_color = 'done-color-btn';
                                    $msg = __('patientappo.done');
                                    @endphp
                                    @elseif ($item->status == 8)
                                    @php
                                    $text_color = 'cancel-color-btn';
                                    $msg = __('patientappo.canceled');
                                    @endphp
                                    @endif

                                    @if ($item->note_doctor)
                                    @php
                                    $icon_note = 'fa-user-check text-blue-400';
                                    @endphp
                                    @else
                                    @php
                                    $icon_note = 'fa-user-edit text-grey-400';
                                    @endphp
                                    @endif

                                    <tr>
                                        <td>{{ $item->trip_offer->name }}</td>
                                        <td class="text-capitalize">{{ $item->qty }}</td>
                                        <td class="text-capitalize">{{ $item->file_id }}</td>
                                        <td class="text-center">{{ $item->trip_offer->trip->destination->name }}</td>
                                        <td class="text-center">
                                            @if ($item->debtor)
                                            {{ $item->debtor->company_name}}
                                            @else
                                            No Company
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @isset($item->creator->first_name)
                                            {{ $item->creator->first_name }}
                                            @endisset
                                        </td>
                                        <td class="text-center">
                                            {{ date('Y-m-d', strtotime($item->start_at)) }} <br>
                                            {{ date('h:i a', strtotime($item->start_at)) }}</td>
                                        <td class="text-center">
                                            {{ date('Y-m-d', strtotime($item->end_at)) }} <br>
                                            {{ date('h:i a', strtotime($item->end_at)) }}</td>
                                        <td class="text-center"> <span
                                                class="badge rounded-pill {{ $text_color }} badge-padd-l">{{ $msg
                                                }}</span>
                                        </td>


                                        <td class="text-center">


                                            {{-- accept client and supplier invoice --}}
                                            @if(in_array($item->payment_method, [1,2]) &&
                                            $item->invoice_item->invoice_id !== 0)
                                            @if ($item->invoice_item->invoice->status == 0)
                                            @php
                                            $msg_invoice_debtor = __('basic.not paid');
                                            $text_color_invoice_debtor = 'cancel-color-btn';
                                            @endphp
                                            @elseif ($item->invoice_item->invoice->status == 1)
                                            @php
                                            $text_color_invoice_debtor = 'pend-color-btn';
                                            $msg_invoice_debtor = __('basic.pending');
                                            @endphp
                                            @elseif ($item->invoice_item->invoice->status == 2)
                                            @php
                                            $text_color_invoice_debtor = 'prog-color-btn';
                                            $msg_invoice_debtor = __('basic.installment');
                                            @endphp
                                            @elseif ($item->invoice_item->invoice->status == 3)
                                            @php
                                            $text_color_invoice_debtor = 'done-color-btn';
                                            $msg_invoice_debtor = __('basic.paid');
                                            @endphp
                                            @elseif ($item->invoice_item->invoice->status == 4)
                                            @php
                                            $msg_invoice_debtor = __('basic.refund');
                                            $text_color_invoice_debtor = 'cancel-color-btn';
                                            @endphp
                                            @else
                                            @php
                                            $msg_invoice_debtor = __('basic.no fees');
                                            $text_color_invoice_debtor = 'not_accepted-color-btn';
                                            @endphp
                                            @endif
                                            <span
                                                class="badge rounded-pill {{ $text_color_invoice_debtor }} badge-padd-l"><a
                                                    class="{{ $text_color_invoice_debtor }}" href="{{ route('sett.invoice.show',
                                    $item->invoice_item->invoice_id) }}">{{
                                                    $msg_invoice_debtor }}</a></span>

                                            @else
                                            <span class="badge not_accepted-color-btn rounded-pill badge-padd-l"><i
                                                    class="fas fa-wallet"></i>
                                                {{ __('basic.no invoice') }}</span>

                                            @endif
                                        </td>


                                        <td class="text-center d-flex justify-content-center">
                                            <a data-id="{{ $item->id }}" data-note_doctor="{{ $item->note_doctor }}"
                                                class="text-s text-gray-400 clickable-item-pointer get_all_info_appointment">
                                                <i class="fas fa-info-circle m-1 fs-6"></i>
                                            </a>
                                            <a data-id="{{ $item->id }}" data-note_doctor="{{ $item->note_doctor }}"
                                                class="text-s text-gray-400 clickable-item-pointer appointment_note_click">
                                                <i class="fas {{ $icon_note }} m-1 fs-6"></i>
                                            </a>
                                        </td>

                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <div class="left-side">
                            <button type="button" class="btn btn-default btn-link" data-bs-dismiss="modal">{{
                                __('basic.never mind') }}</button>
                        </div>
                        <div class="divider"></div>
                        <div class="right-side">
                            <button type="button" class="btn btn-default btn-link main-color">{{ __('basic.save
                                changes')
                                }}</button>
                        </div>
                    </div>

                </div>
            </div>

        </div>

        <!-- Modal show all appointment -->
        <div class="modal fade" id="hotel_show" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
                <div class="modal-content b-r-s-cont border-0">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fas fa-hotel me-1"></i>
                            {{ __('basic.hotel') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <!-- Modal content -->
                    <div class="modal-body px-4">

                        <div class="table-responsive">
                            <table class="table display datatable-modal" id="table-hotel" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th class="text-xs">{{ __('basic.service') }}</th>
                                        <th class="text-xs text-center">{{ __('basic.room') }}</th>
                                        <th class="text-xs text-center">{{ __('basic.destination') }}</th>
                                        <th class="text-xs text-center">{{ __('basic.company') }}</th>
                                        <th class="text-xs text-center">{{ __('basic.worker') }}</th>
                                        <th class="text-xs text-center">{{ __('basic.start') }}</th>
                                        <th class="text-xs text-center">{{ __('basic.end') }}</th>
                                        <th class="text-xs text-center">{{ __('basic.status') }}</th>
                                        <th class="text-xs text-center">{{ __('patientappo.pay status') }}
                                        </th>
                                        <th class="text-xs text-center">{{ __('basic.handle') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($patient->unit as $item)


                                    @if ($item->status == 0)
                                    @php
                                    $text_color = 'not_accepted-color-btn';
                                    $msg = __('patientappo.not accepted');
                                    @endphp
                                    @elseif ($item->status == 1)
                                    @php
                                    $text_color = 'main-color-btn';
                                    $msg = __('patientappo.accepted');
                                    @endphp
                                    @elseif ($item->status == 2)
                                    @php
                                    $text_color = 'active-color-btn';
                                    $msg = __('broker inquire');
                                    @endphp
                                    @elseif ($item->status == 3)
                                    @php
                                    $text_color = 'prog-color-btn';
                                    $msg = __('traveler payment');
                                    @endphp
                                    @elseif ($item->status == 4)
                                    @php
                                    $text_color = 'done-color-btn';
                                    $msg = __('received payment');
                                    @endphp
                                    @elseif ($item->status == 5)
                                    @php
                                    $text_color = 'pend-color-btn';
                                    $msg = __('send a payment to broker');
                                    @endphp
                                    @elseif ($item->status == 6)
                                    @php
                                    $text_color = 'prog-color-btn';
                                    $msg = __('broker confirm');
                                    @endphp
                                    @elseif ($item->status == 7)
                                    @php
                                    $text_color = 'done-color-btn';
                                    $msg = __('patientappo.done');
                                    @endphp
                                    @elseif ($item->status == 8)
                                    @php
                                    $text_color = 'cancel-color-btn';
                                    $msg = __('patientappo.canceled');
                                    @endphp
                                    @endif

                                    @if ($item->note_doctor)
                                    @php
                                    $icon_note = 'fa-user-check text-blue-400';
                                    @endphp
                                    @else
                                    @php
                                    $icon_note = 'fa-user-edit text-grey-400';
                                    @endphp
                                    @endif

                                    <tr>
                                        <td>{{ $item->hotel->name }}</td>
                                        <td class="text-capitalize">{{ $item->quantity }} {{ $item->room_type }} room
                                        </td>
                                        <td class="text-center">{{ $item->destination->name }}</td>
                                        <td class="text-center">
                                            @if ($item->debtor)
                                            {{ $item->debtor->first_name . " " .
                                            $item->debtor->second_name}}
                                            @else
                                            No Company
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @isset($item->creator->first_name)
                                            {{ $item->creator->first_name }}
                                            @endisset
                                        </td>
                                        <td class="text-center">
                                            {{ date('Y-m-d', strtotime($item->start_at)) }} <br>
                                            {{ date('h:i a', strtotime($item->start_at)) }}</td>
                                        <td class="text-center">
                                            {{ date('Y-m-d', strtotime($item->end_at)) }} <br>
                                            {{ date('h:i a', strtotime($item->end_at)) }}</td>
                                        <td class="text-center"> <span
                                                class="badge rounded-pill {{ $text_color }} badge-padd-l">{{ $msg
                                                }}</span>
                                        </td>

                                        <td class="text-center">


                                            {{-- accept client and supplier invoice --}}
                                            @if(in_array($item->payment_method, [1,2]) &&
                                            $item->invoice_item->invoice_id !== 0)
                                            @if ($item->invoice_item->invoice->status == 0)
                                            @php
                                            $msg_invoice_debtor = __('basic.not paid');
                                            $text_color_invoice_debtor = 'cancel-color-btn';
                                            @endphp
                                            @elseif ($item->invoice_item->invoice->status == 1)
                                            @php
                                            $text_color_invoice_debtor = 'pend-color-btn';
                                            $msg_invoice_debtor = __('basic.pending');
                                            @endphp
                                            @elseif ($item->invoice_item->invoice->status == 2)
                                            @php
                                            $text_color_invoice_debtor = 'prog-color-btn';
                                            $msg_invoice_debtor = __('basic.installment');
                                            @endphp
                                            @elseif ($item->invoice_item->invoice->status == 3)
                                            @php
                                            $text_color_invoice_debtor = 'done-color-btn';
                                            $msg_invoice_debtor = __('basic.paid');
                                            @endphp
                                            @elseif ($item->invoice_item->invoice->status == 4)
                                            @php
                                            $msg_invoice_debtor = __('basic.refund');
                                            $text_color_invoice_debtor = 'cancel-color-btn';
                                            @endphp
                                            @else
                                            @php
                                            $msg_invoice_debtor = __('basic.no fees');
                                            $text_color_invoice_debtor = 'not_accepted-color-btn';
                                            @endphp
                                            @endif
                                            <span
                                                class="badge rounded-pill {{ $text_color_invoice_debtor }} badge-padd-l"><a
                                                    class="{{ $text_color_invoice_debtor }}" href="{{ route('sett.invoice.show',
                                                $item->invoice_item->invoice_id) }}">{{
                                                    $msg_invoice_debtor }}</a></span>

                                            @else
                                            <span class="badge not_accepted-color-btn rounded-pill badge-padd-l"><i
                                                    class="fas fa-wallet"></i>
                                                {{ __('basic.no invoice') }}</span>

                                            @endif
                                        </td>

                                        <td class="text-center d-flex justify-content-center">
                                            <a data-id="{{ $item->id }}" data-note_doctor="{{ $item->note_doctor }}"
                                                class="text-s text-gray-400 clickable-item-pointer get_all_info_appointment">
                                                <i class="fas fa-info-circle m-1 fs-6"></i>
                                            </a>
                                            <a data-id="{{ $item->id }}" data-note_doctor="{{ $item->note_doctor }}"
                                                class="text-s text-gray-400 clickable-item-pointer appointment_note_click">
                                                <i class="fas {{ $icon_note }} m-1 fs-6"></i>
                                            </a>
                                        </td>

                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <div class="left-side">
                            <button type="button" class="btn btn-default btn-link" data-bs-dismiss="modal">{{
                                __('basic.never mind') }}</button>
                        </div>
                        <div class="divider"></div>
                        <div class="right-side">
                            <button type="button" class="btn btn-default btn-link main-color">{{ __('basic.save
                                changes')
                                }}</button>
                        </div>
                    </div>

                </div>
            </div>

        </div>

        <!-- Modal for inserting the past appointments -->
        <div class="modal fade" id="add_past_app" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content b-r-s-cont border-0">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-capsules me-1"></i>
                            {{ __('patientappo.last appointment') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <form class="mb-0" action="{{ route('sett.app_past_appointment') }}" method="post">
                        {{ method_field('POST') }}
                        {{ csrf_field() }}

                        <!-- Modal content -->
                        <div class="modal-body px-5 py-3">

                            <div class="row mb-2">
                                <div class="col-12 mb-2">
                                    <label class="form-label">{{ __('basic.branch') }}
                                        <small>({{ __('basic.required') }})</small></label>
                                    <select
                                        class="myselect2-appo-insert select2-hidden-accessible @error('branch_appo') is-invalid @enderror"
                                        id="branch_appo" name="branch_appo" required>
                                        @foreach ($branches as $item)
                                        <option value="{{ $item->id }}">
                                            {{ $item->name }}
                                        </option>
                                        @endforeach
                                    </select>

                                    <span id="branch_appo_error" class="error-msg-form"></span>

                                    @error('branch_appo')
                                    <span class="error-msg-form">
                                        {{ $message }}
                                    </span>
                                    @enderror

                                </div>

                                <div class="col-12 mb-2">
                                    <label class="form-label">{{ __('basic.doctor') }}
                                        <small>({{ __('basic.required') }})</small></label>

                                    <select
                                        class="myselect2-appo-insert select2-hidden-accessible @error('responsible_doc_app') is-invalid @enderror"
                                        id="responsible_doc_app" name="responsible_doc_app" required>
                                        <option value="1">
                                            1
                                        </option>
                                    </select>

                                    <span id="responsible_doc_app_error" class="error-msg-form"></span>

                                    @error('responsible_doc_app')
                                    <span class="error-msg-form">
                                        {{ $message }}
                                    </span>
                                    @enderror

                                </div>

                                <div class="col-12 mb-2">
                                    <label class="form-label">{{ __('basic.start') }}
                                        <small>({{ __('basic.required') }})</small></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="bi bi-calendar2-week-fill"></i>
                                            </div>
                                        </div>
                                        <input name="appo_date" type="text"
                                            class="form-control datepicker_time bg-white @error('appo_date') is-invalid @enderror"
                                            placeholder="YYYY/MM/DD HM" data-enable-time="true" required>
                                    </div>
                                    <span id="appo_date_error" class="error-msg-form"></span>

                                    @error('appo_date')
                                    <span class="error-msg-form">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>

                            </div>

                            <input name="patient_id" value="{{ $patient->id }}" type="hidden">

                        </div>

                        <div class="modal-footer">
                            <div class="left-side">
                                <button type="button" class="btn btn-default btn-link" data-bs-dismiss="modal">{{
                                    __('basic.never mind') }}</button>
                            </div>
                            <div class="divider"></div>
                            <div class="right-side">
                                <button type="submit" class="btn btn-default btn-link main-color">Add
                                    New</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>

        </div>

        <!-- doctor note Modal -->
        <div class="modal fade" id="appointment_note" tabindex="-1" aria-labelledby="exampleModalLabel2"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content b-r-s-cont border-0">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel2"><i class="fas fa-quote-left me-1"></i>
                            Appointment Doctor Note</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <form class="mb-0" action="{{ route('sett.app_appointment_note', 'sd') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Modal content -->
                        <div class="modal-body px-4">
                            <div class="mb-3">
                                <label class="form-label">{{ __('basic.note') }}
                                    <small></small></label>
                                <textarea id="appointment_note_input" name="note_appointment" class="form-control"
                                    placeholder="Write here your note .." rows="4" spellcheck="false"
                                    date-text="Write here your note .."></textarea>
                            </div>
                            <input type="hidden" name="note_appointment_id">
                        </div>

                        <div class="modal-footer">
                            <div class="left-side">
                                <button type="button" class="btn btn-default btn-link" data-bs-dismiss="modal">{{
                                    __('basic.never mind') }}</button>
                            </div>
                            <div class="divider"></div>
                            <div class="right-side">
                                <button type="submit" class="btn btn-default btn-link main-color">{{ __('basic.save
                                    changes') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>

        <!-- get all related info appointment -->
        <div class="modal fade" id="all_info_appointment" tabindex="-1" role="dialog"
            aria-labelledby="all_info_appointment" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content b-r-s-cont border-0">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-capsules me-1"></i>
                            {{ __('patientappo.last appointment') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <!-- Modal content -->
                    <div class="modal-body px-3 py-3 pt-1 pb-4">


                    </div>

                </div>
            </div>

        </div> <!-- end of all info appointment -->

    </div>


</div>