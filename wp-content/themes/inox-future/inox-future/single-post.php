<?php

get_header(); ?>




<div class="hero-banner">
    <?php
    $thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
    ?>
    <img
        class="hero-banner__img"
        src="<?php echo $thumbnail_url ? esc_url($thumbnail_url) : ''; ?>"
        alt="<?php the_title_attribute(); ?>">
    <div class="hero-banner__overlay"></div>
    <div class="hero-banner__content">
        <span class="hero-banner__category">
            <?php
            $categories = get_the_category();
            echo $categories ? esc_html($categories[0]->name) : 'Tin Tức';
            ?>
        </span>
        <h1 class="hero-banner__title"><?php the_title(); ?></h1>
    </div>
</div>


<div class="post-body">
    <div class="container">

        <!-- 1. AUTHOR BAR -->
        <div class="author-bar">
            <div class="author-bar__info">
                <img
                    class="author-bar__avatar"
                    src="<?php echo esc_url(get_avatar_url(get_the_author_meta('ID'))); ?>"
                    alt="<?php the_author(); ?>">
                <div>
                    <p class="author-bar__name"><?php the_author(); ?></p>
                    <p class="author-bar__role"><?php echo pll__('Crypto Analyst'); ?></p>
                </div>
            </div>
            <div class="author-bar__meta">
                <span class="author-bar__meta-item">
                    <i class="ri-calendar-line"></i>
                    <?php echo get_the_date('d/m/Y'); ?>
                </span>
                <span class="author-bar__meta-item">
                    <i class="ri-time-line"></i>
                    <?php
                    $content = get_the_content();
                    $word_count = str_word_count(strip_tags($content));
                    $minutes = max(1, ceil($word_count / 200));
                    echo $minutes . ' ' . pll__('phút đọc');
                    ?>
                </span>
            </div>
        </div>

        <!-- 2. SHARE BAR (TOP) -->
        <div class="share-bar">
            <span class="share-bar__label"><?php echo pll__('Chia sẻ:'); ?></span>
            <div class="share-bar__actions">
                <button class="share-bar__btn share-bar__btn--fb" onclick="sharePost('facebook')">
                    <i class="ri-facebook-fill"></i>
                    <span class="share-bar__btn-text">Facebook</span>
                </button>
                <button class="share-bar__btn share-bar__btn--tg" onclick="sharePost('telegram')">
                    <i class="ri-telegram-fill"></i>
                    <span class="share-bar__btn-text">Telegram</span>
                </button>
                <button class="share-bar__btn share-bar__btn--copy" onclick="copyLink()">
                    <i class="ri-links-line"></i>
                    <span class="share-bar__btn-text"><?php echo pll__('Sao chép link'); ?></span>
                </button>
            </div>
        </div>

        <!-- 3. ARTICLE CONTENT -->
        <div class="prose-article">
            <?php the_content(); ?>
        </div>

        <!-- 4. FOOTER BAR -->
        <div class="post-footer">
            <div class="post-footer__share">
                <span class="post-footer__label"><?php echo pll__('Chia sẻ bài viết:'); ?></span>
                <div class="post-footer__icons">
                    <button class="post-footer__icon post-footer__icon--fb" onclick="sharePost('facebook')">
                        <i class="ri-facebook-fill"></i>
                    </button>
                    <button class="post-footer__icon post-footer__icon--tg" onclick="sharePost('telegram')">
                        <i class="ri-telegram-fill"></i>
                    </button>
                    <button class="post-footer__icon post-footer__icon--copy" onclick="copyLink()">
                        <i class="ri-links-line"></i>
                    </button>
                </div>
            </div>
            <?php
            $blog_page = get_page_by_path('tin-tuc');
            $blog_url  = $blog_page ? get_permalink(pll_get_post($blog_page->ID, pll_current_language())) : home_url('/tin-tuc/');
            ?>
            <a class="post-footer__back" href="<?php echo esc_url($blog_url); ?>">
                <i class="ri-arrow-left-line"></i>
                <?php echo pll__('Quay lại Tin Tức'); ?>
            </a>
        </div>

    </div>
