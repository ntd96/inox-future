jQuery(document).ready(function ($) {
  $('.inox-slick-carousel').slick({
    dots: false,
    infinite: true,
    speed: 400,
    slidesToShow: 4,
    slidesToScroll: 1,
    appendArrows: $('#inox-slick-nav'), // Nhét nút vào đúng vị trí góc phải header
    prevArrow: '<button type="button" class="slick-prev" aria-label="Trước"><i class="fas fa-chevron-left"></i></button>',
    nextArrow: '<button type="button" class="slick-next" aria-label="Sau"><i class="fas fa-chevron-right"></i></button>',
    responsive: [
      {
        breakpoint: 1024,
        settings: { slidesToShow: 3 }
      },
      {
        breakpoint: 768,
        settings: { slidesToShow: 2 }
      },
      {
        breakpoint: 480,
        settings: { 
          slidesToShow: 1.2, 
          arrows: false 
        }
      }
    ]
  });
  /* ===========================================
       COUNTUP STAT
    =========================================== */
  const $stats = $(".hero__stat-value, .advantages-stats .count-up-trigger");

  $stats.each(function () {
    const $this = $(this);
    const endVal = $this.data("countup-end");

    // Tránh lỗi nếu thuộc tính data-countup-end không tồn tại
    if (typeof endVal === "undefined") return;

    const suffix = $this.data("countup-suffix") || "";

    const countUpAnim = new countUp.CountUp(this, endVal, {
      enableScrollSpy: true,
      scrollSpyOnce: true,
      duration: 3,
      separator: ".",
      suffix: suffix,
    });

    // ScrollSpy sẽ tự động kích hoạt khi phần tử vào viewport
  });

  /* ===========================================
       section testimonial slider
    =========================================== */
  $(".testimonials__slider").slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    arrows: false,
    dots: true,
    dotsClass: "testimonials__dots",
    // infinite: true,
    speed: 400,
    cssEase: "ease",
    responsive: [
      {
        breakpoint: 1024,
        settings: { slidesToShow: 2 },
      },
      {
        breakpoint: 640,
        settings: { slidesToShow: 1 },
      },
    ],
  });

  // AOS.refresh();
});
