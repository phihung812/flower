<?php
require_once "./controller/taikhoanController.php";

?>
<main>
    <div class="account">
        <?php if (isset($_GET['check']) && $_GET['check'] !== "myAccount") {
            $check = $_GET['check'];
            switch ($check) {
                case 'editAccount':
                    $taikhoan = new TaikhoanController;
                    $taikhoan->editAccount();
                    break;
                case 'rePassAccount':
                    $taikhoan = new TaikhoanController;
                    $taikhoan->rePassAccount();
                    break;
                
            }
        } else { ?>
            <div class="myaccount">
                <h2 style="margin-top: 0;">Tài khoản của tôi</h2>
                <a href="index.php?act=myAccount&check=editAccount" style="margin-top: -10px;">Chỉnh sửa thông tin tài khoản của bạn</a>
                <a href="index.php?act=myAccount&check=rePassAccount" style="margin-top: 4px;">Thay đổi mật khẩu của bạn</a>
                <h2 style="margin-top: 20px;">Đơn đặt hàng của tôi</h2>
                <a href="" style="margin-top: -10px;">Xem lịch sử đặt hàng của bạn</a>
            </div>
        <?php } ?>

        <div class="group-login">
            <div class="item-login">
                <a href="index.php?act=myAccount">Tài khoản của tôi</a>
            </div>
            <div class="item-login">
                <a href="index.php?act=myAccount&check=editAccount">Chỉnh sửa tài khoản</a>
            </div>
            <div class="item-login">
                <a href="index.php?act=myAccount&check=rePassAccount">Mật khẩu</a>
            </div>
            <div class="item-login">
                <a href="index.php?act=myAccount">Lịch sử đơn hàng</a>
            </div>
            <div class="item-login">
                <a href="index.php?act=logout">Đăng xuất</a>
            </div>

        </div>
    </div>
</main>