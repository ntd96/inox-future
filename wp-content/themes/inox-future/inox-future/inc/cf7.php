<?php


/**
 * Loại bỏ auto <p> và <br> của Contact Form 7
 */
add_filter('wpcf7_autop_or_not', '__return_false');


add_filter('wpcf7_form_tag', function($tag) {
    if ( $tag['type'] === 'turnstile' ) {
        $tag['options'][] = 'language:' . pll_current_language();
    }
    return $tag;
});