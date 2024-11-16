<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thống kê sản phẩm</title>
  
</head>
<body>
<div class="main-content">
    <h1>Thống Kê Sản Phẩm</h1>
    <table class="table_danhmuc">
        <thead class="thead">
            <tr>
                <th>Mã sản phẩm</th>
                <th>Tên sản phẩm</th>
                <th>Danh mục</th>
                <th>Giá bán</th>
                <th>Số lượng bán ra tháng</th>
                <th>Doanh thu</th>
                <th>Tồn kho hiện tại</th>
                
            </tr>
        </thead>
        <tbody>
            <?php foreach ($statistics as $stat): ?>
                <tr>
                    <td><?php echo $stat->product_id; ?></td>
                    <td><?php echo $stat->product_name; ?></td>
                    <td><?php echo $stat->category_name; ?></td>
                    <td><?php echo number_format($stat->price, 0, ',', '.'); ?> VNĐ</td>
                    <td><?php echo $stat->sold_quantity; ?></td>
                    <td><?php echo number_format($stat->revenue, 0, ',', '.'); ?> VNĐ</td>
                    <td><?php echo $stat->stock; ?></td>
                 
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
   </div>
</body>
</html>
