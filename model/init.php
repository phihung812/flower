<?php
class Init
{
    public function cartToken()
    {
        if (!isset($_COOKIE['cart_token'])) {
            // Tạo token ngẫu nhiên
            $cartToken = bin2hex(random_bytes(16));
            // Lưu token vào cookie (thời hạn 30 ngày)
            setcookie('cart_token', $cartToken, time() + (30 * 24 * 60 * 60), '/');
        } else {
            $cartToken = $_COOKIE['cart_token'];
        }

        return $cartToken;
    }
}
?>