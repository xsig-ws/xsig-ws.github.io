//============================================
  //Scrolling Animations
  //==============================================
  jQuery('.scrollimation').waypoint(function(){
    jQuery(this).addClass('in');
  },{offset:'100%'});
  
  //====================================
     //    bottom to top
     //======================================
     var btn = jQuery('#btn-to-top');
     jQuery(window).scroll(function() {
         if (jQuery(window).scrollTop() > 300) {
             btn.addClass('show');
         } else {
             btn.removeClass('show');
         }
     });
     btn.on('click', function(e) {
         e.preventDefault();
         jQuery('html, body').animate({
             scrollTop: 0
         }, '300');
     });