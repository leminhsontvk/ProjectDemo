<?php
/**
 * Pre-configure
 */
ini_set('display_errors', 'off');
ini_set('session.gc_maxlifetime', 0);
ini_set('session.cookie_lifetime', 604800);
/**
 * Libs
 */
include_once 'SendGrid/SendGrid.php';

include_once 'PhoneNumber.php';

include_once 'Core/Core.php';
include_once 'Core/Config.php';
include_once 'Core/Database.php';

include_once 'Model/User.php';
include_once 'Model/Products.php';
include_once 'Model/Category.php';
include_once 'Model/Comments.php';
include_once 'Model/News.php';
include_once 'Model/Cart.php';
include_once 'Model/Info.php';
include_once 'Model/Contact.php';

if ((new \Model\User()) -> IsAdmin()) define('SuperUserGrained', true);
