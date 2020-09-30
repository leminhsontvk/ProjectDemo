<?php
if (!defined('QGAccessGrained')) {header("HTTP/2 404 Not Found"); exit();}

if ($_GET['Product']) $ProductInfo = $Product -> GetProduct($_GET['Product']);

?>
<script>
    tinymce.init
    ({
        branding: false,
        selector: '#ProductDesc',
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
<div class="container">
    <div style="display: none" id="Content">
        <?=$ProductInfo['ProductDescription'];?>
    </div>
    <div class="cart-table-container margin-top-40">
        <div class="title margin-bottom-20">
            <h2>
                Chỉnh sủa thông tin sản phẩm
            </h2>
        </div>
        <form id="productForm" class="margin-bottom-20" enctype="multipart/form-data">
            <input type="hidden" value="<?=$ProductInfo['ProductID']?>" id="ProductID">
            <div class="form-mid-box margin-bottom-20">
                <label for="CategoryName">
                    Tên sản phẩm
                </label>
                <input type="text" value="<?=$ProductInfo['ProductName']?>" id="ProductName">
            </div>
            <div class="form-mid-box margin-bottom-20">
                <label for="CategoryName">
                    Thuộc Danh mục
                </label>
                <select id="ProductCategory">
                    <?php
                    foreach ($CategoryList as $Category)
                    {
                        if ($Category['CategoryID'] == $ProductInfo['ProductCategoryID'])
                        {
                            echo '<option value="'.$Category['CategoryID'].'" selected>'.$Category['CategoryName'].'</option>';
                        } else echo '<option value="'.$Category['CategoryID'].'">'.$Category['CategoryName'].'</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="form-mid-box margin-bottom-20">
                <label for="ProductPrice">
                    Giá sản phẩm
                </label>
                <input type="text" value="<?=$ProductInfo['ProductPrice']?>" id="ProductPrice">
            </div>
            <div class="form-mid-box margin-bottom-20">
                <label for="ProductDiscount">
                    Giảm giá (%)
                </label>
                <input type="text" value="<?=$ProductInfo['ProductDiscount']?>" id="ProductDiscount">
            </div>
            <div class="form-mid-box margin-bottom-20">
                <label for="ProductAvaiable">
                    Còn trong kho
                </label>
                <input type="text" value="<?=$ProductInfo['ProductAvailable']?>" id="ProductAvailable">
            </div>
            <div class="form-mid-box margin-bottom-20">
                <label for="btn-avatar">
                    Danh sách ảnh sản phẩm
                </label>
                <button id="btn-category-image" class="btn-upload">Chọn Ảnh Mới</button>
                <input id="input-category-image" type="file" accept="image/*" style="display: none" name="UserAvatar" multiple>
            </div>
            <div class="form-full-box margin-bottom-20">
                <label for="ProductPreview">
                    Mô tả nhắn gọn
                </label>
                <textarea id="ProductPreview"><?=$ProductInfo['ProductPreview']?></textarea>
            </div>
            <div class="form-full-box">
                <label for="ProductDesc">Mô tả sản phẩm</label>
                <textarea id="ProductDesc"></textarea>
            </div>
            <?php
            if ($_GET['Product'])
            {
                echo '<button id="DoProductEdit" class="checkout-btn">Sửa</button>';
            } else echo '<button id="DoProductAdd" class="checkout-btn">Thêm</button>';
            ?>
            <div class="clearfix"></div>
        </form>
        <script>
            tinymce.activeEditor.setContent($('#Content')['0'].innerHTML);
        </script>
    </div>
</div>
