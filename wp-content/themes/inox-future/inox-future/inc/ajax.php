<?php

// REST API (media delete, Gutenberg, API khác)
if (defined('REST_REQUEST') && REST_REQUEST) {
    return;
}


/**
 * AJAX Filter Search + Tags
 */
add_action('wp_ajax_filter_posts', 'jvc_ajax_filter_posts');
add_action('wp_ajax_nopriv_filter_posts', 'jvc_ajax_filter_posts');

function jvc_ajax_filter_posts()
{

    /**
     * Chỉ cho phép request AJAX chạy vào file này, còn rest API hay request thường khác sẽ không chạy
     * Tránh lỗi như liên quan về attachemtnt hay media khi xóa trong thư viện media
     */
    if (!wp_doing_ajax()) {
        wp_die();
    }

    if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'nonce_custom')) {
        wp_send_json_error('Security check failed');
    }

    /**
     * 
     * Lấy page_id từ request để biết đang filter cho page nào, vì có thể có nhiều page khác nhau cùng dùng chung 
     * function filter này nhưng config query khác nhau (post_type, taxonomy_cat, taxonomy_tag khác nhau), 
     * nên cần biết page_id để lấy đúng config đã set trong ACF field 'query_config' của page đó, 
     * tránh hardcode và dễ tái sử dụng cho nhiều page khác nhau chỉ cần set config khác nhau trong ACF
     */
    $page_id = intval($_POST['page_id'] ?? 0);


    // Lấy search, paged, cats, tags từ request gửi lên
    $s = sanitize_text_field($_POST['search_posts'] ? $_POST['search_posts'] : '');
    // Nếu paged không gửi lên hoặc không hợp lệ thì mặc định là 1
    $paged = intval($_POST['paged'] ? $_POST['paged'] : 1); // Lấy trang hiện tại

    /**
     * Lấy cats và tags từ request, có thể là dạng "1,2,3" hoặc ["1","2","3"] tùy cách gửi từ JS, nên xử lý linh hoạt để tránh lỗi
     */
    $cats = [];
    if (!empty($_POST['cats'][0])) {
        $cats = array_map('intval', explode(',', $_POST['cats'][0]));
    }


    /**
     * Tương tự với tags, có thể là "4,5" hoặc ["4","5"], nên xử lý linh hoạt
     */
    $tags = [];
    if (!empty($_POST['tags'][0])) {
        $tags = explode(',', $_POST['tags'][0]); // ["7","6"]
        $tags = array_map('intval', $tags);      // [7,6] kiểu số nguyên
    }

    /**
     * Lấy config query từ ACF field 'query_config' của page hiện tại (nếu có), để biết post_type, taxonomy_cat, taxonomy_tag nào cần query, tránh hardcode trong function này và có thể tái sử dụng cho nhiều page khác nhau chỉ cần set config khác nhau trong ACF
     */
    $config = $page_id ? get_field('query_config', $page_id) : [];

    // Thực hiện WP_Query với các tham số đã lấy được
    $result = get_posts_filter_query(page_id: $page_id, search: $s, paged: $paged, cats: $cats, tags: $tags);

    ob_start();
    if ($result->have_posts()) {
        while ($result->have_posts()) {
            $result->the_post();
            get_template_part('templates/parts/card', $config['post_type'] ?? 'post'); // Load template part dựa trên post_type ( nhớ tên post_type phải trùng tên card ) , nếu không có post_type trong config thì mặc định là 'post'
        }
        wp_reset_postdata();
    } else {
        echo '<p>' . esc_html(pll__('Không có bài viết nào.')) . '</p>';
    }
    $html = ob_get_clean();

    $pagination = render_pagination($paged, $result->max_num_pages, true);

    /**
     * POST TPE : videos
     * json chỉ dành chi videos post type
     */
    $videos = [];
    if ($config['post_type'] == 'videos') {

        $term_id = !empty($cats) ? $cats[0] : 0;

        // Lấy tags của term hiện tại
        $tag_terms = get_terms([
            'taxonomy'   => $config['taxonomy_tag'] ?: 'post_tag',
            'hide_empty' => false, // Chỉ lấy tag có bài
            'object_ids' => get_posts([ // Chỉ lấy tag thuộc platform này
                'post_type'      => 'videos',
                'posts_per_page' => -1,
                'fields'         => 'ids',
                'tax_query'      => [[
                    'taxonomy' => $config['taxonomy_cat'],
                    'terms'    => $term_id,
                ]],
            ]),
        ]);

        $term    = $term_id ? get_term($term_id) : null;

        $fields = get_fields('videos_platform_tax_' . $term->term_id);
        $videos = [
            'color'       => $fields['backgroup_color_start'] ?: '#000',
            'name'        => $term->name,
            'video_new'   => pll__('Video mới nhất'),
            'view_all' => pll__('Xem Tất Cả') . ' <i class="ri-arrow-right-line"></i>',
            'icon'        => $fields['icon'] ?: '',
            'channel_url' => $fields['link'] ?: '',
            'has_more'    => $paged < $result->max_num_pages,
            'tags' => array_map(fn($t) => [
                'id'   => $t->term_id,
                'name' => $t->name,
            ], $tag_terms ?: []),
        ];
    }

    wp_send_json_success([
        'html' => $html,
        'pagination' => $pagination,
        'videos' => $videos,
    ]);
}

