jQuery(document).ready(function ($) {

  // Origin Slider
  if ($(".origin-slider").length) {
    $(".origin-slider").slick({
      slidesToShow: 1,
      slidesToScroll: 1,
      dots: true,
      arrows: false,
      speed: 600,
      autoplay: true,
      autoplaySpeed: 5000,
    });
  }

  // Founders Slider
  if ($(".founders-slider").length) {
    $(".founders-slider").slick({
      dots: true,
      arrows: false,
      speed: 600,
    //   autoplay: true,
    //   autoplaySpeed: 5000,
      slidesToShow: 3,
      slidesToScroll: 1,
      responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 2,
          },
        },
        {
          breakpoint: 768,
          settings: {
            slidesToShow: 1,
          },
        },
      ],
    });
  }
});
