<main>
    <?php if (isset($cartItem) && !empty($cartItem)) { ?>
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
            <?php foreach ($cartItem as $cart) { ?>
                <tr>
                    <td style="text-align: center;">
                        <a href="index.php?act=sanphamchitiet&idPro=<?php echo $cart->product_id ?>" class="img-cart">
                            <img src="<?php echo 'duan01/' . $cart->main_image ?>" alt="">
                        </a>
                    </td>
                    <td><?php echo $cart->name ?></td>
                    <td><?php echo $cart->sku ?></td>
                    <td><?php echo $cart->size ?></td>
                    <td>
                        <?php
                        // Kiểm tra tồn kho
                        $stock_available = ($cart->stock_quantity > 0) ? $cart->stock_quantity : $cart->available_stock;
                        if ($stock_available > 0) { ?>
                            <form class="frm-qtt" action="index.php?act=updateCartItem" method="POST"
                                style="display: flex; align-items: center; gap: 10px;">
                                
                                <input class="quantity-cartItem" type="number" required min="1" name="quantity"
                                    value="<?php echo $cart->quantity ?>">
                                <input type="hidden" name="cartItemId" value="<?php echo $cart->id ?>">

                                <button class="btn-updateCartItem" type="submit" name="submit-updateCartItemClick">
                                    <i class="fa fa-refresh" aria-hidden="true"></i>
                                </button>

                                <a href="index.php?act=deleteCartItem&cartItemId=<?php echo $cart->id ?>"
                                    class="btn-deleteCartItem">
                                    <i class="fa-solid fa-trash-can"></i>
                                </a>
                            </form>
                        <?php } else { ?>
                            <span style="color: red; font-weight: bold;">Hết hàng</span>
                            <a href="index.php?act=deleteCartItem&cartItemId=<?php echo $cart->id ?>" class="btn-deleteCartItem">
                                <i class="fa-solid fa-trash-can"></i>
                            </a>
                        <?php } ?>
                    </td>
                    <td><?php echo $cart->price ?></td>
                    <td style="text-align: right; padding-right: 10px;"><?php echo $cart->total_price ?></td>

                </tr>
            <?php } ?>

            <tr style="height: 40px;">
                <th style="text-align: right; padding-right: 10px;color: black;" colspan="6">Số lượng</th>
                <td style="text-align: right; padding-right: 10px;"><?php echo $cartAll->total_items ?></td>
            </tr>

            <tr style="height: 40px;">
                <th style="text-align: right;padding-right: 10px;color: black;" colspan="6">Tổng cộng</th>
                <td style="text-align: right; padding-right: 10px; color: red;">
                    <h3><?php echo number_format($cartAll->total_price, 0, ',', '.') ?> VND</h3>
                </td>
            </tr>
        </table>

        <a href="index.php?act=payment">
            <button class="submit-cart">Thanh toán</button>
        </a>
    <?php } else { ?>
        <h2>Bạn chưa thêm sản phẩm nào vào giỏ hàng</h2>
    <?php } ?>
</main>