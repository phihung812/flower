<?php
require_once "connect.php";

class CategoryModel extends connect {
    // Lấy danh sách thống kê số lượng sản phẩm theo danh mục
    public function getCategoryStatistics() {
        $sql = "
            SELECT 
                c.id, 
                c.name, 
                COUNT(p.id) AS total_products, 
                MIN(p.base_price) AS min_price, 
                MAX(p.base_price) AS max_price, 
                ROUND(AVG(p.base_price), 2) AS avg_price
            FROM category c
            LEFT JOIN product p ON c.id = p.category_id
            GROUP BY c.id, c.name
            ORDER BY total_products DESC;
        ";
        $this->setQuery($sql);
        return $this->loadData();
    }
}
?>
