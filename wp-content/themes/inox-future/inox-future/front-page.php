<?php
/**
 * Template Front Page — INOX FUTURE
 */

get_header(); ?>

<main style="background-color:#fff;">

  <?php get_template_part('templates/pages/home/section-home'); ?>
  <?php get_template_part('templates/pages/home/section-features'); ?>
  <?php get_template_part('templates/pages/home/section-products'); ?>
  <?php get_template_part('templates/pages/home/section-business'); ?>

  <?php get_template_part('templates/parts/section-cta'); ?>

</main>

<?php get_footer(); ?>
