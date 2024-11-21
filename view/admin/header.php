<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="./css/admin.css">
</head>
<style>
    .link-item {
        position: relative;
    }

    /* Định dạng cho menu con, ban đầu ẩn đi */
    .submenu {
        display: none;
        position: absolute;
        top: 100%;
        left: 0;
        background-color: #333;
        padding: 0;
        margin: 0;
        list-style: none;
        border-radius: 5px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        z-index: 1000;
    }

    /* Hiển thị menu con khi di chuột vào mục có submenu */
    .link-item:hover .submenu {
        display: block;
    }

    /* Định dạng cho các mục con */
    .submenu li {
        padding: 10px 20px;
    }

    .submenu li a {
        color: #fff;
        text-decoration: none;
        display: block;
    }

    .submenu li a:hover {
        background-color: #555;
    }
</style>
<body>
    <div class="container">
        <ul class="link-items">
            <li class="link-item">
                <a href="index.php" class="link">
                    <span class="icon">&#8962;</span> Home
                </a>
            </li>
            <li class="link-item">
                <a href="index.php?act=listProduct" class="link">
                    <span class="icon">&#128295;</span> Sản Phẩm
                </a>
            </li>
            <li class="link-item">
                <a href="index.php?act=listBanner " class="link">
                    <span class="icon">&#128295;</span> Banner
                </a>
            </li>
            <li class="link-item">
                <a href="index.php?act=Variant" class="link">
                    <span class="icon">&#128295;</span> Biến thể sản phẩm
                </a>
            </li>
            <li class="link-item">
                <a href="index.php?act=list_danhmuc" class="link">
                    <span class="icon">&#128640;</span> Danh Mục
                </a>
            </li>
            <li class="link-item">
                <a href="index.php?act=list_bl" class="link">
                <span class="icon">&#128640;</span></span>bình luận
                </a>
            </li>
           
            <li class="link-item">
                <a href="index.php?act=listTaikhoan" class="link">
                    <span class="icon">&#128100;</span> Người dùng
                </a>
            </li>
            <li class="link-item">
                <a href="#" class="link">
                    <span class="icon">&#128202;</span> Thống Kê
                </a>
                <ul class="submenu">
                    <li><a href="index.php?act=categoryStatisticsView">Danh Mục</a></li>
                    <li><a href="index.php?act=ProductStatisticView">Sản Phẩm</a></li>
                </ul>
            </li>
            <li class="link-item">
                <a href="index.php?act=order" class="link">
                    <span class="icon">&#128202;</span> Đơn Hàng
                </a>
            </li>
            <li class="link-item">
                <a href="../index.php" class="link">
                    <span class="icon">&#128682;</span> Thoát Khỏi Admin
                </a>
            </li>
        </ul>
    </div>
