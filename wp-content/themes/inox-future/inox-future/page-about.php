<?php

/**
 * Template Name: About Page
 */

get_header();
?>


<div class="page-about">
   
    <?php get_template_part('templates/pages/about/section', 'hero'); ?>

    <?php get_template_part('templates/pages/about/section', 'mission'); ?>

    <?php get_template_part('templates/pages/about/section', 'values'); ?>

    <?php get_template_part('templates/pages/about/section', 'timeline'); ?>
    
    <?php get_template_part('templates/pages/about/section', 'team'); ?>

    <?php get_template_part('templates/pages/about/section', 'cta'); ?>

</div>

<?php add_action('wp_footer', function () { ?>
    <script>
        jQuery(document).ready(function($) {
            /* ============================================
   ABOUT MISSION — CountUp.js init
   Yêu cầu: countUp.js v2 + jQuery đã được load
   ============================================ */

            $(".about-mission .count-up-trigger").each(function() {
                const endVal = $(this).data("countup-end");
                const suffix = $(this).data("countup-suffix") || "";

                const countUpAnim = new countUp.CountUp(this, endVal, {
                    enableScrollSpy: true,
                    scrollSpyOnce: true,
                    duration: 3,
                    separator: ".",
                    suffix: suffix,
                });
            });

        });
    </script>
<?php }); ?>

<?php get_footer(); ?>