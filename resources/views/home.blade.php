@extends('layouts.master')

@section('title', 'contact us')

<!-- css insert -->
@section('css')
<style>


</style>

@endsection

<!-- content insert -->
@section('content')

<div class="card card-input shadow mb-4">
    <!-- Card Header - Dropdown -->
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 fw-bold">Users table</h6>
        <div class="dropdown no-arrow">
            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-300"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                <div class="dropdown-header">Dropdown Header:</div>
                <a class="dropdown-item" href="#">Action</a>
            </div>
        </div>
    </div>

    <!-- Card Body -->
    <div class="card-body p-3 p-md-5">

        <div class="d-flex justify-content-center flex-wrap">

            <div class="mb-3 mb-md-0"
                style="background-image: url('{{ asset('img/dashboard/system/human_front.jpg') }}'); width:255px; height:457px; position: relative;">

                <canvas class="canvas" id="canvas" width="255" height="457"
                    style=" solid;position: absolute;top:0;left:0;"></canvas>

                <div id="canvas-clear" class="btn btn-primary" style="position: absolute; bottom:40px; left:0px;"><i
                        class="fas fa-eraser"></i>
                </div>

                <div id="imgsave" class="btn btn-danger" style="position: absolute; bottom:0px; left:0px;"><i
                        id="icon_save" class="fas fa-check"></i>
                </div>


                <div style="position: absolute; bottom:100px; left:0px;">
                    <div class="d-flex mb-1">
                        <div class="color-selector-draw me-1 clickable-item-pointer rounded-circle" data-color="#000000"
                            style="width:10px;height:10px;background:#000000;"></div>
                        <div class="color-selector-draw me-1 clickable-item-pointer rounded-circle" data-color="#0cb6ed"
                            style="width:10px;height:10px;background:#0cb6ed;"></div>
                        <div class="color-selector-draw me-1 clickable-item-pointer rounded-circle" data-color="#17c34e"
                            style="width:10px;height:10px;background:#17c34e;"></div>
                    </div>
                    <div class="d-flex">
                        <div class="color-selector-draw me-1 clickable-item-pointer rounded-circle" data-color="#dc3545"
                            style="width:10px;height:10px;background:#dc3545;"></div>
                        <div class="color-selector-draw me-1 clickable-item-pointer rounded-circle" data-color="#ffd807"
                            style="width:10px;height:10px;background:#ffd807;"></div>
                        <div class="color-selector-draw me-1 clickable-item-pointer rounded-circle" data-color="#ff6d00"
                            style="width:10px;height:10px;background:#ff6d00;"></div>
                    </div>
                </div>

            </div>

            <div
                style="background-image: url('{{ asset('img/dashboard/system/human_back.jpg') }}'); width:255px; height:457px; position: relative;">
                <canvas class="canvas" id="canvas_b" width="255" height="457"
                    style=" solid;position: absolute;top:0;left:0;"></canvas>

                <div id="canvas-clear_b" class="btn btn-primary" style="position: absolute; bottom:40px; left:0px;"><i
                        class="fas fa-eraser"></i>
                </div>

                <div id="imgsave_b" class="btn btn-danger" style="position: absolute; bottom:0px; left:0px;"><i
                        id="icon_save_b" class="fas fa-check"></i>
                </div>


                <div style="position: absolute; bottom:100px; left:0px;">
                    <div class="d-flex mb-1">
                        <div class="color-selector-draw_b me-1 clickable-item-pointer rounded-circle"
                            data-color="#000000" style="width:10px;height:10px;background:#000000;"></div>
                        <div class="color-selector-draw_b me-1 clickable-item-pointer rounded-circle"
                            data-color="#0cb6ed" style="width:10px;height:10px;background:#0cb6ed;"></div>
                        <div class="color-selector-draw_b me-1 clickable-item-pointer rounded-circle"
                            data-color="#17c34e" style="width:10px;height:10px;background:#17c34e;"></div>
                    </div>
                    <div class="d-flex">
                        <div class="color-selector-draw_b me-1 clickable-item-pointer rounded-circle"
                            data-color="#dc3545" style="width:10px;height:10px;background:#dc3545;"></div>
                        <div class="color-selector-draw_b me-1 clickable-item-pointer rounded-circle"
                            data-color="#ffd807" style="width:10px;height:10px;background:#ffd807;"></div>
                        <div class="color-selector-draw_b me-1 clickable-item-pointer rounded-circle"
                            data-color="#ff6d00" style="width:10px;height:10px;background:#ff6d00;"></div>
                    </div>
                </div>
            </div>
        </div>


        <form id="myform" class="myform" method="POST" action="{{ route('sett.disease_draws.store') }}"
            enctype="multipart/form-data">
            @csrf
            <input name="front" id="front_input" type="hidden">
            <input name="back" id="back_input" type="hidden">
            <input type="submit">
        </form>

    </div>

    <!-- Card footer -->
    <div class="card-footer text-center ">

    </div>

</div>

@endsection

<!-- js insert -->
@section('js')


@endsection