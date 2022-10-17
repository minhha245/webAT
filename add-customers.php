<?php
include 'includes/database.php'; 
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
<h2 style="text-align: center;"> Thêm mới Khách hàng </h2>
  <form class="form_add_user" method="post" action="">
      <div class="form-group">
       <input type="text" id="login" class="form-control" name="name" placeholder="Họ tên">
       </div>
       <div class="form-group">
        <input type="email" id="login" class="form-control" name="email" placeholder="Email">
        </div>
         <div class="form-group">
            <input type="password" id="password" class="form-control" name="password" placeholder="Mật khẩu">
        </div>
        <div class="form-group">
        <input type="text" id="login" class="form-control" name="diachi" placeholder="Địa chỉ">
        </div>
        <div class="form-group">
        <input type="text" id="login" class="form-control" name="sdt" placeholder="Số điện thoại">
        </div>
        <div class="form-group">
        <input type="text" id="login" class="form-control" name="dinhdanh" placeholder="Mã định danh">
        </div>
        <div class="form-group">
        <input type="text" id="login" class="form-control" name="mota" placeholder="Mô tả nội dung yêu cầu">
        </div>
        <div class="form-group">
        <input type="text" id="login" class="form-control" name="giatien" placeholder="Giá tiền">
        </div>
        <div class="form-group">
        <input type="text" id="login" class="form-control" name="soluong" placeholder="Số lượng khảo sát">
        </div>
        <div class="form-group">
        <input type="text" id="login" class="form-control" name="socau" placeholder="Số lượng câu hỏi khảo sát">
        </div>
        <!-- <div class="form-group">
            <input type="password" id="password" class="form-control" name="password" placeholder="Mật khẩu">
        </div> -->
        <div class="form-group">
                         <label for="exampleInputEmail1">Trạng thái</label>
                         <select name="tinhtrang" class="custom-select">
                          <option value="0">Kích hoạt</option>
                          <option value="1">Không kích hoạt</option>
                      </select>
                  </div>
        <div class="form-group">
            <input name="submit" type="submit" class="btn btn-sm btn-warning" value="Thêm Khách hàng">
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
<?php

if (isset($_POST['submit'])) {
   

if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['sdt']) && isset($_POST['password'])) {
        $name = trim($_POST['name']);
        $address = $_POST['diachi'];
        $phone = $_POST['sdt'];
        $madd = $_POST['dinhdanh'];
        $email = trim($_POST['email']);
        $password = md5($_POST['password']);
        $noidung = $_POST['mota'];
        $price = $_POST['giatien'];
        $soluong = $_POST['soluong'];
        $socau =$_POST['socau'];
        $trangthai = $_POST['tinhtrang'];
        $sql = "INSERT INTO `customers`(`name`, `address`, `phone`, `madd`, `email`,`password`, `noidung`, `price`, `soluong_KS`, `socau_KS`, `trangthai`) VALUE ('{$name}','{$address}','{$phone}','{$madd}','{$email}', '{$password}','{$noidung}','{$price}','{$soluong}','{$socau}','{$trangthai}')";

        $insert = mysqli_query($connect, $sql); // Lưu Thông tin đăng ký vào bảng users                  
        if ($insert) 
        {

            if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password'])) {
        $name       = trim($_POST['name']);
        $email      = trim($_POST['email']);
        $password   = trim($_POST['password']);
        $password   = md5($password); // Mã hóa md5 mật khẩu
        $created_at = date('Y-m-d H:i:s');
        $sql = "INSERT INTO users(name, email, password, created_at, trangthai) VALUE ('{$name}','{$email}','{$password}','{$created_at}','{$trangthai}')"; // Tạo Query SQL
        $insert = mysqli_query($connect, $sql); // Lưu Thông tin đăng ký vào bảng users 
        $user_id = mysqli_insert_id($connect);
         mysqli_query($connect, "INSERT INTO user_has_roles(role_id,user_id) VALUE ('3','{$user_id}')");                 
       
    }
            // header('Location: customers.php');
            echo '<script>alert("Thêm thành công")</script>';

             // return redirect về login
           
        }
        else // nếu thất bại
        {
             echo '<script>alert("Thêm thất bại")</script>';
            header('Location: ' . $_SERVER['HTTP_REFERER']); // return back
            exit;
        }
    }
}

?>