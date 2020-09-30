<?php
/** Check Access **/
if (!defined('QGAccessGrained')) {header("HTTP/2 404 Not Found"); exit();}

if ($_POST['SiteName'])
{
    $Super -> EditSiteInfo($_POST['SiteName'], $_POST['About'], $_POST['Address'], $_POST['CSKH'], $_POST['Hotline'], $_POST['ContactMail'], $_POST['FBC'], $_POST['GPC'], $_POST['IGC'],$_POST['YTC']);
}

$SiteInfo = (new \Model\Info()) -> GetSiteInfo();
?>

<div class="container">
    <div class="cart-table-container margin-top-40">
        <div class="title margin-bottom-20">
            <h2>
                SiteInfo
            </h2>
        </div>
        <form method="post" class="margin-bottom-20">
            <div class="form-full-box margin-bottom-20">
                <label for="SiteName">
                    Tên Website
                </label>
                <input id="SiteName" value="<?=$SiteInfo['SiteName'];?>" name="SiteName">
            </div>
            <div class="form-full-box margin-bottom-20">
                <label for="About">
                    Mô Tả Website
                </label>
                <textarea id="About" name="About"><?=$SiteInfo['About'];?></textarea>
            </div>
            <div class="form-mid-box margin-bottom-20">
                <label for="Address">Địa chỉ</label>
                <input id="Address" name="Address" value="<?=$SiteInfo['ContactAddress'];?>">
            </div>
            <div class="form-mid-box form-mid-box-right margin-bottom-20">
                <label for="SDTCSKH">Chăm Sóc Khách Hàng</label>
                <input id="SDTCSKH" name="CSKH" value="<?=$SiteInfo['CustomerCareLine'];?>">
            </div>

            <div class="form-mid-box margin-bottom-20">
                <label for="Hotline">Hotline</label>
                <input id="Hotline" name="Hotline" value="<?=$SiteInfo['ContactPhoneLine'];?>">
            </div>
            <div class="form-mid-box form-mid-box-right margin-bottom-20">
                <label for="ContactMail">Mail</label>
                <input id="ContactMail" name="ContactMail" value="<?=$SiteInfo['ContactMail'];?>">
            </div>
            <div class="form-mid-box margin-bottom-20">
                <label for="FBC">Facebook</label>
                <input id="FBC" name="FBC" value="<?=$SiteInfo['FacebookSocial'];?>">
            </div>
            <div class="form-mid-box form-mid-box-right margin-bottom-20">
                <label for="GPC">Google Mail</label>
                <input id="GPC" name="GPC" value="<?=$SiteInfo['GoogleSocial'];?>">
            </div>
            <div class="form-mid-box margin-bottom-20">
                <label for="IGC">Instagarm</label>
                <input id="IGC" name="IGC" value="<?=$SiteInfo['IGSocial'];?>">
            </div>
            <div class="form-mid-box form-mid-box-right margin-bottom-20">
                <label for="YTC">Youtube</label>
                <input id="YTC" name="YTC" value="<?=$SiteInfo['YoutubeSocial'];?>">
            </div>
            <div class="form-full-box">
                <button class="checkout-btn" type="submit">Chỉnh Sửa</button>
            </div>
            <div class="clearfix"></div>
        </form>
    </div>
</div>