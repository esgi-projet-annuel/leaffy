/****************************************/
/********* SLIDER Testimonial **********/
/****************************************/
var current = 0,
  elem  	= $('.slider .slide'),
  slides  = $('.slider .slide').length,
  speed   = 10000,
  transSpeed = 1000;

function autoSlide(){
  current = (current == (slides-1)) ? 0 : current + 1;
  $('.slider').find('.slide')
    .filter(':eq('+ current +')').addClass('current').animate({'opacity':1}, transSpeed)
    .siblings('.slide').removeClass('current').animate({'opacity':0}, transSpeed);
  };

var timer = setInterval(autoSlide, speed);

$('button').on('click', function(){
  clearInterval(timer);
   autoSlide();
   timer = setInterval(autoSlide, speed);
});
