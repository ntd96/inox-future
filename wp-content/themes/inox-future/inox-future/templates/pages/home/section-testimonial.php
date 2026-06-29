<?php
/**
 * Section: Đối tác & Khách hàng — INOX FUTURE
 */
$partners = [
  'Samsung', 'Hyundai', 'Foxconn', 'LG Electronics', 'Canon', 'Brother',
];
?>

<section style="padding:3.5rem 1rem;background:#fff;border-top:1px solid #f1f5f9;">
  <div style="max-width:1280px;margin:0 auto;">
    <p style="text-align:center;font-size:12px;font-weight:600;color:#94a3b8;text-transform:uppercase;letter-spacing:0.12em;margin-bottom:2rem;">Được tin dùng bởi các doanh nghiệp hàng đầu</p>
    <div style="display:flex;flex-wrap:wrap;align-items:center;justify-content:center;gap:2rem 3rem;">
      <?php foreach ($partners as $p) : ?>
        <span style="font-size:16px;font-weight:700;color:#94a3b8;letter-spacing:0.05em;"><?php echo esc_html($p); ?></span>
      <?php endforeach; ?>
    </div>
  </div>
</section>
