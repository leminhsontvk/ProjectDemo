<!DOCTYPE html>
<!--suppress ALL -->
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../Themes/CSS/Style.css" rel="stylesheet" type="text/css">
    <!-- Module JS -->
    <script src="../Themes/JS/JQuery.js"></script>
    <script src="../Themes/JS/Materialize.js"></script>
    <!-- Custom JS -->
    <script src="../Themes/JS/QGarden.js"></script>
    <script src="QGarden/Admin.js"></script>
    <title>QGarden - The Admin</title>
</head>
<body>
<header>
    <div class="container">
        <div class="qgarden-header-top padding-bottom-10 padding-top-10">
            <div class="flex-box align-items-center">
                <div class="social-icons">
                </div>
                <div class="user-account">
                    <a href="#">Đăng Nhập hoặc Đăng Ký</a>
                </div>
            </div>
        </div>
        <div class="qgarden-search-box padding-bottom-25 padding-top-25">
            <div style="justify-content: flex-start;" class="flex-box align-items-center">
                <div class="logo">
                    <a href="#">
                        <img src="../Themes/Images/Default/Logo.png" width="140px" height="40px">
                    </a>
                </div>
            </div>
        </div>
    </div>
</header>
<div class="nav-box">
    <div class="container">
        <ul>
            <li>
                <a href="index.html">Dashboard</a>
            </li>
            <li>
                <a href="index.html">Products</a>
            </li>
            <li>
                <a href="index.html">Category</a>
            </li>
            <li>
                <a href="index.html">Users</a>
            </li>
            <li>
                <a href="index.html">Coupons</a>
            </li>
            <li>
                <a href="index.html">Bills</a>
            </li>
            <li>
                <a href="index.html">Marketing</a>
            </li>
            <li>
                <a href="index.html">SiteInfo</a>
            </li>
        </ul>
    </div>
</div>
<div class="container">
    <div class="title margin-top-40 margin-bottom-20">
        <h2>
            Thông tin website.
        </h2>
    </div>
    <div class="site-info">
        <h3 class="contact-page-title">Về Chúng Tôi</h3>
        <p class="contact-page-message">Chúng tôi mang đến cho bạn một không gian xanh mát, sáng tạo. Một không gian không còn ồn ào, bụi bặm, stress và rời xa những lo toan của cuộc sống. QGarden - Mang màu xanh đồng hành cùng bạn.</p>
        <div class="single-contact-block">
            <h4>
                <i class="fa fa-fax"></i> Địa Chỉ
            </h4>
            <p>The Luxury, Vinhomes Golden River</p>
        </div>
        <div class="single-contact-block">
            <h4>
                <i class="fa fa-phone"></i> Liên Hệ
            </h4>
            <p>Mobile: (08) 2010 1408</p>
            <p>Hotline: 1800 2010 148</p>
        </div>
        <div class="single-contact-block">
            <h4>
                <i class="fal fa-envelope"></i> Email
            </h4>
            <p>support.qgarden@lmsq.vn</p>
        </div>
        <div class="single-contact-block">
            <button type="button" value="submit" id="EditSiteInfo" class="theme-button contact-button" name="submit">Gửi</button>
        </div>
    </div>
    <footer style="min-height: unset" class="margin-top-20 padding-top-20">
        <div class="clearfix"></div>
        <div class="copyright">
            <p>Copyright © <span id="Year"></span> <a href="#">QGarden - LMSQ Group</a>. All Right Reserved.</p>
        </div>
    </footer>
</div>
</body>
</html>