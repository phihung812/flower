<style>
 /* Container and Heading Styling */
h2 {
  text-align: center;
  margin-bottom: 20px;
  font-size: 24px;
  color: #333; /* Dark gray */
  text-transform: uppercase;
  letter-spacing: 1px;
}

/* Table Styling */
.table_bl {
  width: 90%;
  margin: 0 auto;
  border-collapse: collapse; /* Remove space between table cells */
  font-family: Arial, sans-serif;
  font-size: 16px;
  color: #333; /* Dark gray text */
  background-color: #f9f9f9; /* Light background color */
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Subtle shadow */
}

/* Table Headers */
.table_bl th {
  background-color: #007bff; /* Blue header background */
  color: #fff; /* White text */
  padding: 10px;
  text-align: left;
  border: 1px solid #ddd; /* Light border */
  text-transform: capitalize;
}

/* Table Rows */
.table_bl td {
  padding: 10px;
  border: 1px solid #ddd; /* Light border */
  text-align: left;
}

/* Alternating Row Colors */
.table_bl tr:nth-child(even) {
  background-color: #f2f2f2; /* Light gray for even rows */
}

.table_bl tr:nth-child(odd) {
  background-color: #ffffff; /* White for odd rows */
}

/* Hover Effect */
.table_bl tr:hover {
  background-color: #e6f7ff; /* Light blue on hover */
}

/* Button Styling */
.table_bl button {
  background-color: #ff4d4d; /* Red background */
  color: #fff; /* White text */
  border: none;
  border-radius: 4px;
  padding: 5px 10px;
  cursor: pointer;
  font-size: 14px;
  transition: background-color 0.3s ease;
}

.table_bl button:hover {
  background-color: #e60000; /* Darker red on hover */
}

.table_bl button:active {
  background-color: #b30000; /* Even darker red on click */
}

/* Responsive Styling */
@media screen and (max-width: 768px) {
  .table_bl {
    font-size: 14px;
  }
  .table_bl th, .table_bl td {
    padding: 8px;
  }
}
#danhsach{
    margin-left:30%;
}
</style>
<div id="danhsach">
    <h2>DANH SÁCH BÌNH LUẬN</h2>
    <table class="table_bl">
        <tr>
            
            <th>Mã bình luận </th>
            <th>mã sản phẩm</th>
            <th>mã người dùng</th>
            <th>lời bình luận</th>
            <th>mã ngày cập nhật</th>
            <th>thao tác</th>
   
            
        </tr>
        <?php foreach ($list as $binhluan) {?>
            <tr>
              
                <td><?php echo $binhluan->id ?></td>
                <td><?php echo $binhluan->product_id  ?></td>
                <td><?php echo $binhluan->user_id  ?></td>
                <td><?php echo $binhluan->comment ?></td>
                <td><?php echo $binhluan->created_at ?></td>
                <td><a href="index.php?act=delete_bl&id=<?php echo $binhluan->id ?>"><button>xoá</button></a></td>
                

            </tr>
        <?php }?>
    </table>
</div>
<div>

</div>
</div>