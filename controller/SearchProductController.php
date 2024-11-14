<?php
require_once "./model/SearchProduct.php";

class SearchProductController {
    private $productModel;

    public function __construct() {
        $this->productModel = new SearchProduct();
    }

    // Hàm xử lý tìm kiếm sản phẩm
    public function search() {
        $name = isset($_GET['name']) ? $_GET['name'] : '';
        $minPrice = isset($_GET['min_price']) ? (int)$_GET['min_price'] : 0;
        $maxPrice = isset($_GET['max_price']) ? (int)$_GET['max_price'] : 0;

        $products = $this->productModel->searchProducts($name, $minPrice, $maxPrice);

      
        require_once __DIR__ . "/../view/client/searchProductView.php";
    }
}
?>
