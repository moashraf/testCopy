@extends('website.client.client_dashboard')
@section('css')
@endsection
@section('content')
    <div class="row p-3 pt-0">

        <div class="banner-4 radius-20">
            <div class="w-50 float-end pt-3">
                <h2 class="fw-bold ">you need visa to order from destino</h2>
                <p class=" fs-8">Lorem Ipsum is simply dummy text of the printing and typesetting
                    industry.
                    Lorem Ipsum has been the industry's standard dummy text </p>
            </div>
        </div>


        <div class="d-flex justify-content-between ps-4 align-items-center mt-5">
            <div>
                <h2 class="text-capitalize fw-bold">trip information</h2>
                <p class="fs-7 gray">welcome back and discover the world</p>
            </div>
        </div>
        <div>
            <div class="d-flex choose-photo p-2 radius-20">
                <img src="images/slide1.png" class="radius-20 ms-2" alt="">
                <img src="images/slide2.png" class="radius-20 ms-2" alt="">
                <form class="file-uploader ms-2">
                    <label for="file-input"><i class="fa-solid fa-plus"></i></label>
                    <input id="file-input" type="file" />
                </form>
            </div>
            <form method="post" class="col-12 radius-20 pt-3 align-items-center">
                <div class="mb-3 row">
                    <div class="col-12 col-md-12">
                        <input type="text" placeholder="trip name" class="form-control mb-3  p-4 border-0" required=""
                            id="f-name" />
                    </div>
                    <div class="col-12 col-md-6">
                        <select class="form-select form-select-lg form-control fs-7 gray  p-4 border-0 mb-3"
                            aria-label=".form-select-lg example">
                            <option selected>Open this select menu</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-6">
                        <select class="form-select form-select-lg form-control fs-7 gray  p-4 border-0 mb-3"
                            aria-label=".form-select-lg example">
                            <option selected>Open this select menu</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-6">
                        <select class="form-select form-select-lg form-control fs-7 gray  p-4 border-0 mb-3"
                            aria-label=".form-select-lg example">
                            <option selected>Open this select menu</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-6">
                        <select class="form-select form-select-lg form-control fs-7 gray  p-4 border-0 mb-3"
                            aria-label=".form-select-lg example">
                            <option selected>Open this select menu</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-6">
                        <input type="date" placeholder="checkin date" class="radius-10 fs-7 gray  btn-drop w-100 mb-3"
                            required />
                    </div>
                    <div class="col-12 col-md-6">
                        <input type="date" placeholder="checkin date" class="radius-10 btn-drop w-100 mb-3" required />
                    </div>
                    <div class="d-flex justify-content-between  ps-3">
                        <a href=""><button class="btn see-all ">Previous</button></a>
                        <a href=""> <button class="btn-next text-light border-0 radius-10">create and
                                share</button></a>


                    </div>
                </div>
            </form>
        </div>

    </div>
@endsection
@section('js')
@endsection
