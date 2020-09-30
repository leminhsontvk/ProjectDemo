<?php


namespace Model;

use Core\Core;
use Core\Config;
use Core\Database;

use DateTime;
use Model\User;

class SuperUser
{
    private $User;
    private $Database;

    public function __construct()
    {
        $this -> User = new \Model\User();
        $this -> Database = new Database();
    }

    public function GetDashboard()
    {
        if (!$this -> User -> IsAdmin()) return false;

        $CurrentDate = new DateTime('now');
        $CurrentDate -> modify('last day of this month');

        $CurrentYear = date('Y');
        $CurrentMonth = date('M');
        $LastDay =$CurrentDate ->format('d');

        $StartTime = strtotime('01-'.$CurrentMonth.'-'.$CurrentYear.' 00:00:00');
        $EndTime = strtotime($LastDay.'-'.$CurrentMonth.'-'.$CurrentYear.' 23:59:59');

        $SQLBill = "SELECT COUNT(BillID) FROM Bill";
        $SQLProduct = "SELECT COUNT(ProductID) FROM Products";
        $SQLCategory = "SELECT COUNT(CategoryID) FROM Category";
        $SQLTotalCost = "SELECT SUM(BillTotalCost) FROM Bill WHERE BillStatus = 2 AND BillCreateDate BETWEEN ? AND ?";
        $SQLUser = "SELECT COUNT(UserID) FROM Users WHERE UserPermission != 0 AND UserPermission != 3";

        $Dashboard = array();

        $Dashboard['Bill'] = $this -> Database -> QSelectOneValue($SQLBill);
        $Dashboard['User'] = $this -> Database -> QSelectOneValue($SQLUser);
        $Dashboard['Product'] = $this -> Database -> QSelectOneValue($SQLProduct);
        $Dashboard['Category'] = $this -> Database -> QSelectOneValue($SQLCategory);
        $Dashboard['TotalCost'] = $this -> Database -> QSelectOneValue($SQLTotalCost, $StartTime, $EndTime);

        return $Dashboard;
    }

    public function GetTotalUser()
    {
        return $this -> Database -> QSelectOneValue("SELECT COUNT(UserID) FROM Users WHERE UserPermission != 3");
    }

    public function AddNews (string $NewsTitle, string $NewsPreview, string $NewsContent, string $NewsImage)
    {
        $SQL = "INSERT INTO News (NewsTitle, NewsPreview, NewsContent, NewsDefaultImage, NewsCreateDate, NewsCreateByUserID) VALUE (?, ?, ?, ?, ?, ?)";

        return $this -> Database -> QExecute($SQL,$NewsTitle, $NewsPreview, $NewsContent, $NewsImage, time(), $_SESSION['UserID']);
    }

    public function EditCategory(int $CategoryID, string $CategoryName, string $CategoryImage = NULL)
    {
        $SQL = "UPDATE Category SET CategoryName = ?";

        if ($CategoryImage !== NULL)
        {
            $SQL .= " , CategoryDefaultImage = ? WHERE CategoryID = ?";

            return $this -> Database -> QExecute($SQL, $CategoryName, $CategoryImage, $CategoryID);
        }
        else
        {
            $SQL .= " WHERE CategoryID = ?";
            return $this -> Database -> QExecute($SQL, $CategoryName, $CategoryID);
        }
    }

    public function DeleteCategory(int $CategoryID, bool $Confirm = false)
    {
        if ($Confirm)
        {
            $this -> Database -> QExecute('SET FOREIGN_KEY_CHECKS = 0; DELETE FROM Products WHERE ProductCategoryID = ?;SET FOREIGN_KEY_CHECKS = 1;', $CategoryID);
            return $this -> Database -> QExecute('DELETE FROM Category WHERE CategoryID = ?', $CategoryID);
        } else return $this -> Database -> QExecute('DELETE FROM Category WHERE CategoryID = ?', $CategoryID);
    }

    public function EditProduct(int $ProductID, string $ProductName = NULL, string $ProductDecs = NULL, int $ProductPrice = NULL, int $ProductDiscount = NULL, int $ProductAvailable = NULL, int $ProductCategoryID = NULL, string $ProductImage = NULL, string $ProductPreview = NULL)
    {
        $SQL = "UPDATE Products SET ProductID = ?";

        if ($ProductName !== NULL) $SQL .= ", ProductName = '".$ProductName."'";
        if ($ProductDecs !== NULL) $SQL .= ", ProductDescription = ?";
        if ($ProductPrice !== NULL) $SQL .= ", ProductPrice = ".$ProductPrice;
        if ($ProductDiscount !== NULL) $SQL .= ", ProductDiscount = ".$ProductDiscount;
        if ($ProductAvailable !== NULL) $SQL .= ", ProductAvailable = ".$ProductAvailable;
        if ($ProductCategoryID !== NULL) $SQL .= ", ProductCategoryID = ".$ProductCategoryID;
        if ($ProductImage !== NULL) $SQL .= ", ProductImageList = '".$ProductImage."'";
        if ($ProductPreview !== NULL) $SQL .= ", ProductPreview = '".$ProductPreview."'";

        $SQL .= " WHERE ProductID = ?";

        if ($ProductDecs !== NULL) return $this -> Database -> QExecute($SQL, $ProductID, $ProductDecs, $ProductID);
        else return $this -> Database -> QExecute($SQL, $ProductID, $ProductID);
    }

