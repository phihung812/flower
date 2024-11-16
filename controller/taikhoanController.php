<?php
session_start();
require_once(__DIR__ . '/../model/taikhoan.php');
require_once(__DIR__ . '/../model/cart.php');


class TaikhoanController
{

    public function insert_taikhoan()
    {
        if (isset($_POST['submit-register'])) {

            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];
            $city = $_POST['city'];
            $password = $_POST['password'];
            $role = "customer";
            // giỏ hàng
            
            $total_items = 0;
            $total_price = 0;
            $mTaikhoan = new taikhoan();
            $idUser = $mTaikhoan->insert_taikhoan(null, $first_name, $last_name, $email, $password, $phone, $address, $city, $role);
            if ($idUser > 0) {
                $mCart = new Cart();
                $create_cart = $mCart->createCart(null, $idUser, $total_items, $total_price);
            }
            if ($create_cart) {
                $_SESSION['cart_id'] = $create_cart;
                $thongbao = "Đăng ký thành công và giỏ hàng đã được tạo!";
            } else {
                $thongbao = "Đăng ký thành công, nhưng có lỗi khi tạo giỏ hàng!";
            }


        }
        require_once "./view/client/register.php";
    }

    public function list_taikhoan()
    {
        $mTaikhoan = new taikhoan();
        $listTaikhoan = $mTaikhoan->getAllTaikhoan();
        require_once "../view/admin/taikhoan/listTaikhoan.php";
    }

    public function deleteTaikhoan()
    {
        if (isset($_GET['idTaikhoan'])) {
            $idTaikhoan = $_GET['idTaikhoan'];
            $mTaikhoan = new Taikhoan();
            $delete = $mTaikhoan->delete_Taikhoan($idTaikhoan);
            if (!$delete) {
                header("location:index.php?act=listTaikhoan");
            }
        }
    }

    public function updateTaikhoan()
    {
        if (isset($_GET["idTaikhoan"])) {
            $idTaikhoan = $_GET['idTaikhoan'];
            $mTaikhoan = new Taikhoan();
            $taikhoanById = $mTaikhoan->getTaikhoanById($idTaikhoan);
            if (isset($_POST['submit-updateTaikhoan'])) {
                $first_name = $_POST['first_name'];
                $last_name = $_POST['last_name'];
                $email = $_POST['email'];
                $phone = $_POST['phone'];
                $address = $_POST['address'];
                $city = $_POST['city'];
                $password = $_POST['password'];
                $role = $_POST['role'];

                $mTaikhoan = new Taikhoan();
                $edit = $mTaikhoan->update_Taikhoan($first_name, $last_name, $email, $password, $phone, $address, $city, $role, $idTaikhoan);
                if (!$edit) {
                    header("location:index.php?act=listTaikhoan");
                }
            }
        }
        require_once "../view/admin/taikhoan/editTaikhoan.php";
    }

    public function login()
    {
        if (isset($_POST['submit-login'])) {
            
            $email = $_POST['email'];
            $password = $_POST['password'];
            $mTaikhoan = new taikhoan();
            $checkTaikhoan = $mTaikhoan->checkTaikhoan($email, $password);

            if (is_object($checkTaikhoan)) {
                $_SESSION['user'] = $checkTaikhoan;
                $mCart = new Cart();
                $cart = $mCart->getCartIdByUserId($checkTaikhoan->id);
                if ($cart) {
                    // Lưu ID giỏ hàng vào session
                    $_SESSION['cart_id'] = $cart->id;
                    header('location:index.php');
                    
                }

            } else {
                $thongbao = "Email hoặc tên đăng nhập không đúng!";
            }
        }
        require_once "./view/client/login.php";
    }


}

?>