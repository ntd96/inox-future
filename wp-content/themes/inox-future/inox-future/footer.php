<?php
/**
 * Footer Template — INOX FUTURE
 */
?>

<footer class="footer" id="footer">
  <div class="footer-container">

    <!-- Main Footer Content -->
    <div class="footer-main">

      <!-- Cột 1: Logo + Mô tả + Địa chỉ -->
      <div class="footer-col logo-col">
        <div class="footer-logo">
          <?php
          $logo = get_theme_mod('custom_logo');
          if ($logo) :
            echo wp_get_attachment_image($logo, 'full', false, ['class' => 'footer-logo__img']);
          else : ?>
            <div style="display:flex;align-items:center;gap:10px;margin-bottom:4px;">
              <div style="width:36px;height:36px;background:#2563eb;border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                <i class="ri-building-2-fill" style="color:#fff;font-size:18px;"></i>
              </div>
              <span class="logo-text"><?php bloginfo('name'); ?><span style="display:block;font-size:10px;font-weight:400;color:rgba(255,255,255,0.4);letter-spacing:0.1em;">COMPANY LIMITED</span></span>
            </div>
          <?php endif; ?>
        </div>
        <p class="footer-desc">
          Nhà cung cấp thép cuộn, thép tấm, inox và kim loại màu hàng đầu cho thị trường Việt Nam. Chất lượng là cam kết của chúng tôi.
        </p>
        <p style="color:rgba(255,255,255,0.4);font-size:12px;line-height:1.7;margin-top:12px;">
          A-302, Tầng 3, Số 88-90 đường N3C,<br>
          Dự án Khu Đô Thị Sài Gòn Bình An,<br>
          Khu phố 14, Phường An Phú,<br>
          Thành phố Thủ Đức, TP. Hồ Chí Minh
        </p>
        <div class="footer-social">
          <a href="#" target="_blank" rel="nofollow" aria-label="Facebook" class="social-icon"><i class="ri-facebook-fill"></i></a>
          <a href="#" target="_blank" rel="nofollow" aria-label="Zalo" class="social-icon"><i class="ri-chat-smile-2-fill"></i></a>
          <a href="mailto:inoxfuture1218@gmail.com" aria-label="Email" class="social-icon"><i class="ri-mail-line"></i></a>
        </div>
      </div>

      <!-- Cột 2: Điều hướng -->
      <div class="footer-col">
        <h4 class="footer-heading">Điều hướng</h4>
        <?php wp_nav_menu([
          'theme_location' => 'footer_menu',
          'container'      => false,
          'menu_class'     => 'footer-list',
          'fallback_cb'    => false,
        ]); ?>
        <?php if (!has_nav_menu('footer_menu')) : ?>
          <ul class="footer-list">
            <li><a href="<?php echo home_url('/'); ?>">Trang chủ</a></li>
            <li><a href="<?php echo home_url('/gioi-thieu'); ?>">Giới thiệu</a></li>
            <li><a href="#products">Sản phẩm</a></li>
            <li><a href="#business">Lĩnh vực</a></li>
            <li><a href="#footer">Liên hệ</a></li>
          </ul>
        <?php endif; ?>
      </div>

      <!-- Cột 3: Sản phẩm chính -->
      <div class="footer-col">
        <h4 class="footer-heading">Sản phẩm chính</h4>
        <?php wp_nav_menu([
          'theme_location' => 'footer_products',
          'container'      => false,
          'menu_class'     => 'footer-list',
          'fallback_cb'    => false,
        ]); ?>
        <?php if (!has_nav_menu('footer_products')) : ?>
          <ul class="footer-list">
            <li><a href="#products">Thép cán nóng</a></li>
            <li><a href="#products">Thép cán nguội</a></li>
            <li><a href="#products">Thép mạ kẽm</a></li>
            <li><a href="#products">Inox – Thép không gỉ</a></li>
            <li><a href="#products">Ống thép</a></li>
            <li><a href="#products">Thép đặc biệt</a></li>
          </ul>
        <?php endif; ?>
      </div>

      <!-- Cột 4: Liên Hệ -->
      <div class="footer-col contact-col">
        <h4 class="footer-heading">Liên hệ</h4>
        <ul class="contact-list">
          <li>
            <i class="ri-phone-line"></i>
            <div>
              <span class="contact-type">Điện thoại</span><br>
              <a href="tel:02873039996">(028) 7303 9996</a>
            </div>
          </li>
          <li>
            <i class="ri-printer-line"></i>
            <div>
              <span class="contact-type">Fax</span><br>
              <a href="tel:02836366574">(028) 3636 6574</a>
            </div>
          </li>
          <li>
            <i class="ri-mail-line"></i>
            <div>
              <span class="contact-type">Email</span><br>
              <a href="mailto:inoxfuture1218@gmail.com">inoxfuture1218@gmail.com</a>
            </div>
          </li>
          <li>
            <i class="ri-time-line"></i>
            <div>
              <span class="contact-type">Giờ làm việc</span><br>
              <span>Thứ 2 – Thứ 7: 8:00 – 17:30</span>
            </div>
          </li>
        </ul>
      </div>
    </div>

    <!-- Copyright -->
    <div class="footer-bottom">
      <p class="copyright">© <?php echo date('Y'); ?> CÔNG TY TNHH INOX TƯƠNG LAI. All rights reserved.</p>
      <div class="legal-links">
        <a href="#">Chính Sách Bảo Mật</a>
        <span class="separator">|</span>
        <a href="#">Điều Khoản Sử Dụng</a>
      </div>
    </div>

  </div>
