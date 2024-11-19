<main>

    <div class="form-register" style=margin-left:600px;margin-top:30px;>
        <h2>Cập nhật tài khoản</h2>
        <form action="" method="POST">
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
        </form>
    </div>

</main>