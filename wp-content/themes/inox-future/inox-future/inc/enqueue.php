<?php


function theme_assets()
{


    // Variables — load TRƯỚC TIÊN
    wp_enqueue_style('theme-variables', get_theme_file_uri() . '/assets/css/variables.css', array(), '1.0');

    // Components — phụ thuộc variables
    wp_enqueue_style('component-style', get_theme_file_uri() . '/assets/css/components/components.css', array('theme-variables'), '1.0');

    // Header — phụ thuộc variables + components
    wp_enqueue_style('header-style', get_theme_file_uri() . '/assets/css/header.css', array('theme-variables', 'component-style'), '1.0');

    // Footer — phụ thuộc variables + components
    wp_enqueue_style('footer-style', get_theme_file_uri() . '/assets/css/footer.css', array('theme-variables', 'component-style'), '1.0');

    // Fonts
    wp_enqueue_style('custom-fonts', get_theme_file_uri() . '/assets/fonts/stylesheet.css', array(), null);


    // GLightbox CSS
    wp_enqueue_style('glightbox-css', 'https://cdnjs.cloudflare.com/ajax/libs/glightbox/3.3.0/css/glightbox.min.css', array(), '3.3.0');

    // Slick CSS từ CDN
    wp_enqueue_style(
        'slick-css',
        'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css',
        array(),
        '1.8.1'
    );

    // Slick Theme CSS (không bắt buộc)
    wp_enqueue_style(
        'slick-theme-css',
        'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css',
        array('slick-css'),
        '1.8.1'
    );

    // Front Page Specific Styles
    wp_enqueue_style(
        'remixicon',
        'https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.2.0/remixicon.min.css',
        [],
        '4.2.0'
    );

    // CSS
    wp_enqueue_style('main-style', get_theme_file_uri() . '/assets/css/main.css', array(), '1.0', 'all');
    wp_enqueue_style('responsive-style', get_theme_file_uri() . '/assets/css/responsive.css', array('main-style'), '1.0', 'all');


    // jQuery (WordPress bản sẵn có)
    wp_enqueue_script('jquery');


    // JS
    wp_enqueue_script('main-js', get_theme_file_uri() . '/assets/js/main.js', array('jquery', 'slick-js'), '1.0', true);

    // Localize
    wp_localize_script('main-js', 'vari', [
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('nonce_custom'),
        'page_id' => get_the_ID(),
    ]);

    // Header Js
    wp_enqueue_script('header-js', get_theme_file_uri() . '/assets/js/header.js', array('jquery'), '1.0', true);


    wp_enqueue_script('countup-js', 'https://cdnjs.cloudflare.com/ajax/libs/countup.js/2.8.0/countUp.umd.js', array(), '2.8.0', true);

    // Slick JS từ CDN
    wp_enqueue_script(
        'slick-js',
        'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js',
        array('jquery'),
        '1.8.1',
        true
    );

    // Enqueue Font Awesome v6 (bản mới và đầy đủ nhất)
    wp_enqueue_style(
        'font-awesome-cdn',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css',
        array(),
        '6.4.2'
    );


    // GLightbox JS
    wp_enqueue_script('glightbox-js', 'https://cdnjs.cloudflare.com/ajax/libs/glightbox/3.3.0/js/glightbox.min.js', array('jquery'), '3.3.0', true);


    wp_enqueue_style('popup-single-steel', get_theme_file_uri() . '/assets/css/components/popup-single-steel.css');
    wp_enqueue_style('popup-contact', get_theme_file_uri() . '/assets/css/components/popup-contact.css');


    /**
     *  Single post
     */
    if (is_singular('post')) {
        wp_enqueue_style('single-post', get_theme_file_uri() . '/assets/css/pages/post/single-post.css');
        wp_enqueue_script('single-post-js',  get_theme_file_uri() . '/assets/js/single-post.js', array(), '1.0', true);
    }

    /**
     * Chỉ dành cho trang chủ
     */
    if (is_front_page()) {


        wp_enqueue_style('front-page-style', get_theme_file_uri() . '/assets/css/pages/front-page.css', array(), '1.0');


        wp_enqueue_script('front-page-js', get_theme_file_uri() . '/assets/js/front-page.js', array('jquery'), '1.0', true);


        // Dành cho section Features - hiển thị modal
    }



    /**
     * Chỉ dành cho trang Page About
     */
    if (is_page_template('page-about.php')) {
        wp_enqueue_style('page-about', get_theme_file_uri() . '/assets/css/pages/page-about.css', array(), '1.0');
    }

    /**
     * Chỉ dành cho page 404
     */
    if (is_404()) {
        wp_enqueue_style('page-404-style', get_theme_file_uri() . '/assets/css/404.css', array(), '1.0');
    }
}
add_action('wp_enqueue_scripts', 'theme_assets');
