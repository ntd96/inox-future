<?php
$team  = get_field('team');
$badge = $team['badge'] ?? 'Đội Ngũ';
$title = $team['title'] ?? 'Những Người Đứng Sau INOX FUTURE';
$lists = $team['lists'] ?? [
    [
        'avatar' => 'https://readdy.ai/api/search-image?query=professional%20Vietnamese%20male%20entrepreneur%20crypto%20expert%20portrait%2C%20confident%20smile%2C%20modern%20office%20background%2C%20business%20casual%20attire%2C%20warm%20lighting%2C%20high%20quality%20professional%20headshot&width=300&height=300&seq=team1&orientation=squarish',
        'name'   => 'John Vu',
        'role'   => 'Founder & CEO',
        'bio'    => '10+ năm kinh nghiệm đầu tư crypto và tài chính quốc tế.',
    ],
    [
        'avatar' => 'https://readdy.ai/api/search-image?query=professional%20Vietnamese%20male%20business%20development%20manager&width=300&height=300',
        'name'   => 'Minh Tran',
        'role'   => 'Head of Partnerships',
        'bio'    => 'Chuyên gia quan hệ đối tác với 15+ sàn giao dịch hàng đầu.',
    ],
    [
        'avatar' => 'https://readdy.ai/api/search-image?query=professional%20Vietnamese%20female%20community%20manager&width=300&height=300',
        'name'   => 'Linh Nguyen',
        'role'   => 'Community Manager',
        'bio'    => 'Quản lý cộng đồng 50,000+ nhà đầu tư trên Telegram và Zalo.',
    ],
];
?>

<section class="section section--light team">
    <div class="container">

        <div class="section-header">
            <span class="section-header__eyebrow"><?php echo esc_html($badge); ?></span>
            <h2 class="section-header__title"><?php echo esc_html($title); ?></h2>
        </div>

        <div class="team__grid">
            <?php foreach ($lists as $member) :
                $avatar = $member['avatar'] ?? '';
                $name   = $member['name']   ?? '';
                $role   = $member['role']   ?? '';
                $bio    = $member['bio']    ?? '';
            ?>
                <div class="team__card card">

                    <div class="team__avatar">
                        <img src="<?php echo esc_url($avatar ?: 'https://readdy.ai/api/search-image?query=professional%20Vietnamese%20male%20entrepreneur%20crypto%20expert%20portrait%2C%20confident%20smile%2C%20modern%20office%20background%2C%20business%20casual%20attire%2C%20warm%20lighting%2C%20high%20quality%20professional%20headshot&width=300&height=300&seq=team1&orientation=squarish' ); ?>" alt="<?php echo esc_attr($name); ?>">
                    </div>

                    <h3 class="team__name"><?php echo esc_html($name); ?></h3>
                    <p class="team__role"><?php echo esc_html($role); ?></p>
                    <p class="team__bio"><?php echo esc_html($bio); ?></p>
                </div>
            <?php endforeach; ?>
        </div>

    </div>
</section>