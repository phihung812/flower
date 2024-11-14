<div class="banner">
    <img src="https://in.flowercorner.vn/uploads/P657fd247737038.75342862.webp" alt="">
</div>
<main>
    <h2>SẢN PHẨM MỚI</h2>
    <div class="products">
        <?php foreach ($listProductNew as $productNew) {
            $linkPro = "index.php?act=sanphamchitiet&idPro=$productNew->id";
            ?>

            <a href=" <?php echo $linkPro ?>">
                <div class="product">
                    <img src="<?php echo '/duan01' . $productNew->main_image ?>" alt="">
                    <h3><?php echo $productNew->name ?></h3>
                    <p>
                        <?php echo number_format($productNew->base_price, 0, ',', '.') ?> VND
                    </p>
                    <div class="button-buynow">
                        <a href="">ĐẶT HÀNG</a>
                    </div>
                </div>
            </a>
        <?php } ?>
    </div>

    <h2>HOA SINH NHẬT</h2>
    <div class="products">
        <?php foreach ($listProducBirth as $productBirth) { ?>
            <a href="">
                <div class="product">
                    <img src="<?php echo '/duan01' . $productBirth->main_image ?>" alt="">
                    <h3><?php echo $productBirth->name ?></h3>
                    <p>
                        <?php echo number_format($productBirth->base_price, 0, ',', '.') ?> VND
                    </p>
                    <div class="button-buynow">
                        <a href="">ĐẶT HÀNG</a>
                    </div>
                </div>
            </a>
        <?php } ?>
    </div>

</main>
