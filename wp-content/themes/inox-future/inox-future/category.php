<?php
get_header();

$current_cat = get_queried_object();

?>

<!-- Hero Section -->
<section class="category-hero">
    <div class="container">
        <h1 class="category-hero__title"><?php echo esc_html($current_cat->name); ?></h1>

        <nav class="category-hero__breadcrumb" aria-label="Breadcrumb">
            <ol>
                <li><a href="<?php echo esc_url(home_url('/')); ?>">Trang chủ</a></li>
                <li><a href="<?php echo esc_url(home_url('/blog')); ?>">Blog</a></li>
                <li aria-current="page"><?php echo esc_html($current_cat->name); ?></li>
            </ol>
        </nav>

        <?php if ($current_cat->description) : ?>
            <p class="category-hero__desc"><?php echo esc_html($current_cat->description); ?></p>
        <?php endif; ?>
    </div>
</section>

<!-- Main Content -->
<section class="category-content">
    <div class="container">
        <div class="category-content__wrapper">
            <!-- Posts List -->
            <main class="category-content__main">
                <?php if (have_posts()) : ?>
                    <div class="category-content__grid">
                        <?php while (have_posts()) : the_post(); ?>
                            <?php get_template_part('templates/parts/card-post'); ?>
                        <?php endwhile; ?>
                    </div>

                    <!-- Pagination -->
                    <div class="pagination" id="pagination">
                        <?php
                        global $wp_query;
                        $paged = get_query_var('paged') ? get_query_var('paged') : 1;
                        echo render_pagination($paged, $wp_query->max_num_pages, false);
                        ?>
                    </div>
                <?php else : ?>
                    <p class="category-content__empty">Không có bài viết nào trong danh mục này.</p>
                <?php endif; ?>
            </main>

            <!-- Sidebar -->
            <aside class="category-content__sidebar">
                <!-- Widget: Danh mục -->
                <div class="sidebar-widget">
                    <h3 class="sidebar-widget__title">Danh mục</h3>
                    <ul class="sidebar-categories">
                        <?php
                        $all_categories = get_categories(array(
                            'orderby'    => 'name',
                            'order'      => 'ASC',
                            'hide_empty' => true,
                        ));

                        if (!empty($all_categories)) :
                            foreach ($all_categories as $cat) :
                                $is_active = ($current_cat->term_id === $cat->term_id) ? ' active' : '';
                        ?>
                                <li class="sidebar-categories__item<?php echo $is_active; ?>">
                                    <a href="<?php echo esc_url(get_category_link($cat->term_id)); ?>" class="sidebar-categories__link">
                                        <span class="sidebar-categories__name"><?php echo esc_html($cat->name); ?></span>
                                        <span class="sidebar-categories__count"><?php echo esc_html($cat->count); ?> bài viết</span>
                                    </a>
                                </li>
                        <?php
                            endforeach;
                        endif;
                        ?>
                    </ul>
                </div>

                <!-- Widget: Bài viết mới nhất -->
                <div class="sidebar-widget">
                    <h3 class="sidebar-widget__title">Bài viết mới nhất</h3>
                    <div class="sidebar-widget__list">
                        <?php
                        $recent_posts = new WP_Query(array(
                            'post_type'      => 'post',
                            'posts_per_page' => 4,
                            'orderby'        => 'date',
                            'order'          => 'DESC',
                        ));

                        if ($recent_posts->have_posts()) :
                            while ($recent_posts->have_posts()) : $recent_posts->the_post();
                        ?>
                                <article class="sidebar-post-card">
                                    <a href="<?php the_permalink(); ?>" class="sidebar-post-card__link">
                                        <?php if (has_post_thumbnail()) : ?>
                                            <div class="sidebar-post-card__thumb">
                                                <?php the_post_thumbnail('thumbnail'); ?>
                                            </div>
                                        <?php endif; ?>
                                        <div class="sidebar-post-card__content">
                                            <h4 class="sidebar-post-card__title"><?php the_title(); ?></h4>
                                            <time class="sidebar-post-card__date" datetime="<?php echo get_the_date('c'); ?>">
                                                <img class="img-fluid" src="<?php echo get_theme_file_uri() ?>/assets/images/icon-22.svg" alt="">
                                                <?php echo get_the_date('d/m/Y'); ?>
                                            </time>
                                        </div>
                                    </a>
                                </article>
                        <?php
                            endwhile;
                            wp_reset_postdata();
                        endif;
                        ?>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</section>

<?php get_footer(); ?>