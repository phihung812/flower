<?php
require_once "connect.php";
class Product
{
    public $connect;
    public function __construct()
    {
        $this->connect = new Connect();
    }
    public function insert_product($id, $name, $description, $category_id, $base_price, $available_stock, $sku, $status, $main_image, $created_at, $updated_at)
    {
        $sql = "INSERT INTO `product` VALUES (?,?,?,?,?,?,?,?,?,?,?)";
        $this->connect->setQuery($sql);
        return $this->connect->loadData([$id, $name, $description, $category_id, $base_price, $available_stock, $sku, $status, $main_image, $created_at, $updated_at]);
    }
    public function list_product()
    {
        $sql = "SELECT * FROM `product`";
        $this->connect->setQuery($sql);
        return $this->connect->loadData();
    }
    public function deleteProduct($id)
    {
        $sql = "DELETE FROM `product` WHERE id = ?";
        $this->connect->setQuery($sql);
        return $this->connect->loadData([$id], false);
    }

}

?>