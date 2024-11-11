<?php
include_once(__DIR__ . '/../model/danhmuc.php');
class danhmucController
{
    public function add(){
        if (isset($_POST['submit-add_danhmuc'])) {
            $name = $_POST['name'];
            $description=$_POST['description'];
            $created_at=$_POST['created_at'];
            $updated_at=$_POST['updated_at'];
            $mDanhmuc = new danhmuc();
            $add = $mDanhmuc->insert_danhmuc(null,$name,$description,$created_at,$updated_at );
            $thongbao = "Thêm thành công!";
            if(!$add) {
                header("location:index.php?act=list_danhmuc");
                }
        }
             require_once "../view/admin/danhmuc/add.php";
           }

    public function list_danhmuc(){
        $mDanhmuc = new danhmuc();
        $list = $mDanhmuc->all_danhmuc();
        require_once "../view/admin/danhmuc/list.php";
    }


    public function edit_danhmuc(){ 
        if(isset($_GET["id"])){
            $id=$_GET['id'];
            $mDanhmuc = new danhmuc();
            $danhmuc = $mDanhmuc->Data_danhmuc($id);
            if (isset($_POST['submit-editdm'])) {
                $name = $_POST['name'];
                $description = $_POST['description'];
                $created_at = $_POST['created_at'];
                $updated_at = $_POST['updated_at'];
                $mDanhmuc = new danhmuc();
                $edit = $mDanhmuc->update_danhmuc($name,$description,$created_at,$updated_at,$id);
             if(!$edit) {
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
                $delete = $mDanhmuc->delete_danhmuc($id);
                if (!$delete) {
                    header("location:index.php?act=list_danhmuc");
                }
            }
        }












}
?>