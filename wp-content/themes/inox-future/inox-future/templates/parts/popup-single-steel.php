<?php /* templates/parts/popup-single-steel.php */

$post_id = $args['post_id'] ?? get_the_ID();

$badge        = get_field('badge', $post_id);
$thong_tin    = get_field('thong_tin_thep', $post_id); // Group: tieu_chuan, do_day, chieu_rong, dang_san_pham
$dac_diem     = get_field('dac_diem', $post_id);       // Repeater
$ung_dung     = get_field('ung_dung', $post_id);       // Repeater
$images       = get_field('image', $post_id);          // Gallery -> mảng các ảnh

$title = get_the_title( $post_id );
?>

<div class="steel-modal-overlay" id="steelModal">
  <div class="steel-modal-box">

    <!-- Slider -->
    <div class="steel-modal-slider-wrap">
      <div class="steel-modal-slider">
        <?php if ( $images ) : ?>
          <?php foreach ( $images as $img ) :
            $img_url = is_array( $img ) ? ( $img['url'] ?? '' ) : $img;
            $img_alt = is_array( $img ) ? ( $img['alt'] ?? '' ) : '';
          ?>
            <div class="steel-modal-slide">
              <img src="<?php echo esc_url( $img_url ); ?>" alt="<?php echo esc_attr( $img_alt ); ?>" />
            </div>
          <?php endforeach; ?>
        <?php else : ?>
          <div class="steel-modal-slide">
            <img src="https://placehold.co/800x280/111/444?text=No+Image" alt="" />
          </div>
        <?php endif; ?>
      </div>

      <button class="steel-modal-close" id="steelModalClose" aria-label="Đóng">
        <i class="fa-solid fa-xmark"></i>
      </button>

      <span class="steel-modal-badge"><?php echo esc_html( $badge ?: 'Tên danh mục' ); ?></span>
    </div>
    <!-- /Slider -->

    <!-- Body -->
    <div class="steel-modal-body">
      <h2 class="steel-modal-title"><?php echo esc_html( $title ); ?></h2>

      <div class="steel-modal-specs">
        <div class="steel-modal-spec-card">
          <div class="steel-modal-spec-label">
            <i class="fa-regular fa-file-lines"></i>
            <span>Tiêu chuẩn</span>
          </div>
          <p class="steel-modal-spec-value"><?php echo esc_html( $thong_tin['tieu_chuan'] ?? '--' ); ?></p>
        </div>
        <div class="steel-modal-spec-card">
          <div class="steel-modal-spec-label">
            <i class="fa-solid fa-ruler"></i>
            <span>Độ dày</span>
          </div>
          <p class="steel-modal-spec-value"><?php echo esc_html( $thong_tin['do_day'] ?? '--' ); ?></p>
        </div>
        <div class="steel-modal-spec-card">
          <div class="steel-modal-spec-label">
            <i class="fa-solid fa-arrows-left-right"></i>
            <span>Chiều rộng</span>
          </div>
          <p class="steel-modal-spec-value"><?php echo esc_html( $thong_tin['chieu_rong'] ?? '--' ); ?></p>
        </div>
        <div class="steel-modal-spec-card">
          <div class="steel-modal-spec-label">
            <i class="fa-solid fa-shapes"></i>
            <span>Dạng sản phẩm</span>
          </div>
          <p class="steel-modal-spec-value"><?php echo esc_html( $thong_tin['dang_san_pham'] ?? '--' ); ?></p>
        </div>
      </div>

      <h3 class="steel-modal-section-title">
        <i class="fa-solid fa-star"></i>
        Đặc điểm nổi bật
      </h3>
      <ul class="steel-modal-list steel-modal-list--features">
        <?php if ( $dac_diem ) : ?>
          <?php foreach ( $dac_diem as $row ) :
            $value = reset( $row ); // lấy giá trị sub-field đầu tiên trong row
          ?>
            <li><span class="steel-dot steel-dot--red"></span><?php echo esc_html( $value ); ?></li>
          <?php endforeach; ?>
        <?php else : ?>
          <li><span class="steel-dot steel-dot--red"></span>--</li>
        <?php endif; ?>
      </ul>

      <h3 class="steel-modal-section-title">
        <i class="fa-solid fa-industry"></i>
        Ứng dụng
      </h3>
      <ul class="steel-modal-list steel-modal-list--apps">
        <?php if ( $ung_dung ) : ?>
          <?php foreach ( $ung_dung as $row ) :
            $value = reset( $row );
          ?>
            <li><span class="steel-dot steel-dot--amber"></span><?php echo esc_html( $value ); ?></li>
          <?php endforeach; ?>
        <?php else : ?>
          <li><span class="steel-dot steel-dot--amber"></span>--</li>
        <?php endif; ?>
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