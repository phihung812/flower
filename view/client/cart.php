<main>
    <?php if(isset($cartItem)&&!empty($cartItem)){ ?>
    <table class="table-cart" border="1">
        <tr style="height: 40px;">
            <td style="text-align: center;">Hình ảnh</td>
            <td>Tên sản phẩm</td>
            <td>Mã sản phẩm</td>
            <td>Kích cỡ</td>
            <td>Số lượng</td>
            <td>Đơn giá</td>
            <td style="text-align: right; padding-right: 10px;">Tổng cộng</td>
        </tr>
        <?php  foreach ($cartItem as $cart) { ?>
            <tr>
                <td style="text-align: center;">
                    <div class="img-cart">
                        <img src="<?php echo 'duan01/'.$cart->main_image ?>" alt="">
                    </div>
                </td>
                <td><?php echo $cart->name ?></td>
                <td><?php echo $cart->sku ?></td>
                <td><?php echo $cart->size ?></td>
                <td><?php echo $cart->quantity ?></td>
                <td><?php echo $cart->price ?></td>
                <td style="text-align: right; padding-right: 10px;"><?php echo $cart->total_price ?></td>
                
            </tr>
        <?php } ?>
        <tr style="height: 40px;">

            <th style="text-align: right; padding-right: 10px;color: black;" colspan="6">Tổng phụ</th>
            <td style="text-align: right; padding-right: 10px;">20000000</td>
        </tr>
        <tr style="height: 40px;">
            <th style="text-align: right;padding-right: 10px;color: black;" colspan="6">Tổng cộng</th>
            <td style="text-align: right; padding-right: 10px;">2000000</td>
        </tr>
    </table>
    <a href="">
        <button class="submit-cart">Thanh toán</button>
    </a>
    <?php }else{ ?>
        <h2>Bạn chưa thêm sản phẩm nào vào giỏ hàng</h2>
        <?php } ?>
</main>