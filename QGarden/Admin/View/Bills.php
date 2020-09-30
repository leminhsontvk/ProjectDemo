<?php
/** Check Access **/
if (!defined('QGAccessGrained')) {header("HTTP/2 404 Not Found"); exit();}

if ($_POST['BillID']) $BillID = (int)$_POST['BillID']; else $BillID = NULL;

$BillList = $Super -> GetBill($BillID);

$TotalProduct = count($BillList);
?>
<div class="container">
    <div class="cart-table-container margin-top-40">
        <div class="title margin-bottom-20">
            <h2>
                Danh sách hóa đơn
            </h2>
        </div>
        <form class="margin-bottom-20" method="POST">
            <div class="form-full-box margin-bottom-20">
                <label for="SearchBillID">
                    Tìm kiếm hóa đơn
                </label>
                <input id="SearchBillID" name="BillID" placeholder="Mã hóa đơn">
            </div>
            <button type="submit" class="checkout-btn">Tìm Kiếm</button>
            <div class="clearfix"></div>
        </form>
        <div class="cart-table margin-bottom-20">
            <table class="table">
                <thead class="thead-light">
                <tr>
                    <th class="pro-title">Mã Đơn Hàng</th>
                    <th>Người nhận</th>
                    <th>Ngày tạo đơn</th>
                    <th>Trạng Thái</th>
                    <th>Mã giảm giá</th>
                    <th>Tổng Tiền</th>
                    <th>Xem chi tiết</th>
                    <th>Thao Tác</th>
                </tr>
                </thead>
                <?php
                foreach ($BillList as $Bill)
                {
                    switch ($Bill['BillStatus'])
                    {
                        case 0:
                            $Status = "Đặt hàng thành công.";
                            break;
                        case 1:
                            $Status = "Đang giao hàng.";
                            break;
                        case 2:
                            $Status = "Giao hàng thành công.";
                            break;
                        case 3:
                            $Status = "Không giao được hàng.";
                            break;
                        case 4:
                            $Status = "Hóa đơn đã bị hủy.";
                            break;
                    }
                    echo
                    '
                    <tr>
                    <td class="pro-title">
                        <span>'.$Bill['BillID'].'</span>
                    </td>
                    <td class="pro-subtotal">
                        <span>'.$Bill['UserName'].'</span>
                    </td>
                    <td class="pro-subtotal">
                        <span>'.$Core -> ReturnDate($Bill['BillCreateDate']).'</span>
                    </td>
                    <td class="pro-title">
                        <span>'.$Status.'</span>
                    </td>
                    <td class="pro-title">
                        <span>'.$Bill['CouponCode'].'</span>
                    </td>
                    <td class="pro-title">
                        <span>VNĐ '.number_format($Bill['BillTotalCost'], 0, '', '.').'</span>
                    </td>
                    <td class="pro-subtotal">
                        <a href="../?QGPage=View&Bill='.$Bill['BillID'].'">Xem</a>
                    </td>
                    <td class="pro-action">
                        <input type="hidden" value="'.$Bill['BillID'].'" id="SubjectID">
                        <a class="a-danger" id="DeleteBill"  title="Xóa Hóa Đơn" value="'.$Bill['BillID'].'">
                            <i class="fal fa-trash-alt"></i>
                        </a>
                        <tab></tab>
                        <a id="SetShipping" title="Đang Giao Hàng" value="1">
                            <i class="fal fa-shipping-fast"></i>
                        </a>
                        <tab></tab>
                        <a id="SetDelivered" title="Đã Giao Hàng" value="2">
                            <i class="fal fa-box-check"></i>
                        </a>
                        <tab></tab>
                        <a id="SetCancel" title="Hủy Hóa Đơn" value="4">
                            <i class="fal fa-times-circle"></i>
                        </a>
                        <tab></tab>
                        <a id="SetDeliveryFail" title="Không Giao Được Hàng" value="3">
                            <i class="fal fa-file-times"></i>
                        </a>
                    </td>
                </tr>
                    ';
                }
                ?>
                <tbody>
                </tbody>
            </table>
        </div>
        <div class="pagination-box">
            <ul class="pagination">
                <?php
                echo $Core -> Page(count($BillList), $CurrentPage);
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
</div>
