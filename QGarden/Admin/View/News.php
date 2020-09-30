<?php
if (!defined('QGAccessGrained')) {header("HTTP/2 404 Not Found"); exit();}
?>

<div class="container">
    <div class="cart-table-container margin-top-40">
        <div class="title margin-bottom-20">
            <h2>
                Danh Sách Tin Tức
            </h2>
        </div>
        <form action="?Admin=New" method="POST" class="margin-bottom-20">
            <button type="submit" class="checkout-btn">Thêm Tin Tức</button>
            <div class="clearfix"></div>
        </form>
        <div class="cart-table margin-bottom-20">
            <table class="table">
                <thead>
                <tr>
                    <th class="pro-title">STT</th>
                    <th class="pro-title">Ảnh mô tả</th>
                    <th class="pro-title">Tiêu đề tin tức</th>
                    <th class="pro-title">Bản Xem trước</th>
                    <th class="pro-title">Ngày đăng</th>
                    <th class="pro-title">Người đăng</th>
                    <th class="pro-title">Thao tác</th>
                </tr>
                </thead>
                <tbody>

                <?php
                foreach ($NewsList as $CurrentKey => $NewsInfo)
                {
                    echo
                    '
                    <tr>
                        <td class="pro-title">
                            <span>'.($CurrentKey + 1).'</span>
                        </td>
                        <td style="max-height: 130px!important;" class="pro-thumbnail">
                            <a href="../?QGPage=Read&News='.$NewsInfo['NewsID'].'" style="max-height: 130px!important;" >
                                <img style="max-height: 130px!important; max-width: 130px!important;"  src="'.$PublicConfig::WebImagesRoot.$NewsInfo['NewsDefaultImage'].'" alt="Product">
                            </a>
                        </td>
                        <td class="pro-subtotal">
                            <a href="../?QGPage=Read&News='.$NewsInfo['NewsID'].'" style="max-height: 130px!important;" >
                                <span>'.$NewsInfo['NewsTitle'].'</span>
                            </a>
                        </td>
                        <td class="pro-title">
                            <span>'.$NewsInfo['NewsPreview'].'</span>
                        </td>
                        <td class="pro-title">
                            <span>'.$Core -> ReturnDate($NewsInfo['NewsCreateDate']).'</span>
                        </td>
                        <td class="pro-subtotal">
                            <span>'.$NewsInfo['UserName'].'</span>
                        </td>
                        <td id="category-action" class="pro-action">
                            <input type="hidden" value="Category" id="SubjectName">
                            <input type="hidden" value="'.$NewsInfo['NewsID'].'" id="SubjectID">
                            <a class="a-danger" id="DeleteNews" value="1">
                                <i class="fal fa-trash-alt"></i>
                            </a>
                            <tab></tab>
                            <a href="?Admin=New&News='.$NewsInfo['NewsID'].'" value="1">
                                <i class="fal fa-edit"></i>
                            </a>
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
