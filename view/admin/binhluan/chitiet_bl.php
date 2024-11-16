<style>
    .table_bl{
    margin-left:20%;
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
    <h2 style=" margin-left:55%;">CHI TIẾT BÌNH LUẬN</h2>
    <table class="table_bl">
        <tr>
            
            <th>Mã bình luận </th>
            <th>mã sản phẩm</th>
            <th>mã khách hàng</th>
            <th>Mã sản phẩm bình luận</th>
            <th>Nội dung</th>
            <th>thời gian tạo </th>
            <th>thời gian cập nhật</th>
            
        </tr>
        
            <tr>
     
                <td><?php echo $chitiet_binhluan->id ?></td>
                <td><?php echo $chitiet_binhluan->product_id ?></td>
                <td><?php echo $chitiet_binhluan->user_id ?></td>
                <td><?php echo $chitiet_binhluan->rating ?></td>
                <td><?php echo $chitiet_binhluan->comment?></td>
                <td><?php echo $chitiet_binhluan->created_at ?></td>
                <td><?php echo $chitiet_binhluan->updated_at ?></td>

            </tr>
          
    </table>
    <br>
<a href="index.php?act=list_bl" style=" margin-left:20%;"><button>Danh sách bình luận</button></a>


</div>