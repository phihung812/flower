<?php
require_once "../controller/productController.php";
require_once "../controller/danhmuc.php";
require_once "../controller/taikhoanController.php";
require_once "../controller/CategoryController.php";
require_once "../controller/bannerController.php";
require_once "../controller/orderController.php";
require_once "../controller/ProductStatisticController.php";

require_once "admin/header.php";

if (isset($_GET['act'])) {
    $act = $_GET['act'];
    switch ($act) {
        case 'addProduct':
            $product = new ProductController();
            $product->addProduct();
            break;
        case 'Variant':
            $product = new ProductController();
            $product->listVariant();
            break;
        case 'addVariant':
            $product = new ProductController();
            $product->addVariant();
            break;
        case 'deleteVariant':
            $product = new ProductController();
            $product->deleteVariant();
            break;
        case 'updateVariant':
            $product = new ProductController();
            $product->updateVariant();
            break;
        case 'listVariant':
            $product = new ProductController();
            $product->listVariant();
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

        case 'addBanner':
            $banner = new BannerController();
            $banner->addBanner();
            break;
        case 'listBanner':
            $banner = new BannerController();
            $banner->listBanner();
            break;
        case 'editBanner':
            $banner = new BannerController();
            $banner->updateBanner();
            break;
        case 'deleteBanner':
            $banner = new BannerController();
            $banner->deleteBanner();
            break;
        case 'order':
            $order = new OrderController();
            $order->listOrder();
            break;

        ////////////////////////////////////////

        case 'thongke':
            $controller = new CategoryController();
            $controller->showStatistics();
            break;
        case 'categoryStatisticsView':
            $controller = new CategoryController();
            $controller->showStatistics();

            break;
        case 'ProductStatisticView':
            $controller = new ProductStatisticController();
            $controller->getStatistics();

            break;
        ////////////////////////////////////////



    }

} else {
    require_once "admin/home.php";
}

require_once "admin/footer.php";

?>