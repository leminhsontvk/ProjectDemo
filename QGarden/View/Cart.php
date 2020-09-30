<?php
/** Check Access **/
if (!defined('QGAccessGrained')) {header("HTTP/2 404 Not Found"); exit();}

$CartHandler = new \Model\Cart();

$Cart = json_decode($_SESSION['Cart'], true);

$CartInfo = $Cart['CartInfo'];

foreach ($Cart['CartList'] as $ProductID => $Unused)
{
    $Cart['CartList'][$ProductID]['ProductID'] = $ProductID;
    $Cart['CartList'][$ProductID]['ProductName'] = $CartHandler -> GetProductName($ProductID);
    $Cart['CartList'][$ProductID]['ProductImage'] = $CartHandler -> GetProductImage($ProductID);
}

?>

<div class="container">
    <section class="QGCart margin-top-40">
        <?php
        if (empty($Cart) or empty($CartInfo))
        {
            echo
            '
        <div class="title margin-bottom-20">
            <h2>
                Giỏ hàng rỗng
            </h2>
        </div>
</section>
</div>
        '; goto End;
        }
        ?>
        <div class="cart-table-container">
            <div class="cart-table margin-bottom-40">
                <table class="table">
                    <thead>
                    <tr>
                        <th class="pro-thumbnail">Ảnh</th>
                        <th class="pro-title">Tên sản phẩm</th>
                        <th class="pro-price">Giá</th>
                        <th class="pro-quantity">Số lượng</th>
                        <th class="pro-subtotal">Thành tiền</th>
                        <th class="pro-remove">Xóa</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($Cart['CartList'] as $CartList)
                    {
                        echo
                        '
                        <tr>
                        <td class="pro-thumbnail">
                            <a href="?QGPage=Product&Product='.$CartList['ProductID'].'">
                                <img src="'.$PublicConfig::WebImagesRoot.$CartList['ProductImage'].'" alt="Product">
                            </a>
                        </td>
                        <td class="pro-title">
                            <a href="?QGPage=Product&Product='.$CartList['ProductID'].'">'.$CartList['ProductName'].'</a>
                        </td>
                        <td class="pro-price">
                            <span>VNĐ '.number_format($CartList['PricePerUnit'], 0, "",".").'</span>
                        </td>
                        <td class="pro-quantity">
                            <div class="pro-qty">
                                <input type="hidden" id="ProductID" value="'.$CartList['ProductID'].'">
                                <input type="text" id="cart-qty-value" value="'.$CartList['ProductUnit'].'" disabled>
                                <a id="cart-qty-inc" class="inc qty-btn">+</a>
                                <a id="cart-qty-dec" class="dec qty-btn">-</a>
                            </div>
                        </td>
                        <td class="pro-subtotal">
                            <span id="total-price">VNĐ '.number_format($CartList['TotalPrice'], 0, "",".").'</span>
                        </td>
                        <td class="pro-remove">
                            <a id="RemoveFromCart" value="'.$CartList['ProductID'].'">
                                <i class="fal fa-trash-alt"></i>
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
        <div class="cart-summary">
            <div class="cart-summary-content">
                <h4>Tổng quan giỏ hàng</h4>
                <p>Tổng <span>VNĐ <?=number_format($CartInfo['TotalPrice'], 0, '', '.');?></span></p>
                <p>Phí vận chuyển <span>VNĐ 30.000</span></p>
                <p>Coupon <span>
                        <?php
                        if ($Cart['CartInfo']['DiscountCouponApplied'] !== "")
                        {
                            echo $Cart['CartInfo']['DiscountCouponApplied'];
                        } else echo 'No.'
                        ?>
                    </span></p>
                <form>
                    <input type="text" id="CouponCode" placeholder="Coupon Code">
                    <button id="AddCoupon" type="submit">Áp dụng</button>
                </form>
                <h2>Thành Tiền <span>VNĐ <?=number_format($CartInfo['TotalPriceAfterDiscount'], 0, '', '.');?></span></h2>
            </div>
            <div class="cart-summary-button">
                <button ID="GoCheckout" class="checkout-btn">Đặt Hàng</button>
            </div>
        </div>
    </section>
    <div class="clearfix"></div>
</div>
<?php
End:
?>

