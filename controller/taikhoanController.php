<?php
session_start();
require_once(__DIR__ . '/../model/taikhoan.php');
require_once(__DIR__ . '/../model/cart.php');
require_once(__DIR__ . '/../model/init.php');



class TaikhoanController
{

    public function insert_taikhoan()
    {
        $mTaikhoan = new taikhoan();
        if (isset($_POST['submit-register'])) {

            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];
            $city = $_POST['city'];
            $password = $_POST['password'];
            $role = "customer";
            $total_items = 0;
            $total_price = 0;
            $allEmailList = $mTaikhoan->getAllEmails(); // Trả về mảng đa chiều
            $allEmail = array_column($allEmailList, 'email'); // Chuyển thành mảng đơn chứa email
            if (!in_array($email, $allEmail)) {
                $idUser = $mTaikhoan->insert_taikhoan(null, $first_name, $last_name, $email, $password, $phone, $address, $city, $role);
                if ($idUser > 0) {
                    $mCart = new Cart();
                    $create_cart = $mCart->createCart(null, $idUser, null, $total_items, $total_price);
                }
                if ($create_cart) {

                    echo "<script>
                        Swal.fire({
                            title: 'Thành công!',
                            text: 'Đăng ký thành công và mời bạn đăng nhập!',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = 'index.php?act=login';
                            }
                        });
                      </script>";
                } else {
                    $thongbao = "Đăng ký thành công, nhưng có lỗi khi tạo giỏ hàng!";
                }
            } else {
                echo '<script>
                            Swal.fire({
                                icon: "error", // Icon lỗi
                                title: "Lỗi!",
                                text: "Email đã tồn tại trong hệ thống",
                                confirmButtonText: "Thử lại"
                            });
                        </script>';
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
                    echo "<script>
                            Swal.fire({
                                title: 'Thành công!',
                                text: 'Đăng nhập thành công!',
                                icon: 'success',
                                confirmButtonText: 'OK'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = 'index.php';
                                }
                            });
                          </script>";
                    exit(); // Dừng việc xử lý tiếp theo
                }
            } else {
                $thongbao = "Email hoặc tên đăng nhập không đúng!";
            }
        }
        require_once "./view/client/login.php";
    }

    public function myAccount()
    {

        require_once "./view/client/myAccount.php";
    }
    public function editAccount()
    {
        $idAccount = $_SESSION['user']->id;
        $mTaikhoan = new Taikhoan();
        $account = $mTaikhoan->getTaikhoanById($idAccount);
        if (isset($_POST['submit-updateTaikhoan'])) {
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];
            $city = $_POST['city'];

            $mTaikhoan = new Taikhoan();
            $edit = $mTaikhoan->edit_Taikhoan($first_name, $last_name, $email, $phone, $address, $city, $idAccount);
            if (!$edit) {
                echo '<script type="text/javascript">
                        Swal.fire({
                            icon: "success",
                            title: "Thành công",
                            text: "Cập nhật tài khoản thành công!",
                            confirmButtonText: "OK"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = "index.php?act=myAccount";
                            }
                        });
                    </script>';
                exit();
            }

        }
        require_once "./view/client/editAccount.php";
    }
    public function rePassAccount()
    {
        $idAccount = $_SESSION['user']->id;
        $mTaikhoan = new Taikhoan();
        $account = $mTaikhoan->getTaikhoanById($idAccount);
        $passwordOld = $account->password;
        if (isset($_POST['submit-rePass'])) {
            $passOld = $_POST['passOld'];
            $passNew = $_POST['passNew'];
            if ($passOld === $passwordOld) {
                $edit = $mTaikhoan->rePass($passNew, $idAccount);
                if (!$edit) {
                    echo '<script type="text/javascript">
                    Swal.fire({
                        icon: "success",
                        title: "Thành công",
                        text: "Đổi mật khẩu thành công!",
                        confirmButtonText: "OK"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "index.php?act=myAccount";
                        }
                    });
                </script>';
                    exit();
                }
            } else {
                $thongbao = "Mật khẩu cũ không đúng!";
            }

        }
        require_once "./view/client/rePassAccount.php";
    }


    public function forgotPassword()
    {
        if (isset($_POST['submit-forgotPassword'])) {
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $mTaikhoan = new Taikhoan();
            $check = $mTaikhoan->checkForgotPassword($first_name, $last_name, $email, $phone);
            $_SESSION['confirmPassword'] = $check->id;
            if ($check) {
                echo '<script type="text/javascript">
                            Swal.fire({
                                icon: "success",
                                title: "Thành công",
                                text: "Thông tin chính xác mời đặt mật khẩu mới",
                                confirmButtonText: "OK"
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = "index.php?act=confirmPassword";
                                }
                            });
                        </script>';
                exit();
            } else {
                echo '<script type="text/javascript">
                            Swal.fire({
                                icon: "error",
                                title: "Thất bại",
                                text: "Thông tin không chính xác",
                                confirmButtonText: "OK"
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = "index.php?act=forgotPassword";
                                }
                            });
                        </script>';
                exit();
            }
        }
        require_once "./view/client/forgotPassword.php";
    }

    public function confirmPassword()
    {
        if(isset($_POST['submit-confirmPassword'])){
            $passwordNew = $_POST['passwordNew'];
            $passwordConfirm = $_POST['passwordConfirm'];
            $user_id = $_SESSION['confirmPassword'];
            unset($_SESSION['confirmPassword']);
            $mTaikhoan = new Taikhoan();
            if($passwordNew == $passwordConfirm){
                $confirmPass = $mTaikhoan->rePass($passwordConfirm, $user_id);
                if(!$confirmPass){
                    echo '<script type="text/javascript">
                            Swal.fire({
                                icon: "success",
                                title: "Thành công",
                                text: "Thông tin chính xác mời đặt mật khẩu mới",
                                confirmButtonText: "OK"
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = "index.php?act=login";
                                }
                            });
                        </script>';
                        exit();
                }
            }else{
                echo '<script type="text/javascript">
                    Swal.fire({
                        icon: "error",
                        title: "Thất bại",
                        text: "Xác nhận mật khẩu không khớp",
                        confirmButtonText: "OK"
                    }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = "index.php?act=forgotPassword";
                                }
                            });
                    </script>';
                    exit();
            }
            
        }
        require_once "./view/client/confirmPassword.php";
    }



}

?>