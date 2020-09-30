<?php
/**
 * Pre-Configure
 */

ini_set('display_errors', 'off');
session_start();

include_once '../../Core/Core.php';
include_once '../../Core/Config.php';
include_once '../../Core/Database.php';

include_once '../../Model/User.php';
include_once '../../Model/SuperUser.php';

$Core = new \Core\Core();
$PublicConfig = new \Core\Config();

if (isset($_POST['Action']) AND $_POST['Action'] === "Add")
{
    if ($_POST['SubjectName'] === "Coupon")
    {
        $Return = array();

        $EditStatus = (new \Model\SuperUser()) -> AddCoupon($_POST['CouponCode'], $_POST['CouponDiscount'], strtotime($_POST['CouponExpireDate']));

        $Return['StatusCode'] = ($EditStatus === true) ? 1 : 0;

        echo json_encode($Return);
        return;
    }

    if ($_POST['SubjectName'] === "Product")
    {
        $Return = array();

        if ($_FILES['ProductImage'])
        {
            $Loop = 0;
            $ProductImage = array();
            foreach ($_FILES['ProductImage']['name'] as $ImageName)
            {
                if ($Loop === 4) break;
                move_uploaded_file($_FILES['ProductImage']['tmp_name'][$Loop], $PublicConfig::ImagesRoot.'/Products/'.$ImageName);

                $ProductImage[] = '/Products/'.$ImageName;
                $Loop++;
            }

            if (!empty($ProductImage))
            {
                $ProductImage = json_encode($ProductImage);
            } else $ProductImage = NULL;
        }

        if ($_POST['ProductName']) $ProductName = $_POST['ProductName']; else $ProductName = NULL;
        if ($_POST['ProductDecs']) $ProductDecs = $_POST['ProductDecs']; else $ProductDecs = NULL;
        if ($_POST['ProductPrice']) $ProductPrice = (int)$_POST['ProductPrice']; else $ProductPrice = 0;
        if ($_POST['ProductPreview']) $ProductPreview = $_POST['ProductPreview']; else $ProductPreview = NULL;
        if ($_POST['ProductDiscount']) $ProductDiscount = (int)$_POST['ProductDiscount']; else $ProductDiscount = 0;
        if ($_POST['ProductAvailable']) $ProductAvailable = (int)$_POST['ProductAvailable']; else $ProductAvailable = 0;
        if ($_POST['ProductCategoryID']) $ProductCategoryID = (int)$_POST['ProductCategoryID']; else $ProductName = NULL;

        if ($_POST['ProductDiscount'] == 0) $ProductDiscount = (int)0;

        $EditStatus = (new \Model\SuperUser()) -> AddProduct($ProductName, $ProductDecs, $ProductPrice, $ProductDiscount, $ProductAvailable, $ProductCategoryID, $ProductImage, $ProductPreview);

        $Return['StatusCode'] = ($EditStatus) ? 1 : 0;

        echo json_encode($Return);
        return;
    }

    if ($_POST['SubjectName'] === "News")
    {
         $Return = array();

         move_uploaded_file($_FILES['NewsImage']['tmp_name'], $PublicConfig::ImagesRoot.'/News/'.$_FILES['NewsImage']['name']);

         $NewsImage = '/News/'.$_FILES['NewsImage']['name'];

        $EditStatus = (new \Model\SuperUser()) -> AddNews($_POST['NewsTitle'], $_POST['NewsPreview'], $_POST['NewsContent'], $NewsImage);

        $Return['StatusCode'] = ($EditStatus === true) ? 1 : 0;

        echo json_encode($Return);
        return;
    }

    if ($_POST['SubjectName'] === "Category")
    {
        $Return = array();

        move_uploaded_file($_FILES['ProductImage']['tmp_name'], $PublicConfig::ImagesRoot.'/Category/'.$_FILES['NewsImage']['name']);

        $NewsImage = '/Category/'.$_FILES['NewsImage']['name'];

        $EditStatus = (new \Model\SuperUser()) -> AddCategory($_POST['CategoryName'], $NewsImage);

        $Return['StatusCode'] = ($EditStatus === true) ? 1 : 0;

        echo json_encode($Return);
        return;
    }
}

