<?php
require_once "connect.php";

class SearchProduct extends connect {

    // Hàm tìm kiếm sản phẩm theo các tiêu chí: tên, giá tối thiểu, giá tối đa
    public function searchProducts($name = '', $minPrice = 0, $maxPrice = 0) {
        $sql = "SELECT * FROM product WHERE 1";

        $params = [];
        if (!empty($name)) {
            $sql .= " AND name LIKE ?";
            $params[] = "%" . $name . "%";
        }

        if ($minPrice > 0) {
            $sql .= " AND base_price >= ?";
            $params[] = $minPrice;
        }

        if ($maxPrice > 0) {
            $sql .= " AND base_price <= ?";
            $params[] = $maxPrice;
        }

        $this->setQuery($sql);
        return $this->loadData($params);
    }
}
?>
