@extends('website.layouts.master_top')
@section('css')
@endsection
@section('content')
<div class="row p-3 pt-0">
    <div class="banner radius-20" style="height: 310px">
        <div class="w-50 float-end pt-5 text-light">
            <h1 class="fw-bold text-light fs-5">the easiest way</h1>
            <h2 class="fw-bold">to discover the world</h2>
            <p class="fs-8">
                Lorem Ipsum is simply dummy text of the printing and
                typesetting industry. Lorem Ipsum has been the industry's
                standard dummy text
            </p>
        </div>
    </div>
</div>

<div class="d-flex justify-content-between align-items-center mt-5 mb-3">
    <div>
        <h2 class="fs-4 fw-bold text-capitalize">Visa Application</h2>
        <p class="fs-8 text-secondary mb-0">
            Here is your visa application
        </p>
    </div>

    @if ($visa->status == 0)
    @php
    $text_color = 'not_accepted-color-btn';
    $msg = __('in progress');
    @endphp
    @elseif ($visa->status == 1)
    @php
    $text_color = 'pend-color-btn';
    $msg = __('review documents');
    @endphp
    @elseif ($visa->status == 2)
    @php
    $text_color = 'cancel-color-btn';
    $msg = __('Document problem');
    @endphp
    @elseif ($visa->status == 3)
    @php
    $text_color = 'prog-color-btn';
    $msg = __('Return Document');
    @endphp
    @elseif ($visa->status == 4)
    @php
    $text_color = 'active-color-btn';
    $msg = __('Send to broker');
    @endphp
    @elseif ($visa->status == 5)
    @php
    $text_color = 'cancel-color-btn';
    $msg = __('Refused');
    @endphp
    @elseif ($visa->status == 6)
    @php
    $text_color = 'main-color-btn';
    $msg = __('Approved');
    @endphp
    @elseif ($visa->status == 7)
    @php
    $text_color = 'done-color-btn';
    $msg = __('ready to collect');
    @endphp
    @endif
    <span class="badge rounded-pill {{ $text_color }} badge-padd-l">{{
        $msg
        }}</span>

</div>

