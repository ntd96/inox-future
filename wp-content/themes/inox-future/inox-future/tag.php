<?php get_header(); ?>

<div class="archive-tag">
    <section class="archive-tag-hero">
        <div class="container">
            <h1 class="archive-tag-hero__title">TAG</h1>
            <?php
            $tag_description = tag_description();
            if ($tag_description) : ?>
                <p class="archive-tag-hero__desc"><?php echo $tag_description; ?></p>
            <?php endif; ?>
        </div>
    </section>

    <section class="archive-tag-content">
        <div class="container">
            <h3> Tag: <span> <?php single_tag_title(); ?> </span> </h3>
            <div class="archive-tag-content__wrapper">
                <main class="archive-tag-main">
                    <?php if (have_posts()) : ?>
                        <div class="post-list">
                            <?php while (have_posts()) : the_post(); ?>
                                <?php get_template_part('templates/parts/card', 'post'); ?>
                            <?php endwhile; ?>
                        </div>
                        <?php
                        global $wp_query;
                        echo render_pagination(get_query_var('paged'), $wp_query->max_num_pages, false);
                        ?>
                    <?php else : ?>
                        <p class="archive-tag-main__empty">Không có bài viết nào.</p>
                    <?php endif; ?>
                </main>

                <aside class="archive-tag-sidebar">
                    <div class="archive-tag-sidebar__inner">
                        <h3 class="archive-tag-sidebar__title">Tất cả thẻ</h3>
                        <ul class="archive-tag-sidebar__list">
                            <?php
                            $current_tag_id = get_queried_object_id();
                            $tags = get_tags(array(
                                'orderby' => 'count',
                                'order' => 'DESC',
                                'hide_empty' => true
                            ));

                            if ($tags) :
                                foreach ($tags as $tag) :
                                    $is_active = ($tag->term_id === $current_tag_id) ? ' is-active' : '';
                            ?>
                                    <li class="archive-tag-sidebar__item<?php echo $is_active; ?>">
                                        <a href="<?php echo get_tag_link($tag->term_id); ?>" class="archive-tag-sidebar__link">
                                            <span class="archive-tag-sidebar__name"><?php echo $tag->name; ?></span>
                                            <span class="archive-tag-sidebar__count"><?php echo $tag->count; ?></span>
                                        </a>
                                    </li>
                            <?php
                                endforeach;
                            endif;
                            ?>
                        </ul>
                    </div>
                </aside>


            </div>
        </div>
    </section>
</div>

<?php get_footer(); ?>