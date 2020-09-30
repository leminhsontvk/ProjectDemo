<?php
/** Check Access **/
if (!defined('QGAccessGrained')) {header("HTTP/2 404 Not Found"); exit();}

$ActiveHandler = new \Model\User();

if ($ActiveHandler -> Active($_GET['UserID'], $_GET['Token']) === true)
{
    $ActiveStatus = "Kích hoạt tài khoản thành công";
} else $ActiveStatus = "Có lỗi xảy ra. Vui lòng liên hệ với chúng tôi";

?>

<div class="container">
    <section class="QGLogin margin-bottom-40">
        <div class="login-container">
            <div class="title margin-top-40 margin-bottom-20">
                <h2>
                    Kích Hoạt Tài Khoản
                </h2>
            </div>
            <h3 class="footer-nav"><?=$ActiveStatus?>, <a href="?QGPage=Home">Quay lại trang chủ.</a></h3>
        </div>
    </section>
    <div class="clearfix"></div>
</div>