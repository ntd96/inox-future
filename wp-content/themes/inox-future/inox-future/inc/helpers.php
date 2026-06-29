<?php


/**
 * ==========================================================
 * 7. DEBUG HELPER (in ra như var_dump nhưng đẹp)
 * ==========================================================
 */
function dd($data)
{
    echo "<pre style='background:#111;color:#0f0;padding:15px'>";
    print_r($data);
    echo "</pre>";
    die();
}

/**
 * ==========================================================
 * 7. DEBUG TO CONSOLE (in ra console của trình duyệt)
 * ==========================================================
 */
function debug_to_console($data, $context = 'Debug in Console')
{

    // Buffering to solve problems frameworks, like header() in this and not a solid return.
    ob_start();

    $output  = 'console.info(\'' . $context . ':\');';
    $output .= 'console.log(' . json_encode($data) . ');';
    $output  = sprintf('<script>%s</script>', $output);

    echo $output;
}


/**
 * * ==========================================================
 * Render Pagination HTML
 * @param int $current - Trang hiện tại
 * @param int $max_pages - Tổng số trang
 * @param bool $is_ajax - true: dùng cho AJAX, false: dùng URL thật
 * * ==========================================================
 */
function render_pagination($current = 1, $max_pages = 1, $is_ajax = true)
{
    if ($max_pages <= 1) {
        return '';
    }

    $args = [
        'current'   => $current,
        'total'     => $max_pages,
        'prev_text' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>',
        'next_text' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>',
        'end_size'  => 1,
        'mid_size'  => 2,
    ];

    // AJAX mode: dùng # để JS bắt event
    if ($is_ajax) {
        $args['base']   = '%_%';
        $args['format'] = '#page=%#%';
    }
    /**
     * Non-AJAX: để WP tự tạo URL chuẩn
     * get_query_var('paged')
     */

    return paginate_links($args);
}


/**
 * ==========================================================
 * TÙY CHỈNH SEARCH CHỈ THEO TITLE
 * ==========================================================
 */
add_filter('posts_search', function ($search, $wp_query) {
    global $wpdb;

    // chỉ áp dụng cho search frontend
    if (empty($search) || ! $wp_query->is_search()) {
        return $search;
    }

    $keyword = $wp_query->get('s');
    $keyword = esc_sql($wpdb->esc_like($keyword));

    // search CHỈ theo title
    $search = " AND ({$wpdb->posts}.post_title LIKE '%{$keyword}%') ";

    return $search;
}, 10, 2);


/**
 * ==========================================================
 * Thay thế input[type="submit"] -> button[type="submit"]
 * Lý do: conflict với plugin Gtranslate khi switch các ngôn ngữ input[type="submit"] bị ẩn khỏi DOM
 * ==========================================================
 */
add_filter('wpcf7_form_elements', function ($content) {
    // Đơn giản: Thay thế pattern cơ bản
    $content = preg_replace(
        '/<input\s+class="([^"]*wpcf7-submit[^"]*)"\s+type="submit"\s+value="([^"]+)"\s*\/?>/i',
        '<button type="submit" class="$1">$2</button>',
        $content
    );

    return $content;
});


/**
 * Detect platform từ URL
 * @return 'youtube' | 'tiktok' | 'facebook' | 'unknown'
 */
function detect_video_platform(string $url): string
{
    if (preg_match('/youtube\.com|youtu\.be/', $url))  return 'youtube';
    if (preg_match('/tiktok\.com/', $url))             return 'tiktok';
    if (preg_match('/facebook\.com|fb\.watch/', $url)) return 'facebook';
    return 'unknown';
}

/**
 * Convert URL thuần → embed URL
 * Facebook trả về link gốc luôn (mở tab mới)
 */
function get_video_embed_url(string $url, string $platform): string
{
    switch ($platform) {
        case 'youtube':
            $id = get_youtube_video_id($url);
            return $id ? "https://www.youtube.com/embed/{$id}?autoplay=1" : $url;

        case 'tiktok':
            preg_match('/video\/(\d+)/', $url, $m);
            $id = $m[1] ?? '';
            return $id ? "https://www.tiktok.com/embed/v2/{$id}" : $url;

        case 'facebook':
            return $url; // Mở tab mới, không cần embed
    }
}

/**
 * Trích xuất YouTube Video ID từ mọi dạng URL:
 * - youtube.com/watch?v=ID
 * - youtu.be/ID
 * - youtube.com/shorts/ID
 */
function get_youtube_video_id(string $url): string
{
    // watch?v=ID hoặc &v=ID
    if (preg_match('/[?&]v=([a-zA-Z0-9_-]{11})/', $url, $m)) return $m[1];
    // youtu.be/ID
    if (preg_match('/youtu\.be\/([a-zA-Z0-9_-]{11})/', $url, $m))  return $m[1];
    // youtube.com/shorts/ID
    if (preg_match('/\/shorts\/([a-zA-Z0-9_-]{11})/', $url, $m))   return $m[1];
    return '';
}

/**
 * Lấy thumbnail YouTube từ video ID (không cần API key)
 * Ưu tiên maxresdefault (1280×720), fallback hqdefault (480×360) nếu không có
 */
function get_youtube_thumbnail(string $url): string
{
    $id = get_youtube_video_id($url);
    if (!$id) return '';

    $maxres = "https://img.youtube.com/vi/{$id}/maxresdefault.jpg";

    // Kiểm tra maxresdefault có tồn tại không (một số Shorts/video cũ không có)
    $response = wp_remote_head($maxres);
    $code     = wp_remote_retrieve_response_code($response);

    return ($code === 200)
        ? $maxres
        : "https://img.youtube.com/vi/{$id}/hqdefault.jpg";
}