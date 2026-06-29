<?php
$mision       = get_field('mision');
$content      = $mision['content'] ?? [];
$image_group  = $mision['image'] ?? [];

$badge          = $content['badge']          ?? '';
$title          = $content['title']          ?? '';
$highlight      = $content['hightligh_title'] ?? '';
$description    = $content['description']    ?? '';
$stats          = $content['stats']          ?? [];

$img_url = $image_group['image'] ?: 'https://readdy.ai/api/search-image?query=professional%20crypto%20trader%20Vietnamese%20man%20analyzing%20cryptocurrency%20charts%20on%20multiple%20monitors%2C%20modern%20trading%20desk%20setup%20with%20Bitcoin%20Ethereum%20price%20charts%2C%20warm%20orange%20ambient%20lighting%2C%20professional%20financial%20workspace%2C%20high%20quality%20photography&width=700&height=520&seq=about1&orientation=landscape';
$badge_number   = $image_group['badge_number']       ?? '';
$badge_suffix   = $image_group['badge_number_suffix'] ?? '';
$badge_label    = $image_group['badge_label']        ?? '';
?>

<section class="section section--white about-mission">
    <div class="container">
        <div class="about-mission__grid">

            <!-- Left: Text content -->
            <div class="about-mission__content">

                <?php if ($badge) : ?>
                    <span class="section-header__eyebrow"><?php echo esc_html($badge); ?></span>
                <?php endif; ?>

                <h2 class="about-mission__title">
                    <?php echo esc_html($title); ?><br>
                    <span class="text-grad"><?php echo esc_html($highlight); ?></span>
                </h2>

                <?php if ($description) : ?>
                    <div class="about-mission__desc">
                        <?php echo wp_kses_post($description); ?>
                    </div>
                <?php endif; ?>

                <!-- Stats grid -->
                <?php if (!empty($stats)) : ?>
                    <div class="about-mission__stats">
                        <?php foreach ($stats as $stat) :
                            $num    = $stat['number'] ?? '';
                            $suffix = $stat['suffix'] ?? '';
                            $label  = $stat['label']  ?? '';
                        ?>
                            <div class="about-mission__stat">
                                <div class="about-mission__stat-number">
                                    <span
                                        class="count-up-trigger"
                                        data-countup-end="<?php echo esc_attr($num); ?>"
                                        data-countup-suffix="<?php echo esc_attr($suffix); ?>">
                                        <?php echo esc_html($num . $suffix); ?>
                                    </span>
                                </div>
                                <div class="about-mission__stat-label"><?php echo esc_html($label); ?></div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

            </div>

            <!-- Right: Image -->
            <div class="about-mission__media">
                <?php if ($img_url) : ?>
                    <img
                        class="about-mission__img"
                        alt="INOX FUTURE Mission"
                        src="<?php echo esc_url($img_url); ?>">
                <?php endif; ?>

                <?php if ($badge_number) : ?>
                    <div class="about-mission__badge">
                        <div class="about-mission__badge-number">
                            <span
                                class="count-up-trigger"
                                data-countup-end="<?php echo esc_attr($badge_number); ?>"
                                data-countup-suffix="<?php echo esc_attr($badge_suffix); ?>">
                                <?php echo esc_html($badge_number . $badge_suffix); ?>
                            </span>
                        </div>
                        <div class="about-mission__badge-label"><?php echo esc_html($badge_label); ?></div>
                    </div>
                <?php endif; ?>
            </div>

        </div>
    </div>
</section>