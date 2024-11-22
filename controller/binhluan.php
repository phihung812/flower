<?php
include_once(__DIR__ . '/../model/binhluan.php');
class binhluancontronler
{
public function binhluan(){
    $binhluan=new binhluan();
    $list=$binhluan->all_binhluan();
    require_once "../view/admin/binhluan/list.php";
}
public function delete(){
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $mdelete = new binhluan();
    $delete = $mdelete->delete_binhluan($id);
 if(!$delete){
    header("location:index.php?act=binhluan");
 }
}
require_once "../view/admin/binhluan/list.php";
}
}