<div class="main-content">
  <div class="welcome_admin">Cập Nhật Banner</div>
  <?php
  if (isset($thongbao) && ($thongbao != "")) {
    echo "<h3 style='color:red;'>$thongbao</h3>";
  }

  ?>
  <div class="add">
    <form class="wrapper__form" action="" method="POST" enctype="multipart/form-data">
      <div class="form__group">
        <div class="form__label">
          <label>Chọn ảnh</label>
          <div class="form__input">
            <input type="file" name="image">
          </div>
        </div>
      </div>


      <input class="form__submit" type="submit" value="Cập nhật" name="submit-updateBanner">
    </form>
    <a class="href-listPro" href="index.php?act=listBanner">
      <div class="btn-listPro">Danh sách</div>
    </a>
  </div>





  </form>
</div>