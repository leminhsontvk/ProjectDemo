<?php
session_start();
ini_set('display_errors', 'off');

/**
 * Recall all Class needed by AJAX Module
 */

include_once '../../Core/Core.php';
include_once '../../Core/Config.php';
include_once '../../Core/Database.php';

include_once '../../Model/Products.php';
include_once '../../Model/Comments.php';

$Core = new Core\Core();
$CommentHandler = new \Model\Comments();
$ProductHandler = new \Model\Products();

IF ($_POST['Action'])
{
    switch ($_POST['Action'])
    {
        case 'Product':
            $Return = array();
            $Return['StatusCode'] = (int)(($CommentHandler -> AddComment(1, $_POST['SubjectID'], $_POST['CommentContent'], $_POST['Star'])) ? 1 : 0);

            $Loop = 1;
            $StarFill = "";
            while ($Loop <= 5)
            {
                if ($Loop <= $_POST['Star']) $StarFill .= '<i class="fas fa-star fill"></i>'; else $StarFill .= '<i class="fas fa-star"></i>';
                $Loop++;
            }

            $Return['Message'] = '<div class="user-rating-box margin-top-20"><div class="user-rating"><div class="avatar-container"><div class="user-avatar"><img src="'.$PublicConfig::WebImagesRoot.$CommentHandler -> GetUserAvatar($_SESSION['UserID']).'"></div></div><div class="user-rating-content"><div class="rating-author"><h3>'.$CommentHandler -> GetUserName($_SESSION['UserID']).'</h3><div class="ratting-star">'.$StarFill.'</div></div><p>'.$_POST['CommentContent'].'</p></div></div></div>';


            echo json_encode($Return);

            $ProductHandler -> CountAvg($_POST['SubjectID']);

            break;
        case 'News':
            $Return = array();
            $Return['StatusCode'] = (int)(($CommentHandler -> AddComment(2, $_POST['SubjectID'], $_POST['CommentContent'])) ? 1 : 0);

            $Return['Message'] = '<div class="user-rating-box margin-top-20"><div class="user-rating"><div class="avatar-container"><div class="user-avatar"><img src="'.$PublicConfig::WebImagesRoot.$CommentHandler -> GetUserAvatar($_SESSION['UserID']).'"></div></div><div class="user-rating-content"><div class="rating-author"><h3>'.$CommentHandler -> GetUserName($_SESSION['UserID']).'</h3><span class="reply-btn" value="'.$_POST['SubjectID'].'"><a>Phản hồi</a></span></div><p>'.$_POST['CommentContent'].'</p></div></div></div>';

            echo json_encode($Return);
            break;
        case 'Reply':
            $Return = array();
            $Return['StatusCode'] = (int)(($CommentHandler -> AddComment(3, $_POST['SubjectID'], $_POST['CommentContent'])) ? 1 : 0);

            $Return['Message'] = '<div class="user-rating-box margin-top-20"><div class="user-rating"><div class="avatar-container"><div class="user-avatar"><img src="'.$PublicConfig::WebImagesRoot.$CommentHandler -> GetUserAvatar($_SESSION['UserID']).'"></div></div><div class="user-rating-content"><div class="rating-author"><h3>'.$CommentHandler -> GetUserName($_SESSION['UserID']).'</h3><span class="reply-btn" value="'.$_POST['SubjectID'].'"><a>Phản hồi</a></span></div><p>'.$_POST['CommentContent'].'</p></div></div></div>';

            echo json_encode($Return);
    }
}