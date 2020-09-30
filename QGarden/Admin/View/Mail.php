<?php
/** Check Access **/
if (!defined('QGAccessGrained')) {header("HTTP/2 404 Not Found"); exit();}

if ($_GET['ReplyUserFromContactFrom'])
{
    $Title = $_GET['Title'];
    $UserMail = $_GET['UserMail'];
    $UserName = $_GET['UserName'];
} else $UserMail = $UserName = $Title = NULL;

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
    <div class="cart-table-container margin-top-40">
        <div class="title margin-bottom-20">
            <h2>
                Maketing Email
            </h2>
        </div>
        <form>
            <div class="form-full-box">
                <label for="MailList">
                    Danh sách mail người dùng. (Nếu gửi hàng loạt phân cách mỗi mail là một dấu ",".)
                </label>
                <textarea id="MailList"><?php echo $UserMail?></textarea>
            </div>
            <div class="form-full-box margin-bottom-20">
                <label for="UserList">
                    Danh sách tên người dùng. (Nếu gửi hàng loạt phân cách mỗi tên người dùng là một dấu ",".)
                </label>
                <textarea id="UserList"><?php echo $UserName?></textarea>
            </div>
            <div class="form-full-box margin-bottom-20">
                <label for="MailTitle">
                    Tiêu đề:
                </label>
                <input type="text" value="<?=$Title;?>" id="MailTitle">
            </div>
            <div class="form-mid-box margin-bottom-20">
                <label for="FromMail">
                    Gửi từ:
                </label>
                <select id="FromMail">
                    <option></option>
                    <option value="support.qgarden@lmsq.vn">support.qgarden@lmsq.vn</option>
                </select>
            </div>
            <div class="form-mid-box form-mid-box-right margin-bottom-20">
                <label for="Temple">
                    Chọn mẫu mail.
                </label>
                <select id="Temple">
                    <option></option>
                    <option value="2">Khách hàng thân thiết</option>
                </select>
            </div>
            <div id="input-coupon" class="form-full-box hidden margin-bottom-20">
                <label for="Coupon">
                    Mã Giảm Giá
                </label>
                <input id="Coupon" type="text">
            </div>
            <div class="form-full-box">
                <label for="Self">
                    Hoặc tự soạn mail
                </label>
                <textarea id="Self"></textarea>
            </div>
            <div class="form-full-box margin-top-20 margin-bottom-20">
                <button type="submit" id="DoMail" class="checkout-btn">Gửi Mail</button>
            </div>
        </form>
    </div>
</div>