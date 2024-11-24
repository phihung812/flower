<div class="history-order">
    <div class="title-history-order">
        <p>Chi tiết đơn hàng</p>
    </div>
    <table class="table-detail-order" border="1">
        <tr>
            <td style="width: 50%;height: 50px;">
                <span>ID đơn hàng: </span>
                <?php if (!empty($detailOrder)) { ?>
                    <label>#<?php echo $detailOrder[0]->order_id; ?></label>
                <?php } ?><br>

                <span>Ngày thêm: </span>
                <?php if (!empty($detailOrder)) { ?>
                    <label><?php echo $detailOrder[0]->order_created_at; ?></label>
                <?php } ?><br>
            </td>
            <td>
                <span>Phương thức thanh toán: </span>
                <?php if (!empty($detailOrder)) {
                    if ($detailOrder[0]->payment_method == 'online') { ?>
                        <label>Thanh toán momo</label>
                    <?php } else { ?>
                        <label>Thanh toán khi nhận hàng</label>
                    <?php } ?><br>
                <?php } ?>

                <span>Trạng thái thanh toán: </span>
                <?php if (!empty($detailOrder)) { ?>
                    <?php if ($detailOrder[0]->payment_status == 'pending') { ?>
                        <label style="color:blue;">Chờ thanh toán...</label>
                    <?php } elseif ($detailOrder[0]->payment_status == 'completed') { ?>
                        <label style="color:green;">Đã thanh toán</label>
                    <?php } else { ?>
                        <label style="color:red;">Đã hủy</label>
                    <?php } ?>
                <?php } ?>
            </td>
        </tr>
    </table>

    <table border="1" style="margin-top:20px;">
        <tr>
            <td style="width: 50%; height: 30px;">Địa chỉ giao hàng</td>
            <td>Trạng thái đơn hàng</td>
        </tr>
        <tr>
            <td style="height: 60px;">
                <?php if (!empty($detailOrder)) { ?>
                    <p><?php echo $detailOrder[0]->order_shipping_address . ' ' . $detailOrder[0]->order_shipping_city; ?>
                    </p>
                <?php } ?>
            </td>
            <td style="height: 60px;">
                <?php if (!empty($detailOrder)) { ?>
                    <?php if ($detailOrder[0]->order_status == 'pending') { ?>
                        <p style="color:blue">Chờ giao hàng</p>
                    <?php } elseif ($detailOrder[0]->order_status == 'shipped') { ?>
                        <p style="color:#ed05f0">Đang giao hàng</p>
                    <?php } elseif ($detailOrder[0]->order_status == 'delivered') { ?>
                        <p style="color:green">Đã giao</p>
                    <?php } else { ?>
                        <p style="color:red">Đã hủy</p>
                    <?php } ?>
                <?php } ?>
            </td>
        </tr>
    </table>

    <table border="1">
        <tr style="height: 40px;">
            <td>Hình ảnh</td>
            <td>Tên sản phẩm</td>
            <td>Kích cỡ</td>
            <td>Số lượng</td>
            <td>Giá bán</td>
            <td>Tổng cộng</td>
        </tr>
        <?php foreach ($detailOrder as $order) { ?>
            <tr style="height: 60px;">
                <td>
                    <a href="index.php?act=sanphamchitiet&idPro=<?php echo $order->product_id ?>" class="khunganh">
                        <img src="<?php echo 'duan01/' . $order->product_main_image ?>" style="width: 50px;height: 50px;"
                            alt="">
                    </a>
                </td>
                <td><?php echo $order->product_name ?></td>
                <td><?php echo $order->product_variant_size ?></td>
                <td><?php echo $order->order_item_quantity ?></td>
                <td><?php echo $order->order_item_price ?></td>
                <td><?php echo $order->order_item_total_price ?></td>
            </tr>
        <?php } ?>
        <tr style="height: 40px;">
            <td colspan="5" style="text-align: right; padding-right: 20px; font-weight: 600;">Số lượng</td>
            <?php if (!empty($detailOrder)) { ?>
                <td><?php echo $detailOrder[0]->order_total_items; ?></td>
            <?php } ?>

        </tr>
        <tr style="height: 40px;">
            <td colspan="5" style="text-align: right; padding-right: 20px; font-weight: 600;">Tổng cộng</td>
            <?php if (!empty($detailOrder)) { ?>
                <td>
                    <h3 style="color:red;"><?php echo number_format($detailOrder[0]->order_total_price, 0, ',', '.') ?> VND
                    </h3>
                </td>

            <?php } ?>
        </tr>
    </table>
    <a class="btn-cart" href="index.php?act=myAccount&check=historyOrder">
        <button style="margin-left: 810px; margin-right: 0;">Lịch sử đặt hàng</button>
    </a>

</div>