<?php
/** Check Access **/
if (!defined('QGAccessGrained')) {header("HTTP/2 404 Not Found"); exit();}

$CheckAdmin = new \Model\User();
$CartHandler = new \Model\Cart();

$IsAdmin = $CheckAdmin -> IsAdmin();
$IsOwner = empty($CartHandler -> CheckBillOwner($_GET['Bill']));

if ($IsAdmin !== true and $IsOwner !== false)
{
    echo
    '
    <div class="container">
        <section class="QGCart margin-top-40">
            <div class="title margin-bottom-20">
                <h2>
                    Hóa đơn không tồn tại hoặc không phải của bạn.
                </h2>
            </div>
        </section>
        <div class="clearfix"></div>
    </div>
    '; goto EndView;
}

$CartFromBill = $CartHandler -> GetBillDetail($_GET['Bill']);

?>

<div class="container">
    <section class="QGCart margin-top-40">
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
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($CartFromBill as $Cart)
                    {
                        $ProductName = $CartHandler -> GetProductName($Cart['ProductID']);
                        $ProductImage = $CartHandler -> GetProductImage($Cart['ProductID']);
                        $PricePerUnit = $CartHandler -> GetProductPrice($Cart['ProductID']);

                        $TotalPrice = $PricePerUnit * $Cart['ProductCount'];

                        echo
                        '
                        <tr>
                        <td class="pro-thumbnail">
                            <a href="?QGPage=Product&Product='.$Cart['ProductID'].'">
                                <img src="'.$PublicConfig::WebImagesRoot.$ProductImage.'" alt="Product">
                            </a>
                        </td>
                        <td class="pro-title">
                            <a href="?QGPage=Product&Product='.$Cart['ProductID'].'">'.$ProductName.'</a>
                        </td>
                        <td class="pro-price">
                            <span>VNĐ '.number_format($PricePerUnit, 0, "",".").'</span>
                        </td>
                        <td class="pro-price">
                            <span>x'.$Cart['ProductCount'].'</span>
                        </td>
                        <td class="pro-subtotal">
                            <span id="total-price">VNĐ '.number_format($TotalPrice, 0, "",".").'</span>
                        </td>
                    </tr>
                        ';
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <div class="clearfix"></div>
</div>

<?php
EndView:
?>
