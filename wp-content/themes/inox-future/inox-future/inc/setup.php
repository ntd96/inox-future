<?php

function theme_setup()
{
    // Support Custom Logo
    add_theme_support('custom-logo', array(
        'height'      => 60,
        'width'       => 160,
        'flex-height' => true,
        'flex-width'  => true,
    ));

    // Tự update <title>
    add_theme_support('title-tag');

    // Thumbnail
    add_theme_support('post-thumbnails');

    // HTML5 markup chuẩn
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));

    // Support cho menu
    register_nav_menus(array(
        'primary_menu'   => __('Primary Menu', 'inoxfuture'),
        'footer_menu'    => __('Footer Menu', 'inoxfuture'),
        'footer_products' => __('Footer - Sản Phẩm', 'inoxfuture'),
        'footer_support' => __('Footer - Hỗ Trợ', 'inoxfuture'),
    ));
}
add_action('after_setup_theme', 'theme_setup');


/**
 * ==========================================================
 * CLEAN UP HEADER
 * ==========================================================
 */
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'wp_shortlink_wp_head');
remove_action('wp_head', 'rest_output_link_wp_head');
remove_action('wp_head', 'wp_oembed_add_discovery_links');
remove_action('wp_head', 'wp_oembed_add_host_js');

/**
 * ==========================================================
 * Chặn WordPress tạo multiple image sizes
 * ==========================================================
 */
add_filter('big_image_size_threshold', '__return_false');

function disable_all_image_sizes($sizes)
{
    return array();
}
add_filter('intermediate_image_sizes_advanced', 'disable_all_image_sizes');

/**
 * ==========================================================
 * ALLOW SVG UPLOAD
 * ==========================================================
 */
function allow_svg($mimes)
{
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'allow_svg');


/**
 * ==========================================================
 * DISABLE REST API FOR USERS
 * ==========================================================
 */
add_filter('rest_endpoints', function ($endpoints) {
    if (isset($endpoints['/wp/v2/users'])) {
        unset($endpoints['/wp/v2/users']);
    }
    return $endpoints;
});

/**
 * ==========================================================
 * DISABLE GUTENBERG BLOCK LIBRARIES CSS
 * ==========================================================
 */
function disable_gutenberg_block_css()
{
    wp_dequeue_style('wp-block-library');
    wp_dequeue_style('wp-block-library-theme');
    wp_dequeue_style('wc-block-style');
}
add_action('wp_enqueue_scripts', 'disable_gutenberg_block_css', 100);
