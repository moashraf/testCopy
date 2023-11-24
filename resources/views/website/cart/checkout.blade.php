@extends('website.layouts.master', ['no_transparent_header' => false])

@section('css')

<!-- datepicker time and date -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.css"
    integrity="sha512-MQXduO8IQnJVq1qmySpN87QQkiR1bZHtorbJBD0tzy7/0U9+YIC93QWHeGTEoojMVHWWNkoCp8V6OzVSYrX0oQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/dark.css">

<!-- tdatepicker -->
<link rel="stylesheet" href="{{ asset('js/datepicker/t-datepicker.min.css') }}" />
<link rel="stylesheet" href="{{ asset('js/datepicker/themes/t-datepicker-main.css') }}" />

<link rel="stylesheet" href="{{ asset('js/datepicker/themes/t-datepicker-main.css') }}" />

<style>

</style>
@endsection


@section('content')

<section class="bg-white pb-0 pb-md-5  mx-2 mx-md-5 px-4 pt-4 pt-md-5 px-md-5 mb-0"
    style="border-radius: 20px 20px 20px 20px; position: relative; z-index: 1; top: -1.3rem;">


    <form id="myform" method="POST" action="{{ route('school_route.order_store') }}">
        @csrf

        <div class="row">

            @if (cart_sum()['count'] > 0)

            <div class="col-12 col-lg-7 mb-4 mb-xl-0 order-1 order-md-0">

                <h6 class="fw-bold mb-3">Payment Method <i class="fa-solid fa-angle-right"></i></h6>

                <div class="check_payment_method_cont mb-3">
                    <div class="d-flex flex-column">
                        <label class="radio_check_payment">
                            <input type="radio" name="payment_method" class="payment_method_js" checked value="request">
                            <div class="d-flex justify-content-between">
                                <span><i class="fa-solid fa-paper-plane"></i> Send Request</span>
                            </div>
                        </label>
                        <div id="request_payment_cont" class="border_radius_20 p-4 mb-3"
                            style="background-color: #f3f8ff;">
                            <h6 class="fw-bold">Send a request to destino</h6>
                            <p>You can now send a request to our a team with all your cart items. within 24H our team
                                will
                                contact you for the best soluation to make a payment for you</p>
                        </div>

                        <label class="radio_check_payment">
                            <input type="radio" name="payment_method" class="payment_method_js" value="visa">
                            <div class="d-flex justify-content-between">
                                <span><i class="fa-solid fa-credit-card"></i> Visa</span>
                            </div>
                        </label>
                        <div id="visa_payment_cont" class="border_radius_20 p-4"
                            style="display: none; background-color: #f3f8ff;">
                            <h6 class="fw-bold">Pay by your card?</h6>
                            <p>sorry! but we do not accept credit card payment right now, but We are working on it. You
                                can
                                send a request right now</p>
                        </div>
                    </div>
                </div>


                {{-- payment
                <div class="mb-4">
                    <h6 class="fw-bold mb-3"> Payment Details<i class="fa-solid fa-angle-right ms-2"></i></h6>

                    <div class="bg-white border_radius_20 p-4 position-relative">

                        <div class="row">
                            <div class="col-12 col-md-6 mb-3">
                                <label class="form-label">Card Number <small>(required)</small></label>
                                <input name="payment_card_number" type="text" class="form-control"
                                    placeholder="Write your card number .. ..">
                            </div>
                            <div class="col-12 col-md-6 mb-3">
                                <label class="form-label">Expiry Date <small>(required)</small></label>
                                <input name="payment_card_date" type="text"
                                    class="form-control datepicker_time @error('date') is-invalid @enderror"
                                    placeholder="Write here the expiry date.." data-enable-time="true"
                                    value="{{ old('payment_card_date') }}" required>
                            </div>
                            <div class="col-12 col-md-6 mb-3">
                                <label class="form-label">CVS <small>(required)</small></label>
                                <input name="payment_card_number" type="text" class="form-control"
                                    placeholder="Write here the 3 digits of your card..">
                            </div>
                            <div class="col-12 col-md-6 mb-3">
                                <label class="form-label">Card Holder <small>(required)</small></label>
                                <input name="payment_card_number" type="text" class="form-control"
                                    placeholder="Write here the card holder name..">
                            </div>
                        </div>

                    </div>
                </div> --}}

                {{-- payment --}}
                <div>
                    <h6 class="fw-bold mb-0">Confirmation <i class="fa-solid fa-angle-right"></i></h6>

                    <div class="bg-white border_radius_20 p-4 position-relative">

                        <div class="row">
                            <div class="col-7 main-color-bg-200 p-3 border_radius_10">
                                <div class="form-check d-flex align-items-center">
                                    <label class="form-check-label clickable-item-pointer" for="women2">
                                        I agree to the terms and conditions
                                    </label>
                                    <input name="category[]" multiple="multiple" value="women"
                                        class="form-check-input m-0 ms-2 clickable-item-pointer" type="checkbox"
                                        id="women2" onchange="this.form.submit()">
                                </div>
                            </div>
                            <div class="col-5 text-center align-self-center">
                                <button type="submit" class="black_btn border_radius_20 px-5 border-0">PAY NOW</button>
                            </div>
                        </div>

                    </div>
                </div>


            </div>

            <div class="col-12 col-md-5">
                <h6 class="fw-bold mb-3">My Traveling Cart Summry <i class="fa-solid fa-angle-right ms-2"></i></h6>



                <div class="bg-white border_radius_20 p-4 px-4 mb-3" id="check_out_order_items">

                </div>

                <div class="bg-white border_radius_20 p-4 px-5">

                    <h6>We will confirm your booking withing a working day</h6>
                    <hr class=" text-gray-400">

                    <h6 class=" fw-bold">Booking details</h6>

                    <div class="d-flex justify-content-between">
                        <h6 class="text-s">Subtotal</h6>
                        <h6 class="text-gray-600"><span class="put_subtotal">0</span> L.E</h6>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h6 class="text-s">Discount</h6>
                        <h6 class="text-gray-600"><span class="put_discount">0</span> L.E</h6>
                    </div>

                    {{-- <div class="d-flex justify-content-between">
                        <h6 class="text-s">Tax</h6>
                        <h6 class="text-gray-600">60 ريال</h6>
                    </div>
                    --}}
                    <hr class=" text-gray-400">

                    <div class="coupon-result-input"></div>

                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <div class="text-s">
                            <h6 class="fw-bold mb-0">Total</h6>
                            <p class="text-gray-400 mb-0 text-xs">The price includes Tax and service fees</p>
                        </div>
                        <h4 class="text-gray-800 fw-bold"><span class="put_final_price">0</span> <small
                                class="text-xs text-gray-400">L.E</small></h4>
                    </div>

                </div>
            </div>

            @else

            <div class="py-5 text-center bg-white b-r-s-cont my-4">
                <img width="500px" class="img-fluid p-md-2 mb-2"
                    src="{{ URL::asset('img/svg/undraw_into_the_night_vumiw.svg') }}" alt="">
                <div>
                    <h3 class="mb-0">Your cart is empty</h3>
                    <a class="link-hover text-gray-300" href="{{ route('website_homepage') }}">Discover the world more
                        <i class="fas fa-angle-right text-s"></i></a>

                </div>
            </div>
            @endif
        </div>
    </form>

