/********************************************/
/************** CHAR.JS ADMIN ***************/
/*******************************************/
$(function(){

  setNavigation();

}); // ready
/*******************************************/
/************** Active Menu ***************/
/*******************************************/
function setNavigation() {

  // Active menu back
  $(function(){
    var path = window.location.pathname;
     $('.list-admin-bar a').each(function() {
      if (this.pathname === path) {
       $(this).addClass('active');
       // if($('.list-admin-bar a').hasClass("active")){
       //    $('.double-active').addClass('active-button');
       //  }
      }

     });
  })
  $(function(){
    var path = window.location.href;
    $('.group-button a').each(function() {
      if (this.href === path) {
        $(this).addClass('active-button');
      }
    });
  })

  //Active Menu front
  $(function(){
    var path = window.location.pathname;
     $('#menu-main a').each(function() {
      if (this.pathmane === path) {
       $(this).addClass('active-front');
      }
     });
  })
}
