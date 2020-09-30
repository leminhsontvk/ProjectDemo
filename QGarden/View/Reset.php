<?php
/** Check Access **/
if (!defined('QGAccessGrained')) {header("HTTP/2 404 Not Found"); exit();}

?>

<div class="container">
    <section class="QGLogin margin-bottom-40">
        <div class="title margin-top-40 margin-bottom-20">
            <h2>
                Khôi Phục Lại Mật Khẩu
            </h2>
        </div>
        <div class="login-container margin-bottom-40">
            <form style="float: unset; margin: 0 auto!important;" id="DoCheckForm" class="login-form">
                <h4 id="ToScroll" class="login-title">Quên Mật Khẩu</h4>
                <div class="form-full-box margin-bottom-20">
                    <label for="EmailOrLogin">Email hoặc tên đăng nhập</label>
                    <input id="EmailOrLogin" type="text" placeholder="Email hoặc tên đăng nhập" name="Login" required>
                </div>
                <div class="form-full-box">
                    <button id="CheckReset" type="button" class="checkout-btn no-float">Xác Nhận</button>
                </div>
                <div class="clearfix"></div>
            </form>
            <div class="clearfix"></div>
            <form style="display: none; float: unset; margin: 0 auto!important;" id="DoResetForm" class="login-form">
                <h4 id="ToScroll" class="login-title">Quên Mật Khẩu</h4>
                <div class="form-full-box margin-bottom-20">
                    <label for="ResetToken">Mã Khôi Phục</label>
                    <input id="ResetToken" type="text" placeholder="Mã khôi phục" name="Login" required>
                </div>
                <div class="form-full-box margin-bottom-20">
                    <label for="ResetPass">Mật Khẩu</label>
                    <input id="ResetPass" type="password" placeholder="Mật Khẩu" name="Login" required>
                </div>
                <div class="form-full-box margin-bottom-20">
                    <label for="ConfirmResetPass">Xác Nhận Lại Mật Khẩu</label>
                    <input id="ConfirmResetPass" type="password" placeholder="Xác nhận lại mật khẩu" name="Login" required>
                </div>
                <div class="form-full-box">
                    <button id="DoReset" type="button" class="checkout-btn no-float">Khôi Phục</button>
                </div>
                <div class="clearfix"></div>
            </form>
            <div class="clearfix"></div>
        </div>
    </section>
    <div class="clearfix"></div>
</div>