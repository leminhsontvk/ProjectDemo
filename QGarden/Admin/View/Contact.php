<?php
if (!defined('QGAccessGrained')) {header("HTTP/2 404 Not Found"); exit();}
$ContactList = $Super -> GetReceivedContact();
?>
<div class="container">
    <div class="cart-table-container margin-top-40">
        <div class="title margin-bottom-20">
            <h2>
                Liên hệ từ khách hàng
            </h2>
        </div>
        <div class="cart-table margin-bottom-20">
            <table class="table">
                <thead class="thead-light">
                <tr>
                    <th class="pro-title">STT</th>
                    <th>Người Gửi</th>
                    <th>Địa chỉ Mail</th>
                    <th>Tiêu Đề</th>
                    <th>Nội Dung</th>
                    <th>Thao Tác</th>
                </tr>
                </thead>
                <?php
                foreach ($ContactList as $CurrentKey => $Contact)
                {
                    echo
                    '
                     <tr>
                        <td class="pro-title">
                            <span>'.($CurrentKey + 1).'</span>
                        </td>
                        <td class="pro-subtotal">
                            <span>'.$Contact['UserName'].'</span>
                        </td>
                        <td class="pro-subtotal">
                            <span>'.$Contact['UserMail'].'</span>
                        </td>
                        <td class="pro-title">
                            <span>'.$Contact['ContactSubject'].'</span>
                        </td>
                        <td style="min-width: 250px; text-align: justify;" class="pro-title">
                            <span style="max-width: 100%!important;">'.$Contact['ContactMessage'].'</span>
                        </td>
                        <td class="pro-action">
                            <a class="a-danger" id="DeleteContact" value="'.$Contact['ContactID'].'">
                                <i class="fal fa-trash-alt"></i>
                            </a>
                            <tab></tab>
                            <a href="?Admin=Mail&Title=Re: '.$Contact['ContactSubject'].'&UserMail='.$Contact['UserMail'].'&UserName='.$Contact['UserName'].'&ReplyUserFromContactFrom=1" title="Phản Hồi Lại" value="1">
                                <i class="fal fa-reply"></i>
                            </a>
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
