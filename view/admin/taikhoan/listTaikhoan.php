<div class="main-content">
    <div class="welcome_admin">Danh Sách Người Dùng</div>
    <?php if ($listTaikhoan) { ?>
        <table border="1" class="table_danhmuc">

            <tr class="thead">
                <th>ID</th>
                <th>Họ và tên</th>
                <th>Email</th>
                <th>Mật khẩu</th>
                <th>Số điện thoại</th>
                <th>Địa chỉ</th>
                <th>Thành phố</th>
                <th>Vai trò</th>
                <th>Thời gian tạo</th>
                <th>Thời gian update</th>
                <th>Thao tác</th>
            </tr>
            <?php foreach ($listTaikhoan as $taikhoan) { ?>
                <tr>
                    <td><?php echo $taikhoan->id ?></td>
                    <td><?php echo $taikhoan->first_name . " " . $taikhoan->last_name ?></td>
                    <td><?php echo $taikhoan->email ?></td>
                    <td><?php echo $taikhoan->password ?></td>
                    <td><?php echo $taikhoan->phone ?></td>
                    <td><?php echo $taikhoan->address ?></td>
                    <td><?php echo $taikhoan->city ?></td>
                    <td><?php echo $taikhoan->role ?></td>
                    <td><?php echo $taikhoan->created_at ?></td>
                    <td><?php echo $taikhoan->updated_at ?></td>
                    <td>
                        
                        <a href="index.php?act=edit_taikhoan&idTaikhoan=<?php echo $taikhoan->id ?>">
                            <button>Sửa</button>
                        </a>
                    </td>
                </tr>
            <?php } ?>
        </table>
    <?php } else { ?>
        <p style="font-size:30px;">Chưa có tài khoản nào nào</p>
    <?php } ?>

</div>