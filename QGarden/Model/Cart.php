<?php


namespace Model;

use Core\Core;
use Core\Config;
use Core\Database;
use SendGrid\Mail\TypeException;

class Cart
{
    private $Database;

    public function __construct()
    {
        $this -> Database = new Database();
    }

    public function CheckBillOwner(int $BillID)
    {
        $SQL = "SELECT * FROM Bill WHERE BillOfUserID = ? AND BillID = ?";
        return $this -> Database -> QSelect($SQL, $_SESSION['UserID'], $BillID);
    }

    public function CheckCoupon(string $CouponCode)
    {
        return $this -> Database ->QSelect("SELECT CouponCode FROM Coupons WHERE CouponCode = ? AND ExpireDate > ?", $CouponCode, time());
    }

    public function GetProductPrice(int $ProductID)
    {
        $SQL = "SELECT ProductDiscount, ProductPrice FROM Products WHERE ProductID = ?";

        $Data = $this -> Database -> QSelectOneRecord($SQL, $ProductID);

        if ($Data['ProductDiscount'] == 0)
        {
            return $Data['ProductPrice'];
        } else return $Data['ProductPrice'] - ($Data['ProductPrice'] * ($Data['ProductDiscount'] / 100));
    }

    public function GetProductImage(int $ProductID)
    {
        $SQL = "SELECT ProductImageList FROM Products WHERE ProductID = ?";
        $Data = $this -> Database -> QSelectOneValue($SQL, $ProductID);

        return json_decode($Data, true)[0];
    }

    public function GetProductName(int $ProductID)
    {
        $SQL = "SELECT ProductName FROM Products WHERE ProductID = ?";
        return $this -> Database -> QSelectOneValue($SQL, $ProductID);
    }

    public function GetCouponDiscount(string $CouponCode)
    {
        $SQL = "SELECT CouponDiscount FROM Coupons WHERE CouponCode = ? AND ExpireDate > ?";
        return (int)$this -> Database -> QSelectOneValue($SQL, $CouponCode, time());
    }

    public function AddBill(string $Address, string $Phone, string $UserMail, string $TotalCost, string $CouponCode = NULL, string $IUserName = NULL)
    {
        $BillID = (int)$this -> GetCurrentBillID() + 1;

        if ($_SESSION['UserID'] and $_SESSION['Logged'] === 1) $UserID = $_SESSION['UserID']; else $UserID = NULL;

        $CurrentDate = time();
        $Mailer = new \SendGrid\Mail\Mail();

        try
        {
            $Mailer -> setFrom('support.qgarden@lmsq.vn', 'QGarden');
        }
        catch (TypeException $Error)
        {
            (new \Core\Core) -> LogFile($Error -> getMessage(), 'Active Mail Sender.', get_defined_vars());
            return false;
        }

        if ($_SESSION['UserName']) $UserName = $_SESSION['UserName']; else $UserName = $IUserName;

        $Mailer -> addTo($UserMail, $UserName);
        $Mailer -> setSubject("QGarden - Hóa đơn đã được tạo.");

        $Mailer -> addDynamicTemplateData('UserName', $UserName);
        $Mailer -> addDynamicTemplateData('BillID', $BillID);
        $Mailer -> setTemplateId('d-ba6d40732dd54d0981795b7fcc1ab09c');

        $Sender = new \SendGrid('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');

        try
        {
            $Result = $Sender -> send($Mailer);
            (new \Core\Core) -> LogFile('Log Mail Result', '\Model\User\Register.SendMail', $Result);
        }
        catch (\Exception $Error)
        {
            (new \Core\Core) -> LogFile($Error -> getMessage(), '\Model\User\Register.SendMail', get_defined_vars());
            return false;
        }

        $SQL = "INSERT INTO Bill SET BillID = ?, BillOfUserID = ?, UserShippingAddress = ?, UserPhoneNumber = ?, UserMail = ?, BillStatus = 0, BillCreateDate = ?, BillTotalCost = ?";

        if ($CouponCode !== NULL)
        {
            $CouponID = $this -> Database -> QSelectOneValue("SELECT CouponID FROM Coupons WHERE CouponCode = ? AND ExpireDate > ?", $CouponCode, time());

            if ($CouponCode !== NULL)
            {
                $SQL .= ", UsedCouponID = ?";
                return ($this -> Database ->QExecute($SQL,$BillID, $UserID, $Address, $Phone, $UserMail, time(), $TotalCost, $CouponID)) ? $BillID : false;
            }
        }
        return ($this -> Database ->QExecute($SQL, $BillID, $UserID, $Address, $Phone, $UserMail, time(), $TotalCost))  ? $BillID : false;
    }

    public function AddBillDetail(int $BillID, int $ProductID, int $ProductCount)
    {
        $SQL = "INSERT INTO BillDetail (BillID, ProductID, ProductCount) VALUE (?, ?, ?)";

        return $this -> Database -> QExecute($SQL, $BillID, $ProductID, $ProductCount);
    }

    public function GetBill()
    {
        $SQL = "SELECT * FROM Bill WHERE BillOfUserID = ? GROUP BY BillID";
        return $this -> Database -> QSelect($SQL, $_SESSION['UserID']);
    }

    public function GetBillDetail(int $BillID)
    {
        $SQL = "SELECT * FROM BillDetail WHERE BillID = ?";
        return $this -> Database -> QSelect($SQL, $BillID);
    }

    private function GetCurrentBillID()
    {
        return (int)($this -> Database -> QSelectOneValue("SELECT MAX(BillID) FROM Bill"));
    }
}