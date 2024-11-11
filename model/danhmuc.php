<?php
require_once "connect.php";
class danhmuc
{
    public $connect;
    public function __construct()
    {
        $this->connect = new Connect();
    }

public function all_danhmuc(){
    $sql="SELECT * FROM `category`";
    $this->connect->setQuery($sql);
    return  $this->connect->loadData();
}
public function Data_danhmuc($id){
    $sql="SELECT * FROM `category` WHERE id=?";
    $this->connect->setQuery($sql);
    return  $this->connect->loadData([$id],false);
  }
  public function Insert_danhmuc($id,$name,$description,$created_at,$updated_at){
    $sql="INSERT INTO `category` VALUES (?,?,?,?,?)";
    $this->connect->setQuery($sql);
  return  $this->connect->execute([$id,$name,$description,$created_at,$updated_at]);
 }
 public function update_danhmuc($name,$description,$created_at,$updated_at,$id){
    $sql=" UPDATE `category` SET `name`=?,`description`=?,`created_at`=?,`updated_at`=? WHERE  `id`=?";
    $this->connect->setQuery($sql);
   return  $this->connect->loadData([$name,$description,$created_at,$updated_at,$id]);
 }
   
    public function delete_danhmuc($id){
        $sql = "DELETE FROM `category` WHERE id = ?";
        $this->connect->setQuery($sql);
        return $this->connect->loadData([$id],false);
      }
         
   }


















