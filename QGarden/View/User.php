<?php
/** Check Access **/
if (!defined('QGAccessGrained')) {header("HTTP/2 404 Not Found"); exit();}

$CartHandler = new \Model\Cart();

$BillList = $CartHandler -> GetBill();

?>

<div class="container">
    <section class="UserAccount margin-top-40">
        <div class="user-account-nav" id="AccountNav">
            <a id="dashboad" class="active">
                <i class="fas fa-tachometer-alt"></i> Thông Tin Tài Khoản
            </a>
            <a id="orders" data-toggle="tab">
                <i class="fa fa-cart-arrow-down"></i> Đơn Hàng Của Bạn
            </a>
            <a id="payment-method" data-toggle="tab">
                <i class="fa fa-credit-card"></i> Phương Thức Thanh Toán
            </a>
            <a id="address-edit" data-toggle="tab">
                <i class="fa fa-map-marker"></i> Địa Chỉ
            </a>
            <a id="account-info" data-toggle="tab">
                <i class="fa fa-user"></i> Thay Đổi Thông Tin Tài Khoản
            </a>
            <a href="?QGPage=Logout&Redirect=Home">
                <i class="fa fa-sign-out"></i> Đăng Xuất
            </a>
        </div>
        <div class="account-tab-content" id="AccountTab">
            <div class="tab-pane active" id="dashboad" role="tabpanel">
                <div class="myaccount-content">
                    <h3>Thông Tin Tài Khoản</h3>
                    <div class="current-info">
                        <div class="avatar-box">
                            <div class="user-avatar-box">
                                <img src="<?=$PublicConfig::WebImagesRoot.$_SESSION['UserAvatar']?>">
                            </div>
                        </div>
                        <div class="user-info-box">
                            <h4><?=$_SESSION['UserName']?></h4>
                            <div class="box-info">
                                <div class="single-info">
                                    <div class="title">
                                        <i class="far fa-map-marker-alt"></i> <?=$_SESSION['UserAddress']?>
                                    </div>
                                </div>
                                <div class="single-info">
                                    <div class="title">
                                        <i class="fal fa-birthday-cake"></i> <?=gmdate('d/m/Y', $_SESSION['UserBirthday'])?> (<?=(int)(gmdate('Y', time()) - gmdate('Y', $_SESSION['UserBirthday'])) ?> Thanh Xuân)
                                    </div>
                                </div>
                                <div class="single-info">
                                    <div class="title">
                                        <i class="fas fa-mobile-android-alt"></i> <?=Format($_SESSION['UserPhoneNumber'])?> (<?php echo detect_number('0352251115')?>)
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="tab-pane fade" id="orders" role="tabpanel">
                <div class="myaccount-content">
                    <h3>Orders</h3>
                    <div class="myaccount-table table-responsive text-center">
                        <table class="table table-bordered">
                            <thead class="thead-light">
                            <tr>
                                <th>Mã Đơn Hàng</th>
                                <th>Người nhận</th>
                                <th>Ngày tạo đơn</th>
                                <th>Trạng Thái</th>
                                <th>Tổng Tiền</th>
                                <th>Xem chi tiết</th>
                            </tr>
                            </thead>

                            <tbody>
                            <?php
                            foreach ($BillList as $BillKey => $Bill)
                            {
                                switch ($Bill['BillStatus'])
                                {
                                    case 0:
                                        $Status = "Đặt hàng thành công.";
                                        break;
                                    case 1:
                                        $Status = "Đang giao hàng.";
                                        break;
                                    case 2:
                                        $Status = "Giao hàng thành công.";
                                        break;
                                    case 3:
                                        $Status = "Không giao được hàng.";
                                        break;
                                    case 4:
                                        $Status = "Hóa đơn đã bị hủy.";
                                        break;
                                }
                                echo
                                '
                                <tr>
                                    <td>'.$Bill['BillID'].'</td>
                                    <td>'.$_SESSION['UserName'].'</td>
                                    <td>'.$Core -> ReturnDate($Bill['BillCreateDate']).'</td>
                                    <td>'.$Status.'</td>
                                    <td>VNĐ '.number_format($Bill['BillTotalCost'], 0, '', '.').'</td>
                                    <td><a href="?QGPage=View&Bill='.$Bill['BillID'].'" class="btn">View</a></td>
                                </tr>
                                ';
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="payment-method" role="tabpanel">
                <div class="myaccount-content">
                    <h3>Phương Thức Thanh Thoán</h3>

                    <p class="saved-message">Website chỉ chấp nhận thanh toán COD. (Thanh toán online đang được phát triển).</p>
                </div>
            </div>
            <div class="tab-pane fade" id="address-edit" role="tabpanel">
                <div class="myaccount-content">
                    <h3>Địa chỉ nhận hàng</h3>
                    <address>
                        <p><strong><?=$_SESSION['UserName']?></strong></p>
                        <p><?=$_SESSION['UserAddress']?></p>
                        <p>Điện thoại:<?=Format($_SESSION['UserPhoneNumber'])?></p>
                    </address>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="tab-pane fade" id="account-info" role="tabpanel">
                <div id="ToScroll" class="myaccount-content">
                    <h3>Thay Đổi Thông Tin</h3>
                    <div id="ErrorBox" class="alert alert-danger"></div>
                    <div class="account-details-form">
                        <form enctype="multipart/form-data">
                            <div class="form-full-box margin-bottom-20">
                                <button id="btn-avatar" class="btn-upload">Chọn Ảnh Mới</button>
                                <input id="input-avatar" type="file" accept="image/*" style="display: none" name="UserAvatar">
                            </div>
                            <div class="form-full-box margin-bottom-20">
                                <input id="LoginName" name="LoginName" placeholder="Tên Đăng Nhập" type="text">
                            </div>
                            <div class="form-full-box margin-bottom-20">
                                <input id="UserName" name="UserName" placeholder="Họ và tên" type="text">
                            </div>
                            <div class="form-full-box margin-bottom-20">
                                <input id="Email" placeholder="Địa Chỉ Mail" type="email">
                            </div>
                            <div class="form-full-box margin-bottom-20">
                                <input id="Address" name="Address" placeholder="Địa chỉ nhận hàng" type="text">
                            </div>
                            <div class="form-full-box margin-bottom-20">
                                <input id="Phone" name="Phone" placeholder="Số điện thoại" type="text">
                            </div>
                            <div class="form-full-box margin-bottom-20">
                                <input id="Birthday" name="Birthday" placeholder="Sinh nhật (Tháng - Ngày - Năm, Ví dụ: 10/20/2000)" type="date">
                            </div>
                            <div class="form-full-box">
                                <h4 style="margin-bottom: 10px!important;">Đổi Mật Khẩu (Để trống nếu không thay đổi)</h4>
                            </div>
                            <div class="form-full-box margin-bottom-20">
                                <input id="CurrentPassword" name="CurrentPassword" placeholder="Mật khẩu hiện tại" type="password">
                            </div>
                            <div class="form-mid-box margin-bottom-20">
                                <input id="NewPassword" name="NewPassword" placeholder="Mật khẩu mới" type="password">
                            </div>
                            <div class="form-mid-box form-mid-box-right margin-bottom-20">
                                <input id="ConfirmNewPassword" name="ConfirmNewPassword" placeholder="Nhập lại mật khẩu mới" type="password">
                            </div>
                            <div class="form-full-box">
                                <button id="UserInfoChange" name="UserInfoChange" class="checkout-btn">Lưu Thay Đổi</button>
                            </div>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </section>
    <div class="clearfix"></div>
</div>