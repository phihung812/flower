<?php
include_once(__DIR__ . '/../model/cart.php');
include_once(__DIR__ . '/../model/product.php');
include_once(__DIR__ . '/../model/init.php');



class CartController
{
    public function listCart()
    {
        // TH đã đăng nhập và chưa đăng nhập
        if (isset($_SESSION['cart_id'])) {
            $cart_id = $_SESSION['cart_id'];
            $mCart = new Cart();
            $cartItem = $mCart->getCartItems($cart_id);
            $cartAll = $mCart->getCart($cart_id);
        }else{
            $cart_id = $_COOKIE['cart_id'];
            $mCart = new Cart();
            $cartItem = $mCart->getCartItems($cart_id);
            $cartAll = $mCart->getCart($cart_id);
        }
        require_once "./view/client/cart.php";
    }

    public function deleteCartItem()
    {
        if (isset($_GET['cartItemId'])) {
            $cartItemId = $_GET['cartItemId'];
            $cart_id = isset($_SESSION['cart_id']) ? $_SESSION['cart_id']: $_COOKIE['cart_id'];
            $mCart = new Cart();
            $delete = $mCart->deleteCartItem($cartItemId);
            if ($delete) {

                $mCart->updateCartTotals($cart_id);
                header("location:index.php?act=cart");
                exit;
            }

        }

    }
    public function CreateCartNoAcc ()
    {
        $mInit = new Init();
        $mCart = new Cart();
        $idUser =  isset($_SESSION['user']->id)?$_SESSION['user']->id:null;
        $total_items = 0;
        $total_price = 0;
        // Kiểm tra xem giỏ hàng có tồn tại không
        $cartToken = $mInit->cartToken(); 
        $cart = $mCart->checkCart($cartToken, $idUser);
        if (!$cart) {
            // Nếu giỏ hàng chưa tồn tại, tạo mới
            $createCart =  $mCart->createCart(null, $idUser, $cartToken, $total_items, $total_price);  
            setcookie('cart_id', $createCart, time() + (30 * 24 * 60 * 60), '/');
        }     
    }
}
?>