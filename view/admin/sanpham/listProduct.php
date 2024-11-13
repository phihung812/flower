<div class="main-content">
    <div class="welcome_admin">Danh Sách Sản Phẩm</div>

    <table class="listPro">
        <tr class="thead">
            <th>Mã sản phẩm</th>
            <th>Tên sản phẩm</th>
            <th>Mô tả</th>
            <th>Danh mục</th>
            <th>Giá tiền</th>
            <th>Số lượng</th>
            <th>Mã SKU</th>
            <th>Trạng thái</th>
            <th>Hình ảnh</th>
            <th>Thời gian tạo</th>
            <th>Thời gian cập nhật</th>
            <th>Thao tác</th>
        </tr>
        <?php foreach ($listProduct as $product) { ?>
            <tr>
                <td><?php echo $product->id ?></td>
                <td><?php echo $product->name ?></td>
                <td><?php echo $product->description ?></td>
                <td>
                    <?php
                    foreach ($listCategory as $category) {
                        if ($category->id == $product->category_id) {
                            echo $category->name;
                            break; 
                        }
                    }
                    ?>

                </td>
                <td><?php echo $product->base_price ?></td>
                <td><?php echo $product->available_stock ?></td>
                <td><?php echo $product->sku ?></td>
                <td>
                    <?php
                    if ($product->status == 'unavailable') {
                        echo "Hết hàng";
                    } else {
                        echo "Còn hàng";
                    }
                    ?>
                </td>
                <td>
                    <img style="width:100px;height:100px;" src="<?php echo $product->main_image ?>" alt="">
                </td>
                <td><?php echo $product->created_at ?></td>
                <td><?php echo $product->updated_at ?></td>
                <td style="width:110px;">
                    <a href="index.php?act=editProduct&idProduct=<?php echo $product->id ?>">
                        <button>Sửa</button>
                    </a>
                    <a href="index.php?act=deleteProduct&idProduct=<?php echo $product->id ?>">
                        <button>Xóa</button>
                    </a>
                </td>
            </tr>
        <?php } ?>
    </table>
    <a class="href-add_danhmuc" href="index.php?act=addProduct">
        <button class="btn-table_danhmuc">Thêm sản phẩm</button>
    </a>
</div>