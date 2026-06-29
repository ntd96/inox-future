<?php get_header(); ?>

<main>
    <h2>Welcome to your theme!</h2>

    <?php
    if (have_posts()) :
        while (have_posts()) : the_post();
            the_title('<h3>', '</h3>');
            the_content();
        endwhile;
    else :
        echo '<p>No posts found.</p>';
    endif;
    ?>
</main>

<?php get_footer(); ?>
