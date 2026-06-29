<?php
$cta   = get_field('cta');
$title = $cta['title'] ?? 'Sẵn Sàng Bắt Đầu?';
$desc  = $cta['desc']  ?? 'Tham gia cùng 50,000+ nhà đầu tư đang nhận hoàn phí mỗi ngày';

?>

<section class="section cta">
    <div class="container container--narrow">
        <div class="cta__content">
            <h2 class="cta__title"><?php echo esc_html($title); ?></h2>
            <p class="cta__desc"><?php echo esc_html($desc); ?></p>

            <a href="https://t.me/INOX FUTURE"
                target="_blank"
                rel="nofollow noreferrer"
                class="btn btn--white btn--lg">
                <i class="ri-telegram-line"></i> <?= pll__('Liên hệ ngay') ?>
            </a>
        </div>
    </div>
</section>