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
    public function getCartIdByUserId($user_id)
    {
        // Truy vấn để lấy ID giỏ hàng từ bảng cart dựa trên user_id
        $sql = "SELECT id FROM cart WHERE user_id = ?";
        $this->connect->setQuery($sql);
        // Lấy giỏ hàng của người dùng (ở đây chỉ lấy một giỏ hàng duy nhất)
        return $this->connect->loadData([$user_id], false); // Trả về một bản ghi
    }

    // cartItem 
    // thêm sản phẩm vào cartItem (giỏ hàng)
    public function addProductToCartItem($id, $cart_id, $variant_id, $quantity, $price, $total_price)
    {
        $sql = "INSERT INTO `cartitem`(id, cart_id, variant_id, quantity, price, total_price) VALUES (?,?,?,?,?,?)";
        $this->connect->setQuery($sql);
        return $this->connect->execute([$id, $cart_id, $variant_id, $quantity, $price, $total_price]);
    }
    // lấy thông tin ra giỏ hàng
    public function getCartItems($cart_id)
    {
        $sql = "SELECT 
    p.main_image,  -- Lấy main_image từ bảng product
    p.name,        -- Lấy name từ bảng product
    p.sku,         -- Lấy sku từ bảng product
    ci.quantity,   -- Lấy quantity từ bảng cartitem
    ci.total_price, -- Lấy total_price từ bảng cartitem
    pv.size,       -- Lấy size từ bảng productvariant
    pv.price       -- Lấy price từ bảng productvariant
FROM 
    cartitem ci
JOIN 
    productvariant pv ON ci.variant_id = pv.id  -- Nối với bảng productvariant qua variant_id
JOIN 
    product p ON pv.product_id = p.id           -- Nối với bảng product qua product_id
WHERE 
    ci.cart_id = ?  -- Lọc theo cart_id


";
        $this->connect->setQuery($sql);
        return $this->connect->loadData([$cart_id], true); // Trả về danh sách sản phẩm trong giỏ hàng
    }









    // kiểm tra sản phẩm có trong giỏ hàng chưa
    public function checkCartItem($cart_id, $variant_id)
    {
        $sqlCheck = "SELECT * FROM cartitem WHERE cart_id = ? AND variant_id = ?";
        $this->connect->setQuery($sqlCheck);
        return $this->connect->loadData([$cart_id, $variant_id], false);
    }
    // cập nhật item trong giỏ hàng
    public function updateCartItem($newQuantity, $newTotalPrice, $cart_id, $variant_id){
        $sqlUpdate = "UPDATE cartitem SET quantity = ?, total_price = ? WHERE cart_id = ? AND variant_id = ?";
        $this->connect->setQuery($sqlUpdate);
        return $this->connect->loadData([$newQuantity, $newTotalPrice, $cart_id, $variant_id]);
    }

    // cập nhât giỏ hàng
    public function updateCartTotals($cart_id)
    {
        // Tính tổng số lượng sản phẩm và tổng giá tiền từ bảng cartitem
        $sql = "SELECT SUM(quantity) AS total_items, SUM(total_price) AS total_price FROM cartitem WHERE cart_id = ?";
        $this->connect->setQuery($sql);
        $cartTotals = $this->connect->loadData([$cart_id], false);

        // Cập nhật lại giỏ hàng (bảng cart)
        if ($cartTotals) {
            $sqlUpdateCart = "UPDATE cart SET total_items = ?, total_price = ? WHERE id = ?";
            $this->connect->setQuery($sqlUpdateCart);
            $this->connect->loadData([$cartTotals->total_items, $cartTotals->total_price, $cart_id]);
        }
    }






}
?>