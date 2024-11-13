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

    public function updateProduct($name, $description, $category_id, $base_price, $available_stock, $sku, $status, $main_image, $id)
    {
        $sql = "UPDATE `product` SET `name`=?, `description`=?, `category_id`=?, `base_price`=?, `available_stock`=?, `sku`=?, `status`=?, `main_image`=? WHERE `id`=?";
        $this->connect->setQuery($sql);
        return $this->connect->loadData([$name, $description, $category_id, $base_price, $available_stock, $sku, $status, $main_image, $id]);
    }
    public function productNew()
    {
        $sql = "SELECT * FROM `product` ORDER BY created_at DESC LIMIT 8";
        $this->connect->setQuery($sql);
        return $this->connect->loadData();
    }
    public function productBirthday()
    {
        $sql = "SELECT * FROM `product` WHERE category_id =19  LIMIT 19";
        $this->connect->setQuery($sql);
        return $this->connect->loadData();
    }
    public function productRelate($category_id, $idPro)
    {
        $sql = "SELECT * FROM `product` WHERE category_id = ? AND id <> ? LIMIT 4";
        $this->connect->setQuery($sql);
        return $this->connect->loadData([$category_id, $idPro]);
    }
    public function listProductByCategory($category_id)
    {
        $sql = "SELECT * FROM `product` WHERE category_id = ?";
        $this->connect->setQuery($sql);
        return $this->connect->loadData([$category_id]);
    }
    public function listProductByKeyword($kyw, $iddm,$sort)
    {
        $sql = "SELECT * FROM `product` WHERE 1=1";
        if ($kyw != "") {
            $sql .= " AND name LIKE '%$kyw%'";
        }
        if ($iddm > 0) {
            $sql .= " AND category_id = $iddm";
        }
        if ($sort == 'name_asc') {
            $sql .= " ORDER BY LEFT(name, 1) ASC";
        } elseif ($sort == 'name_desc') {
            $sql .= " ORDER BY LEFT(name, 1) ASC";
        } elseif ($sort == 'price_asc') {
            $sql .= " ORDER BY base_price ASC";
        } elseif ($sort == 'price_desc') {
            $sql .= " ORDER BY base_price DESC";
        }


        $this->connect->setQuery($sql);
        return $this->connect->loadData();
    }
    










}

?>