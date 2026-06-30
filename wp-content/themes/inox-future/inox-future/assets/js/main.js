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
    countSelector,
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
          $(resultSelector).html(res.data.html); // cập nhật kết quả
          $(paginationSelector).html(res.data.pagination); // cập nhật pagination
          // cập nhật count
          if (countSelector && typeof res.data.found !== "undefined") {
            $(countSelector).text(res.data.found);
          }
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
    resultSelector: ".products-grid",
    paginationSelector: ".pagination",
    countSelector: ".count-num",
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
    var $modalContainer = $("#steelModal");

    if (!postId) {
      console.error("Không có post-id trên .prod-card");
      return;
    }

    $modalContainer.addClass("is-open");
    $("body").css("overflow", "hidden");
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
        console.log("AJAX success:", res);

        if (!res.success) {
          console.error("Server trả lỗi:", res.data);
          $modalContainer.html(
            '<p style="padding:20px;color:#fff">Lỗi: ' + res.data + "</p>",
          );
          return;
        }

        var $htmlResponse = $(res.data.html);
        var modalContent = $htmlResponse.html();
        $modalContainer.html(modalContent);

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
            $currentSlider.slick("setPosition");
          }
        }, 50);
      },
      error: function (xhr, status, err) {
        console.error("AJAX lỗi:", status, err, xhr.responseText);
        $modalContainer.html(
          '<p style="padding:20px;color:#fff">Có lỗi xảy ra, vui lòng thử lại.</p>',
        );
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
  $(document).on("input", ".search-input", function () {
    clearTimeout(searchTimer);
    var keyword = $(this).val();
    // bỏ qua nếu đang gõ dở (dưới 2 ký tự), trừ khi xóa hết về rỗng (để reset về "tất cả")
    if (keyword.length > 0 && keyword.length < 2) return;
    searchTimer = setTimeout(function () {
      $('#form-filter-steel input[name="search_posts"]').val(keyword);
      loadPosts({ ...filterConfig, paged: 1 });
    }, 1000);
  });

  /* ──────────────────────────────────────────
     PAGINATION
  ────────────────────────────────────────── */
  $(document).on("click", ".pagination a.page-numbers", function (e) {
    e.preventDefault();

    var $this = $(this);
    var pageNum;

    if ($this.hasClass("next")) {
      // lấy số trang hiện tại + 1
      pageNum = parseInt($(".pagination .current").text()) + 1;
    } else if ($this.hasClass("prev")) {
      pageNum = parseInt($(".pagination .current").text()) - 1;
    } else {
      // link số trang thường, lấy trực tiếp text (ví dụ "2")
      pageNum = parseInt($this.text());
    }

    if (!pageNum || isNaN(pageNum)) return;

    loadPosts({ ...filterConfig, paged: pageNum });

    // cuộn lên đầu khu vực sản phẩm cho mượt
    $("html, body").animate(
      { scrollTop: $(".products-grid-wrap").offset().top - 100 },
      300,
    );
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
