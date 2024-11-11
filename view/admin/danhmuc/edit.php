<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body{
      margin-left :500px;
      margin-top:50px;
    }
    .sua_danhmuc{
    padding: 50px;
    width: 400px;
    background-color: #fff;
  } 
  .sua_danhmuc form input{
    font-size: 25px;
  }
  .sua_danhmuc form {
    margin-left:40px;
  }
  .sua_danhmuc form #button{
    margin-left: 90px;
    font-size: 25px;
    width: 200px;
    padding:10px;
    border-radius: 10px;
    background-color:  #00ff15;
  }
    </style>
</head>
<body>
 <div class="sua_danhmuc">
  <h1 style="   margin-left:40px;">sửa danh mục</h1>
<form action="" method="post" >
    
<h3>tên</h3>
<input type="text" value="<?php echo $danhmuc->name ?>" name="name"><br>
<h3>mô tả</h3>
<input type="text" value="<?php echo $danhmuc->description?>" name="description"><br>
<h3>ngày tạo</h3>
<input type="date" value="<?php echo $danhmuc->created_at?>" name="created_at"><br>
<h3>ngày cập nhập</h3>
<input type="date" value="<?php echo $danhmuc->updated_at?>" name="updated_at"><br><br>
<input type="submit" name="submit-editdm" value="SỬA" id=button>

</form>
</div>   
</body>
</html>




