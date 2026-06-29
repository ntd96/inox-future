<?php /* templates/parts/card-steel.php */ ?>

<?php
$badge      = get_field('badge');
$thong_tin  = get_field('thong_tin_thep');
$tieu_chuan = $thong_tin['tieu_chuan'] ?? '';
$do_day     = $thong_tin['do_day']     ?? '';
$fallback   = get_theme_file_uri() . '/assets/images/no-image.jpg';
?>

<div class="prod-card" data-product-id="<?php the_ID(); ?>">

    <div class="prod-img-wrap">
        <?php if ( has_post_thumbnail() ) : ?>
            <?php the_post_thumbnail('large'); ?>
        <?php else : ?>
            <img src="<?php echo esc_url($fallback); ?>" alt="<?php the_title(); ?>" />
        <?php endif; ?>
    </div>

    <div class="prod-body">
        <?php if ($badge) : ?>
            <span class="prod-badge"><?php echo esc_html($badge); ?></span>
        <?php endif; ?>

        <h3 class="prod-name"><?php the_title(); ?></h3>

        <ul class="prod-specs">
            <?php if ($tieu_chuan) : ?>
            <li>
                <i class="fa-regular fa-file-lines"></i>
                <span><?php echo esc_html($tieu_chuan); ?></span>
            </li>
            <?php endif; ?>
            <?php if ($do_day) : ?>
            <li>
                <i class="fa-solid fa-ruler"></i>
                <span><?php echo esc_html($do_day); ?></span>
            </li>
            <?php endif; ?>
        </ul>

        <div class="prod-footer">
            <span>Xem chi tiết</span>
            <i class="fa-solid fa-arrow-right prod-arrow"></i>
        </div>
    </div>

</div>