@extends('website.layouts.master', ['no_transparent_header' => false])
@section('css')
@endsection
@section('content')

<section class="bg-white pb-0 pb-md-5  mx-2 mx-md-5 px-4 pt-4 pt-md-5 px-md-5 mb-0"
    style="border-radius: 20px 20px 20px 20px; position: relative; z-index: 1; top: -1.3rem;">
    <div class="text-center">
        <img width="420px" class="img-fluid p-md-2" src="{{ URL::asset('img/svg/confirmed-not-css.svg') }}" alt="">
        {{-- <i class="bi bi-check-circle text-xl text-green mb-3"></i> --}}
        <div>
            <h3 class="mb-0">Thank You For For Using Destino Tours</h3>

            <p class="text-gray-300 mb-0">Your request has been placed and waiting for reviewing</p>
            <p class="text-gray-300">We have sent an SMS to your mobile to confirm your request</p>

            <p class="text-gray-300 px-3">Your order number: <span class="text-gray-500 fw-bold">#{{
                    $order->code }}</span>
            </p>

            <a class="yellow_400 b-r-l-cont" href="{{ route('school_route.my_request_items', $order->code) }}"><i
                    class="fas fa-send"></i>
                <i class="fa-solid fa-paper-plane text-s"></i>
                Track Your Request
            </a>
        </div>
    </div>

</section>

@endsection
@section('js')

@endsection