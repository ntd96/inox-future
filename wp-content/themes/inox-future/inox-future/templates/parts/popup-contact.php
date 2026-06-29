<?php /* templates/parts/popup-contact.php */ ?>

<div class="contact-overlay" id="contactModal">
    <div class="contact-box">

        <!-- Header -->
        <div class="contact-header">
            <div>
                <h3 class="contact-title">Liên hệ báo giá</h3>
                <p class="contact-desc">Chọn kênh liên hệ phù hợp với bạn</p>
            </div>
            <button class="contact-close" id="contactModalClose" aria-label="Đóng">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        <!-- Channels -->
        <div class="contact-body">

            <a href="tel:02873039996" class="contact-item">
                <div class="contact-icon contact-icon--red">
                    <i class="fa-solid fa-phone"></i>
                </div>
                <div class="contact-item-text">
                    <p class="contact-item-name">Gọi điện thoại</p>
                    <p class="contact-item-sub">(028) 7303 9996</p>
                </div>
                <i class="fa-solid fa-chevron-right contact-item-arrow"></i>
            </a>

            <a href="mailto:inoxfuture1218@gmail.com" class="contact-item">
                <div class="contact-icon contact-icon--amber">
                    <i class="fa-solid fa-envelope"></i>
                </div>
                <div class="contact-item-text">
                    <p class="contact-item-name">Gửi email</p>
                    <p class="contact-item-sub">inoxfuture1218@gmail.com</p>
                </div>
                <i class="fa-solid fa-chevron-right contact-item-arrow"></i>
            </a>

            <a href="#" rel="nofollow" class="contact-item">
                <div class="contact-icon contact-icon--blue">
                    <i class="fa-brands fa-facebook-messenger"></i>
                </div>
                <div class="contact-item-text">
                    <p class="contact-item-name">Facebook Messenger</p>
                    <p class="contact-item-sub">Nhắn tin trực tiếp qua Fanpage</p>
                </div>
                <i class="fa-solid fa-chevron-right contact-item-arrow"></i>
            </a>

            <a href="#" rel="nofollow" class="contact-item">
                <div class="contact-icon contact-icon--sky">
                    <i class="fa-solid fa-comment-dots"></i>
                </div>
                <div class="contact-item-text">
                    <p class="contact-item-name">Zalo</p>
                    <p class="contact-item-sub">Kết nối qua Zalo để được tư vấn nhanh</p>
                </div>
                <i class="fa-solid fa-chevron-right contact-item-arrow"></i>
            </a>

            <!-- Working hours -->
            <div class="contact-hours">
                <i class="fa-regular fa-clock"></i>
                <span>Giờ làm việc: Thứ 2 - Thứ 7, 8:00 - 17:30</span>
            </div>

        </div>

    </div>
</div>