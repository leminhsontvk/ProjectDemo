<?php

use SendGrid\Mail\TypeException;

session_start();
ini_set('display_errors', 'off');

/**
 * Recall all Class needed by AJAX Module
 */

include_once '../../Core/Core.php';
include_once '../../Core/Config.php';
include_once '../../Core/Database.php';
include_once '../../Libs/SendGrid/SendGrid.php';

include_once '../User.php';

$Core = new Core\Core();
$LoginHandler = new \Model\User();

if ($_POST['Action'])
{
    switch ($_POST['Action'])
    {
        case 'Login':
            $Core -> LogFile('', '', get_defined_vars());

            if (strcmp($_POST['SavePortal'], 'on') === 0) $SavePortal = true; else $SavePortal = false;

            $Return = array();
            $Return['StatusCode'] = (int)(($LoginHandler -> CheckLogin($_POST['Login'], $_POST['Password'], $SavePortal)) ? 1 : 0);

            echo json_encode($Return);
            return;
        case 'Register':
            $Return = array();

            $Return['StatusCode'] = (int)(($LoginHandler -> Register($_POST['UserLogin'], $_POST['UserPassword'], $_POST['UserName'], $_POST['UserMail'], $_POST['UserAddress'], $_POST['UserPhone'])) ? 1 : 0);

            echo json_encode($Return);
            return;
        case 'CheckCurrentPass':
            $Return = array();
            $Return['StatusCode'] = (int)(($LoginHandler -> CheckCurrentPassword($_POST['CurrentPass'])) ? 1 : 0);

            echo json_encode($Return);

            return;
        case 'CheckExist':
            $Return = array();
            $Return['StatusCode'] = (int)(($LoginHandler -> IsExist($_POST['Login'])) ? 0 : 1);

            echo json_encode($Return);
            return;
        case 'CheckPhoneExist':
            $Return = array();
            $Return['StatusCode'] = (int)(($LoginHandler -> IsPhoneExist($_POST['Phone'])) ? 0 : 1);

            echo json_encode($Return);
            return;
        case 'ChangePassword':
            $Return = array();
            $Return['StatusCode'] = (int)(($LoginHandler -> ChangePassword($_POST['NewPassword'])) ? 1 : 0);

            echo json_encode($Return);
            return;
        case 'ChangeInfo':
            if (isset($_POST['UserLogin']) or ($_POST['UserLogin'] !== "undefined")) $UserLogin = $_POST['UserLogin'];
            else $UserLogin = NULL;

            if (isset($_POST['UserPhone']) or ($_POST['UserPhone'] !== "undefined")) $UserPhone = $_POST['UserPhone'];
            else $UserPhone = NULL;

            if (isset($_POST['UserMail']) or ($_POST['UserMail'] !== "undefined")) $UserMail = $_POST['UserMail'];
            else $UserMail = NULL;

            if (isset($_POST['NewPassword']) or ($_POST['NewPassword'] !== "undefined")) $NewPassword = $_POST['NewPassword'];
            else $NewPassword = NULL;

            if (isset($_POST['UserName']) or ($_POST['UserName'] !== "undefined")) $UserName = $_POST['UserName'];
            else $UserName = NULL;

            if (isset($_POST['UserAddress']) or ($_POST['UserAddress'] !== "undefined")) $UserAddress = $_POST['UserAddress'];
            else $UserAddress = NULL;

            if (isset($_POST['UserBirthday']) or ($_POST['UserBirthday'] !== "undefined")) $UserBirthday = $_POST['UserBirthday'];
            else $UserBirthday = NULL;

            if ($_FILES['UserAvatar']['size'] > 0)
            {
                move_uploaded_file($_FILES['UserAvatar']['tmp_name'], $LoginHandler::ImagesRoot.'/Avatars/'.$_SESSION['UserID'].$_FILES['UserAvatar']['name']);

                $UserAvatar = '/Avatars/'.$_SESSION['UserID'].$_FILES['UserAvatar']['name'];
            } else $UserAvatar = NULL;

            $Core -> LogFile('', '', get_defined_vars());

            $Return = array();

            $UpdateStatus = $LoginHandler -> Update($UserLogin, $UserPhone, $UserMail, $NewPassword, $UserName, $UserAddress, $UserBirthday, $UserAvatar);

            $Return['StatusCode'] = (int)($UpdateStatus ? 1 : 0);

            echo json_encode($Return);
            return;
        case 'Token':
        {
            $_SESSION['RequestUser'] = $_POST['Login'];
            $_SESSION['Token'] = $Core -> TokenCreator(6);

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

            $UserName = $LoginHandler -> GetUserName($_POST['Login']);
            $Mailer -> addTo($LoginHandler -> GetUserMail($_POST['Login']), $UserName);
            $Mailer -> setSubject("QGarden - Hóa đơn đã được tạo.");

            $Mailer -> addDynamicTemplateData('UserName', $UserName);
            $Mailer -> addDynamicTemplateData('ResetCode', $_SESSION['Token']);
            $Mailer -> setTemplateId('d-4e1aaf6f033c4c0a84ab6be629e2cf6c');

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

            $Return = array();

            $Core -> LogFile('', '', get_defined_vars());

            $Return['StatusCode'] = ($Result ->statusCode() === 202) ? 1 : 0;

            echo json_encode($Return);
            return;
        }
        case 'Reset':
        {
            $Status = $LoginHandler -> DoReset($_POST['ResetCode'], $_POST['NewPass']);

            $Return = array();

            if ($Status == NULL) $Return['StatusCode'] = 2;
            else $Return['StatusCode'] = ($Status) ? 1 : 0;

            echo json_encode($Return);

            if ($Status == NULL) return;

            unset($_SESSION['Token']);
            unset($_SESSION['RequestUser']);
        }
    }
}

