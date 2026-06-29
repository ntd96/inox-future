<?php

/**
 * 404 Template
 * -----------------------------
 * Hiển thị khi trang không tồn tại
 */

get_header();
?>

<section class="error-404">
    <div class="container">
        <div class="error-404__inner">
            <div class="error-404__code">404</div>
            <h1 class="error-404__title">Trang không tồn tại</h1>
            <p class="error-404__desc">Xin lỗi, trang bạn đang tìm kiếm có thể đã bị xóa hoặc không tồn tại.</p>

            <div class="error-404__actions">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="error-404__btn error-404__btn--primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                        <polyline points="9 22 9 12 15 12 15 22" />
                    </svg>
                    Về trang chủ
                </a>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>