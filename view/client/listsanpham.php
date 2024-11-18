<main>

    <h2>
        <?php
        if ($category != "") {
            echo $category->name;
        } else {
            echo "Các Sản Phẩm Tìm Kiếm ";
        }
        ?>
    </h2>
    <form action="" method="GET" class="select">
        <input type="hidden" name="act" value="search-pro"> <!-- Giữ giá trị act -->
        <input type="hidden" name="iddm" value="<?php echo isset($_GET['iddm']) ? $_GET['iddm'] : ''; ?>"><!-- Giữ giá trị iddm từ URL -->
        <div class="label-select">
            <label for="">Sắp xếp</label>
        </div>
        <select  name="sort" onchange="this.form.submit()">
            <option selected>Mặc định</option>
            <option value="name_asc">Tên (A-Z)</option>
            <option value="name_desc">Tên (Z-A)</option>
            <option value="price_asc">Giá (Thấp-Cao)</option>
            <option value="price_desc">Giá (Cao-Thấp)</option>
        </select>
    </form>
    <div class="products">
        <?php foreach ($listProduct as $product) { ?>
            <a href="index.php?act=sanphamchitiet&idPro=<?php echo $product->id ?>">
                <div class="product">
                    <img src="<?php echo 'duan01/' . $product->main_image ?>" alt="">
                    <h3><?php echo $product->name ?></h3>
                    <p><?php echo number_format($product->base_price, 0, ',', '.') ?> VND</p>
                    <div class="button-buynow">
                        <a href="">Xem chi tiết</a>
                    </div>
                </div>
            </a>
        <?php } ?>
    </div>



</main>