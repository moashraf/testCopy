
let slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  let i;
  let slides = document.getElementsByClassName("mySlides");
  let dots = document.getElementsByClassName("demo");
  let captionText = document.getElementById("caption");
  if (n > slides.length) { slideIndex = 1 }
  if (n < 1) { slideIndex = slides.length }
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  // slides[slideIndex-1].style.display = "block";
  // dots[slideIndex-1].className += " active";
  //captionText.innerHTML = dots[slideIndex-1].alt;
};

//page load
$(window).on('load', function () {
  $('.loader-page').fadeOut(1000);
  $('.loadear-pefage').fadeIn(1000);
})


function dodajAktywne(elem) {
  var a = document.getElementsByTagName('li', 'a')
  for (i = 0; i < a.length; i++) {
    a[i].classList.remove('active-page');
  }
  elem.classList.add('active-page');
}

$('document').ready(function () {

  $('.burger').click(function () {
    $('.nav-menu').toggleClass("open");
    $('.menu-list').toggleClass("list-open");
  });

});



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



$(document).on('click', '.submit_loader', function() {

  $(this).html('<div class="spinner-border text-light spinner-border-sm" role="status"><span class="visually-hidden">Loading...</span></div> Loading...');
  $('#myform').submit();


});