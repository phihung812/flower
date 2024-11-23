<?php
include_once(__DIR__ . '/../model/order.php');
include_once(__DIR__ . '/../model/taikhoan.php');
include_once(__DIR__ . '/../model/cart.php');


class OrderController
{

    public function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data)
            )
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        return $result;
    }



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
    public function handlePaymentCallback()
    {
        $mOrder = new Order();
        $order_id = $_SESSION['order_id'];
        unset($_SESSION['order_id']);
        $payment = $mOrder->getPaymentByOrderId($order_id);
        $payment_id = $payment->id;
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $data = $_GET;
            // Kiểm tra chữ ký MoMo
            $partnerCode = 'MOMOBKUN20180529';
            $accessKey = 'klm05TvNBzhg7h7j';
            $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';

            $rawHash = "accessKey=" . $accessKey . "&amount=" . $data['amount'] . "&extraData=" . $data['extraData'] . "&message=" . $data['message'] . "&orderId=" . $data['orderId'] . "&orderInfo=" . $data['orderInfo'] . "&orderType=" . $data['orderType'] . "&partnerCode=" . $data['partnerCode'] . "&payType=" . $data['payType'] . "&requestId=" . $data['requestId'] . "&responseTime=" . $data['responseTime'] . "&resultCode=" . $data['resultCode'] . "&transId=" . $data['transId'];
            $signature = hash_hmac("sha256", $rawHash, $secretKey);

            if ($signature === $data['signature']) {  //kiểm tra chữ kí hợp lệ không

                if ($data['resultCode'] == 0) { // Thanh toán thành công
                    $mOrder->updatePaymentStatus('completed', $payment_id);
                } else {
                    $mOrder->updateOrderStatus('canceled', $order_id);
                    $mOrder->updatePaymentStatus('failed', $payment_id);
                }
                header('Location: index.php?act=myAccount&check=detailOrder&order_id=' . $order_id);
                exit();
            } else {
                echo '<script>alert("Xác thực giao dịch thất bại!");</script>';
            }
        }
    }

    public function createOrder()
    {
        $mTaikhoan = new Taikhoan();
        $mOrder = new Order();
        $mCart = new Cart();
        $user_id = isset($_SESSION['user']) ? $_SESSION['user']->id : null;
        $session_token = $_COOKIE['cart_token'];
        $user = $mTaikhoan->getTaikhoanById($user_id);      //lây thông tin người dùng đổ ra thanh toán
        // $cart = $mCart->getCartIdByUserId($user_id);

        $cart_id = isset($_SESSION['user']) ? $_SESSION['cart_id'] : $_COOKIE['cart_id'];         
        $cartItem = $mCart->getCartItems($cart_id);
        $cartAll = $mCart->getCart($cart_id);

        if (isset($_POST['submit-payment'])) {
            $inforCart = $mCart->getCart($cart_id);
            $total_price_order = $inforCart->total_price;
            $total_items = $inforCart->total_items;
            $shipping_address = $_POST['shipping_address'];
            $shipping_city = $_POST['shipping_city'];
            $name = $_POST['name'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];
            $payment_method = $_POST['payment_method'];

            if ($payment_method === 'online') {
                $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
                $partnerCode = 'MOMOBKUN20180529';
                $accessKey = 'klm05TvNBzhg7h7j';
                $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';

                $orderInfo = "Thanh toán qua MoMo";
                $amount = $total_price_order;
                $orderId = time() . "";
                $redirectUrl = "http://localhost/Duan01/index.php?act=thanhcong&method=handlePaymentCallback";
                $ipnUrl = "http://localhost/Duan01/index.php?act=thanhcong&method=handlePaymentCallback";
                $extraData = "";

                $requestId = time() . "";
                $requestType = "payWithATM";
                $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
                $signature = hash_hmac("sha256", $rawHash, $secretKey);
                $data = array(
                    'partnerCode' => $partnerCode,
                    'partnerName' => "Test",
                    "storeId" => "MomoTestStore",
                    'requestId' => $requestId,
                    'amount' => $amount,
                    'orderId' => $orderId,
                    'orderInfo' => $orderInfo,
                    'redirectUrl' => $redirectUrl,
                    'ipnUrl' => $ipnUrl,
                    'lang' => 'vi',
                    'extraData' => $extraData,
                    'requestType' => $requestType,
                    'signature' => $signature
                );
                $result = $this->execPostRequest($endpoint, json_encode($data));
                $jsonResult = json_decode($result, true);

                $status = 'pending';
                $order_id = $mOrder->createOrder(null, $user_id, $session_token, $name, $email, $phone, $cart_id, $total_items, $total_price_order, $shipping_address, $shipping_city, $status);
                $_SESSION['order_id'] = $order_id;
                if ($order_id > 1) {
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
                }
                $payment_status = 'pending';
                $create_payment = $mOrder->createPayment(null, $order_id, $payment_method, $payment_status, $total_price_order);

                header('location: ' . $jsonResult['payUrl']);

            } else { //TH thanh toán COD
                $status = 'pending';
                $order_id = $mOrder->createOrder(null, $user_id, $session_token, $name, $email, $phone, $cart_id, $total_items, $total_price_order, $shipping_address, $shipping_city, $status);

                if ($order_id > 1) {
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
                }
                $payment_status = 'pending';
                $create_payment = $mOrder->createPayment(null, $order_id, $payment_method, $payment_status, $total_price_order);
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
            $payment = $mOrder->getPaymentByOrderId($order_id);
            $payment_status = $payment->payment_status;
            if ($status_order == 'pending' && $payment_status !== 'completed') {
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
            } elseif ($status_order == 'pending' && $payment_status == 'completed') {
                $cancle = $mOrder->cancleOrder($status, $order_id);
                if (!$cancle) {
                    echo '<script type="text/javascript">
                                Swal.fire({
                                    icon: "success",
                                    title: "Thành công",
                                    text: "Hủy thành công. Bạn sẽ được hoàn tiền vào tài khoản",
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