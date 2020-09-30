<!DOCTYPE html>
<!--suppress ALL -->
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{asset('CSS/Style.css')}}" rel="stylesheet" type="text/css">
    <!-- Module JS -->
    <script src="{{asset('JS/JQuery.js')}}"></script>
    <script src="{{asset('JS/Materialize.js')}}"></script>
    <!-- Custom JS -->
    <script src="{{asset('JS/QGarden.js')}}"></script>
    <title>QGarden - For Your Own Green</title>
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
                            <a href="#">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fab fa-instagram"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fab fa-google-plus-g"></i>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="user-account">
                </div>
            </div>
        </div>
        <div class="qgarden-search-box padding-bottom-25 padding-top-25">
            <div class="flex-box align-items-center">
                <div class="logo">
                    <a href="/">
                        <img src="{{asset('Images/Default/Logo.png')}}" width="140px" height="40px">
                    </a>
                </div>
                <div class="search-box align-items-center">
                    <form class="flex-box" action="/Search" method="GET">
                        <input type="text" name="Key" placeholder="Bạn tìm gì...">
                        <button type="submit">
                            <i class="far fa-search"></i>
                        </button>
                    </form>
                </div>
                <div class="cart-container align-items-center">
                    <div class="cart-box">
                        <a href="#">
                            <i class="far fa-shopping-cart"></i>
                            <span>20</span>
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
            <li class="active">
                <a href="/">Trang Chủ</a>
            </li>
            <li class="menu-has-submenu">
                <a href="/Category">Sản Phẩm</a>
                <ul>
                    @foreach($Menu as $CategoryInfo)
                        <li>
                            <a href="/Category/{{$CategoryInfo -> CategoryID}}">{{$CategoryInfo -> CategoryName}}</a>
                        </li>
                    @endforeach
                </ul>
            </li>


        </ul>
    </div>
</div>
<div class="container">
    @section('content')
    @show
    <div class="clearfix"></div>
    <footer class="margin-top-20 padding-top-20 border-top">
        <div class="footer-widget">
            <div class="footer-logo">
                <img src="{{asset('Images/Default/LogoFooter.png')}}" width="140px" height="40px">
            </div>
            <div class="footer-address">
                <h5 class="footer-block-title">Trụ Sở Tập Đoàn</h5>
                <p class="footer-block-content">The Luxury, Vinhomes Golden River</p>
            </div>
            <div class="footer-phone">
                <h5 class="footer-block-title">Cần Trợ Giúp?</h5>
                <p class="footer-block-content">Vui lòng gọi: 1-800-148-2010</p>
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
                <a href="#">Follow on instagram</a>
            </h4>
            <div class="ig-image-container">
                <a href="">
                    <img src="{{asset('Images/Footer/IG1.jpg')}}">
                </a>
                <a href="">
                    <img src="{{asset('Images/Footer/IG2.jpg')}}">
                </a>
                <a href="">
                    <img src="{{asset('Images/Footer/IG3.jpg')}}">
                </a>
                <a href="">
                    <img src="{{asset('Images/Footer/IG4.jpg')}}">
                </a>
                <a href="">
                    <img src="{{asset('Images/Footer/IG5.jpg')}}">
                </a>
                <a href="">
                    <img src="{{asset('Images/Footer/IG7.jpg')}}">
                </a>
                <a href="">
                    <img src="{{asset('Images/Footer/IG8.jpg')}}">
                </a>
                <a href="">
                    <img src="{{asset('Images/Footer/IG9.jpg')}}">
                </a>
                <div class="clearfix"></div>
            </div>
        </div>
        <div class="footer-widget">
            <h4 class="footer-widget-title">
                <a href="#">Information</a>
            </h4>
            <div class="footer-nav">
                <ul>
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">Contact Us</a></li>
                    <li><a href="#">Gift Certificates</a></li>
                    <li><a href="#">Specials</a></li>
                    <li><a href="#">Delivery Information</a></li>
                    <li><a href="#">Terms &amp; Conditions</a></li>
                    <li><a href="#">Brands</a></li>
                    <li><a href="#">Affiliate</a></li>
                    <li><a href="#">Site Map</a></li>
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
