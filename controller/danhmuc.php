<?php
include_once(__DIR__ . '/../model/danhmuc.php');

class danhmucController
{
    public function add()
    {
        if (isset($_POST['submit-add_danhmuc'])) {
            $name = $_POST['name'];
            $description = $_POST['description'];
            $thongbao = "";
            $mDanhmuc = new danhmuc();
            $add = $mDanhmuc->insert_danhmuc(null, $name, $description);
            $thongbao = "Thêm thành công!";
            if (!$add) {
                // header("location:index.php?act=list_danhmuc");
                $thongbao = "Thêm danh mục thành công";
            }
        }
        require_once "../view/admin/danhmuc/add.php";
    }

    public function list_danhmuc()
    {
        $mDanhmuc = new danhmuc();
        $list = $mDanhmuc->all_danhmuc();
        require_once "../view/admin/danhmuc/list.php";
    }
    public function list_menu()
    {
        $mDanhmuc = new danhmuc();
        $listMenu = $mDanhmuc->all_danhmuc();
        require_once "./view/client/header.php";
    }


    public function edit_danhmuc()
    {
        if (isset($_GET["id"])) {
            $id = $_GET['id'];
            $mDanhmuc = new danhmuc();
            $danhmuc = $mDanhmuc->Data_danhmuc($id);
            if (isset($_POST['submit-editdm'])) {
                $name = $_POST['name'];
                $description = $_POST['description'];
                $mDanhmuc = new danhmuc();
                $edit = $mDanhmuc->update_danhmuc($name, $description, $id);
                if (!$edit) {
                    header("location:index.php?act=list_danhmuc");
                }
            }
        }
        require_once "../view/admin/danhmuc/edit.php";
    }



    public function delete_danhmuc()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $mDanhmuc = new danhmuc();
            $checkDanhmuc = $mDanhmuc->checkCategory($id);
            $count = $checkDanhmuc[0]->{'COUNT(*)'}; //chuyển mảng về dạng int
            $thongbao = "";
            if ($count > 0) {
                $thongbao = "Không thể xóa danh mục vì vẫn còn sản phẩm trong danh mục này. Vui lòng xóa hết sản phẩm trước.";

            } else {
                $delete = $mDanhmuc->delete_danhmuc($id);
                if (!$delete) {
                    header("location:index.php?act=list_danhmuc");
                }
            }
        }
        $mDanhmuc = new danhmuc();
        $list = $mDanhmuc->all_danhmuc();
        require_once "../view/admin/danhmuc/list.php";
    }














}
?>