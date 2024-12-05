<main>
    <?php
    if (isset($thongbao) && ($thongbao != "")) {
        echo "<h3 style='color:red;'>$thongbao</h3>";
    }

    ?>
    <div class="payment">

        <div class="inforcustomer">
            <div class="titleinforcustomer">
                <p>Thông tin nhận hàng</p>
            </div>
            <form action="" method="POST" onsubmit="return confirmSubmit()">
                <div class="row1">
                    <div class="ipt-name">
                        <span>*</span><label for="">Họ tên</label><br>
                        <input type="text" id="namee" name="name" placeholder="Họ tên" required value="<?php if (isset($user) && is_object($user))
                            echo $user->first_name . ' ' . $user->last_name; ?>">
                    </div>
                    <div class="ipt-phone">
                        <span>*</span><label for="">Điện thoại</label><br>
                        <input type="text" id="phone" name="phone" placeholder="Điện thoại" required value="<?php if (isset($user) && is_object($user))
                            echo $user->phone ?>">
                        </div>
                    </div>
                    <div class="row2">
                        <span>*</span><label for="">Email</label><br>
                        <input type="text" id="email" name="email" placeholder="Email" required value="<?php if (isset($user) && is_object($user))
                            echo $user->email ?>">
                    </div>
                    <div class="row1">
                        <div class="ipt-name">
                            <span>*</span><label for="">Quận/Huyện</label><br>
                            <input type="text" id="shipping_address" name="shipping_address" required
                                placeholder="Quận/Huyện" value="<?php if (isset($user) && is_object($user))
                            echo $user->address ?>">
                        </div>
                        <div class="ipt-phone">
                            <span>*</span><label for="">Tỉnh/Thành phố</label><br>
                            <input type="text" id="shipping_city" name="shipping_city" placeholder="Tỉnh/Thành phố" required
                                value="<?php if (isset($user) && is_object($user))
                            echo $user->city ?>">
                        </div>
                    </div>
                    <div class="row2">
                        <span>*</span><label for="">Phương thức thanh toán</label><br>
                        <select name="payment_method" id="">
                            <option value="cash">Thanh toán khi nhận hàng</option>
                            <option value="online">Thanh toán online</option>
                        </select>
                    </div>
                    <div class="row2">
                        <label for="">Yêu cầu, lưu ý (nếu có)</label><br>
                        <textarea name="" id="" cols="86" rows="10"></textarea>
                    </div>
                    <button type="submit" name="submit-payment">Xác nhận</button>

                </form>
                <a href="index.php?act=cart">
                    <button style="background-color: red;">Quay lại</button>
                </a>
            </div>
            <div class="infororder">
                <div class="titleinfororder">
                    <p>Chi tiết đơn hàng</p>
                </div>
                <table border="1">
                    <tr>
                        <th>Ảnh</th>
                        <th>Tên sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Tổng tiền</th>
                    </tr>
                <?php foreach ($cartItem as $cart) { ?>
                    <tr>
                        <td>
                            <div class="border-img">
                                <img style="width: 50px;height: 50px;" src="<?php echo 'duan01/' . $cart->main_image ?>"
                                    alt="">

                            </div>
                        </td>
                        <td><?php echo $cart->name ?></td>
                        <td><?php echo $cart->quantity ?></td>
                        <td style="text-align: right; padding-right: 10px;"><?php echo $cart->total_price ?></td>
                    </tr>
                <?php } ?>
                <tr>
                    <td style="font-weight: bold; text-align: right;padding-right: 10px;" colspan="3">Tổng số lượng</td>
                    <td style="text-align: right; padding-right: 10px;"><?php echo $cartAll->total_items ?></td>
                </tr>
                <tr>
                    <td style="font-weight: bold; text-align: right;padding-right: 10px;" colspan="3">Tổng cộng</td>
                    <td style="text-align: right; padding-right: 10px; color: red;">
                        <?php echo number_format($cartAll->total_price, 0, ',', '.') ?> VND
                    </td>
                </tr>
            </table>
        </div>
    </div>



</main>
<script>
    function confirmSubmit() {
        var namee = document.getElementById('namee');
        var email = document.getElementById('email');
        var phone = document.getElementById('phone');
        var shipping_address = document.getElementById('shipping_address');
        var shipping_city = document.getElementById('shipping_city');

        if (namee.value == '') {
            alert('Họ tên không được để trống');
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
        if (shipping_address.value == '') {
            alert('Địa chỉ không được để trống');
            return false;
        }
        if (shipping_city.value == '') {
            alert('Tỉnh thành phố không được để trống');
            return false;
        }

        return confirm("Xác nhận thanh toán?");
    }
</script>