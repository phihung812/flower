<div class="main-content">
  <div class="welcome_admin">Danh Sách Danh Mục</div>

  <?php
  // Kiểm tra và hiển thị thông báo nếu có
  if (isset($thongbao) && ($thongbao != "")) {
    echo "<h3 style='color:red;'>$thongbao</h3>";
  }
  
  ?>
  <table border="1" class="table_danhmuc">

    <tr class="thead">
      <th>stt</th>
      <th>Tên</th>
      <th>Mô tả</th>
      <th>ngày tạo</th>
      <th>ngày cập nhật</th>
      <th>Thao tác</th>
    </tr>
    <?php foreach ($list as $danhmuc) { ?>
      <tr>
        <td ><?php echo $danhmuc->id ?></td>
        <td><?php echo $danhmuc->name ?></td>
        <td><?php echo $danhmuc->description ?></td>
        <td><?php echo $danhmuc->created_at ?></td>
        <td><?php echo $danhmuc->updated_at ?></td>
        <td>
          <a href="index.php?act=delete_danhmuc&id=<?php echo $danhmuc->id ?>">
            <button>Xóa</button>
          </a>
          <a href="index.php?act=edit_danhmuc&id=<?php echo $danhmuc->id ?>">
            <button>Sửa</button>
          </a>
        </td>
      </tr>
    <?php } ?>

  </table>
  <a class="href-add_danhmuc" href="index.php?act=add_danhmuc">
    <button class="btn-table_danhmuc">Thêm Danh Mục</button>
  </a>
</div>