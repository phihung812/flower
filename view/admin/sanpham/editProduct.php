<div class="main-content">
    <div class="welcome_admin">Cập Nhật Sản Phẩm</div>

    <div class="add">
        <form class="wrapper__form" action="" method="POST" enctype="multipart/form-data">
            <div class="form__group">
                <div class="form__label">
                    <label>Tên sản phẩm</label>
                    <div class="form__input">
                        <input type="text" name="productName" value="<?php echo $productById->name ?>">
                    </div>
                </div>
            </div>

            <div class="form__group">
                <div class="form__label">
                    <label>Mô tả</label>
                    <div class="form__input">
                        <input type="text" name="description" value="<?php echo $productById->description ?>">
                    </div>
                </div>
            </div>

            <div class="form__group">
                <div class="form__label">
                    <label>Danh mục</label>
                    <div class="form__input">
                        <select name="category">
                            <?php foreach ($listCategory as $category) { ?>
                                <option value="<?php echo $category->id ?>"> <?php echo $category->name ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="form__group">
                <div class="form__label">
                    <label>Giá</label>
                    <div class="form__input">
                        <input type="number" name="price" value="<?php echo $productById->base_price ?>">
                    </div>
                </div>
            </div>

            <div class="form__group">
                <div class="form__label">
                    <label>Số lượng</label>
                    <div class="form__input">
                        <input type="number" name="available_stock" value="<?php echo $productById->available_stock ?>">
                    </div>
                </div>
            </div>

            <div class="form__group">
                <div class="form__label">
                    <label>Mã số</label>
                    <div class="form__input">
                        <input type="text" name="sku" value="<?php echo $productById->sku ?>">
                    </div>
                </div>
            </div>

            <div class="form__group">
                <div class="form__label">
                    <label>Trạng thái</label>
                    <div class="form__input">
                        <select name="status" value="<?php echo $productById->status ?>">
                            <option value="available">Còn hàng</option>
                            <option value="unavailable">Hết hàng</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="form__label">
                <label>Ảnh</label>
                <div class="form__input">
                    <?php if (!empty($productById->main_image)): ?>
                        <img src="<?php echo $productById->main_image ?>" style="width:200px; height: 100px;" alt="">
                    <?php else: ?>
                        <input type="text" value="Chưa có ảnh" readonly>
                    <?php endif; ?>
                    <input type="file" name="image">
                </div>
            </div>


            <input class="form__submit" type="submit" value="Cập nhật" name="submit-updateProduct">
        </form>
    </div>
</div>