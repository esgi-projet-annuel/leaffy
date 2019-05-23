/****************************************/
/********* SLIDER Testimonial **********/
/****************************************/

$(function(){
  //makeSlider($('#slider'));
});

var current_image   = 0;
var image_total     = 0;


function  makeSlider(element){

  element.append('<div id="slide-container"></div>');
  element.addClass('slider');

  element.children('.slide').each(function(){
    $(this).remove();
    image_total += 1;
  })
  element.append('<div id="nav" class="nav"></div>');
  $('#nav').append('<button onclick="prev(); resetInterval()" class="nav-prev">></button>');
  $('#nav').append('<button onclick="next(); resetInterval()" class="nav-next"><</button>');


}
function prev(){
  current_image -= 1;
  slide();
}

function next(){
  current_image += 1;
  slide();
}

function slide(){

  disableNav();
  $('#slide-container').on('transitionend', function(){
    enableNav();
  });

  if(current_image == image_total){ //car on commence a l'index 0
    var slide1 = $($('.slide')[0]).clone();
    $('#slide-container').append(slide1);
    slide1.attr('id', 'tmp');
    $('#slide-container').on('transitionend', function(){
      $('#slide-container').css('transition', 'none');
      current_image = 0;
      slide();
      $('#tmp').remove();
      $('#slide-container').unbind('transitionend');
      enableNav();
      setTimeout(function(){
            $('#slide-container').css('transition', 'all 0.6s');
        }, 10);
    });
  }

  if(current_image == -1){ //car on commence a l'index 0
    var slide_last = $($('.slide')[image_total -1]).clone();
    slide_last.attr('id', 'tmp-last');

    slide_last.css({
      'position':'absolute',
      'width': $('#slide-container').width() -'px',
      'height': $('#slide-container').height() -'px',
      'top': 0,
      'left': $('#slide-container').width() -'px'

    });

    $('#slide-container').prepend(slide_last);
    $('#slide-container').on('transitionend', function(){
      $('#slide-container').css('transition', 'none');
      current_image = image_total -1;
      slide();
      $('#tmp-last').remove();
      $('#slide-container').unbind('transitionend');
      enableNav();
      setTimeout(function(){
            $('#slide-container').css('transition', 'all 0.6s');
        }, 10);
    });
  }



  var offset = - $('#slide-container').width() * current_image + 'px';
  $('#slide-container').css('transform', 'translateX(' + offset +')');
}

function disableNav(){
  $('#nav').css("pointer-events", "none");
  $('#nav').css('opacity', '0.5');
}

function enableNav(){
  $('#nav').css("pointer-events", "all");
  $('#nav').css('opacity', '1');
}


var interval = setInterval(function(){
  next()}, 2000);


function resetInterval(){
  clearInterval(interval);
    interval = setInterval(function(){
      next()}, 4000);
}
