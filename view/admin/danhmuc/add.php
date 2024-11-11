<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="view/css/admin.css">
    <style>
        body{
      margin-left: 500px;
      margin-top:50px;
    }
    </style>
</head>
<body>
 
   <div class ="them_danhmuc"> <h1>thêm sản phẩm danh mục</h1>
    <form action="index.php?act=add_danhmuc" method="post">
      <h3>tên</h3>
    <input class="name" type="text" name="name"><br>
  <h3>mô tả</h3>
    <input class="name" type="text" name="description"><br>
<h3>ngày tạo</h3>
    <input class="name" type="date" name="created_at"><br>
<h3>ngày cập nhật</h3>
    <input class="name" type="date" name="updated_at"><br>
<br><br><br>
    <button name="submit-add_danhmuc">thêm</button>
    </form>
</div> 
</body>
</html>