</section>

@endsection


@section('js')

<!-- datapicker date and time -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.js"
    integrity="sha512-K/oyQtMXpxI4+K0W7H25UopjM8pzq0yrVdFdG21Fh5dBe91I40pDd9A4lzNlHPHBIP2cwZuoxaUSX0GJSObvGA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    //-------- datepicker time --------
$('.datepicker_time').flatpickr({
    enableTime: false,
    dateFormat: "Y-m-d",
    theme: "dark", // defaults to "light"
});
</script>

<script>
    var full_height_width_slider_swiper = new Swiper(".full_height_width_slider_swiper", {
    pagination: {
        el: ".swiper-pagination",
    },
});

var swiper = new Swiper(".to_do_desti_swiper", {
    slidesPerView: "auto",
    loop: true,
    touchEventsTarget: 'container',
    slidesPerView: "auto",
    touchEventsTarget: 'container',
    spaceBetween: 10,
    loop: true,

});
</script>


<script src="{{ asset('js/datepicker/t-datepicker.min.js') }}"></script>


<script>
    $('.t-datepicker').tDatePicker({
    autoClose: true,
    durationArrowTop: 200,
    numCalendar: 2
});
</script>




<script>
    $(document).on('click', '.payment_method_js', function() {

    var payment_method = $(this).val();

    if(payment_method === "request"){
        $("#request_payment_cont").show();
        $("#visa_payment_cont").hide();
    }else{
        $("#request_payment_cont").hide();
        $("#visa_payment_cont").show();
    }

});

    //in case the user want to delete the coupon
    $(document).on('click', '#delete_coupon', function() {

    var url = "{{ route('school_route.coupon_delete') }}";

        $.ajax({
            url: url
            , type: 'POST'
            , dataType: "json"
            , data: {
                '_token': "{{ csrf_token() }}"
            , }
            , success: function(data) {
                if (data.status == true) {
                    fetchCart();
                    toastr.success(data.msg);
                } else {
                    $('#coupon_input').val("")
                    $(".put_discount_cont").addClass('d-none');

                    $(".coupon-result-input").html(
                        '<p class="text-red-error"><i class="fas fa-exclamation-circle"></i> ' +
                        data.msg + '</p>');
                    toastr.error(data.msg);
                }
            }
        });

    });

    //add new address
    $(document).on('click', ".delete_item_cart", function(e) {
    e.preventDefault();

    var id = $(this).data('id');

    var url = "{{ route('school_route.remove_cart') }}";

    var that = $(this);
        $.ajax({
            url: url
            , type: 'POST'
            , dataType: "json"
            , data: {
                '_token': "{{ csrf_token() }}"
                , 'id': id
            , }
            , success: function(data) {
                if (data.status == true) {
                    fetchCart();

                    that.closest('.cont-item-ajax').remove();
                    toastr.success(data.msg);
                } else {
                    toastr.error(data.msg);
                }
            }
            , error: function(err) {

                if (err.status == 422) {
                    toastr.error(err.responseJSON.message);
                }
                if (err.status == 500) {
                    toastr.error(err.responseJSON.message);
                }
            }
        , });

    });

