<?php
include_once(__DIR__ . '/../model/cart.php');
include_once(__DIR__ . '/../model/product.php');


class CartController
{
    public function listCart()
    {

        if (isset($_SESSION['cart_id'])) {
            $cart_id = $_SESSION['cart_id'];
            $mCart = new Cart();
            $cartItem = $mCart->getCartItems($cart_id);
        }
        // show thông tin ra giỏ hàng

        require_once "./view/client/cart.php";
    }
}
?>