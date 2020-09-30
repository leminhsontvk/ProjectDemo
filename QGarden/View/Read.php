<?php
/** Check Access **/
if (!defined('QGAccessGrained')) {header("HTTP/2 404 Not Found"); exit();}

$NewsHandler = new Model\News();
$Comments = new \Model\Comments();
$News = $NewsHandler -> GetNewsInfo($_GET['News']);
$CommentsList = $Comments -> GetComment(2, $_GET['News']);

$Core -> LogFile('', '', $_GET);

?>

<div class="container-70">
    <section class="QGNews margin-bottom-40 margin-top-40">
        <div class="blog-single-post-container margin-bottom-40">
            <h3 class="post-title"><?=$News['NewsTitle'];?></h3>
            <div class="post-meta">
                <p><span><i class="fa fa-user-circle"></i> Posted By: </span> <a href="#"><?=$News['UserName'];?></a> <span class="separator">|</span> <span><i class="fa fa-calendar"></i> Đăng vào: <a href="#"><?=gmdate('j F, Y', $News['NewsCreateDate']);?></a></span></p>
            </div>
            <div style="margin: 0 auto!important; max-height: unset!important; display: block;" class="image">
                <img src="<?=$PublicConfig::WebImagesRoot.$News['NewsDefaultImage'];?>" alt="">
            </div>
            <div class="post-content">
                <?=$News['NewsContent'];?>
            </div>
            <div class="social-share-buttons">
                <h3>Share bản tin.?</h3>
                <ul>
                    <li>
                        <a class="twitter" href="#">
                            <i class="fab fa-twitter"></i>
                        </a>
                    </li>
                    <li>
                        <a class="facebook" href="#">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                    </li>
                    <li>
                        <a class="google-plus" href="#">
                            <i class="fab fa-google-plus-g"></i>
                        </a>
                    </li>
                    <li>
                        <a class="pinterest" href="#">
                            <i class="fab fa-pinterest"></i>
                        </a>
                    </li>
                </ul>
            </div>

            <div id="review-content" class="review-content">

                <?php
                if (count($CommentsList) > 0)
                {
                    foreach ($CommentsList as $Comment)
                    {
                        $RateStarList = "";
                        $ReplyList = $Comments -> GetComment(3, $Comment['CommentID']);
                        $UserAvatar = $Comments -> GetUserAvatar($Comment['CommentOfUserID']);
                        $UserName = $Comments -> GetUserName(($Comment['CommentOfUserID']));
                        echo
                            '
                            <div class="user-rating-box margin-top-20">
                                <div class="user-rating">
                                    <div class="avatar-container">
                                        <div class="user-avatar">
                                            <img src="'.$PublicConfig::WebImagesRoot.$UserAvatar.'">
                                        </div>
                                    </div>
                                    <div class="user-rating-content">
                                        <div class="rating-author">
                                            <h3>'.$UserName.'</h3>
                                            <span class="reply-btn" value="'.$Comment['CommentID'].'"><a>Phản hồi</a></span>
                                        </div>
                                        <p>
                                            '.$Comment['CommentContent'].'
                                        </p>
                                    </div>
                                </div>
                            
                            ';

                        if (count($ReplyList) > 0)
                        {
                            foreach ($ReplyList as $Reply)
                            {
                                $RateStarList = "";
                                $UserAvatar = $Comments -> GetUserAvatar($Reply['CommentOfUserID']);
                                $UserName = $Comments -> GetUserName(($Reply['CommentOfUserID']));
                                echo
                                    '
                            <div class="user-rating-box margin-top-20">
                                <div class="user-rating">
                                    <div class="avatar-container">
                                        <div class="user-avatar">
                                            <img src="'.$PublicConfig::WebImagesRoot.$UserAvatar.'">
                                        </div>
                                    </div>
                                    <div class="user-rating-content">
                                        <div class="rating-author">
                                            <h3>'.$UserName.'</h3>
                                            <span class="reply-btn" value="'.$Comment['CommentID'].'"><a>Phản hồi</a></span>
                                        </div>
                                        <p>
                                            '.$Reply['CommentContent'].'
                                        </p>
                                    </div>
                                </div>
                            </div>
                            ';
                            }
                        }
                        echo '<div id="EndOfR'.$Comment['CommentID'].'"></div>';
                        echo '</div>'; //Close user-rating-box having a reply.
                    }
                } else
                {
                    echo
                    '
                        <div class="user-rating-box margin-top-20 no-min-height">
                            <div class="user-rating-content">
                                <div class="rating-author">
                                    <h3>Chưa có bình luận nào về sản phẩm này</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                        ';
                }

                if ($_SESSION['Logged'] === 1)
                {
                    echo
                        '
                        <div id="EndOfComment" class="add-a-comment margin-top-20">
                            <h3>Bình luận của bạn:</h3>
                            <form id="CommentForm">
                            <div class="form-full-box margin-bottom-20">
                            <input type="hidden" value="'.$_GET['News'].'" id="NewsID">
                            <input type="hidden" value="" id="ReplyOnID">
                                <label for="your-review">Nội dung:</label>
                                <textarea name="review" id="your-review" placeholder="Viết bình luận"></textarea>
                            </div>
                            <div class="form-full-box">
                                <button id="DoNewsComment" type="submit">Bình luận</button>
                            </div>
                        </form>
                        </div>
                        ';
                }
                else
                {
                    echo
                    '
                        <div class="add-a-comment margin-top-20">
                            <h3>Vui lòng đăng nhập để đăng bình luận.</h3>
                        </div>
                        ';
                }
                ?>
                <div class="clearfix"></div>
            </div>
        </div>
    </section>
    <div class="clearfix"></div>
</div>