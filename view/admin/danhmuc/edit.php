<div class="main-content">
  <div class="welcome_admin">Sửa Danh Mục</div>

  <div class="add">
    <form class="wrapper__form" action="" method="POST" enctype="multipart/form-data">
      <div class="form__group">
        <div class="form__label">
          <label>Tên danh mục</label>
          <div class="form__input">
            <input type="text" required name="name" value="<?php echo $danhmuc->name ?>">
          </div>
        </div>
      </div>

      <div class="form__group">
        <div class="form__label">
          <label>Mô tả</label>
          <div class="form__input">
            <input type="text" name="description" required value="<?php echo $danhmuc->description ?>">
          </div>
        </div>
      </div>

      <input class="form__submit" type="submit" value="Cập nhật" name="submit-editdm">
      <a class="href-listPro" href="index.php?act=list_danhmuc">
        <div class="btn-listPro">Danh sách</div>
      </a>
  </div>

  </form>
</div>