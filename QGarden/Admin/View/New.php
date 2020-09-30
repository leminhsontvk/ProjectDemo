<?php
if (!defined('QGAccessGrained')) {header("HTTP/2 404 Not Found"); exit();}

if ($_GET['News'])
{
    $News = new \Model\News();
    $NewsInfo = $News -> GetNewsInfo($_GET['News']);
}

?>
<div class="container">
    <script>
        tinymce.init
        ({
            branding: false,
            selector: '#Self',
            height: 500,
            images_upload_url: '../Model/AJAX/NewsImages.php',
            plugins:
                [
                    'advlist autolink link image imagetools lists charmap print preview hr anchor pagebreak spellchecker',
                    'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
                    'save table directionality emoticons template paste'
                ],
            toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons'
        });
    </script>
    <div class="hidden" id="Content"><?=$NewsInfo['NewsContent']?></div>
    <div class="cart-table-container margin-top-40">
        <div class="title margin-bottom-20">
            <form enctype="multipart/form-data" class="margin-bottom-20">
                <div class="form-full-box margin-bottom-20">
                    <label for="NewsTitle">Tiêu Đề Tin</label>
                    <input type="text" value="<?=$NewsInfo['NewsTitle']?>" id="NewsTitle">
                </div>
                <div class="form-full-box margin-bottom-20">
                    <label for="NewsPreview">
                        Bản xem trước
                    </label>
                    <textarea id="NewsPreview"><?=$NewsInfo['NewsPreview']?></textarea>
                </div>
                <div class="form-full-box margin-bottom-20">
                    <label for="btn-avatar">
                        Ảnh Đại Diện Tin Tức
                    </label>
                    <button id="btn-category-image" class="btn-upload">Chọn Ảnh Mới</button>
                    <input id="input-category-image" type="file" accept="image/*" style="display: none" name="UserAvatar">
                </div>
                <div class="form-full-box margin-bottom-20">
                    <label for="NewsContent">
                        Nội Dung Tin
                    </label>
                    <textarea id="Self"></textarea>
                </div>
                <input type="hidden" id="SubjectID" value="<?=$NewsInfo['NewsID']?>">
                <?php
                if ($_GET['News'])
                {
                    echo '<button type="submit" id="DoEditNews" class="checkout-btn">Chỉnh Sửa</button>';
                } else echo '<button type="submit" id="DoAddNews" class="checkout-btn">Thêm Tin Tức</button>'
                ?>
                <div class="clearfix"></div>
            </form>
        </div>
    </div>

</div>

