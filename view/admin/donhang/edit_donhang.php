


<form action="" method="post">
    <h1>Cập nhật đơn hàng</h1><br><br>

    <label for="customer">Khách hàng:</label>
    <span class="info-text"><?php echo $sua->name; ?></span>

    <label for="quantity">Số lượng:</label>
    <span class="info-text"><?php echo $sua->total_items; ?></span>

    <label for="total_price">Tổng cộng:</label>
    <span class="info-text"><?php echo $sua->total_price; ?></span>

    <label for="shipping_address">số điện thoại:</label>
    <span class="info-text">0<?php echo $sua->phone; ?></span>

    <label for="payment_status">Trạng thái thanh toán:</label>
    <input type="text"  name=trangthai_tien value="<?php echo $thanhtoan->payment_status; ?>">


    <label for="payment_status">Trạng thái đơn hàng:</label>
    <input type="text"  name=trangthai_don value="<?php echo $sua->status; ?>">

    <input type="submit" name="capnhat" value="Cập nhật">
</form>


