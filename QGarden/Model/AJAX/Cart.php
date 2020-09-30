<?php
session_start();
ini_set('display_errors', 'off');

/**
 * Recall all Class needed by AJAX Module
 */

include_once '../../Core/Core.php';
include_once '../../Core/Config.php';
include_once '../../Core/Database.php';

include_once '../../Libs/SendGrid/SendGrid.php';
include_once '../../Model/Cart.php';

$Core = new Core\Core();
$CartHandler = new \Model\Cart();

if ($_POST['Action'] === "AddToCart")
{
    $Return = array();

    if ($_SESSION['Cart'])
    {
        $Cart = json_decode($_SESSION['Cart'], true);
    } else $Cart = array();

    $CartInfoTotalPrice = 0;
    $Return['StatusCode'] = 1;

    $PricePerUnit = $CartHandler -> GetProductPrice($_POST['ProductID']);

    $ProductUnit = $_POST['ProductUnit'];
    $TotalPrice = (int)$ProductUnit * (int)$PricePerUnit;

    $Cart['CartList'][$_POST['ProductID']]['TotalPrice'] = $TotalPrice;
    $Cart['CartList'][$_POST['ProductID']]['PricePerUnit'] = $PricePerUnit;
    $Cart['CartList'][$_POST['ProductID']]['ProductUnit'] = ($ProductUnit <= 10) ? $ProductUnit : 10;

    foreach ($Cart['CartList'] as $Price)
    {
        $CartInfoTotalPrice += $Price['TotalPrice'];
    }

    $Cart['CartInfo']['TotalPrice'] = $CartInfoTotalPrice;

    $Return['ProductTotalPrice'] = $TotalPrice;
    $Return['CartTotalPrice'] = $CartInfoTotalPrice;

    if ($Cart['CartInfo']['DiscountCouponApplied'] != NULL)
    {
        $Cart['CartInfo']['TotalPriceAfterDiscount'] = $CartInfoTotalPrice - ($CartInfoTotalPrice * ($CartHandler -> GetCouponDiscount($Cart['CartInfo']['DiscountCouponApplied']) / 100)) + 30000;

        $Return['TotalPriceAfterDiscount'] = $Cart['CartInfo']['TotalPriceAfterDiscount'];
    }
    else
    {
        $Cart['CartInfo']['TotalPriceAfterDiscount'] = $CartInfoTotalPrice + 30000;
        $Return['TotalPriceAfterDiscount'] = $Cart['CartInfo']['TotalPriceAfterDiscount'];
    }

    $Return['CartQTY'] = count($Cart['CartList']);

    $_SESSION['Cart'] = json_encode($Cart);

    echo json_encode($Return);
}

if ($_POST['Action'] === "RemoveFromCart")
{
    $Return = array();

    if ($_SESSION['Cart'])
    {
        $Cart = json_decode($_SESSION['Cart'], true);
    }
    else
    {
        $Return['StatusCode'] = 0;
        echo json_encode($Return);
        return;
    }

    $CartInfoTotalPrice = 0;
    $Return['StatusCode'] = 1;

    unset($Cart['CartList'][$_POST['ProductID']]);

    if (empty($Cart['CartList']))
    {
        unset($_SESSION['Cart']);
        unset($Cart['CartInfo']['DiscountCouponApplied']);
    }

    foreach ($Cart['CartList'] as $Price)
    {
        $CartInfoTotalPrice += $Price['TotalPrice'];
    }

    $Cart['CartInfo']['TotalPrice'] = $CartInfoTotalPrice;

    $Return['ProductTotalPrice'] = $TotalPrice;
    $Return['CartTotalPrice'] = $CartInfoTotalPrice;

    if ($Cart['CartInfo']['DiscountCoupon'] != "")
    {
        $Discount = ($CartHandler -> GetCouponDiscount($Cart['CartInfo']['DiscountCouponApplied']) / 100);
        $Cart['CartInfo']['TotalPriceAfterDiscount'] = $CartInfoTotalPrice - ($CartInfoTotalPrice * $Discount) + 30000;

        $Return['TotalPriceAfterDiscount'] = $Cart['CartInfo']['TotalPriceAfterDiscount'];
    }
    else
    {
        $Cart['CartInfo']['TotalPriceAfterDiscount'] = $CartInfoTotalPrice;
        $Return['TotalPriceAfterDiscount'] = $Cart['CartInfo']['TotalPriceAfterDiscount'];
    }

    $_SESSION['Cart'] = json_encode($Cart);
    echo json_encode($Return);
}

if ($_POST['Action'] === "AddCoupon")
{
    $Return = array();

    if ($_SESSION['Cart'])
    {
        $Cart = json_decode($_SESSION['Cart'], true);
    } else $Cart = array();

    $CartInfoTotalPrice = 0;
    $Return['StatusCode'] = 1;

    foreach ($Cart['CartList'] as $Price)
    {
        $CartInfoTotalPrice += $Price['TotalPrice'];
    }

    $Cart['CartInfo']['TotalPrice'] = $CartInfoTotalPrice;

    if ($_POST['CouponCode'])
    {
        if ($CartHandler -> CheckCoupon($_POST['CouponCode']) == NULL)
        {
            goto End;
        }
        $Cart['CartInfo']['DiscountCouponApplied'] = $_POST['CouponCode'];
        $Cart['CartInfo']['TotalPriceAfterDiscount'] = $CartInfoTotalPrice - ($CartInfoTotalPrice * ($CartHandler -> GetCouponDiscount($_POST['CouponCode']) / 100)) + 30000;

        $Return['TotalPriceAfterDiscount'] = $Cart['CartInfo']['TotalPriceAfterDiscount'];
    }
    else
    {
        End:
        $Return['StatusCode'] = 0;
        $Return['ErrorMessage'] = "Mã giảm giá không tồn tại hoặc đã hết hạn.";
        $Cart['CartInfo']['TotalPriceAfterDiscount'] = $CartInfoTotalPrice;
        $Return['TotalPriceAfterDiscount'] = $Cart['CartInfo']['TotalPriceAfterDiscount'];
    }

    $_SESSION['Cart'] = json_encode($Cart);

    echo json_encode($Return);
}

if ($_POST['Action'] === "Checkout")
{
    $Cart = json_decode($_SESSION['Cart'], true);

    $CartInfo = $Cart['CartInfo'];
    $CartProduct = $Cart['CartList'];

    if ($CartInfo['DiscountCouponApplied']) $Coupon = $CartInfo['DiscountCouponApplied']; else $Coupon = NULL;

    $CartID = $CartHandler -> AddBill($_POST['UserAddress'], $_POST['UserPhone'], $_POST['UserMail'], $CartInfo['TotalPriceAfterDiscount'] + 30000, $Coupon, $_POST['UserName']);

    foreach ($CartProduct as $ProductID => $Product)
    {
        $CartHandler -> AddBillDetail($CartID, $ProductID, $Product['ProductUnit']);
    }

    $Return = array();
    $Return['StatusCode'] = 1;

    echo json_encode($Return);
    unset($_SESSION['Cart']);
}