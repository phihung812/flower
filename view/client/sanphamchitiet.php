<style>
/* Styling for the .box3 container */
.box3 {
  display: flex;
  align-items: center; /* Align items vertically in the center */
  gap: 10px; /* Space between the input and button */
  margin-top: 15px; /* Space above the container */
}

/* Styling for the input field */
.bl1 {
  flex: 1; /* Make the input take up remaining space in the row */
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 4px;
  font-size: 16px;
  box-sizing: border-box; /* Ensure padding is included in width calculation */
}

.bl1:focus {
  outline: none;
  border-color: #007bff; /* Highlight the border when focused */
  box-shadow: 0 0 5px rgba(0, 123, 255, 0.5); /* Glow effect on focus */
}

/* Styling for the submit button */
.bl2 {
  padding: 10px 20px;
  background-color: #ed24aa; /* Blue background color */
  color: #fff; /* White text color */
  border: none;
  border-radius: 4px;
  cursor: pointer;
  font-size: 16px;
  transition: background-color 0.3s ease;
}

.bl2:hover {
  background-color: #0056b3; /* Darker blue on hover */
}

.bl2:active {
  background-color: #004085; /* Even darker blue when clicked */
}



.star-rating {
    display: flex;
    flex-direction: row-reverse; /* Ngôi sao từ phải sang trái */
    justify-content: flex-end;
    cursor: pointer;
}
.box1{
    display: flex;
}


.star-rating span {
    margin-top:-8px;
    font-size: 1.5rem;
    color: #ccc; /* Màu mặc định (xám) */
    transition: color 0.2s;
}

.star-rating span.active {
    color: #ffc107; /* Màu vàng khi chọn */
}

#rating-inpu{

    border: none;
    background: none;
    margin-left: 10px;
    width: 9px;
    text-align: center;
    outline: none;
    cursor: default;
}

.star-ratin span {
    margin-top:10px;
    font-size: 30px;
    color: gray; /* Màu mặc định cho ngôi sao */
    cursor: pointer;
}

.star-ratin .active {
    color: gold; /* Màu vàng cho các ngôi sao đã chọn */
}
.leson{
    display: flex;
}
    </style>
<main>

    <div class="cart">
        <div class="product-infor-cart">
            <div class="image-product-cart">
                <img src="<?php echo 'duan01/' . $sanphamchitiet->main_image ?>" alt="">
            </div>
            <div class="cart-right">
                <div class="name-product-cart">
                    <h2><?php echo $sanphamchitiet->name ?></h2>
                    
                </div>
                
                    <div class="price-product-cart">
                        <?php if (isset($sizePro) && !empty($sizePro)) { ?>
                            <h2 id="variant-price"><?php echo number_format($sizePro[0]->price, 0, ',', '.') ?> VND</h2>
                        <?php } else { ?>
                            <h2 id="variant-price"><?php echo number_format($sanphamchitiet->base_price, 0, ',', '.') ?> VND</h2>
                        <?php } ?>
                    </div>
                
                    
                <div class="phone-cart">
                    <h3>Gọi ngay: </h3>
                    <div class="box-phone">
                        <h2>0359 058 116</h2>
                    </div>
                </div>
                <div class="chat-cart">
                    <h3 style="display: inline;">Chat ngay: </h3>
                    <div class="chat">
                        <a href=""><img src="https://www.flowercorner.vn/image/icon/ms.png" alt=""></a>
                        <a href=""><img src="https://www.flowercorner.vn/image/icon/zalo.png" alt=""></a>
                    </div>
                </div>
                <div class="ship-cart">
                    <h3>Vận chuyển:</h3>
                    <p>Miễn phí giao hoa khu vực nội thành TP.HCM & Hà Nội</p>
                </div>
                <form action="" method="POST" class="qti-variant">
                    <input type="hidden" id="product-id" value="<?php echo $sanphamchitiet->id; ?>">
                    <div class="quantyti">
                        <h3>SỐ LƯỢNG:</h3>
                        <input type="number" name="quantity" id="" value="1">
                    </div>
                    <?php if (isset($sizePro) && (!empty($sizePro))) { ?>
                        <div class="variant">
                            <h3>SIZE:</h3>
                            <select id="size" name="size" onchange="updatePrice()">
                                <!-- Các option sẽ được lấy từ database -->
                                <?php foreach ($sizePro as $sizes) { ?>
                                    <option value="<?php echo $sizes->size; ?>" data-price="<?php echo $sizes->price; ?>">
                                        <?php echo $sizes->size; ?>
                                    </option>
                                <?php } ?>
                            </select>

                        </div>
                    <?php } ?>

                    <div class="btn-cart">
                        <button name="submit-addCart">Thêm vào giỏ hàng</button>
                        <button>Đặt hàng</button>
                    </div>
                </form>

            </div>
        </div>
        <div class="description">
            <h2>Mô tả sản phẩm</h2>
            <p>
                <?php echo $sanphamchitiet->description ?>
            </p>
            <p>*Sản phẩm cần đặt trước, sản phẩm chỉ có tại HCM.</p>
            <h3>Lưu ý:</h3>
            <em>**Do được làm thủ công, nên sản phẩm ngoài thực tế sẽ có đôi chút khác biệt so với hình ảnh trên
                website. Tuy nhiên, Flowercorner cam kết hoa sẽ giống khoảng 80% so với hình ảnh.</em><br><br>
            <em>** Vì các loại hoa lá phụ sẽ có tùy vào thời điểm trong năm, Flowercorner đảm bảo các loại hoa
                chính, các loại hoa lá phụ sẽ thay đổi phù hợp giá cả và thiết kế sản phẩm.</em>
        </div>
        <div class="binhluan">
            <h2>đánh giá sản phẩm</h2>
