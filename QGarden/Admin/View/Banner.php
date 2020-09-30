<?php
/** Check Access **/
if (!defined('QGAccessGrained')) {header("HTTP/2 404 Not Found"); exit();}

$BannerList = $Super -> GetBanner();
?>
<div class="container">
    <div class="cart-table-container margin-top-40">
        <div class="title margin-bottom-20">
            <h2>
                Danh sách banner
            </h2>
        </div>
        <form class="hidden margin-bottom-20" enctype="multipart/form-data">
            <div class="form-full-box margin-bottom-20">
                <label for="btn-avatar">
                    Ảnh banner
                </label>
                <button id="btn-category-image" class="btn-upload">Chọn Ảnh Mới</button>
                <input id="input-category-image" type="file" accept="image/*" style="display: none" name="Banner">
            </div>
            <button id="DoAddBanner" type="submit" class="checkout-btn">Thêm</button>
            <div class="clearfix"></div>
        </form>
        <button class="checkout-btn" type="submit" id="AddBanner">Thêm Banner</button>
        <div class="clearfix"></div>
        <div class="cart-table margin-bottom-20 margin-top-20">
            <table class="table">
                <thead class="thead-light">
                <tr>
                    <th class="pro-title">Banner ID</th>
                    <th>Ảnh Mô Tả</th>
                    <th>Trạng Thái</th>
                    <th>Thao Tác</th>
                </tr>
                </thead>
                <?php
                foreach ($BannerList as $CurrentKey => $Banner)
                {
                    if ($Banner['BannerStatus'] == 1)
                    {
                        $Status = "Hoạt Động";
                        $AvailableLink = '<a class="a-danger" title="Xóa Banner" id="DeleteBanner" value="'.$Banner['BannerID'].'"><i class="fal fa-trash-alt"></i></a><tab></tab><a id="SetUnactive" title="Ngưng hoạt động banner" value="'.$Banner['BannerID'].'"><i class="fal fa-times-circle"></i></a>';
                    }
                    else
                    {
                        $Status = "Không Hoạt Động";
                        $AvailableLink = '<a class="a-danger" id="DeleteBanner" value="'.$Banner['BannerID'].'"><i class="fal fa-trash-alt"></i></a><tab></tab><a id="SetActive" title="Kích hoạt banner lên trang chủ" value="'.$Banner['BannerID'].'"><i class="fal fa-check-circle"></i></a>';
                    }
                    echo
                    '
                    <tr>
                        <td class="pro-title">
                            <span>'.($CurrentKey + 1).'</span>
                        </td>
                        <td class="pro-thumbnail">
                            <img src="'.$PublicConfig::WebImagesRoot.$Banner['BannerImage'].'" alt="Product">
                        </td>
                        <td class="pro-subtotal">
                            <span>'.$Status.'</span>
                        </td>
                        <td class="pro-action">
                        '.$AvailableLink.'
                        </td>
                    </tr>
                    ';
                }
                ?>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>
