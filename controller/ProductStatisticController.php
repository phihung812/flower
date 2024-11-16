<?php

include_once(__DIR__ . '/../model/ProductStatisticModel.php');
class ProductStatisticController {
    private $model;

    public function __construct() {
        $this->model = new ProductStatisticModel();
    }

    public function getStatistics() {
        $statistics = $this->model->getProductStatistics();
        
        require_once __DIR__ . "/../view/admin/thongke/ProductStatisticView.php";
    }
}
?>
