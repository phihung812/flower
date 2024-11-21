<?php
require_once "connect.php";
class Cart
{
    public $connect;
    public function __construct()
    {
        $this->connect = new Connect();
    }
    public function createCart($id, $user_id, $session_token, $total_items, $total_price)
    {
        $sql = "INSERT INTO `cart` (id, user_id, session_token, total_items,total_price) VALUES (?,?,?,?,?)";
        $this->connect->setQuery($sql);
        $this->connect->execute([$id, $user_id, $session_token, $total_items, $total_price]);
        return $this->connect->lastInsertId();
    }
    public function checkCart($cartToken, $userId)
    {
        $sql = "SELECT * FROM cart WHERE session_token = ? OR user_id = ?";
        $this->connect->setQuery($sql);
        return $this->connect->loadData([$cartToken, $userId], false);
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

    // lấy thông tin ra giỏ hàng

    public function getCartItems($cart_id)
    {
        $sql = "SELECT 
                p.main_image, 
                p.name, 
                p.sku, 
                ci.quantity, 
                ci.total_price,
                ci.id, 
                IFNULL(pv.size, 'Mặc định') AS size, 
                IFNULL(pv.price, p.base_price) AS price       
            FROM 
                cartitem ci 
            JOIN 
                product p ON ci.product_id = p.id  
            LEFT JOIN 
                productvariant pv ON ci.variant_id = pv.id  
            WHERE 
                ci.cart_id = ?";
        $this->connect->setQuery($sql);
        return $this->connect->loadData([$cart_id], true);  // Trả về danh sách sản phẩm trong giỏ hàng
    }


    // thêm sản phẩm vào cartItem (giỏ hàng)
    public function addProductToCartItem($id, $cart_id, $product_id, $variant_id, $quantity, $price, $total_price)
    {
        $sql = "INSERT INTO `cartitem`(id, cart_id, product_id, variant_id, quantity, price, total_price) VALUES (?,?,?,?,?,?,?)";
        $this->connect->setQuery($sql);
        return $this->connect->execute([$id, $cart_id, $product_id, $variant_id, $quantity, $price, $total_price]);
    }

    // kiểm tra sản phẩm có trong giỏ hàng chưa
    public function checkCartItem($cart_id, $variant_id)
    {
        $sqlCheck = "SELECT * FROM cartitem WHERE cart_id = ? AND variant_id = ?";
        $this->connect->setQuery($sqlCheck);
        return $this->connect->loadData([$cart_id, $variant_id], false);
    }
    // cập nhật item trong giỏ hàng
    public function updateCartItem($newQuantity, $newTotalPrice, $cart_id, $variant_id)
    {
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

    // -------------------------------đối với sản phẩm không có biến thể--------------------------------
    public function checkCartItem0($cart_id, $product_id)
    {
        $sqlCheck = "SELECT * FROM cartitem WHERE cart_id = ? AND product_id = ?";
        $this->connect->setQuery($sqlCheck);
        return $this->connect->loadData([$cart_id, $product_id], false);
    }
    public function updateCartItem0($newQuantity, $newTotalPrice, $cart_id, $product_id)
    {
        $sqlUpdate = "UPDATE cartitem SET quantity = ?, total_price = ? WHERE cart_id = ? AND product_id = ?";
        $this->connect->setQuery($sqlUpdate);
        return $this->connect->loadData([$newQuantity, $newTotalPrice, $cart_id, $product_id]);
    }


    // ---------------------------------------------------------------------------------------------------------------------

    public function getCart($cart_id)
    {
        $sql = "SELECT * FROM `cart` WHERE id = ?";
        $this->connect->setQuery($sql);
        return $this->connect->loadData([$cart_id], false);
    }



    public function deleteCartItem($cartItemId)
    {
        $sql = "DELETE FROM cartitem WHERE id = ?";
        $this->connect->setQuery($sql);
        return $this->connect->execute([$cartItemId]);
    }
    public function deleteCartItembyCartId($cart_id)
    {
        $sql = "DELETE FROM cartitem WHERE cart_id = ?";
        $this->connect->setQuery($sql);
        return $this->connect->execute([$cart_id]);
    }
    public function getCartItemsByCartId($cart_id)
    {
        $sql = "SELECT * FROM `cartitem` WHERE cart_id = ?";
        $this->connect->setQuery($sql);
        return $this->connect->loadData([$cart_id], true); // Lấy danh sách sản phẩm trong giỏ hàng
    }



    public function all_chitietgiohang(){
        $sql = "SELECT * FROM `cartitem`";
        $this->connect->setQuery($sql);
        return $this->connect->loadData();
      }

      public function all_giohang(){
        $sql = "SELECT * FROM `cart`";
        $this->connect->setQuery($sql);
        return $this->connect->loadData();
      }
      public function all_thanhtien(){
        $sql = "SELECT * FROM `orderitem`";
        $this->connect->setQuery($sql);
        return $this->connect->loadData();
      }
      public function all_thanhtoan(){
        $sql = "SELECT * FROM `orders`";
        $this->connect->setQuery($sql);
        return $this->connect->loadData();
      }




}
?>