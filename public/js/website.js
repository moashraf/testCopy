//to enable tooltips everywhere
/* var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
}) */

//to enable tooltips everywhere
$(document).ready(function() {
    $("body").tooltip({
        selector: '[data-toggle=tooltip]'
    });
});

//multi steps form
$(document).ready(function () {
    var current_fs, next_fs, previous_fs; //fieldsets
    var opacity;

    /*
    //to show the given div by <a> progress head and hide other divs 
    $('#myform a[href^="#"]').on('click', function (event) {

        $('.cont_tap').hide() //hide all div
        var target = $(this).attr('href'); //get the value of href
        $('.cont_tap' + target).show(); //show the specific div with href

        $(this).parent().addClass("active");
        $(this).children('.icon-circle').addClass("checked");

    }); */

    $(document).on("click", ".next-form-steps", function() {

        if(!$(this).data("skip")){
            //for validation
            $('#myform').validate();
            if (!$('#myform').valid()) {
                return false;
            }
        }

        //
        current_fs = $(this).closest(".cont_tap");
        next_fs = $(this).closest(".cont_tap").next();

        //Add Class (Active) and (checked) progress bar
        $("#progressbar li").eq($(".cont_tap").index(next_fs)).addClass("active");
        //eq() is to select an element with a specific index number.
        $("#progressbar li .icon-circle").eq($(".cont_tap").index(next_fs)).addClass("checked");
        
        //show the next div
        next_fs.show();

        //hide the current div with style
        current_fs.animate({ opacity: 0 }, {
            step: function (now) {
                // for making the div appear animation
                opacity = 1 - now;
                current_fs.css({
                    'display': 'none',
                    'position': 'relative'
                });
                next_fs.css({ 'opacity': opacity });
            },
            duration: 500
        });
    });


    $(document).on("click", ".skip-form-steps", function() {
        
        //
        current_fs = $(this).closest(".cont_tap");
        next_fs = $(this).closest(".cont_tap").next();

        //Add Class (Active) and (checked) progress bar
        $("#progressbar li").eq($(".cont_tap").index(next_fs)).addClass("active");
        //eq() is to select an element with a specific index number.
        $("#progressbar li .icon-circle").eq($(".cont_tap").index(next_fs)).addClass("checked");

        //show the next div
        next_fs.show();

        //hide the current div with style
        current_fs.animate({ opacity: 0 }, {
            step: function (now) {
                // for making the div appear animation
                opacity = 1 - now;
                current_fs.css({
                    'display': 'none',
                    'position': 'relative'
                });
                next_fs.css({ 'opacity': opacity });
            },
            duration: 500
        });
    });

    $(document).on("click", ".previous-form-steps", function() {

        current_fs = $(this).closest(".cont_tap");
        previous_fs = $(this).closest(".cont_tap").prev();

        //Remove class active progress bar
        $("#progressbar li").eq($(".cont_tap").index(current_fs)).removeClass("active");
        $("#progressbar li .icon-circle").eq($(".cont_tap").index(current_fs)).removeClass("checked");

        //show the previous fieldset
        previous_fs.show();

        //hide the current fieldset with style
        current_fs.animate({ opacity: 0 }, {
            step: function (now) {
                // for making fielset appear animation
                opacity = 1 - now;
                current_fs.css({
                    'display': 'none',
                    'position': 'relative'
                });
                previous_fs.css({ 'opacity': opacity });
            },
            duration: 500
        });
    });


    //for second bar prog (patient)
    $(document).on("click", ".next-form-steps_patient", function() {

        current_fs = $(this).closest(".cont_tap_patient");
        next_fs = $(this).closest(".cont_tap_patient").next();

        //Add Class (Active) and (checked) progress bar
        $("#progressbar_patient li").eq($(".cont_tap_patient").index(next_fs)).addClass("active");
        //eq() is to select an element with a specific index number.
        $("#progressbar_patient li .icon-circle").eq($(".cont_tap_patient").index(next_fs)).addClass("checked");
        

        //show the next div
        next_fs.show();

        //hide the current div with style
        current_fs.animate({ opacity: 0 }, {
            step: function (now) {
                // for making the div appear animation
                opacity = 1 - now;
                current_fs.css({
                    'display': 'none',
                    'position': 'relative'
                });
                next_fs.css({ 'opacity': opacity });
            },
            duration: 500
        });
    });

    $(document).on("click", ".previous-form-steps_patient", function() {

        current_fs = $(this).closest(".cont_tap_patient");
        previous_fs = $(this).closest(".cont_tap_patient").prev();

        //Remove class active progress bar
        $("#progressbar_patient li").eq($(".cont_tap_patient").index(current_fs)).removeClass("active");
        $("#progressbar_patient li .icon-circle").eq($(".cont_tap_patient").index(current_fs)).removeClass("checked");

        //show the previous fieldset
        previous_fs.show();

        //hide the current fieldset with style
        current_fs.animate({ opacity: 0 }, {
            step: function (now) {
                // for making fielset appear animation
                opacity = 1 - now;
                current_fs.css({
                    'display': 'none',
                    'position': 'relative'
                });
                previous_fs.css({ 'opacity': opacity });
            },
            duration: 500
        });
    });


    $(".submit").click(function () {
        return false;
    })
});

