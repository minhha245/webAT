<?php
include 'includes/database.php'; 
if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password'])) {
        $name       = trim($_POST['name']);
        $email      = trim($_POST['email']);
        $password   = trim($_POST['password']);
        $password   = md5($password); // Mã hóa md5 mật khẩu
        $create_at = date('Y-m-d H:i:s');
        $sql = "INSERT INTO users(name, email, password, created_at) VALUE ('{$name}','{$email}','{$password}','{$created_at}')"; // Tạo Query SQL
        $insert = mysqli_query($connect, $sql); // Lưu Thông tin đăng ký vào bảng users                  
        if ($insert) // nếu lưu thành công
        {
            header('Location: ' . '?page=dang-nhap'); // return redirect về login
            exit;
        }
        else // nếu thất bại
        {
            header('Location: ' . $_SERVER['HTTP_REFERER']); // return back
            exit;
        }
    }
include 'includes/nav.php';
?>
<!DOCTYPE html>
<html>

<head>
<meta charset="UTF-8">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title> Danh sách thành viên - Hệ Thống Quản Trị </title>
  
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js">
</script>   

</head>
<body>
<div class="panel" style="box-shadow: none;">
<h2 style="text-align: center;"> Thêm mới thành viên </h2>
  <form class="form_add_user" method="post" action="?page=dang-ky">
      <div class="form-group">
       <input type="text" id="login" class="form-control" name="name" placeholder="Tên tài khoản">
       </div>
       <div class="form-group">
        <input type="email" id="login" class="form-control" name="email" placeholder="Email">
        </div>
        <div class="form-group">
            <input type="password" id="password" class="form-control" name="password" placeholder="Mật khẩu">
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-sm btn-warning" value="Thêm thành viên">
        </div>
    </form>
</div>
	<style>
        .form_add_user {
            max-width: 500px;
            margin: 0 auto;
            border: 1px solid #eee;
            border-radius: 3px;
            padding: 20px;
            margin-top: 50px;
        }
   </style>
</body>
</html>