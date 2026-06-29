<?php /* templates/parts/popup-single-steel.php */ ?>

<div class="steel-modal-overlay" id="steelModal">
  <div class="steel-modal-box">

    <!-- Slider -->
    <div class="steel-modal-slider-wrap">
      <div class="steel-modal-slider">
        <div class="steel-modal-slide">
          <img src="https://placehold.co/800x280/111/444?text=Anh+san+pham+1" alt="" />
        </div>
        <div class="steel-modal-slide">
          <img src="https://placehold.co/800x280/111/444?text=Anh+san+pham+2" alt="" />
        </div>
        <div class="steel-modal-slide">
          <img src="https://placehold.co/800x280/111/444?text=Anh+san+pham+3" alt="" />
        </div>
      </div>

      <button class="steel-modal-close" id="steelModalClose" aria-label="Đóng">
        <i class="fa-solid fa-xmark"></i>
      </button>

      <span class="steel-modal-badge">Tên danh mục</span>
    </div>
    <!-- /Slider -->

    <!-- Body -->
    <div class="steel-modal-body">
      <h2 class="steel-modal-title">Tên sản phẩm</h2>
      <p class="steel-modal-subtitle">Product name in English</p>

      <div class="steel-modal-specs">
        <div class="steel-modal-spec-card">
          <div class="steel-modal-spec-label">
            <i class="fa-regular fa-file-lines"></i>
            <span>Tiêu chuẩn</span>
          </div>
          <p class="steel-modal-spec-value">--</p>
        </div>
        <div class="steel-modal-spec-card">
          <div class="steel-modal-spec-label">
            <i class="fa-solid fa-ruler"></i>
            <span>Độ dày</span>
          </div>
          <p class="steel-modal-spec-value">--</p>
        </div>
        <div class="steel-modal-spec-card">
          <div class="steel-modal-spec-label">
            <i class="fa-solid fa-arrows-left-right"></i>
            <span>Chiều rộng</span>
          </div>
          <p class="steel-modal-spec-value">--</p>
        </div>
        <div class="steel-modal-spec-card">
          <div class="steel-modal-spec-label">
            <i class="fa-solid fa-shapes"></i>
            <span>Dạng sản phẩm</span>
          </div>
          <p class="steel-modal-spec-value">--</p>
        </div>
      </div>

      <h3 class="steel-modal-section-title">
        <i class="fa-solid fa-star"></i>
        Đặc điểm nổi bật
      </h3>
      <ul class="steel-modal-list steel-modal-list--features">
        <li><span class="steel-dot steel-dot--red"></span>--</li>
        <li><span class="steel-dot steel-dot--red"></span>--</li>
        <li><span class="steel-dot steel-dot--red"></span>--</li>
      </ul>

      <h3 class="steel-modal-section-title">
        <i class="fa-solid fa-industry"></i>
        Ứng dụng
      </h3>
      <ul class="steel-modal-list steel-modal-list--apps">
        <li><span class="steel-dot steel-dot--amber"></span>--</li>
        <li><span class="steel-dot steel-dot--amber"></span>--</li>
        <li><span class="steel-dot steel-dot--amber"></span>--</li>
      </ul>

      <div class="steel-modal-actions">
        <button class="steel-btn-primary">
          <i class="fa-solid fa-phone"></i>
          Liên hệ báo giá
        </button>
        <button class="steel-btn-secondary js-steel-modal-close">
          <i class="fa-solid fa-xmark"></i>
          Đóng
        </button>
      </div>
    </div>
    <!-- /Body -->

  </div>
</div>