if (isset($_POST['Action']) AND $_POST['Action'] === "GetData")
{
    if ($_POST['SubjectName'] === "Category")
    {
        include_once '../../Model/Category.php';

        $Return = array();
        $CategoryData = (new \Model\Category()) -> GetCategoryList($_POST['SubjectID']);

        $Return['StatusCode'] = 1;
        $Return['CategoryName'] = $CategoryData['CategoryName'];

        echo json_encode($Return);
        return;
    }

    if ($_POST['SubjectName'] === "Coupon")
    {
        include_once '../../Model/SuperUser.php';

        $Return = array();
        $CouponInfo = (new \Model\SuperUser()) -> GetCoupon($_POST['SubjectID']);

        $Return['StatusCode'] = 1;
        $Return['CouponCode'] = $CouponInfo['CouponCode'];
        $Return['Discount'] = $CouponInfo['CouponDiscount'];
        $Return['ExpireDate'] = date('Y-m-d', $CouponInfo['ExpireDate']);

        echo json_encode($Return);
        return;
    }
}

if ((isset($_POST['Action']) AND $_POST['Action'] === "Edit"))
{
    if ($_POST['SubjectName'] === "Category")
    {
        $Return = array();

        if ($_FILES['CategoryImage'])
        {
            move_uploaded_file($_FILES['CategoryImage']['tmp_name'], $PublicConfig::ImagesRoot.'/Category/'.$_FILES['CategoryImage']['name']);

            $CategoryImage = '/Category/'.$_FILES['CategoryImage']['name'];
        } else $CategoryImage = NULL;
        $EditStatus = (new \Model\SuperUser()) -> EditCategory($_POST['SubjectID'], $_POST['CategoryName'], $CategoryImage);

        $Return['StatusCode'] = ($EditStatus === true) ? 1 : 0;

        echo json_encode($Return);
        return;
    }

    if ($_POST['SubjectName'] === "Coupon")
    {
        $Return = array();

        $EditStatus = (new \Model\SuperUser()) -> EditCoupon($_POST['SubjectID'], $_POST['CouponCode'], $_POST['CouponDiscount'], strtotime($_POST['CouponExpireDate']));

        $Return['StatusCode'] = ($EditStatus === true) ? 1 : 0;

        echo json_encode($Return);
        return;
    }

    if ($_POST['SubjectName'] === "Product")
    {
        $Return = array();

        if ($_FILES['ProductImage'])
        {
            $Loop = 0;
            $ProductImage = array();
            foreach ($_FILES['ProductImage']['name'] as $ImageName)
            {
                if ($Loop === 4) break;
                move_uploaded_file($_FILES['ProductImage']['tmp_name'][$Loop], $PublicConfig::ImagesRoot.'/Products/'.$ImageName);

                $ProductImage[] = '/Products/'.$ImageName;
                $Loop++;
            }

            if (!empty($ProductImage))
            {
                $ProductImage = json_encode($ProductImage);
            } else $ProductImage = NULL;
        }

        if ($_POST['ProductName']) $ProductName = $_POST['ProductName']; else $ProductName = NULL;
        if ($_POST['ProductDecs']) $ProductDecs = $_POST['ProductDecs']; else $ProductDecs = NULL;
        if ($_POST['ProductPrice']) $ProductPrice = $_POST['ProductPrice']; else $ProductPrice = NULL;
        if ($_POST['ProductPreview']) $ProductPreview = $_POST['ProductPreview']; else $ProductPreview = NULL;
        if ($_POST['ProductAvailable']) $ProductAvailable = $_POST['ProductAvailable']; else $ProductAvailable = NULL;
        if ($_POST['ProductDiscount']) $ProductDiscount = (int)$_POST['ProductDiscount']; else $ProductDiscount = NULL;
        if ($_POST['ProductCategoryID']) $ProductCategoryID = (int)$_POST['ProductCategoryID']; else $ProductName = NULL;

        if ($_POST['ProductDiscount'] == 0) $ProductDiscount = (int)0;

        $EditStatus = (new \Model\SuperUser()) -> EditProduct($_POST['SubjectID'], $ProductName, $ProductDecs, $ProductPrice, $ProductDiscount, $ProductAvailable, $ProductCategoryID, $ProductImage, $ProductPreview);

        $Return['StatusCode'] = ($EditStatus) ? 1 : 0;

        echo json_encode($Return);
        return;
    }

    if ($_POST['SubjectName'] === "News")
    {
        $Return = array();

        if ($_FILES['NewsImage'])
        {
            move_uploaded_file($_FILES['NewsImage']['tmp_name'], $PublicConfig::ImagesRoot.'/News/'.$_FILES['NewsImage']['name']);

            $CategoryImage = '/News/'.$_FILES['NewsImage']['name'];
        } else $CategoryImage = NULL;
        $EditStatus = (new \Model\SuperUser()) -> EditNews($_POST['SubjectID'], $_POST['NewsTitle'], $_POST['NewsPreview'], $_POST['NewsContent'], $CategoryImage);

        $Return['StatusCode'] = ($EditStatus === true) ? 1 : 0;

        echo json_encode($Return);
        return;
    }
}