/**
 * Get Posts Filter Query
 * Thực hiện chức năng lọc search và tags ở trang blog.php +  jvc_ajax_filter_posts()
 */
function get_posts_filter_query($page_id = 0, $search = '', $paged = 1, $cats = [], $tags = [])
{

    $config = $page_id ? get_field('query_config', $page_id) : [];
    $relation = $config['tax_query_relation'] ?: 'OR';


    $tax_query = ['relation' => $relation];

    $args = [
        'post_type'      => $config['post_type'] ?? 'post',
        'posts_per_page' => $config['posts_per_page'] ?? 9,
        'post_status'    => 'publish',
        'paged'          => $paged,
    ];

    if (!empty($search)) {
        $args['s'] = $search;
    }

    if (!empty($cats) || !empty($tags)) {
        $tax_query = ['relation' => 'AND'];

        if (!empty($cats)) {
            $tax_query[] = [
                'taxonomy' => $config['taxonomy_cat'] ?: 'category',
                'field'    => 'term_id',
                'terms'    => $cats,
                'operator' => 'IN',
            ];
        }

        if (!empty($tags)) {
            $tax_query[] = [
                'taxonomy' => $config['taxonomy_tag'] ?: 'post_tag',
                'field'    => 'term_id',
                'terms'    => $tags,
                'operator' => 'IN',
            ];
        }

        $args['tax_query'] = $tax_query;
    }

    return new WP_Query($args);
}


/**
 * AJAX Get Steel Detail
 * Dành cho post type steel, khi click vào card steel sẽ load popup chi tiết sản
 */
add_action('wp_ajax_get_steel_detail', 'jvc_get_steel_detail');
add_action('wp_ajax_nopriv_get_steel_detail', 'jvc_get_steel_detail');

function jvc_get_steel_detail()
{
    if (!wp_doing_ajax()) wp_die();

    if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'nonce_custom')) {
        wp_send_json_error('Security check failed');
    }

    $post_id = intval($_POST['post_id'] ?? 0);
    if (!$post_id) wp_send_json_error('Invalid post ID');

    $post = get_post($post_id);
    if (!$post || $post->post_type !== 'steel') wp_send_json_error('Post not found');

    ob_start();
    get_template_part('templates/parts/popup-single-steel', null, ['post_id' => $post_id]);
    $html = ob_get_clean();

    wp_send_json_success(['html' => $html]);
}
