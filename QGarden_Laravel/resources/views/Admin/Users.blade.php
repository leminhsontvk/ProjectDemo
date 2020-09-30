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
    <script src="../Themes/JS/Materialize.js"></script>
    <script src="../Themes/JS/SweetAlert/SweetAlert2.js"></script>
    <!-- Custom JS -->
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
                    <a href="#">Đăng Nhập hoặc Đăng Ký</a>
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
                <a href="index.html">Dashboard</a>
            </li>
            <li>
                <a href="index.html">Products</a>
            </li>
            <li>
                <a href="index.html">Category</a>
            </li>
            <li>
                <a href="index.html">Users</a>
            </li>
            <li>
                <a href="index.html">Coupons</a>
            </li>
            <li>
                <a href="index.html">Bills</a>
            </li>
            <li>
                <a href="index.html">Marketing</a>
            </li>
            <li>
                <a href="index.html">SiteInfo</a>
            </li>
        </ul>
    </div>
</div>
<div class="container">
    <div class="cart-table-container margin-top-40">
        <div class="title margin-bottom-20">
            <h2>
                Tài khoản người dùng
            </h2>
        </div>
        <div class="cart-table margin-bottom-20">
            <table class="table">
                <thead>
                <tr>
                    <th class="pro-title">STT</th>
                    <th class="pro-title">Ảnh đại diện</th>
                    <th class="pro-title">Tên người dùng</th>
                    <th class="pro-title">Login ID</th>
                    <th class="pro-title">Số Điện Thoại</th>
                    <th class="pro-title">Địa chỉ Mail</th>
                    <th class="pro-title">Trạng thái tài khoản</th>
                    <th class="pro-title">Thao tác</th>
                </tr>
                </thead>
                <tbody>

                <tr>
                    <td class="pro-title">
                        <span>1</span>
                    </td>
                    <td class="pro-avatar">
                        <a>
                            <img src="../Themes/Images/Avatars/1Img_3.jpg" alt="Product">
                        </a>
                    </td>
                    <td class="pro-subtotal">
                        <span>karry2811</span>
                    </td>
                    <td class="pro-subtotal">
                        <span>Lê Minh Sơn</span>
                    </td>
                    <td class="product-title">
                        <span>0352251115</span>
                    </td>
                    <td class="product-title">
                        <span>contact@lmsq.vn</span>
                    </td>
                    <td class="product-title">
                        <span>Active - Admin</span>
                    </td>
                    <td id="category-action" class="pro-action">
                        <input type="hidden" value="3" id="SubjectID">
                        <a class="a-danger" title="Khóa người dùng" id="BlockUser" value="1">
                            <i class="far fa-user-lock"></i>
                        </a>
                        <tab></tab>
                        <a title="Mở khóa người dùng" id="ActiveUser" value="1">
                            <i class="far fa-unlock-alt"></i>
                        </a>
                        <tab></tab>
                        <a id="MakeAdmin" title="Cấp quyền Super User" value="1">
                            <i class="fas fa-user-shield"></i>
                        </a>
                    </td>
                </tr>

                <tr>
                    <td class="pro-title">
                        <span>1</span>
                    </td>
                    <td class="pro-avatar">
                        <a>
                            <img src="../Themes/Images/Avatars/1Img_3.jpg" alt="Product">
                        </a>
                    </td>
                    <td class="pro-subtotal">
                        <span>karry2811</span>
                    </td>
                    <td class="pro-subtotal">
                        <span>Lê Minh Sơn</span>
                    </td>
                    <td class="product-title">
                        <span>0352251115</span>
                    </td>
                    <td class="product-title">
                        <span>contact@lmsq.vn</span>
                    </td>
                    <td class="product-title">
                        <span>Active - Admin</span>
                    </td>
                    <td id="category-action" class="pro-action">
                        <input type="hidden" value="3" id="SubjectID">
                        <a class="a-danger" title="Khóa người dùng" id="BlockUser" value="1">
                            <i class="far fa-user-lock"></i>
                        </a>
                        <tab></tab>
                        <a title="Mở khóa người dùng" id="ActiveUser" value="1">
                            <i class="far fa-unlock-alt"></i>
                        </a>
                        <tab></tab>
                        <a id="MakeAdmin" title="Cấp quyền Super User" value="1">
                            <i class="fas fa-user-shield"></i>
                        </a>
                    </td>
                </tr>

                <tr>
                    <td class="pro-title">
                        <span>1</span>
                    </td>
                    <td class="pro-avatar">
                        <a>
                            <img src="../Themes/Images/Avatars/1Img_3.jpg" alt="Product">
                        </a>
                    </td>
                    <td class="pro-subtotal">
                        <span>karry2811</span>
                    </td>
                    <td class="pro-subtotal">
                        <span>Lê Minh Sơn</span>
                    </td>
                    <td class="product-title">
                        <span>0352251115</span>
                    </td>
                    <td class="product-title">
                        <span>contact@lmsq.vn</span>
                    </td>
                    <td class="product-title">
                        <span>Active - Admin</span>
                    </td>
                    <td id="category-action" class="pro-action">
                        <input type="hidden" value="3" id="SubjectID">
                        <a class="a-danger" title="Khóa người dùng" id="BlockUser" value="1">
                            <i class="far fa-user-lock"></i>
                        </a>
                        <tab></tab>
                        <a title="Mở khóa người dùng" id="ActiveUser" value="1">
                            <i class="far fa-unlock-alt"></i>
                        </a>
                        <tab></tab>
                        <a id="MakeAdmin" title="Cấp quyền Super User" value="1">
                            <i class="fas fa-user-shield"></i>
                        </a>
                    </td>
                </tr>

                </tbody>
            </table>
        </div>
    </div>
    <footer style="min-height: unset" class="margin-top-20 padding-top-20">
        <div class="clearfix"></div>
        <div class="copyright">
            <p>Copyright © <span id="Year"></span> <a href="#">QGarden - LMSQ Group</a>. All Right Reserved.</p>
        </div>
    </footer>
</div>
</body>
</html>