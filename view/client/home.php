<div class="banner">
    <img src="" id="banner" alt="">
    <script>
        var arrIMG = <?php echo $banner ?>;
        document.getElementById('banner').src = 'duan01/'+arrIMG[0].image; //cho ảnh đầu lên banner
        var index = 0;
        function next() {
            index++;
            if (index >= arrIMG.length) {
                index = 0; // Quay lại ảnh đầu tiên nếu vượt quá số ảnh trong mảng
            }
            document.getElementById('banner').src = 'duan01/'+arrIMG[index].image;
        }
        setInterval(next, 2000);
    </script>
</div>
<main>
    <h2>SẢN PHẨM MỚI</h2>
    <div class="products">
        <?php foreach ($listProductNew as $productNew) {
            $linkPro = "index.php?act=sanphamchitiet&idPro=$productNew->id";
            ?>

            <a href=" <?php echo $linkPro ?>">
                <div class="product">
                    <img src="<?php echo 'duann01/' . $productNew->main_image ?>" alt="">
                    <h3><?php echo $productNew->name ?></h3>
                    <p>
                        <?php echo number_format($productNew->base_price, 0, ',', '.') ?> VND
                    </p>
                    <div class="button-buynow">


                        <a href="">Xem chi tiết</a>

                    </div>
                </div>
            </a>
        <?php } ?>
    </div>

    <h2>HOA SINH NHẬT</h2>
    <div class="products">
        <?php foreach ($listProducBirth as $productBirth) { ?>
            <a href="index.php?act=sanphamchitiet&idPro=<?php echo $productBirth->id ?>">
                <div class="product">
                    <img src="<?php echo 'duan01/' . $productBirth->main_image ?>" alt="">
                    <h3><?php echo $productBirth->name ?></h3>
                    <p>
                        <?php echo number_format($productBirth->base_price, 0, ',', '.') ?> VND
                    </p>
                    <div class="button-buynow">
                        <a href="">Xem chi tiết</a>
                    </div>
                </div>
            </a>
        <?php } ?>
    </div>

</main>
