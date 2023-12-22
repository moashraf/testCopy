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

<section class="bg-white py-5 mx-2 mx-md-5 px-2 pt-5 px-md-5 mb-0"
    style="border-radius: 20px 20px 20px 20px; position: relative; z-index: 1; top: -1.3rem;">

    <div class="row">

        <div class="col-12 col-lg-7 mb-4 mb-xl-0">


            {{-- cart items --}}
            <div class="mb-4">
                <h6 class="fw-bold mb-4">Your Booking Details <i class="fa-solid fa-angle-right ms-2"></i></h6>


                <div id="cart_items_ajax" class="mb-4">

                    <div class="bg-white border_radius_20 p-4 pt-5 pt-md-5 position-relative">
                        <div class="position-absolute" style="top: -11px; left:20px">
                            <button data-bs-toggle="modal" data-bs-target="#new_ht_traveler"
                                class="white_btn border-0 shadow-main border_radius_20 ms-2"><i
                                    class="fa-solid fa-plus text-xxs"></i>
                                Is it for you or other person?</button>
                            <button class=" btn btn-danger rounded-circle p-0 w_h_25"><i
                                    class="fa-solid fa-trash-can text-xxs"></i></button>

                            {{-- modal for new traveler --}}
                            <div class="modal fade" id="new_ht_traveler" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">

                                    <div class=" modal-content b-r-s-cont border-0">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel"><i
                                                    class="fas fa-plus me-1"></i>
                                                Add other person to this booking</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>

                                        <div class="modal-body px-5 py-3">

                                            <div class="row mb-2">
                                                <div class="col-12 mb-2">
                                                    <label class="form-label">Traveler Name
                                                        <small>(required)</small></label>
                                                    <input name="ht_traveler_name[]" type="text" class="form-control"
                                                        placeholder="Write here the traveler name ..">
                                                </div>
                                                <div class="col-12 mb-2">
                                                    <label class="form-label">Traveler Phone Number
                                                        <small>(Required)</small></label>
                                                    <input name="ht_traveler_phone[]" type="number" class="form-control"
                                                        placeholder="Write here the traveler phone ..">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <div class="right-side">
                                                <button data-bs-dismiss="modal"
                                                    class="btn btn-default btn-link main-color">
                                                    Add New</button>
                                            </div>
                                            <div class="divider"></div>

                                            <div class="left-side">
                                                <button type="button" class="btn btn-default btn-link"
                                                    data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>


                        <div class="row align-items-center">

                            <div class="col-12 col-md-6 d-flex align-items-center calander-left-border mb-3 mb-md-0">
                                <img class="avatar-lg me-2 b-r-xs"
                                    src="{{ URL::asset('img/website/test/Rectangle q18.png') }}">
                                <div>
                                    <h6 class="mb-2 text-gray-900 text-truncate fw-bold text-truncate">كوريدو آيلاند
                                        ريزورت
                                    </h6>

                                    <div>
                                        <h6 class="mb-2 text-xs text-gray-500"><i class="fa-solid fa-user"></i> <i
                                                class="fa-solid fa-user"></i> ٢ اشخاص
                                        </h6>
                                        <h6 class="mb-2 text-xs text-gray-500"><i class="fa-solid fa-utensils"></i>
                                            شاملة
                                            كليا
                                        </h6>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6 col-md-3 calander-left-border text-center">
                                <h6 class="mb-2 text-xs text-gray-400">From
                                    <span class="text-gray-800 fw-bold">20 Jan 2023</span>
                                </h6>
                                <h6 class="mb-2 text-xs text-gray-400">To
                                    <span class="text-gray-800 fw-bold">20 Jan 2023</span>
                                </h6>
                                <h6 class="mb-2 text-xs text-gray-400">Nights
                                    <span class="text-gray-800 fw-bold">5 <span> Nights</span></span>
                                </h6>
                            </div>

                            <div class="col-6 col-md-3 d-flex justify-content-around align-items-center">
                                <div class="text-center">
                                    <h6 class="text-gray-400 text-xs mb-0">Total for 4 nights</h6>
                                    <h4 class="main-color fw-bold mb-1">
                                        212 <small> L.E</small>
                                    </h4>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>

            </div>
        </div>

        <div class="col-12 col-md-5">
            <h6 class="fw-bold mb-3">My Traveling Cart Summry <i class="fa-solid fa-angle-right ms-2"></i></h6>
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

                <div class="main-color-bg-200 border_radius_10 p-3 d-flex justify-content-between mb-4">
                    <input name="ht_traveler_phone" type="text" id="coupon_input" class="form-control"
                        placeholder="Write here the coupon code..">
                    <input type="hidden" name="coupon_id" id="coupon_id">

                    <button class="btn btn-dark px-5 text-xs" id="coupon-buttn">Apply</button>

                    @error('coupon_id')
                    <span class="error-msg-form">
                        {{ $message }}
                    </span>
                    @enderror
                </div>
                <div class="coupon-result-input"></div>

                <div class="d-flex align-items-center justify-content-between mb-2">
                    <div class="text-s">
                        <h6 class="fw-bold mb-0">Total</h6>
                        <p class="text-gray-400 mb-0 text-xs">The price includes Tax and service fees</p>
                    </div>
                    <h4 class="text-gray-800 fw-bold"><span class="put_final_price">0</span> <small
                            class="text-xs text-gray-400">L.E</small></h4>
                </div>

                <div class="col-5 text-center align-self-center justify-content-center mx-auto">
                    <a href="{{ route('school_route.checkout') }}">
                        <button class="black_btn border_radius_20 px-5 border-0">CHECKOUT</button>
                    </a>
                </div>

            </div>
        </div>

    </div>
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
    $(document).on('click', '#coupon-buttn', function() {

    var search_query = $('#coupon_input').val();

    var url = "{{ route('school_route.coupon_search') }}";

    $.ajax({
        url: url
        , type: 'POST'
        , dataType: "json"
        , data: {
            '_token': "{{ csrf_token() }}"
            , 'code': search_query
        , }
        , success: function(data) {
            if (data.status == true) {

                $(".put_discount_cont").removeClass('d-none');

                $(".coupon-result-input").show();

                $(".coupon-result-input").html(
                    '<p class="me-2 mb-2 text-green"><i class="bi bi-check-circle-fill"></i> ' +
                    data.msg +
                    '<small id="delete_coupon" class="text-red pointer_item clickable-item-pointer"> Delete?</small></p>'
                );

                fetchCart();
                toastr.success(data.msg);
            } else {
                $('#coupon_input').val("")
                $(".put_discount_cont").addClass('d-none');

                $(".coupon-result-input").html(
                    '<p class="text-red-error"><i class="fas fa-exclamation-circle"></i> ' +
                    data.msg +
                    '</p>');

                toastr.error(data.msg);
            }
        }
    });
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

            $('#cart_items_ajax').html('');

            $.each(data.content, function(key, value) {

                if(value.type === "hotel"){
                    avatar_url = '{{ URL::asset('img/unit/') }}';
                }else if(value.type === "package"){
                    avatar_url = '{{ URL::asset('img/package/') }}';
                }else if(value.type === "visa"){
                    avatar_url = '{{ URL::asset('img/visa/cat/') }}';
                }else if(value.type === "trip"){
                    avatar_url = '{{ URL::asset('img/trip/') }}';
                }


                var rendom_number = (Math.random() + 1).toString(36).substring(4);


                $('#cart_items_ajax').append(

                   '<div class="bg-white border_radius_20 p-4 pt-5 pt-md-5 position-relative">' +
                   '<div class="position-absolute" style="top: -11px; left:20px">' +

                        '<button data-bs-toggle="modal" data-bs-target="#new_ht_traveler' + rendom_number + '" class="white_btn border-0 shadow-main border_radius_20 me-2">' + 
                            '<i class="fa-solid fa-plus text-xxs"></i>' +
                            'Is it for you or other person? </button>' +
                            '<button data-id="' + value.type + value.product_id + '" class=" btn btn-danger delete_item_cart rounded-circle p-0 w_h_25"><i class="fa-solid fa-trash-can text-xxs"></i></button>' +

                        // modal to add person
                        '<div class="modal fade" id="new_ht_traveler' + rendom_number + '" tabindex="-1" role="dialog"  aria-labelledby="exampleModalLabel" aria-hidden="true">' +
                           '<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">' +

                                '<div class=" modal-content b-r-s-cont border-0">' +
                                    '<div class="modal-header">' +
                                        '<h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-plus me-1"></i>' +
                                            'Add other person to this booking</h5>' +
                                        '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>' +
                                '</div>' +

                                    '<div class="modal-body px-5 py-3">' +

                                        '<div class="row mb-2">' +
                                            '<div class="col-12 mb-2">' +
                                                '<label class="form-label">Traveler Name<small>(required)</small></label>' +
                                                '<input name="ht_traveler_name[]" type="text" class="form-control" placeholder="Write here the traveler name ..">' +
                                            '</div>' +
                                            '<div class="col-12 mb-2">' +
                                               '<label class="form-label">Traveler Phone Number <small>(Required)</small></label>' +
                                                '<input name="ht_traveler_phone[]" type="number" class="form-control" placeholder="Write here the traveler phone ..">' +
                                            '</div>' +
                                        '</div>' +
                                    '</div>' +

                                    '<div class="modal-footer">' +
                                        '<div class="right-side">' +
                                            '<button data-bs-dismiss="modal" class="btn btn-default btn-link main-color">Add New</button>' +
                                        '</div>' +
                                        '<div class="divider"></div>' +
                                        '<div class="left-side">' +
                                           '<button type="button" class="btn btn-default btn-link" data-bs-dismiss="modal">Close</button>' +
                                        '</div>' +
                                   '</div>' +
                                '</div>' +
                            '</div>' +
                        '</div>' +
                    '</div>' +


                    '<div class="row align-items-center">' +

                        '<div class="col-12 col-md-6 d-flex align-items-center calander-left-border mb-3 mb-md-0">' +
                            '<img class="avatar-lg me-2 b-r-xs" src="' + avatar_url + '/' +  value.img + '">' +
                            '<div>' +
                                '<h6 class="text-gray-400 text-truncate fw-bold text-truncate text-xs mb-1">' + value.type +'</h6>' +

                                '<h6 class="text-gray-900 text-truncate fw-bold text-truncate mb-1">' + value.name +'</h6>' +

                                (value.meal !== null ? '<div>' +
                                        '<h6 class="text-xs text-gray-500">Type: ' +
                                            value.meal +
                                        '</h6>' +
                                    '</div>' : '')   +

                                (value.cat !== null ? '<div>' +
                                        '<h6 class="text-xs text-gray-500">Type: ' +
                                            value.cat +
                                        '</h6>' +
                                    '</div>' : '')   +
                               
                            '</div>' +
                       '</div>' +

                        '<div class="col-6 col-md-3 calander-left-border text-center">' +
                            '<h6 class="mb-2 text-xs text-gray-400">From <span class="text-gray-800 fw-bold">' + value.from + '</span> </h6>' +
                            '<h6 class="mb-2 text-xs text-gray-400">To <span class="text-gray-800 fw-bold"> ' + value.to +' </span></h6>' +
                            
                            (value.nights !== null ? '<h6 class="mb-2 text-xs text-gray-400">Nights <span class="text-gray-800 fw-bold">' + value.nights +'<span> Nights</span></span> </h6>' : '')   +
                             
                        '</div>' +

                        '<div class="col-6 col-md-3 d-flex justify-content-around align-items-center">' +
                            '<div class="text-center">' +
                                '<h6 class="text-gray-400 text-xs mb-0">' +
                                    (value.nights !== null ? 'Total for ' + value.nights +  ' nights' : 'Total Price')   +
                                '<h4 class="main-color fw-bold mb-1">' + value.price + '<small> L.E</small>' +
                                '</h4>'+
                            '</div>' +
                        '</div>' +
                    '</div>' +

                '</div>'
                )

            });

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