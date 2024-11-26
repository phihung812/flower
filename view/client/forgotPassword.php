<main>
    <div class="account">
        <div class="repass">
            <div class="title-repass">
                <h1>Quên mật khẩu</h1>
                <p>Thông tin của bạn</p>
            </div>
            <p style="color:red; font-size:14px">
                <?php
                if (isset($thongbao) && $thongbao != "") {
                    echo $thongbao;
                } ?>
            </p>
            <form action="" method="POST" class="frm-repass">
                <div class="ipt-repass">
                    <span>* </span><label for="">Họ</label>
                    <input type="text" name="first_name" id="" placeholder="Nhập họ">
                </div>
                <div class="ipt-repass">
                    <span>* </span><label for="">Tên</label>
                    <input type="text" name="last_name" id="" placeholder="Nhập tên">
                </div>
                <div class="ipt-repass">
                    <span>* </span><label for="">Email</label>
                    <input type="text" name="email" id="" placeholder="Nhập email">
                </div>
                <div class="ipt-repass">
                    <span>* </span><label for="">Điện thoại</label>
                    <input type="text" name="phone" id="" placeholder="Nhập số điện thoại">
                </div>
                <button type="submit" name="submit-forgotPassword">Tiếp tục</button>
            </form>
        </div>
        <div class="group-login">
            <div class="item-login">
                <a href="index.php?act=login">Đăng nhập</a>
            </div>
            <div class="item-login">
                <a href="index.php?act=register">Đăng ký</a>
            </div>
            <div class="item-login">
                <a href="index.php?act=forgotPassword">Đã quên mật khẩu</a>
            </div>
            <div class="item-login">
                <a href="index.php?act=myAccount&check=historyOrder">Lịch sử đơn hàng</a>
            </div>
            <div class="item-login">
                <a href="index.php">Quay lại trang chủ</a>
            </div>

        </div>
    </div>
</main>