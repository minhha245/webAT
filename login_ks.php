<?php include 'includes/database.php';

?> 
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="device-width, initial-scale=1">
  <title>Đăng nhập</title>
  <link rel="stylesheet" type="text/css" href="view.css">
</head>

<Body>
  <div class="login-page">
    <div class="form">
      <form class="login-form" method="post" action="">
        <input type="text" name="email" placeholder="Tên đăng nhập" />
        <br></br>
        <button name="dangnhap">Đăng nhập</button>
      </form>
    </div>
  </div>


<?php  
if(isset($_POST['dangnhap'])){
 if (isset($_POST['email'])) {
}
$tendangnhap = $_POST['email'];
$query = mysqli_query($connect, "SELECT * FROM khaosat WHERE tendangnhap = '$tendangnhap'");

if (mysqli_num_rows($query) > 0) { 
 while ($row = mysqli_fetch_array($query)) {
 $_SESSION['khaosat']  = [
'id'    => $row['id'], 
'name'  => $row['tendangnhap'], 
'email' => $row['email'],
];
             header('Location: index_thamgiaks.php');
}
}
else {
 echo '<script>alert("Tài khoản mật khẩu không đúng")</script>';
exit;
}
}
?> 