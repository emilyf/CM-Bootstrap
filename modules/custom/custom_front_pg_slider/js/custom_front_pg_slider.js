(function($) {
  Drupal.behaviors.front_pg_slider_initialize_flexslider = {
    attach: function (context, settings) {
      
      $(window).load(function() {
        $('.flexslider').flexslider({
          animation: "slide",
          controlNav: false,
          slideshow: false,
        });
      });
    
    }
  };   
  
  //
  Drupal.behaviors.front_pg_slider_hover_accent = {
    attach: function (context, settings) {
      $('ul.front-pg-slider-items li a').each(function () {
        var origColor = $(this).find('span.title').css('background-color');  
        var accentColor = $(this).find('span.title').data('accent-color');
        
        $(this).hover(function() {  
          $(this).find('span.title').css('background-color', accentColor);
        },function() {
          $(this).find('span.title').css('background-color', origColor);
        });   
        
      });
    }
  };   
  
  
  
})(jQuery);