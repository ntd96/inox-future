<?php
/**
 * Header Template — INOX FUTURE
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header" id="site-header">
  <div class="container">
    <div class="site-header__inner">

      <!-- Logo -->
      <a href="<?php echo esc_url(home_url('/')); ?>" class="site-header__logo">
        <?php
        $logo = get_theme_mod('custom_logo');
        if ($logo) :
          echo wp_get_attachment_image($logo, 'full', false, ['class' => 'site-header__logo-img']);
        else : ?>
          <div class="site-header__logo-icon">
            <i class="ri-building-2-fill"></i>
          </div>
          <span class="site-header__logo-text">INOX FUTURE</span>
        <?php endif; ?>
      </a>

      <!-- Nav Desktop -->
      <nav class="site-header__nav" aria-label="Primary">
        <ul class="site-header__menu">
          <li <?php echo is_front_page() ? 'class="current-menu-item"' : ''; ?>>
            <a href="<?php echo esc_url(home_url('/')); ?>">Trang chủ</a>
          </li>
          <li <?php echo is_page('gioi-thieu') ? 'class="current-menu-item"' : ''; ?>>
            <a href="<?php echo esc_url(home_url('/gioi-thieu')); ?>">Giới thiệu</a>
          </li>
          <li>
            <a href="#products">Sản phẩm</a>
          </li>
          <li>
            <a href="#business">Lĩnh vực</a>
          </li>
          <li <?php echo is_page('lien-he') ? 'class="current-menu-item"' : ''; ?>>
            <a href="<?php echo esc_url(home_url('/lien-he')); ?>">Liên hệ</a>
          </li>
        </ul>
      </nav>

      <!-- CTA -->
      <div class="site-header__actions">
        <a href="<?php echo esc_url(home_url('/lien-he')); ?>" class="btn btn--primary btn--sm site-header__cta">
          Liên hệ
        </a>
      </div>

      <!-- Hamburger -->
      <button class="site-header__hamburger" id="nav-toggle" aria-label="Toggle menu" aria-expanded="false">
        <i class="ri-menu-line"></i>
      </button>

    </div><!-- /.site-header__inner -->
  </div><!-- /.container -->

  <!-- Mobile Menu -->
  <div class="site-header__mobile-menu" id="mobile-menu" aria-hidden="true">
    <div class="container">
      <ul class="site-header__mobile-nav">
        <li><a href="<?php echo esc_url(home_url('/')); ?>">Trang chủ</a></li>
        <li><a href="<?php echo esc_url(home_url('/gioi-thieu')); ?>">Giới thiệu</a></li>
        <li><a href="#products">Sản phẩm</a></li>
        <li><a href="#business">Lĩnh vực</a></li>
        <li><a href="<?php echo esc_url(home_url('/lien-he')); ?>">Liên hệ</a></li>
      </ul>
      <a href="<?php echo esc_url(home_url('/lien-he')); ?>"
        class="btn btn--primary" style="width:100%;margin-top:1rem;text-align:center;">
        Liên hệ báo giá
      </a>
    </div>
  </div><!-- /.site-header__mobile-menu -->

</header>