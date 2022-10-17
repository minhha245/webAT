<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="device-width, initial-scale=1">
    <title>Đổi mật khẩu</title>
    <link rel="stylesheet" type="text/css" href="view.css">
</head>

<Body>
    <div class="changepass-page">
        <div class="form">
            <form class="login-form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <input type="text" name="email" placeholder="Email" />
                <input type="password" name="opassword" placeholder="Mật khẩu cũ" />
                <input type="password" name="npassword" placeholder="Mật khẩu mới" />
                <input type="password" name="rnpassword" placeholder="Nhập lại mật khẩu mới" />
                <button name="changebtn">Đổi mật khẩu</button>
                <p class="message"><a href="login.php">Đăng nhập</a></p>
            </form>
        </div>
    </div>

    <?php

include 'includes/database.php';
    if (isset($_POST['changebtn'])) {
        if ($_POST['email'] === null) {
             header("location: changepass.php");
            echo '<script> alert("Không bỏ trống email") </script>';
           
        }
        if ($_POST['opassword'] === null) {
            header("location: changepass.php");
            echo '<script> alert("Các trường không được bỏ trống") </script>';
            
        }
        if ($_POST['npassword'] === null) {
            header("location: changepass.php");
            echo '<script> alert("Các trường không được bỏ trống") </script>';
            
        }
        if ($_POST['rnpassword'] === null) {
              header("location: changepass.php");
            echo '<script> alert("Các trường không được bỏ trống") </script>';
          
        }

        $email = $_POST['email'];
        $opassword = $_POST['opassword'];
        $npassword = $_POST['npassword'];
        $rnpassword = $_POST['rnpassword'];
       
        $sql = "SELECT * FROM users WHERE email= '$email'";
        $ud = $connect->query($sql);
        if ($ud->num_rows > 0) {
            $row = $ud->fetch_assoc();
            if (($row["password"] === hash('md5', $opassword))) {
                if (($npassword === $rnpassword)) {
                    if (($npassword === $rnpassword)) {


                        $hashnpass = hash('md5', $npassword);

                        $to = $email;
                        $subiject = "Change Password";
                        $message = "Bạn đã thay đổi mật khẩu. Nếu đó không phải là bạn thì xác nhận lại!";
                        $header = "From: minhha.com";
                        if (mail($to, $subiject, $message, $header) == true) {
                            $sua = "UPDATE users SET password='$hashnpass' WHERE email='$email'";
                           $connect->query($sua);
                            $connect->close();
                        }
                         echo '<script>alert("Đổi mật khẩu thành công")</script>';
                    }
                }
            } else  echo '<script>alert("Mật khẩu không khớp")</script>';
        }
    }
    ?>

</Body>


</html>