if ((isset($_POST['Action']) AND $_POST['Action'] === "Delete"))
{
    if ($_POST['SubjectName'] === "Category")
    {
        $Return = array();

        if (!$_POST['Confirm'])
        {
            $DeleteStatus = (new \Model\SuperUser()) -> DeleteCategory($_POST['SubjectID']);
            $Return['StatusCode'] = ($DeleteStatus === true) ? 1 : 2;
        }
        else
        {
            $DeleteStatus = (new \Model\SuperUser()) -> DeleteCategory($_POST['SubjectID'], true);
            $Return['StatusCode'] = ($DeleteStatus === true) ? 1 : 0;
        }

        echo json_encode($Return);
        return;
    }

    if ($_POST['SubjectName'] === "Product")
    {
        $Return = array();

        $DeleteStatus = (new \Model\SuperUser()) -> DeleteProduct($_POST['SubjectID']);
        $Return['StatusCode'] = ($DeleteStatus === true) ? 1 : 0;

        echo json_encode($Return);
        return;
    }

    if ($_POST['SubjectName'] === "News")
    {
        $Return = array();

        $DeleteStatus = (new \Model\SuperUser()) -> DeleteNews($_POST['SubjectID']);
        $Return['StatusCode'] = ($DeleteStatus === true) ? 1 : 0;

        echo json_encode($Return);
        return;
    }

    if ($_POST['SubjectName'] === "Coupon")
    {
        $Return = array();

        $DeleteStatus = (new \Model\SuperUser()) -> DeleteCoupon($_POST['SubjectID']);
        $Return['StatusCode'] = ($DeleteStatus === true) ? 1 : 0;

        echo json_encode($Return);
        return;
    }
}

if ((isset($_POST['Action']) AND $_POST['Action'] === "Block"))
{
    $Return = array();

    $DeleteStatus = (new \Model\SuperUser()) -> DoBlock($_POST['SubjectID']);
    $Return['StatusCode'] = ($DeleteStatus === true) ? 1 : 0;

    echo json_encode($Return);
    return;
}

if ((isset($_POST['Action']) AND $_POST['Action'] === "Unblock"))
{
    $Return = array();

    $DeleteStatus = (new \Model\SuperUser()) -> DoUnblock($_POST['SubjectID']);
    $Return['StatusCode'] = ($DeleteStatus === true) ? 1 : 0;

    echo json_encode($Return);
    return;
}

if ((isset($_POST['Action']) AND $_POST['Action'] === "MakeSuper"))
{
    $Return = array();

    $DeleteStatus = (new \Model\SuperUser()) -> MakeSuper($_POST['SubjectID']);
    $Return['StatusCode'] = ($DeleteStatus === true) ? 1 : 0;

    echo json_encode($Return);
    return;
}

