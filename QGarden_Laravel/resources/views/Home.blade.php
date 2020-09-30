@extends('Layout.Layout')
@section('content')
    <section class="Banner margin-bottom-40">
        <div class="slider">
            <ul class="slides">
                <li>
                    <img src="{{asset('Images/Banner/BannerB1.jpg')}}"> <!-- random image -->
                    <div class="caption center-align">
                    </div>
                </li>
                <li>
                    <img src="{{asset('Images/Banner/BannerB2.jpg')}}"> <!-- random image -->
                    <div class="caption left-align">
                    </div>
                </li>
                <li>
                    <img src="{{asset('Images/Banner/BannerB3.jpg')}}"> <!-- random image -->
                    <div class="caption right-align">
                    </div>
                </li>
            </ul>
        </div>
    </section>
    <section class="Mini-Banner margin-bottom-40">
        <div class="mini-left">
            <a href="#">
                <img src="{{asset('Images/Banner/BannerM1.jpg')}}">
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
                <img src="{{asset('Images/Banner/BannerM2.jpg')}}.jpg">
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
                Sản Phẩm Mới
            </h2>
        </div>
        @php
            $LoopCount = 0;

            $ProductList = (array)$ProductList;

            foreach ($ProductList as $Product)
            {
                $Product = (array) $Product;
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
                        <img id="img1" src="'.asset("/Images".$ImageList['0']).'" style="z-index: 1">
                        <img id="img2" src="'.asset("/Images".$ImageList['1']).'" style="z-index: 2">
                        <span class="sale"></span>
                        <div class="product-icon-hover">
                            <div class="icon-position">
                                <ul>
                                    <li>
                                        <a href="'.asset('/ProductDetail/'.$Product['ProductID']).'">
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
        @endphp

{{--        <div class="product-container">--}}
{{--            <div class="product-img">--}}
{{--                <span class="discount-label">-20%</span>--}}
{{--                <img id="img1" src="{{asset('Images/Products/Product1.jpg')}}" style="z-index: 1">--}}
{{--                <img id="img2" src="{{asset('Images/Products/Product2.jpg')}}" style="z-index: 2">--}}
{{--                <span class="sale"></span>--}}
{{--                <div class="product-icon-hover">--}}
{{--                    <div class="icon-position">--}}
{{--                        <ul>--}}
{{--                            <li>--}}
{{--                                <a href="#">--}}
{{--                                    <i class="far fa-eye"></i>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <a href="#">--}}
{{--                                    <i class="fal fa-heart"></i>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <a href="#">--}}
{{--                                    <i class="fal fa-shopping-cart"></i>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="clearfix"></div>--}}
{{--            <div class="product-detail">--}}
{{--                <div class="detail-title">--}}
{{--                    Xương Rồng Đá--}}
{{--                </div>--}}
{{--                <div class="detail-rated-star">--}}
{{--                    <i class="fas fa-star fill"></i>--}}
{{--                    <i class="fas fa-star fill"></i>--}}
{{--                    <i class="fas fa-star fill"></i>--}}
{{--                    <i class="fas fa-star fill"></i>--}}
{{--                    <i class="fas fa-star"></i>--}}
{{--                </div>--}}
{{--                <div class="detail-price">--}}
{{--                    <span class="price-amount-mini">VNĐ 250.000</span>--}}
{{--                    <span class="price-before-sale">VNĐ 500.000</span>--}}
{{--                </div>--}}
{{--                <div class="add-cart-icon">--}}
{{--                    <a href="#">--}}
{{--                        <i class="far fa-shopping-cart"></i>--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="product-container">--}}
{{--            <div class="product-img">--}}
{{--                <span class="discount-label">-20%</span>--}}
{{--                <img id="img1" src="{{asset('Images/Products/Product1.jpg')}}" style="z-index: 1">--}}
{{--                <img id="img2" src="{{asset('Images/Products/Product2.jpg')}}" style="z-index: 2">--}}
{{--                <span class="sale"></span>--}}
{{--                <div class="product-icon-hover">--}}
{{--                    <div class="icon-position">--}}
{{--                        <ul>--}}
{{--                            <li>--}}
{{--                                <a href="#">--}}
{{--                                    <i class="far fa-eye"></i>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <a href="#">--}}
{{--                                    <i class="fal fa-heart"></i>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <a href="#">--}}
{{--                                    <i class="fal fa-shopping-cart"></i>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="clearfix"></div>--}}
{{--            <div class="product-detail">--}}
{{--                <div class="detail-title">--}}
{{--                    Xương Rồng Đá--}}
{{--                </div>--}}
{{--                <div class="detail-rated-star">--}}
{{--                    <i class="fas fa-star fill"></i>--}}
{{--                    <i class="fas fa-star fill"></i>--}}
{{--                    <i class="fas fa-star fill"></i>--}}
{{--                    <i class="fas fa-star fill"></i>--}}
{{--                    <i class="fas fa-star"></i>--}}
{{--                </div>--}}
{{--                <div class="detail-price">--}}
{{--                    <span class="price-amount-mini">VNĐ 250.000</span>--}}
{{--                    <span class="price-before-sale">VNĐ 500.000</span>--}}
{{--                </div>--}}
{{--                <div class="add-cart-icon">--}}
{{--                    <a href="#">--}}
{{--                        <i class="far fa-shopping-cart"></i>--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="product-container">--}}
{{--            <div class="product-img">--}}
{{--                <span class="discount-label">-20%</span>--}}
{{--                <img id="img1" src="{{asset('Images/Products/Product1.jpg')}}" style="z-index: 1">--}}
{{--                <img id="img2" src="{{asset('Images/Products/Product2.jpg')}}" style="z-index: 2">--}}
{{--                <span class="sale"></span>--}}
{{--                <div class="product-icon-hover">--}}
{{--                    <div class="icon-position">--}}
{{--                        <ul>--}}
{{--                            <li>--}}
{{--                                <a href="#">--}}
{{--                                    <i class="far fa-eye"></i>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <a href="#">--}}
{{--                                    <i class="fal fa-heart"></i>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <a href="#">--}}
{{--                                    <i class="fal fa-shopping-cart"></i>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="clearfix"></div>--}}
{{--            <div class="product-detail">--}}
{{--                <div class="detail-title">--}}
{{--                    Xương Rồng Đá--}}
{{--                </div>--}}
{{--                <div class="detail-rated-star">--}}
{{--                    <i class="fas fa-star fill"></i>--}}
{{--                    <i class="fas fa-star fill"></i>--}}
{{--                    <i class="fas fa-star fill"></i>--}}
{{--                    <i class="fas fa-star fill"></i>--}}
{{--                    <i class="fas fa-star"></i>--}}
{{--                </div>--}}
{{--                <div class="detail-price">--}}
{{--                    <span class="price-amount-mini">VNĐ 250.000</span>--}}
{{--                    <span class="price-before-sale">VNĐ 500.000</span>--}}
{{--                </div>--}}
{{--                <div class="add-cart-icon">--}}
{{--                    <a href="#">--}}
{{--                        <i class="far fa-shopping-cart"></i>--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="product-container">--}}
{{--            <div class="product-img">--}}
{{--                <span class="discount-label">-20%</span>--}}
{{--                <img id="img1" src="{{asset('Images/Products/Product1.jpg')}}" style="z-index: 1">--}}
{{--                <img id="img2" src="{{asset('Images/Products/Product2.jpg')}}" style="z-index: 2">--}}
{{--                <span class="sale"></span>--}}
{{--                <div class="product-icon-hover">--}}
{{--                    <div class="icon-position">--}}
{{--                        <ul>--}}
{{--                            <li>--}}
{{--                                <a href="#">--}}
{{--                                    <i class="far fa-eye"></i>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <a href="#">--}}
{{--                                    <i class="fal fa-heart"></i>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <a href="#">--}}
{{--                                    <i class="fal fa-shopping-cart"></i>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="clearfix"></div>--}}
{{--            <div class="product-detail">--}}
{{--                <div class="detail-title">--}}
{{--                    Xương Rồng Đá--}}
{{--                </div>--}}
{{--                <div class="detail-rated-star">--}}
{{--                    <i class="fas fa-star fill"></i>--}}
{{--                    <i class="fas fa-star fill"></i>--}}
{{--                    <i class="fas fa-star fill"></i>--}}
{{--                    <i class="fas fa-star fill"></i>--}}
{{--                    <i class="fas fa-star"></i>--}}
{{--                </div>--}}
{{--                <div class="detail-price">--}}
{{--                    <span class="price-amount-mini">VNĐ 250.000</span>--}}
{{--                    <span class="price-before-sale">VNĐ 500.000</span>--}}
{{--                </div>--}}
{{--                <div class="add-cart-icon">--}}
{{--                    <a href="#">--}}
{{--                        <i class="far fa-shopping-cart"></i>--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
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
                <img src="{{asset('Images/Banner/BannerBIG1.jpg')}}">
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
            <a href="#"><img src="{{asset('Images/Banner/BannerNewProduct.jpg')}}"></a>
        </div>
        <div class="new-product">
            @php
                $LoopCount = 0;

                foreach ($ProductDiscount as $Product)
                {
                    $Product = (array) $Product;
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
                                <img id="img1" src="'.asset('/Images'.$ImageList['0']).'" style="z-index: 1">
                                <img id="img2" src="'.asset('/Images'.$ImageList['1']).'" style="z-index: 2">
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
            @endphp
{{--            <div class="product-container">--}}
{{--                <div class="product-img">--}}
{{--                    <span class="discount-label">-20%</span>--}}
{{--                    <img id="img1" src="{{asset('Images/Products/Product1.jpg')}}" style="z-index: 1">--}}
{{--                    <img id="img2" src="{{asset('Images/Products/Product2.jpg')}}" style="z-index: 2">--}}
{{--                    <span class="sale"></span>--}}
{{--                    <div class="product-icon-hover">--}}
{{--                        <div class="icon-position">--}}
{{--                            <ul>--}}
{{--                                <li>--}}
{{--                                    <a href="#">--}}
{{--                                        <i class="far fa-eye"></i>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                                <li>--}}
{{--                                    <a href="#">--}}
{{--                                        <i class="fal fa-heart"></i>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                                <li>--}}
{{--                                    <a href="#">--}}
{{--                                        <i class="fal fa-shopping-cart"></i>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                            </ul>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="clearfix"></div>--}}
{{--                <div class="product-detail">--}}
{{--                    <div class="detail-title">--}}
{{--                        Xương Rồng Đá--}}
{{--                    </div>--}}
{{--                    <div class="detail-rated-star">--}}
{{--                        <i class="fas fa-star fill"></i>--}}
{{--                        <i class="fas fa-star fill"></i>--}}
{{--                        <i class="fas fa-star fill"></i>--}}
{{--                        <i class="fas fa-star fill"></i>--}}
{{--                        <i class="fas fa-star"></i>--}}
{{--                    </div>--}}
{{--                    <div class="detail-price">--}}
{{--                        <span class="price-amount-mini">VNĐ 250.000</span>--}}
{{--                        <span class="price-before-sale">VNĐ 500.000</span>--}}
{{--                    </div>--}}
{{--                    <div class="add-cart-icon">--}}
{{--                        <a href="#">--}}
{{--                            <i class="far fa-shopping-cart"></i>--}}
{{--                        </a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="product-container">--}}
{{--                <div class="product-img">--}}
{{--                    <span class="discount-label">-20%</span>--}}
{{--                    <img id="img1" src="{{asset('Images/Products/Product1.jpg')}}" style="z-index: 1">--}}
{{--                    <img id="img2" src="{{asset('Images/Products/Product2.jpg')}}" style="z-index: 2">--}}
{{--                    <span class="sale"></span>--}}
{{--                    <div class="product-icon-hover">--}}
{{--                        <div class="icon-position">--}}
{{--                            <ul>--}}
{{--                                <li>--}}
{{--                                    <a href="#">--}}
{{--                                        <i class="far fa-eye"></i>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                                <li>--}}
{{--                                    <a href="#">--}}
{{--                                        <i class="fal fa-heart"></i>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                                <li>--}}
{{--                                    <a href="#">--}}
{{--                                        <i class="fal fa-shopping-cart"></i>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                            </ul>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="clearfix"></div>--}}
{{--                <div class="product-detail">--}}
{{--                    <div class="detail-title">--}}
{{--                        Xương Rồng Đá--}}
{{--                    </div>--}}
{{--                    <div class="detail-rated-star">--}}
{{--                        <i class="fas fa-star fill"></i>--}}
{{--                        <i class="fas fa-star fill"></i>--}}
{{--                        <i class="fas fa-star fill"></i>--}}
{{--                        <i class="fas fa-star fill"></i>--}}
{{--                        <i class="fas fa-star"></i>--}}
{{--                    </div>--}}
{{--                    <div class="detail-price">--}}
{{--                        <span class="price-amount-mini">VNĐ 250.000</span>--}}
{{--                        <span class="price-before-sale">VNĐ 500.000</span>--}}
{{--                    </div>--}}
{{--                    <div class="add-cart-icon">--}}
{{--                        <a href="#">--}}
{{--                            <i class="far fa-shopping-cart"></i>--}}
{{--                        </a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="product-container">--}}
{{--                <div class="product-img">--}}
{{--                    <span class="discount-label">-20%</span>--}}
{{--                    <img id="img1" src="{{asset('Images/Products/Product1.jpg')}}" style="z-index: 1">--}}
{{--                    <img id="img2" src="{{asset('Images/Products/Product2.jpg')}}" style="z-index: 2">--}}
{{--                    <span class="sale"></span>--}}
{{--                    <div class="product-icon-hover">--}}
{{--                        <div class="icon-position">--}}
{{--                            <ul>--}}
{{--                                <li>--}}
{{--                                    <a href="#">--}}
{{--                                        <i class="far fa-eye"></i>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                                <li>--}}
{{--                                    <a href="#">--}}
{{--                                        <i class="fal fa-heart"></i>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                                <li>--}}
{{--                                    <a href="#">--}}
{{--                                        <i class="fal fa-shopping-cart"></i>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                            </ul>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="clearfix"></div>--}}
{{--                <div class="product-detail">--}}
{{--                    <div class="detail-title">--}}
{{--                        Xương Rồng Đá--}}
{{--                    </div>--}}
{{--                    <div class="detail-rated-star">--}}
{{--                        <i class="fas fa-star fill"></i>--}}
{{--                        <i class="fas fa-star fill"></i>--}}
{{--                        <i class="fas fa-star fill"></i>--}}
{{--                        <i class="fas fa-star fill"></i>--}}
{{--                        <i class="fas fa-star"></i>--}}
{{--                    </div>--}}
{{--                    <div class="detail-price">--}}
{{--                        <span class="price-amount-mini">VNĐ 250.000</span>--}}
{{--                        <span class="price-before-sale">VNĐ 500.000</span>--}}
{{--                    </div>--}}
{{--                    <div class="add-cart-icon">--}}
{{--                        <a href="#">--}}
{{--                            <i class="far fa-shopping-cart"></i>--}}
{{--                        </a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="product-container">--}}
{{--                <div class="product-img">--}}
{{--                    <span class="discount-label">-20%</span>--}}
{{--                    <img id="img1" src="{{asset('Images/Products/Product1.jpg')}}" style="z-index: 1">--}}
{{--                    <img id="img2" src="{{asset('Images/Products/Product2.jpg')}}" style="z-index: 2">--}}
{{--                    <span class="sale"></span>--}}
{{--                    <div class="product-icon-hover">--}}
{{--                        <div class="icon-position">--}}
{{--                            <ul>--}}
{{--                                <li>--}}
{{--                                    <a href="#">--}}
{{--                                        <i class="far fa-eye"></i>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                                <li>--}}
{{--                                    <a href="#">--}}
{{--                                        <i class="fal fa-heart"></i>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                                <li>--}}
{{--                                    <a href="#">--}}
{{--                                        <i class="fal fa-shopping-cart"></i>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                            </ul>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="clearfix"></div>--}}
{{--                <div class="product-detail">--}}
{{--                    <div class="detail-title">--}}
{{--                        Xương Rồng Đá--}}
{{--                    </div>--}}
{{--                    <div class="detail-rated-star">--}}
{{--                        <i class="fas fa-star fill"></i>--}}
{{--                        <i class="fas fa-star fill"></i>--}}
{{--                        <i class="fas fa-star fill"></i>--}}
{{--                        <i class="fas fa-star fill"></i>--}}
{{--                        <i class="fas fa-star"></i>--}}
{{--                    </div>--}}
{{--                    <div class="detail-price">--}}
{{--                        <span class="price-amount-mini">VNĐ 250.000</span>--}}
{{--                        <span class="price-before-sale">VNĐ 500.000</span>--}}
{{--                    </div>--}}
{{--                    <div class="add-cart-icon">--}}
{{--                        <a href="#">--}}
{{--                            <i class="far fa-shopping-cart"></i>--}}
{{--                        </a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="product-container">--}}
{{--                <div class="product-img">--}}
{{--                    <span class="discount-label">-20%</span>--}}
{{--                    <img id="img1" src="{{asset('Images/Products/Product1.jpg')}}" style="z-index: 1">--}}
{{--                    <img id="img2" src="{{asset('Images/Products/Product2.jpg')}}" style="z-index: 2">--}}
{{--                    <span class="sale"></span>--}}
{{--                    <div class="product-icon-hover">--}}
{{--                        <div class="icon-position">--}}
{{--                            <ul>--}}
{{--                                <li>--}}
{{--                                    <a href="#">--}}
{{--                                        <i class="far fa-eye"></i>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                                <li>--}}
{{--                                    <a href="#">--}}
{{--                                        <i class="fal fa-heart"></i>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                                <li>--}}
{{--                                    <a href="#">--}}
{{--                                        <i class="fal fa-shopping-cart"></i>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                            </ul>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="clearfix"></div>--}}
{{--                <div class="product-detail">--}}
{{--                    <div class="detail-title">--}}
{{--                        Xương Rồng Đá--}}
{{--                    </div>--}}
{{--                    <div class="detail-rated-star">--}}
{{--                        <i class="fas fa-star fill"></i>--}}
{{--                        <i class="fas fa-star fill"></i>--}}
{{--                        <i class="fas fa-star fill"></i>--}}
{{--                        <i class="fas fa-star fill"></i>--}}
{{--                        <i class="fas fa-star"></i>--}}
{{--                    </div>--}}
{{--                    <div class="detail-price">--}}
{{--                        <span class="price-amount-mini">VNĐ 250.000</span>--}}
{{--                        <span class="price-before-sale">VNĐ 500.000</span>--}}
{{--                    </div>--}}
{{--                    <div class="add-cart-icon">--}}
{{--                        <a href="#">--}}
{{--                            <i class="far fa-shopping-cart"></i>--}}
{{--                        </a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="product-container">--}}
{{--                <div class="product-img">--}}
{{--                    <span class="discount-label">-20%</span>--}}
{{--                    <img id="img1" src="{{asset('Images/Products/Product1.jpg')}}" style="z-index: 1">--}}
{{--                    <img id="img2" src="{{asset('Images/Products/Product2.jpg')}}" style="z-index: 2">--}}
{{--                    <span class="sale"></span>--}}
{{--                    <div class="product-icon-hover">--}}
{{--                        <div class="icon-position">--}}
{{--                            <ul>--}}
{{--                                <li>--}}
{{--                                    <a href="#">--}}
{{--                                        <i class="far fa-eye"></i>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                                <li>--}}
{{--                                    <a href="#">--}}
{{--                                        <i class="fal fa-heart"></i>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                                <li>--}}
{{--                                    <a href="#">--}}
{{--                                        <i class="fal fa-shopping-cart"></i>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                            </ul>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="clearfix"></div>--}}
{{--                <div class="product-detail">--}}
{{--                    <div class="detail-title">--}}
{{--                        Xương Rồng Đá--}}
{{--                    </div>--}}
{{--                    <div class="detail-rated-star">--}}
{{--                        <i class="fas fa-star fill"></i>--}}
{{--                        <i class="fas fa-star fill"></i>--}}
{{--                        <i class="fas fa-star fill"></i>--}}
{{--                        <i class="fas fa-star fill"></i>--}}
{{--                        <i class="fas fa-star"></i>--}}
{{--                    </div>--}}
{{--                    <div class="detail-price">--}}
{{--                        <span class="price-amount-mini">VNĐ 250.000</span>--}}
{{--                        <span class="price-before-sale">VNĐ 500.000</span>--}}
{{--                    </div>--}}
{{--                    <div class="add-cart-icon">--}}
{{--                        <a href="#">--}}
{{--                            <i class="far fa-shopping-cart"></i>--}}
{{--                        </a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>
        <div class="clearfix"></div>
    </section>
    <section class="QGCategory margin-bottom-40">
        <div class="title margin-bottom-20">
            <h2>
                Danh Mục Sản Phẩm
            </h2>
        </div>
        @php
            foreach ($Menu as $CategoryKey => $Category)
            {
                $Category = (array) $Category;
                if ($CategoryKey === 4) break;
                echo
                '
                <div class="product-container">
                    <div class="product-img no-hover">
                        <img id="img1" src="'.asset('/Images'.$Category['CategoryDefaultImage']).'">
                        <div class="category-img-info">
                            <h5 class="category-title">
                                <a href="'.asset('/Category/'.$Category['CategoryID']).'">'.$Category['CategoryName'].'</a>
                            </h5>
                            <p class="quantity">'.$Category['CategoryTotalProduct'].' sản phẩm</p>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                ';
            }
        @endphp
{{--        <div class="product-container">--}}
{{--        <div class="product-img no-hover">--}}
{{--            <img id="img1" src="{{asset('Images/Category/CategoryID1.jpg')}}">--}}
{{--            <div class="category-img-info">--}}
{{--                <h5 class="category-title">--}}
{{--                    <a href="#">HOUSE PLANTS</a>--}}
{{--                </h5>--}}
{{--                <p class="quantity">8 products</p>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="clearfix"></div>--}}
{{--    </div>--}}
{{--        <div class="product-container">--}}
{{--            <div class="product-img no-hover">--}}
{{--                <img id="img1" src="{{asset('Images/Category/CategoryID1.jpg')}}">--}}
{{--                <div class="category-img-info">--}}
{{--                    <h5 class="category-title">--}}
{{--                        <a href="#">HOUSE PLANTS</a>--}}
{{--                    </h5>--}}
{{--                    <p class="quantity">8 products</p>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="clearfix"></div>--}}
{{--        </div>--}}
{{--        <div class="product-container">--}}
{{--            <div class="product-img no-hover">--}}
{{--                <img id="img1" src="{{asset('Images/Category/CategoryID1.jpg')}}">--}}
{{--                <div class="category-img-info">--}}
{{--                    <h5 class="category-title">--}}
{{--                        <a href="#">HOUSE PLANTS</a>--}}
{{--                    </h5>--}}
{{--                    <p class="quantity">8 products</p>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="clearfix"></div>--}}
{{--        </div>--}}
{{--        <div class="product-container">--}}
{{--            <div class="product-img no-hover">--}}
{{--                <img id="img1" src="{{asset('Images/Category/CategoryID1.jpg')}}">--}}
{{--                <div class="category-img-info">--}}
{{--                    <h5 class="category-title">--}}
{{--                        <a href="#">HOUSE PLANTS</a>--}}
{{--                    </h5>--}}
{{--                    <p class="quantity">8 products</p>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="clearfix"></div>--}}
{{--        </div>--}}
        <div class="clearfix"></div>
    </section>
    {{--<section class="QGNews padding-bottom-20 border-bottom">
        <div class="title margin-bottom-20">
            <h2>
                Test Title
            </h2>
        </div>
        <div class="news-container">
            <div class="news-img">
                <a href="#">
                    <img src="{{asset('Images/News/NewsID1.jpg')}}">
                </a>
            </div>
            <div class="news-info">
                <h3 class="post-title">
                    <a href="#">Bromeliad Mount Care: How to Water and Care for Mounted Bromeliads</a>
                </h3>
                <div class="post-meta">
                    <p class="author-name">by <span>HasTech</span></p>
                    <p class="post-date">30 Oct, 2019</p>
                </div>
            </div>
        </div>
        <div class="news-container">
            <div class="news-img">
                <a href="#">
                    <img src="{{asset('Images/News/NewsID1.jpg')}}">
                </a>
            </div>
            <div class="news-info">
                <h3 class="post-title">
                    <a href="#">Bromeliad Mount Care: How to Water and Care for Mounted Bromeliads</a>
                </h3>
                <div class="post-meta">
                    <p class="author-name">by <span>HasTech</span></p>
                    <p class="post-date">30 Oct, 2019</p>
                </div>
            </div>
        </div>
        <div class="news-container">
            <div class="news-img">
                <a href="#">
                    <img src="{{asset('Images/News/NewsID1.jpg')}}">
                </a>
            </div>
            <div class="news-info">
                <h3 class="post-title">
                    <a href="#">Bromeliad Mount Care: How to Water and Care for Mounted Bromeliads</a>
                </h3>
                <div class="post-meta">
                    <p class="author-name">by <span>HasTech</span></p>
                    <p class="post-date">30 Oct, 2019</p>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </section>--}}
    <section class="QGSubscribe margin-top-40 padding-bottom-20">
        <div class="sub-container">
            <div class="sub-info">
                <h5>Subscribe newsletter to get updated</h5>
                <p>We’ll never share your email address with a third-party.</p>
            </div>
            <div class="sub-form">
                <form class="flex-box">
                    <input type="email" placeholder="Enter your email address here ..." name="Mail">
                    <button type="submit">Subscribe</button>
                </form>
            </div>
            <div class="clearfix"></div>
        </div>
    </section>
@endsection