// fetch cart 
    fetchCart();

function fetchCart() {

    var url = "{{ route('school_route.cart_show_ajax') }}";
    $.ajax({
        url: url
        , type: "GET"
        , dataType: "json"
        , success: function(data) {


            $('#check_out_order_items').html('');

            html = "";
            $.each(data.content, function(key, value) {
                if(value.type === "hotel"){
                    avatar_url = '{{ URL::asset('img/unit/') }}';
                }

                html += 
                    '<div class="d-flex align-items-center justify-content-between">' +
                        '<div class="d-flex ">' +
                                '<img class="rounded-circle avatar-small2 me-2" src=' + avatar_url + '/' + value.img + '>' +
                            '<div class="text-start"">' +
                            '<p class="mb-0 text-xs fw-bold text-gray-600 ">' + value.name + '</p>' +
                                '<p class="mb-0 text-xs text-gray-300 ">from:' + value.from + '</p>' +
                                '<p class="mb-0 text-xs text-gray-300 ">to:' + value.to + '</p>' +
                            '</div>' +
                        '</div>' +
                    '<h4>' + value.price + '</h4>' +
                    '</div>';
            });

            $('#check_out_order_items').html(html);


            $('.put_subtotal').html(data.subtotal);

            if (data.coupon_id !== null) {
                $('.put_discount_cont').removeClass('d-none');
                $('.put_discount').html(data.discount);
                
            } else {
                $('.put_discount_cont').addClass('d-none');
                $('.put_discount').html('0');
                $('.coupon-result-input').hide();
                $('#coupon_input').val('');
            }

            var final_price = parseInt(data.final_price);

            // $('.put_tax').html(data.total_tax);
            $('.put_final_price').html(final_price);


        }
    });
}
</script>
@endsection