<!-- //////////////////////////////////////////////////////////////////////////// -->

<?php  
$userMap = [];
foreach ($taikhoan as $tk) {
    $userMap[$tk->id] = $tk;
}

// Đảo ngược thứ tự của $listbl
$listbl = array_reverse($listbl);

foreach ($listbl as $bl) {
    if (isset($userMap[$bl->user_id])) {
        $tk = $userMap[$bl->user_id];
        ?>
        <div>
            <?php echo $bl->created_at; ?>
            <div><?php echo $tk->last_name; ?>: <?php echo $bl->comment; ?></div>
            <div class='box1'>
                Đánh giá: <?php echo $bl->rating; ?> sao
                <div id="star" class="star-rating">
                    <span data-value="5">☆</span>
                    <span data-value="4">☆</span>
                    <span data-value="3">☆</span>
                    <span data-value="2">☆</span>
                    <span data-value="1">☆</span>
                </div>
                <input type="hidden" onclick="updateStars()" class="rating-input" value="<?php echo $bl->rating; ?>">
            </div>
        </div>
        <br><br>
        <?php
    } else {
        ?>
        <div>
            <?php echo $bl->created_at; ?>
            <div>Người ẩn danh: <?php echo $bl->comment; ?></div>
            <div class='box1'>
              Đánh giá: <?php echo $bl->rating; ?> sao
                <div id="star" class="star-rating">
                    <span data-value="5">☆</span>
                    <span data-value="4">☆</span>
                    <span data-value="3">☆</span>
                    <span data-value="2">☆</span>
                    <span data-value="1">☆</span>
                </div>
                <input type="hidden" onclick="updateStars()" class="rating-input" value="<?php echo $bl->rating; ?>">
            </div>
        </div>
        <br><br>
        <?php
    }
}
?>


<!-- //////////////////////////////////////////////////////////////////////////// -->
    
