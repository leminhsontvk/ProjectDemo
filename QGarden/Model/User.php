<?php


namespace Model;

use Core\Core;
use Core\Config;
use Core\Database;
use SendGrid\Mail\Mail;
use SendGrid\Mail\TypeException;

class User extends Config
{
    private $Database;

    /**
     * User constructor.
     */
    public function __construct()
    {
        $this -> Database = new Database();
    }

    /**
     * Check the existence of some user.
     * @param string $EmailOrUserLoginID User-input Email or LoginID to check the existence.
     * @return bool true if Exist or fail.
     */
    public function IsExist (string $EmailOrUserLoginID)
    {
        if (filter_var($EmailOrUserLoginID, FILTER_VALIDATE_EMAIL))
        {
            $SQL = "SELECT UserMail FROM Users WHERE UserMail = ?";
        } else $SQL = "SELECT UserLogin FROM Users WHERE UserLogin = ?";

        return (count($this -> Database -> QSelectOneValue($SQL, $EmailOrUserLoginID)) > 0) ? true : false;
    }

    /**
     * Check the existence of some phone number.
     * @param string $Phone User-input Email or LoginID to check the existence.
     * @return bool true if Exist or fail.
     */
    public function IsPhoneExist (string $Phone)
    {
        $SQL = 'SELECT UserPhoneNumber FROM Users WHERE UserPhoneNumber = ?';
        return (count($this -> Database -> QSelectOneValue($SQL, $Phone)) > 0) ? true : false;
    }

    /**
     * check user-input password if match.
     * @param string $CurrentPass user-input current password.
     * @return bool true if match current password.
     */
    public function CheckCurrentPassword(string $CurrentPass)
    {
        $SQL = 'SELECT * FROM Users WHERE UserID = ?';

        $User = $this -> Database -> QSelectOneRecord($SQL, $_SESSION['UserID']);

        $UserInputPassword = $this->Hasher($CurrentPass, $User['UserRegisterDate']);

        if (hash_equals($UserInputPassword, $User['UserPass'])) return true; else return false;
    }

    /**
     * Change user password.
     * @param string $NewPassword User-input new password.
     * @return bool|string Return true if success false if error. Error Message if DebugMode true.
     */
    public function ChangePassword(string $NewPassword)
    {
        $SQL = 'UPDATE Users SET UserPass = ? WHERE UserID = ?';

        return $this -> Database -> QExecute($SQL, self::Hasher($NewPassword, self::GetHash()), $_SESSION['UserID']);
    }

    /**
     * Create user login credential.
     * @param string $UserLoginID LoginID or user email.
     * @param string $UserLoginPassword User password.
     * @param bool $IsRemember If user want remember.
     * @return bool true if success and else if fail.
     */
    public function CheckLogin (string $UserLoginID, string $UserLoginPassword, bool $IsRemember = false)
    {
        if ($IsRemember) $_COOKIE['PortalID'] = session_id(); else unset($_COOKIE);

        if (filter_var($UserLoginID, FILTER_VALIDATE_EMAIL))
        {
            return self::LoginViaEmail($UserLoginID, $UserLoginPassword);
        }
        else
        {
            return self::LoginViaLoginID($UserLoginID, $UserLoginPassword);
        }
    }

    /**
     * Do login event via LoginID.
     * @param string $UserLoginID User mail.
     * @param string $UserLoginPassword User password.
     * @return bool|null true if match all. false if password not match and null if user not exist.
     */
    private function LoginViaLoginID(string $UserLoginID, string $UserLoginPassword)
    {
        $User = $this -> Database -> QSelectOneRecord("SELECT * FROM Users WHERE UserLogin = ? AND UserPermission != 0", $UserLoginID);

        if (NULL == $User) return null;

        $UserInputPassword = $this->Hasher($UserLoginPassword, $User['UserRegisterDate']);

        if (hash_equals($UserInputPassword, $User['UserPass']))
        {
            $_SESSION['Logged'] = 1;
            $_SESSION['UserID'] = $User['UserID'];
            $_SESSION['UserName'] = $User['UserName'];
            $_SESSION['UserMail'] = $User['UserMail'];
            $_SESSION['UserLogin'] = $User['UserLogin'];
            $_SESSION['UserAvatar'] = $User['UserAvatar'];
            $_SESSION['UserAddress'] = $User['UserAddress'];
            $_SESSION['UserBirthday'] = $User['UserBirthday'];
            $_SESSION['UserPhoneNumber'] = $User['UserPhoneNumber'];


            return true;
        } else return false;
    }

