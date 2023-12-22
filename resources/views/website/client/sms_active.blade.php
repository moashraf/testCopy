@extends('website.layouts.master')
@section('css')
@endsection
@section('content')
<div class="container-fluid signin">
    <div class="containery h-100">
        <!-- navbar  -->
        <img src=" {{ asset('images/Mask Group 5.png') }}" alt="" class="position-absolute animate1" style="top: 0 ;" />
        <img src=" {{ asset('images/Mask Group 5.png') }}" alt="" class="position-absolute animate2"
            style="top: 10% ;" />
        <img src=" {{ asset('images/Mask Group 5.png') }}" alt="" class="position-absolute animate3" style="top: 0 ;" />
        <section class="row p-3 h-100 align-items-center justify-content-center">


            <div class="col-12 col-md-8 col-xl-4 radius-20 bg-blur p-5 align-items-center">

                <div class=" bgWhite">
                    <div class="title">
                        <h3 class="fw-bold mb-3 text-capitalize text-center">SMS Active</h3>
                    </div>

                    <form method="get" data-group-name="digits" data-autosubmit="false" autocomplete="off"
                        class="align-items-center d-flex justify-content-between mt-4">
                        <input class="otp radius-10 border-0 form_input" type="text" id="digit_1" name="digit_1"
                            data-next="digit_1" oninput='digitValidate(this)' onkeyup='tabChange(1)' maxlength=1>
                        <input class="otp radius-10 border-0 form_input" type="text" id="digit_2" name="digit_2"
                            data-next="digit_2" data-previous="digit_1" oninput='digitValidate(this)'
                            onkeyup='tabChange(2)' maxlength=1>
                        <input class="otp radius-10 border-0 form_input" type="text" id="digit_3" name="digit_3"
                            data-next="digit_3" data-previous="digit_2" oninput='digitValidate(this)'
                            onkeyup='tabChange(3)' maxlength=1>
                        <input class="otp radius-10 border-0 form_input" type="text" id="digit_4" name="digit_4"
                            data-next="digit_4" data-previous="digit_3" oninput='digitValidate(this)'
                            onkeyup='tabChange(4)' maxlength=1>
                    </form>
                    <hr class="mt-4">
                    <button id="otp_send" class="btn yellow-btn p-3 text-center col-12">Verify</button>
                </div>

            </div>


        </section>
    </div>
</div>
@endsection
@section('js')

<script>
    let digitValidate = function(ele){
  console.log(ele.value);
  ele.value = ele.value.replace(/[^0-9]/g,'');
}

let tabChange = function(val){
    let ele = document.querySelectorAll('input');
    if(ele[val-1].value != ''){
      ele[val].focus()
    }else if(ele[val-1].value == ''){
      ele[val-2].focus()
    }   
 }

</script>

<script>
    //otp confirm
    $(document).on('click', "#otp_send", function(e) {
        e.preventDefault();
        //run vlidation plugin
        var digit_1 = $("input[name='digit_1']").val();
        var digit_2 = $("input[name='digit_2']").val();
        var digit_3 = $("input[name='digit_3']").val();
        var digit_4 = $("input[name='digit_4']").val();
        var digits = digit_1 + digit_2 + digit_3 + digit_4;
        var url = "{{ route('school_route.register_with_otp') }}";
        $(this).prop("disabled", true);
        // add spinner to button
        $(this).html(
            '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...'
        );
        $.ajax({
            url: url
            , type: 'POST'
            , dataType: "json"
            , data: {
                '_token': "{{ csrf_token() }}"
                , 'digits': digits
            , }
            , success: function(data) {
                if (data.status == true) {
                    toastr.success(data.msg);
                    $(location).attr('href', data.url);
                } else {
                    $("#otp_send").prop("disabled", false);
                    $("#otp_send").html('ارسال');
                    toastr.error(data.msg);
                }
            }
            , error: function(err) {
                // remove spinner to button
                $("#otp_send").prop("disabled", false);
                $("#otp_send").html('ارسال');
                toastr.error(data.msg);
            }
        , });
    });

</script>

@endsection