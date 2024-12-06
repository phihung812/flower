\<div class="main-content">
    <h1>Thống Kê Sản Phẩm</h1>
    <table border="1" class="table_danhmuc" style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr style="background-color: #f4f4f4;">
                <th>Mã sản phẩm</th>
                <th>Tên sản phẩm</th>
                <th>Giá bán</th>
                <th>Số lượng bán ra tháng</th>
                <th>Doanh thu</th>
                <th>Tồn kho hiện tại</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($sanpham as $product): ?>
                <?php

                $total_sold = 0; // Tổng số lượng sản phẩm bán ra
                $revenue = 0;    // Tổng doanh thu
                $processed_orders = []; // Để chặn lặp đơn hàng
            
                // Tính tổng số lượng bán ra từ các chi tiết đơn hàng
                foreach ($chitietdonhang as $chitiet) {
                    if ($chitiet->product_id == $product->id) {
                        foreach ($donhang as $order) {

                            if ($order->id == $chitiet->order_id && $order->status == "delivered" && !in_array($order->id, $processed_orders)) {
                                $total_sold += $chitiet->quantity; // Cộng số lượng bán
                                $processed_orders[] = $order->id;  // Đánh dấu đã xử lý
                                break;
                            }
                        }
                    }
                }

                // Tính doanh thu
                $revenue = $total_sold * $product->base_price;

                // Tính tồn kho hiện tại
                $current_stock = $product->available_stock - $total_sold;

                // Đảm bảo tồn kho không hiển thị giá trị âm
                $current_stock = max(0, $current_stock);
                ?>
                <tr>
                    <td><?php echo $product->id; ?></td>
                    <td><?php echo $product->name; ?></td>
                    <td><?php echo number_format($product->base_price, 0, ',', '.'); ?> VND</td>
                    <td><?php echo $total_sold; ?></td>
                    <td><?php echo number_format($revenue, 0, ',', '.'); ?> VND</td>
                    <td><?php echo $product->available_stock; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>