<?php
$timeline = get_field('timeline');
$badge    = $timeline['badge'] ?? 'Lịch Sử';
$title    = $timeline['title'] ?? 'Hành Trình Phát Triển';
$lists    = $timeline['lists'] ?? [
    [
        'year'  => 2020,
        'title' => 'Khởi Đầu',
        'desc'  => 'INOX FUTURE bắt đầu hành trình với tư cách là một nhà đầu tư crypto cá nhân, tích lũy kinh nghiệm trên các sàn giao dịch hàng đầu.',
    ],
    [
        'year'  => 2021,
        'title' => 'Mở Rộng',
        'desc'  => 'Trở thành đối tác chính thức của Binance và OKX, bắt đầu chia sẻ hoàn phí với cộng đồng nhà đầu tư Việt Nam.',
    ],
    [
        'year'  => 2022,
        'title' => 'Phát Triển',
        'desc'  => 'Mở rộng lên 10+ sàn đối tác, đạt 10,000 người dùng đầu tiên. Ra mắt kênh YouTube và Telegram hỗ trợ cộng đồng.',
    ],
    [
        'year'  => 2023,
        'title' => 'Bứt Phá',
        'desc'  => 'Đạt 30,000 người dùng, mở rộng sang thị trường Forex với VT Markets và Vantage. Tổng hoàn phí chi trả vượt 5 tỷ đồng.',
    ],
    [
        'year'  => 2024,
        'title' => 'Dẫn Đầu',
        'desc'  => 'Trở thành nền tảng hoàn phí crypto uy tín #1 Việt Nam với 50,000+ người dùng và 15+ sàn đối tác chính thức.',
    ],
    [
        'year'  => 2026,
        'title' => 'Tương Lai',
        'desc'  => 'Tiếp tục mở rộng ra thị trường quốc tế, hỗ trợ đa ngôn ngữ và phát triển hệ sinh thái đầu tư crypto toàn diện.',
    ],
];

$current_year = (int) date('Y');
?>

<section class="section section--white timeline">
    <div class="container container--narrow">

        <div class="section-header">
            <span class="section-header__eyebrow"><?php echo esc_html($badge); ?></span>
            <h2 class="section-header__title"><?php echo esc_html($title); ?></h2>
        </div>

        <div class="timeline__wrapper">
            <div class="timeline__items">
                <?php foreach ($lists as $item) :
                    $year  = (int) ($item['year']  ?? 0);
                    $ttitle = $item['title'] ?? '';
                    $desc  = $item['desc']  ?? '';
                    $is_future = $year > $current_year;
                ?>
                    <div class="timeline__item<?php echo $is_future ? ' timeline__item--future' : ''; ?>">
                        <div class="timeline__year<?php echo $is_future ? ' timeline__year--grad' : ''; ?>">
                            <?php echo esc_html($year); ?>
                        </div>
                        <div class="timeline__content card">
                            <h3 class="timeline__title"><?php echo esc_html($ttitle); ?></h3>
                            <p class="timeline__desc"><?php echo esc_html($desc); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

    </div>
</section>