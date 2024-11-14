<style>
    body{
        margin-left:40%;
    }
</style>
<div class="danhsachhh" style="height: auto;">
    <h2 style=" color: #606063; padding-left: 20px;">DANH SÁCH BÌNH LUẬN</h2>
    <table>
        <tr>
            
            <th>Mã bình luận </th>
            <th>mã sản phẩm</th>
            <th>mã người dùng</th>
            <th>mã ngày cập nhật</th>
            <th>thao tác</th>
            
        </tr>
        <?php foreach ($list as $binhluan) {?>
            <tr>
              
                <td><?php echo $binhluan->id ?></td>
                <td><?php echo $binhluan->product_id  ?></td>
                <td><?php echo $binhluan->user_id  ?></td>
                <td><?php echo $binhluan->created_at ?></td>
                <td><a href="index.php?act=delete_bl&id=<?php echo $binhluan->id ?>">xoá</a></td>
                
                <td>
                    <a href="index.php?act=chitiet_bl&id=<?php echo $binhluan->id ?>"><input type="button" value="Xem chi tiết"></a>
                </td>
            </tr>
        <?php }?>
    </table>
</div>
<div>

</div>
</div>