<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="admin.css">
  <style>
  body{
      margin-left: 300px;
    }
  </style>
</head>
<body>
<div>
<table class="table_danhmuc">
  <thead>
    <tr>
        <th>stt</th>
        <th>name</th>
        <th>mô tả</th>
        <th>ngày tạo</th>
        <th>ngày cập nhật</th>
        <th>hành động</th>
    </tr>
    <?php foreach($list as $danhmuc){?>
      <tr>
        <td><?php echo $danhmuc->id ?></td>
        <td><?php echo $danhmuc->name ?></td>
        <td><?php echo $danhmuc->description ?></td>
        <td><?php echo $danhmuc->created_at ?></td>
        <td><?php echo $danhmuc->updated_at ?></td>
        <td>
        <a href="index.php?act=delete_danhmuc&id=<?php echo $danhmuc->id ?>"><input type="button" value="Xóa"></a>
        <a href="index.php?act=edit_danhmuc&id=<?php echo $danhmuc->id ?>"><input type="button" value="sửa"></a>
        </td>
      </tr>
   <?php }?>


    


       
    </thead>


</table>
<button class ="fon_danhmuc"><a href="index.php?act=add_danhmuc" >thêm</a></button>
</div>

</body>
</html>

