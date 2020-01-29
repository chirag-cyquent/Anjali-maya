/*!
 * Start Bootstrap - Agnecy Bootstrap Theme (http://startbootstrap.com)
 * Code licensed under the Apache License v2.0.
 * For details, see http://www.apache.org/licenses/LICENSE-2.0.
 */
// jQuery for page scrolling feature - requires jQuery Easing plugin
jQuery.noConflict();
jQuery(document).ready(function() {
    jQuery('ul.sf-menu').superfish();

    //auto height
    if ( jQuery( ".not_home" ).length ) {
        var menu_h =jQuery('.not_home').height();
         jQuery('.page_heading_container').css( "padding-top", menu_h );
    }
// loader
jQuery(".loader").fadeOut("slow");
jQuery(".overlayloader").delay(1000).fadeOut("slow");
// home Slider
jQuery(window).load(function() {
var newspeed = jQuery("#txt_slidespeed").val();
 jQuery('.flexslider').flexslider({
         animation: "fade",
         fadeFirstSlide: false,
         slideshowSpeed: newspeed,
         slide_easing: 'easeInOutCubic',
         animationSpeed: 1000,
         direction: "horizontal",
         controlNav: true,
         video: true,
         slideshow: true, 
         pauseOnHover: true, 
         prevText: "",           //String: Set the text for the "previous" directionNav item
         nextText: "",   
     });
 });    
//Gallery
    jQuery(".gallery:first a[rel^='prettyPhoto']").prettyPhoto({animation_speed: 'normal', theme: 'facebook', slideshow: 3000, autoplay_slideshow: false, social_tools: false});
    jQuery(".gallery_blog:first a[rel^='prettyPhoto']").prettyPhoto({animation_speed: 'normal', theme: 'facebook', slideshow: 3000, autoplay_slideshow: false, social_tools: false});
    jQuery(".gallery_portfolio a[rel^='prettyPhoto']").prettyPhoto({animation_speed: 'normal', theme: 'facebook', slideshow: 3000, autoplay_slideshow: false, social_tools: false});

function validUrlCheck(url){
  var url_validate = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/;
 return url_validate;
}

if ( jQuery( ".home" ).length ) {
  jQuery('.menu li a:first').addClass('active');
  jQuery(document).on("scroll", onScroll);
  function onScroll(event){
    var scrollPos = jQuery(document).scrollTop();
    if (scrollPos >= 100) {
        jQuery('a.page-scroll').each(function () {
        var currLink = jQuery(this);
        var url =currLink.attr("href");
      var url_validate = validUrlCheck(url);
  if(!url_validate.test(url)){
         var refElement = jQuery(currLink.attr("href"));
        if ( jQuery(url).length ) {
          if (refElement.position().top - 100 <= scrollPos && refElement.position().top - 100 + refElement.height() > scrollPos) {
            jQuery('.menu li a').removeClass('active');
            currLink.addClass("active");
          }
        }
  }
    });
} else {
    jQuery('.menu li a').removeClass('active');
    jQuery('.menu li a:first').addClass('active');
    }
}
}
    jQuery('a.page-scroll').bind('click', function(event) {
            var $anchor = jQuery(this);
            var url = $anchor.attr('href');
            var url_validate = validUrlCheck(url);
            
            if(!url_validate.test(url)){
              if ( jQuery( url ).length ) {
            jQuery('html, body').stop().animate({
            scrollTop: jQuery(url).offset().top
        }, 1500, 'easeInOutExpo');
        event.preventDefault();
       }
      }
    });
// Highlight the top nav as scrolling occurs
//jQuery('body').scrollspy({
//    target: '.navbar-fixed-top'
//})
jQuery(window).scroll(function() {
    if (jQuery(window).scrollTop() >= jQuery('.blackwell_slider').height()) {
        jQuery('nav').addClass('navbar-shrink');
    } else {
        jQuery('nav').removeClass('navbar-shrink');
    }
});
jQuery(window).scroll(function() {
    if (jQuery(window).scrollTop() >= jQuery('.navbar-header').height()) {
        jQuery('nav').addClass('navbar-shrink');
        jQuery('nav.static').removeClass('navbar-shrink');
    } else {
        jQuery('nav').removeClass('navbar-shrink');
    }
});
// Highlight the top nav as scrolling occurs
jQuery('body').scrollspy({
    target: '.navbar-fixed-top'
})
// Closes the Responsive Menu on Menu Item Click
// jQuery('.navbar-collapse ul li a').click(function() {
//     jQuery('.navbar-toggle:visible').click();
// });
var testinewspeed = jQuery("#testimonial_slidespeed").val();
jQuery('.bxslider').bxSlider({
      auto: true,
      autoControls: true,
      captions: true,
      mode: 'fade',
      adaptiveHeight: true,
      pause:testinewspeed,
    });
//Crousel Init  
    jQuery(".carousel-listing").jCarouselLite({     //carousel settings
            visible: jQuery('#carousel-full li').length,                        // visible items
            auto: 62800,
            speed: 1000,                                    // carousel speed
            mouseWheel: true,
            circular: true,
            btnNext: ".carousel-next",                      // next button class
            btnPrev: ".carousel-prev"                       // previous button class
    });

    
// Show-hide Scroll to top & move-to-top arrow
  if(jQuery("#back-to-top").val()=='' || jQuery("#back-to-top").val()=='0'){ 
  jQuery("body").prepend("<a id='move-to-top' class='animate hiding' href='#header'><i class='fa fa-angle-up'></i></a>");  
  var scrollDes = 'html,body';  

  /*Opera does a strange thing if we use 'html' and 'body' together so my solution is to do the UA sniffing thing*/
  if(navigator.userAgent.match(/opera/i)){
    scrollDes = 'html';
  }
  //show ,hide
       jQuery(window).scroll(function(){
            if (jQuery(this).scrollTop() > 100) {
                jQuery('#move-to-top').fadeIn();
            } else {
                jQuery('#move-to-top').fadeOut();
            }
        }); 
        jQuery('#move-to-top').click(function(){
            jQuery("html, body").animate({ scrollTop: 0 }, 600);
            return false;
    
     });
  }
  });
    //map scrolling
