<?php
/** Check Access **/
if (!defined('QGAccessGrained')) {header("HTTP/2 404 Not Found"); exit();}

$Comments = new \Model\Comments();
$ProductInfo = $Product -> GetProduct($_GET['Product']);
$CommentsList = $Comments -> GetComment(1, $_GET['Product']);

$Loop = 1;
$DiscountSpan = '';
$Price = $ProductInfo['ProductPrice'];
$ProductImageList = json_decode($ProductInfo['ProductImageList']);
$RelatedProduct = $Product -> GetRelatedProduct($ProductInfo['ProductCategoryID'], $ProductInfo['ProductID']);

if ($ProductInfo['ProductAvailable'] > 0) $IsAvailable = 'available'; else $IsAvailable = 'unavailable';

if ($ProductInfo['ProductDiscount'] != 0)
{
    $Price = $Price - ($ProductInfo['ProductPrice'] * ($ProductInfo['ProductDiscount'] / 100));


    $BeforeDiscountSpan = '<span class="price">VNĐ '.number_format($ProductInfo['ProductPrice']).'</span>';
}

if ($ProductInfo['ProductAvailable'] === 0)
{
    $Unavailable = 'unavailable';
} $Unavailable = 'available';

while ($Loop <= 5)
{
    if ($Loop <= (int) $ProductInfo['ProductRateAvg'])
    {
        $RateStar .= '<i class="fas fa-star fill"></i>';
    } else $RateStar .= '<i class="fas fa-star"></i>';

    $Loop++;
}

?>

