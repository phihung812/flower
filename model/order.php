<?php
require_once "connect.php";
class Order
{
    public $connect;
    public function __construct()
    {
        $this->connect = new Connect();
    }
    public function createOrder($id, $user_id, $session_token, $name, $email, $phone, $cart_id, $total_items, $total_price, $shipping_address, $shipping_city, $status)
    {
        $sql = "INSERT INTO `orders`(`id`, `user_id`, `session_token` , `name`, `email`, `phone`, `cart_id`,`total_items` ,`total_price`, `shipping_address`, `shipping_city`, `status`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
        $this->connect->setQuery($sql);
        $this->connect->loadData([$id, $user_id, $session_token, $name, $email, $phone, $cart_id, $total_items, $total_price, $shipping_address, $shipping_city, $status]);
        return $this->connect->lastInsertId();
    }

    public function createPayment($id, $order_id, $payment_method, $payment_status, $payment_amount)
    {
        $sql = "INSERT INTO `payment`(`id`, `order_id`, `payment_method`, `payment_status`, `payment_amount`) VALUES (?,?,?,?,?)";
        $this->connect->setQuery($sql);
        return $this->connect->loadData([$id, $order_id, $payment_method, $payment_status, $payment_amount]);
    }
    public function InsertOrderitem($id, $order_id, $product_id, $variant_id, $quantity, $price, $total_price)
    {
        $sql = "INSERT INTO `orderitem`(`id`, `order_id`, `product_id`, `variant_id`, `quantity`, `price`, `total_price`) VALUES (?,?,?,?,?,?,?)";
        $this->connect->setQuery($sql);
        return $this->connect->execute([$id, $order_id, $product_id, $variant_id, $quantity, $price, $total_price]);
    }

    public function historyOrder($user_id, $session_token)
    {
        $sql = " SELECT * FROM `orders` WHERE user_id = ? or session_token = ?";
        $this->connect->setQuery($sql);
        return $this->connect->loadData([$user_id, $session_token]);
    }
    public function detailOrder($order_id)
    {
        $sql = "SELECT 
                o.id AS order_id,
                o.created_at AS order_created_at,
                o.total_price AS order_total_price,
                o.total_items AS order_total_items,
                o.shipping_address AS order_shipping_address,
                o.shipping_city AS order_shipping_city,
                o.status AS order_status,
                p.payment_method AS payment_method,
                p.payment_status AS payment_status,
                pv.size AS product_variant_size,
                pr.name AS product_name,
                pr.main_image AS product_main_image,
                oi.quantity AS order_item_quantity,
                oi.price AS order_item_price,
                oi.total_price AS order_item_total_price
            FROM 
                orders o
            JOIN 
                payment p ON o.id = p.order_id
            JOIN 
                orderitem oi ON o.id = oi.order_id
            LEFT JOIN 
                productvariant pv ON oi.variant_id = pv.id
            JOIN 
                product pr ON oi.product_id = pr.id
            WHERE 
                o.id = ? ";
        $this->connect->setQuery($sql);
        return $this->connect->loadData([$order_id], true);
    }
    public function cancleOrder($status, $id)
    {
        $sql = "UPDATE `orders` SET `status`= ? WHERE id = ?";
        $this->connect->setQuery($sql);
        return $this->connect->loadData([$status, $id]);
    }
    public function getOrderById($id)
    {
        $sql = "SELECT * FROM `orders` WHERE id = ?";
        $this->connect->setQuery($sql);
        return $this->connect->loadData([$id],false);
    }
    public function getAllOrder()
    {
        $sql = "SELECT 
                orders.*, 
                payment.payment_method, 
                payment.payment_status
            FROM 
                orders
            LEFT JOIN 
                payment
            ON 
                orders.id = payment.order_id;
            ";
        $this->connect->setQuery($sql);
        return $this->connect->loadData();
    }
    
}


?>