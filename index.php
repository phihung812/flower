<?php
require_once "controller/danhmuc.php";
require_once "controller/productController.php";
require_once "controller/taikhoanController.php";
require_once "controller/cartController.php";

$danhmuc = new danhmucController();
$menuDanhmuc = $danhmuc->list_menu();

if (isset($_GET['act'])) {
    $act = $_GET['act'];
    switch ($act) {
        case 'gioithieu':
            require_once "view/client/gioithieu.php";
            break;
        case 'lienhe':
             require_once "view/client/lienhe.php";
            break;
        case 'register':
            $register = new TaikhoanController();
            $register->insert_taikhoan();
            break;
        case 'sanphamchitiet':
            $product = new ProductController();
            $product->sanPhamChiTiet();
            // $cart = new CartController();
            // $cart->addProductToCartItem();
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
        
        
    }
} else {
    $sanpham = new ProductController();
    $listProNew = $sanpham->product_New();
}

require_once "view/client/footer.php";

?>