</footer>

<!-- Floating contact buttons -->
<div style="position:fixed;bottom:1.25rem;right:1.25rem;z-index:40;display:flex;flex-direction:column;align-items:center;gap:10px;">
  <a href="#" target="_blank" aria-label="Facebook" style="width:36px;height:36px;display:flex;align-items:center;justify-content:center;border-radius:50%;background:#fff;border:1px solid #e2e8f0;color:#64748b;transition:all 0.3s;box-shadow:0 1px 4px rgba(0,0,0,0.1);text-decoration:none;">
    <i class="ri-facebook-fill" style="font-size:14px;"></i>
  </a>
  <a href="#" target="_blank" aria-label="Zalo" style="width:36px;height:36px;display:flex;align-items:center;justify-content:center;border-radius:50%;background:#fff;border:1px solid #e2e8f0;color:#64748b;transition:all 0.3s;box-shadow:0 1px 4px rgba(0,0,0,0.1);text-decoration:none;">
    <i class="ri-chat-smile-2-fill" style="font-size:14px;"></i>
  </a>
  <a href="mailto:inoxfuture1218@gmail.com" aria-label="Email" style="width:36px;height:36px;display:flex;align-items:center;justify-content:center;border-radius:50%;background:#fff;border:1px solid #e2e8f0;color:#64748b;transition:all 0.3s;box-shadow:0 1px 4px rgba(0,0,0,0.1);text-decoration:none;">
    <i class="ri-mail-line" style="font-size:14px;"></i>
  </a>
  <a href="tel:02873039996" aria-label="Điện thoại" style="width:36px;height:36px;display:flex;align-items:center;justify-content:center;border-radius:50%;background:#fff;border:1px solid #e2e8f0;color:#64748b;transition:all 0.3s;box-shadow:0 1px 4px rgba(0,0,0,0.1);text-decoration:none;">
    <i class="ri-phone-line" style="font-size:14px;"></i>
  </a>
  <div style="width:1px;height:12px;background:#e2e8f0;"></div>
  <button onclick="window.scrollTo({top:0,behavior:'smooth'})" aria-label="Quay lại đầu trang" style="width:40px;height:40px;display:flex;align-items:center;justify-content:center;background:#2563eb;color:#fff;border-radius:50%;border:none;cursor:pointer;box-shadow:0 4px 12px rgba(37,99,235,0.35);transition:all 0.3s;">
    <i class="ri-arrow-up-line" style="font-size:18px;"></i>
  </button>
</div>

<?php wp_footer(); ?>
</body>
</html>
