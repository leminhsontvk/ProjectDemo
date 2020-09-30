<?php
/** Setup Security Check **/
define('QGAccessGrained', true);

/** Call Default Module **/
include_once 'Libs/Loader.php';

/**
 * Overall MVP Variable.
 **/
session_start();

if (isset($_REQUEST['Clean'])) unset($_SESSION['Search']);

if (isset($_GET['Page'])) $CurrentPage = $_GET['Page']; else $CurrentPage = 1;

if (isset($_GET['Category'])) $CategoryID = $_GET['Category']; else $CategoryID = NULL;

if (isset($_SESSION['Search'])) $_POST = json_decode(base64_decode($_SESSION['Search']), true);

/**
 * Init session
 */
if ($_COOKIE['PortalID'] AND (strcmp($_COOKIE['PHPSESSID'], $_COOKIE['PortalID']) != 0))
{
    $_COOKIE['PHPSESSID'] = $_COOKIE['PortalID'];

    session_destroy();
    session_id($_COOKIE['PortalID']);
    session_start();

    unset($_SESSION['Token']);
    header('location: ?'.http_build_query($_GET));
}

/**
 * Init Model Class
 */
$Core = new \Core\Core();
$SiteInfo = new \Model\Info();
$NewsHandler = new Model\News();
$Product = new \Model\Products();
$Category = new \Model\Category();
$PublicConfig = new \Core\Config();

/**
 * Call Object Class
 */
$SiteInfo = $SiteInfo -> GetSiteInfo();
$CategoryList = $Category -> GetCategoryList();
$NewsList = $NewsHandler -> GetNewsList($CurrentPage);
$TotalProduct = $Product -> GetTotalProduct($CategoryID);
$Pagination = $Core -> Page($TotalProduct, $CurrentPage);
$ProductList = $Product -> GetProductList($CurrentPage, $CategoryID);


/** Load Header */
include_once 'View/Header.php';

/** Controller **/
if (isset($_GET['QGPage']))
{
    switch ($_GET['QGPage'])
    {
        case 'Home':
            if (isset($_SESSION['Search'])) {unset($_SESSION['Search']); unset($_POST);}
            include_once 'View/Home.php';
            break;
        case 'Product':
            if (isset($_SESSION['Search'])) {unset($_SESSION['Search']); unset($_POST);}
            include_once 'View/ProductInfo.php';
            break;
        case 'Products':
            if ($_POST['Search'])
            {
                if ($_POST['IsSale']) $IsSale = (int)$_POST['IsSale']; else $IsSale = NULL;
                if ($_POST['PriceTo']) $PriceTo = $_POST['PriceTo']; else $PriceTo = NULL;
                if ($_POST['PriceFrom']) $PriceFrom = $_POST['PriceFrom']; else $PriceFrom = NULL;
                if ($_POST['SearchKey']) $SearchKey = $_POST['SearchKey']; else $SearchKey = NULL;
                if ($_POST['OnlyStar'] and $_POST['OnlyStar']!== 'NULL') $OnlyStar = $_POST['OnlyStar']; else $OnlyStar = NULL;

                $ProductList = $Product -> GetProductList($CurrentPage, $CategoryID, $SearchKey, $PriceFrom, $PriceTo, $OnlyStar, $IsSale);

                /**
                 * Reset total product matching search param product.
                 */
                $TotalProduct = (int) $Product -> GetTotalSearchProduct($CategoryID, $SearchKey, $PriceFrom, $PriceTo, $OnlyStar, $IsSale);

                $Pagination = $Core -> Page($TotalProduct, $CurrentPage);

                $Core -> LogFile('', '', $TotalProduct);

                /**
                 * Keep current search param
                 */
                $_SESSION['Search'] = base64_encode(json_encode($_POST));
            }

            include_once 'View/ProductList.php';
            break;
        case 'Contact':
            if (isset($_SESSION['Search'])) {unset($_SESSION['Search']); unset($_POST);}
            include_once 'View/Contact.php';
            break;
        case 'Login':
            if (isset($_SESSION['Search'])) {unset($_SESSION['Search']); unset($_POST);}
            if (!isset($_SESSION['Logged']))
            {
                include_once 'View/Login.php';
                break;
            } else include_once 'View/User.php';
            break;
        case 'Logout':
            if (isset($_SESSION['Search'])) {unset($_SESSION['Search']); unset($_POST);}
            unset($_SESSION['Logged']);
            unset($_SESSION['UserID']);
            unset($_SESSION['UserName']);
            unset($_SESSION['UserMail']);
            unset($_SESSION['UserLogin']);
            unset($_SESSION['UserAvatar']);
            unset($_SESSION['UserAddress']);
            unset($_SESSION['UserBirthday']);
            unset($_SESSION['UserPhoneNumber']);

            if ($_GET['Redirect'])
            {
                header('location: ?QGPage='.$_GET['Redirect']);
            } else header('location: ?QGPage=Home');

            break;
        case 'User':
            if (isset($_SESSION['Search'])) {unset($_SESSION['Search']); unset($_POST);}
            if (isset($_SESSION['Logged']))
            {
                include_once 'View/User.php';
                break;
            }
            header('location: ?QGPage=Login');
            break;
        case 'Active':
            if (isset($_SESSION['Search'])) {unset($_SESSION['Search']); unset($_POST);}
            include_once 'View/Active.php';
            break;
        case 'Cart':
            if (isset($_SESSION['Search'])) {unset($_SESSION['Search']); unset($_POST);}
            include_once 'View/Cart.php';
            break;
        case 'News':
            if (isset($_SESSION['Search'])) {unset($_SESSION['Search']); unset($_POST);}
            include_once 'View/News.php';
            break;
        case 'Read':
            if (isset($_SESSION['Search'])) {unset($_SESSION['Search']); unset($_POST);}
            include_once 'View/Read.php';
            break;
        case 'Checkout':
            if (isset($_SESSION['Search'])) {unset($_SESSION['Search']); unset($_POST);}
            include_once 'View/Checkout.php';
            break;
        case 'View':
            if (isset($_SESSION['Search'])) {unset($_SESSION['Search']); unset($_POST);}
            include_once 'View/View.php';
            break;
        case 'Reset':
            if (isset($_SESSION['Search'])) {unset($_SESSION['Search']); unset($_POST);}
            include_once 'View/Reset.php';
            break;
        default:
            if (isset($_SESSION['Search'])) {unset($_SESSION['Search']); unset($_POST);}
            include_once 'View/Home.php';
    }
}
else
{
    if (isset($_SESSION['Search'])) {unset($_SESSION['Search']); unset($_POST);}
    include_once 'View/Home.php';
}

include_once 'View/Footer.php';
?>
