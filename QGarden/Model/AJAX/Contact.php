<?php
session_start();
ini_set('display_errors', 'off');

/**
 * Recall all Class needed by AJAX Module
 */

include_once '../../Core/Core.php';
include_once '../../Core/Config.php';
include_once '../../Core/Database.php';

include_once '../Contact.php';

if ($_POST['Action'] === 'AddContact')
{
    $Return = array();
    $Return['StatusCode'] = (int)(new \Model\Contact($_POST['UserName'], $_POST['UserMail'], $_POST['ContactSubject'], $_POST['ContactMessage'])) ? 1 : 0;

    echo json_encode($Return);
}
