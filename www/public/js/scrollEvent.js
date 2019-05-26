/*******************************************/
/************** Sticky Menu ***************/
/*******************************************/
$(function(){
  $(window).scroll(function(){
    var window_position = $(window).scrollTop();
    if(window_position > 0){
        $('.top-header').addClass('sticky');
    }else{
        $('.top-header').removeClass('sticky');
    }
    var hauteurWindow = $(window).height();
  });
}); // ready
