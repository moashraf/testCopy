<!-- treatments and sessions -->
<div class="col-12 col-lg-4">
    <div class="card shadow mb-4">

        <div id="treat-session" class="carousel slide curr-treament-info-carousel" data-bs-ride="carousel"
            data-bs-interval="false">

            <div class="carousel-indicators dots-radius-carousel" style="bottom: 34px; margin-bottom: 0px;">
                <button type="button" data-bs-target="#treat-session" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#treat-session" data-bs-slide-to="1"
                    aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#treat-session" data-bs-slide-to="2"
                    aria-label="Slide 3"></button>
                <button type="button" data-bs-target="#treat-session" data-bs-slide-to="3"
                    aria-label="Slide 4"></button>
            </div>

            <div class="carousel-inner">

                <!-- Current treatments -->
                <div class="carousel-item active">

                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <span class="m-0 fs-6 me-2 fw-bold clickable-item-pointer">{{ __('basic.treatments')
                                }}</span>
                            <span
                                class="m-0 me-2 text-x link-cust-text text-s fw-bold clickable-item-pointer text-gray-200"
                                data-bs-target="#treat-session" data-bs-slide-to="1" aria-label="Slide 2">
                                {{ __('patientappo.sessions') }}</span>
                            <span
                                class="m-0 me-2 text-x link-cust-text text-s fw-bold clickable-item-pointer text-gray-200"
                                data-bs-target="#treat-session" data-bs-slide-to="2" aria-label="Slide 3">
                                {{ __('basic.laser') }}</span>
                            <span class="m-0 text-x link-cust-text text-s fw-bold clickable-item-pointer text-gray-200"
                                data-bs-target="#treat-session" data-bs-slide-to="3" aria-label="Slide 4">
                                {{ __('basic.package') }}</span>
                        </div>
                        <div class="dropdown no-arrow">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-300"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                aria-labelledby="dropdownMenuLink">
                                <div class="dropdown-header">Dropdown Header:</div>
                                <a class="dropdown-item clickable-item-pointer" data-bs-toggle="modal"
                                    data-bs-target="#addtreatment">{{ __('patientappo.new treatment') }}</a>
                            </div>
                        </div>
                    </div>

                    <!-- Card Body -->

                    @if (!$patient->treatments->isEmpty())
                    <div class="card-body pb-4">

                        @foreach ($patient->treatments as $item)
                        {{-- blade-formatter-disable-next-line --}}
                        @break($loop->index === 3)

                        @if ($item->status == 0)
                        @php
                        $text_color = 'main-color';
                        $msg = __('basic.in prog');
                        @endphp
                        @elseif ($item->status == 1)
                        @php
                        $text_color = 'done-color-btn';
                        $msg = __('patientappo.done');
                        @endphp
                        @endif

                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="me-1 d-flex align-self-center align-items-center me-2 text-truncate">
                                <i class="fas fa-circle me-2 text-xxs mb-0 {{ $text_color }}"></i>

                                <div class="text-truncate">
                                    <h6 class="text-s fw-bold text-gray-700  mb-0">
                                        {{ $item->treatment_cat->name }}</h6>
                                    <p class="text-xs text-gray-300 fw-bold mb-0">{{ $msg }}</p>
                                </div>
                            </div>

                            <div class="text-s text-gray-600 fw-bold">{{ $item->sessions }}<small
                                    class="text-gray-300 text-xxxs">
                                    Sesi</small>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="card-body align-items-center text-center position-relative">
                        <a class="add-new-item stretched-link link-cust-text text-gray-400" href="#"
                            data-bs-toggle="modal" data-bs-target="#addtreatment">
                            <i class="fas fa-plus-circle fa-sm fa-fw fs-4"></i>
                            <p class="fw-light mb-0">You can put your Treatment</p>
                        </a>
                    </div>
                    @endif

                    <!-- Card footer -->
                    <div class="card-footer text-center ">
                        <a class="text-xs link-cust-text text-gray-300 clickable-item-pointer" data-bs-toggle="modal"
                            data-bs-target="#treatment_show">
                            <i class="fas fa-chevron-down"></i> {{ __('basic.more') }}
                        </a>
                    </div>

                </div>


                <!----------- sessions start content ----------->
                <div class="carousel-item">

                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <span class="m-0 fs-6 me-2 fw-bold clickable-item-pointer">{{ __('patientappo.sessions')
                                }}</span>
                            <span
                                class="m-0 text-x me-2 link-cust-text text-s fw-bold clickable-item-pointer text-gray-200"
                                data-bs-target="#treat-session" data-bs-slide-to="2" aria-label="Slide 3">
                                {{ __('basic.laser') }}</span>
                            <span
                                class="m-0 text-x me-2 link-cust-text text-s fw-bold clickable-item-pointer text-gray-200"
                                data-bs-target="#treat-session" data-bs-slide-to="3" aria-label="Slide 4">
                                {{ __('basic.package') }}</span>
                            <span class="m-0 text-x link-cust-text text-s fw-bold clickable-item-pointer text-gray-200"
                                data-bs-target="#treat-session" data-bs-slide-to="0" aria-label="Slide 1">
                                {{ __('basic.treatments') }}</span>
                        </div>
                        <div class="dropdown no-arrow">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-300"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                aria-labelledby="dropdownMenuLink">
                                <div class="dropdown-header">Dropdown Header:</div>
                                <a class="dropdown-item clickable-item-pointer" data-bs-toggle="modal"
                                    data-bs-target="#addsession">{{ __('patientappo.new session') }}</a>
                            </div>
                        </div>
                    </div>

                    <!-- Card Body -->
                    @if (!$patient->sessions->isEmpty())
                    <div id="medicine_card_home" class="card-body align-items-center">

                        @foreach ($patient->sessions as $item)
                        {{-- blade-formatter-disable-next-line --}}
                        @break($loop->index === 3)

                        @if ($item->status == 0)
                        @php
                        $text_color = 'main-color';
                        $msg = __('patientappo.not done');
                        @endphp
                        @elseif ($item->status == 1)
                        @php
                        $text_color = 'done-color-btn';
                        $msg = __('patientappo.done');
                        @endphp
                        @endif

                        @if ($item->invoice_item)
                        @if ($item->invoice_item->invoice->status == 0)
                        @php
                        $text_color_invoice = 'cancel-color-btn';
                        $msg_invoice = __('basic.not paid');
                        @endphp
                        @elseif ($item->invoice_item->invoice->status == 1)
                        @php
                        $text_color_invoice = 'pend-color-btn';
                        $msg_invoice = __('basic.pending');
                        @endphp
                        @elseif ($item->invoice_item->invoice->status == 2)
                        @php
                        $text_color_invoice = 'prog-color-btn';
                        $msg_invoice = __('basic.installment');
                        @endphp
                        @elseif ($item->invoice_item->invoice->status == 3)
                        @php
                        $text_color_invoice = 'done-color-btn';
                        $msg_invoice = __('basic.paid');
                        @endphp
                        @elseif ($item->invoice_item->invoice->status == 4)
                        @php
                        $text_color_invoice = 'cancel-color-btn';
                        $msg_invoice = __('basic.refund');
                        @endphp
                        @endif
                        @else
                        @php
                        $text_color_invoice = 'done-color-btn';
                        $msg_invoice = __('patientappo.old record');
                        @endphp
                        @endif
                        <div class="d-flex justify-content-between align-items-center mb-3">

                            <div class="me-1 d-flex align-self-center align-items-center me-2 text-truncate">
                                <i class="fas fa-circle me-2 text-xxs mb-0 {{ $text_color }}"></i>

                                <div class="text-truncate">
                                    <p class="text-s text-truncate text-gray-700 mb-0 fw-bold">
                                        {{ $item->service_item->name }}</p>
                                    <p class="text-xs text-gray-300 fw-bold mb-0">{{ $msg }}</p>
                                </div>
                            </div>

                            <span class="badge rounded-pill {{ $text_color_invoice }} badge-padd-l">{{ $msg_invoice
                                }}</span>

                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="card-body align-items-center text-center position-relative">
                        <a class="add-new-item stretched-link link-cust-text text-gray-400" href="#"
                            data-bs-toggle="modal" data-bs-target="#addsession">
                            <i class="fas fa-plus-circle fa-sm fa-fw fs-4"></i>
                            <p class="fw-light mb-0">{{ __('patientappo.new session') }}</p>
                        </a>
                    </div>

                    @endif

                    <!-- Card footer session -->
                    <div class="card-footer text-center ">
                        <a class="text-xs link-cust-text text-gray-300" href="#" data-bs-toggle="modal"
                            data-bs-target="#session_show">
                            <i class="fas fa-chevron-down"></i> {{ __('basic.more') }}
                        </a>
                    </div>

                </div>

                <!----------- pulses start content ----------->
                <div class="carousel-item">

                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <span class="m-0 fs-6 me-2 fw-bold clickable-item-pointer">{{ __('basic.laser') }}</span>
                            <span
                                class="m-0 text-x me-2 link-cust-text text-s fw-bold clickable-item-pointer text-gray-200"
                                data-bs-target="#treat-session" data-bs-slide-to="3" aria-label="Slide 4">
                                {{ __('basic.package') }}</span>
                            <span
                                class="m-0 text-x me-2 link-cust-text text-s fw-bold clickable-item-pointer text-gray-200"
                                data-bs-target="#treat-session" data-bs-slide-to="1" aria-label="Slide 2">
                                {{ __('patientappo.session') }}</span>
                            <span class="m-0 text-x link-cust-text text-s fw-bold clickable-item-pointer text-gray-200"
                                data-bs-target="#treat-session" data-bs-slide-to="0" aria-label="Slide 1">
                                {{ __('basic.treatments') }}</span>
                        </div>
                        <div class="dropdown no-arrow">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-300"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                aria-labelledby="dropdownMenuLink">
                                <div class="dropdown-header">Dropdown Header:</div>
                                <a class="dropdown-item clickable-item-pointer" data-bs-toggle="modal"
                                    data-bs-target="#addpulses">{{ __('basic.new pulses') }}</a>
                            </div>
                        </div>
                    </div>

                    <!-- Card Body -->
                    @if (!$patient->hotel->isEmpty())
                    <div id="medicine_card_home" class="card-body align-items-center">

                        @foreach ($patient->hotel as $item)
                        {{-- blade-formatter-disable-next-line --}}
                        @break($loop->index === 3)

                        @if ($item->invoice_item)
                        @if ($item->invoice_item->invoice->status == 0)
                        @php
                        $text_color_invoice = 'cancel-color-btn';
                        $msg_invoice = __('basic.not paid');
                        @endphp
                        @elseif ($item->invoice_item->invoice->status == 1)
                        @php
                        $text_color_invoice = 'pend-color-btn';
                        $msg_invoice = __('basic.pending');
                        @endphp
                        @elseif ($item->invoice_item->invoice->status == 2)
                        @php
                        $text_color_invoice = 'prog-color-btn';
                        $msg_invoice = __('basic.installment');
                        @endphp
                        @elseif ($item->invoice_item->invoice->status == 3)
                        @php
                        $text_color_invoice = 'done-color-btn';
                        $msg_invoice = __('basic.paid');
                        @endphp
                        @elseif ($item->invoice_item->invoice->status == 4)
                        @php
                        $text_color_invoice = 'cancel-color-btn';
                        $msg_invoice = __('basic.refund');
                        @endphp
                        @endif
                        @else
                        @php
                        $text_color_invoice = 'done-color-btn';
                        $msg_invoice = __('basic.from package');
                        @endphp
                        @endif
                        <div class="d-flex justify-content-between align-items-center mb-3">

                            <div class="me-1 d-flex align-self-center align-items-center me-2 text-truncate">
                                <i class="fas fa-circle me-2 text-xxs mb-0 {{ $text_color_invoice }}"></i>

                                <div class="text-truncate">
                                    <p class="text-s text-truncate text-gray-700 mb-0 fw-bold">
                                        @if ($item->service_item)
                                        {{ $item->service_item->name }}
                                        @else
                                        Taken from package
                                        @endif
                                    </p>
                                    <p class="text-xs text-gray-300 fw-bold mb-0">
                                        {{ date('d M Y', strtotime($item->date)) }}</p>
                                </div>
                            </div>

                            <span class="badge rounded-pill {{ $text_color_invoice }} badge-padd-l">{{ $msg_invoice
                                }}</span>

                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="card-body align-items-center text-center position-relative">
                        <a class="add-new-item stretched-link link-cust-text text-gray-400" href="#"
                            data-bs-toggle="modal" data-bs-target="#addpulses">
                            <i class="fas fa-plus-circle fa-sm fa-fw fs-4"></i>
                            <p class="fw-light mb-0">{{ __('basic.new pulses') }}</p>
                        </a>
                    </div>

                    @endif

                    <!-- Card footer session -->
                    <div class="card-footer text-center ">
                        <a class="text-xs link-cust-text text-gray-300" href="#" data-bs-toggle="modal"
                            data-bs-target="#pulses_show">
                            <i class="fas fa-chevron-down"></i> {{ __('basic.more') }}
                        </a>
                    </div>

                </div>

                <!----------- pulses start content ----------->
                <div class="carousel-item">

                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <span class="m-0 fs-6 me-2 fw-bold clickable-item-pointer">{{ __('basic.package') }}</span>
                            <span
                                class="m-0 text-x link-cust-text text-s me-2 fw-bold clickable-item-pointer text-gray-200"
                                data-bs-target="#treat-session" data-bs-slide-to="2" aria-label="Slide 3">
                                {{ __('basic.laser') }}</span>
                            <span
                                class="m-0 text-x me-2 link-cust-text text-s fw-bold clickable-item-pointer text-gray-200"
                                data-bs-target="#treat-session" data-bs-slide-to="1" aria-label="Slide 2">
                                {{ __('patientappo.session') }}</span>
                            <span
                                class="m-0 text-x me-2 link-cust-text text-s fw-bold clickable-item-pointer text-gray-200"
                                data-bs-target="#treat-session" data-bs-slide-to="0" aria-label="Slide 1">
                                {{ __('basic.treatments') }}</span>
                        </div>
                        <div class="dropdown no-arrow">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-300"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                aria-labelledby="dropdownMenuLink">
                                <div class="dropdown-header">Dropdown Header:</div>
                                <a class="dropdown-item clickable-item-pointer" data-bs-toggle="modal"
                                    data-bs-target="#addpackage">{{ __('basic.new package') }}</a>
                            </div>
                        </div>
                    </div>

                    <!-- Card Body -->
                    @if (!$patient->package->isEmpty())
                    <div id="medicine_card_home" class="card-body align-items-center">

                        @foreach ($patient->package as $item)
                        {{-- blade-formatter-disable-next-line --}}
                        @break($loop->index === 3)

                        @if ($item->invoice_item)
                        @if ($item->invoice_item->invoice->status == 0)
                        @php
                        $text_color_invoice = 'cancel-color-btn';
                        $msg_invoice = __('basic.not paid');
                        @endphp
                        @elseif ($item->invoice_item->invoice->status == 1)
                        @php
                        $text_color_invoice = 'pend-color-btn';
                        $msg_invoice = __('basic.pending');
                        @endphp
                        @elseif ($item->invoice_item->invoice->status == 2)
                        @php
                        $text_color_invoice = 'prog-color-btn';
                        $msg_invoice = __('basic.installment');
                        @endphp
                        @elseif ($item->invoice_item->invoice->status == 3)
                        @php
                        $text_color_invoice = 'done-color-btn';
                        $msg_invoice = __('basic.paid');
                        @endphp
                        @elseif ($item->invoice_item->invoice->status == 4)
                        @php
                        $text_color_invoice = 'cancel-color-btn';
                        $msg_invoice = __('basic.refund');
                        @endphp
                        @endif
                        @else
                        @php
                        $text_color_invoice = 'done-color-btn';
                        $msg_invoice = __('patientappo.old record');
                        @endphp
                        @endif
                        <div class="d-flex justify-content-between align-items-center mb-3">

                            <div class="me-1 d-flex align-self-center align-items-center me-2 text-truncate">
                                <i class="fas fa-circle me-2 text-xxs mb-0 {{ $text_color_invoice }}"></i>

                                <div class="text-truncate">
                                    <p class="text-s text-truncate text-gray-700 mb-0 fw-bold">
                                        {{ $item->service_item->name }}
                                    </p>
                                    <p class="text-xs text-gray-300 fw-bold mb-0">
                                        {{ date('d M Y', strtotime($item->date)) }}</p>
                                </div>
                            </div>

                            <span class="badge rounded-pill {{ $text_color_invoice }} badge-padd-l">{{ $msg_invoice
                                }}</span>

                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="card-body align-items-center text-center position-relative">
                        <a class="add-new-item stretched-link link-cust-text text-gray-400" href="#"
                            data-bs-toggle="modal" data-bs-target="#addpackage">
                            <i class="fas fa-plus-circle fa-sm fa-fw fs-4"></i>
                            <p class="fw-light mb-0">{{ __('basic.new package') }}</p>
                        </a>
                    </div>

                    @endif

                    <!-- Card footer session -->
                    <div class="card-footer text-center ">
                        <a class="text-xs link-cust-text text-gray-300" href="#" data-bs-toggle="modal"
                            data-bs-target="#package_show">
                            <i class="fas fa-chevron-down"></i> {{ __('basic.more') }}
                        </a>
                    </div>

                </div>

            </div>


            <!-- Modal show all treatment -->
            <div class="modal fade" id="treatment_show" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
                    <div class="modal-content b-r-s-cont border-0">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"><i class="fas fas fa-x-ray me-1"></i>
                                Treatment</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <!-- Modal content -->
                        <div class="modal-body px-4">

                            <div class="table-responsive">
                                <table class="table display datatable-modal" id="table-treatment" width="100%"
                                    cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th class="text-xs">{{ __('basic.id') }}</th>
                                            <th class="text-xs">{{ __('basic.name') }}</th>
                                            <th class="text-xs text-center">{{ __('basic.start') }}</th>
                                            <th class="text-xs text-center">{{ __('basic.end') }}</th>
                                            <th class="text-xs text-center">{{ __('patientappo.sessions') }}
                                            </th>
                                            <th class="text-xs text-center">
                                                {{ __('patientappo.sessions done') }}</th>
                                            <th class="text-xs text-center">{{ __('basic.status') }}</th>
                                            <th class="text-xs text-center">{{ __('basic.handle') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($patient->treatments as $item)
                                        @if ($item->status == 0)
                                        @php
                                        $text_color = 'active-color-btn';
                                        $msg = __('basic.in prog');
                                        @endphp
                                        @elseif ($item->status == 1)
                                        @php
                                        $text_color = 'done-color-btn';
                                        $msg = __('patientappo.done');
                                        @endphp
                                        @endif

                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td class="">
                                                {{ $item->treatment_cat->name }}</td>
                                            <td>{{ $item->start }}</td>
                                            <td class="text-center">{{ $item->end }}</td>
                                            <td class="text-center">{{ $item->sessions }}</td>
                                            <td class="text-center">{{ $item->sessions_done }}</td>
                                            <td class="text-center"> <span
                                                    class="badge rounded-pill {{ $text_color }} badge-padd-l">{{ $msg
                                                    }}</span>
                                            </td>

                                            <td class="text-center">
                                                <a data-treatment_id="{{ $item->id }}"
                                                    data-treatment_cat_id="{{ $item->treatment_cat->id }}"
                                                    data-status_treatment="{{ $item->status }}"
                                                    data-sessions="{{ $item->sessions }}"
                                                    data-sessions_done="{{ $item->sessions_done }}"
                                                    data-start="{{ $item->start }}" data-end="{{ $item->end }}"
                                                    class="btn btn-sm status-col-link active-color-btn b-r-xs mb-1 treatment_edit_click"
                                                    title="edit"><i class="fas fa-pencil-alt"></i>
                                                    {{ __('basic.edit') }} </a>

                                                <a data-treatment_id="{{ $item->id }}"
                                                    class="btn btn-sm status-col-link active-color-btn b-r-xs mb-1 treatment_newsession_click"
                                                    title="edit"><i class="fas fa-pencil-alt"></i>
                                                    {{ __('patientappo.new session') }} </a>

                                                <a data-treatment_id="{{ $item->id }}"
                                                    class="btn btn-sm modal-effect status-col-link cancel-color-btn b-r-xs mb-1 treatment_delete_click"
                                                    title="delete" data-effect="effect-scale"><i
                                                        class="fas fa-trash"></i>
                                                    {{ __('basic.delete') }}
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
                                    changes') }}</button>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

            <!-- Modal treatment insert data -->
            <div class="modal fade" id="addtreatment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content b-r-s-cont border-0">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"><i class="fas fas fa-x-ray me-1"></i>
                                {{ __('patientappo.new treatment') }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <form action="{{ route('sett.treatment.store') }}" method="post">
                            {{ method_field('POST') }}
                            {{ csrf_field() }}

                            <!-- Modal content -->
                            <div class="modal-body px-5 py-3">

                                <div class="row mb-2">

                                    <div class="col-12 mb-2">
                                        <label class="form-label">{{ __('basic.treatment') }}
                                            <small>({{ __('basic.required') }})</small></label>
                                        <select
                                            class="myselect2-treatment-insert select2-hidden-accessible @error('treatment_cat') is-invalid @enderror"
                                            id="treatment_cat" name="treatment_cat" required>
                                            @foreach ($treatment_cat as $item)
                                            <option value="{{ $item->id }}">
                                                {{ $item->name }}
                                            </option>
                                            @endforeach
                                        </select>

                                        <span id="treatment_cat_error" class="error-msg-form"></span>

                                        @error('treatment_cat')
                                        <span class="error-msg-form">
                                            {{ $message }}
                                        </span>
                                        @enderror

                                    </div>

                                    <div class="col-12 mb-2">
                                        <label class="form-label"> {{ __('patientappo.sessions') }}
                                            <small>({{ __('basic.required') }})</small></label>

                                        <input name="treatment_session" type="number"
                                            class="form-control @error('treatment_session') is-invalid @enderror"
                                            placeholder="How many session?" required>

                                        <span id="treatment_session_error" class="error-msg-form"></span>

                                        @error('treatment_session')
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
                                            <input name="treatment_start" type="text"
                                                class="form-control hasdatetimepicker @error('treatment_start') is-invalid @enderror"
                                                placeholder="YYYY/MM/DD" required>
                                        </div>
                                        <span id="treatment_start_error" class="error-msg-form"></span>

                                        @error('treatment_start')
                                        <span class="error-msg-form">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="col-12 mb-2">
                                        <label class="form-label">{{ __('basic.end') }}
                                            <small>({{ __('basic.required') }})</small></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"><i class="bi bi-calendar2-week-fill"></i>
                                                </div>
                                            </div>
                                            <input name="treatment_end" type="text"
                                                class="form-control hasdatetimepicker @error('treatment_end') is-invalid @enderror"
                                                placeholder="YYYY/MM/DD">
                                        </div>
                                        <span id="treatment_end_error" class="error-msg-form"></span>

                                        @error('treatment_end')
                                        <span class="error-msg-form">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="col-12 mb-2">
                                        <label class="form-label">{{ __('basic.appointment') }}
                                            <small>({{ __('basic.required') }})</small></label>
                                        <select
                                            class="myselect2-treatment-insert select2-hidden-accessible @error('last_appointment_id') is-invalid @enderror"
                                            id="last_appointment_id_trea" name="last_appointment_id" required>
                                            @foreach ($patient->appointments as $item)
                                            <option value="{{ $item->id }}">
                                                {{ $item->start_at }}
                                            </option>
                                            @endforeach
                                        </select>

                                        <span id="last_appointment_id_error" class="error-msg-form"></span>

                                        @error('last_appointment_id')
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

            <!-- Modal treatment update data -->
            <div class="modal fade" id="treatment_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content b-r-s-cont border-0">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-capsules me-1"></i>
                                Edit treatment</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <form class="mb-0" action="{{ route('sett.treatment.update', '21') }}" method="POST">
                            @csrf
                            @method('PUT')

                            <!-- Modal content -->
                            <div class="modal-body px-5 py-3">

                                <div class="row mb-2">

                                    <div class="col-12 mb-2">
                                        <label class="form-label">{{ __('basic.treatment') }}
                                            <small>({{ __('basic.required') }})</small></label>

                                        <select
                                            class="myselect2-treatment-update select2-hidden-accessible @error('treatment_cat_update') is-invalid @enderror"
                                            id="treatment_cat_update" name="treatment_cat_update" required>
                                            @foreach ($treatment_cat as $item)
                                            <option value="{{ $item->id }}">
                                                {{ $item->name }}
                                            </option>
                                            @endforeach
                                        </select>

                                        <span id="treatment_cat_update_error" class="error-msg-form"></span>

                                        @error('treatment_cat_update')
                                        <span class="error-msg-form">
                                            {{ $message }}
                                        </span>
                                        @enderror

                                    </div>


                                    <div class="col-12 mb-2">
                                        <label class="form-label"> {{ __('patientappo.sessions') }}
                                            <small>({{ __('basic.required') }})</small></label>

                                        <input name="treatment_session_update" type="number"
                                            class="form-control @error('treatment_session_update') is-invalid @enderror"
                                            placeholder="How many session?" required>

                                        <span id="treatment_session_update_error" class="error-msg-form"></span>

                                        @error('treatment_session_update')
                                        <span class="error-msg-form">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="col-12 mb-2">
                                        <label class="form-label">Sessions Done
                                            <small>({{ __('basic.required') }})</small></label>

                                        <input name="treatment_session_done_update" type="number"
                                            class="form-control @error('treatment_session_done_update') is-invalid @enderror"
                                            placeholder="How many session?">

                                        <span id="treatment_session_done_update_error" class="error-msg-form"></span>

                                        @error('treatment_session_done_update')
                                        <span class="error-msg-form">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="col-12 mb-2">
                                        <label class="form-label">{{ __('basic.status') }}
                                            <small>({{ __('basic.required') }})</small></label>
                                        <select
                                            class="select2-no-search-treatment select2-hidden-accessible select2-no-search-treatment @error('status_treatment_update') is-invalid @enderror"
                                            id="status_treatment_update" name="status_treatment_update" required>
                                            <option value="0">
                                                {{ __('basic.in prog') }}
                                            </option>
                                            <option value="1">
                                                {{ __('patientappo.done') }}
                                            </option>
                                        </select>

                                        <span id="status_treatment_update_error" class="error-msg-form"></span>

                                        @error('status_treatment_update')
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
                                            <input name="treatment_start_update" type="text"
                                                class="form-control hasdatetimepicker @error('treatment_start_update') is-invalid @enderror"
                                                placeholder="YYYY/MM/DD" required>
                                        </div>
                                        <span id="treatment_start_update_error" class="error-msg-form"></span>

                                        @error('treatment_start_update')
                                        <span class="error-msg-form">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="col-12 mb-2">
                                        <label class="form-label">{{ __('basic.end') }}
                                            <small>({{ __('basic.required') }})</small></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"><i class="bi bi-calendar2-week-fill"></i>
                                                </div>
                                            </div>
                                            <input name="treatment_end_update" type="text"
                                                class="form-control hasdatetimepicker @error('treatment_end_update') is-invalid @enderror"
                                                placeholder="YYYY/MM/DD" required>
                                        </div>

                                        @error('treatment_end_update')
                                        <span class="error-msg-form">
                                            {{ $message }}
                                        </span>
                                        @enderror

                                        <span id="treatment_end_update_error" class="error-msg-form"></span>
                                    </div>


                                </div>

                                <input name="treatment_id_update" value="" type="hidden">

                            </div>

                            <div class="modal-footer">
                                <div class="left-side">
                                    <button type="button" class="btn btn-default btn-link" data-bs-dismiss="modal">{{
                                        __('basic.never mind') }}</button>
                                </div>
                                <div class="divider"></div>
                                <div class="right-side">
                                    <button type="submit" class="btn btn-default btn-link main-color">{{
                                        __('basic.update') }}</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>

            </div>

            <!-- treatment Modal delete -->
            <div class="modal fade" id="treatment_delete" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable ">

                    <div class="modal-content shadow-lgg b-r-s-cont border-0">

                        <div class="modal-header">
                            <div class="modal-title" id="exampleModalLabel"><i class="fas fa-trash me-1"></i>
                                {{ __('basic.delete') }}</div>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <form action="{{ route('sett.treatment.destroy', 'test') }}" method="post">
                            {{ method_field('delete') }}
                            {{ csrf_field() }}

                            <!-- Modal content -->
                            <div class="modal-body px-4">

                                <div class="modal-body delete-conf-input text-center py-0">
                                    <p class="mb-0">ِAre
                                        you sure you want to delete
                                        this
                                        treatment?</p><br>
                                    <input type="hidden" name="treatment_id_delete" value="">
                                </div>
                            </div>

                            <div class="modal-footer">
                                <div class="left-side">
                                    <button type="button" class="btn btn-default btn-link" data-bs-dismiss="modal">{{
                                        __('basic.never mind') }}</button>
                                </div>
                                <div class="divider"></div>
                                <div class="right-side">
                                    <button type="submit" class="btn btn-default btn-link text-red">{{
                                        __('basic.delete') }}
                                    </button>
                                </div>

                            </div>
                        </form>

                    </div>
                </div>
            </div>

            <!-- Modal show all session -->
            <div class="modal fade" id="session_show" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
                    <div class="modal-content b-r-s-cont border-0">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"><i class="fas fas fa-capsules me-1"></i>
                                {{ __('patientappo.session') }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <!-- Modal content -->
                        <div class="modal-body px-4">

                            <div class="table-responsive">
                                <table class="table display datatable-modal" id="table-session" width="100%"
                                    cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th class="text-xs">{{ __('basic.date') }}</th>
                                            <th class="text-xs">{{ __('basic.name') }}</th>
                                            <th class="text-xs text-center">
                                                {{ __('patientappo.session status') }}</th>
                                            <th class="text-xs text-center">{{ __('patientappo.pay status') }}
                                            </th>
                                            <th class="text-xs text-center">{{ __('patientappo.pay Code') }}
                                            </th>
                                            <th class="text-xs text-center">{{ __('patientappo.treat id') }}
                                            </th>
                                            <th class="text-xs text-center">
                                                {{ __('patientappo.treat sessions') }}</th>
                                            <th class="text-xs text-center">{{ __('basic.handle') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($patient->sessions as $item)
                                        @if ($item->status == 0)
                                        @php
                                        $text_color = 'active-color-btn';
                                        $msg = __('patientappo.not done');
                                        @endphp
                                        @elseif ($item->status == 1)
                                        @php
                                        $text_color = 'done-color-btn';
                                        $msg = __('basic.done');
                                        @endphp
                                        @endif

                                        @if ($item->invoice_item)
                                        @if ($item->invoice_item->invoice->status == 0)
                                        @php
                                        $text_color_invoice = 'cancel-color-btn';
                                        $msg_invoice = __('basic.not paid');
                                        @endphp
                                        @elseif ($item->invoice_item->invoice->status == 1)
                                        @php
                                        $text_color_invoice = 'pend-color-btn';
                                        $msg_invoice = __('basic.pending');
                                        @endphp
                                        @elseif ($item->invoice_item->invoice->status == 2)
                                        @php
                                        $text_color_invoice = 'prog-color-btn';
                                        $msg_invoice = __('basic.installment');
                                        @endphp
                                        @elseif ($item->invoice_item->invoice->status == 3)
                                        @php
                                        $text_color_invoice = 'done-color-btn';
                                        $msg_invoice = __('basic.paid');
                                        @endphp
                                        @elseif ($item->invoice_item->invoice->status == 4)
                                        @php
                                        $text_color_invoice = 'cancel-color-btn';
                                        $msg_invoice = __('basic.refund');
                                        @endphp
                                        @endif
                                        @php
                                        $invoice_url = 'href=' . route('sett.invoice.show',
                                        $item->invoice_item->invoice->id);
                                        @endphp
                                        @else
                                        @php
                                        $text_color_invoice = 'done-color-btn';
                                        $msg_invoice = __('patientappo.old record');
                                        $invoice_url = '';
                                        @endphp
                                        @endif

                                        <tr>
                                            <td>{{ date('d M Y', strtotime($item->date)) }}</td>
                                            <td>{{ $item->service_item->name }}</td>
                                            <td class="text-center"> <span
                                                    class="badge rounded-pill {{ $text_color }} badge-padd-l">{{ $msg
                                                    }}</span>
                                            </td>
                                            <td class="text-center">
                                                <a {{ $invoice_url }}><span
                                                        class="badge rounded-pill {{ $text_color_invoice }} badge-padd-l">{{
                                                        $msg_invoice }}</span></a>
                                            </td>
                                            <td class="text-center">
                                                @if ($item->invoice_item)
                                                {{ $item->invoice_item->invoice->code }}
                                                @else
                                                {{ __('patientappo.old record') }}
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if (!empty($item->treatment->id))
                                                {{ $item->treatment->id }}
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if (!empty($item->treatment->sessions))
                                                {{ $item->treatment->sessions }}
                                                @endif
                                            </td>

                                            <td class="text-center">
                                                <a data-session_id="{{ $item->id }}"
                                                    data-status_session="{{ $item->status }}"
                                                    data-treat_id="@if (!empty($item->treatment->id)) {{ $item->treatment->id }} @endif"
                                                    class="btn btn-sm status-col-link active-color-btn b-r-xs mb-1 session_edit_click"
                                                    title="edit"><i class="fas fa-pencil-alt"></i>
                                                    {{ __('basic.edit') }} </a>

                                                @if ($item->invoice_item)
                                                @if ($item->invoice_item->invoice->status == 0)
                                                <a data-session_id="{{ $item->id }}"
                                                    class="btn btn-sm modal-effect status-col-link cancel-color-btn b-r-xs mb-1 session_delete_click"
                                                    title="delete" data-effect="effect-scale" data-bs-toggle="modal"
                                                    data-bs-target="#delete1"><i class="fas fa-trash"></i>
                                                    {{ __('basic.delete') }}
                                                </a>
                                                @endif
                                                @endif

                                            </td>

                                        </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <div class="left-side">
                                <button type="button" class="btn btn-default btn-link" data-bs-dismiss="modal">
                                    {{ __('basic.never mind') }}</button>
                            </div>
                            <div class="divider"></div>
                            <div class="right-side">
                                <button type="button" class="btn btn-default btn-link main-color">{{ __('basic.save
                                    changes') }}</button>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

            <!-- Modal session update data -->
            <div class="modal fade" id="session_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content b-r-s-cont border-0">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-capsules me-1"></i>
                                Update Session</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <form class="mb-0" action="{{ route('sett.session.update', '21') }}" method="POST">
                            @csrf
                            @method('PUT')

                            <!-- Modal content -->
                            <div class="modal-body px-5 py-3">

                                <div class="row mb-2">


                                    <div class="col-12 mb-2">
                                        <label class="form-label">{{ __('basic.status') }}
                                            <small>({{ __('basic.required') }})</small></label>
                                        <select
                                            class="select2-no-search-session select2-hidden-accessible select2-no-search-medicine @error('status_session_update') is-invalid @enderror"
                                            id="status_session_update" name="status_session_update" required>
                                            <option value="0">
                                                {{ __('patientappo.not done') }}
                                            </option>
                                            <option value="1">
                                                {{ __('patientappo.done') }}
                                            </option>
                                        </select>

                                        <span id="status_update_update_error" class="error-msg-form"></span>

                                        @error('status_update_update')
                                        <span class="error-msg-form">
                                            {{ $message }}
                                        </span>
                                        @enderror

                                    </div>


                                    <div class="col-12 mb-2">
                                        <label class="form-label">{{ __('patientappo.related to treatment') }}
                                            <small>( {{ __('basic.required') }})</small></label>

                                        <select
                                            class="myselect2-session-update select2-hidden-accessible @error('related_treatment_id_update') is-invalid @enderror"
                                            id="related_treatment_id_update" name="related_treatment_id_update">
                                            @foreach ($patient->treatments as $item)
                                            @if ($item->status == 0)
                                            <option value="{{ $item->id }}">
                                                {{ $item->treatment_cat->name . ' - ' . $item->start }}
                                            </option>
                                            @endif
                                            @endforeach
                                        </select>

                                        <span id="related_treatment_id_update_error" class="error-msg-form"></span>

                                        @error('related_treatment_id_update')
                                        <span class="error-msg-form">
                                            {{ $message }}
                                        </span>
                                        @enderror

                                    </div>


                                </div>

                                <input name="session_id_update" value="" type="hidden">

                            </div>

                            <div class="modal-footer">
                                <div class="left-side">
                                    <button type="button" class="btn btn-default btn-link" data-bs-dismiss="modal">{{
                                        __('basic.never mind') }}</button>
                                </div>
                                <div class="divider"></div>
                                <div class="right-side">
                                    <button type="submit" class="btn btn-default btn-link main-color">{{
                                        __('basic.update') }}</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>

            </div>

            <!-- session delete -->
            <div class="modal fade" id="session_delete" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable ">

                    <div class="modal-content shadow-lgg b-r-s-cont border-0">

                        <div class="modal-header">
                            <div class="modal-title" id="exampleModalLabel"><i class="fas fa-trash me-1"></i>
                                {{ __('patientappo.session delete') }}</div>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <form class="mb-0" action="{{ route('sett.session.destroy', 'test') }}" method="post">
                            {{ method_field('delete') }}
                            {{ csrf_field() }}

                            <!-- Modal content -->
                            <div class="modal-body px-4">

                                <div class="modal-body delete-conf-input text-center py-0">
                                    <p class="mb-0">ِAre
                                        you sure you want to delete
                                        this
                                        session?</p><br>
                                    <input type="hidden" name="session_id_delete" value="">
                                </div>
                            </div>

                            <div class="modal-footer">
                                <div class="left-side">
                                    <button type="button" class="btn btn-default btn-link" data-bs-dismiss="modal">{{
                                        __('basic.never mind') }}</button>
                                </div>
                                <div class="divider"></div>
                                <div class="right-side">
                                    <button type="submit" class="btn btn-default btn-link text-red">{{
                                        __('basic.delete') }}
                                    </button>
                                </div>

                            </div>
                        </form>

                    </div>
                </div>
            </div>

            <!-- Modal add new session insert data -->
            <div class="modal fade" id="addsession" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">

                    <form class="mb-0" action="{{ route('sett.session.store') }}" method="post"
                        style="display: contents">
                        {{ method_field('POST') }}
                        {{ csrf_field() }}

                        <div class="modal-content b-r-s-cont border-0">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-capsules me-1"></i>
                                    {{ __('patientappo.new session') }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>

                            <!-- Modal content -->
                            <div class="modal-body px-5 py-3">

                                <div class="row mb-2">
                                    <div class="col-12 mb-2">
                                        <label class="form-label">{{ __('patientappo.session') }}
                                            <small>({{ __('basic.required') }})</small></label>
                                        <select
                                            class="myselect2-session-insert select2-hidden-accessible @error('session_cat_service') is-invalid @enderror"
                                            id="session_cat_service_insert" multiple name="session_cat_service[]"
                                            required>
                                            @foreach ($service_cat_ses as $item)
                                            <option value="{{ $item->id }}" data-price="{{ $item->price }}">
                                                {{ $item->name . ' - ' . $item->price . 'EGP' }}
                                            </option>
                                            @endforeach
                                        </select>

                                        <span id="session_cat_service_error" class="error-msg-form"></span>

                                        @error('session_cat_service')
                                        <span class="error-msg-form">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="col-12 mb-3">
                                        <label class="form-label">{{ __('basic.doctor') }}
                                            <small>({{ __('basic.required') }})</small></label>

                                        <select
                                            class="myselect2-session-insert select2-hidden-accessible @error('doc_session') is-invalid @enderror"
                                            id="doc_session" name="doc_session" required>
                                            @foreach ($doctors as $item)
                                            <option value="{{ $item->id }}">
                                                {{ $item->name }}
                                            </option>
                                            @endforeach
                                        </select>

                                        <span id="doc_session_error" class="error-msg-form"></span>

                                        @error('doc_session')
                                        <span class="error-msg-form">
                                            {{ $message }}
                                        </span>
                                        @enderror

                                    </div>

                                    <div class="col-12 mb-2">
                                        <label class="form-label">{{ __('basic.status') }}
                                            <small>({{ __('basic.required') }})</small></label>
                                        <select
                                            class="myselect2-session-insert-nosearch select2-hidden-accessible @error('session_status') is-invalid @enderror"
                                            id="session_status" name="session_status" required>
                                            <option value="0">
                                                {{ __('patientappo.new record') }}
                                            </option>
                                            <option value="1">
                                                {{ __('patientappo.old record') }}
                                            </option>
                                        </select>

                                        <span id="session_status_error" class="error-msg-form"></span>

                                        @error('session_status')
                                        <span class="error-msg-form">
                                            {{ $message }}
                                        </span>
                                        @enderror

                                    </div>

                                    <div class="col-12 mb-2">
                                        <label class="form-label">{{ __('patientappo.related to treatment') }}
                                            <small>({{ __('basic.optional') }})</small></label>
                                        <select
                                            class="myselect2-session-insert select2-hidden-accessible @error('related_treatment_id') is-invalid @enderror"
                                            id="related_treatment_id" name="related_treatment_id">
                                            <option disabled selected value> -- select treatment -- </option>
                                            @foreach ($patient->treatments as $item)
                                            @if ($item->status == 0)
                                            <option value="{{ $item->id }}">
                                                {{ $item->treatment_cat->name . ' - ' . $item->start }}
                                            </option>
                                            @endif
                                            @endforeach
                                        </select>

                                        <span id="related_treatment_id_error" class="error-msg-form"></span>

                                        @error('related_treatment_id')
                                        <span class="error-msg-form">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="col-12 mb-2">
                                        <label class="form-label">{{ __('basic.date') }}
                                            <small>({{ __('basic.required') }})</small></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"><i class="bi bi-calendar2-week-fill"></i>
                                                </div>
                                            </div>
                                            <input name="session_date" type="text"
                                                class="form-control hasdatetimepicker @error('session_date') is-invalid @enderror"
                                                placeholder="YYYY/MM/DD" required>
                                        </div>
                                        <span id="session_date_error" class="error-msg-form"></span>

                                        @error('session_date')
                                        <span class="error-msg-form">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>

                                    <hr class="my-2">

                                    <div class="col-12 mb-2">
                                        <label class="form-label">{{ __('basic.appointment') }}
                                            <small>({{ __('basic.required') }})</small></label>
                                        <select
                                            class="myselect2-session-insert-nosearch select2-hidden-accessible @error('last_appointment_id') is-invalid @enderror"
                                            id="last_appointment_id_pulses" name="last_appointment_id" required>
                                            @foreach ($patient->appointments as $item)
                                            <option value="{{ $item->id }}">
                                                {{ $item->start_at }}
                                            </option>
                                            @endforeach
                                        </select>

                                        <span id="last_appointment_id_error" class="error-msg-form"></span>

                                        @error('last_appointment_id')
                                        <span class="error-msg-form">
                                            {{ $message }}
                                        </span>
                                        @enderror

                                    </div>

                                    <div class="col-12 mb-2">
                                        <label class="form-label">{{ __('basic.invoice') }}
                                            <small>({{ __('basic.required') }})</small></label>
                                        <select
                                            class="myselect2-session-insert-nosearch @error('session_cat_service') is-invalid @enderror"
                                            id="session_cat_invoice_insert" name="session_cat_invoice" required>
                                            <option value="new">New Invoice</option>
                                            <option value="wallet">Wallet</option>
                                            @foreach ($patient->invoices as $item)
                                            @if ($item->status == 0)
                                            <option value="{{ $item->id }}">
                                                {{ $item->service_inv_cat->name . ' - ' . $item->final_price . 'EGP' }}
                                            </option>
                                            @endif
                                            @endforeach
                                        </select>

                                        <span id="session_cat_invoice_error" class="error-msg-form"></span>

                                        @error('session_cat_invoice')
                                        <span class="error-msg-form">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="col-12 mb-2">
                                        <label class="form-label">{{ __('basic.invoice note') }}
                                            <small>({{ __('basic.optional') }})</small></label>
                                        <textarea name="invoice_note" class="form-control"
                                            placeholder="Write here your notes .." rows="4"
                                            spellcheck="false"></textarea>

                                        <span id="session_cat_invoice_error" class="error-msg-form"></span>

                                        @error('invoice_note')
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

                        </div>
                    </form>

                </div>

            </div>

            <!-- Modal add new pulses insert data -->
            <div class="modal fade" id="addpulses" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">

                    <form class="mb-0" action="{{ route('sett.pulses.store') }}" method="post"
                        style="display: contents">
                        {{ method_field('POST') }}
                        {{ csrf_field() }}

                        <div class="modal-content b-r-s-cont border-0">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-capsules me-1"></i>
                                    {{ __('basic.new pulses') }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>

                            <!-- Modal content -->
                            <div class="modal-body px-5 py-3">

                                <div class="row mb-2">

                                    <div class="col-12 mb-3">
                                        <label class="form-label">{{ __('basic.type') }}
                                            <small>({{ __('basic.required') }})</small></label>
                                        <select
                                            class="myselect2-pulses-insert-nosearch select2-hidden-accessible @error('pulses_type') is-invalid @enderror"
                                            id="pulses_type" name="pulses_type" required>
                                            <option value="0">
                                                {{ __('patientappo.session') }}
                                            </option>
                                            <option value="1">
                                                {{ __('basic.money per pulse') }}
                                            </option>
                                            <option value="2">
                                                {{ __('basic.from session package') }}
                                            </option>
                                            <option value="3">
                                                {{ __('basic.from pulses package') }}
                                            </option>
                                            <option value="4">
                                                {{ __('basic.free session') }}
                                            </option>
                                        </select>

                                        <span id="pulses_type_error" class="error-msg-form"></span>

                                        @error('pulses_type')
                                        <span class="error-msg-form">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>


                                    <div class="col-12 mb-2" id="pulses_record_cont">
                                        <label class="form-label">{{ __('basic.status') }}
                                            <small>({{ __('basic.required') }})</small></label>
                                        <select
                                            class="myselect2-pulses-insert-nosearch select2-hidden-accessible @error('pulses_record') is-invalid @enderror"
                                            id="pulses_record" name="pulses_record" required>
                                            <option value="0">
                                                {{ __('patientappo.new record') }}
                                            </option>
                                            <option value="1">
                                                {{ __('patientappo.old record') }}
                                            </option>
                                        </select>

                                        <span id="pulses_record_error" class="error-msg-form"></span>

                                        @error('pulses_record')
                                        <span class="error-msg-form">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>

                                    <div id="pulses_serv_item_sess_cont" class="col-12 mb-3">
                                        <label class="form-label">{{ __('patientappo.session') }}
                                            <small>({{ __('basic.required') }})</small></label>
                                        <select
                                            class="myselect2-pulses-insert select2-hidden-accessible @error('pulses_serv_item_sess') is-invalid @enderror"
                                            id="pulses_serv_item_sess" name="pulses_serv_item_sess" required>
                                            @foreach ($service_cat_pulses as $item)
                                            @if ($item->package == 0 && $item->id != 2 && $item->id != 3)
                                            <option value="{{ $item->id }}" data-price="{{ $item->price }}">
                                                {{ $item->name . ' - ' . $item->price . ' EGP ' . $item->pulses . ' ps'
                                                }}
                                            </option>
                                            @endif
                                            @endforeach
                                        </select>

                                        <span id="pulses_serv_item_sess_error" class="error-msg-form"></span>

                                        @error('pulses_serv_item_sess')
                                        <span class="error-msg-form">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>

                                    <div id="sessions_serv_item_package_cont" class="col-12 mb-3" style="display: none">

                                        <label class="form-label">{{ __('basic.package') }}
                                            <small>({{ __('basic.required') }})</small></label>
                                        <select
                                            class="myselect2-pulses-insert select2-hidden-accessible @error('session_serv_item_package') is-invalid @enderror"
                                            id="session_serv_item_package" name="session_serv_item_package" required
                                            disabled>
                                            @foreach ($patient->package as $item)
                                            @if ($item->type == 1 && $item->items_number_left > 0)
                                            <option value="{{ $item->id }}"
                                                data-balance="{{ $item->items_number_left }}">
                                                {{ $item->service_item->name . ' - ' . $item->items_number_left . 'left'
                                                }}
                                            </option>
                                            @endif
                                            @endforeach
                                        </select>

                                        <span id="session_serv_item_package" class="error-msg-form"></span>

                                        @error('session_serv_item_package')
                                        <span class="error-msg-form">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="col-12 mb-3" id="patient_balance_cont" style="display: none">
                                        <label class="form-label"> {{ __('basic.balance') }}</label>

                                        <input type="number" id="pt_puls_balance" class="form-control"
                                            value="{{ $patient->balance }}" disabled>
                                    </div>

                                    <div id="pulses_no_balance" class="p-4 text-center" style="display: none">
                                        Sorry, there is no available balance
                                    </div>

                                    <div id="pulses_details_cont">

                                        <div class="col-12 mb-3">
                                            <label class="form-label">{{ __('basic.doctor') }}
                                                <small>({{ __('basic.required') }})</small></label>

                                            <select
                                                class="myselect2-pulses-insert select2-hidden-accessible @error('responsible_doc_pulses') is-invalid @enderror"
                                                id="responsible_doc_pulses" name="responsible_doc_pulses" required>
                                                @foreach ($doctors as $item)
                                                <option value="{{ $item->id }}">
                                                    {{ $item->name }}
                                                </option>
                                                @endforeach
                                            </select>

                                            <span id="responsible_doc_pulses_error" class="error-msg-form"></span>

                                            @error('responsible_doc_pulses')
                                            <span class="error-msg-form">
                                                {{ $message }}
                                            </span>
                                            @enderror

                                        </div>

                                        <div class="col-12 mb-2">
                                            <label class="form-label">{{ __('basic.branch') }}
                                                <small>({{ __('basic.required') }})</small></label>
                                            <select
                                                class="myselect2-pulses-insert select2-hidden-accessible @error('branch_id_pulses') is-invalid @enderror"
                                                id="branch_id_pulses" name="branch_id_pulses" required>
                                                @foreach ($branches as $item)
                                                <option value="{{ $item->id }}">
                                                    {{ $item->name }}
                                                </option>
                                                @endforeach
                                            </select>

                                            <span id="branch_id_pulses_error" class="error-msg-form"></span>

                                            @error('branch_id_pulses')
                                            <span class="error-msg-form">
                                                {{ $message }}
                                            </span>
                                            @enderror

                                        </div>

                                        <div class="col-12 mb-2">
                                            <label class="form-label">{{ __('basic.machine') }}
                                                <small>({{ __('basic.required') }})</small></label>

                                            <select
                                                class="myselect2-pulses-insert select2-hidden-accessible @error('responsible_doc_app') is-invalid @enderror"
                                                id="machine_id" name="machine_id" required>
                                                <option disabled selected>
                                                    Chose Branch first
                                                </option>
                                            </select>

                                            <span id="machine_id_error" class="error-msg-form"></span>

                                            @error('machine_id')
                                            <span class="error-msg-form">
                                                {{ $message }}
                                            </span>
                                            @enderror

                                        </div>

                                        <div class="col-12 mb-3">
                                            <label class="form-label"> {{ __('basic.fluence') }}
                                                <small>({{ __('basic.required') }})</small></label>

                                            <select
                                                class="myselect2-pulses-insert-nosearch select2-hidden-accessible @error('fluence') is-invalid @enderror"
                                                name="fluence" required>
                                                <option value="6">
                                                    6
                                                </option>
                                                <option value="7">
                                                    7
                                                </option>
                                                <option value="8">
                                                    8
                                                </option>
                                                <option value="9">
                                                    9
                                                </option>
                                                <option value="10">
                                                    10
                                                </option>
                                                <option value="12">
                                                    12
                                                </option>
                                                <option value="14">
                                                    14
                                                </option>
                                                <option value="16">
                                                    16
                                                </option>
                                                <option value="18">
                                                    18
                                                </option>
                                                <option value="20">
                                                    20
                                                </option>
                                            </select>

                                            <span id="fluence_error" class="error-msg-form"></span>

                                            @error('fluence')
                                            <span class="error-msg-form">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                        </div>

                                        <div class="col-12 mb-3">
                                            <label class="form-label">{{ __('basic.pulse area') }}
                                                <small>({{ __('basic.optional') }})</small></label>
                                            <select
                                                class="myselect2-pulses-insert select2-hidden-accessible @error('pulse_area_id') is-invalid @enderror"
                                                id="pulse_area_id" name="pulse_area_id">
                                                @foreach ($pulses_area as $item)
                                                <option value="{{ $item->id }}">
                                                    {{ $item->name }}
                                                </option>
                                                @endforeach
                                            </select>

                                            <span id="pulse_area_id_error" class="error-msg-form"></span>

                                            @error('pulse_area_id')
                                            <span class="error-msg-form">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                        </div>

                                        <div class="col-12 mb-3">
                                            <label class="form-label"> {{ __('basic.spot size') }}
                                                <small>({{ __('basic.required') }})</small></label>

                                            <select
                                                class="myselect2-pulses-insert-nosearch select2-hidden-accessible @error('spot_size') is-invalid @enderror"
                                                id="spot_size" name="spot_size" required>
                                                <option value="15">
                                                    15
                                                </option>
                                                <option value="18">
                                                    18
                                                </option>
                                                <option value="20">
                                                    20
                                                </option>
                                                <option value="22">
                                                    22
                                                </option>
                                                <option value="24">
                                                    24
                                                </option>
                                            </select>

                                            <span id="spot_size_error" class="error-msg-form"></span>

                                            @error('spot_size')
                                            <span class="error-msg-form">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                        </div>

                                        <div class="col-12 mb-3">
                                            <label class="form-label"> {{ __('basic.used pulses') }}
                                                <small>({{ __('basic.required') }})</small></label>

                                            <input name="used_pulses" type="number"
                                                class="form-control @error('used_pulses') is-invalid @enderror"
                                                placeholder="used pulses ..." value="0" required>

                                            <span id="used_pulses_error" class="error-msg-form"></span>

                                            @error('used_pulses')
                                            <span class="error-msg-form">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                        </div>

                                        <div id="free_session_price_cont" class="col-12 mb-3" style="display: none">
                                            <label class="form-label"> {{ __('basic.free session price') }}
                                                <small>({{ __('basic.required') }})</small></label>

                                            <input id="free_session_price" name="free_session_price" type="number"
                                                class="form-control @error('free_session_price') is-invalid @enderror"
                                                placeholder="free session price ..." required disabled>

                                            <span id="free_session_price_error" class="error-msg-form"></span>

                                            @error('free_session_price')
                                            <span class="error-msg-form">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                        </div>

                                    </div>

                                    <div class="col-12 mb-3">
                                        <label class="form-label">{{ __('basic.date') }}
                                            <small>({{ __('basic.required') }})</small></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"><i class="bi bi-calendar2-week-fill"></i>
                                                </div>
                                            </div>
                                            <input name="pulses_date" type="text"
                                                class="form-control hasdatetimepicker @error('pulses_date') is-invalid @enderror"
                                                placeholder="YYYY/MM/DD" required value="{{ date('Y-m-d') }}">
                                        </div>
                                        <span id="pulses_date_error" class="error-msg-form"></span>

                                        @error('pulses_date')
                                        <span class="error-msg-form">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="col-12 mb-3">
                                        <label class="form-label">{{ __('basic.appointment') }}
                                            <small>({{ __('basic.required') }})</small></label>
                                        <select
                                            class="myselect2-pulses-insert-nosearch select2-hidden-accessible @error('last_appointment_id') is-invalid @enderror"
                                            id="last_appointment_id_sess" name="last_appointment_id" required>
                                            @foreach ($patient->appointments as $item)
                                            <option value="{{ $item->id }}">
                                                {{ $item->start_at }}
                                            </option>
                                            @endforeach
                                        </select>

                                        <span id="last_appointment_id_error" class="error-msg-form"></span>

                                        @error('last_appointment_id')
                                        <span class="error-msg-form">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>

                                    <div id="invoice_area_pulses">

                                        <hr class="my-2">

                                        <div class="col-12 mb-3">
                                            <label class="form-label">{{ __('basic.invoice') }}
                                                <small>({{ __('basic.required') }})</small></label>
                                            <select
                                                class="myselect2-pulses-insert-nosearch @error('pulses_cat_invoice') is-invalid @enderror"
                                                id="pulses_cat_invoice_insert" name="pulses_cat_invoice" required>
                                                <option value="new">New Invoice</option>
                                                <option value="wallet">Wallet</option>
                                                @foreach ($patient->invoices as $item)
                                                @if ($item->status == 0)
                                                <option value="{{ $item->id }}">
                                                    {{ $item->service_inv_cat->name . ' - ' . $item->final_price . 'EGP'
                                                    }}
                                                </option>
                                                @endif
                                                @endforeach
                                            </select>

                                            <span id="pulses_cat_invoice_error" class="error-msg-form"></span>

                                            @error('pulses_cat_invoice')
                                            <span class="error-msg-form">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                        </div>

                                        <div class="col-12 mb-3">
                                            <label class="form-label">{{ __('basic.invoice note') }}
                                                <small>({{ __('basic.optional') }})</small></label>
                                            <textarea id="invoice_note_pulses" name="invoice_note" class="form-control"
                                                placeholder="Write here your notes .." rows="4"
                                                spellcheck="false"></textarea>

                                            <span id="invoice_note_error" class="error-msg-form"></span>

                                            @error('invoice_note')
                                            <span class="error-msg-form">
                                                {{ $message }}
                                            </span>
                                            @enderror

                                        </div>

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

                        </div>
                    </form>

                </div>

            </div>

            <!-- Modal show all pulses -->
            <div class="modal fade" id="pulses_show" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
                    <div class="modal-content b-r-s-cont border-0">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"><i class="fas fas fa-capsules me-1"></i>
                                {{ __('basic.pulses') }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <!-- Modal content -->
                        <div class="modal-body px-4">

                            <div class="table-responsive">
                                <table class="table display datatable-modal" id="table-pulses" width="100%"
                                    cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th class="text-xs">{{ __('basic.date') }}</th>
                                            <th class="text-xs text-center">
                                                {{ __('basic.type') }}</th>
                                            <th class="text-xs">{{ __('basic.name') }}</th>
                                            <th class="text-xs text-center">{{ __('basic.doctor') }}
                                            </th>
                                            <th class="text-xs text-center">{{ __('basic.machine') }}
                                            </th>
                                            <th class="text-xs text-center">{{ __('patientappo.pay status') }}
                                            </th>
                                            <th class="text-xs">{{ __('basic.fluence') }}</th>
                                            <th class="text-xs">{{ __('basic.pulse area') }}</th>
                                            <th class="text-xs">{{ __('basic.spot size') }}</th>
                                            <th class="text-xs">{{ __('basic.balance before session') }}
                                            </th>
                                            <th class="text-xs">{{ __('basic.used pulses') }}</th>
                                            <th class="text-xs">{{ __('basic.package id') }}</th>
                                            <th class="text-xs text-center">{{ __('basic.handle') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($patient->pulses as $item)
                                        @if ($item->type == 0)
                                        @php
                                        $text_color = 'active-color-btn';
                                        $msg = __('patientappo.session');
                                        @endphp
                                        @elseif ($item->type == 1)
                                        @php
                                        $text_color = 'done-color-btn';
                                        $msg = __('basic.money per pulse');
                                        @endphp
                                        @elseif ($item->type == 2)
                                        @php
                                        $text_color = 'prog-color-btn';
                                        $msg = __('basic.session package');
                                        @endphp
                                        @elseif ($item->type == 3)
                                        @php
                                        $text_color = 'not_accepted-color-btn';
                                        $msg = __('basic.pulses package');
                                        @endphp
                                        @elseif ($item->type == 4)
                                        @php
                                        $text_color = 'pend-color-btn';
                                        $msg = __('basic.free session');
                                        @endphp
                                        @endif

                                        @if ($item->invoice_item)
                                        @if ($item->invoice_item->invoice->status == 0)
                                        @php
                                        $text_color_invoice = 'cancel-color-btn';
                                        $msg_invoice = __('basic.not paid');
                                        @endphp
                                        @elseif ($item->invoice_item->invoice->status == 1)
                                        @php
                                        $text_color_invoice = 'pend-color-btn';
                                        $msg_invoice = __('basic.pending');
                                        @endphp
                                        @elseif ($item->invoice_item->invoice->status == 2)
                                        @php
                                        $text_color_invoice = 'prog-color-btn';
                                        $msg_invoice = __('basic.installment');
                                        @endphp
                                        @elseif ($item->invoice_item->invoice->status == 3)
                                        @php
                                        $text_color_invoice = 'done-color-btn';
                                        $msg_invoice = __('basic.paid');
                                        @endphp
                                        @elseif ($item->invoice_item->invoice->status == 4)
                                        @php
                                        $text_color_invoice = 'cancel-color-btn';
                                        $msg_invoice = __('basic.refund');
                                        @endphp
                                        @endif
                                        @php
                                        $invoice_url = 'href=' . route('sett.invoice.show',
                                        $item->invoice_item->invoice->id);

                                        @endphp
                                        @else
                                        @php
                                        $text_color_invoice = 'done-color-btn';
                                        if ($item->type == 2 || $item->type == 3) {
                                        $msg_invoice = __('basic.from package');
                                        $invoice_url = '';
                                        } else {
                                        $msg_invoice = __('patientappo.old record');
                                        $invoice_url = '';
                                        }
                                        @endphp
                                        @endif

                                        <tr>
                                            <td>{{ date('d M Y', strtotime($item->date)) }}</td>
                                            <td class="text-center"> <span
                                                    class="badge rounded-pill {{ $text_color }} badge-padd-l">{{ $msg
                                                    }}</span>
                                            </td>
                                            <td>
                                                @if ($item->service_item)
                                                {{ $item->service_item->name }}
                                                @else
                                                Taken from package
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if ($item->doctor)
                                                {{ $item->doctor->name }}
                                                @else
                                                No selected
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if ($item->machine)
                                                {{ $item->machine->name }}
                                                @else
                                                No Machine
                                                @endif
                                            </td>
                                            <td class="text-center"> <a {{ $invoice_url }}><span
                                                        class="badge rounded-pill {{ $text_color_invoice }} badge-padd-l">{{
                                                        $msg_invoice }}</span></a>
                                            </td>

                                            <td class="text-center">
                                                {{ $item->fluence }}
                                            </td>
                                            <td class="text-center">
                                                @if ($item->pulse_area)
                                                {{ $item->pulse_area->name }}
                                                @else
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                {{ $item->spot_size }}
                                            </td>
                                            <td class="text-center">
                                                {{ $item->balance_before_session }}
                                            </td>
                                            <td class="text-center">
                                                {{ $item->used_pulses }}
                                            </td>
                                            <td class="text-center">
                                                @if ($item->package)
                                                {{ $item->package->service_item->name }}
                                                {{ $item->package->date }}
                                                @else
                                                No package
                                                @endif

                                            </td>
                                            <td class="text-center">

                                                @if ($item->type !== 1)
                                                <a data-id="{{ $item->id }}" data-fluence="{{ $item->fluence }}"
                                                    data-pulse_area_id="{{ $item->pulse_area_id }}"
                                                    data-spot_size="{{ $item->spot_size }}"
                                                    data-used_pulses="{{ $item->used_pulses }}"
                                                    class="btn btn-sm status-col-link active-color-btn b-r-xs mb-1 pulses_edit_click"
                                                    title="edit"><i class="fas fa-pencil-alt"></i>
                                                    {{ __('basic.edit') }} </a>
                                                @endif

                                                @role('Super-admin|Branch-manager')
                                                @if ($item->invoice_item)
                                                @if ($item->invoice_item->invoice->status == 0)
                                                <a data-id="{{ $item->id }}"
                                                    class="btn btn-sm modal-effect status-col-link cancel-color-btn b-r-xs mb-1 pulses_delete_click"
                                                    title="delete" data-effect="effect-scale" data-bs-toggle="modal"
                                                    data-bs-target="#delete1"><i class="fas fa-trash"></i>
                                                    {{ __('basic.delete') }}
                                                </a>
                                                @endif
                                                @else
                                                <a data-id="{{ $item->id }}"
                                                    class="btn btn-sm modal-effect status-col-link cancel-color-btn b-r-xs mb-1 pulses_delete_click"
                                                    title="delete" data-effect="effect-scale" data-bs-toggle="modal"
                                                    data-bs-target="#delete1"><i class="fas fa-trash"></i>
                                                    {{ __('basic.delete') }}
                                                </a>
                                                @endif
                                                @endrole

                                            </td>

                                        </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <div class="left-side">
                                <button type="button" class="btn btn-default btn-link" data-bs-dismiss="modal">
                                    {{ __('basic.never mind') }}</button>
                            </div>
                            <div class="divider"></div>
                            <div class="right-side">
                                <button type="button" class="btn btn-default btn-link main-color">{{ __('basic.save
                                    changes') }}</button>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

            <!-- Modal pulses update data -->
            <div class="modal fade" id="pulses_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content b-r-s-cont border-0">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-capsules me-1"></i>
                                Update Pulses</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <form class="mb-0" action="{{ route('sett.pulses.update', '21') }}" method="POST">
                            @csrf
                            @method('PUT')

                            <!-- Modal content -->
                            <div class="modal-body px-5 py-3">

                                <div class="row mb-2">

                                    <div class="col-12 mb-2">
                                        <label class="form-label"> {{ __('basic.fluence') }}
                                            <small>({{ __('basic.required') }})</small></label>
                                        <select id="fluence_update_id"
                                            class="myselect2-pulses-update-nosearch select2-hidden-accessible @error('fluence_update') is-invalid @enderror"
                                            name="fluence_update" required>
                                            <option value="6">
                                                6
                                            </option>
                                            <option value="7">
                                                7
                                            </option>
                                            <option value="8">
                                                8
                                            </option>
                                            <option value="9">
                                                9
                                            </option>
                                            <option value="10">
                                                10
                                            </option>
                                            <option value="12">
                                                12
                                            </option>
                                            <option value="14">
                                                14
                                            </option>
                                            <option value="16">
                                                16
                                            </option>
                                            <option value="18">
                                                18
                                            </option>
                                            <option value="20">
                                                20
                                            </option>
                                        </select>

                                        <span id="fluence_update_error" class="error-msg-form"></span>

                                        @error('fluence_update')
                                        <span class="error-msg-form">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>


                                    <div class="col-12 mb-2">
                                        <label class="form-label">{{ __('basic.pulse area') }}
                                            <small>( {{ __('basic.required') }})</small></label>

                                        <select
                                            class="myselect2-pulses-update select2-hidden-accessible @error('related_treatment_id_update') is-invalid @enderror"
                                            id="pulse_area_id_update" name="pulse_area_id_update">
                                            @foreach ($pulses_area as $item)
                                            <option value="{{ $item->id }}">
                                                {{ $item->name }}
                                            </option>
                                            @endforeach
                                        </select>

                                        <span id="pulse_area_id_update_error" class="error-msg-form"></span>

                                        @error('pulse_area_id_update')
                                        <span class="error-msg-form">
                                            {{ $message }}
                                        </span>
                                        @enderror

                                    </div>

                                    <div class="col-12 mb-2">
                                        <label class="form-label"> {{ __('basic.spot size') }}
                                            <small>({{ __('basic.required') }})</small></label>

                                        <select
                                            class="myselect2-pulses-update-nosearch select2-hidden-accessible @error('spot_size') is-invalid @enderror"
                                            id="spot_size_update_id" name="spot_size_update" required>
                                            <option value="15">
                                                15
                                            </option>
                                            <option value="18">
                                                18
                                            </option>
                                            <option value="20">
                                                20
                                            </option>
                                            <option value="22">
                                                22
                                            </option>
                                            <option value="24">
                                                24
                                            </option>
                                        </select>

                                        <span id="spot_size_update_error" class="error-msg-form"></span>

                                        @error('spot_size_update')
                                        <span class="error-msg-form">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="col-12 mb-2">
                                        <label class="form-label"> {{ __('basic.used pulses') }}
                                            <small>({{ __('basic.required') }})</small></label>

                                        <input name="used_pulses_update" type="number"
                                            class="form-control @error('used_pulses_update') is-invalid @enderror"
                                            placeholder="used pulses ..." required>

                                        <span id="used_pulses_update_error" class="error-msg-form"></span>

                                        @error('used_pulses_update')
                                        <span class="error-msg-form">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <input name="pulses_id_update" value="" type="hidden">

                            </div>

                            <div class="modal-footer">
                                <div class="left-side">
                                    <button type="button" class="btn btn-default btn-link" data-bs-dismiss="modal">{{
                                        __('basic.never mind') }}</button>
                                </div>
                                <div class="divider"></div>
                                <div class="right-side">
                                    <button type="submit" class="btn btn-default btn-link main-color">{{
                                        __('basic.update') }}</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>

            </div>

            <!-- pulses delete -->
            <div class="modal fade" id="pulses_delete" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable ">

                    <div class="modal-content shadow-lgg b-r-s-cont border-0">

                        <div class="modal-header">
                            <div class="modal-title" id="exampleModalLabel"><i class="fas fa-trash me-1"></i>
                                {{ __('basic.pulses delete') }}</div>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <form class="mb-0" action="{{ route('sett.pulses.destroy', 'test') }}" method="post">
                            {{ method_field('delete') }}
                            {{ csrf_field() }}

                            <!-- Modal content -->
                            <div class="modal-body px-4">

                                <div class="modal-body delete-conf-input text-center py-0">
                                    <p class="mb-0">ِAre
                                        you sure you want to delete
                                        this
                                        session?</p><br>
                                    <input type="hidden" name="pulses_id_delete" value="">
                                </div>
                            </div>

                            <div class="modal-footer">
                                <div class="left-side">
                                    <button type="button" class="btn btn-default btn-link" data-bs-dismiss="modal">{{
                                        __('basic.never mind') }}</button>
                                </div>
                                <div class="divider"></div>
                                <div class="right-side">
                                    <button type="submit" class="btn btn-default btn-link text-red">{{
                                        __('basic.delete') }}
                                    </button>
                                </div>

                            </div>
                        </form>

                    </div>
                </div>
            </div>

            <!-- Modal add new package insert data -->
            <div class="modal fade" id="addpackage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">

                    <form class="mb-0" action="{{ route('sett.service_package.store') }}" method="post"
                        style="display: contents">
                        {{ method_field('POST') }}
                        {{ csrf_field() }}

                        <div class="modal-content b-r-s-cont border-0">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-capsules me-1"></i>
                                    {{ __('basic.new package') }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>

                            <!-- Modal content -->
                            <div class="modal-body px-5 py-3">

                                <div class="row mb-2">

                                    <div class="col-12 mb-3">
                                        <label class="form-label">{{ __('basic.status') }}
                                            <small>({{ __('basic.required') }})</small></label>
                                        <select
                                            class="myselect2-package-insert select2-hidden-accessible @error('old_new_package') is-invalid @enderror"
                                            id="old_new_package" name="old_new_package" required>
                                            <option value="1">
                                                {{ __('patientappo.new record') }}
                                            </option>
                                            <option value="2">
                                                {{ __('patientappo.old record') }}
                                            </option>
                                        </select>

                                        <span id="old_new_package_error" class="error-msg-form"></span>

                                        @error('old_new_package')
                                        <span class="error-msg-form">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="col-12 mb-3">
                                        <label class="form-label">{{ __('basic.package') }}
                                            <small>({{ __('basic.required') }})</small></label>
                                        <select
                                            class="myselect2-package-insert select2-hidden-accessible @error('package_service_item_cat') is-invalid @enderror"
                                            id="package_service_item_cat" name="package_service_item_cat" required>
                                            @foreach ($service_cat_pulses as $item)
                                            @if ($item->package > 0)
                                            <option value="{{ $item->id }}" data-price="{{ $item->price }}">
                                                {{ $item->name . ' - ' . $item->price . ' EGP ' .
                                                $item->package_items_number . ' ps' }}
                                            </option>
                                            @endif
                                            @endforeach
                                        </select>

                                        <span id="package_service_item_cat_error" class="error-msg-form"></span>

                                        @error('package_service_item_cat')
                                        <span class="error-msg-form">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="col-12 mb-3">
                                        <label class="form-label">{{ __('basic.appointment') }}
                                            <small>({{ __('basic.required') }})</small></label>
                                        <select
                                            class="myselect2-package-insert select2-hidden-accessible @error('last_appointment_id') is-invalid @enderror"
                                            id="last_appointment_id_package" name="last_appointment_id" required>
                                            @foreach ($patient->appointments as $item)
                                            <option value="{{ $item->id }}">
                                                {{ $item->start_at }}
                                            </option>
                                            @endforeach
                                        </select>

                                        <span id="last_appointment_id_error" class="error-msg-form"></span>

                                        @error('last_appointment_id')
                                        <span class="error-msg-form">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>

                                    <hr>

                                    <div class="col-12 mb-2">
                                        <label class="form-label">{{ __('basic.invoice note') }}
                                            <small>({{ __('basic.optional') }})</small></label>
                                        <textarea name="invoice_note" class="form-control"
                                            placeholder="Write here your notes .." rows="4"
                                            spellcheck="false"></textarea>

                                        <span id="session_cat_invoice_error" class="error-msg-form"></span>

                                        @error('invoice_note')
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

                        </div>
                    </form>

                </div>

            </div>

            <!-- Modal show all package -->
            <div class="modal fade" id="package_show" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
                    <div class="modal-content b-r-s-cont border-0">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"><i class="fas fas fa-capsules me-1"></i>
                                {{ __('basic.package') }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <!-- Modal content -->
                        <div class="modal-body px-4">

                            <div class="table-responsive">
                                <table class="table display datatable-modal" id="table-package" width="100%"
                                    cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th class="text-xs">{{ __('basic.id') }}</th>
                                            <th class="text-xs">{{ __('basic.status') }}</th>
                                            <th class="text-xs">{{ __('basic.date') }}</th>
                                            <th class="text-xs">{{ __('basic.name') }}</th>
                                            <th class="text-xs text-center">
                                                {{ __('basic.type') }}</th>
                                            <th class="text-xs text-center">{{ __('patientappo.pay status') }}
                                            </th>
                                            <th class="text-xs text-center">{{ __('basic.session|pulses number') }}
                                            </th>
                                            <th class="text-xs text-center">
                                                {{ __('basic.session|pulses number left') }}
                                            </th>

                                            <th class="text-xs text-center">{{ __('basic.handle') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($patient->package as $item)
                                        @if ($item->invoice_item)
                                        @php
                                        $text_color_status = 'active-color-btn';
                                        $msg_status = __('patientappo.new record');
                                        @endphp
                                        @else
                                        @php
                                        $text_color_status = 'done-color-btn';
                                        $msg_status = __('patientappo.old record');
                                        @endphp
                                        @endif

                                        @if ($item->type == 1)
                                        @php
                                        $text_color = 'active-color-btn';
                                        $msg = __('basic.session');
                                        @endphp
                                        @elseif ($item->type == 2)
                                        @php
                                        $text_color = 'done-color-btn';
                                        $msg = __('basic.pulses');
                                        @endphp
                                        @endif

                                        @if ($item->invoice_item)
                                        @if ($item->invoice_item->invoice->status == 0)
                                        @php
                                        $text_color_invoice = 'cancel-color-btn';
                                        $msg_invoice = __('basic.not paid');
                                        @endphp
                                        @elseif ($item->invoice_item->invoice->status == 1)
                                        @php
                                        $text_color_invoice = 'pend-color-btn';
                                        $msg_invoice = __('basic.pending');
                                        @endphp
                                        @elseif ($item->invoice_item->invoice->status == 2)
                                        @php
                                        $text_color_invoice = 'prog-color-btn';
                                        $msg_invoice = __('basic.installment');
                                        @endphp
                                        @elseif ($item->invoice_item->invoice->status == 3)
                                        @php
                                        $text_color_invoice = 'done-color-btn';
                                        $msg_invoice = __('basic.paid');
                                        @endphp
                                        @elseif ($item->invoice_item->invoice->status == 4)
                                        @php
                                        $text_color_invoice = 'cancel-color-btn';
                                        $msg_invoice = __('basic.refund');
                                        @endphp
                                        @endif
                                        @php
                                        $invoice_url = 'href=' . route('sett.invoice.show',
                                        $item->invoice_item->invoice->id);
                                        @endphp
                                        @else
                                        @php
                                        $text_color_invoice = 'done-color-btn';
                                        $msg_invoice = __('patientappo.old record');
                                        $invoice_url = '';
                                        @endphp
                                        @endif

                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td><span
                                                    class="badge rounded-pill {{ $text_color_status }} badge-padd-l">{{
                                                    $msg_status }}</span>
                                            </td>
                                            <td>{{ date('d M Y', strtotime($item->date)) }}</td>
                                            <td>{{ $item->service_item->name }}</td>
                                            <td class="text-center"> <span
                                                    class="badge rounded-pill {{ $text_color }} badge-padd-l">{{ $msg
                                                    }}</span>
                                            </td>
                                            <td class="text-center">
                                                <a {{ $invoice_url }}><span
                                                        class="badge rounded-pill {{ $text_color_invoice }} badge-padd-l">{{
                                                        $msg_invoice }}</span></a>
                                            </td>

                                            <td class="text-center">
                                                {{ $item->items_number }}
                                            </td>
                                            <td class="text-center">
                                                {{ $item->items_number_left }}
                                            </td>

                                            <td class="text-center">
                                                @if ($item->invoice_item)
                                                @if ($item->invoice_item->invoice->status == 0)
                                                <a data-id="{{ $item->id }}"
                                                    class="btn btn-sm modal-effect status-col-link cancel-color-btn b-r-xs mb-1 package_delete_click"
                                                    title="delete" data-effect="effect-scale" data-bs-toggle="modal"
                                                    data-bs-target="#delete1"><i class="fas fa-trash"></i>
                                                    {{ __('basic.delete') }}
                                                </a>
                                                @endif
                                                @endif

                                            </td>

                                        </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <div class="left-side">
                                <button type="button" class="btn btn-default btn-link" data-bs-dismiss="modal">
                                    {{ __('basic.never mind') }}</button>
                            </div>
                            <div class="divider"></div>
                            <div class="right-side">
                                <button type="button" class="btn btn-default btn-link main-color">{{ __('basic.save
                                    changes') }}</button>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

            <!-- pulses delete -->
            <div class="modal fade" id="package_delete" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable ">

                    <div class="modal-content shadow-lgg b-r-s-cont border-0">

                        <div class="modal-header">
                            <div class="modal-title" id="exampleModalLabel"><i class="fas fa-trash me-1"></i>
                                {{ __('basic.package delete') }}</div>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <form class="mb-0" action="{{ route('sett.service_package.destroy', 'test') }}" method="post">
                            {{ method_field('delete') }}
                            {{ csrf_field() }}

                            <!-- Modal content -->
                            <div class="modal-body px-4">

                                <div class="modal-body delete-conf-input text-center py-0">
                                    <p class="mb-0">ِAre
                                        you sure you want to delete
                                        this
                                        package?</p><br>
                                    <input type="hidden" name="package_id_delete" value="">
                                </div>
                            </div>

                            <div class="modal-footer">
                                <div class="left-side">
                                    <button type="button" class="btn btn-default btn-link" data-bs-dismiss="modal">{{
                                        __('basic.never mind') }}</button>
                                </div>
                                <div class="divider"></div>
                                <div class="right-side">
                                    <button type="submit" class="btn btn-default btn-link text-red">{{
                                        __('basic.delete') }}
                                    </button>
                                </div>

                            </div>
                        </form>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>