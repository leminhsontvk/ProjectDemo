<?php
/** Check Access **/
if (!defined('QGAccessGrained')) {header("HTTP/2 404 Not Found"); exit();}

?>

    <div class="container">
        <footer class="margin-top-20 padding-top-20 border-top">
            <div class="footer-widget">
                <div class="footer-logo">
                    <img src="<?=$PublicConfig::WebImagesRoot?>/Default/LogoFooter.png" width="140px" height="40px">
                </div>
                <div class="footer-address">
                    <h5 class="footer-block-title">Trụ Sở Tập Đoàn</h5>
                    <p class="footer-block-content"><?=$SiteInfo['ContactAddress']?></p>
                </div>
                <div class="footer-phone">
                    <h5 class="footer-block-title">Cần Trợ Giúp?</h5>
                    <p class="footer-block-content">Vui lòng gọi: <?=$SiteInfo['CustomerCareLine']?></p>
                </div>
                <div class="footer-icon">
                    <ul>
                        <li>
                            <a class="icon-fb" href="#">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                        </li>
                        <li>
                            <a class="icon-ig" href="#">
                                <i class="fab fa-instagram"></i>
                            </a>
                        </li>
                        <li>
                            <a class="icon-yt" href="#">
                                <i class="fab fa-youtube"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="footer-widget">
                <h4 class="footer-widget-title">
                    <a href="#">Một Vài Hình Ảnh...</a>
                </h4>
                <div class="ig-image-container">
                    <a href="">
                        <img src="<?=$PublicConfig::WebImagesRoot?>/Footer/IG1.jpg">
                    </a>
                    <a href="">
                        <img src="<?=$PublicConfig::WebImagesRoot?>/Footer/IG2.jpg">
                    </a>
                    <a href="">
                        <img src="<?=$PublicConfig::WebImagesRoot?>/Footer/IG3.jpg">
                    </a>
                    <a href="">
                        <img src="<?=$PublicConfig::WebImagesRoot?>/Footer/IG4.jpg">
                    </a>
                    <a href="">
                        <img src="<?=$PublicConfig::WebImagesRoot?>/Footer/IG5.jpg">
                    </a>
                    <a href="">
                        <img src="<?=$PublicConfig::WebImagesRoot?>/Footer/IG9.jpg">
                    </a>
                    <a href="">
                        <img src="<?=$PublicConfig::WebImagesRoot?>/Footer/IG7.jpg">
                    </a>
                    <a href="">
                        <img src="<?=$PublicConfig::WebImagesRoot?>/Footer/IG8.jpg">
                    </a>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="footer-widget">
                <h4 class="footer-widget-title">
                    <a href="#">Danh Mục Sản Phẩm</a>
                </h4>
                <div class="footer-nav">
                    <ul>
                        <?php
                        foreach ($CategoryList as $Category)
                        {
                            echo '<li><a href="?QGPage=Products&Category='.$Category['CategoryID'].'">'.$Category['CategoryName'].'</a></li>';
                        }
                        ?>
                    </ul>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="copyright">
                <p>Copyright © <span id="Year"></span> <a href="#">QGarden - LMSQ Group</a>. All Right Reserved.</p>
            </div>
        </footer>
    </div>
</body>
</html>