jQuery(document).ready(function() {
    jQuery('.map').click(function () {
       jQuery('.map iframe').css("pointer-events", "auto");
    });
    
    jQuery( ".map" ).mouseleave(function() {
      jQuery('.map iframe').css("pointer-events", "none"); 
    });
 }); 

///-----------------------///
///start section pallaxx
///-----------------------///
 jQuery(function() {
     if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
         (function(n) {
             n.viewportSize = {}, n.viewportSize.getHeight = function() {
                 return t("Height")
             }, n.viewportSize.getWidth = function() {
                 return t("Width")
             };
             var t = function(t) {
                 var f, o = t.toLowerCase(),
                     e = n.document,
                     i = e.documentElement,
                     r, u;
                 return n["inner" + t] === undefined ? f = i["client" + t] : n["inner" + t] != i["client" + t] ? (r = e.createElement("body"), r.id = "vpw-test-b", r.style.cssText = "overflow:scroll", u = e.createElement("div"), u.id = "vpw-test-d", u.style.cssText = "position:absolute;top:-1000px", u.innerHTML = "<style>@media(" + o + ":" + i["client" + t] + "px){body#vpw-test-b div#vpw-test-d{" + o + ":7px!important}}<\/style>", r.appendChild(u), i.insertBefore(r, e.head), f = u["offset" + t] == 7 ? i["client" + t] : n["inner" + t], i.removeChild(r)) : f = n["inner" + t], f
             }
         })(this);
         (function($){
             // Setup variables
             $window = $(window);
             $body = $('body');

             //FadeIn all sections   

             function adjustWindow() {

                 // Init Skrollr
                 var s = skrollr.init({
                     render: function(data) {

                         //Debugging - Log the current scroll position.
                         //console.log(data.curTop);
                     }
                 });

                 // Get window size
                 winH = $window.height();

                 // Keep minimum height 550
                 if (winH <= 550) {
                     winH = 550;
                 }


             }

         })(jQuery);
     } else {
         (function(n) {
             n.viewportSize = {}, n.viewportSize.getHeight = function() {
                 return t("Height")
             }, n.viewportSize.getWidth = function() {
                 return t("Width")
             };
             var t = function(t) {
                 var f, o = t.toLowerCase(),
                     e = n.document,
                     i = e.documentElement,
                     r, u;
                 return n["inner" + t] === undefined ? f = i["client" + t] : n["inner" + t] != i["client" + t] ? (r = e.createElement("body"), r.id = "vpw-test-b", r.style.cssText = "overflow:scroll", u = e.createElement("div"), u.id = "vpw-test-d", u.style.cssText = "position:absolute;top:-1000px", u.innerHTML = "<style>@media(" + o + ":" + i["client" + t] + "px){body#vpw-test-b div#vpw-test-d{" + o + ":7px!important}}<\/style>", r.appendChild(u), i.insertBefore(r, e.head), f = u["offset" + t] == 7 ? i["client" + t] : n["inner" + t], i.removeChild(r)) : f = n["inner" + t], f
             }
         })(this);


         (function($) {
             // Setup variables
             $window = $(window);
             $body = $('body');
             //FadeIn all sections   
             $body.imagesLoaded(function() {
                 setTimeout(function() {

                     // Resize sections
                     adjustWindow();

                     // Fade in sections
                     $body.removeClass('loading').addClass('loaded');

                 }, 800);
             });

             function adjustWindow() {

                 // Init Skrollr
                 var s = skrollr.init({
                     render: function(data) {

                         //Debugging - Log the current scroll position.
                         //console.log(data.curTop);
                     }
                 });

                 // Get window size
                 winH = $window.height();
                 // Keep minimum height 550
                 if (winH <= 550) {
                     winH = 550;
                 }
             }
         })(jQuery);
     }
 });
 /*------------wow animation------------*/
if ( jQuery( "#animate-css" ).length) {
wow = new WOW(
      {
        animateClass: 'animated',
        offset:       100,
        callback:     function(box) {
         // console.log("WOW: animating <" + box.tagName.toLowerCase() + ">")
        }
      }
    );
    wow.init();
 }