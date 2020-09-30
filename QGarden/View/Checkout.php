<?php
/** Check Access **/
if (!defined('QGAccessGrained')) {header("HTTP/2 404 Not Found"); exit();}

$CartHandler = new \Model\Cart();

$Cart = json_decode($_SESSION['Cart'], true);

$CartInfo = $Cart['CartInfo'];
$CartList = $Cart['CartList'];
?>

<div class="container">
    <?php
    if (empty($Cart) or empty($CartInfo))
    {
        echo
        '
        <div class="title margin-bottom-20 margin-top-40">
            <h2>
                Giỏ hàng rỗng
            </h2>
        </div>
        </div>
        '; goto End;
    }
    ?>
    <section class="QGCheckout margin-top-40">
        <div class="address-form">
            <h4 class="checkout-title">Địa chỉ nhận hàng</h4>
            <form>

                <div class="form-mid-box">
                    <label>Người nhận*</label>
                    <input type="text" id="cart-user-name" placeholder="Người nhận" value="<?=$_SESSION['UserName']?>">
                </div>

                <div class="form-mid-box">
                    <label>Địa chỉ mail*</label>
                    <input type="email" id="cart-user-mail" placeholder="Địa chỉ mail" value="<?=$_SESSION['UserMail']?>">
                </div>

                <div class="form-full-box">
                    <label>Số điện thoại*</label>
                    <input type="text" id="cart-user-phone" placeholder="Số điện thoại" value="<?=$_SESSION['UserPhoneNumber']?>">
                </div>

                <div class="form-full-box">
                    <label>Địa chỉ nhận*</label>
                    <input type="text" id="cart-user-address" placeholder="Địa chỉ nhận" value="<?=$_SESSION['UserAddress']?>">
                </div>

                <div class="clearfix"></div>
            </form>
        </div>
        <div class="bill-info">
            <h4 class="checkout-title">chi tiết giỏ hàng</h4>

            <div class="checkout-summary-content">

                <h4>Sản Phẩm <span class="list-title">Thành tiền</span></h4>

                <ul>
                    <?php
                    foreach ($CartList as $ProductKey => $CartProduct)
                    {
                        echo
                        '<li>
                            '.$CartHandler -> GetProductName($ProductKey).'
                            <div style="float: right; display: inline">
                                <span style="float: unset">x'.$CartProduct['ProductUnit'].' </span>
                                <span style="float: unset"> VNĐ '.number_format($CartProduct['TotalPrice'], 0, '', '.').'</span>
                            </div>
                        </li>
                        ';
                    }
                    ?>
                </ul>

                <p>Tổng <span><?=number_format($CartInfo['TotalPriceAfterDiscount'], 0, '', '.')?></span></p>
                <p>Phí vận chuyển <span>VNĐ 30.000</span></p>
                <p>Mã giảm giá <span>
                        <?php
                        if ($Cart['CartInfo']['DiscountCouponApplied'] !== "")
                        {
                            echo $Cart['CartInfo']['DiscountCouponApplied'];
                        } else echo 'No.'
                        ?>
                    </span></p>
                <h4 class="margin-top-i20">Cần thanh toán <span class="list-title">VNĐ <?=number_format($CartInfo['TotalPriceAfterDiscount'], 0, '', '.')?></span></h4>
                <div class="clearfix"></div>
            </div>
        </div>
        <div class="clearfix"></div>
        <button id="CheckOut" class="checkout-btn">Đặt hàng</button>
    </section>
    <div class="clearfix"></div>
</div>
<?php
End:
?>
