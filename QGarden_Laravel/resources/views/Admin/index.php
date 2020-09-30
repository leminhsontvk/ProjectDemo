<?php
/** Setup Security Check **/
define('QGAccessGrained', true);

/** Call Cortex **/
include_once 'LyokoCotex.blade.php';

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
    header('location: ?'.http_build_query($_GET));
}

/**
 * Init Class and variable
 */
$Core = new \Core\Core();
$User = new \Model\User();
$Super = new \Model\SuperUser();
$Product = new \Model\Products();
$PublicConfig = new \Core\Config();

$CategoryList = (new \Model\Category()) -> GetCategoryList();
/**
 * Check User Is Admin
 */
if (!($User -> IsAdmin())) {header('HTTP/2 401 Access Authorization Requested.');}

include_once 'View/Header.php';

if ($_GET['Admin'])
{
    switch ($_GET['Admin'])
    {
        case 'Home':
        case 'Dashboard':
            include_once 'View/Home.php';
            break;
        case 'Category':
            include_once 'View/Category.php';
            break;
        case 'Products':
            if ($CategoryID !== NULL) $ProductList = $Product -> GetProductList($CategoryID); else $ProductList = $Product -> GetProductList();

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
                $TotalProduct = (int) count($ProductList);

                /**
                 * Keep current search param
                 */
                $_SESSION['Search'] = base64_encode(json_encode($_POST));
            }
            else
            {
                $TotalProduct = $Product -> GetTotalProduct($CategoryID);
            }

            $Pagination = $Core -> Page($Super -> GetTotalUser(), $CurrentPage);

            include_once 'View/Products.php';
            break;
        case 'Product':
            include_once 'View/Product.blade.php';
            break;
        case 'Users':
            if ($_GET['UserLogin']) $UserLogin = $_GET['UserLogin']; else $UserLogin = NULL;
            if ($_GET['UserName']) $UserName = $_GET['UserName']; else $UserName = NULL;

            if ($UserName !== NULL or $UserLogin !== NULL)
            {
                $UserList = $Super -> GetUser($CurrentPage, $UserName, $UserLogin);
                $Pagination = $Core -> Page(count($UserList), $CurrentPage);
                $TotalProduct = count($UserList);
            }
            else
            {
                $TotalProduct = $Super -> GetTotalUser();
                $UserList = $Super -> GetUser($CurrentPage);
                $Pagination = $Core -> Page($Super -> GetTotalUser(), $CurrentPage);
            }
            include_once 'View/Users.php';
            break;
        case 'Coupons':
            include_once 'View/Coupons.php';
            break;
        case 'Bills':
            include_once 'View/Bills.php';
            break;
        case 'Mail':
            include_once 'View/Mail.php';
            break;
        case 'News':
            $News = new \Model\News();
            $TotalProduct = $News -> GetTotalNews();
            $NewsList = $News -> GetNewsList($CurrentPage);
            $Pagination = $Core -> Page($TotalProduct, $CurrentPage);

            include_once 'View/News.php';
            break;
        case 'New':
            include_once 'View/New.php';
            break;
        default:
            include_once 'View/Home.php';
    }
}
else
{
    include_once 'View/Home.php';
}

include_once 'View/Footer.php';