/*   //hide the current fieldset with style
        current_fs.animate({ opacity: 0 }, {
            step: function (now) {
                // for making fielset appear animation
                opacity = 1 - now;

                current_fs.css({
                    'display': 'none',
                    'position': 'relative'
                });
                previous_fs.css({ 'opacity': opacity });
            },
            duration: 500
        }); */

//Function to show image before upload
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#mib_PicturePreview').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    } else {
        alert('select a file to see preview');
        $('#mib_PicturePreview').attr('src', '');
    }
}
$("#mib_img_input").change(function () {
    readURL(this);
});

/* 
//to put rule to phone number by vlidation jquery plugin
$.validator.addMethod("telas", function (phone_number, element) {
    phone_number = phone_number.replace(/\s+/g, "");
    return this.optional(element) || phone_number.length == 11;
}, "Invalid phone number");
*/

//to enable international telephone input (#int-miphone) is where we need to insert it

/* 

//nitialize the plugin nice select.
$(document).ready(function () {
    $('select').niceSelect();
});
*/

// to remove the placeholder on type and return it back when it is unfoucse
$('[placeholder]').focus(function () {
    $(this).attr('date-text', $(this).attr('placeholder'));
    $(this).attr('placeholder', '');
});
$('[placeholder]').blur(function () {
    $(this).attr('placeholder', $(this).attr('date-text'));
});

/* ------------------- Admin Dashboard -------------------*/

var wheight, wWidth;

(function ($) {
    "use strict"; // Start of use strict

    // ------ sidebar wide -------
    // Toggle the side navigation
    $("#sidebarToggleTop").on('click', function (e) {
        $(".sidebar_wide").toggleClass("toggled");
        $(".sidebar_wide").toggleClass("d-flex");
    });

    // Toggle the side navigation
    $("#sidebarToggle").on('click', function (e) {
        $("body").toggleClass("sidebar-toggled");
        $(".sidebar_wide").toggleClass("toggled");
        if ($(".sidebar_wide").hasClass("toggled")) {
            $('.sidebar_wide .collapse').collapse('hide');
        };
    });

    wWidth = $(window).width(); // Change the width of browser resize

    // Close any open menu accordions when window is resized below 768px
    window.addEventListener('resize', function(event) {
        if ($(window).width() < 768) {
            $(".sidebar").removeClass("toggled");
            $(".sidebar_wide").removeClass("toggled");
            $(".sidebar_wide").removeClass("d-flex");
            //$('.sidebar .collapse').collapse('hide');
            //if (window.console) console.log('tested');
        };

        // Toggle the side navigation when window is resized below 480px
        if (innerWidth < 480 && !$(".sidebar").hasClass("toggled")) {
            //$("body").addClass("sidebar-toggled");
            //$(".sidebar").addClass("toggled");
            //$('.sidebar .collapse').collapse('hide');
            //console.log('testdasaaaasdasdwqeqwrevxcvippoaaadased');
        };
    });

    // Prevent the content wrapper from scrolling when the fixed side navigation hovered over
    $('body.fixed-nav .sidebar').on('mousewheel DOMMouseScroll wheel', function (e) {
        if ($(window).width() > 768) {
            var e0 = e.originalEvent,
                delta = e0.wheelDelta || -e0.detail;
            this.scrollTop += (delta < 0 ? 1 : -1) * 30;
            e.preventDefault();
        }
    });

    // Scroll to top button appear
    $(document).on('scroll', function () {
        var scrollDistance = $(this).scrollTop();
        if (scrollDistance > 100) {
            $('.scroll-to-top').fadeIn();} 
        else {
        $('.scroll-to-top').fadeOut();}
    });

    // Smooth scrolling using jQuery easing
    $(document).on('click', 'a.scroll-to-top', function (e) {
        var $anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: ($($anchor.attr('href')).offset().top)
        }, 1000, 'easeInOutExpo');
        e.preventDefault();
    });

})(jQuery); // End of use strict

