<?php
include_once(__DIR__ . '/../model/banner.php');
class BannerController
{
    public function addBanner()
    {
        if (isset($_POST['submit-addBanner'])) {

            $target_dir = "../images/";
            $target_img = $_FILES['image']['name'];
            $image = $target_dir . $target_img;
            move_uploaded_file($_FILES['image']['tmp_name'], $image);
            $mBanner = new Banner();
            $add = $mBanner->addImageBanner(null, $image);
            if (!$add) {
                $thongbao = "Thêm banner thành công!";
            }
        }
        require_once "../view/admin/banner/addBanner.php";


    }
    public function listBanner()
    {
        $mBanner = new Banner();
        $listBanner = $mBanner->allBanner();
        require_once "../view/admin/banner/listBanner.php";
    }
    public function updateBanner()
    {
        if (isset($_GET['idBanner'])) {
            $idBanner = $_GET['idBanner'];
            $mBanner = new Banner();
            $bannerById = $mBanner->getBannerById($idBanner);

            if (isset($_POST['submit-updateBanner'])) {
                if ($_FILES['image']['name'] != null) {
                    $target_dir = "../images/";
                    $target_img = $_FILES['image']['name'];
                    $image = $target_dir . $target_img;
                    move_uploaded_file($_FILES['image']['tmp_name'], $image);
                } else {
                    $main_image = $bannerById->image;
                }

                $update = $mBanner->updateBanner($image, $idBanner);
                if (!$update) {
                    header("location:index.php?act=listBanner");
                }

            }
        }
        require_once "../view/admin/banner/editBanner.php";

    }
    public function deleteBanner()
    {
        $mBanner = new Banner();
        if (isset($_GET['idBanner'])) {
            $idBanner = $_GET['idBanner'];
            $delete = $mBanner->deleteBanner($idBanner);
            if (!$delete) {
                header("location:index.php?act=listBanner");
            }
        }
    }


}
?>