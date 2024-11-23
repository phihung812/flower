<?php
ob_start();
require_once "controller/danhmuc.php";
require_once "controller/productController.php";
require_once "controller/taikhoanController.php";
require_once "controller/cartController.php";
require_once "controller/orderController.php";



$danhmuc = new danhmucController();
$menuDanhmuc = $danhmuc->list_menu();
$Cart = new CartController();
$Cart->CreateCartNoAcc();

if (isset($_GET['act'])) {
    $act = $_GET['act'];
    switch ($act) {
        case 'gioithieu':
            require_once "view/client/gioithieu.php";
            break;
        case 'lienhe':
            require_once "view/client/lienhe.php";
            break;
        case 'chinhsach':
            require_once "view/client/chinhsach.php";
            break;
        case 'register':
            $register = new TaikhoanController();
            $register->insert_taikhoan();
            break;
        case 'sanphamchitiet':
            $product = new ProductController();
            $product->sanPhamChiTiet();
            break;
        case 'search-pro':
            $product = new ProductController();
            $product->serchProduct();
            break;
        case 'login':
            $taikhoan = new TaikhoanController();
            $taikhoan->login();
            break;
        case 'cart':
            $cart = new CartController();
            $cart->listCart();
            break;
        case 'deleteCartItem':
            $cart = new CartController();
            $cart->deleteCartItem();
            break;
        case 'myAccount':
            $taikhoan = new TaikhoanController;
            $taikhoan->myAccount();
            break;
        case 'payment':
            $thanhtoan = new OrderController();
            $thanhtoan->createOrder();
            break;
        case 'thanhcong':
            if (isset($_GET['method']) && $_GET['method'] === 'handlePaymentCallback') {
                $mOrder = new OrderController();
                $mOrder->handlePaymentCallback();
            } 
            break;
        case 'logout':
            session_unset();
            header('location:index.php?act=login');
            break;

    }
} else {
    $sanpham = new ProductController();
    $listProNew = $sanpham->product_New();
}

require_once "view/client/footer.php";

?>