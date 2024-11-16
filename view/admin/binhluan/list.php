<style>
    .table_bl{
    margin-left:45%;
    width: 100%;
border-collapse: collapse;
border: 0.5px solid #888;
}
.table_bl tr th{
    padding: 20px;
    background-color: #a3caf3;
}
.table_bl tr td{
  padding: 20px;

}

</style>
<div>
    <h2 style="  margin-left:55%;">DANH SÁCH BÌNH LUẬN</h2>
    <table class="table_bl">
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
                <td>
                <a href="index.php?act=chitiet_bl&id=<?php echo $binhluan->id ?>"><button>xem chi tiết</button></a>
                <a href="index.php?act=delete_bl&id=<?php echo $binhluan->id ?>"><button>xoá</button></a>
                </td>
                

            </tr>
        <?php }?>
    </table>
</div>
<div>

</div>
</div>