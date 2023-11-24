
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


function dodajAktywne(elem) {
  var a = document.getElementsByTagName('li')
  for (i = 0; i < a.length; i++) {
      a[i].classList.remove('active-page');
  }
  elem.classList.add('active-page');
}

$('document').ready(function() {

  $('.burger').click(function() {
      $('.nav-menu').toggleClass("open");
      $('.menu-list').toggleClass("list-open");
  });

});
