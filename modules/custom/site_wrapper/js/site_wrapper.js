(function($) {

  
  Drupal.behaviors.headerDropDown = {
    attach: function(context, settings) {
      //$(document).ready(function() {
        $('nav#site-wrapper-main-menu li ul').hide();
        $('nav#site-wrapper-main-menu ul.first-level li').hover(
          function () {
            $('ul.second-level', this).show();
          },
          function () {
            $('ul.second-level', this).hide();
          }
        );
        
        $('ul.third-level').hide();
        
        $('nav#site-wrapper-main-menu ul.second-level li').hover(
          function () {
            $('ul.third-level', this).show();
          },
          function () {
            $('ul.third-level', this).hide();
          }
        );

        
      //});
    }
  };

    
})(jQuery);