if ((isset($_POST['Action']) AND $_POST['Action'] === "SendMail"))
{
    include_once '../../Libs/SendGrid/SendGrid.php';

    $Return = array();

    if (strpos($_POST['MailList'], ',') !== false)
    {
        $MailList = explode(',', $_POST['MailList']);
        $UserList = explode(',', $_POST['UserList']);
    }
    else
    {
        $MailList[] = ($_POST['MailList']);
        $UserList[] = ($_POST['UserList']);
    }

    $Loop = 0;
    $Return['StatusCode'] = 1;
    foreach ($MailList as $Mail)
    {
        $Mailer = new \SendGrid\Mail\Mail();

        try
        {
            $Mailer -> setFrom($_POST['FromMail'], 'QGarden');
        }
        catch (\SendGrid\Mail\TypeException $Error)
        {
            (new \Core\Core) -> LogFile($Error -> getMessage(), 'Mail Sender.', get_defined_vars());
            return false;
        }

       if ($_POST['Temple'] == 2)
       {
           $Mailer -> addTo($Mail, $UserList[$Loop]);
           $Mailer -> setSubject($_POST['MailTitle']);

           $Mailer -> addDynamicTemplateData('UserName', $UserList[$Loop]);
           $Mailer -> addDynamicTemplateData('CouponCode', $_POST['CouponCode']);
           $Mailer -> setTemplateId('d-5948358e5c5b46f5a7a8e13e3bb3ff12');

           $Sender = new \SendGrid('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');

           try
           {
               $Return['StatusCode'] = 1;
               $Result = $Sender -> send($Mailer);
               (new \Core\Core) -> LogFile('', '\Model\User\Register.SendMail', $Result);
           }
           catch (\Exception $Error)
           {
               $Return['StatusCode'] = 0;
               (new \Core\Core) -> LogFile($Error -> getMessage(), '\Model\User\Register.SendMail', get_defined_vars());
           }

           unset($Mailer);
           unset($Sender);

           $Loop++;
       }
       else
       {
           $Mailer -> addTo($Mail, $UserList[$Loop]);
           $Mailer -> setSubject($_POST['MailTitle']);
           $Mailer -> addContent('text/html', $_POST['Content']);

           $Sender = new \SendGrid('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');

           try
           {
               $Result = $Sender -> send($Mailer);
               (new \Core\Core) -> LogFile('', '\Model\User\Register.SendMail', $Result);
           }
           catch (\Exception $Error)
           {
               (new \Core\Core) -> LogFile($Error -> getMessage(), '\Model\User\Register.SendMail', get_defined_vars());
           }

           unset($Mailer);
           unset($Sender);

           $Loop++;
       }
    }

    echo json_encode($Return);
}

if ((isset($_POST['Action']) AND $_POST['Action'] === "BillStatus"))
{
    $Return = array();

    $DeleteStatus = (new \Model\SuperUser()) -> EditBillStatus($_POST['SubjectID'], $_POST['Status']);

    $Return['StatusCode'] = ($DeleteStatus === true) ? 1 : 0;

    echo json_encode($Return);
    return;
}

if ((isset($_POST['Action']) AND $_POST['Action'] === "DeleteBill"))
{
    $Return = array();

    $DeleteStatus = (new \Model\SuperUser()) -> DeleteBill((int)$_POST['SubjectID']);

    $Return['StatusCode'] = ($DeleteStatus === true) ? 1 : 0;

    echo json_encode($Return);
    return;
}

if ((isset($_POST['Action']) AND $_POST['Action'] === "DeleteContact"))
{
    $Return = array();

    $DeleteStatus = (new \Model\SuperUser()) -> DeleteReceivedContact((int)$_POST['SubjectID']);

    $Return['StatusCode'] = ($DeleteStatus === true) ? 1 : 0;

    echo json_encode($Return);
    return;
}

if ((isset($_POST['Action']) AND $_POST['Action'] === "AddBanner"))
{
    $Return = array();

    move_uploaded_file($_FILES['BannerImage']['tmp_name'], $PublicConfig::ImagesRoot.'/Banner/'.$_FILES['BannerImage']['name']);

    $NewsImage = '/Banner/'.$_FILES['BannerImage']['name'];

    $EditStatus = (new \Model\SuperUser()) -> AddBanner($NewsImage);

    $Return['StatusCode'] = ($EditStatus === true) ? 1 : 0;

    echo json_encode($Return);
    return;
}

if ((isset($_POST['Action']) AND $_POST['Action'] === "DeleteBanner"))
{
    $Return = array();

    $EditStatus = (new \Model\SuperUser()) -> DeleteBanner($_POST['SubjectID']);

    $Return['StatusCode'] = ($EditStatus === true) ? 1 : 0;

    echo json_encode($Return);
    return;
}

if ((isset($_POST['Action']) AND $_POST['Action'] === "BannerStatus"))
{
    $Return = array();

    $DeleteStatus = (new \Model\SuperUser()) -> UpdateBannerStatus($_POST['SubjectID'], $_POST['Status']);

    $Return['StatusCode'] = ($DeleteStatus === true) ? 1 : 0;

    echo json_encode($Return);
    return;
}
?>
