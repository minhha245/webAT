<?php include 'includes/database.php';

?> 
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="device-width, initial-scale=1">
    <title></title>
    <link rel="stylesheet" type="text/css" href="view.css">
</head>

<Body>
    <div class="verify-page">
        <div class="form">
            <form class="register-form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <input type="text" name="email" placeholder="Nhập email của bạn" />
                <button name="registerbtn">Xác nhận</button>
                <p class="message"><a href="login.php">Đăng nhập</a></p>
            </form>
        </div>
    </div>

    <?php

    if (isset($_POST['registerbtn'])) {
        if ($_POST['email'] === null) {
            echo '<script> alert("Không bỏ trống email") </script>';
        } else {
            $email = $_POST['email'];
            $result = true;
            $newpass = substr(md5(rand()), 0, 9);
            $to = $email;
            $subiject = "New password";
            $message = "Mật khẩu mới là: " . $newpass;
            $header = "From: nguyenlam.com";
            $hnewpass = hash('md5', $newpass);
            if (mail($to, $subiject, $message, $header) == true) {
              
                $sua = "UPDATE users SET password='$hnewpass' WHERE email='$email'";
               $connect->query($sua);
                $connect->close();            
                echo '<script> alert("Mật khẩu mới cấp lại đã có trong mail") </script>';
                
                header('Location: ' . 'login.php'); 

                
            } else  echo '<script type="text/javascript"> alert("Lỗi gửi mail") </script>';
        }
    } 
    ?>

</Body>

</html>