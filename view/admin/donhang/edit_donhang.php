<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cập nhật thông tin</title>
    <style>
        form {
            width: 50%;
            margin: 0 auto;
            padding: 20px;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 10px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        .info-text {
            display: block;
            padding: 8px;
            margin-bottom: 15px;
            background-color: #f1f1f1;
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<form action="" method="post">
    <h1>Cập nhật đơn hàng</h1><br><br>

    <label for="customer">Khách hàng:</label>
    <span class="info-text"><?php echo $sua->name; ?></span>

    <label for="quantity">Số lượng:</label>
    <span class="info-text"><?php echo $sua->total_items; ?></span>

    <label for="total_price">Tổng cộng:</label>
    <span class="info-text"><?php echo $sua->total_price; ?></span>

    <label for="shipping_address">số điện thoại:</label>
    <span class="info-text">0<?php echo $sua->phone; ?></span>

    <label for="payment_status">Trạng thái thanh toán:</label>
    <input type="text"  name=trangthai_tien value="<?php echo $thanhtoan->payment_status; ?>">


    <label for="payment_status">Trạng thái đơn hàng:</label>
    <input type="text"  name=trangthai_don value="<?php echo $sua->status; ?>">

    <input type="submit" name="capnhat" value="Cập nhật">
</form>

</body>
</html>
