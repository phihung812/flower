<?php
require_once "controller/danhmuc.php";
require_once "controller/productController.php";
require_once "controller/taikhoanController.php";

$danhmuc = new danhmucController();
$menuDanhmuc = $danhmuc->list_menu();

if (isset($_GET['act'])) {
    $act = $_GET['act'];
    switch ($act) {
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
        
        
    }
} else {
    $sanpham = new ProductController();
    $listProNew = $sanpham->product_New();
}

require_once "view/client/footer.php";

?>