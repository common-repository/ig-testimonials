/**
 * Main js
 */

jQuery(document).ready(function($) {
$(".ig-testimonials-carousel").slick({
  slidesToScroll: 1,
  pauseOnHover:true,
  arrows:false,
  responsive: [
     {
      breakpoint: 768,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
 ]
    });
});
