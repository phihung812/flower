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
    public function checkProduct($productId)
    {
        $sql = "SELECT COUNT(*) FROM cartitem WHERE product_id = ?";
        $this->connect->setQuery($sql);
        return $this->connect->loadData([$productId]);

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
        $sql = "SELECT * FROM `product` WHERE category_id =19  LIMIT 9";
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
    public function listProductByKeyword($kyw, $iddm, $sort)
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
            $sql .= " ORDER BY LEFT(name, 1) DESC";
        } elseif ($sort == 'price_asc') {
            $sql .= " ORDER BY base_price ASC";
        } elseif ($sort == 'price_desc') {
            $sql .= " ORDER BY base_price DESC";
        }


        $this->connect->setQuery($sql);
        return $this->connect->loadData();
    }
    public function insertVariant($id, $product_id, $size, $price, $stock_quantity)
    {
        $sql = "INSERT INTO `productvariant` (id, product_id, size, price, stock_quantity) VALUES (?,?,?,?,?)";
        $this->connect->setQuery($sql);
        return $this->connect->loadData([$id, $product_id, $size, $price, $stock_quantity]);
    }
    public function listVariant()
    {
        $sql = "SELECT * FROM `productvariant`";
        $this->connect->setQuery($sql);
        return $this->connect->loadData();
    }
    public function deleteVariant($id)
    {
        $sql = "DELETE FROM `productvariant` WHERE id = ?";
        $this->connect->setQuery($sql);
        return $this->connect->loadData([$id], false);
    }
    public function kiemTraTonTaiVariant($product_id, $size)
    {
        $sql = "SELECT * FROM `productvariant` WHERE product_id = ? AND size = ?";
        $this->connect->setQuery($sql);
        return $this->connect->loadData([$product_id, $size], false);
    }
    // lấy id biến thể
    public function getVariantId($product_id, $size)
    {
        $sql = "SELECT id, price FROM productvariant WHERE product_id = ? AND size = ?";
        $this->connect->setQuery($sql);
        return $this->connect->loadData([$product_id, $size], false); // Lấy một bản ghi
    }
    public function getVariantById($id)
    {
        $sql = "SELECT * FROM `productvariant` WHERE id = ?";
        $this->connect->setQuery($sql);
        return $this->connect->loadData([$id], false);
    }
    public function updateVariant($product_id, $size, $price, $stock_quantity, $id)
    {
        $sql = "UPDATE `productvariant` SET `product_id`=?,`size`=?,`price`=?,`stock_quantity`=? WHERE `id`=?";
        $this->connect->setQuery($sql);
        return $this->connect->loadData([$product_id, $size, $price, $stock_quantity, $id]);
    }
    // lấy các size của sản  phẩm
    public function getProductSize($product_id)
    {
        $sql = "SELECT size,price FROM productvariant WHERE product_id = ?";
        $this->connect->setQuery($sql);
        $sizes = $this->connect->loadData([$product_id]);
        return $sizes;
    }
    // xử lí giá theo biến thế
    public function getPriceBySize($product_id, $size)
    {
        // Truy vấn để lấy giá của sản phẩm theo size
        $sql = "SELECT price FROM productvariant WHERE product_id = ? AND size = ?";
        $this->connect->setQuery($sql);
        return $this->connect->loadData([$product_id, $size], true);
    }














}

?>