<?php
include_once(__DIR__ . '/../model/order.php');
include_once(__DIR__ . '/../model/taikhoan.php');
include_once(__DIR__ . '/../model/cart.php');


class OrderController
{
    public function inforOrder()
    {
        $mTaikhoan = new Taikhoan();
        $mOrder = new Order();
        $mCart = new Cart();
        $user_id = isset($_SESSION['user']) ? $_SESSION['user']->id : null;
        $user = $mTaikhoan->getTaikhoanById($user_id);

        $cart = $mCart->getCartIdByUserId($user_id);
        $cart_id = $cart->id;
        $cartItem = $mCart->getCartItems($cart_id);
        $cartAll = $mCart->getCart($cart_id);

        require_once "./view/client/payment.php";
    }
    public function createOrder()
    {
        $mTaikhoan = new Taikhoan();
        $mOrder = new Order();
        $mCart = new Cart();
        $user_id = isset($_SESSION['user']) ? $_SESSION['user']->id : null;
        $user = $mTaikhoan->getTaikhoanById($user_id);

        if (isset($_SESSION['user']) && $_SESSION['user']) {
            $cart = $mCart->getCartIdByUserId($user_id);
            $cart_id = $cart->id;
            $cartItem = $mCart->getCartItems($cart_id);
            $cartAll = $mCart->getCart($cart_id);

            if (isset($_POST['submit-payment'])) {
                // $cart_id = $cart->id;
                $inforCart = $mCart->getCart($cart_id);
                $total_price = $inforCart->total_price;
                $total_items = $inforCart->total_items;
                $shipping_address = $_POST['shipping_address'];
                $shipping_city = $_POST['shipping_city'];
                $name = $_POST['name'];
                $phone = $_POST['phone'];
                $email = $_POST['email'];
                $status = 'pending';
                $payment_method = $_POST['payment_method'];
                $payment_status = 'pending';
                $order_id = $mOrder->createOrder(null, $user_id, null, $name, $email, $phone, $cart_id, $total_items, $total_price, $shipping_address, $shipping_city, $status);

                if ($order_id > 1) {
                    $create_payment = $mOrder->createPayment(null, $order_id, $payment_method, $payment_status, $total_price);
                    $cartItems = $mCart->getCartItemsByCartId($cart_id); //danh sách sản phẩm trong giỏ
                    foreach ($cartItems as $item) {
                        $product_id = $item->product_id;
                        $variant_id = $item->variant_id;
                        $quantity = $item->quantity;
                        $price = $item->price;
                        $total_price = $item->total_price;
                        $addProductToOrderitem = $mOrder->InsertOrderitem(null, $order_id, $product_id, $variant_id, $quantity, $price, $total_price);
                    }
                    $deleteCartItems = $mCart->deleteCartItembyCartId($cart_id);

                    if ($deleteCartItems) {
                        echo '<script type="text/javascript">
                                const orderId = ' . json_encode($order_id) . ';
                                Swal.fire({
                                    icon: "success",
                                    title: "Thành công",
                                    text: "Đặt hàng thành công!",
                                    confirmButtonText: "OK"
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.href = "index.php?act=myAccount&check=detailOrder&order_id=" + orderId;
                                    }
                                });
                            </script>';
                        exit();

                    }
                }
            }
        } else {
            $cart_id = $_COOKIE['cart_id'];
            $session_token = $_COOKIE['cart_token'];
            $mCart = new Cart();
            $cartItem = $mCart->getCartItems($cart_id);
            $cartAll = $mCart->getCart($cart_id);

            if (isset($_POST['submit-payment'])) {
                $inforCart = $mCart->getCart($cart_id);
                $total_price = $inforCart->total_price;
                $total_items = $inforCart->total_items;
                $shipping_address = $_POST['shipping_address'];
                $shipping_city = $_POST['shipping_city'];
                $name = $_POST['name'];
                $phone = $_POST['phone'];
                $email = $_POST['email'];
                $status = 'pending';
                $payment_method = $_POST['payment_method'];
                $payment_status = 'pending';
                $order_id = $mOrder->createOrder(null, $user_id, $session_token, $name, $email, $phone, $cart_id, $total_items, $total_price, $shipping_address, $shipping_city, $status);

                if ($order_id > 1) {
                    $create_payment = $mOrder->createPayment(null, $order_id, $payment_method, $payment_status, $total_price);
                    $cartItems = $mCart->getCartItemsByCartId($cart_id); // $cartItems là danh sách sản phẩm trong giỏ
                    foreach ($cartItems as $item) {
                        $product_id = $item->product_id;
                        $variant_id = $item->variant_id;
                        $quantity = $item->quantity;
                        $price = $item->price;
                        $total_price = $item->total_price;
                        $addProductToOrderitem = $mOrder->InsertOrderitem(null, $order_id, $product_id, $variant_id, $quantity, $price, $total_price);
                    }

                    $deleteCartItems = $mCart->deleteCartItembyCartId($cart_id);
                    if ($deleteCartItems) {
                        echo '<script type="text/javascript">
                                const orderId = ' . json_encode($order_id) . ';
                                Swal.fire({
                                    icon: "success",
                                    title: "Thành công",
                                    text: "Đặt hàng thành công!",
                                    confirmButtonText: "OK"
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.href = "index.php?act=myAccount&check=detailOrder&order_id=" + orderId;
                                    }
                                });
                            </script>';
                        exit();
                    }
                }
            }
        }
        require_once "./view/client/payment.php";
    }


    public function historyOrder()
    {
        $mOrder = new Order();
        $user_id = isset($_SESSION['user']->id) ? $_SESSION['user']->id : null;
        $session_token = !isset($user_id) ? $_COOKIE['cart_token'] : null;
        $inforOrder = $mOrder->historyOrder($user_id, $session_token);
        require_once "./view/client/historyOrder.php";

    }
    public function detailOrder()
    {
        $mOrder = new Order();
        $order_id = $_GET['order_id'];
        $detailOrder = $mOrder->detailOrder($order_id);
        require_once "./view/client/detailOrder.php";
    }
    public function cancleOrder()
    {
        $mOrder = new Order();
        if (isset($_GET['order_id'])) {
            $order_id = $_GET['order_id'];
            $status = 'canceled';
            $order = $mOrder->getOrderById($order_id);
            $status_order = $order->status;
            if ($status_order == 'pending') {
                $cancle = $mOrder->cancleOrder($status, $order_id);
                if (!$cancle) {
                    echo '<script type="text/javascript">
                                Swal.fire({
                                    icon: "success",
                                    title: "Thành công",
                                    text: "Hủy đơn hàng thành công",
                                    confirmButtonText: "OK"
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.href = "index.php?act=myAccount&check=historyOrder";
                                    }
                                });
                            </script>';
                    exit();
                }
            } else {
                echo '<script type="text/javascript">
                                Swal.fire({
                                    icon: "error",
                                    title: "Thất bại",
                                    text: "Đơn hàng đang vận chuyển hoặc đã giao không thể hủy",
                                    confirmButtonText: "OK"
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.href = "index.php?act=myAccount&check=historyOrder";
                                    }
                                });
                            </script>';
                exit();
            }

        }

    }
    public function listOrder()
    {
        $mOrder = new Order();
        $listOrder = $mOrder->getAllOrder();
        require_once "../view/admin/donhang/listOrder.php";  
    }
}
?>