    /**
     * Do login event via user email.
     * @param string $UserLoginID User mail.
     * @param string $UserLoginPassword User password.
     * @return bool|null reu if match all. false if password not match and null if user not exist.
     */
    private function LoginViaEmail(string $UserLoginID, string $UserLoginPassword)
    {
        $User = $this -> Database -> QSelectOneRecord("SELECT * FROM Users WHERE UserMail = ? AND UserPermission != 0", $UserLoginID);

        if (NULL === $User) return null;

        $UserInputPassword = $this->Hasher($UserLoginPassword, $User['UserRegisterDate']);

        if (hash_equals($UserInputPassword, $User['UserPass']))
        {
            $_SESSION['Logged'] = 1;
            $_SESSION['UserID'] = $User['UserID'];
            $_SESSION['UserName'] = $User['UserName'];
            $_SESSION['UserMail'] = $User['UserMail'];
            $_SESSION['UserLogin'] = $User['UserLogin'];
            $_SESSION['UserAvatar'] = $User['UserAvatar'];
            $_SESSION['UserAddress'] = $User['UserAddress'];
            $_SESSION['UserBirthday'] = $User['UserBirthday'];
            $_SESSION['UserPhoneNumber'] = $User['UserPhoneNumber'];

            return true;
        } else return false;
    }

    /**
     * Hash function hash given string to Config Class configure.
     * @param string $String Given string need to hashed.
     * @param int $Key Hash Sign key.
     * @return string Hashed string.
     */
    private function Hasher(string $String, int $Key)
    {
        return hash_hmac(Config::HashAlgorithm, $String, $Key);
    }

    /**
     * Get hash key from UserID.
     * @param string|null $UserLogin Get hash by Userlogin.
     * @return int User default hash key.
     */
    private function GetHash(string $UserLogin = NULL)
    {
        if ($UserLogin !== NULL)
        {
            return $this -> Database -> QSelectOneRecord('SELECT UserRegisterDate FROM Users WHERE UserLogin = ?', $UserLogin)['UserRegisterDate'];
        }
        return $this -> Database -> QSelectOneRecord('SELECT UserRegisterDate FROM Users WHERE UserID = ?', $_SESSION['UserID'])['UserRegisterDate'];
    }

    /**
     * Create new user function.
     * @param string $UserLogin User LoginID.
     * @param string $UserPass User password string.
     * @param string $UserName User full name.
     * @param string $UserMail User mail address.
     * @param string $UserAddress User shipping address.
     * @param string $UserPhoneNumber User phone number.
     * @return bool|string Return true if success false if error. Error Message if DebugMode true.
     */
    public function Register(string $UserLogin, string $UserPass, string $UserName, string $UserMail, string $UserAddress, string $UserPhoneNumber)
    {
        //Sending Active Mail.
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

        $ActiveLink = Config::WebDocumentRoot.'?QGPage=Active&UserID='.$UserLogin.'&Token='.self::Hasher($UserLogin, $CurrentDate);

        $Mailer -> addTo($UserMail, $UserName);
        $Mailer -> setSubject("QGarden - Kích hoạt tài khoản của bạn.");

        $Mailer -> addDynamicTemplateData('UserName', $UserName);
        $Mailer -> addDynamicTemplateData('UserLogin', $UserLogin);
        $Mailer -> addDynamicTemplateData('ActiveLink', $ActiveLink);
        $Mailer -> setTemplateId('d-30fc47ea322d412db4453a0bf304b7c6');

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

        $SQL = "INSERT INTO Users (UserLogin, UserPass, UserName, UserMail, UserAddress, UserPhoneNumber, UserRegisterDate, UserPermission) VALUE (?, ?, ?, ?, ?, ?, ?, ?)";

        return $this -> Database -> QExecute($SQL, $UserLogin, $this -> Hasher($UserPass, $CurrentDate), $UserName, $UserMail, $UserAddress, $UserPhoneNumber, $CurrentDate, 0);
    }

