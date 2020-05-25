var mywindow = $(window);
var mypos = mywindow.scrollTop();
var up = false;
var newscroll;

mywindow.scroll(function () {
    //Si nous avons dépassé la photo, on change la couleur du texte et de l'icone.
    if (mypos > 900){
        $('.nav-link').css("color", "black");
        $('.logo').attr("src", "images/kendo1.png");
    } else{
        $('.nav-link').css("color", "#E8F1F2");
        $('.logo').attr("src", "images/kendo2.png");

    }

    //On fait un effet dégrader quand on arrive au niveau du contenu.
    newscroll = mywindow.scrollTop();
    if (newscroll > mypos && !up) {
        $('.nav-link').stop().fadeOut();
        up = !up;
    } else if(newscroll < mypos && up) {
        $('.nav-link').stop().fadeIn();
        $('.date-picker').stop().fadeOut();
        up = !up;
    }
    

    mypos = newscroll;
});

//Carousel script
var slideIndex = 1;
showSlides(slideIndex);

// Next/previous controls
function plusSlides(n) {
  showSlides(slideIndex += n);
}

// Thumbnail image controls
function currentSlide(n) {
  showSlides(slideIndex = n);
}

//Affichage du carousel
function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
}