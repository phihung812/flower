<main>
    <div class="login">
        <div class="form-register">
            <h2>Đăng ký tài khoản</h2>
            <div class="infor-title">
                <p>Thông tin cá nhân của bạn</p>
            </div>
            <form action="index.php?act=register" method="POST">
                <div class="form-group-register">
                    <label for="first_name">Họ:</label>
                    <input type="text" name="first_name" id="first_name" placeholder="Nhập họ của bạn">
                </div>
                <div class="form-group-register">
                    <label for="last_name">Tên:</label>
                    <input type="text" name="last_name" id="last_name" placeholder="Nhập tên của bạn">
                </div>
                <div class="form-group-register">
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" placeholder="Nhập email của bạn">
                </div>
                <div class="form-group-register">
                    <label for="phone">Số điện thoại:</label>
                    <input type="text" name="phone" id="phone" placeholder="Nhập số điện thoại">
                </div>
                <div class="form-group-register">
                    <label for="address">Địa chỉ:</label>
                    <input type="text" name="address" id="address" placeholder="Nhập địa chỉ của bạn">
                </div>
                <div class="form-group-register">
                    <label for="city">Tỉnh/Thành phố:</label>
                    <input type="text" name="city" id="city" placeholder="Nhập tỉnh/thành phố">
                </div>
                <div class="form-group-register">
                    <label for="password">Mật khẩu:</label>
                    <input type="password" name="password" id="password" placeholder="Nhập mật khẩu">
                </div>
                <p style="color:red;">
                    <?php
                    if (isset($thongbao) && $thongbao != "") {
                        echo $thongbao;
                    } ?>
                </p>

                <button type="submit" name="submit-register">Đăng ký</button>
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