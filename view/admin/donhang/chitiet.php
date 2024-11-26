<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hoá Đơn</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .invoice-container {
            width: 80%;
            max-width: 900px;
            margin: 30px auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .invoice-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .invoice-header h1 {
            font-size: 28px;
            margin: 0;
            color: #333;
        }

        .invoice-header .date {
            font-size: 16px;
            color: #777;
        }

        .invoice-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
        }

        .invoice-info div {
            width: 48%;
        }

        .invoice-info div h3 {
            margin: 0;
            color: #333;
            font-size: 18px;
        }

        .invoice-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .invoice-table th, .invoice-table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        .invoice-table th {
            background-color: #f8f8f8;
            font-weight: bold;
            color: #333;
        }

        .invoice-table td {
            font-size: 16px;
            color: #555;
        }

        .invoice-table .total {
            text-align: right;
            font-size: 18px;
            font-weight: bold;
        }

        .invoice-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 30px;
            border-top: 2px solid #333;
            padding-top: 10px;
        }

        .invoice-footer .terms {
            font-size: 14px;
            color: #777;
        }

        .invoice-footer .total-amount {
            font-size: 20px;
            font-weight: bold;
            color: #333;
        }
    </style>
</head>
<body>

<div class="invoice-container">
    <!-- Invoice Header -->
    <div class="invoice-header">
        <h1>chi tiết đơn hàng</h1>
        <div class="date">Ngày: <?php echo date('d-m-Y'); ?></div>
    </div>

    <!-- Invoice Information -->
    <div class="invoice-info">
        <div>
            <h3>Thông tin khách hàng:</h3>
            <p>Tên khách hàng: <?php echo $chitiet->name ?></p>
            <p>Email: <?php echo $chitiet->email ?></p>
            <p>Số điện thoại: <?php echo $chitiet->phone ?></p>
            <p>biên lai: <?php echo $chitiet->session_token  ?></p>
        </div>
        <div>
            <h3>Thông tin đơn hàng:</h3>
            <p>Mã đơn hàng: <?php echo $chitiet->id ?></p>
            <p>ID giỏ hàng: <?php echo $chitiet->cart_id ?></p>
            <p>số lượng: <?php echo $chitiet->total_items ?></p>
            <p>thành phố : <?php echo $chitiet->shipping_city ?></p>
            <p>Địa chỉ giao hàng: <?php echo $chitiet->shipping_address ?></p>
            <p>tình trạng đơn hàng: <?php echo $chitiet->status ?></p>

        </div>
    </div>

    <!-- Product Table -->
    <table class="invoice-table">
        <tr>
            <th>Ảnh</th>
            <th>tên sản phẩm</th>
            <th>Mã sản phẩm</th>
            <th>Biến thể (Size)</th>
            <th>Số lượng</th>
            <th>Đơn giá</th>
            <th>Tổng giá</th>
        </tr>

        <?php foreach ($payment as $payments) { ?>
            <?php if ($chitiet->id == $payments->order_id) { ?>
                <?php 
                    $img = null;
                    $bienthe = null;
                    foreach ($anh as $image) {
                        if ($payments->product_id == $image->id) {
                            $img = $image;
                            break;
                        }
                    }
                    foreach ($bienthem as $variant) {
                        if ($payments->variant_id == $variant->id) {
                            $bienthe = $variant;
                            break;
                        }
                    }
                ?>
                <tr>
                    <td>
                        <?php if ($img) { ?>
                            <img src="<?php echo $img->main_image ?>" width="50px">
                        <?php } else { ?>
                            Không có ảnh
                        <?php } ?>
                    </td>
                    
                    <td><?php echo $image->name; ?></td>
                    <td><?php echo $payments->product_id; ?></td>
                    <td><?php echo $bienthe ? $bienthe->size : 'Không có biến thể'; ?></td>
                    <td><?php echo $payments->quantity; ?></td>
                    <td><?php echo number_format($payments->price, 0, ',', '.') . ' VNĐ'; ?></td>
                    <td><?php echo number_format($payments->total_price, 0, ',', '.') . ' VNĐ'; ?></td>
                </tr>
            <?php } ?>
        <?php } ?>
    </table>

    <!-- Invoice Footer -->
    <div class="invoice-footer">
        <div class="terms">* Chính sách hoàn trả và bảo hành có thể thay đổi theo điều kiện.</div>
        <div class="total-amount">Tổng cộng: <?php echo number_format($chitiet->total_price, 0, ',', '.') . ' VNĐ'; ?></div>
    </div>
</div>

</body>
</html>
