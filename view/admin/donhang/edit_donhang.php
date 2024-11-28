<form class="frm-order" action="" method="post">
    <h1>Cập nhật đơn hàng</h1><br><br>

    <label for="customer">Khách hàng:</label>
    <span class="info-text"><?php echo $sua->name; ?></span>

    <label for="quantity">Số lượng:</label>
    <span class="info-text"><?php echo $sua->total_items; ?></span>

    <label for="total_price">Tổng cộng:</label>
    <span class="info-text"><?php echo $sua->total_price; ?></span>

    <label for="shipping_address">số điện thoại:</label>
    <span class="info-text">0<?php echo $sua->phone; ?></span>


    <label>Trạng thái đơn hàng: </label>
    <div class="form__input">
        <select name="status" value="<?php echo $sua->status ?>">
            <option value="available" <?php echo ($sua->status === 'pending') ? 'selected' : ''; ?>>Đang chờ giao
            </option>
            <option value="unavailable" <?php echo ($sua->status === 'shipped') ? 'selected' : ''; ?>>Đang giao
            </option>
            <option value="unavailable" <?php echo ($sua->status === 'delivered') ? 'selected' : ''; ?>>Đã giao
            </option>
            <option value="unavailable" <?php echo ($sua->status === 'canceled') ? 'selected' : ''; ?>>Đã hủy
            </option>
        </select>
    </div>


    <label>Trạng thái thanh toán: </label>
    <div class="form__input">
        <select name="status" value="<?php echo $thanhtoan->payment_status ?>">
            <option value="available" <?php echo ($thanhtoan->payment_status === 'pending') ? 'selected' : ''; ?>>Chưa thanh toán
            </option>
            <option value="unavailable" <?php echo ($thanhtoan->payment_status === 'completed') ? 'selected' : ''; ?>>Đã thanh toán
            </option>
            <option value="unavailable" <?php echo ($thanhtoan->payment_status === 'failed') ? 'selected' : ''; ?>>Đã hủy
            </option>
        </select>
    </div>


    <input style="margin-top:15px;" type="submit" name="capnhat" value="Cập nhật">
</form>