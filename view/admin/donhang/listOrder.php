<div class="main-content">
    <div class="welcome_admin">Danh Sách Đơn Hàng</div>
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
                <td><?php echo $order->status ?></td>
                <td><?php echo $order->payment_method ?></td>
                <td><?php echo $order->payment_status ?></td>
                <td><?php echo $order->created_at ?></td>
                <td>
                    <a href="">
                        <button>Xem chi tiết</button>
                    </a>
                    <a href="">
                        <button>Cập nhật</button>
                    </a>
                </td>
            </tr>
        <?php } ?>
    </table>

</div>