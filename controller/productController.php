<?php
include_once(__DIR__ . '/../model/product.php');
include_once(__DIR__ . '/../model/danhmuc.php');
include_once(__DIR__ . '/../model/cart.php');
include_once(__DIR__ . '/../model/init.php');
include_once(__DIR__ . '/../model/banner.php');
include_once(__DIR__ . '/../model/binhluan.php');


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
        $mBanner = new Banner();
        $bannerArray = $mBanner->imgBanner();
        $banner = json_encode($bannerArray);

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
            $idPro = $_GET['idPro'];
            $sanphamchitiet = $mProduct->getProductById($idPro);
            $size = isset($_POST['size']) ? $_POST['size'] : null;
            $quantity = $_POST['quantity'];

            $cart_id = isset($_SESSION['user']) ? $_SESSION['cart_id'] : $_COOKIE['cart_id'];
            $variant = $mProduct->getVariantId($idPro, $size);
            $variant_id = ($variant && is_object($variant)) ? $variant->id : null;
            $price = $variant_id ? $variant->price : $sanphamchitiet->base_price;
            $total_price = $quantity * $price;

            if ($quantity < $sanphamchitiet->available_stock || (isset($variant) && is_object($variant) && $quantity < $variant->stock_quantity)) {
                // kiểm tra sản phẩm có trong giỏ hàng hay chưa
                $mCart = new Cart();
                $checkCartItem = $mCart->checkCartItem($cart_id, $variant_id, $idPro);
                // nêu có trong giỏ hàng
                if ($checkCartItem) {
                    $newQuantity = $checkCartItem->quantity + $quantity;
                    $newTotalPrice = $checkCartItem->total_price + $total_price;
                    $mCart->updateCartItem($newQuantity, $newTotalPrice, $cart_id, $variant_id, $idPro);
                    echo "<script>
                            const Toast = Swal.mixin({
                                toast: false,
                                position: 'top-right',
                                showConfirmButton: false,
                                timer: 800,
                                timerProgressBar: false,
                                customClass: {
                                popup: 'small-toast'  
                            },
                                didOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal.stopTimer);
                                    toast.addEventListener('mouseleave', Swal.resumeTimer);
                                }
                            });

                            Toast.fire({
                                 imageUrl: 'https://png.pngtree.com/element_our/20190522/ourlarge/pngtree-shopping-cart-icon-design-image_1071385.jpg', 
                                imageWidth: 60, 
                                imageHeight: 60, 
                                title: 'Đã cập nhật sản phẩm trong giỏ hàng'
                            });
                        </script>";
                } else {
                    // thêm mới sản phẩm vào giỏ hàng
                    $addToCart = $mCart->addProductToCartItem(null, $cart_id, $idPro, $variant_id, $quantity, $price, $total_price);
                    echo "<script>
                                const Toast = Swal.mixin({
                                    toast: false,
                                    position: 'top-right',
                                    showConfirmButton: false,
                                    timer: 800,
                                    timerProgressBar: false,
                                    customClass: {
                                    popup: 'small-toast'  
                                },
                                    didOpen: (toast) => {
                                        toast.addEventListener('mouseenter', Swal.stopTimer);
                                        toast.addEventListener('mouseleave', Swal.resumeTimer);
                                    }
                                });

                                Toast.fire({
                                    imageUrl: 'https://png.pngtree.com/element_our/20190522/ourlarge/pngtree-shopping-cart-icon-design-image_1071385.jpg', 
                                    imageWidth: 60, 
                                    imageHeight: 60, 
                                    title: 'Đã thêm sản phẩm trong giỏ hàng'
                                });
                            </script>";

                }
                // cập nhật lại giỏ hàng
                $mCart->updateCartTotals($cart_id);
            } else {
                echo "<script>
                            const Toast = Swal.mixin({
                                toast: false,
                                position: 'top-right',
                                showConfirmButton: false,
                                timer: 2000,
                                timerProgressBar: true,
                                customClass: {
                                popup: 'small-toast'  
                            },
                                didOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal.stopTimer);
                                    toast.addEventListener('mouseleave', Swal.resumeTimer);
                                }
                            });
                            Toast.fire({
                                 imageUrl: 'https://img.pikbest.com/png-images/qiantu/shopping-cart-icon-png-free-image_2605207.png!sw800', 
                                imageWidth: 80, 
                                imageHeight: 80, 
                                title: 'Số lượng sản phẩm trong kho không đủ'
                            });
                        </script>";

            }


        }



        ////////////////////////////////////////////////////////////////////
        $m=new cart();      
        $thanhtoan=$m->all_thanhtoan();
        $thanhtien=$m->all_thanhtien();
    
        $tk=new Taikhoan();
        $taikhoan=$tk-> getAllTaikhoan();
        if(isset($_POST['submit-binhluan'])&& isset($_SESSION['user'])){
            $comment=$_POST['noidungbl']; 
            $rating=$_POST['sao'];
            $user_id=$_POST['user_id'];
            $product_id=$_POST['idsp'];
            $mbinhluan=new binhluan();
           $binhluan=$mbinhluan->Insert_binhluan1(null, $product_id, $user_id, $rating, $comment);
           
        }else{
            if(isset($_POST['submit-binhluan'])){
            $comment=$_POST['noidungbl']; 
            $rating=$_POST['sao'];
            $product_id=$_POST['idsp'];
            $mbinhluan=new binhluan();
           $binhluan=$mbinhluan->Insert_binhluan2(null, $product_id,$rating, $comment);
        }
    }
        $mbinhluan=new binhluan();
        $listbl = $mbinhluan->ID_binhluan_sanpham($_GET['idPro']);
        ////////////////////////////////////////////////////////////////////

        require_once "./view/client/sanphamchitiet.php";
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
        $mProduct = new Product();
        if (isset($_POST['submit-addVariant'])) {

            $product_id = $_POST['product_id'];
            $size = $_POST['size'];
            $price = $_POST['price'];
            $stock_quantity = $_POST['stock_quantity'];
            $check = $mProduct->getProductById($product_id);
            if ($check) {
                $variantExists = $mProduct->kiemTraTonTaiVariant($product_id, $size);
                if ($variantExists) {
                    $thongbao = "Sản phẩm đã tồn tại biến thể này, không thể thêm!";
                } else {
                    $addVariant = $mProduct->insertVariant(null, $product_id, $size, $price, $stock_quantity);
                    if (!$addVariant) {
                        $thongbao = "Thêm biến thể thành công!";
                    }
                }
            } else {
                $thongbao = "ID sản phẩm không tồn tại không thể thêm!";
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
    public function updateVariant()
    {
        if (isset($_GET['idVariant'])) {
            $idVariant = $_GET['idVariant'];
            $mProduct = new Product();
            $variant = $mProduct->getVariantById($idVariant);
            if (isset($_POST['submit-updateVariant'])) {
                $product_id = $_POST['product_id'];
                $size = $_POST['size'];
                $price = $_POST['price'];
                $stock_quantity = $_POST['stock_quantity'];

                $check = $mProduct->getProductById($product_id);
                if ($check) {
                    $updateVariant = $mProduct->updateVariant($product_id, $size, $price, $stock_quantity, $idVariant);
                    if (!$updateVariant) {
                        $thongbao = "Cập nhật thành công!";
                    }
                } else {
                    $thongbao = "ID sản phẩm không tồn tại không thể sửa!";
                }
            }
        }
        require_once "../view/admin/sanpham/editVariant.php";

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