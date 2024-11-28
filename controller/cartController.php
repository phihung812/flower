<?php
include_once(__DIR__ . '/../model/cart.php');
include_once(__DIR__ . '/../model/product.php');
include_once(__DIR__ . '/../model/init.php');



class CartController
{
    public function listCart()
    {
        $cart_id = isset($_SESSION['cart_id']) ? $_SESSION['cart_id'] : $_COOKIE['cart_id'];
        $mCart = new Cart();
        $mProduct = new Product();
        $cartItem = $mCart->getCartItems($cart_id);
        $cartAll = $mCart->getCart($cart_id);

        foreach ($cartItem as $cart) {
            $product_id = $cart->product_id;
            $variant_id = $cart->variant_id;
            $variant = isset($variant_id) ? $mProduct->getVariantById($variant_id) : null;
            $product = !isset($variant) ? $mProduct->getProductById($product_id) : null;

            // Gắn thông tin tồn kho
            $cart->available_stock = $product ? $product->available_stock : null; 
            $cart->stock_quantity = $variant ? $variant->stock_quantity : null;   
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

            if ($quantity <= $product->available_stock || (isset($variant) && is_object($variant) && $quantity <= $variant->stock_quantity)) {
                $cart_id = isset($_SESSION['user']) ? $_SESSION['cart_id'] : $_COOKIE['cart_id'];
                $update = $mCart->updateCartItem($quantity, $total_price, $cart_id, $variant_id, $idProduct);
                if (!$update) {

                    $mCart->updateCartTotals($cart_id);
                    header("location:index.php?act=cart");
                    exit;
                }
            } else {
                echo "<script>
                            const Toast = Swal.mixin({
                                toast: false,
                                position: 'top-right',
                                showConfirmButton: false,
                                timer: 2000,
                                timerProgressBar: true,
                                customClass: {
                                    popup: 'small-toast'  
                                },
                                didOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal.stopTimer);
                                    toast.addEventListener('mouseleave', Swal.resumeTimer);
                                }
                            });

                            Toast.fire({
                                imageUrl: 'https://img.pikbest.com/png-images/qiantu/shopping-cart-icon-png-free-image_2605207.png!sw800', 
                                imageWidth: 80, 
                                imageHeight: 80, 
                                title: 'Số lượng sản phẩm trong kho không đủ'
                            });

                            setTimeout(function() {
                                window.location.href = 'index.php?act=cart'; 
                            }, 2000); 
                        </script>";

            }

        }
    }

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