<?php
require_once 'connect.php';

class ProductStatisticModel {
    private $db;

    public function __construct() {
        $this->db = new connect();
    }

    // Lấy danh sách sản phẩm với thống kê
    public function getProductStatistics() {
        $sql = "
            SELECT 
                p.id AS product_id,
                p.name AS product_name,
                c.name AS category_name,
                p.base_price AS price,
                IFNULL(SUM(oi.quantity), 0) AS sold_quantity,
                IFNULL(SUM(oi.total_price), 0) AS revenue,
                p.available_stock AS stock,
                IFNULL(SUM(ri.quantity), 0) AS return_quantity,
                IFNULL(SUM(ri.quantity) / SUM(oi.quantity), 0) AS return_rate
            FROM product p
            LEFT JOIN category c ON p.category_id = c.id
            LEFT JOIN orderitem oi ON p.id = oi.variant_id
            LEFT JOIN orderitem ri ON p.id = ri.variant_id AND ri.order_id IN (SELECT o.id FROM orders o WHERE o.status = 'canceled')
            GROUP BY p.id
            ORDER BY p.name
        ";

        $this->db->setQuery($sql);
        return $this->db->loadData();
    }
}
?>
