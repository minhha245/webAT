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
        <input type="password" name="password" placeholder="Mật khẩu" />
        <p class="forgot-pass"><a href="verify.php">Quên mật khẩu</a></p>
        <p class="forgot-pass"><a href="changepass.php">Thay đổi mật khẩu</a></p>
        <br></br>
        <button name="dangnhap">Đăng nhập</button>
        <p class="message">Chưa đăng ký? <a href="registerview.php">Tạo tài khoản</a></p>
      </form>
    </div>
  </div>

</body>
</html>
<?php  
if(isset($_POST['dangnhap'])){
 if (isset($_POST['email']) && isset($_POST['password'])) {
}
$email      = $_POST['email'];
$password   = $_POST['password'];
$password   = md5($password); // Mã hóa md5 mật khẩu

$query = mysqli_query($connect, "SELECT
users.email, users.id as user_id, users.name as user_name,
GROUP_CONCAT(permissions.name) as permission_name,
user_has_roles.user_id,
roles.name as role_name,
roles.id as role_id
FROM users
LEFT JOIN user_has_roles ON users.id = user_has_roles.user_id
LEFT JOIN roles ON roles.id = user_has_roles.role_id
LEFT JOIN role_has_permissions ON role_has_permissions.role_id = roles.id
LEFT JOIN permissions ON role_has_permissions.permission_id = permissions.id
WHERE email = '$email' AND password = '$password' AND trangthai = 0
GROUP BY roles.id");

if (mysqli_num_rows($query) > 0) { 
    $permissions = '';
while ($row = mysqli_fetch_array($query)) {
$permissions .= $row['permission_name'];
$_SESSION['auth_user']  = [
'id'    => $row['user_id'], 
'name'  => $row['user_name'], 
'email' => $row['email'],
];
}       
$_SESSION['auth_user']['permission_name']  = explode(',', $permissions)];


header('Location: ' . 'index.php'); 
// exit();
}
else {
 echo '<script>alert("Tài khoản mật khẩu không đúng")</script>';
exit;
}
}


?> 