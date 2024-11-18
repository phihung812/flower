<div class="form-register">
    <h2>Chỉnh sửa tài khoản</h2>
    <form action="" method="POST">
        <div class="form-group-register">
            <label for="first_name">Họ:</label>
            <input type="text" name="first_name" id="first_name" value="<?php echo $account->first_name ?>"
                placeholder="Nhập họ của bạn">
        </div>
        <div class="form-group-register">
            <label for="last_name">Tên:</label>
            <input type="text" name="last_name" id="last_name" value="<?php echo $account->last_name ?>"
                placeholder="Nhập tên của bạn">
        </div>
        <div class="form-group-register">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" value="<?php echo $account->email ?>"
                placeholder="Nhập email của bạn">
        </div>
        <div class="form-group-register">
            <label for="phone">Số điện thoại:</label>
            <input type="text" name="phone" id="phone" value="<?php echo $account->phone ?>"
                placeholder="Nhập số điện thoại">
        </div>
        <div class="form-group-register">
            <label for="address">Địa chỉ:</label>
            <input type="text" name="address" id="address" value="<?php echo $account->address ?>"
                placeholder="Nhập địa chỉ của bạn">
        </div>
        <div class="form-group-register">
            <label for="city">Tỉnh/Thành phố:</label>
            <input type="text" name="city" id="city" value="<?php echo $account->city ?>"
                placeholder="Nhập tỉnh/thành phố">
        </div>
        
        <button type="submit" name="submit-updateTaikhoan">Cập nhật</button>
    </form>
</div>