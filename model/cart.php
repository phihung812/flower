<?php
require_once "connect.php";
class Cart
{
    public $connect;
    public function __construct()
    {
        $this->connect = new Connect();
    }
    public function createCart($id, $user_id, $total_items, $total_price)
    {
        $sql = "INSERT INTO `cart` (id, user_id, total_items,total_price) VALUES (?,?,?,?)";
        $this->connect->setQuery($sql);
        $this->connect->execute([$id, $user_id, $total_items, $total_price]);
        return $this->connect->lastInsertId();
    }
    public function getCartIdByUserId($user_id) {
        // Truy vấn để lấy ID giỏ hàng từ bảng cart dựa trên user_id
        $sql = "SELECT id FROM cart WHERE user_id = ?";
        $this->connect->setQuery($sql);
        // Lấy giỏ hàng của người dùng (ở đây chỉ lấy một giỏ hàng duy nhất)
        return $this->connect->loadData([$user_id], false); // Trả về một bản ghi
    }
    
    // cartItem
    public function addProductToCartItem($id, $cart_id, $variant_id, $quantity, $price, $total_price){
        $sql = "INSERT INTO `cartitem`(id, cart_id, variant_id, quantity, price, total_price) VALUES (?,?,?,?,?,?)";
        $this->connect->setQuery($sql);
        return $this->connect->execute([$id, $cart_id, $variant_id, $quantity, $price, $total_price]);
    }

}
?>
