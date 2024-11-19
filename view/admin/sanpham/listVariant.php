<div class="main-content">
    <div class="welcome_admin">Danh Sách Biến Thể</div>

        <table class="listPro">
            <tr class="thead">
                <th>Mã biến thể</th>
                <th>ID sản phẩm</th>
                <th>Kích cỡ</th>
                <th>Giá tiền</th>
                <th>Số lượng</th>
                <th>Thao tác</th>
            </tr>
            <?php foreach ($listVariant as $variant) { ?>
                <tr>
                    <td><?php echo $variant->id ?></td>
                    <td><?php echo $variant->product_id ?></td>
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
        <a class="href-add_danhmuc" href="index.php?act=addVariant">
            <button class="btn-table_danhmuc">Thêm biến thể</button>
        </a>
    </div>