    public function AddProduct(string $ProductName, string $ProductDecs, int $ProductPrice, int $ProductDiscount, int $ProductAvailable, int $ProductCategoryID, string $ProductImage, string $ProductPreview)
    {
        $SQL = "INSERT INTO Products (ProductName, ProductDescription, ProductPrice, ProductDiscount, ProductAvailable, ProductCategoryID, ProductImageList, ProductPreview) VALUE (?, ?, ?, ?, ?, ?, ?, ?)";

        return $this -> Database -> QExecute($SQL, $ProductName, $ProductDecs, $ProductPrice, $ProductDiscount, $ProductAvailable, $ProductCategoryID, $ProductImage, $ProductPreview);
    }

    public function DeleteProduct(int $ProductID)
    {
        return $this -> Database -> QExecute('SET FOREIGN_KEY_CHECKS = 0; DELETE FROM Products WHERE ProductID = ?;SET FOREIGN_KEY_CHECKS = 1;', $ProductID);
    }

    public function DeleteNews(int $ProductID)
    {
        return $this -> Database -> QExecute('SET FOREIGN_KEY_CHECKS = 0; DELETE FROM News WHERE NewsID = ?;SET FOREIGN_KEY_CHECKS = 1;', $ProductID);
    }

    public function GetUser(int $CurrentPage = 1, string $UserName = NULL, string $UserLoginID = NULL)
    {
        $SQL = "SELECT * FROM Users WHERE UserPermission != 3";

        if ($UserName !== NULL)
        {
            $SQL .= " AND UserName LIKE ?";

            if (is_string($UserName))
            {
                $UserName = '%'.$UserName.'%';
            }
        }

        if ($UserLoginID !== NULL)
        {
            $SQL .= " AND UserLogin LIKE ?";

            if (is_string($UserLoginID))
            {
                $UserLoginID = "%".$UserLoginID."%";
            }
        }

        if ($CurrentPage !== 0)
        {
            $SQL .= " LIMIT ".($CurrentPage - 1) * Config::ProductPerPage.", ".Config::ProductPerPage;
        }

        if ($UserName === NULL) return $this -> Database -> QSelect($SQL, $UserLoginID);

        if ($UserLoginID === NULL) return $this -> Database -> QSelect($SQL, $UserName);

        return $this -> Database -> QSelect($SQL, $UserName, $UserLoginID);
    }

    public function DoBlock(int $UserID)
    {
        return $this -> Database ->QExecute("UPDATE Users SET UserPermission = 0 WHERE UserID = ? AND UserPermission != 3", $UserID);
    }

    public function DoUnblock(int $UserID)
    {
        return $this -> Database ->QExecute("UPDATE Users SET UserPermission = 1 WHERE UserID = ? AND UserPermission != 3", $UserID);
    }

    public function MakeSuper(int $UserID)
    {
        return $this -> Database ->QExecute("UPDATE Users SET UserPermission = 4 WHERE UserID = ? AND UserPermission != 3", $UserID);
    }

    public function GetCoupon(int $CouponID = NULL)
    {
        $SQL = "SELECT *, UserName FROM Coupons, Users WHERE UserID = CouponCreatedByAdminID";

        if ($CouponID !== NULL)
        {
            $SQL .= " AND CouponID = ?";

            return $this -> Database -> QSelectOneRecord($SQL." GROUP BY CouponID", $CouponID);
        } return $this -> Database -> QSelect($SQL." GROUP BY CouponID");
    }

    public function DeleteCoupon(int $CouponID)
    {
        $SQL = "SET FOREIGN_KEY_CHECKS = 0;DELETE FROM Coupons WHERE CouponID = ?SET FOREIGN_KEY_CHECKS = 1;";

        return $this -> Database -> QExecute($SQL, $CouponID);
    }

    public function EditCoupon(int $CouponID, string $CouponCode = NULL, string $Discount = NULL, int $ExpireDate = NULL)
    {
        $SQL = "UPDATE Coupons SET CouponID = ?";

        if ($CouponCode !== NULL) $SQL .= ", CouponCode = '".$CouponCode."'";
        if ($CouponCode !== NULL) $SQL .= ", ExpireDate = ".$ExpireDate;
        if ($CouponCode !== NULL) $SQL .= ", CouponDiscount = ".$Discount;

        $SQL .= " WHERE CouponID = ?";

        return $this -> Database -> QExecute($SQL, $CouponID, $CouponID);
    }

