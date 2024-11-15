<?php
include_once(__DIR__ . '/../model/product.php');
include_once(__DIR__ . '/../model/danhmuc.php');

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
            $thongbao = "";

            $target_dir = "../images/";
            $target_img = $_FILES['image']['name'];
            $image = $target_dir . $target_img;
            move_uploaded_file($_FILES['image']['tmp_name'], $image);

            $mProduct = new Product();
            $add = $mProduct->insert_product(null, $name, $description, $category, $price, $available_stock, $sku, $status, $image);
            if (!$add) {
                $thongbao = "Thêm sản phẩm thành công!";
            }
        }
        $mDanhmuc = new danhmuc();
        $listCategory = $mDanhmuc->all_danhmuc();
        require_once "../view/admin/sanpham/addProduct.php";


    }

    public function listProduct()
    {
        $mProduct = new Product();
        $listProduct = $mProduct->list_product();
        $mDanhmuc = new danhmuc();
        $listCategory = $mDanhmuc->all_danhmuc();
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
    public function updateProduct()
    {
        if (isset($_GET['idProduct'])) {
            $id = $_GET['idProduct'];
            $mProduct = new Product();
            $productById = $mProduct->getProductById($id);

            if (isset($_POST['submit-updateProduct'])) {
                $name = $_POST['productName'];
                $description = $_POST['description'];
                $category = $_POST['category'];
                $base_price = $_POST['price'];
                $available_stock = $_POST['available_stock'];
                $sku = $_POST['sku'];
                $status = $_POST['status'];


                if ($_FILES['image']['name'] != null) {
                    $target_dir = "../images/";
                    $target_img = $_FILES['image']['name'];
                    $main_image = $target_dir . $target_img;
                    move_uploaded_file($_FILES['image']['tmp_name'], $main_image);
                } else {
                    $main_image = $productById->main_image;
                }

                $mProduct = new Product();
                $update = $mProduct->updateProduct($name, $description, $category, $base_price, $available_stock, $sku, $status, $main_image, $id);
                if (!$update) {
                    header("location:index.php?act=listProduct");
                }

            }
        }
        $mDanhmuc = new danhmuc();
        $listCategory = $mDanhmuc->all_danhmuc();
        require_once "../view/admin/sanpham/editProduct.php";

    }

    public function product_New()
    {
        $product = new Product();
        $listProductNew = $product->productNew();
        $listProducBirth = $product->productBirthday();
        require_once "./view/client/home.php";
    }

    public function sanPhamChiTiet()
    {
        $mProduct = new Product();
        if (isset($_GET['idPro'])) {
            $idPro = $_GET['idPro'];
            $sanphamchitiet = $mProduct->getProductById($idPro);
            $sizePro = $mProduct->getProductSize($idPro);
            // 4 sản phẩm cùng loại
            $category_id = $sanphamchitiet->category_id;
            $productRelate = $mProduct->productRelate($category_id, $idPro);
        }
        if (isset($_POST['submit-addCart']) && isset($_GET['idPro'])) {
            
            // lấy thông tin sản phẩm
            $mProduct = new Product();
            $idPro = $_GET['idPro'];
            $sanphamchitiet = $mProduct->getProductById($idPro);

            $price = $sanphamchitiet->base_price;
            $size = $_POST['variant'];         ///////
            $quantity = $_POST['quantity'];
            $cart_id = $_SESSION['cart_id'];
            $total_price = $quantity*$price;
            $mProduct = new Product();
            $variant_id = $mProduct->getVariantId($idPro, $size);
            
            if ($variant_id) {
                $variant_id = $variant_id->id;
    
                // Thêm sản phẩm vào giỏ hàng (cartItem)
                $mCartItem = new Cart();
                $addToCart = $mCartItem->addProductToCartItem(null, $cart_id, $variant_id, $quantity, $price, $total_price);
    
                if ($addToCart) {
                    $thongbao = "Sản phẩm đã được thêm vào giỏ hàng!";
                    header("location:index.php?act=cart");
                } else {
                    $thongbao = "Có lỗi khi thêm sản phẩm vào giỏ hàng!";
                }
            } else {
                $thongbao = "Không tìm thấy biến thể sản phẩm phù hợp!";
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
        $binhluan = new binhluan();
        $listbl = $binhluan->ID_binhluan_sanpham($_GET['idPro']) ;

        
        require_once "./view/client/sanphamchitiet.php";
    }

    public function list_Sanpham()
    {
        $mProduct = new Product();
        $mDanhmuc = new danhmuc();
        if (isset($_GET['iddm'])) {
            $iddm = $_GET['iddm'];
            $ProductBySelect = $mProduct->listProductByCategory($iddm);
            $danhmuc = $mDanhmuc->Data_danhmuc($iddm);
        }
        require_once "./view/client/listsanpham.php";
    }
    public function serchProduct()
    {
        $mDanhmuc = new danhmuc();
        $mProduct = new Product();
        if (isset($_POST['submit-search'])) {
            $keyword = $_POST['search'];
        } else {
            $keyword = "";
        }
        if (isset($_GET['iddm'])) {
            $iddm = $_GET['iddm'];
        } else {
            $iddm = "";
        }

        $sort = isset($_GET['sort']) ? $_GET['sort'] : "";

        $category = $mDanhmuc->getNameCategory($iddm);
        $listProduct = $mProduct->listProductByKeyword($keyword, $iddm, $sort);
        require_once "./view/client/listsanpham.php";
    }

    public function addVariant()
    {
        if (isset($_POST['submit-addVariant'])) {

            $product_id = $_POST['product_id'];
            $size = $_POST['size'];
            $price = $_POST['price'];
            $stock_quantity = $_POST['stock_quantity'];

            $mProduct = new Product();
            $variantExists = $mProduct->kiemTraTonTaiVariant($product_id, $size);
            if ($variantExists) {
                $thongbao = "Sản phẩm đã tồn tại biến thể này, không thể thêm!";
            } else {
                $addVariant = $mProduct->insertVariant(null, $product_id, $size, $price, $stock_quantity);
                if (!$addVariant) {
                    $thongbao = "Thêm biến thể thành công!";
                } 
            }
        }

        require_once "../view/admin/sanpham/addProductVariant.php";

    }

    public function listVariant()
    {
        $mProduct = new Product();
        $listVariant = $mProduct->listVariant();
        require_once "../view/admin/sanpham/listVariant.php";
    }
    public function deleteVariant()
    {
        if (isset($_GET['idVariant'])) {
            $idVariant = $_GET['idVariant'];
            $mProduct = new Product();
            $delete = $mProduct->deleteVariant($idVariant);
            if (!$delete) {
                header("location:index.php?act=listVariant");
            }
        }
    }

}

?>