// -------------- Show a Success and patient info Flash Message --------------
$(document).ready(function() {
    $(document).on("click", "#flash-msg-btn", function() {
        $('#flash-msg').hide();
    });
    setTimeout(function(){
        $('#flash-msg').hide();// or fade, css display however you'd like.
     }, 5000);

    $(document).on("click", "#flash-msg-hide-btn", function() {
        $('#flash-msg-hide').hide();
    });

})

//to close the popup window from menu
$(document).on('click',function(){
    $('.collapse-side-admin').collapse('hide');
})

//page load
$(window).on('load',function(){
    $('.loader-page').fadeOut(1000);
    $('.loadear-pefage').fadeIn(1000);})

var elem = document.getElementById("myvideo");

//to have fullscreen
$(document).on('click', '#full_screen', function() {

    var status = $(this).data("full_screen_tr");

    if(status === "max"){
        var docElm = document.documentElement;

        if (docElm.requestFullscreen) {
        docElm.requestFullscreen();}

        else if (docElm.mozRequestFullScreen) {
        docElm.mozRequestFullScreen();}

        else if (docElm.webkitRequestFullScreen) {
        docElm.webkitRequestFullScreen();}

        jQuery('.fullScreen').css({'display' : 'none'});
        jQuery('.minimize').css({'display' : 'block'});

        $(this).data('full_screen_tr', 'min');

        //to hide the sidebar
        $('#accordionSidebar').hide();
        //to hide all with this class
        $('.fullsc_topbar_hide').attr('style','display:none !important');
    }else{
        if (document.exitFullscreen) {
            document.exitFullscreen();}

            else if (document.mozCancelFullScreen) {
            document.mozCancelFullScreen();}
        
            else if (document.webkitCancelFullScreen) {
            document.webkitCancelFullScreen();}               
        
            jQuery('.fullScreen').css({'display' : 'block'});
            jQuery('.minimize').css({'display' : 'none'});

            $(this).data('full_screen_tr', 'max');
            //to show the sidebar
            $('#accordionSidebar').show();
            //to show the title and search bar
            $('.pagetitle-navbar').show();       
            //to show all with this class
            $('.fullsc_topbar_hide').attr('style','display:flex !important');
    }
});

$(document).on('click', '.submit_loader', function() {
    $(this).html('<div class="spinner-border text-light spinner-border-sm" role="status"><span class="visually-hidden">Loading...</span></div> Loading...');
});


$(document).on('click','.plus_counter_btn',function(){
    var selector_plus =  $(this).parent().find('.counter_book_count').val();
    $(this).parent().find('.counter_book_count').val((parseInt(selector_plus) + 1));

    
    //to show in the search bar
    if($(this).data('type') === "room"){
        $('#room_show_qty').html((parseInt(selector_plus) + 1 + " Room "));
    }
    else if($(this).data('type') === "adult"){
        $('#adult_show_qty').html((parseInt(selector_plus) + 1 + " Adult "));
    }
    else{
        $('#child_show_qty').html((parseInt(selector_plus) + 1 + " Children "));
    }
    

    if (selector_plus >= 100) {
        $(this).parent().find('.counter_book_count').val(100); 
    }
});

