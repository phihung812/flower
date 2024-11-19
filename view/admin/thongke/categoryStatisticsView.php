<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thống Kê Danh Mục</title>

</head>
<body>
    <div class="main-content">
        <h1>Thống Kê Danh Mục Sản Phẩm</h1>
        <table class="table_danhmuc">
            <thead class="thead">
                <tr>
                    <th>ID</th>
                    <th>Tên Danh Mục</th>
                    <th>Tổng Sản Phẩm</th>
                    <th>Giá Nhỏ Nhất</th>
                    <th>Giá Cao Nhất</th>
                    <th>Giá Trung Bình</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($statistics)) : ?>
                    <?php foreach ($statistics as $item) : ?>
                        <tr>
                            <td><?= $item->id ?></td>
                            <td><?= htmlspecialchars($item->name) ?></td>
                            <td><?= $item->total_products ?></td>
                            <td><?= number_format($item->min_price ?? 0) ?> VND</td>
                            <td><?= number_format($item->max_price ?? 0) ?> VND</td>
                            <td><?= number_format($item->avg_price ?? 0) ?> VND</td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="6">Không có dữ liệu</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
