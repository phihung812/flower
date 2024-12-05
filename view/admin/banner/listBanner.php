<div class="main-content">
    <div class="welcome_admin">Danh Sách Banner</div>

    <?php
    if (isset($thongbao) && ($thongbao != "")) {
        echo "<h3 style='color:red;'>$thongbao</h3>";
    }

    ?>

    <?php if ($listBanner) { ?>
        <table border="1" class="table_danhmuc">

            <tr class="thead">
                <th>ID</th>
                <th>Ảnh</th>
                <th>ngày tạo</th>
                <th>ngày cập nhật</th>
                <th>Thao tác</th>
            </tr>
            <?php foreach ($listBanner as $banner) { ?>
                <tr>
                    <td><?php echo $banner->id ?></td>
                    <td>
                        <img style="width:100px; height:100px;" src="<?php echo $banner->image ?>" alt="">
                    </td>
                    <td><?php echo $banner->created_at ?></td>
                    <td><?php echo $banner->updated_at ?></td>
                    <td>
                        <a href="index.php?act=deleteBanner&idBanner=<?php echo $banner->id ?>">
                            <button>Xóa</button>
                        </a>
                        <a href="index.php?act=editBanner&idBanner=<?php echo $banner->id ?>">
                            <button>Sửa</button>
                        </a>
                    </td>
                </tr>
            <?php } ?>

        </table>
    <?php } else { ?>
        <p style="font-size:30px;">Chưa có banner nào</p>
    <?php } ?>
    <a class="href-add_danhmuc" href="index.php?act=addBanner">
        <button class="btn-table_danhmuc">Thêm mới</button>
    </a>
</div>