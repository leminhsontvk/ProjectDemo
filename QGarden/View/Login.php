<?php
/** Check Access **/
if (!defined('QGAccessGrained')) {header("HTTP/2 404 Not Found"); exit();}

?>

<div class="container">
    <section class="QGLogin margin-bottom-40">
        <div class="login-container">
            <form class="login-form margin-top-40">
                <h4 id="ToScroll" class="login-title">Đăng nhập</h4>
                <div class="form-full-box margin-bottom-20">
                    <label for="EmailOrLogin">Email hoặc tên đăng nhập</label>
                    <input id="EmailOrLogin" type="text" placeholder="Email hoặc tên đăng nhập" name="Login" required>
                </div>
                <div class="form-full-box margin-bottom-20">
                    <label for="LoginPass">Mật khẩu</label>
                    <input id="LoginPass" type="password" name="Password" placeholder="Mật khẩu" required>
                </div>
                <div class="form-mid-box margin-bottom-20">
                    <div class="check-box">
                        <input type="checkbox" name="SavePortal" id="Remember">
                        <label for="Remember">Lưu đăng nhập</label>
                    </div>
                </div>

                <div class="form-mid-box no-mar form-mid-box-right">
                    <a class="link-full" href="?QGPage=Reset">Quên mật khẩu?</a>
                </div>

                <div class="form-full-box">
                    <button id="DoLogin" type="button" class="checkout-btn no-float">Đăng nhập</button>
                </div>
            </form>
            <form class="login-form margin-top-40">
                <h4 id="ToScroll" class="login-title">Đăng ký</h4>
                <div id="ErrorBox" class="alert alert-danger"></div>
                <div class="form-full-box margin-bottom-20">
                    <label for="Login">Tên đăng nhập*</label>
                    <input id="Login" type="email" name="UserLogin" placeholder="Tên đăng nhập">
                </div>
                <div class="form-full-box margin-bottom-20">
                    <label for="Mail">Địa chỉ mail*</label>
                    <input id="Mail" type="email" name="UserMail" placeholder="Địa chỉ mail">
                </div>
                <div class="form-full-box margin-bottom-20">
                    <label for="FullName">Họ và tên*</label>
                    <input id="FullName" type="text" name="UserName" placeholder="Tên của bạn">
                </div>
                <div class="form-full-box margin-bottom-20">
                    <label for="Phone">Số điện thoại*</label>
                    <input id="Phone" type="text" name="UserPhoneNumber" placeholder="Số điện thoại">
                </div>
                <div class="form-full-box margin-bottom-20">
                    <label for="Address">Địa chỉ</label>
                    <input id="Address" type="email" name="UserAddress" placeholder="Địa chỉ nhận hàng của bạn">
                </div>
                <div class="form-mid-box margin-bottom-20">
                    <label for="Pass">Mật khẩu*</label>
                    <input id="Pass" type="password" name="UserPassword" placeholder="Mật khẩu đăng nhập">
                </div>
                <div class="form-mid-box margin-bottom-20 no-mar form-mid-box-right">
                    <label for="RePass">Nhập lại mật khẩu*</label>
                    <input id="RePass" type="password" name="UserConfirmPassword" placeholder="Nhập lại mật khẩu">
                </div>
                <div class="form-full-box">
                    <button type="button" id="DoRegister" class="checkout-btn no-float">Register</button>
                </div>
            </form>
            <div class="clearfix"></div>
        </div>
    </section>
    <div class="clearfix"></div>
</div>