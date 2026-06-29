jQuery(function ($) {
  // Init GLightbox
  const lightbox = GLightbox({
    selector: ".page-album .glightbox",
    touchNavigation: true,
    loop: true,
    zoomable: true,
  });

  // View Mode Toggle (jQuery)
  $(".btn-view").on("click", function () {
    let col = $(this).data("col");
    let $grid = $("#album-grid");

    // Update active button
    $(".btn-view").removeClass("active");
    $(this).addClass("active");

    // Update grid class
    $grid.removeClass("col-3 col-4 col-5").addClass(`col-${col}`);
  });
});
