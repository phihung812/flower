<?php
require_once "../controller/productController.php";
require_once "../controller/danhmuc.php";
require_once "../controller/taikhoanController.php";
require_once "../controller/binhluan.php";

require_once "admin/header.php";

if (isset($_GET['act'])) {
    $act = $_GET['act'];
    switch ($act) {
        case 'addProduct':
            $product = new ProductController();
            $product->addProduct();
            break;
        case 'listProduct':
            $product = new ProductController();
            $product->listProduct();
            break;
        case 'deleteProduct':
            $product = new ProductController();
            $product->deleteProduct();
            break;
        case 'editProduct':
            $product = new ProductController();
            $product->updateProduct();
            break;
        ////////////////////////////////////////
        case 'add_danhmuc':
            $danhmuc = new danhmucController();
            $danhmuc->add();
            break;
        case 'list_danhmuc':
            $danhmuc = new danhmucController();
            $danhmuc->list_danhmuc();
            break;
        case 'delete_danhmuc':
            $danhmuc = new danhmucController();
            $danhmuc->delete_danhmuc();
            break;
        case 'edit_danhmuc':
            $danhmuc = new danhmucController();
            $danhmuc->edit_danhmuc();
            break;
        // --------------------------------------
        case 'listTaikhoan':
            $taikhoan = new TaikhoanController();
            $taikhoan->list_taikhoan();
            break;
        case 'delete_taikhoan':
            $taikhoan = new TaikhoanController();
            $taikhoan->deleteTaikhoan();
            break;
        case 'edit_taikhoan':
            $taikhoan = new TaikhoanController();
            $taikhoan->updateTaikhoan();
            break;
///////////////////////////////////////////////////
        case 'list_bl':
            $binhluan = new binhluanController();
            $binhluan->list_binhluan();
            break;
        case 'chitiet_bl':
            $binhluan= new binhluanController();
            $binhluan->chitiet_binhluan();
             break;
        case 'delete_bl':
            $binhluan= new binhluanController();
            $binhluan->delete_binhluan();
            break;

    }

} else {
    require_once "admin/home.php";
}

require_once "admin/footer.php";

?>