<style>
    body{
        margin-left:30%;
    }
</style>
<div class="danhsachhh" style="height: auto;">
    <h2 style=" color: #606063; padding-left: 20px;">CHI TIẾT BÌNH LUẬN</h2>
    <table>
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
    <br><br>
    <a href="index.php?act=list_bl"><button>Danh sách bình luận</button></a>
</div>
<div>

   

</div> 
</div>