<?php
/** Check Access **/
if (!defined('QGAccessGrained')) {header("HTTP/2 404 Not Found"); exit();}

$BannerList = (new \Core\Database()) -> QSelect("SELECT * FROM Banner WHERE BannerStatus != 0 GROUP BY BannerID");

?>

<div class="container">
    <section class="Banner margin-bottom-40">
        <div class="slider">
            <ul class="slides">
                <?php
                $Break = 0;
                foreach ($BannerList as $CurrentKey => $Banner)
                {
                    if ($Break == 3) break;
                    echo
                    '
                    <li>
                        <img src="'.$PublicConfig::WebImagesRoot.$Banner['BannerImage'].'"> <!-- random image -->
                        <div class="caption center-align">
                        </div>
                    </li>
                    ';
                    $Break++;
                }
                ?>
            </ul>
        </div>
    </section>
    <section class="Mini-Banner margin-bottom-40">
        <div class="mini-left">
            <a href="#">
                <img src="Themes/Images/Banner/BannerM1.jpg">
            </a>
            <div class="mini-info">
                <p class="title-light">
                    Sản phẩm mới nhập
                </p>
                <p class="title-bold">
                    Xương Rồng Mini
                </p>
                <p class="price">
                    Chỉ Từ
                    <span class="price-amount">
                        VNĐ 500.000
                    </span>
                </p>
            </div>
        </div>
        <div class="mini-right">
            <a href="#">
                <img src="Themes/Images/Banner/BannerM2.jpg">
            </a>
            <div class="mini-info">
                <p class="title-light">
                    Sản phẩm mới nhập
                </p>
                <p class="title-bold">
                    Xương Rồng Mini
                </p>
                <p class="price">
                    Chỉ Từ
                    <span class="price-amount">
                        VNĐ 500.000
                    </span>
                </p>
            </div>
        </div>
        <div class="clearfix"></div>
    </section>
    <div class="clearfix"></div>
    <section class="QGFlash-Sale margin-bottom-20">
        <div class="title margin-bottom-20">
            <h2>
                Sản phẩm mới
            </h2>
        </div>
        <?php
        $LoopCount = 0;

        foreach ($ProductList as $Product)
        {
            if ($LoopCount == 4) break;
            $Loop = 1;
            $LoopCount++;
            $RateStar = '';
            $DiscountSpan = '';
            $DiscountPriceSpan = '';
            $CurrentPrice = $Product['ProductPrice'];
            $ImageList = json_decode($Product['ProductImageList']);

            while ($Loop <= 5)
            {
                if ($Loop <= (int) $Product['ProductRateAvg'])
                {
                    $RateStar .= '<i class="fas fa-star fill"></i>';
                } else $RateStar .= '<i class="fas fa-star"></i>';

                $Loop++;
            }

            if ($Product['ProductDiscount'] != 0)
            {
                $DiscountSpan = '<span class="discount-label">-'.($Product['ProductDiscount']).'%</span>';

                $CurrentPrice = $CurrentPrice - (($Product['ProductDiscount'] / 100) * $Product['ProductPrice']);

                $DiscountPriceSpan = '<span class="price-before-sale">VNĐ '.number_format($Product['ProductPrice']).'</span>';
            }

            echo
                '
                <div class="product-container" qgid="'.$Product['ProductID'].'">
                <div class="product-img">
                    '.$DiscountSpan.'
                    <img id="img1" src="'.$PublicConfig::WebImagesRoot.$ImageList['0'].'" style="z-index: 1">
                    <img id="img2" src="'.$PublicConfig::WebImagesRoot.$ImageList['1'].'" style="z-index: 2">
                    <span class="sale"></span>
                    <div class="product-icon-hover">
                        <div class="icon-position">
                            <ul>
                                <li>
                                    <a href="#">
                                        <i class="far fa-eye"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fal fa-heart"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fal fa-shopping-cart"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="product-detail">
                    <div class="detail-title">
                        '.$Product['ProductName'].'
                    </div>
                    <div class="detail-rated-star">
                        '.$RateStar.'
                    </div>
                    <div class="detail-price">
                        <span class="price-amount-mini">VNĐ '.number_format($CurrentPrice).'</span>
                        '.$DiscountPriceSpan.'
                    </div>
                    <div class="add-cart-icon">
                        <a href="#">
                            <i class="far fa-shopping-cart"></i>
                        </a>
                    </div>
                </div>
            </div>
            ';
        }
        ?>
        <div class="clearfix"></div>
    </section>
    <section class="QGBig-Banner margin-bottom-40">
        <div class="banner-content">
            <div class="full-content">
                <h5>special offer</h5>
                <h4>SUCCULENT GARDEN</h4>
                <h3>GIFT BOXES</h3>
                <p>
                    From planter materials to style options, discover which planter is best for your space.
                </p>
                <a href="#" class="button-link">Explore The Shop</a>
            </div>
        </div>
        <div class="banner-link">
            <a href="#">
                <img src="Themes/Images/Banner/BannerBIG1.jpg">
            </a>
        </div>
    </section>
    <section class="QGNewProduct margin-bottom-20">
        <div class="title margin-bottom-20">
            <h2>
                Sản phẩm giảm giá
            </h2>
        </div>
        <div class="new-product-banner">
            <a href="#"><img src="Themes/Images/Banner/BannerNewProduct.jpg"></a>
        </div>
        <div class="new-product">
            <?php
            $LoopCount = 0;

            foreach ((new \Model\Products()) -> GetDiscountProduct() as $Product)
            {
                if ($Product['ProductDiscount'] != 0)
                {
                    if ($LoopCount == 6) break;
                    $Loop = 1;
                    $LoopCount++;
                    $RateStar = '';
                    $DiscountSpan = '';
                    $DiscountPriceSpan = '';
                    $CurrentPrice = $Product['ProductPrice'];
                    $ImageList = json_decode($Product['ProductImageList']);

                    while ($Loop <= 5)
                    {
                        if ($Loop <= (int) $Product['ProductRateAvg'])
                        {
                            $RateStar .= '<i class="fas fa-star fill"></i>';
                        } else $RateStar .= '<i class="fas fa-star"></i>';

                        $Loop++;
                    }

                    $DiscountSpan = '<span class="discount-label">-'.($Product['ProductDiscount']).'%</span>';

                    $CurrentPrice = $CurrentPrice - (($Product['ProductDiscount'] / 100) * $Product['ProductPrice']);

                    $DiscountPriceSpan = '<span class="price-before-sale">VNĐ '.number_format($Product['ProductPrice']).'</span>';

                    echo
                        '
                    <div class="product-container" qgid="'.$Product['ProductID'].'">
                        <div class="product-img">
                            '.$DiscountSpan.'
                            <img id="img1" src="'.$PublicConfig::WebImagesRoot.$ImageList['0'].'" style="z-index: 1">
                            <img id="img2" src="'.$PublicConfig::WebImagesRoot.$ImageList['1'].'" style="z-index: 2">
                            <span class="sale"></span>
                            <div class="product-icon-hover">
                                <div class="icon-position">
                                    <ul>
                                        <li>
                                            <a href="#">
                                                <i class="far fa-eye"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fal fa-heart"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fal fa-shopping-cart"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="product-detail">
                            <div class="detail-title">
                                '.$Product['ProductName'].'
                            </div>
                            <div class="detail-rated-star">
                                '.$RateStar.'
                            </div>
                            <div class="detail-price">
                                <span class="price-amount-mini">VNĐ '.number_format($CurrentPrice).'</span>
                                '.$DiscountPriceSpan.'
                            </div>
                            <div class="add-cart-icon">
                                <a href="#">
                                    <i class="far fa-shopping-cart"></i>
                                </a>
                            </div>
                        </div>
                    </div>
            ';
                }
            }
            ?>
        </div>
        <div class="clearfix"></div>
    </section>
    <section class="QGCategory margin-bottom-40">
        <div class="title margin-bottom-20">
            <h2>
                Danh mục sản phẩm
            </h2>
        </div>
        <?php
        foreach ($CategoryList as $CategoryKey => $Category)
        {
            if ($CategoryKey === $PublicConfig::CategoryHomeCount) break;
            echo
            '
            <div class="product-container">
                <div class="product-img no-hover">
                    <img id="img1" src="'.$PublicConfig::WebImagesRoot.$Category['CategoryDefaultImage'].'">
                    <div class="category-img-info">
                        <h5 class="category-title">
                            <a href="#">'.$Category['CategoryName'].'</a>
                        </h5>
                        <p class="quantity">'.$Category['CategoryTotalProduct'].' sản phẩm</p>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            ';
        }
        ?>
        <div class="clearfix"></div>
    </section>
    <section class="QGNews padding-bottom-20 border-bottom">
        <div class="title margin-bottom-20">
            <h2>
                Tin tức
            </h2>
        </div>
        <?php
        $Loop = 0;
        foreach ($NewsList as $CurrentKey => $NewsCard)
        {
            if ($CurrentKey == 3) break;
            echo
            '
            <div class="news-container">
                <div class="news-img">
                    <a href="?QGPage=Read&News='.$NewsCard['NewsID'].'">
                        <img src="'.$PublicConfig::WebImagesRoot.$NewsCard['NewsDefaultImage'].'">
                    </a>
                </div>
                <div class="news-info">
                    <h3 class="post-title">
                        <a href="?QGPage=Read&News='.$NewsCard['NewsID'].'">'.$NewsCard['NewsTitle'].'</a>
                    </h3>
                    <div class="post-meta">
                        <p class="author-name">by <span>'.$NewsCard['UserName'].'</span></p>
                        <p class="post-date">'.gmdate('j F, Y', $NewsCard['NewsCreateDate']).'</p>
                    </div>
                </div>
            </div>
            ';
        }
        ?>
        <div class="clearfix"></div>
    </section>
    <section class="QGSubscribe margin-top-40 padding-bottom-20">
        <div class="sub-container">
            <div class="sub-info">
                <h5>Nhận những thông tin khuyến mãi mới nhất từ chúng tôi.?</h5>
                <p>Email của bạn sẽ không được chia sẻ với bên thứ 3.</p>
            </div>
            <div class="sub-form">
                <form class="flex-box">
                    <input style="width: 81.2%; border-radius: 5px!important; margin-bottom: 5px!important;" type="email" placeholder="Địa chỉ mail..." name="Mail">
                    <input type="text" placeholder="Tên của bạn..." name="Name">
                    <button type="submit">Subscribe</button>
                </form>
            </div>
            <div class="clearfix"></div>
        </div>
    </section>
</div>