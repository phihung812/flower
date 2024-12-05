<main>

    <div class="form-register" style=margin-left:600px;margin-top:30px;>
        <h2>Cập nhật tài khoản</h2>
        <form action="" method="POST" onsubmit="return validateSubmit()">
            <div class="form-group-register">
                <label for="first_name">Họ:</label>
                <input type="text" name="first_name" id="first_name" value="<?php echo $taikhoanById->first_name ?>"
                    placeholder="Nhập họ của bạn">
            </div>
            <div class="form-group-register">
                <label for="last_name">Tên:</label>
                <input type="text" name="last_name" id="last_name" value="<?php echo $taikhoanById->last_name ?>"
                    placeholder="Nhập tên của bạn">
            </div>
            <div class="form-group-register">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" value="<?php echo $taikhoanById->email ?>"
                    placeholder="Nhập email của bạn">
            </div>
            <div class="form-group-register">
                <label for="phone">Số điện thoại:</label>
                <input type="text" name="phone" id="phone" value="<?php echo $taikhoanById->phone ?>"
                    placeholder="Nhập số điện thoại">
            </div>
            <div class="form-group-register">
                <label for="address">Địa chỉ:</label>
                <input type="text" name="address" id="address" value="<?php echo $taikhoanById->address ?>"
                    placeholder="Nhập địa chỉ của bạn">
            </div>
            <div class="form-group-register">
                <label for="city">Tỉnh/Thành phố:</label>
                <input type="text" name="city" id="city" value="<?php echo $taikhoanById->city ?>"
                    placeholder="Nhập tỉnh/thành phố">
            </div>
            <div class="form-group-register">
                <label for="role">Vai trò</label>
                <select name="role" style="height: 40px;">
                    <option value="customer" <?php echo ($taikhoanById->role === 'customer') ? 'selected' : ''; ?>>Người
                        dùng</option>
                    <option value="admin" <?php echo ($taikhoanById->role === 'admin') ? 'selected' : ''; ?>>Admin
                    </option>
                </select>
            </div>

            <div class="form-group-register">
                <label for="password">Mật khẩu:</label>
                <input type="password" name="password" id="password" value="<?php echo $taikhoanById->password ?>"
                    placeholder="Nhập mật khẩu">
            </div>
            <button type="submit" name="submit-updateTaikhoan">Cập nhật</button>
            <a class="href-listPro" href="index.php?act=listTaikhoan">
                <div style="width:650px; margin-top:15px;" class="btn-listPro">Hủy</div>
            </a>
        </form>

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