<?php
/** Check Access **/
if (!defined('QGAccessGrained')) {header("HTTP/2 404 Not Found"); exit();}
?>

<div class="container">
    <div class="cart-table-container margin-top-40">
        <div class="title margin-bottom-20">
            <h2>
                Danh mục sản phẩm
            </h2>
        </div>
        <form id="AddCategory" class="margin-bottom-20" enctype="multipart/form-data">
            <div class="form-mid-box margin-bottom-20">
                <label id="category-edit" for="AddCategoryName">
                    Tên Danh Mục
                </label>
                <input type="text" value="" id="AddCategoryName">
            </div>
            <div class="form-mid-box form-mid-box-right margin-bottom-20">
                <label for="btn-avatar">
                    Ảnh Đại Diện Danh Mục
                </label>
                <button id="btn-category-image" type="button" class="btn-upload">Chọn Ảnh Mới</button>
                <input id="input-category-image" type="file" accept="image/*" style="display: none" name="UserAvatar">
            </div>
            <button id="DoCategoryAdd" class="checkout-btn">Thêm</button>
            <div class="clearfix"></div>
        </form>
        <form class="hidden margin-bottom-20" enctype="multipart/form-data">
            <input type="hidden" value="" id="EditID">
            <div class="form-mid-box margin-bottom-20">
                <label id="category-edit" for="CategoryName">
                    Tên Danh Mục
                </label>
                <input type="text" value="" id="CategoryName">
            </div>
            <div class="form-mid-box form-mid-box-right margin-bottom-20">
                <label for="btn-avatar">
                    Ảnh Đại Diện Danh Mục
                </label>
                <button id="btn-category-add-image" class="btn-upload">Chọn Ảnh Mới</button>
                <input id="input-category-image" type="file" accept="image/*" style="display: none" name="UserAvatar">
            </div>
            <button id="DoCategoryEdit" class="checkout-btn">Sửa</button>
            <div class="clearfix"></div>
        </form>
        <div class="cart-table margin-bottom-20">
            <table class="table">
                <thead>
                <tr>
                    <th class="pro-title">STT</th>
                    <th class="pro-title">Ảnh mô tả</th>
                    <th class="pro-title">Tên danh mục</th>
                    <th class="pro-title">Số sản phẩm</th>
                    <th class="pro-title">Thao tác</th>
                </tr>
                </thead>
                <tbody>

                <?php
                foreach ($CategoryList as $CurrentKey => $CategoryInfo)
                {
                    echo
                    '
                    <tr>
                    <td class="pro-title">
                        <span>'.($CurrentKey + 1).'</span>
                    </td>
                    <td style="max-height: 130px!important;" class="pro-thumbnail">
                        <a style="max-height: 130px!important;" >
                            <img style="max-height: 130px!important; max-width: 130px!important;"  src="'.$PublicConfig::WebImagesRoot.$CategoryInfo['CategoryDefaultImage'].'" alt="Product">
                        </a>
                    </td>
                    <td class="pro-subtotal">
                        <span>'.$CategoryInfo['CategoryName'].'</span>
                    </td>
                    <td class="pro-title">
                        <span>'.$CategoryInfo['CategoryTotalProduct'].'</span>
                    </td>
                    <td id="category-action" class="pro-action">
                        <input type="hidden" value="Category" id="SubjectName">
                        <input type="hidden" value="'.$CategoryInfo['CategoryID'].'" id="SubjectID">
                        <a id="DeleteCategory" value="1">
                            <i class="fal fa-trash-alt"></i>
                        </a>
                        <tab></tab>
                        <a id="EditCategory" value="1">
                            <i class="fal fa-edit"></i>
                        </a>
                    </td>
                </tr>
                    ';
                }
                ?>

                </tbody>
            </table>
        </div>
    </div>
</div>
