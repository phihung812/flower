<?php
require_once "connect.php";
class Product
{
    public $connect;
    public function __construct()
    {
        $this->connect = new Connect();
    }
    public function insert_product($id, $name, $description, $category_id, $base_price, $available_stock, $sku, $status, $main_image)
    {
        $sql = "INSERT INTO `product` (id, name, description, category_id, base_price, available_stock, sku, status, main_image) VALUES (?,?,?,?,?,?,?,?,?)";
        $this->connect->setQuery($sql);
        return $this->connect->loadData([$id, $name, $description, $category_id, $base_price, $available_stock, $sku, $status, $main_image]);
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
    public function getProductById($id)
    {
        $sql = "SELECT * FROM `product` WHERE id = ?";
        $this->connect->setQuery($sql);
        return $this->connect->loadData([$id], false);
    }
    

    

    public function updateProduct( $name, $description, $category_id, $base_price, $available_stock, $sku, $status, $main_image, $id)
{
    $sql = "UPDATE `product` SET `name`=?, `description`=?, `category_id`=?, `base_price`=?, `available_stock`=?, `sku`=?, `status`=?, `main_image`=? WHERE `id`=?";
    $this->connect->setQuery($sql);
    return $this->connect->loadData([$name, $description, $category_id, $base_price, $available_stock, $sku, $status, $main_image, $id]);
}



}

?>