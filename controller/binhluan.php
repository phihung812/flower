<?php
include_once (__DIR__ . '/../model/binhluan.php');
class binhluanController
{
    public function list_binhluan()
    {
        $binhluan = new binhluan();
        $list = $binhluan->all_binhluan();
        require_once "../view/admin/binhluan/list.php";

    }
    public function chitiet_binhluan()
    {
        $id = $_GET['id'];
        $binhluan = new binhluan();
        $chitiet_binhluan = $binhluan->ID_binhluan($id);
        require_once "../view/admin/binhluan/chitiet_bl.php";

    }
    public function delete_binhluan(){
  if(isset($_GET['id'])){
    $id=$_GET['id'];
    $mbinhluan=new binhluan();
    $delete=$mbinhluan->delete_binhluan($id);
    if (!$delete) {
        header("location:index.php?act=list_bl");
    }

  }
  require_once "../view/admin/binhluan/list.php";
    
}
}

        ////////// binhluan
        // if (isset($_POST['submit-bl'])) {
        //     $nameuser = $_SESSION['user']->user;
        //     $noidung = $_POST['noidung'];
        //     $ngaybl = date("y-m-d");
        //     $binhluan = new binhluan();
        //     $binhluan->Insert_binhluan(null,  $product_id, $user_id, $rating, $comment, $created_at, $updated_at);
        // }
        // $binhluan = new binhluan();
        // $listbl = $binhluan->all_binhluan() ;