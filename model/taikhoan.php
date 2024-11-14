<?php
require_once "connect.php";
class Taikhoan
{
    public $connect;
    public function __construct()
    {
        $this->connect = new Connect();
    }
    
    public function insert_taikhoan($id ,$first_name,$last_name ,$email ,$password ,$phone ,$address, $city, $role ){
        $sql = "INSERT INTO `user` (id, first_name, last_name, email, password, phone, address, city, role) VALUES (?,?,?,?,?,?,?,?,?)";
        $this->connect->setQuery($sql);
        $this->connect->loadData([$id ,$first_name,$last_name , $email ,$password ,$phone ,$address ,$city, $role]);
        return $this->connect->lastInsertId();
    }
    public function getAllTaikhoan(){
        $sql = "SELECT * FROM `user` ORDER BY id desc";
        $this->connect->setQuery($sql);
        return $this->connect->loadData();
    }
    public function delete_Taikhoan($id){
        $sql = "DELETE FROM `user` WHERE id =?";
        $this->connect->setQuery($sql);
        return $this->connect->loadData([$id],false);
    }
    public function getTaikhoanById($id)
    {
        $sql = "SELECT * FROM `user` WHERE id = ?";
        $this->connect->setQuery($sql);
        return $this->connect->loadData([$id], false);
    }
    public function update_Taikhoan($first_name ,$last_name ,$email ,$password ,$phone ,$address ,$city ,$role, $id){
        $sql = "UPDATE `user` SET `first_name`=?,`last_name`=?,`email`=?,`password`=?,`phone`=?,`address`=?,`city`=?,`role`=? WHERE `id`=?";
        $this->connect->setQuery($sql);
        return $this->connect->loadData([$first_name ,$last_name ,$email ,$password ,$phone ,$address ,$city ,$role, $id ],false);
    }
    public function checkTaikhoan($email,$pass ){
        $sql = "SELECT * FROM `user` WHERE `email`= ? and `password` = ?";
        $this->connect->setQuery($sql);
        return $this->connect->loadData([$email,$pass],false);
    }
    
}

?>