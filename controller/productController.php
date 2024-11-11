<?php
include_once(__DIR__ . '/../model/product.php');

class ProductController
{
    public function addProduct()
    {
        if (isset($_POST['submit-addProduct'])) {

            $name = $_POST['productName'];
            $description = $_POST['description'];
            $category = $_POST['category'];
            $price = $_POST['price'];
            $available_stock = $_POST['available_stock'];
            $sku = $_POST['sku'];
            $status = $_POST['status'];
            $create_at = date('Y-m-d H:i:s');
            $update_at = date('Y-m-d H:i:s');

            $target_dir = "../images/";
            $target_img = $_FILES['image']['name'];
            $image = $target_dir . $target_img;
            move_uploaded_file($_FILES['image']['tmp_name'], $image);

            $mProduct = new Product();
            $add = $mProduct->insert_product(null, $name, $description, null, $price, $available_stock, $sku, $status, $image, $create_at, $update_at);
            if (!$add) {
                $thongbao = "Thêm sản phẩm thành công!";
            }
        }
        require_once "../view/admin/sanpham/addProduct.php";


    }

    public function listProduct()
    {
        $mProduct = new Product();
        $listProduct = $mProduct->list_product();
        require_once "../view/admin/sanpham/listProduct.php";
    }

    public function deleteProduct()
    {
        if (isset($_GET['idProduct'])) {
            $idProduct = $_GET['idProduct'];
            $mProduct = new Product();
            $delete = $mProduct->deleteProduct($idProduct);
            if (!$delete) {
                header("location:index.php?act=listProduct");
            }
        }
    }
}

?>