    /**
     * @param string|NULL $UserLogin
     * @param string|NULL $UserPhone
     * @param string|NULL $UserMail
     * @param string|NULL $NewPassword
     * @param string|NULL $UserName
     * @param string|NULL $UserAddress
     * @param string|NULL $UserBirthday
     * @param string|NULL $UserAvatar
     * @return bool|string
     */
    public function Update(string $UserLogin = NULL, string $UserPhone = NULL, string $UserMail = NULL, string $NewPassword = NULL, string $UserName = NULL, string $UserAddress = NULL, string $UserBirthday = NULL, string  $UserAvatar = NULL)
    {
        $SQL = "UPDATE Users SET";

        if ($UserLogin !== NULL) $SQL .= " UserLogin = '".$UserLogin."',";
        if ($UserPhone !== NULL) $SQL .= " UserPhoneNumber = '".$UserPhone."',";
        if ($UserMail !== NULL) $SQL .= " UserMail = '".$UserMail."',";
        if ($NewPassword !== NULL) $SQL .= " UserPass = '".self::Hasher($NewPassword, self::GetHash())."',";
        if ($UserName !== NULL) $SQL .= " UserName = '".$UserName."',";
        if ($UserAddress !== NULL) $SQL .= " UserAddress = '".$UserAddress."',";
        if ($UserBirthday !== NULL) $SQL .= " UserBirthday = '".strtotime($UserBirthday)."',";
        if ($UserAvatar !== NULL) $SQL .= " UserAvatar = '".$UserAvatar."',";

        $SQL .= " UserID = ? WHERE UserID = ?";

        return $this -> Database -> QExecute($SQL, $_SESSION['UserID'], $_SESSION['UserID']);
    }

    public function Active(string $UserLogin, string $Token)
    {
        $HashKey = self::GetHash($UserLogin);
        $ServerKey = self::Hasher($UserLogin, $HashKey);

        Core::LogFile('', '', get_defined_vars());

        if (hash_equals($ServerKey, $Token))
        {


            $IsNotActive = count($this -> Database -> QSelectOneValue('SELECT UserPermission FROM Users WHERE UserLogin = ? AND UserPermission = 0', $UserLogin)) ? true : false;

            if ($IsNotActive === false) return false;

            $SQL = 'UPDATE Users SET UserPermission = 1 WHERE UserLogin = ? AND UserPermission = 0';

            return $this -> Database -> QExecute($SQL, $UserLogin);
        } else return false;
    }

    public function IsAdmin()
    {
        if (empty($_SESSION['UserID'])) return false;

        if ($_SESSION['Logged'] !== 1) return false;

        if ($_SESSION['UserID'] and $_SESSION['Logged'] === 1) $UserID = $_SESSION['UserID']; else $UserID = NULL;
        $SQL = "SELECT UserPermission FROM Users WHERE UserID = ?";
        $UserPermission = $this -> Database -> QSelectOneValue($SQL, $UserID);

        return ((int)$UserPermission === 3 or (int)$UserPermission === 4) ? true : false;
    }

    public function GetUserName(string $MailOrLoginID)
    {
        if (filter_var($MailOrLoginID, FILTER_VALIDATE_EMAIL))
        {
            return $this -> Database -> QSelectOneValue('SELECT UserName FROM Users WHERE UserMail = ?', $MailOrLoginID);
        } else return $this -> Database -> QSelectOneValue('SELECT UserName FROM Users WHERE UserLogin = ?', $MailOrLoginID);
    }

    public function GetUserMail(string $LoginID)
    {
        if (filter_var($LoginID, FILTER_VALIDATE_EMAIL)) return $LoginID;
        return $this -> Database -> QSelectOneValue('SELECT UserMail FROM Users WHERE UserLogin = ?', $LoginID);
    }

    private function GetLoginID(string $UserMail)
    {
        return $this -> Database -> QSelectOneValue("SELECT UserLogin FROM Users WHERE UserMail = ?", $UserMail);
    }

    public function DoReset(string $ResetCode, string $NewPass)
    {
        if (strcmp($_SESSION['Token'], $ResetCode) == 0)
        {
            if (filter_var($_SESSION['RequestUser'], FILTER_VALIDATE_EMAIL))
            {
                $HashKey = self::Hasher($NewPass, $this->GetHash(self::GetLoginID($_SESSION['RequestUser'])));

                return $this -> Database -> QExecute("UPDATE Users SET UserPass = ? WHERE UserMail = ?", $HashKey, $_SESSION['RequestUser']);
            }
            else
            {
                $HashKey = self::Hasher($NewPass, $this->GetHash($_SESSION['RequestUser']));
                return $this -> Database -> QExecute("UPDATE Users SET UserPass = ? WHERE UserLogin = ?", $HashKey, $_SESSION['RequestUser']);
            }
        } else return NULL;
    }
}