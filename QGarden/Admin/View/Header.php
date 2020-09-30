<?php
/** Check Access **/
if (!defined('QGAccessGrained')) {header("HTTP/2 404 Not Found"); exit();}

?>

<!DOCTYPE html>
<!--suppress ALL -->
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../Themes/CSS/Style.css" rel="stylesheet" type="text/css">
    <link href="../Themes/JS/SweetAlert/SweetAlert2.css" rel="stylesheet" type="text/css">
    <!-- Module JS -->
    <script src="../Themes/JS/JQuery.js"></script>
    <script src="JS/TinyMCE/TinyMCE.js"></script>
    <script src="../Themes/JS/Materialize.js"></script>
    <script src="../Themes/JS/SweetAlert/SweetAlert2.js"></script>
    <!-- Custom JS -->
    <script>
        let NotAdmin = false;
    </script>
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
                    <a href="<?=$PublicConfig::WebDocumentRoot;?>?QGPage=Users"><?=$_SESSION['UserName']?></a>
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
                <a href="<?=$PublicConfig::WebDocumentRoot;?>/Admin?Admin=Dashboard">Tổng Quan</a>
            </li>
            <li>
                <a href="<?=$PublicConfig::WebDocumentRoot;?>/Admin?Admin=Products">Sản Phẩm</a>
            </li>
            <li>
                <a href="<?=$PublicConfig::WebDocumentRoot;?>/Admin?Admin=Category">Danh Mục</a>
            </li>
            <li style="min-width: 100px">
                <a href="<?=$PublicConfig::WebDocumentRoot;?>/Admin?Admin=Users">Người Dùng</a>
            </li>
            <li class="menu-has-submenu">
                <a href="<?=$PublicConfig::WebDocumentRoot;?>/Admin?Admin=Coupons">Mở Rộng</a>
                <ul style="line-height: 0.5;">
                    <li style="line-height: normal;">
                        <a href="<?=$PublicConfig::WebDocumentRoot;?>/Admin?Admin=Banner">Banner Quảng Bá</a>
                    </li>
                    <li style="line-height: normal;">
                        <a href="<?=$PublicConfig::WebDocumentRoot;?>/Admin?Admin=Coupons">Mã Giảm Giá</a>
                    </li>
                    <li style="line-height: normal;">
                        <a href="<?=$PublicConfig::WebDocumentRoot;?>/Admin?Admin=Bills">Hóa Đơn</a>
                    </li>
                    <li style="line-height: normal;">
                        <a href="<?=$PublicConfig::WebDocumentRoot;?>/Admin?Admin=News">Tin Tức</a>
                    </li>
                    <li style="line-height: normal;">
                        <a href="<?=$PublicConfig::WebDocumentRoot;?>/Admin?Admin=Contact">Liên Hệ Đã Nhận</a>
                    </li>
                    <li style="line-height: normal;">
                        <a href="<?=$PublicConfig::WebDocumentRoot;?>/Admin?Admin=Mail">Marketing Mail</a>
                    </li>
                    <li style="line-height: normal;">
                        <a href="<?=$PublicConfig::WebDocumentRoot;?>/Admin?Admin=SiteInfo">Thông Tin Website</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>
