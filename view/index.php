<?php
require_once "../controller/productController.php";
require_once "../controller/danhmuc.php";

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
    }
} else {
    require_once "admin/home.php";
}

require_once "admin/footer.php";

?>