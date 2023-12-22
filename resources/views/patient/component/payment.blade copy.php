@role('Super-admin|Doctor|Branch-manager|Receptionist')
<!-- Payment -->
<div class="col-12 pe-0">
    <div class="card shadow mb-4">

        <div id="payment_wallet" class="carousel slide curr-treament-info-carousel">

            <div class="carousel-indicators dots-radius-carousel" style="bottom: 34px; margin-bottom: 0px;">
                <button type="button" data-bs-target="#payment_wallet" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#payment_wallet" data-bs-slide-to="1"
                    aria-label="Slide 2"></button>
            </div>

            <div class="carousel-inner">

                <!-- Current treatments -->
                <div class="carousel-item active">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <span class="m-0 fs-6 me-2 fw-bold clickable-item-pointer">{{ __('basic.invoices') }}</span>
                            <span
                                class="m-0 me-2 text-x link-cust-text text-s fw-bold clickable-item-pointer text-gray-200"
                                data-bs-target="#payment_wallet" data-bs-slide-to="1" aria-label="Slide 2">
                                {{ __('basic.payments') }}</span>
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
                                    data-bs-target="#add_wallet">{{ __('basic.add wallet balance') }}</a>
                            </div>
                        </div>
                    </div>

                    <!-- Card Body -->
                    <div class="card-body pb-2">

                        @if (count($patient->invoices) > 0)
                        <div class="d-flex justify-content-between">
                            <p class="text-xs text-gray-300">{{ __('patientappo.transaction') }}</p>
                            <p class="text-xs text-gray-300">{{ __('basic.amount') }}</p>
                        </div>

                        @foreach ($patient->invoices as $item)
                        {{-- blade-formatter-disable-next-line --}}
                        @break($loop->index === 4)

                        @if ($item->status == 0)
                        @php
                        $text_color = 'cancel-color-btn';
                        $msg = __('basic.not paid');
                        @endphp
                        @elseif ($item->status == 1)
                        @php
                        $text_color = 'pend-color-btn';
                        $msg = __('basic.pending');
                        @endphp
                        @elseif ($item->status == 2)
                        @php
                        $text_color = 'prog-color-btn';
                        $msg = __('basic.installment');
                        @endphp
                        @elseif ($item->status == 3)
                        @php
                        $text_color = 'done-color-btn';
                        $msg = __('basic.paid');
                        @endphp
                        @elseif ($item->status == 4)
                        @php
                        $text_color = 'cancel-color-btn';
                        $msg = __('basic.refund');
                        @endphp
                        @endif

                        @if ($item->operation == 1)
                        @role('Super-admin|Operation')
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="me-1 d-flex align-self-center align-items-center me-2 text-truncate">
                                <i class="fas fa-circle me-2 text-xxs mb-0 {{ $text_color }}"></i>

                                <div class="text-truncate">
                                    <a href="{{ route('sett.invoice.show', $item->id) }}"
                                        class="text-s text-truncate link-cust-text text-gray-500 mb-0 fw-bold">
                                        {{ $item->code }}</a>
                                    <p class="text-xs text-gray-300 fw-bold mb-0">{{ $msg }}</p>
                                </div>
                            </div>

                            <div class="text-s text-gray-600 fw-bold">{{ $item->final_price }}<small
                                    class="text-gray-300 text-xxxs">
                                    {{ __('basic.egp') }}</small>
                            </div>
                        </div>
                        @endrole
                        @else
                        <div class="d-flex justify-content-between align-items-center mb-3">

                            <div class="me-1 d-flex align-self-center align-items-center me-2 text-truncate">
                                <i class="fas fa-circle me-2 text-xxs mb-0 {{ $text_color }}"></i>

                                <div class="text-truncate">
                                    <a href="{{ route('sett.invoice.show', $item->id) }}"
                                        class="text-s text-truncate link-cust-text text-gray-500 mb-0 fw-bold">
                                        {{ $item->new_id }}</a>
                                    <p class="text-xs text-gray-300 fw-bold mb-0">{{ $msg }}</p>
                                </div>
                            </div>

                            <div class="text-s text-gray-600 fw-bold">{{ $item->final_price }}<small
                                    class="text-gray-300 text-xxxs">
                                    {{ __('basic.egp') }}</small>
                            </div>

                        </div>
                        @endif
                        @endforeach
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
                            data-bs-target="#payment_show">
                            <i class="fas fa-chevron-down"></i> {{ __('basic.more') }}
                        </a>
                    </div>
                </div>

                <div class="carousel-item">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <span class="m-0 fs-6 me-2 fw-bold clickable-item-pointer">{{ __('basic.payments')
                                }}</span>
                            <span
                                class="m-0 me-2 text-x link-cust-text text-s fw-bold clickable-item-pointer text-gray-200"
                                data-bs-target="#payment_wallet" data-bs-slide-to="0" aria-label="Slide 1">{{
                                __('basic.invoices') }}</span>
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
                                    data-bs-target="#add_wallet">{{ __('basic.add wallet balance') }}</a>
                            </div>
                        </div>
                    </div>

                    <!-- Card Body -->
                    <div class="card-body pb-2">

                        @if (count($patient->payments) > 0)
                        <div class="d-flex justify-content-between">
                            <p class="text-xs text-gray-300">{{ __('basic.balance') }}</p>
                            <p class="text-xs text-gray-300">{{ __('basic.amount') }}</p>
                        </div>

                        @foreach ($patient->payments as $item)
                        {{-- blade-formatter-disable-next-line --}}
                        @break($loop->index === 4)

                        @if ($item->type == 0)
                        @php
                        $text_color = "text-green";
                        $msg = __('basic.income');
                        @endphp
                        @elseif ($item->type == 1)
                        @php
                        $text_color = 'main-color';
                        $msg = __('basic.expenses');
                        @endphp
                        @endif

                        <div class="d-flex justify-content-between align-items-center mb-3">

                            <div class="me-1 d-flex align-self-center align-items-center me-2 text-truncate">
                                <i class="fas fa-circle me-2 text-xxs mb-0 {{ $text_color }}"></i>

                                <div class="text-truncate">
                                    <a class="text-s text-truncate link-cust-text text-gray-500 mb-0 fw-bold">
                                        {{ $item->new_id }}
                                    </a>
                                    <p class="text-xs text-gray-300 fw-bold mb-0">{{ $msg }}</p>
                                </div>
                            </div>

                            <div class="text-s text-gray-600 fw-bold">{{ $item->amount }}<small
                                    class="text-gray-300 text-xxxs">
                                    {{ __('basic.egp') }}</small>
                            </div>

                        </div>
                        @endforeach
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
                            data-bs-target="#wallet_show">
                            <i class="fas fa-chevron-down"></i> {{ __('basic.more') }}
                        </a>
                    </div>
                </div>
            </div>

            <!-- Modal show all invoices -->
            <div class="modal fade" id="payment_show" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
                    <div class="modal-content b-r-s-cont border-0">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"><i class="fas fas fa-receipt me-1"></i>
                                {{ __('basic.invoices') }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <!-- Modal content -->
                        <div class="modal-body px-4">

                            <div class="table-responsive">
                                <table class="table display datatable-modal" id="table-payment" width="100%"
                                    cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th class="text-xs">{{ __('basic.name') }}</th>
                                            <th class="text-xs text-center">{{ __('basic.type') }}</th>
                                            <th class="text-xs text-center">{{ __('basic.discount') }}</th>
                                            <th class="text-xs text-center">{{ __('patientappo.final price') }}
                                            </th>
                                            <th class="text-xs text-center">{{ __('basic.remaining amount') }}</th>
                                            <th class="text-xs text-center">{{ __('basic.status') }}</th>
                                            <th class="text-xs text-center">{{ __('basic.description') }}</th>
                                            <th class="text-xs text-center">{{ __('basic.branch') }}</th>
                                            <th class="text-xs text-center">{{ __('basic.date') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($patient->invoices as $item)
                                        @if ($item->status == 0)
                                        @php
                                        $text_color_invoice = 'cancel-color-btn';
                                        $msg_invoice = __('basic.not paid');
                                        @endphp
                                        @elseif ($item->status == 1)
                                        @php
                                        $text_color_invoice = 'pend-color-btn';
                                        $msg_invoice = __('basic.pending');
                                        @endphp
                                        @elseif ($item->status == 2)
                                        @php
                                        $text_color_invoice = 'prog-color-btn';
                                        $msg_invoice = __('basic.installment');
                                        @endphp
                                        @elseif ($item->status == 3)
                                        @php
                                        $text_color_invoice = 'done-color-btn';
                                        $msg_invoice = __('basic.paid');
                                        @endphp
                                        @elseif ($item->status == 4)
                                        @php
                                        $text_color_invoice = 'cancel-color-btn';
                                        $msg_invoice = __('basic.refund');
                                        @endphp
                                        @endif

                                        @if ($item->type == 0)
                                        @php
                                        $text_color_invoice_type = 'main-color-btn';
                                        $msg_invoice_type = __('patientappo.income');
                                        @endphp
                                        @else
                                        @php
                                        $text_color_invoice_type = 'pend-color-btn';
                                        $msg_invoice_type = __('patientappo.expenses');
                                        @endphp
                                        @endif
                                        <tr>
                                            <td><a class="link-cust-text text-gray-500"
                                                    href="{{ route('sett.invoice.show', $item->id) }}">
                                                    {{ $item->new_id }}</a></td>
                                            <td class="text-center"><span
                                                    class="badge rounded-pill {{ $text_color_invoice_type }} badge-padd-l">{{
                                                    $msg_invoice_type }}</span>
                                            <td class="text-center">
                                                @if (!empty($item->discount))
                                                {{ $item->discount }} <small class="text-gray-300 text-xxxs">
                                                    {{ __('basic.egp') }}</small>
                                                @endif
                                            </td>
                                            <td class="text-center">{{ $item->final_price }} <small
                                                    class="text-gray-300 text-xxxs">
                                                    {{ $item->currency->code }}</small>
                                            </td>
                                            <td class="text-center fw-bold">
                                                {{ $item->final_price - $item->total_paid }}
                                                <small class="text-gray-300 text-xxxs">
                                                    {{ $item->currency->code }}</small>
                                            </td>
                                            <td class="text-center"> <span
                                                    class="badge rounded-pill {{ $text_color_invoice }} badge-padd-l">{{
                                                    $msg_invoice }}</span>
                                            </td>
                                            <td class="text-center"> {{ $item->note }} @if ($item->worker)
                                                | shift: {{ $item->worker->name }}
                                                @endif
                                            </td>
                                            <td class="text-center"> {{ $item->branch->name }}</td>
                                            <td class="text-center">
                                                {{ date('Y-m-d', strtotime($item->paid_date)) }} <br>
                                                {{ date('h:i a', strtotime($item->paid_date)) }}</td>

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


            <!-- Modal for inserting wallet -->
            <div class="modal fade" id="add_wallet" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content b-r-s-cont border-0">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-wallet me-1"></i>
                                {{ __('basic.add wallet balance') }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <form class="mb-0" action="{{ route('sett.pat_add_wallet_balance', $patient->id) }}"
                            method="post" style="display: contents;">
                            {{ method_field('POST') }}
                            {{ csrf_field() }}

                            <!-- Modal content -->
                            <div class="modal-body px-5 py-3">

                                <div class="row mb-2">

                                    <div class="col-12 mb-2">
                                        <label class="form-label">{{ __('basic.branch') }}
                                            <small>({{ __('basic.required') }})</small></label>
                                        <select
                                            class="myselect2-wallet-insert-nosearch select2-hidden-accessible @error('branch_wallet') is-invalid @enderror"
                                            id="branch_wallet" name="branch_wallet" required>
                                            @foreach ($branches as $item)
                                            <option value="{{ $item->id }}">
                                                {{ $item->name }}
                                            </option>
                                            @endforeach
                                        </select>

                                        <span id="branch_wallet_error" class="error-msg-form"></span>

                                        @error('branch_wallet')
                                        <span class="error-msg-form">
                                            {{ $message }}
                                        </span>
                                        @enderror

                                    </div>

                                    <div class="col-12 mb-2">
                                        <label class="form-label">{{ __('basic.type') }}
                                            <small>({{ __('basic.required') }})</small></label>
                                        <select
                                            class="myselect2-wallet-insert-nosearch select2-hidden-accessible @error('type_wallet') is-invalid @enderror"
                                            id="type_wallet" name="type_wallet" required>
                                            <option value="0">
                                                {{ __('patientappo.income') }}
                                            </option>
                                            <option value="1">
                                                {{ __('patientappo.expenses') }}
                                            </option>
                                        </select>

                                        <span id="type_wallet_error" class="error-msg-form"></span>

                                        @error('type_wallet')
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
                                            <input name="wallet_date" type="text"
                                                class="form-control datepicker_time bg-white @error('wallet_date') is-invalid @enderror"
                                                placeholder="YYYY/MM/DD HM" data-enable-time="true" required>
                                        </div>
                                        <span id="wallet_date_error" class="error-msg-form"></span>

                                        @error('wallet_date')
                                        <span class="error-msg-form">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="col-12 mb-2">
                                        <label class="form-label"> {{ __('basic.wallet balance') }}
                                            <small>({{ __('basic.required') }})</small></label>

                                        <input name="wallet_price" type="number"
                                            class="form-control @error('wallet_price') is-invalid @enderror"
                                            placeholder="Wallent balance.." value="{{ old('wallet_price') }}" required>

                                        <span id="wallet_price_error" class="error-msg-form"></span>

                                        @error('wallet_price')
                                        <span class="error-msg-form">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="col-12 mb-2">
                                        <label class="form-label">{{ __('basic.note') }}
                                            <small>({{ __('basic.optional') }})</small></label>
                                        <textarea name="balance_note" class="form-control "
                                            placeholder="Write here the invoice note .." rows="4"
                                            spellcheck="false">{{ old('balance_note') }}</textarea>
                                        <span id="note" class="error-msg-form"></span>

                                        @error('balance_note')
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
                                    <button type="submit" class="btn btn-default btn-link main-color">{{ __('basic.add
                                        new') }}</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>

            </div>


            <!-- Modal show all wallet -->
            <div class="modal fade" id="wallet_show" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
                    <div class="modal-content b-r-s-cont border-0">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"><i class="fas fas fa-wallet me-1"></i>
                                {{ __('basic.wallet') }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <!-- Modal content -->
                        <div class="modal-body px-4">

                            <div class="table-responsive">
                                <table class="table display datatable-modal" id="table-wallet" width="100%"
                                    cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th class="text-xxs">{{ __('basic.name') }}</th>
                                            <th class="text-xxs">{{ __('basic.date') }}</th>
                                            <th class="text-xxs text-center">{{ __('basic.treasury') }}</th>
                                            <th class="text-xxs text-center">{{ __('basic.goes to') }}</th>
                                            <th class="text-xxs text-center">{{ __('basic.current balance') }}</th>
                                            <th class="text-xxs text-center">{{ __('basic.status') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($patient->payments )

                                        @foreach ($patient->payments as $item)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-content-center">

                                                    @if ($item->type == 0)
                                                    @php
                                                    $icon = "fas fa-plus";
                                                    $icon_color = "text-green";
                                                    $type = __('basic.income');
                                                    @endphp
                                                    @else
                                                    @php
                                                    $icon = "fas fa-minus";
                                                    $icon_color = "main-color";
                                                    $type = __('basic.expenses');
                                                    @endphp
                                                    @endif

                                                    <h2 class="me-2">
                                                        <i class="{{ $icon . " " . $icon_color }}"></i>
                                                    </h2>
                                                    <div>
                                                        <h6 class="mb-0 text-s fw-bold">
                                                            {{ $item->code }}
                                                        </h6>
                                                        <h6 class="mb-0">
                                                            {{ $item->receiver }}
                                                        </h6>
                                                        <p class="text-gray-300">{{ $type }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                {{ $item->paid_date}}
                                            </td>

                                            <td>
                                                <a href="{{ route('sett.acc_treasury.show', $item->acc_treasury_id) }}">
                                                    <div
                                                        class="status-col-link not_accepted-color-btn b-r-l-cont p-2 px-4 text-center me-2 clickable-item-pointer">
                                                        {{ $item->treasury->name }}
                                                    </div>
                                                </a>
                                            </td>
                                            <td>
                                                @if($item->type == 0)
                                                <a
                                                    href="{{ route('sett.chart_of_accounts_show', $item->debit_acc_account_id) }}">
                                                    <div
                                                        class="status-col-link not_accepted-color-btn b-r-l-cont p-2 px-4 text-center me-2 clickable-item-pointer">
                                                        {{ $item->debit_acc->name }}
                                                    </div>
                                                </a>
                                                @else
                                                <a
                                                    href="{{ route('sett.chart_of_accounts_show', $item->debit_acc_account_id) }}">
                                                    <div
                                                        class="status-col-link not_accepted-color-btn b-r-l-cont p-2 px-4 text-center me-2 clickable-item-pointer">
                                                        {{ $item->debit_acc->name }}
                                                    </div>
                                                </a>
                                                @endif
                                            </td>

                                            <td>
                                                <h5 class="text-center fw-bold">
                                                    {{ $item->amount .' ' . $item->currency->code}}
                                                </h5>
                                            </td>

                                            <td class="text-center">
                                                <a href="{{ route('sett.acc_payment.show', $item->id) }}"
                                                    class="btn btn-sm status-col-link status-col-link not_accepted-color-btn b-r-xs mb-1"
                                                    title="edit"><i class="fas fa-eye"></i></a>
                                            </td>

                                        </tr>
                                        @endforeach


                                        @endif


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


        </div>
    </div>
    @endrole