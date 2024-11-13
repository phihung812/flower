<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="view/css/client.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.css">
    </link>
    <title>Trang chủ</title>
</head>

<body>
    <div class="container">
        <nav>
            <div class="nav-left">
                <ul>
                    <li>
                        HOTLINE:
                        <a href="tel:0359 058 116">0359 058 116</a>
                        |
                        <a href="tel:1900 35 58 16">1900 35 58 16</a>
                    </li>
                </ul>
            </div>
            <div class="nav-right">
                <ul>
                    <li>
                        <a href="#">
                            <i class="fa-solid fa-user"></i>
                            <span>Tài khoản</span>
                        </a>
                        <ul class="submenu">
                            <li><a href="index.php?act=register">Đăng ký</a></li>
                            <li><a href="index.php?act=login">Đăng nhập</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="">
                            <i class="fa-solid fa-cart-shopping"></i>
                            <span>Giỏ hàng</span>
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <i class="fa-solid fa-file-invoice-dollar"></i>
                            <span>Thanh toán</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
        <header>
            <div class="contact">
                <a href="">
                    <i style="color: blue;" class="fa-brands fa-facebook"></i>
                </a>
                <a href="">
                    <i style="color: rgb(0, 179, 255);" class="fa-brands fa-twitter"></i>
                </a>
                <a href="">
                    <i style="color: rgb(207, 62, 103);" class="fa-brands fa-instagram"></i>
                </a>
            </div>
            <div class="logo">
                <a href="index.php">
                    <img src="https://www.flowercorner.vn/image/catalog/common/shop-hoa-tuoi-flowercorner-logo.png.webp"
                        alt="">
                </a>

            </div>
            <div class="search-product">
                <form class="search" action="index.php?act=search-pro" method="POST">
                    <input type="text"  placeholder="Tìm kiếm" name="search">
                    <button type="submit" name="submit-search"><i class="fa-solid fa-magnifying-glass"></i></button>
                </form>
            </div>
        </header>
        <div class="menu">
            <nav>
                <ul>
                    <?php foreach ($listMenu as $list) { ?>
                    <li>
                        <a href="<?php echo 'index.php?act=search-pro&iddm='.$list->id ?>"><?php echo $list->name ?></a>
                    </li>
                    <?php } ?>
                    
                </ul>
            </nav>
        </div>
        <div class="title">
            <p>ĐẶT HOA ONLINE - GIAO MIỄN PHÍ HÀ NỘI - GỌI NGAY 0359 058 116</p>
        </div>