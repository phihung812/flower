<main>
    <div class="login">
        <div class="form-register">
            <h2>Đăng ký tài khoản</h2>
            <p style="color:red; font-size:14px">
                <?php
                if (isset($thongbao) && $thongbao != "") {
                    echo $thongbao;
                } ?>
            </p>
            <div class="infor-title">
                <p>Thông tin cá nhân của bạn</p>
            </div>
            <form action="index.php?act=register" method="POST" onsubmit="return validateSubmit()">
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
                <a href="index.php?act=forgotPassword">Đã quên mật khẩu</a>
            </div>
            <div class="item-login">
                <a href="">Lịch sử đơn hàng</a>
            </div>
            <div class="item-login">
                <a href="index.php">Quay lại trang chủ</a>
            </div>

        </div>
    </div>
</main>
<script>
    function validateSubmit() {
        var first_name = document.getElementById('first_name');
        var last_name = document.getElementById('last_name');
        var email = document.getElementById('email');
        var phone = document.getElementById('phone');
        var address = document.getElementById('address');
        var city = document.getElementById('city');
        var password = document.getElementById('password');

        if (first_name.value == '') {
            alert('Họ không được để trống');
            return false;
        }
        if (last_name.value == '') {
            alert('Tên không được để trống');
            return false;
        }
        if (email.value == '' || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email.value)) {
            alert('Email không hợp lệ. Vui lòng nhập đúng định dạng.');
            return false;
        }
        if (phone.value == '' || !/^\d{10}$/.test(phone.value)) {
            alert('Số điện thoại phải gồm 10 chữ số.');
            return false;
        }
        if (address.value == '') {
            alert('Địa chỉ không được để trống');
            return false;
        }
        if (city.value == '') {
            alert('Tỉnh thành phố không được để trống');
            return false;
        }
        if (password.value.length < 6) {
            alert('Mật khẩu phải từ 6 kí tự trở lên');
            return false;
        }

    }
</script>