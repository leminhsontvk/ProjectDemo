<?php
if (!defined('QGAccessGrained')) {header("HTTP/2 404 Not Found"); exit();}
?>

<div class="container">
    <div class="cart-table-container margin-top-40">
        <div class="title margin-bottom-20">
            <h2>
                Tài khoản người dùng
            </h2>
        </div>
        <form class="margin-bottom-20">
            <input type="hidden" name="Admin" value="Users">
            <div class="form-mid-box margin-bottom-20">
                <label for="SearchByName">
                    Tìm kiếm theo tên:
                </label>
                <input type="text" name="UserName">
            </div>
            <div class="form-mid-box form-mid-box-right margin-bottom-20">
                <label for="SearchByID">
                    Tìm kiếm theo Login ID:
                </label>
                <input type="text" name="UserLogin">
            </div>
            <button type="submit" style="margin-left: 10px;" id="ClearSearch" class="checkout-btn">Xóa Tìm Kiếm</button>
            <button type="submit" class="checkout-btn">Tìm Kiếm</button>
            <div class="clearfix"></div>
        </form>
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
                <?php
                foreach ($UserList as $CurrentKey => $UserInfo)
                {
                    if ($UserInfo['UserPermission'] == 0)
                    {
                        $Status = "Blocked or Not Active";

                        $AvailableLink =
                            '
                            <a title="Mở khóa người dùng" id="ActiveUser" value="1">
                                <i class="far fa-unlock-alt"></i>
                            </a>
                            ';
                    }

                    if ($UserInfo['UserPermission'] == 1)
                    {
                        $Status = "Active";
                        $AvailableLink =
                            '
                            <a class="a-danger" title="Khóa người dùng" id="BlockUser" value="1">
                                <i class="fal fa-user-slash"></i>
                            </a>
                            <tab></tab>
                            <a id="MakeAdmin" title="Cấp quyền Super User" value="1">
                                <i class="fas fa-user-shield"></i>
                            </a>
                            ';
                    }

                    if ($UserInfo['UserPermission'] == 4)
                    {
                        $Status = "Super - Active";
                        $AvailableLink =
                            '
                            <a class="a-danger" title="Khóa người dùng" id="BlockUser" value="1">
                                <i class="fal fa-user-slash"></i>
                            </a>
                            <tab></tab>
                            ';
                    }

                    echo
                    '
                    <tr>
                        <td class="pro-title">
                            <span>'.($CurrentKey + 1).'</span>
                        </td>
                        <td class="pro-avatar">
                            <a>
                                <img src="'.$PublicConfig::WebImagesRoot.$UserInfo['UserAvatar'].'" alt="Product">
                            </a>
                        </td>
                        <td class="pro-subtotal">
                            <span>'.$UserInfo['UserName'].'</span>
                        </td>
                        <td class="pro-subtotal">
                            <span>'.$UserInfo['UserLogin'].'</span>
                        </td>
                        <td class="product-title">
                            <span>'.$UserInfo['UserPhoneNumber'].'</span>
                        </td>
                        <td class="product-title">
                            <span>'.$UserInfo['UserMail'].'</span>
                        </td>
                        <td class="product-title">
                            <span>'.$Status.'</span>
                        </td>
                        <td id="category-action" class="pro-action">
                            <input type="hidden" value="'.$UserInfo['UserID'].'" id="SubjectID">
                            '.$AvailableLink.'
                        </td>
                    </tr>
                    ';
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="pagination-box">
        <?php ?>
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

            ?>
            Đang hiển thị <?=$From?> đến <?=$To?> trong <?=$All?> (<?=$PageCount?> Trang)
        </div>
    </div>
</div>
