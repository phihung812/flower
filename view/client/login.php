<main>
    <div class="login">
        <div class="form-login">
            <h2>ĐĂNG NHẬP</h2>
            <form action="" method="POST">
                <p>Địa chỉ email</p>
                <input type="text" name="email" id="" placeholder="Địa chỉ email">
                <p>Mật khẩu</p>
                <input type="text" name="password" id="" placeholder="Mật khẩu"><br>
                <p style="color:red;">
                    <?php if (isset($thongbao) && $thongbao != "") {
                        echo $thongbao;
                    }
                    ?>
                </p>
                <button type="submit" name="submit-login">Đăng nhập</button>
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
                <a href="">Đã quên mật khẩu</a>
            </div>
            <div class="item-login">
                <a href="">Tài khoản của tôi</a>
            </div>
            <div class="item-login">
                <a href="">Lịch sử đơn hàng</a>
            </div>

        </div>
    </div>
</main>