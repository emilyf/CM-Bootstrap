(function ($) {        
  // Controls events for panel menu.
  // We use context here on click events to compensate for a stupid bug in views ajax.
  Drupal.behaviors.menuPanelBehavior = {
    attach: function(context, settings) {
      $(document).ready(function() {
        $('body', context).click(function(e) {  
          // Ignore click on search box.
          if (e.target.id == "edit-search-block-form--2") {
            return;
          }
          else {
            menuPanelClose();
          }
        });
        $('.menu-panel-trigger', context).click(function(e) {  
          e.preventDefault();
          e.stopPropagation();
          //console.log('trigger clicked');
          menuPanelToggleMenu();
        });
        $('#menu-panel .close-menu', context).click(function(e) {  
          e.preventDefault();
          //console.log('close button clicked');
          menuPanelClose();
        });
      });
      // Helper functions
      function menuPanelClose() {
        $('body').removeClass('menu-panel-expanded');
      }
      function menuPanelToggleMenu() {
        $('body').toggleClass('menu-panel-expanded');
      }
    }
  };

  Drupal.behaviors.bs3_overrides = {
    attach: function (context, settings) {
      $('.region-footer .block-menu-block li').removeClass('dropdown');
      
      $('.region-footer .block-menu-block li a').removeClass('dropdown-toggle');
      $('.region-footer .block-menu-block .caret').remove();
      
      
      $('.region-footer .block-menu-block li ul').removeClass('dropdown-menu');
    } 
  };    
  
  Drupal.behaviors.bs3_overrides_navigation_menu = {
    attach: function (context, settings) {
      $('.menu.nav li').hover(
        function () {
          $('.dropdown-menu', this).show();
        },
        function () {
          $('.dropdown-menu', this).hide();
        }
      );
    } 
  };     
      
  Drupal.behaviors.headerDropDownColor = {
    attach: function(context, settings) {
      
      //$('nav#site-wrapper-main-menu ul.first-level li.item-1').hover(function() {
      
      $('nav#site-wrapper-main-menu ul.first-level li.item-2 .third-level').remove();
        
      $('nav#site-wrapper-main-menu ul.first-level li.item-1').on({        
        mouseenter: function() {
          // Check if second-level is visibile to retain hover color.
          if ($(this).find('.second-level').is(':visible')) {
            //$(this).find('.second-level').css('opacity', '.9');
            $(this).find('a').css('color', '#FFF');
            $(this).find('a').css('background-color', '#FF7700');
          }
        },
        
        mouseleave: function() {
          if ($(this).find('.second-level').is(':hidden')) {
            $(this).find('a').css('background-color', '#0099D9');
          }
        }        
      });
      
      // Second level hover
      $('nav#site-wrapper-main-menu ul.second-level li').on({        
        mouseenter: function() {
          // Check if second-level is visibile to retain hover color.
          if ($(this).find('.third-level').is(':visible')) {
            $(this).find('.third-level').css('opacity', '1');
            $(this).find('a').css('color', '#FFF');
            $(this).find('a').css('background-color', '#FAA830');
          }
        },
        
        mouseleave: function() {
          if ($(this).find('.third-level').is(':hidden')) {
            $(this).find('a').css('background-color', '#FF7700');
          }
        }      
      });
      
      // 3rd level hover
      /*$('nav#site-wrapper-main-menu ul.third-level li a').on({        
        mouseenter: function() {
          console.log('kjhsdfkhjfsdkhsdfhksfdjkhsdfjkhsdf');
          $(this).css('color', '#000');
          $(this).css('background', 'red');
        },
        
        mouseleave: function() {
          //if ($(this).find('.second-level').is(':hidden')) {
          //$(this).find('a').css('background-color', '#FAA830');
          //}
        }      
      });*/

      
      $('nav#site-wrapper-main-menu ul.first-level li.item-2').on({        
        mouseenter: function() {
          // Check if second-level is visibile to retain hover color.
          if ($(this).find('.second-level').is(':visible')) {
            $(this).find('a').css('color', '#FFF');
            $(this).find('a').css('background-color', '#E60023');  
          }
        },
        
        mouseleave: function() {
          //if ($(this).find('.second-level').is(':hidden')) {
          $(this).find('a').css('background-color', '#34AF37');
          //}
        }        
      });
        

    }
  };    
  
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
  function custom_video_lists_flexslider_carousel(bp1, bp2, bp3, bp4) {
    //parameter defaults
    bp1 = bp1 || 1;
    bp2 = bp2 || 2;
    bp3 = bp3 || 3;
    bp4 = bp4 || 4;
    
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
                itemWidth: $(window).width() / 3,
                minItems: bp3,
                maxItems: bp3,
                controlNav: false,
                animationSpeed: 400
              });    
            }
            // END: breakpoint_3
            
            // START: breakpoint_4
            if (newBreakpoint === 'breakpoint_4') {
              currentBreakpoint = 'breakpoint_4';
              // 4 slides
              $(this).find('.flexslider').flexslider({
                //startAt: 1,
                animation: "slide",
                slideshow: false,
                animationLoop: false,
                itemWidth: $(window).width() / 4,
                minItems: bp4,
                maxItems: bp4,
                controlNav: false,
                animationSpeed: 400
              });    
            }
            // END: breakpoint_4
          });      
        }
      }
    }, 250);
  }
  
  Drupal.behaviors.bs3_archive_pg_adjust_height = {
    attach: function (context, settings) {
      $(window).on('load resize',function() {
        var browserWidth = $(window).width();
        //console.log(browserWidth);
        
        if (browserWidth > 990) {
          var leftHeight = $('.two-col-list li .container .left').height();
          //console.log(leftHeight);
          
          $('.two-col-list li .container .right').height(leftHeight);
        }
        else {
          $('.two-col-list li .container .right').height('auto');
        }
        
      });
    } 
  };
  
  Drupal.behaviors.cm_boostrap_show_recent_videos_adjust_height = {
    attach: function (context, settings) {
      $(window).on('load resize',function() {
        var browserWidth = $(window).width();        
        if (browserWidth > 990) {
          var leftHeight = $('.cb-show-recent-videos li .left').height();   
          //console.log(leftHeight);       
          $('.cb-show-recent-videos li .right').height(leftHeight);
          $('.cb-show-recent-videos li .right').css('max-height', leftHeight);
        }
        else {
          //$('.cb-show-recent-videos li .right').height('auto');
        }
      });
    } 
  };
  
  Drupal.behaviors.bs3_add_item_num_to_video_block = {
    attach: function (context, settings) {
      $(window).on('load',function(){
        var i = 1;
        $('.block-custom-block h2.block-title').each(function( index ) {
          $(this).addClass('cb-vl-item-' + i++);
          //console.log(this);
        });  
      });
    } 
  };  
  
  // Adjust height of sidebar on partner + series to match height of video.
  Drupal.behaviors.bs3_partner_and_series_sidebar = {
    attach: function (context, settings) {
      $(window).on('load resize',function() {
        var browserWidth = $(window).width();        
        if (browserWidth > 768) {
          var colHeight = $('.node-type-partner .col-sm-8').height();
          //console.log(colHeight);
          $('.node-type-partner .col-sm-4').height(colHeight);
        }      
        else {
          $('.node-type-partner .col-sm-4').height('auto');  
        }  
      });
      $(window).on('load resize',function() {
        var browserWidth = $(window).width();        
        if (browserWidth > 768) {
          var colHeight = $('.node-type-cm-project .col-sm-8').height();
          //console.log(colHeight);
          $('.node-type-cm-project .col-sm-4').height(colHeight);
        }      
        else {
          $('.node-type-cm-project .col-sm-4').height('auto');  
        }  
      });
    } 
  };
  // Adjust height of sidebar on show node to match height of video.
  Drupal.behaviors.bs3_cm_show_sidebar = {
    attach: function (context, settings) {
      $(window).on('load resize',function() {
        //$(document).ready(function() {
          var browserWidth = $(window).width();        
          if (browserWidth > 996) {
            var colHeight = $('.node-type-cm-show .col-sm-8 .field-name-field-show-vod').height();
            var metaBoxHeight = $('.node-type-cm-show .show-meta').height();
            //console.log(colHeight);
            //$('.node-type-cm-show .region-sidebar-second').hide();
            $('.node-type-cm-show .region-sidebar-second .tab-content').height(colHeight - 35);
            $('.node-type-cm-show .region-sidebar-second .tab-content').css('min-height', colHeight - 35);
            $('.node-type-cm-show .region-sidebar-second .tab-content').css('max-height', colHeight - 35);
            //$('.node-type-cm-show .region-sidebar-second').fadeIn();
          }      
          else {
            //console.log('no min height');
            $('.node-type-cm-show .region-sidebar-second .tab-content').height('auto');  

            $('.node-type-cm-show .region-sidebar-second .tab-content').css('min-height', 'initial');
            $('.node-type-cm-show .region-sidebar-second .tab-content').css('max-height', 'initial');
          } 
        //}); 
      });
    } 
  };
  
  // Hide certains tabs + reset active state to first remaining.
  Drupal.behaviors.cm_bootstrap_show_sidebar_mobile = {
    attach: function (context, settings) {
      $(window).on('load resize',function() {
        var browserWidth = $(window).width();        
        if (browserWidth < 990) {
          $('.node-type-cm-show .region-sidebar-second ul.nav-tabs li.recent-videos').remove();
          $('.node-type-cm-show .region-sidebar-second .tab-content #recent-video').remove();
          $('.nav-tabs li:first').addClass('active'); 
          $('.node-type-cm-show .region-sidebar-second .tab-content .tab-pane:first').addClass('active');  
        }
      });
    } 
  };
  
  //
  /*Drupal.behaviors.user_profile_ajax_load = {
    attach: function (context, settings) {
      $('ul.user-statistics li a').click(function(e) {
        e.preventDefault();
        e.stopPropagation();
        
        var href = $(this).attr('href');
        console.log(href);
        
        var htmlElement;
        
        switch (href) {
          case '/user/1/likes':
            htmlElement = 'ul.user-shows-likes';
            break;
          case '/user/1/followers':
          case '/user/1/following':
            htmlElement = 'ul.user-grid';
            break;
        }
        $('.recent-videos').load(href + ' ' + htmlElement);
      });
    } 
  };*/
  
  // Hide chapters + extract air date data for mobile.
  // wluisi 5/23/2015 -- not used for now.
  /*Drupal.behaviors.cm_bootstrap_airdate_mobile = {
    attach: function (context, settings) {
      $(document).ready(function() {
        var browserWidth = $(window).width();
        //console.log(browserWidth);
        // Store original tabs markup
        var originalTabsMarkup = $('.main-container .col-sm-4').clone();
        if (browserWidth < 768) {
          var airDateHtml = $('#airdate').clone();
          console.log(airDateHtml);
          var chapterAirdateTabs = $('.region-sidebar-second div[role="tabpanel"]');
          // Remove chapters + tabs
          chapterAirdateTabs.remove();
          // Wrap airDateHtml in container div
          $(airDateHtml).wrapInner('<div class="airdate-container"></div>');
          // Append airDateHtml to 2nd sidebar
          $(airDateHtml).appendTo('.region-sidebar-second');          
        }
        else {
          console.log(originalTabsMarkup);
          //$('.main-container .col-sm-4').remove();
          //$('.airdate-container').html(originalTabsMarkup);
          //console.log(originalTabsMarkup);
          //$('.region-sidebar-second div[role="tabpanel"]').replaceWith(originalTabsMarkup);
        }
      });
    } 
  };*/
  
  
})(jQuery);