$(document).on('click','.minus_counter_btn',function(){
    var selector_minus =  $(this).parent().find('.counter_book_count').val();


    //to show in the search bar
    if($(this).data('type') === "room"){
        $('#room_show_qty').html((parseInt(selector_minus) - 1 + " غرفة "));
    }
    else if($(this).data('type') === "adult"){
        $('#adult_show_qty').html((parseInt(selector_minus) - 1 + " بالغ "));
    }else{
        $('#child_show_qty').html((parseInt(selector_minus) - 1 + " طفل "));
    }
    

    $(this).parent().find('.counter_book_count').val((parseInt(selector_minus) - 1));
    if (selector_minus <= 0) {
        $(this).parent().find('.counter_book_count').val(0); 
    }
});

      



// ----- price range ------
const rangeInput = document.querySelectorAll(".range-input_price_range input"),
priceInput = document.querySelectorAll(".price-input_price_range input"),
range = document.querySelector(".slider_price_range .progress_price_range");
let priceGap = 1000;

priceInput.forEach(input =>{
    input.addEventListener("input", e =>{
        let minPrice = parseInt(priceInput[0].value),
        maxPrice = parseInt(priceInput[1].value);
        
        if((maxPrice - minPrice >= priceGap) && maxPrice <= rangeInput[1].max){
            if(e.target.className === "input-min_price_range"){
                rangeInput[0].value = minPrice;
                range.style.left = ((minPrice / rangeInput[0].max) * 100) + "%";
            }else{
                rangeInput[1].value = maxPrice;
                range.style.right = 100 - (maxPrice / rangeInput[1].max) * 100 + "%";
            }
        }
    });
});
rangeInput.forEach(input =>{
    input.addEventListener("input", e =>{
        let minVal = parseInt(rangeInput[0].value),
        maxVal = parseInt(rangeInput[1].value);

        if((maxVal - minVal) < priceGap){
            if(e.target.className === "range-min_price_range"){
                rangeInput[0].value = maxVal - priceGap
            }else{
                rangeInput[1].value = minVal + priceGap;
            }
        }else{
            priceInput[0].value = minVal;
            priceInput[1].value = maxVal;
            range.style.left = ((minVal / rangeInput[0].max) * 100) + "%";
            range.style.right = 100 - (maxVal / rangeInput[1].max) * 100 + "%";
        }
    });
});

// for small devices
const rangeInput_small = document.querySelectorAll(".range-input_price_range_small input"),
priceInput_small = document.querySelectorAll(".price-input_price_range_small input"),
range_small = document.querySelector(".slider_price_range_small .progress_price_range_small");
let priceGap_small = 1000;

priceInput_small.forEach(input =>{
    input.addEventListener("input", e =>{
        let minPrice = parseInt(priceInput_small[0].value),
        maxPrice = parseInt(priceInput_small[1].value);
        
        if((maxPrice - minPrice >= priceGap) && maxPrice <= rangeInput_small[1].max){
            if(e.target.className === "input-min_price_range_small"){
                rangeInput_small[0].value = minPrice;
                range_small.style.left = ((minPrice / rangeInput_small[0].max) * 100) + "%";
            }else{
                rangeInput_small[1].value = maxPrice;
                range_small.style.right = 100 - (maxPrice / rangeInput_small[1].max) * 100 + "%";
            }
        }
    });
});
rangeInput_small.forEach(input =>{
    input.addEventListener("input", e =>{
        let minVal = parseInt(rangeInput_small[0].value),
        maxVal = parseInt(rangeInput_small[1].value);

        if((maxVal - minVal) < priceGap){
            if(e.target.className === "range-min_price_range_small"){
                rangeInput_small[0].value = maxVal - priceGap
            }else{
                rangeInput_small[1].value = minVal + priceGap;
            }
        }else{
            priceInput_small[0].value = minVal;
            priceInput_small[1].value = maxVal;
            range_small.style.left = ((minVal / rangeInput_small[0].max) * 100) + "%";
            range_small.style.right = 100 - (maxVal / rangeInput_small[1].max) * 100 + "%";
        }
    });
});


// enable tooltip
const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))


// video toutrial
$("#video_toutrial_cont").on({
    mouseenter: function () {
        $("#video_toutrial_modal_text").show();
    },
    mouseleave: function () {
        $("#video_toutrial_modal_text").hide();
    }
});
