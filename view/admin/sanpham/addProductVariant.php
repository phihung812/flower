<div class="main-content">
    <div class="welcome_admin">Thêm Biến Thể</div>
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
                        <input type="number" required name="product_id">
                    </div>
                </div>
            </div>

            <div class="form__group">
                <div class="form__label">
                    <label>Kích cỡ</label>
                    <div class="form__input">
                        <select name="size" id="">
                            <option value="small">Nhỏ</option>
                            <option value="medium">Vừa</option>
                            <option value="large">Lớn</option>
                        </select>
                    </div>
                </div>
            </div>


            <div class="form__group">
                <div class="form__label">
                    <label>Giá tiền</label>
                    <div class="form__input">
                        <input type="number" required name="price">
                    </div>
                </div>
            </div>

            <div class="form__group">
                <div class="form__label">
                    <label>Số lượng</label>
                    <div class="form__input">
                        <input type="number" required name="stock_quantity">
                    </div>
                </div>
            </div>



            <input class="form__submit" type="submit" value="Thêm" name="submit-addVariant">

            <a class="href-listPro" href="index.php?act=listVariant">
                <div class="btn-listPro">Danh sách</div>
            </a>

        </form>
    </div>
</div>