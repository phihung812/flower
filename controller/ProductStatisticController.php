<?php

include_once(__DIR__ . '/../model/ProductStatisticModel.php');
class ProductStatisticController
{
    private $model;

    public function __construct()
    {
        $this->model = new ProductStatisticModel();

    }

    public function getStatistics()
    {
        $statistics = $this->model->getProductStatistics();
        $danhmuc = $this->model->all_danhmuc();
        $sanpham = $this->model->all_product();
        $donhang = $this->model->all_oder();
        $bienthe = $this->model->all_bienthe();
        $chitietdonhang = $this->model->all_odreitem();
        require_once __DIR__ . "/../view/admin/thongke/ProductStatisticView.php";
    }
}
?>