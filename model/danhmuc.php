<?php
require_once "connect.php";
class danhmuc
{
  public $connect;
  public function __construct()
  {
    $this->connect = new Connect();
  }

  public function all_danhmuc()
  {
    $sql = "SELECT * FROM `category`";
    $this->connect->setQuery($sql);
    return $this->connect->loadData();
  }
  public function Data_danhmuc($id)
  {
    $sql = "SELECT * FROM `category` WHERE id=?";
    $this->connect->setQuery($sql);
    return $this->connect->loadData([$id], false);
  }

  public function Insert_danhmuc($id, $name, $description)
  {
    $sql = "INSERT INTO `category` (id, name, description) VALUES (?,?,?)";
    $this->connect->setQuery($sql);
    return $this->connect->execute([$id, $name, $description]);
  }

  public function update_danhmuc($name, $description, $id)
  {
    $sql = "UPDATE `category` SET `name`=?, `description`=? WHERE `id`=?";
    $this->connect->setQuery($sql);
    return $this->connect->loadData([$name, $description, $id]);
  }


  public function delete_danhmuc($id)
  {
    $sql = "DELETE FROM `category` WHERE id = ?";
    $this->connect->setQuery($sql);
    return $this->connect->loadData([$id], false);
  }
  public function checkCategory($id)
  {
    $sql = "SELECT COUNT(*) FROM `product` WHERE `category_id` = ?";
    $this->connect->setQuery($sql);
    return $this->connect->loadData([$id]);
  }
  public function getNameCategory($iddm)
    {
        if ($iddm > 0) {
            $sql = "SELECT * FROM `category` WHERE id = ?";
            $this->connect->setQuery($sql);
            return $this->connect->loadData([$iddm], false);
        } else {
            return "";
        }
    }
  

}


















