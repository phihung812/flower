<?php
include_once(__DIR__ . '/../model/CategoryModel.php');

class CategoryController {
    private $categoryModel;

    public function __construct() {
        $this->categoryModel = new CategoryModel();
    }

    // Hiển thị dữ liệu thống kê
    public function showStatistics() {
        $statistics = $this->categoryModel->getCategoryStatistics();
        require_once __DIR__ . "/../view/admin/thongke/categoryStatisticsView.php";
    }
}
?>
