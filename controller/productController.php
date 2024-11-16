<?php
include_once(__DIR__ . '/../model/product.php');
include_once(__DIR__ . '/../model/danhmuc.php');
include_once(__DIR__ . '/../model/cart.php');

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
        $mProduct = new Product();
        $listProduct = $mProduct->list_product();
        $mDanhmuc = new danhmuc();
        $listCategory = $mDanhmuc->all_danhmuc();

        if (isset($_GET['idProduct'])) {
            $idProduct = $_GET['idProduct'];
            $mProduct = new Product();
            $checkPro = $mProduct->checkProduct($idProduct);
            $count = $checkPro[0]->{'COUNT(*)'}; //chuyển mảng về dạng int
            $thongbao = "";
            if ($count > 0) {
                $thongbao = "Không thể xóa, sản phẩm này đã tồn tại trong giỏ hàng!";

            } else {
                $delete = $mProduct->deleteProduct($idProduct);
                if (!$delete) {

                    header("location:index.php?act=listProduct");
                }
            }

        }
        require_once "../view/admin/sanpham/listProduct.php";
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

            $size = isset($_POST['size']) ? $_POST['size'] : null;
            $quantity = $_POST['quantity'];
            $cart_id = $_SESSION['cart_id'];
            $mProduct = new Product();
            $variant = $mProduct->getVariantId($idPro, $size);
            $variant_id = ($variant && is_object($variant)) ? $variant->id : null;
            if ($variant_id) {
                $price = $variant->price;
            } else {
                $price = $sanphamchitiet->base_price;
            }
            $total_price = $quantity * $price;
            // TH có biến thể và không có biến thể
            if ($variant_id) {
                // $variant_id = $variant_id->id;
                // kiểm tra sản phẩm có trong giỏ hàng hay chưa
                $mCart = new Cart();
                $checkCartItem = $mCart->checkCartItem($cart_id, $variant_id);
                // nêu có trong giỏ hàng
                if ($checkCartItem) {
                    $newQuantity = $checkCartItem->quantity + $quantity;
                    $newTotalPrice = $checkCartItem->total_price + $total_price;
                    $mCart->updateCartItem($newQuantity, $newTotalPrice, $cart_id, $variant_id);
                    header('location:index.php?act=cart');
                } else {
                    // thêm mới sản phẩm vào giỏ hàng
                    $addToCart = $mCart->addProductToCartItem(null, $cart_id, $idPro, $variant_id, $quantity, $price, $total_price);
                    header('location:index.php?act=cart');

                }
                // cập nhật lại giỏ hàng
                $mCart->updateCartTotals($cart_id);
            } else {
                $mCart = new Cart();
                $checkCartItem = $mCart->checkCartItem0($cart_id, $idPro);
                if ($checkCartItem) {
                    $newQuantity = $checkCartItem->quantity + $quantity;
                    $newTotalPrice = $checkCartItem->total_price + $total_price;
                    $mCart->updateCartItem0($newQuantity, $newTotalPrice, $cart_id, $idPro);
                    // header('location:index.php?act=cart');
                } else {
                    // thêm mới sản phẩm vào giỏ hàng
                    $addToCart = $mCart->addProductToCartItem(null, $cart_id, $idPro, $variant_id, $quantity, $price, $total_price);
                    // header('location:index.php?act=cart');

                }
                // cập nhật lại giỏ hàng
                $mCart->updateCartTotals($cart_id);
            }

        }
        require_once "./view/client/sanphamchitiet.php";
    }

    // public function list_Sanpham()
    // {
    //     $mProduct = new Product();
    //     $mDanhmuc = new danhmuc();
    //     if (isset($_GET['iddm'])) {
    //         $iddm = $_GET['iddm'];
    //         $ProductBySelect = $mProduct->listProductByCategory($iddm);
    //         $danhmuc = $mDanhmuc->Data_danhmuc($iddm);
    //     }
    //     require_once "./view/client/listsanpham.php";
    // }
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