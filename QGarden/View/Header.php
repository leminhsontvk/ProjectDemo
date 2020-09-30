<?php
ob_clean();
ob_start();
/** Check Access **/
if (!defined('QGAccessGrained')) {header("HTTP/2 404 Not Found"); exit();}

if ($_SESSION['Cart']) $CartQTY = count(json_decode($_SESSION['Cart'], true)['CartList']); else $CartQTY = 0;

?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="Themes/CSS/Style.css" rel="stylesheet" type="text/css">
    <link href="Themes/JS/SweetAlert/SweetAlert2.css">
    <!-- Module JS -->
    <script src="Themes/JS/JQuery.js"></script>
    <script src="Themes/JS/Materialize.js"></script>
    <script src="Themes/JS/SweetAlert/SweetAlert2.js"></script>
    <!-- Custom JS -->
    <script src="Themes/JS/QGarden.js"></script>
    <script src="Themes/JS/Module/Login.js"></script>
    <script src="Themes/JS/Module/UserDetail.js"></script>
    <script>
        let NotAdmin = true;
    </script>
    <title><?=$SiteInfo['SiteName']?></title>
</head>
<body>
<header>
    <div class="container">
        <div class="qgarden-header-top padding-bottom-10 padding-top-10">
            <div class="flex-box align-items-center">
                <div class="social-icons">
                    <ul class="social-icons-small">
                        <li>
                            <span class="follow-us-text">Theo dõi chúng tôi:</span>
                        </li>
                        <li>
                            <a href="<?=$SiteInfo['FacebookSocial']?>" target="_blank">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                        </li>
                        <li>
                            <a href="<?=$SiteInfo['IGSocial']?>" target="_blank">
                                <i class="fab fa-instagram"></i>
                            </a>
                        </li>
                        <li>
                            <a href="mailto:<?=$SiteInfo['ContactMail']?>" target="_blank">
                                <i class="fab fa-google-plus-g"></i>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="user-account">
                    <?php
                    if ($_SESSION['Logged'] === 1) echo'<a href="?QGPage=User">'.$_SESSION['UserName'].'</a>'; else echo '<a href="?QGPage=Login">Đăng Nhập hoặc Đăng Ký</a>';
                    ?>
                </div>
            </div>
        </div>
        <div class="qgarden-search-box padding-bottom-25 padding-top-25">
            <div class="flex-box align-items-center">
                <div class="logo">
                    <a href="?QGPage=Home">
                        <img src="Themes/Images/Default/Logo.png" width="140px" height="40px">
                    </a>
                </div>
                <div class="search-box align-items-center">
                    <form method="POST" action="?QGPage=Products" class="flex-box">
                        <input type="hidden" name="Search" value="1">
                        <input type="text" name="SearchKey" placeholder="Bạn tìm gì...">
                        <button type="submit">
                            <i class="far fa-search"></i>
                        </button>
                    </form>
                </div>
                <div class="cart-container align-items-center">
                    <div class="cart-box">
                        <a href="?QGPage=Cart">
                            <i class="far fa-shopping-cart"></i>
                            <span id="CartHeaderQTY" value="<?=$CartQTY;?>"><?=$CartQTY;?></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<div class="nav-box">
    <div class="container">
        <ul>
            <li id="QGHome">
                <a href="?QGPage=Home">Trang Chủ</a>
            </li>
            <li id="QGProducts" class="menu-has-submenu">
                <a href="?QGPage=Products">Sản Phẩm</a>
                <ul>
                    <?php
                    foreach ($CategoryList as $Category)
                    {
                        echo '<li><a href="?QGPage=Products&Category='.$Category['CategoryID'].'">'.$Category['CategoryName'].'</a></li>';
                    }
                    ?>
                </ul>
            </li>
            <li id="QGNews">
                <a href="?QGPage=News">Tin Tức</a>
            </li>
            <li id="QGContact">
                <a href="?QGPage=Contact">Liên Hệ</a>
            </li>
        </ul>
    </div>
</div>