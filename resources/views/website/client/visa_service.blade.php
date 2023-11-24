@extends('website.client.client_dashboard')
@section('css')
@endsection
@section('content')
<div class="row p-3 pt-0">

    <div class="banner-2 radius-20">
        <div class="w-50 float-end pt-3">
            <h2 class="fw-bold ">you need visa to order from destino</h2>
            <p class=" fs-8">Lorem Ipsum is simply dummy text of the printing and typesetting
                industry.
                Lorem Ipsum has been the industry's standard dummy text </p>
        </div>
    </div>
    <div class="multi-setps-form-calander col-12">

        <form id="myform" method="POST" action="{{route('school_route.store_order')}}" enctype="multipart/form-data"
            novalidate="novalidate">

            @csrf



            <!-- content -->

            <div class="cont_tap " id="order_visa">
                <div class="text-center mt-5">
                    <img src="images/Group 39925.svg" alt="">
                    <h1 class="fw-bold fs-4 mt-2">You havnt visa</h1>
                    <p class="gray fs-7">welcome to destino please fill all information</p>
                    <input type="button" name="next" class="next-form-steps btn yellow-btn action-button-next"
                        value="Continue">
                </div>
            </div>


            <div class="cont_tap" id="collect_info">
                <div class="d-flex justify-content-between align-items-center p-3 mt-4 flex-wrap">
                    <div>
                        <h3 class="text-capitalize fw-bold">order information</h3>
                        <p class="fs-7 gray">welcome back and discover the world</p>
                    </div>
                    <div class="d-flex step flex-wrap">
                        <div class="d-flex me-5" id="step-1">
                            <i class="fa-solid fa-info text-light radius-10"></i>
                            <div class="ms-2">
                                <span class="fs-7 fw-bold">1.</span>
                                <p class="fs-7 fw-bold">collect info</p>
                            </div>
                        </div>
                        <div class="d-flex active-step" id="step-2">
                            <i class="fa-regular fa-file-lines  radius-10"></i>
                            <div class="ms-2">
                                <span class="fs-7 fw-bold">2.</span>
                                <p class="fs-7 fw-bold">upload docx</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-3 row">
                    <div class="col-12 col-md-6">
                        <input type="text" name="name" placeholder="Lgal name" class="form-control mb-3  p-4 border-0"
                            required="" id="f-name" />
                    </div>
                    <div class="col-12 col-md-6">
                        <input type="date" name="birth_date" placeholder="Birth date"
                            class="form-control mb-3  p-4 border-0" required="" id="f-name" />
                    </div>
                    <div class="col-12 col-md-6">
                        <input type="email" name="email" placeholder="Email" class="form-control mb-3 p-4 border-0"
                            required="" id="f-name" />
                    </div>
                    <div class="col-12 col-md-6">
                        <input type="phone" name="phone" placeholder="phone" class="form-control mb-3 p-4 border-0"
                            required="" id="phone" />
                    </div>
                    <div class="col-12 col-md-6">
                        <select name="country_id"
                            class="form-select form-select-lg form-control fs-7 gray  p-4 border-0 mb-3"
                            aria-label=".form-select-lg example">
                            <option class="fs-8" style="color:#66615b">Country</option>
                            @foreach ($country as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach

                        </select>
                    </div>
                    <div class="col-12 col-md-6">
                        <select name="country_want_book"
                            class="form-select form-select-lg form-control fs-7 gray p-4 border-0 mb-3"
                            id="floatingTextarea10" aria-label=".form-select-lg example" id="floatingTextarea10">
                            <option class="fs-8" style="color:#66615b">Country you want book</option>

                            @foreach ($country as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12">
                        <div class="form-floating gray">
                            <textarea name="about" class="form-control gray  border-0 mb-3"
                                placeholder="Leave a comment here" id="floatingTextarea2"
                                style="height: 100px"></textarea>
                            <label for="floatingTextarea2 fs-8">about you</label>
                        </div>
                    </div>


                </div>
                <div class="d-flex justify-content-between ">
                    <input type="button" name="previous" class="previous-form-steps btn see-all action-button-previous"
                        value="Previous">
                    <input type="button" name="next" class="next-form-steps btn btn-primary action-button-next"
                        value="Continue">
                </div>

            </div>

            <div class="cont_tap" id="Upload_docs">
                <div class="d-flex justify-content-between align-items-center p-3 mt-4 flex-wrap">
                    <div>
                        <h3 class="text-capitalize fw-bold">order information</h3>
                        <p class="fs-7 gray">welcome back and discover the world</p>
                    </div>
                    <div class="d-flex step">
                        <div class="d-flex  me-5" id="step-1">
                            <i class="fa-solid fa-info text-light radius-10"></i>
                            <div class="ms-2">
                                <span class="fs-7 fw-bold">1.</span>
                                <p class="fs-7 fw-bold">collect info</p>
                            </div>
                        </div>
                        <div class="d-flex" id="step-2">
                            <i class="fa-regular fa-file-lines text-light radius-10"></i>
                            <div class="ms-2">
                                <span class="fs-7 fw-bold">2.</span>
                                <p class="fs-7 fw-bold">upload docx</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex choose-photo p-2 radius-20 w-100 ms-0">
                    <i class="fa-regular fa-file-lines file radius-20"></i>
                    <i class="fa-regular fa-file-lines file radius-20"></i>

                    <label for="file-input"><i class="fa-solid fa-plus"></i></label>
                    <input name="image_order" id="file-input" accept="image/*" type="file" />
                    @error('image_order')
                    <span class="error-msg-form">
                        {{ $message }}
                    </span>
                    @enderror

                </div>
                <div class="d-flex justify-content-between mt-4 ">
                    <input type="button" name="previous" class="previous-form-steps btn see-all action-button-previous"
                        value="Previous" />
                    <button type="submit" name="next"
                        class="next-form-steps btn btn-primary action-button-next">Order</button>
                </div>

            </div>

            <div class="cont_tap" id="visa_done">
                <div class="text-center mt-5">
                    <img src="images/Group 39925.svg" alt="">
                    <h2 class="fw-bold fs-4 mt-2">your visa ordered</h2>
                    <p class="gray fs-7">welcome to destino please fill all information</p>
                    <a href="#"> <button class="btn yellow-btn">see trips</button></a>

                </div>
            </div>

        </form>
    </div>


</div>
@endsection
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"
    integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{ asset('js/main.js') }}"></script>
@endsection