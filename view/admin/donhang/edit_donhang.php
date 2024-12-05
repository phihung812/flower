<form class="frm-order" action="" method="POST">
    <h1>Cập nhật đơn hàng</h1><br><br>
    <?php
    if (isset($thongbao) && ($thongbao != "")) {
        echo "<h3 style='color:red;text-align:center;'>$thongbao</h3>";
    }

    ?>

    <label for="customer">Khách hàng:</label>
    <span class="info-text"><?php echo $order->name; ?></span>

    <label for="quantity">Số lượng:</label>
    <span class="info-text"><?php echo $order->total_items; ?></span>

    <label for="total_price">Tổng cộng:</label>
    <span class="info-text"><?php echo $order->total_price; ?></span>

    <label for="shipping_address">số điện thoại:</label>
    <span class="info-text">0<?php echo $order->phone; ?></span>


    <label for="payment_status">Trạng thái thanh toán:</label>
    <select name="payment_status" id="payment_status" style="width: 100%;height: 30px;">
        <option value="pending" <?php echo $payment->payment_status == 'pending' ? 'selected' : ''; ?>>Chưa thanh toán
        </option>
        <option value="completed" <?php echo $payment->payment_status == 'completed' ? 'selected' : ''; ?>>Đã thanh toán
        </option>
        <option value="failed" <?php echo $payment->payment_status == 'failed' ? 'selected' : ''; ?>>Đã hủy</option>
    </select>

    <label for="status">Trạng thái đơn hàng:</label>
    <select name="order_status" id="order_status" style="width: 100%;height: 30px;">
        <option value="pending" <?php echo $order->status == 'pending' ? 'selected' : ''; ?>>Đang chờ giao</option>
        <option value="shipped" <?php echo $order->status == 'shipped' ? 'selected' : ''; ?>>Đang giao</option>
        <option value="delivered" <?php echo $order->status == 'delivered' ? 'selected' : ''; ?>>Đã giao</option>
        <option value="canceled" <?php echo $order->status == 'canceled' ? 'selected' : ''; ?>>Đã hủy</option>
    </select>


    <input style="margin-top:15px;" type="submit" name="submit-order" value="Cập nhật">
</form>