<div class="row">
    <!-- Card Body -->
    <div class="card-body">


        <div class="row">

            <div class="col-12">
                <div class="row">
                    <div class="col-12 col-md-4 align-self-center">
                        <div class="d-flex mb-2 align-items-center">
                            <img class="rounded-circle avatar-lg me-3"
                                src="{{ URL::asset('img/useravatar/' . $visa->patient->avatar) }}">
                            <div class="">
                                <p class=" mb-0 text-xs text-gray-300">
                                    {{ __('basic.patient') }}</p>
                                <p class="mb-1 fw-bold fs-5 text-gray-600">{{ $visa->patient->first_name . ' '
                                    . $visa->patient->second_name }}
                                </p>
                                <p class="mb-0 text-xs text-gray-400">{{ __('Passport Number:') }} <strong>
                                        {{ $visa->patient->passport_number }}</strong>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-2 align-self-center">
                        <h6 class="text-gray-300 text-xs mb-1 text-center">{{ __('basic.destination') }}</h6>
                        <p id="branch_final_info" class="text-gray-600 text-s fw-bold text-center">
                            {{ $visa->visa->name }}
                        </p>
                    </div>
                    <div class="col-6 col-md-2 align-self-center">
                        <h6 class="text-gray-300 text-xs mb-1 text-center">{{ __('Company') }}</h6>
                        <p id="branch_final_info" class="text-gray-600 text-s fw-bold text-center">
                            {{ $visa->debtor->first_name }}
                        </p>
                    </div>
                    <div class="col-6 col-md-2 align-self-center">
                        <h6 class="text-gray-300 text-xs mb-1 text-center">{{ __('Duration') }}</h6>
                        <p id="branch_final_info" class="text-gray-600 text-s fw-bold text-center">
                            {{ $visa->duration }}
                        </p>
                    </div>
                    <div class="col-6 col-md-2 align-self-center">
                        <h6 class="text-gray-300 text-xs mb-1 text-center">{{ __('Date') }}</h6>
                        <p id="branch_final_info" class="text-gray-600 text-s fw-bold text-center">
                            {{ $visa->start_at }}
                        </p>
                    </div>
                </div>

            </div>
        </div>

        <hr>

        <form id="myforminput" method="POST" action="{{ route('school_route.visa_traveler_update', $visa->id) }}"
            enctype="multipart/form-data">
            {{ method_field('PUT') }}
            @csrf

            <div class="row mb-1 justify-content-center">

                <div class="col-12 col-md-10 col-lg-7">

                    <div class="row">

                        <div class="col-12 mb-3">
                            <label class="form-label">{{ __('passport cover') }}
                                <small>({{ __('basic.required') }})</small></label>

                            @if ($visa->passport_cover_img)
                            <div class="text-center mb-2">
                                <a target=”_blank” href="{{ URL::asset('img/visa/' . $visa->passport_cover_img) }}">
                                    <img class=" me-3" style="width: 200px"
                                        src="{{ URL::asset('img/visa/' . $visa->passport_cover_img) }}">
                                </a>
                            </div>
                            @endif

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="bi bi-calendar2-week-fill"></i>
                                    </div>
                                </div>
                                <input class="form-control" name='passport_cover_img' accept="image/*" type="file"
                                    id="formFile">
                            </div>
                            <span id="passport_cover_img-error" class="error-msg-form"></span>
                            @error('passport_cover_img')
                            <span class="error-msg-form">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>

                        <div class="col-12 mb-3">
                            <label class="form-label">{{ __('passport 1') }}
                                <small>({{ __('basic.required') }})</small></label>

                            @if ($visa->passport_1_img)
                            <div class="text-center mb-2">
                                <a target=”_blank” href="{{ URL::asset('img/visa/' . $visa->passport_1_img) }}">
                                    <img class=" me-3" style="width: 200px"
                                        src="{{ URL::asset('img/visa/' . $visa->passport_1_img) }}">
                                </a>
                            </div>
                            @endif

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="bi bi-calendar2-week-fill"></i>
                                    </div>
                                </div>
                                <input class="form-control" name='passport_1_img' accept="image/*" type="file"
                                    id="formFile">
                            </div>
                            <span id="passport_1_img-error" class="error-msg-form"></span>
                            @error('passport_1_img')
                            <span class="error-msg-form">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>

                        <div class="col-12 mb-3">
                            <label class="form-label">{{ __('passport 2') }}
                                <small>({{ __('basic.required') }})</small></label>

                            @if ($visa->passport_2_img)
                            <div class="text-center mb-2">
                                <a target=”_blank” href="{{ URL::asset('img/visa/' . $visa->passport_2_img) }}">
                                    <img class=" me-3" style="width: 200px"
                                        src="{{ URL::asset('img/visa/' . $visa->passport_2_img) }}">
                                </a>
                            </div>
                            @endif

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="bi bi-calendar2-week-fill"></i>
                                    </div>
                                </div>
                                <input class="form-control" name='passport_2_img' accept="image/*" type="file"
                                    id="formFile">
                            </div>
                            <span id="passport_2_img-error" class="error-msg-form"></span>
                            @error('passport_2_img')
                            <span class="error-msg-form">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>

                        <div class="col-12 mb-3">
                            <label class="form-label">{{ __('passport 3') }}
                                <small>({{ __('basic.required') }})</small></label>

                            @if ($visa->passport_3_img)
                            <div class="text-center mb-2">
                                <a target=”_blank” href="{{ URL::asset('img/visa/' . $visa->passport_3_img) }}">
                                    <img class=" me-3" style="width: 200px"
                                        src="{{ URL::asset('img/visa/' . $visa->passport_3_img) }}">
                                </a>
                            </div>
                            @endif

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="bi bi-calendar2-week-fill"></i>
                                    </div>
                                </div>
                                <input class="form-control" name='passport_3_img' accept="image/*" type="file"
                                    id="formFile">
                            </div>
                            <span id="passport_3_img-error" class="error-msg-form"></span>
                            @error('passport_3_img')
                            <span class="error-msg-form">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>

                        <div class="col-12 mb-3">
                            <label class="form-label">{{ __('passport 4') }}
                                <small>({{ __('basic.required') }})</small></label>

                            @if ($visa->passport_4_img)
                            <div class="text-center mb-2">
                                <a target=”_blank” href="{{ URL::asset('img/visa/' . $visa->passport_4_img) }}">
                                    <img class=" me-3" style="width: 200px"
                                        src="{{ URL::asset('img/visa/' . $visa->passport_4_img) }}">
                                </a>
                            </div>
                            @endif

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="bi bi-calendar2-week-fill"></i>
                                    </div>
                                </div>
                                <input class="form-control" name='passport_4_img' accept="image/*" type="file"
                                    id="formFile">
                            </div>
                            <span id="passport_4_img-error" class="error-msg-form"></span>
                            @error('passport_4_img')
                            <span class="error-msg-form">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>

                        <div class="col-12 mb-3">
                            <label class="form-label">{{ __('HR letter') }}
                                <small>({{ __('basic.required') }})</small></label>

                            @if ($visa->hr_img)
                            <div class="text-center mb-2">
                                <a target=”_blank” href="{{ URL::asset('img/visa/' . $visa->hr_img) }}">
                                    <img class=" me-3" style="width: 200px"
                                        src="{{ URL::asset('img/visa/' . $visa->hr_img) }}">
                                </a>
                            </div>
                            @endif

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="bi bi-calendar2-week-fill"></i>
                                    </div>
                                </div>
                                <input class="form-control" name='hr_img' accept="image/*" type="file" id="formFile">
                            </div>
                            <span id="hr_img-error" class="error-msg-form"></span>
                            @error('hr_img')
                            <span class="error-msg-form">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>

                        <div class="col-12 mb-3">
                            <label class="form-label">{{ __('bank statement') }}
                                <small>({{ __('basic.required') }})</small></label>

                            @if ($visa->bank_stat_img)

                            <div class="text-center mb-2">
                                <a target=”_blank” href="{{ URL::asset('img/visa/' . $visa->bank_stat_img) }}">
                                    <img class=" me-3" style="width: 200px"
                                        src="{{ URL::asset('img/visa/' . $visa->bank_stat_img) }}">
                                </a>
                            </div>
                            @endif

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="bi bi-calendar2-week-fill"></i>
                                    </div>
                                </div>
                                <input class="form-control" name='bank_stat_img' accept="image/*" type="file"
                                    id="formFile">
                            </div>
                            <span id="bank_stat_img-error" class="error-msg-form"></span>
                            @error('bank_stat_img')
                            <span class="error-msg-form">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>

                        <div class="col-12 mb-3">
                            <label class="form-label">{{ __('insurance') }}
                                <small>({{ __('basic.required') }})</small></label>

                            @if ($visa->insurance_img)
                            <div class="text-center mb-2">
                                <a target=”_blank” href="{{ URL::asset('img/visa/' . $visa->insurance_img) }}">
                                    <img class=" me-3" style="width: 200px"
                                        src="{{ URL::asset('img/visa/' . $visa->insurance_img) }}">
                                </a>
                            </div>
                            @endif

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="bi bi-calendar2-week-fill"></i>
                                    </div>
                                </div>
                                <input class="form-control" name='insurance_img' accept="image/*" type="file"
                                    id="formFile">
                            </div>
                            <span id="insurance_img-error" class="error-msg-form"></span>
                            @error('insurance_img')
                            <span class="error-msg-form">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>

                        <div class="col-12 mb-3">
                            <label class="form-label">{{ __('movement') }}
                                <small>({{ __('basic.required') }})</small></label>

                            @if ($visa->movement_img)
                            <div class="text-center mb-2">
                                <a target=”_blank” href="{{ URL::asset('img/visa/' . $visa->movement_img) }}">
                                    <img class=" me-3" style="width: 200px"
                                        src="{{ URL::asset('img/visa/' . $visa->movement_img) }}">
                                </a>
                            </div>
                            @endif

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="bi bi-calendar2-week-fill"></i>
                                    </div>
                                </div>
                                <input class="form-control" name='movement_img' accept="image/*" type="file"
                                    id="formFile">
                            </div>
                            <span id="movement_img-error" class="error-msg-form"></span>
                            @error('movement_img')
                            <span class="error-msg-form">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>

                        <div class="col-12 mb-3">
                            <label class="form-label">{{ __('other 1') }}
                                <small>({{ __('basic.required') }})</small></label>

                            @if ($visa->other_1)
                            <div class="text-center mb-2">
                                <a target=”_blank” href="{{ URL::asset('img/visa/' . $visa->other_1) }}">
                                    <img class=" me-3" style="width: 200px"
                                        src="{{ URL::asset('img/visa/' . $visa->other_1) }}">
                                </a>
                            </div>
                            @endif
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="bi bi-calendar2-week-fill"></i>
                                    </div>
                                </div>
                                <input class="form-control" name='other_1' accept="image/*" type="file" id="formFile">
                            </div>
                            <span id="other_1-error" class="error-msg-form"></span>
                            @error('other_1')
                            <span class="error-msg-form">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>

                        <div class="col-12 mb-3">
                            <label class="form-label">{{ __('other 2') }}
                                <small>({{ __('basic.required') }})</small></label>
                            @if ($visa->other_2)
                            <div class="text-center mb-2">
                                <a target=”_blank” href="{{ URL::asset('img/visa/' . $visa->other_2) }}">
                                    <img class=" me-3" style="width: 200px"
                                        src="{{ URL::asset('img/visa/' . $visa->other_2) }}">
                                </a>
                            </div>
                            @endif

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="bi bi-calendar2-week-fill"></i>
                                    </div>
                                </div>
                                <input class="form-control" name='other_2' accept="image/*" type="file" id="formFile">
                            </div>
                            <span id="other_2-error" class="error-msg-form"></span>
                            @error('other_2')
                            <span class="error-msg-form">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>

                    </div>
                </div>
            </div>


            <div class="d-flex justify-content-between mt-4 mb-2">
                <div class="d-flex justify-content-between ">
                    <a class="btn see-all" href="{{route('school_route.my_visa')}}">Previous</a>
                </div>

                <input type="submit" name="next" class="next-form-steps btn btn-primary action-button-next"
                    value="{{ __('basic.send') }}">
            </div>

        </form>

    </div>
</div>

@endsection
@section('js')
@endsection