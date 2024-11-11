<?php
require_once "../controller/productController.php";


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
    }
} else {
    require_once "admin/home.php";
}

require_once "admin/footer.php";

?>