<!-- ============================================
     INOX FUTURE — Section: Danh mục sản phẩm
     ============================================ -->
<section id="products">
  <div class="products-inner">

    <!-- Header -->
    <div class="products-header">
      <div class="section-label">
        <span class="label-bar"></span>
        <span class="label-text">Sản phẩm</span>
      </div>
      <h2 class="products-title">Danh mục sản phẩm</h2>
      <p class="products-desc">
        INOX TƯƠNG LAI cung cấp đầy đủ các sản phẩm sắt, thép chất lượng cao, đáp ứng tiêu chuẩn ngành công nghiệp hiện đại và phù hợp với nhiều lĩnh vực sản xuất.
      </p>
    </div>

    <!-- Body: Sidebar + Grid -->
    <div class="products-body">

      <!-- Form ẩn cho AJAX filter -->
      <form id="form-filter-steel" style="display:none;">
        <input type="hidden" name="cats[]" value="0" />
        <input type="hidden" name="search_posts" value="" />
      </form>
      <!-- Sidebar -->
      <aside class="products-sidebar">
        <div class="sidebar-inner">

          <!-- Search -->
          <div class="sidebar-search">
            <i class="fa-solid fa-magnifying-glass search-icon"></i>
            <input type="text" placeholder="Tìm sản phẩm..." class="search-input" />
          </div>

          <!-- Categories -->
          <?php
          $terms = get_terms([
            'taxonomy'   => 'categories_steel',
            'hide_empty' => true,
          ]);
          ?>
          <h3 class="sidebar-cat-label">Danh mục</h3>
          <div class="sidebar-cats">
            <button class="cat-btn cat-btn--active" data-category="all" data-id="0">
              <span>Tất cả</span>
              <i class="fa-solid fa-check"></i>
            </button>
            <?php
            $terms = get_terms([
              'taxonomy'   => 'categories_steel',
              'hide_empty' => false,
            ]);
            if (! empty($terms) && ! is_wp_error($terms)) :
              foreach ($terms as $term) : ?>
                <button class="cat-btn"
                  data-category="<?php echo esc_attr($term->slug); ?>"
                  data-id="<?php echo esc_attr($term->term_id); ?>">
                  <?php echo esc_html($term->name); ?>
                </button>
            <?php endforeach;
            endif; ?>
          </div>

          <!-- Count -->
          <div class="sidebar-count">
            <p>Hiển thị <span class="count-num"></span> sản phẩm</p>
          </div>
        </div>
      </aside>

      <!-- Product grid -->
      <div class="products-grid-wrap">
        <div class="products-grid">

        </div><!-- /.products-grid -->

        <!-- Pagination -->
        <div class="pagination" id=pagination>
          <!-- <button class="page-btn page-btn--nav" disabled>
            <i class="fa-solid fa-chevron-left"></i>
          </button>
          <button class="page-btn page-btn--active">1</button>
          <button class="page-btn">2</button>
          <button class="page-btn page-btn--nav">
            <i class="fa-solid fa-chevron-right"></i>
          </button> -->
        </div>

      </div><!-- /.products-grid-wrap -->
    </div><!-- /.products-body -->
  </div><!-- /.products-inner -->
</section>


<?php get_template_part('templates/parts/popup-single-steel'); ?>
<?php get_template_part('templates/parts/popup-contact'); ?>