<?php
/** Check Access **/
if (!defined('QGAccessGrained')) {header("HTTP/2 404 Not Found"); exit();}

$CouponList = $Super -> GetCoupon();
?>
<div class="container">
    <div class="cart-table-container margin-top-40">
        <div class="title margin-bottom-20">
            <h2>
                Danh Sách Mã Giảm Giá
            </h2>
        </div>
        <form id="cedit" class="hidden margin-bottom-20">
            <div class="form-mid-box margin-bottom-20">
                <label for="EditCouponCode">
                    Mã Giảm Giá
                </label>
                <input id="EditCouponCode" value="">
            </div>
            <div class="form-mid-box form-mid-box-right margin-bottom-20">
                <label for="EditDiscount">
                    Mức Giảm Giá
                </label>
                <input type="number" value="" id="EditDiscount" max="90">
            </div>
            <div class="form-full-box margin-bottom-20">
                <label for="EditExpireDate">
                    Ngày Hết Hạn
                </label>
                <input type="date" value="" id="EditExpireDate">
            </div>
            <input type="hidden" id="EditID" value="1">
            <button type="submit" class="checkout-btn" id="DoCouponEdit">Sửa Coupon</button>
            <div class="clearfix"></div>
        </form>
        <form id="cadd" class="hidden margin-bottom-20">
            <div class="form-mid-box margin-bottom-20">
                <label for="CouponCode">
                    Mã Giảm Giá
                </label>
                <input id="CouponCode" value="">
            </div>
            <div class="form-mid-box form-mid-box-right margin-bottom-20">
                <label for="Discount">
                    Mức Giảm Giá
                </label>
                <input type="number" value="" id="Discount">
            </div>
            <div class="form-full-box margin-bottom-20">
                <label for="ExpireDate">
                    Ngày Hết Hạn
                </label>
                <input type="date" value="" id="ExpireDate">
            </div>
            <input type="hidden" id="EditID" value="">
            <button type="submit" class="checkout-btn" id="DoCouponAdd">Thêm Coupon</button>
            <div class="clearfix"></div>
        </form>
        <button style="margin-bottom: 20px!important;" id="AddNew" type="submit" class="checkout-btn">Thêm mã giảm giá</button>
        <div class="clearfix"></div>
        <div class="cart-table">
            <table class="table">
                <thead>
                <tr>
                    <th class="pro-title">STT</th>
                    <th class="pro-title">Mã giảm giá</th>
                    <th class="pro-title">Mức giảm giá (%)</th>
                    <th class="pro-title">Tên Admin Tạo Mã</th>
                    <th class="pro-title">Ngày tạo</th>
                    <th class="pro-title">Ngày hết hạn</th>
                    <th class="pro-title">Thao tác</th>
                </tr>
                </thead>
                <tbody>

                <?php
                foreach ($CouponList as $CurrentKey => $Coupon)
                {
                    echo
                    '
                    <tr>
                    <td class="pro-title">
                        <span>'.($CurrentKey + 1).'</span>
                    </td>
                    <td class="pro-subtotal">
                        <span>'.$Coupon['CouponCode'].'</span>
                    </td>
                    <td class="pro-subtotal">
                        <span>'.$Coupon['CouponDiscount'].'%</span>
                    </td>
                    <td class="product-title">
                        <span>'.$Coupon['UserName'].'</span>
                    </td>
                    <td class="product-title">
                        <span>'.$Core -> ReturnDate($Coupon['CreateDate']).'</span>
                    </td>
                    <td class="product-title">
                        <span>'.$Core -> ReturnDate($Coupon['ExpireDate']).'</span>
                    </td>
                    <td class="pro-action">
                        <input type="hidden" value="'.$Coupon['CouponID'].'" id="SubjectID">
                        <a class="a-danger" id="DeleteCoupon" value="1">
                            <i class="fal fa-trash-alt"></i>
                        </a>
                        <tab></tab>
                        <a id="EditCoupon" value="1">
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
</div>