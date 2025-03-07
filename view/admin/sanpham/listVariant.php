<div class="main-content">
    <div class="welcome_admin">Danh Sách Biến Thể</div>
    <?php
    if (isset($thongbao) && ($thongbao != "")) {
        echo "<h3 style='color:red;'>$thongbao</h3>";
    }

    ?>
    <a class="href-add_danhmuc" href="index.php?act=addVariant">
        <button class="btn-table_danhmuc">Thêm biến thể</button>
    </a>
    <?php if ($listVariant) { ?>
        <form class="frm-searchProductAdm" action="" method="post">
            <input type="text" name="kyw" placeholder="Nhập tên sản phẩm">

            <button type="submit" name="submit-search"><i class="fa-solid fa-magnifying-glass"></i></button>
        </form>
        <table border="1" class="listPro">
            <tr class="thead">
                <th>Mã biến thể</th>
                <th>ID sản phẩm</th>
                <th>Ảnh</th>
                <th>Tên sản phẩm</th>
                <th>Kích cỡ</th>
                <th>Giá tiền</th>
                <th>Số lượng</th>
                <th>Thao tác</th>
            </tr>
            <?php foreach ($listVariant as $variant) { ?>
                <tr>
                    <td><?php echo $variant->id ?></td>
                    <td><?php echo $variant->product_id ?></td>
                    <td>
                        <img style="width:70px;height:70px;" src="<?php echo $variant->image_product ?>" alt="">
                    </td>
                    <td><?php echo $variant->name_product ?></td>
                    <td><?php echo $variant->size ?></td>
                    <td><?php echo $variant->price ?></td>
                    <td><?php echo $variant->stock_quantity ?></td>
                    <td style="width:110px;">
                        <a href="index.php?act=updateVariant&idVariant=<?php echo $variant->id ?>">
                            <button>Sửa</button>
                        </a>
                        <a href="index.php?act=deleteVariant&idVariant=<?php echo $variant->id ?>">
                            <button>Xóa</button>
                        </a>
                    </td>
                </tr>
            <?php } ?>
        </table>
    <?php } else { ?>
        <p style="font-size:30px;">Chưa có biến thể nào</p>
    <?php } ?>
    
</div>