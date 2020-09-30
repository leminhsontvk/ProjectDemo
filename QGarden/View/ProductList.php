<?php
/** Check Access **/
if (!defined('QGAccessGrained')) {header("HTTP/2 404 Not Found"); exit();}

?>

<div class="container">
    <section class="QGSearch-Bar margin-top-40">
        <div class="search-widget">
            <h3 class="widget-title">Danh mục sản phẩm</h3>
            <ul class="category-list">
                <?php
                foreach ($CategoryList as $Category)
                {
                    echo '<li><a href="?QGPage=Products&Category='.$Category['CategoryID'].'">'.$Category['CategoryName'].' ('.$Category['CategoryTotalProduct'].')</a></li>';
                }
                ?>
            </ul>
            <h3 class="widget-title">Bộ lọc</h3>
            <form id="SearchInfo" METHOD="POST" action="?<?=http_build_query($_GET)?>" class="category-list">
                <input type="text" name="SearchKey" placeholder="Bạn Cần tìm gì.?">
                <input class="p-from" name="PriceFrom" placeholder="Giá Từ" type="number" min="" max="">
                <label class="connect"> - </label>
                <input class="p-to" name="PriceTo" placeholder="Giá Đến" type="number" min="" max="">
                <select name="OnlyStar">
                    <option value="NULL"></option>
                    <option value="5">Chỉ những sản phẩm từ 5 sao.</option>
                    <option value="4">Chỉ những sản phẩm từ 4 sao.</option>
                    <option value="3">Chỉ những sản phẩm từ 3 sao.</option>
                </select>
                <div class="check-box">
                    <input type="checkbox" id="IsSale" name="IsSale" value="1">
                    <label for="IsSale">Chỉ sản phẩm giảm giá</label>
                </div>
                <div class="check-box">
                    <input type="checkbox" id="IsNotSale" name="IsSale" value="2">
                    <label for="IsNotSale">Chỉ sản phẩm không giảm giá</label>
                </div>
                <input type="hidden" name="Search" value="1">
                <button type="submit">Tìm Kiếm</button>
                <div class="clearfix"></div>
            </form>
            <form id="NewProductForm" class="category-list margin-bottom-20" method="POST" action="?QGPage=Products">
                <input type="hidden" name="Clean" value="1">
                <button type="submit" id="AddNewProduct">Xóa Bộ Lọc</button>
            </form>
        </div>
    </section>
    <section class="QGProductList margin-top-40">
        <?php
        if ($TotalProduct > 0)
        {
            foreach ($ProductList as $Product)
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

                    $CurrentPrice =$Product['ProductPrice'] - ($Product['ProductDiscount'] / 100) * $Product['ProductPrice'];

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
        }
        else
        {
            echo
            '
            <div class="title margin-bottom-20">
            <h2>
                Không có sản phẩm nào.
            </h2>
        </div>
            ';
        }
        ?>
        <div class="clearfix"></div>
        <div class="pagination-box">
            <ul class="pagination">
                <?php
                echo $Pagination;
                ?>
            </ul>
            <div class="pagination-text">
                <?php

                if ($TotalProduct <= $PublicConfig -> ProductPerPage)
                {
                    $From = '1';
                    $PageCount = '1';
                    $To = $TotalProduct;
                    $All = $TotalProduct;
                }

                if ($TotalProduct > $PublicConfig -> ProductPerPage)
                {
                    $All = $TotalProduct;
                    /** @var int $CurrentPage */
                    $From = (($CurrentPage - 1) * $PublicConfig -> ProductPerPage) + 1;
                    $PageCount = ceil($TotalProduct / $PublicConfig -> ProductPerPage);
                    $To = (($CurrentPage - 1) * $PublicConfig -> ProductPerPage) + ($PublicConfig -> ProductPerPage);

                    if ($To > $TotalProduct) $To = $TotalProduct;
                }

                if ($TotalProduct == 0) $From = 0;

                ?>
                Đang hiển thị <?=$From?> đến <?=$To?> trong <?=$All?> (<?=$PageCount?> Trang)
            </div>
        </div>
    </section>
    <div class="clearfix"></div>
</div>