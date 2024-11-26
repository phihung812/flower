
<div class="invoice-container">
    <!-- Invoice Header -->
    <div class="invoice-header">
        <h1>chi tiết đơn hàng</h1>
        <div class="date">Ngày: <?php echo date('d-m-Y'); ?></div>
    </div>

    <!-- Invoice Information -->
    <div class="invoice-info">
        <div>
            <h3>Thông tin khách hàng:</h3>
            <p>Tên khách hàng: <?php echo $chitiet->name ?></p>
            <p>Email: <?php echo $chitiet->email ?></p>
            <p>Số điện thoại: <?php echo $chitiet->phone ?></p>
            <p>biên lai: <?php echo $chitiet->session_token  ?></p>
        </div>
        <div>
            <h3>Thông tin đơn hàng:</h3>
            <p>Mã đơn hàng: <?php echo $chitiet->id ?></p>
            <p>ID giỏ hàng: <?php echo $chitiet->cart_id ?></p>
            <p>số lượng: <?php echo $chitiet->total_items ?></p>
            <p>thành phố : <?php echo $chitiet->shipping_city ?></p>
            <p>Địa chỉ giao hàng: <?php echo $chitiet->shipping_address ?></p>
            <p>tình trạng đơn hàng: <?php echo $chitiet->status ?></p>

        </div>
    </div>

    <!-- Product Table -->
    <table class="invoice-table">
        <tr>
            <th>Ảnh</th>
            <th>tên sản phẩm</th>
            <th>Mã sản phẩm</th>
            <th>Biến thể (Size)</th>
            <th>Số lượng</th>
            <th>Đơn giá</th>
            <th>Tổng giá</th>
        </tr>

        <?php foreach ($payment as $payments) { ?>
            <?php if ($chitiet->id == $payments->order_id) { ?>
                <?php 
                    $img = null;
                    $bienthe = null;
                    foreach ($anh as $image) {
                        if ($payments->product_id == $image->id) {
                            $img = $image;
                            break;
                        }
                    }
                    foreach ($bienthem as $variant) {
                        if ($payments->variant_id == $variant->id) {
                            $bienthe = $variant;
                            break;
                        }
                    }
                ?>
                <tr>
                    <td>
                        <?php if ($img) { ?>
                            <img src="<?php echo $img->main_image ?>" width="50px">
                        <?php } else { ?>
                            Không có ảnh
                        <?php } ?>
                    </td>
                    
                    <td><?php echo $image->name; ?></td>
                    <td><?php echo $payments->product_id; ?></td>
                    <td><?php echo $bienthe ? $bienthe->size : 'Không có biến thể'; ?></td>
                    <td><?php echo $payments->quantity; ?></td>
                    <td><?php echo number_format($payments->price, 0, ',', '.') . ' VNĐ'; ?></td>
                    <td><?php echo number_format($payments->total_price, 0, ',', '.') . ' VNĐ'; ?></td>
                </tr>
            <?php } ?>
        <?php } ?>
    </table>

    <!-- Invoice Footer -->
    <div class="invoice-footer">
        <div class="terms">* Chính sách hoàn trả và bảo hành có thể thay đổi theo điều kiện.</div>
        <div class="total-amount">Tổng cộng: <?php echo number_format($chitiet->total_price, 0, ',', '.') . ' VNĐ'; ?></div>
    </div>
</div>


