// =================================================
// HELPER FUNCTION GLOBAL
// =================================================

function equalHeightByMax(wrapper, itemSelector, minWidth = 568) {
  const $win = jQuery(window);
  if ($win.width() < minWidth) {
    jQuery(wrapper).find(itemSelector).css("height", "auto");
    return;
  }
  jQuery(wrapper).each(function () {
    let maxHeight = 0;
    const $items = jQuery(this).find(itemSelector);
    $items.css("height", "auto");
    $items.each(function () {
      maxHeight = Math.max(maxHeight, jQuery(this).outerHeight());
    });
    $items.css("height", maxHeight);
  });
}

(function ($) {
  function loadPosts({
    paged = 1,
    formSelector,
    resultSelector,
    paginationSelector,
  } = {}) {
    let form = $(formSelector)[0];
    let formData = new FormData(form);

    formData.append("action", "filter_posts");
    formData.append("nonce", vari.nonce);
    formData.append("paged", paged);
    formData.append("page_id", vari.page_id);

    $(resultSelector).html(
      '<div class="spinner-wrapper"><div class="spinner"></div></div>',
    );

    fetch(vari.ajax_url, {
      body: formData,
      method: "POST",
    })
      .then((res) => res.json())
      .then((res) => {
        if (res.success) {
          $(resultSelector).html(res.data.html);
          $(paginationSelector).html(res.data.pagination);
        }
      })
      .catch((err) => {
        console.log(err);
        $(resultSelector).html("");
      });
  }
  window.loadPosts = loadPosts;
})(jQuery);

/* ==============================================
   MAIN
============================================== */
jQuery(function ($) {
  var filterConfig = {
    formSelector: "#form-filter-steel",
    resultSelector: ".products-grid-wrap",
    paginationSelector: ".pagination",
  };

  /* ──────────────────────────────────────────
     LOAD LẦN ĐẦU — nằm trong DOM ready
  ────────────────────────────────────────── */
  if ($(filterConfig.formSelector).length) {
    loadPosts({ ...filterConfig, paged: 1 });
  }

  /* ──────────────────────────────────────────
     STEEL MODAL
  ────────────────────────────────────────── */
  var $overlay = $("#steelModal");
  var $slider = $overlay.find(".steel-modal-slider");

  function openSteelModal() {
    var postId = $(this).data("product-id");
    var $modalContainer = $("#steelModal"); // Hoặc vùng chứa modal cố định trên giao diện của bạn

    // 1. Mở khung modal ngoài và hiển thị Spinner chờ
    $modalContainer.addClass("is-open");
    $("body").css("overflow", "hidden");

    // Bạn có thể tạo 1 class loading tạm thời cho modal box nếu muốn
    $modalContainer.html(
      '<div class="spinner-wrapper"><div class="spinner"></div></div>',
    );

    $.ajax({
      url: vari.ajax_url,
      method: "POST",
      data: {
        action: "get_steel_detail",
        nonce: vari.nonce,
        post_id: postId,
      },
      success: function (res) {
        if (!res.success) return;

        // 2. Lấy HTML trả về (đã bao gồm toàn bộ nội dung trong file php)
        var $htmlResponse = $(res.data.html);

        // Vì file PHP trả về có sẵn thẻ <div id="steelModal"> ngoài cùng,
        // ta chỉ lấy phần ruột bên trong của nó để đập vào container ngoài giao diện
        var modalContent = $htmlResponse.html();
        $modalContainer.html(modalContent);

        // 3. Sử dụng setTimeout (khoảng 30-50ms) để DOM kịp tính toán width/height
        setTimeout(function () {
          var $currentSlider = $modalContainer.find(".steel-modal-slider");

          if ($currentSlider.length) {
            $currentSlider.slick({
              dots: true,
              arrows: true,
              infinite: true,
              speed: 350,
              slidesToShow: 1,
              slidesToScroll: 1,
              prevArrow:
                '<button type="button" class="slick-prev"><i class="fa-solid fa-chevron-left"></i></button>',
              nextArrow:
                '<button type="button" class="slick-next"><i class="fa-solid fa-chevron-right"></i></button>',
            });

            // Ép buộc Slick căn chỉnh vị trí chuẩn đét ngay lập tức
            $currentSlider.slick("setPosition");
          }
        }, 50);
      },
    });
  }

  function closeSteelModal() {
    $overlay.removeClass("is-open");
    $("body").css("overflow", "");
  }

  $(document).on("click", ".prod-card", openSteelModal);

  $(document).on(
    "click",
    "#steelModalClose, .js-steel-modal-close",
    closeSteelModal,
  );
  $overlay.on("click", function (e) {
    if ($(e.target).is($overlay)) closeSteelModal();
  });

  /* ──────────────────────────────────────────
     SIDEBAR CATEGORY FILTER
  ────────────────────────────────────────── */
  $(document).on("click", ".cat-btn", function () {
    $(".cat-btn").removeClass("cat-btn--active");
    $(this).addClass("cat-btn--active");
    $('#form-filter-steel input[name="cats[]"]').val($(this).data("id"));
    loadPosts({ ...filterConfig, paged: 1 });
  });

  /* ──────────────────────────────────────────
     SEARCH
  ────────────────────────────────────────── */
  var searchTimer;
  $(document).on("input", "#steel-search", function () {
    clearTimeout(searchTimer);
    var keyword = $(this).val();
    searchTimer = setTimeout(function () {
      $('#form-filter-steel input[name="search_posts"]').val(keyword);
      loadPosts({ ...filterConfig, paged: 1 });
    }, 400);
  });

  /* ──────────────────────────────────────────
     PAGINATION
  ────────────────────────────────────────── */
  $(document).on("click", ".page-btn:not(.page-btn--nav)", function () {
    loadPosts({ ...filterConfig, paged: parseInt($(this).text()) });
  });

  /* ──────────────────────────────────────────
     CONTACT MODAL
  ────────────────────────────────────────── */
  function openContactModal() {
    $("#contactModal").addClass("is-open");
  }

  function closeContactModal() {
    $("#contactModal").removeClass("is-open");
  }

  $(document).on("click", ".steel-btn-primary", openContactModal);
  $(document).on("click", "#contactModalClose", closeContactModal);
  $(document).on("click", "#contactModal", function (e) {
    if ($(e.target).is("#contactModal")) closeContactModal();
  });

  /* ──────────────────────────────────────────
     ESC
  ────────────────────────────────────────── */
  $(document).on("keydown", function (e) {
    if (e.key !== "Escape") return;
    if ($("#contactModal").hasClass("is-open")) {
      closeContactModal();
    } else {
      closeSteelModal();
    }
  });
});
