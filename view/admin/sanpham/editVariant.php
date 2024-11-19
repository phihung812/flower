<div class="main-content">
    <div class="welcome_admin">Sửa Biến Thể</div>
    <?php
    // Kiểm tra và hiển thị thông báo nếu có
    if (isset($thongbao) && ($thongbao != "")) {
        echo "<h3 style='color:red;'>$thongbao</h3>";
    }
    
    ?>
    <div class="add">
        <form class="wrapper__form" action="" method="POST" enctype="multipart/form-data">
            <div class="form__group">
                <div class="form__label">
                    <label>ID sản phẩm</label>
                    <div class="form__input">
                        <input type="number" name="product_id" value="<?php echo $variant->product_id ?>">
                    </div>
                </div>
            </div>

            <div class="form__group">
                <div class="form__label">
                    <label>Kích cỡ</label>
                    <div class="form__input">
                        <select name="size" id="">
                            <option value="small" <?php echo ($variant->size === 'small') ? 'selected' : ''; ?>>Nhỏ</option>
                            <option value="medium" <?php echo ($variant->size === 'medium') ? 'selected' : ''; ?>>Vừa</option>
                            <option value="large" <?php echo ($variant->size === 'large') ? 'selected' : ''; ?>>Lớn</option>
                        </select>
                    </div>
                </div>
            </div>


            <div class="form__group">
                <div class="form__label">
                    <label>Giá tiền</label>
                    <div class="form__input">
                        <input type="number" name="price" value="<?php echo $variant->price ?>">
                    </div>
                </div>
            </div>

            <div class="form__group">
                <div class="form__label">
                    <label>Số lượng</label>
                    <div class="form__input">
                        <input type="number" name="stock_quantity" value="<?php echo $variant->stock_quantity ?>">
                    </div>
                </div>
            </div>



            <input class="form__submit" type="submit" value="Cập nhật" name="submit-updateVariant">

            <a class="href-listPro" href="index.php?act=listVariant">
                <div class="btn-listPro">Danh sách</div>
            </a>

        </form>
    </div>
</div>