<?php get_header(); ?>

<main>
    <div class="container">
        <?php
        if (have_posts()) :
            while (have_posts()) : the_post();
                // the_title('<h3>', '</h3>');
                the_content();
            endwhile;
        else :
            echo '<p>No posts found.</p>';
        endif;
        ?>
    </div>
</main>

<?php get_footer(); ?>