<?php
require_once "connect.php";
class Banner
{
    public $connect;
    public function __construct()
    {
        $this->connect = new Connect();
    }
    public function addImageBanner($id, $image)
    {
        $sql = "INSERT INTO `imageslide` (id, image) VALUES (?,?)";
        $this->connect->setQuery($sql);
        return $this->connect->loadData([$id, $image]);
    }
    public function allBanner()
    {
        $sql = "SELECT * FROM `imageslide`";
        $this->connect->setQuery($sql);
        return $this->connect->loadData();
    }
    public function deleteBanner($id)
    {
        $sql = "DELETE FROM `imageslide` WHERE id = ?";
        $this->connect->setQuery($sql);
        return $this->connect->loadData([$id], false);
    }
    public function getBannerById($id)
    {
        $sql = "SELECT * FROM `imageslide` WHERE id = ?";
        $this->connect->setQuery($sql);
        return $this->connect->loadData([$id], false);
    }
    public function updateBanner($image, $id)
    {
        $sql = "UPDATE `imageslide` SET `image`=? WHERE `id`=?";
        $this->connect->setQuery($sql);
        return $this->connect->loadData([$image, $id]);
    }
    public function imgBanner()
    {
        $sql = "SELECT image FROM `imageslide`";
        $this->connect->setQuery($sql);
        return $this->connect->loadData();
    }
}
?>