<div class="container">
    <section class="QGProductInfo margin-top-40">
        <div class="product-img-box">
            <div class="img-big-box">
                <img id="bigimg" src="<?=$PublicConfig::WebImagesRoot.$ProductImageList['0']?>">
            </div>
            <div class="img-list-box">
                <img id="active" src="<?=$PublicConfig::WebImagesRoot.$ProductImageList['0']?>">
                <img src="<?=$PublicConfig::WebImagesRoot.$ProductImageList['1']?>">
                <img src="<?=$PublicConfig::WebImagesRoot.$ProductImageList['2']?>">
                <img src="<?=$PublicConfig::WebImagesRoot.$ProductImageList['3']?>">
            </div>
        </div>
        <div class="product-detail-box">
            <div class="product-detail-content">
                <h3 class="product-info-title">
                    <?=$ProductInfo['ProductName']?>
                </h3>
                <div class="detail-rated-star">
                    <?=$RateStar?>
                </div>
                <div class="total-rate">
                    <a>(<?=$ProductInfo['ProductTotalRate']?> Đánh Giá)</a>
                </div>
                <p class="product-price">
                    <span class="discounted-price">VNĐ <?=number_format($Price)?></span>
                    <?=$BeforeDiscountSpan?>
                </p>
                <div class="product-info-block">
                    <div class="single-info">
                        <span class="title">Phí vận chuyển tạm tính:</span>
                        <span class="value">VNĐ 30.000 (Toàn Quốc)</span>
                    </div>
                    <div class="single-info">
                        <span class="title">Mã sản phẩm:</span>
                        <span class="value">LQG<?=$ProductInfo['ProductID']?>G<?=$ProductInfo['ProductCategoryID']?></span>
                    </div>
                    <div class="single-info">
                        <span class="title">Trạng thái:</span>
                        <span class="value <?=$IsAvailable?>"></span>
                    </div>
                </div>
                <div class="product-short-desc">
                    <p><?=$ProductInfo['ProductPreview']?></p>
                </div>
                <div class="quantity">
                    <span class="quantity-title">Số lượng</span>
                    <div class="pro-qty">
                        <input type="text" id="qty-value" value="1" disabled>
                        <input type="hidden" id="ProductID" value="<?=$ProductInfo['ProductID']?>" disabled>
                        <input type="hidden" id="PricePerUnit" value="<?=$Price?>" disabled>
                        <a href="" id="qty-inc" class="inc">+</a>
                        <a href="" id="qty-dec" class="dec">-</a>
                    </div>
                    <button id="AddToCart" class="product-cart-button">+ Thêm vào giỏ hàng</button>
                </div>

                <div class="wishlist-button">
                    <a href="#">
                        <i class="fal fa-heart"></i> Thêm vào yêu thích
                    </a>
                </div>

                <div class="social-share-buttons">
                    <h3>chi sẻ sản phẩm.?</h3>
                    <ul>
                        <li>
                            <a class="twitter" href="#">
                                <i class="fab fa-twitter"></i>
                            </a>
                        </li>
                        <li>
                            <a class="facebook" href="#">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                        </li>
                        <li>
                            <a class="google-plus" href="#">
                                <i class="fab fa-google-plus-g"></i>
                            </a>
                        </li>
                        <li>
                            <a class="pinterest" href="#">
                                <i class="fab fa-pinterest"></i>
                            </a>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
        <div class="clearfix"></div>
        <div class="description-review-box margin-top-20">
            <div class="nav-flex-tab">
                <a id="description-tab" class="active-tab">Mô Tả</a>
                <a id="review-tab">Nhận Xét</a>
            </div>
            <div class="tab-box">
                <div id="decs-content" class="desc-content active">
                    <p><?=$ProductInfo['ProductDescription']?></p>
                </div>
                <div id="review-content" class="review-content deactivate">
                    <div class="pro-avg-ratting">
                        <h4><?=$ProductInfo['ProductRateAvg']?><span>(Overall)</span></h4>
                        <span>Dựa trên tất cả <?=$ProductInfo['ProductTotalRate']?> bình luận từ người dùng.</span>
                    </div>
                    <div class="ratting-list">
                        <div class="detail-rated-star">
                            <i class="fas fa-star fill"></i>
                            <i class="fas fa-star fill"></i>
                            <i class="fas fa-star fill"></i>
                            <i class="fas fa-star fill"></i>
                            <i class="fas fa-star fill"></i>
                            <span>(<?=(int)$Product -> TotalPerStar(5, $_GET['Product'])?>)</span>
                        </div>
                        <div class="detail-rated-star">
                            <i class="fas fa-star fill"></i>
                            <i class="fas fa-star fill"></i>
                            <i class="fas fa-star fill"></i>
                            <i class="fas fa-star fill"></i>
                            <i class="fas fa-star"></i>
                            <span>(<?=(int)$Product -> TotalPerStar(4, $_GET['Product'])?>)</span>
                        </div>
                        <div class="detail-rated-star">
                            <i class="fas fa-star fill"></i>
                            <i class="fas fa-star fill"></i>
                            <i class="fas fa-star fill"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <span>(<?=(int)$Product -> TotalPerStar(3, $_GET['Product'])?>)</span>
                        </div>
                        <div class="detail-rated-star">
                            <i class="fas fa-star fill"></i>
                            <i class="fas fa-star fill"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <span>(<?=(int)$Product -> TotalPerStar(2, $_GET['Product'])?>)</span>
                        </div>
                        <div class="detail-rated-star">
                            <i class="fas fa-star fill"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <span>(<?=(int)$Product -> TotalPerStar(1, $_GET['Product'])?>)</span>
                        </div>
                    </div>
                    <?php
                    if (count($CommentsList) > 0)
                    {
                        foreach ($CommentsList as $Comment)
                        {
                            $Loop = 1;
                            $RateStarList = "";
                            while ($Loop <= 5)
                            {
                                if ($Loop <= $Comment['CommentRatedStar'])
                                {
                                    $RateStarList .= '<i class="fas fa-star fill"></i>';
                                } else $RateStarList .= '<i class="fas fa-star"></i>';

                                $Loop++;
                            }
                            $UserAvatar = $Comments -> GetUserAvatar($Comment['CommentOfUserID']);
                            $UserName = $Comments -> GetUserName(($Comment['CommentOfUserID']));
                            echo
                            '
                            <div class="user-rating-box margin-top-20">
                                <div class="user-rating">
                                    <div class="avatar-container">
                                        <div class="user-avatar">
                                            <img src="'.$PublicConfig::WebImagesRoot.$UserAvatar.'">
                                        </div>
                                    </div>
                                    <div class="user-rating-content">
                                        <div class="rating-author">
                                            <h3>'.$UserName.'</h3>
                                            <div class="ratting-star">
                                                '.$RateStarList.'
                                                <span>('.$Comment['CommentRatedStar'].')</span>
                                            </div>
                                        </div>
                                        <p>
                                            '.$Comment['CommentContent'].'
                                        </p>
                                    </div>
                                </div>
                            </div>
                            ';
                        }
                    } else
                    {
                        echo
                        '
                        <div class="user-rating-box margin-top-20 no-min-height">
                            <div class="user-rating-content">
                                <div class="rating-author">
                                    <h3>Chưa có bình luận nào về sản phẩm này</h3>
                                </div>
                            </div>
                        </div>
                        ';
                    }

                    if ($_SESSION['Logged'] === 1)
                    {
                        echo
                        '
                        <div id="EndOfComment" class="add-a-comment margin-top-20">
                            <h3>Bình luận của bạn:</h3>
                                <form id="CommentForm">
                                    <div class="rating-box">
                                        <h5>Đánh giá:</h5>
                                        <input type="hidden" id="ProID" value="'.$ProductInfo['ProductID'].'">
                                        <input id="star" value="0" type="hidden">
                                        <div id="star-hover" class="ratting-star">
                                            <i id="star-hover-one" class="fas fa-star"></i>
                                            <i id="star-hover-two" class="fas fa-star"></i>
                                            <i id="star-hover-thr" class="fas fa-star"></i>
                                            <i id="star-hover-fou" class="fas fa-star"></i>
                                            <i id="star-hover-fiv" class="fas fa-star"></i>
                                        </div>
                                    </div>
                                    <div class="form-full-box margin-bottom-20">
                                        <label for="your-review">Nội dung:</label>
                                        <textarea name="review" id="your-review" placeholder="Write a review"></textarea>
                                    </div>
                                    <div class="form-full-box">
                                        <button id="DoComment" type="submit">Đánh Giá</button>
                                    </div>
                            </form>
                        </div>
                        ';
                    }
                    else
                    {
                        echo
                        '
                        <div class="add-a-comment margin-top-20">
                            <h3>Vui lòng đăng nhập để đăng bình luận.</h3>
                        </div>
                        ';
                    }
                    ?>

                    <div class="clearfix"></div>
                </div>
            </div>
    </section>
    <div class="clearfix"></div>
    <section class="QGFlash-Sale margin-top-20">
        <div class="title margin-bottom-20">
            <h2>
                Sản phẩm liên quan
            </h2>
        </div>
        <?php
        foreach ($RelatedProduct as $Product)
        {
            $Loop = 1;
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

                $CurrentPrice = ($Product['ProductDiscount'] / 100) * $Product['ProductPrice'];

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
    <div class="clearfix"></div>
</div>