<div class="main-content">
    <div class="welcome_admin">Thêm Sản Phẩm</div>
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
                    <label>Tên sản phẩm</label>
                    <div class="form__input">
                        <input type="text" name="productName">
                    </div>
                </div>
            </div>

            <div class="form__group">
                <div class="form__label">
                    <label>Mô tả</label>
                    <div class="form__input">
                        <input type="text" name="description">
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
                        <input type="number" name="price">
                    </div>
                </div>
            </div>

            <div class="form__group">
                <div class="form__label">
                    <label>Số lượng</label>
                    <div class="form__input">
                        <input type="number" name="available_stock">
                    </div>
                </div>
            </div>

            <div class="form__group">
                <div class="form__label">
                    <label>Mã số</label>
                    <div class="form__input">
                        <input style="text-transform: uppercase;" oninput="this.value = this.value.toUpperCase();" type="text" name="sku">
                    </div>
                </div>
            </div>

            <div class="form__group">
                <div class="form__label">
                    <label>Trạng thái</label>
                    <div class="form__input">
                        <select name="status">
                            <option value="available">Còn hàng</option>
                            <option value="unavailable">Hết hàng</option>
                        </select>
                    </div>
                </div>
            </div>



            <div class="form__group">
                <div class="form__label">
                    <label>Ảnh</label>
                    <div class="form__input">
                        <input type="file" name="image">
                    </div>
                </div>
            </div>


            <input class="form__submit" type="submit" value="Thêm" name="submit-addProduct">

            <a class="href-listPro" href="index.php?act=listProduct">
                <div class="btn-listPro">Danh sách</div>
            </a>

        </form>
    </div>
</div>