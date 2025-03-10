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
        $sql = "SELECT * FROM `product` ORDER BY `id` desc";
        $this->connect->setQuery($sql);
        return $this->connect->loadData();
    }
    public function deleteProduct($id)
    {
        $sql = "DELETE FROM `product` WHERE id = ?";
        $this->connect->setQuery($sql);
        return $this->connect->loadData([$id], false);
    }
    public function checkProductCart($productId)
    {
        $sql = "SELECT COUNT(*) FROM cartitem WHERE product_id = ?";
        $this->connect->setQuery($sql);
        return $this->connect->loadData([$productId]);

    }
    public function checkProductOrder($productId)
    {
        $sql = "SELECT COUNT(*) FROM orderitem WHERE product_id = ?";
        $this->connect->setQuery($sql);
        return $this->connect->loadData([$productId]);

    }
    public function checkVariantCart($variant_id)
    {
        $sql = "SELECT COUNT(*) FROM cartitem WHERE variant_id = ?";
        $this->connect->setQuery($sql);
        return $this->connect->loadData([$variant_id]);

    }
    public function checkVariantOrder($variant_id)
    {
        $sql = "SELECT COUNT(*) FROM orderitem WHERE variant_id = ?";
        $this->connect->setQuery($sql);
        return $this->connect->loadData([$variant_id]);

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
    public function updateAvailableStock($quantity, $idProduct)
    {
        $sql = "UPDATE `product` SET `available_stock`= available_stock - ?  WHERE `id` = ?";
        $this->connect->setQuery($sql);
        return $this->connect->loadData([$quantity, $idProduct]);
    }
    public function updateVariantAvailableStock($quantity, $idVariant)
    {
        $sql = "UPDATE `productvariant` SET `stock_quantity`= stock_quantity - ?  WHERE `id` = ?";
        $this->connect->setQuery($sql);
        return $this->connect->loadData([$quantity, $idVariant]);
    }
    public function updateAvailableStock2($quantity, $idProduct)
    {
        $sql = "UPDATE `product` SET `available_stock`= available_stock + ?  WHERE `id` = ?";
        $this->connect->setQuery($sql);
        return $this->connect->loadData([$quantity, $idProduct]);
    }
    public function updateVariantAvailableStock2($quantity, $idVariant)
    {
        $sql = "UPDATE `productvariant` SET `stock_quantity`= stock_quantity + ?  WHERE `id` = ?";
        $this->connect->setQuery($sql);
        return $this->connect->loadData([$quantity, $idVariant]);
    }
    public function productNew()
    {
        $sql = "SELECT * FROM `product` ORDER BY created_at DESC LIMIT 8";
        $this->connect->setQuery($sql);
        return $this->connect->loadData();
    }
    public function productBirthday()
    {
        $sql = "SELECT * FROM `product` WHERE category_id =19  LIMIT 8";
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
        }elseif ($sort == ''){
            $sql .= " ORDER BY id DESC";
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
    public function listVariant($kyw)
    {
        $sql = "SELECT 
                    productvariant.*, 
                    product.main_image AS image_product, 
                    product.name AS name_product
                FROM 
                    productvariant 
                JOIN 
                    product 
                ON 
                    productvariant.product_id = product.id 
                WHERE 
                    product.name LIKE '%$kyw%'
                ORDER BY 
                    productvariant.id DESC;
                ";
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
        $sql = "SELECT id, price, stock_quantity FROM productvariant WHERE product_id = ? AND size = ?";
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