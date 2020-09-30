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

    <!-- Module Alert -->
    <link href="{{asset('/JS/SweetAlert/SweetAlert2.css')}}" type="text/css" rel="stylesheet">
    <script src="{{asset('JS/SweetAlert/SweetAlert2.js')}}"></script>

    <!-- Custom JS -->
    <script src="{{asset('JS/Admin.js')}}"></script>

    <title>QGarden - The Admin</title>
</head>
<body>
<header>
    <div class="container">
        <div style="display: none" class="qgarden-header-top padding-bottom-10 padding-top-10">
            <div class="flex-box align-items-center">
                <div class="social-icons">
                </div>
                <div class="user-account">
                </div>
            </div>
        </div>
        <div class="qgarden-search-box padding-bottom-25 padding-top-25">
            <div style="justify-content: flex-start;" class="flex-box align-items-center">
                <div class="logo">
                    <a href="/admin/dashboard">
                        <img src="{{asset('Images/Default/Logo.png')}}" width="140px" height="40px">
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
                <a href="/admin/dashboard">Dashboard</a>
            </li>
            <li>
                <a href="/admin/product/">Products</a>
            </li>
            <li>
                <a href="/admin/category">Category</a>
            </li>

            <li>
                <a href="/admin/Bill">Bills</a>
            </li>


        </ul>
    </div>
</div>
<div class="container">
    @section('AdminView')
    @show
    <footer class="margin-top-20 padding-top-20">
        <div class="clearfix"></div>
        <div class="copyright">
            <p>Copyright © <span id="Year"></span> <a href="#">QGarden - LMSQ Group</a>. All Right Reserved.</p>
        </div>
    </footer>
</div>
</body>
</html>
