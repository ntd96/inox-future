 <?php
    // Lấy dữ liệu từ ACF Group 'hero'
    $hero = get_field('hero');

    // Khai báo các giá trị mặc định (Default)
    $default_badge       = 'Câu Chuyện Của Chúng Tôi';
    $default_title       = 'INOX FUTURE - Hành Trình Xây Dựng Uy Tín';
    $default_description = 'Từ một nhà đầu tư crypto cá nhân đến nền tảng hoàn phí uy tín #1 Việt Nam';
    $default_bg          = 'https://readdy.ai/api/search-image?query=abstract%20cryptocurrency%20blockchain%20technology%20background%2C%20dark%20deep%20space%20with%20glowing%20orange%20golden%20particles%20and%20geometric%20network%20lines%2C%20futuristic%20digital%20finance%20concept%2C%20ultra%20wide%20cinematic%20wallpaper%20with%20rich%20dark%20tones%20and%20warm%20amber%20highlights&width=1920&height=600&seq=about-hero&orientation=landscape';

    // Gán dữ liệu với toán tử ?: và ?? để an toàn
    $badge       = ($hero['badge'] ?? '') ?: $default_badge;
    $title       = ($hero['title'] ?? '') ?: $default_title;
    $description = ($hero['description'] ?? '') ?: $default_description;
    $bg_image    = ($hero['bg_image'] ?? '') ?: $default_bg;
    ?>
 <section class="section section--dark about-hero">
     <div class="about-hero__bg">
         <img class="about-hero__img"
             src="<?php echo esc_url($bg_image); ?>"
             alt="<?php echo esc_attr($title); ?>">
         <div class="about-hero__overlay"></div>
     </div>

     <div class="container">
         <div class="about-hero__content">
             <span class="section-header__eyebrow"><?php echo esc_html($badge); ?></span>
             <h1 class="about-hero__title"><?php echo esc_html($title); ?></h1>
             <p class="about-hero__desc"><?php echo esc_html($description); ?></p>
         </div>
     </div>
 </section>