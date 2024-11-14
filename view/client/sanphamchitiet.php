<main>
    <div class="cart">
        <div class="product-infor-cart">
            <div class="image-product-cart">
                <img src="<?php echo 'duan01/' . $sanphamchitiet->main_image ?>" alt="">
            </div>
            <div class="cart-right">
                <div class="name-product-cart">
                    <h2><?php echo $sanphamchitiet->name ?></h2>
                </div>
                <div class="price-product-cart">
                    <h2><?php echo number_format($sanphamchitiet->base_price, 0, ',', '.') ?> VND</h2>
                </div>
                <div class="phone-cart">
                    <h3>Gọi ngay: </h3>
                    <div class="box-phone">
                        <h2>0359 058 116</h2>
                    </div>
                </div>
                <div class="chat-cart">
                    <h3 style="display: inline;">Chat ngay: </h3>
                    <div class="chat">
                        <a href=""><img src="https://www.flowercorner.vn/image/icon/ms.png" alt=""></a>
                        <a href=""><img src="https://www.flowercorner.vn/image/icon/zalo.png" alt=""></a>
                    </div>
                </div>
                <div class="ship-cart">
                    <h3>Vận chuyển:</h3>
                    <p>Miễn phí giao hoa khu vực nội thành TP.HCM & Hà Nội</p>
                </div>
                <form action="" method="POST" class="qti-variant">
                    <div class="quantyti">
                        <h3>SỐ LƯỢNG:</h3>
                        <input type="number" name="quantity" id="" value="1">
                    </div>

                    <div class="variant">
                        <h3>SIZE:</h3>
                        <select name="variant">
                            <?php foreach ($sizePro as $size) { ?>
                                <option value="<?php echo $size->size; ?>"><?php echo $size->size; ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="btn-cart">
                        <button name="submit-addCart">Thêm vào giỏ hàng</button>
                        <button>Đặt hàng</button>
                    </div>
                </form>

            </div>
        </div>
        <div class="description">
            <h2>Mô tả sản phẩm</h2>
            <p>
                <?php echo $sanphamchitiet->description ?>
            </p>
            <p>*Sản phẩm cần đặt trước, sản phẩm chỉ có tại HCM.</p>
            <h3>Lưu ý:</h3>
            <em>**Do được làm thủ công, nên sản phẩm ngoài thực tế sẽ có đôi chút khác biệt so với hình ảnh trên
                website. Tuy nhiên, Flowercorner cam kết hoa sẽ giống khoảng 80% so với hình ảnh.</em><br><br>
            <em>** Vì các loại hoa lá phụ sẽ có tùy vào thời điểm trong năm, Flowercorner đảm bảo các loại hoa
                chính, các loại hoa lá phụ sẽ thay đổi phù hợp giá cả và thiết kế sản phẩm.</em>
        </div>
        <h2>SẢN PHẨM LIÊN QUAN</h2>
        <div class="products-relate">
            <?php foreach ($productRelate as $product) { ?>
                <a href="index.php?act=sanphamchitiet&idPro=<?php echo $product->id ?>">
                    <div class="relate">
                        <img src="<?php echo 'duann01/' . $product->main_image ?>" alt="">
                        <h3><?php echo $product->name ?></h3>
                        <p><?php echo number_format($product->base_price, 0, ',', '.') ?> VND</p>
                    </div>
                </a>
            <?php } ?>

        </div>
        
    </div>
</main>