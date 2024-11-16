<?php
require_once "connect.php";
class binhluan
{
  public $connect;
  public function __construct()
  {
    $this->connect = new Connect();
  }

  public function all_binhluan(){
    $sql = "SELECT * FROM `productreview`";
    $this->connect->setQuery($sql);
    return $this->connect->loadData();
  }
  public function ID_binhluan($id){
    $sql = "SELECT * FROM `productreview` WHERE id=?";
    $this->connect->setQuery($sql);
    return $this->connect->loadData([$id], false);
  }
  public function ID_binhluan_sanpham($product_id){
    $sql = "SELECT * FROM `productreview` WHERE product_id=?";
    $this->connect->setQuery($sql);
    return $this->connect->loadData([$product_id]);
  }
  public function Insert_binhluan($id, $product_id, $user_id, $rating, $comment, $created_at, $updated_at){
    $sql="INSERT INTO `productreview` VALUES (?,?,?,?,?,?,?)";
    $this->connect->setQuery($sql);
    return $this->connect->execute([$id, $product_id, $user_id, $rating, $comment, $created_at, $updated_at]);
  }
  public function delete_binhluan($id){
    $sql = "DELETE FROM `productreview` WHERE id = ?";
    $this->connect->setQuery($sql);
    return $this->connect->loadData([$id], false);
  }

  

}