</div>


<!-- 5. RELATED POSTS -->
<section class="related-posts">
    <div class="container">
        <h2 class="related-posts__title"><?php echo pll__('Bài Viết Liên Quan'); ?></h2>

        <?php
        $related = new WP_Query(array(
            'post_type'           => 'post',
            'posts_per_page'      => 5,
            'post__not_in'        => array(get_the_ID()),
            // 'category__in'        => wp_get_post_categories(get_the_ID()),
            // 'ignore_sticky_posts' => 1,
        ));
        ?>

        <?php if ($related->have_posts()) : ?>
            <div class="related-posts__slider">
                <?php while ($related->have_posts()) : $related->the_post(); ?>
                    <div class="related-posts__item">
                        <a class="post-card" href="<?php the_permalink(); ?>">
                            <div class="post-card__thumb">
                                <?php if (has_post_thumbnail()) : ?>
                                    <img
                                        class="post-card__img"
                                        src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'medium_large')); ?>"
                                        alt="<?php the_title_attribute(); ?>">
                                <?php endif; ?>
                                <span class="post-card__cat">
                                    <?php
                                    $cats = get_the_category();
                                    echo $cats ? esc_html($cats[0]->name) : '';
                                    ?>
                                </span>
                            </div>
                            <div class="post-card__body">
                                <div class="post-card__meta">
                                    <span class="post-card__meta-item">
                                        <i class="ri-calendar-line"></i>
                                        <?php echo get_the_date('d/m/Y'); ?>
                                    </span>
                                    <span class="post-card__meta-item">
                                        <i class="ri-time-line"></i>
                                        <?php
                                        $wc  = str_word_count(strip_tags(get_the_content()));
                                        echo max(1, ceil($wc / 200)) . ' ' . pll__('phút đọc');
                                        ?>
                                    </span>
                                </div>
                                <h3 class="post-card__title"><?php the_title(); ?></h3>
                            </div>
                        </a>
                    </div>
                <?php endwhile;
                wp_reset_postdata(); ?>
            </div>
        <?php endif; ?>

    </div>
</section>

<?php add_action('wp_footer', function () { ?>
    <script>
        jQuery(function($) {

            function sharePost(platform) {
                const url = encodeURIComponent(window.location.href);
                const title = encodeURIComponent(document.title);
                const links = {
                    facebook: `https://www.facebook.com/sharer/sharer.php?u=${url}`,
                    telegram: `https://t.me/share/url?url=${url}&text=${title}`,
                };
                window.open(links[platform], '_blank', 'width=600,height=500');
            }

            function copyLink() {
                navigator.clipboard.writeText(window.location.href).then(() => {
                    const $btns = $('.share-bar__btn--copy, .post-footer__icon--copy');
                    $btns.each(function() {
                        const $icon = $(this).find('i');
                        const $text = $(this).find('.share-bar__btn-text');

                        $icon.attr('class', 'ri-check-line');
                        if ($text.length) $text.text('<?php echo pll__('Đã sao chép!'); ?>');

                        setTimeout(() => {
                            $icon.attr('class', 'ri-links-line');
                            if ($text.length) $text.text('<?php echo pll__('Sao chép link'); ?>');
                        }, 2000);
                    });
                });
            }

            $(document).on('click', '.share-bar__btn--fb, .post-footer__icon--fb', () => sharePost('facebook'));
            $(document).on('click', '.share-bar__btn--tg, .post-footer__icon--tg', () => sharePost('telegram'));
            $(document).on('click', '.share-bar__btn--copy, .post-footer__icon--copy', copyLink);



            // Related posts slider
            $('.related-posts__slider').slick({
                slidesToShow: 3,
                slidesToScroll: 1,
                dots: true,
                arrows: true,
                infinite: true,
                responsive: [{
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 2
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 1
                        }
                    }
                ]
            });
        });
    </script>
<?php }); ?>

<?php
get_footer();
