<?php
$values = get_field('values');
$badge  = $values['badge'] ?? 'Giá Trị Cốt Lõi';
$title  = $values['title'] ?? 'Những Giá Trị Chúng Tôi Theo Đuổi';
$lists  = $values['lists'] ?? [
    [
        'icon'  => 'ri-shield-check-line',
        'title' => 'Uy Tín',
        'desc'  => 'Cam kết minh bạch trong mọi giao dịch. Không có điều khoản ẩn, không có chi phí bất ngờ.',
    ],
    [
        'icon'  => 'ri-heart-line',
        'title' => 'Tận Tâm',
        'desc'  => 'Đặt lợi ích của người dùng lên hàng đầu. Hỗ trợ 24/7 với đội ngũ chuyên nghiệp và nhiệt tình.',
    ],
    [
        'icon'  => 'ri-lightbulb-line',
        'title' => 'Đổi Mới',
        'desc'  => 'Liên tục cải tiến dịch vụ, cập nhật công nghệ mới nhất để mang lại trải nghiệm tốt nhất.',
    ],
    [
        'icon'  => 'ri-team-line',
        'title' => 'Cộng Đồng',
        'desc'  => 'Xây dựng cộng đồng nhà đầu tư crypto lớn mạnh, chia sẻ kiến thức và cơ hội đầu tư.',
    ],
];
?>

<section class="section section--light about-values">
    <div class="container">

        <!-- Section header -->
        <div class="section-header">
            <span class="section-header__eyebrow"><?php echo esc_html($badge); ?></span>
            <h2 class="section-header__title"><?php echo esc_html($title); ?></h2>
        </div>

        <!-- Cards grid -->
        <div class="about-values__grid">
            <?php foreach ($lists as $item) :
                $icon  = $item['icon']  ?? '';
                $ititle = $item['title'] ?? '';
                $desc  = $item['desc']  ?? '';
            ?>
                <div class="about-values__card card">
                    <?php if ($icon) : ?>
                        <div class="about-values__icon">
                            <i class="<?php echo esc_attr($icon); ?>"></i>
                        </div>
                    <?php endif; ?>
                    <h3 class="about-values__card-title"><?php echo esc_html($ititle); ?></h3>
                    <p class="about-values__card-desc"><?php echo esc_html($desc); ?></p>
                </div>
            <?php endforeach; ?>
        </div>

    </div>
</section>