    public function AddCoupon(string $CouponCode, string $Discount, int $ExpireDate)
    {
        $SQL = "INSERT INTO Coupons (CouponCode, CouponCreatedByAdminID, CouponDiscount, CreateDate, ExpireDate) VALUE(?, ?, ?, ?, ?)";

        return $this -> Database -> QExecute($SQL, $CouponCode, $_SESSION['UserID'], $Discount, time(), $ExpireDate);
    }

    public function GetBill(int $BillID = NULL)
    {
        if ($BillID === NULL)
        {
            $SQL = "SELECT *, UserName, CouponCode FROM Bill INNER JOIN Coupons, Users WHERE BillOfUserID = UserID GROUP BY BillID ORDER BY BillCreateDate DESC";
            return $this -> Database -> QSelect($SQL);

        } else $SQL = "SELECT *, UserName, CouponCode FROM Bill INNER JOIN Coupons, Users WHERE BillOfUserID = UserID AND BillID = ? GROUP BY BillID ORDER BY BillCreateDate DESC";
        return $this -> Database -> QSelect($SQL, $BillID);

    }

    public function EditNews(int $NewsID , string $NewsTitle = NULL, string $NewsPreview = NULL, string $NewsContent = NULL, string $NewsImage = NULL)
    {
        $SQL = "UPDATE News SET NewsID = ?";

        if ($NewsTitle !== NULL) $SQL .= " , NewsTitle = '".$NewsTitle."'";
        if ($NewsPreview !== NULL) $SQL .= " , NewsPreview = '".$NewsPreview."'";
        if ($NewsContent !== NULL) $SQL .= " , NewsContent = ?";
        if ($NewsImage !== NULL) $SQL .= " , NewsDefaultImage = '".$NewsImage."'";

        if ($NewsContent !== NULL ) return $this -> Database -> QExecute($SQL." WHERE NewsID = ?", $NewsID, $NewsContent, $NewsID);
        else return $this -> Database -> QExecute($SQL." WHERE NewsID = ?", $NewsID, $NewsID);
    }

    public function AddCategory(string $CateName, string $CateImage)
    {
        $SQL = "INSERT INTO Category (CategoryName, CategoryDefaultImage) VALUE (?, ?)";

        return $this -> Database -> QExecute($SQL, $CateName, $CateImage);
    }

    public function EditSiteInfo( $SiteName, $About, $ContactAddress, $ContactPhoneLine, $CustomerCareLine, $ContactMail, $FacebookSocial, $GoogleSocial, $IGSocial, $YoutubeSocial)
    {
        $SQL = "TRUNCATE SiteInfo;INSERT INTO SiteInfo (SiteName, About, ContactAddress, ContactPhoneLine, CustomerCareLine, ContactMail, FacebookSocial, GoogleSocial, IGSocial, YoutubeSocial) VALUE (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";


        $this -> Database ->QExecute($SQL, $SiteName, $About, $ContactAddress, $ContactPhoneLine, $CustomerCareLine, $ContactMail, $FacebookSocial, $GoogleSocial, $IGSocial, $YoutubeSocial);
    }

    public function EditBillStatus(int $BillID, int $BillStatus)
    {
        return $this -> Database -> QExecute("UPDATE Bill SET BillStatus = ? WHERE BillID = ?", $BillStatus, $BillID);
    }

    public function DeleteBill(int $BillID)
    {
        $this -> Database -> QExecute("DELETE FROM BillDetail WHERE BillID = ?", $BillID);
        return $this -> Database -> QExecute("DELETE FROM Bill WHERE BillID = ?", $BillID);
    }

    public function GetReceivedContact()
    {
        $SQL = "SELECT * FROM ReceivedContact";
        return $this -> Database ->QSelect($SQL);
    }

    public function DeleteReceivedContact(int $ContactID)
    {
        $SQL = "DELETE FROM ReceivedContact WHERE ContactID = ?";
        return $this -> Database ->QExecute($SQL, $ContactID);
    }

    public function GetBanner()
    {
        $SQL = "SELECT * FROM Banner";
        return $this -> Database -> QSelect($SQL);
    }

    public function AddBanner(string $BannerImage)
    {
        $SQL = "INSERT INTO Banner SET BannerImage = ?, BannerStatus = ?";
        return $this -> Database -> QExecute($SQL, $BannerImage, 1);
    }

    public function UpdateBannerStatus(int $BannerID, int $BannerStatus)
    {
        $SQL = "UPDATE Banner SET BannerStatus = ? WHERE BannerID = ?";
        return $this -> Database -> QExecute($SQL, $BannerStatus, $BannerID);
    }

    public function DeleteBanner(int $BannerID)
    {
        return $this -> Database -> QExecute('DELETE FROM Banner WHERE BannerID = ?', $BannerID);
    }
}