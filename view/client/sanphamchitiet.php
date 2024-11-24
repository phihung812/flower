
<style>
.star-rating {
  display: flex;
  flex-direction: row-reverse;
  justify-content: flex-end;
  cursor: pointer;
}

.star-rating span {
  font-size: 2rem;
  color: #ccc; /* Màu mặc định (xám) */
  transition: color 0.2s;
}
.star-rating span.active {
  color: #ffc107; /* Màu vàng khi chọn */
}
#rating-input {
  border: none; /* Bỏ khung viền */
  outline: none; /* Bỏ viền xanh khi nhấp vào */
}
    </style><main>

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

foreach ($listbl as $bl) {
 
    if (isset($userMap[$bl->user_id])) {
        $tk = $userMap[$bl->user_id];
        echo " <p>{$tk->last_name} : {$bl->comment}  {$bl->created_at} </p><p>đánh giá :{$bl->rating}sao</p><br>";     
    } else {
        echo "<p>Người ẩn danh : {$bl->comment}  {$bl->created_at}</p></p><p>đánh giá :{$bl->rating}sao</p><br>";
    }
}
?>



<!-- //////////////////////////////////////////////////////////////////////////// -->
    
<!-- đánh giá and bình luận -->
<?php if(isset($_SESSION['user'])) {?>
     <?php
     $user=$_SESSION['user'];  
     ?> 
<?php 
$hasDisplayed = false; // Biến cờ để kiểm tra form đã hiển thị hay chưa

foreach ($thanhtien as $t) {
    if ($sanphamchitiet->id == $t->product_id && !$hasDisplayed) {
        $hasDisplayed = true; // Đánh dấu là đã hiển thị form
?>
<form class="fombl" action="" method="post"> 
  <div class="star-rating">
    <span data-value="5">☆</span>
    <span data-value="4">☆</span>
    <span data-value="3">☆</span>
    <span data-value="2">☆</span>
    <span data-value="1">☆</span>
  </div>
      đánh giá  <input type="text" id="rating-input" name="sao" value="0"> 
        <input type="hidden" value="<?php echo $user->id ?>" name="user_id">      
        <input type="hidden" value="<?php echo $sanphamchitiet->id?>" name="idsp">    
        <input type="text" name="noidungbl">
        <button name="submit-binhluan">Gửi</button>
</form>
<?php 
    }
}?>

<?php }else{?>
    <?php 
$hasDisplayed = false; 
foreach ($thanhtien as $t) {
    if ($sanphamchitiet->id == $t->product_id && !$hasDisplayed) {
        $hasDisplayed = true; ?>
    <form class="fombl" action="" method="post"> 
        <div class="star-rating">
            <span data-value="5">☆</span>
            <span data-value="4">☆</span>
            <span data-value="3">☆</span>
            <span data-value="2">☆</span>
           <span data-value="1">☆</span>
        </div>
       đánh giá     <input type="text" id="rating-input" name="sao" value="0">      
            <input type="hidden" value="<?php echo $sanphamchitiet->id?>" name="idsp">    
            <input type="text" name="noidungbl">
            <button name="submit-binhluan">Gửi</button>
    </form>
<?php 
    }
}?>

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
    function updatePrice() {
        const sizeSelect = document.getElementById('size');   //truy xuất select
        const selectedOption = sizeSelect.options[sizeSelect.selectedIndex];   //lấy tùy chọn đc chọn
        const price = selectedOption.getAttribute('data-price');   //lấy giá của size đc chọn

        // Cập nhật giá hiển thị
        document.getElementById('variant-price').textContent = formatPrice(price);
    }

    // Gọi updatePrice() khi trang được load để cập nhật giá ban đầu
    document.addEventListener('DOMContentLoaded', updatePrice);


      // Lấy tất cả các ngôi sao
const stars = document.querySelectorAll('.star-rating span');
const ratingInput = document.getElementById('rating-input');
let selectedRating = 0; // Giá trị sao đã chọn

stars.forEach(star => {
  // Xử lý sự kiện click
  star.addEventListener('click', () => {
    selectedRating = parseInt(star.getAttribute('data-value')); // Lấy giá trị sao
    updateStars(); // Cập nhật giao diện ngôi sao
    ratingInput.value = selectedRating; // Gán giá trị vào input
    console.log(`Đánh giá: ${ratingInput.value} sao`); // Log giá trị để kiểm tra
  });
});

// Cập nhật trạng thái của các ngôi sao
function updateStars() {
  stars.forEach(star => {
    if (parseInt(star.getAttribute('data-value')) <= selectedRating) {
      star.classList.add('active'); // Làm sáng các sao được chọn
    } else {
      star.classList.remove('active'); // Bỏ sáng các sao không được chọn
    }
  });
}
</script>