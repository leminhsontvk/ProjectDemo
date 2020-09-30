@extends('Layout.Layout')
@section('content')
        <section class="QGSearch-Bar margin-top-40">
            <div class="search-widget">
                <h3 class="widget-title">CATEGORIES</h3>
                <ul class="category-list">
                    @foreach($ListCategory as $CategoryInfo)
                        <li>
                            <a href="/Category/{{$CategoryInfo -> CategoryID}}">{{$CategoryInfo -> CategoryName}}</a>
                        </li>
                    @endforeach
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
            @php

            $TotalProduct = $Total;

            if ($TotalProduct > 0)
            {

                foreach ($Product as $ProductInfo)
                {
                    $Loop = 1;
                    $RateStar = '';
                    $DiscountSpan = '';
                    $DiscountPriceSpan = '';
                    $CurrentPrice = $ProductInfo['ProductPrice'];
                    $ImageList = json_decode($ProductInfo['ProductImageList']);

                    while ($Loop <= 5)
                    {
                        if ($Loop <= (int) $ProductInfo['ProductRateAvg'])
                        {
                            $RateStar .= '<i class="fas fa-star fill"></i>';
                        } else $RateStar .= '<i class="fas fa-star"></i>';

                        $Loop++;
                    }

                    if ($ProductInfo['ProductDiscount'] != 0)
                    {
                        $DiscountSpan = '<span class="discount-label">-'.($ProductInfo['ProductDiscount']).'%</span>';

                        $CurrentPrice =$ProductInfo['ProductPrice'] - ($ProductInfo['ProductDiscount'] / 100) * $ProductInfo['ProductPrice'];

                        $DiscountPriceSpan = '<span class="price-before-sale">VNĐ '.number_format($ProductInfo['ProductPrice']).'</span>';
                    }

                    echo
                        '
                    <div class="product-container" qgid="'.$ProductInfo['ProductID'].'">
                    <div class="product-img">
                        '.$DiscountSpan.'
                        <img id="img1" src="'.asset('/Images'.$ImageList['0']).'" style="z-index: 1">
                        <img id="img2" src="'.asset('/Images'.$ImageList['1']).'" style="z-index: 2">
                        <span class="sale"></span>
                        <div class="product-icon-hover">
                            <div class="icon-position">
                                <ul>
                                    <li>
                                        <a href="'.asset('/ProductDetail/'.$ProductInfo['ProductID']).'">
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
                            '.$ProductInfo['ProductName'].'
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
            @endphp
            <div class="clearfix"></div>
            {{$Product -> links()}}
{{--            <div class="pagination-box">--}}
{{--                <ul class="pagination">--}}
{{--                    <li class="hidden">--}}
{{--                        <a href="#">|<</a>--}}
{{--                    </li>--}}
{{--                    <li class="hidden">--}}
{{--                        <a href="#"><</a>--}}
{{--                    </li>--}}
{{--                    <li class="active">--}}
{{--                        <a href="#">1</a>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <a href="#">2</a>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <a href="#">></a>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <a href="#">>|</a>--}}
{{--                    </li>--}}
{{--                </ul>--}}
{{--                <div class="pagination-text">--}}
{{--                    Showing 1 to 9 of 15 (2 Pages)--}}
{{--                </div>--}}
{{--            </div>--}}
        </section>
        <div class="clearfix"></div>
    @endsection
