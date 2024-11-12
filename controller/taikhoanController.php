<?php
require_once(__DIR__ . '/../model/taikhoan.php');

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

            $mTaikhoan = new taikhoan();
            $add = $mTaikhoan->insert_taikhoan(null, $first_name, $last_name, $email, $password, $phone, $address, $city, $role);
            if (!$add) {
                $thongbao = "Đăng ký thành công!";
            } else {
                $thongbao = "";
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


}

?>