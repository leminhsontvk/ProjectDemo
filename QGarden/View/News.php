<?php
/** Check Access **/
if (!defined('QGAccessGrained')) {header("HTTP/2 404 Not Found"); exit();}

$TotalNews = $NewsHandler -> GetTotalNews();

$NewsPagination = $Core -> Page($TotalNews, $CurrentPage);

?>

<div class="container-70">
    <section class="QGNews margin-bottom-40 margin-top-40">
        <?php
        foreach ($NewsList as $News)
        {
            echo
            '
            <div class="single-blog-post margin-bottom-40">
            <div class="post-container">
                <div class="single-blog-post-media mb-sm-20">
                    <div class="image">
                        <a href="?QGPage=Read&News='.$News['NewsID'].'"><img src="'.$PublicConfig::WebImagesRoot.$News['NewsDefaultImage'].'" alt=""></a>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="post-container">
                <div class="single-blog-post-content">
                    <h3 class="post-title">
                    <a href="?QGPage=Read&News='.$News['NewsID'].'">'.$News['NewsTitle'].'</a></h3>
                    <div class="post-meta">
                        <p>
                            <span><i class="fa fa-user-circle"></i> </span> <a>'.$News['UserName'].'</a> <span class="separator">|</span> <span><i class="fal fa-calendar-alt"></i> <a href="#">'.gmdate('j F, Y', $News['NewsCreateDate']).'</a></span></p>
                    </div>

                    <p class="post-excerpt">'.$News['NewsPreview'].'</p>
                    <a href="?QGPage=Read&News='.$News['NewsID'].'" class="blog-readmore-btn">Đọc Thêm</a>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
            ';
        }
        ?>
        <div class="pagination-box">
            <ul class="pagination">
                <?php
                echo $NewsPagination;
                ?>
            </ul>
            <div class="pagination-text">
                <?php

                if ($TotalNews <= $PublicConfig -> ProductPerPage)
                {
                    $From = '1';
                    $PageCount = '1';
                    $To = $TotalNews;
                    $All = $TotalNews;
                }

                if ($TotalNews > $PublicConfig -> ProductPerPage)
                {
                    $All = $TotalNews;
                    /** @var int $CurrentPage */
                    $From = (($CurrentPage - 1) * $PublicConfig -> ProductPerPage) + 1;
                    $PageCount = ceil($TotalNews / $PublicConfig -> ProductPerPage);
                    $To = (($CurrentPage - 1) * $PublicConfig -> ProductPerPage) + ($PublicConfig -> ProductPerPage);

                    if ($To > $TotalNews) $To = $TotalNews;
                }

                ?>
                Đang hiển thị <?=$From?> đến <?=$To?> trong <?=$All?> (<?=$PageCount?> Trang)
            </div>
        </div>
    </section>
    <div class="clearfix"></div>
</div>
