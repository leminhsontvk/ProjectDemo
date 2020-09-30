<?php
/** Check Access **/
if (!defined('QGAccessGrained')) {header("HTTP/2 404 Not Found"); exit();}

?>

<div class="container">
    <section class="QGContact margin-top-40">
        <div class="contact-container">
            <div class="contact-form-content">
                <h3 class="contact-page-title">Hãy nói, chúng tôi đang nghe bạn</h3>
                <div class="contact-form">
                    <form id="contact-form" action="assets/php/mail.php" method="post">
                        <div class="form-group">
                            <label>Tên Của Bạn <span class="required">*</span></label>
                            <input type="text" name="customerName" id="customername" required="">
                        </div>
                        <div class="form-group">
                            <label>Địa Chỉ Mail <span class="required">*</span></label>
                            <input type="email" name="customerEmail" id="customerEmail" required="">
                        </div>
                        <div class="form-group">
                            <label>Tiêu Đề<span class="required">*</span></label>
                            <input type="text" name="contactSubject" id="contactSubject">
                        </div>
                        <div class="form-group">
                            <label>Nội Dung<span class="required">*</span></label>
                            <textarea name="contactMessage" id="contactMessage"></textarea>
                        </div>
                        <div class="form-group">
                            <button type="button" value="submit" id="ContactSubmit" class="theme-button contact-button" name="submit">Gửi</button>
                        </div>
                    </form>
                </div>
                <p class="form-messege"></p>
            </div>
        </div>
        <div class="contact-container">
            <div class="contact-page-content">
                <h3 class="contact-page-title">Về Chúng Tôi</h3>
                <p class="contact-page-message">
                    <?=$SiteInfo['About']?>
                </p>
                <div class="single-contact-block">
                    <h4>
                        <i class="fa fa-fax"></i> Địa Chỉ
                    </h4>
                    <p>
                        <?=$SiteInfo['ContactAddress']?>
                    </p>
                </div>
                <div class="single-contact-block">
                    <h4>
                        <i class="fa fa-phone"></i> Liên Hệ
                    </h4>
                    <p>
                        Mobile: <?=$SiteInfo['ContactPhoneLine']?>
                    </p>
                    <p>
                        Hotline: <?=$SiteInfo['CustomerCareLine']?>
                    </p>
                </div>
                <div class="single-contact-block">
                    <h4>
                        <i class="fal fa-envelope"></i> Email
                    </h4>
                    <p>
                        <?=$SiteInfo['ContactMail']?>
                    </p>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </section>
    <div class="clearfix"></div>
</div>