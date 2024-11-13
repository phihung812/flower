<?php
require_once "controller/danhmuc.php";
require_once "controller/productController.php";
require_once "controller/taikhoanController.php";
require_once "controller/CategoryController.php";
require_once "view/client/header.php";

if (isset($_GET['act'])) {
    $act = $_GET['act'];
    switch ($act) {
        case 'register':
            $register = new TaikhoanController();
            $register->insert_taikhoan();
            break;
        case 'login':
            require_once "view/client/login.php";
            break;
    }
}else{
    require_once "view/client/home.php";
}

require_once "view/client/footer.php";

?>