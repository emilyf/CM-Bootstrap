(function($) {
  /*$(function() {
    $('body').hide();
    
    $(window).load(function(){
      $('body').show();
    });
  });*/
  
  
  //
  Drupal.behaviors.c_flexslider_video_carousel = {
    attach: function (context, settings) {
      $(document).ready(function() {
        custom_video_lists_flexslider_carousel();
      });
    }
  };
  
  //custom_video_lists_flexslider_carousel();
  
  /*
   * FlexSlider API: https://github.com/woothemes/FlexSlider/wiki/FlexSlider-Properties
   */ 
  function custom_video_lists_flexslider_carousel(bp1, bp2, bp3) {
    //parameter defaults
    bp1 = bp1 || 1;
    bp2 = bp2 || 3;
    bp3 = bp3 || 4;
    
    var currentBreakpoint; 
    var didResize  = true; 
    
    // on window resize, set the didResize to true
    $(window).resize(function() {
      didResize = true;
    });
  
    // every 1/4 second, check if the browser was resized
    // we throttled this because some browsers fire the resize even continuously during resize
    // that causes excessive processing, this helps limit that
    setInterval(function() {
      if(didResize) {
        didResize = false;
  
        // inspect the CSS to see what breakpoint the new window width has fallen into
        var newBreakpoint = window.getComputedStyle(document.body, ':after').getPropertyValue('content');
  
        /* tidy up after inconsistent browsers (some include quotation marks, they shouldn't) */
        newBreakpoint = newBreakpoint.replace(/"/g, "");
        newBreakpoint = newBreakpoint.replace(/'/g, "");
  
        // if the new breakpoint is different to the old one, do some stuff
        if (currentBreakpoint != newBreakpoint) {
          
          $('.c-flexslider-video-carousel').each(function( index ) {
            var raw_slider = $(this).find('.flexslider').html();
                            
            // remove the old flexslider (which has attached event handlers and adjusted DOM nodes)
            $(this).find('.flexslider').remove();
    
            // now re-insert clean mark-up so flexslider can run on it properly
            $(this).append("<div class='flexslider'></div>");
            $(this).find('.flexslider').html(raw_slider);
    
            // execute JS specific to each breakpoint
            if (newBreakpoint === 'breakpoint_1') {
              currentBreakpoint = 'breakpoint_1';              
              // Slider with one slide
              $(this).find('.flexslider').flexslider({
                animation: "slide",
                slideshow: false,
                animationLoop: false,
                itemWidth: $(window).width(),
                /*minItems: 1,
                maxItems: 1,*/
                minItems: bp1,
                maxItems: bp1,
                controlNav: false,
                animationSpeed: 400,
              });
            }
            
            if (newBreakpoint === 'breakpoint_2') {
              currentBreakpoint = 'breakpoint_2';              
              // Slider with one slide
              $(this).find('.flexslider').flexslider({
                animation: "slide",
                slideshow: false,
                animationLoop: false,
                itemWidth: $(window).width() / 2,
                /*minItems: 1,
                maxItems: 1,*/
                minItems: bp2,
                maxItems: bp2,
                controlNav: false,
                animationSpeed: 400,
              });
            }
            
            // START: breakpoint_3
            if (newBreakpoint === 'breakpoint_3') {
              currentBreakpoint = 'breakpoint_3';
              // 3 slides
              $(this).find('.flexslider').flexslider({
                //startAt: 1,
                animation: "slide",
                slideshow: false,
                animationLoop: false,
                itemWidth: $(window).width() / 4,
                minItems: bp3,
                maxItems: bp3,
                controlNav: false,
                animationSpeed: 400
              });    
            }
            // END: breakpoint_3
          });      
        }
      }
    }, 250);
  }
    
})(jQuery);

