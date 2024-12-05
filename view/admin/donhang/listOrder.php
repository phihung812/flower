<div class="main-content">
    <div class="welcome_admin">Danh Sách Đơn Hàng</div>
    <?php if ($listOrder) { ?>
        <table border="1" class="table_danhmuc">
            <tr class="thead">
                <th>ID</th>
                <th>Khách hàng</th>
                <th>Số lượng</th>
                <th>Tổng cộng</th>
                <th>Giao hàng</th>
                <th>Phương thức thanh toán</th>
                <th>Trạng thái thanh toán</th>
                <th>Thời gian mua</th>
                <th>Thao tác</th>
            </tr>
            <?php foreach ($listOrder as $order) { ?>
                <tr>
                    <td><?php echo $order->id ?></td>
                    <td><?php echo $order->name ?></td>
                    <td><?php echo $order->total_items ?></td>
                    <td><?php echo $order->total_price ?></td>

                    <?php if ($order->status == 'pending') { ?>
                        <td style="color: rgb(173, 173, 132);">Đang chờ giao</td>
                    <?php } elseif ($order->status == 'shipped') { ?>
                        <td style="color: blue">Đang giao</td>
                    <?php } elseif ($order->status == 'delivered') { ?>
                        <td style="color: green">Đã giao</td>
                    <?php } elseif ($order->status == 'canceled') { ?>
                        <td style="color: red">Đã hủy</td>
                    <?php } ?>

                    <td><?php echo $order->payment_method ?></td>

                    <?php if ($order->payment_status == 'pending') { ?>
                        <td style="color: rgb(173, 173, 132);">Chưa thanh toán</td>
                    <?php } elseif ($order->payment_status == 'completed') { ?>
                        <td style="color: green">Đã thanh toán</td>
                    <?php } elseif ($order->payment_status == 'failed') { ?>
                        <td style="color: red">Đã hủy</td>
                    <?php } ?>

                    <td><?php echo $order->created_at ?></td>
                    <td>
                        <a href="index.php?act=chitiet&id=<?php echo $order->id ?>">
                            <button>Xem chi tiết</button>
                        </a>
                        <a href="index.php?act=editOrder&order_id=<?php echo $order->id ?>">
                            <button>Cập nhật</button>
                        </a>
                    </td>
                </tr>
            <?php } ?>
        </table>
    <?php } else { ?>
        <p style="font-size:30px;">Chưa có đơn hàng nào</p>
    <?php } ?>

</div>