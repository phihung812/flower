<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="./css/admin.css">
</head>
<style>
    /* Thiết lập cơ bản cho ul */
/* Thiết lập cơ bản cho ul */
.link-items {
    list-style: none;
    padding: 0;
    margin: 0;
}

.link-item {
    position: relative;
}

/* Thiết lập cho link */
.link {
    text-decoration: none;
    color: white; /* Giữ màu chữ trắng */
    font-weight: bold;
    padding: 10px 15px;
    display: flex;
    align-items: center;
}

/* Tạo khoảng cách giữa icon và chữ */
.link ion-icon {
    margin-right: 8px; /* Thêm khoảng cách 8px giữa biểu tượng và chữ */
}

/* Hiệu ứng hover */
.link:hover {
    color: #007bff; /* Thay đổi màu chữ khi di chuột */
}

.link-item:hover .link {
    color: #007bff; /* Thay đổi màu chữ khi di chuột */
}

/* Dropdown menu tùy chỉnh */
.dropdown-menu {
    display: none;
    position: absolute;
    top: 100%;
    left: 0;
    background-color: #fff;
    list-style: none;
    padding: 0;
    margin: 0;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    border-radius: 4px;
    min-width: 200px;
    z-index: 1000;
}

.dropdown-menu li {
    padding: 10px 15px;
}

.dropdown-menu li a {
    text-decoration: none;
    color: #007bff ; /* Giữ màu chữ trắng trong menu thả xuống */
    display: flex;
    align-items: center;
    gap: 8px;
}

.dropdown-menu li a:hover {
    background-color: #f0f0f0;
    color: #007bff; /* Thay đổi màu chữ khi hover vào mục dropdown */
}

/* Hiển thị dropdown khi di chuột vào link-item có menu con */
.link-item:hover .dropdown-menu {
    display: block;
}

</style>
<body>
    <div class="container">
        <ul class="link-items">
            <li class="link-item">
                <a href="index.php" class="link">
                <ion-icon name="home-outline"></ion-icon>
                <span style="--i: 1">Home</span>
                </a>
            </li>
            <li class="link-item">
                <a href="index.php?act=listProduct" class="link">
                <ion-icon name="extension-puzzle-outline"></ion-icon>
                <span style="--i: 2">Sản Phẩm</span>
                </a>
            </li>
            <li class="link-item">
                <a href="index.php?act=list_danhmuc" class="link">
                <ion-icon name="apps-outline"></ion-icon>
                <span style="--i: 3">Danh Mục</span>
                </a>
            </li>
            <li class="link-item">
                <a href="index.php?act=Comment" class="link">
                <ion-icon name="chatbubble-outline"></ion-icon>
                <span style="--i: 4">Bình Luận</span>
                </a>
            </li>
            <li class="link-item">
                <a href="index.php?act=listTaikhoan" class="link">
                <ion-icon name="person-outline"></ion-icon>
                <span style="--i: 6">Người dùng</span>
                </a>
            </li>

            <li class="link-item">
            <a href="" class="link">
            <ion-icon name="bar-chart-outline"></ion-icon>
            <span style="--i: 6">Thống Kê</span>
            </a>
            <ul class="dropdown-menu">
                <li><a href="index.php?act=categoryStatistics">Danh Mục</a></li>
                <li><a href="index.php?act=productStatistics">Sản Phẩm</a></li>
            </ul>
         </li>

           <li class="link-item">
                <a href="index.php?act=Order" class="link">
                <ion-icon name="bar-chart-outline"></ion-icon>
                <span style="--i: 6">Đơn Hàng</span>
                </a>
            </li>
            <li class="link-item">
                <a href="../index.php" class="link">
                <ion-icon name="log-out-outline"></ion-icon>
                <span style="--i: 6">Thoát khỏi Admin</span>
                </a>
            </li>
        </ul>
        
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    </div>