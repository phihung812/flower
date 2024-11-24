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
        } else {
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
            $cart_id = isset($_SESSION['cart_id']) ? $_SESSION['cart_id'] : $_COOKIE['cart_id'];
            $mCart = new Cart();
            $delete = $mCart->deleteCartItem($cartItemId);
            if ($delete) {

                $mCart->updateCartTotals($cart_id);
                header("location:index.php?act=cart");
                exit;
            }

        }

    }
    public function updateCartItemClick()
    {
        $mCart = new Cart();
        $mProduct = new Product();
        if (isset($_POST['cartItemId']) && isset($_POST['quantity'])) {
            $quantity = $_POST['quantity'];
            $cartItemId = $_POST['cartItemId'];
            $cartItem = $mCart->getCartItemId($cartItemId);
            // Để lấy giá
            $idProduct = $cartItem->product_id;
            $product = $mProduct->getProductById($idProduct);
            $variant_id = isset($cartItem->variant_id) ? $cartItem->variant_id : null;
            $variant = $mProduct->getVariantById($variant_id);
            $price = isset($variant_id) ? $variant->price : $product->base_price;
            $total_price = $quantity * $price;

            $cart_id = isset($_SESSION['user']) ? $_SESSION['cart_id'] : $_COOKIE['cart_id'];

            $update = $mCart->updateCartItem($quantity, $total_price, $cart_id, $variant_id, $idProduct);
            if (!$update) {

                $mCart->updateCartTotals($cart_id);
                header("location:index.php?act=cart");
                exit;
            }

        }
    }
    // public function updateCartItem()
    // {
    //     if (isset($_GET['cartItemId'])) {
    //         $cartItemId = $_GET['cartItemId'];
    //         $cart_id = isset($_SESSION['cart_id']) ? $_SESSION['cart_id']: $_COOKIE['cart_id'];
    //         $mCart = new Cart();
    //         $delete = $mCart->deleteCartItem($cartItemId);
    //         if ($delete) {

    //             $mCart->updateCartTotals($cart_id);
    //             header("location:index.php?act=cart");
    //             exit;
    //         }

    //     }

    // }
    public function CreateCartNoAcc()
    {
        $mInit = new Init();
        $mCart = new Cart();
        // $idUser = isset($_SESSION['user']->id) ? $_SESSION['user']->id : null;
        $total_items = 0;
        $total_price = 0;
        $Token = $mInit->cartToken();
        $cart = $mCart->checkCart($Token);
        if (!$cart) {
            $createCart = $mCart->createCart(null, null, $Token, $total_items, $total_price);
            setcookie('cart_id', $createCart, time() + (30 * 24 * 60 * 60), '/');
        }
    }
}
?>