<!-- đánh giá and bình luận -->
<?php if(isset($_SESSION['user'])) { ?>
    <?php
    $user = $_SESSION['user'];  
    ?> 
    <?php 

    foreach ($thanhtien as $t) {
        if ($sanphamchitiet->id == $t->product_id) {
    // Đánh dấu là đã hiển thị form

            foreach ($thanhtoan as $order) {
                // Kiểm tra nếu đơn hàng có trạng thái là "shipped" và thuộc về người dùng hiện tại
                if($t->order_id==$order->id&&$user->id==$order->user_id){

               

                
                
                 if ($order->status =="delivered" ) {
                    // Hiển thị form bình luận
                    ?>
                    <form class="fomb" action="" method="post" class="binhluan"> 
                        <div>
                            <div class="leson">đánh giá sản phẩm : 
                                <div class="star-ratin" style="margin-top:-15px;">
                                    <span data-value="1">☆</span>
                                    <span data-value="2">☆</span>
                                    <span data-value="3">☆</span>
                          
                                    <span data-value="4">☆</span>
                                    <span data-value="5">☆</span>
                                </div>
                                <div><input type="text" id="rating-inpu" name="sao" value="0"> sao</div>
                            </div> 
                        </div>
                        <input type="hidden" value="<?php echo $sanphamchitiet->id ?>" name="idsp">  
                        <div class="box3">
                            <input type="hidden" value="<?php echo $user->id ?>" name="user_id"> 
                            <input type="text" name="noidungbl" placeholder="Nhập bình luận của bạn" class="bl1">
                            <button name="submit-binhluan" class="bl2">Gửi</button>
                        </div>  
                    </form>
                    <?php
                    break;  // Dừng vòng lặp sau khi tìm thấy trạng thái "shipped"
                
           
            
        }
           
           
           
            }
            }
        }
    }
    ?>

<?php } else{?>   
    <?php 
$formDisplayed = false; // Biến cờ kiểm tra form đã hiển thị

foreach ($thanhtien as $t) {
    if ($sanphamchitiet->id == $t->product_id && !$formDisplayed) {
        foreach ($thanhtoan as $order) {
            if ($t->order_id == $order->id) {
                    if(isset($order->user_id) ){
                        echo"";
                    }else{
                        if ( $order->status == "delivered") {
                    ?>
                    <form class="fomb" action="" method="post" class="binhluan"> 
                        <div>
                            <div class="leson">đánh giá sản phẩm : 
                                <div class="star-ratin" style="margin-top:-15px;">
                                    <span data-value="1">☆</span>
                                    <span data-value="2">☆</span>
                                    <span data-value="3">☆</span>
                                    <span data-value="4">☆</span>
                                    <span data-value="5">☆</span>
                                </div>
                                <div><input type="text" id="rating-inpu" name="sao" value="0"> sao</div>
                            </div> 
                        </div>
                        <input type="hidden" value="<?php echo $sanphamchitiet->id ?>" name="idsp">  
                        <div class="box3">
                            <input type="text" name="noidungbl" placeholder="Nhập bình luận của bạn" class="bl1">
                            <button name="submit-binhluan" class="bl2">Gửi</button>
                        </div>  
                    </form>
                    <?php
                    $formDisplayed = true; // Đánh dấu form đã hiển thị
                    break; // Dừng vòng lặp trong `thanhtoan`   
                    }
                  
                }
            }
        }
        if ($formDisplayed) {
            break; // Dừng vòng lặp ngoài nếu form đã hiển thị
        }
    }
}
?>

    <?php }?>

<!-- //////////////////////////////////////////////////////////////////////////// -->
                </div>

        <h2>SẢN PHẨM LIÊN QUAN</h2>
        <div class="products-relate">
            <?php foreach ($productRelate as $product) { ?>
                <a href="index.php?act=sanphamchitiet&idPro=<?php echo $product->id ?>">
                    <div class="relate">
                        <img src="<?php echo 'duann01/' . $product->main_image ?>" alt="">
                        <h3><?php echo $product->name ?></h3>
                        <p><?php echo number_format($product->base_price, 0, ',', '.') ?> VND</p>
                    </div>
                </a>
            <?php } ?>

        </div>

    </div>
</main>
<script>
    function formatPrice(price) {
        return price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") + " VND";
    }
    document.addEventListener('DOMContentLoaded', () => {
    const stars = document.querySelectorAll('.star-ratin span');
    const ratingInput = document.getElementById('rating-inpu');

    // Xử lý khi click vào ngôi sao
    stars.forEach(star => {
        star.addEventListener('click', () => {
            const selectedValue = parseInt(star.getAttribute('data-value')); // Lấy giá trị của sao được chọn
            updateStars(selectedValue); // Cập nhật giao diện ngôi sao
            ratingInput.value = selectedValue; // Gán giá trị sao vào input
        });
    });

    // Cập nhật trạng thái ngôi sao
    function updateStars(rating) {
        stars.forEach(star => {
            const value = parseInt(star.getAttribute('data-value'));
            if (value <= rating) {
                star.classList.add('active'); // Thêm màu vàng
            } else {
                star.classList.remove('active'); // Xóa màu vàng
            }
        });
    }
});










function updateStars() {
    const ratingInputs = document.querySelectorAll('.rating-input'); // Lấy tất cả input có class .rating-input

    ratingInputs.forEach(input => {
        const stars = input.previousElementSibling.querySelectorAll('span'); // Tìm các ngôi sao liên quan
        const rating = parseInt(input.value, 10); // Lấy giá trị từ input

        // Kiểm tra giá trị hợp lệ


        // Cập nhật trạng thái ngôi sao
        stars.forEach(star => {
            const value = parseInt(star.getAttribute('data-value'), 10);
            if (value <= rating) {
                star.classList.add('active'); // Thêm màu vàng
            } else {
                star.classList.remove('active'); // Xóa màu vàng
            }
        });
    });
}

// Gọi hàm cập nhật khi trang tải
window.addEventListener('DOMContentLoaded', () => {
    updateStars(); // Cập nhật tất cả ngôi sao khi tải trang
});

// Tự động cập nhật khi giá trị trong input thay đổi
document.querySelectorAll('.rating-input').forEach(input => {
    input.addEventListener('input', updateStars); // Cập nhật từng input khi thay đổi
});


</script>