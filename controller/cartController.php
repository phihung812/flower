<?php
include_once(__DIR__ . '/../model/cart.php');
include_once(__DIR__ . '/../model/product.php');


class CartController
{
    public function listCart()
    {
        require_once "./view/client/cart.php";
    }
    // cartItem
    // public function addProductToCartItem()
    // {
        
    //     if (isset($_POST['submit-addCart']) && isset($_GET['idPro'])) {
            
    //         // lấy thông tin sản phẩm
    //         $mProduct = new Product();
    //         $idPro = $_GET['idPro'];
    //         $sanphamchitiet = $mProduct->getProductById($idPro);

    //         $price = $sanphamchitiet->base_price;
    //         $size = $_POST['variant'];
    //         $quantity = $_POST['quantity'];
    //         $cart_id = $_SESSION['cart_id'];
    //         $total_price = $quantity*$price;
    //         $mProduct = new Product();
    //         $variant_id = $mProduct->getVariantId($idPro, $size);
            
    //         if ($variant_id) {
    //             $variant_id = $variant_id->id;
    
    //             // Thêm sản phẩm vào giỏ hàng (cartItem)
    //             $mCartItem = new Cart();
    //             $addToCart = $mCartItem->addProductToCartItem(null, $cart_id, $variant_id, $quantity, $price, $total_price);
    
    //             if (!$addToCart) {
    //                 $thongbao = "Sản phẩm đã được thêm vào giỏ hàng!";
    //                 header("location:index.php?act=cart");
    //             } else {
    //                 $thongbao = "Có lỗi khi thêm sản phẩm vào giỏ hàng!";
    //             }
    //         } else {
    //             $thongbao = "Không tìm thấy biến thể sản phẩm phù hợp!";
    //         }
            
            
            
    //     }
    //     require_once "./view/client/sanphamchitiet.php";
    // }

}
?>